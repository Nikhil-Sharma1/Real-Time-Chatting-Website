<?php
  session_start();
  include_once("config.php");
  $user_id=$_SESSION['unique_id'];
  $g_id=$_GET['g_id'];
  $sql=mysqli_query($conn,"DELETE FROM groups WHERE unique_id={$g_id} AND createdby={$user_id}");
  if($sql)
  {
    header("location: ../users.php");
  }
?>