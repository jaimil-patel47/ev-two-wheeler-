<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(135deg, #141e30, #243b55);
        animation: fadeIn 1s ease-in-out;
}


        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .form {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 400px;
            animation: bounceIn 0.8s ease;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        h1 {
            margin-bottom: 25px;
            color: #fff;
            font-size: 22px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .btn {
            width: 100%;
            height: 45px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .btn.cancel {
            background: #ff3b3b;
            color: white;
        }

        .btn.cancel:hover {
            background: #d63031;
            transform: scale(1.05);
            box-shadow: 0 0 5px #ff3b3b;
        }

        .btn.payment {
            background: #27ae60;
            color: white;
        }

        .btn.payment:hover {
            background: #1e8449;
            transform: scale(1.05);
            box-shadow: 0 0 5px #27ae60;
        }

        .btn.payment a {
            text-decoration: none;
            color: inherit;
            display: block;
            width: 100%;
            height: 100%;
            line-height: 45px;
        }

        .modal {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
            z-index: 1000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            animation: popUp 0.3s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        }

        @keyframes popUp {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-content h2 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #333;
        }

        .modal-content button {
            margin: 10px;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .confirm {
            background: #ff3b3b;
            color: white;
        }

        .confirm:hover {
            background: #d63031;
            transform: scale(1.05);
        }

        .cancel {
            background: #ccc;
            color: #333;
        }

        .cancel:hover {
            background: #999;
            color: #fff;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

<?php
    require_once('connection.php');
    session_start();
    $bid = $_SESSION['bid'];
    if(isset($_POST['cancelnow'])){
        $del = mysqli_query($con,"DELETE FROM booking WHERE BOOK_ID = '$bid' ORDER BY BOOK_ID DESC LIMIT 1");
        echo "<script>window.location.href='evdetails.php';</script>";
    }
?>

    <form class="form" method="POST" id="cancelForm">
        <h1>Are you sure you want to cancel your booking?</h1>
        <button type="button" class="btn cancel" id="openModal">Cancel Now</button>
        <button type="button" class="btn payment"><a href="payment.php">Go to Payment</a></button>
        <input type="hidden" name="cancelnow" value="1">
    </form>

    <div class="modal" id="confirmModal">
        <div class="modal-content">
            <h2>⚠️ Confirm Cancellation</h2>
            <p>Are you sure you want to cancel your booking?</p>
            <button class="confirm" id="confirmYes">Yes, Cancel</button>
            <button class="cancel" id="confirmNo">No, Go Back</button>
        </div>
    </div>

    <script>
        const openModalBtn = document.getElementById('openModal');
        const modal = document.getElementById('confirmModal');
        const confirmYes = document.getElementById('confirmYes');
        const confirmNo = document.getElementById('confirmNo');
        const form = document.getElementById('cancelForm');

        openModalBtn.addEventListener('click', () => {
            modal.classList.add('active');
        });

        confirmNo.addEventListener('click', () => {
            modal.classList.remove('active');
        });

        confirmYes.addEventListener('click', () => {
            form.submit();
        });
    </script>

</body>

</html>
