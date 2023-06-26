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
            timer: 1000,
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
          text: "los datos están vacíos o la inscripción ya existe",
          icon: "error",
          allowOutsideClick: false,
          allowEscapeKey: false,
          showConfirmButton: true,
          confirmButtonText: "Aceptar",
          confirmButtonColor: "red",
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          }
        });
      }
  
      xhr.open("POST", "controllers/inscripcionesController.php", true);
      xhr.send(formData);
    });
  });
  