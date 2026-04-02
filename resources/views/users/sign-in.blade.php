<x-layout>

    <section class="login-section">

        <div class="login-wrapper">

            <div class="login-header">
                <div class="text-start mb-4">
                    <a href="/" style="color: white"> <img src="{{asset('img/cross.png')}}" alt="Close" style="margin-bottom: -50px"/></a>
                </div>
                <h2>Login</h2>
            </div>
            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Success Message (Optional) --}}
            @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif
            <form class="login-form" method="POST" action="{{ route('login.authenticate') }}">
                @csrf
                <div class="login-field">
                    <label for="login-email">Username or Email</label>
                    <input type="text" id="login-email" name="email" placeholder="Enter your Username or Email" required>
                </div>

                <div class="login-field">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="Enter your Password" required>
                </div>



                <button type="submit" class="login-btnn">Login</button>

                <p class="login-register-text">
                    Don't Have an Account? <a href="/sign-up">Register</a>
                </p>
            </form>

        </div>
    </section>
    <x-chatbot>
    </x-chatbot> 
</x-layout>
