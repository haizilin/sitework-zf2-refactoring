
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- language
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `locale` VARCHAR(5) NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=innodb;

-- ---------------------------------------------------------------------
-- contact
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `label` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=innodb;

-- ---------------------------------------------------------------------
-- category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=innodb;

-- ---------------------------------------------------------------------
-- category_detail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category_detail`;

CREATE TABLE `category_detail`
(
    `fk_category_id` INTEGER NOT NULL,
    `fk_lang_id` INTEGER NOT NULL,
    `label` VARCHAR(255),
    PRIMARY KEY (`fk_category_id`,`fk_lang_id`),
    INDEX `FI_egory_lang` (`fk_lang_id`),
    CONSTRAINT `category_index`
        FOREIGN KEY (`fk_category_id`)
        REFERENCES `category` (`id`),
    CONSTRAINT `category_lang`
        FOREIGN KEY (`fk_lang_id`)
        REFERENCES `language` (`id`)
) ENGINE=innodb;

-- ---------------------------------------------------------------------
-- service
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `service`;

CREATE TABLE `service`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `fk_category_id` INTEGER NOT NULL,
    `pos` INTEGER NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `FI_egory` (`fk_category_id`),
    CONSTRAINT `category`
        FOREIGN KEY (`fk_category_id`)
        REFERENCES `category` (`id`)
) ENGINE=innodb;

-- ---------------------------------------------------------------------
-- service_detail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `service_detail`;

CREATE TABLE `service_detail`
(
    `fk_service_id` INTEGER NOT NULL,
    `fk_lang_id` INTEGER NOT NULL,
    `description` TEXT NOT NULL,
    PRIMARY KEY (`fk_service_id`,`fk_lang_id`),
    INDEX `FI_vice_lang` (`fk_lang_id`),
    CONSTRAINT `service`
        FOREIGN KEY (`fk_service_id`)
        REFERENCES `service` (`id`),
    CONSTRAINT `service_lang`
        FOREIGN KEY (`fk_lang_id`)
        REFERENCES `language` (`id`)
) ENGINE=innodb;

-- ---------------------------------------------------------------------
-- project
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `fk_contact_client_id` INTEGER,
    `fk_contact_employer_id` INTEGER,
    `started_at` DATE NOT NULL,
    `finished_at` DATE,
    `url` VARCHAR(255),
    `img` VARCHAR(255),
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `FI_ject_client` (`fk_contact_client_id`),
    INDEX `FI_ject_employer` (`fk_contact_employer_id`),
    CONSTRAINT `project_client`
        FOREIGN KEY (`fk_contact_client_id`)
        REFERENCES `contact` (`id`),
    CONSTRAINT `project_employer`
        FOREIGN KEY (`fk_contact_employer_id`)
        REFERENCES `contact` (`id`)
) ENGINE=innodb;

-- ---------------------------------------------------------------------
-- project_detail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_detail`;

CREATE TABLE `project_detail`
(
    `fk_project_id` INTEGER NOT NULL,
    `fk_lang_id` INTEGER NOT NULL,
    `label` VARCHAR(255) NOT NULL,
    `description` TEXT,
    PRIMARY KEY (`fk_project_id`,`fk_lang_id`),
    INDEX `FI_ject_lang` (`fk_lang_id`),
    CONSTRAINT `project`
        FOREIGN KEY (`fk_project_id`)
        REFERENCES `project` (`id`),
    CONSTRAINT `project_lang`
        FOREIGN KEY (`fk_lang_id`)
        REFERENCES `language` (`id`)
) ENGINE=innodb;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
