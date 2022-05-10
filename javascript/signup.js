const form = document.querySelector(".signup form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
}

continueBtn.onclick = () => {

  let x = new XMLHttpRequest();
  x.open("Post", "php/signup.php", true);
  x.onload = () => {
    if (x.readyState === XMLHttpRequest.DONE) {
      if (x.status === 200) {
        let data = x.response;
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
