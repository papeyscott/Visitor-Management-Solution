<?php
include 'includes/db.php';
include 'includes/function.php';

$date =  date("Y-m-d");
$stmt = $conn->prepare("SELECT * FROM visitors WHERE last_login_date=:dt AND NOT last_logout_date = :dt OR last_logout_date IS NULL ");
$stmt->bindParam(":dt",$date);
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    
      $detail = getEmployeeByName($conn,$row['whom']);
    $a=urlencode('tadeayodeji92@gmail.com'); //Note: urlencodemust be added forusername and
$b=urlencode('papa2657'); // passwordas encryption code for security purpose.
$c= 'Hello '.$detail['name'].', Your visitor, '.$row['name'].' has not checked out.';
$d='GLH';
$e=$detail['phone'];
$url = "http://portal.bulksmsnigeria.net/api/?username=".$a."&password=".$b."&message=".$c."&sender=".$d."&mobiles=".$e;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, 0);
$resp = curl_exec($ch);
// echo $resp; // Add double slash or delete “echo”
// echo "<br>Thank you for using Bulk SMS Nigeria API"; // Your notification message here
curl_close($ch);

    
    
    
}