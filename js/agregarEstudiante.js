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

    function InsercionExitosa() {
      Swal.fire({
        title: "Insercion Exitosa!",
        text: "El estudiante fue agregado correctamente",
        icon: "success",
        allowOutsideClick: false, // permite que la alerta no se cierre si clikeas fuera de ella
        allowEscapeKey: false, // si das esc no se sale de la alerta
        showConfirmButton: true,
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#86FFC7",
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

    xhr.open("POST", "../controllers/estudiantesInstance.php", true);
    xhr.send(formDataEst);
  });
});
