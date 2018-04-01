-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Mar-2018 às 23:06
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mpog_linel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estacao`
--

CREATE TABLE `estacao` (
  `codigo_estacao` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estacao`
--

INSERT INTO `estacao` (`codigo_estacao`, `nome`, `latitude`, `longitude`) VALUES
(16900000, 'Oriximina', '-1,7764 S', '-55,8622 W'),
(17050001, 'Obidos', ' -1,9192 S', '-55,5131 W'),
(17900000, 'Santarem', '-2,4136 S', '-54,7378 W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estacao`
--
ALTER TABLE `estacao`
  ADD PRIMARY KEY (`codigo_estacao`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
