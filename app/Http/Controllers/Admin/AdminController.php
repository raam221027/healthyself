<?php

namespace App\Http\Controllers\Admin;



use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
use App\Http\Controllers\Response;



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
            if ($request->role === 'Cashier') {
                $user->assignRole('Cashier');
            } elseif ($request->role === 'Kitchen') {
                $user->assignRole('Kitchen');
            }
    
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $permissions = Permission::all();
        return view ('admin.edit', compact(['user', 'permissions']));
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
        'role' => ['required', Rule::in(['Cashier', 'Kitchen'])], // Make sure role is one of 'cashier' or 'kitchen'
    ]);

    try {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Update the role for the user based on the selected value
        if ($request->role === 'Cashier') {
            $user->assignRole('Cashier');
            $user->removeRole('Kitchen'); // Remove the 'kitchen' role if it was assigned before
        } elseif ($request->role === 'Kitchen') {
            $user->assignRole('Kitchen');
            $user->removeRole('Cashier'); // Remove the 'cashier' role if it was assigned before
        }

        // Redirect to the list of users with a success message
        return redirect()->route('admin')->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        // Redirect back with an error message if something goes wrong
        return redirect()->back()->with('error', 'User not updated. Please try again.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    /**
 * Disable the specified resource.
 */
// public function destroy(string $id)
// {
//     try {
//         $user = User::findOrFail($id);
//         $user->is_disabled = true; // Set is_disabled to true
//         $user->save(); // Save the changes
//     } catch (\Exception $e) {
//         return redirect()->back()->with('message', "User not disabled");
//     }
    
//     return redirect()->route('users')->with('success', "User has been disabled successfully");
// }

/**
     * Disable the specified user.
     */
    public function disableUser(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_disabled = true;
            $user->save();
            
            session()->put('failed', 'User has been disabled successfully'); // Store success message
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back();
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

public function toggleStatus(Request $request)
{
    $user = User::find($request->id);

    if ($user) {
        $user->update(['is_disabled' => !$user->is_disabled]);
        return response()->json(['is_disabled' => $user->is_disabled], 200);
    }

    return response()->json(['error' => 'User not found'], 404);
}



//Assigning roles
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
    return redirect()->route('admin');
}

public function adminDailySalesReport(Request $request)
{
    $query = DailySalesReport::query();
    $dateFilter = $request->date_filter;

    switch ($dateFilter) {
        case 'today':
            $query->whereDate('created_at', Carbon::today());
            break;
        case 'yesterday':
            $query->whereDate('created_at', Carbon::yesterday());
            break;
        case 'this_week':
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            break;
        case 'last_week':
            $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
            break;
        case 'this_month':
            $query->whereMonth('created_at', Carbon::now()->month);
            break;
        case 'last_month':
            $query->whereMonth('created_at', Carbon::now()->subMonth()->month);
            break;
        case 'this_year':
            $query->whereYear('created_at', Carbon::now()->year);
            break;
        case 'last_year':
            $query->whereYear('created_at', Carbon::now()->subYear()->year);
            break;
    }

    $reports = $query->get();

    // Calculate new totals based on the latest orders
    $currentDate = now()->toDateString();
    $newTotalCash = Order::where('payment_method', 'Cash')
        ->where('status', 'Done')
        ->whereDate('created_at', $currentDate)
        ->sum('total_amount');

    $newTotalGCash = Order::where('payment_method', 'GCash')
        ->where('status', 'Done')
        ->whereDate('created_at', $currentDate)
        ->sum('total_amount');

    $newTotalSales = $newTotalCash + $newTotalGCash;

    // Update or create the daily sales report record
    $dailyReport = DailySalesReport::updateOrCreate(
        ['report_date' => $currentDate],
        [
            'total_cash' => $newTotalCash,
            'total_gcash' => $newTotalGCash,
            'total_sales' => $newTotalSales,
        ]
    );

    return response()->view('admin.daily_sales_report', compact('reports', 'dateFilter'));
}
}





