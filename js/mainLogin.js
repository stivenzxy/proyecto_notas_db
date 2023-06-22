window.addEventListener('load',() => {
    let button = document.getElementById('loginForm');
    let usuario = document.getElementById('user');
    let password = document.getElementById('pass');
    let alert = document.getElementById('alerta');

    console.log(usuario);

    function data(){
        let datos = new FormData();
        datos.append("user", usuario.value);
        datos.append("pass", password.value);
        fetch('controllers/usuariosController.php',{
            method: 'POST',
            body: datos
        }).then(Response => Response.text())
        .then(responseText => {
            console.log(responseText);
            const responseJson = JSON.parse(responseText);
            const { success } = responseJson;
            if(success === 1){
                location.href = 'views/home.php';
             }
            else {
                SessionError();
            }
        })
        .catch(error => console.log(error));
    }
    //console.log(Response) 

    function SessionError(){
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
            icon: 'error',
            title: 'Oops...',
            text: '¡Datos Incorrectos!'
        }).then(() => {
            window.location.reload();
        });
    }

    button.addEventListener('submit',(e) => {
        e.preventDefault();
        data();
    });
    
});