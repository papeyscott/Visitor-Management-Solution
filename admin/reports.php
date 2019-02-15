<?php
session_start();

include 'includes/authentication.php';
include 'includes/db.php';
include 'includes/function.php';
include ("includes/header.php");
if(isset($_GET['today'])){
 $visitor =   getAllDataToday($conn,'visitors');
}else{
    $visitor = getAllData($conn,'visitors');
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
                        <h4 class="page-title">Genrate Reports</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="http://www.greenlandhall.org/visitors/admin/index.php">Dashboard</a></li>
                            <li class="active">generate reports</li>
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
                      <!-- <div  id="fedit" style="width:100%;" class=""> -->
                   

                         <div class="">
                           <div class="col-md-4">
                             <p>Filter:</p>
                             <select id='selected' onchange="selectType(this.value)" class="form-control " name="print">
                               <option>--Select Query--</option>
                               <option value="all">All</option>
                               <option value="date">By Specific Date</option>
                               <option value="btdate">By Date Range</option>
                               <option value="type">By Type</option>
                               <option value="date/type">By Date And Type</option>
                             </select>
                           </div>

                           <form class="" action="index.html" method="post">
                             <div class="col-md-4"  id="handle">
                                 <p>Click To</p>
<a class="btn btn-primary" onclick="pront()">Print Log</a>

                             </div>

                          
                             <div class="col-md-3"  id="extra">


                             </div>
                             <div class="clearfix">

                             </div>
                             <div class="clearfix">

                             </div>
                           </form>



                         </div>
                         <br>
                        <div  class="white-box">
                               <div  id="fedit" style="width:100%" class="">
                        <div style="float:right" class="">
                          <p>Visitors List</p>
                          <p id="indicator" style="color:red;"><?php $this_date = date("d-m-Y"); if(isset($_GET['today'])){ echo $this_date; }else{ echo "ALL"; } ?></p>
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
                                <tbody id="tableBorder">
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
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <script type="text/javascript">
            function selectType(value){
              if(value == "all"){
                location.reload();
                var html = '<p>Click To</p><a class="btn btn-primary" onclick="pront()">Print Log</a>';
                document.getElementById("handle").innerHTML= html;
              }
              if(value == "date"){
                var html = '<p>Date</p><input class="form-control" name="date" type="date" onchange="fetch(this)" >';
                document.getElementById("handle").innerHTML= html;
              }
              if(value == "type"){
                var html = '<p>Type</p><select onchange="fetch(this);" class="form-control" name="type" required><option >--Select Type--</option><option value="Official">Official</option><option value="Contractor">Contractor</option><option value="Parent">Parent</option><option value="Event">Event</option><option value="Inquiry">Inquiry</option></select>';
                document.getElementById("handle").innerHTML= html;
              }
              if(value == "btdate"){
                // var html = '<select onchange="fetch(this);" class="form-control" name="type" required><option >--Select Type--</option><option value="Official">Official</option><option value="Contractor">Contractor</option><option value="Parent">Parent</option><option value="Event">Event</option><option value="Inquiry">Inquiry</option></select>';
                var html = '<p>From</p><input class="form-control" name="date" type="date" onchange="callDatebt(this.value)" >';
                document.getElementById("handle").innerHTML= html;
              }
              if(value == "date/type"){
                var html = '<p>Type</p><select onchange="callDate(this.value);" class="form-control" name="purpose" required><option >--Select Type--</option><option value="Official">Official</option><option value="Contractor">Contractor</option><option value="Parent">Parent</option><option value="Event">Event</option><option value="Inquiry">Inquiry</option></select>';
                document.getElementById("handle").innerHTML= html;
              }
            }

            function callDate(value){

                var html = '<p>Date</p><input class="form-control" name="both" id='+value+' type="date" onchange="fetchBoth(this)" >';
              document.getElementById('extra').innerHTML = html;
            }   
            function callDatebt(value){

                var html = '<p>To</p><input class="form-control" name="range" id='+value+' type="date" onchange="fetchBoth(this)" >';
              document.getElementById('extra').innerHTML = html;
            }

            function fetch(value){
              setPrint(value);
            }
            function fetchBoth(value){
              setPrint2(value);
            }

            function setPrint(query){
              // console.log(id);
              var url = 'select.php';
              var method = 'POST';
              var params = 'data=' + query.value;
              params += '&type=' + query.name;

              executeSend1(url,method,params,query);
            }

            function setPrint2(query){
              // console.log(id);
              var url = 'select.php';
              var method = 'POST';
              var params = 'data=' + query.value;
              params += '&data2=' + query.id;
              params += '&type=' + query.name;

              executeSend1(url,method,params,query);
            }

            function executeSend1(url, method,params,query){
              var xhr = new XMLHttpRequest();
              xhr.onreadystatechange = function(){
                if(xhr.readyState == 4){

                  var res = xhr.responseText;
                    // document.getElementById(query).value = res;
                  console.log(res);
                  document.getElementById("extra").innerHTML= '';

                  document.getElementById('tableBorder').innerHTML = res;
                  var html = '<p>Click To</p><a class="btn btn-primary" onclick="pront()">Print Log</a>';
                  document.getElementById("handle").innerHTML= html;
                  document.getElementById("extra").innerHTML= '';
                  $('#selected').prop('selectedIndex', 0);

                  if(query.name == "date"){
                      $('#selected').prop('selectedIndex', 0);
                    document.getElementById("indicator").innerHTML= query.value;
                    //  document.getElementById("handle").innerHTML= '';
                  document.getElementById("extra").innerHTML= '';
                  
                  }
                  if(query.name == "type"){
                        $('#selected').prop('selectedIndex', 0);
                      document.getElementById("indicator").innerHTML= query.value;
                            // document.getElementById("handle").innerHTML= '';
                  document.getElementById("extra").innerHTML= '';
                  }
                  if(query.name == "both"){
                        $('#selected').prop('selectedIndex', 0);
                      document.getElementById("indicator").innerHTML= query.id +" / "+ query.value ;
                            // document.getElementById("handle").innerHTML= '';
                  document.getElementById("extra").innerHTML= '';
                  } 
                  if(query.name == "range"){
                        $('#selected').prop('selectedIndex', 0);
                      document.getElementById("indicator").innerHTML= query.id +" to "+ query.value ;
                            // document.getElementById("handle").innerHTML= '';
                  document.getElementById("extra").innerHTML= '';
                  }


                  // console.log(res['"'+'https://boardspeck.com/contest?id='+id+'"'].engagement.share_count);

                }
              }
              xhr.open(method, url, true);
              xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
              xhr.send(params);
            }





            function setBackData(data,query){
              // console.log(id);
              var url = 'suspend_status.php';
              var method = 'POST';
              var params = 'data=' + data;
              params += '&query=' + query;
              executeSend(url,method,params,query);
            }

            function executeSend(url, method,params,query){
              var xhr = new XMLHttpRequest();
              xhr.onreadystatechange = function(){
                if(xhr.readyState == 4){

                  var res = xhr.responseText;
                    document.getElementById(query).value = res;
                  console.log(res);
                  // document.getElementById('board').innerHTML = res;
                  // console.log(res['"'+'https://boardspeck.com/contest?id='+id+'"'].engagement.share_count);

                }
              }
              xhr.open(method, url, true);
              xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
              xhr.send(params);
            }

            </script>

            <!-- /.container-fluid -->
<?php

include ("includes/footer.php");

?>
