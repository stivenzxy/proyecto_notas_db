document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("crearInscripcion-form");
  
    form.addEventListener("submit", function (event) {
      event.preventDefault();
  
      const formData = new FormData(form);
      const xhr = new XMLHttpRequest();
  
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
  
            if (response.success === 1) {
              inscripcionCreada();
            } else {
              Error();
            }
          } else {
            console.error("Error:", xhr.status);
          }
        }
      };
  
      function inscripcionCreada() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'success',
            title: 'Perfecto!',
            text: 'La inscripcion se creo correctamente'
        }).then(() => {
            window.location.reload();
        });
      }

      function Error() {
        Swal.fire({
            title: "ERROR!",
            text: "los datos estan vacios o la inscripcion ya existe",
            icon: "error",
            allowOutsideClick: false, // permite que la alerta no se cierre si clikeas fuera de ella
            allowEscapeKey: false, // si das esc no se sale de la alerta
            showConfirmButton: true,
            confirmButtonText: "Aceptar",
            confirmButtonColor: "red",
          });
      }
  
      xhr.open("POST", "controllers/inscripcionesController.php", true);
      xhr.send(formData);
    });
  });
  