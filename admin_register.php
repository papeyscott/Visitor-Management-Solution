<?php
ob_start();
session_start();
include 'admin/includes/db.php';
include 'admin/includes/authentication.php';
include 'admin/includes/function.php';
$info = adminFullInfo($conn,$_SESSION['id']);

if($info['level'] !== "MASTER"){
  header("Location:index.php");
}


$error= [];

if(array_key_exists('submit', $_POST)){

  if(empty($_POST['firstname'])){
    $error['firstname']="Enter a firstname";
  }

  if(empty($_POST['lastname'])){
    $error['lastname']="Enter a lastname";
  }

  if(empty($_POST['email'])){
    $error['email']="Enter a email";
  }
  // if(empty($_POST['area'])){
  //   $error['area']="Enter Area of Interest";
  // }

  if(doesEmailExist($conn,$_POST['email'])){
    $error['email'] = "*Email already exists on our system, Please enter another email";
  }

  if(empty($_POST['pword'])){
    $error['pword']="Enter a password";
  }

  if(empty($_POST['cpword'])){
    $error['cpword']="Confirm password";
  }

  if($_POST['pword']!=$_POST['cpword']){
    $error['pword'] ="Password mismatch";
  }

  if(empty($error)){
    $_POST['area'] = 9;
    // die("hello ohh");

    $clean = array_map('trim', $_POST);


  doAdminRegister($conn, $clean);

$message = "Registered Successfully";

 header("Location:admin?success=$message");

  }
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Visitors Register</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

</head>
<body><br><br><br><br>
	<div class="container register">
    	<div class="row">
        	<div class="col-md-4 register-left">
            	<img src="img/logo.png" style="width: 300px; height: 150px;">
                	<h6 style="text-decoration: underline; text-transform: uppercase;"><b> Terms and Condition</b></h6>
                    	<p>I understand that information collected by Greenland Edu Serve is for security & statistics purposes only.<br> Greenland will not share your details with any third party without prior consent. </p>
            </div><br><br>
    <div class="col-md-8 register-right">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              
                <h3 class="register-heading"><strong> Welcome to Greenland </strong></h3>


            <form method="post" action="" enctype="multipart/form-data">

            <div class="row register-form">

                <div class="col-md-6">
                    <div class="form-group">
                      <?php $display = displayErrors($error, 'firstname');
                      echo $display ?>
                        <input type="text" name="firstname" class="form-control" placeholder="First Name *" value=""  />
                    </div>
                    <div class="form-group">
                      <?php $display = displayErrors($error, 'lastname');
                      echo $display ?>
                        <input type="text" name="lastname" class="form-control" placeholder="Last NAme *" value=""  />
                    </div>
                    <div class="form-group">
                      <?php $display = displayErrors($error, 'email');
                      echo $display ?>
                        <input type="email" name="email" class="form-control" placeholder="Email *" value=""/>
                    </div>
                    <div class="form-group">
                      <?php $display = displayErrors($error, 'pword');
                      echo $display ?>
                        <input type="password" name="pword" class="form-control" placeholder="Password *" value=""/>
                    </div>
                    <div class="form-group">
                      <?php $display = displayErrors($error, 'cpword');
                      echo $display ?>
                        <input type="password" name="cpword" class="form-control" placeholder="Retype Password *" value=""/>
                    </div>




				<div class="form-group row">
                <div class="col-md-12">
                    <button type="submit" name="submit" class="btn  btn-success btn-lg">Register Admin</button>
                </div>
            </div>


    		</div>
            </div>
        </form>

        </div>
    </div>
    </div>
  </div>

            </div>
</body>
</html>
