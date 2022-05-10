<?php
 session_start();
 $video_link=$_GET['video_link'];
?>
<!doctype>
<html>
<head>
<title> multimedia tags</title>
</head>
<body>
<video width="1400" height="700px"controls autoplay>
<source src=" <?php echo "php/videos/$video_link" ?> "type="video/mp4">
not supported tag
</video>
</body>
</html>