-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2017 a las 05:46:39
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_empleados`
--
CREATE DATABASE IF NOT EXISTS `db_empleados` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
use db_empleados;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `codigo` varchar(10) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `lugar_nacimiento` varchar(30) NOT NULL,
  `fecha_nacimiento` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `puesto` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`codigo`, `nombres`, `lugar_nacimiento`, `fecha_nacimiento`, `direccion`, `telefono`, `puesto`, `estado`) VALUES
('1250', 'Juan Campos', 'Santa Ana, El Salvador', '15-06-1991', '', '70252525', 'Gerente', 2),
('12509', 'Andres Perez', 'SM', '06-06-1980', 'SM', '12345789', 'Gerente', 3),
('15200', 'Marcos Amaya', 'Santa Salvador', '06-06-2017', 'San Salvador', '12345678', 'Vendedor', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE bitacora (
    codigo_ant varchar(10) NOT NULL,
    nombres_ant varchar(50) NOT NULL,
    lugar_nacimiento varchar(30) NOT NULL,
    fecha_nacimiento varchar(30) NOT NULL,
    direccion_ant varchar(50) NOT NULL,
    telefono_ant varchar(10) NOT NULL,
    puesto_ant varchar(15) NOT NULL,
    estado_ant int(11) NOT NULL,
    fecha_mod datetime NOT NULL,
    PRIMARY KEY (id_usuario),
    INDEX codigo_ant_index (codigo_ant)
);


DELIMITER //

CREATE TRIGGER before_update_empleados
BEFORE UPDATE
ON empleados FOR EACH ROW

BEGIN
    IF NEW.codigo <> OLD.codigo OR
       NEW.nombres <> OLD.nombres OR
       NEW.lugar_nacimiento <> OLD.lugar_nacimiento OR
       NEW.fecha_nacimiento <> OLD.fecha_nacimiento OR
       NEW.direccion <> OLD.direccion OR
       NEW.telefono <> OLD.telefono OR
       NEW.puesto <> OLD.puesto OR
       NEW.estado <> OLD.estado THEN

        INSERT INTO bitacora (
            codigo_ant,
            nombres_ant,
            lugar_nacimiento,
            fecha_nacimiento,
            direccion_ant,
            telefono_ant,
            puesto_ant,
            estado_ant,
            fecha_mod
        ) VALUES (
            OLD.codigo,
            OLD.nombres,
            OLD.lugar_nacimiento,
            OLD.fecha_nacimiento,
            OLD.direccion,
            OLD.telefono,
            OLD.puesto,
            OLD.estado,
            NOW()
        );

    END IF;
END //

DELIMITER ;
