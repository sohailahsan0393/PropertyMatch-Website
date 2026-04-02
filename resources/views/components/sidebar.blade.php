<x-layout>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('styles2.css') }}">
    <style>
            :root {
        --primary-color: #6b4eff;
        --hover-bg: #f1f4ff;
        --sidebar-width: 250px;
        --collapsed-width: 70px;
    }

    .sidebar {
        width: var(--sidebar-width);
        background: white;
        padding: 20px 15px;
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        min-height: 100vh;
    }

    .sidebar.collapsed {
        width: var(--collapsed-width);
    }

    .sidebar .logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .sidebar .logo img {
        max-width: 140px;
        transition: all 0.3s ease;
    }

    .sidebar .nav {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .sidebar .nav a {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px 14px;
    border-radius: 8px;
    color: #333;
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s ease;
    border-bottom: 1px solid #eee; /* 👈 This adds the line */
}


    .sidebar .nav a:hover {
        background-color: var(--hover-bg);
        color: var(--primary-color);
    }

    .sidebar .nav a.active {
        background-color: var(--primary-color);
        color: white !important;
    }

    .sidebar .nav a.active img,
    .sidebar .nav a:hover img {
        filter: brightness(-10) invert(1);
    }

    .sidebar .nav img {
        width: 22px;
        transition: 0.3s ease;
    }

    .sidebar .nav span {
        font-size: 14px;
    }

    .mobile-sidebar-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1001;
        background: var(--primary-color);
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        border: none;
    }

    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100vh;
            z-index: 1000;
            overflow-y: auto;
            transition: left 0.3s ease-in-out;
        }

        .sidebar.mobile-visible {
            left: 0;
        }

        .mobile-sidebar-toggle {
            display: block;
        }

        .main-content {
            display: none;
        }

        .sidebar.mobile-visible ~ .main-content {
            display: none;
        }
    }

    /* Optional scroll style */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
    </style>

    <!-- Toggle Button for Mobile -->
    <button class="mobile-sidebar-toggle" onclick="showMobileSidebar()">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">

        <div>
            <!-- Cross icon for mobile sidebar -->
            <div class="toggle-icon d-md-none" onclick="hideMobileSidebar()" style="text-align:end;margin-top:20px;">
                <i class="fa fa-times" style="font-size: 28px;"></i>
            </div>
            <div class="nav" style="padding-top: 5% !important;">
                <x-nav-link href="/" :active="request()->is('/')">
                    <img src="{{asset('assets/icons/23.png')}}" alt="Logo" style="width:100px;">
                </x-nav-link>

                <x-nav-link href="/dashboard" :active="request()->is('dashboard')">
                    <img src="{{asset('img/dashboard.png')}}" alt="Logo" style="width:25px;"><span>Dashboard</span>
                </x-nav-link>





                <x-nav-link href="/add-property" :active="request()->is('add-property')">
                    <img src="{{asset('img/add.png')}}" alt="Logo" style="width:25px;">
                    <span>Add Property</span>
                </x-nav-link>

                <x-nav-link href="/my-properties" :active="request()->is('my-properties')">
                    <img src="{{asset('img/property.png')}}" alt="Logo" style="width:25px;">
                    <span>My Properties</span>
                </x-nav-link>
                <x-nav-link href="/user-chatter" :active="request()->is('user-chatter')">
                    <img src="{{asset('img/chat.png')}}" alt="Logo" style="width:25px;">
                    <span>Chatter</span>
                </x-nav-link>

                <x-nav-link href="/my-account" :active="request()->is('my-account')">
                    <img src="{{asset('img/profile.png')}}" alt="Logo" style="width:25px;">
                    <span>Profile</span>
                </x-nav-link>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" style="all: unset; width: 100%;">
                        <x-nav-link href="#" :active="request()->is('logout')">
                            <li class="nav-item" style="list-style: none; display: flex; align-items: center; gap: 10px;">
                                <img src="{{asset('img/logout.png')}}" alt="Logo" style="width:25px;">Logout
                            </li>
                        </x-nav-link>
                    </button>
                </form>


            </div>

        </div>


    </div>



    <!-- Script -->
    <script>
        function showMobileSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.add("mobile-visible");
        }

        function hideMobileSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.remove("mobile-visible");
        }

        // Optional: close sidebar on outside click (only for mobile)
        document.addEventListener('click', function (e) {
            const sidebar = document.getElementById("sidebar");
            const toggle = document.querySelector('.mobile-sidebar-toggle');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !toggle.contains(e.target)) {
                sidebar.classList.remove("mobile-visible");
            }
        });
    </script>

</x-layout>
