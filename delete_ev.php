<?php

require_once('connection.php');
$evid=$_GET['id'];
$sql="DELETE from ev where EV_ID=$evid";
$result=mysqli_query($con,$sql);

echo '<script>alert("EV DELETED SUCCESFULLY")</script>';
echo '<script> window.location.href = "adminvehicle.php";</script>';



?>