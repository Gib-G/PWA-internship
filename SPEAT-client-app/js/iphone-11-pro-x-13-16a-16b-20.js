var password;
var eyeImage = document.getElementById("eye-image");

function showPassword() {  
  if (document.getElementById("password") == null) {
    password = document.getElementById("editable-password");
  } else {
    password = document.getElementById("password");
  }

  if (password.type == "password") {
    password.type = "text";
    eyeImage.src = "../assets/eye-slash.svg";
  } else {
    password.type = "password";
    eyeImage.src = "../assets/eye.svg"
  }
}