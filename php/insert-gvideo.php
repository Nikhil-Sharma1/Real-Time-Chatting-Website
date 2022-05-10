<?php
  session_start();
  include_once "config.php";
  $outgoing_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);//collect data from http post method
  $group_id=mysqli_real_escape_string($conn,$_POST['group_id']);
  $sql1=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$group_id}");
  $row1=mysqli_fetch_assoc($sql1);
  $sql2=mysqli_query($conn,"SELECT * FROM gusers WHERE user_id={$outgoing_id}");
  $row2=mysqli_fetch_assoc($sql2);
  date_default_timezone_set("Asia/Calcutta");
  $itime=date("h:ia");
  if(isset($_FILES['image']))
  {
    $vid_name=$_FILES['video']['name'];
    $name = substr($vid_name, 0, strrpos($vid_name, "."));
    $vid_type=$_FILES['video']['type'];
    $tmp_name=$_FILES['video']['tmp_name'];
    if(filesize($tmp_name)>=41943040)
    {
      echo "The file is too big. Please wait some time";
    }
    $vid_explode=explode('.',$vid_name);
    $vid_ext=end($vid_explode);
    $extension=['mp4','flv'];
    if(in_array($vid_ext,$extension)===true)
    {
      $time=time();
      $new_vid_name=$time.$vid_name;
      if(move_uploaded_file($tmp_name,"videos/".$new_vid_name))
      {
        $sql2=mysqli_query($conn,"INSERT INTO gmessages(g_id,group_name, outgoing_msg_id,img,video,video_name,type,time)
                            VALUES('{$group_id}','{$row1['gname']}','{$outgoing_id}','{$row2['img']}','{$new_vid_name}','{$name}','video','{$itime}')");
        if($sql2)
        {
            echo "success";
        }
        else{
          echo "Something went wrong";
        }
      }
    }
    else{
      echo "Please select a video file of only mp4/flv format";
    }
  }
  else
  {
    echo "Please select a video file";
  }

?>