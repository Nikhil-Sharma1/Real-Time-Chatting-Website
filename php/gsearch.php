<?php
  session_start();
  include_once("config.php");
  $outgoing_id=$_SESSION['unique_id'];
  $value=mysqli_real_escape_string($conn,$_POST['searchTerm']);
  $output="";
  if (strpos($value, ' ') !== false) {
    $output.="Space or any special character is not allowed in searching. Use only first name or last name to search";
  }
  else{
    $sql=mysqli_query($conn,"SELECT * FROM users where (NOT unique_id={$outgoing_id}) AND (fname LIKE '%{$value}%' OR lname LIKE '%{$value}%')");
  
    if(mysqli_num_rows($sql)>0){
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
  else{
    $output.="No users is available ";
  }
}
  echo $output;
?>