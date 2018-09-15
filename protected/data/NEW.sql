-- ****************** SqlDBM: MySQL ******************;
-- ***************************************************;

DROP DATABASE tcc;

CREATE DATABASE tcc;

USE tcc;

-- ************************************** `Usuario`

CREATE TABLE `Usuario`
(
 `CodUsuario`   INT NOT NULL ,
 `NomeUsuario`  VARCHAR(100) NOT NULL ,
 `EmailUsuario` VARCHAR(45) NOT NULL ,
 `SenhaUsuario` VARCHAR(255) NOT NULL ,

PRIMARY KEY (`CodUsuario`),
UNIQUE KEY `Ind_233` (`EmailUsuario`)
);






-- ************************************** `UnidadeFederacao`

CREATE TABLE `UnidadeFederacao`
(
 `CodUF`   INT NOT NULL ,
 `NomeUF`  VARCHAR(30) NOT NULL ,
 `SiglaUF` VARCHAR(2) NOT NULL ,

PRIMARY KEY (`CodUF`)
);






-- ************************************** `Autor`

CREATE TABLE `Autor`
(
 `CodAutor`  INT NOT NULL ,
 `NomeAutor` VARCHAR(200) NOT NULL ,

PRIMARY KEY (`CodAutor`)
);






-- ************************************** `Palavra`

CREATE TABLE `Palavra`
(
 `CodPalavra`  INT NOT NULL ,
 `NomePalavra` VARCHAR(100) NOT NULL ,

PRIMARY KEY (`CodPalavra`)
);






-- ************************************** `Coordenador`

CREATE TABLE `Coordenador`
(
 `CodCoordenador`  INT NOT NULL ,
 `NomeCoordenador` VARCHAR(200) NOT NULL ,

PRIMARY KEY (`CodCoordenador`)
);






-- ************************************** `Abrangencia`

CREATE TABLE `Abrangencia`
(
 `CodAbrangencia`  INT NOT NULL ,
 `NomeAbrangencia` VARCHAR(100) NOT NULL ,

PRIMARY KEY (`CodAbrangencia`)
);






-- ************************************** `TipoProcedimento`

CREATE TABLE `TipoProcedimento`
(
 `CodTipoProcedimento`  INT NOT NULL ,
 `NomeTipoProcedimento` VARCHAR(100) NOT NULL ,
 `IndicadorExclusao`    VARCHAR(1) ,

PRIMARY KEY (`CodTipoProcedimento`)
);






-- ************************************** `TipoObjetivo`

CREATE TABLE `TipoObjetivo`
(
 `CodTipoObjetivo`   INT NOT NULL ,
 `NomeTipoObjetivo`  VARCHAR(100) NOT NULL ,
 `IndicadorExclusao` VARCHAR(1) ,

PRIMARY KEY (`CodTipoObjetivo`)
);






-- ************************************** `TipoAnalise`

CREATE TABLE `TipoAnalise`
(
 `CodTipoAnalise`    INT NOT NULL ,
 `NomeTipoAnalise`   VARCHAR(100) NOT NULL ,
 `IndicadorExclusao` VARCHAR(1) ,

PRIMARY KEY (`CodTipoAnalise`)
);






-- ************************************** `ObjetoPesquisa`

CREATE TABLE `ObjetoPesquisa`
(
 `CodObjetoPesquisa`    INT NOT NULL ,
 `NomeObjetoPesquisa`   VARCHAR(100) NOT NULL ,
 `CodObjetoPesquisaPai` INT ,
 `IndicadorExclusao`    VARCHAR(1) ,

PRIMARY KEY (`CodObjetoPesquisa`),
KEY `fkIdx_164` (`CodObjetoPesquisaPai`),
CONSTRAINT `FK_164` FOREIGN KEY `fkIdx_164` (`CodObjetoPesquisaPai`) REFERENCES `ObjetoPesquisa` (`CodObjetoPesquisa`)
);






-- ************************************** `Artigo`

CREATE TABLE `Artigo`
(
 `CodArtigo`           INT NOT NULL ,
 `Resumo`              VARCHAR(2000) NOT NULL ,
 `Multicentrico`       VARCHAR(1) NOT NULL ,
 `DataInicioEstudo`    DATE NOT NULL ,
 `DataFimEstudo`       DATE NOT NULL ,
 `DataInsercao`        DATETIME NOT NULL ,
 `DataUltimaAtu`       DATETIME NOT NULL ,
 `CodAbrangencia`      INT NOT NULL ,
 `CodObjetoPesquisa`   INT NOT NULL ,
 `NomeArtigo`          VARCHAR(300) NOT NULL ,
 `RevistaConferencia`  VARCHAR(300) NOT NULL ,
 `Volume`              VARCHAR(45) ,
 `AnoPublicacao`       YEAR NOT NULL ,
 `CodUsuarioInsercao`  INT NOT NULL ,
 `CodUsuarioUltimaAtu` INT NOT NULL ,

PRIMARY KEY (`CodArtigo`),
KEY `fkIdx_99` (`CodAbrangencia`),
CONSTRAINT `FK_99` FOREIGN KEY `fkIdx_99` (`CodAbrangencia`) REFERENCES `Abrangencia` (`CodAbrangencia`),
KEY `fkIdx_103` (`CodObjetoPesquisa`),
CONSTRAINT `FK_103` FOREIGN KEY `fkIdx_103` (`CodObjetoPesquisa`) REFERENCES `ObjetoPesquisa` (`CodObjetoPesquisa`),
KEY `fkIdx_215` (`CodUsuarioInsercao`),
CONSTRAINT `FK_215` FOREIGN KEY `fkIdx_215` (`CodUsuarioInsercao`) REFERENCES `Usuario` (`CodUsuario`),
KEY `fkIdx_218` (`CodUsuarioUltimaAtu`),
CONSTRAINT `FK_218` FOREIGN KEY `fkIdx_218` (`CodUsuarioUltimaAtu`) REFERENCES `Usuario` (`CodUsuario`)
);






-- ************************************** `Instituicao`

CREATE TABLE `Instituicao`
(
 `CodInstituicao`   INT NOT NULL ,
 `NomeInstituicao`  VARCHAR(200) NOT NULL ,
 `SiglaInstituicao` VARCHAR(20) ,
 `CodUF`            INT NOT NULL ,

PRIMARY KEY (`CodInstituicao`),
KEY `fkIdx_195` (`CodUF`),
CONSTRAINT `FK_195` FOREIGN KEY `fkIdx_195` (`CodUF`) REFERENCES `UnidadeFederacao` (`CodUF`)
);






-- ************************************** `ArtigoCoordenador`

CREATE TABLE `ArtigoCoordenador`
(
 `CodArtigo`      INT NOT NULL ,
 `CodCoordenador` INT NOT NULL ,

PRIMARY KEY (`CodArtigo`, `CodCoordenador`),
KEY `fkIdx_235` (`CodArtigo`),
CONSTRAINT `FK_235` FOREIGN KEY `fkIdx_235` (`CodArtigo`) REFERENCES `Artigo` (`CodArtigo`),
KEY `fkIdx_239` (`CodCoordenador`),
CONSTRAINT `FK_239` FOREIGN KEY `fkIdx_239` (`CodCoordenador`) REFERENCES `Coordenador` (`CodCoordenador`)
);






-- ************************************** `ArtigoPalavra`

CREATE TABLE `ArtigoPalavra`
(
 `CodArtigo`  INT NOT NULL ,
 `CodPalavra` INT NOT NULL ,

PRIMARY KEY (`CodArtigo`, `CodPalavra`),
KEY `fkIdx_222` (`CodArtigo`),
CONSTRAINT `FK_222` FOREIGN KEY `fkIdx_222` (`CodArtigo`) REFERENCES `Artigo` (`CodArtigo`),
KEY `fkIdx_226` (`CodPalavra`),
CONSTRAINT `FK_226` FOREIGN KEY `fkIdx_226` (`CodPalavra`) REFERENCES `Palavra` (`CodPalavra`)
);






-- ************************************** `ArtigoAutor`

CREATE TABLE `ArtigoAutor`
(
 `CodArtigo` INT NOT NULL ,
 `CodAutor`  INT NOT NULL ,

PRIMARY KEY (`CodArtigo`, `CodAutor`),
KEY `fkIdx_179` (`CodArtigo`),
CONSTRAINT `FK_179` FOREIGN KEY `fkIdx_179` (`CodArtigo`) REFERENCES `Artigo` (`CodArtigo`),
KEY `fkIdx_184` (`CodAutor`),
CONSTRAINT `FK_184` FOREIGN KEY `fkIdx_184` (`CodAutor`) REFERENCES `Autor` (`CodAutor`)
);






-- ************************************** `ArtigoInstituicao`

CREATE TABLE `ArtigoInstituicao`
(
 `CodArtigo`      INT NOT NULL ,
 `CodInstituicao` INT NOT NULL ,

PRIMARY KEY (`CodArtigo`, `CodInstituicao`),
KEY `fkIdx_120` (`CodArtigo`),
CONSTRAINT `FK_120` FOREIGN KEY `fkIdx_120` (`CodArtigo`) REFERENCES `Artigo` (`CodArtigo`),
KEY `fkIdx_125` (`CodInstituicao`),
CONSTRAINT `FK_125` FOREIGN KEY `fkIdx_125` (`CodInstituicao`) REFERENCES `Instituicao` (`CodInstituicao`)
);






-- ************************************** `ArtigoTipoObjetivo`

CREATE TABLE `ArtigoTipoObjetivo`
(
 `CodArtigo`       INT NOT NULL ,
 `CodTipoObjetivo` INT NOT NULL ,

PRIMARY KEY (`CodArtigo`, `CodTipoObjetivo`),
KEY `fkIdx_109` (`CodArtigo`),
CONSTRAINT `FK_109` FOREIGN KEY `fkIdx_109` (`CodArtigo`) REFERENCES `Artigo` (`CodArtigo`),
KEY `fkIdx_114` (`CodTipoObjetivo`),
CONSTRAINT `FK_114` FOREIGN KEY `fkIdx_114` (`CodTipoObjetivo`) REFERENCES `TipoObjetivo` (`CodTipoObjetivo`)
);






-- ************************************** `ArtigoTipoProcedimento`

CREATE TABLE `ArtigoTipoProcedimento`
(
 `CodArtigo`           INT NOT NULL ,
 `CodTipoProcedimento` INT NOT NULL ,

PRIMARY KEY (`CodArtigo`, `CodTipoProcedimento`),
KEY `fkIdx_75` (`CodArtigo`),
CONSTRAINT `FK_75` FOREIGN KEY `fkIdx_75` (`CodArtigo`) REFERENCES `Artigo` (`CodArtigo`),
KEY `fkIdx_80` (`CodTipoProcedimento`),
CONSTRAINT `FK_80` FOREIGN KEY `fkIdx_80` (`CodTipoProcedimento`) REFERENCES `TipoProcedimento` (`CodTipoProcedimento`)
);






-- ************************************** `ArtigoTipoAnalise`

CREATE TABLE `ArtigoTipoAnalise`
(
 `CodArtigo`      INT NOT NULL ,
 `CodTipoAnalise` INT NOT NULL ,

PRIMARY KEY (`CodArtigo`, `CodTipoAnalise`),
KEY `fkIdx_47` (`CodTipoAnalise`),
CONSTRAINT `FK_47` FOREIGN KEY `fkIdx_47` (`CodTipoAnalise`) REFERENCES `TipoAnalise` (`CodTipoAnalise`),
KEY `fkIdx_66` (`CodArtigo`),
CONSTRAINT `FK_66` FOREIGN KEY `fkIdx_66` (`CodArtigo`) REFERENCES `Artigo` (`CodArtigo`)
);





