<x-layout>
    <x-nav/>
    <!-- Hero Section -->
    <section class="hero-section">

        <!-- Search Filter -->
                <!-- Search Filter -->
                <form action="{{ url('/all-listing') }}#listings" method="GET" class="search-bar">                    <input type="text" name="property_title" placeholder="Search properties by title..." class="form-control" value="{{ request('property_title') }}">
        
                    <select name="property_status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Sale" {{ request('property_status') == 'Sale' ? 'selected' : '' }}>For Sale</option>
                        <option value="Rent" {{ request('property_status') == 'Rent' ? 'selected' : '' }}>For Rent</option>
                    </select>
        
                    <select name="property_category" class="form-control">
                        <option value="">Select Category</option>
                        <option value="Apartment" {{ request('property_category') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="House" {{ request('property_category') == 'House' ? 'selected' : '' }}>House</option>
                        <option value="Villa" {{ request('property_category') == 'Villa' ? 'selected' : '' }}>Villa</option>
                        <option value="Office" {{ request('property_category') == 'Office' ? 'selected' : '' }}>Office</option>
                        <option value="Hostel" {{ request('property_category') == 'Hostel' ? 'selected' : '' }}>Hostel</option>
                    </select>
        
                    <button type="submit" class="btn search-btn"><i class="fas fa-search"></i> Search</button>
                </form>
    </section>
    {{-- <div class="container">
        <div class="advanced-filters" id="filters">
            <div class="form-row">

                <select id="city" class="form-control">
                    <option value="">--Select City--</option>
                    <option value="New York">New York</option>
                    <option value="Los Angeles">Los Angeles</option>
                    <option value="Chicago">Chicago</option>
                </select>

                <!-- <label for="min-area">:</label> -->
                <input type="number" id="min-area" placeholder="Min Area (sqft)" class="form-control">

                <!-- <label for="max-area">Max Area (sqft):</label> -->
                <input type="number" id="max-area" placeholder="Max Area (sqft)" class="form-control">
            </div>
            <div class="form-row">
                <!-- <label for="bedrooms">Bedrooms:</label> -->
                <input type="number" id="bedrooms" placeholder="Number of bedrooms" class="form-control">

                <!-- <label for="bathrooms">Bathrooms:</label> -->
                <input type="number" id="bathrooms" placeholder="Number of bathrooms" class="form-control">

                <!-- <label for="build-year">Build Year:</label> -->
                <input type="number" id="build-year" placeholder="Year built" class="form-control">
            </div>

            <label for="price-range">Price Range: $<span id="price-value">0</span> - $500000</label>
            <input type="range" id="price-range" min="0" max="500000" step="1000" value="0">

            <label>Amenities:</label>
            <div class="amenities">
                <label><input type="checkbox"> Parking</label>
                <label><input type="checkbox"> Swimming Pool</label>
                <label><input type="checkbox"> Gym</label>
                <label><input type="checkbox"> Garden</label>
                <label><input type="checkbox"> Security</label>
                <label><input type="checkbox"> Elevator</label>
            </div>
        </div>
    </div> --}}


    {{--========================================================properties=====================================--}}
    <section class="listings-section" id="listings">
        <div class="section-heading">
            <p>Properties</p>
            <h2>Latest Listings</h2>
        </div>

        <div class="listing" style="margin-left: 1%;">
            @foreach($properties as $property)
                <div class="property-card" style="margin-right: -90px">
                    <!-- Property Image -->
                    <div class="property-image">
                        <img src="{{ asset('storage/' . $property->images[0]) }}" alt="{{ $property->property_title }}" style="width:100%; height:200px; object-fit:cover;">
                        <div class="tags">
                            <span class="tag" style="background: orange;">{{ ucfirst($property->property_category) }}</span>
                            <span class="tag" style="background: green;">{{ ucfirst($property->property_status) }}</span>
                            <span class="tag" style="background: red;">{{ ucfirst($property->status) }}</span>

                        </div>
                        <div class="image-footer">
                            <p>{{ $property->land_area }} Sqft</p>
                            <p>Rs {{ number_format($property->price, 2) }}</p>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="property-info">
                        <div class="top-row">
                            <h4 class="property-title">{{ $property->property_title }}</h4>
                            <p class="property-location">📍 {{ $property->location }}</p>
                        </div>

                        <!-- Features -->
                        <div class="property-features">
                            <div class="feature-row">
                                <div class="feature-title">Bedrooms</div>
                                <div class="feature-title">Bathrooms</div>
                                <div class="feature-title">Floors</div>
                            </div>
                            <div class="feature-row">
                                <div class="feature">
                                    <img src="{{ asset('assets/icons/bed.png') }}" alt="" class="icon">
                                    <span>{{ $property->bedrooms }}</span>
                                </div>
                                <div class="feature">
                                    <img src="{{ asset('assets/icons/bath.png') }}" alt="" class="icon">
                                    <span>{{ $property->bathrooms }}</span>
                                </div>
                                <div class="feature">
                                    <img src="{{ asset('assets/icons/parking.png') }}" class="icon">
                                    <span>{{ $property->floors }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- View Details Button -->
                        <div class="property-button">
                            <a href="{{ route('property.detail', $property->id) }}">
                                <button class="view-details">View Details</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex" style="margin-left: 45%; margin-top: -5%;">
                {{ $properties->links() }}
            </div>
            
        </div>
    </section>



    {{--    ==========================================================================================--}}



    <x-chatbot>
    </x-chatbot> 
</x-layout>
<x-footer/>
