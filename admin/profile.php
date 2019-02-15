<?php
ob_start();
session_start();
include 'includes/authentication.php';
include 'includes/db.php';
include 'includes/function.php';
include ("includes/header.php");



$visitor = getSpecificData($conn,$_GET['tdata'],'id',$_GET['vdata']);
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

    $ver['a'] = compressImage3($_FILES,'upload',90, 'uploads/' );
    $clean = array_map('trim',$_POST);

    $new['id'] = $_GET['vdata'];
    $add['image'] = $ver['a'];



    $final = $add + $clean;
    // $final =  $clean;



update2($conn,'visitors',$final,'image',$new,$_GET['ret']);


    // addProfile($conn, $clean, $ver,$image_1,$hash_id);
  }



}


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
    $clean = array_map('trim', $_POST);
  $new['id'] = $_GET['vdata'];
    update($conn,'visitors',$clean,'id',$new,$_GET['ret']);
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
                                      <?php if($value['image'] !== NULL){
                                     ?>
                                        <a href="javascript:void(0)"><img src="../<?php echo $value['image'] ?>" class="thumb-lg img-circle" alt="img"></a>
                                      <?php   }else{

                                      ?>

                                      <form action="" method="post" enctype="multipart/form-data" role="form">
                                        <!-- <h2 class="title-2">UPLOAD IMAGE</h2> -->


                                        <div class="form-group">
                                          <?php $display = displayErrors($error, 'upload');
                                          echo $display ?>
                                             <input type="file" name="upload" accept="image/*" capture="camera"><!-- this should be accessing device camera -->
                                         </div>

                                        <input class="btn btn-common" name="image" type="submit" value="Upload">
                              				</form>


                                    <?php } ?>
                                        <h4 class="text-white"><?php echo $value['name'] ?></h4>
                                        <h5 class="text-white"><?php echo $value['email'] ?></h5> </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1><?php echo $value['phone'] ?></h1> </div>
                                
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
                                    <label class="col-md-12">Company</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="company" name="company" value="<?php echo $value['company'] ?>" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line" name="address"><?php echo $value['address'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Purpose of Visit(<?php echo $value['purpose'] ?>)</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="purpose">
                                          <option value="Official">Official</option>
                                          <option value="Contractor">Contractor</option>
                                          <option value="Parent">Parent</option>
                                          <option value="Event">Event</option>
                                          <option value="Inquiry">Inquiry</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Whom to See (<?php echo $value['whom'] ?>)</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="whom">
                                          <option value="">
                                          --Whom to See--
                                          </option>
                                          <?php getEmployee($conn); ?>
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
