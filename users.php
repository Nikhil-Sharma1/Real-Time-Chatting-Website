<?php
  session_start();
  if(!isset($_SESSION['unique_id']))
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
    <section class="users">
      <header>
        <?php
        include_once "php/config.php";
        $sql=mysqli_query($conn,"SELECT * FROM users WHERE unique_id={$_SESSION['unique_id']}");
        if(mysqli_num_rows($sql)>0)
        {
          $row=mysqli_fetch_assoc($sql);
        }
        ?>
        <div class="content">
          <form action="#" class="formDp" >
          <label for="changeDp" ><img id='dp' src="php/images/<?php echo $row['img']?>" alt=""></label>
          <input id="changeDp" name='dpImage' style="visibility:hidden; display:none;" type="file"> </input>
          </form>
          <div class="details">
            <span><?php echo $row['fname']." ".$row['lname']; ?></span>
            <p id="stats"><?php echo $row['status'] ?></p>
          </div>
        </div>
        <a href="groupsignup.php?user_id=<?php echo $row['unique_id'];?>" class="createGroup">Create Group</a>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id'];?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text"placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
      </div>
    </section>
  </div>
  <script src="javascript/users.js"></script>
</body>
</html>