<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PropertyController extends Controller
{
    public function create()
    {
        return view('users.add-property');
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_title' => 'required',
            'property_status' => 'required',
            'property_category' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'map_url' => 'required|url',
            'description' => 'required',
            'land_area' => 'required|integer',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'floors' => 'required|integer',
            'legal_docs.*' => 'required|file|mimes:pdf', // Only PDF files allowed
            'images.*' => 'required|image',
            'video' => 'required|file',
            'amenities' => 'required|array'
        ]);

        $userId = Auth::id() ?? session('user_id');

        // Store legal documents with original names
        $legalDocs = [];
        foreach ($request->file('legal_docs') as $doc) {
            $originalName = $doc->getClientOriginalName();
            $path = $doc->storeAs('legal_docs', $originalName, 'public');
            $legalDocs[] = $path;
        }

        // Store images
        $images = [];
        foreach ($request->file('images') as $img) {
            $images[] = $img->store('property_images', 'public');
        }

        // Store video
        $video = $request->file('video')->store('videos', 'public');

        // Create property record
        Property::create([
            'user_id' => $userId,
            'property_title' => $request->property_title,
            'property_status' => $request->property_status,
            'property_category' => $request->property_category,
            'price' => $request->price,
            'location' => $request->location,
            'map_url' => $request->map_url,
            'description' => $request->description,
            'land_area' => $request->land_area,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'floors' => $request->floors,
            'legal_docs' => $legalDocs,
            'images' => $images,
            'video' => $video,
            'amenities' => $request->amenities,
        ]);

        return redirect()->back()->with('success', 'Property submitted successfully!');
    }


    public function edit($id)
    {
        $property = Property::findOrFail($id);

        // Optional: check if the authenticated user owns this property
        if (Auth::id() !== $property->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('users.edit-my-property', compact('property'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'property_title' => 'required|string',
            'property_status' => 'required|string',
            'property_category' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'map_url' => 'required|url',
            'description' => 'required|string',
            'land_area' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'floors' => 'required|numeric',
            'legal_docs.*' => 'nullable|file|mimes:pdf',
            'images.*' => 'nullable|image',
            'video' => 'nullable|file|mimes:mp4,avi,mov',
            'amenities' => 'nullable|array',
        ]);

        // Find the property
        $property = Property::findOrFail($id);

        // Update simple fields
        $property->property_title = $request->property_title;
        $property->property_status = $request->property_status;
        $property->property_category = $request->property_category;
        $property->price = $request->price;
        $property->location = $request->location;
        $property->map_url = $request->map_url;
        $property->description = $request->description;
        $property->land_area = $request->land_area;
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->floors = $request->floors;
        $property->amenities = $request->amenities;

        // Handle legal documents
        if ($request->hasFile('legal_docs')) {
            $legalDocs = [];
            foreach ($request->file('legal_docs') as $doc) {
                $legalDocs[] = $doc->store('legal_docs', 'public');
            }
            $property->legal_docs = $legalDocs;
        }

        // Handle images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('property_images', 'public');
            }
            $property->images = $images;
        }

        // Handle video
        if ($request->hasFile('video')) {
            $property->video = $request->file('video')->store('property_videos', 'public');
        }

        $property->save();

        return redirect()->route('my-properties')->with('success', 'Property updated successfully.');

    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect()->back()->with('success', 'Property deleted successfully!');
    }



//    ---------------------all active properties for showing on home page and all listing page------------

    // PropertyController.php


//    public function showHomePage(Request $request)
//    {
//        $query = Property::where('status', 'active');
//
//
//        if ($request->has('property_title') && !empty($request->property_title)) {
//            $query->where('property_title', 'like', '%' . $request->property_title . '%');
//        }
//
//
//        if ($request->has('property_status') && !empty($request->property_status)) {
//            $query->where('property_status', $request->property_status);
//        }
//
//
//        if ($request->has('property_category') && !empty($request->property_category)) {
//            $query->where('property_category', $request->property_category);
//        }
//
//        $properties = $query->get();
//
//        return view('welcome', compact('properties'));
//    }

public function showHomePage(Request $request)
{
    $query = Property::where('status', 'active');

    if ($request->filled('property_status')) {
        $query->where('property_status', $request->property_status);
    }

    if ($request->filled('property_category')) {
        $query->where('property_category', $request->property_category);
    }

    // Title check: apply only if it finds matching records
    if ($request->filled('property_title')) {
        // Clone the query to test title match first
        $testQuery = clone $query;
        $testQuery->where('property_title', 'like', '%' . $request->property_title . '%');

        if ($testQuery->count() > 0) {
            $query->where('property_title', 'like', '%' . $request->property_title . '%');
        }
    }

    $properties = $query->paginate(6)->withQueryString();

    return view('welcome', compact('properties'));
}




    public function showAllListings(Request $request)
    {
        $query = Property::where('status', 'active');

        if ($request->filled('property_title') || $request->filled('property_status') || $request->filled('property_category'))
        {
            $query->where(function($q) use ($request) {
                // Search by title (if provided)
                if ($request->filled('property_title')) {
                    $q->orWhere('property_title', 'like', '%' . $request->property_title . '%');
                }

                // Filter by status (if provided)
                if ($request->filled('property_status')) {
                    $q->orWhere('property_status', $request->property_status);
                }

                // Filter by category (if provided)
                if ($request->filled('property_category')) {
                    $q->orWhere('property_category', $request->property_category);
                }
            });
        }
        $properties = $query->paginate(9);
        return view('pages.all-listing', compact('properties'));
    }


    public function dashboard()
    {
        $userId = session('user_id'); // or use Auth::id() if you're using Laravel's Auth system

        $activeCount = Property::where('user_id', $userId)->count(); // all active properties
        $myActiveCount = Property::where('status', 'active')->where('user_id', $userId)->count(); // user's active
        $soldCount = Property::where('status', 'sold')->where('user_id', $userId)->count(); // user's sold

        return view('users.dashboard', compact('activeCount', 'myActiveCount', 'soldCount'));
    }
//-------------buy property inside user dashbaord ------

    public function show($id)
    {
        $property = Property::findOrFail($id);

        // Fetch the user (registration) who owns the property
        $user = Registration::find($property->user_id);

        return view('users.property-detail', compact('property', 'user'));
    }

}
