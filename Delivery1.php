<?php
ob_start();
include 'admin/includes/db.php';
include 'admin/includes/function.php';


$error = [];
if(array_key_exists('submit', $_POST)){
  $ext = ["image/jpg", "image/JPG", "image/jpeg", "image/JPEG", "image/png", "image/PNG"];



  if(empty($_POST['name'])){
    $error['name']="Enter a name";
  }

  if(empty($_POST['item'])){
    $error['item']="Enter item";
  }
  if(empty($_POST['qty'])){
    $error['qty']="Enter Quantity";
  }

  if(empty($_POST['vnumber'])){
    $error['vnumber']="Enter Vehicle Number";
  }


  if(empty($_POST['company'])){
    $error['company']="Enter Company";
  }
  if(empty($_POST['whom'])){
    $error['whom']="Enter Whom to see";
  }
  if(empty($_POST['address'])){
    $error['address']="Enter Address";
  }

  if(empty($error)){
    // $ver['a'] = compressImage($_FILES,'upload',90, 'uploads/' );
    // die($ver['a']);
    $new['date_created'] = date("Y-m-d");
      // $new['type'] = 1;
        // $new['image'] = $ver['a'];
      $post = $new + $_POST ;
    insert($conn, 'delivery', $post);
    $success = "Delivered";
    // $succ = preg_replace('/\s+/', '_', $success);
    // workRate($dbconn,$sess);
    header("Location:success.php?success=$success");
  }
}
 ?>
 <!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
        <title>Deliveries</title>

        <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

     <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <style>
        .center-screen {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
}

html {
    height: 100%;
    background-repeat: no-repeat;
   /* background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
}

.card-container.card {
    max-width: 550px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(12, 97, 33);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}





    </style>



<style type="text/css">
* {margin:0;padding:0;}
</style>


</head>
<body class="center-screen">


    <div class="container">
        <div class="card card-container">

            <form class="form-signin" method="POST" action="" enctype="multipart/form-data">
                 <h2><b>DELIVERY</b></h2>
                <br>
                <?php $display = displayErrors($error, 'name');
              echo $display ?>
                <input type="text" name="name" class="form-control" placeholder="Full Name *" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>"  required>

                <?php $display = displayErrors($error, 'company');
              echo $display ?>
                <input type="text" name="company" class="form-control" placeholder="Courier/Company *" value="<?php if(isset($_POST['comapny'])){ echo $_POST['comapny'];}?>" required>

                 <?php $display = displayErrors($error, 'address');
            echo $display ?>
            
            <textarea name="address" placeholder="Address *" class="form-control"><?php if(isset($_POST['address'])){ echo $_POST['address'];}?></textarea>
                
           <br>



                <?php $display = displayErrors($error, 'vnumber');
                    echo $display ?>
                <input type="text" name="vnumber" class="form-control" placeholder="Vehicle Registration Number *" value="<?php if(isset($_POST['vnumber'])){ echo $_POST['vnumber'];}?>" required>
               




                <?php $display = displayErrors($error, 'item');
              echo $display ?>


                <select onchange="specify(this.name, this);" class="form-control" name="item" required>
                    <option class="hidden"  selected disabled>
                                                                        <?php
                                                                            if(isset($_POST['item']))
                                                                            {
                                                                                echo $_POST['item'];

                                                                            }else{
                                                                              echo "-- Item to Deliver ? --";
                                                                            }
                                                                            ?>
                    </option>
                    <option value="Parcel">Parcel</option>
                    <option value="Letter">Letter</option>
                    <option value="Food">Food, Water or Groceries</option>
                    <option value="Book">Book and Stationary</option>
                    <option value="Construction">Construction Material</option>
                    <option value="others">Others</option>
                </select>
                  <div style="margin-top:5px" id="hold">
                </div><br>
                
                
                <?php $display = displayErrors($error, 'qty');
                    echo $display ?>
                <input type="number" name="qty" class="form-control" placeholder="Quantity *" value="<?php if(isset($_POST['qty'])){ echo $_POST['qty'];}?>" required>
               
                <br>
                
                <?php $display = displayErrors($error, 'whom');
              echo $display ?>
              
                <select class="form-control" name="whom" required>
                    <option class="hidden"  selected disabled><?php
                                                                            if(isset($_POST['whom']))
                                                                            {
                                                                                echo $_POST['whom'];

                                                                            }else{
                                                                              echo "-- Who would you like to see? --";
                                                                            }
                                                                            ?> </option>
                    <?php getEmployee($conn); ?>
                </select>
<br>
               
              
<br>










                <button class="btn btn-primary btn-signin" name="submit" type="submit">Deliver</button>
            </form><!-- /form -->

        </div><!-- /card-container -->
    </div><!-- /container -->




<footer class="d-flex justify-content-around">
<h6 style="position: static; bottom: 0 "> Greenland Educational Service &copy; 2019</h6>
</footer>


 <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
localStorage.removeItem('elementName')
window.onload=function() {
var other = document.getElementById('other');
other.style.display = 'none';
document.form1.select1.onchange = function() {
    other.style.display =(this.value=='other')? '' : 'none';
    };
};
function specify(name,element){
  if(!localStorage.getItem('elementName')){
      localStorage.setItem('elementName',name);
  };

if(element.value == 'Construction' || element.value == 'Food' || element.value =='Book' ){
  element.name = "";
  document.getElementById('hold').innerHTML = '<input type="test" name="'+name+'" class="form-control" placeholder="Specify*" value="" required>';
}else{
  element.name = localStorage.getItem('elementName');
  document.getElementById('hold').innerHTML = '';
}
}
</script>
</body>
</html>
