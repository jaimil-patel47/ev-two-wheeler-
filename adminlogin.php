<!DOCTYPE html>

<?php
    
    require_once('connection.php');

    
    session_start();

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adlog'])) {
        
        $id = trim($_POST['adid']);
        $pass = trim($_POST['adpass']);

        
        if (empty($id) || empty($pass)) {
            echo "<script>alert('Please fill in all the fields');</script>";
        } else {
            
            $query = "SELECT * FROM admin WHERE ADMIN_ID = ?";
            if ($stmt = $con->prepare($query)) {
                $stmt->bind_param("s", $id); 
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $row = $result->fetch_assoc()) {
                    $db_password = $row['ADMIN_PASSWORD'];

                    
                    if ($pass === $db_password) {
                        $_SESSION['admin_id'] = $id; 
                        echo "<script>alert('Welcome ADMINISTRATOR!');</script>";
                        header("Location: admindash.php");
                        exit();
                    } else {
                        echo "<script>alert('Incorrect password, please try again.');</script>";
                    }
                } else {
                    echo "<script>alert('Admin ID not found. Please check your credentials.');</script>";
                }

                $stmt->close(); 
            } else {
                echo "<script>alert('Database query failed. Please try again later.');</script>";
            }
        }
    }
    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script type="text/javascript">
        
        function preventBack() {
            window.history.forward();
        }
        setTimeout(preventBack, 0);
        window.onunload = function () { null };
    </script>
    <style>
        
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            background-image: url("images/adminbg2.jpg"); 
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            font-family: Arial, sans-serif;
            animation: fadeIn 2s ease-in; 
        }

        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        
        .form {
            width: 300px;
            height: 400px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            padding: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            animation: slideDown 1s ease-in-out; 
        }

        
        @keyframes slideDown {
            from {
                transform: translate(-50%, -100%);
                opacity: 0;
            }
            to {
                transform: translate(-50%, -50%);
                opacity: 1;
            }
        }

        .form h2 {
            text-align: center;
            color: orange;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .form input {
            width: 100%;
            height: 40px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #ff7200;
            color: #fff;
            font-size: 15px;
            margin: 20px 0;
            padding: 5px;
            transition: border-color 0.3s ease-in-out; 
        }

        .form input:focus {
            outline: none;
            border-bottom: 1px solid #fff; 
        }

        ::placeholder {
            color: #ccc;
        }

        .btnn {
            width: 100%;
            height: 40px;
            background: #ff7200;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out; 
        }

        .btnn:hover {
            background: #fff;
            color: #ff7200;
        }

        .btnn a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .back {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #ff7200;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s ease-in-out; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
}

        .back:hover {
        background: #fff;
        color: #ff7200;
        transform: scale(1.15); 
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); 
}

        .back a {
        text-decoration: none;
    color: inherit; 
}

    </style>
</head>
<body>
    
    
    <button class="back"><a href="index.php">Go To Home</a></button>

    
    <div class="form">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="adid" placeholder="Enter admin user ID" required>
            <input type="password" name="adpass" placeholder="Enter admin password" required>
            <button type="submit" class="btnn" name="adlog">LOGIN</button>
        </form>
    </div>
</body>
</html>
