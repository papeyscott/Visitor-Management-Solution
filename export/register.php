<?php
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.0.6/src/Exception.php';
require 'PHPMailer-6.0.6/src/PHPMailer.php';
require 'PHPMailer-6.0.6/src/SMTP.php';
include 'admin/includes/db.php';
include 'admin/includes/function.php';


$error = [];
if(array_key_exists('submit', $_POST)){
  $ext = ["image/jpg", "image/JPG", "image/jpeg", "image/JPEG", "image/png", "image/PNG"];

  if(empty($_FILES['upload']['name'])){
    $error['upload'] = "Please choose file";
  }
  if(!in_array($_FILES['upload']['type'], $ext)){
    $error['upload'] = " Please Take a Selfie ";
  }
  if(empty($_POST['name'])){
    $error['name']="Enter a name";
  }

  if(empty($_POST['email'])){
    $error['email']="Enter email";
  }

  if(empty($_POST['phone'])){
    $error['phone']="Enter Phone";
  }

if(doesPhoneNumberExist($conn,$_POST['phone'])){
      $error['phone'] = "*Number already exists on our system, Please enter another phone number";
    }
  if(empty($_POST['address'])){
    $error['address']="Enter address";
  }
  if(empty($_POST['company'])){
    $error['company']="Enter Company";
  }
  if(empty($_POST['whom'])){
    $error['whom']="Enter Whom to see";
  }
  if(empty($_POST['purpose'])){
    $error['purpose']="Enter Purpose of Visit";
  }

  if(empty($error)){
    $ver['a'] = compressImage($_FILES,'upload',90, 'uploads/' );
    // die($ver['a']);

      $new['type'] = 1;
        $new['image'] = $ver['a'];
      $post = $new + $_POST ;
    insert($conn, 'visitors', $post);
 $result = login($conn, $post);



$detail = getEmployeeByName($conn,$result);
  $subject = "A visitor has checked in to see you"; // subject of your email

$toAddress = $detail['email'];  //To whom you are sending the mail.
$message   = '<html>
                <body>
                    <h>Hello, '.$detail['name'].'</h>
                    <p>Your visitor, '.$_SESSION['name'].' has arrived and will be waiting for you at the reception </p>
                    <p>In an event you would not be able to attend to your visitor immediately, contact them or the reception to let them know.</p>
                    <p></p>
                    
                    <h3>Greenland Hall Visitors Policy.</h3>
                    <p>Every staff member is responsible for there visitors, therefore all host should make sure their visitors adhere strictly to the <a href="">Greenland Hall Visitors Policy</a></p></body></html>';






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
 // $success = "Visitor Added";
 // $succ = preg_replace('/\s+/', '_', $success);
 // workRate($dbconn,$sess);

}
 $message = "Registration Successfull";
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
        <title>Visitors Register</title>

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
</head>
<body class="center-screen">
    
    
    <div class="container">
        <div class="card card-container">
               
            <form class="form-signin" method="POST" action="" enctype="multipart/form-data">
                 <h2><b>REGISTER</b></h2>
                <br> 
                <?php $display = displayErrors($error, 'name');
              echo $display ?>
              
                <input type="text" name="name" class="form-control" placeholder="Full Name *" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>"  required>
                
                
                <?php $display = displayErrors($error, 'email');
              echo $display ?>
              
                <input type="email" name="email" class="form-control" placeholder="Email *" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>" required>
              
                
                <?php $display = displayErrors($error, 'phone');
                    echo $display ?>
                                    <input type="number" name="phone" class="form-control" placeholder="Phone Number" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone'];}?>" required>
                <br>
                
                <?php $display = displayErrors($error, 'company');
              echo $display ?>
              
                <input type="text" name="company" class="form-control" placeholder="Company *" value="<?php if(isset($_POST['company'])){ echo $_POST['company'];}?>" required>
                
                <?php $display = displayErrors($error, 'address');
            echo $display ?>
            
             <textarea name="address" placeholder="Address *" class="form-control"><?php if(isset($_POST['address'])){ echo $_POST['address'];}?></textarea> 
              <!--  <textarea name="address" rows="5.5" cols="47" class="form-control" placeholder="Personal Address *" required>
                                <?php if(isset($_POST['address'])){ echo $_POST['address'];}?>
                </textarea>-->
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
               
           
            <?php $display = displayErrors($error, 'upload');
            echo $display ?>
            
            <label class="btn btn-secondary">
               
                <i class="fa fa-image"></i> Tap to Take a Selfie
                <input type="file" style="display: none;" name="upload" accept="image/*" capture="camera">
            </label>
        <!--    <p> Take a Selfie 
            <input type="file"  name="upload" accept="image/*" capture="camera">
            </p>  -->  
                
                
                <div class="form-group col-md-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                  <label class="form-check-label" for="invalidCheck">
                    I understand that information collected by Greenland Educational Service is for security & statistics purposes only.
                            Greenland will not share my details with any third party without prior consent. 
                  </label>
                  <div class="invalid-feedback">
                    You must agree before submitting.
                  </div>
                </div>
            </div>
               
                <button class="btn btn-lg btn-primary btn-block btn-signin" name="submit" type="submit">Register</button>
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