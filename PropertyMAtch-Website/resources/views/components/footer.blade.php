<footer class="footer">
    <div class="footer-content">
        <!-- Logo + Contact -->
        <div class="footer-section">
            <div class="footer-logo">
                <img src="{{asset('assets/icons/22.png')}}" alt="Property Match Logo">
            </div>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+92 34832832</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>info@propertymatch.com</span>
                </div>
            </div>
        </div>

        <!-- General Info -->
        <div class="footer-section">
            <h4>General Info</h4>
            <ul class="footer-links">
                <li><a href="/about">About Us</a></li>
                <li><a href="/all-listing">All Listings</a></li>
                <li><a href="/calculator">Investment Calculator</a></li>
                <li><a href="/contact">Contact Us</a></li>
            </ul>
        </div>

        <!-- Categories -->
        <div class="footer-section">
            <h4>Categories</h4>
            <ul class="footer-links">
                <li><a href="{{ url('/property?category=Apartment') }}">Apartment</a></li>
                <li><a href="{{ url('/property?category=Villa') }}">Villa</a></li>
  <li><a href="{{ url('/property?category=Overseas') }}">Overseas</a></li>
                <li><a href="{{ url('/property?category=Family House') }}">Family House</a></li>
            </ul>
        </div>

        <!-- Subscribe -->
        <div class="footer-section">
            <h4>Subscribe</h4>
            <p>To get a free & amazing offers and other cool things stay with us. Please subscribe us.</p>
            <form class="subscribe-form">
                <input type="email" placeholder="Your email address" class="subscribe-input" class="form-contol">
                <button type="submit" class="subscribe-btn">Subscribe</button>
            </form>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="copyright">
            © 2024 Property Match. All Rights Reserved
        </div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</footer>
