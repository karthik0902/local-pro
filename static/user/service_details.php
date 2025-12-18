<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap FIRST -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- YOUR CSS LAST -->
<link rel="stylesheet" href="../index.css">
<link rel="stylesheet" href="../styles/srvicedetails.css">


<title>Sticky Navbar & Footer</title>




</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="logo">Local Services</a>

        <div class="menu-toggle" onclick="toggleMenu()">☰</div>

        <div class="nav-links" id="navLinks">
              <form class="search-form1" id="localServiceForm">
                
                <div class="input-group service-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="serviceInput" placeholder="What are you looking for? (e.g. Plumber, Salon)">
                </div>

                <div class="input-group location-search">
                    <i class="fa-solid fa-location-dot"></i>
                    <input type="text" id="locationInput" placeholder="Location">
                </div>

                <button type="submit" class="btn-search">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Login</a>
        </div>
    </div>
</nav>

<!-- ================= CONTENT ================= -->
 <main>

 <section class="service-hero">
    <div class="overlay">
        <div class="container">
            <h1>Premium AC Repair Service</h1>
            <p>
                <i class="fa fa-map-marker"></i> Hyderabad |
                <i class="fa fa-star"></i> 4.8 (124 Reviews)
            </p>
            <a href="../booking.html" class="btn btn-warning btn-lg">Book Service</a>
        </div>
    </div>
</section>
<div class="container service-content">

    <div class="row">

        <!-- LEFT COLUMN -->
        <div class="col-md-8">

            <!-- Overview -->
            <div class="card">
                <h3>Service Overview</h3>
                <p>
                    Our professional AC repair service ensures fast, reliable, and affordable solutions
                    for all air conditioner brands. Trusted by 1000+ customers.
                </p>

                <ul class="service-features">
                    <li><i class="fa fa-check-circle"></i> Experienced Technicians</li>
                    <li><i class="fa fa-check-circle"></i> Same Day Service</li>
                    <li><i class="fa fa-check-circle"></i> Affordable Pricing</li>
                </ul>

                <p><strong>Price:</strong> ₹499 onwards</p>
                <p><strong>Duration:</strong> 1–2 Hours</p>
            </div>

            <!-- Gallery -->
            <div class="card">
                <h3>Service Gallery</h3>
                <div class="row gallery">
                    <div class="col-xs-4">
                        <img src="https://images.pexels.com/photos/4489762/pexels-photo-4489762.jpeg" class="img-responsive">
                    </div>
                    <div class="col-xs-4">
                        <img src="https://images.pexels.com/photos/8486925/pexels-photo-8486925.jpeg" class="img-responsive">
                    </div>
                    <div class="col-xs-4">
                        <img src="https://cdn.pixabay.com/photo/2020/05/26/07/05/screwdriver-5221750_1280.jpg" class="img-responsive">
                    </div>
                    
                </div>
            </div>

            <!-- Reviews -->
            <div class="card">
                <h3>Customer Reviews</h3>

                <div class="review">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg">
                    <div>
                        <strong>Rahul Sharma</strong>
                        <p class="stars">★★★★★</p>
                        <p>Quick service and very professional technician.</p>
                    </div>
                </div>

                <div class="review">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg">
                    <div>
                        <strong>Anita Verma</strong>
                        <p class="stars">★★★★☆</p>
                        <p>Good service at a reasonable price.</p>
                    </div>
                </div>

                <button type="button" id="writeReviewBtn" class="btn btn-default">Write a Review</button>

                <form id="reviewForm" style="display:none; margin-top:15px;">
                    <div class="form-group">
                        <label for="reviewName">Your Name</label>
                        <input type="text" class="form-control" id="reviewName" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="reviewRating">Rating</label>
                        <select id="reviewRating" class="form-control">
                            <option value="5">★★★★★ - Excellent</option>
                            <option value="4">★★★★☆ - Good</option>
                            <option value="3">★★★☆☆ - Average</option>
                            <option value="2">★★☆☆☆ - Poor</option>
                            <option value="1">★☆☆☆☆ - Very Poor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reviewText">Your Review</label>
                        <textarea id="reviewText" class="form-control" rows="3" placeholder="Share your experience..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-md-4">

            <div class="card provider-card">
                <img src="https://images.pexels.com/photos/7347538/pexels-photo-7347538.jpeg" class="img-responsive">
                <h4>CoolTech Services</h4>
                <p><i class="fa fa-map-marker"></i> Hyderabad</p>
                <p><i class="fa fa-phone"></i> +91 98765 43210</p>

                <a href="#" class="btn btn-success btn-block">
                    <i class="fa fa-phone"></i> Call Now
                </a>
                <a href="../booking.html" class="btn btn-primary btn-block">
                    <i class="fa fa-calendar"></i> Book Appointment
                </a>
            </div>

        </div>

    </div>
</div>
 </main>

<!-- ================= FOOTER ================= -->
<footer class="footer">
    <div class="footer-container">
        <div>
            <h3>About</h3>
            <p>Professional local services platform providing quality solutions.</p>
        </div>

        <div>
            <h3>Quick Links</h3>
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">Pricing</a>
            <a href="#">Contact</a>
        </div>

        <div>
            <h3>Support</h3>
            <a href="#">Help Center</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
        </div>
    </div>

    <div class="footer-bottom">
        © 2025 MyWebsite. All rights reserved.
    </div>
</footer>

<script>
function toggleMenu() {
    document.getElementById("navLinks").classList.toggle("active");
}

// Show / hide review form
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('writeReviewBtn');
    var form = document.getElementById('reviewForm');
    if (btn && form) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            var isVisible = form.style.display === 'block';
            form.style.display = isVisible ? 'none' : 'block';
            btn.textContent = isVisible ? 'Write a Review' : 'Close Review';
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Thank you for your review! (Demo only, not saved.)');
            form.reset();
            form.style.display = 'none';
            btn.textContent = 'Write a Review';
        });
    }
});
</script>

</body>
</html>
