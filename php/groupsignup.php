<?php
  session_start();
  include_once "config.php";
  $user_id=$_SESSION['unique_id'];
  $gname=mysqli_real_escape_string($conn,$_POST['gname']);
  if(!empty($gname))
  {
    if(isset($_FILES['image']))
    {
        $img_name=$_FILES['image']['name'];
        $img_type=$_FILES['image']['type'];
        $tmp_name=$_FILES['image']['tmp_name'];
        $img_explode=explode('.',$img_name);
        $img_ext=end($img_explode);
        $extension=['jpeg','jpg','png','JPG'];
        if(in_array($img_ext,$extension)===true)
        {
          $time=time();
          $new_img_name=$time.$img_name;
          if(move_uploaded_file($tmp_name,"images/".$new_img_name))
          {
            $random_id=rand(time(),10000000);
            $sql=mysqli_query($conn,"SELECT * from users WHERE unique_id='{$_SESSION['unique_id']}'");
            $row=mysqli_fetch_assoc($sql);
            $img=$row['img'];
            $user_fname=$row['fname'];
            $user_lname=$row['lname'];
            $sql2=mysqli_query($conn,"INSERT INTO groups(unique_id,gname,img,createdby,createdby_fn,createdby_ln)
                                VALUES('{$random_id}','{$gname}','{$new_img_name}','{$user_id}','{$user_fname}','{$user_lname}')");
            $sql3=mysqli_query($conn,"INSERT INTO gusers(unique_id,g_name,user_id,user_fname,user_lname,img) VALUES ('{$random_id}','{$gname}','{$user_id}','{$user_fname}','{$user_lname}','{$img}')");
            $_SESSION['gname']=$random_id;
            echo "success";
          }
        }
        else
        {
          echo "Please select an image file of jpeg/jpg/png format";
        }
    }
    else
    {
      echo "Please select an image file";
    }
  }
  else
  {
    echo "all input fields are required";
  }
?>
