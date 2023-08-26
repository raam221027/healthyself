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

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
       
        $users = User::latest()->paginate(8);   
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

// public function login(Request $request)
// {
//     $credentials = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     $user = User::where('email', $request->email)->first();

//     if ($user && $user->canLogin()) {
//         if ($user->attemptLogin($request->password)) {
//             // Authentication successful
//             $request->session()->regenerate();

//             return redirect()->intended('home');
//         }
//     }

//     // Authentication failed
//     return redirect()->back()->with('error', 'Invalid credentials');
// }
}



