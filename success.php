<?php
session_start();
 ?>
 <!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  <meta http-equiv="refresh" content="5;URL=index.php" />
        <title>GREENLAND HALL VISITORS</title>

        <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

     <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <style>
        .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
.center-screen {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
}
    </style>
</head>
<body class="center-screen">
<div class="container">


    <?php if (isset($_GET['success'])){
    $msg = $_GET['success'];

      echo '
                            <h2 class="btn btn-success" style="color: #ffffff"> '.$msg.' </h2>
                        ';
    } ?>
    <?php if (isset($_GET['error'])){
    $msg = $_GET['error'];

      echo '<div class="row">
                <div class="col-md-12">
                    <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="btn btn-block btn-danger" style="color: #ffffff"> '.$msg.' </h2>
                        </div>
                    </div>
                </div>
            </div>';
            die;
    } ?>







<div class="d-flex justify-content-around">
    <?php if (isset($_SESSION['name']) && isset($_SESSION['login']) && isset($_SESSION['whom'])){ ?>

<h1>Welcome to Greenland Hall</h1>
</div>

<div class="d-flex justify-content-around">
    <h2><b> <?php
            echo  $_SESSION['name'];
            unset($_SESSION['name']);
            unset($_SESSION['login']);
        ?></b></h2>
</div>

<br><br>

<div class="d-flex justify-content-around">
<p class="text-center"> <?php
        echo $_SESSION['whom']. " has been notified of your arrival and will be with you shortly. Please remain at the reception except instructed otherwise.";
       unset($_SESSION['whom']);
        unset($_SESSION['whom']);
    ?></p>
</div>

<br><br>
<?php } ?>











</div>

<footer class="d-flex justify-content-around">
<h6 style="position: fixed; bottom: 0 ">&copy;  Greenland Educational Service 2019</h6>
</footer>



 <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
