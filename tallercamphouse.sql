-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 09-08-2024 a las 08:16:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tallercamphouse`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `averageActivityRating` ()   BEGIN
 SELECT
 a.id AS idActividad,
 a.name AS nombreActividad,
 AVG(e.grade) AS promedioCalificacion
 FROM
 Activity a
 LEFT JOIN
 Evaluation e ON a.id = e.activity_id
 GROUP BY
 a.id, a.name
 ORDER BY
 promedioCalificacion DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `averageRatingByCampHouse` ()   BEGIN
 SELECT
 ch.id AS idCasa,
 ch.name AS nombreCasa,
 a.id AS idActividad,
 a.name AS nombreActividad,
 AVG(e.grade) AS promedioCalificacion
 FROM
 CampHouse ch
 JOIN
 CampHouseActivity cha ON ch.id = cha.campHouse_id
 JOIN
 Activity a ON cha.activity_id = a.id
 JOIN
 Evaluation e ON a.id = e.activity_id
 GROUP BY
 ch.id, ch.name, a.id, a.name
 ORDER BY
 promedioCalificacion DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCampHouseTutorCount` ()   BEGIN
 SELECT
 ch.id AS idCampHouse,
 ch.name AS campHouseName,
 COUNT(cht.tutor_id) AS tutorCount
 FROM
 CampHouse ch
 JOIN
 CampHouseTutor cht ON ch.id = cht.campHouse_id
 GROUP BY
 ch.id, ch.name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCampHouseTutors` ()   BEGIN
 SELECT
 ch.id AS idCampHouse,
 ch.name AS campHouseName,
 t.id AS tutorID,
 t.name AS tutorName,
 t.phone AS tutorPhone
 FROM
 CampHouse ch
 JOIN
 CampHouseTutor cht ON ch.id = cht.campHouse_id
 JOIN
 Tutor t ON cht.tutor_id = t.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCampHouseWithMostChildren` ()   BEGIN
 SELECT
 ch.id AS idCampHouse,
 ch.name AS nameCampHouse,
 COUNT(c.id) AS numberOfChildren
 FROM
 CampHouse ch
 LEFT JOIN
 Child c ON ch.id = c.campHouse_id
 GROUP BY
 ch.id, ch.name
 ORDER BY
 numberOfChildren DESC
 LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCampHouseWithMostRooms` ()   BEGIN
 SELECT
 c.id AS idCampHouse,
 c.name AS nameCampHouse,
 COUNT(r.id) AS numberOfRooms
 FROM
 CampHouse c
 JOIN
 Room r ON c.id = r.campHouse_id
 GROUP BY
 c.id, c.name
 ORDER BY
 numberOfRooms DESC
 LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCountyWithMostCampHouses` ()   BEGIN
 SELECT
 c.id AS idCounty,
 c.name AS nameCounty,
 COUNT(ch.id) AS numberOfCampHouses
 FROM
 County c
 LEFT JOIN
 CampHouse ch ON c.id = ch.county_id
 GROUP BY
 c.id, c.name
 ORDER BY
 numberOfCampHouses DESC
 LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDirectors` ()   BEGIN
 SELECT
 ch.id AS idCampHouse,
 ch.name AS campHouseName,
 t.id AS tutorID,
 t.name AS tutorName,
 t.phone AS tutorPhone
 FROM
 CampHouse ch
 JOIN
 CampHouseTutor cht ON ch.id = cht.campHouse_id
 JOIN
 Tutor t ON cht.tutor_id = t.id
 WHERE
 t.is_director = TRUE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLowRatings` ()   BEGIN
 SELECT
 n.id AS idNino,
 n.name AS nombreNino,
 e.activity_id AS idActividad,
 e.grade AS nota
 FROM
 Child n
 JOIN
 Evaluation e ON n.id = e.child_id
 WHERE
 e.grade < 5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `numberfordirectorhouse` ()   BEGIN
 SELECT
 ch.id AS idCasa,
 ch.name AS nombreCasa,
 COUNT(cht.tutor_id) AS numeroTutores
 FROM
 CampHouse ch
 JOIN
 CampHouseTutor cht ON ch.id = cht.campHouse_id
 WHERE
 t.is_director = TRUE
 GROUP BY
 ch.id, ch.name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `numberofchildrenhouse` ()   BEGIN
 SELECT
 ch.id AS idCasa,
 ch.name AS nombreCasa,
 COUNT(c.id) AS numeroNinos
 FROM
 CampHouse ch
 JOIN
 Child c ON ch.id = c.campHouse_id
 GROUP BY
 ch.id, ch.name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `numberoftutorshouse` ()   BEGIN
 SELECT
 ch.id AS idCasa,
 ch.name AS nombreCasa,
 COUNT(cht.tutor_id) AS numeroTutores
 FROM
 CampHouse ch
 JOIN
 CampHouseTutor cht ON ch.id = cht.campHouse_id
 GROUP BY
 ch.id, ch.name
 ORDER BY
 numeroTutores DESC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `activity`
--

INSERT INTO `activity` (`id`, `name`) VALUES
(1, 'Swimming'),
(2, 'Painting'),
(3, 'Music'),
(4, 'Football'),
(5, 'Basketball'),
(6, 'Theatre'),
(7, 'Dance'),
(8, 'Cooking'),
(9, 'Hiking'),
(10, 'Cycling'),
(11, 'Climbing'),
(12, 'Equestrianism'),
(13, 'Gardening'),
(14, 'Astronomy'),
(15, 'Photography'),
(16, 'Robotics'),
(17, 'Yoga'),
(18, 'Chess'),
(19, 'Science'),
(20, 'Crafts');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `postalCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `address`
--

INSERT INTO `address` (`id`, `street`, `postalCode`) VALUES
(1, 'Calle A', '08001'),
(2, 'Calle B', '08002'),
(3, 'Calle C', '08003'),
(4, 'Calle D', '08004'),
(5, 'Calle E', '08005'),
(6, 'Calle F', '08006'),
(7, 'Calle G', '08007'),
(8, 'Calle H', '08008'),
(9, 'Calle I', '08009'),
(10, 'Calle J', '08010'),
(11, 'Calle K', '08011'),
(12, 'Calle L', '08012'),
(13, 'Calle M', '08013'),
(14, 'Calle N', '08014'),
(15, 'Calle O', '08015'),
(16, 'Calle P', '08016'),
(17, 'Calle Q', '08017'),
(18, 'Calle R', '08018'),
(19, 'Calle S', '08019'),
(20, 'Calle T', '08020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camphouse`
--

CREATE TABLE `camphouse` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `county_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camphouse`
--

INSERT INTO `camphouse` (`id`, `name`, `address_id`, `capacity`, `county_id`) VALUES
(1, 'CampHouse 1', 1, 50, 1),
(2, 'CampHouse 2', 2, 60, 2),
(3, 'CampHouse 3', 3, 70, 3),
(4, 'CampHouse 4', 4, 80, 4),
(5, 'CampHouse 5', 5, 90, 5),
(6, 'CampHouse 6', 6, 100, 6),
(7, 'CampHouse 7', 7, 110, 7),
(8, 'CampHouse 8', 8, 120, 8),
(9, 'CampHouse 9', 9, 130, 9),
(10, 'CampHouse 10', 10, 140, 10),
(11, 'CampHouse 11', 11, 150, 11),
(12, 'CampHouse 12', 12, 160, 12),
(13, 'CampHouse 13', 13, 170, 13),
(14, 'CampHouse 14', 14, 180, 14),
(15, 'CampHouse 15', 15, 190, 15),
(16, 'CampHouse 16', 16, 200, 16),
(17, 'CampHouse 17', 17, 210, 17),
(18, 'CampHouse 18', 18, 220, 18),
(19, 'CampHouse 19', 19, 230, 19),
(20, 'CampHouse 20', 20, 240, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camphouseactivity`
--

CREATE TABLE `camphouseactivity` (
  `campHouse_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camphousetutor`
--

CREATE TABLE `camphousetutor` (
  `tutor_id` int(11) NOT NULL,
  `campHouse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camphousetutor`
--

INSERT INTO `camphousetutor` (`tutor_id`, `campHouse_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(7, 4),
(8, 4),
(9, 5),
(10, 5),
(11, 6),
(12, 6),
(13, 7),
(14, 7),
(15, 8),
(16, 8),
(17, 9),
(18, 9),
(19, 10),
(20, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `child`
--

CREATE TABLE `child` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parentsPhone` varchar(15) NOT NULL,
  `county_id` int(11) DEFAULT NULL,
  `campHouse_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `child`
--

INSERT INTO `child` (`id`, `name`, `parentsPhone`, `county_id`, `campHouse_id`) VALUES
(1, 'Child 1', '700000001', 1, 1),
(2, 'Child 2', '700000002', 2, 1),
(3, 'Child 3', '700000003', 3, 2),
(4, 'Child 4', '700000004', 4, 2),
(5, 'Child 5', '700000005', 5, 3),
(6, 'Child 6', '700000006', 6, 3),
(7, 'Child 7', '700000007', 7, 4),
(8, 'Child 8', '700000008', 8, 4),
(9, 'Child 9', '700000009', 9, 5),
(10, 'Child 10', '700000010', 10, 5),
(11, 'Child 11', '700000011', 11, 6),
(12, 'Child 12', '700000012', 12, 6),
(13, 'Child 13', '700000013', 13, 7),
(14, 'Child 14', '700000014', 14, 7),
(15, 'Child 15', '700000015', 15, 8),
(16, 'Child 16', '700000016', 16, 8),
(17, 'Child 17', '700000017', 17, 9),
(18, 'Child 18', '700000018', 18, 9),
(19, 'Child 19', '700000019', 19, 10),
(20, 'Child 20', '700000020', 20, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `county`
--

CREATE TABLE `county` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `county`
--

INSERT INTO `county` (`id`, `name`) VALUES
(1, 'County A'),
(2, 'County B'),
(3, 'County C'),
(4, 'County D'),
(5, 'County E'),
(6, 'County F'),
(7, 'County G'),
(8, 'County H'),
(9, 'County I'),
(10, 'County J'),
(11, 'County K'),
(12, 'County L'),
(13, 'County M'),
(14, 'County N'),
(15, 'County O'),
(16, 'County P'),
(17, 'County Q'),
(18, 'County R'),
(19, 'County S'),
(20, 'County T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `score` int(11) NOT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluation`
--

INSERT INTO `evaluation` (`id`, `description`, `score`, `tutor_id`, `child_id`) VALUES
(1, 'Excellent progress in swimming', 9, 1, 1),
(2, 'Needs improvement in math', 5, 2, 2),
(3, 'Outstanding in art', 10, 3, 3),
(4, 'Good performance in music', 8, 4, 4),
(5, 'Average in sports', 7, 5, 5),
(6, 'Excellent progress in science', 9, 6, 6),
(7, 'Needs improvement in teamwork', 6, 7, 7),
(8, 'Outstanding in dance', 10, 8, 8),
(9, 'Good performance in chess', 8, 9, 9),
(10, 'Average in language skills', 7, 10, 10),
(11, 'Excellent progress in robotics', 9, 11, 11),
(12, 'Needs improvement in creativity', 6, 12, 12),
(13, 'Outstanding in leadership', 10, 13, 13),
(14, 'Good performance in yoga', 8, 14, 14),
(15, 'Average in punctuality', 7, 15, 15),
(16, 'Excellent progress in crafts', 9, 16, 16),
(17, 'Needs improvement in attendance', 6, 17, 17),
(18, 'Outstanding in photography', 10, 18, 18),
(19, 'Good performance in gardening', 8, 19, 19),
(20, 'Average in social skills', 7, 20, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `number` varchar(10) NOT NULL,
  `campHouse_id` int(11) DEFAULT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `room`
--

INSERT INTO `room` (`id`, `number`, `campHouse_id`, `capacity`) VALUES
(1, '101', 1, 4),
(2, '102', 1, 4),
(3, '103', 2, 4),
(4, '104', 2, 4),
(5, '201', 3, 6),
(6, '202', 3, 6),
(7, '203', 4, 6),
(8, '204', 4, 6),
(9, '301', 5, 8),
(10, '302', 5, 8),
(11, '303', 6, 8),
(12, '304', 6, 8),
(13, '401', 7, 10),
(14, '402', 7, 10),
(15, '403', 8, 10),
(16, '404', 8, 10),
(17, '501', 9, 12),
(18, '502', 9, 12),
(19, '503', 10, 12),
(20, '504', 10, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `is_director` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id`, `name`, `phone`, `is_director`) VALUES
(1, 'Tutor 1', '600000001', 1),
(2, 'Tutor 2', '600000002', 0),
(3, 'Tutor 3', '600000003', 1),
(4, 'Tutor 4', '600000004', 0),
(5, 'Tutor 5', '600000005', 1),
(6, 'Tutor 6', '600000006', 0),
(7, 'Tutor 7', '600000007', 1),
(8, 'Tutor 8', '600000008', 0),
(9, 'Tutor 9', '600000009', 1),
(10, 'Tutor 10', '600000010', 0),
(11, 'Tutor 11', '600000011', 1),
(12, 'Tutor 12', '600000012', 0),
(13, 'Tutor 13', '600000013', 1),
(14, 'Tutor 14', '600000014', 0),
(15, 'Tutor 15', '600000015', 1),
(16, 'Tutor 16', '600000016', 0),
(17, 'Tutor 17', '600000017', 1),
(18, 'Tutor 18', '600000018', 0),
(19, 'Tutor 19', '600000019', 1),
(20, 'Tutor 20', '600000020', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `camphouse`
--
ALTER TABLE `camphouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `county_id` (`county_id`);

--
-- Indices de la tabla `camphouseactivity`
--
ALTER TABLE `camphouseactivity`
  ADD PRIMARY KEY (`campHouse_id`,`activity_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indices de la tabla `camphousetutor`
--
ALTER TABLE `camphousetutor`
  ADD PRIMARY KEY (`tutor_id`,`campHouse_id`),
  ADD KEY `campHouse_id` (`campHouse_id`);

--
-- Indices de la tabla `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `county_id` (`county_id`),
  ADD KEY `campHouse_id` (`campHouse_id`);

--
-- Indices de la tabla `county`
--
ALTER TABLE `county`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_id` (`tutor_id`),
  ADD KEY `child_id` (`child_id`);

--
-- Indices de la tabla `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campHouse_id` (`campHouse_id`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `camphouse`
--
ALTER TABLE `camphouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
