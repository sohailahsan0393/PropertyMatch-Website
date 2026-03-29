<x-layout>
    <x-nav/>
    <section class="contact-section">
        <div class="contact-container">
            <h1 class="main-heading">We're Here to Help!</h1>

            <div class="divider"></div>

            <p class="support-text">
                Feel free to reach out with any questions or feedback. Our team is ready to assist you with all your property needs.
            </p>

            <div class="contact-boxes">
                <!-- Email Box -->
                <div class="contact-card">
                    <div class="contact-content">
                        <div class="icon-container email-icon">
                            <img src="{{asset('assets/icons/icons8-email-50.png')}}" alt="">
                        </div>
                        <div class="text-content">
                            <h3 class="contact-title">Email Address</h3>
                            <a href="mailto:info@propertymatch.com" class="contact-info">info@propertymatch.com</a>
                        </div>
                    </div>
                </div>

                <!-- Phone Box -->
                <div class="contact-card">
                    <div class="contact-content">
                        <div class="icon-container phone-icon">
                            <img src="{{asset('assets/icons/icons8-call-50.png')}}" alt="">
                        </div>
                        <div class="text-content">
                            <h3 class="contact-title">Phone Number</h3>
                            <a href="tel:+92345678910" class="contact-info">+92 345 678 910</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section-form">
        <h2>Get in touch</h2>
        <div class="divider">
            <span></span>
            <i class="box"></i>
            <span></span>
        </div>
        {{-- Success message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <input type="text" placeholder="Full Name" name="full_name" required>
            <input type="email" placeholder="Email Address" name="email" required>
            <input type="tel" placeholder="Mobile Number" name="tel_no" required>
            <input type="text" placeholder="Subject" name="subject" required>
            <textarea placeholder="Enter Your Message" name="message" rows="5" required></textarea>
            <button type="submit">Send Message</button>
        </form>



    </section>
    <x-chatbot>
    </x-chatbot> 
</x-layout>
<x-footer/>
