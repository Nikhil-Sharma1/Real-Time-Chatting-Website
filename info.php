<?php
  session_start();
  if(!isset($_SESSION['unique_id'])&&!isset($_SESSION['gname']))
  {
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Realtime Chatting</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudFlare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
  <div class="wrapper">
    <section class="info">
      <header>
        <a href="gchat.php?g_id=<?php echo $_GET['g_id'] ?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <?php
        include_once "php/config.php";
        $sql=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$_GET['g_id']}");
        if(mysqli_num_rows($sql)>0)
        {
          $row=mysqli_fetch_assoc($sql);
        }
        ?>
        <div class="content">
          <?php 
            $output="";
            if($_SESSION['unique_id']==$row['createdby'])
            {
              $output.='<form action="#" class="formDp" >
              <label for="changeDp" ><img id="dp" src="php/images/'.$row["img"].'" alt=""></label>
              <input id="changeDp" name="dpImage" style="visibility:hidden; display:none;" type="file"> </input>
              </form>';
            }
            else{
              $output.='<img style="cursor:default" src="php/images/'.$row["img"].'" alt="">';
            }
            echo $output;
          ?>
          
          <div class="details">
            <span><?php echo $row['gname']?></span>
            <p>Created by <?php echo $row['createdby_fn']." ".$row['createdby_ln']?></p>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Select an user</span>
        <input type="text"placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <?php 
            $output="";
            if($_SESSION['unique_id']==$row['createdby'])
            {
              $output.='<div class="info-list">
              </div>
              <div class="addscope">
                <div class="field button">
                  <input type="submit" value="Add user">
                </div>
                <div class="addsearch" style="display:none;">
                  <span class="text">Search an user to add</span>
                  <input type="text"placeholder="Enter name to search...">
                  <button><i class="fas fa-search"></i></button>
                </div>
                <div class="selectUser" style="display:none; margin-top: 35px;margin-left: 30px;">
                </div>
                <div class="add" style="display:none;">
                <input type="submit" value="Add">
                </div>
              </div>';
            }
            else{
              $output.='<div class="info-list">
              </div>';
            }
            echo $output;
      ?>
      
    </section>
  </div>
  <script src=
  <?php 
    if($_SESSION['unique_id']==$row['createdby'])
    echo "javascript/ainfo.js";
    else
    echo "javascript/cinfo.js";
  ?>></script>
</body>
</html>




