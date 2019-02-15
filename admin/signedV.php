<?php
session_start();

include 'includes/authentication.php';
include 'includes/db.php';
include 'includes/function.php';
include ("includes/header.php");
if(isset($_GET['today'])){
    $visitor = getSpecificDataToday($conn,'visitors','status','signed out');
}else{
    $visitor = getSpecificData($conn,'visitors','status','signed out');
}


//for serial numbering;
$dev = [];
for($var=1;  $var <= count($visitor); $var++  ){
 // echo $var;
 $dev[$var] = $var;
}
$deb['num'] = $dev;


//rewriting array
$newArray = array();
$i=1;
foreach($visitor as $value){
  $newArray[$i] = $value;
  $newArray[$i]['sn'] = $deb["num"][$i];
  $i++;
}
//populating with rewritten array
$visitor = $newArray;
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
                        <h4 class="page-title">Signed Out Visitors</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Signed Out Visitors</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
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

                     <div class="col-sm-12">
                       <script src='print.min.js'></script>
                   <script type="text/javascript">
                   function pront(){
                     printJS({ printable: 'fedit',documentTitle:'GLH VISITORS LOG',type:'html',headerStyle:'font-weight:300;',targetStyle:['height','font-family','float','width','content','clear','color','margin-right','margin-left','text-align','font-size','font-weight','vertical-align','margin-top','border','background-color','position','left','right'],honorColor:'true',font_size:'16pt'});
                   }
                   </script>
                       <!-- <div  id="fedit" style="width:100%; " class=""> -->
                       <div  id="fedit" style="width:100%; display: none " class="">
                         <div style="float:right" class="">
                           <p>Signed-Out Visitors List</p>
                           <p style="color:red;"><?php $this_date = date("d-m-Y"); if(isset($_GET['today'])){ echo $this_date; }else{ echo "ALL"; } ?></p>
                         </div>  <img style="float:left;" src="logo.png" alt="">
                         <div style="width:100%; " class="table-responsive">
                             <table style="width:100%;" class="table">
                                 <thead>
                                     <tr>
                                         <th>SN</th>
                                         <th>TYPE</th>
                                         <th>TIME IN</th>
                                         <th>TIME OUT</th>
                                         <th>NAME AND ADDRESS</th>
                                         <th>ID NO.</th>
                                         <th>NAME</th>
                                         <th>LOCATION</th>


                                     </tr>
                                 </thead>
                                 <tbody>
                                   <?php foreach ($visitor as $key => $value) {
                                   $employ = getEmployeeByName($conn,$value['whom'])
                                     // code...
                                    ?>
                                     <tr>
                                         <td><?php echo $value['sn'] ?></td></td>
                                         <td><?php echo $value['purpose'] ?></td>
                                         <td><?php echo $value['last_login'] ?></td>
                                         <td><?php echo $value['last_logout'] ?></td>
                                         <td><?php echo $value['name'] ?>, <?php echo $value['address'] ?></td>
                                         <td><?php echo $employ['id'] ?></td>
                                         <td><?php echo $employ['name'] ?></td>
                                         <td><?php echo $employ['school_category'] ?></td>
                                            </tr>
                                     </tr>
                                   <?php } ?>

                                 </tbody>
                             </table>
                         </div>
                       </div>
                          <a class="btn btn-primary" onclick="pront()">Print Log</a>
                        <div class="white-box">
                            <h3 class="box-title">Signed Out Visitors Log</h3>
                            <div class="table-responsive">

                        <div class="how-section1">
                                                        <?php foreach ($visitor as $key => $value) {
                                        // code...
                                       ?>

                        <div class="row col-md-6">
                            <div class="col-md-6 how-img">
                                <img src="../<?php echo $value['image'] ?>" class="rounded-circle img-fluid" alt="" style="width:80px; height:80px;"/>
                            </div>
                            <div class="col-md-6">
                                 <b><?php echo $value['name'] ?></b>
                                 <p class=" text-danger"><?php echo $value['status'] ?></p>
                                  <p class=" text-secondary"><?php echo $value['last_logout']." ".$value['last_login_date'] ?></p>
                            </div>
                    </div>


                                                         <?php } ?>



                    </div>
                            </div>
                        </div>
                    </div>







                </div>
                <!-- /.row -->



            </div>
            <!-- /.container-fluid -->


        </div>
<?php

include ("includes/footer.php");

?>
