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

{{--======================================================--}}


                <section class="listings-section" style="margin-left: 1%;">
                    <div class="section-heading">
                        <p> MY Properties</p>

                    </div>

                    <div class="listing" style="margin-right: -90px">
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
                                                <img src="{{ asset('assets/icons/floors.png') }}" class="icon">
                                                <span>{{ $property->floors }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Details Button -->
                                    <div class="property-button">
                                        <!-- View Details Button -->
                                        <a href="{{ route('property.details', $property->id) }}">
                                            <button class="view-details"  style="margin-top: 5% !important;">View </button>
                                        </a>
                                        <a href="{{ route('edit.details', $property->id) }}">
                                            <button class="view-details" style="margin-top: 5% !important;background: orange;color:black;">Edit </button>
                                        </a>
                                        <form action="{{ route('delete.property', $property->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="view-details" style="margin-top: 5% !important;background: red;">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>


                {{--===============================================--}}
                {{--            --------------------}}

            </div>


        </div>
    </div>
    <x-chatbot>
    </x-chatbot> 
</x-layout>
