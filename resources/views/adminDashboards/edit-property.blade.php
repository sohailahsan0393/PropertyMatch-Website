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

        .edit-form-container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            font-family: 'Segoe UI', sans-serif;
        }

        .edit-form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .edit-form-container label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        .edit-form-container input,
        .edit-form-container select,
        .edit-form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .edit-form-container textarea {
            resize: vertical;
            min-height: 80px;
        }

        .edit-form-container button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
            width: 100%;
        }

        .edit-form-container button:hover {
            background-color: #0056b3;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="main-container" style="  background-color: #f9f9ff;">
        <x-AdminSidebar/>

        <div class="content" id="content">
            {{--            --------------------}}

            <div id="main-container">

                <div class="edit-form-container">
                    <h2>Edit Property</h2>

                    @if(session('success'))
                        <div style="color: green;">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.update.property', $property->id) }}" method="POST" style="max-width: 700px; margin: auto;">
                        @csrf
                        @method('PUT')

                        <div>
                            <label>Property Status:</label>
                            <select name="status" required>
                                <option value="active" {{ old('status', $property->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ old('status', $property->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                                <option value="reject" {{ old('status', $property->status) == 'reject' ? 'selected' : '' }}>Reject</option>
                            </select>
                        </div>

                        <div style="margin-top: 15px;">
                            <button type="submit" style="padding: 10px 20px; background: #2a9fd6; color: white; border: none; border-radius: 5px;">Update Property Status</button>
                        </div>
                    </form>

            </div>

        </div>
    </div>
</x-layout>
