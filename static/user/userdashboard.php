<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap FIRST -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- YOUR CSS LAST -->
<link rel="stylesheet" href="../index.css">
<link rel="stylesheet" href="../styles/userdashboard.css">


<title>Sticky Navbar & Footer</title>




</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="logo">Local Services</a>

        <div class="menu-toggle" onclick="toggleMenu()">☰</div>

        <div class="nav-links" id="navLinks">
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
<section class="shops-section">
  <div class="container">
    <h2 class="section-title">Featured Local Shops</h2>

    <div class="row">

      <!-- CARD 1 -->
      <div class="col-md-3 col-sm-6">
        <div class="shop-card">
          <div class="shop-img">
            <img src="https://cdn.pixabay.com/photo/2019/12/01/18/04/hairdresser-4666064_1280.jpg" alt="Shop">
          </div>
          <div class="shop-content">
            <h4>Glow Beauty Salon</h4>
            <p><i class="fa fa-map-marker"></i> Hyderabad</p>
            <div class="rating">
              ★★★★☆ <span>(4.5)</span>
            </div>
            <a href="#" class="btn btn-primary btn-block">Contact Now</a>
          </div>
        </div>
      </div>

      <!-- CARD 2 -->
      <div class="col-md-3 col-sm-6">
        <div class="shop-card">
          <div class="shop-img">
            <img src="https://images.pexels.com/photos/4254168/pexels-photo-4254168.jpeg" alt="Shop">
          </div>
          <div class="shop-content">
            <h4>QuickFix Electricians</h4>
            <p><i class="fa fa-map-marker"></i> Bangalore</p>
            <div class="rating">
              ★★★★☆ <span>(4.4)</span>
            </div>
            <a href="#" class="btn btn-primary btn-block">Contact Now</a>
          </div>
        </div>
      </div>

      <!-- CARD 3 -->
      <div class="col-md-3 col-sm-6">
        <div class="shop-card">
          <div class="shop-img">
            <img src="https://images.pexels.com/photos/6195117/pexels-photo-6195117.jpeg" alt="Shop">
          </div>
          <div class="shop-content">
            <h4>CleanHome Services</h4>
            <p><i class="fa fa-map-marker"></i> Chennai</p>
            <div class="rating">
              ★★★★☆ <span>(4.6)</span>
            </div>
            <a href="#" class="btn btn-primary btn-block">Contact Now</a>
          </div>
        </div>
      </div>

      <!-- CARD 4 -->
      <div class="col-md-3 col-sm-6">
        <div class="shop-card">
          <div class="shop-img">
            <img src="https://images.pexels.com/photos/4254555/pexels-photo-4254555.jpeg" alt="Shop">
          </div>
          <div class="shop-content">
            <h4>Pro Plumbing Works</h4>
            <p><i class="fa fa-map-marker"></i> Mumbai</p>
            <div class="rating">
              ★★★★☆ <span>(4.3)</span>
            </div>
            <a href="#" class="btn btn-primary btn-block">Contact Now</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
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
</script>

</body>
</html>
