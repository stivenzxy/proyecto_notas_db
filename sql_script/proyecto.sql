CREATE TABLE docentes(
	cod_docente INT PRIMARY KEY UNIQUE NOT NULL, CHECK(cod_docente>=0),
	p_nombre_doc VARCHAR(50) NOT NULL,
	s_nombre_doc VARCHAR(50) NOT NULL,
	ape_paterno_doc VARCHAR(50) NOT NULL,
	ape_materno_doc VARCHAR(50) NOT NULL
);


CREATE TABLE cursos(
	cod_curso INT PRIMARY KEY UNIQUE NOT NULL, CHECK(cod_curso>=0),
	nomb_curso VARCHAR(50) NOT NULL,
	cod_docente INT NOT NULL,
	CONSTRAINT fk_cod_docente FOREIGN KEY (cod_docente) REFERENCES docentes(cod_docente)
);

CREATE TABLE estudiantes(
	cod_est INT PRIMARY KEY NOT NULL, CHECK(cod_estudiante>=0),
	p_nom_est VARCHAR(50) NOT NULL,
	s_nombre_est VARCHAR(50) NOT NULL,
	ape_paterno_est VARCHAR(50) NOT NULL,
	ape_materno_est VARCHAR(50) NOT NULL
);

CREATE TABLE inscripciones(
	periodo INT NOT NULL,
	anio INT NOT NULL, CHECK(anio BETWEEN 1000 AND 9999),
	cod_curso INT NOT NULL UNIQUE,
	cod_est INT NOT NULL UNIQUE
);
ALTER TABLE inscripciones ADD CONSTRAINT pk_inscrip PRIMARY KEY(periodo,anio,cod_curso,cod_est);
ALTER TABLE inscripciones ADD CONSTRAINT fk_cursos FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso);
ALTER TABLE inscripciones ADD CONSTRAINT fk_estudiantes FOREIGN KEY (cod_est) REFERENCES estudiantes(cod_est);

CREATE TABLE notas(
	nota INT PRIMARY KEY UNIQUE NOT NULL, CHECK(nota>=0),
	descripcion VARCHAR(300),
	porcentaje INT NOT NULL, CHECK(porcentaje>=0 AND porcentaje<=100),
	posicion INT NOT NULL UNIQUE,
	cod_curso INT NOT NULL UNIQUE,
	CONSTRAINT fk_cod_curso FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso)
);

CREATE TABLE calificaciones(
	cod_cal INT PRIMARY KEY UNIQUE, CHECK(cod_cal>=0),
	valor REAL NOT NULL,
	fecha DATE NOT NULL,
	cod_curso INT NOT NULL UNIQUE,
	cod_est INT NOT NULL UNIQUE,
	periodo INT NOT NULL,
	anio INT NOT NULL,
	nota INT NOT NULL,
);

ALTER TABLE calificaciones ADD CONSTRAINT pk_calificaciones PRIMARY KEY(cod_cal,cod_curso,cod_est,periodo,año,nota);
ALTER TABLE calificaciones ADD CONSTRAINT fk_estudiantes_cal FOREIGN KEY (cod_est) REFERENCES estudiantes(cod_est);
ALTER TABLE calificaciones ADD CONSTRAINT fk_cursos_cal FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso);
ALTER TABLE calificaciones ADD CONSTRAINT fk_inscripciones_cal FOREIGN KEY (periodo,anio) REFERENCES inscripciones(periodo,anio);
/*ALTER TABLE calificaciones ADD CONSTRAINT fk_notas_cal FOREIGN KEY (nota) REFERENCES notas(nota);*/