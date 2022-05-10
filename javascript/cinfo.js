const searchbar = document.querySelector(".info .search input"),
  searchBtn = document.querySelector(".info .search button"),
  infoList = document.querySelector(".info .info-list");

//console.log(adduser);





searchBtn.onclick = () => {
  searchbar.classList.toggle("active");
  searchbar.focus();
  searchBtn.classList.toggle("active");
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