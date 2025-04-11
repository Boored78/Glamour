<?php
session_start();
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        header("Location: my_index.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="css/my_bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            
            background-size: cover; 
            margin: 0; 
            height: 100vh; 
            width: 100vw; 
            color:rgb(0, 0, 0);
            font-family: 'Roboto', sans-serif;
        }
        .card {
            background-color:#ffffff;
            border: none;
            border-radius: 10px;
        }
        .form-control, .btn-primary {
            background-color: #292929;
            color: #ffffff;
        }
        .form-control {
            background-color:rgb(162, 162, 162);
            color: #ffffff;
            margin-left: -2px;
        }
        .form-control:focus {
            background-color: #292929;
            color: #ffffff;
            border-color: #007bff;
            box-shadow: none;
        }
        .btn-primary {
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<div class="header finisher-header" style="width: 100%; height: 100%;">
    <div class="d-flex vh-100 align-items-center justify-content-center">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h2 class="text-center mb-4;" style="color:rgb(0, 0, 0);">Log In</h2>
            <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-50">Log In</button>
                <p style="color:rgb(0, 0, 0);" class="text-center mt-3">Don't have an account? <a href="signup.php" style="color: #007bff;">Sign Up</a></p>
            </form>
        </div>
    </div>
    </div>
</body>
<script src="finisher-header.es5.min.js" type="text/javascript"></script>
<script type="text/javascript">
new FinisherHeader({
  "count": 6,
  "size": {
    "min": 1100,
    "max": 1300,
    "pulse": 0
  },
  "speed": {
    "x": {
      "min": 0.1,
      "max": 0.3
    },
    "y": {
      "min": 0.1,
      "max": 0.3
    }
  },
  "colors": {
    "background": "#9138e5",
    "particles": [
      "#d2d2d2",
      "#6e4e07",
      "#ff333d"
    ]
  },
  "blending": "overlay",
  "opacity": {
    "center": 1,
    "edge": 0.1
  },
  "skew": 0,
  "shapes": [
    "c"
  ]
});
</script>


</html>