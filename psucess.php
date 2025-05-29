\<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            font-family: "Nunito Sans", sans-serif;
        }
        
        .card {
            background: white;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .icon-container {
            background: #F0FFF0;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            animation: bounceIn 1s ease-in-out;
        }
        
        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
        }
        
        i {
            color: #4CAF50;
            font-size: 50px;
        }
        
        h1 {
            color: #333;
            font-size: 32px;
            font-weight: 900;
        }
        
        p {
            color: #555;
            font-size: 18px;
            margin-bottom: 20px;
        }
        
        .button {
            display: inline-block;
            background: #ff7200;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }
        
        .button:hover {
            background: #ff9800;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-container">
            <i class="checkmark">✓</i>
        </div>
        <h1>Payment Successful</h1> 
        <p>Your rental request has been received! <br/> We'll be in touch shortly.</p>
        <a href="evdetails.php" class="button">Search EV</a>
    </div>
</body>
</html>
