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
            background: #0a0a0a;
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



                <h2 style="text-align:center;">Registered Users</h2>

                @if(session('success'))
                    <p style="text-align:center; color: green;">{{ session('success') }}</p>
                @endif

                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn edit-btn"><i class="fa-solid fa-pen-to-square" style="font-size: 20px;"></i></a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-btn" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash" style="font-size: 20px;color:red;"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No users found.</td></tr>
                    @endforelse
                    </tbody>
                </table>








                {{--            --------------------}}

            </div>

        </div>
    </div>
</x-layout>
