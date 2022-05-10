<?php
  session_start();
  include_once("config.php");
  $outgoing_id=$_SESSION['unique_id'];
  $output="";
  $sql1=mysqli_query($conn,"SELECT * FROM gusers WHERE user_id={$outgoing_id}");
  if(mysqli_num_rows($sql1)>0)
  {
    include "gdata.php";
  }
  $sql4=mysqli_query($conn,"SELECT * FROM users WHERE NOT unique_id={$outgoing_id}");
  if(mysqli_num_rows($sql4)==1)
  {
    $output.="No users are available to chat";
  }
  else if(mysqli_num_rows($sql4)>0){
    include "data.php";
  }
  echo $output;
?>