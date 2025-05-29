<?php

require_once('connection.php');
$bookid=$_GET['id'];
$sql="SELECT * FROM booking WHERE BOOK_Id=$bookid";
$result=mysqli_query($con, $sql);
$res = mysqli_fetch_assoc($result);
$ev_id=$res['EV_ID'];
$sql2="SELECT * FROM evs WHERE EV_ID=$ev_id";
$evres=mysqli_query($con, $sql2);
$evresult = mysqli_fetch_assoc($evres);
$email=$res['EMAIL'];
$evname=$evresult['EV_NAME'];

if ($evresult['AVAILABLE'] == 'Y') {
    if ($res['BOOK_STATUS'] == 'APPROVED' || $res['BOOK_STATUS'] == 'RETURNED') {
        echo '<script>alert("ALREADY APPROVED")</script>';
        echo '<script>window.location.href = "adminbook.php";</script>';
    } else {
        $query="UPDATE bookings SET BOOK_STATUS='APPROVED' WHERE BOOK_ID=$bookid";
        $queryy=mysqli_query($con, $query);

        echo '<script>alert("APPROVED SUCCESSFULLY")</script>';
        // $to_email = $email;
        // $subject = "DONOT-REPLY";
        // $body = "YOUR BOOKING FOR THE CAR $evname IS BEEN APPROVED WITH BOOKING ID : $bookid";
        // $headers = "From: sender email";

        // if (mail($to_email, $subject, $body, $headers)) {
        //     echo "Email successfully sent to $to_email...";
        // } else {
        //     echo "Email sending failed!";
        // }

        echo '<script>window.location.href = "adminbook.php";</script>';
    }  
} else {
    echo '<script>alert("CAR IS NOT AVAILABLE")</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
}

?>
