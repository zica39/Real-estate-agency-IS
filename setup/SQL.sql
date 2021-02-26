-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2021 at 10:43 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agencija_za_nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencija`
--

CREATE TABLE `agencija` (
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL,
  `telefon` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `adresa` varchar(255) COLLATE utf8_bin NOT NULL,
  `o_nama` text COLLATE utf8_bin NOT NULL,
  `map_api` varchar(255) COLLATE utf8_bin NOT NULL,
  `email_host` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email_username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email_password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `broj_posjeta` int(11) NOT NULL DEFAULT 0,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `agencija`
--

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `grad`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `aktiviran` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `korisnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `nekretnina`
--

CREATE TABLE `nekretnina` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `grad` int(11) DEFAULT NULL,
  `tip_oglasa` int(11) DEFAULT NULL,
  `tip_nekretnine` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `datum_postavljanja` datetime DEFAULT current_timestamp(),
  `datum_prodaje` date DEFAULT NULL,
  `povrsina` float NOT NULL,
  `cijena` float NOT NULL,
  `godina_izgradnje` year(4) DEFAULT NULL,
  `opis` text COLLATE utf8_bin DEFAULT NULL,
  `fotografije` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fotografije`)),
  `broj_pregleda` int(11) NOT NULL DEFAULT 0,
  `adresa` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `svojstva` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `nekretnina`
--

-- --------------------------------------------------------

--
-- Table structure for table `status_nekretnine`
--

CREATE TABLE `status_nekretnine` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `status_nekretnine`
--

INSERT INTO `status_nekretnine` (`id`, `naziv`) VALUES
(1, 'dostupno'),
(2, 'prodato');

-- --------------------------------------------------------

--
-- Table structure for table `tip_nekretnine`
--

CREATE TABLE `tip_nekretnine` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tip_nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `tip_oglasa`
--

CREATE TABLE `tip_oglasa` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tip_oglasa`
--

INSERT INTO `tip_oglasa` (`id`, `naziv`) VALUES
(1, 'prodaja'),
(2, 'iznajmljivanje'),
(3, 'kompenzacija');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agencija`
--
ALTER TABLE `agencija`
  ADD KEY `fk_admin_korisnik` (`admin`);

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nekretnina_grad` (`grad`),
  ADD KEY `fk_nekretnina_status` (`status`),
  ADD KEY `fk_nekretnina_tip` (`tip_nekretnine`),
  ADD KEY `fk_nekretnina_tip_oglasa` (`tip_oglasa`),
  ADD KEY `fk_nekretnina_korisnik` (`korisnik_id`);

--
-- Indexes for table `status_nekretnine`
--
ALTER TABLE `status_nekretnine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tip_nekretnine`
--
ALTER TABLE `tip_nekretnine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tip_oglasa`
--
ALTER TABLE `tip_oglasa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nekretnina`
--
ALTER TABLE `nekretnina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `status_nekretnine`
--
ALTER TABLE `status_nekretnine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tip_nekretnine`
--
ALTER TABLE `tip_nekretnine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tip_oglasa`
--
ALTER TABLE `tip_oglasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agencija`
--
ALTER TABLE `agencija`
  ADD CONSTRAINT `fk_admin_korisnik` FOREIGN KEY (`admin`) REFERENCES `korisnik` (`id`);

--
-- Constraints for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD CONSTRAINT `fk_nekretnina_grad` FOREIGN KEY (`grad`) REFERENCES `grad` (`id`),
  ADD CONSTRAINT `fk_nekretnina_korisnik` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `fk_nekretnina_status` FOREIGN KEY (`status`) REFERENCES `status_nekretnine` (`id`),
  ADD CONSTRAINT `fk_nekretnina_tip` FOREIGN KEY (`tip_nekretnine`) REFERENCES `tip_nekretnine` (`id`),
  ADD CONSTRAINT `fk_nekretnina_tip_oglasa` FOREIGN KEY (`tip_oglasa`) REFERENCES `tip_oglasa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
