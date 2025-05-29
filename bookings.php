<?php    
    session_start();
    require_once('connection.php');
    if (!isset($_SESSION['email'])) {
        
        header("Location: index.html");
        exit();
    }

    $value = $_SESSION['email'];
    $evid = $_GET['id'];

    $sql = "SELECT * FROM ev WHERE EV_ID='$evid'";
    $cname = mysqli_query($con, $sql);
    $email = mysqli_fetch_assoc($cname);
    $ev_name = $email['EV_NAME'];

    $sql = "SELECT * FROM users WHERE EMAIL='$value'";
    $name = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($name);
    $uemail = $rows['EMAIL'];
    $evprice = $email['PRICE'];

    if (isset($_POST['book'])) {
        $bplace = isset($_POST['place']) ? mysqli_real_escape_string($con, $_POST['place']) : null;
        $bdate = isset($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : null;
        $phno = isset($_POST['ph']) ? mysqli_real_escape_string($con, $_POST['ph']) : null;
        $des = isset($_POST['des']) ? mysqli_real_escape_string($con, $_POST['des']) : null;
        $ev_model = isset($_POST['ev_model']) ? mysqli_real_escape_string($con, $_POST['ev_model']) : null;
        $color = isset($_POST['color']) ? mysqli_real_escape_string($con, $_POST['color']) : null;

        if (empty($bplace) || empty($bdate) || empty($phno) || empty($des) || empty($ev_model) || empty($color) || strlen($phno) != 10) {
            echo '<script>alert("Please fill all fields correctly.")</script>';
        } else {
            $price = $evprice;
            $sql = "INSERT INTO bookings (EV_ID, EMAIL, EV_NAME, EV_MODEL, BOOK_PLACE, BOOK_DATE, PHONE_NUMBER, DESTINATION, PRICE, COLOR) 
                    VALUES ($evid, '$uemail', '$ev_name','$ev_model', '$bplace', '$bdate', $phno, '$des', $price, '$color')";

            $result = mysqli_query($con, $sql);

            if ($result) {
                $_SESSION['email'] = $uemail;
                header("Location: payment.php");
                exit();
            } else {
                echo '<script>alert("Please check the connection.")</script>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV BOOKING</title>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };

        function validateForm() {
            var bookingDate = document.getElementById("datefield").value;
            var today = new Date().toISOString().split('T')[0];
            if (bookingDate !== today) {
                alert("The booking date must be today's date.");
                return false;
            }
            return true;
        }

        function validatePhoneNumber(input) {
            input.value = input.value.replace(/[^0-9]/g, ''); 
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        div.main {
            width: 400px;
            margin: 100px auto 0px auto;
        }

        .btnn {
            width: 240px;
            height: 40px;
            background: #ff7200;
            border: none;
            margin-top: 30px;
            margin-left: 30px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
            transition: all 0.3s ease;
            text-color="white";
            font-weight:bold;  
        }

        .btnn:hover {
            background: #fff;
            color: #ff7200;
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(255, 115, 0, 0.6);
        }

        .btnn a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            padding: 20px;
            font-family: sans-serif;
        }

        div.register {
            background-color: rgba(0, 0, 0, 0.6);
            width: 100%;
            font-size: 18px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
            color: #fff;
            opacity: 0;
            transform: translateY(50px);
            animation: slideIn 1s ease forwards;
            animation-delay: 0.3s;
        }

        form#register {
            margin: 40px;
        }

        label {
            font-family: sans-serif;
            font-size: 18px;
            font-style: italic;
        }

        input#place, input#ev_model, input#ph, input#des, input#datefield {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 3px;
            outline: 0;
            padding: 7px;
            background-color: #fff;
            box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.3);
            transition: 0.3s;
        }

        input:focus {
            border-color: #ff7200;
            box-shadow: 0 0 8px #ff7200;
        }

        .hai {
            width: 100%;
            height: 0px;
        }

        .main {
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0) 50%);
            background-position: center;
            background-size: cover;
        }

        .navbar {
            width: 1200px;
            height: 75px;
            margin: auto;
            opacity: 0;
            animation: navbarFade 1s ease forwards;
        }

        .icon {
            width: 200px;
            float: left;
            height: 70px;
        }

        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #ff7200;
            font-size: 35px;
            font-family: Arial;
            padding-left: 10px;
            padding-top: 10px;
        }

        .menu {
            width: 400px;
            float: left;
            height: 70px;
        }

        ul {
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
        }

        ul li {
            list-style: none;
            margin-left: 80px;
            margin-top: 20px;
            font-size: 14px;
            color: black;
        }

        ul li a {
            text-decoration: none;
            color: white;
            font-family: Arial;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }

        ul li a:hover {
            color: orange;
        }

        .nn {
            width: 100px;
            height: 40px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            background: linear-gradient(90deg, #ff7200, #ff5500);
            color: white;
            border: none;
            transition: all 0.4s ease;
            box-shadow: 0 4px 10px rgba(255, 115, 0, 0.3);
            overflow: hidden;
            position: relative;
        }

        .nn a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            display: block;
            width: 100%;
            height: 100%;
            line-height: 40px;
            transition: color 0.3s ease;
        }

        .nn:hover a {
            color: #fff !important;
        }

        .nn:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #ff5500, #ff7200);
            box-shadow: 0 6px 14px rgba(255, 115, 0, 0.4);
        }

        .nn:active {
            transform: scale(0.95);
            box-shadow: 0 2px 5px rgba(255, 115, 0, 0.2);
        }

        .circle, .phello {
            opacity: 0;
            transform: translateY(-10px);
            animation: fadeInProfile 1s ease forwards;
            animation-delay: 0.8s;
        }

        .circle {
            border-radius: 48%;
            width: 65px;
        }

        .phello {
            width: 200px;
            margin-left: -60px;
            padding: 0px;
            color: #fff;
        }

        body {
            animation: fadeInBody 1s ease-in-out;
            background-image: url("images/Booking.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        @keyframes fadeInBody {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes navbarFade {
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInProfile {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="hai">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">EV</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="evdetails.php">HOME</a></li>
                    <li><a href="aboutus2.html">ABOUT</a></li>
                    <li><a href="#">DESIGN</a></li>
                    <li><a href="contactus.php">CONTACT</a></li>
                    <li><button class="nn"><a href="index.php">LOGOUT</a></button></li>
                    <li><img src="images/profile.png" class="circle" alt="Profile Image"></li>
                    <li><p class="phello">HELLO! &nbsp;<a id="pname"><?php echo $rows['FNAME'] . " " . $rows['LNAME'] ?></a></p></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main">
        <div class="register">
            <h2>BOOKING</h2>
            <form id="register" method="POST" onsubmit="return validateForm()">
                <h2>EV NAME: <?php echo $email['EV_NAME']; ?></h2>
                <label>EV MODEL</label><br> 
                <input type="text" name="ev_model" id="ev_model" placeholder="Enter EV Model" required><br><br>
                <label>BOOKING PLACE</label><br>
                <input type="text" name="place" id="place" placeholder="Enter Booking Place" required><br><br>
                <label>BOOKING DATE</label><br>
                <input type="date" name="date" id="datefield" required><br><br>
                <label for="phonenumber">Phone Number:</label>
                <input type="text" id="ph" name="ph" maxlength="10" pattern="[0-9]{10}" 
                    oninput="validatePhoneNumber(this)" placeholder="Enter Your Phone Number" required><br><br>
                <label>DESTINATION</label><br>
                <input type="text" name="des" id="des" placeholder="Enter Your Destination" required><br><br>
                <label>SELECT COLOR</label>&nbsp;&nbsp;<input type="color" name="color" id="color" required><br><br>
                <button type="submit" name="book" class="btnn">BOOK NOW</button>
                <button type="button" class="btnn" onclick="window.location.href='evdetails.php'">CANCEL</button>
            </form>
        </div>
    </div>
</body>
</html>
        