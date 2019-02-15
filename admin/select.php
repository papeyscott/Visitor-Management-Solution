<?php
include 'includes/db.php';
include 'includes/function.php';

if($_POST['type'] == 'date'){

$st = $conn->prepare("SELECT * FROM visitors WHERE last_login_date=:dt");
$st->bindParam(":dt",$_POST['data']);
$st->execute();
$visitor = [];

while($row = $st->fetch(PDO::FETCH_BOTH)){
  $visitor[] = $row;
}

// echo $st->rowCount();

$dev = [];
for($var=1;  $var <= $st->rowCount(); $var++  ){
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

foreach ($visitor as $key => $value) {
$employ = getEmployeeByName($conn,$value['whom']);
echo '<tr>
    <td>'.$value['sn'].'</td></td>
    <td>'.$value['purpose'].'</td>
    <td>'.$value['last_login'].'</td>
    <td>'.$value['last_logout'].'</td>
    <td>'.$value['name'].', '.$row['address'].'</td>
    <td>'.$employ['id'].'</td>
    <td>'.$employ['name'].'</td>
    <td>'.$employ['school_category'].'</td>
       </tr>';

}





}elseif($_POST['type'] == 'type'){

  $st = $conn->prepare("SELECT * FROM visitors WHERE purpose = :dt");
  $st->bindParam(":dt",$_POST['data']);
  $st->execute();
  $visitor = [];

  while($row = $st->fetch(PDO::FETCH_BOTH)){
    $visitor[] = $row;
  }

  // echo $st->rowCount();

  $dev = [];
  for($var=1;  $var <= $st->rowCount(); $var++  ){
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

  foreach ($visitor as $key => $value) {
  $employ = getEmployeeByName($conn,$value['whom']);
  echo '<tr>
      <td>'.$value['sn'].'</td></td>
      <td>'.$value['purpose'].'</td>
      <td>'.$value['last_login'].'</td>
      <td>'.$value['last_logout'].'</td>
      <td>'.$value['name'].', '.$row['address'].'</td>
      <td>'.$employ['id'].'</td>
      <td>'.$employ['name'].'</td>
      <td>'.$employ['school_category'].'</td>
         </tr>';

  }
}elseif($_POST['type']  == 'both' ){



    $st = $conn->prepare("SELECT * FROM visitors WHERE last_login_date =:dt AND purpose = :dt2");
    $st->bindParam(":dt",$_POST['data']);
    $st->bindParam(":dt2",$_POST['data2']);
    $st->execute();
    $visitor = [];

    while($row = $st->fetch(PDO::FETCH_BOTH)){
      $visitor[] = $row;
    }

    // echo $st->rowCount();

    $dev = [];
    for($var=1;  $var <= $st->rowCount(); $var++  ){
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

    foreach ($visitor as $key => $value) {
    $employ = getEmployeeByName($conn,$value['whom']);
    echo '<tr>
        <td>'.$value['sn'].'</td></td>
        <td>'.$value['purpose'].'</td>
        <td>'.$value['last_login'].'</td>
        <td>'.$value['last_logout'].'</td>
        <td>'.$value['name'].', '.$row['address'].'</td>
        <td>'.$employ['id'].'</td>
        <td>'.$employ['name'].'</td>
        <td>'.$employ['school_category'].'</td>
           </tr>';

    }

}elseif($_POST['type']  == 'range' ){




    $st = $conn->prepare("SELECT * FROM visitors WHERE last_login_date BETWEEN :dt2 AND :dt");
    $st->bindParam(":dt",$_POST['data']);
    $st->bindParam(":dt2",$_POST['data2']);
    $st->execute();
    $visitor = [];
  

    while($row = $st->fetch(PDO::FETCH_BOTH)){
      $visitor[] = $row;
    }

    // echo $st->rowCount();

    $dev = [];
    for($var=1;  $var <= $st->rowCount(); $var++  ){
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

    foreach ($visitor as $key => $value) {
    $employ = getEmployeeByName($conn,$value['whom']);
    echo '<tr>
        <td>'.$value['sn'].'</td></td>
        <td>'.$value['purpose'].'</td>
        <td>'.$value['last_login'].'</td>
        <td>'.$value['last_logout'].'</td>
        <td>'.$value['name'].', '.$row['address'].'</td>
        <td>'.$employ['id'].'</td>
        <td>'.$employ['name'].'</td>
        <td>'.$employ['school_category'].'</td>
           </tr>';

    }


}else{
  die;
}


 ?>
