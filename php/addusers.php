<?php
  session_start();
  include_once("config.php");
  $g_id=$_SESSION['gname'];
  $sql=mysqli_query($conn,"SELECT * FROM gusers WHERE unique_id={$g_id}");
  $a=array();
  while($row=mysqli_fetch_assoc($sql))
  {
    array_push($a,$row['user_id']);
  }
  $sql1=mysqli_query($conn,"SELECT * from users ");
  $output="";
  $c=0;
    while($row1=mysqli_fetch_assoc($sql1))
    {
      if(!(in_array($row1['unique_id'],$a)))
      {
        $output.='<label for="user">
                  <div class="content">
                    <img style="margin-right: 15px;"src="php/images/'.$row1['img'].'" alt="">
                    <div class="details">
                      <span>'.$row1['fname']." ".$row1['lname'].'</span>
                      <input type="checkbox" id="user" name="user" value="'.$row1['unique_id'].'">
                      </div>
                </div>
                </label><br>
                ';
        $c++;
      }
    }
    if($c===0)
    {
      $output.="NO user is available";
    }
  echo $output;
?>