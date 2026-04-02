 // Mobile Menu Toggle
 function toggleMobileMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
}

// Update mobile menu display on window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 992) {
        document.querySelector('.nav-links').style.display = 'flex';
    } else {
        document.querySelector('.nav-links').style.display = 'none';
    }
});

// Existing filter toggle function
function toggleFilters() {
    let filters = document.getElementById("filters");
    filters.style.display = filters.style.display === "none" || filters.style.display === "" ? "block" : "none";
}

// Price range update
const priceRange = document.getElementById("price-range");
const priceValue = document.getElementById("price-value");
priceRange.addEventListener("input", function() {
    priceValue.textContent = priceRange.value;
});

// calculator
