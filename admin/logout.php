<?php
ob_start();
session_start();
unset($_SESSION['id']);
session_destroy();
header("Location:../admin_login.php");
die();