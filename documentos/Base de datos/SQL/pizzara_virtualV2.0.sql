SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `alumno`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `alumno` (
  `id_alumno` INT NOT NULL AUTO_INCREMENT ,
  `nombres` VARCHAR(75) NOT NULL ,
  `apellidos` VARCHAR(75) NOT NULL ,
  `matricula` VARCHAR(45) NOT NULL ,
  `institucion` VARCHAR(45) NOT NULL ,
  `fecha_nacimiento` DATE NOT NULL ,
  `fecha_ingreso` DATE NOT NULL ,
  `correo` VARCHAR(45) NOT NULL ,
  `info_adicional` TEXT NOT NULL ,
  PRIMARY KEY (`id_alumno`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tutor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tutor` (
  `id_tutor` INT NOT NULL AUTO_INCREMENT ,
  `nombres` VARCHAR(75) NOT NULL ,
  `apellidos` VARCHAR(75) NOT NULL ,
  `seccion` VARCHAR(45) NOT NULL ,
  `fecha_nacimiento` DATE NOT NULL ,
  `fecha_ingreso` DATE NOT NULL ,
  `correo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_tutor`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `usuario` INT NOT NULL ,
  `nombre_usuario` VARCHAR(45) NOT NULL ,
  `contraseña` VARCHAR(100) NOT NULL ,
  `tipo_usuario` INT NOT NULL ,
  PRIMARY KEY (`id_usuario`) ,
  INDEX `fk_usuario_tutor_idx` (`usuario` ASC) ,
  CONSTRAINT `fk_usuario_tutor`
    FOREIGN KEY (`usuario` )
    REFERENCES `tutor` (`id_tutor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_alumno`
    FOREIGN KEY (`usuario` )
    REFERENCES `alumno` (`id_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tarea` (
  `id_tarea` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` TEXT NOT NULL ,
  `responsable` INT NOT NULL ,
  PRIMARY KEY (`id_tarea`) ,
  INDEX `fk_tutor_tarea_idx` (`responsable` ASC) ,
  CONSTRAINT `fk_tutor_tarea`
    FOREIGN KEY (`responsable` )
    REFERENCES `tutor` (`id_tutor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `plan` (
  `id_plan` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(75) NOT NULL ,
  `fecha_creacion` DATE NOT NULL ,
  `carpeta_material` TEXT NOT NULL ,
  `plan_procedente` VARCHAR(75) NOT NULL ,
  `tarea` INT NOT NULL ,
  PRIMARY KEY (`id_plan`) ,
  INDEX `fK_plan_tarea_idx` (`tarea` ASC) ,
  CONSTRAINT `fK_plan_tarea`
    FOREIGN KEY (`tarea` )
    REFERENCES `tarea` (`id_tarea` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grupo` (
  `id_grupo` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(75) NOT NULL ,
  `fecha_creacion` DATE NOT NULL ,
  `fecha_desintegracion` DATE NOT NULL ,
  `plan` INT NOT NULL ,
  `tutor` INT NOT NULL ,
  `pizarra` TEXT NULL ,
  PRIMARY KEY (`id_grupo`) ,
  INDEX `fk_tutor_grupo_idx` (`tutor` ASC) ,
  INDEX `fk_plan_grupo_idx` (`plan` ASC) ,
  CONSTRAINT `fk_tutor_grupo`
    FOREIGN KEY (`tutor` )
    REFERENCES `tutor` (`id_tutor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plan_grupo`
    FOREIGN KEY (`plan` )
    REFERENCES `plan` (`id_plan` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clase`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clase` (
  `id_clase` INT NOT NULL ,
  `grupo` INT NOT NULL ,
  `alumno` INT NOT NULL ,
  PRIMARY KEY (`id_clase`) ,
  INDEX `fk_grupo_clase_idx` (`grupo` ASC) ,
  INDEX `fk_alumno_clase_idx` (`alumno` ASC) ,
  CONSTRAINT `fk_grupo_clase`
    FOREIGN KEY (`grupo` )
    REFERENCES `grupo` (`id_grupo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumno_clase`
    FOREIGN KEY (`alumno` )
    REFERENCES `alumno` (`id_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Chat`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Chat` (
  `id_Chat` INT NOT NULL ,
  `mensaje` TEXT NULL ,
  `alumno` INT NOT NULL ,
  `grupo` INT NULL ,
  `fecha` DATETIME NULL ,
  PRIMARY KEY (`id_Chat`) ,
  INDEX `fk_Chat_alumno1_idx` (`alumno` ASC) ,
  INDEX `fk_Chat_grupo1_idx` (`grupo` ASC) ,
  CONSTRAINT `fk_Chat_alumno1`
    FOREIGN KEY (`alumno` )
    REFERENCES `alumno` (`id_alumno` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Chat_grupo1`
    FOREIGN KEY (`grupo` )
    REFERENCES `grupo` (`id_grupo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Archivos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Archivos` (
  `id_Archivos` INT NOT NULL ,
  `url` TEXT NULL ,
  `grupo` INT NOT NULL ,
  PRIMARY KEY (`id_Archivos`) ,
  INDEX `fk_Archivos_grupo1_idx` (`grupo` ASC) ,
  CONSTRAINT `fk_Archivos_grupo1`
    FOREIGN KEY (`grupo` )
    REFERENCES `grupo` (`id_grupo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
