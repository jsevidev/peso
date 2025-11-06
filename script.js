function show_pass_func() {
  var x = document.getElementById("password");
  var btn = document.querySelector(".toggle-password span");
  var icon = document.querySelector(".toggle-password i");
  if (x.type === "password") {
    x.type = "text";
    btn.textContent = "Show";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  } else {
    x.type = "password";
    btn.textContent = "Hide";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  }
}

//e fix pani

