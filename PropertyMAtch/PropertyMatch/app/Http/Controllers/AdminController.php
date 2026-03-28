<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get counts of all properties
        $AllCount = Property::count(); // All properties
        $ActiveCount = Property::where('status', 'active')->count(); // Active properties
        $PendingCount = Property::where('status', 'pending')->count(); // Pending properties

        // Pass data to view
        return view('adminDashboards.admin-dashboard', compact('AllCount', 'ActiveCount', 'PendingCount'));
    }

//    ----active properties for showing on admin dashboard-
    public function activeProperties()
    {

        $properties = Property::where('status', 'active')->get();
        return view('adminDashboards.admin-active-properties', compact('properties'));


    }

    public function show($id)
    {
        $property = Property::findOrFail($id);

        // Fetch the user (registration) who owns the property
        $user = Registration::find($property->user_id);

        return view('adminDashboards.adminproperty-detail', compact('property', 'user'));
    }
//    =================================pending properties==================================

    public function pendingProperties()
    {
        $properties = \App\Models\Property::where('status', 'pending')->get();

        return view('adminDashboards.admin-pending-properties', compact('properties'));
    }

//    ====================manage properties=============
    public function manageProperties()
    {
        $properties = \App\Models\Property::all(); // Fetch all properties
        return view('adminDashboards.manage-properties', compact('properties'));
    }


    public function editProperty($id)
    {
        $property = \App\Models\Property::findOrFail($id);
        return view('adminDashboards.edit-property', compact('property'));
    }

    public function updateProperty(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:active,pending,sold,reject',
        ]);

        $property = \App\Models\Property::findOrFail($id);

        // Only update if status changed
        if ($property->status !== $request->status) {
            $property->status = $request->status;
            $property->save();
            return redirect()->route('admin.manage.properties')->with('success', 'Property status updated successfully.');
        }

        return redirect()->route('admin.manage.properties')->with('info', 'No changes made. Status is already up to date.');
    }


    public function deleteProperty($id)
    {
        $property = \App\Models\Property::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.manage.properties')->with('success', 'Property deleted successfully.');
    }
//    ======================================================all users===========================



    public function listUsers()
    {
        $users = DB::table('registrations')->get();
        return view('adminDashboards.users', compact('users'));
    }

    // Show edit form
    public function editUser($id)
    {
        $user = DB::table('registrations')->where('id', $id)->first();
        return view('adminDashboards.editUser', compact('user'));
    }

    // Update user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6'
        ]);

        $updateData = [
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        // Only hash and update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('registrations')->where('id', $id)->update($updateData);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function deleteUser($id)
    {
        DB::table('registrations')->where('id', $id)->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

//===========================admin profile update====================

    public function editProfile()
    {
        $admin = Auth::guard('admin')->user(); // Get the logged-in admin
        return view('adminDashboards.admin-profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }









}
