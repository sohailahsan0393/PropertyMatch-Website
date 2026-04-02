<x-layout >
    <style>
        .dashboard-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 1rem;
            background-color: #fff;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="main-container" style="  background-color: #f9f9ff;">
        <x-AdminSidebar/>

        <div class="content" id="content">
            {{--            --------------------}}

            <div id="main-container">

                {{--                ------------------------------------------------}}




{{--==========================================--}}
                <section class="listings-section">
                    <div class="section-heading">
                        <p>Properties</p>
                        <h2>Latest Listings</h2>
                    </div>

                    <div class="listing" style="margin-left: -6%;">
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
                                        <a href="{{ route('adminproperty.detail', $property->id) }}">
                                            <button class="view-details"  style="margin-top: 5% !important;">View Details</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>






                {{--            --------------------}}

            </div>

        </div>
    </div>
    <x-chatbot>
    </x-chatbot> 
</x-layout>
