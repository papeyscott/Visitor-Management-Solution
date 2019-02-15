<?php
ob_start();
session_start();
if(isset($_SESSION['login']) || isset($_SESSION['name']) or isset($_SESSION['whom'])){
  unset($_SESSION['login']);
  unset($_SESSION['name']);
  unset($_SESSION['whom']);
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.0.6/src/Exception.php';
require 'PHPMailer-6.0.6/src/PHPMailer.php';
require 'PHPMailer-6.0.6/src/SMTP.php';
include 'admin/includes/db.php';
include 'admin/includes/function.php';
$error = [];
if(array_key_exists('submit', $_POST)){
  if(empty($_POST['phone'])){
    $error['phone'] = "PLease Enter Phone Number";
  }
  if(empty($error)){
    // die("now");
    $result = login($conn, $_POST);



  $detail = getEmployeeByName($conn,$result['whom']);
    $a=urlencode('tadeayodeji92@gmail.com'); //Note: urlencodemust be added forusername and
$b=urlencode('papa2657'); // passwordas encryption code for security purpose.
$c= 'Hello '.$detail['name'].', Your visitor, '.$_SESSION['name'].' is waiting for you at the reception.';
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


  $subject = "A visitor has checked in to see you"; // subject of your email

$toAddress = $detail['email'];  //To whom you are sending the mail.
$message   = '<html>
                <body>
                    <h>Hello, '.$detail['name'].'</h>
                    <p>Your visitor, '.$_SESSION['name'].' has arrived and will be waiting for you at the reception </p>
                    <p>In an event you would not be able to attend to your visitor immediately, contact them or the reception to let them know.</p>
                      <img src="http://greenlandhall.org/visitors/'.$result['image'].'" width="100" height="100"  >

                    <h3>Greenland Hall Visitors Policy.</h3>
                    <p>Every staff member is responsible for their visitors, therefore all host should make sure their visitors adhere strictly to the <a href="">Greenland Hall Visitors Policy</a></p></body></html>';





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

$message = "Login Successfull";
 // $success = "Visitor Added";
 // $succ = preg_replace('/\s+/', '_', $success);
 // workRate($dbconn,$sess);
  header("Location:welcome.php?success=$message");
}


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
        <title>Visitors Check-In</title>

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
    max-width: 450px;
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

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(12, 97, 33);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}


    </style>
</head>
<body class="center-screen">

<div class="container">
        <div class="card card-container">

            <form class="form-signin" method="POST" action="">
                 <h2 class="text-success"><b>CHECK-IN</b></h2>
                <br> <br>
                <input type="number" name="phone" class="form-control" placeholder="Phone Number" required autofocus>

                <div class="card" >

                    <p class="card-text" style="text-align: justify;">Have you been here before and have been registered electronically?
                don't worry you don't have to provide all details again. Just provide us with your phone number and whom you are here to see.</p>

                </div>

                <button class="btn btn-lg btn-primary btn-block btn-signin" name="submit" type="submit">Check-In</button>
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
        $( document ).ready(function() {
    // DOM ready

    // Test data
    /*
     * To test the script you should discomment the function
     * testLocalStorageData and refresh the page. The function
     * will load some test data and the loadProfile
     * will do the changes in the UI
     */
    // testLocalStorageData();
    // Load profile if it exits
    loadProfile();
});

/**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
function getLocalProfile(callback){
    var profileImgSrc      = localStorage.getItem("PROFILE_IMG_SRC");
    var profileName        = localStorage.getItem("PROFILE_NAME");
    var profileReAuthEmail = localStorage.getItem("PROFILE_REAUTH_EMAIL");

    if(profileName !== null
            && profileReAuthEmail !== null
            && profileImgSrc !== null) {
        callback(profileImgSrc, profileName, profileReAuthEmail);
    }
}

/**
 * Main function that load the profile if exists
 * in localstorage
 */
function loadProfile() {
    if(!supportsHTML5Storage()) { return false; }
    // we have to provide to the callback the basic
    // information to set the profile
    getLocalProfile(function(profileImgSrc, profileName, profileReAuthEmail) {
        //changes in the UI
        $("#profile-img").attr("src",profileImgSrc);
        $("#profile-name").html(profileName);
        $("#reauth-email").html(profileReAuthEmail);
        $("#inputEmail").hide();
        $("#remember").hide();
    });
}

/**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

/**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
function testLocalStorageData() {
    if(!supportsHTML5Storage()) { return false; }
    localStorage.setItem("PROFILE_IMG_SRC", "//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" );
    localStorage.setItem("PROFILE_NAME", "César Izquierdo Tello");
    localStorage.setItem("PROFILE_REAUTH_EMAIL", "oneaccount@gmail.com");
}
    </script>
</body>
</html>
