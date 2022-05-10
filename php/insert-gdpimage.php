<?php
  session_start();
  include_once "config.php";
  $user_id=mysqli_real_escape_string($conn,$_SESSION['unique_id']);
  if(isset($_FILES['dpImage']))
  {
    $img_name=$_FILES['dpImage']['name'];
    $img_type=$_FILES['dpImage']['type'];
    $tmp_name=$_FILES['dpImage']['tmp_name'];
    $img_explode=explode('.',$img_name);
    $img_ext=end($img_explode);
    $extension=['jpeg','jpg','png','JPG'];
    if(in_array($img_ext,$extension)===true)
    {
      $time=time();
      $new_img_name=$time.$img_name;
      if(move_uploaded_file($tmp_name,"images/".$new_img_name))
      {
        $sql=mysqli_query($conn,"UPDATE groups SET img ='{$new_img_name}' WHERE createdby={$_SESSION['unique_id']}");
        if($sql)
        {
            echo $new_img_name;
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