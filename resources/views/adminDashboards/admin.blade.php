<x-layout2>
    <style>
        signup-wrapper {
            max-width: 990px;
            margin: 50px auto;
            padding: 20px;
            width: 100%; /* ✅ Add this */
        }

        @media (max-width: 574px) {
            .signup-wrapper {
                width: 400px !important;
                margin: 20px 10px;  /* ✅ Reduce margin */
                padding: 10px;
            }
        }

        @media (max-width: 395px) {
            .signup-wrapper {
                width: 370px !important;
                margin: 20px 10px;  /* ✅ Reduce margin */
                padding: 10px;
            }
        }

    </style>
    <link rel="stylesheet" href="{{ asset('style2.css')}}">
    <div class="container signup-wrapper text-center" >

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif


        <!-- Close icon -->
        <div class="text-start mb-4">
            <a href="/"> <img src="{{asset('img/delete-sign.png')}}" alt="Close" /></a>
        </div>

        <!-- Heading -->
        <div class="mb-3">
            <p class="text-welcome">Welcome</p>
            <h2 class="signup-title">Sign in to your account</h2>
        </div>



        <!-- Form -->
        <form action="{{ route('adminLogin.authenticate') }}" method="POST">
            @csrf
            <!-- Email -->
            <div class="form-group text-start">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="johndoe@email.com" />
            </div>

            <!-- Password -->
            <div class="form-group text-start">
                <label class="form-label">Password</label>
                <input type="password" class="form-control password-input" name="password" id="password" placeholder="*************" />
                <span class="toggle-password" onclick="togglePassword('password', this)">
            <img src="{{ asset('img/visible--v1.png') }}" />
        </span>
            </div>

            <!-- Checkbox -->
            <div class="form-check text-start mb-4">
                <input class="form-check-input checkbox-custom" type="checkbox" id="terms" checked />
                <label class="form-check-label small" for="terms"> Remember me </label>
            </div>

            <!-- Sign In Button -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">SIGN IN</button>
            </div>
        </form>


        <!-- Footer -->
        {{-- <p class="small">
            No Account yet?
            <a href="/sign-up" class="custom-link">SIGN UP</a>
        </p> --}}

    </div>

    <script>
        function togglePassword(fieldId, icon) {
            const input = document.getElementById(fieldId);
            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";

            icon.querySelector("img").src = isPassword
                ? "https://img.icons8.com/ios-glyphs/20/000000/invisible.png"
                : "https://img.icons8.com/ios-glyphs/20/000000/visible--v1.png";
        }
    </script>
</x-layout2>
