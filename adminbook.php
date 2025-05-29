<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; overflow-x: hidden; }
        .hai {
            width: 100%;
            height: 100vh;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.5) 50%), url("../images/carbg2.jpg");
            background-position: center;
            background-size: cover;
            animation: infiniteScrollBg 20s linear infinite;
        }
        @keyframes infiniteScrollBg {
            0% { background-position: center top; }
            100% { background-position: center bottom; }
        }
        .navbar {
            width: 100%;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 0 50px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .logo { color: #ff7200; font-size: 35px; font-weight: bold; }
        .menu ul { list-style: none; display: flex; align-items: center; }
        .menu ul li { margin: 0 20px; }
        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }
        .menu ul li a:hover { color: #ff7200; }
        .btn {
            border: none;
            padding: 10px 20px;
            background-color: #ff7200;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover { background-color: #e65c00; }
        .header {
            text-align: center;
            margin: 50px 0;
            font-size: 32px;
            color: #333;
        }
        .content-table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 90%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            background-color: white;
        }
        .content-table thead tr {
            background-color: orange;
            color: white;
            text-align: left;
        }
        .content-table th, .content-table td {
            padding: 12px 15px;
            text-align: center;
        }
        .content-table tbody tr { border-bottom: 1px solid #dddddd; }
        .content-table tbody tr:nth-of-type(even) { background-color: #f3f3f3; }
        .content-table tbody tr:last-of-type { border-bottom: 2px solid orange; }
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            margin: 2px;
        }
        .approve-btn { background-color: #28a745; }
        .approve-btn:hover { background-color: #218838; transform: scale(1.05); }
        .reject-btn { background-color: #dc3545; }
        .reject-btn:hover { background-color: #c82333; transform: scale(1.05); }
    </style>
</head>

<body>

<?php
require_once('connection.php');

// APPROVE booking
if (isset($_GET['approve_id'])) {
    $approve_id = intval($_GET['approve_id']);
    $update = "UPDATE bookings SET BOOK_STATUS = 'APPROVED' WHERE BOOK_ID = $approve_id";
    if (mysqli_query($con, $update)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Approved!',
                text: 'Booking Approved Successfully!',
                confirmButtonColor: '#ff7200'
            }).then(() => { window.location.href='adminbook.php'; });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Approval Failed!',
                confirmButtonColor: '#ff7200'
            });
        </script>";
    }
}

if (isset($_GET['reject_id'])) {
    $reject_id = intval($_GET['reject_id']);
    $update = "UPDATE bookings SET BOOK_STATUS = 'NOT AVAILABLE' WHERE BOOK_ID = $reject_id";
    if (mysqli_query($con, $update)) {
        echo "<script>
            Swal.fire({
                icon: 'info',
                title: 'Marked as Not Available!',
                text: 'Booking marked as not available.',
                confirmButtonColor: '#ff7200'
            }).then(() => { window.location.href='adminbook.php'; });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Update Failed!',
                confirmButtonColor: '#ff7200'
            });
        </script>";
    }
}

$query = "SELECT b.*, c.EV_NAME FROM bookings AS b
          LEFT JOIN ev AS c ON b.EV_ID = c.EV_ID
          WHERE b.BOOK_STATUS != 'APPROVED'
          ORDER BY b.BOOK_ID DESC";
$queryy = mysqli_query($con, $query);
?>
    <div class="hai">
    <div class="navbar">
        <div class="logo">EV</div>
        <div class="menu">
            <ul>
                <li><a href="adminvehicle.php">VEHICLE MANAGEMENT</a></li>
                <li><a href="adminusers.php">USERS</a></li>
                <li><a href="admindash.php">FEEDBACKS</a></li>
                <li><a href="adminbook.php">BOOKING REQUEST</a></li>
                <li>
                    <form method="post" action="adminlogin.php" style="display:inline;">
                        <button type="submit" class="btn">LOGOUT</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <h1 class="header">BOOKINGS</h1>

    <table class="content-table">
        <thead>
            <tr>
                <th>EV ID</th>
                <th>EV MODEL</th>
                <th>EV NAME</th>
                <th>EMAIL</th>
                <th>BOOK PLACE</th>
                <th>BOOK DATE</th>
                <th>PHONE NUMBER</th>
                <th>DESTINATION</th>
                <th>BOOKING STATUS</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($queryy) > 0) {
                while ($res = mysqli_fetch_array($queryy)) { ?>
                    <tr>
                        <td><?php echo $res['EV_ID']; ?></td>
                        <td><?php echo $res['EV_MODEL']; ?></td>
                        <td><?php echo isset($res['EV_NAME']) ? $res['EV_NAME'] : 'Unknown'; ?></td>
                        <td><?php echo $res['EMAIL']; ?></td>
                        <td><?php echo $res['BOOK_PLACE']; ?></td>
                        <td><?php echo $res['BOOK_DATE']; ?></td>
                        <td><?php echo $res['PHONE_NUMBER']; ?></td>
                        <td><?php echo $res['DESTINATION']; ?></td>
                        <td><?php echo $res['BOOK_STATUS']; ?></td>
                        <td>
                            <button class="action-btn approve-btn" onclick="approveBooking(<?php echo $res['BOOK_ID']; ?>)">APPROVE</button>
                            <button class="action-btn reject-btn" onclick="rejectBooking(<?php echo $res['BOOK_ID']; ?>)">NOT AVAILABLE</button>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="10" style="color:red; font-weight:bold; padding: 20px;">
                        No Bookings Available
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

    <script>
    function approveBooking(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to approve this booking!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'adminbook.php?approve_id=' + id;
            }
        });
    }

    function rejectBooking(id) {
        Swal.fire({
            title: 'Mark as Not Available?',
            text: "This will mark the booking as NOT AVAILABLE.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Mark it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'adminbook.php?reject_id=' + id;
            }
        });
    }
</script>

</body>
</html>