-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 24. Jan 2013 um 22:47
-- Server Version: 5.5.29-0ubuntu0.12.10.1
-- PHP-Version: 5.4.6-1ubuntu1.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `sitework_dev`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `active`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category_detail`
--

DROP TABLE IF EXISTS `category_detail`;
CREATE TABLE IF NOT EXISTS `category_detail` (
  `fk_category_id` int(11) NOT NULL,
  `fk_lang_id` int(11) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fk_category_id`,`fk_lang_id`),
  KEY `FI_egory_lang` (`fk_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `category_detail`
--

INSERT INTO `category_detail` (`fk_category_id`, `fk_lang_id`, `label`) VALUES
(1, 1, 'Services'),
(1, 2, 'Leistungen'),
(2, 1, 'Technology'),
(2, 2, 'Technologie');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `contact`
--

INSERT INTO `contact` (`id`, `label`) VALUES
(1, 'Eva E. Froese'),
(2, 'Gebrauchte-Autoersatzteile.de (TM)'),
(3, 'Autoreparaturen.de (TM)'),
(4, 'Car Mobile Systems'),
(5, 'Reinickendorfer HKP Marco Müller GmbH'),
(6, 'JaCarte Kartographische Dienstleistungen'),
(7, 'Lianè Hübner');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(5) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `language`
--

INSERT INTO `language` (`id`, `locale`, `active`) VALUES
(1, 'en', 1),
(2, 'de', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_contact_client_id` int(11) DEFAULT NULL,
  `fk_contact_employer_id` int(11) DEFAULT NULL,
  `started_at` date NOT NULL,
  `finished_at` date DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FI_ject_client` (`fk_contact_client_id`),
  KEY `FI_ject_employer` (`fk_contact_employer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`id`, `fk_contact_client_id`, `fk_contact_employer_id`, `started_at`, `finished_at`, `url`, `img`, `active`) VALUES
(1, 1, 1, '2004-04-01', NULL, 'http://www.mpu-und-therapie.de', 'mpu-und-therapie.png', 1),
(2, 2, 4, '2006-03-13', NULL, 'http://www.gebrauchte-autoersatzteile.de', 'shpc.png', 1),
(3, 3, 4, '2009-06-13', NULL, 'http://www.autoreparaturen.de', 'autoreparaturen.png', 1),
(4, 5, 5, '2010-02-01', NULL, 'http://www.muellerpflege.de', 'marco-mueller.png', 1),
(5, 6, 6, '2011-01-09', NULL, 'http://www.jacarte.de', 'jacarte.png', 1),
(6, 3, 4, '2010-02-01', NULL, 'http://www.autoreparaturen.de', 'autoreparaturen.png', 1),
(7, 7, 7, '2012-11-15', '2013-01-05', 'http://www.awhitesheetofpaper.com', 'awsop.png', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project_detail`
--

DROP TABLE IF EXISTS `project_detail`;
CREATE TABLE IF NOT EXISTS `project_detail` (
  `fk_project_id` int(11) NOT NULL,
  `fk_lang_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`fk_project_id`,`fk_lang_id`),
  KEY `FI_ject_lang` (`fk_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `project_detail`
--

INSERT INTO `project_detail` (`fk_project_id`, `fk_lang_id`, `label`, `description`) VALUES
(1, 1, 'Med./Psych. Assessment and Therapy', 'This project started during my education as developer.\nThe Website was designed as presentation of the psychotherapy practice of the client at a time, when broadband internet connections where not self-evident for private households.'),
(1, 2, 'MPU und Therapie', 'Dieses Projekt entstand während meiner Ausbildung zum Fachinformatiker.\nZiel war die Präsentation der psychotherapeutischen Praxis der Auftraggeberin zu einer Zeit, als Breitband Internetanschlüsse im privaten Haushalt noch nicht selbstverständlich waren.'),
(2, 2, 'Gebrauchte-Autoersatzteile.de', 'Die Website stellt eine Plattform zur Vermittlung von gebrauchten Autoersatzteilen dar. Die Website stellt ein Account-System für Anbieter von Ersatzteilen und ein CMS zur Verwaltung der Clients zur Verfügung.'),
(3, 1, 'Autoreparaturen.de', 'Website to provide automotive repairs and services.\nThe chance to join this project was directly caused by the very successful development of the project "Gebrauchte-Autoersatzteile.de". Working at this project, I got the chance to gain first experiences with Zend Framework in a production environment. Because my excellent knowledge an the fast forward development in further projects, the choice for the Implementation of the view layer felt once mor on Smarty Template-Engine. Same like in the project before, the project included the development of a Service providing accounts for Drivers and service carriers and a development of a backend to manage the account and the content of the website.'),
(3, 2, 'Autoreparaturen.de', 'Service zur Vermittlung von Werkstattleistungen rund um''s Auto.\nDie Gelegenheit zur Mitarbeit an diesem Projekt war eine unmittelbare Folge der sehr guten Ergebnisse bei Realisierung des Projekts "Gebrauchte-Autoersatzteile.de". Im Rahmen dieses Projekts hatte ich die Gelegenheit erste Erfahrungen mit der Verwendung des Zend Framework in einer Produktionsumgebung zu machen. Aufgrund meiner guten Erfahrungen in der Vergangenheit kam für das Renderung des HTML-Codes die Template-Engine Smarty zum Einsatz. Wie auch Gebrauchte-Autoersatzteile.de bestand die Aufgabe in der Entwicklung einer Website mit Accounts für Autofahrer und Werkstätten, sowie eines Backends zur Verwaltung der registrierten Mitglieder und der Inhalte der Seite.'),
(4, 1, 'Marco Müller - mobile home-care service', 'This Website is the internet presentation of the "Reinickendorfer Hauskrankenpflege Marco Müller GmbH".\nThe project included the graphical design and its implementation. The Zend Framework and a MySQL database where used to solve this task.\nThe coding concept provides the possibility to extend the website, depending on later requirements of the client.'),
(4, 2, 'Marco Müller - Häusliche Krankenpflege', 'Diese Website dient der Präsentation der Reinickendorfer Hauskrankenpflege Marco Müller GmbH im Internet.\nDas Projekt beinhaltete sowohl die Entwicklung eines Designs, als auch dessen technische Umsetzung.\nHierzu kommen das Zend Framework und eine MySQL Datenbank zum Einsatz. Das Konzept ermöglicht eine einfache Pflege und bedarfsorientierte Möglichkeiten zur Erweiterung der Website zu einem späteren Zeitpunkt.'),
(5, 1, 'JaCarte - cartographic services', 'On his website, Mr. Jacoby submits an offer and presents references around cartographic services.\nDesign and content of the website are for the most part by Mr. Jacoby himself. The website and the CMS behind using the Zend Framework and providing a easily extendable architecture.'),
(5, 2, 'JaCarte - Kartographische Dienstleistungen', 'Herr Jacoby unterbreitet auf seiner Website ein Angebot und zeigt Referenzen zur Erbringung von kartographische Dienstleistungen. Inhalt und Gestaltung stammen dabei zum überwiegnden Teil von Herrn Jacoby selbst. Die Website und das dahinter liegende CMS basieren auf dem Zend Framework und stellen eine leicht erweiterbare Architektur zur Verfügung.'),
(6, 2, 'Autoreparaturen.de', 'Ein grundlegendes Refactoring zur Optimierung der Performance und Stabilität und die Entwicklung eines, hinsichtlich der Useability optimierten Designs waren Gegenstand der Überarbeitung des unter Autoreparaturen.de angebotenen Services.'),
(7, 2, 'AWHITESHEETOFPAPER.COM', NULL),
(8, 2, 'Gebrauchte-Autoersatzteile.de', 'Eine umfangreiche funktionale Erweiterung und die Entwicklung eines neuen Designs, das den Anforderungen der User an eine moderne Website gerecht wird, waren Schwerpunkte dieses Projekts.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_category_id` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FI_vice_category` (`fk_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `service`
--

INSERT INTO `service` (`id`, `fk_category_id`, `pos`, `active`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 2, 1, 1),
(8, 2, 2, 1),
(9, 2, 3, 1),
(10, 2, 4, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `service_detail`
--

DROP TABLE IF EXISTS `service_detail`;
CREATE TABLE IF NOT EXISTS `service_detail` (
  `fk_service_id` int(11) NOT NULL,
  `fk_lang_id` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`fk_service_id`,`fk_lang_id`),
  KEY `FI_vice_lang` (`fk_lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `service_detail`
--

INSERT INTO `service_detail` (`fk_service_id`, `fk_lang_id`, `description`) VALUES
(1, 2, 'Beratung bei der Auswahl einer bedarfsorientierten, kostengünstigen technischen Basis für Ihr Projekt.'),
(2, 2, 'Entwicklung und Implementierung eines, auf die Anforderungen Ihres Projekts zugeschnittenen Daten- und Anwendungsmodells.'),
(3, 2, 'Gestaltung und standardkonforme Realisierung moderner Benutzeroberflächen.'),
(4, 2, 'Installation und Einrichtung von Systemen zur Verwaltung und Präsentation Ihrer Inhalte (CMS)'),
(5, 2, 'Einrichtung, Erweiterung und Anpassung von E-Commerce Lösungen (z.B. Magento eCommerce).'),
(6, 2, 'Entwicklung und nahtlose Integration von Modulen zur Erweiterung bestehender Projekte.'),
(7, 2, 'Programmierung in PHP 4/5 (OOP, Verwendung von Design Pattern).'),
(8, 2, 'Einsatz von MVC-Frameworks (z.B Zend Framework) und Template- systemen (z.B. Smarty).'),
(9, 2, 'MySQL/PgSQL Datenbanken zur Speicherung Ihrer Daten.'),
(10, 2, 'Verwendung moderner Javascript Frameworks, wie jQuery oder MooTools.');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `category_detail`
--
ALTER TABLE `category_detail`
  ADD CONSTRAINT `category_lang` FOREIGN KEY (`fk_lang_id`) REFERENCES `language` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_client` FOREIGN KEY (`fk_contact_client_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `project_employer` FOREIGN KEY (`fk_contact_employer_id`) REFERENCES `contact` (`id`);

--
-- Constraints der Tabelle `project_detail`
--
ALTER TABLE `project_detail`
  ADD CONSTRAINT `project_index` FOREIGN KEY (`fk_project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_lang` FOREIGN KEY (`fk_lang_id`) REFERENCES `language` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_category` FOREIGN KEY (`fk_category_id`) REFERENCES `category` (`id`);

--
-- Constraints der Tabelle `service_detail`
--
ALTER TABLE `service_detail`
  ADD CONSTRAINT `service_index` FOREIGN KEY (`fk_service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_lang` FOREIGN KEY (`fk_lang_id`) REFERENCES `language` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
