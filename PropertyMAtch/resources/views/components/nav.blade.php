<x-layout>
    <!-- Navbar -->
    <style>
        .profile-dropdown {
            position: relative;
        }

        .profile-menu {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            list-style: none;
            padding: 10px;
            border: 1px solid #ccc;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .profile-dropdown.active .profile-menu {
            display: block;
        }
    </style>
    <header>
        <nav class="navbar">
            <div class="logo" style="margin-left: 20px;">
                <a href="/"><img src="{{ asset('assets/icons/22.png') }}" alt="Logo"></a>
            </div>

            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-links">
                <li><a href="/" class="{{ Request::is('/') ? 'active-link' : '' }}">Home</a></li>
                <li><a href="/about" class="{{ Request::is('about') ? 'active-link' : '' }}">About Us</a></li>
                <li><a href="/all-listing" class="{{ Request::is('all-listing') ? 'active-link' : '' }}">All Listing</a>
                </li>
                <li class="dropdown">
                    <a href="#">Categories <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/property?category=Apartment') }}">Apartment</a></li>
                        <li><a href="{{ url('/property?category=House') }}">Family House</a></li>
                        <li><a href="{{ url('/property?category=Villa') }}">Villa</a></li>
                        <li><a href="{{ url('/property?category=Office') }}">Office</a></li>
                        <li><a href="{{ url('/property?category=Hostel') }}">Hostel</a></li>
                        <li><a href="{{ url('/property?category=Residential') }}">Residential</a></li>
                        <li><a href="{{ url('/property?category=Overseas') }}">Overseas</a></li>
                        {{-- <li><a href="{{ url('/property?category=Family House') }}">Family House</a></li> --}}
                    </ul>
                </li>

                <li><a href="/calculator" class="{{ Request::is('calculator') ? 'active-link' : '' }}">Investment Calculator</a></li>
                {{--            <li><a href="/blog">Blog</a></li> --}}
                <li><a href="/contact" class="{{ Request::is('contact') ? 'active-link' : '' }}">Contact Us</a></li>
            </ul>

            <div class="nav-buttons">

                {{-- Show if user is NOT logged in --}}
                @guest
                    <a href="/sign-in">
                        <button class="btn login-btn">Login / Signup</button>
                    </a>
                @endguest

                {{-- Show if user IS logged in --}}
                @auth
                    <div class="profile-dropdown">
                        <button class="profile-toggle">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="profile-menu">
                            <li><a href="/dashboard">Profile</a></li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="logout-btn">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>


                @endauth

                {{-- Always show Add Property button, but link depends on auth status --}}
                @if (Auth::check())
                <a href="/add-property">
                    <button class="btn add-property-btn"
                    style="background: #01A2DD; color: white; padding: 9px 6px; margin-right: 30px; width:110px;height:43px;"
                    onmouseover="this.style.background='#058ec0'"
                    onmouseout="this.style.background='#01A2DD'">
                    Add Property
                </button>
                </a>
                
                
                @else
                    <a href="/sign-in">
                        <button class="btn add-property-btn"
                        style="background: #01A2DD; color: white; padding: 9px 6px; margin-right: 30px; width:110px;height:43px;"
                        onmouseover="this.style.background='#058ec0'"
                        onmouseout="this.style.background='#01A2DD'">
                        Add Property
                    </button>
                    </a>
                @endif

            </div>




        </nav>
    </header>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.querySelector('.profile-toggle');
            const dropdown = document.querySelector('.profile-dropdown');

            if (toggleBtn && dropdown) {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('active');
                });

                // Close dropdown if clicked outside
                document.addEventListener('click', function() {
                    dropdown.classList.remove('active');
                });
            }
        });
    </script>
</x-layout>
