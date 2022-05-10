<?php
  session_start();
  include_once("config.php");
  $value=mysqli_real_escape_string($conn,$_POST['user_id']);
  $sql=mysqli_query($conn,"SELECT * FROM users WHERE unique_id= '{$value}'");
  $row=mysqli_fetch_assoc($sql);
  echo $row['status'];
?>