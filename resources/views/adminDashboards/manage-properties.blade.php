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
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th{
            background: #5038ED;
            color:white;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="main-container" style="  background-color: #f9f9ff;">
        <x-AdminSidebar/>

        <div class="content" id="content">
            {{--            --------------------}}

            <div id="main-container">

                {{--                ------------------------------------------------}}





                    <h2>Manage Properties</h2>

                    @if(session('success'))
                        <div style="color: green;">{{ session('success') }}</div>
                    @endif

                    <table >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Area</th>
                            <th>Bedrooms</th>
                            <th>Bathrooms</th>
                            <th>Floors</th>
                            <th>Status</th>
                            <th><i class="fa-solid fa-download"></i></th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($properties as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>{{ $property->user_id }}</td>
                                <td>{{ $property->property_title }}</td>
                                <td>{{ $property->property_status }}</td>
                                <td>{{ $property->property_category }}</td>
                                <td>{{ $property->price }}</td>
                                <td>{{ $property->location }}</td>
                                <td>{{ $property->land_area }}</td>
                                <td>{{ $property->bedrooms }}</td>
                                <td>{{ $property->bathrooms }}</td>
                                <td>{{ $property->floors }}</td>
                                <td>{{ $property->status }}</td>
                                <td>
                                    {{-- Download Legal Docs --}}
                                    @foreach($property->legal_docs as $doc)
                                        <a href="{{ asset('storage/' . $doc) }}" download title="Download Legal Document">
                                            <i class="fa-solid fa-file-arrow-down" style="font-size: 20px; color: green;"></i>
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.edit.property', $property->id) }}"><i class="fa-solid fa-pen-to-square" style="font-size: 20px;"></i></a> |
                                    <form action="{{ route('admin.delete.property', $property->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this property?')" style="border: none;"><i class="fa-solid fa-trash" style="font-size: 20px;color:red;"></i></button>
                                    </form>


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">No properties found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>









                {{--            --------------------}}

            </div>

        </div>
    </div>
</x-layout>
