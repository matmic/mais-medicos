DELETE FROM objetopesquisa;
DELETE FROM tipoanalise;
DELETE FROM tipoobjetivo;
DELETE FROM tipoprocedimento;
DELETE FROM abrangencia;
DELETE FROM unidadefederacao;

INSERT INTO objetopesquisa (CodObjetoPesquisa, NomeObjetoPesquisa, CodObjetoPesquisaPai) Values(1,'Programa Mais Médicos', NULL);
INSERT INTO objetopesquisa (CodObjetoPesquisa, NomeObjetoPesquisa, CodObjetoPesquisaPai) Values(2,'Provimento emergencial de médicos', NULL);
INSERT INTO objetopesquisa (CodObjetoPesquisa, NomeObjetoPesquisa, CodObjetoPesquisaPai) Values(3,'Formação de médicos', NULL);  
INSERT INTO objetopesquisa (CodObjetoPesquisa, NomeObjetoPesquisa, CodObjetoPesquisaPai) Values(4,'Expandir a (i) infraestrutura física e da (ii) oferta de saúde', NULL);
INSERT INTO objetopesquisa (CodObjetoPesquisa, NomeObjetoPesquisa, CodObjetoPesquisaPai) Values(5,'Outros', NULL);


INSERT INTO tipoanalise (CodTipoAnalise, NomeTipoAnalise) Values(1,'Quantitativas');
INSERT INTO tipoanalise (CodTipoAnalise, NomeTipoAnalise) Values(2,'Qualitativas');
INSERT INTO tipoanalise (CodTipoAnalise, NomeTipoAnalise) Values(3,'Triangulação');  
INSERT INTO tipoanalise (CodTipoAnalise, NomeTipoAnalise) Values(4,'Outros');


INSERT INTO tipoobjetivo (CodTipoObjetivo, NomeTipoObjetivo) Values(1,'Exploratório');
INSERT INTO tipoobjetivo (CodTipoObjetivo, NomeTipoObjetivo) Values(2,'Descritiva');
INSERT INTO tipoobjetivo (CodTipoObjetivo, NomeTipoObjetivo) Values(3,'Explicativa');


INSERT INTO tipoprocedimento (CodTipoProcedimento, NomeTipoProcedimento) Values(1,'Bibliográfico');
INSERT INTO tipoprocedimento (CodTipoProcedimento, NomeTipoProcedimento) Values(2,'Documental');
INSERT INTO tipoprocedimento (CodTipoProcedimento, NomeTipoProcedimento) Values(3,'Campo');


INSERT INTO abrangencia (CodAbrangencia, NomeAbrangencia) Values(1,'Local');
INSERT INTO abrangencia (CodAbrangencia, NomeAbrangencia) Values(2,'Regional');
INSERT INTO abrangencia (CodAbrangencia, NomeAbrangencia) Values(3,'Nacional');
INSERT INTO abrangencia (CodAbrangencia, NomeAbrangencia) Values(4,'Internacional');


INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(12,'AC','Acre');  
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(27,'AL','Alagoas');  
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(13,'AM','Amazonas');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(16,'AP','Amapá');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(29,'BA','Bahia');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(23,'CE','Ceará');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(53,'DF','Distrito Federal');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(32,'ES','Espírito Santo');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(52,'GO','Goiás');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(21,'MA','Maranhão');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(31,'MG','Minas Gerais');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(50,'MS','Mato Grosso do Sul');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(51,'MT','Mato Grosso');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(15,'PA','Pará');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(25,'PB','Paraíba');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(26,'PE','Pernambuco');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(22,'PI','Piauí');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(41,'PR','Paraná');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(33,'RJ','Rio de Janeiro');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(24,'RN','Rio Grande do Norte');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(11,'RO','Rondônia');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(14,'RR','Roraima');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(43,'RS','Rio Grande do Sul');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(42,'SC','Santa Catarina');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(28,'SE','Sergipe');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(35,'SP','São Paulo');
INSERT INTO unidadefederacao (CodUF, SiglaUF, NomeUF) Values(17,'TO','Tocantins');