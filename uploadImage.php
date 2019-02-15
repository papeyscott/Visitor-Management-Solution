<?php
ob_start();
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.0.6/src/Exception.php';
require 'PHPMailer-6.0.6/src/PHPMailer.php';
require 'PHPMailer-6.0.6/src/SMTP.php';
include 'admin/includes/db.php';
include 'admin/includes/function.php';


$error = [];


if(array_key_exists('image', $_POST)){


  $ext = ["image/jpg", "image/JPG", "image/jpeg", "image/JPEG", "image/png", "image/PNG"];
  if(empty($_FILES['upload']['name'])){
    $error['upload'] = "Please choose file";
  }
  if(!in_array($_FILES['upload']['type'], $ext)){
    $error['upload'] = "Invalid file type, Please Upload an Image File) ";
  }

  if(empty($error)){
      function compressImage4($files, $name, $quality, $upDIR ) {
  $rnd = rand(0000000, 9999999);
  $strip_name = str_replace(" ", "_", $files[$name]['name']);
  $filename = time().$rnd.$strip_name;
  $destination_url = $upDIR.$filename;
  $info = getimagesize($files[$name]['tmp_name']);
  if ($info['mime'] == 'image/jpeg')
  $image = imagecreatefromjpeg($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/gif')
  $image = imagecreatefromgif($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/png')
  $image = imagecreatefrompng($files[$name]['tmp_name']);
  imagejpeg($image,$destination_url, $quality);
  return $destination_url;
}

    $ver['a'] = compressImage4($_FILES,'upload',90, 'uploads/' );
    $clean = array_map('trim',$_POST);

    $new['id'] = $_SESSION['image'];
    unset($_SESSION['image']);
    $add['image'] = $ver['a'];
    $add['status'] = 'signed in';
    $firstime = date("h:i:sa");
    $timestamp = strtotime($firstime) + 60*60;
    $time = date('H:i:s', $timestamp);
    $add['last_login'] = $time;
    $add['last_login_date'] = date("Y-m-d");
    $_SESSION['login'] =  $_SESSION['name'];
    $final = $add + $clean;


$redirect = "success.php?success=Login Successful";

$result = update3($conn,'visitors',$final,'image',$new);
// die;
 $detail = getEmployeeByName($conn,$_SESSION['whom']);
    $a=urlencode('tadeayodeji92@gmail.com'); //Note: urlencodemust be added forusername and
$b=urlencode('papa2657'); // passwordas encryption code for security purpose.
$c= 'Hello '.$detail['name'].', Your visitor, '.$_SESSION['name'].' has arrived and will be waiting for you at the reception. Kindly meet up as soon as possible.. Thanks. ADMIN';
$d='GLH';
$e=$detail['phone'];
$url = "http://portal.bulksmsnigeria.net/api/?username=".$a."&password=".$b."&message=".$c."&sender=".$d."&mobiles=".$e;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, 0);
$resp = curl_exec($ch);
echo $resp; // Add double slash or delete “echo”
echo "<br>Thank you for using Bulk SMS Nigeria API"; // Your notification message here
curl_close($ch);


    $detail = getEmployeeByName($conn,$_SESSION['whom']);

  $subject = "Your visitor is here"; // subject of your email

$toAddress = $detail['email'];  //To whom you are sending the mail.
$message   = '<html>
                <body>
                    <h>Hello, '.$detail['name'].'</h>
                    <p>Your visitor, '.$_SESSION['name'].' has arrived and will be waiting for you at the reception </p>
                    <p>In an event you would not be able to attend to your visitor immediately, contact them or the reception to let them know.</p>
                    <img src="http://greenlandhall.org/visitors/'.$_POST['image'].'" width="100" height="100"  >

                    <h3>Greenland Hall Visitors Policy.</h3>
                    <p>Every staff member is responsible for there visitors, therefore all host should make sure their visitors adhere strictly to the <a href="">Greenland Hall Visitors Policy</a></p></body></html>';

$subject2 = "Checked In At Greenland Hall"; // subject of your email

$toAddress2 = $result['email'];  //To whom you are sending the mail.
$message2   = '<html>
              <body>
                  <h>Hello, '.$_SESSION['name'].'</h>
                  <p>You have checked in at Greenland Hall. Please wait at the Reception except instructed otherwise.
'.$detail['name'].' has been notified of your arrival.
</p>



                  <p>Note that signing our visitor register acknowledges that you understand <a href="">Greenland Hall Visitors Policy</a> and would abide by it</p></body></html>';






$mail2 = new PHPMailer();
$mail2->IsSMTP();
$mail2->Host       = "relay-hosting.secureserver.net";
$mail2->Port       = 25;
$mail2->SMTPDebug  = 0;
$mail2->SMTPSecure = "none";
$mail2->SMTPAuth   = false;

$mail2->IsHTML(true);
$mail2->Username = "visitors@greenlandhall.org"; // your gmail address
$mail2->Password = "Visitor@.02"; // password
$mail2->SetFrom("visitors@greenlandhall.org");
$mail2->Subject = $subject2; // Mail subject
$mail2->Body    = $message2;
$mail2->AddAddress($toAddress2);
if (!$mail2->Send()) {
die("Failed to send mail");

} else {


}





$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host       = "relay-hosting.secureserver.net";
$mail->Port       = 25;
$mail->SMTPDebug  = 0;
$mail->SMTPSecure = "none";
$mail->SMTPAuth   = false;

$mail->IsHTML(true);
$mail->Username = "visitors@greenlandhall.org"; // your gmail address
$mail->Password = "Visitor@.02"; // password
$mail->SetFrom("visitors@greenlandhall.org");
$mail->Subject = $subject; // Mail subject
$mail->Body    = $message;
$mail->AddAddress($toAddress);
if (!$mail->Send()) {
 die("Failed to send mail");

} else {


}
$message = "Login Successfull";
 // $success = "Visitor Added";
 // $succ = preg_replace('/\s+/', '_', $success);
 // workRate($dbconn,$sess);
  header("Location:welcome.php?success=$message");


    // addProfile($conn, $clean, $ver,$image_1,$hash_id);
  }



}
 ?>



<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
        <title>Take a Selfie</title>

        <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

     <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <style>
        .center-screen {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
}

html {
    height: 100%;
    background-repeat: no-repeat;
   /* background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
}

.card-container.card {
    max-width: 550px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}





    </style>
</head>
<body class="center-screen">


    <div class="container">
        <div class="card card-container">

            <form class="form-signin" method="POST" action="" enctype="multipart/form-data">







            <?php $display = displayErrors($error, 'upload');
            echo $display ?>

            <label class="btn btn-secondary">

                <i class="fa fa-image"></i> Tap to Take a Selfie
                <input type="file" style="display: none;" name="upload" accept="image/*" capture="camera">
            </label>

               <br> <br>
                <div class="form-group row">
                <div class="col-md-12">
                    <!-- <button type="submit" name="submit" class="btn btn-success btn-lg">Login</button> -->
                    <button class="btn btn-success" name="image" type="submit">Login</button>
                </div>
            </div>
            </form><!-- /form -->

        </div><!-- /card-container -->
    </div><!-- /container -->




<footer class="d-flex justify-content-around">
<h6 style="position: static; bottom: 0 ">&copy;  Greenland Educational Service 2019</h6>
</footer>


 <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>
</html>
