-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 20, 2021 at 02:16 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `examen`
--

-- --------------------------------------------------------

--
-- Table structure for table `Zombis`
--

CREATE TABLE `Zombis` (
  `IdZombi` int(11) NOT NULL,
  `IdEstado` int(11) NOT NULL,
  `Id` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Zombis`
--

INSERT INTO `Zombis` (`IdZombi`, `IdEstado`, `Id`, `Fecha`) VALUES
(1, 1, 1, '2021-10-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Zombis`
--
ALTER TABLE `Zombis`
  ADD PRIMARY KEY (`IdZombi`),
  ADD KEY `IdEstado` (`IdEstado`),
  ADD KEY `Id` (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Zombis`
--
ALTER TABLE `Zombis`
  MODIFY `IdZombi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Zombis`
--
ALTER TABLE `Zombis`
  ADD CONSTRAINT `zombis_ibfk_1` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`IdEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zombis_ibfk_2` FOREIGN KEY (`Id`) REFERENCES `nuevo-zombi` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
