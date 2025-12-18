<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- YOUR CSS LAST -->
<link rel="stylesheet" href="./styles/index_navbar.css">
<link rel="stylesheet" href="./styles/index_footer.css">
<link rel="stylesheet" href="./styles/loader.css">


    <title>Join Us - Service Provider Sign Up</title>

    <style>
        /* ----------------------------------------------------------- */
        /* 🌈 CORE CAREERNOVA THEME VARIABLES */
        /* ----------------------------------------------------------- */
        :root {
            /* Core Colors */
            --Cn-bg-0: #F6F9FB; 
            --Cn-surface: rgba(255, 255, 255, 0.95); 
            --Cn-text-primary: #1B2838; 
            --Cn-text-muted: #5A6A85; 
            
            /* Accent Colors */
            --Cn-primary: #3A7BD5; /* Base color for primary actions/links */
            --Cn-premium: #FF7A00; /* Distinctive color for Premium CTA */
            --Cn-success: #12CBC4; /* Feature/Checkmark color */
            
            /* Gradients */
            --Cn-grad-premium: linear-gradient(135deg, #FFB56B, #FF7A00); /* Premium CTA gradient */
            
            /* Radii & Shadows */
            --Cn-radius-sm: 12px; 
            --Cn-radius-card: 30px; 
            --Cn-radius-pill: 999px; 
            --Cn-shadow-soft: 0 4px 12px rgba(15, 26, 42, 0.08); 
            --Cn-shadow-lift: 0 16px 32px rgba(255, 122, 0, 0.25); /* Premium lift shadow */
            --Cn-glow-cta: 0 8px 20px rgba(58, 123, 213, 0.4);
            
            /* Spacing */
            --Cn-gap-xs: 8px; 
            --Cn-gap-sm: 16px; 
            --Cn-gap-md: 24px; 
            --Cn-gap-lg: 40px; 
        }

        /* ----------------------------------------------------------- */
        /* GLOBAL & LAYOUT STYLES */
        /* ----------------------------------------------------------- */
        body {
            background-color: var(--Cn-bg-0);
            font-family: 'Inter', system-ui, sans-serif;
            color: var(--Cn-text-primary);
        }
        .container {
            padding-top: var(--Cn-gap-lg);
            padding-bottom: var(--Cn-gap-lg);
        }
        .text-muted {
            color: var(--Cn-text-muted);
        }
        .section-heading {
            text-align: center;
            font-size: 2em;
            font-weight: 700;
            margin-top: var(--Cn-gap-lg);
            margin-bottom: var(--Cn-gap-lg);
        }

        /* ----------------------------------------------------------- */
        /* 1. HEADER & CTA */
        /* ----------------------------------------------------------- */
        .Cn-header-section {
            text-align: center;
            margin-bottom: var(--Cn-gap-lg);
        }
        .Cn-header-section h1 {
            font-size: 3.5em; /* Slightly larger */
            font-weight: 900;
            color: var(--Cn-primary);
            margin-bottom: var(--Cn-gap-sm);
        }
        .Cn-header-section p {
            font-size: 1.3em; /* Slightly larger */
            color: var(--Cn-text-muted);
            max-width: 800px;
            margin: 0 auto;
        }
        .Cn-main-cta {
            margin-top: var(--Cn-gap-lg);
            padding: 15px 40px;
            font-size: 1.4em;
            font-weight: 800;
            border-radius: var(--Cn-radius-pill);
            background: var(--Cn-primary);
            color: white;
            border: none;
            box-shadow: var(--Cn-glow-cta);
            transition: all 0.3s;
        }
        .Cn-main-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(58, 123, 213, 0.6);
            opacity: 0.9;
        }


        /* ----------------------------------------------------------- */
        /* 2. PRICING & COMPARISON */
        /* ----------------------------------------------------------- */
        .Cn-pricing-card {
            background-color: var(--Cn-surface);
            border-radius: var(--Cn-radius-card); 
            box-shadow: var(--Cn-shadow-soft);
            padding: var(--Cn-gap-md);
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: var(--Cn-gap-md);
            height: 100%; 
            display: flex;
            flex-direction: column;
        }

        /* Premium Card Styling (Highlighting) */
        .Cn-premium-card {
            background: #fff; 
            border: 3px solid var(--Cn-premium);
            box-shadow: var(--Cn-shadow-lift);
            transform: scale(1.05); /* Slightly bigger for emphasis */
            position: relative;
        }
        .Cn-premium-card:before {
            content: "BEST VALUE"; /* Changed text */
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--Cn-grad-premium);
            color: white;
            padding: 4px 15px;
            border-radius: var(--Cn-radius-pill);
            font-weight: 700;
            font-size: 0.9em;
            box-shadow: 0 4px 10px rgba(255, 122, 0, 0.4);
        }

        /* Pricing Card Content */
        .Cn-plan-name {
            font-size: 1.8em;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: var(--Cn-gap-xs);
        }
        .Cn-price-tag {
            font-size: 3em;
            font-weight: 800;
            line-height: 1;
            margin-bottom: var(--Cn-gap-md);
            color: var(--Cn-primary);
        }
        .Cn-price-tag.premium {
            color: var(--Cn-premium);
        }
        .Cn-features-list {
            list-style: none;
            padding: 0;
            text-align: left;
            margin-bottom: var(--Cn-gap-md);
            flex-grow: 1;
        }
        .Cn-features-list li {
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
            font-size: 1.1em;
        }
        .Cn-features-list li i {
            margin-right: var(--Cn-gap-xs);
            color: var(--Cn-success);
        }
        .Cn-features-list li.dimmed {
            color: var(--Cn-text-muted);
            opacity: 0.7; /* Use opacity instead of strikethrough for cleaner look */
        }
        .Cn-cta-button {
            margin-top: auto;
            border-radius: var(--Cn-radius-pill);
            font-weight: 700;
            padding: 12px 20px;
        }
        .Cn-cta-premium {
            background: var(--Cn-grad-premium);
            color: white;
            border: none;
            box-shadow: 0 4px 10px rgba(255, 122, 0, 0.2);
        }

        /* ----------------------------------------------------------- */
        /* 3. VALUE & TRUST SECTION */
        /* ----------------------------------------------------------- */
        .Cn-stats-bar {
            background-color: var(--Cn-surface);
            border-radius: var(--Cn-radius-sm);
            padding: var(--Cn-gap-md);
            margin-top: var(--Cn-gap-lg);
            margin-bottom: var(--Cn-gap-lg);
            box-shadow: var(--Cn-shadow-soft);
        }
        .Cn-stat {
            text-align: center;
        }
        .Cn-stat h3 {
            font-size: 2.8em;
            font-weight: 900;
            margin-top: 0;
            color: var(--Cn-premium);
        }
        .Cn-testimonial-card {
            background-color: #fff;
            padding: var(--Cn-gap-md);
            border-radius: var(--Cn-radius-sm);
            box-shadow: var(--Cn-shadow-soft);
            margin-bottom: var(--Cn-gap-sm);
            border-left: 5px solid var(--Cn-primary);
        }
        .Cn-testimonial-card i {
            color: var(--Cn-primary);
            font-size: 1.5em;
        }

        /* ----------------------------------------------------------- */
        /* 4. HOW IT WORKS */
        /* ----------------------------------------------------------- */
        .Cn-steps-grid {
            text-align: center;
            margin-bottom: var(--Cn-gap-lg);
            padding: var(--Cn-gap-md);
            background-color: var(--Cn-surface);
            border-radius: var(--Cn-radius-card);
        }
        .Cn-step-item i {
            font-size: 3.5em; /* Slightly larger icons */
            color: var(--Cn-primary);
            margin-bottom: var(--Cn-gap-xs);
        }
        .Cn-step-item h4 {
            font-weight: 800;
            margin-top: 0;
        }
        
        @media (max-width: 991px) {
             .Cn-premium-card {
                transform: scale(1.0); /* Remove scale on mobile for better fit */
                margin-top: var(--Cn-gap-lg); /* Add space when stacking */
            }
            .Cn-header-section h1 {
                font-size: 2.5em;
            }
        }
        
    </style>
</head>

<body>

 <?php include "./includes/index_navbar.html"; ?>
    
    <div class="container">
        
        <header class="Cn-header-section">
            <h1>Scale Your Service. Secure Verified Local Leads.</h1>
            <p>Access our vast customer base, take control of your pricing, and grow your revenue with zero hassle.</p>
            
            <button class="btn Cn-main-cta" onclick="alert('Starting Registration...')">
                Join Our Network Today
            </button>
        </header>

        <div class="row Cn-stats-bar">
            <div class="col-xs-4 Cn-stat">
                <h3>10K+</h3>
                <p class="text-muted">Active Pros</p>
            </div>
            <div class="col-xs-4 Cn-stat">
                <h3>98%</h3>
                <p class="text-muted">Job Completion Rate</p>
            </div>
            <div class="col-xs-4 Cn-stat">
                <h3>4.8★</h3>
                <p class="text-muted">Average Rating</p>
            </div>
        </div>

        <h2 class="section-heading">Choose Your Path to Growth</h2>
        
        <div class="row">
            <div class="col-md-5 col-md-offset-1 col-sm-6">
                <div class="Cn-pricing-card">
                    <h3 class="Cn-plan-name">Base Tier</h3>
                    <p class="text-muted">Perfect for solo pros and flexible starters.</p>
                    
                    <div class="Cn-price-tag">
                        <span style="font-size: 0.8em;">₹</span>0<span style="font-size: 0.4em;">/month</span>
                    </div>
                    <p class="text-muted" style="margin-top: -20px;">+ Standard Commission (Pay Per Lead)</p>

                    <ul class="Cn-features-list">
                        <li><i class="fa fa-check-circle"></i> Basic Profile Listing</li>
                        <li><i class="fa fa-check-circle"></i> Standard Lead Notifications</li>
                        <li><i class="fa fa-check-circle"></i> Mobile App Management</li>
                        <li class="dimmed"><i class="fa fa-check-circle" style="opacity: 0.5;"></i> Priority Search Placement</li>
                        <li class="dimmed"><i class="fa fa-check-circle" style="opacity: 0.5;"></i> Instant Booking Feature</li>
                        <li class="dimmed"><i class="fa fa-check-circle" style="opacity: 0.5;"></i> Dedicated Account Manager</li>
                    </ul>

                   <button class="btn btn-default Cn-cta-button" onclick="handlePlanSelection('base', './shop_owner/signup.php')">
    Choose Base Plan
</button>
                </div>
            </div>

            <div class="col-md-5 col-sm-6">
                <div class="Cn-pricing-card Cn-premium-card">
                    <h3 class="Cn-plan-name" style="color: var(--Cn-premium);">Premium Tier</h3>
                    <p class="text-muted">Maximum visibility and revenue potential.</p>

                    <div class="Cn-price-tag premium">
                        <span style="font-size: 0.8em;">₹</span>999<span style="font-size: 0.4em;">/month</span>
                    </div>
                    <p class="text-muted" style="margin-top: -20px;">+ Reduced Commission (Save on every job)</p>

                    <ul class="Cn-features-list">
                        <li><i class="fa fa-check-circle" style="color: var(--Cn-premium);"></i> Enhanced Profile Listing</li>
                        <li><i class="fa fa-check-circle" style="color: var(--Cn-premium);"></i> **Priority** Lead Notifications (First Access)</li>
                        <li><i class="fa fa-check-circle" style="color: var(--Cn-premium);"></i> Mobile App Management</li>
                        <li><i class="fa fa-check-circle" style="color: var(--Cn-premium);"></i> **Priority Search Placement**</li>
                        <li><i class="fa fa-check-circle" style="color: var(--Cn-premium);"></i> Instant Booking Feature</li>
                        <li><i class="fa fa-check-circle" style="color: var(--Cn-premium);"></i> Dedicated Account Manager</li>
                    </ul>

                  <button class="btn Cn-cta-button Cn-cta-premium" onclick="handlePlanSelection('premium', './shop_owner/signup.php')">
    Go Premium Now
</button>
                </div>
            </div>
        </div>
        
        <h2 class="section-heading">How It Works</h2>
        <div class="row Cn-steps-grid">
            <div class="col-sm-4 Cn-step-item">
                <i class="fa fa-id-card-o"></i>
                <h4>1. Sign Up & Verify</h4>
                <p class="text-muted">Create your account and complete our simple background check.</p>
            </div>
            <div class="col-sm-4 Cn-step-item">
                <i class="fa fa-list-alt"></i>
                <h4>2. Define Your Services</h4>
                <p class="text-muted">Set your rates, define your service area, and confirm your availability.</p>
            </div>
            <div class="col-sm-4 Cn-step-item">
                <i class="fa fa-money"></i>
                <h4>3. Get Booked & Paid</h4>
                <p class="text-muted">Receive instant bookings and get paid securely and quickly.</p>
            </div>
        </div>
        
        <div class="text-center" style="margin-top: var(--Cn-gap-lg);">
            <button class="btn Cn-main-cta" onclick="alert('Starting Registration...')">
                Join Our Network Today
            </button>
        </div>


    </div>
<?php include "./includes/index_footer.html"; ?>

<script>
/**
 * Saves the selected plan to session storage and redirects
 * @param {string} planName - 'base' or 'premium'
 * @param {string} redirectUrl - where to go next
 */
function handlePlanSelection(planName, redirectUrl) {
    try {
        // Save to session storage (persists until the tab is closed)
        sessionStorage.setItem('selectedPlan', planName);
        console.log("Plan saved:", planName);
        
        // Redirect to the signup page
        window.location.href = redirectUrl;
    } catch (e) {
        // Fallback: Redirect even if storage fails
        window.location.href = redirectUrl;
    }
}
</script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>