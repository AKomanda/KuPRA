-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014 m. Lap 18 d. 18:39
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kupra`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `maisto_produktai`
--

CREATE TABLE IF NOT EXISTS `maisto_produktai` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Pavadinimas` varchar(60) COLLATE utf16_lithuanian_ci NOT NULL,
  `Matavimo_vienetas` int(11) NOT NULL,
  `Autorius` int(11) NOT NULL,
  `Aprasymas` varchar(500) COLLATE utf16_lithuanian_ci NOT NULL,
  `Nuotrauka` varchar(100) CHARACTER SET utf32 COLLATE utf32_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `maisto_produktai`
--

INSERT INTO `maisto_produktai` (`ID`, `Pavadinimas`, `Matavimo_vienetas`, `Autorius`, `Aprasymas`, `Nuotrauka`) VALUES
(1, 'Faršas', 1, 1, 'Kiaulienos faršas', 'null'),
(2, 'Pienas', 2, 2, 'Kiaulienos pienas', 'null');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `matavimo_vienetai`
--

CREATE TABLE IF NOT EXISTS `matavimo_vienetai` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Trumpinys` varchar(10) COLLATE utf16_lithuanian_ci NOT NULL,
  `Autorius` int(11) NOT NULL,
  `Pavadinimas` varchar(60) COLLATE utf16_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `matavimo_vienetai`
--

INSERT INTO `matavimo_vienetai` (`ID`, `Trumpinys`, `Autorius`, `Pavadinimas`) VALUES
(1, 'Kg', 2, 'Kilogramas'),
(2, 'l', 2, 'litras');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `naudotojai`
--

CREATE TABLE IF NOT EXISTS `naudotojai` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Teises` varchar(30) COLLATE utf16_lithuanian_ci NOT NULL,
  `Vardas` varchar(30) COLLATE utf16_lithuanian_ci NOT NULL,
  `Pavarde` varchar(40) COLLATE utf16_lithuanian_ci NOT NULL,
  `Slapyvardis` varchar(40) COLLATE utf16_lithuanian_ci NOT NULL,
  `Nuotrauka` varchar(255) COLLATE utf16_lithuanian_ci NOT NULL,
  `Slaptazodis` varchar(125) COLLATE utf16_lithuanian_ci NOT NULL,
  `Adresas` varchar(50) COLLATE utf16_lithuanian_ci NOT NULL,
  `Aprasymas` varchar(1000) COLLATE utf16_lithuanian_ci NOT NULL,
  `Draugai` varchar(2000) COLLATE utf16_lithuanian_ci NOT NULL,
  `Ivertinimai` varchar(2000) COLLATE utf16_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `naudotojai`
--

INSERT INTO `naudotojai` (`ID`, `Teises`, `Vardas`, `Pavarde`, `Slapyvardis`, `Nuotrauka`, `Slaptazodis`, `Adresas`, `Aprasymas`, `Draugai`, `Ivertinimai`) VALUES
(1, 'user', 'Testas', 'Testauskas', 'Test', 'null', 'test1', 'test gatve', 'testuoju sistema', '2;', ''),
(2, 'admin', 'Testutis', 'Testutavičius', 'Test2', 'null', 'test2', 'test gatve', 'testuoju sistemos admin', '1;', '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `receptai`
--

CREATE TABLE IF NOT EXISTS `receptai` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Autorius` int(11) NOT NULL,
  `Pavadinimas` varchar(60) COLLATE utf16_lithuanian_ci NOT NULL,
  `Vertinimas` float NOT NULL,
  `Tipas` varchar(25) COLLATE utf16_lithuanian_ci NOT NULL,
  `Porciju_sk` int(11) NOT NULL,
  `Gamybos_trukme` int(11) NOT NULL,
  `Produktu_sar` varchar(256) COLLATE utf16_lithuanian_ci NOT NULL,
  `Gamybos_apr` varchar(2000) COLLATE utf16_lithuanian_ci NOT NULL,
  `Nuotraukos` varchar(2000) COLLATE utf16_lithuanian_ci NOT NULL,
  `Viesumas` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `receptai`
--

INSERT INTO `receptai` (`ID`, `Autorius`, `Pavadinimas`, `Vertinimas`, `Tipas`, `Porciju_sk`, `Gamybos_trukme`, `Produktu_sar`, `Gamybos_apr`, `Nuotraukos`, `Viesumas`) VALUES
(1, 1, 'Koteletai', 10, 'Desertas', 3, 50, '1:2;2:3;', 'Imam pirmą ir dedam į antrą', 'null', 1),
(2, 1, 'Kijevas', 10, 'Desertas', 3, 50, '2:2;1:3;', 'Imam pirmą ir dedam į antrą', 'null', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `saldytuvas`
--

CREATE TABLE IF NOT EXISTS `saldytuvas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Autorius` int(11) NOT NULL,
  `Produktai` varchar(2000) COLLATE utf16_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `saldytuvas`
--

INSERT INTO `saldytuvas` (`ID`, `Autorius`, `Produktai`) VALUES
(1, 1, '2:10;1:7;'),
(2, 2, '2:100;1:70;');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `valgiarastis`
--

CREATE TABLE IF NOT EXISTS `valgiarastis` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Autorius` int(11) NOT NULL,
  `Receptai` varchar(2000) COLLATE utf16_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `valgiarastis`
--

INSERT INTO `valgiarastis` (`ID`, `Autorius`, `Receptai`) VALUES
(1, 1, ''),
(2, 2, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
