-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 24 Avril 2022 à 21:37
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `betterland`
--

-- --------------------------------------------------------

--
-- Structure de la table `cat`
--

CREATE TABLE `cat` (
  `ROW_IDT` int(11) NOT NULL,
  `NAM` varchar(30) NOT NULL,
  `ROW_IDT_PRY_CAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cat`
--

INSERT INTO `cat` (`ROW_IDT`, `NAM`, `ROW_IDT_PRY_CAT`) VALUES
(1, 'cahiers', 1),
(2, 'fiches_cartonnees', 1),
(3, 'feuilles_blanches', 1),
(4, 'enveloppes', 1),
(5, 'imprimantes', 2),
(6, 'cartouches', 2),
(7, 'scanners', 2),
(8, 'tablettes', 2),
(9, 'trousses', 3),
(10, 'effaceurs', 3),
(11, 'surligneurs', 3),
(12, 'stylos', 3),
(13, 'crayons_couleur', 3),
(14, 'gommes', 3),
(15, 'feutres', 3);

-- --------------------------------------------------------

--
-- Structure de la table `crt`
--

CREATE TABLE `crt` (
  `ROW_IDT` int(11) NOT NULL,
  `DAT` datetime DEFAULT NULL,
  `ROW_IDT_USR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `crt`
--

INSERT INTO `crt` (`ROW_IDT`, `DAT`, `ROW_IDT_USR`) VALUES
(1, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `crt_pdt_lnk`
--

CREATE TABLE `crt_pdt_lnk` (
  `QTY` int(11) NOT NULL,
  `CRT_ROW_IDT` int(11) NOT NULL,
  `PDT_ROW_IDT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pdt`
--

CREATE TABLE `pdt` (
  `ROW_IDT` int(11) NOT NULL,
  `PCE` decimal(10,2) NOT NULL,
  `IMG` text NOT NULL,
  `DSC` text NOT NULL,
  `NAM` varchar(100) NOT NULL,
  `ROW_IDT_CAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pdt`
--

INSERT INTO `pdt` (`ROW_IDT`, `PCE`, `IMG`, `DSC`, `NAM`, `ROW_IDT_CAT`) VALUES
(1, '23.90', '/static/img/products/1.jpg', 'Jet\'Up Bureau Vallée - Papier blanc - A4 (210 x 297 mm) - 80 g/m² - 2500 feuilles (carton de 5 ramettes)', 'Jet\'Up Bureau Vallée - Papier blanc - A4 (210 x 297 mm) - 80 g/m² - 2500 feuilles', 3),
(2, '4.99', '/static/img/products/2.jpg', 'Jet\'up Bureau Vallée - Papier blanc - A4 (210 x 297 mm) - 80g/m² - 500 feuilles', 'Angle droit - Papier Blanc', 3),
(3, '5.99', '/static/img/products/3.jpg', 'Clairefontaine CLAIRALFA - Papier ultra blanc - A4 (210 x 297 mm) - 80 g/m² - 500 feuilles', 'Angle gauche - Papier Blanc', 3),
(4, '25.90', '/static/img/products/4.jpg', 'Clairefontaine CLAIRALFA - Papier ultra blanc - A4 (210 x 297 mm) - 80 g/m² - 2500 feuilles (carton de 5 ramettes)', 'Clairefontaine CLAIRALFA - Papier ultra blanc - A4 (210 x 297 mm) - 80 g/m² - 2500 feuilles', 3),
(5, '19.90', '/static/img/products/5.jpg', 'Papier blanc - A4 (210 x 297 mm) - 80 g/m² - 2500 feuilles (carton de 5 ramettes)', 'Papier blanc - A4 (210 x 297 mm) - 80 g/m² - 2500 feuilles (carton de 5 ramettes)', 3),
(6, '5.49', '/static/img/products/6.jpg', 'Navigator Universal - Papier blanc - A4 (210 x 297 mm) - 80 g/m² - 500 feuilles', 'Navigator Universal - Papier blanc - A4 (210 x 297 mm) - 80 g/m² - 500 feuilles', 3),
(7, '24.90', '/static/img/products/7.jpg', 'Navigator Universal - Papier blanc - A4 (210 x 297 mm) - 80 g/m² - 2500 feuilles (carton de 5 ramettes)', 'Navigator Universal - Papier blanc - A4 (210 x 297 mm) - 80 g/m² - 2500 feuilles', 3),
(8, '14.90', '/static/img/products/8.jpg', 'Clairefontaine CLAIRALFA - Papier blanc - A3 (297 x 420 mm) - 80 g/m² - 500 feuilles', 'Clairefontaine CLAIRALFA - Papier blanc - A3 (297 x 420 mm) - 80 g/m² - 500 feuilles', 3),
(9, '8.95', '/static/img/products/10.jpg', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 160 g/m² - 250 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 160 g/m² - 250 feuilles', 3),
(10, '6.99', '/static/img/products/11.jpg', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 120 g/m² - 250 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 120 g/m² - 250 feuilles', 3),
(11, '7.99', '/static/img/products/12.jpg', 'Clairefontaine - Papier blanc - A4 (210 x 297 mm) - 90 g/m² - 500 feuilles', 'Clairefontaine - Papier blanc - A4 (210 x 297 mm) - 90 g/m² - 500 feuilles', 3),
(12, '9.89', '/static/img/products/13.jpg', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 100 g/m² - 500 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 100 g/m² - 500 feuilles', 3),
(13, '6.95', '/static/img/products/14.jpg', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 250 g/m² - 125 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 250 g/m² - 125 feuilles', 3),
(14, '8.99', '/static/img/products/15.jpg', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 90 g/m² - 500 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 90 g/m² - 500 feuilles', 3),
(15, '10.39', '/static/img/products/16.jpg', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 200 g/m² - 250 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A4 (210 x 297 mm) - 200 g/m² - 250 feuilles', 3),
(16, '4.99', '/static/img/products/17.jpg', 'Clairefontaine Smart Print Paper - Papier ultra blanc - A4 (210 x 297 mm) - 60 g/m² - 500 feuilles', 'Clairefontaine Smart Print Paper - Papier ultra blanc - A4 (210 x 297 mm) - 60 g/m² - 500 feuilles', 3),
(17, '4.50', '/static/img/products/18.jpg', 'Clairefontaine - Papier ultra blanc - A5 (148 x 210 mm) - 80 g/m² - 500 feuilles', 'Clairefontaine - Papier ultra blanc - A5 (148 x 210 mm) - 80 g/m² -  500 feuilles', 3),
(18, '34.90', '/static/img/products/19.jpg', 'Clairefontaine - Papier blanc - A4 (210 x 297 mm) - 90 g/m² - 2500 feuilles (carton de 5 ramettes)', 'Clairefontaine - Papier blanc - A4 (210 x 297 mm) - 90 g/m² - 2500 feuilles (carton de 5 ramettes)', 3),
(19, '19.99', '/static/img/products/20.jpg', 'Clairefontaine DCP - Papier ultra blanc - A3 (297 x 420 mm) - 160 g/m² - 250 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A3 (297 x 420 mm) - 160 g/m² - 250 feuilles', 3),
(20, '59.90', '/static/img/products/21.jpg', 'Clairefontaine CLAIRALFA - Papier blanc - A3 (297 x 420 mm) - 80 g/m² - 2500 feuilles (carton de 5 ramettes)', 'Clairefontaine CLAIRALFA - Papier blanc - A3 (297 x 420 mm) - 80 g/m² - 2500 feuilles', 3),
(21, '14.99', '/static/img/products/22.jpg', 'Clairefontaine DCP - Papier ultra blanc - A3 (297 x 420 mm) - 120 g/m² - 250 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A3 (297 x 420 mm) - 120 g/m² - 250 feuilles', 3),
(22, '11.50', '/static/img/products/23.jpg', 'Paperbox - Papier ordinaire blanc - A3 (297 x 420 mm) - 80 g/m² - 500 feuilles', 'Paperbox - Papier ordinaire blanc - A3 (297 x 420 mm) - 80 g/m² - 500 feuilles', 3),
(23, '6.90', '/static/img/products/24.jpg', 'Clairefontaine CLAIRALFA - Papier blanc perforé 4 trous - A4 (210 x 297 mm) - 80 g/m² - 500 feuilles', 'Clairefontaine CLAIRALFA - Papier blanc perforé 4 trous - A4 (210 x 297 mm) - 80 g/m² - 500 feuilles', 3),
(24, '5.10', '/static/img/products/25.jpg', 'Clairefontaine Smart Print Paper - Papier ultra blanc - A4 (210 x 297 mm) - 70 g/m² - 500 feuilles', 'Clairefontaine Smart Print Paper - Papier ultra blanc - A4 (210x297 mm) - 70 g/m² - 500 feuilles', 3),
(25, '16.60', '/static/img/products/26.jpg', 'Clairefontaine DCP - Papier ultra blanc - A3 (297 x 420 mm) - 200 g/m² - 250 feuilles', 'Clairefontaine DCP - Papier ultra blanc - A3 (297 x 420 mm) - 200 g/m² - 250 feuilles', 3),
(26, '3.09', '/static/img/products/27.jpg', 'Clairefontaine - Cahier à spirale 17 x 22 cm - 100 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Avant', 1),
(27, '3.69', '/static/img/products/28.jpg', 'Clairefontaine - Cahier à spirale A4 (21x29,7 cm) - 100 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Clairefontaine - Cahier à spirale A4 (21x29,7 cm) - 100 pages - petits carreaux (5x5 mm)', 1),
(28, '3.61', '/static/img/products/29.jpg', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 96 pages - grands carreaux (Seyes) - violet', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 96 pages - grands carreaux (Seyes) - violet', 1),
(29, '4.09', '/static/img/products/30.jpg', 'Clairefontaine - Cahier à spirale 17 x 22 cm - 180 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Avant - Cahier 2', 1),
(30, '3.09', '/static/img/products/31.jpg', 'Clairefontaine - Cahier à spirale 17 x 22 cm - 100 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Clairefontaine - Cahier à spirale 17 x 22 cm - 100 pages - grands carreaux (Seyes)', 1),
(31, '4.09', '/static/img/products/32.jpg', 'Clairefontaine - Cahier à spirale 17 x22 cm - 180 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Avant - Cahier 3', 1),
(32, '4.49', '/static/img/products/33.jpg', 'Clairefontaine - Cahier à spirale A4 (21x29,7 cm) - 180 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Avant - Cahier 4', 1),
(33, '4.49', '/static/img/products/34.jpg', 'Clairefontaine - Cahier à spirale A4 (21x29,7 cm) - 180 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Avant - Cahier 5', 1),
(34, '3.69', '/static/img/products/35.jpg', 'Clairefontaine - Cahier à spirale A4 (21x29,7 cm) - 100 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Avant - Cahier 6', 1),
(35, '3.70', '/static/img/products/36.jpg', 'Calligraphe 8000 - Cahier 24 x 32 cm - 48 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Calligraphe 8000 - Cahier 24 x 32 cm - 48 pages - grands carreaux (Seyes)', 1),
(36, '4.39', '/static/img/products/37.jpg', 'Clairefontaine Koverbook - Cahier polypro 24 x 32 cm - 48 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Avant - Cahier 7', 1),
(37, '1.85', '/static/img/products/38.jpg', 'Clairefontaine - Cahier 17 x 22 cm - 96 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Avant - Cahier 8', 1),
(38, '1.29', '/static/img/products/39.jpg', 'Clairefontaine - Cahier 17 x 22 cm - 48 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Avant - Cahier 9', 1),
(39, '3.99', '/static/img/products/40.jpg', 'Oxford Openflex - Cahier polypro 24 x 32 cm - 96 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Avant  - Cahier 10', 1),
(40, '5.19', '/static/img/products/41.jpg', 'Clairefontaine - Cahier à spirale 24 x 32 cm - 100 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Clairefontaine - Cahier à spirale 24 x 32 cm - 100 pages - petits carreaux (5x5 mm)', 1),
(41, '4.99', '/static/img/products/42.jpg', 'Clairefontaine Koverbook - Cahier polypro 24 x 32 cm - 96 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Angle gauche', 1),
(42, '2.19', '/static/img/products/43.jpg', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 96 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 96 pages - petits carreaux (5x5 mm)', 1),
(43, '0.95', '/static/img/products/44.jpg', 'Calligraphe 8000 - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - violet', 'Calligraphe 8000 - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - violet', 1),
(44, '2.99', '/static/img/products/45.jpg', 'Clairefontaine Koverbook - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Clairefontaine Koverbook - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes)', 1),
(45, '1.85', '/static/img/products/46.jpg', 'Clairefontaine - Cahier 17 x 22 cm - 96 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Avant - Cahier 11', 1),
(46, '2.19', '/static/img/products/47.jpg', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 96 pages - grands carreaux (Seyes) - transparent', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 96 pages - grands carreaux (Seyes) - transparent', 1),
(47, '4.39', '/static/img/products/48.jpg', 'Clairefontaine Koverbook - Cahier polypro A4 (21x29,7 cm) - 96 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Clairefontaine Koverbook - Cahier polypro A4 (21x29,7 cm) - 96 pages - grands carreaux (Seyes)', 1),
(48, '1.30', '/static/img/products/49.jpg', 'Clairefontaine Mimesys - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Avant - Cahier 12', 1),
(49, '2.19', '/static/img/products/50.jpg', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 96 pages - grands carreaux (Seyes) - gris', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 96 pages - grands carreaux (Seyes) - gris', 1),
(50, '2.49', '/static/img/products/51.jpg', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 140 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Calligraphe 8000 - Cahier polypro 24 x 32 cm - 140 pages - grands carreaux (Seyes)', 1),
(51, '0.95', '/static/img/products/52.jpg', 'Calligraphe 8000 - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - jaune', 'Calligraphe 8000 - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - jaune', 1),
(52, '0.95', '/static/img/products/53.jpg', 'Calligraphe 8000 - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - orange', 'Calligraphe 8000 - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - orange', 1),
(53, '3.99', '/static/img/products/54.jpg', 'Oxford Openflex - Cahier polypro 24 x 32 cm - 96 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Avant - Cahier 0', 1),
(54, '2.69', '/static/img/products/55.jpg', 'Clairefontaine Mimesys - Cahier polypro 24 x 32 cm - 96 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Clairefontaine Mimesys - Cahier polypro 24 x 32 cm - 96 pages - petits carreaux (5x5 mm)', 1),
(55, '8.49', '/static/img/products/56.jpg', 'Clairefontaine - Cahier à spirale 24 x 32 cm - 180 pages - petits carreaux (5x5 mm) - disponible dans différentes couleurs', 'Avant - Cahier 13', 1),
(56, '1.00', '/static/img/products/57.jpg', 'Clairefontaine Mimesys - Cahier polypro 17 x 22 cm - 48 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Clairefontaine Mimesys - Cahier polypro 17 x 22 cm - 48 pages - grands carreaux (Seyes)', 1),
(57, '1.79', '/static/img/products/58.jpg', 'Oxford Openflex - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes) - disponible dans différentes couleurs', 'Oxford Openflex - Cahier polypro 17 x 22 cm - 96 pages - grands carreaux (Seyes)', 1),
(58, '59.90', '/static/img/products/59.jpg', 'Canon PIXMA TS3450 - imprimante multifonctions jet d\'encre couleur A4 - Wifi, USB - recto-verso manuel', 'Canon PIXMA TS3450 - imprimante multifonctions jet d\'encre couleur A4 - Wifi, USB - recto-verso', 5),
(59, '59.90', '/static/img/products/60.jpg', 'HP Deskjet 2710 All-in-One - imprimante multifonctions jet d\'encre couleur A4 - Wifi, Bluetooth, USB', 'HP Deskjet 2710 All-in-One - imprimante multifonctions jet d\'encre couleur A4 - Wifi, Bluetooth, USB', 5),
(60, '209.90', '/static/img/products/61.jpg', 'Brother MFC-J5330DW - imprimante multifonctions jet d\'encre couleur A3 - Wifi, USB - recto-verso', 'Brother MFC-J5330DW - imprimante multifonctions jet d\'encre couleur A3 - Wifi, USB - recto-verso', 5),
(61, '629.90', '/static/img/products/62.jpg', 'Brother MFC-L8690CDW - imprimante laser multifonction couleur A4 - recto-verso - Wifi', 'Brother MFC-L8690CDW - imprimante laser multifonction couleur A4 - recto-verso - Wifi', 5),
(62, '479.90', '/static/img/products/63.jpg', 'Brother DCP-L3550CDW - imprimante laser multifonction couleur A4 - recto-verso - Wifi', 'Brother DCP-L3550CDW - imprimante laser multifonction couleur A4 - recto-verso - Wifi', 5),
(63, '589.90', '/static/img/products/64.jpg', 'Brother MFC-L3770CDW - imprimante laser multifonction couleur A4 - recto-verso - Wifi', 'Brother MFC-L3770CDW - imprimante laser multifonction couleur A4 - recto-verso - Wifi', 5),
(64, '189.90', '/static/img/products/65.jpg', 'HP Laser MFP 135w - imprimante multifonctions monochrome A4 - Wifi', 'HP Laser MFP 135w - imprimante multifonctions monochrome A4 - Wifi', 5),
(65, '319.90', '/static/img/products/66.jpg', 'Epson EcoTank ET-2851 - imprimante multifonctions jet d\'encre couleur A4 - Wifi - recto-verso', 'Epson EcoTank ET-2851 - imprimante multifonctions jet d\'encre couleur A4 - Wifi - recto-verso', 5),
(66, '199.90', '/static/img/products/67.jpg', 'HP Envy Inspire 7920e All-in-One - imprimante multifonctions jet d\'encre couleur A4 - Wifi', 'HP Envy Inspire 7920e All-in-One - imprimante multifonctions jet d\'encre couleur A4 - Wifi ', 5),
(67, '89.90', '/static/img/products/68.jpg', 'HP Envy 6030 All-In-One - imprimante multifonctions jet d\'encre couleur A4 - Wifi', 'HP Envy 6030 All-In-One - imprimante multifonctions jet d\'encre couleur A4 - Wifi', 5),
(68, '22.90', '/static/img/products/69.jpg', 'Armor Kimya - filament 3D PLA-R - blanc - Ø 1,75 mm - 750g', 'Armor Kimya  - filament 3D PLA-R - blanc - Ø 1,75 mm - 750g', 5),
(69, '22.90', '/static/img/products/70.jpg', 'Armor Kimya - filament 3D PLA-R - noir - Ø 1,75 mm - 750g', 'Armor Kimya  - filament 3D PLA-R - noir - Ø 1,75 mm - 750g', 5),
(70, '119.90', '/static/img/products/71.jpg', 'HP ENVY Pro 6430 All-in-One - imprimante multifonctions jet d\'encre couleur A4 - wifi', 'HP ENVY Pro 6430 All-in-One - imprimante multifonctions jet d\'encre couleur A4 - wifi', 5),
(71, '129.90', '/static/img/products/72.jpg', 'Brother HL-L2350DW - imprimante laser monochrome A4 - recto-verso - Wifi', 'Brother HL-L2350DW - imprimante laser monochrome A4 - recto-verso - Wifi', 5),
(72, '79.90', '/static/img/products/73.jpg', 'HP DeskJet 3762 All-in-One - imprimante multifonctions jet d\'encre couleur A4 - Wifi - recto-verso manuel', 'HP DeskJet 3762 All-in-One - imprimante multifonctions jet d\'encre couleur A4 - Wifi - recto-verso', 5),
(73, '22.90', '/static/img/products/74.jpg', 'OWA - filament 3D PLA-S - gris - Ø 1,75 mm - 750g', 'OWA - filament 3D PLA-S - gris - Ø 1,75 mm - 750g', 5),
(74, '22.90', '/static/img/products/75.jpg', 'OWA - filament 3D PLA-S - noir - Ø 1,75 mm - 750g', 'OWA - filament 3D PLA-S - noir - Ø 1,75 mm - 750g', 5),
(75, '22.90', '/static/img/products/76.jpg', 'Armor Kimya - filament 3D PLA-R - rouge - Ø 1,75 mm - 750g', 'Armor Kimya  - filament 3D PLA-R - rouge - Ø 1,75 mm - 750g', 5),
(76, '159.90', '/static/img/products/77.jpg', 'HP LaserJet M110we - imprimante laser monochrome A4', 'HP LaserJet M110we - imprimante laser monochrome A4', 5),
(77, '22.90', '/static/img/products/78.jpg', 'Armor Kimya - filament 3D PLA-R - bleu - Ø 1,75 mm - 750g', 'Armor Kimya  - filament 3D PLA-R - bleu - Ø 1,75 mm - 750g', 5),
(78, '22.90', '/static/img/products/79.jpg', 'OWA - filament 3D PLA-S - blanc - Ø 1,75 mm - 750g', 'OWA - filament 3D PLA-S - blanc - Ø 1,75 mm - 750g', 5),
(79, '289.90', '/static/img/products/80.jpg', 'Canon PIXMA G3560 - imprimante multifonctions jet d\'encre couleur A4 - Wifi, USB', 'Canon PIXMA G3560 - imprimante multifonctions jet d\'encre couleur A4 - Wifi, USB', 5),
(80, '22.90', '/static/img/products/81.jpg', 'Armor Kimya - filament 3D PLA-R - gris - Ø 1,75 mm - 750g', 'Armor Kimya  - filament 3D PLA-R - gris - Ø 1,75 mm - 750g', 5),
(81, '189.00', '/static/img/products/82.jpg', 'Bac d\'alimentation supplémentaire de 520 feuilles pour Brother LT6500', 'Bac d\'alimentation supplémentaire de 520 feuilles pour Brother LT6500', 5),
(82, '22.90', '/static/img/products/83.jpg', 'Armor Kimya - filament 3D PLA-R - blanc cassé - Ø 1,75 mm - 750g', 'Armor Kimya - filament 3D PLA-R - blanc cassé - Ø 1,75 mm - 750g', 5),
(83, '149.90', '/static/img/products/84.jpg', 'Brother VC-500WCR - imprimante d\'étiquettes - couleur - thermique directe', 'Brother VC-500WCR - imprimante d\'étiquettes - couleur - thermique directe', 5),
(84, '19.90', '/static/img/products/85.jpg', 'OWA - Filament 3D PS - noir - Ø 1,75 mm - 250g', 'OWA - Filament 3D PS - noir - Ø 1,75 mm - 250g', 5),
(85, '166.90', '/static/img/products/86.jpg', 'Bac d\'alimentation supplémentaire de 250 feuilles pour Brother LT330CL', 'Bac d\'alimentation supplémentaire de 250 feuilles pour Brother LT330CL', 5),
(86, '179.00', '/static/img/products/87.jpg', 'Bac d\'alimentation supplémentaire de 520 feuilles pour Brother LT6505', 'Bac d\'alimentation supplémentaire de 520 feuilles pour Brother LT6505', 5),
(87, '359.90', '/static/img/products/88.jpg', 'Brother DCP-L3510CDW - imprimante laser multifonction couleur A4 - recto-verso - Wifi', 'Brother DCP-L3510CDW - imprimante laser multifonction couleur A4 - recto-verso - Wifi', 5),
(88, '799.90', '/static/img/products/89.jpg', 'Meuble support bas pour Epson WF-C8000', 'Meuble support bas pour Epson WF-C8000', 5),
(89, '369.90', '/static/img/products/90.jpg', 'Bac d\'alimentation supplémentaire de 500 feuilles pour Epson WF-C8000', 'Bac d\'alimentation supplémentaire de 500 feuilles pour Epson WF-C8000', 5),
(90, '1.99', '/static/img/products/91.jpg', 'BIC 4 Couleurs Original - Stylo à bille 4 couleurs', 'BIC 4 Couleurs Original', 12),
(91, '0.39', '/static/img/products/92.jpg', 'BIC Cristal - Stylo à bille - noir - 1 mm - pointe moyenne', 'BIC Cristal - Stylo à bille - noir - 1 mm - pointe moyenne', 12),
(92, '0.39', '/static/img/products/93.jpg', 'BIC Cristal - Stylo à bille - bleu - 1 mm - pointe moyenne', 'BIC Cristal - Stylo à bille - bleu - 1 mm - pointe moyenne', 12),
(93, '2.39', '/static/img/products/94.jpg', 'Pilot Frixion Ball - Roller effaçable - 0,7 mm - bleu', 'Pilot Frixion Ball - Roller effaçable - 0,7 mm - bleu', 12),
(94, '4.65', '/static/img/products/95.jpg', 'Pilot Frixion Ball - 3 Recharges pour rollers effaçables - 0,7 mm - bleu', 'Pilot Frixion Ball - 3 Recharges pour rollers effaçables - 0,7 mm - bleu', 12),
(95, '1.29', '/static/img/products/96.jpg', 'Paper Mate Flair Original - Feutre fin - pointe moyenne - bleu', 'Paper Mate Flair Original - Feutre fin - pointe moyenne - bleu', 12),
(96, '0.39', '/static/img/products/97.jpg', 'BIC Cristal - Stylo à bille - rouge - 1 mm - pointe moyenne', 'BIC Cristal - Stylo à bille - rouge - 1 mm - pointe moyenne', 12),
(97, '2.89', '/static/img/products/98.jpg', 'Pilot Frixion Ball Clicker - Roller effaçable - 0,7 mm - bleu', 'Pilot Frixion Ball Clicker - Roller effaçable - 0,7 mm - bleu', 12),
(98, '8.39', '/static/img/products/99.jpg', 'Pilot Frixion Ball - 6 Recharges pour rollers effaçables - 0,7 mm - bleu', 'Pilot Frixion Ball - 6 Recharges pour rollers effaçables - 0,7 mm - bleu', 12),
(99, '1.29', '/static/img/products/100.jpg', 'Paper Mate Flair Original - Feutre fin - pointe moyenne - rouge', 'Paper Mate Flair Original - Feutre fin - pointe moyenne - rouge', 12),
(100, '3.49', '/static/img/products/101.jpg', 'BIC 4 Couleurs - Stylo à bille 3 couleurs + 1 crayon HB avec gomme', 'Angle gauche - Bic 4 Couleur', 12),
(101, '2.39', '/static/img/products/102.jpg', 'Pilot Frixion Ball - Roller effaçable - 0,7 mm - noir', 'Pilot Frixion Ball - Roller effaçable - 0,7 mm - noir', 12),
(102, '1.99', '/static/img/products/103.jpg', 'BIC 4 Couleurs Original Fine - Stylo à bille 4 couleurs', 'BIC 4 Couleurs Original Fine - Stylo à bille 4 couleurs', 12),
(103, '2.89', '/static/img/products/104.jpg', 'Pilot V Sign Pen - Feutre fin - noir', 'Pilot V Sign Pen - Feutre fin - noir', 12),
(104, '2.89', '/static/img/products/105.jpg', 'Paper Mate FlexGrip ultra - Stylo à bille - noir - 1 mm - rétractable', 'Paper Mate FlexGrip ultra - Stylo à bille - noir - 1 mm - rétractable', 12),
(105, '2.09', '/static/img/products/106.jpg', 'Pilot G-2 - Roller encre gel rétractable - 0,7 mm - noir', 'Pilot G-2 - Roller encre gel rétractable - 0,7 mm - noir', 12),
(106, '0.79', '/static/img/products/107.jpg', 'Wonday - 12 Crayons de couleur - pointe moyenne', 'Wonday - 12 Crayons de couleur - pointe moyenne', 13),
(107, '1.99', '/static/img/products/108.jpg', 'BIC Kids Tropicolors 2 - 12 Crayons de couleur', 'BIC Kids Tropicolors 2 - 12 Crayons de couleur', 13),
(108, '1.79', '/static/img/products/109.jpg', 'Wonday - 18 Crayons de couleur', 'Wonday - 18 Crayons de couleur', 13),
(109, '3.69', '/static/img/products/110.jpg', 'BIC Kids Aquacouleur - 12 Crayons de couleur aquarellables', 'BIC Kids Aquacouleur - 12 Crayons de couleur aquarellables', 13),
(110, '3.99', '/static/img/products/111.jpg', 'Maped Color\'Peps Pastel - 12 Crayons de couleur - couleurs pastels assorties', 'Maped Color\'Peps Pastel - 12 Crayons de couleur - couleurs pastels assorties', 13),
(111, '2.09', '/static/img/products/112.jpg', 'STABILO Woody 3 in 1 - Crayon de couleur pointe large - rouge', 'STABILO Woody 3 in 1 - Crayon de couleur pointe large - rouge', 13),
(112, '4.85', '/static/img/products/113.jpg', 'Maped Color\'Peps Jumbo - 12 Crayons de couleur triangulaires- certifiés FSC', 'Maped Color\'Peps Jumbo - 12 Crayons de couleur triangulaires- certifiés FSC', 13),
(113, '4.85', '/static/img/products/114.jpg', 'STABILO Color - 18 Crayons de couleur', 'STABILO Color - 18 Crayons de couleur', 13),
(114, '1.29', '/static/img/products/115.jpg', 'STABILO Pen 68 - Feutre pointe moyenne - noir', 'STABILO Pen 68 - Feutre pointe moyenne - noir', 15),
(115, '2.79', '/static/img/products/116.jpg', 'BIC Kids Visa - 18 Feutres format spécial', 'BIC Kids Visa - 18 Feutres format spécial', 15),
(116, '1.49', '/static/img/products/117.jpg', 'Wonday - 12 Feutres - pointe fine', 'Wonday - 12 Feutres - pointe fine', 15),
(117, '1.00', '/static/img/products/118.jpg', 'STABILO Pen 68 - Feutre pointe moyenne - carmin', 'STABILO Pen 68 - Feutre pointe moyenne - carmin', 15),
(118, '3.29', '/static/img/products/119.jpg', 'STABILO Trio A-Z - 12 Feutres dont 2 fluo - pointe moyenne', 'STABILO Trio A-Z - 12 Feutres dont 2 fluo - pointe moyenne', 15),
(119, '6.69', '/static/img/products/120.jpg', 'BIC Kids Visaquarelle - 10 Feutres - pointe pinceau', 'BIC Kids Visaquarelle - 10 Feutres - pointe pinceau', 15),
(120, '4.70', '/static/img/products/121.jpg', 'STABILO power max - 12 Feutres - pointe large', 'STABILO power max - 12 Feutres - pointe large', 15),
(121, '3.09', '/static/img/products/122.jpg', 'GIOTTO Turbo Color - 12 Feutres - pointe moyenne', 'GIOTTO Turbo Color - 12 Feutres - pointe moyenne', 15),
(122, '1.19', '/static/img/products/123.jpg', 'STAEDTLER - Gomme Mars Plastic', 'STAEDTLER - Gomme Mars Plastic', 14),
(123, '0.39', '/static/img/products/124.jpg', 'Wonday - Gomme blanche - tous usages', 'Wonday - Gomme blanche - tous usages', 14),
(124, '0.39', '/static/img/products/125.jpg', 'Wonday - Gomme blanche sous plastique - tous usages', 'Wonday - Gomme blanche sous plastique - tous usages', 14),
(125, '0.85', '/static/img/products/126.jpg', 'Maped - Gomme Dessin - blanche - FSC mix', 'Maped - Gomme Dessin - blanche - FSC mix', 14),
(126, '0.89', '/static/img/products/127.jpg', 'STAEDTLER - Gomme Mars Plastic mini', 'STAEDTLER - Gomme Mars Plastic mini', 14),
(127, '0.95', '/static/img/products/128.jpg', 'Maped - Gomme Duo Gom Medium - 2 usages - FSC mix', 'Maped - Gomme Duo Gom Medium - 2 usages - FSC mix', 14),
(128, '0.95', '/static/img/products/129.jpg', 'Maped Gom Pen - Pack de 2 recharges pour porte gomme', 'Maped Gom Pen - Pack de 2 recharges pour porte gomme', 14),
(129, '3.39', '/static/img/products/130.jpg', 'Maped - Porte Gomme soft grip - Gom Pen', 'Maped - Porte Gomme soft grip - Gom Pen', 14),
(130, '0.95', '/static/img/products/131.jpg', 'Pentel - Gomme sans PVC', 'Pentel - Gomme sans PVC', 14),
(131, '1.85', '/static/img/products/132.jpg', 'Maped Harry Potter - Pack de 3 Gommes pyramide (Gryffindor, Serpantard, Ravenclaw)', 'Maped Harry Potter - Pack de 3 Gommes pyramide (Gryffindor, Serpantard, Ravenclaw)', 14);

-- --------------------------------------------------------

--
-- Structure de la table `pry_cat`
--

CREATE TABLE `pry_cat` (
  `ROW_IDT` int(11) NOT NULL,
  `NAM` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pry_cat`
--

INSERT INTO `pry_cat` (`ROW_IDT`, `NAM`) VALUES
(3, 'fournitures'),
(2, 'informatique'),
(1, 'papeterie');

-- --------------------------------------------------------

--
-- Structure de la table `rol`
--

CREATE TABLE `rol` (
  `ROW_IDT` int(11) NOT NULL,
  `RGT` tinyint(50) NOT NULL,
  `NAM` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='RGT ->  Utilisateur Admin Super_Admin ';

--
-- Contenu de la table `rol`
--

INSERT INTO `rol` (`ROW_IDT`, `RGT`, `NAM`) VALUES
(1, 50, 'User'),
(2, 1, 'Admin'),
(3, 0, 'SuperAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `rol_usr_lnk`
--

CREATE TABLE `rol_usr_lnk` (
  `ROL_ROW_IDT` int(11) NOT NULL,
  `USR_ROW_IDT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rol_usr_lnk`
--

INSERT INTO `rol_usr_lnk` (`ROL_ROW_IDT`, `USR_ROW_IDT`) VALUES
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `usr`
--

CREATE TABLE `usr` (
  `ROW_IDT` int(11) NOT NULL,
  `FST_NAM` varchar(25) NOT NULL,
  `LST_NAM` varchar(25) NOT NULL,
  `SEX` varchar(20) NOT NULL,
  `EML` text NOT NULL,
  `ADR` varchar(50) NOT NULL,
  `CTY` varchar(20) NOT NULL,
  `PST_COD` int(11) NOT NULL,
  `PHN_NBR` text NOT NULL,
  `BTH_DAT` date NOT NULL,
  `PWD` char(64) NOT NULL,
  `TMP_PWD` tinyint(1) NOT NULL,
  `PSD` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `usr`
--

INSERT INTO `usr` (`ROW_IDT`, `FST_NAM`, `LST_NAM`, `SEX`, `EML`, `ADR`, `CTY`, `PST_COD`, `PHN_NBR`, `BTH_DAT`, `PWD`, `TMP_PWD`, `PSD`) VALUES
(1, 'Max', 'PONCET', 'Homme', 'maximilien.poncet19+PaperLand@gmail.com', '10 Rue Théolaps', 'Perléans', 56451, '0782517500', '2004-01-19', '28f3a79e0b1672b76a373d035f66f536178ebfce1ff0fa24335a4242dc8195eb', 0, 'Max_01');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`ROW_IDT`),
  ADD KEY `CAT_PRY_CAT_FK` (`ROW_IDT_PRY_CAT`);

--
-- Index pour la table `crt`
--
ALTER TABLE `crt`
  ADD PRIMARY KEY (`ROW_IDT`),
  ADD KEY `CRT_USR_FK` (`ROW_IDT_USR`);

--
-- Index pour la table `crt_pdt_lnk`
--
ALTER TABLE `crt_pdt_lnk`
  ADD PRIMARY KEY (`CRT_ROW_IDT`,`PDT_ROW_IDT`),
  ADD KEY `CRT_PDT_LNK_PDT0_FK` (`PDT_ROW_IDT`);

--
-- Index pour la table `pdt`
--
ALTER TABLE `pdt`
  ADD PRIMARY KEY (`ROW_IDT`),
  ADD UNIQUE KEY `PDT_AK` (`NAM`),
  ADD KEY `PDT_CAT_FK` (`ROW_IDT_CAT`);

--
-- Index pour la table `pry_cat`
--
ALTER TABLE `pry_cat`
  ADD PRIMARY KEY (`ROW_IDT`),
  ADD UNIQUE KEY `PRY_CAT_AK` (`NAM`);

--
-- Index pour la table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ROW_IDT`),
  ADD UNIQUE KEY `ROL_AK` (`NAM`);

--
-- Index pour la table `rol_usr_lnk`
--
ALTER TABLE `rol_usr_lnk`
  ADD PRIMARY KEY (`ROL_ROW_IDT`,`USR_ROW_IDT`),
  ADD KEY `ROL_USR_LNK_USR0_FK` (`USR_ROW_IDT`);

--
-- Index pour la table `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`ROW_IDT`),
  ADD UNIQUE KEY `USR_AK` (`PSD`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cat`
--
ALTER TABLE `cat`
  MODIFY `ROW_IDT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `crt`
--
ALTER TABLE `crt`
  MODIFY `ROW_IDT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `pdt`
--
ALTER TABLE `pdt`
  MODIFY `ROW_IDT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;
--
-- AUTO_INCREMENT pour la table `pry_cat`
--
ALTER TABLE `pry_cat`
  MODIFY `ROW_IDT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `rol`
--
ALTER TABLE `rol`
  MODIFY `ROW_IDT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `usr`
--
ALTER TABLE `usr`
  MODIFY `ROW_IDT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cat`
--
ALTER TABLE `cat`
  ADD CONSTRAINT `CAT_PRY_CAT_FK` FOREIGN KEY (`ROW_IDT_PRY_CAT`) REFERENCES `pry_cat` (`ROW_IDT`) ON DELETE CASCADE;

--
-- Contraintes pour la table `crt`
--
ALTER TABLE `crt`
  ADD CONSTRAINT `CRT_USR_FK` FOREIGN KEY (`ROW_IDT_USR`) REFERENCES `usr` (`ROW_IDT`) ON DELETE CASCADE;

--
-- Contraintes pour la table `crt_pdt_lnk`
--
ALTER TABLE `crt_pdt_lnk`
  ADD CONSTRAINT `CRT_PDT_LNK_CRT_FK` FOREIGN KEY (`CRT_ROW_IDT`) REFERENCES `crt` (`ROW_IDT`) ON DELETE CASCADE,
  ADD CONSTRAINT `CRT_PDT_LNK_PDT0_FK` FOREIGN KEY (`PDT_ROW_IDT`) REFERENCES `pdt` (`ROW_IDT`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pdt`
--
ALTER TABLE `pdt`
  ADD CONSTRAINT `PDT_CAT_FK` FOREIGN KEY (`ROW_IDT_CAT`) REFERENCES `cat` (`ROW_IDT`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rol_usr_lnk`
--
ALTER TABLE `rol_usr_lnk`
  ADD CONSTRAINT `ROL_USR_LNK_ROL_FK` FOREIGN KEY (`ROL_ROW_IDT`) REFERENCES `rol` (`ROW_IDT`) ON DELETE CASCADE,
  ADD CONSTRAINT `ROL_USR_LNK_USR0_FK` FOREIGN KEY (`USR_ROW_IDT`) REFERENCES `usr` (`ROW_IDT`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
