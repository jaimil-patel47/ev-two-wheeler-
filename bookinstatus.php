<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url("../ev_rental_project-main/images/desktop.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            overflow-y: auto;
            padding: 30px;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .container {
            position: relative;
            width: 90%;
            max-width: 850px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
            text-align: center;
            overflow-y: auto;
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .header .name {
            font-size: 26px;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }

        .header button {
            background-color: #ff7200;
            border: none;
            padding: 14px 28px;
            color: white;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .header button:hover {
            background-color: #e65a00;
            transform: scale(1.05);
        }

        .box {
            padding: 25px;
            background: linear-gradient(145deg, #ffffff, #f3f3f3);
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            transform: scale(1);
        }

        .box:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .box h1 {
            font-size: 22px;
            margin-bottom: 8px;
            color: #222;
        }

        .box p {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        .box .status {
            font-weight: bold;
            font-size: 18px;
            color: green;
            transition: color 0.4s ease;
        }

        .box .status:hover {
            color: #2ecc71;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <?php
    require_once('connection.php');
    session_start();

    if (!isset($_SESSION['email'])) {
        echo '<script>alert("Please login first.")</script>';
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }

    $email = $_SESSION['email'];

    $sql = "SELECT b.BOOK_ID, b.EV_ID, b.EV_MODEL, b.BOOK_STATUS, b.BOOK_DATE 
            FROM bookings AS b
            LEFT JOIN ev AS c ON b.EV_ID = c.EV_ID
            WHERE b.EMAIL='$email' 
            ORDER BY b.BOOK_ID DESC";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo '<script>alert("No booking details found.")</script>';
        echo '<script>window.location.href = "evdetails.php";</script>';
        exit();
    }

    $sql2 = "SELECT * FROM users WHERE EMAIL='$email'";
    $result2 = mysqli_query($con, $sql2);
    $user = mysqli_fetch_assoc($result2);
    ?>

    <div class="container">
        <div class="header">
            <button onclick="window.location.href='evdetails.php'">Go to Home</button>
            <div class="name">Hello, <?php echo htmlspecialchars($user['FNAME'] . " " . $user['LNAME']); ?>!</div>
        </div>

        <?php while ($booking = mysqli_fetch_assoc($result)) {
            $ev_id = $booking['EV_ID'];
            $sql3 = "SELECT * FROM ev WHERE EV_ID='$ev_id'";
            $result3 = mysqli_query($con, $sql3);
            $ev = mysqli_fetch_assoc($result3);
        ?>
            <div class="box">
                <?php if ($ev): ?>
                    <h1>EV Name: <?php echo htmlspecialchars($ev['EV_NAME']); ?></h1>
                <?php else: ?>
                    <h1>EV Name: <em style="color:red;">EV not found</em></h1>
                <?php endif; ?>

                <h1>EV Model: <?php echo htmlspecialchars($booking['EV_MODEL']); ?></h1>

                <p>Booked on: 
                    <strong>
                        <?php 
                        echo isset($booking['BOOK_DATE']) 
                            ? date('d M Y', strtotime($booking['BOOK_DATE'])) 
                            : '<em style="color:red;">Unknown</em>'; 
                        ?>
                    </strong>
                </p>

                <p>Status: <span class="status"><?php echo htmlspecialchars($booking['BOOK_STATUS']); ?></span></p>
            </div>
        <?php } ?>
    </div>
</body>

</html>
