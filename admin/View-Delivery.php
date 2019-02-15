<?php
ob_start();
session_start();
include 'includes/authentication.php';
include 'includes/db.php';
include 'includes/function.php';
include ("includes/header.php");
$employee = getAllData($conn,'delivery');
//for serial numbering;
$dev = [];
for($var=1;  $var <= count($employee); $var++  ){
 // echo $var;
 $dev[$var] = $var;
}
$deb['num'] = $dev;


//rewriting array
$newArray = array();
$i=1;
foreach($employee as $value){
  $newArray[$i] = $value;
  $newArray[$i]['sn'] = $deb["num"][$i];
  $i++;
}
//populating with rewritten array
$employee = $newArray;
// var_dump($newArray);
// die;

?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Delivery</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Delivery</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!-- .row -->
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
                 <!--   <div class="col-lg-4 col-sm-6 col-xs-12">
                        <a href="Add-Employee.php">

                            <div class="white-box" style="background-color: #95e297">
                            <h3 class="box-title text-center"><strong style="font-size: 25px;"> ADD EMPLOYEE </strong></h3>

                        </div>
                        </a>
                    </div>-->

                </div>
                <!--/.row -->

                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Delivery</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><a href="profile.php">Name</a></th>
                                            <th>Company</th>
                                            <th>Vehicle Number</th>
                                            <th>Item</th>
                                            <th>Whom to see</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                          <?php foreach ($employee as $key => $value) {
                                            // code...
                                          ?>
                                          <tr>
                                            <td><?php echo $value['sn'] ?></td></td>
                                            <td><?php echo $value['name'] ?></td></td>
                                            <td><?php echo $value['company'] ?></td>
                                            <td><?php echo $value['vnumber'] ?></td>
                                            <td><?php echo $value['item'] ?></td>
                                            <td><?php echo $value['whom'] ?></td>
                                            <td><?php echo $value['address'] ?></td>
                                            <th><?php echo $value['date_created'] ?></th> 
                                        <!--    <?php $urii = explode("/", $_SERVER['REQUEST_URI']);
                                              $retUrl = end($urii); ?>
                                             <td> <a href="employee_profile.php?tdata=employee&vdata=<?php echo $value['id'] ?>
                                                    &ret=<?php echo $retUrl ?>">  
                                                        <i class="btn btn-warning fa fa-pencil" aria-hidden="true"></i>
                                            </a></td>-->
                                          <!--      <td><a href="delete.php?tdata=employee&vdata=<?php echo $value['id'] ?>
                                                    &ret=<?php echo $retUrl ?>">
                                                        <i class="btn btn-danger fa fa-trash" aria-hidden="true"></i>
                                                </a></td>-->
                                                </tr>
                                            <?php } ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
<?php

include ("includes/footer.php");

?>
