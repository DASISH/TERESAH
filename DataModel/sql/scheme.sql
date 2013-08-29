SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `tools_registry` ;
CREATE SCHEMA IF NOT EXISTS `tools_registry` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `tools_registry` ;

-- -----------------------------------------------------
-- Table `tools_registry`.`Tool`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `shorname` VARCHAR(100) NULL ,
  PRIMARY KEY (`UID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Provider`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Provider` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Provider` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `contact` VARCHAR(255) NOT NULL ,
  `homepage` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`UID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Licence_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Licence_type` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Licence_type` (
  `licence_type` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`licence_type`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Licence`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Licence` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Licence` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `text` TEXT NOT NULL ,
  `issued_by` INT NOT NULL COMMENT 'Provider_UID' ,
  `type` VARCHAR(255) NOT NULL COMMENT 'Licence_type_licence_type' ,
  PRIMARY KEY (`UID`) ,
  CONSTRAINT `fk_Licence_Provider1`
    FOREIGN KEY (`issued_by` )
    REFERENCES `tools_registry`.`Provider` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Licence_Licence_type1`
    FOREIGN KEY (`type` )
    REFERENCES `tools_registry`.`Licence_type` (`licence_type` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Licence_Provider1_idx` ON `tools_registry`.`Licence` (`issued_by` ASC) ;

CREATE INDEX `fk_Licence_Licence_type1_idx` ON `tools_registry`.`Licence` (`type` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_type` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_type` (
  `tool_type` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`tool_type`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Feature`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Feature` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Feature` (
  `name` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  PRIMARY KEY (`name`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_has_Feature`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_has_Feature` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_has_Feature` (
  `Tool_UID` INT NOT NULL ,
  `Feature_name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`Tool_UID`, `Feature_name`) ,
  CONSTRAINT `fk_Tool_has_Feature_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Feature_Feature1`
    FOREIGN KEY (`Feature_name` )
    REFERENCES `tools_registry`.`Feature` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Feature_Feature1_idx` ON `tools_registry`.`Tool_has_Feature` (`Feature_name` ASC) ;

CREATE INDEX `fk_Tool_has_Feature_Tool1_idx` ON `tools_registry`.`Tool_has_Feature` (`Tool_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Platform`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Platform` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Platform` (
  `platform` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`platform`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_has_Platform`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_has_Platform` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_has_Platform` (
  `Tool_UID` INT NOT NULL ,
  `Platform_platform` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`Tool_UID`, `Platform_platform`) ,
  CONSTRAINT `fk_Tool_has_Platform_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Platform_Platform1`
    FOREIGN KEY (`Platform_platform` )
    REFERENCES `tools_registry`.`Platform` (`platform` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Platform_Platform1_idx` ON `tools_registry`.`Tool_has_Platform` (`Platform_platform` ASC) ;

CREATE INDEX `fk_Tool_has_Platform_Tool1_idx` ON `tools_registry`.`Tool_has_Platform` (`Tool_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Keyword`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Keyword` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Keyword` (
  `keyword` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`keyword`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_has_Keyword`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_has_Keyword` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_has_Keyword` (
  `Tool_UID` INT NOT NULL ,
  `Keyword_keyword` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`Tool_UID`, `Keyword_keyword`) ,
  CONSTRAINT `fk_Tool_has_Keyword_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Keyword_Keyword1`
    FOREIGN KEY (`Keyword_keyword` )
    REFERENCES `tools_registry`.`Keyword` (`keyword` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Keyword_Keyword1_idx` ON `tools_registry`.`Tool_has_Keyword` (`Keyword_keyword` ASC) ;

CREATE INDEX `fk_Tool_has_Keyword_Tool1_idx` ON `tools_registry`.`Tool_has_Keyword` (`Tool_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Project` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Project` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `contact` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`UID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_has_Project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_has_Project` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_has_Project` (
  `Tool_UID` INT NOT NULL ,
  `Project_UID` INT NOT NULL ,
  PRIMARY KEY (`Tool_UID`, `Project_UID`) ,
  CONSTRAINT `fk_Tool_has_Project_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Project_Project1`
    FOREIGN KEY (`Project_UID` )
    REFERENCES `tools_registry`.`Project` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Project_Project1_idx` ON `tools_registry`.`Tool_has_Project` (`Project_UID` ASC) ;

CREATE INDEX `fk_Tool_has_Project_Tool1_idx` ON `tools_registry`.`Tool_has_Project` (`Tool_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Publication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Publication` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Publication` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `reference` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`UID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_has_Publication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_has_Publication` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_has_Publication` (
  `Tool_UID` INT NOT NULL ,
  `Publication_UID` INT NOT NULL ,
  PRIMARY KEY (`Tool_UID`, `Publication_UID`) ,
  CONSTRAINT `fk_Tool_has_Publication_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Publication_Publication1`
    FOREIGN KEY (`Publication_UID` )
    REFERENCES `tools_registry`.`Publication` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Publication_Publication1_idx` ON `tools_registry`.`Tool_has_Publication` (`Publication_UID` ASC) ;

CREATE INDEX `fk_Tool_has_Publication_Tool1_idx` ON `tools_registry`.`Tool_has_Publication` (`Tool_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Standard`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Standard` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Standard` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `version` VARCHAR(255) NOT NULL ,
  `source` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`UID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_has_Standard`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_has_Standard` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_has_Standard` (
  `Tool_UID` INT NOT NULL ,
  `Standard_UID` INT NOT NULL ,
  PRIMARY KEY (`Tool_UID`, `Standard_UID`) ,
  CONSTRAINT `fk_Tool_has_Standard_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Standard_Standard1`
    FOREIGN KEY (`Standard_UID` )
    REFERENCES `tools_registry`.`Standard` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Standard_Standard1_idx` ON `tools_registry`.`Tool_has_Standard` (`Standard_UID` ASC) ;

CREATE INDEX `fk_Tool_has_Standard_Tool1_idx` ON `tools_registry`.`Tool_has_Standard` (`Tool_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Developer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Developer` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Developer` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `contact` VARCHAR(255) NULL ,
  PRIMARY KEY (`UID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_has_Developer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_has_Developer` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_has_Developer` (
  `Tool_UID` INT NOT NULL ,
  `Developer_UID` INT NOT NULL ,
  PRIMARY KEY (`Tool_UID`, `Developer_UID`) ,
  CONSTRAINT `fk_Tool_has_Developer_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Developer_Developer1`
    FOREIGN KEY (`Developer_UID` )
    REFERENCES `tools_registry`.`Developer` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Developer_Developer1_idx` ON `tools_registry`.`Tool_has_Developer` (`Developer_UID` ASC) ;

CREATE INDEX `fk_Tool_has_Developer_Tool1_idx` ON `tools_registry`.`Tool_has_Developer` (`Tool_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Suite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Suite` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Suite` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `provided_by` INT NOT NULL COMMENT 'Provider_UID' ,
  PRIMARY KEY (`UID`) ,
  CONSTRAINT `fk_Suite_Provider1`
    FOREIGN KEY (`provided_by` )
    REFERENCES `tools_registry`.`Provider` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Suite_Provider1_idx` ON `tools_registry`.`Suite` (`provided_by` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Application_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Application_type` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Application_type` (
  `application_type` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`application_type`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Users` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Users` (
  `UID` INT NOT NULL ,
  `Name` VARCHAR(255) NULL ,
  `Mail` VARCHAR(255) NULL ,
  `Login` VARCHAR(255) NULL ,
  `Password` VARCHAR(255) NULL ,
  PRIMARY KEY (`UID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Description`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Description` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Description` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `version` VARCHAR(255) NOT NULL ,
  `homepage` VARCHAR(255) NOT NULL ,
  `available_from` DATE NOT NULL ,
  `registered` DATE NULL ,
  `registered_by` INT NULL ,
  `author` INT NOT NULL COMMENT 'Provider_UID' ,
  `Licence_UID` INT NOT NULL COMMENT 'issued for' ,
  `Tool_type_tool_type` VARCHAR(255) NOT NULL ,
  `Application_type_application_type1` VARCHAR(255) NOT NULL ,
  `Tool_UID` INT NOT NULL ,
  `Users_UID` INT NOT NULL ,
  PRIMARY KEY (`UID`) ,
  CONSTRAINT `fk_Tool_Provider0`
    FOREIGN KEY (`author` )
    REFERENCES `tools_registry`.`Provider` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_Licence10`
    FOREIGN KEY (`Licence_UID` )
    REFERENCES `tools_registry`.`Licence` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_Tool_type10`
    FOREIGN KEY (`Tool_type_tool_type` )
    REFERENCES `tools_registry`.`Tool_type` (`tool_type` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_Application_type10`
    FOREIGN KEY (`Application_type_application_type1` )
    REFERENCES `tools_registry`.`Application_type` (`application_type` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_suite_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Description_Users1`
    FOREIGN KEY (`Users_UID` )
    REFERENCES `tools_registry`.`Users` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_Provider_idx` ON `tools_registry`.`Description` (`author` ASC) ;

CREATE INDEX `fk_Tool_Licence1_idx` ON `tools_registry`.`Description` (`Licence_UID` ASC) ;

CREATE INDEX `fk_Tool_Tool_type1_idx` ON `tools_registry`.`Description` (`Tool_type_tool_type` ASC) ;

CREATE INDEX `fk_Tool_Application_type1_idx` ON `tools_registry`.`Description` (`Application_type_application_type1` ASC) ;

CREATE INDEX `fk_Tool_has_suite_Tool1_idx` ON `tools_registry`.`Description` (`Tool_UID` ASC) ;

CREATE INDEX `fk_Description_Users1_idx` ON `tools_registry`.`Description` (`Users_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Tool_has_Suite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Tool_has_Suite` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Tool_has_Suite` (
  `Tool_UID` INT NOT NULL ,
  `Suite_UID` INT NOT NULL ,
  PRIMARY KEY (`Tool_UID`) ,
  CONSTRAINT `fk_Tool_has_Feature_Tool10`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tool_has_Feature_copy1_Suite1`
    FOREIGN KEY (`Suite_UID` )
    REFERENCES `tools_registry`.`Suite` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tool_has_Feature_Tool1_idx` ON `tools_registry`.`Tool_has_Suite` (`Tool_UID` ASC) ;

CREATE INDEX `fk_Tool_has_Feature_copy1_Suite1_idx` ON `tools_registry`.`Tool_has_Suite` (`Suite_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Comment_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Comment_type` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Comment_type` (
  `COMMENT_TYPE_UID` INT NOT NULL AUTO_INCREMENT ,
  `Comment_type_name` VARCHAR(45) NULL ,
  PRIMARY KEY (`COMMENT_TYPE_UID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tools_registry`.`Comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Comment` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Comment` (
  `UID` INT NOT NULL AUTO_INCREMENT ,
  `Text` TEXT NULL ,
  `Date` DATE NULL ,
  `Subject` VARCHAR(255) NULL ,
  `Users_UID` INT NOT NULL ,
  `Tool_UID` INT NOT NULL ,
  `Comment_type_COMMENT_TYPE_UID` INT NOT NULL ,
  PRIMARY KEY (`UID`) ,
  CONSTRAINT `fk_Comment_Users1`
    FOREIGN KEY (`Users_UID` )
    REFERENCES `tools_registry`.`Users` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_Tool1`
    FOREIGN KEY (`Tool_UID` )
    REFERENCES `tools_registry`.`Tool` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_Comment_type1`
    FOREIGN KEY (`Comment_type_COMMENT_TYPE_UID` )
    REFERENCES `tools_registry`.`Comment_type` (`COMMENT_TYPE_UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Comment_Users1_idx` ON `tools_registry`.`Comment` (`Users_UID` ASC) ;

CREATE INDEX `fk_Comment_Tool1_idx` ON `tools_registry`.`Comment` (`Tool_UID` ASC) ;

CREATE INDEX `fk_Comment_Comment_type1_idx` ON `tools_registry`.`Comment` (`Comment_type_COMMENT_TYPE_UID` ASC) ;


-- -----------------------------------------------------
-- Table `tools_registry`.`Comment_has_reply`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tools_registry`.`Comment_has_reply` ;

CREATE  TABLE IF NOT EXISTS `tools_registry`.`Comment_has_reply` (
  `Comment_UID` INT NOT NULL ,
  `Comment_UID1` INT NOT NULL ,
  CONSTRAINT `fk_Comment_has_reply_Comment1`
    FOREIGN KEY (`Comment_UID` )
    REFERENCES `tools_registry`.`Comment` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_has_reply_Comment2`
    FOREIGN KEY (`Comment_UID1` )
    REFERENCES `tools_registry`.`Comment` (`UID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Comment_has_reply_Comment1_idx` ON `tools_registry`.`Comment_has_reply` (`Comment_UID` ASC) ;

CREATE INDEX `fk_Comment_has_reply_Comment2_idx` ON `tools_registry`.`Comment_has_reply` (`Comment_UID1` ASC) ;

USE `tools_registry` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
