SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Applications table
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `idApplication` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDefault` tinyint(1) DEFAULT '0' NOT NULL,
  `isEnabled` tinyint(1) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`idApplication`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `prefix` (`prefix`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- Languages table
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `idLanguage` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isMain` tinyint(1) NOT NULL,
  `isEnabled` tinyint(1) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`idLanguage`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Routes table
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `idRoute` int(11) NOT NULL AUTO_INCREMENT,
  `idApplication` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pattern` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requirements` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `methods` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isLocalized` tinyint(1) DEFAULT '1' NOT NULL,
  `isDefault` tinyint(1) DEFAULT '0' NOT NULL,
  `isEnabled` tinyint(1) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`idRoute`),
  UNIQUE KEY `route` (`name`),
  KEY `IDX_32D5C2B33E030ACD` (`idApplication`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- Routes constraint
--
ALTER TABLE `routes`
  ADD CONSTRAINT `FK_32D5C2B33E030ACD` FOREIGN KEY (`idApplication`) REFERENCES `applications` (`idApplication`);
