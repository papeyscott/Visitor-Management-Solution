<?php
include 'includes/db.php';
if($_POST['data'] == 1){
$stmt = $conn->prepare("UPDATE visitors SET suspend_status = NULL WHERE id =:id ");
$stmt->bindParam("id",$_POST['query']);
$stmt->execute();
$return = "";
}else{
  $stmt = $conn->prepare("UPDATE visitors SET suspend_status = 1 WHERE id =:id ");
  $stmt->bindParam("id",$_POST['query']);
  $stmt->execute();
  $return = 1;
}

echo $return;

 ?>
