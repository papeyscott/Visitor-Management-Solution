-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2019 at 03:44 AM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glh_visitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `hash`, `date_created`, `level`) VALUES
(7, 'Banji', 'Akole', 'banjimayowa@gmail.com', '$2y$10$nfIX.S/vu469XEOOr4nrjupfWxF2tHfUwpX7S0sH1eyaIY8tZivs.', '2018-02-28', 'MASTER'),
(34, 'GreenLand', 'Hall', 'visitors@greenlandhall.org', '$2y$10$hz0bXkYPN.mB.ObtfflHauYg.ogsMLJ4zbSJN.O7lSV1tcnhmGXi.', '2019-01-18', 'MASTER');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(225) NOT NULL,
  `company` varchar(225) NOT NULL,
  `vnumber` varchar(225) NOT NULL,
  `item` varchar(225) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `whom` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `date_created` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `name`, `company`, `vnumber`, `item`, `qty`, `whom`, `address`, `date_created`) VALUES
(1, 'ADEDIGBA JOY', 'usp', '0254896', 'Parcel', '2', 'IBRAHIM TEMITOPE', '         ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss                                       ', '2019-01-18'),
(2, 'Seun Sanni', 'Jumia', 'FKJ6765TY', 'Parcel', '3', 'BABASOLA JANET', 'Ikeja, Lagos', '2019-01-22'),
(3, 'Fuji Balogun', 'Konga', 'FKJ452TA', 'Water for Kitchen', '4', 'Adulab Waheeb', '24 Baale Street, Ogudu', '2019-01-29'),
(4, 'Ayodeji', 'Enactus', 'cdc 58852 gg', 'ffff', '2', 'TADE, AYODEJI', '222222222222222222222222222', '2019-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `phone` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `school_category` varchar(255) DEFAULT NULL,
  `staff_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `phone`, `address`, `school_category`, `staff_status`) VALUES
(2, 'ONAJOBI OPEYEMI', 'opeyemi.onajobi@greenlandhall.org', '08064989811', 'ART & CRAFT/DRAMA', 'Secondary', 'Academic'),
(4, 'OGUNDARE SHAKIRAT', 'shakirat.ogundare@greenlandhall.org.ng', '08038516483', 'CLASS TEACHER', 'Primary', 'Academic'),
(5, 'FOLAKE OSHOSANYA', 'folake.oshosanya@greenlandhall.org', '08033710459', 'SECRETARY/FRONT DESK OFFICER\r\n      ', 'Primary', 'Non-Academic'),
(6, 'AJIKE BLESSING', '', '08183361653', 'BUS ATTENDANT\r\n      ', 'Primary', 'Non-Academic'),
(7, 'FUNMILAYO FAGBOYI', '', '08035585826', 'LIBRARY AID\r\n      ', 'Primary', 'Non-Academic'),
(8, 'OGAR MONICA', '', '08107803822', 'DAYCARE\r\n      ', 'Primary', 'Non-Academic'),
(9, 'OLAYIWOLA ELIZABETH', '', '08081169682', '\r\n      BUS ATTENDANT', 'Primary', 'Non-Academic'),
(10, 'ADENIYI JANET', '', '08183317598', '\r\n      CLEANER', 'Primary', 'Non-Academic'),
(11, 'MUSA VICTORIA', '', '08100893229', 'CLEANER\r\n      ', 'Primary', 'Non-Academic'),
(12, 'OKON JOY', '', '07081820061', 'BUS ATTENDANT\r\n      ', 'Primary', 'Non-Academic'),
(13, 'ADEDIGBA JOY', 'adedigba.joy@greenlandhall.org', '08185130475', 'HOUSE MISTRESS\r\n\r\n      ', 'Primary', 'Non-Academic'),
(14, 'OLUWASEUN BADIRU', '', '07034569228', 'COOK\r\n\r\n      ', 'Primary', 'Non-Academic'),
(15, 'OLUNADE TOYIN', '', '08082440640', 'CLEANER\r\n\r\n      ', 'Primary', 'Non-Academic'),
(16, 'UBANEDE LOUIS', '', '08032269758', '\r\n      Security', 'Primary', 'Non-Academic'),
(17, 'OROGHODO ESTHER', 'esther.orogodo@greenlandhall.org', '07038175508', 'TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(18, 'IDRIS KEHINDE MONSURAT', 'kehinde.idris@greenlandhall.org', '07038175507', 'TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(19, 'AREMU FUNMILAYO LARA', 'funmilayo.aremu@greenlandhall.org', '08174718256', 'TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(20, 'AJALA UCHIKARU FAVOUR', 'favour.ajala@greenlandhall.org', '08148192133', 'TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(21, 'IBRAHIM TEMITOPE', 'temitope.ibrahim@greenlandhall.org', '08138154763', 'TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(22, 'PEDRO OYINLOLA', 'pedro.oyinlola@greenland.org', '08143360421', 'SPECIAL TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(23, 'ADEGOKE ADEDAYO DORCAS', 'adedayo.adegoke@greenlandhall.org', '08134334665', 'COORDINATOR\r\n\r\n      ', 'Primary', 'Academic'),
(24, 'AKINDE SUNDAY', 'Sunday.akinde@greenlandhall.org', '08072455186', 'TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(25, 'OMOH OZIEGBE GODWIN', 'omo.oziegbe@greenlandhall.org', '07038823384', 'TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(26, 'PETER EBOJOH', 'peter.ebojoh@greenlandhall.org', '08173978145', 'TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(27, 'OYEBAMJI ESTHER ATINUKE', 'tinu.oyebamji@greenlandhall.org', '09035294013', 'CLASS TEACHER\r\n\r\n      ', 'Pre school', 'Academic'),
(28, 'OMOTOSHO ODUNAYO', 'odunayo.omotosho@greenlandhall.org', '08064354885', 'CLASS TEACHER\r\n\r\n      ', 'Pre school', 'Academic'),
(29, 'EMMANUEL NGOZI VICTORIA', 'ngozie.emmanuel@greenlandhall.org', '08067346381', 'CLASS TEACHER\r\n\r\n      ', 'Pre school', 'Academic'),
(30, 'OMOLOLA TAIWO', 'omolola.taiwo@greenlandhall.org', '08025173470', 'CLASS TEACHER\r\n\r\n      ', 'Pre school', 'Academic'),
(31, 'ENISAN ADENIKE', 'adenike.enisan@greenlandhall.org', '08068299881', 'CLASS TEACHER\r\n\r\n      ', 'Pre school', 'Academic'),
(32, 'OLAYINKA MODUPE', 'modupe.olayinka@greenlandhall.org', '08032692406', 'HEAD TEACHER\r\n\r\n      ', 'Primary', 'Academic'),
(33, 'OLASUPO TOYIN', 'toyin.olasupo@greenlandhall.org', '00000000000', 'CLASS TEACHER\r\n\r\n      ', 'Pre school', 'Academic'),
(34, 'THOMAS FATOKI', 'thomas.fatoki@greenlandhall.org', '07085910624', 'ACCOUNT OFFICER/STORE KEEPER\r\n\r\n      ', 'Secondary', 'Non-Academic'),
(35, 'FOLORUNSHO FUNKE', '', '08085764635', 'CLEANER\r\n\r\n      ', 'Secondary', 'Non-Academic'),
(36, 'KESHINRO AFUAPE', '', '08034340873', 'DRIVER\r\n\r\n      ', 'Secondary', 'Academic'),
(37, 'JOLLY OMOAREBUN', '', '07035042127', 'DRIVER\r\n\r\n      ', 'Primary', 'Academic'),
(38, 'FELICIA OMOREBU', '', '08134780385', 'CLEANER\r\n\r\n      ', 'Secondary', 'Academic'),
(39, 'JULIUS ATAMAH', '', '08062818490', 'DRIVER\r\n\r\n      ', 'Secondary', 'Academic'),
(40, 'CHARLES ANITA', '', '09060833372', 'BUS ATTENDANT\r\n\r\n      ', 'Secondary', 'Academic'),
(41, 'AINA FUNMILAYO', '', '08132557255', 'BUS ATTENDANT\r\n\r\n      ', 'Secondary', 'Academic'),
(42, 'ORIYOMI ABIJO', '', '09095811928', 'DRIVER\r\n\r\n      ', 'Secondary', 'Academic'),
(43, 'ANTHONY EZE', '', '07018125058', 'BUS DRIVER\r\n\r\n      ', 'Secondary', 'Academic'),
(44, 'BABASOLA JANET', 'janet.babasola@greenlandhall.org', '08038072269', 'ADMIN CORDINATOR\r\n\r\n      ', 'Secondary', 'Academic'),
(45, 'AGNES UBANEDE', '', '08032269758', 'CLEANER\r\n\r\n      ', 'Secondary', 'Academic'),
(46, 'OLUWAFEMI DAVID', 'david.oluwafemi@greenlandhall.org', '08184055633', 'HEAD OF SCHOOLS\r\n\r\n      ', 'Secondary', 'Academic'),
(47, 'NWAIGBO BEATRICE', 'beatrice.nwaigbo@greenlandhall.org', '08111438115', 'MATHEMATICS/ICT\r\n\r\n      ', 'Secondary', 'Academic'),
(48, 'OGUNSAKIN SULAIMON', 'sulaimon.ogunsakin@greenland.org', '08062779854', 'PHE\r\n\r\n      ', 'Secondary', 'Academic'),
(49, 'ADELAJA SAMUEL OLAMILEKAN', 'samuel.adelaja@greenlandhall.org', '08024589532', 'GOVERNMENT/CIVIC TUTOR\r\n\r\n      ', 'Secondary', 'Academic'),
(50, 'JEGEDE OLATUNBOSUN', 'jegede.olatunbosun@greenlandhall.org', '08146403608', 'BASIC TECH/HOME ECONS. TUTOR\r\n\r\n      ', 'Secondary', 'Academic'),
(51, 'EDAFE MICHAEL OVIE-DIVINE', 'michael.edafe@greenlandhall.org', '08161542691', 'COORDINATOR SS/TUTOR\r\n\r\n      ', 'Secondary', 'Academic'),
(52, 'MATTHEWS ADEOYE ADEYEMI', 'adeoye.matthew@greenlandhall.org', '08033857790', 'MATH/F-MATHS TUTOR.\r\n\r\n      ', 'Secondary', 'Academic'),
(53, 'ANYANWU DEBORAH ADAKU', 'deborah.anyanwu@greenlandhall.org', '08038918526', 'COMPUTER/ICT TUTOR\r\n\r\n      ', 'Secondary', 'Academic'),
(54, 'JINADU TAOFEEK OLAWALE', 'taofeek.jinadu@greenlandhall.org', '08033468273', 'BIOLOGY TUTOR\r\n\r\n      ', 'Secondary', 'Academic'),
(55, 'OJEBODE SAMSON OLUFEMI', 'olufemi.ojebode@greenlandhall.org', '08023834765', 'ECONOMICS/SOCIAL STUDIES\r\n\r\n      ', 'Secondary', 'Academic'),
(56, 'OKUNOLA ANTHONY', 'okunola.anthony@greenlandhall.org', '07037962020', 'CRS /FELLOWSHIP CORD.\r\n\r\n      ', 'Secondary', 'Academic'),
(57, 'MAALA BOLORUNDURO AUGUSTINE', 'augustine.maala@greenlandhall.org', '08065695617', 'COMMERCE/BUSINESS STD.TUTOR\r\n\r\n\r\n      ', 'Secondary', 'Academic'),
(58, 'AJIBOYE V.O FADIJI', 'oluwayemisi.ajiboye@greenlandhall.org', '08065987513', 'CATERING CRAFT &FOOD AND NUTRI.\r\n\r\n      ', 'Secondary', 'Academic'),
(59, 'ABOBARIN OLUWATOSIN', 'tosin.abobarin@greenlandhall.org', '08106817785', 'CHEMISTRY/AGRIC.\r\n\r\n      ', 'Secondary', 'Academic'),
(60, 'KOLAWOLE ABAYOMI KAYODE', 'kolawole.abayomi@greenlandhall.org', '08132874962', 'CHEMISTRY AND BASIC SCIENCE\r\n\r\n      ', 'Secondary', 'Academic'),
(61, 'OKENYEN VERA', 'vera.okenyen@greenlandhall.org', '07061173236', 'GEO/AGRIC.SOCIAL STUDIES TUTOR\r\n\r\n      ', 'Secondary', 'Academic'),
(62, 'AGBOOLA BUKOLA FUNKE', 'bukola.agboola@greenlandhall.org', '08022015239', 'CIVIC /SOCIAL TEACHER\r\n\r\n      ', 'Secondary', 'Academic'),
(63, 'FASANYA HOPE MICHAEL', 'hope.fasanya@greenlandhall.org', '07030098039', 'ENGLISH LANG.& LIT. TUTOR\r\n\r\n      ', 'Secondary', 'Academic'),
(64, 'OLATOYAN SERIFAT AYOBAMI', 'ayobami.olatoyan@greenlandhall.org', '08073483556', 'YORUBA LANGUAGE\r\n\r\n      ', 'Secondary', 'Academic'),
(66, 'Akole Banji TEST EMPLOYEE', 'banjimayowa@gmail.com', '09055062879', 'Baale Close, Oregun Lagos', 'Secondary', 'Academic'),
(67, 'Akole Banji', 'banjimayowa@gmail.com', '09055062879', 'Baale Close, Oregun Lagos', 'Secondary', 'Non-Academic'),
(68, 'DAPO ORIMOLOYE', 'dapo.orimoloye@greenlandhall.org', '07033959529', 'Head of Academics\r\n      ', 'Secondary', 'Academic'),
(70, 'Adulab Waheeb', 'tech@greenlandhall.org', '09031913059', 'Ast, Exec Director\r\n      ', 'Secondary', 'Non-Academic'),
(72, 'Ayodeji Tade', 'ayodeji.tade@greenlandhall.org', '07033751685', 'Tech Support\r\n      ', 'Secondary', 'Non-Academic');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `school_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `company` varchar(225) DEFAULT NULL,
  `phone` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `purpose` text,
  `whom` varchar(225) DEFAULT NULL,
  `image` text,
  `status` varchar(225) DEFAULT NULL,
  `last_login` time DEFAULT NULL,
  `last_logout` time DEFAULT NULL,
  `last_login_date` date DEFAULT NULL,
  `last_logout_date` date DEFAULT NULL,
  `type` int(11) NOT NULL,
  `suspend_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `name`, `email`, `company`, `phone`, `address`, `purpose`, `whom`, `image`, `status`, `last_login`, `last_logout`, `last_login_date`, `last_logout_date`, `type`, `suspend_status`) VALUES
(5, 'kole BAnji', 'banjimayowa@gmail.com', '5678900987654', '08168785591', '34569086', 'Contractor', 'Akole Banji TEST EMPLOYEE', 'uploads/15489185954754943WhatsApp_Image_2018-12-01_at_4.27.48_PM.jpeg', 'signed out', '00:23:45', '03:03:12', '2019-02-10', '2019-02-11', 1, 1),
(16, 'Akole Banji', 'banjimayowa@gmail.com', 'Boardspeck', '08035602849', 'Baale Close, Oregun Lagos', 'waste time', 'TADE, AYODEJI', 'uploads/1548965893539115212805850_470834549780453_8828166806062221559_n.jpg', 'signed in', '02:56:42', '02:56:05', '2019-02-01', '2019-02-01', 1, NULL),
(17, 'Ayodeji', 'tadeayodeji92@gmail.com', 'Enactus', '07033751685', 'Supremo ', 'Contractor', 'Ayodeji Tade', 'uploads/154897176822217231548971739189199945417.jpg', 'signed in', '03:05:26', '03:04:55', '2019-02-11', '2019-02-11', 1, NULL),
(19, 'Opeyemi Aderogba', 'ooaderogba@gmail.com', 'Cradle Solution', '09031913059', '36 Gerard Road, Ikoyi, Lagos', 'Contractor', 'Olumide', 'uploads/1549020223308788220180131_114016-01.jpg', 'signed out', '02:31:07', '10:38:34', '2019-02-07', '2019-02-09', 1, NULL),
(20, 'Ayodele Agbedana', 'ayo@lex.com.ng', 'Lex Quaritus', '08036798100', 'Admiralty Road,lekki', 'Parent', 'Adulab Waheeb', 'uploads/1549740243341935115497399356332692291816673813540.jpg', 'signed in', '12:24:03', NULL, '2019-02-09', NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
