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
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-container">
                    <h2>Property Details</h2>
                    <form action="{{ route('add-property') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Property Title -->
                        <div class="form-group">
                            <label for="title">Property Title<span style="color: red;">*</span></label>
                            <input type="text" id="title" name="property_title" placeholder="Enter property title" required>
                        </div>

                        <!-- Property Type -->
                        <div class="form-group">
                            <label for="type">Property status<span style="color: red;">*</span></label>
                            <select id="type" name="property_status" required>
                                <option value="">Select Property ststus</option>
                                <option value="Rent">Rent</option>
                                <option value="Sale">Sale</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Property Category<span style="color: red;">*</span></label>
                            <select id="type" name="property_category" required>
                                <option value="">Select Property Category</option>
                                <option value="Apartment">Apartment</option>
                                <option value="House"> Family House</option>
                                <option value="Villa">Villa</option>
                                <option value="Office">Office</option>
                                <option value="Hostel">Hostel</option>

                                <option value="Residential">Residential</option>
                                <option value="Overseas">Overseas</option>
                                

                            </select>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price<span style="color: red;">*</span></label>
                            <input type="number" id="price" name="price" placeholder="Enter property price" required>
                        </div>

                        <!-- Location -->
                        <div class="form-group">
                            <label for="location">Location<span style="color: red;">*</span></label>
                            <input type="text" id="location" name="location" placeholder="Enter property location" required>
                        </div>

                        <!-- Map URL -->
                        <div class="form-group">
                            <label for="map-url">Google Map URL<span style="color: red;">*</span></label>
                            <input type="url" id="map-url" name="map_url" placeholder="Enter Google Map link for the property" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description<span style="color: red;">*</span></label>
                            <textarea id="description" name="description" rows="4" placeholder="Enter property description" required></textarea>
                        </div>
                        <!-- Land Area -->
                        <div class="form-group">
                            <label for="land-area">Land Area (Square Feet)</label>
                            <input type="number" id="land-area" name="land_area" placeholder="Enter land area in square feet" >
                        </div>

                        <!-- Number of Bedrooms -->
                        <div class="form-group">
                            <label for="bedrooms">Number of Bedrooms</label>
                            <input type="number" id="bedrooms" name="bedrooms" placeholder="Enter number of bedrooms" >
                        </div>

                        <!-- Number of Bathrooms -->
                        <div class="form-group">
                            <label for="bathrooms">Number of Bathrooms</label>
                            <input type="number" id="bathrooms" name="bathrooms" placeholder="Enter number of bathrooms" >
                        </div>

                        <!-- Number of Floors -->
                        <div class="form-group">
                            <label for="floors">Number of Floors</label>
                            <input type="number" id="floors" name="floors" placeholder="Enter number of floors" >
                        </div>


                        <!-- Legal Documents -->

                        <div class="form-group">
                            <label for="legal-docs">Upload Legal Documents <span style="color: red;">*</span></label>
                            <p style="color: #555; font-size: 14px; margin-top: 5px;">
                                <strong>Note:</strong> Uploading legal documents is mandatory. Only PDF files are allowed.
                                If you do not upload valid legal documents, your property listing will be rejected from the Admin.
                            </p>
                            <input type="file" id="legal-docs" name="legal_docs[]" accept="application/pdf" multiple required>
                        </div>


                        <!-- Property Images -->
                        <div class="form-group">
                            <label for="images">Upload Property Images<span style="color: red;">*</span></label>
                            <input type="file" id="images" name="images[]" accept="image/*" multiple required>
                        </div>

                        <!-- Property Video -->
                        <div class="form-group">
                            <label for="video">Upload Property Video</label>
                            <input type="file" id="video" name="video" accept="video/*" >
                        </div>

                        <!-- Amenities -->
                        <div class="form-group">
                            <label for="amenities">Property Amenities</label>
                            <div class="amenities-container">
                                <label><input type="checkbox" name="amenities[]" value="Swimming Pool"> Swimming Pool</label>
                                <label><input type="checkbox" name="amenities[]" value="Gym"> Gym</label>
                                <label><input type="checkbox" name="amenities[]" value="Parking"> Parking</label>
                                <label><input type="checkbox" name="amenities[]" value="Garden"> Garden</label>
                                <label><input type="checkbox" name="amenities[]" value="Wi-Fi"> Wi-Fi</label>
                                <label><input type="checkbox" name="amenities[]" value="CCTV"> CCTV</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="submit-btn">Submit Property</button>
                    </form>
                </div>







                {{--            --------------------}}

            </div>


        </div>
    </div>
    <x-chatbot>
    </x-chatbot> 
</x-layout>
