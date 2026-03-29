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

                <h2>My Account</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ url('/update-account') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>New Password (optional):</label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Update Account</button>
                </form>






                {{--            --------------------}}

            </div>


        </div>
    </div>
    <x-chatbot>
    </x-chatbot> 
</x-layout>
