<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Product\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Display the orders of the authenticated user
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('users.myorders', compact('orders')); 
    }
    
    // Display the settings page for the authenticated user
    public function settings()
    {
        $user = Auth::user();
        $mfa_enabled = $user->google2fa_secret ? true : false; // Check if MFA is enabled for the user
        return view('users.settings', compact('user', 'mfa_enabled')); 
    }
    
    // Update the settings of the authenticated user
    public function updateUserSettings(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10', 
        ]);
    
        // Find the user by ID
        $user = User::find($id);
    
        // If user is not found, return a 404 error
        if (!$user) {
            abort(404, 'User not found');
        }
    
        // Update the user's data with the validated request data
        $user->update($request->all());
    
        // Redirect back to the settings page with a success message
        return redirect()->route('users.settings')->with('update', 'User data updated successfully');
    }
}
