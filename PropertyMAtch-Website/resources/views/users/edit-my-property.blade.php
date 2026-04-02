<x-layout >
    <style>
        .main-container {
            height: 100vh;         /* Full viewport height */
            overflow-x: hidden;    /* Hide horizontal scroll */
            overflow-y: auto;      /* Enable vertical scroll if needed */
            /* Add spacing inside */
        }
    </style>



    <div class="main-container" style="  background-color: #f9f9ff;">
        <x-sidebar/>

        <div class="content" id="content" style="overflow: scroll;">
            {{--            --------------------}}

            <div id="main-container" >

                {{--                ------------------------------------------------}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-container">
                    <h2>Property Details</h2>
                    <form action="{{ route('update.property', $property->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Property Title -->
                        <div class="form-group">
                            <label for="title">Property Title</label>
                            <input type="text" id="title" name="property_title" value="{{ old('property_title', $property->property_title) }}" required>
                        </div>

                        <!-- Property Status -->
                        <div class="form-group">
                            <label for="type">Property Status</label>
                            <select id="type" name="property_status" required>
                                <option value="">Select Property Status</option>
                                <option value="Rent" {{ $property->property_status == 'Rent' ? 'selected' : '' }}>Rent</option>
                                <option value="Sale" {{ $property->property_status == 'Sale' ? 'selected' : '' }}>Sale</option>
                            </select>
                        </div>

                        <!-- Property Category -->
                        <div class="form-group">
                            <label for="category">Property Category</label>
                            <select id="category" name="property_category" required>
                                <option value="">Select Property Category</option>
                                @foreach(['Apartment', 'House', 'Villa', 'Office', 'Hostel','Residential','Overseas','Family House'] as $category)
                                    <option value="{{ $category }}" {{ $property->property_category == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $property->price) }}" required>
                        </div>

                        <!-- Location -->
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" value="{{ old('location', $property->location) }}" required>
                        </div>

                        <!-- Map URL -->
                        <div class="form-group">
                            <label for="map-url">Google Map URL</label>
                            <input type="url" id="map-url" name="map_url" value="{{ old('map_url', $property->map_url) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" required>{{ old('description', $property->description) }}</textarea>
                        </div>

                        <!-- Land Area -->
                        <div class="form-group">
                            <label for="land-area">Land Area (Square Feet)</label>
                            <input type="number" id="land-area" name="land_area" value="{{ old('land_area', $property->land_area) }}" required>
                        </div>

                        <!-- Bedrooms -->
                        <div class="form-group">
                            <label for="bedrooms">Bedrooms</label>
                            <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" required>
                        </div>

                        <!-- Bathrooms -->
                        <div class="form-group">
                            <label for="bathrooms">Bathrooms</label>
                            <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" required>
                        </div>

                        <!-- Floors -->
                        <div class="form-group">
                            <label for="floors">Floors</label>
                            <input type="number" id="floors" name="floors" value="{{ old('floors', $property->floors) }}" required>
                        </div>

                        <!-- Legal Documents Preview -->
                        <div class="form-group">
                            <label>Existing Legal Documents</label>
                            <ul>
                                @foreach($property->legal_docs as $doc)
                                    <li><a href="{{ asset('storage/' . $doc) }}" target="_blank">{{ basename($doc) }}</a></li>
                                @endforeach
                            </ul>
                            <label for="legal-docs">Upload New Documents (Optional)</label>
                            <input type="file" id="legal-docs" name="legal_docs[]" accept="application/pdf" multiple>
                        </div>

                        <!-- Property Images Preview -->
                        <div class="form-group">
                            <label>Existing Property Images</label>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                @foreach($property->images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Image" style="width: 100px; height: auto;">
                                @endforeach
                            </div>
                            <label for="images">Upload New Images (Optional)</label>
                            <input type="file" id="images" name="images[]" accept="image/*" multiple>
                        </div>

                        <!-- Property Video Preview -->
                        <div class="form-group">
                            <label>Existing Video</label><br>
                            <video width="320" controls>
                                <source src="{{ asset('storage/' . $property->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <br>
                            <label for="video">Upload New Video (Optional)</label>
                            <input type="file" id="video" name="video" accept="video/*">
                        </div>

                        <!-- Amenities -->
                        <div class="form-group">
                            <label>Property Amenities</label>
                            <div class="amenities-container">
                                @php
                                    $selectedAmenities = $property->amenities ?? [];
                                @endphp
                                @foreach(['Swimming Pool', 'Gym', 'Parking', 'Garden', 'Wi-Fi', 'CCTV'] as $amenity)
                                    <label>
                                        <input type="checkbox" name="amenities[]" value="{{ $amenity }}"
                                            {{ in_array($amenity, $selectedAmenities) ? 'checked' : '' }}>
                                        {{ $amenity }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">Update Property</button>
                    </form>

                </div>







                {{--            --------------------}}

            </div>


        </div>
    </div>
    <x-chatbot>
    </x-chatbot> 
</x-layout>
