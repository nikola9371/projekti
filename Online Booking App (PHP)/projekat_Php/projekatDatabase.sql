-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2018 at 11:24 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `aranzman`
--

CREATE TABLE `aranzman` (
  `id` int(11) NOT NULL,
  `ponude` varchar(16) NOT NULL,
  `agencija` varchar(20) NOT NULL,
  `grad` varchar(32) NOT NULL,
  `tip_smestaja` varchar(16) NOT NULL,
  `prevoz` varchar(16) NOT NULL,
  `datum_polaska` date NOT NULL,
  `komentar` varchar(32) DEFAULT NULL,
  `cena` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aranzman`
--

INSERT INTO `aranzman` (`id`, `ponude`, `agencija`, `grad`, `tip_smestaja`, `prevoz`, `datum_polaska`, `komentar`, `cena`) VALUES
(1, 'vikend', 'Turisttrade', 'Rusalka', 'hotel', 'avion', '2018-06-04', '', 10000),
(4, 'vikend', 'Alimpex', 'Kiten', 'hotel', 'avion', '2018-07-29', NULL, 19900),
(5, 'vikend', 'Prestige', 'Konstantin i Helena', 'hostel', 'avion', '2018-07-30', NULL, 19000),
(6, 'vise-nedeljna', 'EvroTurs', 'Irakli', 'privatni', 'avion', '2018-08-09', NULL, 20000),
(7, 'nedeljna', 'BigBlue', 'Kavarna', 'hostel', 'sopstveni', '2018-09-10', NULL, 21000),
(8, 'nedeljna', 'Turisttrade', 'Kavarna', 'hotel', 'sopstveni', '2018-09-25', NULL, 21500),
(9, 'vise-nedeljna', 'Turisttrade', 'Konstantin i Helena', 'privatni', 'autobus', '2018-10-01', NULL, 21600),
(10, 'vise-nedeljna', 'Turisttrade', 'Irakli', 'privatni', 'avion', '2018-10-04', NULL, 21600),
(11, 'vise-nedeljna', 'BigBlue', 'Albena', 'privatni', 'sopstveni', '2018-10-05', NULL, 21700),
(12, 'vise-nedeljna', 'EvroTurs', 'Rusalka', 'privatni', 'autobus', '2018-10-15', NULL, 21800),
(13, 'vikend', 'BigBlue', 'Kavarna', 'hostel', 'autobus', '2018-10-16', NULL, 21900),
(14, 'vise-nedeljna', 'EuroTurs', 'Bodrost', 'hotel', 'sopstveni', '2018-10-25', NULL, 22000),
(15, 'vise-nedeljna', 'EuroTurs', 'Pamporovo', 'privatni', 'sopstveni', '2018-11-16', NULL, 22400),
(16, 'vikend', 'Philoxenia', 'Bodrost', 'hostel', 'sopstveni', '2018-11-28', NULL, 22500),
(17, 'nedeljna', 'Philoxenia', 'Semskovo', 'privatni', 'avion', '2018-12-12', NULL, 22600),
(18, 'vikend', 'EuroTurs', 'Borovec', 'hostel', 'sopstveni', '2018-12-20', NULL, 22800),
(19, 'vikend', 'EuroTurs', 'Cigov Cark', 'hostel', 'avion', '2019-01-18', NULL, 22900),
(20, 'vise-nedeljna', 'EuroTurs', 'Kulinoto', 'privatni', 'avion', '2019-01-23', NULL, 23000),
(21, 'vikend', 'BigStar', 'Albena', 'privatni', 'sopstveni', '2019-01-31', NULL, 23200),
(22, 'vise-nedeljna', 'Prestige', 'Fira', 'privatni', 'avion', '2019-02-05', NULL, 235000),
(23, 'vise-nedeljna', 'Prestige', 'Cesme', 'privatni', 'avion', '2019-02-08', NULL, 23600),
(24, 'vise-nedeljna', 'Alimpex', 'Ercijes Ski Resort', 'hotel', 'autobus', '2019-02-12', NULL, 23700),
(25, 'vikend', 'MountTurs', 'Kartalkaja', 'hotel', 'sopstveni', '2019-03-06', NULL, 23800),
(26, 'vikend', 'MountTurs', 'Sofija', 'privatni', 'autobus', '2019-03-27', NULL, 23900),
(27, 'vikend', 'MountTurs', 'Oludeniz', 'hotel', 'avion', '2019-04-03', NULL, 24000),
(28, 'vikend', 'BojanaTurs', 'Alanja', 'privatni', 'avion', '2019-04-16', NULL, 24200),
(29, 'vikend', 'AllegroTravel', 'Ruse', 'hostel', 'sopstveni', '2019-04-18', NULL, 24300),
(30, 'vise-nedeljna', 'Sherry', 'Oludeniz', 'hotel', 'autobus', '2018-08-16', NULL, 24300),
(31, 'vikend', 'AllegroTravel', 'Hanija', 'hotel', 'avion', '2018-09-10', NULL, 24300),
(32, 'nedeljna', 'BojanaTurs', 'Cesme', 'hotel', 'autobus', '2018-09-14', NULL, 24300),
(33, 'nedeljna', 'SuTrans', 'Istanbul', 'privatni', 'avion', '2018-09-18', NULL, 24300),
(34, 'vise-nedeljna', 'AllegroTravel', 'Kasiopi', 'privatni', 'autobus', '2018-09-19', NULL, 24300),
(35, 'nedeljna', 'BojanaTurs', 'Veliko Tarnovo', 'privatni', 'autobus', '2018-10-02', NULL, 24300),
(36, 'nedeljna', 'Alimpex', 'Ercijes Ski Resort', 'hostel', 'sopstveni', '2018-10-04', NULL, 24300),
(37, 'vise-nedeljna', 'Alimpex', 'Jedrene', 'privatni', 'autobus', '2018-10-19', NULL, 24300),
(38, 'vikend', 'BojanaTurs', 'Fira', 'hotel', 'avion', '2018-10-25', NULL, 24300),
(39, 'nedeljna', 'Prestige', 'Kusadasi', 'hostel', 'autobus', '2018-11-02', NULL, 24300),
(40, 'vise-nedeljna', 'MountTurs', 'Hanija', 'hotel', 'avion', '2018-12-19', NULL, 24300),
(41, 'vikend', 'SuTrans', 'Izmir', 'privatni', 'autobus', '2018-12-26', NULL, 24300),
(42, 'vise-nedeljna', 'Prestige', 'Kusadasi', 'hotel', 'avion', '2019-01-03', NULL, 24300),
(43, 'vikend', 'Proffis', 'Ruse', 'hostel', 'avion', '2019-01-07', NULL, 24300),
(44, 'vikend', 'AllegroTravel', 'Atina', 'hotel', 'sopstveni', '2019-01-09', NULL, 24300),
(45, 'vise-nedeljna', 'SuTrans', 'Kartalkaja', 'hotel', 'avion', '2019-01-23', NULL, 24300),
(46, 'vise-nedeljna', 'BojanaTurs', 'Izmir', 'privatni', 'autobus', '2019-02-12', NULL, 24300),
(47, 'vise-nedeljna', 'BojanaTurs', 'Laganas', 'hotel', 'autobus', '2019-02-20', NULL, 24300),
(48, 'nedeljna', 'AllegroTravel', 'Oludeniz', 'hotel', 'autobus', '2019-02-22', NULL, 24300),
(49, 'vikend', 'Prestige', 'Heraklion', 'privatni', 'sopstveni', '2019-02-27', NULL, 24300),
(50, 'nedeljna', 'Proffis', 'Ankara', 'hotel', 'sopstveni', '2019-03-01', NULL, 24300),
(51, 'nedeljna', 'Alimpex', 'Saklikent', 'hostel', 'autobus', '2019-03-11', NULL, 24300),
(52, 'vise-nedeljna', 'AllegroTravel', 'Sidari', 'privatni', 'sopstveni', '2019-03-19', NULL, 24300),
(53, 'nedeljna', 'Sherry', 'Izmir', 'privatni', 'avion', '2019-03-21', NULL, 24300),
(54, 'vikend', 'AllegroTravel', 'Kasiopi', 'hostel', 'sopstveni', '2019-03-25', NULL, 24300),
(55, 'vikend', 'Proffis', 'Fira', 'hostel', 'autobus', '2018-08-10', NULL, 24300),
(56, 'vikend', 'AllegroTravel', 'Kavala', 'hostel', 'avion', '2018-08-13', NULL, 24300),
(57, 'vikend', 'SuTrans', 'Laganas', 'hotel', 'sopstveni', '2018-09-04', NULL, 24300);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(250) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stanje` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_user`, `name`, `email`, `username`, `password`, `reg_date`, `stanje`) VALUES
(1, 'Nikola Radunovic', 'nikola9371@gmail.com', 'nikola', 'd6eed32bf5cb8c8d99b6f76ebe408c342d5377c2', '2018-07-29 20:42:44', 20030),
(3, 'Nika Mikic', 'mika@gmail.com', 'mika', 'd6eed32bf5cb8c8d99b6f76ebe408c342d5377c2', '2018-07-30 21:58:30', NULL),
(4, 'Mina Milanovic', 'mina@gmail.com', 'mina', 'd6eed32bf5cb8c8d99b6f76ebe408c342d5377c2', '2018-08-01 00:38:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE `login_admin` (
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(250) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_admin`
--

INSERT INTO `login_admin` (`id_user`, `name`, `email`, `username`, `password`, `reg_date`) VALUES
(1, 'Nikola Nikodinovic', 'nikola9371@gmail.com', 'nikola', 'd6eed32bf5cb8c8d99b6f76ebe408c342d5377c2', '2018-07-22 22:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbenica`
--

CREATE TABLE `narudzbenica` (
  `idNarudzbenica` int(11) NOT NULL,
  `datumKupovine` date NOT NULL,
  `idKupac` int(11) NOT NULL,
  `idAranzman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `narudzbenica`
--

INSERT INTO `narudzbenica` (`idNarudzbenica`, `datumKupovine`, `idKupac`, `idAranzman`) VALUES
(11, '2018-07-28', 1, 1),
(16, '2018-07-29', 1, 1),
(20, '2018-07-30', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `profile_pics`
--

CREATE TABLE `profile_pics` (
  `id_pic` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_pics`
--

INSERT INTO `profile_pics` (`id_pic`, `name`, `id_user`) VALUES
(1, 'phonepicutres-TA.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile_pics_admin`
--

CREATE TABLE `profile_pics_admin` (
  `id_pic` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_pics_admin`
--

INSERT INTO `profile_pics_admin` (`id_pic`, `name`, `id_user`) VALUES
(1, 'orao1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reklamacija`
--

CREATE TABLE `reklamacija` (
  `idReklamacije` int(11) NOT NULL,
  `idNarudzbenica` int(11) NOT NULL,
  `imePrezime` varchar(30) NOT NULL,
  `datumRodjenja` date NOT NULL,
  `pol` varchar(10) NOT NULL,
  `komentar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reklamacija`
--

INSERT INTO `reklamacija` (`idReklamacije`, `idNarudzbenica`, `imePrezime`, `datumRodjenja`, `pol`, `komentar`) VALUES
(1, 1, 'Nikola Radunovic', '1993-04-13', 'muski', NULL),
(2, 4, 'Stevan Stevic', '1990-07-17', 'muski', NULL),
(4, 4, 'Nenan Prvic', '2018-07-28', 'muski', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aranzman`
--
ALTER TABLE `aranzman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `login_admin`
--
ALTER TABLE `login_admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `narudzbenica`
--
ALTER TABLE `narudzbenica`
  ADD PRIMARY KEY (`idNarudzbenica`),
  ADD KEY `idKupac` (`idKupac`),
  ADD KEY `idAranzman` (`idAranzman`),
  ADD KEY `idKupac_2` (`idKupac`);

--
-- Indexes for table `profile_pics`
--
ALTER TABLE `profile_pics`
  ADD PRIMARY KEY (`id_pic`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `profile_pics_admin`
--
ALTER TABLE `profile_pics_admin`
  ADD PRIMARY KEY (`id_pic`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `reklamacija`
--
ALTER TABLE `reklamacija`
  ADD PRIMARY KEY (`idReklamacije`),
  ADD KEY `idNarudzbenica` (`idNarudzbenica`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aranzman`
--
ALTER TABLE `aranzman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_admin`
--
ALTER TABLE `login_admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `narudzbenica`
--
ALTER TABLE `narudzbenica`
  MODIFY `idNarudzbenica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `profile_pics`
--
ALTER TABLE `profile_pics`
  MODIFY `id_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile_pics_admin`
--
ALTER TABLE `profile_pics_admin`
  MODIFY `id_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reklamacija`
--
ALTER TABLE `reklamacija`
  MODIFY `idReklamacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `narudzbenica`
--
ALTER TABLE `narudzbenica`
  ADD CONSTRAINT `narudzbenica_ibfk_1` FOREIGN KEY (`idAranzman`) REFERENCES `aranzman` (`id`),
  ADD CONSTRAINT `narudzbenica_ibfk_2` FOREIGN KEY (`idKupac`) REFERENCES `login` (`id_user`);

--
-- Constraints for table `profile_pics`
--
ALTER TABLE `profile_pics`
  ADD CONSTRAINT `profile_pics_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`);

--
-- Constraints for table `profile_pics_admin`
--
ALTER TABLE `profile_pics_admin`
  ADD CONSTRAINT `profile_pics_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login_admin` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
