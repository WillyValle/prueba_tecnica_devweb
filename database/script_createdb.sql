-- MySQL/MariaDB Script adaptado
-- Compatible con MariaDB 10.4.x

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Prueba_Tecnica_DB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Prueba_Tecnica_DB` DEFAULT CHARACTER SET utf8;
USE `Prueba_Tecnica_DB`;

-- -----------------------------------------------------
-- Table `budget_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `budget_items` (
  `id_budget_item` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`id_budget_item`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projects` (
  `id_project` INT NOT NULL AUTO_INCREMENT,
  `project_name` VARCHAR(50) NOT NULL,
  `municipality` VARCHAR(100) NOT NULL,
  `department` VARCHAR(50) NOT NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NULL,
  PRIMARY KEY (`id_project`),
  UNIQUE KEY `project_name_UNIQUE` (`project_name`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `donors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `donors` (
  `id_donor` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`id_donor`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `donations_allocations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `donations_allocations` (
  `id_allocations` INT NOT NULL AUTO_INCREMENT,
  `donors_id_donor` INT NOT NULL,
  `projects_id_project` INT NOT NULL,
  `budget_items_id_budget_item` INT NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id_allocations`),
  KEY `fk_budget_projects_projects1_idx` (`projects_id_project`),
  KEY `fk_donations_allocations_budget_items1_idx` (`budget_items_id_budget_item`),
  KEY `fk_donations_allocations_donors1_idx` (`donors_id_donor`),
  CONSTRAINT `fk_budget_projects_projects1`
    FOREIGN KEY (`projects_id_project`)
    REFERENCES `projects` (`id_project`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_donations_allocations_budget_items1`
    FOREIGN KEY (`budget_items_id_budget_item`)
    REFERENCES `budget_items` (`id_budget_item`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_donations_allocations_donors1`
    FOREIGN KEY (`donors_id_donor`)
    REFERENCES `donors` (`id_donor`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `suppliers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id_suppliers` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`id_suppliers`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `purchase_orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `id_purchase_order` INT NOT NULL AUTO_INCREMENT,
  `total_amount` DECIMAL(10,2) NOT NULL,
  `order_date` DATETIME NOT NULL,
  `projects_id_project` INT NOT NULL,
  `suppliers_id_suppliers` INT NOT NULL,
  PRIMARY KEY (`id_purchase_order`),
  KEY `fk_purchase_orders_projects1_idx` (`projects_id_project`),
  KEY `fk_purchase_orders_suppliers1_idx` (`suppliers_id_suppliers`),
  CONSTRAINT `fk_purchase_orders_projects1`
    FOREIGN KEY (`projects_id_project`)
    REFERENCES `projects` (`id_project`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_orders_suppliers1`
    FOREIGN KEY (`suppliers_id_suppliers`)
    REFERENCES `suppliers` (`id_suppliers`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `purchase_order_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `purchase_order_details` (
  `id_purchase_order_details` INT NOT NULL AUTO_INCREMENT,
  `budget_items_id_budget_item` INT NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `purchase_orders_id_purchase_order` INT NOT NULL,
  PRIMARY KEY (`id_purchase_order_details`),
  KEY `fk_purchase_order_details_budget_items1_idx` (`budget_items_id_budget_item`),
  KEY `fk_purchase_order_details_purchase_orders1_idx` (`purchase_orders_id_purchase_order`),
  CONSTRAINT `fk_purchase_order_details_budget_items1`
    FOREIGN KEY (`budget_items_id_budget_item`)
    REFERENCES `budget_items` (`id_budget_item`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_order_details_purchase_orders1`
    FOREIGN KEY (`purchase_orders_id_purchase_order`)
    REFERENCES `purchase_orders` (`id_purchase_order`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
