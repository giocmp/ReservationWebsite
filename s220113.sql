-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 19, 2015 alle 16:41
-- Versione del server: 5.5.43
-- Versione PHP: 5.3.10-1ubuntu3.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `s220113`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita`
--

CREATE TABLE IF NOT EXISTS `attivita` (
  `idA` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeA` text NOT NULL,
  `descrizione` text NOT NULL,
  `postitot` int(10) unsigned NOT NULL,
  `postidisp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `attivita`
--

INSERT INTO `attivita` (`idA`, `nomeA`, `descrizione`, `postitot`, `postidisp`) VALUES
(0, 'golf', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ', 6, 1),
(1, 'tennis', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ', 8, 3),
(3, 'pallavolo', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ', 4, 0),
(4, 'Calcio', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ', 15, 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE IF NOT EXISTS `prenotazioni` (
  `codP` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codA` int(10) unsigned NOT NULL,
  `codU` int(10) unsigned NOT NULL,
  `nadulti` int(10) unsigned NOT NULL,
  `nbambini` int(10) unsigned NOT NULL,
  PRIMARY KEY (`codP`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`codP`, `codA`, `codU`, `nadulti`, `nbambini`) VALUES
(93, 1, 5, 1, 0),
(94, 0, 5, 1, 1),
(96, 0, 6, 1, 2),
(97, 1, 7, 1, 3),
(98, 3, 6, 1, 1),
(99, 3, 7, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `codU` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `sale` text NOT NULL,
  PRIMARY KEY (`codU`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`codU`, `username`, `password`, `sale`) VALUES
(2, 'g@i', '15140d9ae13e0485efddb27ac16ac2e1', 'Aoz0M44Rgd'),
(3, 'c@i.com', '55923eaf9472b87e71330f39ae60943b', 'aQNAkeGyTx'),
(4, 'f@g', 'f96249becac369ec0e1c6230a763bcf4', 'P7XY6f8hPp'),
(5, 'u1', '85e7b8b687744407da92d9d7d606a42b', 'vERyFPxaH0'),
(6, 'u2', '7c31743b830950083a895d092f1cea1d', 'HecVHbhNn1'),
(7, 'u3', 'cd038081bdce4d177a6d4c9cd189c244', 'wk5c1LEGmN'),
(8, 'g@p', '226a245bdd07cfe9a2d837ab839dae61', 'yddeErETbr'),
(9, 'gi', '59ff2bfec43b4914f29f2dcb64bef568', 'UiZnMBrGUF'),
(15, 'freg', 'ed1beb3983a826bb5578e223ab897d44', 'MIoAUqgI9g'),
(25, 'prc', '89a4befbc0916c43a783da55af086cc4', '5uSpIlyHuy'),
(26, 'ciao', '81c7fbfd3699721b4c7e98b9934b07fd', 'Q2uOXf6HZV'),
(27, 'c', 'dbd2aa2e04a93eafc0a884c347670007', '5zleGgg3Cd'),
(29, ' CIAO', 'd7a7bd0e99b17230b58f7fc42eaee9b3', 'nBcs7kSTpn');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
