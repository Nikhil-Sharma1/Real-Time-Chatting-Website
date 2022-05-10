const searchbar = document.querySelector(".info .search input"),
  searchBtn = document.querySelector(".info .search button"),
  infoList = document.querySelector(".info .info-list"),
  form = document.querySelector('.formDp'),
  addsearchbar = document.querySelector(".info .addsearch input"),
  addsearchBtn = document.querySelector(".info .addsearch button"),
  addsearch = document.querySelector(".addsearch"),
  image = document.getElementById('dp'),
  Dp = document.getElementById("changeDp"),
  userlist = document.querySelector(".selectUser"),
  addblock = document.querySelector(".addscope"),
  adduser = document.querySelector(".button"),
  insertuser = document.querySelector(".add");

//console.log(adduser);
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

adduser.onclick = () => {
  if (userlist.style.display == "none") {
    userlist.style.display = "block";
    insertuser.style.display = "block";
    addsearch.style.display = "block";
  }
  else {
    userlist.style.display = "none";
    insertuser.style.display = "none";
    addsearch.style.display = "none";
  }
}
insertuser.onclick = () => {
  var markedCheckbox = document.getElementsByName("user");
  for (var checkbox of markedCheckbox) {
    if (checkbox.checked) {
      let xhr = new XMLHttpRequest();
      xhr.open("Post", `php/insert-user-in-group.php`, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("user_id=" + checkbox.value);
    }
  }
  setTimeout(() => {
    let x = new XMLHttpRequest();
    x.open("GET", "php/info.php", true);
    x.onload = () => {
      if (x.readyState === XMLHttpRequest.DONE) {
        if (x.status === 200) {
          let data = x.response;
          if (!searchbar.classList.contains("active")) {
            infoList.innerHTML = data;
          }
        }
      }
    }
    x.send()
  }, 500);
  userlist.style.display = "none";
  addsearch.style.display = "none";
  insertuser.style.display = "none";
}


document.addEventListener('click', function (event) {
  var isClickInsideElement = addblock.contains(event.target);
  if (!isClickInsideElement) {
    if (userlist.style.display == "block")
      userlist.style.display = "none";
    insertuser.style.display = "none";
    addsearch.style.display = "none";
  }
});

searchBtn.onclick = () => {
  searchbar.classList.toggle("active");
  searchbar.focus();
  searchBtn.classList.toggle("active");
}

addsearchBtn.onclick = () => {
  addsearchbar.classList.toggle("active");
  addsearchbar.focus();
  addsearchBtn.classList.toggle("active");
}

Dp.onchange = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/insert-gdpimage.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        if (data.substring(data.length - 7) != "success") {
          alert("Dp changed succesdsfully");
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
    setTimeout(() => {
      let x = new XMLHttpRequest();
      x.open("GET", "php/info.php", true);
      x.onload = () => {
        if (x.readyState === XMLHttpRequest.DONE) {
          if (x.status === 200) {
            let data = x.response;
            // console.log(data);
            if (!searchbar.classList.contains("active")) {//to prevent from run to ajax responce at same time
              infoList.innerHTML = data;                 //(1) from search and 2) from users.php
            }                                             //if searchbar not using, then add this data
          }
        }
      }
      x.send()
    }, 500);
  }
  if (searchbar.value == "") {
    searchBtn.classList.remove("active");
    setTimeout(() => {
      let x = new XMLHttpRequest();
      x.open("GET", "php/info.php", true);
      x.onload = () => {
        if (x.readyState === XMLHttpRequest.DONE) {
          if (x.status === 200) {
            let data = x.response;
            // console.log(data);
            if (!searchbar.classList.contains("active")) {
              infoList.innerHTML = data;
            }
          }
        }
      }
      x.send()
    }, 500);
  }
  if (searchTerm != "") {
    let x = new XMLHttpRequest();
    x.open("POST", "php/infosearch.php", true);
    x.onload = () => {
      if (x.readyState === XMLHttpRequest.DONE) {
        if (x.status === 200) {
          let data = x.response;
          console.log(data);
          infoList.innerHTML = data;
        }
      }
    }
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//To POST data like an HTML form
    x.send("searchTerm=" + searchTerm);//header: specifies the header name 
    //value: specifies the header value
  }
}



addsearchbar.onkeyup = () => {
  let searchTerm = addsearchbar.value;
  if (searchTerm != "") {
    addsearchbar.classList.add("active");
  }
  else {
    addsearchbar.classList.remove("active");
  }
  if (addsearchbar.value == "") {
    addsearchBtn.classList.remove("active");
  }
  if (searchTerm != "") {
    let x = new XMLHttpRequest();
    x.open("POST", "php/addsearch.php", true);
    x.onload = () => {
      if (x.readyState === XMLHttpRequest.DONE) {
        if (x.status === 200) {
          let data = x.response;
          console.log(data);
          userlist.innerHTML = data;
        }
      }
    }
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//To POST data like an HTML form
    x.send("searchTerm=" + searchTerm);//header: specifies the header name 
    //value: specifies the header value
  }
}
// let xhr = new XMLHttpRequest();
// xhr.open("POST", "php/open.php", true);


setTimeout(() => {
  let x = new XMLHttpRequest();
  x.open("GET", "php/info.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        // console.log(data);
        if (!searchbar.classList.contains("active")) {//to prevent from run to ajax responce at same time
          infoList.innerHTML = data;                 //(1) from search and 2) from users.php
        }                                             //if searchbar not using, then add this data
      }
    }
  }
  x.send()
}, 500);

setTimeout(() => {
  let x = new XMLHttpRequest();
  x.open("GET", "php/addusers.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        //alert(data);
        //console.log(data);
        userlist.innerHTML = data;
      }
    }
  };
  x.send();
});