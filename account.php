<?php
require 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $connection->prepare("SELECT username, profile_picture, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
    } else {
        $target_file = $user['profile_picture'];
    }

    $stmt = $connection->prepare("UPDATE users SET username = ?, email = ?, profile_picture = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $email, $target_file, $user_id);
    $stmt->execute();

    header("Location: account.php");
    exit();
}

require 'pfp.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>

    

    <meta charset="utf-8">
    <title>Service</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/logo1.ico" rel="icon">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/my_bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">



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
              <a href="my_index.php" class="nav-item nav-link">Home</a>
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
        <div class="card p-4 shadow-lg" style="max-width: 500px; margin: auto; background-color: #353535; border-radius:25px">
            <h2 class="text-center">Account Settings</h2>
            <form action="account.php" method="post" enctype="multipart/form-data">
                <div class="mb-3 text-center">
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" class="img-thumbnail" style="width: 150px; height: 150px;">
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label center-label" style="color: white">Change Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label center-label" style="color: white">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label center-label" style="color: white">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 20px">Save Changes</button>
                <a href="logout.php" class="btn btn-logout" style="margin-top: 20px">Logout</a>

            </form>
        </div>
    </div>



    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn"  data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="my_about.html">About Us</a>
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
    <script>
  $(document).ready(function() {
      updateCartCount();
  });
</script>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    
</body>

</html>
