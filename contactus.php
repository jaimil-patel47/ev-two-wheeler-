<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "evproject";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $successMessage = "Message sent successfully!";
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | EV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #ff9d6c, #ffd86f);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        section.contact {
            width: 100%;
            max-width: 1200px;
            background: #ffffffcc;
            backdrop-filter: blur(8px);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact .content {
            text-align: center;
            margin-bottom: 30px;
        }

        .contact .content h1 {
            font-size: 38px;
            color: #333;
            font-weight: 600;
            letter-spacing: 2px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .contactInfo,
        .contactForm {
            flex: 1;
            min-width: 300px;
        }

        .contactInfo .box {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .contactInfo .box:hover {
            transform: translateY(-5px);
        }

        .contactInfo .box .icon {
            font-size: 30px;
            color: #ff8008;
            margin-right: 15px;
        }

        .contactInfo .box .text h3 {
            font-size: 20px;
            color: #444;
            margin-bottom: 5px;
        }

        .contactInfo .box .text p {
            color: #777;
        }

        .contactForm {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .contactForm:hover {
            transform: translateY(-5px);
        }

        .contactForm h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .contactForm .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        .contactForm .inputBox input,
        .contactForm .inputBox textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            font-size: 16px;
            background: #f9f9f9;
            transition: border-color 0.3s;
        }

        .contactForm .inputBox input:focus,
        .contactForm .inputBox textarea:focus {
            border-color: #ff8008;
        }

        .contactForm .inputBox span {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
            transition: all 0.3s;
        }

        .contactForm .inputBox input:focus+span,
        .contactForm .inputBox input:not(:placeholder-shown)+span,
        .contactForm .inputBox textarea:focus+span,
        .contactForm .inputBox textarea:not(:placeholder-shown)+span {
            top: -12px;
            left: 8px;
            font-size: 12px;
            background: #fff;
            padding: 0 4px;
            color: #ff8008;
        }

        .contactForm .inputBox input[type="submit"],
        .contactForm .btn {
            width: 100%;
            background: linear-gradient(to right, #ff8008, #ffc837);
            color: #fff;
            font-size: 18px;
            border: none;
            padding: 12px;
            cursor: pointer;
            text-align: center;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .contactForm .btn a {
            color: #fff;
            text-decoration: none;
        }

        .contactForm .inputBox input[type="submit"]:hover,
        .contactForm .btn:hover {
            background: linear-gradient(to right, #ffc837, #ff8008);
            box-shadow: 0 0 10px #ff8008;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <section class="contact">
        <div class="content">
            <h1>CONTACT US</h1>
            <?php
            if (isset($successMessage)) {
                echo "<p style='color: green;'>$successMessage</p>";
            } elseif (isset($errorMessage)) {
                echo "<p style='color: red;'>$errorMessage</p>";
            }
            ?>
        </div>
        <div class="container">
            
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>4671 Sugar Camp Road,<br>Owagonna, Minnesota,<br>55060</p>
                    </div>
                </div>
                <br>
                <div class="box">
                    <div class="icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>507-475-6094</p>
                    </div>
                </div>
                <br>
                <div class="box">
                    <div class="icon"><i class="fas fa-envelope"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>contactuscars@gmail.com</p>
                    </div>
                </div>
            </div>
            
            <div class="contactForm">
                <form method="POST" action="">
                    <h2>Send Message</h2>
                    <div class="inputBox">
                        <input type="text" name="name" required="required" placeholder="">
                        <span>Full Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" required="required" placeholder="">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <textarea name="message" required="required" placeholder=""></textarea>
                        <span>Type your Message...</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Send">
                    </div>
                    <div class="inputBox btn">
                        <a href="evdetails.php">Go To Home</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>
