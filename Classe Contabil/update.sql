CREATE TABLE `classev3`.`noticia_comentario` (
`idComentario` INT NOT NULL AUTO_INCREMENT ,
`idNoticia` INT NOT NULL ,
`comentario` MEDIUMTEXT NOT NULL ,
PRIMARY KEY ( `idComentario` )
)