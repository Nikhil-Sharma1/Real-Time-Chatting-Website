const searchbar = document.querySelector(".users .search input"),
  searchBtn = document.querySelector(".users .search button"),
  usersList = document.querySelector(".users .users-list"),
  form = document.querySelector('.formDp'),
  image = document.getElementById('dp'),
  Dp = document.getElementById("changeDp"),
  Exit = document.getElementsByClassName('.Exit'),
  Delete = document.getElementsByClassName('.Delete'),
  stats = document.getElementById('stats');




// setTimeout(() => {
//   console.log(stats.innerHTML);
// });
Delete.onclick = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/delete.php", true);
}

Exit.onclick = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/exit.php", true);
}

searchBtn.onclick = () => {
  searchbar.classList.toggle("active");
  searchbar.focus();
  searchBtn.classList.toggle("active");
}

Dp.onchange = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/insert-dpimage.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        if (data.substring(data.length - 7) != "success") {
          alert("Dp changed successfully");
          image.src = `php/images/${data}`;
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
}
//Toggling the class means if there is no class name assigned to the element, 
//then a class name can be assigned to it dynamically or
// if a certain class is already present, then it can be removed dynamically by just using the toggle()
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
    x.open("POST", "php/search.php", true);
    x.onload = () => {
      if (x.readyState === XMLHttpRequest.DONE) {
        if (x.status === 200) {
          let data = x.response;
          //console.log(data);
          usersList.innerHTML = data;
        }
      }
    }
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//To POST data like an HTML form
    x.send("searchTerm=" + searchTerm);//header: specifies the header name 
    //value: specifies the header value
  }
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
        stats.innerText = data;
        console.log(data);
      }
    }
  }
  x.send()
}, 500);


setInterval(() => {
  let x = new XMLHttpRequest();
  x.open("GET", "php/users.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        //console.log(data);
        if (!searchbar.classList.contains("active")) {
          usersList.innerHTML = data;
        }
      }
    }
  }
  x.send()
}, 500);

