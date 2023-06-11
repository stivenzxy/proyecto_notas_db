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
	cod_curso INT NOT NULL,
	cod_est INT NOT NULL,
	periodo INT NOT NULL,
	anio INT NOT NULL
);
ALTER TABLE inscripciones ADD CONSTRAINT pk_inscrip PRIMARY KEY(cod_curso,cod_est,periodo,anio);
ALTER TABLE inscripciones ADD CONSTRAINT fk_cursos FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso);
ALTER TABLE inscripciones ADD CONSTRAINT fk_estudiantes FOREIGN KEY (cod_est) REFERENCES estudiantes(cod_est);

CREATE TABLE notas(
	nota INT PRIMARY KEY NOT NULL, CHECK(nota>=0),
	descripcion VARCHAR(300),
	porcentaje INT, CHECK(porcentaje>=0 AND porcentaje<=100),
	posicion INT NOT NULL UNIQUE,
	cod_curso INT NOT NULL
);
ALTER TABLE notas ADD CONSTRAINT fk_cod_curso FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso);

CREATE TABLE calificaciones(
	cod_cal INT,CHECK(cod_cal>=0),
	valor REAL,
	fecha DATE NOT NULL,
	cod_curso INT NOT NULL,
	cod_est INT NOT NULL,
	periodo INT NOT NULL,
	anio INT NOT NULL,
	nota INT NOT NULL
);

ALTER TABLE calificaciones ADD CONSTRAINT pk_calificaciones PRIMARY KEY(cod_cal,cod_curso,cod_est,periodo,anio,nota);
ALTER TABLE calificaciones ADD CONSTRAINT fk_inscripciones_cal FOREIGN KEY (cod_curso,cod_est,periodo,anio) REFERENCES inscripciones(cod_curso,cod_est,periodo,anio);
ALTER TABLE calificaciones ADD CONSTRAINT fk_notas_cal FOREIGN KEY (nota) REFERENCES notas(nota);

COPY estudiantes(cod_est,nomb1_est,nomb2_est,ape_paterno,ape_materno) FROM '/tmp/estudiantes.csv' DELIMITER ',' CSV HEADER;
COPY cursos(cod_curso,nomb_curso) FROM '/tmp/cursos.csv' DELIMITER ',' CSV HEADER;
COPY inscripciones(cod_curso,cod_est,periodo,anio) FROM '/tmp/inscripciones.csv' DELIMITER ',' CSV HEADER;