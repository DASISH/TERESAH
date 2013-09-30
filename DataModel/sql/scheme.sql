SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `tools_registry` ;
CREATE SCHEMA IF NOT EXISTS `tools_registry` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `tools_registry` ;

-- -----------------------------------------------------
-- Table `tools_registry`.`tool`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool` (
  `tool_uid` INT NOT NULL AUTO_INCREMENT,
  `shortname` VARCHAR(100) NULL,
  PRIMARY KEY (`tool_uid`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `shortname_UNIQUE` ON `tools_registry`.`tool` (`shortname` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`organization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`organization` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`organization` (
  `organization_uid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `contact` VARCHAR(255) NOT NULL,
  `homepage` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`organization_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`licence_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`licence_type` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`licence_type` (
  `licence_type_uid` INT NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`licence_type_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`licence`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`licence` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`licence` (
  `licence_uid` INT NOT NULL AUTO_INCREMENT,
  `text` TEXT NOT NULL,
  `issued_by` INT NULL COMMENT 'Provider_UID',
  `licence_type_uid` INT NOT NULL COMMENT 'Licence_type_licence_type',
  PRIMARY KEY (`licence_uid`),
  CONSTRAINT `fk_Licence_Provider1`
    FOREIGN KEY (`issued_by`)
    REFERENCES `tools_registry`.`organization` (`organization_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Licence_Licence_type1`
    FOREIGN KEY (`licence_type_uid`)
    REFERENCES `tools_registry`.`licence_type` (`licence_type_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Licence_Provider1_idx` ON `tools_registry`.`licence` (`issued_by` ASC);

CREATE INDEX `fk_Licence_Licence_type1_idx` ON `tools_registry`.`licence` (`licence_type_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_type` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_type` (
  `tool_type_uid` INT NOT NULL AUTO_INCREMENT,
  `tool_type` VARCHAR(255) NULL,
  `sourceURI` VARCHAR(255) NULL,
  PRIMARY KEY (`tool_type_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`feature`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`feature` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`feature` (
  `feature_uid` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`feature_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_feature`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_feature` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_feature` (
  `tool_uid` INT NOT NULL,
  `feature_uid` INT NOT NULL,
  PRIMARY KEY (`tool_uid`, `feature_uid`),
  CONSTRAINT `fk_Tool_has_Feature_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Feature_Feature1`
    FOREIGN KEY (`feature_uid`)
    REFERENCES `tools_registry`.`feature` (`feature_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Feature_Feature1_idx` ON `tools_registry`.`tool_has_feature` (`feature_uid` ASC);

CREATE INDEX `fk_Tool_has_Feature_Tool1_idx` ON `tools_registry`.`tool_has_feature` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`platform`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`platform` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`platform` (
  `platform_uid` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`platform_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_platform`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_platform` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_platform` (
  `tool_uid` INT NOT NULL,
  `platform_uid` INT NOT NULL,
  PRIMARY KEY (`tool_uid`, `platform_uid`),
  CONSTRAINT `fk_Tool_has_Platform_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Platform_Platform1`
    FOREIGN KEY (`platform_uid`)
    REFERENCES `tools_registry`.`platform` (`platform_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Platform_Tool1_idx` ON `tools_registry`.`tool_has_platform` (`tool_uid` ASC);

CREATE INDEX `fk_Tool_has_Platform_Platform1_idx` ON `tools_registry`.`tool_has_platform` (`platform_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`keyword`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`keyword` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`keyword` (
  `keyword_uid` INT NOT NULL AUTO_INCREMENT,
  `keyword` VARCHAR(255) NOT NULL,
  `source_uri` VARCHAR(255) NULL,
  `source_taxonomy` VARCHAR(255) NULL,
  PRIMARY KEY (`keyword_uid`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `UNIQ` ON `tools_registry`.`keyword` (`keyword` ASC, `source_uri` ASC, `source_taxonomy` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_keyword`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_keyword` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_keyword` (
  `tool_uid` INT NOT NULL,
  `keyword_uid` INT NOT NULL,
  PRIMARY KEY (`tool_uid`, `keyword_uid`),
  CONSTRAINT `fk_Tool_has_Keyword_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Keyword_Keyword1`
    FOREIGN KEY (`keyword_uid`)
    REFERENCES `tools_registry`.`keyword` (`keyword_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Keyword_Tool1_idx` ON `tools_registry`.`tool_has_keyword` (`tool_uid` ASC);

CREATE INDEX `fk_Tool_has_Keyword_Keyword1_idx` ON `tools_registry`.`tool_has_keyword` (`keyword_uid` ASC);

CREATE UNIQUE INDEX `UNIQ` ON `tools_registry`.`tool_has_keyword` (`tool_uid` ASC, `keyword_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`project` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`project` (
  `project_uid` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `contact` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`project_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_project` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_project` (
  `tool_uid` INT NOT NULL,
  `project_uid` INT NOT NULL,
  PRIMARY KEY (`tool_uid`, `project_uid`),
  CONSTRAINT `fk_Tool_has_Project_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Project_Project1`
    FOREIGN KEY (`project_uid`)
    REFERENCES `tools_registry`.`project` (`project_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Project_Project1_idx` ON `tools_registry`.`tool_has_project` (`project_uid` ASC);

CREATE INDEX `fk_Tool_has_Project_Tool1_idx` ON `tools_registry`.`tool_has_project` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`publication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`publication` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`publication` (
  `publication_uid` INT NOT NULL AUTO_INCREMENT,
  `reference` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`publication_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_publication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_publication` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_publication` (
  `tool_uid` INT NOT NULL,
  `publication_uid` INT NOT NULL,
  PRIMARY KEY (`tool_uid`, `publication_uid`),
  CONSTRAINT `fk_Tool_has_Publication_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Publication_Publication1`
    FOREIGN KEY (`publication_uid`)
    REFERENCES `tools_registry`.`publication` (`publication_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Publication_Publication1_idx` ON `tools_registry`.`tool_has_publication` (`publication_uid` ASC);

CREATE INDEX `fk_Tool_has_Publication_Tool1_idx` ON `tools_registry`.`tool_has_publication` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`standard`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`standard` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`standard` (
  `standard_uid` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `version` VARCHAR(255) NOT NULL,
  `source` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`standard_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_standard`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_standard` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_standard` (
  `tool_uid` INT NOT NULL,
  `standard_uid` INT NOT NULL,
  PRIMARY KEY (`tool_uid`, `standard_uid`),
  CONSTRAINT `fk_Tool_has_Standard_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Standard_Standard1`
    FOREIGN KEY (`standard_uid`)
    REFERENCES `tools_registry`.`standard` (`standard_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Standard_Standard1_idx` ON `tools_registry`.`tool_has_standard` (`standard_uid` ASC);

CREATE INDEX `fk_Tool_has_Standard_Tool1_idx` ON `tools_registry`.`tool_has_standard` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`developer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`developer` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`developer` (
  `developer_uid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `contact` VARCHAR(255) NULL,
  PRIMARY KEY (`developer_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_developer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_developer` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_developer` (
  `tool_uid` INT NOT NULL,
  `developer_uid` INT NOT NULL,
  PRIMARY KEY (`tool_uid`, `developer_uid`),
  CONSTRAINT `fk_Tool_has_Developer_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Developer_Developer1`
    FOREIGN KEY (`developer_uid`)
    REFERENCES `tools_registry`.`developer` (`developer_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Developer_Developer1_idx` ON `tools_registry`.`tool_has_developer` (`developer_uid` ASC);

CREATE INDEX `fk_Tool_has_Developer_Tool1_idx` ON `tools_registry`.`tool_has_developer` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`suite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`suite` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`suite` (
  `suite_uid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`suite_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`application_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`application_type` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`application_type` (
  `application_type_uid` INT NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`application_type_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`user` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`user` (
  `user_uid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `mail` VARCHAR(255) NOT NULL,
  `login` VARCHAR(255) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`user_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`description`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`description` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`description` (
  `description_uid` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `version` VARCHAR(255) NULL,
  `homepage` VARCHAR(255) NOT NULL,
  `available_from` DATE NULL,
  `registered` DATE NULL,
  `registered_by` INT NULL,
  `licence_uid` INT NOT NULL COMMENT 'issued for',
  `tool_uid` INT NOT NULL,
  `user_uid` INT NOT NULL,
  PRIMARY KEY (`description_uid`),
  CONSTRAINT `fk_Tool_Licence10`
    FOREIGN KEY (`licence_uid`)
    REFERENCES `tools_registry`.`licence` (`licence_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_suite_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Description_Users1`
    FOREIGN KEY (`user_uid`)
    REFERENCES `tools_registry`.`user` (`user_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_Licence1_idx` ON `tools_registry`.`description` (`licence_uid` ASC);

CREATE INDEX `fk_Tool_has_suite_Tool1_idx` ON `tools_registry`.`description` (`tool_uid` ASC);

CREATE INDEX `fk_Description_Users1_idx` ON `tools_registry`.`description` (`user_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_suite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_suite` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_suite` (
  `tool_uid` INT NOT NULL,
  `suite_uid` INT NOT NULL,
  PRIMARY KEY (`tool_uid`, `suite_uid`),
  CONSTRAINT `fk_Tool_has_Feature_Tool10`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Feature_copy1_Suite1`
    FOREIGN KEY (`suite_uid`)
    REFERENCES `tools_registry`.`suite` (`suite_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Feature_Tool1_idx` ON `tools_registry`.`tool_has_suite` (`tool_uid` ASC);

CREATE INDEX `fk_Tool_has_Feature_copy1_Suite1_idx` ON `tools_registry`.`tool_has_suite` (`suite_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`comment` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`comment` (
  `comment_uid` INT NOT NULL AUTO_INCREMENT,
  `text` TEXT NULL,
  `date` DATE NULL,
  `subject` VARCHAR(255) NULL,
  `user_uid` INT NOT NULL,
  `tool_uid` INT NOT NULL,
  `type` ENUM('answer', 'question', 'comment') NOT NULL DEFAULT 'question',
  PRIMARY KEY (`comment_uid`),
  CONSTRAINT `fk_Comment_Users1`
    FOREIGN KEY (`user_uid`)
    REFERENCES `tools_registry`.`user` (`user_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Comment_Users1_idx` ON `tools_registry`.`comment` (`user_uid` ASC);

CREATE INDEX `fk_Comment_Tool1_idx` ON `tools_registry`.`comment` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`comment_has_reply`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`comment_has_reply` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`comment_has_reply` (
  `comment_uid` INT NOT NULL,
  `comment_uid1` INT NOT NULL,
  CONSTRAINT `fk_Comment_has_reply_Comment1`
    FOREIGN KEY (`comment_uid`)
    REFERENCES `tools_registry`.`comment` (`comment_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_has_reply_Comment2`
    FOREIGN KEY (`comment_uid1`)
    REFERENCES `tools_registry`.`comment` (`comment_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Comment_has_reply_Comment1_idx` ON `tools_registry`.`comment_has_reply` (`comment_uid` ASC);

CREATE INDEX `fk_Comment_has_reply_Comment2_idx` ON `tools_registry`.`comment_has_reply` (`comment_uid1` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_previous_version`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_previous_version` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_previous_version` (
  `previous_version_tool_uid` INT NOT NULL,
  `later_version_tool_uid` INT NOT NULL,
  PRIMARY KEY (`previous_version_tool_uid`, `later_version_tool_uid`),
  CONSTRAINT `fk_Tool_has_Tool_Tool1`
    FOREIGN KEY (`previous_version_tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Tool_Tool2`
    FOREIGN KEY (`later_version_tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Tool_Tool2_idx` ON `tools_registry`.`tool_has_previous_version` (`later_version_tool_uid` ASC);

CREATE INDEX `fk_Tool_has_Tool_Tool1_idx` ON `tools_registry`.`tool_has_previous_version` (`previous_version_tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`api_key`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`api_key` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`api_key` (
  `api_key_uid` INT NOT NULL AUTO_INCREMENT,
  `public_key` VARCHAR(64) NULL,
  `private_key` VARCHAR(64) NULL,
  `user_uid` INT NOT NULL,
  PRIMARY KEY (`api_key_uid`),
  CONSTRAINT `fk_Api_Keys_Users1`
    FOREIGN KEY (`user_uid`)
    REFERENCES `tools_registry`.`user` (`user_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Api_Keys_Users1_idx` ON `tools_registry`.`api_key` (`user_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`system_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`system_log` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`system_log` (
  `system_log_uid` INT NOT NULL AUTO_INCREMENT,
  `table` VARCHAR(45) NULL,
  `table_uid` INT NULL,
  `action` ENUM('insert','update','delete','login','logout') NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT now(),
  `user_uid` INT NOT NULL,
  PRIMARY KEY (`system_log_uid`),
  CONSTRAINT `fk_SystemLog_Users1`
    FOREIGN KEY (`user_uid`)
    REFERENCES `tools_registry`.`user` (`user_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_SystemLog_Users1_idx` ON `tools_registry`.`system_log` (`user_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`description_has_organization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`description_has_organization` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`description_has_organization` (
  `organization_uid` INT NOT NULL,
  `description_uid` INT NOT NULL,
  PRIMARY KEY (`organization_uid`, `description_uid`),
  CONSTRAINT `fk_Description_has_Organization_Organization1`
    FOREIGN KEY (`organization_uid`)
    REFERENCES `tools_registry`.`organization` (`organization_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Description_has_Organization_Description1`
    FOREIGN KEY (`description_uid`)
    REFERENCES `tools_registry`.`description` (`description_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Description_has_Organization_Organization1_idx` ON `tools_registry`.`description_has_organization` (`organization_uid` ASC);

CREATE INDEX `fk_Description_has_Organization_Description1_idx` ON `tools_registry`.`description_has_organization` (`description_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`alternative_title`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`alternative_title` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`alternative_title` (
  `description_uid` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`description_uid`),
  CONSTRAINT `fk_Alternative_Title_Description1`
    FOREIGN KEY (`description_uid`)
    REFERENCES `tools_registry`.`description` (`description_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Alternative_Title_Description1_idx` ON `tools_registry`.`alternative_title` (`description_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_tool_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_tool_type` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_tool_type` (
  `tool_type_uid` INT NOT NULL,
  `tool_uid` INT NOT NULL,
  PRIMARY KEY (`tool_type_uid`, `tool_uid`),
  CONSTRAINT `fk_Description_has_Tool_type_Tool_type1`
    FOREIGN KEY (`tool_type_uid`)
    REFERENCES `tools_registry`.`tool_type` (`tool_type_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Description_has_Tool_type_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Description_has_Tool_type_Tool1_idx` ON `tools_registry`.`tool_has_tool_type` (`tool_uid` ASC);

CREATE INDEX `fk_Description_has_Tool_type_Tool_type1_idx` ON `tools_registry`.`tool_has_tool_type` (`tool_type_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_has_application_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_has_application_type` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_has_application_type` (
  `application_type_uid` INT NOT NULL,
  `tool_uid` INT NOT NULL,
  PRIMARY KEY (`application_type_uid`, `tool_uid`),
  CONSTRAINT `fk_Description_has_Application_type_Application_type1`
    FOREIGN KEY (`application_type_uid`)
    REFERENCES `tools_registry`.`application_type` (`application_type_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Description_has_Application_type_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Description_has_Application_type_Application_type1_idx` ON `tools_registry`.`tool_has_application_type` (`application_type_uid` ASC);

CREATE INDEX `fk_Description_has_Application_type_Tool1_idx` ON `tools_registry`.`tool_has_application_type` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`external_description`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`external_description` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`external_description` (
  `external_description_uid` INT NOT NULL AUTO_INCREMENT,
  `tool_uid` INT NOT NULL,
  `description` TEXT NULL,
  `source_uri` VARCHAR(255) NULL,
  `registry_name` VARCHAR(255) NULL,
  PRIMARY KEY (`external_description_uid`),
  CONSTRAINT `fk_External_Description_Tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_External_Description_Tool1_idx` ON `tools_registry`.`external_description` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`tool_application_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`tool_application_type` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`tool_application_type` (
  `tool_application_type_uid` INT NOT NULL AUTO_INCREMENT,
  `tool_uid` INT NOT NULL,
  `application_type` ENUM('localDesktop', 'webApplication', 'webService', 'other', 'unknown') NOT NULL DEFAULT 'unknown',
  PRIMARY KEY (`tool_application_type_uid`),
  CONSTRAINT `fk_tool_application_type_tool1`
    FOREIGN KEY (`tool_uid`)
    REFERENCES `tools_registry`.`tool` (`tool_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_tool_application_type_tool1_idx` ON `tools_registry`.`tool_application_type` (`tool_uid` ASC);


-- -----------------------------------------------------
-- Table `tools_registry`.`user_oauth`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`user_oauth` ;

CREATE TABLE IF NOT EXISTS `tools_registry`.`user_oauth` (
  `user_oauth_uid` INT NOT NULL AUTO_INCREMENT,
  `user_uid` INT NOT NULL,
  `provider` VARCHAR(45) NOT NULL,
  `oauth_user_uid` INT(11) NOT NULL,
  PRIMARY KEY (`user_oauth_uid`),
  CONSTRAINT `fk_user_oauth_user1`
    FOREIGN KEY (`user_uid`)
    REFERENCES `tools_registry`.`user` (`user_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_user_oauth_user1_idx` ON `tools_registry`.`user_oauth` (`user_uid` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
