<?php
require 'db_connection.php'; // Uses MySQLi connection
require 'pfp.php'; 


if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Error: User not logged in.'); window.location.href='login.php';</script>";
    exit();
}

$userId = $_SESSION['user_id'];
if (!isset($_SESSION['email'])) {
    die("Error: No email found in session.");
}

$userEmail = $_SESSION['email'];

// Fetch cart items from database
$cartItems = [];
$sql = "SELECT product_id, quantity FROM cart WHERE user_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}
$stmt->close();

if (empty($cartItems)) {
    echo "<script>alert('Your cart is empty.'); window.location.href='my_cart.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $paymentMethod = $_POST['payment_method'];
    $cardNumber = $paymentMethod === 'card' ? $_POST['card_number'] : NULL;
    $cartJSON = json_encode($cartItems);

    $stmt = $connection->prepare("INSERT INTO orders (user_id, first_name, last_name, address, phone, payment_method, card_number, cart_items) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $userId, $firstName, $lastName, $address, $phone, $paymentMethod, $cardNumber, $cartJSON);
    
    if ($stmt->execute()) {
        $connection->query("DELETE FROM cart WHERE user_id = $userId"); // Clear the cart after purchase
        
        // Fetch product details and calculate total
        $productDetails = "";
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $productStmt = $connection->prepare("SELECT name, price FROM products WHERE id = ?");
            $productStmt->bind_param("i", $item['product_id']);
            $productStmt->execute();
            $productResult = $productStmt->get_result();
            if ($productRow = $productResult->fetch_assoc()) {
                $productTotal = $productRow['price'] * $item['quantity'];
                $totalAmount += $productTotal;
                $productDetails .= "Product: " . $productRow['name'] . "\n";
                $productDetails .= "Price: " . $productRow['price'] . "лв.\n";
                $productDetails .= "Quantity: " . $item['quantity'] . "\n";
                $productDetails .= "Subtotal: " . $productTotal . "лв.\n\n";
            }
            $productStmt->close();
        }
        
        // Send confirmation email
        $to = $userEmail;
        $subject = "Order Confirmation";
        $message = "Hello $firstName $lastName,\n\nYour order has been placed successfully!\n\nDelivery Address: $address\nPhone: $phone\nPayment: $paymentMethod\n\nOrdered Products:\n$productDetails\nTotal Amount: $totalAmount лв.\n\nThank you for shopping with us!";
        $headers = "From: bobonoob25@gmail.com\r\nContent-Type: text/plain; charset=UTF-8";

        if (mail($to, $subject, $message, $headers)) {
            echo "<script>alert('Order placed and confirmation email sent!'); window.location.href='my_index.php';</script>";
        } else {
            echo "<script>alert('Order placed, but email sending failed.'); window.location.href='my_index.php';</script>";
        }
    } else {
        echo "<script>alert('Error placing order.');</script>";
    }

    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Glamour</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <script src="js/main.js?v=<?php echo time(); ?>"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    
        <!-- Favicon -->
        <link href="img/logo1.ico" rel="icon">
    
        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/my_bootstrap.min.css" rel="stylesheet">
    
        <!-- Template Stylesheet -->
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


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-grey navbar-white p-0" style="background-color: black; padding: 10px; opacity: calc(80%);">
            <a href="my_index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
               <img src="img/logo.png" alt="logo" style="width: 95px; height: 60px;">
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
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
                  <a style="color: white; margin-left: 20px;font-family: 'Courier New'; font-weight: bolder;" href=" my_shop2.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Shop Now</a>
               </div>
            </div>
         </nav>
    
        <!-- Navbar End -->

                <!-- Checkout Section Start-->
                <div class="container mt-5">
        <h2 class="text-center">Proceed to Checkout</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label center-label" style="color: white">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label center-label" style="color: white">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label center-label" style="color: white">Delivery Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label center-label" style="color: white">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label center-label" style="color: white">Payment Method</label>
                <div class="d-flex gap-3 align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="cash" id="cash" checked>
                        <label class="form-check-label" for="cash" style="color: white">Cash on Delivery</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="card" id="card">
                        <label class="form-check-label" for="card" style="color: white">Pay by Card</label>
                    </div>
                </div>
            </div>
            <div class="mb-3" id="cardInfo" style="display: none;">
                <label class="form-label">Card Number</label>
                <input type="text" name="card_number" class="form-control" maxlength="16">
            </div>
            <button type="submit" class="btn btn-primary w-15">Submit Order</button>
        </form>
    </div>






                <!-- Checkout Section End-->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn"  data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
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

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>
    <script>
  $(document).ready(function() {
      updateCartCount();
  });

  document.querySelectorAll('input[name="payment_method"]').forEach(input => {
            input.addEventListener('change', function() {
                document.getElementById('cardInfo').style.display = this.value === 'card' ? 'block' : 'none';
            });
        });
</script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
