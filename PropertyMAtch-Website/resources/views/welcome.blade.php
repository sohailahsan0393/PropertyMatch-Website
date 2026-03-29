<x-layout>
    <x-nav />
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h2 style="color:white;">Find your perfect fit!</h2>
            <h1>Discover Your <span class="highlight">Dream</span> Home</h1>
            <p>We can find you the perfect property & help you locate the home of your dreams.</p>
        </div>

        <!-- Search Filter -->
        <form action="{{ url('/') }}#listings" method="GET" class="search-bar"> <input type="text"
                name="property_title" placeholder="Search properties by title..." class="form-control"
                value="{{ request('property_title') }}">

            <select name="property_status" class="form-control">
                <option value="">Select Status</option>
                <option value="Sale" {{ request('property_status') == 'Sale' ? 'selected' : '' }}>For Sale</option>
                <option value="Rent" {{ request('property_status') == 'Rent' ? 'selected' : '' }}>For Rent</option>
            </select>

            <select name="property_category" class="form-control">
                <option value="">Select Category</option>
                <option value="Apartment" {{ request('property_category') == 'Apartment' ? 'selected' : '' }}>Apartment
                </option>
                <option value="House" {{ request('property_category') == 'House' ? 'selected' : '' }}>House</option>
                <option value="Villa" {{ request('property_category') == 'Villa' ? 'selected' : '' }}>Villa</option>
                <option value="Office" {{ request('property_category') == 'Office' ? 'selected' : '' }}>Office</option>
                <option value="Hostel" {{ request('property_category') == 'Hostel' ? 'selected' : '' }}>Hostel</option>
                <option value="Oversease" {{ request('property_category') == 'Oversease' ? 'selected' : '' }}>Oversease
                </option>
                <option value="Residential" {{ request('property_category') == 'Residential' ? 'selected' : '' }}>
                    Residential</option>


            </select>

            <button type="submit" class="btn search-btn"><i class="fas fa-search"></i> Search</button>
        </form>


        <!-- Property Categories Section -->
        <div class="property-categories">
            <a href="{{ url('/property?category=Apartment') }}" style="text-decoration:none">
                <div class="category"><i class="fas fa-building"></i><span>Apartment</span></div>
            </a>
            <a href="{{ url('/property?category=hostel') }}" style="text-decoration:none">
                <div class="category"><i class="fas fa-hotel"></i><span>Hostels</span></div>
                <a href="{{ url('/property?category=residential') }}" style="text-decoration:none">
                    <div class="category"><i class="fas fa-home"></i><span>Residential</span></div>
                    <a href="{{ url('/property?category=villa') }}" style="text-decoration:none">
                        <div class="category"><i class="fas fa-archway"></i><span>Villa</span></div>
                        <a href="{{ url('/property?category=office') }}" style="text-decoration:none">
                            <div class="category"><i class="fas fa-briefcase"></i><span>Office</span></div>
                            <a href="{{ url('/property?category=overseas') }}" style="text-decoration:none">
                                <div class="category"><i class="fas fa-globe"></i><span>Overseas</span></div>
                                <a href="{{ url('/property?category=House') }}" style="text-decoration:none">
                                    <div class="category"><i class="fas fa-house-user"></i><span>Family House</span>
                                    </div>
                                </a>
        </div>
    </section>

    {{--    -------------------- --}}

    <section class="listings-section" id="listings">
        <div class="section-heading">
            <p>Properties</p>
            <h2>Latest Listings</h2>
        </div>
        <!-- Property Search Summary -->
        @if (request('property_title') || request('property_status') || request('property_category'))
            <div class="text-center mb-4">
                <h5 style="color:#333;">
                    <span style="color:#00BBFF">Showing results for:</span>
                    @if (request('property_title'))
                        <span style="color:#00BBFF">
                            <strong>"{{ request('property_title') }}"</strong></span>
                    @endif

                    @if (request('property_category'))
                        <span style="color:#00BBFF"><strong>{{ request('property_category') }}</strong></span>
                    @endif

                    @if (request('property_status'))
                        <span style="color:#00BBFF">for <strong>{{ request('property_status') }}</strong></span>
                    @endif
                </h5>
            </div>
        @endif

        <div class="listing" style="margin-left: 1%;">
            @foreach ($properties as $property)
                <div class="property-card" style="margin-right: -90px">
                    <!-- Property Image -->
                    <div class="property-image">
                        <img src="{{ asset('storage/' . $property->images[0]) }}"
                            alt="{{ $property->property_title }}" style="width:100%; height:200px; object-fit:cover;">
                        <div class="tags">
                            <span class="tag"
                                style="background: orange;">{{ ucfirst($property->property_category) }}</span>
                            <span class="tag"
                                style="background: green;">{{ ucfirst($property->property_status) }}</span>
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

    {{-- ========================================== --}}
    <!-- about section -->
    <section class="about-section">
        <!-- Left Side: Image Grid -->
        <div class="about-images">
            <div class="image-grid">
                <img src="{{ asset('assets/images/Gallery.webp') }}" alt="Property 1">
            </div>
            <!-- <div class="play-button">
        <span>&#9658;</span>
    </div> -->
        </div>

        <!-- Right Side: Text and Icons -->
        <div class="about-content">
            <h3 class="sections-subtitle">About Us - Property Match</h3>
            <h2 class="sections-title">Grow your Real Estate business with Property Match.</h2>
            <p class="description">
                Welcome to <strong>Property Match</strong>, your trusted partner in finding the perfect rental property.
                We are dedicated to simplifying the property rental process by connecting property owners and renters
                through an innovative, user-friendly platform.
            </p>

            <div class="feature">
                <img src="{{ asset('assets/icons/register.png') }}" width="50" alt="Register Icon">
                <div class="feature-text">
                    <h4>It's Easier to Register</h4>
                    <p>Creating an account on Property Match is quick and hassle-free. Simply sign up, and you'll gain
                        instant access to all our features.</p>
                </div>
            </div>

            <div class="feature">
                <img src="{{ asset('assets/icons/verified.png') }}" width="50" alt="Verified Listings Icon">
                <div class="feature-text">
                    <h4>Get Your Verified Listings</h4>
                    <p>Upload your property details and legal documents to build trust with potential renters. Our
                        verification process ensures transparency and authenticity.</p>
                </div>
            </div>
        </div>
    </section>
    {{--    ========================================================================================== --}}

    <!-- How It Works sections -->
    <section class="process-section">
        <div class="section-header">
            <h2>Our Process</h2>
            <h3>How it Works?</h3>
            <p>Property Match simplifies your property search. Sign up, browse verified listings, and connect with
                owners or renters through our secure chat. Schedule visits and finalize deals confidently, all in one
                seamless platform.</p>
        </div>

        <div class="steps-grid">
            <!-- Step 1 -->
            <div class="process-step">
                <div class="step-icon">
                    <img src="{{ asset('assets/icons/sign.png') }}" alt="">
                </div>
                <div class="step-content">
                    <h4>Signup</h4>
                    <p>Create an account or log in to unlock the platform's full features.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="process-step">
                <div class="step-icon">
                    <img src="{{ asset('assets/icons/listing.png') }}" alt="">
                </div>
                <div class="step-content">
                    <h4>Explore Listings</h4>
                    <p>Browse verified listings using advanced filters to find the perfect match for your needs.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="process-step">
                <div class="step-icon">
                    <img src="{{ asset('assets/icons/chat.png') }}" alt="">
                </div>
                <div class="step-content">
                    <h4>Chat with Ease</h4>
                    <p>Connect with property owners or renters securely in real-time using the platform's Chat feature.
                    </p>
                </div>
            </div>
            <div class="process-step">
                <div class="step-icon">
                    <img src="{{ asset('assets/icons/calc.png') }}" alt="">
                </div>
                <div class="step-content">
                    <h4>Use the Investment Calculator</h4>
                    <p>Evaluate potential ROI and compare properties with our built-in financial tool.</p>
                </div>
            </div>
            <div class="process-step">
                <div class="step-icon">
                    <img src="{{ asset('assets/icons/chatbot.png') }}" alt="">
                </div>
                <div class="step-content">
                    <h4>Get Assistance with Chatbot</h4>
                    <p>rowse verified listings using advanced filters to find the perfect match for your needs.</p>
                </div>
            </div>
            <div class="process-step">
                <div class="step-icon">
                    <img src="{{ asset('assets/icons/deal.png') }}" alt="">
                </div>
                <div class="step-content">
                    <h4>Finalize Deals</h4>
                    <p>Complete agreements with confidence, backed by verified listings and secure communication.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ready sections -->


    <section class="ready-section">
        <div class="ready-container">
            <h2 class="ready-heading">Ready to sell your property</h2>
            <p class="ready-text">
                Easily list your property with confidence and reach potential buyers effortlessly.
                Simplify the process and let us connect you with the right audience.
            </p>
            <a href="/add-property"><button class="cta-button">List Your Property</button></a>
            {{-- 
            <div class="stats-container">
                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-number">10 +</div>
                        <div class="stat-label">Properties Listed</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">20 +</div>
                        <div class="stat-label">Properties Sold</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">30 +</div>
                        <div class="stat-label">Satisfied Clients</div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <section class="partners-section">
        <h2 class="section-title">Our Partners</h2>
        <div class="carousel-container">

            <div class="partners-carousel" id="partnerScroll">
                <div class="partner-card"><img src="../assets/images/Allens-Home.webp" alt="AZ Builders">
                    <p>AZ BUILDERS</p>
                </div>
                <div class="partner-card"><img src="../assets/images/AZ-Builders.webp" alt="Aliens Homes">
                    <p>ALIENS HOMES</p>
                </div>
                <div class="partner-card"><img src="../assets/images/City-Dwellings.webp" alt="Royal Builders">
                    <p>ROYAL BUILDERS</p>
                </div>
                <div class="partner-card"><img src="../assets/images/City-Dwellings.webp" alt="Perfect Estate">
                    <p>PERFECT ESTATE</p>
                </div>
                <div class="partner-card"><img src="../assets/images/City-Dwellings.webp" alt="Perfect Estate">
                    <p>PERFECT ESTATE</p>
                </div>
                <div class="partner-card"><img src="../assets/images/City-Dwellings.webp" alt="Perfect Estate">
                    <p>PERFECT ESTATE</p>
                </div>


                <!-- You can add more partners as needed -->
            </div>

        </div>
    </section>
    <x-chatbot>
    </x-chatbot>
    <x-footer />
</x-layout>
