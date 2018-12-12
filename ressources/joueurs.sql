-- phpMyAdmin SQL Dump
-- version 4.3.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2016 at 12:22 PM
-- Server version: 5.5.50-0+deb7u2
-- PHP Version: 5.4.45-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Table structure for table `joueurs`
--

CREATE TABLE IF NOT EXISTS `joueurs` (
  `pseudo` varchar(20) CHARACTER SET utf8 NOT NULL,
  `motDePasse` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `joueurs`
--

INSERT INTO `joueurs` (`pseudo`, `motDePasse`) VALUES
('titi', 'ti9WALcto5gZw'),
('toto', 'tok.SOnXr50ss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`pseudo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
