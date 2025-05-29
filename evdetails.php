<?php 
    require_once('connection.php');
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }
    $value = $_SESSION['email'];

    $stmt = $con->prepare("SELECT * FROM users WHERE EMAIL = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
    } else {
        header("Location: index.php");
        exit();
    }
    
    $sql2 = "SELECT * FROM ev WHERE AVAILABLE = 'Y'";
    $ev = mysqli_query($con, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Details</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: url("images/index1.jpg");
    background-position: center;
    background-size: cover;
    font-family: Arial, sans-serif;
}

.navbar {
    width: 100%;
    height: 75px;
    padding: 10px 0;
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    opacity: 0;
    animation: slideDown 0.7s ease forwards;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-50px); }
    to { opacity: 1; transform: translateY(0); }
}

.navbar .logo {
    float: left;
    font-size: 30px;
    font-weight: bold;
    color: #ff7200;
    padding-left: 20px;
}

.navbar ul {
    list-style: none;
    display: flex;
    justify-content: flex-end;
    padding-right: 20px;
}

.navbar ul li {
    margin-left: 30px;
    font-size: 16px;
    padding-top: 15px;
}

.navbar ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    transition: all 0.3s ease;
}

.navbar ul li a:hover {
    color: #ff7200;
    letter-spacing: 1px;
}

.cd {
    text-align: center;
    margin-top: 80px;
}

h1.overview {
    color: white;
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 40px;
}

.de {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 40px;
    padding: 0 20px;
}

.de li {
    list-style: none;
}

.box {
    background: linear-gradient(135deg, rgba(255, 251, 251, 0.8) 50%, rgba(250, 246, 246, 0.8) 50%);
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    padding: 20px;
    height: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    transition: box-shadow 0.5s ease, transform 1s cubic-bezier(0.22, 1, 0.36, 1), opacity 1s ease;
    opacity: 0;
    transform: translateY(50px);
    will-change: opacity, transform;
}

.box.visible {
    opacity: 1;
    transform: translateY(0);
}

.box.not-visible {
    opacity: 0;
    transform: translateY(50px);
}

.box:hover {
    transform: scale(1.02) translateY(-5px);
    box-shadow: 0px 12px 24px rgba(255, 115, 0, 0.5);
}

.imgBx {
    width: 100%;
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.imgBx img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    border-radius: 8px;
    transition: transform 0.5s ease;
}

.imgBx img:hover {
    transform: scale(1.08);
    transition: transform 0.5s ease;
}

.content {
    text-align: center;
    margin-top: 20px;
}

.content h1 {
    font-size: 20px;
    font-weight: bold;
}

.content h2 {
    font-size: 16px;
    margin-top: 10px;
}

.content span {
    font-weight: bold;
}


.utton {
    width: 100%;
    max-width: 240px;
    margin-top: 20px;
    background: linear-gradient(90deg, #ff7200, #ff5500);
    border: none;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color: white;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 10px 20px;
    position: relative;
    overflow: hidden;
    transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}

.utton:hover {
    transform: scale(1.1);
    box-shadow: 0px 10px 20px rgba(255, 115, 0, 0.4), 0px 4px 10px rgba(255, 115, 0, 0.2);
    background: linear-gradient(90deg, #ff5500, #ff7200);
}

.utton:active {
    transform: scale(0.95);
    box-shadow: 0px 5px 10px rgba(255, 115, 0, 0.2);
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


.circle{
    border-radius:50%;
    width:45px;
}

.phello{
    width: 150px;
    margin-left: -20px;
    padding: 0px;
}

#stat {
    margin-left: -8px;
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
}

    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">EV</div>
        <ul>
            <li><a href="evdetails.php">HOME</a></li>
            <li><a href="aboutus2.html">ABOUT</a></li>
            <li><a href="contactus.php">CONTACT</a></li>
            <li><a href="feedback/Feedbacks.php">FEEDBACK</a></li>
            <li><button class="nn"><a href="index.php">LOGOUT</a></button></li>
            <li><img src="images/profile.png" class="circle" alt="Alps"></li>
            <li><p class="phello">HELLO! &nbsp;<a id="pname"><?php echo $rows['FNAME']." ".$rows['LNAME']?></a></p></li>
            <li><a id="stat" href="bookinstatus.php">BOOKING STATUS</a></li>
        </ul>
    </div>

    <div class="cd">
        <h1 class="overview">OUR EV OVERVIEW</h1>

        <ul class="de">
            <?php if (mysqli_num_rows($ev) > 0) { ?>
                <?php while ($result = mysqli_fetch_array($ev)) { ?>
                    <li>
                        <div class="box">
                            <div class="imgBx">
                                <img src="images/<?php echo htmlspecialchars($result['EV_IMG']); ?>" alt="EV Image">
                            </div>
                            <div class="content">
                                <h1><?php echo htmlspecialchars($result['EV_NAME']); ?></h1>
                                <h2>Fuel Type: <span><?php echo htmlspecialchars($result['FUEL_TYPE']); ?></span></h2>
                                <h2>Capacity: <span><?php echo htmlspecialchars($result['CAPACITY']); ?></span></h2>
                                <h2>Price of EV: <span>₹<?php echo htmlspecialchars($result['PRICE']); ?>/-</span></h2><br>
                                <a href="bookings.php?id=<?php echo htmlspecialchars($result['EV_ID']); ?>">
                                    <button class="utton">BOOK NOW</button>
                                </a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <p style="color: white; text-align: center; font-size: 24px;">There is no EV available.</p>
            <?php } ?>
        </ul>
    </div>
    <script>
    const boxes = document.querySelectorAll('.box');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                entry.target.classList.remove('not-visible');
            } else {
                entry.target.classList.remove('visible');
                entry.target.classList.add('not-visible');
            }
        });
    }, {
        threshold: 0.2
    });

    boxes.forEach(box => {
        box.classList.add('not-visible');
        observer.observe(box);
    });
</script>

</body>
</html>
