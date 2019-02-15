<?php

function compressImage($files, $name, $quality, $upDIR ) {
  $rnd = rand(0000000, 9999999);
  $strip_name = str_replace(" ", "_", $_FILES[$name]['name']);
  $filename = time().$rnd.$strip_name;
  $destination_url = $upDIR.$filename;
  $info = getimagesize($files[$name]['tmp_name']);
  if ($info['mime'] == 'image/jpeg')
  $image = imagecreatefromjpeg($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/gif')
  $image = imagecreatefromgif($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/png')
  $image = imagecreatefrompng($files[$name]['tmp_name']);
  imagejpeg($image, $destination_url, $quality);
  return $destination_url;
}

function getEmployeeByName($dbconn,$name){
  $result = [];
  $stmt = $dbconn->prepare("SELECT * FROM employee WHERE name=:nm");
  $stmt->bindParam(":nm", $name);
  $stmt->execute();
$row = $stmt->fetch(PDO::FETCH_BOTH);


  return $row;
}

function adminLogin($dbconn, $input,$loc){
  $stmt = $dbconn->prepare("SELECT * FROM admin WHERE email = :e ");
  $stmt ->bindParam(":e", $input['email']);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  if($stmt->rowCount() !=1 || !password_verify($input['pword'], $row['hash'])){
    $suc = 'Invalid Email or Password';
    $message = preg_replace('/\s+/', '_', $suc);
    header("Location:admin_login.php?error=$message");
  }else{
    // die($row['verification']);
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['firstname'];
        header("Location:$loc");
    }
  }








  function doAdminRegister($dbconn, $input){
    try{


    $hash = password_hash($input['pword'], PASSWORD_BCRYPT);
    #insert data
    $stmt = $dbconn->prepare("INSERT INTO admin(firstname,lastname,email,hash,date_created) VALUES(:fn, :ln,:e, :h,NOW())");
    #bind params...
    $data = [ ':fn' => $input['firstname'],
    ':ln' => $input['lastname'],
    ':e' => $input['email'],

    ':h' => $hash,
  ];
  $stmt->execute($data);


}



catch(PDOException $e){
  die($e->getMessage());

}



}
function doesEmailExist($dbconn, $input){ #placeholders are just there
  $result = false;
  $stmt = $dbconn -> prepare("SELECT * FROM admin WHERE email = :em");
  $stmt->bindParam(":em",$input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}
function compressImage3($files, $name, $quality, $upDIR ) {
  $rnd = rand(0000000, 9999999);
  $strip_name = str_replace(" ", "_", $files[$name]['name']);
  $filename = time().$rnd.$strip_name;
  $destination_url = $upDIR.$filename;
  $info = getimagesize($files[$name]['tmp_name']);
  if ($info['mime'] == 'image/jpeg')
  $image = imagecreatefromjpeg($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/gif')
  $image = imagecreatefromgif($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/png')
  $image = imagecreatefrompng($files[$name]['tmp_name']);
  imagejpeg($image, "../".$destination_url, $quality);
  return $destination_url;
}

function login($dbconn, $input){
    $result = [];
  $stmt = $dbconn->prepare("SELECT * FROM visitors WHERE phone = :ph");
  $stmt->bindParam(":ph", $input['phone']);
  $stmt->execute();
  if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_BOTH);
if($row['suspend_status'] == 1){
  $message = "You have been Locked out of our system for failing to sign out during your last visit. Kindly contact the admin to rectify this";
  header("Location:success.php?error=$message");
  die;
}
  if($row['status'] == "signed in"){
    $message = "You are currently signed in. ";
    header("Location:success.php?error=$message");
    die;
  }


    if($row['image'] == NULL){
      session_start();
      $_SESSION['image'] = $row['id'];
        $_SESSION['name'] =  $row['name'];
        $_SESSION['whom'] =  $row['whom'];
      header("Location:uploadImage.php");
    }elseif($row['status'] == NULL){
     $status = "signed in";
     $stmt2 = $dbconn->prepare("UPDATE visitors SET status=:st,last_login=NOW(),last_login_date=NOW() WHERE phone = :ph");
     $stmt2->bindParam(":ph", $input['phone']);
     $stmt2->bindParam(":st", $status);
     $stmt2->execute();
     session_start();
     $_SESSION['name'] =  $row['name'];
     $_SESSION['login'] =  $row['name'];
     $_SESSION['whom'] = $row['whom'];

$result['whom'] = $row['whom'];
$result['email'] = $row['email'];
$result['image'] = $row['image'];
return $result;


    }else{
  session_start();
  $_SESSION['name'] =  $row['name'];
  $_SESSION['phone'] =  $input['phone'];
 $_SESSION['image'] =  $row['image'];
    header("Location:newLogin.php");
    }
  }else{
    $message = "Phone number doesnt exist on our system";
    header("Location:success.php?error=$message");
  }
}



function newLogin($dbconn, $input, $ph){
  $result = [];
  $stmt = $dbconn->prepare("SELECT * FROM visitors WHERE phone = :ph");
  $stmt->bindParam(":ph", $ph);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  if($row['suspend_status'] == 1){
    $message = "You have been blocked on our system Kindly contact the admin ";
    header("Location:success.php?error=$message");
    die;
  }
  if($row['status'] == "signed in"){
    $message = "You are currently signed in. ";
    header("Location:success.php?error=$message");
    die;
  }

  $status = "signed in";
  $stmt2 = $dbconn->prepare("UPDATE visitors SET status=:st, whom=:wm, purpose=:pp,last_login=NOW(),last_login_date=NOW() WHERE phone = :ph");
    $stmt2->bindParam(":ph", $ph);
    $stmt2->bindParam(":wm", $input['whom']);
    $stmt2->bindParam(":pp", $input['purpose']);
    $stmt2->bindParam(":st", $status);
    $stmt2->execute();
    session_start();
    $_SESSION['name'] =  $row['name'];
    $_SESSION['login'] =  $row['name'];
    $_SESSION['whom'] = $input['whom'];
    $_SESSION['image'] = $row['id'];

$result['whom'] = $row['whom'];
$result['email'] = $row['email'];
$result['image'] = $row['image'];

return $result;
}

function logout($dbconn, $input){
  $stmt = $dbconn->prepare("SELECT * FROM visitors WHERE phone = :ph");
  $stmt->bindParam(":ph", $input['phone']);
  $stmt->execute();
  if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_BOTH);
    if($row['status'] !== 'signed in'){
      $message = "You have not registered in to our system";
      header("Location:login.php?error=$message");
      die();
    }
    $status = "signed out";
    $stmt2 = $dbconn->prepare("UPDATE visitors SET status=:st,last_logout=NOW(),last_logout_date=NOW() WHERE phone = :ph");
    $stmt2->bindParam(":ph", $input['phone']);
    $stmt2->bindParam(":st", $status);
    $stmt2->execute();

    session_start();
    $_SESSION['name'] =  $row['name'];
    $_SESSION['logout'] =  $row['name'];

    $message = "Checkout Successfull";
    header("Location:success.php?success=$message");
  }else{
    $message = "Phone number doesnt exist on our system";
    header("Location:success.php?error=$message");
  }
}

function compressImage2($files, $name, $quality, $upDIR ) {
// die(var_dump($files[$name]['type']));
  $rnd = rand(0000000, 9999999);
  $strip_name = str_replace(" ", "_", $files[$name]['name']);
  $filename = time()."mail".$strip_name;
  $destination_url = $filename;
  $info = getimagesize($files[$name]['tmp_name']);
  if ($info['mime'] == 'image/jpeg')
  $image = imagecreatefromjpeg($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/gif')
  $image = imagecreatefromgif($files[$name]['tmp_name']);
  elseif ($info['mime'] == 'image/png')
  $image = imagecreatefrompng($files[$name]['tmp_name']);

$range1 = 100000;

$range2 = 500000;

$range3 = 1000000;

  if($files[$name]['size'] >= 0  && $files[$name]['size'] <= $range1 ){
    $quality = 100;
  }elseif($files[$name]['size'] >= $range1  && $files[$name]['size'] <= $range2 ){
      $quality = 90;
  }elseif ($files[$name]['size'] >= $range2  && $files[$name]['size'] <= $range3) {
  $quality =  70;
  }else{
  $quality =  20;
  }
  imagejpeg($image, $destination_url, $quality);
  return $destination_url;
}

function getEmployee($dbconn){
  $stmt = $dbconn->prepare("SELECT * FROM employee");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    echo '<option value="'.$name.'">
    '.$name.'
    </option>';
  }
}

function doesPhoneNumberExist($dbconn, $input){
  $result = false;
  $stmt = $dbconn->prepare("SELECT * FROM visitors WHERE phone = :tp");
  $stmt->bindParam(":tp", $input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}


function insert($dbconn, $table, $parameters){

array_pop($parameters);
  // var_dump($parameters);
  $sql = sprintf('INSERT INTO %s (%s) VALUES(%s)',
      $table,
      implode(', ',array_keys($parameters)), ':'.implode(',:',array_keys($parameters))
  );
  // die(var_dump($sql));
$stmt =  $dbconn->prepare($sql);
$stmt->execute($parameters);
}

function displayErrors($error, $field)
{
  $result= "";
  if (isset($error[$field]))
  {
    $result = '<span style="color:red">'.$error[$field].'</span>';
  }
  return $result;
}

function getAllData($dbconn,$table){
  $result = [];
  $stmt = $dbconn->prepare("SELECT * FROM $table");
  // $stmt->bindParam(":tb", $table);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $result[] = $row;
  }
  return $result;
}
function getAllDataToday($dbconn,$table){
  $result = [];
  $date = date("Y-m-d");
  $stmt = $dbconn->prepare("SELECT * FROM $table WHERE last_login_date=:tm");
  $stmt->bindParam(":tm", $date);
  // $stmt->bindParam(":tb", $table);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $result[] = $row;
  }
  return $result;
}

function update($dbconn, $table, $parameters,$column,$value,$locat){
  // die(var_dump($parameters));

try {
  function getVal($param){
  $result = [];
  foreach($param as $col => $val){
      $result[] = "$col = :$col";
    }
    $new = implode(', ', $result);
    return $new;
}


array_pop($parameters);
$what = getVal($parameters);
$vall = getVal($value);

  // var_dump($parameters);
  $sql = sprintf('UPDATE %s SET %s',
      $table, $what
  );
  $sql .= " WHERE ".$vall;
  // die(var_dump($sql));
$stmt =  $dbconn->prepare($sql);
$newt = $parameters + $value;
// die(var_dump($newt));
$stmt->execute($newt);
} catch (PDOException $e) {
  die("Error Occured");
}

$success = "Edited";
header("Location:$locat?success=$success");
}
function update2($dbconn, $table, $parameters,$column,$value,$locat){
  // die(var_dump($parameters));

try {
  function getVal($param){
  $result = [];
  foreach($param as $col => $val){
      $result[] = "$col = :$col";
    }
    $new = implode(', ', $result);
    return $new;
}


// array_pop($parameters);
$what = getVal($parameters);
$vall = getVal($value);

  // var_dump($parameters);
  $sql = sprintf('UPDATE %s SET %s',
      $table, $what
  );
  $sql .= " WHERE ".$vall;
  // die(var_dump($sql));
$stmt =  $dbconn->prepare($sql);
$newt = $parameters + $value;
// die(var_dump($newt));
$stmt->execute($newt);
} catch (PDOException $e) {
  die("Error Occured");
}

$success = "Edited";
header("Location:$locat?success=$success");
}
function update3($dbconn, $table, $parameters,$column,$value){
  // die(var_dump($parameters));

try {
  function getVal($param){
  $result = [];
  foreach($param as $col => $val){
      $result[] = "$col = :$col";
    }
    $new = implode(', ', $result);
    return $new;
}


// array_pop($parameters);
$what = getVal($parameters);
$vall = getVal($value);

  // var_dump($parameters);
  $sql = sprintf('UPDATE %s SET %s',
      $table, $what
  );
  $sql .= " WHERE ".$vall;
  // die(var_dump($sql));
$stmt =  $dbconn->prepare($sql);
$newt = $parameters + $value;
// die(var_dump($newt));
$stmt->execute($newt);
} catch (PDOException $e) {
  die("Error Occured");
}


}


function adminFullInfo($dbconn,$sess){
  $stmt = $dbconn->prepare("SELECT * FROM admin WHERE id = :id");
  $data = [
    ':id' => $sess
  ];
  $stmt->execute($data);
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}


function getSpecificData($dbconn,$table,$where,$value){

    $result = [];
  $stmt = $dbconn->prepare("SELECT * FROM $table WHERE $where = :tb ");
    $stmt->bindParam(":tb", $value);
    // $stmt->bindParam(":cond", $where);
  // die(var_dump($stmt));
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      $result[] = $row;
    }
    return $result;
}
function getSpecificDataToday($dbconn,$table,$where,$value){
$date = date("Y-m-d");
    $result = [];
  $stmt = $dbconn->prepare("SELECT * FROM $table WHERE $where = :tb AND last_login_date = :tm ");
    $stmt->bindParam(":tb", $value);
    $stmt->bindParam(":tm", $date);
    // $stmt->bindParam(":cond", $where);
  // die(var_dump($stmt));
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      $result[] = $row;
    }
    return $result;
}
