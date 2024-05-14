-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 11:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skartoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `jelovnik`
--

CREATE TABLE `jelovnik` (
  `id` int(11) NOT NULL,
  `naziv` text NOT NULL,
  `Event` text NOT NULL,
  `mjesto` longtext NOT NULL,
  `koridnate` longtext NOT NULL,
  `datum_start` date DEFAULT NULL,
  `datum_kraj` date DEFAULT NULL,
  `aktivan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jelovnik`
--

INSERT INTO `jelovnik` (`id`, `naziv`, `Event`, `mjesto`, `koridnate`, `datum_start`, `datum_kraj`, `aktivan`) VALUES
(1, 'Jelovnik', 'Burger festival u Čakovcu', 'Čakovec', 'https://maps.app.goo.gl/UfCuC2JSfq9frRzN7', '2023-02-06', '2023-02-07', 1),
(2, 'Jelovnik', 'Advent u Varaždinu', 'Varaždin', '-', '2023-12-01', '2024-01-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `korisnicko_ime`, `email`, `ime`, `prezime`, `lozinka`, `admin`) VALUES
(1, 'proba', '', 'proba', 'proba', 'proba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ponuda`
--

CREATE TABLE `ponuda` (
  `id` int(11) NOT NULL,
  `naziv` longtext NOT NULL,
  `sastojci_hrv` longtext NOT NULL,
  `sastojci_eng` longtext NOT NULL,
  `slika_putanja` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ponuda`
--

INSERT INTO `ponuda` (`id`, `naziv`, `sastojci_hrv`, `sastojci_eng`, `slika_putanja`) VALUES
(1, 'ŠKARTOC BURGER', 'Pljeskavica - lisnata salata - čips od pancete - cheddar sir - BBQ umak - coleslaw salata - burger pecivo', 'Hamburger – lettuce – bacon chips - cheddar cheese - BBQ sauce - coleslaw salad - burger buns', 'slike/jelovnik/skartoc_bruger.jpeg'),
(8, 'Gospon Buncek', 'Dimljeni buncek - kineski kupus - pečena paprika - pržene bučine koštice - dresing na bazi majoneze - brioche burger pecivo', 'Smoked ham hock - Chinese cabbage - roasted peppers - fried pumpkin seeds – mayonnaise dressing - brioche burger buns', 'slike/jelovnik/gospon_buncek.jpeg'),
(9, 'BBQ REBARCA', 'Bbq spare ribs 380 dkg - krumpirići - coleslaw salata', 'Bbq spare ribs 380 dkg - french fries - coleslaw salad', 'slike/jelovnik/bbq_rebarca.jpeg'),
(10, 'ZIMSKI ŽEPEKI', 'Dinstane jabuke u prženom lisnatom tijestu - umak od vanilije- zimski posip - caramela', 'Stewed apples in fried puff pastry - vanilla sauce - winter powder - caramel', 'slike/jelovnik/zimski_zepeki.jpeg'),
(11, 'XL KOBASICA', 'Dimljena blago pikant kobasica sa sirom - lisnata salatica - pečena paprika - prženi luk - slatki senf umak - brioche torpedo pecivo', 'Smoked hot sausage with cheese - lettuce - roasted peppers - fried onion - sweet mustard sauce - brioche torpedo buns', 'slike/jelovnik/xl_kobasa.jpeg'),
(12, 'VEGANO BURGER', 'Burger od cikle 150 g - lisnata salatica - krema od graška marinirano povrće - kiseli krastavci - BBQ umak - vegansko pecivo', 'Beetroot burger - pea cream- lettucemarinated vegetables pickles - BBQ sauce - vegan bun', 'slike/jelovnik/vegano_burger.jpeg'),
(13, 'Krumpirići', 'Krumpirći', '  French fries', 'slike/jelovnik/krumpirici.jpeg'),
(14, 'KRUMPIRIĆI S KREM CHEDDAR SIROM I PRŽENIM LUKOM', ' ', 'French fries with cream cheddar cheese and fried onions', 'slike/jelovnik/krumpirici.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `spoj`
--

CREATE TABLE `spoj` (
  `id` int(11) NOT NULL,
  `jelovnik_id` int(11) NOT NULL,
  `ponuda_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spoj`
--

INSERT INTO `spoj` (`id`, `jelovnik_id`, `ponuda_id`) VALUES
(2, 1, 2),
(3, 1, 3),
(4, 1, 6),
(8, 1, 8),
(9, 1, 1),
(13, 2, 8),
(14, 2, 9),
(15, 2, 10),
(16, 2, 11),
(18, 1, 12),
(19, 1, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jelovnik`
--
ALTER TABLE `jelovnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ponuda`
--
ALTER TABLE `ponuda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spoj`
--
ALTER TABLE `spoj`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jelovnik`
--
ALTER TABLE `jelovnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ponuda`
--
ALTER TABLE `ponuda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `spoj`
--
ALTER TABLE `spoj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
