-- Remove o schema anterior, caso exista (CUIDADO: isso apaga tudo nele!)
DROP SCHEMA IF EXISTS `projeto_final`;

-- Cria o schema novamente
CREATE SCHEMA IF NOT EXISTS `projeto_final` DEFAULT CHARACTER SET latin1;
USE `projeto_final`;

-- Criação da tabela `usuario`
CREATE TABLE `usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) DEFAULT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `dataNascimento` DATE DEFAULT NULL,
  `email` VARCHAR(150) DEFAULT NULL,
  `senha` VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Criação da tabela `formacaoAcademica`
CREATE TABLE `formacaoAcademica` (
  `idformacaoAcademica` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `inicio` DATE NOT NULL,
  `fim` DATE DEFAULT NULL,
  `descricao` VARCHAR(150) DEFAULT NULL,
  PRIMARY KEY (`idformacaoAcademica`),
  KEY `IDUSUARIO_idx` (`idusuario`),
  CONSTRAINT `fk_formacao_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

