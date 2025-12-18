<?php
require_once '../config/db.php';
session_start();

// --- PAGINATION SETTINGS ---
$limit = 5; // How many services per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// 1. Get the shop_id (Keep your existing code)
$user_id = $_SESSION['user_id'];
$stmt_shop = $pdo->prepare("SELECT shop_id FROM shops WHERE owner_id = ?");
$stmt_shop->execute([$user_id]);
$shop = $stmt_shop->fetch();
$shop_id = $shop['shop_id'] ?? 0;

// 2. Get TOTAL count of services for this shop (needed for page numbers)
$stmt_count = $pdo->prepare("SELECT COUNT(*) FROM services WHERE shop_id = ?");
$stmt_count->execute([$shop_id]);
$total_services = $stmt_count->fetchColumn();
$total_pages = ceil($total_services / $limit);

// 3. Fetch ONLY the services for the current page
$stmt_services = $pdo->prepare("SELECT * FROM services WHERE shop_id = ? ORDER BY service_id DESC LIMIT ? OFFSET ?");
$stmt_services->bindValue(1, $shop_id, PDO::PARAM_INT);
$stmt_services->bindValue(2, $limit, PDO::PARAM_INT);
$stmt_services->bindValue(3, $offset, PDO::PARAM_INT);
$stmt_services->execute();
$services = $stmt_services->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Shop Owner Dashboard</title>
<link rel="stylesheet" href="../styles/index_footer.css">

<style>
    /* ---------------------------------------------------- */
    /* 1. Global & Variables */
    /* ---------------------------------------------------- */
    :root {
        --color-primary: #1890FF; /* Deep Blue */
        --color-accent: #00BF63;  /* Bright Green */
        --color-danger: #FA5252;  /* Red for critical metrics */
        --color-warning: #FFC107; /* Yellow for pending */
        --color-bg: #F5F7FB;      /* Soft page background */
        --color-text-dark: #333;
        --color-muted: #6c757d;
        --shadow-soft: 0 4px 12px rgba(0, 0, 0, 0.08);
        --radius-default: 8px;
    }
    body {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        margin: 0;
        /* Padding for two fixed navbars (approx 50px + 55px = 105px) */
        padding-top: 105px; 
        background-color: var(--color-bg);
        color: var(--color-text-dark);
    }
    a {
        text-decoration: none !important;
    }
    
    /* ---------------------------------------------------- */
    /* 2. Primary Global Navbar */
    /* ---------------------------------------------------- */
    .navbar {
        background-color: white;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1001; 
        border: none; /* Override Bootstrap default border */
        border-radius: 0;
        min-height: 50px;
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
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--color-primary);
        line-height: 50px; /* Center with min-height */
        padding: 0;
    }
    .nav-links {
        display: flex;
        align-items: center;
        gap: 15px;
        list-style: none;
        padding-left: 0;
        margin: 0;
    }
    .nav-links li a {
        color: var(--color-muted);
        padding: 15px 10px;
        display: block;
        transition: color 0.3s;
    }
    .nav-links li a:hover {
        color: var(--color-primary);
        background: transparent;
    }
    /* Hide default Bootstrap Nav toggles/collapse functionality for custom menu */
    .navbar-collapse.collapse.in, .navbar-toggle { display: none !important; }

    /* ---------------------------------------------------- */
    /* 3. Secondary Dashboard Navbar (CONTEXTUAL MENU) */
    /* ---------------------------------------------------- */
    .dashboard-nav {
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        position: fixed;
        top: 50px; /* Positioned right below the primary navbar */
        left: 0;
        width: 100%;
        z-index: 1000;
        min-height: 55px;
        border-bottom: 2px solid #eee;
        padding: 0 15px;
    }

    .dashboard-nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        /* Enable Horizontal Scrolling on small screens */
        overflow-x: auto; 
        white-space: nowrap; 
        -webkit-overflow-scrolling: touch; 
        scrollbar-width: none; /* Firefox */
    }
    /* Hide scrollbar for Chrome/Safari */
    .dashboard-nav-container::-webkit-scrollbar {
        display: none; 
    }

    .dashboard-nav-container a {
        color: var(--color-text-dark);
        font-weight: 600;
        padding: 17px 20px;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
        border-bottom: 3px solid transparent;
        flex-shrink: 0; /* Prevents links from squishing */
    }

    .dashboard-nav-container a i {
        margin-right: 8px;
        font-size: 1.1em;
    }

    .dashboard-nav-container a:hover,
    .dashboard-nav-container a.active {
        color: var(--color-primary);
        border-bottom: 3px solid var(--color-primary);
        background-color: #f7f9fc;
    }
    
    .dashboard-header {
        font-size: 1.1em;
        font-weight: 600;
        color: var(--color-text-dark);
        padding: 17px 25px 17px 0;
        flex-shrink: 0;
        margin-right: 20px;
        border-right: 1px solid #eee;
    }
    .dashboard-header span {
        color: var(--color-accent);
        font-weight: 700;
    }


    /* ---------------------------------------------------- */
    /* 4. Main Content Area & Cards */
    /* ---------------------------------------------------- */
    main {
        padding: 30px 15px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .service-img {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid #ddd;
    }
    
    /* Centering Pagination */
    .pagination-container {
        text-align: center;
        margin-top: 20px;
        border-top: 1px solid #eee;
        padding-top: 10px;
    }
    
    .pagination > .active > a {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
    }

    .service-meta-text {
        font-size: 0.85em;
        color: var(--color-muted);
        display: block;
    }

    .dashboard-card {
        background: #fff;
        border-radius: var(--radius-default);
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: var(--shadow-soft);
        text-align: center;
        transition: transform 0.2s;
        border: 1px solid #e8e8e8;
    }
    .dashboard-card h4 {
        margin-top: 0;
        color: var(--color-muted);
        font-weight: 600;
        font-size: 1.1em;
    }
    
    /* Table Specific Styling */
    .table-responsive {
        border: none; /* Remove default Bootstrap responsive table border */
    }
    .table > tbody > tr > td, .table > thead > tr > th {
        vertical-align: middle;
        text-align: center;
        font-size: 1.1em;
    }
    .table thead th {
        font-weight: 700;
        color: var(--color-muted);
        border-bottom-width: 2px;
    }
    .table .label {
        font-size: 90%;
        padding: 0.5em 0.8em;
    }
    .service-management-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .service-management-header h3 {
        margin: 0;
        font-weight: 700;
        color: var(--color-primary);
    }
    .service-price-col {
        font-weight: 700;
        color: var(--color-primary);
    }
    .service-name-col {
        font-weight: 600;
        color: var(--color-text-dark);
    }
    .btn-action-group .btn {
        margin: 2px;
        border-radius: 4px;
        padding: 5px 8px; /* Slightly larger hit area for mobile */
    }
    .btn-edit { background-color: var(--color-primary); color: white; border-color: var(--color-primary); }
    .btn-toggle-on { background-color: var(--color-accent); color: white; border-color: var(--color-accent); }
    .btn-toggle-off { background-color: var(--color-warning); color: #333; border-color: var(--color-warning); }
    .btn-delete { background-color: var(--color-danger); color: white; border-color: var(--color-danger); }
    .label-success { background-color: var(--color-accent); }
    .label-warning { background-color: var(--color-warning); }
    
    /* --- FILTER BAR STYLES (CORRECTION) --- */
    .filter-bar-wrapper {
        background: #fff;
        padding: 15px;
        border-radius: var(--radius-default);
        box-shadow: var(--shadow-soft);
        margin-bottom: 25px;
    }
    .filter-bar-wrapper .input-group-addon {
        background: #f0f0f5;
    }
    .filter-bar-wrapper .form-control {
        /* Aligning the input to the group */
        border-radius: 0 var(--radius-default) var(--radius-default) 0;
    }

    /* ---------------------------------------------------- */
    /* 5. Footer Styling (CORRECTION) */
    /* ---------------------------------------------------- */


    /* ---------------------------------------------------- */
    /* 6. Mobile Responsiveness */
    /* ---------------------------------------------------- */
    @media (max-width: 767px) {
        body {
            padding-top: 100px; /* Reduced for mobile */
        }
        
        /* Navbars - Ensure scrollability */
        .dashboard-nav-container {
            justify-content: initial; 
            padding-right: 15px; 
        }
        
        /* Header stacking */
        .service-management-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        /* Full width search bar on mobile */
        .filter-bar-wrapper .input-group {
            width: 100%;
        }

        /* Action Buttons: Use smaller buttons and smaller font size in table on mobile */
        .table > tbody > tr > td {
            font-size: 0.9em;
        }
        .btn-action-group .btn {
            padding: 4px 6px;
        }
    }
</style>
</head>

<body>

<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="logo">Local Services</a>

        <ul class="nav-links list-unstyled">
            <li><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
    </div>
</nav>

<nav class="dashboard-nav">
    <div class="dashboard-nav-container">
        
        <div class="dashboard-header hidden-xs">
            Welcome, Shop Owner! <span>(Online)</span>
        </div>

   <a href="./owner_dashboard.php" ><i class="fa fa-dashboard"></i> Overview</a>
<a href="./add-service.php"><i class="fa fa-plus-circle"></i> Add Service</a>
        <a href="./shop_bookings.php"><i class="fa fa-calendar-check-o"></i> Bookings</a>
        <a href="./Services_Pricing.php" class="active"><i class="fa fa-wrench"></i> Services & Pricing</a>
        <a href="./shop_reviews.php"><i class="fa fa-users"></i> Reviews</a>
        <a href="./shop_settings.html"><i class="fa fa-cog"></i> Settings</a>
        <a href="./shop_member.html"><i class="fa fa-user-circle-o"></i> Profile</a>

    </div>
</nav>


<main>
    <div class="container-fluid">
    <div class="dashboard-card" style="padding: 15px;">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Service Details</th>
                        <th>Category</th>
                        <th>Base Price</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
    <?php if (count($services) > 0): ?>
        <?php foreach ($services as $row): ?>
            <tr>
               <td>
    <?php 
        $db_path = $row['service_image']; // e.g. "uploads/services/image.jpg"

        // If the file is in the SAME folder as this script:
        $display_path = "./" . $db_path; 

        // Check if the file actually exists on the server
        if (!empty($db_path)) {
            $img_src = $display_path;

        } else {
            // Fallback to a placeholder if the path is wrong or file is missing
            $img_src = "./uploads/services/1766043616_s1_cayenne-dried-pepper-small-ceramic-bowl.jpg";
        }
    ?>
    <img src="<?php echo $img_src; ?>" class="service-img" alt="Service">
</td>
                <td>
                    <span class="service-name-col"><?php echo htmlspecialchars($row['service_name']); ?></span>
                    <span class="service-meta-text">Duration: <?php echo htmlspecialchars($row['duration']); ?></span>
                </td>
                <td>General</td> <td class="service-price-col">₹<?php echo number_format($row['starting_price'], 2); ?></td>
                <td><span class="label label-success">Active</span></td>
                <td class="text-center btn-action-group">
                    <button class="btn btn-xs btn-edit" 
                        data-toggle="modal" 
                        data-target="#editServiceModal" 
                        data-service-id="<?php echo $row['service_id']; ?>"
                        data-service-name="<?php echo htmlspecialchars($row['service_name']); ?>"
                        data-service-price="<?php echo $row['starting_price']; ?>"
                        data-service-duration="<?php echo $row['duration']; ?>"
                        data-service-desc="<?php echo htmlspecialchars($row['short_description']); ?>">
                        <i class="fa fa-pencil"></i>
                    </button>
                    
                    <button class="btn btn-xs btn-delete" 
                        data-toggle="modal" 
                        data-target="#deleteConfirmationModal" 
                        data-service-id="<?php echo $row['service_id']; ?>"
                        data-service-name="<?php echo htmlspecialchars($row['service_name']); ?>">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">No services found. Add your first service!</td>
        </tr>
    <?php endif; ?>
</tbody>
            </table>
        </div>

   
    </div>
         <div class="pagination-container">
    <p class="text-muted">
        Showing <?php echo min($offset + 1, $total_services); ?> 
        to <?php echo min($offset + $limit, $total_services); ?> 
        of <?php echo $total_services; ?> services
    </p>
    
    <ul class="pagination">
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($page > 1){ echo "?page=".($page - 1); } else { echo "#"; } ?>">
                <i class="fa fa-angle-left"></i>
            </a>
        </li>

        <?php for($i = 1; $i <= $total_pages; $i++): ?>
            <li class="<?php if($page == $i) echo 'active'; ?>">
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($page < $total_pages){ echo "?page=".($page + 1); } else { echo "#"; } ?>">
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
</div>
</div>
</main>


<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="editServiceLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editServiceLabel"><i class="fa fa-pencil"></i> Edit Service: <span id="modalServiceName"></span></h4>
      </div>
      <div class="modal-body">
        <form action="edit_service_process.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="modalServiceId" name="service_id" >
          
          <div class="form-group">
            <label for="serviceNameInput">Service Name</label>
            <input type="text" class="form-control" id="serviceNameInput" name="service_name" placeholder="e.g., Deep AC Cleaning">
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="servicePriceInput">Base Price (₹)</label>
                <input type="number" class="form-control" name="price" id="servicePriceInput" placeholder="e.g., 1499">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="serviceDurationInput">Duration (Mins)</label>
                <input type="number" class="form-control" name="duration" id="serviceDurationInput" placeholder="e.g., 90">
              </div>
            </div>
          </div>
          
       

          <div class="form-group">
            <label for="serviceDescriptionArea">Description</label>
            <textarea class="form-control" name="description" id="serviceDescriptionArea" rows="3" placeholder="Detailed service description for customers..."></textarea>
          </div>
          <div class="form-group">
        <label>Change Image (Optional)</label>
        <input type="file" name="service_image" class="form-control">
    </div>    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
      </div>
          
        </form>
      </div>
  
    </div>
  </div>
</div>

<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: var(--color-danger);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteConfirmationLabel"><i class="fa fa-trash-o"></i> Confirm Deletion</h4>
      </div>
     <form action="delete_service_process.php" method="POST">
    <input type="hidden" id="deleteServiceId" name="service_id">
    <div class="modal-body">
        <p>Are you sure you want to delete <strong><span id="deleteServiceName"></span></strong>?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete Permanently</button>
    </div>
</form>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // Logic for EDIT Modal
    $('#editServiceModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        
        // Extract info from data-* attributes
        var id = button.data('service-id');
        var name = button.data('service-name');
        var price = button.data('service-price');
        var duration = button.data('service-duration');
        var desc = button.data('service-desc');
        
        var modal = $(this);
        modal.find('#modalServiceId').val(id);
        modal.find('#modalServiceName').text(name);
        modal.find('#serviceNameInput').val(name);
        modal.find('#servicePriceInput').val(price);
        modal.find('#serviceDurationInput').val(duration);
        modal.find('#serviceDescriptionArea').val(desc);
    });

    // Logic for DELETE Modal
    $('#deleteConfirmationModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('service-id');
        var name = button.data('service-name');
        
        var modal = $(this);
        modal.find('#deleteServiceId').val(id);
        modal.find('#deleteServiceName').text(name);
    });
});
</script>

<?php include "../includes/index_footer.html"; ?>

</body>
</html>