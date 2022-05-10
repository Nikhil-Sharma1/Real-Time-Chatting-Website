<?php
  session_start();
  include_once "config.php";
  $outgoing_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);
  $incoming_id=mysqli_real_escape_string($conn,$_POST['incoming_id']);
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
        $sql2=mysqli_query($conn,"INSERT INTO messages(incoming_msg_id, outgoing_msg_id,image,image_name,type,time)
                            VALUES('{$incoming_id}','{$outgoing_id}','{$new_img_name}','{$name}','image','{$itime}')");
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