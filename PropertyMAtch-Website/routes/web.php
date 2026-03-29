<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

Route::match(['get', 'post'], '/', [PropertyController::class, 'showHomePage']);

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/contact', function () {
    return view('pages.contact');
});


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/calculator', function () {
    return view('pages.calculator');
})->middleware('auth');
Route::get('/property-detail', function () {
    return view('pages.property-detail');
});
Route::match(['get', 'post'], '/all-listing', [PropertyController::class, 'showAllListings']);

// Route::get('/all-listing', [PropertyController::class, 'showAllListings']);

//--feature listings-
Route::get('/property', function (Request $request) {
    $query = Property::where('status', 'active');

    if ($request->has('category')) {
        $category = Str::lower($request->category);
        $query->whereRaw('LOWER(property_category) = ?', [$category]);
    }

    $properties = $query->get();

    return view('pages.property', compact('properties'));
});
//================================================================================================

                          //--user dashboard----.
//================================================================================================

Route::get('/sign-up', function () {
    return view('users.sign-up');
});
Route::get('/sign-in', function () {
    return view('users.sign-in');
})->name('login');
//------signup route----------
Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
// Protected route

Route::get('/dashboard', [PropertyController::class, 'dashboard'])->middleware('auth');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//------property adding---

Route::get('/add-property', [PropertyController::class, 'create'])
    ->middleware('auth')
    ->name('add-property.form');

Route::post('/add-property', [PropertyController::class, 'store'])->name('add-property');
//---my properties-
Route::get('/my-properties', function () {
    $userId = Auth::id(); // safer and more consistent than session('user_id')
    $properties = Property::where('user_id', $userId)->get();

    return view('users.my-properties', compact('properties'));
})->middleware('auth')->name('my-properties');

Route::get('/property-details/{id}', function ($id) {
    $property = Property::findOrFail($id);
    return view('users.property-details', compact('property'));
})->name('property.details');
//-buy property routes--
Route::get('/property-detail/{id}', [PropertyController::class, 'show'])->name('property.detail');
//--profile-
Route::get('/my-account', [AuthController::class, 'myAccount'])->middleware('auth');
Route::post('/update-account', [AuthController::class, 'updateAccount'])->middleware('auth');

//--------------chatter--

//Route::get('/user-chatter', function () {
//    return view('users.user-chatter');
//});
Route::get('/user-chatter', [ChatController::class, 'index'])->middleware('auth')->name('chat.index');
Route::post('/user-chatter/send', [ChatController::class, 'send'])->middleware('auth')->name('chat.send');


//-----edit property---------
Route::get('/edit-my-property/{id}', [PropertyController::class, 'edit'])->name('edit.details');
Route::put('/update-property/{id}', [PropertyController::class, 'update'])->name('update.property');
Route::delete('/delete-property/{id}', [PropertyController::class, 'destroy'])->name('delete.property');



//================================================================================================
                                       //Admin Dashboard
//================================================================================================

Route::get('/admin', function () {
    return view('adminDashboards.admin');
})->name('adminDashboards.admin');
// POST route to handle login submission
Route::post('/admin', [AdminAuthController::class, 'authenticate'])->name('adminLogin.authenticate');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth:admin')
    ->name('admin.dashboard');
//--------
Route::get('/admin-active-properties', [AdminController::class, 'activeProperties'])
    ->middleware('auth:admin')
    ->name('admin.active.properties');

Route::get('/admin-pending-properties', [AdminController::class, 'pendingProperties'])
    ->middleware('auth:admin')
    ->name('admin.pending.properties');
Route::get('/adminproperty-detail/{id}', [AdminController::class, 'show'])->name('adminproperty.detail');
//----manage properties
Route::get('/manage-properties', [AdminController::class, 'manageProperties'])
    ->middleware('auth:admin')
    ->name('admin.manage.properties');

Route::get('/admin/property/{id}/edit', [AdminController::class, 'editProperty'])->name('admin.edit.property');
Route::put('/admin/property/{id}', [AdminController::class, 'updateProperty'])->name('admin.update.property');
Route::delete('/admin/property/{id}', [AdminController::class, 'deleteProperty'])->name('admin.delete.property');
//-----all users----------------------
// List all users
Route::get('/users', [AdminController::class, 'listUsers']) ->middleware('auth:admin')->name('admin.users');
// Edit user form
Route::get('/users/{id}/edit', [AdminController::class, 'editUser']) ->middleware('auth:admin')->name('admin.users.edit');
// Update user
Route::put('/users/{id}', [AdminController::class, 'updateUser']) ->middleware('auth:admin')->name('admin.users.update');
// Delete user
Route::delete('/users/{id}', [AdminController::class, 'deleteUser']) ->middleware('auth:admin')->name('admin.users.delete');
//---users that contacted
Route::get('/contact-persons', [ContactController::class, 'index'])->name('contact.index');
//-----------admin account----

Route::get('/admin-profile', [AdminController::class, 'editProfile'])->name('admin.profile');
Route::post('/admin-profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
