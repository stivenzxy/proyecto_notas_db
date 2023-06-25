const OpenModal = document.querySelector("#header-button");
const modal = document.querySelector(".modal");
const closeModal = document.querySelector(".modal-close");

OpenModal.addEventListener("click", (e) => {
  e.preventDefault(); // Oculta el comportamiento por defecto del evento (#)
  modal.classList.add("modal--show");
});

closeModal.addEventListener("click", (e) => {
  e.preventDefault();
  modal.classList.remove("modal--show");
});



/***OPERACIONES INSCRIBIR CREAR ESTUDIANTES** */
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form-addExistingStudent");

  /////////////////////////////////////////////

  function actualizarTablaEstudiantes() {
    const tablaEstudiantes = document.getElementById("tablaEstudiantes");

    // Realiza la solicitud Ajax para obtener los nuevos datos de la tabla
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const nuevosDatos = xhr.responseText;
          console.log(nuevosDatos);
          tablaEstudiantes.innerHTML = nuevosDatos;
        } else {
          console.error("Error:", xhr.status);
        }
      }
    };

    xhr.open("GET", "../controllers/actualizarTabla.php", true); // Solicita la informacion del servidor a traves del archivo actualizarTabla.php
    xhr.send();
  }

  ///////////////////////////////////////////

  function InsercionExitosa() {
    Swal.fire({
      title: "Inscripcion Exitosa!",
      text: "El estudiante fue agregado a la presente inscripcion correctamente",
      icon: "success",
      allowOutsideClick: false, // permite que la alerta no se cierre si clikeas fuera de ella
      allowEscapeKey: false, // si das esc no se sale de la alerta
      showConfirmButton: true,
      confirmButtonText: "Aceptar",
      confirmButtonColor: "#86FFC7",
    }).then(() => {
      actualizarTablaEstudiantes();
    });
  }

  function Error() {
    Swal.fire({
      title: "El estudiante ya se encuentra inscrito",
      text: "El estudiante ya fue agregado a la presente inscripcion",
      icon: "error",
      allowOutsideClick: false, // permite que la alerta no se cierre si clikeas fuera de ella
      allowEscapeKey: false, // si das esc no se sale de la alerta
      showConfirmButton: true,
      confirmButtonText: "Aceptar",
      confirmButtonColor: "red",
    })
  }

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const formDataEst = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          console.log(xhr.responseText);
          
          if (response.success === 1) {
            InsercionExitosa();
          } else {
            Error();
          }

        } else {
          console.error("Error:", xhr.status);
        }
      }
    };

    xhr.open("POST", "../controllers/inscripcionesController.php", true); //Con post los datos se envian sin ser parte del cuerpo de la URL
    xhr.send(formDataEst);
  });
});
