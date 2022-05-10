<?php
  session_start();
  include_once("config.php");
  $outgoing_id=$_SESSION['unique_id'];
  $value=mysqli_real_escape_string($conn,$_POST['searchTerm']);
  if (strpos($value, ' ') !== false) {
    $output.="Space or any special character is not allowed in searching. Use only first name or last name to search";
  }
  else{
  $outgoing_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);
  $incoming_id=mysqli_real_escape_string($conn,$_POST['incoming_id']);
  $sql=mysqli_query($conn,"SELECT * FROM messages
                      LEFT JOIN users ON users.unique_id=messages.outgoing_msg_id
                      WHERE ((outgoing_msg_id={$outgoing_id} AND incoming_msg_id={$incoming_id})
                      or (outgoing_msg_id={$incoming_id} AND incoming_msg_id={$outgoing_id}))
                      AND (msg LIKE '%{$value}%' or video_name LIKE '%{$value}%' or 
                          audio_name LIKE '%{$value}%') ORDER BY msg_id ");
  $output="";
  if(mysqli_num_rows($sql)>0)
    {
      while($row=mysqli_fetch_assoc($sql))
      {
        if($row['outgoing_msg_id']===$outgoing_id && $row['type']==='msg')
        {
          $output.='<div class="chat outgoing">
                      <div class="details">
                        <p>'.$row["msg"].'</p><br>
                        <small class="time">'.$row['time'].'</small>
                      </div>
                    </div>';
        }
        else if($row['outgoing_msg_id']===$outgoing_id && $row['type']==='image')
        {
          $output.='<div class="chat outgoing">
                      <div class="image">
                      <img src="php/images/'.$row['image'].'" alt=""><br><br>
                      <small class="time">'.$row['time'].'</small>
                      </div>
                    </div>';
        }
        else if($row['outgoing_msg_id']!=$outgoing_id && $row['type']==='image')
        {
          $output.='<div class="chat incoming">
                      <img src="PHP/images/'.$row['img'].'"alt="">
                      <div class="image">
                      <img src="php/images/'.$row['image'].'" alt=""><br><br>
                      <small>'.$row['time'].'</small>
                      </div>
                    </div>';
        }
        else if($row['outgoing_msg_id']===$outgoing_id && $row['type']==='video')
        {
          $output.='<div class="chat outgoing">
                      <a href="video.php?video_link='.$row['video'].'"
                        <div class="details">
                          <p class="ovideo-link"> Click to play the video </p><br>
                          <small class="time">'.$row['time'].'</small>
                        </div>
                      </a>
                    </div>';
        }
        else if($row['outgoing_msg_id']!=$outgoing_id && $row['type']==='video')
        {
          $output.=   '<div class="chat incoming">
                        <img src="PHP/images/'.$row['img'].'"alt="">
                        <a href="video.php?video_link='.$row['video'].'"
                        <div class="details">
                          <p class="ivideo-link"> Click to play the video </p>
                          <small>'.$row['time'].'</small>
                        </div>
                        </a>
                      </div>';
        }
        else if($row['outgoing_msg_id']===$outgoing_id && $row['type']==='audio')
        {
          $output.='<div class="chat outgoing">
                      <a href="Music/audio.php?audio_link='.$row['audio'].'&audio_name='.$row['audio_name'].'"
                        <div class="details">
                          <p class="ovideo-link"> Click to play the audio </p><br>
                          <small class="time">'.$row['time'].'</small>
                        </div>
                      </a>
                    </div>';
        }
        else if($row['outgoing_msg_id']!=$outgoing_id && $row['type']==='audio')
        {
          $output.=   '<div class="chat incoming">
                        <img src="PHP/images/'.$row['img'].'"alt="">
                        <a href="Music/audio.php?audio_link='.$row['audio'].'&audio_name='.$row['audio_name'].'">
                        <div class="details">
                          <p class="ivideo-link"> Click to play the audio </p>
                          <small>'.$row['time'].'</small>
                        </div>
                        </a>
                      </div>';
        }
        else if($row['outgoing_msg_id']!=$outgoing_id && $row['type']==='msg'){
          $output.=  '<div class="chat incoming">
                      <img src="PHP/images/'.$row['img'].'"alt="">
                      <div class="details">
                        <p>'.$row['msg'].'</p>
                        <small>'.$row['time'].'</small>
                      </div>
                    </div>';
        }
      }
    }
    else{
      $output.="no message matches your search";
    };
  }
  echo $output;
?>
    

    