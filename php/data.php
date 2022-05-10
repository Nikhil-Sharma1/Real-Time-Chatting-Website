<?php
while($row4=mysqli_fetch_assoc($sql4))
    {
      $sql5=mysqli_query($conn,"SELECT * FROM messages WHERE (incoming_msg_id={$row4['unique_id']}
                          OR outgoing_msg_id={$row4['unique_id']}) AND (incoming_msg_id={$outgoing_id}
                          OR outgoing_msg_id={$outgoing_id}) ORDER BY msg_id DESC LIMIT 1");
      $row5=mysqli_fetch_assoc($sql5);
      if(mysqli_num_rows($sql5)>0)
      {
        if($row5['type']==='image')
        {
          $result="Photo";
        }
        else if($row5['type']==='msg'){
          $result=$row5['msg'];
        }
        else if($row5['type']==='video'){
          $result="Video";
        }
        else if($row5['type']==='audio'){
          $result="Audio";
        }
        else{
          $result="No message available";
        }
      }
      else{
        $result="No message available";
      }
      (strlen($result)>28) ? $msg = substr($result,0,20).'...': $msg=$result;//strtr=to replace
      if(isset($row5['outgoing_msg_id'])){
      ($outgoing_id == $row5['outgoing_msg_id']) ? $you = "You: " : $you = "";
      }
      else{
        $you = "";
      }
      ($row4['status']=="Offline now") ? $offline = "offline" : $offline = "";

      $output.='
                <div class="userlist">
                <a href="chat.php?user_id='.$row4['unique_id'].'">
                <div class="content">
                <img src="php/images/'.$row4['img'].'" alt="">
                <div class="details">
                  <span>'.$row4['fname']." ".$row4['lname'].'</span>
                  <p>'.$you.$msg.'</p>
                </div>
              </div>
              <div class="status-dot '.$offline.'">
                <i class="fas fa-circle"> </i>
              </div>
              </a>
              </div>';
    }
    ?>