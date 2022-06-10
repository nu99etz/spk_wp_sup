-- MariaDB dump 10.19  Distrib 10.7.3-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: spk_wp_sup
-- ------------------------------------------------------
-- Server version	10.7.3-MariaDB-1:10.7.3+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kriteria` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria`
--

LOCK TABLES `kriteria` WRITE;
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` VALUES
(1,'PROTEIN',0),
(2,'KALORI',1),
(3,'SUGAR',1),
(4,'FAT',1),
(5,'KARBOHIDRAT',1),
(6,'JUMLAH SAJIAN',0),
(14,'Harga',0);
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria_produk`
--

DROP TABLE IF EXISTS `kriteria_produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kriteria_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produk` (`id_produk`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `kriteria_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`),
  CONSTRAINT `kriteria_produk_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=613 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria_produk`
--

LOCK TABLES `kriteria_produk` WRITE;
/*!40000 ALTER TABLE `kriteria_produk` DISABLE KEYS */;
INSERT INTO `kriteria_produk` VALUES
(1,1,1,'40%'),
(2,2,1,'50%'),
(3,3,1,'55%'),
(4,4,1,'44%'),
(5,5,1,'52%'),
(6,6,1,'52%'),
(7,7,1,'44%'),
(8,8,1,'50%'),
(9,9,1,'48%'),
(10,10,1,'50%'),
(11,11,1,'40%'),
(12,12,1,'50%'),
(13,13,1,'44%'),
(14,14,1,'44%'),
(15,15,1,'40%'),
(16,16,1,'50%'),
(17,17,1,'44%'),
(18,18,1,'48%'),
(19,19,1,'50%'),
(20,20,1,'53%'),
(21,21,1,'48%'),
(22,22,1,'48%'),
(23,23,1,'45%'),
(24,24,1,'40%'),
(25,25,1,'50%'),
(26,26,1,'50%'),
(27,27,1,'50%'),
(28,28,1,'45%'),
(29,29,1,'48%'),
(30,30,1,'33%'),
(31,31,1,'42%'),
(32,32,1,'50%'),
(33,33,1,'50%'),
(34,34,1,'50%'),
(35,35,1,'45%'),
(36,36,1,'45%'),
(37,37,1,'48%'),
(38,38,1,'40%'),
(39,39,1,'40%'),
(40,40,1,'37%'),
(41,41,1,'46%'),
(42,42,1,'50%'),
(43,43,1,'60%'),
(44,44,1,'60%'),
(45,45,1,'60%'),
(46,46,1,'48%'),
(47,47,1,'48%'),
(48,48,1,'52%'),
(49,49,1,'60%'),
(50,50,1,'48%'),
(51,51,1,'52%'),
(52,52,1,'50%'),
(53,53,1,'46%'),
(54,54,1,'50%'),
(55,55,1,'48%'),
(56,56,1,'44%'),
(57,57,1,'48%'),
(58,58,1,'44%'),
(59,59,1,'50%'),
(60,60,1,'50%'),
(61,61,1,'49%'),
(62,62,1,'61%'),
(63,63,1,'50%'),
(64,64,1,'47%'),
(65,65,1,'50%'),
(66,66,1,'45%'),
(67,67,1,'50%'),
(68,68,1,'44%'),
(69,69,1,'50%'),
(70,70,1,'45%'),
(71,71,1,'50%'),
(72,72,1,'50%'),
(73,73,1,'50%'),
(74,74,1,'50%'),
(75,75,1,'45%'),
(76,76,1,'50%'),
(77,77,1,'48%'),
(78,78,1,'50%'),
(79,79,1,'45%'),
(80,80,1,'38%'),
(81,81,1,'56%'),
(82,82,1,'42%'),
(83,83,1,'42%'),
(84,84,1,'48%'),
(85,85,1,'42%'),
(86,86,1,'44%'),
(87,87,1,'40%'),
(88,88,1,'40%'),
(89,89,1,'80%'),
(90,90,1,'90%'),
(91,91,1,'48%'),
(92,92,1,'48%'),
(93,93,1,'66%'),
(94,94,1,'46%'),
(95,95,1,'93%'),
(96,96,1,'50%'),
(97,97,1,'40%'),
(98,98,1,'40%'),
(99,99,1,'45%'),
(100,100,1,'50%'),
(101,1,2,'110'),
(102,2,2,'120'),
(103,3,2,'650'),
(104,4,2,'130'),
(105,5,2,'140'),
(106,6,2,'110'),
(107,7,2,'116'),
(108,8,2,'160'),
(109,9,2,'120'),
(110,10,2,'130'),
(111,11,2,'120'),
(112,12,2,'150'),
(113,13,2,'200'),
(114,14,2,'200'),
(115,15,2,'700'),
(116,16,2,'140'),
(117,17,2,'200'),
(118,18,2,'150'),
(119,19,2,'120'),
(120,20,2,'110'),
(121,21,2,'110'),
(122,22,2,'110'),
(123,23,2,'120'),
(124,24,2,'160'),
(125,25,2,'100'),
(126,26,2,'160'),
(127,27,2,'150'),
(128,28,2,'140'),
(129,29,2,'125'),
(130,30,2,'120'),
(131,31,2,'100'),
(132,32,2,'120'),
(133,33,2,'120'),
(134,34,2,'140'),
(135,35,2,'140'),
(136,36,2,'140'),
(137,37,2,'110'),
(138,38,2,'130'),
(139,39,2,'140'),
(140,40,2,'90'),
(141,41,2,'120'),
(142,42,2,'120'),
(143,43,2,'130'),
(144,44,2,'160'),
(145,45,2,'160'),
(146,46,2,'130'),
(147,47,2,'120'),
(148,48,2,'160'),
(149,49,2,'160'),
(150,50,2,'130'),
(151,51,2,'160'),
(152,52,2,'710'),
(153,53,2,'110'),
(154,54,2,'120'),
(155,55,2,'120'),
(156,56,2,'150'),
(157,57,2,'130'),
(158,58,2,'130'),
(159,59,2,'125'),
(160,60,2,'125'),
(161,61,2,'117'),
(162,62,2,'137'),
(163,63,2,'108'),
(164,64,2,'110'),
(165,65,2,'144'),
(166,66,2,'110'),
(167,67,2,'110'),
(168,68,2,'120'),
(169,69,2,'190'),
(170,70,2,'130'),
(171,71,2,'120'),
(172,72,2,'530'),
(173,73,2,'120'),
(174,74,2,'120'),
(175,75,2,'120'),
(176,76,2,'1030'),
(177,77,2,'130'),
(178,78,2,'110'),
(179,79,2,'130'),
(180,80,2,'114'),
(181,81,2,'131'),
(182,82,2,'102'),
(183,83,2,'87'),
(184,84,2,'107'),
(185,85,2,'113'),
(186,86,2,'112'),
(187,87,2,'80'),
(188,88,2,'89'),
(189,89,2,'99'),
(190,90,2,'92'),
(191,91,2,'120'),
(192,92,2,'100'),
(193,93,2,'150'),
(194,94,2,'90'),
(195,95,2,'130'),
(196,96,2,'120'),
(197,97,2,'130'),
(198,98,2,'140'),
(199,99,2,'130'),
(200,100,2,'120'),
(201,1,3,'4%'),
(202,2,3,'0%'),
(203,3,3,'6%'),
(204,4,3,'0%'),
(205,5,3,'0%'),
(206,6,3,'1%'),
(207,7,3,'3%'),
(208,8,3,'0%'),
(209,9,3,'0%'),
(210,10,3,'0%'),
(211,11,3,'0%'),
(212,12,3,'1%'),
(213,13,3,'4%'),
(214,14,3,'4%'),
(215,15,3,'10%'),
(216,16,3,'0%'),
(217,17,3,'2%'),
(218,18,3,'0%'),
(219,19,3,'0%'),
(220,20,3,'0%'),
(221,21,3,'0%'),
(222,22,3,'0%'),
(223,23,3,'0%'),
(224,24,3,'0%'),
(225,25,3,'0%'),
(226,26,3,'0%'),
(227,27,3,'0%'),
(228,28,3,'0%'),
(229,29,3,'0%'),
(230,30,3,'0%'),
(231,31,3,'0%'),
(232,32,3,'0%'),
(233,33,3,'0%'),
(234,34,3,'0%'),
(235,35,3,'0%'),
(236,36,3,'0%'),
(237,37,3,'0%'),
(238,38,3,'0%'),
(239,39,3,'0%'),
(240,40,3,'0%'),
(241,41,3,'1%'),
(242,42,3,'0%'),
(243,43,3,'0%'),
(244,44,3,'0%'),
(245,45,3,'0%'),
(246,46,3,'0%'),
(247,47,3,'0%'),
(248,48,3,'0%'),
(249,49,3,'0%'),
(250,50,3,'0%'),
(251,51,3,'0%'),
(252,52,3,'0%'),
(253,53,3,'0%'),
(254,54,3,'0%'),
(255,55,3,'1%'),
(256,56,3,'0%'),
(257,57,3,'0%'),
(258,58,3,'0%'),
(259,59,3,'0%'),
(260,60,3,'0%'),
(261,61,3,'0%'),
(262,62,3,'0%'),
(263,63,3,'1%'),
(264,64,3,'2%'),
(265,65,3,'1%'),
(266,66,3,'0%'),
(267,67,3,'0%'),
(268,68,3,'0%'),
(269,69,3,'0%'),
(270,70,3,'0%'),
(271,71,3,'0%'),
(272,72,3,'6%'),
(273,73,3,'0%'),
(274,74,3,'0%'),
(275,75,3,'0%'),
(276,76,3,'25%'),
(277,77,3,'0%'),
(278,78,3,'0%'),
(279,79,3,'0%'),
(280,80,3,'2%'),
(281,81,3,'2%'),
(282,82,3,'2%'),
(283,83,3,'0%'),
(284,84,3,'1%'),
(285,85,3,'2%'),
(286,86,3,'2%'),
(287,87,3,'0%'),
(288,88,3,'0%'),
(289,89,3,'1%'),
(290,90,3,'0%'),
(291,91,3,'0%'),
(292,92,3,'0%'),
(293,93,3,'0%'),
(294,94,3,'0%'),
(295,95,3,'0%'),
(296,96,3,'0%'),
(297,97,3,'0%'),
(298,98,3,'0%'),
(299,99,3,'0%'),
(300,100,3,'0%'),
(301,1,4,'2%'),
(302,2,4,'1%'),
(303,3,4,'7%'),
(304,4,4,'3%'),
(305,5,4,'2%'),
(306,6,4,'1%'),
(307,7,4,'3%'),
(308,8,4,'4%'),
(309,9,4,'2%'),
(310,10,4,'2%'),
(311,11,4,'3%'),
(312,12,4,'5%'),
(313,13,4,'8%'),
(314,14,4,'8%'),
(315,15,4,'23%'),
(316,16,4,'2%'),
(317,17,4,'8%'),
(318,18,4,'5%'),
(319,19,4,'0%'),
(320,20,4,'0%'),
(321,21,4,'5%'),
(322,22,4,'5%'),
(323,23,4,'2%'),
(324,24,4,'4%'),
(325,25,4,'0%'),
(326,26,4,'4%'),
(327,27,4,'3%'),
(328,28,4,'1%'),
(329,29,4,'2%'),
(330,30,4,'2%'),
(331,31,4,'1%'),
(332,32,4,'1%'),
(333,33,4,'2%'),
(334,34,4,'2%'),
(335,35,4,'0%'),
(336,36,4,'0%'),
(337,37,4,'1%'),
(338,38,4,'2%'),
(339,39,4,'3%'),
(340,40,4,'0%'),
(341,41,4,'3%'),
(342,42,4,'0%'),
(343,43,4,'1%'),
(344,44,4,'4%'),
(345,45,4,'4%'),
(346,46,4,'3%'),
(347,47,4,'3%'),
(348,48,4,'2%'),
(349,49,4,'5%'),
(350,50,4,'3%'),
(351,51,4,'4%'),
(352,52,4,'3%'),
(353,53,4,'0%'),
(354,54,4,'1%'),
(355,55,4,'1%'),
(356,56,4,'3%'),
(357,57,4,'1%'),
(358,58,4,'3%'),
(359,59,4,'1%'),
(360,60,4,'2%'),
(361,61,4,'1%'),
(362,62,4,'1%'),
(363,63,4,'1%'),
(364,64,4,'1%'),
(365,65,4,'3%'),
(366,66,4,'1%'),
(367,67,4,'0%'),
(368,68,4,'2%'),
(369,69,4,'4%'),
(370,70,4,'4%'),
(371,71,4,'2%'),
(372,72,4,'4%'),
(373,73,4,'1%'),
(374,74,4,'1%'),
(375,75,4,'1%'),
(376,76,4,'8%'),
(377,77,4,'2%'),
(378,78,4,'1%'),
(379,79,4,'4%'),
(380,80,4,'2%'),
(381,81,4,'1%'),
(382,82,4,'2%'),
(383,83,4,'0%'),
(384,84,4,'1%'),
(385,85,4,'3%'),
(386,86,4,'3%'),
(387,87,4,'0%'),
(388,88,4,'0%'),
(389,89,4,'1%'),
(390,90,4,'0%'),
(391,91,4,'3%'),
(392,92,4,'0%'),
(393,93,4,'0%'),
(394,94,4,'0%'),
(395,95,4,'0%'),
(396,96,4,'2%'),
(397,97,4,'3%'),
(398,98,4,'3%'),
(399,99,4,'0%'),
(400,100,4,'2%'),
(401,1,5,'1%'),
(402,2,5,'1%'),
(403,3,5,'42%'),
(404,4,5,'2%'),
(405,5,5,'2%'),
(406,6,5,'1%'),
(407,7,5,'1%'),
(408,8,5,'3%'),
(409,9,5,'1%'),
(410,10,5,'1%'),
(411,11,5,'3%'),
(412,12,5,'1%'),
(413,13,5,'5%'),
(414,14,5,'5%'),
(415,15,5,'35%'),
(416,16,5,'2%'),
(417,17,5,'5%'),
(418,18,5,'2%'),
(419,19,5,'5%'),
(420,20,5,'2%'),
(421,21,5,'0%'),
(422,22,5,'0%'),
(423,23,5,'1%'),
(424,24,5,'1%'),
(425,25,5,'0%'),
(426,26,5,'2%'),
(427,27,5,'3%'),
(428,28,5,'3%'),
(429,29,5,'1%'),
(430,30,5,'2%'),
(431,31,5,'1%'),
(432,32,5,'1%'),
(433,33,5,'1%'),
(434,34,5,'2%'),
(435,35,5,'2%'),
(436,36,5,'2%'),
(437,37,5,'1%'),
(438,38,5,'3%'),
(439,39,5,'3%'),
(440,40,5,'1%'),
(441,41,5,'1%'),
(442,42,5,'1%'),
(443,43,5,'1%'),
(444,44,5,'1%'),
(445,45,5,'1%'),
(446,46,5,'1%'),
(447,47,5,'1%'),
(448,48,5,'3%'),
(449,49,5,'1%'),
(450,50,5,'1%'),
(451,51,5,'3%'),
(452,52,5,'45%'),
(453,53,5,'1%'),
(454,54,5,'1%'),
(455,55,5,'1%'),
(456,56,5,'3%'),
(457,57,5,'1%'),
(458,58,5,'2%'),
(459,59,5,'2%'),
(460,60,5,'1%'),
(461,61,5,'1%'),
(462,62,5,'1%'),
(463,63,5,'1%'),
(464,64,5,'1%'),
(465,65,5,'2%'),
(466,66,5,'1%'),
(467,67,5,'1%'),
(468,68,5,'1%'),
(469,69,5,'4%'),
(470,70,5,'2%'),
(471,71,5,'1%'),
(472,72,5,'27%'),
(473,73,5,'1%'),
(474,74,5,'1%'),
(475,75,5,'1%'),
(476,76,5,'74%'),
(477,77,5,'1%'),
(478,78,5,'1%'),
(479,79,5,'2%'),
(480,80,5,'2%'),
(481,81,5,'2%'),
(482,82,5,'1%'),
(483,83,5,'0%'),
(484,84,5,'0%'),
(485,85,5,'1%'),
(486,86,5,'1%'),
(487,87,5,'0%'),
(488,88,5,'0%'),
(489,89,5,'1%'),
(490,90,5,'0%'),
(491,91,5,'1%'),
(492,92,5,'0%'),
(493,93,5,'1%'),
(494,94,5,'0%'),
(495,95,5,'1%'),
(496,96,5,'1%'),
(497,97,5,'2%'),
(498,98,5,'3%'),
(499,99,5,'2%'),
(500,100,5,'1%'),
(501,1,6,'24'),
(502,2,6,'78'),
(503,3,6,'42'),
(504,4,6,'73'),
(505,5,6,'52'),
(506,6,6,'66'),
(507,7,6,'75'),
(508,8,6,'22'),
(509,9,6,'28'),
(510,10,6,'23'),
(511,11,6,'25'),
(512,12,6,'21'),
(513,13,6,'25'),
(514,14,6,'50'),
(515,15,6,'16'),
(516,16,6,'48'),
(517,17,6,'48'),
(518,18,6,'48'),
(519,19,6,'71'),
(520,20,6,'28'),
(521,21,6,'50'),
(522,22,6,'50'),
(523,23,6,'70'),
(524,24,6,'30'),
(525,25,6,'77'),
(526,26,6,'58'),
(527,27,6,'58'),
(528,28,6,'50'),
(529,29,6,'50'),
(530,30,6,'50'),
(531,31,6,'50'),
(532,32,6,'25'),
(533,33,6,'68'),
(534,34,6,'63'),
(535,35,6,'25'),
(536,36,6,'50'),
(537,37,6,'36'),
(538,38,6,'57'),
(539,39,6,'23'),
(540,40,6,'19'),
(541,41,6,'77'),
(542,42,6,'73'),
(543,43,6,'23'),
(544,44,6,'41'),
(545,45,6,'21'),
(546,46,6,'31'),
(547,47,6,'40'),
(548,48,6,'22'),
(549,49,6,'19'),
(550,50,6,'30'),
(551,51,6,'23'),
(552,52,6,'14'),
(553,53,6,'56'),
(554,54,6,'71'),
(555,55,6,'73'),
(556,56,6,'61'),
(557,57,6,'20'),
(558,58,6,'71'),
(559,59,6,'71'),
(560,60,6,'32'),
(561,61,6,'28'),
(562,62,6,'40'),
(563,63,6,'31'),
(564,64,6,'74'),
(565,65,6,'19'),
(566,66,6,'23'),
(567,67,6,'50'),
(568,68,6,'90'),
(569,69,6,'52'),
(570,70,6,'30'),
(571,71,6,'55'),
(572,72,6,'32'),
(573,73,6,'76'),
(574,74,6,'56'),
(575,75,6,'20'),
(576,76,6,'20'),
(577,77,6,'68'),
(578,78,6,'76'),
(579,79,6,'20'),
(580,80,6,'30'),
(581,81,6,'58'),
(582,82,6,'30'),
(583,83,6,'80'),
(584,84,6,'76'),
(585,85,6,'76'),
(586,86,6,'78'),
(587,87,6,'104'),
(588,88,6,'15'),
(589,89,6,'50'),
(590,90,6,'50'),
(591,91,6,'67'),
(592,92,6,'60'),
(593,93,6,'34'),
(594,94,6,'35'),
(595,95,6,'28'),
(596,96,6,'80'),
(597,97,6,'67'),
(598,98,6,'67'),
(599,99,6,'43'),
(600,100,6,'23');
/*!40000 ALTER TABLE `kriteria_produk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nilai_awal_bobot_kriteria`
--

DROP TABLE IF EXISTS `nilai_awal_bobot_kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_awal_bobot_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai_bobot_kriteria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `nilai_awal_bobot_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilai_awal_bobot_kriteria`
--

LOCK TABLES `nilai_awal_bobot_kriteria` WRITE;
/*!40000 ALTER TABLE `nilai_awal_bobot_kriteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `nilai_awal_bobot_kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nilai_bobot_kriteria`
--

DROP TABLE IF EXISTS `nilai_bobot_kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_bobot_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) DEFAULT NULL,
  `batas_nilai_parameter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_bobot_kriteria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `nilai_bobot_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilai_bobot_kriteria`
--

LOCK TABLES `nilai_bobot_kriteria` WRITE;
/*!40000 ALTER TABLE `nilai_bobot_kriteria` DISABLE KEYS */;
INSERT INTO `nilai_bobot_kriteria` VALUES
(1,1,'0%-15%',1),
(2,1,'16%-30%',2),
(3,1,'31%-45%',3),
(4,1,'46%-60%',4),
(5,1,'>60%',5),
(6,2,'0-50',5),
(7,2,'51-100',4),
(8,2,'101-150',3),
(9,2,'151-200',2),
(10,2,'>200',1),
(11,3,'0%-5%',3),
(12,3,'6%-10%',2),
(13,3,'>10%',1),
(14,4,'0%-5%',3),
(15,4,'6%-10%',2),
(16,4,'>10%',1),
(17,5,'0%-5%',3),
(18,5,'6%-10%',2),
(19,5,'>10%',1),
(20,6,'1-15',1),
(21,6,'16-30',2),
(22,6,'31-45',3),
(23,6,'46-60',4),
(24,6,'>60',5);
/*!40000 ALTER TABLE `nilai_bobot_kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

LOCK TABLES `produk` WRITE;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES
(1,'ANS PERFORMANCE DIABLO',NULL),
(2,'ANS PERFORMANCE N-ISO',NULL),
(3,'ANS PERFORMANCE N-MASS',NULL),
(4,'ANS PERFORMANCE N-WHEY',NULL),
(5,'ANS PERFORMANCE N-PRO',NULL),
(6,'BLADE SPORTS WHEY ISOLATE 5LBS',NULL),
(7,'BLADE SPORTS WHEY PROTEIN CONCENTRATE 5LBS',NULL),
(8,'BODYLOGIX VEGAN PROTEIN 4LBS',NULL),
(9,'BPI BEST PROTEIN',NULL),
(10,'BPI ISO HD',NULL),
(11,'BPI VEGGIE PROTEIN',NULL),
(12,'BPI WHEY HD',NULL),
(13,'BSN SYNTHA 6 COLD STONE 2,5LBS',NULL),
(14,'BSN SYNTHA 6 COLD STONE 4,5LBS',NULL),
(15,'BSN SYNTHA 6 TRUE MASS',NULL),
(16,'BSN SYNTHA 6 WHEY ISOLATE 4LBS',NULL),
(17,'BSN SYNTHA 6 WHEY PROTEIN',NULL),
(18,'BSN SYNTHA 6 EDGE',NULL),
(19,'BXN NUTRITION XTREME BLEND',NULL),
(20,'BXN WHEY ISOLATE',NULL),
(21,'BXN WHEY PROTEIN 12LBS',NULL),
(22,'BXN WHEY PROTEIN 5LBS',NULL),
(23,'CELLUCOR WHEY PERFORMANCE',NULL),
(24,'DNI WHEY PROTEIN',NULL),
(25,'EVL 100% ISOLATE',NULL),
(26,'EVL NUTRITION STACKED WHEY PROTEIN',NULL),
(27,'EVL NUTRITION WHEY PROTEIN',NULL),
(28,'EVOLENE ISOLENE 3,6LBS',NULL),
(29,'EVOLENE WHEY PROTEIN 4,2 LBS',NULL),
(30,'FITLIFE WPRO CONCENTRATE',NULL),
(31,'FITLIFE WPRO ISOLATE',NULL),
(32,'MP COMBAT PROTEIN POWDER',NULL),
(33,'MP COMBAT 100% WHEY',NULL),
(34,'MP STEALTH SERIES',NULL),
(35,'MUSCLE FIRST GOLD ISOLATE 2LBS',NULL),
(36,'MUSCLE FIRST GOLD ISOLATE 5LBS',NULL),
(37,'MUSCLE TECH CASEIN GOLD',NULL),
(38,'MUSCLE TECH ELITE 100% ISOLATE',NULL),
(39,'MUSCLE TECH GRASS FED 100% WHEY PROTEIN',NULL),
(40,'MUSCLE TECH ISO CLEAR',NULL),
(41,'MUSCLE TECH 100% WHEY GOLD',NULL),
(42,'MUSCLE TECH ISO ZERO',NULL),
(43,'MUSCLE TECH NITRO TECH ELITE',NULL),
(44,'MUSCLE TECH NITRO TECH PERFORMANCE',NULL),
(45,'MUSCLE TECH NITRO TECH RIPPED',NULL),
(46,'MUSCLE TECH NITRO TECH WHEY AOM',NULL),
(47,'MUSCLE TECH NITRO TECH WHEY GOLD',NULL),
(48,'MUSCLE TECH PHASE8 PROTEIN',NULL),
(49,'MUSCLE TECH POWER',NULL),
(50,'MUSCLE TECH PREMIUM WHEY',NULL),
(51,'MUSCLE TECH PURE SERIES 100% WHEY PROTEIN',NULL),
(52,'MUSCLEMEDS CARNIVOR MASS',NULL),
(53,'MUSCLEMEDS CARNIVOR WHEY BEEF PROTEIN',NULL),
(54,'MUTANT ISO SURGE 5LBS',NULL),
(55,'MUTANT PRO PROTEIN 5LBS',NULL),
(56,'MUTANT WHEY PROTEIN 5LBS',NULL),
(57,'NUTRABOLIC HYDRO PURE',NULL),
(58,'NUTRABOLIC HYPER WHEY',NULL),
(59,'NUTRABOLIC ISOBOLIC',NULL),
(60,'NUTREX ISO FIT 2LBS',NULL),
(61,'ON GOLD STANDARD CASEIN WHEY',NULL),
(62,'ON PLATINUM HYDROWHEY 3,5LBS',NULL),
(63,'ON WHEY GOLD ISOLATE STANDARD',NULL),
(64,'ON WHEY GOLD STANDARD',NULL),
(65,'ON WHEY GOLD STANDARD PLANT BASED',NULL),
(66,'PROSUPPS WHEY ISOLATE 1,63LBS',NULL),
(67,'RC ISO TROPIC MAX',NULL),
(68,'RC KING WHEY PROTEIN 10LBS',NULL),
(69,'RC PRO ANTIUM',NULL),
(70,'RSP WHEY PROTEIN',NULL),
(71,'RULE 1 CASEIN',NULL),
(72,'RULE 1 GAIN',NULL),
(73,'RULE 1 NATURALY FLAVORED',NULL),
(74,'RULE 1 PRO6',NULL),
(75,'RULE 1 PROTEIN HC',NULL),
(76,'RULE 1 LBS',NULL),
(77,'RULE 1 WHEY BLEND',NULL),
(78,'RULE 1 WHEY PROTEIN 5LBS',NULL),
(79,'RULE 1 WHEY PLANT PROTEIN',NULL),
(80,'SCITEC 100% BEEF CONCENTRATE',NULL),
(81,'SCITEC NUTRITION 100% HYDROLYZED WHEY PROTEIN',NULL),
(82,'SCITEC NUTRITION 100% PLANT PROTEIN',NULL),
(83,'SCITEC NUTRITION 100% WHEY ISOLATE',NULL),
(84,'SCITEC NUTRITION 100% WHEY PROTEIN PROFESSIONAL + ISO',NULL),
(85,'SCITEC NUTRITION ANABOLIC WHEY',NULL),
(86,'SCITEC NUTRITION WHEY PROFESSIONAL',NULL),
(87,'SCITEC NUTRITION ZERO SUGAR',NULL),
(88,'SCITEC NUTRITION PURE FORM VEGAN PROTEIN',NULL),
(89,'THE PROTEIN WORKS WHEY CONCENTRATE 4LBS',NULL),
(90,'THE PROTEIN WORKS WHEY ISOLATE',NULL),
(91,'ULTIMATE NUTRITION 100% RAW',NULL),
(92,'ULTIMATE NUTRITION CARNEBOLIC',NULL),
(93,'ULTIMATE NUTRITION HYDROCOOL',NULL),
(94,'ULTIMATE NUTRITION ISO COOL',NULL),
(95,'ULTIMATE NUTRITION ISO SENSATION',NULL),
(96,'ULTIMATE NUTRITION PROSTAR WHEY',NULL),
(97,'ULTIMATE NUTRITION SYNTHO GOLD',NULL),
(98,'ULTIMATE NUTRITION WHEY GOLD',NULL),
(99,'VECTOR LABS MASTER WHEY 11LBS',NULL),
(100,'XTEND PRO ISOLATE',NULL);
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES
(1,'admin'),
(2,'user');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_list`
--

DROP TABLE IF EXISTS `temp_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `temp_list_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=544 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_list`
--

LOCK TABLES `temp_list` WRITE;
/*!40000 ALTER TABLE `temp_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'admin','admin','ee11cbb19052e40b07aac0ca060c23ee',1),
(2,'novant','novant','202cb962ac59075b964b07152d234b70',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_rank`
--

DROP TABLE IF EXISTS `user_rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_peranking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter_ranking` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_ranking` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eksekusi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_rank`
--

LOCK TABLES `user_rank` WRITE;
/*!40000 ALTER TABLE `user_rank` DISABLE KEYS */;
INSERT INTO `user_rank` VALUES
(1,'bejo','[{\"PROTEIN\":\"20\"},{\"KALORI\":\"21\"},{\"SUGAR\":\"23\"},{\"FAT\":\"10\"},{\"KARBOHIDRAT\":\"20\"},{\"JUMLAH SAJIAN\":\"20\"},{\"Harga\":\"10\"}]','[{\"v_vektor_id\":\"V2\",\"nama_produk\":\"ANS PERFORMANCE N-ISO\",\"vektor_s\":0.841608078702944,\"vektor_v\":0.3722848285616607},{\"v_vektor_id\":\"V10\",\"nama_produk\":\"BPI ISO HD\",\"vektor_s\":0.725982284807156,\"vektor_v\":0.32113782801938945},{\"v_vektor_id\":\"V1\",\"nama_produk\":\"ANS PERFORMANCE DIABLO\",\"vektor_s\":0.6930660321709565,\"vektor_v\":0.30657734341894977},{\"v_vektor_id\":null,\"nama_produk\":null,\"vektor_s\":null,\"vektor_v\":null},{\"v_vektor_id\":null,\"nama_produk\":null,\"vektor_s\":null,\"vektor_v\":null}]',0);
/*!40000 ALTER TABLE `user_rank` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-16  6:13:44
