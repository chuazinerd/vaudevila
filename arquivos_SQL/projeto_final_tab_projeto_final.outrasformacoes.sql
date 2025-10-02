CREATE TABLE IF NOT EXISTS projeto_final.outrasformacoes (
  idoutrasformacoes INT(11) NOT NULL AUTO_INCREMENT,
  idusuario INT(11) NOT NULL,
  inicio DATE NULL DEFAULT NULL,
  fim DATE NULL DEFAULT NULL,
  descricao VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (idoutrasformacoes),
  INDEX idusuario_idx (idusuario ASC),
  CONSTRAINT fk_idUsuario
    FOREIGN KEY (idusuario)
    REFERENCES projeto_final.usuario (idusuario)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

