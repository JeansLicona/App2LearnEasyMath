SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(50) NOT NULL ,
  `usuario` VARCHAR(50) NOT NULL ,
  `contrasena` VARCHAR(35) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mensaje`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mensaje` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `usuario_id` INT UNSIGNED NOT NULL ,
  `mensaje` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuario_mensaje_usuario_1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_mensaje_usuario`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
