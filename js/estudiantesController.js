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




document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form-addStudent");

  /////////////////////////////////////////////

  function actualizarTablaEstudiantes() {
    const tablaEstudiantes = document.getElementById("tablaEstudiantes");

    // Realiza la solicitud Ajax para obtener los nuevos datos de la tabla
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const nuevosDatos = xhr.responseText;
          //console.log(nuevosDatos);
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
      text: "El estudiante fue creado y agregado correctamente en el curso, fecha y periodo actual",
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

  function InsercionFallida() {
    Swal.fire({
      title: "Insercion Fallida!",
      text: "El codigo de estudiante ingresado ya existe en la base de datos",
      icon: "error",
      allowOutsideClick: false, // permite que la alerta no se cierre si clikeas fuera de ella
      allowEscapeKey: false, // si das esc no se sale de la alerta
      showConfirmButton: true,
      confirmButtonText: "Aceptar",
      confirmButtonColor: "red",
    });
  }

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const formDataEst = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);

          if (response.success === 1) {
            InsercionExitosa();
          } else {
            InsercionFallida();
          }
        } else {
          console.error("Error:", xhr.status);
        }
      }
    };

    xhr.open("POST", "../controllers/estudiantesController.php", true); //Con post los datos se envian sin ser parte del cuerpo de la URL
    xhr.send(formDataEst);
  });
});
