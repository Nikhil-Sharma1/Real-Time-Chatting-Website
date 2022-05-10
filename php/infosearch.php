<?php
  session_start();
  include_once("config.php");
  $outgoing_id=$_SESSION['unique_id'];
  $output="";
  $value=mysqli_real_escape_string($conn,$_POST['searchTerm']);
  if (strpos($value, ' ') !== false) {
    $output.="Space or any special character is not allowed in searching. Use only first name or last name to search";
  }
  else{
  $g_id=$_SESSION['gname'];
  $sql=mysqli_query($conn,"SELECT * FROM gusers WHERE unique_id={$g_id} AND NOT user_id={$outgoing_id} AND (user_fname LIKE '%{$value}%' OR user_lname LIKE '%{$value}%')");
  $sql1=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$g_id}");
  $row1=mysqli_fetch_assoc($sql1);
  
  if(mysqli_num_rows($sql)==0)
  {
    $output.="No user found";
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
}
  echo $output;
?>