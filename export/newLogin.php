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

if(isset($_SESSION['phone'])){
  $phone = $_SESSION['phone'];
}else{
  header("Location:login.php");
}
$error = [];
if(array_key_exists('submit', $_POST)){

  if(empty($_POST['whom'])){
    $error['whom']="Enter Whom to see";
  }
  if(empty($_POST['purpose'])){
    $error['purpose']="Enter Purpose of Visit";
  }

  if(empty($error)){
  $result = newLogin($conn, $_POST,$phone);
  
   

    $detail = getEmployeeByName($conn,$result);
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
                    <p></p>
                    
                    <h3>Greenland Hall Visitors Policy.</h3>
                    <p>Every staff member is responsible for there visitors, therefore all host should make sure their visitors adhere strictly to the <a href="">Greenland Hall Visitors Policy</a></p>
                </body>
            </html>';





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
        <title>CHECK-IN</title>

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
    <style>
    .how-section1{
    margin-top:-15%;
    padding: 10%;
}
.how-section1 h4{
    color: #ffa500;
    font-weight: bold;
    font-size: 30px;
}
.how-section1 .subheading{
    color: #3931af;
    font-size: 20px;
}
.how-section1 .row
{
    margin-top: 10%;
}
.how-img 
{
    text-align: center;
}
.how-img img{
    width: 40%;
}

</style>
</head>
<body class="center-screen">


    <div class="container">
        <div class="card card-container">

            <form class="form-signin" method="POST" action="" enctype="multipart/form-data">
                
                <div><img width="200" height="200" class="rounded-circle" src="<?php echo $_SESSION['image']; unset($_SESSION['image']); ?>"></div>
                
                 <h2><b>Hi <?php echo ucwords($_SESSION['name']); ?></b></h2>
                 <p>Welcome Back</p>
                <br>




                <?php $display = displayErrors($error, 'purpose');
              echo $display ?>
                <select class="form-control" name="purpose" required>
                    <option class="hidden"  selected disabled>
                                                                        <?php
                                                                            if(isset($_POST['purpose']))
                                                                            {
                                                                                echo $_POST['purpose'];

                                                                            }else{
                                                                              echo "-- Why are you visiting? --";
                                                                            }
                                                                            ?>
                    </option>
                    <option value="Official">Official</option>
                    <option value="Contractor">Contractor</option>
                    <option value="Parent">Parent</option>
                    <option value="Event">Event</option>
                    <option value="Inquiry">Inquiry</option>
                </select>

                <br>
                <?php $display = displayErrors($error, 'whom');
              echo $display ?>
                <select class="form-control" name="whom" required>
                    <option class="hidden"  selected disabled><?php
                                                                            if(isset($_POST['whom']))
                                                                            {
                                                                                echo $_POST['whom'];

                                                                            }else{
                                                                              echo "-- Who would you like to see? --";
                                                                            }
                                                                            ?> </option>
                    <?php getEmployee($conn); ?>
                </select>

               <br>







                <button class="btn btn-lg btn-primary  btn-signin" name="submit" type="submit">Check-In</button>
            </form><!-- /form -->
            
            <div class="row">
                <div class="col-sm-12">
        		    <div class="card text-center shadow-lg" style="width: 18rem; background-color: #011100;">
        			      
        			        	<h4 class="text-center"><a href="register.php" style="color: #ffffff"><strong><i class="fas fa-times-circle"></i>&nbsp; This is not me </strong></a> </h4>
        			      
        		    </div>
        	  </div>
        </div>
        
        
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
