-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014 m. Lap 22 d. 16:21
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
-- Sukurta duomenų struktūra lentelei `draugai`
--

CREATE TABLE IF NOT EXISTS `draugai` (
`id` int(11) NOT NULL,
  `siuntejas` int(11) NOT NULL,
  `gavejas` int(11) NOT NULL,
  `statusas` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=2 ;

--
-- Sukurta duomenų kopija lentelei `draugai`
--

INSERT INTO `draugai` (`id`, `siuntejas`, `gavejas`, `statusas`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `maisto_produktai`
--

CREATE TABLE IF NOT EXISTS `maisto_produktai` (
`ID` int(11) NOT NULL,
  `Autorius` int(11) NOT NULL,
  `Pavadinimas` varchar(100) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Aprasymas` varchar(2000) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Nuotrauka` varchar(100) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `maisto_produktai`
--

INSERT INTO `maisto_produktai` (`ID`, `Autorius`, `Pavadinimas`, `Aprasymas`, `Nuotrauka`) VALUES
(1, 1, 'Pienas', 'Pienas isgaunamas is karves', 'nuotrauka'),
(2, 2, 'Kiauliena', '', '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `matavimo_vienetai`
--

CREATE TABLE IF NOT EXISTS `matavimo_vienetai` (
`ID` int(11) NOT NULL,
  `Autorius` int(11) NOT NULL,
  `Trumpinys` varchar(10) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Pavadinimas` varchar(100) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `matavimo_vienetai`
--

INSERT INTO `matavimo_vienetai` (`ID`, `Autorius`, `Trumpinys`, `Pavadinimas`) VALUES
(1, 1, 'KG', 'Kilogramas'),
(2, 2, 'L', 'Litras');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `produkto_matavimo_vienetai`
--

CREATE TABLE IF NOT EXISTS `produkto_matavimo_vienetai` (
  `Produktas` int(11) NOT NULL,
  `Matavimo_vienetas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `produkto_matavimo_vienetai`
--

INSERT INTO `produkto_matavimo_vienetai` (`Produktas`, `Matavimo_vienetas`) VALUES
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `receptai`
--

CREATE TABLE IF NOT EXISTS `receptai` (
`ID` int(11) NOT NULL,
  `Autorius` int(11) NOT NULL,
  `Pavadinimas` varchar(100) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Porciju_skaicius` int(11) NOT NULL,
  `Gamybos_trukme` int(11) NOT NULL,
  `Aprasymas` varchar(2000) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Viesumas` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=4 ;

--
-- Sukurta duomenų kopija lentelei `receptai`
--

INSERT INTO `receptai` (`ID`, `Autorius`, `Pavadinimas`, `Porciju_skaicius`, `Gamybos_trukme`, `Aprasymas`, `Viesumas`) VALUES
(1, 1, 'Receptas', 1, 20, 'aprasymas', 1),
(2, 2, 'skanus maistas', 2, 50, 'skaniai gamink ir bus gerai', 1),
(3, 1, 'pav', 2, 30, 'skanumelis', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `recepto_produktai`
--

CREATE TABLE IF NOT EXISTS `recepto_produktai` (
  `Receptas` int(11) NOT NULL,
  `Produktas` int(11) NOT NULL,
  `Kiekis` int(11) NOT NULL,
  `Matavimo_vienetas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `recepto_produktai`
--

INSERT INTO `recepto_produktai` (`Receptas`, `Produktas`, `Kiekis`, `Matavimo_vienetas`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `recepto_tipai`
--

CREATE TABLE IF NOT EXISTS `recepto_tipai` (
  `Tipas` int(11) NOT NULL,
  `Receptas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `recepto_tipai`
--

INSERT INTO `recepto_tipai` (`Tipas`, `Receptas`) VALUES
(4, 1),
(5, 1),
(4, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `receptu_nuotraukos`
--

CREATE TABLE IF NOT EXISTS `receptu_nuotraukos` (
  `receptas` int(11) NOT NULL,
  `Nuotrauka` varchar(100) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `receptu_nuotraukos`
--

INSERT INTO `receptu_nuotraukos` (`receptas`, `Nuotrauka`) VALUES
(1, '../resources/testavimoSumetimai/kotletai.jpg'),
(1, '../resources/testavimoSumetimai/kotletai2.jpg'),
(1, '../resources/testavimoSumetimai/kotletai3.jpg'),
(1, '../resources/testavimoSumetimai/kotletai4.jpg');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `saldytuvas`
--

CREATE TABLE IF NOT EXISTS `saldytuvas` (
  `Vartotojas` int(11) NOT NULL,
  `Produktas` int(11) NOT NULL,
  `Kiekis` int(11) NOT NULL,
  `Matavimo_vienetas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `saldytuvas`
--

INSERT INTO `saldytuvas` (`Vartotojas`, `Produktas`, `Kiekis`, `Matavimo_vienetas`) VALUES
(1, 1, 1, 1),
(1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `tipas`
--

CREATE TABLE IF NOT EXISTS `tipas` (
`ID` int(11) NOT NULL,
  `Pavadinimas` varchar(100) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=6 ;

--
-- Sukurta duomenų kopija lentelei `tipas`
--

INSERT INTO `tipas` (`ID`, `Pavadinimas`) VALUES
(1, 'Desertas'),
(4, 'Kiaulienos patiekalai'),
(5, 'Vištienos patiekalai\r\n');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `valgiarastis`
--

CREATE TABLE IF NOT EXISTS `valgiarastis` (
  `Vartotojas` int(11) NOT NULL,
  `Receptas` int(11) NOT NULL,
  `Gaminimo_data` date NOT NULL,
  `Porciju_skaicius` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `valgiarastis`
--

INSERT INTO `valgiarastis` (`Vartotojas`, `Receptas`, `Gaminimo_data`, `Porciju_skaicius`) VALUES
(1, 2, '2014-11-22', 12),
(1, 3, '2014-11-26', 2);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `vartotojas`
--

CREATE TABLE IF NOT EXISTS `vartotojas` (
`ID` int(11) NOT NULL,
  `Teises` varchar(30) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Vardas` varchar(40) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Pavarde` varchar(40) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Adresas` varchar(100) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Slapyvardis` varchar(30) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Nuotrauka` varchar(100) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Slaptazodis` varchar(64) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL,
  `Aprasymas` varchar(1000) CHARACTER SET utf16 COLLATE utf16_lithuanian_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `vartotojas`
--

INSERT INTO `vartotojas` (`ID`, `Teises`, `Vardas`, `Pavarde`, `Adresas`, `Slapyvardis`, `Nuotrauka`, `Slaptazodis`, `Aprasymas`) VALUES
(1, 'User', 'Vardenis', 'Pavardenis', 'kažkur toli toli', 'Slapyvardis', 'Nuotrauka', 'slaptažodis', 'Aprašymas'),
(2, 'ADMIN', 'vardzius', 'pavardzius', 'adresas', 'slap', 'nuotrauka', 'slaptazodis', 'aprašymas');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `vertinimai`
--

CREATE TABLE IF NOT EXISTS `vertinimai` (
  `Vertintojas` int(11) NOT NULL,
  `Receptas` int(11) NOT NULL,
  `Vertinimas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `vertinimai`
--

INSERT INTO `vertinimai` (`Vertintojas`, `Receptas`, `Vertinimas`) VALUES
(1, 2, 5),
(1, 3, 10),
(1, 1, 5),
(2, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `draugai`
--
ALTER TABLE `draugai`
 ADD PRIMARY KEY (`id`), ADD KEY `Siuntėjas` (`siuntejas`), ADD KEY `Gavėjas` (`gavejas`);

--
-- Indexes for table `maisto_produktai`
--
ALTER TABLE `maisto_produktai`
 ADD PRIMARY KEY (`ID`), ADD KEY `Autorius` (`Autorius`);

--
-- Indexes for table `matavimo_vienetai`
--
ALTER TABLE `matavimo_vienetai`
 ADD PRIMARY KEY (`ID`), ADD KEY `Autorius` (`Autorius`);

--
-- Indexes for table `produkto_matavimo_vienetai`
--
ALTER TABLE `produkto_matavimo_vienetai`
 ADD KEY `Produktas` (`Produktas`), ADD KEY `Matavimo_vienetas` (`Matavimo_vienetas`);

--
-- Indexes for table `receptai`
--
ALTER TABLE `receptai`
 ADD PRIMARY KEY (`ID`), ADD KEY `Autorius` (`Autorius`);

--
-- Indexes for table `recepto_produktai`
--
ALTER TABLE `recepto_produktai`
 ADD KEY `Receptas` (`Receptas`), ADD KEY `Produktas` (`Produktas`), ADD KEY `Matavimo vienetas` (`Matavimo_vienetas`);

--
-- Indexes for table `recepto_tipai`
--
ALTER TABLE `recepto_tipai`
 ADD KEY `Tipas` (`Tipas`), ADD KEY `Receptas` (`Receptas`);

--
-- Indexes for table `receptu_nuotraukos`
--
ALTER TABLE `receptu_nuotraukos`
 ADD KEY `receptas` (`receptas`);

--
-- Indexes for table `saldytuvas`
--
ALTER TABLE `saldytuvas`
 ADD KEY `Vartotojas` (`Vartotojas`), ADD KEY `Produktas` (`Produktas`), ADD KEY `Matavimo vienetas` (`Matavimo_vienetas`);

--
-- Indexes for table `tipas`
--
ALTER TABLE `tipas`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `valgiarastis`
--
ALTER TABLE `valgiarastis`
 ADD KEY `Vartotojas` (`Vartotojas`), ADD KEY `Receptas` (`Receptas`);

--
-- Indexes for table `vartotojas`
--
ALTER TABLE `vartotojas`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vertinimai`
--
ALTER TABLE `vertinimai`
 ADD KEY `Vertintojas` (`Vertintojas`), ADD KEY `Receptas` (`Receptas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `draugai`
--
ALTER TABLE `draugai`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `maisto_produktai`
--
ALTER TABLE `maisto_produktai`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `matavimo_vienetai`
--
ALTER TABLE `matavimo_vienetai`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `receptai`
--
ALTER TABLE `receptai`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipas`
--
ALTER TABLE `tipas`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vartotojas`
--
ALTER TABLE `vartotojas`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `draugai`
--
ALTER TABLE `draugai`
ADD CONSTRAINT `draugai_ibfk_1` FOREIGN KEY (`siuntejas`) REFERENCES `vartotojas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `draugai_ibfk_2` FOREIGN KEY (`gavejas`) REFERENCES `vartotojas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Apribojimai lentelei `maisto_produktai`
--
ALTER TABLE `maisto_produktai`
ADD CONSTRAINT `maisto_produktai_ibfk_1` FOREIGN KEY (`Autorius`) REFERENCES `vartotojas` (`ID`);

--
-- Apribojimai lentelei `matavimo_vienetai`
--
ALTER TABLE `matavimo_vienetai`
ADD CONSTRAINT `matavimo_vienetai_ibfk_1` FOREIGN KEY (`Autorius`) REFERENCES `vartotojas` (`ID`);

--
-- Apribojimai lentelei `produkto_matavimo_vienetai`
--
ALTER TABLE `produkto_matavimo_vienetai`
ADD CONSTRAINT `produkto_matavimo_vienetai_ibfk_1` FOREIGN KEY (`Produktas`) REFERENCES `maisto_produktai` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `produkto_matavimo_vienetai_ibfk_2` FOREIGN KEY (`Matavimo_vienetas`) REFERENCES `matavimo_vienetai` (`ID`);

--
-- Apribojimai lentelei `receptai`
--
ALTER TABLE `receptai`
ADD CONSTRAINT `receptai_ibfk_1` FOREIGN KEY (`Autorius`) REFERENCES `vartotojas` (`ID`);

--
-- Apribojimai lentelei `recepto_produktai`
--
ALTER TABLE `recepto_produktai`
ADD CONSTRAINT `recepto_produktai_ibfk_1` FOREIGN KEY (`Receptas`) REFERENCES `receptai` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `recepto_produktai_ibfk_2` FOREIGN KEY (`Produktas`) REFERENCES `maisto_produktai` (`ID`),
ADD CONSTRAINT `recepto_produktai_ibfk_3` FOREIGN KEY (`Matavimo_vienetas`) REFERENCES `matavimo_vienetai` (`ID`);

--
-- Apribojimai lentelei `recepto_tipai`
--
ALTER TABLE `recepto_tipai`
ADD CONSTRAINT `recepto_tipai_ibfk_1` FOREIGN KEY (`Tipas`) REFERENCES `tipas` (`ID`),
ADD CONSTRAINT `recepto_tipai_ibfk_2` FOREIGN KEY (`Receptas`) REFERENCES `receptai` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Apribojimai lentelei `receptu_nuotraukos`
--
ALTER TABLE `receptu_nuotraukos`
ADD CONSTRAINT `receptu_nuotraukos_ibfk_1` FOREIGN KEY (`receptas`) REFERENCES `receptai` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Apribojimai lentelei `saldytuvas`
--
ALTER TABLE `saldytuvas`
ADD CONSTRAINT `saldytuvas_ibfk_1` FOREIGN KEY (`Vartotojas`) REFERENCES `vartotojas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `saldytuvas_ibfk_2` FOREIGN KEY (`Produktas`) REFERENCES `maisto_produktai` (`ID`),
ADD CONSTRAINT `saldytuvas_ibfk_3` FOREIGN KEY (`Matavimo_vienetas`) REFERENCES `matavimo_vienetai` (`ID`);

--
-- Apribojimai lentelei `valgiarastis`
--
ALTER TABLE `valgiarastis`
ADD CONSTRAINT `valgiarastis_ibfk_1` FOREIGN KEY (`Vartotojas`) REFERENCES `vartotojas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `valgiarastis_ibfk_2` FOREIGN KEY (`Receptas`) REFERENCES `receptai` (`ID`);

--
-- Apribojimai lentelei `vertinimai`
--
ALTER TABLE `vertinimai`
ADD CONSTRAINT `vertinimai_ibfk_1` FOREIGN KEY (`Vertintojas`) REFERENCES `vartotojas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `vertinimai_ibfk_2` FOREIGN KEY (`Receptas`) REFERENCES `receptai` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
