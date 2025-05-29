<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #6a11cb, #2575fc);
            margin: 50px;   
            padding: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        .container {
            width: 100%;
            max-width: 480px;
            background: #fff;
            color: #333;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
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

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #6a11cb;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2575fc;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
            color: #666;
            width: 100%;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
            background: #f9f9f9;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #2575fc;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
            background: #fff;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border-radius: 10px;
            border: none;
            font-size: 16px;
            font-weight: bold;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.4);
        }

        .footer {
            margin-top: 20px;
            color: #2575fc;
        }

        .footer a {
            text-decoration: none;
            color: #6a11cb;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            input, button {
                font-size: 14px;
            }

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to EV Community!</h1>
        <h2>Sign Up Below</h2>

        <?php
    $errorMessage = "";

    
    $servername = "localhost"; 
    $username = "root";        
    $password = "";            
    $dbname = "evproject";  

    $conn = new mysqli('localhost', 'root', '', 'evproject');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['ph'];
        $password = $_POST['password']; 
        $cpassword = $_POST['cpassword'];
        $gender = $_POST['gender'];

        
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = "Email already exists. Please use a different email.";
        } else {
            
            if ($password === $cpassword) {
                
                $sql = "INSERT INTO users (fname, lname, email, phone_number, password, gender) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $fname, $lname, $email, $phone, $password, $gender);

                if ($stmt->execute()) {
                    echo "<script>alert('Registration successful!');</script>";
                    echo "<script>window.location.href = 'index.php';</script>";
                } else {
                    $errorMessage = "Error occurred. Please try again later.";
                }
            } else {
                $errorMessage = "Passwords do not match.";
            }
        }
        $stmt->close();
    }
    $conn->close();
?>


        <form id="register" action="" method="POST">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" placeholder="Enter Your First Name" required>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" placeholder="Enter Your Last Name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter Valid Email" 
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ex: example@ex.com" required>

            <label for="phonenumber">Phone Number:</label>
            <input type="tel" id="ph" name="ph" maxlength="10" onkeypress="return onlyNumberKey(event)" 
                   placeholder="Enter Your Phone Number" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" 
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters" required>

            <label for="cpassword">Confirm Password:</label>
            <input type="password" id="cpassword" name="cpassword" placeholder="Re-enter Password" required>

            <label>Gender:</label>
            <div style="display: flex; justify-content: center;">
                <input type="radio" id="male" name="gender" value="Male" required>
                <label for="male" style="margin-right: 20px;">Male</label>
                <input type="radio" id="female" name="gender" value="Female" required>
                <label for="female">Female</label>
            </div>

            <?php if (!empty($errorMessage)) { echo "<div class='error'>$errorMessage</div>"; } ?>

            <button type="submit" name="regs">Register</button>
        </form>

        <div class="footer">
            <p>Already have an account? <a href="index.php">Login</a></p>
        </div>
    </div>

    <script>
        function onlyNumberKey(evt) {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            if (ASCIICode >= 48 && ASCIICode <= 57) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>
</html>
