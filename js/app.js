var boton_register = document.getElementById("boton_register");

var nombre_us = document.getElementById("nombre_us");
var email_us = document.getElementById("email_us");
var contra_us = document.getElementById("contra_us");
var repContra_us = document.getElementById("repContra_us");

var usuario_invalido = document.getElementById("usuario_invalido");
var email_invalido = document.getElementById("email_invalido");
var contra_invalida = document.getElementById("contra_invalida");
var recontra_invalida = document.getElementById("recontra_invalida");

const RegExpressionName = /^[a-zA-Z\s]*$/; //NO ACEPTA LA LETRA Ñ
const RegExpressionEmail =
  /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

nombre_us.addEventListener("input", () => {
  if (nombre_us.classList.contains("is-invalid")) {
    //si tiene error y vuelve a escribir en el input quitar el error
    nombre_us.className = "form-control";
  }
});

email_us.addEventListener("input", () => {
  if (email_us.classList.contains("is-invalid")) {
    //si tiene error y vuelve a escribir en el input quitar el error
    email_us.className = "form-control";
  }
});

contra_us.addEventListener("input", () => {
  if (contra_us.classList.contains("is-invalid")) {
    //si tiene error y vuelve a escribir en el input quitar el error
    contra_us.className = "form-control";
  }
});

repContra_us.addEventListener("input", () => {
  if (repContra_us.classList.contains("is-invalid")) {
    //si tiene error y vuelve a escribir en el input quitar el error
    repContra_us.className = "form-control";
  }
});

boton_register.addEventListener("click", (event) => {
  /*VALIDACION DEL NOMBRE DE USUARIO*/
  if (nombre_us.value === "") {
    usuario_invalido.textContent = "Ingresa tu nombre";
    stopSubmit(event);
    nombre_us.className = "form-control is-invalid";
  } else if (!RegExpressionName.test(nombre_us.value)) {
    usuario_invalido.textContent = "Solo se permiten letras y espacios";
    nombre_us.className = "form-control is-invalid";
    stopSubmit(event);
  } else if (nombre_us.value.length > 30) {
    usuario_invalido.textContent = "Maximo 30 caracteres";
    nombre_us.className = "form-control is-invalid";
    stopSubmit(event);
  } else {
    nombre_us.className = "form-control is-valid";
  }

  /*VALIDACION DEL EMAIL DE USUARIO*/
  if (email_us.value === "") {
    email_invalido.textContent = "Ingresa tu email";
    email_us.classList.add("is-invalid");
    stopSubmit(event);
  } else if (!RegExpressionEmail.test(email_us.value)) {
    email_invalido.textContent = "Ingresa un email valido";
    email_us.className = "form-control is-invalid";
    stopSubmit(event);
  } else if (email_us.value.length > 45) {
    email_invalido.textContent = "Maximo 45 caracteres";
    email_us.className = "form-control is-invalid";
    stopSubmit(event);
  } else {
    email_us.className = "form-control is-valid";
  }

  /*VALIDACION DEL PASSWORD DE USUARIO*/
  if (contra_us.value === "") {
    contra_invalida.textContent = "Ingresa tu password";
    contra_us.classList.add("is-invalid");
    stopSubmit(event);
  } else if (contra_us.value != repContra_us.value) {
    contra_invalida.textContent = "Las contraseñas deben ser iguales";
    contra_us.classList.add("is-invalid");
    stopSubmit(event);
  } else if (contra_us.value.length > 30) {
    contra_invalida.textContent = "Maximo 30 caracteres";
    contra_us.className = "form-control is-invalid";
    stopSubmit(event);
  } else if (contra_us.value.length < 8) {
    contra_invalida.textContent = "Minimo 7 caracteres";
    contra_us.className = "form-control is-invalid";
    stopSubmit(event);
  } else {
    contra_us.className = "form-control is-valid";
  }

  if (repContra_us.value === "") {
    recontra_invalida.textContent = "Repite tu password";
    repContra_us.classList.add("is-invalid");
    stopSubmit(event);
  } else if (repContra_us.value != contra_us.value) {
    recontra_invalida.textContent = "Las contraseñas deben ser iguales";
    stopSubmit(event);
  } else if (repContra_us.value.length > 30) {
    recontra_invalida.textContent = "Maximo 30 caracteres";
    repContra_us.className = "form-control is-invalid";
    stopSubmit(event);
  } else if (contra_us.value.length < 8) {
    recontra_invalida.textContent = "Minimo 7 caracteres";
    repContra_us.className = "form-control is-invalid";
    stopSubmit(event);
  } else {
    repContra_us.className = "form-control is-valid";
  }
});

const stopSubmit = function (event) {
  //PREVENIR QUE SE ENVIEN LOS DATOS A PHP
  event.preventDefault();
  event.stopPropagation();
};
