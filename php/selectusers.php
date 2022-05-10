<?php
  session_start();
  include_once("config.php");
  $outgoing_id=$_SESSION['unique_id'];
  //echo $outgoing_id;
  $sql=mysqli_query($conn,"SELECT * FROM users WHERE NOT unique_id='{$outgoing_id}'");
  $output="";
  if(mysqli_num_rows($sql)==1)
  {
    $output.="No user is available ";
  }
  else if(mysqli_num_rows($sql)>0){
    while($row=mysqli_fetch_assoc($sql))
    {
      $output.='<label for="user">
                <div class="content">
                  <img src="php/images/'.$row['img'].'" alt="">
                  <div class="details">
                    <span>'.$row['fname']." ".$row['lname'].'</span>
                    <input type="checkbox" id="user" name="user" value="'.$row['unique_id'].'">
                    </div>
              </div>
              </label><br>
              ';
    }
  }
  echo $output;
?>