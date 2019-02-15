<?php
include 'includes/db.php';

$date =  date("Y-m-d");
$stmt = $conn->prepare("UPDATE visitors SET suspend_status=1 WHERE last_login_date=:dt AND NOT last_logout_date = :dt OR last_logout_date IS NULL ");
$stmt->bindParam(":dt",$date);
$stmt->execute();