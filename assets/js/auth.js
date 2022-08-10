$(document).ready(function () {
  const re_email = "";
  const re_password = "";
  const re_first_last_name = "";

  $("#btnLogin").click(function (e) {
    e.preventDefault();
    loginFormValidation();
  });

  $("#btnRegister").click(function (e) {
    e.preventDefault();
    registerFormValidation();
  });
});

//  ? dodati regularne izraze i validaciju sa njima
const loginFormValidation = () => {
  let email = document.querySelector("#email-login").value;
  let password = document.querySelector("#password-login").value;

  let errors = [];
  if (email == "") {
    errors.push("Email isn't ok");
    createErrorMessage("email-login-error", classes, "Email isn't ok");
  } else {
    removeErrorMessage("email-login-error", classes);
  }
  if (password == "") {
    errors.push("Password isn't ok");
    createErrorMessage("password-login-error", classes, "Password isn't ok");
  } else {
    removeErrorMessage("password-login-error", classes);
  }

  if (errors.length == 0) {
    $.ajax({
      type: "post",
      url: "models/auth/login.php",
      data: { email, password },
      dataType: "json",
      success: (data) => {
        if (data == "1") {
          window.location.href = "admin.php";
        } else {
          window.location.href = "index.php";
        }
      },
      error: (jqXHR, statustTxt, xhr) => {
        console.log(jqXHR);
      },
    });
  }
};

// ? dodati regularne izraze i valicadiju sa njima
const registerFormValidation = () => {
  let first_name = document.querySelector("#first-name-register").value;
  let last_name = document.querySelector("#last-name-register").value;
  let email = document.querySelector("#email-register").value;
  let password = document.querySelector("#password-register").value;

  let errors = [];

  if (first_name == "") {
    errors.push("First name isnt' ok");
    createErrorMessage(
      "first-name-register-error",
      classes,
      "First name isn't ok"
    );
  } else {
    removeErrorMessage("first-name-register-error", classes);
  }

  if (last_name == "") {
    errors.push("Last name isn't ok");
    createErrorMessage(
      "last-name-register-error",
      classes,
      "Last name isn't ok"
    );
  } else {
    removeErrorMessage("last-name-register-error", classes);
  }

  if (email == "") {
    errors.push("Email isn't ok");
    createErrorMessage("email-register-error", classes, "Email isn't ok");
  } else {
    removeErrorMessage("email-register-error", classes);
  }

  if (password == "") {
    errors.push("Password isn't ok");
    createErrorMessage("password-register-error", classes, "Password isn't ok");
  } else {
    removeErrorMessage("password-register-error", classes);
  }

  if (errors.length == 0) {
    $.ajax({
      type: "post",
      url: "models/auth/register.php",
      data: { first_name, last_name, email, password },
      dataType: "JSON",
      success: (data) => {
        window.location.href = "index.php?page=login";
      },
      error: (jqXHR, statustTxt, xhr) => {
        createResponseMessage(
          "danger",
          jqXHR.responseJSON,
          "passwordRegistrationError"
        );
      },
    });
  }
};
