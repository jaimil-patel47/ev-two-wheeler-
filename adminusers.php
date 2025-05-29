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
        }

        body {
            font-family: Arial, sans-serif;
            animation: fadeIn 1.5s ease-in-out;
        }

        .logo {
            color: black;
            font-size: 35px;
            font-weight: bold;
            animation: slideInLeft 1s ease-in-out;
        }

        .menu {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            animation: slideInDown 1.2s ease-in-out;
        }

        .menu ul {
            display: flex;
            list-style: none;
        }

        .menu ul li {
            margin: 0 20px;
        }

        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: 0.3s;
        }

        .menu ul li a:hover {
            color: #ff7200;
        }

        .navbar {
            width: 95%;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;             background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 0 50px;
        }

        .logout {
            background-color: #ff7200;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            animation: slideInRight 1s ease-in-out;
            margin-left: auto;         }

        .logout a {
            text-decoration: none;
            color: white;
        }

        .logout:hover {
            background-color: #e65c00;
        }

        .header {
            text-align: center;
            margin: 50px 0;
            font-size: 32px;
            color: black;
            animation: fadeIn 2s ease-in-out;
        }

        .content-table {
            border-collapse: collapse;
            margin: 0 auto;
            font-size: 0.9em;
            min-width: 800px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            animation: zoomIn 1.5s ease-in-out;
        }

        .content-table thead tr {
            background-color: orange;
            color: white;
            text-align: left;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid orange;
        }

        .content-table tbody tr.active-row {
            font-weight: bold;
            color: black;
        }

        .delete-button {
            background-color: #ff7200;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-button a {
            text-decoration: none;
            color: white;
        }

        .delete-button:hover {
            background-color: #e66b00;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">EV</div>
        <div class="menu">
            <ul>
                <li><a href="adminvehicle.php">VEHICLE MANAGEMENT</a></li>
                <li><a href="adminusers.php">USERS</a></li>
                <li><a href="admindash.php">FEEDBACKS</a></li>
                <li><a href="adminbook.php">BOOKING REQUEST</a></li>
            </ul>
        </div>
        <button class="logout"><a href="index.php">LOGOUT</a></button>
    </div>

    <h1 class="header">USERS</h1>

    <table class="content-table">
        <thead>
            <tr>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PHONE NUMBER</th>
                <th>GENDER</th>
                <th>DELETE USERS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once('connection.php');
                $query = "SELECT * FROM users";
                $queryy = mysqli_query($con, $query);

                while ($res = mysqli_fetch_array($queryy)) {
            ?>
            <tr class="active-row">
                <td><?php echo $res['FNAME'] . " " . $res['LNAME']; ?></td>
                <td><?php echo $res['EMAIL']; ?></td>
                <td><?php echo $res['PHONE_NUMBER']; ?></td>
                <td><?php echo $res['GENDER']; ?></td>
                <td><button class="delete-button"><a href="deleteuser.php?id=<?php echo $res['EMAIL']; ?>">DELETE USER</a></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
