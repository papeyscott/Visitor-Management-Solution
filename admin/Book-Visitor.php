<?php
ob_start();
session_start();
    	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.0.6/src/Exception.php';
require 'PHPMailer-6.0.6/src/PHPMailer.php';
require 'PHPMailer-6.0.6/src/SMTP.php';

include 'includes/db.php';
include 'includes/function.php';
include 'includes/authentication.php';
include ("includes/header.php");
$error = [];
if(array_key_exists('submit', $_POST)){
  if(empty($_POST['name'])){
    $error['name']="Enter a name";
  }

  if(empty($_POST['email'])){
    $error['email']="Enter email";
  }

  if(doesPhoneNumberExist($conn,$_POST['phone'])){
    $error['phone'] = "*Number already exists on our system, Please enter another phone number";
  }

  if(empty($_POST['address'])){
    $error['address']="Enter address";
  }
  if(empty($_POST['phone'])){
    $error['phone']="Enter phone";
  }

  if(empty($_POST['company'])){
    $error['company']="Enter Company";
  }

  if(empty($_POST['whom'])){
    $error['whom']="Enter Whom to see";
  }
  if(empty($_POST['purpose'])){
    $error['purpose']="EnterPurpose of Visit";
  }

  if(empty($error)){
      $new['type'] = 2;
      $post = $new + $_POST ;
    insert($conn, 'visitors', $post);





     $subject = "Appointment Confirmation"; // subject of your email

$toAddress = $_POST['email']; ; //To whom you are sending the mail.
$message   = <<<EOT
    <html>
       <body>
          <h>Hello</h>
          <p>This is to certify that your appointment has been confirmed.</p>
          <p> Please note that you will be required to electronically log in with your phone number at the reception.</p>
          <p> If this is your first time visiting you will take a selfie. </p>
          <p> Thanks you</p>
       </body>
    </html>
EOT;






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


    $success = "Visitor Added";
    // $succ = preg_replace('/\s+/', '_', $success);
    // workRate($dbconn,$sess);
    header("Location:Visitors-Manager.php?success=$success");
}


  }
}

?>

<!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Book A Visitor</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Book a Visitor</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                  <?php if (isset($_GET['success'])){
                  $msg = $_GET['success'];

                    echo '<div class="col-md-12">
                  <div class="inner-box posting">
                  <div class="alert alert-success alert-lg" role="alert">
                  <h2 class="postin-title">✔ Successfull! '.$msg.' </h2>
                  <p>Thank you</p>
                  </div>
                  </div>
                  </div>';
                  } ?>
                  <?php if (isset($_GET['error'])){
                  $msg = $_GET['error'];

                    echo '<div class="col-md-12">
                  <div class="inner-box posting">
                  <div class="alert alert-danger alert-lg" role="alert">
                  <h2 class="postin-title">error! '.$msg.' </h2>

                  </div>
                  </div>
                  </div>';
                  } ?>
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">New Visitor</h3>
                        </div>

                    <form action="" method="post" class="needs-validation" >
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Name</label>
                                     <div class="text-danger">
                                        <?php $display = displayErrors($error, 'name');
                                        echo $display ?>
                                     </div>
                                <input name="name" type="text" class="form-control" id="validationCustom01" placeholder="Full name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Email</label>
                                    <div class="text-danger">
                                        <?php $display = displayErrors($error, 'email');
                                        echo $display ?>
                                    </div>
                                <input type="email" name="email" class="form-control" id="validationCustom02" placeholder="Email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Company</label>
                                    <div class="text-danger">
                                        <?php $display = displayErrors($error, 'company');
                                        echo $display ?>
                                    </div>
                                <input type="text" name="company" class="form-control" id="validationCustom03" placeholder="Company" value="<?php if(isset($_POST['company'])){ echo $_POST['company'];}?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Phone</label>
                                    <div class="text-danger">
                                        <?php $display = displayErrors($error, 'phone');
                                        echo $display ?>
                                    </div>
                                <input type="number" name="phone" class="form-control" id="validationCustom03" placeholder="Phone" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone'];}?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom04">Address</label>
                                    <div class="text-danger">
                                        <?php $display = displayErrors($error, 'address');
                                        echo $display ?>
                                    </div>
                                <textarea name="address" class="form-control" id="validationCustom04" required=""><?php if(isset($_POST['address'])){ echo $_POST['address'];}?></textarea>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Purpose of visit</label>
                                    <div class="text-danger">
                                        <?php $display = displayErrors($error, 'purpose');
                                        echo $display ?>
                                    </div>
                                <select onchange="specify(this.name, this);" name="purpose" class="form-control" id="inlineFormCustomSelect" required="">
                                    <option class="hidden"  selected disabled value="<?php if(isset($_POST['purpose'])){ echo $_POST['purpose'];}?>">Purpose of visit</option>
                                    <option value="Official">Official</option>
                                    <option value="Contractor">Contractor</option>
                                    <option value="Parent">Parent</option>
                                    <option value="Event">Event</option>
                                    <option value="Inquiry">Inquiry</option>
                                      <option value="others">Others</option>
                                </select>
                                <div style="margin-top:5px" id="hold">
                              </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Whom to See</label>
                                    <div class="text-danger">
                                        <?php $display = displayErrors($error, 'whom');
                                        echo $display ?>
                                    </div>
                                <select name="whom" class="form-control" id="inlineFormCustomSelect" required="">
                                    <option class="hidden"  selected disabled value="<?php if(isset($_POST['whom'])){ echo $_POST['whom'];}?>">Whom to see</option>
                                      <?php getEmployee($conn); ?>
                                </select>
                            </div>
                        </div>
                        <hr>

                            <div class="col-md-12 text-center">
                                <input class="btn btn-primary text-center" type="submit" name="submit" value="Submit form">
                            </div>




                    </form>

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
<script type="text/javascript">
localStorage.removeItem('elementName');

function specify(name,element){
  if(!localStorage.getItem('elementName')){
      localStorage.setItem('elementName',name);
  };

if(element.value =='others' ){
  element.name = "";
  document.getElementById('hold').innerHTML = '<input type="test" name="'+name+'" class="form-control" placeholder="Specify*" value="" required>';
}else{
  element.name = localStorage.getItem('elementName');
  document.getElementById('hold').innerHTML = '';
}
}
</script>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

<?php

include ("includes/footer.php");

?>
