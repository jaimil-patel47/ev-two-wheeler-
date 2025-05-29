<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #form {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s;
        }

        input:focus, textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.5);
        }

        textarea {
            resize: none;
        }

        .rating {
            text-align: center;
            margin: 20px 0;
        }

        .rating i {
            font-size: 28px;
            color: #ddd;
            cursor: pointer;
            transition: transform 0.3s, color 0.3s;
        }

        .rating i.active {
            color: #ffcc00;
            transform: scale(1.2);
        }

        .rating i:hover {
            color: #ffcc00;
        }

        .btn {
            background: linear-gradient(to right, #36d1dc, #5b86e5);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 30px;
            padding: 12px;
            width: 100%;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn:hover {
            background: linear-gradient(to right, #5b86e5, #36d1dc);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: orange;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<?php
require_once('../connection.php');
session_start();

if (!isset($_SESSION['email'])) {
    echo '<script>alert("Please login first! Redirecting to login page.");</script>';
    header("Location: ../login.php");
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $comment = trim($_POST['comment']);
    $rating = $_POST['rating'];
    if (!empty($comment)) {
        $stmt = $con->prepare("INSERT INTO feedback (EMAIL, COMMENT, RATING) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $email, $comment, $rating);
        if ($stmt->execute()) {
            echo '<script>alert("Feedback Sent Successfully! THANK YOU!")</script>';
            header("Location: ../evdetails.php");
            exit();
        } else {
            echo '<script>alert("Error submitting feedback. Please try again.")</script>';
        }
        $stmt->close();
    } else {
        echo '<script>alert("Comment cannot be empty.")</script>';
    }
}
?>

<div id="form">
    <h2>Feedback Form</h2>
    <form method="POST">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" placeholder="Your Name" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email); ?>" readonly>
        </div>

        <div class="form-group">
            <label>Comments:</label>
            <textarea name="comment" rows="4" placeholder="Your message" required></textarea>
        </div>

        <div class="form-group rating">
            <label>Rate Us:</label><br>
            <input type="hidden" name="rating" id="rating" value="0" />
            <i class="fa fa-star" data-value="1"></i>
            <i class="fa fa-star" data-value="2"></i>
            <i class="fa fa-star" data-value="3"></i>
            <i class="fa fa-star" data-value="4"></i>
            <i class="fa fa-star" data-value="5"></i>
        </div>

        <button type="submit" class="btn" name="submit">Submit Feedback</button>
        <a class="back-btn" href="../evdetails.php">← Go Back</a>
    </form>
</div>

<script>
    const stars = document.querySelectorAll('.rating i');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            ratingInput.value = value;
            stars.forEach(s => s.classList.remove('active'));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('active');
            }
        });
    });
</script>

</body>

</html>
