<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Local Services Listing with Filters</title>

<style>
    /* ----------------------------------------------------------- */
    /* 🌈 MANDATORY :root CAREERNOVA THEME VARIABLES */
    /* ----------------------------------------------------------- */
    :root {
        /* ---------- Core Colors ---------- */
        --Cn-bg-0: #F6F9FB; /* light page base */
        --Cn-bg-1: #0F1A2A; /* deep navy (primary background) */
        --Cn-surface: rgba(255, 255, 255, 0.82); /* glass-like panel base */
        --Cn-text-primary: #1B2838; /* primary dark text */
        --Cn-text-muted: #5A6A85;         /* secondary text */
        --Cn-border-light: rgba(255,255,255,0.08); /* for dark backgrounds */
        
        /* ---------- Gradients ---------- */
        --Cn-grad-primary: linear-gradient(135deg, #3A7BD5, #00D2FF);   /* sunrise blue cyan */
        --Cn-grad-accent: linear-gradient(135deg, #FFB56B, #FF7A00); /* warm sunrise accent */
        
        /* ---------- Typography ---------- */
        --Cn-font-heading: "Poppins", system-ui, sans-serif;
        --Cn-font-body: "Inter", system-ui, sans-serif;

        /* ---------- Radii ---------- */
        --Cn-radius-sm: 10px; 
        --Cn-radius-card: 28px; 
        --Cn-radius-pill: 999px; 

        /* ---------- Shadows & Motion ---------- */
        --Cn-shadow-soft: 0 5px 18px rgba(15, 26, 42, 0.06); 
        --Cn-shadow-lift: 0 12px 28px rgba(15, 26, 42, 0.12); 
        --Cn-glow-primary: 0 8px 32px rgba(58, 123, 213, 0.18);
        --Cn-speed-fast: 0.22s; 
        --Cn-ease-smooth: cubic-bezier(.25,.46,.45,.94); 

        /* ---------- Layout tokens ---------- */
        --Cn-gap-xs: 8px; 
        --Cn-gap-sm: 16px; 
        --Cn-gap-md: 24px; 
        --Cn-gap-lg: 36px; 
    }

    /* ----------------------------------------------------------- */
    /* GENERAL STYLES & LAYOUT */
    /* ----------------------------------------------------------- */
    body {
        background-color: var(--Cn-bg-0);
        font-family: var(--Cn-font-body);
        color: var(--Cn-text-primary);
    }
    h1, h2, h3, h4 {
        font-family: var(--Cn-font-heading);
    }
    .service-section {
        padding-top: var(--Cn-gap-lg);
        padding-bottom: var(--Cn-gap-lg);
    }
    .section-title {
        font-family: var(--Cn-font-heading);
        margin-top: 0;
        margin-bottom: var(--Cn-gap-lg);
    }

    /* ----------------------------------------------------------- */
    /* NAVBAR STYLES */
    /* ----------------------------------------------------------- */
    .navbar {
        background-color: var(--Cn-bg-1);
        border: none;
        box-shadow: var(--Cn-shadow-soft);
        z-index: 1000;
        position: sticky; 
        top: 0;
    }
    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    .logo {
        color: white;
        font-size: 1.5em;
        font-weight: 700;
        padding: 15px 0;
        text-decoration: none;
    }
    .nav-links a {
        color: var(--Cn-text-muted);
        text-decoration: none;
        padding: 15px 10px;
        display: inline-block;
        transition: color var(--Cn-speed-fast);
    }
    .nav-links a:hover {
        color: #00D2FF;
    }
    /* Mobile Menu Toggle */
    .menu-toggle {
        color: white;
        font-size: 1.5em;
        cursor: pointer;
        display: none;
        padding: 15px 0;
    }
    
    @media (max-width: 767px) {
        .menu-toggle { display: block; }
        .nav-links {
            display: none;
            flex-direction: column;
            width: 100%;
            background-color: var(--Cn-bg-1);
            position: absolute;
            top: 50px;
            left: 0;
            padding: 10px 0;
            text-align: center;
        }
        .nav-links.active { display: flex; }
    }



    /* ----------------------------------------------------------- */
    /* STICKY FILTER WRAPPER FOR DESKTOP (WEB VIEW) */
    /* ----------------------------------------------------------- */
    @media (min-width: 992px) { /* Applies to md (desktop) and larger screens */
        .Cn-filter-panel-wrapper {
            position: -webkit-sticky;
            position: sticky;
            top: 80px; /* sits just below sticky navbar */
            z-index: 900; /* below navbar (1000) */
            margin-bottom: var(--Cn-gap-lg);
        }
        .Cn-filter-panel {
            max-height: calc(100vh - 110px); /* fill viewport under navbar */
            overflow-y: auto;
        }
    }


    /* ----------------------------------------------------------- */
    /* FILTER PANEL STYLES (Applies to both desktop and modal) */
    /* ----------------------------------------------------------- */
    .Cn-filter-panel {
        /* Glass Elevation */
        background-color: var(--Cn-surface);
        backdrop-filter: blur(8px);
        border-radius: var(--Cn-radius-card); 
        padding: var(--Cn-gap-md);
        box-shadow: var(--Cn-shadow-soft);
        /* Removed margin-bottom since it's now on the wrapper */
    }
    /* Modal content styling to inherit Glass Elevation */
    #filterModal .modal-content {
        border-radius: var(--Cn-radius-card);
        background-color: var(--Cn-surface); 
        backdrop-filter: blur(8px);
        box-shadow: var(--Cn-shadow-lift);
    }
    #filterModal .modal-header, #filterModal .modal-footer {
        border-color: rgba(0, 0, 0, 0.1);
    }
    #filterModal .modal-title {
        font-family: var(--Cn-font-heading);
        font-weight: 700;
        color: var(--Cn-text-primary);
    }
    /* Utility for filter groups */
    .Cn-filter-group {
        margin-bottom: var(--Cn-gap-md);
        padding-bottom: var(--Cn-gap-sm);
        border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
    }
    .Cn-filter-group:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .Cn-filter-group h4 {
        font-size: 1.2em;
        font-weight: 600;
        margin-top: 0;
        margin-bottom: var(--Cn-gap-sm);
    }

    /* Filter Pills */
    .Cn-filter-pills {
        display: flex;
        flex-wrap: wrap;
        gap: var(--Cn-gap-xs);
    }
    .Cn-filter-pill {
        font-size: 0.85em;
        padding: 5px 12px;
        border-radius: var(--Cn-radius-pill);
        background-color: var(--Cn-bg-0);
        color: var(--Cn-text-primary);
        border: 1px solid transparent;
        transition: all var(--Cn-speed-fast) var(--Cn-ease-smooth);
        cursor: pointer;
    }
    .Cn-filter-pill.active {
        background: var(--Cn-grad-primary);
        color: white;
        font-weight: 600;
        border-color: #00D2FF;
    }
    .Cn-filter-pill:hover:not(.active) {
        border-color: #3A7BD5;
        background-color: white;
    }

    /* Mobile Filter Button (Opportunity Glow) */
    .Cn-btn-filter-mobile, .Cn-btn-filter-apply {
        background: var(--Cn-grad-primary);
        color: white;
        font-weight: 600;
        padding: 10px 25px;
        border-radius: var(--Cn-radius-pill);
        border: none;
        transition: all var(--Cn-speed-fast) var(--Cn-ease-smooth);
        box-shadow: 0 0 10px rgba(58, 123, 213, 0.5); /* Soft glow */
    }

    .Cn-btn-filter-mobile:hover, .Cn-btn-filter-apply:hover {
        color: white;
        opacity: 0.9;
        box-shadow: var(--Cn-shadow-lift), var(--Cn-glow-primary); 
    }


    /* ----------------------------------------------------------- */
    /* SERVICE CARD STYLES */
    /* ----------------------------------------------------------- */
    .service-card {
        background-color: var(--Cn-surface); 
        backdrop-filter: blur(8px);
        border-radius: var(--Cn-radius-card); 
        padding: var(--Cn-gap-md);
        box-shadow: var(--Cn-shadow-soft); 
        margin-bottom: var(--Cn-gap-md); 
        transition: transform var(--Cn-speed-fast) var(--Cn-ease-smooth), 
                    box-shadow var(--Cn-speed-fast) var(--Cn-ease-smooth);
    }
    .service-card:hover {
        transform: translateY(-6px); /* Elevation Hover Lift */
        box-shadow: var(--Cn-shadow-lift); 
    }
    .service-image img {
        width: 100%;
        height: 100%;
        min-height: 130px;
        max-height: 130px;
        margin-top : 20px;
        border-radius: var(--Cn-radius-card); 
        object-fit: cover;
    }
    .shop-name { color: #3A7BD5; font-weight: 600; margin-top: 5px; }
    .location { color: var(--Cn-text-muted); font-size: 0.9em; }
    .rating { color: #FF7A00; margin-top: var(--Cn-gap-xs); font-size: 1.1em; }
    .rating span { color: var(--Cn-text-primary); font-size: 0.9em; margin-left: 5px; }
    .price {
        font-size: 1.8em;
        font-weight: 700;
        color: #12CBC4; 
        display: block;
        margin-bottom: var(--Cn-gap-sm);
        text-align: center;
    }
    .service-actions { text-align: center; padding-top: var(--Cn-gap-sm); }
    .service-actions .btn { margin-bottom: var(--Cn-gap-xs); }
    .service-actions .btn-success {
        background: var(--Cn-grad-primary);
        border-color: #3A7BD5;
        color: white;
        font-weight: 600;
    }
    .service-actions .btn-success:hover {
        background: #00D2FF;
        border-color: #00D2FF;
    }

    /* ----------------------------------------------------------- */
    /* FOOTER STYLES */
    /* ----------------------------------------------------------- */
    .footer {
        background-color: var(--Cn-bg-1);
        color: white;
        padding: var(--Cn-gap-lg) 0 0 0;
    }
    .footer-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    .footer-container > div {
        flex: 1 1 200px;
        margin-bottom: var(--Cn-gap-md);
    }
    .footer-container h3 {
        color: white;
        font-size: 1.3em;
        margin-top: 0;
        margin-bottom: var(--Cn-gap-sm);
    }
    .footer-container a, .footer-container p {
        display: block;
        color: var(--Cn-text-muted);
        text-decoration: none;
        font-size: 0.9em;
        margin-bottom: 5px;
        transition: color var(--Cn-speed-fast);
    }
    .footer-container a:hover {
        color: #00D2FF;
    }
    .footer-bottom {
        text-align: center;
        padding: var(--Cn-gap-md);
        border-top: 1px solid var(--Cn-border-light);
        color: var(--Cn-text-muted);
        margin-top: var(--Cn-gap-md);
        font-size: 0.8em;
    }
</style>


</head>

<body>

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

<main>
    <div class="container service-section">
        <h2 class="text-center section-title">Search Results</h2>
        
        <div class="row visible-xs visible-sm">
            <div class="col-xs-12 text-center" style="margin-bottom: 20px;">
                <button class="btn Cn-btn-filter-mobile" data-toggle="modal" data-target="#filterModal">
                    <i class="fa fa-sliders"></i> Show Filters
                </button>
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-md-3 col-sm-4 hidden-xs hidden-sm">
                <div class="Cn-filter-panel-wrapper">
                    <div class="Cn-filter-panel">
                        <div class="Cn-filter-group">
                            <h4>Filter by Category</h4>
                            <div class="Cn-filter-pills">
                                <span class="Cn-filter-pill active">Home Cleaning</span>
                                <span class="Cn-filter-pill">Plumbing</span>
                                <span class="Cn-filter-pill">Electrical</span>
                                <span class="Cn-filter-pill">Pest Control</span>
                                <span class="Cn-filter-pill">Salon at Home</span>
                            </div>
                        </div>

                        <div class="Cn-filter-group">
                            <h4>Price Range</h4>
                            <label for="price-range" style="width: 100%;">
                                <input type="range" id="price-range" min="100" max="5000" value="700" style="width: 100%;">
                            </label>
                            <p class="text-center" style="font-size: 0.9em; color: var(--Cn-text-muted);">Max Price: ₹700</p>
                        </div>

                        <div class="Cn-filter-group">
                            <h4>Rating</h4>
                            <div class="checkbox">
                                <label><input type="checkbox" value=""> 4 Stars & Up</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" value="" checked> 3 Stars & Up</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" value=""> Show Only Verified</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-sm-8 col-xs-12">
                
                <div class="service-card">
                    <div class="row">

                        <div class="col-md-3 col-sm-4 service-image">
                            <img src="https://images.pexels.com/photos/2635038/pexels-photo-2635038.jpeg" alt="Service">
                        </div>

                        <div class="col-md-6 col-sm-5 service-info">
                            <h4>Home Cleaning Service</h4>
                            <p class="shop-name">Sparkle Clean Services</p>

                            <p class="location">
                                <i class="fa fa-map-marker"></i> Hyderabad, India
                            </p>

                            <p class="description">
                                Professional home cleaning with eco-friendly products and trained staff.
                            </p>

                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(4.5)</span>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 service-actions">
                            <span class="price">₹799</span>

                            <a href="./service_details.php" class="btn btn-default btn-block">
                                <i class="fa fa-eye"></i> View details
                            </a>

                            <a href="#" class="btn btn-success btn-block">
                                <i class="fa fa-calendar"></i> Book Now
                            </a>

                            <a href="#" class="btn btn-default btn-block">
                                <i class="fa fa-phone"></i> Call
                            </a>
                        </div>
                    </div>
                </div>
               <div class="service-card">
    <div class="row">

        <div class="col-md-3 col-sm-4 service-image">
            <img src="https://images.pexels.com/photos/3993444/pexels-photo-3993444.jpeg" alt="Salon Service">
        </div>

        <div class="col-md-6 col-sm-5 service-info">
            <h4>Luxury Haircut & Styling</h4>
            <p class="shop-name">The Glamour Studio</p>

            <p class="location">
                <i class="fa fa-map-marker"></i> Bengaluru, India
            </p>

            <p class="description">
                Expert consultation, wash, professional haircut, and signature blow-dry finish.
            </p>

            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <span>(4.9)</span>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 service-actions">
            <span class="price">₹1,200</span>

            <a href="#" class="btn btn-default btn-block">
                <i class="fa fa-eye"></i> View details
            </a>

            <a href="#" class="btn btn-success btn-block">
                <i class="fa fa-calendar"></i> Book Now
            </a>

            <a href="#" class="btn btn-default btn-block">
                <i class="fa fa-phone"></i> Call
            </a>
        </div>
    </div>
</div>
                
                
                
            </div>
            
        </div>
    </div>
 </main>

<div id="filterModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Filter Services</h4>
            </div>
            <div class="modal-body">
                <div class="Cn-filter-group">
                    <h4>Filter by Category</h4>
                    <div class="Cn-filter-pills">
                        <span class="Cn-filter-pill active">Home Cleaning</span>
                        <span class="Cn-filter-pill">Plumbing</span>
                        <span class="Cn-filter-pill">Electrical</span>
                        <span class="Cn-filter-pill">Pest Control</span>
                        <span class="Cn-filter-pill">Salon at Home</span>
                    </div>
                </div>

                <div class="Cn-filter-group">
                    <h4>Price Range</h4>
                    <label for="price-range-mobile" style="width: 100%;">
                        <input type="range" id="price-range-mobile" min="100" max="5000" value="700" style="width: 100%;">
                    </label>
                    <p class="text-center" style="font-size: 0.9em; color: var(--Cn-text-muted);">Max Price: ₹700</p>
                </div>

                <div class="Cn-filter-group" style="border-bottom: none; margin-bottom: 0;">
                    <h4>Rating</h4>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> 4 Stars & Up</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked> 3 Stars & Up</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value=""> Show Only Verified</label>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn Cn-btn-filter-apply">Apply Filters</button>
            </div>
        </div>
    </div>
</div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
function toggleMenu() {
    document.getElementById("navLinks").classList.toggle("active");
}
</script>

</body>
</html>