<?php
require_once('connection.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addev'])) {
    
    $evname = mysqli_real_escape_string($con, trim($_POST['evname']));
    $ftype = mysqli_real_escape_string($con, trim($_POST['ftype']));
    $capacity = intval($_POST['capacity']);
    $price = floatval($_POST['price']);
    
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_folder = "uploads/" . $image;
        
        
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }
        
        
        if (move_uploaded_file($image_tmp, $image_folder)) {
            
            $sql = "INSERT INTO ev (EV_NAME, FUEL_TYPE, CAPACITY, PRICE, EV_IMG) 
                    VALUES ('$evname', '$ftype', '$capacity', '$price', '$image')";
            
            if (mysqli_query($con, $sql)) {
                echo '<script>alert("EV added successfully!"); window.location.href="adminvehicle.php";</script>';
            } else {
                echo '<script>alert("Error adding EV: " . mysqli_error($con));</script>';
            }
        } else {
            echo '<script>alert("Error uploading image. Please try again.");</script>';
        }
    } else {
        echo '<script>alert("Please upload a valid image file.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            animation: fadeIn 1.5s ease-in-out;
        }

        .navbar {
            width: 95%;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 0 50px;
        }

        .logo {
            color: black;
            font-size: 35px;
            font-weight: bold;
            animation: slideInLeft 1s ease-in-out;
        }

        .menu {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            animation: slideInDown 1.2s ease-in-out;
        }

        .menu ul {
            display: flex;
            list-style: none;
        }

        .menu ul li {
            margin: 0 20px;
        }

        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: 0.3s;
        }

        .menu ul li a:hover {
            color: #ff7200;
        }

        .logout {
            background-color: #ff7200;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            animation: slideInRight 1s ease-in-out;
            margin-left: auto;
        }

        .logout a {
            text-decoration: none;
            color: white;
        }

        .logout:hover {
            background-color: #e65c00;
        }

        .header {
            text-align: center;
            margin: 50px 0;
            font-size: 32px;
            color: black;
            animation: fadeIn 2s ease-in-out;
        }

        .main {
            width: 400px;
            margin: 100px auto 0;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .register {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .btnn {
            width: 100%;
            background-color: #ff7200;
            border: none;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btnn:hover {
            background-color: #e65c00;
        }

        #back {
            width: 100%;
            height: 40px;
            background: #ff7200;
            border: none;
            font-size: 18px;
            color: white;
            text-align: center;
            border-radius: 5px;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #back a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }
    </style>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="navbar">
        <div class="logo">EV</div>
        <div class="menu">
            <ul>
                <li><a href="adminvehicle.php">VEHICLE MANAGEMENT</a></li>
                <li><a href="adminusers.php">USERS</a></li>
                <li><a href="admindash.php">FEEDBACKS</a></li>
                <li><a href="adminbook.php">BOOKING REQUEST</a></li>
            </ul>
        </div>
        <button class="logout"><a href="index.php">LOGOUT</a></button>
    </div>

    <h1 class="header">Add New EV</h1>

    <div class="main">
        <h2>Enter Details Of New EV</h2>&nbsp;
        <form action="" method="POST" enctype="multipart/form-data">
            <label>EV Name :</label>
            <input type="text" name="evname" placeholder="Enter EV Name" required>
            
            <label>Fuel Type :</label>
            <input type="text" name="ftype" placeholder="Enter Fuel Type" required>
            
            <label>Capacity :</label>
            <input type="number" name="capacity" min="1" placeholder="Enter Capacity Of EV" required>
            
            <label>Price :</label>
            <input type="number" name="price" min="1" placeholder="Enter Price Of EV (in rupees)" required>
            
            <label>EV Image :</label>
            <input type="file" name="image" accept="image/*" required>

            <input type="submit" class="btnn" value="ADD EV" name="addev">
            <button id="back"><a href="adminvehicle.php">HOME</a></button>
        </form>
    </div>
</body>
</html>