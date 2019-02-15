<?php
ob_start();
session_start();
include 'includes/db.php';
include 'includes/function.php';
include 'includes/authentication.php';
include ("includes/header.php");
$error = [];
if(array_key_exists('submit', $_POST)){
  if(empty($_POST['name'])){
    $error['name']="Enter a name";
  }

  

  if(empty($_POST['address'])){
    $error['address']="Enter address";
  }

  if(empty($_POST['school_category'])){
    $error['school_category']="Enter category";
  }

  if(empty($_POST['staff_status'])){
    $error['staff_status']="Enter staff_status";
  }

  if(empty($error)){
    insert($conn, 'employee', $_POST);
    $success = "Employee Added";
    // $succ = preg_replace('/\s+/', '_', $success);
    // workRate($dbconn,$sess);
    header("Location:View-Employee.php?success=$success");
  }
}

?>

<!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Add Employee</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Add Employee</li>
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
                            <h3 class="box-title">New Employee</h3>

                        </div>
<form class="needs-validation" action="" method="post" >
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">Name</label>
      <div class="text-danger">
        <?php $display = displayErrors($error, 'name');
        echo $display ?>
      </div>
      <input type="text" name="name" class="form-control" id="validationCustom01" placeholder="Full name" value="" required>

    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">Email</label>
      
      <input type="email" name="email" class="form-control" id="validationCustom02" placeholder="Email" value="">

    </div>

  </div>
  <div class="form-row">

    <div class="col-md-6 mb-3">
      <label for="validationCustom03">Phone</label>
      <div class="text-danger">
        <?php $display = displayErrors($error, 'phone');
        echo $display ?>
      </div>
      <input type="number" name="phone" class="form-control" id="validationCustom03" placeholder="Phone" required>

    </div>

    <div class="col-md-6 mb-3">
      <label for="validationCustom04">Job Title</label>
      <div class="text-danger">
        <?php $display = displayErrors($error, 'address');
        echo $display ?>
      </div>
      <textarea name="address" class="form-control" id="validationCustom04" required="">

      </textarea>


    </div>
    <div class="col-md-6 mb-3">
      <label for="validationCustom05">School Category</label>
      <div class="text-danger">
        <?php $display = displayErrors($error, 'school_category');
        echo $display ?>
      </div>
      <select name="school_category" class="form-control" id="inlineFormCustomSelect" required="">
        <option selected>Choose...</option>
        <option >Primary</option>
        <option >Secondary</option>
        <option >Pre school</option>
      </select>

    </div>

    <div class="col-md-6 mb-3">
      <label for="validationCustom05">Staff Status</label>
      <div class="text-danger">
        <?php $display = displayErrors($error, 'staff_status');
        echo $display ?>
      </div>
      <select name="staff_status" class="form-control" id="inlineFormCustomSelect" required="">
        <option selected>Choose...</option>
        <option >Academic</option>
        <option >Non-Academic</option>
      </select>

    </div>


  </div>
  <div class="form-group">
    <!-- <div class="form-check">
      <button class="btn " name="submit" type="submit"> </button>
    </div> -->
  </div><br>
  <div class="text-center">
    <input class="btn btn-primary text-center" type="submit" name="submit" value="Submit form">
          <!-- <button  type="submit">Submit form</button> -->
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
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->


<?php

include ("includes/footer.php");

?>
