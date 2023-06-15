<?php require('./layout/header.php')?>
<main>
<div class="container">
        <div class="subtitle"><h2>Registro de notas - Fecha: </h2></div>
		<div class="title">Cursos de docente</div>
		<form method="post" id="form-cursos" action="controllers/cursosInstance.php">
			<div class="cursos-details">
				<label for="cursos" class="cursos-selector">Cursos:</label>
				<select id="cursos" name="cursos">
					<option value="Bases de datos">Bases de datos</option>
					<option value="Redes de computadores">Redes de computadores</option>
				</select>
				<div class="input-box">
					<span class="details">Año:</span>
					<input type="number" id="anio" name="anio" placeholder="año">
				</div>
				<div class="radio-container">
					<h4>Periodo: </h4>
  					<input type="radio" id="periodo1" name="periodo" value="1">
  					<label for="periodo1" class="radio-custom">Periodo I</label>
				</div>
				<div class="radio-container">
  					<input type="radio" id="periodo2" name="periodo" value="2">
  					<label for="periodo2" class="radio-custom">Periodo II</label>
				</div>
					<button type="submit" id="button">Ver listado de estudiantes</button>
			</div>
			<br><br>
		</form>
	</div>
</main>
<?php require('./layout/footer.php')?>
