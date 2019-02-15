<?php

ob_start();
session_start();
include 'includes/db.php';
include 'includes/function.php';
include 'includes/authentication.php';

if(!isset($_GET['tdata']) && !isset($_GET['vdata']) && !isset($_GET['ret'])){
  header("location:/index.php");
}else{
  $table = $_GET['tdata'];
}

$stmt = $conn->prepare("DELETE FROM $table WHERE id=:ji");
$stmt->bindParam(":ji",$_GET['vdata']);
$stmt->execute();

header("Location:".$_GET['ret']);
