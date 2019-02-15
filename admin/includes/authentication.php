<?php



if (!isset($_SESSION['id'])){

  $success = "You are not signed in";
//   $succ = preg_replace('/\s+/', '_', $success);

  header("Location:/visitors/admin_login.php?error=$success");
  die;
}
