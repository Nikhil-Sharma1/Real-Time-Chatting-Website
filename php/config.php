<?php
  // $conn=mysqli_connect("localhost","root","","chat");
  $conn=mysqli_connect("sql207.epizy.com","epiz_31579388","zLmyupunrXZ","epiz_31579388_chat");
  if(!$conn)
  {
    echo "Database connected".mysqli_connect_error();
  }
?>