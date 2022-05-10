<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if(!isset($_SESSION['unique_id']))
  {
    header("location: login.php");
  }
?>
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
    <section class="form signup">
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        Realtime Chat app</header>
      <form action="#" enctype="multipart/form-data" autocomplete="off">
      <!-- multipart form data is used for encoding input type="file" -->
      <!-- each value is sent as a block of data ("body part"), with a user agent-defined delimiter ("boundary")
       separating each part. The keys are given in the Content-Disposition header of each part. -->
        <div class="error-txt"></div>
        <div class="name-details">
          <div class="field input">
            <label>Group Name</label>
            <input type="text" name="gname" placeholder="Group Name" required>
          </div>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" title="myfile" required>
        </div>
        <div class="search">
          <span class="text">Search a user to select</span>
          <input type="text"placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="selectUser">
        </div>
        <div class="field button">
          <input type="submit" value="Create group">
        </div>
      </form>
    </section>
  </div>
  <script src="javascript/groupsignup.js"></script>
</body>
</html>