-- MySQL Script generated by MySQL Workbench
-- Thu May 16 13:24:05 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projetoVan
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projetoVan
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projetoVan` DEFAULT CHARACTER SET utf8 ;
USE `projetoVan` ;

-- -----------------------------------------------------
-- Table `projetoVan`.`Motorista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Motorista` (
  `idMotorista` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `telefone` CHAR(11) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  `mensalidade` DECIMAL(3,2) NOT NULL,
  `dataNascimento` DATETIME NOT NULL,
  PRIMARY KEY (`idMotorista`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetoVan`.`Responsavel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Responsavel` (
  `idResponsavel` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `telefone` CHAR(11) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`idResponsavel`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetoVan`.`Endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Endereco` (
  `idEndereco` INT NOT NULL AUTO_INCREMENT,
  `logradouro` VARCHAR(50) NOT NULL,
  `numero` INT NOT NULL,
  `complemento` VARCHAR(30) NOT NULL,
  `bairro` VARCHAR(75) NOT NULL,
  `cidade` VARCHAR(75) NOT NULL,
  `cep` CHAR(8) NOT NULL,
  PRIMARY KEY (`idEndereco`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetoVan`.`Escola`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Escola` (
  `idEscola` INT NOT NULL,
  `nome` VARCHAR(75) NOT NULL,
  `Endereco_idEndereco` INT NOT NULL,
  PRIMARY KEY (`idEscola`),
  INDEX `fk_Escola_Endereco1_idx` (`Endereco_idEndereco` ASC) VISIBLE,
  CONSTRAINT `fk_Escola_Endereco1`
    FOREIGN KEY (`Endereco_idEndereco`)
    REFERENCES `projetoVan`.`Endereco` (`idEndereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetoVan`.`Aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Aluno` (
  `idAluno` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `dataNascimento` DATE NOT NULL,
  `idEndereco` INT NOT NULL,
  `idResponsavel` INT NOT NULL,
  `idEscola` INT NOT NULL,
  PRIMARY KEY (`idAluno`),
  INDEX `fk_Aluno_Endereco1_idx` (`idEndereco` ASC) VISIBLE,
  INDEX `fk_Aluno_Responsavel1_idx` (`idResponsavel` ASC) VISIBLE,
  INDEX `fk_Aluno_Escola1_idx` (`idEscola` ASC) VISIBLE,
  CONSTRAINT `fk_Aluno_Endereco1`
    FOREIGN KEY (`idEndereco`)
    REFERENCES `projetoVan`.`Endereco` (`idEndereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aluno_Responsavel1`
    FOREIGN KEY (`idResponsavel`)
    REFERENCES `projetoVan`.`Responsavel` (`idResponsavel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aluno_Escola1`
    FOREIGN KEY (`idEscola`)
    REFERENCES `projetoVan`.`Escola` (`idEscola`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetoVan`.`Veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Veiculo` (
  `idVeiculo` INT NOT NULL AUTO_INCREMENT,
  `placa` CHAR(7) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `capacidade` INT UNSIGNED NOT NULL,
  `ano` YEAR NOT NULL,
  `marca` VARCHAR(45) NOT NULL,
  `idMotorista` INT NOT NULL,
  PRIMARY KEY (`idVeiculo`),
  INDEX `fk_Veiculo_Motorista_idx` (`idMotorista` ASC) VISIBLE,
  CONSTRAINT `fk_Veiculo_Motorista`
    FOREIGN KEY (`idMotorista`)
    REFERENCES `projetoVan`.`Motorista` (`idMotorista`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetoVan`.`Horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Horario` (
  `idHorario` INT NOT NULL AUTO_INCREMENT,
  `horarioPartida` TIME NOT NULL,
  `horarioChegada` TIME NOT NULL,
  `turno` VARCHAR(30) NOT NULL,
  `idMotorista` INT NOT NULL,
  PRIMARY KEY (`idHorario`),
  INDEX `fk_Horario_Motorista1_idx` (`idMotorista` ASC) VISIBLE,
  CONSTRAINT `fk_Horario_Motorista1`
    FOREIGN KEY (`idMotorista`)
    REFERENCES `projetoVan`.`Motorista` (`idMotorista`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetoVan`.`Motorista_Escola`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Motorista_Escola` (
  `Motorista_idMotorista` INT NOT NULL,
  `Escola_idEscola` INT NOT NULL,
  PRIMARY KEY (`Motorista_idMotorista`, `Escola_idEscola`),
  INDEX `fk_Motorista_has_Escola_Escola1_idx` (`Escola_idEscola` ASC) VISIBLE,
  INDEX `fk_Motorista_has_Escola_Motorista1_idx` (`Motorista_idMotorista` ASC) VISIBLE,
  CONSTRAINT `fk_Motorista_has_Escola_Motorista1`
    FOREIGN KEY (`Motorista_idMotorista`)
    REFERENCES `projetoVan`.`Motorista` (`idMotorista`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Motorista_has_Escola_Escola1`
    FOREIGN KEY (`Escola_idEscola`)
    REFERENCES `projetoVan`.`Escola` (`idEscola`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetoVan`.`Aluno_Horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVan`.`Aluno_Horario` (
  `idHorario` INT NOT NULL,
  `idAluno` INT NOT NULL,
  PRIMARY KEY (`idHorario`, `idAluno`),
  INDEX `fk_Horario_has_Aluno_Aluno1_idx` (`idAluno` ASC) VISIBLE,
  INDEX `fk_Horario_has_Aluno_Horario1_idx` (`idHorario` ASC) VISIBLE,
  CONSTRAINT `fk_Horario_has_Aluno_Horario1`
    FOREIGN KEY (`idHorario`)
    REFERENCES `projetoVan`.`Horario` (`idHorario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Horario_has_Aluno_Aluno1`
    FOREIGN KEY (`idAluno`)
    REFERENCES `projetoVan`.`Aluno` (`idAluno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
