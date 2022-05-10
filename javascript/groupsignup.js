const form = document.querySelector(".signup form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-txt"),
  usersList = form.querySelector(".selectUser"),
  searchbar = document.querySelector(".search input"),
  searchBtn = document.querySelector(".search button");

form.onsubmit = (e) => {
  e.preventDefault();
};

searchBtn.onclick = (e) => {
  e.preventDefault();
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
    x.open("POST", "php/gsearch.php", true);
    x.onload = () => {
      if (x.readyState === XMLHttpRequest.DONE) {
        if (x.status === 200) {
          let data = x.response;
          console.log(data);
          usersList.innerHTML = data;
        }
      }
    }
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//To POST data like an HTML form
    x.send("searchTerm=" + searchTerm);//header: specifies the header name 
    //value: specifies the header value
  }
}
setTimeout(() => {
  let x = new XMLHttpRequest();
  x.open("GET", "php/selectusers.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        //alert(data);
        console.log(data);
        usersList.innerHTML = data;
      }
    }
  };
  x.send();
});




continueBtn.onclick = () => {
  let x = new XMLHttpRequest();
  x.open("Post", "php/groupsignup.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        if (data == "success") {
          //location.href = "users.php";
          //g_id = data;
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  };
  let formData = new FormData(form);
  x.send(formData);

  setTimeout(() => {
    var markedCheckbox = document.getElementsByName("user");
    for (var checkbox of markedCheckbox) {
      if (checkbox.checked) {
        let xhr = new XMLHttpRequest();
        xhr.open("Post", `php/insert-user-in-group.php`, true);
        xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              let data = xhr.response;
              if (data == "success") {
                location.href = "users.php";
                console.log(data);
              } else {
                console.log(data);
                errorText.textContent = data;
                errorText.style.display = "block";
              }
            }
          }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("user_id=" + checkbox.value);
      }
      //console.log(checkbox.value);
    }
  }, 2000);

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

};
