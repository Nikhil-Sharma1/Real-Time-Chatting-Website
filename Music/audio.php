<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NON STOP PLAYER</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <ul>
      <li class="brand"><img src="logo.png" alt="Spotify">NON STOP PLAYER</li>
      <li>Home</li>
      <li>About</li>
    </ul>
  </nav>
  <div class="container">
    <div class="songList">
      <h1>Best of NCS- No Copyright Sounds</h1>
      <div class="songitemcontainer">
        
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="0" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="1" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="2" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="3" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="4" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="5" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="6" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="7" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="8" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="9" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div> 
        <div class="songitem">
          <img src="1.jpg" alt="1">
          <span class="songName">Let Me Love You</span>
          <span class="songlistplay">
            <span class="timestamp"><span class="timeOfSong">05:34</span> <i id="10" class="far songItemPlay fa-play-circle"></i></span>
          </span>
        </div>
      </div>
    </div>
    <div class="songBanner"></div>
  </div>
  <div class="bottom">
    <input type="range" name="range" id="myProgressBar" min="0" value=0 max="100">
    <div class="icons">
      <!-- fontawesome icons -->
      <i class="fas fa-3x fa-step-backward" id="previous"></i>
      <i class="far fa-3x fa-play-circle" id="masterPlay"></i>
      <i class="fas fa-3x fa-step-forward" id="next"></i>
    </div>
    <div class="songInfo">
      <img src="playing.gif" width=42px alt="" id="gif"><span id="masterSong"></span> 
    </div>
  </div>
  <script src="https://kit.fontawesome.com/1c79c9d694.js" crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>
</html>