<?php
require 'db_connection.php'; // Uses MySQLi connection
require 'pfp.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    <meta charset="utf-8">
    <title>Shop</title>
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
    
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


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
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
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


    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/perfume.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 col-sm-12 text-center">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Welcome To Glamour</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Best Scents For Your Everyday Life</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Explore the Best Scents to Transform Your Everyday Life, Elevate Your Mood, and Create a Lasting Impression</p>
                                <a style="color: white;" href="my_shop2.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Shop Now</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/male2.png" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 col-sm-12 text-center">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Welcome To Glamour</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Lots Of Different Options For All Genders</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Explore a Diverse Selection of Fragrance Options for All Genders, Offering Unique Scents to Complement Every Style, Mood, and Occasion</p>
                                <a style="color: white;" href="my_shop2.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Shop Now</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/scent1.png" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 col-sm-12 text-center">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Welcome To Glamour</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Lowest Prices Ever</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Don't Miss Out on the Lowest Prices Ever: Unbeatable Deals on Your Favorite Scents and Fragrances</p>
                                <a style="color: white;" href="my_shop2.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Shop Now</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Feature Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 col-sm-12 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-dark" style="width: 60px; height: 60px;">
                            <i class="fa fa-money-bill-alt fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">01</h1>
                    </div>
                    <h5>Best Prices</h5>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-12 wow fadeIn" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-dark" style="width: 60px; height: 60px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">02</h1>
                    </div>
                    <h5>Quality Products</h5>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-12 wow fadeIn" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-dark" style="width: 60px; height: 60px;">
                            <i class="fa fa-drafting-compass fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">03</h1>
                    </div>
                    <h5>Free Consultation</h5>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-12 wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-dark" style="width: 60px; height: 60px;">
                            <i class="fa fa-headphones fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">04</h1>
                    </div>
                    <h5>Customer Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->



    <!-- About Start -->
    <section id="About">
        <div class="container-fluid bg-dark overflow-hidden my-5 px-lg-0">
            <div class="container about px-lg-0">
                <div class="row g-0 mx-lg-0">
                    <div class="col-lg-6 col-sm-12 ps-lg-0" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute img-fluid w-100 h-100" src="img/about_ logo.png" style="object-fit: cover;" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                        <div class="p-lg-5 pe-lg-0">
                            <div class="section-title text-start">
                                <h1 class="display-5 mb-4">About Us</h1>
                            </div>
                            <p class="mb-4 pb-2">At Glamour, we are passionate about the transformative power of fragrance. Our mission is to bring you an exclusive range of high-quality, authentic scents that inspire confidence and evoke unforgettable experiences.</p>
                            <div class="row g-4 mb-4 pb-2">
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-dark" style="width: 60px; height: 60px;">
                                            <i class="fa fa-users fa-2x text-primary"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h2 class="text-primary mb-1" data-toggle="counter-up">4932</h2>
                                            <p class="fw-medium mb-0">Happy Clients</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-dark" style="width: 60px; height: 60px;">
                                            <i class="fa fa-check fa-2x text-primary"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h2 class="text-primary mb-1" data-toggle="counter-up">425</h2>
                                            <p class="fw-medium mb-0">Projects Done</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a style="color: white;" href="" class="btn btn-primary py-3 px-5">Explore More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About End -->

    <!-- Feature Start -->
    <div class="container-fluid bg-dark overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 col-sm-12 feature-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4">Why Choose Us</h1>
                        </div>
                        <p class="mb-4 pb-2">
                            At Glamour, we offer a carefully curated selection of premium, authentic fragrances designed to elevate your personal style. Our commitment to quality and personalized customer experience ensures you'll find the perfect scent to match your unique taste. Choose us for a fragrance journey that blends luxury, elegance, and individuality.</p>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-very_dark" style="width: 60px; height: 60px;">
                                        <i class="fa fa-check fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Quality</p>
                                        <h5 class="mb-0">Services</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-very_dark" style="width: 60px; height: 60px;">
                                        <i class="fa fa-money-bill-alt fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Best</p>
                                        <h5 class="mb-0">Prices</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-very_dark" style="width: 60px; height: 60px;">
                                        <i class="fa fa-drafting-compass fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Free</p>
                                        <h5 class="mb-0">Consultation</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-very_dark" style="width: 60px; height: 60px;">
                                        <i class="fa fa-headphones fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Customer</p>
                                        <h5 class="mb-0">Support</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 pe-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/parfium2.png" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->
     

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Team Members</h1>
            </div>
            <div class="row g-4" style="margin-left: 223px;">
                <div class="col-lg-3 col-sm-12 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="img/didi.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center border border-5 border-light border-top-0 p-4">
                            <h5 style="font-size: 1.32vw;" class="mb-0">Diana Ivanova</h5>
                            <small style="color:white"> Back-End</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="img/bobo.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center border border-5 border-light border-top-0 p-4">
                            <h5 style="font-size: 1.32vw;" class="mb-0">Bojidar Angelov</h5>
                            <small style="color:white"> CEO</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-12 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="img/madlen.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div style="align-content: center;"class="text-center border border-5 border-light border-top-0 p-4 ">
                            <h5 style="font-size: 1.32vw;"class="mb-0">Madlen Neikova</h5>
                            <small style="color:white"> Front-End</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Reviews Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Reviews</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light p-2 mx-auto mb-3" src="img/testimonial-1.jpg" style="width: 90px; height: 90px;">
                    <div class="testimonial-text text-center p-4">
                        <p>Absolutely love this store! I've ordered from this online perfume store twice now, and both experiences were flawless. The website is easy to navigate, and they have an impressive selection of both niche and designer fragrances. My order arrived super fast, and the packaging was beautiful! They even included a few free samples, which was a lovely surprise. The customer service is top-notch, very responsive and friendly. I’ve found my go-to place for all my perfume needs!</p>
                        <h5 class="mb-1">– Emily R.</h5>
                        <span class="fst-italic">Model</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light p-2 mx-auto mb-3" src="img/testimonial-2.jpg" style="width: 90px; height: 90px;">
                    <div class="testimonial-text text-center p-4">
                        <p>Great selection and fast shipping! I was hesitant to order perfumes online, but this store exceeded my expectations. The detailed descriptions and fragrance notes on the site really helped me pick the right scent. My order arrived within just a few days, and everything was carefully packaged. I appreciate the free returns policy, though I didn’t need it because I loved what I got! Only giving 4 stars because I wish there were more discounts on high-end brands. Otherwise, it’s a fantastic experience!</p>
                        <h5 class="mb-1">– Mark L.</h5>
                        <span class="fst-italic">Accountant</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light p-2 mx-auto mb-3" src="img/testimonial-3.jpg" style="width: 90px; height: 90px;">
                    <div class="testimonial-text text-center p-4">
                        <p>Best online perfume shopping experience! This is hands down the best place to shop for perfumes online! I was looking for a hard-to-find fragrance and finally found it here. The prices are competitive, and the customer support team is so helpful—they answered all my questions quickly. My perfume arrived perfectly wrapped, and I even received a handwritten thank-you note, which was a nice touch. I’ve already recommended this store to several friends, and I’ll definitely be a returning customer!</p>
                        <h5 class="mb-1">Josh M.</h5>
                        <span class="fst-italic">Influencer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reviews End -->


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
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-1 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>