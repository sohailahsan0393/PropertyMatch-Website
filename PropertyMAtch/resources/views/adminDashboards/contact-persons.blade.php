<x-layout >
    <style>
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




                <h2>Contact Persons</h2>

                @if(session('success'))
                    <div style="color: green;">{{ session('success') }}</div>
                @endif

                <table >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->full_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->tel_no }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="12">Nothing found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>









                {{--            --------------------}}

            </div>

        </div>
    </div>
</x-layout>
