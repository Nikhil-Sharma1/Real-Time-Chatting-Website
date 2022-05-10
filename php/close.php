<?php
  session_start();
  include_once("config.php");
  $id=$_SESSION['unique_id'];
  $sql=mysqli_query($conn,"UPDATE users SET status = 'Offline now' WHERE unique_id= '{$id}'");
  echo "status changed";
?>