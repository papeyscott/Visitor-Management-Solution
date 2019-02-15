<?php
ob_start();
session_start();
include 'includes/db.php';
include 'includes/function.php';
include 'includes/authentication.php';
include ("includes/header.php");
//get all table data
$visitor = getAllData($conn,'visitors');
$visitor_today = getAllDataToday($conn,'visitors');
$employee = getAllData($conn,'employee');
$student = getAllData($conn,'student');

//get all data count
$student_count = count($student);
$visitor_count = count($visitor);
$visitor_count_today = count($visitor_today);
$employee_count = count($employee);

//get Specific Data
$on_visitor = getSpecificData($conn,'visitors','status','signed in');
$off_visitor = getSpecificData($conn,'visitors','status','signed out');

$on_visitor_today = getSpecificDataToday($conn,'visitors','status','signed in');
$off_visitor_today = getSpecificDataToday($conn,'visitors','status','signed out');

$academic_employee = getSpecificData($conn,'employee','staff_status','Academic');
$nacademic_employee = getSpecificData($conn,'employee','staff_status','Non-Academic');
$primary_student = getSpecificData($conn,'student','school_category','Primary');
$secondary_student = getSpecificData($conn,'student','school_category','Secondary');

$on_count = count($on_visitor);
$off_count = count($off_visitor);
$on_count_today = count($on_visitor_today);
$off_count_today = count($off_visitor_today);
$academic_count = count($academic_employee);
$nacademic_count = count($nacademic_employee);
$primary_count = count($primary_student);
$secondary_count = count($secondary_student);


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

              <!--      <a href="Visitors-log.php"><div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Visitor</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-building"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-success"></i> <span class="counter text-success"><?php echo $visitor_count; ?></span></li>
                            </ul>
                        </div>
                    </div></a>
                   <a href="signedin.php"><div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Signed In</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-sign-in"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-purple"></i> <span class="counter text-purple"><?php echo $on_count ?></span></li>
                            </ul>
                        </div>
                    </div></a>
                   <a href="signedV.php"><div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Signed Out</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-sign-out"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-info"></i> <span class="counter text-info"><?php echo $off_count ?></span></li>
                            </ul>
                        </div>
                    </div></a>-->
                </div>
                <!--/.row -->
                <div class="row">
                    <a href="Visitors-log.php?today=true"><div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Visitor (Today)</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-building"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-success"></i> <span class="counter text-success"><?php echo $visitor_count_today; ?></span></li>
                            </ul>
                        </div>
                    </div></a>
                   <a href="signedin.php?today=true"><div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Checked-In(Today)</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-sign-in"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-purple"></i> <span class="counter text-purple"><?php echo $on_count_today ?></span></li>
                            </ul>
                        </div>
                    </div></a>
                   <a href="signedV.php?today=true"><div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Checked-Out(Today)</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class="fa fa-sign-out"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-info"></i> <span class="counter text-info"><?php echo $off_count_today ?></span></li>
                            </ul>
                        </div>
                    </div></a>
                </div>

                <!-- .row -->
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Employees</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class=" fa fa-user"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-success"></i> <span class="counter text-success"><?php echo $employee_count; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Academic</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class=" fa fa-users"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-purple"></i> <span class="counter text-purple"><?php echo $academic_count ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Non Academic</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class=" fa fa-users"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-info"></i> <span class="counter text-info"><?php echo $nacademic_count ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/.row -->

                <!-- .row -->
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Students</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class=" fa fa-users"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-success"></i> <span class="counter text-success"><?php echo $student_count; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Primary</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div><i class=" fa fa-user"></i></div>
                                </li>
                                <li class="text-right"><i class=" text-info"></i> <span class="counter text-purple"><?php echo $primary_count ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Secondary</h3>
                            <ul class="list-inline two-part">
                                <li>
                                   <div><i class=" fa fa-user"></i></div>
                                </li>
                                <li class="text-right"><i class="text-danger"></i> <span class="counter text-info"><?php echo $secondary_count ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/.row -->



                <!-- ============================================================== -->
                <!-- chat-listing & recent comments -->
                <!-- ==============================================================
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="panel">
                            <div class="sk-chat-widgets">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        CHAT LISTING
                                    </div>
                                    <div class="panel-body">
                                        <ul class="chatonline">
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="javascript:void(0)"><img src="../plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="javascript:void(0)"><img src="../plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="javascript:void(0)"><img src="../plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="javascript:void(0)"><img src="../plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.container-fluid -->
<?php

include ("includes/footer.php");
?>
