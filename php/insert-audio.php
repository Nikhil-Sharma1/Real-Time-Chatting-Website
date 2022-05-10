<?php
  session_start();
  include_once "config.php";
  $outgoing_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);
  $incoming_id=mysqli_real_escape_string($conn,$_POST['incoming_id']);
  date_default_timezone_set("Asia/Calcutta");
  $itime=date("h:ia");
  if(isset($_FILES['image']))
  {
    $aud_name=$_FILES['audio']['name'];
    $name = substr($aud_name, 0, strrpos($aud_name, "."));
    $aud_type=$_FILES['audio']['type'];
    $tmp_name=$_FILES['audio']['tmp_name'];
    if(filesize($tmp_name)>=41943040)
    {
      echo "The file is too big. Please wait some time";
    }
    $aud_explode=explode('.',$aud_name);
    $aud_ext=end($aud_explode);
    $extension=['mp3','flac','mp4','wav'];
    if(in_array($aud_ext,$extension)===true)
    {
      $time=time();
      $new_aud_name=$time.$aud_name;
      if(move_uploaded_file($tmp_name,"audios/".$new_aud_name))
      {
        $sql2=mysqli_query($conn,"INSERT INTO messages(incoming_msg_id, outgoing_msg_id,audio,audio_name,type,time)
                            VALUES('{$incoming_id}','{$outgoing_id}','{$new_aud_name}','{$name}','audio','{$itime}')");
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
      echo "Please select an audio file of only mp3/flac/mp4/wav format";
    }
  }
  else
  {
    echo "Please select an image file";
  }

?>