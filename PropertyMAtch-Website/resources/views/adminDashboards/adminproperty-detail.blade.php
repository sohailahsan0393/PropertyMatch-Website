<x-layout >
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

                <div class="re-container">


                    <section class="re-image-slider">
                        <div id="propertyImageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($property->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="Property Image" style="height: 450px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#propertyImageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#propertyImageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </section>


                    <h1 class="re-property-title">{{ $property->property_title }}</h1>
                    <p class="re-location">
                        <i class="fas fa-map-marker-alt"></i>  {{ $property->location }}
                    </p>

                    <div class="re-content-grid">
                        <aside class="re-agent-card">
                            <div class="re-agent-photo">
                                <img
                                    src="{{asset('img/images.png')}}"
                                    alt="Agent Profile"
                                />
                            </div>
                            <h3 class="re-agent-name">Property Owner</h3>
                            {{-- If user is logged in --}}

                            <p class="re-agent-email">{{ $user->email ?? 'Unknown' }}</p>
                            <button class="re-chat-button">
                                <i class="fas fa-comment"></i> Start Chat
                            </button>




                            <div class="re-social-links">
                                <a href="#" class="re-social-icon" aria-label="Facebook"
                                ><i class="fab fa-facebook"></i
                                    ></a>
                                <a href="#" class="re-social-icon" aria-label="WhatsApp"
                                ><i class="fab fa-whatsapp"></i
                                    ></a>
                                <a href="#" class="re-social-icon" aria-label="Instagram"
                                ><i class="fab fa-instagram"></i
                                    ></a>
                            </div>
                        </aside>


                        <main class="re-property-details">
                            <div class="re-price-tag-group">
                                <span class="re-price-tag re-sale">For {{ ucfirst($property->property_status) }}</span>
                                <span class="re-price-tag re-price">${{ number_format($property->price, 2) }}</span>
                                <span class="re-price-tag re-sale" style="background: red;"> {{ ucfirst($property->status) }}</span>
                            </div>

                            <section class="re-description">
                                <h3>Description</h3>
                                <p>
                                    {{ $property->description }}
                                </p>
                            </section>

                            <section class="re-property-stats">
                                <div class="re-stat-box">
                                    <span>Type</span>
                                    <strong> {{ $property->property_category }}</strong>
                                </div>

                                <div class="re-stat-box">
                                    <span>Size</span>
                                    <strong> {{ $property->land_area }}</strong>
                                </div>

                            </section>

                            <section class="re-amenities">
                                <h3>Property Amenities</h3>
                                <div class="re-amenities-grid">
                                    @foreach($property->amenities as $amenity)
                                        <div class="re-amenity-item">
                                            <i class="fas fa-check-circle"></i> {{ $amenity }}
                                        </div>
                                    @endforeach
                                </div>

                            </section>

                            <section class="re-video-section">
                                <h3>Property Video</h3>
                                <video controls>
                                    <source
                                        src="{{ asset('storage/' . $property->video)}}"
                                        type="video/mp4"
                                    />
                                    Your browser does not support the video tag.
                                </video>
                            </section>

                            <section class="re-map-section">
                                <h3>Property Map</h3>
                                @if(!empty($property->map_url))
                                    <iframe
                                        src="{{ $property->map_url }}"
                                        width="100%"
                                        height="450"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                        title="Property Location"
                                    ></iframe>
                                @else
                                    <p>Map location not available.</p>
                                @endif
                            </section>

                        </main>

                    </div>









                {{--            --------------------}}

            </div>

        </div>
    </div>
</x-layout>
