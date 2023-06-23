document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
  
    form.addEventListener("submit", function (event) {
      event.preventDefault();
  
      const formData = new FormData(form);
      const xhr = new XMLHttpRequest();
  
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            console.log(xhr.responseText);
            if (response.success === 1) {
              window.location.href = "views/tablaEstudiantes.php";
            } else {
              SessionError();
            }
          } else {
            console.error("Error:", xhr.status);
          }
        }
      };
  
      function SessionError(){
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
            icon: 'error',
            title: 'Oops...',
            text: '¡Datos Incorrectos!'
        }).then(() => {
            window.location.reload();
        });
    }
  
      xhr.open("POST", "../controllers/usuariosController.php", true);
      xhr.send(formData);
    });
  });
  