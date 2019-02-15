<?php
ob_start();
session_start();
include 'includes/authentication.php';
include 'includes/db.php';
include 'includes/function.php';
include ("includes/header.php");

$visitor = getSpecificData($conn,$_GET['tdata'],'id',$_GET['vdata']);
$error = [];
if (array_key_exists('update', $_POST)) {
  if(empty($_POST['name'])){
    $error['name']="Enter a name";
  }

  if(empty($_POST['email'])){
    $error['email']="Enter email";
  }

  if(empty($_POST['address'])){
    $error['address']="Enter address";
  }

  if(empty($_POST['school_category'])){
    $error['company']="Enter Category";
  }


if(empty($error)){
    $clean = array_map('trim', $_POST);
  $new['id'] = $_GET['vdata'];
    update($conn,'student',$clean,'id',$new,$_GET['ret']);
}

}
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Profile Page</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <?php foreach ($visitor as $key => $value) {
                  // code...
              ?>
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
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="styles/plugins/images/large/img1.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="styles/plugins/images/users/genu.jpg" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $value['name'] ?></h4>
                                        <h5 class="text-white"><?php echo $value['email'] ?></h5> </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1>258</h1> </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-blue"><i class="ti-twitter"></i></p>
                                    <h1>125</h1> </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-danger"><i class="ti-dribbble"></i></p>
                                    <h1>556</h1> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form action="" method="post" class="form-horizontal form-material">
                                <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Johnathan Doe" name="name" class="form-control form-control-line" value="<?php echo $value['name'] ?>">  </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="johnathan@admin.com" name="email" value="<?php echo $value['email'] ?>" class="form-control form-control-line"  id="example-email"> </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Phone</label>
                                    <div class="col-md-12">
                                        <input type="number"  class="form-control form-control-line" name="phone" value="<?php echo $value['phone'] ?>"> </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line" name="address"><?php echo $value['address'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">School Category(<?php echo $value['school_category'] ?>)</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="school_category">
                                            <option value="" >--School Category--</option>
                                            <option>Primary</option>
                                            <option>Secondary</option>

                                        </select>

                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <!-- <button class="btn btn-success"></button> -->
                                        <input class="btn btn-success" type="submit" name="update" value="Update Profile">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              <?php } ?>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <?php

            include ("includes/footer.php");

            ?>
