const form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
}

continueBtn.onclick = () => {

  let x = new XMLHttpRequest();
  x.open("Post", "php/login.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
        console.log(data);
        if (data == "success") {
          location.href = 'users.php';
        }
        else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  }
  let formData = new FormData(form);
  x.send(formData);
}
