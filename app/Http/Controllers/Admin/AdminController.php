<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\CustomizedProduct;
use App\Models\Order;
use App\Models\AddOns;
use App\Models\Payment;
use App\Models\OrderItem;
use App\Models\CustomerOrder;
use App\Models\DailySalesReport;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::latest()->paginate(5);
        return view('admin.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permissions = Permission::all();
        try {
            // Validate the request data
            $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['email', 'required', 'unique:users'],
                'password' => ['required', 'confirmed', 'min:6'],
                'role' => ['required', Rule::in(['Cashier', 'Kitchen'])],
            ]);

            // Create a new user instance
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Save the user to the database
            $user->save();

            // Assign the role to the user based on the selected value
            $user->assignRole($request->role);

            // Redirect to the list of users with a success message
            return redirect()->route('admin.index')->with(['success' => 'User created successfully', 'success_modal' => true]);
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'User not registered. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $permissions = Permission::all();
        return view('admin.edit', compact('user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['email', 'required'],
            'role' => ['required', Rule::in(['Cashier', 'Kitchen'])],
        ]);

        try {
            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            // Update the role for the user based on the selected value
            $user->syncRoles($request->role);

            // Redirect to the list of users with a success message
            return redirect()->route('admin.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if something goes wrong
            return redirect()->back()->with('error', 'User not updated. Please try again.');
        }
    }

    /**
     * Disable the specified user.
     */
    public function disableUser(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_disabled = true;
            $user->save();
            
            Session::flash('success', 'User has been disabled successfully');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User not disabled');
        }
    }

    /**
     * Enable the specified user.
     */ 
    public function enableUser(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_disabled = false;
            $user->save();
            
            Session::flash('success', 'User has been enabled successfully');
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            Session::flash('error', 'User not enabled');
            return redirect()->back();
        }
    }

    /**
     * Toggle the user status via AJAX.
     */
    public function toggleStatus(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $user->update(['is_disabled' => !$user->is_disabled]);
            return response()->json(['is_disabled' => $user->is_disabled], 200);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    /**
     * Show roles assignment form.
     */
    public function assignRoles(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.assign_roles', compact('user', 'roles'));
    }

    /**
     * Handle the role assignment form submission.
     */
    public function storeRoles(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'roles' => 'array', // Make sure roles is an array
        ]);

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);

        // Role assignment successful message
        Session::flash('success', "Roles have been assigned successfully");

        // Redirect to the list of users
        return redirect()->route('admin.index');
    }

    /**
     * Display daily sales report.
     */
    public function adminDailySalesReport(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'this_month');
        $currentDate = now()->toDateString();

        $query = DailySalesReport::query();

        if ($dateFilter == 'this_month') {
            $query->whereMonth('report_date', Carbon::now()->month);
        } elseif ($dateFilter == 'today') {
            $query->whereDate('report_date', $currentDate);
        } else {
            // Handle month filters by converting to a number
            $monthNumber = Carbon::parse($dateFilter)->month;
            $query->whereMonth('report_date', $monthNumber);
        }

        // Calculate total cash, gcash, and total sales
        $totalCash = $query->sum('total_cash') ?: 0;
        $totalGCash = $query->sum('total_gcash') ?: 0;
        $totalSales = $query->sum('total_sales') ?: 0;

        // If filtering for today, update or create the DailySalesReport entry based on the Order model
        if ($dateFilter == 'today') {
            $orderTotals = Order::where('status', 'Done')
                ->whereDate('created_at', $currentDate)
                ->selectRaw('SUM(CASE WHEN payment_method = "Cash" THEN total_amount ELSE 0 END) as total_cash')
                ->selectRaw('SUM(CASE WHEN payment_method = "GCash" THEN total_amount ELSE 0 END) as total_gcash')
                ->first();

            $totalCash = $orderTotals->total_cash ?: 0;
            $totalGCash = $orderTotals->total_gcash ?: 0;
            $totalSales = $totalCash + $totalGCash;

            // Update or create a new DailySalesReport entry for today
            DailySalesReport::updateOrCreate(
                ['report_date' => $currentDate],
                [
                    'total_cash' => $totalCash,
                    'total_gcash' => $totalGCash,
                    'total_sales' => $totalSales,
                ]
            );
        }

        // Fetch reports for the view
        $reports = $query->get();

        // Calculate total collectables (cash) and receivables (gcash) for the whole month
        $totalCollectablesForMonth = $reports->sum('total_cash');
        $totalReceivablesForMonth = $reports->sum('total_gcash');

        // Calculate total sales for the whole month
        $totalSalesForMonth = $reports->sum('total_sales');

        // Calculate total sales for today
        $totalSalesForToday = ($dateFilter == 'today') ? $totalSales : 0;

        // Display the results
        return view('admin.daily_sales_report', compact(
            'reports',
            'dateFilter',
            'totalSalesForMonth',
            'totalSalesForToday',
            'totalCollectablesForMonth',
            'totalReceivablesForMonth',
            'totalCash',
            'totalGCash',
            'totalSales'
        ));
    }
}
