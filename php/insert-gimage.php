<?php
  session_start();
  include_once "config.php";
  $outgoing_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);
  $group_id=mysqli_real_escape_string($conn,$_POST['group_id']);
  $sql1=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$group_id}");
  $row1=mysqli_fetch_assoc($sql1);
  $sql2=mysqli_query($conn,"SELECT * FROM gusers WHERE user_id={$outgoing_id}");
  $row2=mysqli_fetch_assoc($sql2);
  date_default_timezone_set("Asia/Calcutta");
  $itime=date("h:ia");
  if(isset($_FILES['image']))
  {
    $img_name=$_FILES['image']['name'];
    $name = substr($img_name, 0, strrpos($img_name, "."));//Returns the position where the needle exists relative to the beginning of the haystack string (independent of search direction or offset).
    $img_type=$_FILES['image']['type'];
    $tmp_name=$_FILES['image']['tmp_name'];
    if(filesize($tmp_name)>=41943040)
    {
      echo "The file is too big. Please wait some time";
    }
    $img_explode=explode('.',$img_name);
    $img_ext=end($img_explode);
    $extension=['jpeg','jpg','png','JPG'];
    if(in_array($img_ext,$extension)===true)
    {
      $time=time();
      $new_img_name=$time.$img_name;
      if(move_uploaded_file($tmp_name,"images/".$new_img_name))
      {
        $sql2=mysqli_query($conn,"INSERT INTO gmessages(g_id,group_name, outgoing_msg_id,img,image,image_name,type,time)
                            VALUES('{$group_id}','{$row1['gname']}','{$outgoing_id}','{$row2['img']}','{$new_img_name}','{$name}','image','{$itime}')");
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
      echo "Please select an image file of jpeg/jpg/png format";
    }
  }
  else
  {
    echo "Please select an image file";
  }

?>