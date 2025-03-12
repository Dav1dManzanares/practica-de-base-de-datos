-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tienda_videojuegos;
USE tienda_videojuegos;

-- Tabla Videojuegos
CREATE TABLE videojuegos (
    id_videojuego INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    plataforma VARCHAR(50) NOT NULL,
    genero VARCHAR(50),
    desarrollador VARCHAR(100),
    precio DECIMAL(10,2) NOT NULL,
    fecha_lanzamiento DATE,
    stock INT NOT NULL DEFAULT 0,
    clasificacion_edad VARCHAR(10)
);

-- Tabla Clientes
CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefono VARCHAR(20),
    direccion VARCHAR(200),
    fecha_registro DATE DEFAULT (CURRENT_DATE),
    membresia ENUM('Regular', 'Premium', 'VIP') DEFAULT 'Regular'
);

-- Tabla Empleados
CREATE TABLE empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(20) UNIQUE NOT NULL,
    cargo ENUM('Vendedor', 'Supervisor', 'Gerente') NOT NULL,
    fecha_contratacion DATE NOT NULL,
    salario DECIMAL(10,2),
    telefono VARCHAR(20),
    email VARCHAR(100) UNIQUE
);

-- Tabla Ventas (tabla para la relación entre clientes, empleados y videojuegos)
CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    fecha_venta DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_cliente INT NOT NULL,
    id_empleado INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    metodo_pago ENUM('Efectivo', 'Tarjeta', 'Transferencia') NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
);

-- Tabla intermedia para la relación N:M entre Ventas y Videojuegos
CREATE TABLE detalle_venta (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_videojuego INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta),
    FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego)
);