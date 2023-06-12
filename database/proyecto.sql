CREATE TABLE cursos(
	cod_curso INT PRIMARY KEY NOT NULL, CHECK(cod_curso>=0),
	nomb_curso VARCHAR(50) NOT NULL
);

CREATE TABLE estudiantes(
	cod_est INT PRIMARY KEY NOT NULL, CHECK(cod_est>=0),
	nomb1_est VARCHAR(50),
	nomb2_est VARCHAR(50),
	ape_paterno VARCHAR(50),
	ape_materno VARCHAR(50)
);

CREATE TABLE inscripciones(
	cod_curso INT NOT NULL, CHECK(cod_curso>=0),
	cod_est INT NOT NULL, CHECK(cod_est>=0),
	periodo INT NOT NULL, CHECK(periodo>=0),
	anio INT NOT NULL, CHECK(anio>=0)
);
ALTER TABLE inscripciones ADD CONSTRAINT pk_inscrip PRIMARY KEY(cod_curso,cod_est,periodo,anio);
ALTER TABLE inscripciones ADD CONSTRAINT fk_cursos FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE inscripciones ADD CONSTRAINT fk_estudiantes FOREIGN KEY (cod_est) REFERENCES estudiantes(cod_est) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE TABLE notas(
	nota INT PRIMARY KEY NOT NULL, CHECK(nota>=0),
	descripcion VARCHAR(300),
	porcentaje INT, CHECK(porcentaje>=0 AND porcentaje<=100),
	posicion INT NOT NULL UNIQUE, CHECK(posicion>=0),
	cod_curso INT NOT NULL, CHECK(cod_curso>=0)
);
ALTER TABLE notas ADD CONSTRAINT fk_cod_curso FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE calificaciones(
	cod_cal INT,CHECK(cod_cal>=0),
	valor REAL, CHECK(valor>=0),
	fecha DATE NOT NULL,
	cod_curso INT NOT NULL, CHECK(cod_curso>=0),
	cod_est INT NOT NULL, CHECK(cod_est>=0),
	periodo INT NOT NULL, CHECK(periodo>=0),
	anio INT NOT NULL, CHECK(anio>=0),
	nota INT NOT NULL, CHECK(nota>=0)
);

ALTER TABLE calificaciones ADD CONSTRAINT pk_calificaciones PRIMARY KEY(cod_cal,cod_curso,cod_est,periodo,anio,nota);
ALTER TABLE calificaciones ADD CONSTRAINT fk_inscripciones_cal FOREIGN KEY (cod_curso,cod_est,periodo,anio) REFERENCES inscripciones(cod_curso,cod_est,periodo,anio) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE calificaciones ADD CONSTRAINT fk_notas_cal FOREIGN KEY (nota) REFERENCES notas(nota) ON DELETE CASCADE ON UPDATE CASCADE;

COPY estudiantes(cod_est,nomb1_est,nomb2_est,ape_paterno,ape_materno) FROM '/tmp/estudiantes.csv' DELIMITER ',' CSV HEADER;
COPY cursos(cod_curso,nomb_curso) FROM '/tmp/cursos.csv' DELIMITER ',' CSV HEADER;
COPY inscripciones(cod_curso,cod_est,anio,periodo) FROM '/tmp/inscripciones.csv' DELIMITER ',' CSV HEADER;
