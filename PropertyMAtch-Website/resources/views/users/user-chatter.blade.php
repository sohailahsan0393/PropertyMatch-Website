<x-layout>
    <style>
        body {
            background-color: #f4f7f9;
        }

        .chat-container {
            display: flex;
            height: 80vh;
            margin-top: 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
                rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        }

        .property-list {
            width: 30%;
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            overflow-y: auto;
            height: 100%;
            max-height: 80vh;
        }

        .property-item {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
            transition: background 0.2s;
        }

        .property-item:hover {
            background-color: #f8f9fa;
        }

        .chat-area {
            width: 70%;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
            height: 100%;
        }

        .chat-header {
            padding: 15px;
            background-color: #007bff;
            color: white;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            max-height: 60vh;
        }

        .message {
            margin-bottom: 15px;
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 20px;
        }

        .message.agent {
            background-color: #e3f2fd;
            align-self: flex-start;
        }

        .message.buyer {
            background-color: #d4edda;
            align-self: flex-end;
        }

        .chat-input {
            padding: 10px 15px;
            border-top: 1px solid #ccc;
        }

        .chat-input input {
            width: 85%;
            display: inline-block;
        }

        .chat-input button {
            width: 13%;
        }

        .property-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
        }

        .property-title {
            font-weight: bold;
            margin-top: 5px;
        }

        .property-price {
            color: green;
            font-size: 0.9em;
        }

        /* Optional scrollbar style */
        .chat-messages::-webkit-scrollbar,
        .property-list::-webkit-scrollbar {
            width: 6px;
        }

        .chat-messages::-webkit-scrollbar-thumb,
        .property-list::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        .chat-messages {
            overflow-y: auto;
            max-height: 400px;
        }

        .message {
            padding: 8px 12px;
            border-radius: 12px;
            margin: 4px 0;
        }
    </style>

    <!-- Bootstrap Icons (optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <div class="main-container" style="background-color: #f9f9ff;">
        <x-sidebar />

        <div class="content" id="content">
            <div id="main-container">

                <div class="chat-container mt-5 d-flex gap-4">

                    <!-- Sidebar -->
                    <div class="property-list" style="width: 300px;padding:1%;">
                        <h5>User Chats</h5>
                        @foreach ($chattedProperties as $property)
                            <a href="{{ route('chat.index', [
                                'receiver_id' => $property->other_user_id,
                                'property_title' => $property->property_title,
                            ]) }}"
                            
                                class="text-decoration-none text-dark">
                                <div
                                    class="property-item mb-3 border rounded p-2 {{ $property->property_title == $property_title && $property->other_user_id == $receiver_id ? 'bg-light border-primary' : '' }}">
                                    @if ($property->property_image)
                                    <img src="{{ asset('storage/' . $property->property_image) }}"
                                         alt="Property Image"
                                         class="img-fluid rounded mb-2"
                                         style="width: 100%; max-height: 120px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/default-property.jpg') }}"
                                         alt="Default Property"
                                         class="img-fluid rounded mb-2"
                                         style="width: 100%; max-height: 120px; object-fit: cover;">
                                @endif
                                    <div class="fw-bold">{{ $property->property_title }}</div>
                                    {{--                                    <div class="text-muted small">User ID: {{ $property->other_user_id }}</div> --}}
                                    <div class="text-muted small">Owner Email: {{ $property->other_user_email }}</div>
                                    @if ($property->other_user_phone)
    <div class="text-muted small">Phone: {{ $property->other_user_phone }}</div>
@endif

                                   


                                </div>
                            </a>
                        @endforeach

                    </div>

                    <!-- Chat area -->
                    <div class="chat-area flex-grow-1">
                        @if ($property_title && $receiver_id)
                            <div class="chat-header mb-3">
                                <h5>Chat About: <strong>{{ $property_title }}</strong></h5>

                            </div>

                            <div class="chat-messages d-flex flex-column mb-3" style="height: 400px; overflow-y: auto;">
                                @foreach ($messages as $msg)
                                    @if ($msg->sender_id == session('user_id'))
                                        <div class="align-self-end bg-primary text-white p-2 rounded mb-2"
                                            style="max-width: 60%">
                                            {{ $msg->message }}
                                        </div>
                                    @else
                                        <div class="align-self-start bg-light p-2 rounded mb-2" style="max-width: 60%">
                                            {{ $msg->message }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <form action="{{ route('chat.send') }}" method="POST" class="chat-input d-flex">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
                                <input type="hidden" name="property_title" value="{{ $property_title }}">
                                <input type="text" name="message" class="form-control me-2"
                                    placeholder="Type your message..." required>
                                <button class="btn btn-primary">Send</button>
                            </form>
                        @else
                            <div class="alert alert-info">No chat available yet.</div>
                        @endif
                    </div>
                </div>



            </div>
        </div>
    </div>
</x-layout>
