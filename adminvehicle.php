<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background-color: #f4f4f4;
            color: #333;
        }

        .hai {
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0) 50%), url("../car_rental_project-main/images/desktop.jpg");
            background-position: center;
            background-size: cover;
            height: 109vh;
            animation: infiniteScrollBg 50s linear infinite;
        }

        .navbar {
            width: 1200px;
            height: 75px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 0;
            animation: fadeInUp 1s ease-in-out forwards 0.5s;
        }

        .logo {
            color: #ff5722;
            font-size: 36px;
            padding-left: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .logo:hover {
            transform: scale(1.1);
        }

        .menu ul {
            display: flex;
            list-style: none;
            margin-right: 20px;
        }

        .menu ul li {
            margin-left: 30px;
            font-size: 16px;
            text-align: center;
            transition: color 0.3s ease-in-out;
        }

        .menu ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: 0.3s ease-in-out;
        }

        .menu ul li a:hover {
            color: #ff5722;
        }

        .content-table {
            width: 100%;
            margin: 30px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            opacity: 0;
            animation: fadeInUp 1s ease-in-out forwards 1s;
        }

        .content-table thead tr {
            background-color: #ff5722;
            color: white;
            text-align: left;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
            text-align: center;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
            transition: transform 0.3s ease-in-out;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:hover {
            background-color: #ffebee;
            transform: translateX(10px);
        }

        .header {
            margin-top: 50px;
            text-align: center;
            font-size: 30px;
            color: #333;
            animation: fadeInUp 1s ease-in-out;
            opacity: 0;
            animation: fadeInUp 1s ease-in-out forwards 0.8s;
        }

        .add {
            width: 200px;
            height: 45px;
            background: #ff5722;
            border: none;
            font-size: 18px;
            border-radius: 25px;
            cursor: pointer;
            color: white;
            transition: background 0.4s ease, transform 0.3s ease, box-shadow 0.3s;
            display: block;
            margin: 20px auto;
            animation: popIn 1s ease forwards;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .add a {
            text-decoration: none;
            color: white;
            font-weight: bolder;
            display: block;
            height: 100%;
            width: 100%;
            line-height: 45px;
            text-align: center;
        }

        .add:hover {
            background: #e64a19;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
        }

        .logout-btn {
            padding: 12px 20px;
            background: #ff5722;
            border-radius: 25px;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .logout-btn a {
            text-decoration: none;
            color: white !important;
            font-weight: bold;
            display: block;
        }

        .logout-btn:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
        }

        @keyframes popIn {
            0% { opacity: 0; transform: scale(5) translateY(20px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        @keyframes fadeInUp {
            0% { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes infiniteScrollBg {
            0% { background-position: 0 0; }
            100% { background-position: 100% 0; }
        }
    </style>
</head>
<body>

<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_ids'])) {
    $ids = $_POST['delete_ids'];
    $safe_ids = array_map('intval', $ids);
    $id_list = implode(',', $safe_ids);

    $delete_query = "DELETE FROM ev WHERE EV_ID IN ($id_list)";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo "<script>alert('Selected EVs deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting EVs: " . mysqli_error($con) . "');</script>";
    }
}

$query = "SELECT * FROM ev";  
$queryy = mysqli_query($con, $query);
$num = mysqli_num_rows($queryy);
?>

<div class="hai">
    <div class="navbar">
        <div class="logo">
            <h2>EV Management</h2>
        </div>
        <div class="menu">
            <ul>
                <li><a href="adminvehicle.php">EV MANAGEMENT</a></li>
                <li><a href="adminusers.php">USERS</a></li>
                <li><a href="admindash.php">FEEDBACKS</a></li>
                <li><a href="adminbook.php">BOOKING REQUEST</a></li>
                <li><button class="logout-btn"><a href="adminlogin.php">LOGOUT</a></button></li>
            </ul>
        </div>
    </div>

    <div>
        <h1 class="header">Electric Vehicles (EV)</h1>
        <button class="add"><a href="addev.php">+ ADD EV</a></button>

        <form method="POST" action="">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>EV ID</th>
                        <th>EV NAME</th>
                        <th>FUEL TYPE</th>
                        <th>CAPACITY</th>
                        <th>PRICE</th>
                        <th>AVAILABLE</th>
                        <th>Select</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($num > 0) {
                        while ($res = mysqli_fetch_array($queryy)) {
                    ?>
                    <tr class="active-row">
                        <td><?php echo $res['EV_ID']; ?></td>
                        <td><?php echo $res['EV_NAME']; ?></td>  
                        <td><?php echo $res['FUEL_TYPE']; ?></td>
                        <td><?php echo $res['CAPACITY']; ?></td>
                        <td><?php echo $res['PRICE']; ?></td>
                        <td><?php echo ($res['AVAILABLE'] == 'Y') ? 'YES' : 'NO'; ?></td>
                        <td>
                            <input type="checkbox" name="delete_ids[]" value="<?php echo $res['EV_ID']; ?>"></td>
                            <td>    <a href="editev.php?id=<?php echo $res['EV_ID']; ?>" style="margin-left:10px; color:#ff5722; font-weight:bold;">Edit</a>
                        </td>
                    </tr>
<?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>No EVs found in the database.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <button type="submit" class="add" style="margin-top: 20px;">Delete Selected EVs</button>
        </form>
    </div>
</div>

</body>
</html>
