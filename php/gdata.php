<?php
while($row1=mysqli_fetch_assoc($sql1))
    {
      $sql2=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id='{$row1['unique_id']}'");
      if(mysqli_num_rows($sql2)!=0)
      {
      $sql3=mysqli_query($conn,"SELECT * FROM gmessages WHERE g_id={$row1['unique_id']} ORDER BY msg_id DESC LIMIT 1");
      $row3=mysqli_fetch_assoc($sql3);
      //$id=$row3['outgoing_msg_id'];
      //echo $id;
      
      if(mysqli_num_rows($sql3)>0)
      {
        if($row3['type']==='image')
        {
          $gresult="Photo";
        }
        else if($row3['type']==='msg'){
          $gresult=$row3['msg'];
        }
        else if($row3['type']==='video'){
          $gresult="Video";
        }
        else if($row3['type']==='audio'){
          $gresult="Audio";
        }
        else{
          $gresult="No message available";
        }
      }
      else{
        $gresult="No message available";
      }
      (strlen($gresult)>28) ? $gmsg = substr($gresult,0,20).'...': $gmsg=$gresult;//strtr=to replace
      if(isset($row3['outgoing_msg_id'])){
        $sql6=mysqli_query($conn,"SELECT * FROM users WHERE unique_id={$row3['outgoing_msg_id']}");
        if(mysqli_num_rows($sql6)==0)
        {
          $sql7=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$row3['outgoing_msg_id']}");
          $row7=mysqli_fetch_assoc($sql7);
          ($outgoing_id == $row3['outgoing_msg_id']) ? $gyou = "You: " : $gyou =$row7['gname'].": ";  
        }
        else
        {
          $row6=mysqli_fetch_assoc($sql6);
          ($outgoing_id == $row3['outgoing_msg_id']) ? $gyou = "You: " : $gyou =$row6['fname'].": ";
        }
      }
      else if($gresult=="No message available"){
        $gyou = "";
      }

      if(mysqli_num_rows($sql2)>0)
      {
          $row2=mysqli_fetch_assoc($sql2);
          if($_SESSION['unique_id']===$row2['createdby'])
          {
            $output.='<div class="userlist">
                        <a href="gchat.php?g_id='.$row2['unique_id'].'">
                          <div class="content">
                            <img src="php/images/'.$row2['img'].'" alt="">
                            <div class="details">
                              <span>'.$row2['gname'].'</span>
                              <p>'.$gyou.$gmsg.'</p>
                            </div>
                          </div>
                        </a>
                        <a href="php/delete.php?g_id='.$row2['unique_id'].'"><input type="submit" class="Delete" style="cursor:pointer" value="DELETE GROUP">
                        </a>
                      </div>
                      ';
          }
          else
          {
            $output.='<div class="userlist">
                        <a href="gchat.php?g_id='.$row2['unique_id'].'">
                          <div class="content">
                            <img src="php/images/'.$row2['img'].'" alt="">
                            <div class="details">
                              <span>'.$row2['gname'].'</span>
                              <p>'.$gyou.$gmsg.'</p>
                            </div>
                          </div>
                        </a>
                        <a href="php/exit.php?g_id='.$row2['unique_id'].'"><input type="submit" class="Exit" style="cursor:pointer" value="EXIT GROUP">
                        </a>
                      </div>
                      ';
          }
      }
    }
    }
    ?>