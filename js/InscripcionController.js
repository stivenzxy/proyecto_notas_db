document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form-cursos");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);

          if (response.success === 1) {
            window.location.href = "views/tablaEstudiantes.php";
          } else {
            NoExistsInDB();
          }
        } else {
          console.error("Error:", xhr.status);
        }
      }
    };

    function NoExistsInDB() {
      Swal.fire({
        title: "Verifique los datos ingresados!",
        text: "No se encontraron estudiantes en la base de datos",
        icon: "warning",
        allowOutsideClick: false, // permite que la alerta no se cierre si clikeas fuera de ella
        allowEscapeKey: false, // si das esc no se sale de la alerta
        showConfirmButton: true,
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#5CBB8F",
      });
    }

    xhr.open("POST", "../controllers/inscripcionesController.php", true);
    xhr.send(formData);
  });
});
