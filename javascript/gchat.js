const form = document.querySelector('.typing-area'),
  inputfield = form.querySelector('.input-field'),
  sendbtn = form.querySelector('button'),
  chatbox = document.querySelector('.chat-box'),
  masterPlay = document.getElementById('folder'),
  file = document.getElementById('Folder-content'),
  image = document.getElementById('Image-file'),
  video = document.getElementById('Video-file'),
  audio = document.getElementById('Audio-file'),
  outgoingId = document.getElementById('outgoing'),
  filescope = document.querySelector(".filescope"),
  groupId = document.getElementById('group');

// window.onbeforeunload = function () {
//   window.location.replace("php/close.php");
//   console.log("hi");
// }


const searchbar = document.querySelector(".chat-area .search input"),
  searchBtn = document.querySelector(".chat-area .search button");


searchBtn.onclick = () => {
  searchbar.classList.toggle("active");
  searchbar.focus();
  searchBtn.classList.toggle("active");
}

searchbar.onkeyup = () => {
  let searchTerm = searchbar.value;
  if (searchTerm != "") {
    searchbar.classList.add("active");
  }
  else {
    searchbar.classList.remove("active");
  }
  if (searchbar.value == "") {
    searchBtn.classList.remove("active");
  }
  if (searchTerm != "") {
    let x = new XMLHttpRequest();
    x.open("POST", "php/gchat-search.php", true);
    x.onload = () => {
      if (x.readyState === XMLHttpRequest.DONE) {
        if (x.status === 200) {
          let data = x.response;
          console.log(data);
          chatbox.innerHTML = data;
        }
      }
    }
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//To POST data like an HTML form
    x.send("searchTerm=" + searchTerm);

    //header: specifies the header name 
    //value: specifies the header value
  }
}

form.onsubmit = (e) => {
  e.preventDefault();
}
console.log(audio);


document.addEventListener('click', function (event) {
  var isClickInsideElement = filescope.contains(event.target);
  if (!isClickInsideElement) {
    if (file.style.display == "block")
      file.style.display = "none";
    masterPlay.classList.remove('fa-folder-open');
    masterPlay.classList.add('fa-folder');
  }
});

masterPlay.addEventListener('click', () => {
  if (masterPlay.classList.contains("fa-folder")) {
    masterPlay.classList.remove('fa-folder');
    file.style.display = "block";
    masterPlay.classList.add('fa-folder-open');
  }
  else {
    masterPlay.classList.remove('fa-folder-open');
    masterPlay.classList.add('fa-folder');
    file.style.display = "none";
  }
})

sendbtn.onclick = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/insert-gchat.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        inputfield.value = "";
      }
    }
  }
  let formData = new FormData(form);
  x.send(formData);
}

image.onchange = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/insert-gimage.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        if (data.substring(data.length - 7) != "success") {
          alert(data);
        }
        else {
          let m = data.substring(0, data.length - 7);
          alert(m);
        }
      }
    }
  }
  let formData = new FormData(form);
  x.send(formData);
  masterPlay.classList.remove('fa-folder-open');
  masterPlay.classList.add('fa-folder');
  file.style.display = "none";
}


video.onchange = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/insert-gvideo.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        if (data.substring(data.length - 7) != "success") {
          alert(data);
        }
        else {
          let m = data.substring(0, data.length - 7);
          alert(m);
        }
      }
    }
  }
  let formData = new FormData(form);
  x.send(formData);
  masterPlay.classList.remove('fa-folder-open');
  masterPlay.classList.add('fa-folder');
  file.style.display = "none";
}



audio.onchange = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/insert-gaudio.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        if (data.substring(data.length - 7) != "success") {
          alert(data);
        }
        else {
          let m = data.substring(0, data.length - 7);
          alert(m);
        }
      }
    }
  }
  let formData = new FormData(form);
  x.send(formData);
  masterPlay.classList.remove('fa-folder-open');
  masterPlay.classList.add('fa-folder');
  file.style.display = "none";
}



chatbox.onmouseenter = () => {
  chatbox.classList.add("active");
}

chatbox.onmouseleave = () => {
  chatbox.classList.remove("active");
}

setInterval(() => {
  let x = new XMLHttpRequest();
  x.open("POST", "php/get-gchat.php", true);

  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        if (!searchbar.classList.contains("active")) {//to prevent from run to ajax responce at same time
          chatbox.innerHTML = data;                 //(1) from search and 2) from users.php
        }                                             //if searchbar not using, then add this data
        if (!chatbox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  }
  let formData = new FormData(form);
  x.send(formData);
}, 500);

function scrollToBottom() {
  chatbox.scrollTop = chatbox.scrollHeight;
}


window.addEventListener('beforeunload', function (e) {
  e.preventDefault();
  navigator.sendBeacon('php/close.php');
});

setTimeout(() => {
  let x = new XMLHttpRequest();
  x.open("GET", "php/open.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        //stats.innerText = data;
        console.log(data);
      }
    }
  }
  x.send()
}, 500);