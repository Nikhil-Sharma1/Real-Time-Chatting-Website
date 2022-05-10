const pass = document.querySelector(".form input[type='password']"),
  togglebtn = document.querySelector(".form .field i");

togglebtn.onclick = () => {
  if (pass.type == "password") {
    pass.type = "text";
    togglebtn.classList.add("active");
  }
  else {
    pass.type = "password";
    togglebtn.classList.remove("active");
  }
}