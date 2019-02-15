<?php
ob_start();
session_start();
include 'includes/db.php';
include 'includes/function.php';
include 'includes/authentication.php';
include ("includes/header.php");
//get all table data
$visitor = getAllData($conn,'visitors');
$pre_visitor = getSpecificData($conn,'visitors','type',2);
$front_visitor = getSpecificData($conn,'visitors','type',1);


//get all data count
$visitor_count = count($visitor);
$pre_visitor_count = count($pre_visitor);
$front_visitor_count = count($front_visitor);

?>
<!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4> </div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
                
                
                 <!-- .row -->
                <div class="row">
                  
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                      <a href="reports.php">  <div class="white-box analytics-info" style="background-color: #42f4ee">
                            <h3 class="box-title"><strong style="font-size: 20px;">Generate Reports</strong></h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-bars" style="color: #ffffff"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-white"></i> <span class="counter text-white"><?php echo $visitor_count ?></span></li>
                            </ul>
                        </div>
                      </a>
                    </div>
                    
                </div>
                <!--/.row -->
                
                
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
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                      <a href="Visitors-log.php">  <div class="white-box analytics-info" style="background-color: #e1e295">
                            <h3 class="box-title"><strong style="font-size: 20px;">All Visitor</strong></h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-building" style="color: #ffffff"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-white"></i> <span class="counter text-white"><?php echo $visitor_count ?></span></li>
                            </ul>
                        </div>
                      </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <a href="pre-registered-visitors-log.php"><div class="white-box analytics-info" style="background-color: #9de295">
                            <h3 class="box-title"><strong style="font-size: 20px;">Pre Registered Visitors</strong></h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-sign-in" style="color: #ffffff"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-white"></i> <span class="counter text-white"><?php echo $pre_visitor_count ?></span></li>
                            </ul>
                        </div>
                    </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                       <a href="Front-Desk-Visitors-Log.php"> <div class="white-box analytics-info" style="background-color: #d495e2">
                        	<h3 class="box-title"><strong style="font-size: 20px;">Front Desk Visitors</strong></h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-sign-out" style="color: #ffffff"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-white"></i> <span class="counter text-white"><?php echo $front_visitor_count ?></span></li>
                            </ul>
                        </div>
                        </a>
                    </div>
                </div>
                <!--/.row -->
                
                
               




 </div>
            </div>
            <!-- /.container-fluid -->
<?php

include ("includes/footer.php");
?>
