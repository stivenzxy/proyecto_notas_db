<?php require('./layout/header.php')?>
<main>
    <div class="container">
        <div class="subtitle">
            <h2>Registro de estudiante - Fecha: <span id="current_date"></span></h2>
            <script>
            date = new Date();
            year = date.getFullYear();
            month = date.getMonth() + 1;
            day = date.getDate();
            document.getElementById("current_date").innerHTML = day + "/" + month + "/" + year;
            </script>
        </div>
        <div class="title">Registrar Estudiante</div>
        <div class="estudiante-form-container">
            <img src="resources/AddStudentModal.svg" class="est-image">
            <form method="post" id="addNewStudent" action="controllers/estudiantesController.php">
                <div class="input-box">
                    <span class="details1">Codigo: </span>
                    <input type="number" id="cod_est" name="cod_est" placeholder="Código de Estudiante" required>
                </div>
                <div class="input-box">
                    <span class="details2">Nombre:</span>
                    <input type="text" id="nomb_est" name="nomb_est" minlength="3" maxlength="50"
                        placeholder="Nombre del Estudiante" required><br>
                </div>
                <button type="submit" id="addStudentButton">Registrar</button>
                <input type="hidden" name="action" value="agregarEstudiante">
            </form>
        </div>
    </div>
</main>
<script type="module" src="js/registrarEstudiante.js"></script>
<?php require('./layout/footer.php')?>