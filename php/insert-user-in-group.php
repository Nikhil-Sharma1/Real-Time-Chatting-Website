<?php
  session_start();
  include_once("config.php");
  $user_id=$_POST['user_id'];
  $g_id=$_SESSION['gname'];
  date_default_timezone_set("Asia/Calcutta");
  $time=date("h:ia");
  //echo $g_id;
  $sql=mysqli_query($conn,"SELECT * from users WHERE unique_id='{$user_id}'");
  $row=mysqli_fetch_assoc($sql);
  $img=$row['img'];
  $user_fname=$row['fname'];
  $user_lname=$row['lname'];
  $sql1=mysqli_query($conn,"SELECT * from groups WHERE unique_id='{$g_id}'");
  $row1=mysqli_fetch_assoc($sql1);
  $g_name=$row1['gname'];
  $message=$row1['createdby_fn']." add ".$user_fname." ".$user_lname;
  $sql1=mysqli_query($conn,"INSERT INTO gusers(unique_id,g_name,user_fname,user_lname,user_id,img) VALUES ('{$g_id}','{$g_name}','{$user_fname}','{$user_lname}','{$user_id}','{$img}')");
  $sql6=mysqli_query($conn,"INSERT INTO gmessages (g_id,group_name, outgoing_msg_id,img, msg,type,time) VALUES ('{$g_id}','{$g_name}','{$row1['unique_id']}','{$row1['img']}','{$message}','msg','{$time}')") or die();
  echo "success";
?>