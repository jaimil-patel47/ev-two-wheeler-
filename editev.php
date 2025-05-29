<?php
require_once('connection.php');

if (isset($_GET['id'])) {
    $ev_id = intval($_GET['id']);
    $query = "SELECT * FROM ev WHERE EV_ID = $ev_id";
    $result = mysqli_query($con, $query);
    $ev = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ev_id = intval($_POST['ev_id']);
    $name = $_POST['name'];
    $fuel = $_POST['fuel'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $available = $_POST['available'];

    $update = "UPDATE ev SET EV_NAME='$name', FUEL_TYPE='$fuel', CAPACITY='$capacity', PRICE='$price', AVAILABLE='$available' WHERE EV_ID=$ev_id";
    if (mysqli_query($con, $update)) {
        echo "<script>alert('EV updated successfully.'); window.location.href='adminvehicle.php';</script>";
    } else {
        echo "<script>alert('Error updating EV: " . mysqli_error($con) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit EV</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            width: 400px;
        }
        .form-container h2 {
            text-align: center;
            color: #ff5722;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        .form-container input,
        .form-container select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-container button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: #ff5722;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 25px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }
        .form-container button:hover {
            background: #e64a19;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit EV</h2>
        <form method="POST">
            <input type="hidden" name="ev_id" value="<?php echo $ev['EV_ID']; ?>">
            <label>EV Name:</label>
            <input type="text" name="name" value="<?php echo $ev['EV_NAME']; ?>" required>

            <label>Fuel Type:</label>
            <input type="text" name="fuel" value="<?php echo $ev['FUEL_TYPE']; ?>" required>

            <label>Capacity:</label>
            <input type="text" name="capacity" value="<?php echo $ev['CAPACITY']; ?>" required>

            <label>Price:</label>
            <input type="number" name="price" value="<?php echo $ev['PRICE']; ?>" required>

            <label>Available:</label>
            <select name="available">
                <option value="Y" <?php if ($ev['AVAILABLE'] == 'Y') echo 'selected'; ?>>Yes</option>
                <option value="N" <?php if ($ev['AVAILABLE'] == 'N') echo 'selected'; ?>>No</option>
            </select>

            <button type="submit">Update EV</button>
        </form>
    </div>
</body>
</html>
