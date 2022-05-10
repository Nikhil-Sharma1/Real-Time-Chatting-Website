<?php
  session_start();
  if(isset($_SESSION['unique_id']))
  {
    include_once("config.php");
    $status="Active now";
    $id=$_SESSION['unique_id'];
    $sql=mysqli_query($conn,"UPDATE users SET status = '{$status}' WHERE unique_id={$id}");
    echo "Active now";
  }
?>