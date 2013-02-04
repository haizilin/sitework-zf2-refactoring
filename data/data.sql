SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- category
TRUNCATE TABLE `category`;
INSERT INTO `category` (`id`, `active`) VALUES
(1, 1),
(2, 1);

-- category_detail
TRUNCATE TABLE `category_detail`;
INSERT INTO `category_detail` (`fk_category_id`, `fk_lang_id`, `label`) VALUES
(1, 2, 'Leistungen'),
(2, 2, 'Technologie');

 -- contact
 TRUNCATE TABLE `contact`;
INSERT INTO `contact` (`id`, `label`) VALUES
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

-- project
TRUNCATE TABLE `project`;
INSERT INTO `project` (`id`, `fk_contact_client_id`, `fk_contact_employer_id`, `started_at`, `finished_at`, `url`, `img`, `active`) VALUES
(1, 7, 7, '2004-04-01', NULL, 'http://www.mpu-und-therapie.de', NULL, 1),
(3, 5, 5, '2004-12-01', NULL, NULL, NULL, 1),
(5, 5, 5, '2005-09-10', NULL, 'http://rap.de', NULL, 1),
(6, 9, 10, '2006-07-01', NULL, 'http://www.arbeits-personalsuche.de', NULL, 1),
(7, 8, 10, '2006-03-01', NULL, 'http://www.ratio-eg.de', NULL, 1),
(8, 1, 16, '2006-03-13', NULL, 'http://www.shpc.de', NULL, 1),
(9, 4, 5, '2009-03-01', NULL, 'http://www.ecko-unltd.de', NULL, 1),
(12, 2, 16, '2009-06-13', NULL, 'http://www.autoreparaturen.de', NULL, 1),
(15, 3, 5, '2008-06-17', NULL, 'http://dvd.saturn.de', NULL, 1),
(16, 2, 16, '0000-00-00', NULL, NULL, NULL, 1),
(17, 5, 5, '2009-09-30', NULL, NULL, NULL, 1),
(18, 5, 5, '2009-09-30', NULL, 'http://shop.rap.de', NULL, 1),
(19, 14, 14, '2010-02-01', NULL, 'http://www.muellerpflege.de', NULL, 1),
(20, 13, 13, '0000-00-00', NULL, 'http://www.zalando.de', NULL, 1),
(21, 15, 15, '2011-01-09', NULL, 'http://www.jacarte.de', NULL, 1),
(22, 18, 18, '2012-11-15', '2013-01-05', 'http://www.awhitesheetofpaper.com', NULL, 1);

-- project_detail
TRUNCATE TABLE `project_detail`;
INSERT INTO `project_detail` (`fk_project_id`, `fk_lang_id`, `label`, `description`) VALUES
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

-- service
TRUNCATE TABLE `service`;
INSERT INTO `service` (`id`, `pos`, `fk_category_id`, `active`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 1, 2, 1),
(8, 2, 2, 1),
(9, 3, 2, 1),
(10, 4, 2, 1);

-- service_detail
TRUNCATE TABLE `service_detail`;
INSERT INTO `service_detail` (`fk_service_id`, `fk_lang_id`, `description`) VALUES
(1, 2,  'Beratung bei der Auswahl einer bedarfsorientierten, kostengünstigen technischen Basis für Ihr Projekt.'),
(2, 2,  'Entwicklung und Implementierung eines, auf die Anforderungen Ihres Projekts zugeschnittenen Daten- und Anwendungsmodells.'),
(3, 2,  'Gestaltung und standardkonforme Realisierung moderner Benutzeroberflächen.'),
(4, 2,  'Installation und Einrichtung von Systemen zur Verwaltung und Präsentation Ihrer Inhalte (CMS)'),
(5, 2,  'Einrichtung, Erweiterung und Anpassung von E-Commerce Lösungen (z.B. Magento eCommerce).'),
(6, 2,  'Entwicklung und nahtlose Integration von Modulen zur Erweiterung bestehender Projekte.'),
(7, 2,  'Programmierung in PHP 4/5 (OOP, Verwendung von Design Pattern).'),
(8, 2,  'Einsatz von MVC-Frameworks (z.B Zend Framework) und Template- systemen (z.B. Smarty).'),
(9, 2,  'MySQL/PgSQL Datenbanken zur Speicherung Ihrer Daten.'),
(10, 2, 'Verwendung moderner Javascript Frameworks, wie jQuery oder MooTools.');


SET FOREIGN_KEY_CHECKS=1;
