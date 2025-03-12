
-- CREAMOS LA BASE DE DATOS
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    is_deleted BOOLEAN DEFAULT false
);

CREATE TABLE ordenes (
    id SERIAL PRIMARY KEY,
    usuario_id INT REFERENCES usuarios(id),
    producto VARCHAR(100),
    cantidad INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar Usuarios y Órdenes
INSERT INTO usuarios (nombre, email) VALUES 
('Juan Pérez', 'juan@example.com'),
('María López', 'maria@example.com');

INSERT INTO ordenes (usuario_id, producto, cantidad) VALUES 
(1, 'Laptop', 1),
(1, 'Mouse', 2),
(2, 'Teclado', 1);

-- Ejemplo de Hard Delete (Eliminación Física)
DELETE FROM usuarios WHERE id = 1;

/*Problema: Esto eliminará a Juan Pérez, pero sus órdenes seguirán existiendo en la tabla ordenes, lo que puede generar datos huérfanos.*/

------ Ejemplo de Soft Delete (Eliminación Lógica)
UPDATE usuarios SET is_deleted = true WHERE id = 1;

------ Ahora, cuando queramos obtener los usuarios activos, usamos este filtro:
SELECT * FROM usuarios WHERE is_deleted = false;

------ Y si queremos ver las órdenes solo de usuarios activos:
SELECT o.* FROM ordenes o
JOIN usuarios u ON o.usuario_id = u.id
WHERE u.is_deleted = false;

-- Recuperar un Usuario Eliminado con Soft Delete
UPDATE usuarios SET is_deleted = false WHERE id = 1;
