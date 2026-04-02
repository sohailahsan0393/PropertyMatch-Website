

<x-layout>
    <section class="register-section">
        <div class="register-wrapper">
            <div class="register-header">
                <div class="text-start mb-4">
                    <a href="/" style="color: white"> <img src="{{asset('img/cross.png')}}" alt="Close" style="margin-bottom: -50px"/></a>
                </div>
                <h2>Create Account</h2>
            </div>
            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="register-form" method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="register-field">
                    <label for="register-username">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder=" Phone #" >

                </div>

                <div class="register-field">
                    <label for="register-email">Email</label>
                    <input type="email" id="register-email" name="email" placeholder="Enter your Email" required>
                </div>

                <div class="register-field">
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" placeholder="Create a Password"
                           required>
                </div>

                <div class="register-field">
                    <label for="register-confirm-password">Confirm Password</label>
                    <input type="password" id="register-confirm-password" name="password_confirmation"
                           placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="register-btn">Register</button>

                <p class="register-login-text">
                    Already have an account? <a href="/sign-in">Login</a>
                </p>
            </form>


        </div>
    </section>
    <x-chatbot>
    </x-chatbot> 
</x-layout>
