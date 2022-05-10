<?php
  session_start();
  include_once("config.php");
  $user_id=$_SESSION['unique_id'];
  $g_id=$_GET['g_id'];
  $sql=mysqli_query($conn,"SELECT * FROM gusers WHERE unique_id={$g_id} AND user_id={$user_id}");
  $row=mysqli_fetch_assoc($sql);
  $message=$row['user_fname']." exit the group";
  $gname=$row['g_name'];
  $sql1=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$g_id}");
  $row1=mysqli_fetch_assoc($sql1);
  $img=$row1['img'];
  date_default_timezone_set("Asia/Calcutta");
  $time=date("h:ia");
  $sql=mysqli_query($conn,"DELETE FROM gusers WHERE unique_id={$g_id} AND user_id={$user_id}");
  if($sql)
  {
    $sql6=mysqli_query($conn,"INSERT INTO gmessages (g_id,group_name, outgoing_msg_id,img, msg,type,time) VALUES ('{$g_id}','{$gname}','{$user_id}','{$img}','{$message}','msg','{$time}')") or die();
    header("location: ../users.php");
  }
?>
