<x-layout>
    <x-nav/>
    {{-- <!-- Hero Section -->
    <section class="hero-section">

        <!-- Search Filter -->
        <div class="search-bar">
            <input type="text" placeholder="Search properties by title..." class="form-control">
            <select class="form-control">
                <option>Select Status</option>
                <option>For Sale</option>
                <option>For Rent</option>
            </select>
            <select class="form-control">
                <option>Select Type</option>
                <option>Apartment</option>
                <option>House</option>
                <option>Villa</option>
            </select>
            <button class="settings-btn" onclick="toggleFilters()">⚙️</button>
            <button class="btn search-btn"><i class="fas fa-search"></i> Search</button>
        </div>
    </section>
    <div class="container">
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
    <section class="listings-section">
        <div class="section-heading">
            <p>Properties</p>
            <h2> Listings</h2>
        </div>

        <div class="listing">
            @foreach($properties as $property)
                <div class="property-card">
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
        </div>
    </section>



    {{--    ==========================================================================================--}}


    <x-chatbot>
    </x-chatbot> 

</x-layout>
<x-footer/>
