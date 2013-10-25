How to add a facet to DASISH T2.3 Tool Registry
=========================
##DataBase

###Facet Table


To follow with the model used in the project, please create a table in lower case named after the name of your facet. It should have a *UID* as a primary key named `yourFacetName_uid` and a title/name column. E.G. :

    CREATE  TABLE IF NOT EXISTS `tools_registry`.`project` (
      `project_uid` INT NOT NULL AUTO_INCREMENT ,
      `title` VARCHAR(255) NOT NULL ,
      `description` TEXT NOT NULL ,
      `contact` VARCHAR(255) NOT NULL ,
      PRIMARY KEY (`project_uid`) )
    ENGINE = InnoDB;
    
###Relative table


To continue to follow the model established, please call your relative table `tool_has_yourFacetName`. It should have a column `tool_uid` (int 11) and a `yourFacetName_uid` one. Both should be linked to `tool` and `yourFacetName` through *foreign keys* with *CASCADE* or *NO ACTION*. You can also ensure that you don't have duplicates by creating a unique index on both columns.

    CREATE  TABLE IF NOT EXISTS `tools_registry`.`tool_has_project` (
      `tool_uid` INT NOT NULL ,
      `project_uid` INT NOT NULL ,
      PRIMARY KEY (`tool_uid`, `project_uid`) ,
      CONSTRAINT `fk_Tool_has_Project_Tool1`
        FOREIGN KEY (`tool_uid` )
        REFERENCES `tools_registry`.`tool` (`tool_uid` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_Tool_has_Project_Project1`
        FOREIGN KEY (`project_uid` )
        REFERENCES `tools_registry`.`project` (`project_uid` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    
    CREATE INDEX `fk_Tool_has_Project_Project1_idx` ON `tools_registry`.`tool_has_project` (`project_uid` ASC) ;
    
    CREATE INDEX `fk_Tool_has_Project_Tool1_idx` ON `tools_registry`.`tool_has_project` (`tool_uid` ASC) ;
    
##API

###Helper configuration

###Facet Browsing configuration

###Tool Display configuration