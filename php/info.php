<?php
  session_start();
  include_once("config.php");
  $outgoing_id=$_SESSION['unique_id'];
  $g_id=$_SESSION['gname'];
  $output="";
  $sql=mysqli_query($conn,"SELECT * FROM gusers WHERE unique_id={$g_id} AND NOT user_id={$outgoing_id}");
  $sql1=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$g_id}");
  $row1=mysqli_fetch_assoc($sql1);
  
  if(mysqli_num_rows($sql)==0)
  {
    $output.="No user is here";
  }
  else if(mysqli_num_rows($sql)>0){
    while($row=mysqli_fetch_assoc($sql))
    {
      if($row1['createdby']==$outgoing_id)
      $output.='
                <div class="infolist">
                <div class="content">
                <img src="php/images/'.$row['img'].'" alt="">
                <div class="details">
                  <span>'.$row['user_fname']." ".$row['user_lname'].'</span>
                </div>
                <a class="remove" href="php/remove.php?user_id='.$row['user_id'].'"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
              </div>
              </div>';
      else
      {
        $output.='
                <div class="infolist">
                <div class="content">
                <img src="php/images/'.$row['img'].'" alt="">
                <div class="details">
                  <span>'.$row['user_fname']." ".$row['user_lname'].'</span>
                </div>
              </div>
              </div>';
      }
    }
  }
  echo $output;
?>