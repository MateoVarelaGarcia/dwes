CREATE DATABASE mysitedb;
USE mysitedb;

CREATE TABLE tUsuarios (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellidos VARCHAR(100),
    email VARCHAR(200) UNIQUE,
    contraseña VARCHAR(200)
);

CREATE TABLE tPeliculas (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    url_imagen VARCHAR(200),
    director VARCHAR(100),
    año YEAR
);

CREATE TABLE tComentarios (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    comentario VARCHAR(2000),
    usuario_id INTEGER,
    pelicula_id INTEGER NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES tUsuarios(id),
    FOREIGN KEY (pelicula_id) REFERENCES tPeliculas(id)
);

-- Insertar usuarios
INSERT INTO tUsuarios (nombre, apellidos, email, contraseña) VALUES
('Alex', 'Turner', 'alex.turner@mail.com', 'pass123'),
('Matt', 'Helders', 'matt.helders@mail.com', 'rock456'),
('Jamie', 'Cook', 'jamie.cook@mail.com', 'music789'),
('Nick', 'O\'Malley', 'nick.omalley@mail.com', 'band321'),
('Brian', 'Storm', 'brian.storm@mail.com', 'wind999');

-- Insertar películas
INSERT INTO tPeliculas (nombre, url_imagen, director, año) VALUES
('Inception', 'https://upload.wikimedia.org/wikipedia/en/7/7f/Inception_ver3.jpg', 'Christopher Nolan', 2010),
('Interstellar', 'https://upload.wikimedia.org/wikipedia/en/b/bc/Interstellar_film_poster.jpg', 'Christopher Nolan', 2014),
('Pulp Fiction', 'https://upload.wikimedia.org/wikipedia/en/8/82/Pulp_Fiction_cover.jpg', 'Quentin Tarantino', 1994),
('Fight Club', 'https://upload.wikimedia.org/wikipedia/en/f/fc/Fight_Club_poster.jpg', 'David Fincher', 1999),
('The Matrix', 'https://upload.wikimedia.org/wikipedia/en/c/c1/The_Matrix_Poster.jpg', 'Lana Wachowski', 1999);

-- Insertar comentarios
INSERT INTO tComentarios (comentario, usuario_id, pelicula_id) VALUES
('Una película impresionante, la mejor de Nolan.', 1, 1),
('Los efectos especiales son brutales.', 2, 2),
('Diálogos increíbles, Tarantino en su máximo esplendor.', 3, 3),
('No se habla del Club de la Lucha...', 4, 4),
('La filosofía de Matrix sigue vigente hoy en día.', 5, 5);
