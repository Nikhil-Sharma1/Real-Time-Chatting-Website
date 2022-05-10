<?php
  session_start();
  if(!isset($_SESSION['unique_id']))
  {
    header("location: login.php");
  }
  $_SESSION['gname']=$_GET['g_id'];
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
    <section class="chat-area">
      <header>
      <?php
        include_once "php/config.php";
        $g_id=mysqli_real_escape_string($conn,$_GET['g_id']);
        $sql=mysqli_query($conn,"SELECT * FROM groups WHERE unique_id={$g_id}");
        if(mysqli_num_rows($sql)>0)
        {
          $row=mysqli_fetch_assoc($sql);
        }
      ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']?>" alt="">
          <div class="details">
            <span><?php echo $row['gname']; ?></span>
            <p>Created by <?php echo $row['createdby_fn']." ".$row['createdby_ln']?></p>
          </div>
          <a href="info.php?g_id=<?php echo $g_id;?>" class="Info">INFO</a>
      </header>
      <div class="search">
        <span class="text">Search the message</span>
        <input type="text"placeholder="Enter message to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="chat-box"></div>
      <form action="#"class="typing-area" autocomplete="off">
      <div class="filescope">
        <div class="Files" >
            <i class="far fa-4x fa-folder" id="folder"></i>
        </div>
        <div class="File-content" id="Folder-content" >
            <span class="fa-stack w3-animate-bottom fa-2x">
              <label for="Image-file" class="btn1" style="cursor: pointer;"><i class="fas fa-circle fa-stack-2x"></i>
              <i class="fas fa-images fa-stack-1x fa-inverse"></i></label>
              <input id="Image-file" name='image' style="visibility:hidden;" type="file"  > </input>
            </span>
            <span class="fa-stack w3-animate-bottom fa-2x">
              <label for="Video-file" class="btn1" style="cursor: pointer;"><i class="fas fa-circle fa-stack-2x"></i>
              <i class="fas fa-video fa-stack-1x fa-inverse"></i></label>
              <input id="Video-file" name='video' style="visibility:hidden;" type="file"  > </input>
            </span>
            <span class="fa-stack w3-animate-bottom fa-2x">
              <label for="Audio-file" class="btn1" style="cursor: pointer;"><i class="fas fa-circle fa-stack-2x"></i>
              <i class="fas fa-music fa-stack-1x fa-inverse"></i></label>
              <input id="Audio-file" name='audio' style="visibility:hidden;" type="file"  > </input> 
            </span>
          </div>
        </div>
        <input type="text" name="outgoing_id" id="outgoing" value=<?php echo $_SESSION['unique_id'];?> hidden>
        <input type="text" name="group_id" id="group" value=<?php echo $g_id;?> hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here...">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
  <script src="javascript/gchat.js"></script>
</body>
</html>