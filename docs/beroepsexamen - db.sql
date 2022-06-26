-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2022 at 12:35 PM
-- Server version: 8.0.29
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beroepsexamen`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodatie`
--

CREATE TABLE `accommodatie` (
  `idAcco` int NOT NULL,
  `bstmID` int DEFAULT NULL,
  `bstm_naam` varchar(254) DEFAULT NULL,
  `soort` tinytext NOT NULL,
  `kamer` int NOT NULL,
  `ligging` longtext NOT NULL,
  `faciliteit` varchar(254) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `picture` varchar(254) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bestemming`
--

CREATE TABLE `bestemming` (
  `idBestemming` int NOT NULL,
  `plaats` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `land` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `provincie` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `boeking`
--

CREATE TABLE `boeking` (
  `idBoeking` bigint NOT NULL,
  `reisID` bigint NOT NULL,
  `userID` int NOT NULL,
  `bstmID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departures`
--

CREATE TABLE `departures` (
  `idDeparture` int NOT NULL,
  `departure` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faciliteit`
--

CREATE TABLE `faciliteit` (
  `idFac` int NOT NULL,
  `naam_fac` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reis`
--

CREATE TABLE `reis` (
  `idReis` bigint NOT NULL,
  `bestemmingID` int DEFAULT NULL,
  `depID` int DEFAULT NULL,
  `bestemming` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `naam_type` varchar(254) DEFAULT NULL,
  `periode` mediumtext NOT NULL,
  `check_in` bigint NOT NULL,
  `vertrek_date` datetime(6) NOT NULL,
  `reis_nr` mediumtext NOT NULL,
  `prijs` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `voornaam` mediumtext NOT NULL,
  `tvg` tinytext,
  `achternaam` mediumtext NOT NULL,
  `email` longtext NOT NULL,
  `telefoon_nr` mediumtext NOT NULL,
  `DoB` date NOT NULL,
  `pwd` longtext NOT NULL,
  `pwd_rep` longtext NOT NULL,
  `role` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `voornaam`, `tvg`, `achternaam`, `email`, `telefoon_nr`, `DoB`, `pwd`, `pwd_rep`, `role`) VALUES
(5, 'Admin', '', 'Admin', 'admin@gmail.com', '0000000000', '2022-06-20', 'Admin', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodatie`
--
ALTER TABLE `accommodatie`
  ADD PRIMARY KEY (`idAcco`),
  ADD KEY `fk_bstm` (`bstmID`);

--
-- Indexes for table `bestemming`
--
ALTER TABLE `bestemming`
  ADD PRIMARY KEY (`idBestemming`);

--
-- Indexes for table `boeking`
--
ALTER TABLE `boeking`
  ADD PRIMARY KEY (`idBoeking`),
  ADD KEY `fk_reis` (`reisID`),
  ADD KEY `fk_user` (`userID`),
  ADD KEY `bstm_fk` (`bstmID`);

--
-- Indexes for table `departures`
--
ALTER TABLE `departures`
  ADD PRIMARY KEY (`idDeparture`);

--
-- Indexes for table `faciliteit`
--
ALTER TABLE `faciliteit`
  ADD PRIMARY KEY (`idFac`);

--
-- Indexes for table `reis`
--
ALTER TABLE `reis`
  ADD PRIMARY KEY (`idReis`),
  ADD KEY `fk_dep` (`depID`),
  ADD KEY `fk_bestemming` (`bestemmingID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodatie`
--
ALTER TABLE `accommodatie`
  MODIFY `idAcco` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `bestemming`
--
ALTER TABLE `bestemming`
  MODIFY `idBestemming` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `boeking`
--
ALTER TABLE `boeking`
  MODIFY `idBoeking` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `departures`
--
ALTER TABLE `departures`
  MODIFY `idDeparture` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `faciliteit`
--
ALTER TABLE `faciliteit`
  MODIFY `idFac` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `reis`
--
ALTER TABLE `reis`
  MODIFY `idReis` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accommodatie`
--
ALTER TABLE `accommodatie`
  ADD CONSTRAINT `fk_bstm` FOREIGN KEY (`bstmID`) REFERENCES `bestemming` (`idBestemming`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `boeking`
--
ALTER TABLE `boeking`
  ADD CONSTRAINT `bstm_fk` FOREIGN KEY (`bstmID`) REFERENCES `bestemming` (`idBestemming`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reis` FOREIGN KEY (`reisID`) REFERENCES `reis` (`idReis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userID`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reis`
--
ALTER TABLE `reis`
  ADD CONSTRAINT `fk_bestemming` FOREIGN KEY (`bestemmingID`) REFERENCES `bestemming` (`idBestemming`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dep` FOREIGN KEY (`depID`) REFERENCES `departures` (`idDeparture`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
