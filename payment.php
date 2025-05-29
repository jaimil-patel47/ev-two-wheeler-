<?php
require_once('connection.php');
session_start();
$email = $_SESSION['email'];
$sql = "SELECT * FROM bookings   WHERE EMAIL='$email' ORDER BY BOOK_ID DESC";
$cname = mysqli_query($con, $sql);
$email = mysqli_fetch_assoc($cname);
$bid = $email['BOOK_ID'];
$_SESSION['bid'] = $bid;

if (isset($_POST['pay'])) {
    $cardno = mysqli_real_escape_string($con, str_replace(' ', '', $_POST['cardno']));
    $exp = mysqli_real_escape_string($con, $_POST['exp']);
    $cvv = mysqli_real_escape_string($con, $_POST['cvv']);
    $cardtype = mysqli_real_escape_string($con, $_POST['cardtype']);
    $price = $email['PRICE'];
    
    if (empty($cardno) || empty($exp) || empty($cvv) || empty($cardtype)) {
        echo '<script>alert("Please fill all the fields")</script>';
    } elseif (!preg_match('/^\d{15,19}$/', $cardno)) {
        echo '<script>alert("Card number must be 15 to 19 digits depending on card type.")</script>';
    } else {
        $sql2 = "INSERT INTO payment (BOOK_ID, CARD_NO, EXP_DATE, CVV, CARD_TYPE, PRICE) VALUES($bid, '$cardno', '$exp', $cvv, '$cardtype', $price)";
        $result = mysqli_query($con, $sql2);
        if ($result) {
            header("Location: psucess.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <link rel="stylesheet" href="css/pay.css">
    <title>Payment Form</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Poppins&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: orange url("images/payment1.jpg") center/cover;
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .card {
            margin-left: -500px;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            padding: 2.5rem;
            border-radius: 2.5rem;
            animation: slideIn 1s ease-in-out;
        }
        @keyframes slideIn {
            from { transform: translateY(100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .card__input:focus {
            outline: none;
            border-bottom: 1px solid #ff7200;
            box-shadow: 0px 4px 8px rgba(255, 114, 0, 0.3);
        }
        .pay {
            width: 220px;
            height: 50px;
            font-size: 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #ff7200;
            color: white;
            text-decoration: none;
            margin-left: 40px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .btn {
            width: 220px;
            height: 50px;
            font-size: 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #ff7200;
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .pay:hover, .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(231, 76, 60, 0.5);
            background: #e05200;
        }
        .btn {
            background: #ccc;
            color: #333;
        }
        .btn:hover {
            background: #999;
            color: white;
        }
        .payment {
            margin-top: -550px;
            margin-left: 1000px;
            animation: fadeIn 1s ease-in-out;
        }
        #cardType {
            display: block;
            margin-top: 5px;
            font-weight: bold;
            color: #ff7200;
        }
        .card__col {
            flex: 1;
        }
        #cardExpiry, #cardCcv {
            width: 110px;
        }
        .error-message {
            color: #ff7200;
            font-size: 0.8em;
            margin-top: 4px;
        }
        .card__input.invalid {
            border-bottom-color: #ff7200;
            box-shadow: 0 0 5px rgba(255, 114, 0, 0.3);
        }
    </style>
</head>
<body>
    <h2 class="payment">TOTAL PAYMENT : <a>₹<?php echo $email['PRICE'] ?>/-</a></h2>
    <div class="card">
        <form method="POST">
            <h1 class="card__title">Enter Payment Information</h1>
            <div class="card__row">
                <div class="card__col">
                    <label for="cardNumber" class="card__label">Card Number</label>
                    <input type="text" class="card__input card__input--large" id="cardNumber" name="cardno" required>
                    <span id="cardType">Card Type: Unknown</span>
                    <span class="error-message" id="cardNumberError"></span>
                    <input type="hidden" name="cardtype" id="cardtype" value="">
                </div>
            </div>
            <div class="card__row">
                <div class="card__col">
                    <label for="cardExpiry" class="card__label">Expiry Date</label>
                    <input type="text" class="card__input" id="cardExpiry" name="exp" required>
                    <br>
                    <span class="error-message" id="expiryError"></span>
                </div>
                <div class="card__col">
                    <label for="cardCcv" class="card__label">CCV</label>
                    <input type="password" class="card__input" id="cardCcv" name="cvv" maxlength="3" pattern="\d{3}" title="Enter valid 3-digit CCV" required>
                    <br>
                    <span class="error-message" id="cvvError"></span>
                </div>
            </div>
            <div style="margin-top: 20px; display: flex; gap: 15px;">
                <button type="submit" name="pay" class="pay">
                    <i class="fas fa-credit-card"></i> PAY NOW
                </button>
                <a href="cancelbooking.php" class="btn">
                    <i class="fas fa-times-circle"></i> CANCEL
                </a>
            </div>
        </form>
    </div>

    <script>
    const cleaveCard = new Cleave('#cardNumber', {
        creditCard: true,
        onCreditCardTypeChanged: function(type) {
            const cardTypeText = {
                visa: 'VISA',
                mastercard: 'MasterCard',
                amex: 'American Express',
                diners: 'Diners Club',
                discover: 'Discover',
                jcb: 'JCB',
                unionpay: 'UnionPay',
                maestro: 'Maestro',
                mir: 'MIR',
                unknown: 'Unknown'
            };
            document.getElementById('cardType').textContent = 'Card Type: ' + (cardTypeText[type] || 'Unknown');
            document.getElementById('cardtype').value = cardTypeText[type] || 'Unknown';
        }
    });

    new Cleave('#cardExpiry', {
        date: true,
        datePattern: ['m', 'y']
    });

    function validateCardNumber(input) {
        const errorSpan = document.getElementById('cardNumberError');
        const value = input.value.replace(/\s/g, '');
        
        if (!value) {
            setError(errorSpan, 'Card number is required');
            return false;
        } else if (!/^\d{15,19}$/.test(value)) {
            setError(errorSpan, 'Card number must be 15 to 19 digits depending on card type');
            return false;
        } else {
            clearError(errorSpan);
            return true;
        }
    }

    function validateExpiryDate(input) {
        const errorSpan = document.getElementById('expiryError');
        const value = input.value;
        const parts = value.split("/");

        const payButton = document.querySelector(".pay");

        if (!value) {
            setError(errorSpan, 'Expiry date is required');
            payButton.disabled = true;
            return false;
        } else if (parts.length !== 2) {
            setError(errorSpan, 'Invalid expiry date format. Use MM/YY.');
            payButton.disabled = true;
            return false;
        }

        const month = parseInt(parts[0], 10);
        const year = parseInt(parts[1], 10) + 2000;
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth() + 1;

        if (isNaN(month) || isNaN(year) || 
            month < 1 || month > 12 || 
            year < currentYear || 
            (year === currentYear && month < currentMonth)) {
            setError(errorSpan, 'Invalid or expired card date');
            payButton.disabled = true;
            return false;
        }

        clearError(errorSpan);
        payButton.disabled = false;
        return true;
    }

    function validateCVV(input) {
        const errorSpan = document.getElementById('cvvError');
        const value = input.value;

        if (!value) {
            setError(errorSpan, 'CVV is required');
            return false;
        } else if (!/^\d{3}$/.test(value)) {
            setError(errorSpan, 'Please enter valid 3-digit CVV');
            return false;
        }

        clearError(errorSpan);
        return true;
    }

    function setError(element, message) {
        element.textContent = message;
        element.style.color = '#ff7200';
        element.previousElementSibling.classList.add('invalid');
    }

    function clearError(element) {
        element.textContent = '';
        element.previousElementSibling.classList.remove('invalid');
    }

    document.getElementById("cardNumber").addEventListener("input", function() {
        validateCardNumber(this);
    });

    document.getElementById("cardExpiry").addEventListener("blur", function() {
        validateExpiryDate(this);
    });

    document.getElementById("cardCcv").addEventListener("input", function() {
        validateCVV(this);
    });
</script>

</body>
</html>
