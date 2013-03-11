-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 09. Jan 2013 um 10:34
-- Server Version: 5.5.28-0ubuntu0.12.10.2
-- PHP-Version: 5.4.6-1ubuntu1.1

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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `state` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category_detail`
--

DROP TABLE IF EXISTS `category_detail`;
CREATE TABLE IF NOT EXISTS `category_detail` (
  `category_id` int(11) unsigned NOT NULL,
  `lang_id` int(11) unsigned NOT NULL,
  `description` text,
  PRIMARY KEY (`category_id`,`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `category_detail`
--

INSERT INTO `category_detail` (`category_id`, `lang_id`, `description`) VALUES
(1, 2, 'Leistungen'),
(2, 2, 'Technologie');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Daten für Tabelle `contacts`
--

INSERT INTO `contacts` (`id`, `name`) VALUES
(1, 'Second-Hand-Parts Cyran'),
(2, 'Autoreparaturen.de'),
(3, 'Saturn Media GmbH'),
(4, 'DIRTY JERZ GmbH'),
(5, 'Joint Forces Media GmbH'),
(6, 'Styleheads GmbH'),
(7, 'Eva E. Froese'),
(8, 'Ratio Wohnungsbaugenossenschaft e.G'),
(9, 'APB Arbeits- und Personalvermittlung Berlin'),
(10, 'STEPSEVEN Kreativagentur GmbH'),
(11, 'Intern'),
(12, 'IHK Potsdam'),
(13, 'Zalando GmbH'),
(14, 'Reinickendorfer HKP Marco Müller GmbH'),
(15, 'JaCarte Kartographische Dienstleistungen, Jochen Jacoby'),
(16, 'Car Mobile Systems'),
(18, 'Lianè Hübner');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_client_id` int(11) unsigned DEFAULT NULL,
  `contact_employer_id` int(11) unsigned DEFAULT NULL,
  `started_at` date DEFAULT NULL,
  `finished_at` date DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `state` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `contact_client_id` (`contact_client_id`,`contact_employer_id`,`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`id`, `contact_client_id`, `contact_employer_id`, `started_at`, `finished_at`, `url`, `img`, `state`) VALUES
(1, 7, 7, '2004-04-01', NULL, 'http://www.mpu-und-therapie.de', NULL, 3),
(3, 5, 5, '2004-12-01', NULL, NULL, NULL, 3),
(5, 5, 5, '2005-09-10', NULL, 'http://rap.de', NULL, 3),
(6, 9, 10, '2006-07-01', NULL, 'http://www.arbeits-personalsuche.de', NULL, 3),
(7, 8, 10, '2006-03-01', NULL, 'http://www.ratio-eg.de', NULL, 3),
(8, 1, 16, '2006-03-13', NULL, 'http://www.shpc.de', NULL, 3),
(9, 4, 5, '2009-03-01', NULL, 'http://www.ecko-unltd.de', NULL, 3),
(12, 2, 16, '2009-06-13', NULL, 'http://www.autoreparaturen.de', NULL, 3),
(15, 3, 5, '2008-06-17', NULL, 'http://dvd.saturn.de', NULL, 3),
(16, 2, 16, '0000-00-00', NULL, NULL, NULL, 2),
(17, 5, 5, '2009-09-30', NULL, NULL, NULL, 3),
(18, 5, 5, '2009-09-30', NULL, 'http://shop.rap.de', NULL, 3),
(19, 14, 14, '2010-02-01', NULL, 'http://www.muellerpflege.de', NULL, 3),
(20, 13, 13, '0000-00-00', NULL, 'http://www.zalando.de', NULL, 2),
(21, 15, 15, '2011-01-09', NULL, 'http://www.jacarte.de', NULL, 3),
(22, 18, 18, '2012-11-15', '2013-01-05', 'http://www.awhitesheetofpaper.com', NULL, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project_detail`
--

DROP TABLE IF EXISTS `project_detail`;
CREATE TABLE IF NOT EXISTS `project_detail` (
  `project_id` int(11) unsigned NOT NULL,
  `lang_id` int(11) unsigned NOT NULL DEFAULT '2',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`project_id`,`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `project_detail`
--

INSERT INTO `project_detail` (`project_id`, `lang_id`, `title`, `description`) VALUES
(1, 2, 'MPU und Therapie', 'Bei diesem Projekt handelt es sich um eine kleine Website für eine psychotherapeutische Praxis.'),
(3, 2, 'DVD/Film-Spider', '<p>Diese Programm wurde von mir als Projekt bei meiner Abschlussprüfung zum Fachinformatiker Anwendungsentwicklung bei der IHK-Potsdam vorgestellt.</p>\r\n<p>Mit Hilfe des Programms werden Daten aus Websites von Film/DVD-Labels gelesen und in einer MySQL-Datenbank gespeichert.</p>'),
(5, 2, 'rap.de', 'Community-Plattform für ein HipHop-affines Publikum.'),
(6, 2, 'APB Arbeits- und Personalvermittlungsagentur', 'Website einer Berliner Arbeits- und Personalvermittlungsagentur.'),
(7, 2, 'ratio-eg', 'Website einer Wohnungsbaugenossenschaft in Halle.'),
(8, 2, 'Second-Hand-Parts Cyran', 'Die Website stellt eine Plattform zur Vermittlung von gebrauchten Autoersatzteilen dar. Die Website stellt ein Account-System für Anbieter von Ersatzteilen und ein CMS zur Verwaltung der Clients zur Verfügung.'),
(9, 2, 'Website *ecko unltd.', 'Website der Streetware Marke *ecko-unltd.'),
(12, 2, 'Autoreparaturen.de', 'Plattform zur Vermittlung von Kfz-Werkstattleistungen.'),
(15, 2, 'Saturn - DVD Website', 'Im Auftrag der Saturn Media GmbH wurde durch die Joint Forces Media GmbH der DVD-Bereich der Website der Saturn Media GmbH nach Vorgaben des Kunden gestaltet. Die Software verfügt über ein CMS zur Pflege der Daten und über eine Schnittstelle für den Import der Sidebars durch Drittanbieter, die ihren Content selbst hosten.'),
(16, 2, 'Erweiterung/Pflege Autoreparaturen.de', '<p>Nach Inbetriebnahme am 13.06.2008, einem ersten Update am 13.06.2009 und mit neu gewonnenen Erfahrungen geht\r\ndie Entwicklung von <a href="http://www.autorepaarturen.de" target="_blank">Autoreparaturen.de</a> in die dritte Runde.</p>\r\n<p>Neben einem umfangreichen Refactoring des Codes und der Optimierung der Ansichten im Sinne einer intuitiven Bedienung, stehen vor Allem Erweiterungen der Funktionalit&auml;t der Useraccounts und des administrativen Bereichs auf der Agenda.</p>\r\n'),
(17, 2, 'Synchronisation Magento/TinyERP', '<p>Als Teilprojekt der Umstellung der von der <a href="http://www.jfmedia.de" target="_blank">Joint Forces Media GmbH</a> betriebenen Online-Shops,\r\nzielt dieses Projekt auf eine zeitnahe Synchronisation des Datenbestandes einer entfernten <a href="http://mysql.com" target="_blank">MySQL-Datenbank</a>\r\nmit dem	Datenbestand einer lokalen und strukturell abweichenden <a href="http://http://www.postgresql.org" target="_blank">Postgres-Datenbank</a>.</p>\r\n<p>Zum Einsatz kommen hierf&uuml;r <a href="http://php.net" target="_blank">PHP</a> mit dem Zend Framework und <a href="http://python.org" target="_blank">Python</a>.</p>\r\n'),
(18, 2, 'Anpassung von Modulen für Magento eCommerce', '<p>Zur Anpassung an die individuellen Anforderungen der Online-Shops der Joint Forces Media GmbH und zur Gew&auml;hrleistung einer optimalen Vermarktung der angebotenen Produkte werden im Rahmen dieses Projektes insbesondere Module des Frontend von <a href="http://www.magentoecommerce.com">Magento eCommerce</a> modifiziert und erweitert. Dabei kommt haupts&auml;chlich das <a href="http://jquery.com">Javascript Framework jQuery</a> und CSS (Cascading Style Sheets) zum Einsatz.</p>\r\n'),
(19, 2, 'Marco Müller - Häusliche Krankenpflege', '<p>Website zur Präsentation der Reinickendorfer Hauskrankenpflege Marco Müller GmbH. Dieses Projekt beinhaltete  sowohl die Entwicklung des Designs, als auch dessen technische Umsetzung.</p><p>Zum Einsatz kommen hierzu PHP mit dem Zend Framework und MySQL. Das Konzept ermöglicht eine einfache Pflege und bedarfsorientierte Möglichkeiten zur Erweiterung der Website zu einem späteren Zeitpunkt.</p>\r\n'),
(20, 2, 'Zalando.de', '<p>Im Zusammenhang meines Wechsels zur <a href="http://www.rocket-internet.de" target="_blank">Rocket Internet GmbH</a> (Okt. 2009) und später zur Zalando GmbH (März 2010), wirke ich an der Umsetzung des Online-Shops der <a href="http://www.zalando.de" target="_blank">Zalando GmbH</a> und der damit verbundenen Services mit.</p><p>Technische Basis des Shops ist Magento eCommerce. Die Software wurde inzwischen durch zahlreiche Module erweitert und den Anforderungen angepasst. Besonders hervorzuheben sind dabei die Integration eines <a href="http://lucene.apache.org/solr" target="_blank">SOLR Such-Servers</a> auf Basis des <a href="http://lucene.apache.org/" target="_blank">Apache Lucene Projekts</a></p> '),
(21, 2, 'JaCarte Kartographische Dienstleistungen', 'Jochen Jacoby unterbreitet auf seiner Website ein Angebot und zeigt Referenzen zur Erbringung von kartographische Dienstleistungen. Inhalt und Gestaltung stammen dabei zu einem großen teil von Herrn Jacoby und wurden auf basis des Zend Framework auf <a href="http://www.jacarte.de">www.jacarte.de</a> umgesetzt.'),
(22, 2, 'AWHITESHEETOFPAPER.COM', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pos` int(2) unsigned NOT NULL,
  `category_id` int(2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pos_cat` (`pos`,`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `service`
--

INSERT INTO `service` (`id`, `pos`, `category_id`) VALUES
(1, 1, 1),
(7, 1, 2),
(2, 2, 1),
(8, 2, 2),
(3, 3, 1),
(9, 3, 2),
(4, 4, 1),
(10, 4, 2),
(5, 5, 1),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `service_detail`
--

DROP TABLE IF EXISTS `service_detail`;
CREATE TABLE IF NOT EXISTS `service_detail` (
  `service_id` int(11) unsigned NOT NULL,
  `lang_id` int(11) unsigned NOT NULL DEFAULT '2',
  `description` text NOT NULL,
  PRIMARY KEY (`service_id`,`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `service_detail`
--

INSERT INTO `service_detail` (`service_id`, `lang_id`, `description`) VALUES
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
