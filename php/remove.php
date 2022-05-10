<?php
  session_start();
  include_once("config.php");
  $user_id=$_GET['user_id'];
  $g_id=$_SESSION['gname'];
  $sql=mysqli_query($conn,"SELECT * FROM groups where unique_id={$g_id}");
  $row=mysqli_fetch_assoc($sql);
  $sql1=mysqli_query($conn,"SELECT * FROM gusers WHERE unique_id={$g_id} AND user_id={$user_id}");
  $row1=mysqli_fetch_assoc($sql1);
  $message=$row['createdby_fn']." removed ".$row1['user_fname'];
  $gname=$row1['g_name'];
  $img=$row['img'];
  date_default_timezone_set("Asia/Calcutta");
  $time=date("h:ia");
  $sql=mysqli_query($conn,"DELETE FROM gusers WHERE unique_id={$g_id} AND user_id={$user_id}");
  if($sql)
  {
    $sql6=mysqli_query($conn,"INSERT INTO gmessages (g_id,group_name, outgoing_msg_id,img, msg,type,time) VALUES ('{$g_id}','{$gname}','{$row['unique_id']}','{$img}','{$message}','msg','{$time}')") or die();
    header("location: ../info.php?g_id=".$g_id);
  }
?>