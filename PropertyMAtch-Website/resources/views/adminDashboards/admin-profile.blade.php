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




                <h2>My Account</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
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
</x-layout>
