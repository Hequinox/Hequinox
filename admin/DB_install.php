<?php
try {
	$db = new PDO('sqlite:/mnt/113/sda/4/7/artpicre/Hequinox/sqlite.sq3', null, null, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


	$sql = '-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 28 Septembre 2012 à 19:28
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `hequinox`
--
CREATE DATABASE `hequinox` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hequinox`;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `banned` tinyint(1) NOT NULL,
  `date_register` datetime NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`,`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `dateRedac` datetime NOT NULL,
  `auteurModif` varchar(255) NOT NULL,
  `dateModif` datetime NOT NULL,
  `theme` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
';

	$q = $db->prepare($sql);
	$q->exec();

	if ($q) {
		echo "Database created successfully !";
	} else {
		echo "Error, database wasn't created !";
	}

} catch (Exception $e) {
	echo "Error : ".$e->getMessage();
	exit();
}