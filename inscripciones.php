<?php require('./layout/header.php')?>
<main>
    <div class="container">
        <div class="subtitle">
            <h2>Registro de notas - Fecha: <span id="current_date"></span></h2>
            <script>
				date = new Date();
				year = date.getFullYear();
				month = date.getMonth() + 1;
				day = date.getDate();
				document.getElementById("current_date").innerHTML = day + "/" + month + "/" + year;
            </script>
        </div>
        <div class="title">Inscripciones de docente</div>
        <form method="post" id="form-cursos" action="controllers/inscripcionesController.php">
            <div class="cursos-details">
                <label for="cursos" class="cursos-selector">Cursos:</label>
                <select id="cursos" name="cursos">
                    <option value="Bases de datos">Bases de datos</option>
                    <option value="Redes de computadores">Redes de computadores</option>
                </select>
                <div class="input-box">
                    <span class="details">Año:</span>
                    <input type="number" id="anio" min="2020" max="2050" name="anio" placeholder="año" required>
                </div>
                <div class="radio-container">
                    <h4>Periodo: </h4>
                    <input type="radio" id="periodo1" name="periodo" value="1" required>
                    <label for="periodo1" class="radio-custom">Periodo I</label>
                </div>
                <div class="radio-container">
                    <input type="radio" id="periodo2" name="periodo" value="2" required>
                    <label for="periodo2" class="radio-custom">Periodo II</label>
                </div>
                <button type="submit" id="button">Ver listado de estudiantes</button>
                <input type="hidden" name="action" value="verListado">
                <!--<button type="submit" id="button2">Crear Inscripcion</button>
                <input type="hidden" name="action" value="crearInscripcion">-->
            </div>
            <br><br>
        </form>
    </div>
</main>
<script type="module" src="./js/verInscripcionController.js"></script>
<?php require('./layout/footer.php')?>