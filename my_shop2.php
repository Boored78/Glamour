<?php
session_start();

require 'db_connection.php'; // Uses MySQLi connection
require 'pfp.php'; 

// ✅ Get search and filter inputs
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';
$sex = isset($_GET['sex']) ? $_GET['sex'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// ✅ Start building the SQL query dynamically
$sql = "SELECT * FROM products WHERE 1=1";  // Always true condition

// ✅ Add search condition (this will allow all products if search is empty)
if (!empty($searchQuery)) {
    $sql .= " AND name LIKE ?";
}

// ✅ Add filter conditions
if (!empty($sex)) {
    $sql .= " AND sex = ?";
}
if (!empty($type)) {
    $sql .= " AND type = ?";
}

// ✅ Prepare statement dynamically
$stmt = $connection->prepare($sql);

// ✅ Bind parameters dynamically
$paramTypes = '';
$paramValues = [];

// Search query binding (only if search query is provided)
if (!empty($searchQuery)) {
    $paramTypes .= 's';
    $paramValues[] = "%" . $searchQuery . "%";
}

// Filter binding (only if filters are provided)
if (!empty($sex)) {
    $paramTypes .= 's';
    $paramValues[] = $sex;
}
if (!empty($type)) {
    $paramTypes .= 's';
    $paramValues[] = $type;
}

// ✅ Bind params only if there are values
if (!empty($paramValues)) {
    $stmt->bind_param($paramTypes, ...$paramValues);
}

// ✅ Execute query
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>  

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js?v=<?php echo time(); ?>"></script>
    
    <meta charset="utf-8">
    <title>Cart</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/logo1.ico" rel="icon">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    

    <!-- Customized Bootstrap Stylesheet -->
     
    <link href="css/my_bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">




</head>       
<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark p-0">
    
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 col-sm-12 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-map-marker-alt text-primary me-2"></small>
                <small style="color: rgb(255, 255, 255);">123 Street, New York, USA</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="far fa-clock text-primary me-2"></small>
                <small style="color: rgb(255, 255, 255);">Mon - Fri : 09.00 AM - 09.00 PM</small>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-phone-alt text-primary me-2"></small>
                <small style="color: rgb(255, 255, 255);">+359 889 455 535</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <!-- Social Media Icons -->
                <a style="background-color: rgb(0, 0, 0);" class="btn btn-sm-square text-primary me-1" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                <a style="background-color: rgb(0, 0, 0);" class="btn btn-sm-square text-primary me-1" href="https://x.com/?lang=en"><i class="fab fa-twitter"></i></a>
                <a style="background-color: rgb(0, 0, 0);" class="btn btn-sm-square text-primary me-1" href="https://www.instagram.com/perfumesde_glamour/"><i class="fab fa-instagram"></i></a>
                
                <!-- Cart Button (Only Visible When Logged In) -->
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a style="background-color: black;" class="btn btn-sm-square text-primary me-1" href="my_cart.php">
                        <i class="fa fa-shopping-cart fa-1x"></i><span id="cart-count">0</span>
                    </a>
                    <!-- Profile Image (Replaces Logout) -->
                    <a href="account.php" style="display: inline-block;">
                        <img src="<?= $profileImage ?>" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-left: 5px;">
                    </a>
                <?php else: ?>
                    <!-- If NOT Logged In, Show Login -->
                    <a style="background-color: black;" class="btn btn-sm-square text-primary me-1" href="login.php">
                        <i class="fas fa-user-alt"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <!-- Topbar End -->



    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-grey navbar-white p-0" style="background-color: black; padding: 10px; opacity: calc(80%);">
        <a href="my_index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
           <img src="img/logo.png" alt="logo" style="width: 95px; height: 60px;">
        </a>
        <button class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
           <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
           <div class="navbar-nav ms-auto p-4 p-lg-0">
            <div class="navbar-nav ms-auto p-4 p-lg-0" style="margin-top: 10px; margin-right: -10px; font-family: 'Courier New'; font-weight: bolder;">
              <a href="my_index.php" class="nav-item nav-link ">Home</a>
              <a href="my_index.php#About" class="nav-item nav-link">About</a>
              <a href="my_service.php" class="nav-item nav-link">Service</a>
              <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
              <a style="color: white; margin-left: 20px;font-family: 'Courier New'; font-weight: bolder;" href="my_shop2.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Shop Now</a>
           </div>
        </div>
     </nav>
     
    <!-- Navbar End -->
    <div class="container mt-5">
    <h2 class="text-center">Shop</h2>

    <form action="my_shop2.php" method="GET" class="d-flex">
    <input type="text" name="query" class="form-control me-2" 
           placeholder="Search products..." value="<?php echo htmlspecialchars($searchQuery); ?>">
    <button class="btn btn-primary" style="margin-top:40px" type="submit">Search</button>
</form>


<div class="filter-container wow fadeIn" data-wow-delay="0.1s">
    <h2>Filter Perfumes</h2>
    <form method="GET" action="">
        <label id="sex">Sex:</label>
        <select name="sex">
            <option value="">All</option>
            <option value="male" <?php if ($sex == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($sex == 'female') echo 'selected'; ?>>Female</option>
        </select>

        <label id="type">Type:</label>
        <select name="type">
            <option value="">All</option>
            <option value="woody" <?php if ($type == 'woody') echo 'selected'; ?>>Woody</option>
            <option value="floral" <?php if ($type == 'floral') echo 'selected'; ?>>Floral</option>
            <option value="oriental" <?php if ($type == 'oriental') echo 'selected'; ?>>Oriental</option>
            <option value="fresh" <?php if ($type == 'fresh') echo 'selected'; ?>>Fresh</option>
        </select>

        <button type="submit">Filter</button>
    </form>
</div>



    <div class="shop-listing" >
    <?php if ($result->num_rows > 0): ?>
        <?php while ($item = $result->fetch_assoc()): ?>
    <div class="shop" onclick="window.location.href='product_page.php?id=<?= $item['id'] ?>'">
        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
        <div class="shop-details">
            <h3><?= htmlspecialchars($item['name']) ?></h3>
            <p class="price"><?= number_format($item['price'], 2) ?> лв.</p>
        </div>
    </div>
<?php endwhile; ?>


    <?php else: ?>
        <p class="no-results text-center">No products found.</p>
    <?php endif; ?>
</div>

</div>



    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-sm-12 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+359 889 455 535</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-12 col-md-6" style="margin-left: 500px;">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="my_about.php">About Us</a>
                    <a class="btn btn-link" href="contact.php">Contact Us</a>
                    <a class="btn btn-link" href="my_service.php">Our Services</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Glamour</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed By <a class="border-bottom" href="https://www.instagram.com/uktc_214/">21405, 21412, 21417</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="js/main.js"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>


</body>
</html>
