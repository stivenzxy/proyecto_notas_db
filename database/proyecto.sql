CREATE TABLE usuarios(
	codigo_usr INT PRIMARY KEY NOT NULL, CHECK(codigo_usr>=0),
	nomb1_usr VARCHAR(50),
	nomb2_usr VARCHAR(50),
	ape_paterno_usr VARCHAR(50),
	ape_materno_usr VARCHAR(50),
	passhash TEXT NOT NULL
);

CREATE TABLE cursos(
	cod_curso INT PRIMARY KEY NOT NULL, CHECK(cod_curso>=0),
	nomb_curso VARCHAR(50) NOT NULL,
	codigo_usr INT NOT NULL, CHECK(codigo_usr>=0)
);
ALTER TABLE cursos ADD CONSTRAINT fk_cod_usr FOREIGN KEY(codigo_usr) REFERENCES usuarios(codigo_usr) on DELETE RESTRICT ON UPDATE CASCADE;

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
	nota INT SERIAL PRIMARY KEY NOT NULL, CHECK(nota>=0),
	descripcion VARCHAR(300),
	porcentaje INT, CHECK(porcentaje>=0 AND porcentaje<=100),
	posicion INT NOT NULL UNIQUE, CHECK(posicion>=0),
	cod_curso INT NOT NULL, CHECK(cod_curso>=0)
);
ALTER TABLE notas ADD CONSTRAINT fk_cod_curso FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE calificaciones(
	cod_cal SERIAL,CHECK(cod_cal>=0),
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
COPY cursos(cod_curso,nomb_curso,codigo_usr) FROM '/tmp/cursos.csv' DELIMITER ',' CSV HEADER;
COPY inscripciones(cod_curso,cod_est,anio,periodo) FROM '/tmp/inscripciones.csv' DELIMITER ',' CSV HEADER;


CREATE extension pgcrypto;

CREATE OR REPLACE FUNCTION adduser(cod INT, n1 VARCHAR(50), n2 VARCHAR(50), a1 VARCHAR(50), 
a2 VARCHAR(50), pass TEXT) 
RETURNS VOID AS $$
DECLARE
BEGIN
insert into usuarios values(cod,n1,n2,a1,a2, crypt(pass, gen_salt('bf', 4)));

END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION authenticate(cod INT, pass TEXT) 
RETURNS INT AS $$
DECLARE
    cant INTEGER;
BEGIN
    SELECT COUNT(*) INTO cant FROM usuarios WHERE codigo_usr = cod AND passhash
	= crypt(pass, passhash);
    
    IF (cant > 0) THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END;
$$ LANGUAGE plpgsql;

SELECT adduser(1001,'Jesus','','Reyes','Carvajal','12345');



