
-- Crear tabla sedes
CREATE TABLE sedes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Crear tabla salas con clave foránea a sedes
CREATE TABLE salas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    id_sedes INT,
    FOREIGN KEY (id_sedes) REFERENCES sedes(id)
);

-- Crear tabla marcas
CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Crear tabla equipos con claves foráneas a marcas y salas
CREATE TABLE equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255) NOT NULL,
    id_marca INT,
    id_sala INT,
    FOREIGN KEY (id_marca) REFERENCES marcas(id),
    FOREIGN KEY (id_sala) REFERENCES salas(id)
);

-- Crear tabla monitores
CREATE TABLE monitores (
    cc INT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Crear tabla mantenimientos con claves foráneas a equipos y monitores
CREATE TABLE mantenimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_mantenimiento VARCHAR(255) NOT NULL,
    problema VARCHAR(255) NOT NULL,
    descripcion TEXT,
    fecha DATE,
    id_equipo INT,
    quien_cc INT,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id),
    FOREIGN KEY (quien_cc) REFERENCES monitores(cc)
);

