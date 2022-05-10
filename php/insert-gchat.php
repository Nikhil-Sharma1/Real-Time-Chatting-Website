<?php
  session_start();
  if(isset($_SESSION['unique_id']))
  {
    include_once "config.php";
    $outgoing_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);
    $group_id=mysqli_real_escape_string($conn,$_POST['group_id']);
    $message=mysqli_real_escape_string($conn,$_POST['message']);
    $sql1=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$group_id}");
    $row1=mysqli_fetch_assoc($sql1);
    $sql2=mysqli_query($conn,"SELECT * FROM gusers WHERE user_id={$outgoing_id}");
    $row2=mysqli_fetch_assoc($sql2);
    date_default_timezone_set("Asia/Calcutta");
    $time=date("h:ia");
    if(!empty($message))
    {
      $sql=mysqli_query($conn,"INSERT INTO gmessages (g_id,group_name, outgoing_msg_id,img, msg,type,time) VALUES ('{$group_id}','{$row1['gname']}','{$outgoing_id}','{$row2['img']}','{$message}','msg','{$time}')") or die();
    }
  }
  else{
    header("../login.php");
  }




























?>