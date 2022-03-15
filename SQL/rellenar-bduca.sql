-- Centros
INSERT INTO centro (nombre_centro) VALUES ('ESI');

-- Grados
INSERT INTO grado (id_centro, nombre_grado) VALUES ((SELECT id_centro FROM centro WHERE nombre_centro = 'ESI' ),'Informatica');

-- Usuarios
INSERT INTO usuario (nombre, apellido, dni, tipo) VALUES ('Jose', 'Bautista Lazar', '58574796Y', 1);
INSERT INTO usuario (nombre, apellido, dni, tipo) VALUES ('Nicolas', 'Priego Cadenas', '94493273G', 2);
INSERT INTO usuario (nombre, apellido, dni, tipo) VALUES ('Laura', 'Muriel Arcos', '40714384Z', 2);

-- Profesores
INSERT INTO profesor (id_usuario) VALUES ((SELECT id_usuario FROM usuario WHERE dni = '94493273G'));
INSERT INTO profesor (id_usuario) VALUES ((SELECT id_usuario FROM usuario WHERE dni = '40714384Z'));

-- Asignaturas
INSERT INTO asignatura (nombre_asig, id_grado, id_profesor) VALUES ('POO', (SELECT id_grado FROM grado WHERE nombre_grado = 'Informatica'), (1));
INSERT INTO asignatura (nombre_asig, id_grado, id_profesor) VALUES ('PW', (SELECT id_grado FROM grado WHERE nombre_grado = 'Informatica'), (2));

-- Temas
INSERT INTO tema (nombre_tema, id_asignatura) VALUES ('Paradigma de la POO', (SELECT id_asig FROM asignatura WHERE nombre_asig = 'POO'));
INSERT INTO tema (nombre_tema, id_asignatura) VALUES ('Polimorfismo', (SELECT id_asig FROM asignatura WHERE nombre_asig = 'POO'));
INSERT INTO tema (nombre_tema, id_asignatura) VALUES ('Introduccion PHP', (SELECT id_asig FROM asignatura WHERE nombre_asig = 'PW'));
INSERT INTO tema (nombre_tema, id_asignatura) VALUES ('Frameworks', (SELECT id_asig FROM asignatura WHERE nombre_asig = 'PW'));

-- Alumno
INSERT INTO alumno (id_usuario, id_asignatura) VALUES ((SELECT id_usuario FROM usuario WHERE dni = '58574796Y'), (SELECT id_asig FROM asignatura WHERE nombre_asig = 'POO'));
INSERT INTO alumno (id_usuario, id_asignatura) VALUES ((SELECT id_usuario FROM usuario WHERE dni = '58574796Y'), (SELECT id_asig FROM asignatura WHERE nombre_asig = 'PW'));

-- Examenes
INSERT INTO examen (nombre_examen, id_tema) VALUES ('Clases y Objetos', (SELECT id_tema FROM tema WHERE nombre_tema = 'Paradigma de la POO'));
INSERT INTO examen (nombre_examen, id_tema) VALUES ('Administrador Web', (SELECT id_tema FROM tema WHERE nombre_tema = 'Introduccion PHP'));
INSERT INTO examen (nombre_examen, id_tema) VALUES ('Laravel', (SELECT id_tema FROM tema WHERE nombre_tema = 'Frameworks'));

-- Calificaciones
INSERT INTO calificacion (id_alumno, id_examen, calificacion) VALUES (1, (SELECT id_examen FROM examen WHERE nombre_examen = 'Clases y Objetos'), 8);
INSERT INTO calificacion (id_alumno, id_examen, calificacion) VALUES (1, (SELECT id_examen FROM examen WHERE nombre_examen = 'Laravel'), 4);