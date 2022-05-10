<?php
  session_start();
  include_once("config.php");
  $outgoing_id=$_SESSION['unique_id'];
  $output="";
  $value=mysqli_real_escape_string($conn,$_POST['searchTerm']);
  if (strpos($value, ' ') !== false) {
    $output.="Space or any special character is not allowed in searching. Use only first name or last name to search";
  }
  else{
  $sql1=mysqli_query($conn,"SELECT * FROM gusers WHERE user_id={$outgoing_id} AND g_name LIKE '%{$value}%'");
  if(mysqli_num_rows($sql1)>0)
  {
    include "gdata.php";
  }
  $sql4=mysqli_query($conn,"SELECT * FROM users where (NOT unique_id={$outgoing_id}) AND (fname LIKE '%{$value}%' OR lname LIKE '%{$value}%')");
  if(mysqli_num_rows($sql4)>0)
  {
    include "data.php";
  }
  else{
    $output.="No user found";
  }
}
  echo $output;
?>