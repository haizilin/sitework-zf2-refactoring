-- phpMyAdmin SQL Dump
-- version 4.0.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 28. Mai 2013 um 07:54
-- Server Version: 5.5.31-0ubuntu0.13.04.1
-- PHP-Version: 5.4.9-4ubuntu2

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `active`) VALUES
(1, 1),
(2, 1),
(3, 1);

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
(2, 2, 'Technologie'),
(3, 1, 'Resources'),
(3, 2, 'Resources');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Daten für Tabelle `contact`
--

INSERT INTO `contact` (`id`, `label`) VALUES
(1, 'Intern'),
(2, 'Eva E. Froese'),
(3, 'Second-Hand-Parts Cyran'),
(4, 'Autoreparaturen.de'),
(5, 'Car Mobile Systems'),
(6, 'Reinickendorfer HKP Marco Müller GmbH'),
(7, 'JaCarte Kartographische Dienstleistungen, Jochen Jacoby'),
(8, 'Lianè Hübner'),
(9, 'Frank Müller'),
(10, 'Rozalina Angelova');

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
(1, 'en_US', 1),
(2, 'de_DE', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`id`, `fk_contact_client_id`, `fk_contact_employer_id`, `started_at`, `finished_at`, `url`, `img`, `active`) VALUES
(1, 2, 2, '2004-04-01', '2004-05-25', 'http://www.mpu-und-therapie.de', 'mpu-und-therapie.png', 1),
(2, 2, 5, '2006-03-13', '2006-08-01', 'http://www.shpc.de', 'shpc.png', 1),
(3, 3, 5, '2009-06-13', '2010-01-02', 'http://www.autoreparaturen.de', 'autoreparaturen.png', 1),
(4, 6, 6, '2010-02-01', '2010-03-01', 'http://www.muellerpflege.de', 'marco-mueller.png', 1),
(5, 7, 7, '2011-01-09', '2011-10-20', 'http://www.jacarte.de', 'jacarte.png', 1),
(6, 8, 8, '2012-11-15', '2013-01-05', 'http://www.awhitesheetofpaper.com', 'awsop.png', 1),
(7, 9, 9, '2013-03-15', NULL, NULL, NULL, 1),
(8, 10, 10, '2013-05-15', NULL, NULL, NULL, 1);

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
(1, 2, 'MPU und Therapie', '<p>Bei diesem Projekt handelt es sich um eine kleine Website für eine psychotherapeutische Praxis.</p>'),
(2, 2, 'Second-Hand-Parts Cyran', '<p>Die Website stellt eine Plattform zur Vermittlung von gebrauchten Autoersatzteilen dar. Die Website stellt ein Account-System für Anbieter von Ersatzteilen und ein CMS zur Verwaltung der Clients zur Verfügung.</p>'),
(3, 2, 'Autoreparaturen.de', '<p>Plattform zur Vermittlung von Kfz-Werkstattleistungen.</p>'),
(4, 2, 'Marco Müller - Hauskrankenpflege', '<p>Website zur Präsentation der Reinickendorfer Hauskrankenpflege Marco Müller GmbH. Dieses Projekt beinhaltete  sowohl die Entwicklung des Designs, als auch dessen technische Umsetzung.</p><p>Zum Einsatz kommen hierzu PHP mit dem Zend Framework und MySQL. Das Konzept ermöglicht eine einfache Pflege und bedarfsorientierte Möglichkeiten zur Erweiterung der Website zu einem späteren Zeitpunkt.</p>\r\n'),
(5, 2, 'JaCarte - Kartographie', '<p>Jochen Jacoby unterbreitet auf seiner Website ein Angebot und zeigt Referenzen zur Erbringung von kartographische Dienstleistungen. Inhalt und Gestaltung stammen dabei zu einem großen teil von Herrn Jacoby und wurden auf basis des Zend Framework auf <a href="http://www.jacarte.de">www.jacarte.de</a> umgesetzt.</p>'),
(6, 2, 'AWHITESHEETOFPAPER.COM', NULL),
(7, 2, 'Sportfischen vor Puerto Angel ', 'Website für ein Angebot für Sportfischen an der mexikanischen Pazifikküste.'),
(8, 2, 'Stress Free Motion', 'Website für ein Angebot für Coaching, Yoga und Vermittlung von Techniken zur Stressbewältigung und Verbesserung der lebensqualität durch eine positive Einstellung.');

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
  KEY `FI_egory` (`fk_category_id`)
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
(1, 1, 'Advice on the selection of a demand-driven, cost-effective technical basis for your project'),
(1, 2, 'Beratung bei der Auswahl einer bedarfsorientierten, kostengünstigen technischen Basis für Ihr Projekt.'),
(2, 1, 'Development and implementationof a project data and application model fitting your needs.'),
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
  ADD CONSTRAINT `category_index` FOREIGN KEY (`fk_category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `category_lang` FOREIGN KEY (`fk_lang_id`) REFERENCES `language` (`id`);

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
  ADD CONSTRAINT `project` FOREIGN KEY (`fk_project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `project_lang` FOREIGN KEY (`fk_lang_id`) REFERENCES `language` (`id`);

--
-- Constraints der Tabelle `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `category` FOREIGN KEY (`fk_category_id`) REFERENCES `category` (`id`);

--
-- Constraints der Tabelle `service_detail`
--
ALTER TABLE `service_detail`
  ADD CONSTRAINT `service` FOREIGN KEY (`fk_service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `service_lang` FOREIGN KEY (`fk_lang_id`) REFERENCES `language` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
