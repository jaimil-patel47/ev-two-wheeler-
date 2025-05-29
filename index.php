<?php
session_start();
require_once('connection.php');  

$error_message = '';

if (isset($_POST['login'])) {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
    $password = isset($_POST['pass']) ? mysqli_real_escape_string($con, $_POST['pass']) : '';
    
    if (empty($email) || empty($password)) {
        $error_message = "Please enter both email and password.";
    } else {
        $sql = "SELECT * FROM users WHERE EMAIL = '$email'";
        $result = mysqli_query($con, $sql);    

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($password === $user['PASSWORD']) {
                $_SESSION['email'] = $email;
                header("Location: evdetails.php");  
                exit();
            } else {
                $error_message = "Incorrect password. Please try again.";
            }
        } else {
            $error_message = "Email not found.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Two Wheelers</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: url("indexbg2.jpg");
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: linear-gradient(90deg, #00203f, #004080);
            color: white;
            animation: fadeIn 1s ease-in-out;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffe600;
        }

        .navbar ul {
            list-style: none;
            display: flex;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #ffe600;
        }

        .hero {
            height: 80vh;
            background: linear-gradient(to right, #00203f, #004080), url('images/hero-bg.jpg') center/cover no-repeat;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: #ffe600;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero .btn {
            padding: 12px 30px;
            font-size: 1rem;
            color: #00203f;
            background-color: #ffe600;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        
        .login-section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            background: #fff;
        }

        .login-card {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: slideUp 1s ease-in-out;
        }

        .login-card h2 {
            margin-bottom: 20px;
            color: #00203f;
            font-size: 1.5rem;
        }

        .login-card form {
            margin-bottom: 20px;
        }

        .login-card input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
        }

        .login-card button {
            width: 100%;
            padding: 10px;
            background: #00203f;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card button:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            background: #004080;
        }

        .login-card p {
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .login-card p a {
            color: #00203f;
            text-decoration: none;
            font-weight: bold;
        }

        .login-card p a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: red;
            font-size: 1rem;
            margin-bottom: 15px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    
    <header class="navbar">
        <div class="logo">EV</div>
        <ul>
            <li><a href="#">HOME</a></li>
            <li><a href="aboutus.html">ABOUT</a></li>
            <li><a href="#">SERVICES</a></li>
            <li><a href="contactus.html">CONTACT</a></li>
        </ul>
    </header>
    <section class="hero">
        <div>
            <h1>Welcome to Your <span>Dream EV</span></h1>
            <p>Discover innovation and sustainability with our premium EV two-wheelers.</p>
            <a href="register.php" class="btn">Join Us</a>
        </div>
    </section>
    <section class="login-section">
        <div class="login-card">
            <h2>Login to Your Account</h2>
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?= $error_message ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="email" name="email" placeholder="Enter Your Email" required>
                <input type="password" name="pass" placeholder="Enter Your Password" required>
                <button type="submit" name="login">Login</button>
            </form>
            <p>
                Don't have an account? <a href="register.php">Sign up here</a>
            </p>
        </div>
    </section>
</body>
</html>
