-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: bdlivre.ufrgs.br
-- Tempo de geração: 20/10/2018 às 11:04
-- Versão do servidor: 5.5.31
-- Versão do PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pmmpub`
--

-- --------------------------------------------------------
INSERT INTO `Usuario` (`CodUsuario`, `NomeUsuario`, `EmailUsuario`, `SenhaUsuario`, `IndicadorExclusao`) VALUES
(1, 'Matheus Michel', 'admin@admin.com', '$2y$10$UmagW5DtwAWsYS1omM2PAuRZ9yl72PkyMWHgmWSOrrgKEkjM4/avW', NULL),
(2, 'Renata Galante', 'teste@teste.com', '$2y$10$skCvWr63wPVo716BPbi9Xumja9CdNVVx3P5VASPWuvZ9MB8wNXws6', NULL);

INSERT INTO `Autor` (`CodAutor`, `NomeAutor`) VALUES
(1, 'Michel'),
(2, 'Viviane Karoline da Silva Carvalho'),
(3, 'Carla Pinta Marques'),
(4, 'Everton Nunes da Silva'),
(5, 'Andreia Carrer'),
(6, 'Yamila Comes'),
(7, 'Yamila Comes'),
(8, 'Rebeca Maria de Medeiros Vieira'),
(9, 'Tiago Rocha Pinto'),
(10, 'Lucas Pereira de Melo');


INSERT INTO `Coordenador` (`CodCoordenador`, `NomeCoordenador`) VALUES
(1, 'Matheus'),
(2, 'Yamila Comes'),
(3, ' Josélia de Souza Trindade'),
(4, ' Helena Eri Shimizu'),
(5, ' Edgar Merchan Hamann'),
(6, ' Florencia Bargioni'),
(7, ' Loana Ramirez'),
(8, ' Mauro Niskier Sanchez'),
(9, ' Leonor Maria Pacheco Santos'),
(10, 'Yamila Comes'),
(11, ' Josélia de Souza Trindade'),
(12, ' Helena Eri Shimizu'),
(13, ' Edgar Merchan Hamann'),
(14, ' Florencia Bargioni'),
(15, ' Loana Ramirez'),
(16, ' Mauro Niskier Sanchez'),
(17, ' Leonor Maria Pacheco Santos'),
(18, 'Yamila Comes'),
(19, ' Josélia de Souza Trindade'),
(20, ' Vanira Matos Pessoa'),
(21, ' Ivana Cristina de Holanda Cunha Barreto'),
(22, ' Helena Eri Shimizu'),
(23, ' Diego Dewes'),
(24, ' Carlos André Moura Arruda'),
(25, ' Leonor Maria Pacheco Santos');


INSERT INTO `Palavra` (`CodPalavra`, `NomePalavra`) VALUES
(3, ' Atração'),
(4, ' Provimento de profissionais de saúde'),
(5, ' Médicos rurais'),
(6, 'Escassez de médicos'),
(7, 'Distribuição desigual'),
(8, 'Retenção e recrutamento de força de trabalho'),
(9, 'Atenção Primária à Saúde'),
(10, ' Enfermeiros'),
(11, 'Avaliação de serviços de saúde'),
(12, 'Médicos de atenção primária'),
(13, 'Distribuição de médicos'),
(14, ' Atenção Primaria à Saúde'),
(15, ' Qualidade'),
(16, ' acesso e avaliação da assistência á saúde'),
(17, ' Satisfação dos usuários'),
(18, 'Distribuição de médicos'),
(19, ' Atenção Primaria à Saúde'),
(20, ' Qualidade'),
(21, ' acesso e avaliação da assistência á saúde'),
(22, ' Satisfação dos usuários'),
(23, 'Integralidade em saúde'),
(24, ' Estratégia Saúde da Família'),
(25, ' Programas nacionais de saúde'),
(26, ' Sistema Único de Saúde'),
(27, 'Educação Médica'),
(28, ' Narrativa e Memória'),
(29, ' Currículo'),
(30, ' Programa Mais Médicos'),
(31, ' Ensino Baseado na Comunidade');

INSERT INTO `Artigo` (`CodArtigo`, `Resumo`, `IndicadorMulticentrico`, `DataInicioEstudo`, `DataFimEstudo`, `DataInsercao`, `DataUltimaAtu`, `CodAbrangencia`, `CodObjetoPesquisa`, `NomeArtigo`, `NomeRevistaConferencia`, `Volume`, `AnoPublicacao`, `CodUsuarioInsercao`, `CodUsuarioUltimaAtu`, `IndicadorRevistaConferencia`, `Paginas`) VALUES
(1, 'Este estudo tem como objetivo analisar se o Programa Mais Médicos (PMM) contemplou as recomendações da Organização Mundial da\r\nSaúde (OMS) relacionadas ao aprimoramento da atração, do recrutamento e da retenção de profissionais de saúde em áreas remotas e rurais.\r\nTrata-se de um estudo descritivo, qualitativo, baseado em análise documental, no intuito de comparar se as recomendações publicadas em 2010 pela OMS foram contempladas na Lei 12.871/13, que instituiu o PMM. Ao total, foram sistematizadas 16 recomendações da OMS, para as quais o PMM atendeu a 37,5%. Entre as recomendações não contempladas, encontram-se a ausência de programas de desenvolvimento da carreira e de medidas de reconhecimento público. Algumas recomendações que não foram atendidas pela PMM já estavam sendo desenvolvidas, tais como o Programa Nacional de Bolsa Permanência para estudantes de nível superior e a inserção de diferentes profissionais de saúde no SUS (Estratégia Saúde da Família). O programa apresenta fatores inovadores, como a mudança curricular do curso\r\nde medicina e o serviço médico obrigatório, entretanto, poderia ter feito mais investimentos na categoria de apoio pessoal e profissional.', 'S', '2016-01-01', '2016-12-31', '2018-10-11 12:49:37', '2018-10-19 18:47:49', 3, 1, 'A contribuição do Programa Mais Médicos: análise a partir das recomendações da OMS para provimento de médicos', 'Ciência e Saúde Coletiva', '21', 2016, 1, 1, 'R', '2773-2784'),
(2, 'Após dois anos de implantação do Programa Mais Médicos no país, estudar sua viabilidade faz-se necessário. Esta pesquisa teve como objetivo avaliar a efetividade da assistência oferecida na atenção primária, segundo a ótica dos profissionais de saúde, comparando-se unidades com e sem médicos do Programa Mais Médicos. Pesquisa quantitativa que utilizou para coleta de dados, o instrumento Primary Care Assesment Tool – Brasil, versão para profissionais de saúde, na totalidade das unidades de saúde da família, em município de médio porte, no interior do Paraná, de novembro de 2015 a fevereiro de 2016. Abrangeu 72 profissionais, 47 alocados em unidades da estratégia saúde da família e 25 nessas unidades contendo o programa. Os resultados evidenciaram que os escores dos atributos essencial (6,93) e geral (7,10) obtiveram valores considerados orientados aos preceitos da atenção primária, em ambas as unidades. Contudo, a acessibilidade\r\n(4,17), em ambas as unidades e coordenação – sistema de informações (6,57), em unidades com o Programa Mais Médicos, não atingiram avaliação satisfatória, o que remete à necessidade de alteração na organização da estratégia saúde da família, independente da implantação desse programa.', 'N', '2015-01-01', '2016-12-31', '2018-10-19 21:33:15', '2018-10-19 21:34:00', 1, 2, 'Efetividade da Estratégia Saúde da Família em unidades com e sem Programa Mais Médicos em município no oeste do Paraná', ' Ciência e Saúde Coletiva', '21', 2016, 1, 1, 'R', '2849-2860'),
(3, 'A finalidade do Programa Mais Médicos é diminuir a carência de médicos e reduzir as desigualdades regionais no acesso à atenção à saúde.\r\nO estudo objetivou avaliar a satisfação dos usuários com os médicos do Programa e a responsividade destes serviços de saúde. Estudo transversal descritivo realizado em 32 municípios com 20% ou mais de extrema pobreza com 263 usuários dos serviços de saúde. Aplicou-se um questionário estruturado com perguntas abertas e fechadas. Os usuários expressaram satisfação quanto ao atendimento médico, às informações recebidas sobre a doença e o tratamento, e a clareza e a compreensão das indicações. O bom desempenho técnico e\r\nhumanizado dos médicos contribuiu para a satisfação dos usuários que ressaltaram a importância da continuidade do programa. Na dimensão responsividade, a maioria dos usuários externou contentamento quanto aos aspectos não médicos do cuidado: rapidez no agendamento, tempo de espera inferior a uma hora e privacidade. As sugestões dos usuários de melhorias na infraestrutura, maior disponibilidade de medicamentos e presença de mais médicos, devem ser consideradas pelos gestores do Sistema Único de Saúde para\r\navançar na garantia do direito constitucional de acesso à saúde no Brasil.', 'S', '2014-01-01', '2015-12-31', '2018-10-19 21:41:00', '2018-10-19 21:41:00', 3, 2, 'Avaliação da satisfação dos usuários e da responsividade dos serviços em municípios inscritos no Programa Mais Médicos', 'Ciência e Saúde Coletiva', '21', 2016, 1, 1, 'R', '2749-2759'),
(4, 'O Programa Mais Médicos (PMM) é uma estratégia do governo do Brasil que visa à ampliação do acesso a profissionais médicos e,\r\nconsequentemente, melhorias na qualidade dos serviços de Atenção Primária à Saúde. Objetivou-se analisar a percepção dos outros membros das equipes de saúde da família acerca da integralidade nas práticas a partir da incorporação do médico do Programa. Estudo em 32 municípios pobres nas cinco regiões do Brasil, nos quais foram entrevistados 78 profissionais de saúde, não médicos,\r\ndas equipes que receberam médicos do PMM. As entrevistas foram submetidas à análise de conteúdo auxiliada pelo software Atlas.ti. Os principais achados revelaram o aumento do acesso e da acessibilidade ao serviço de saúde da Estratégia Saúde da Família; acolhimento humanizado e vínculo: compreensão, parceria, amizade e respeito; o resgate da clínica: tempo dedicado, escuta atenta, exame físico minucioso; o desejo e a disponibilidade para resolver problemas; a continuidade dos cuidados; a garantia de visitas domiciliares e as\r\nequipes multiprofissionais articuladas em redes. Conclui-se que o Programa Mais Médicos contribuiu na presença de traços de integralidade nas práticas de saúde, impactando positivamente na melhoria da Atenção Básica à Saúde.', 'S', '2014-01-01', '2015-12-31', '2018-10-19 21:41:01', '2018-10-19 21:45:52', 3, 2, 'A implementação do Programa Mais Médicos e a integralidade nas práticas da Estratégia Saúde da Família', 'Ciência e Saúde Coletiva', '21', 2016, 1, 1, 'R', '2729-2738'),
(5, 'O ensino baseado na comunidade trata-se de uma abordagem educacional voltada à inserção de estudantes em cenários de prática real desde os anos iniciais dos cursos, principalmente em comunidades urbanas e/ou rurais e em serviços da atenção primária à saúde, em que o planejamento, a execução e a avaliação das ações desenvolvidas partem das necessidades de saúde local e, idealmente, inclui a participação de pessoas da comunidade, das equipes de saúde e da própria universidade em todas as suas etapas. Este estudo problematizou o processo de implementação de um currículo baseado no ensino em comunidade em uma escola médica criada no âmbito do Programa Mais Médicos, no sertão nordestino. Para isto, trabalhou-se com interlocuções teóricas entre narrativas, memória e currículo. Teve-se por objetivo compreender como docentes médicos vivenciam o ensino baseado na comunidade, tendo em vista suas memórias da formação médica. Trata-se de estudo qualitativo, nos marcos da história oral. Para a produção das narrativas e contextualização dos sujeitos, utilizaram-se observações participantes, questionários socioeconômicos e entrevistas individuais semi-estruturadas. As informações foram  analisadas  pela  técnica  de  codificação  temática.  Os  resultados  são  apresentados  e  discutidos por  meio  de  duas  categorias  temáticas:  “eles  serão  médicos  dentro  de  uma  comunidade”:  currículo, memória e formação médica; e “na hora em que eu cheguei lá, quis ir embora”: atuação docente no ensino baseado na comunidade. As narrativas desvelaram as disparidades e incongruências entre uma formação  médica  modelada  nas  prescrições  do  currículo  “tradicional”  e  as  expectativas  de  atuação docente num currículo “inovador”, caracterizado pela centralidade do estudante e das necessidades de saúde locais que produzem arranjos pedagógicos diversos próprios do ensino baseado na comunidade. Nesse panorama, imbricam-se desafios, dificuldades e gratificações num movimento ainda amorfo e num espaço ainda com muitos vazios que esperam para serem preenchidos, descritos, narrados com futuras histórias de vida que poderão elucidar como se aprendeu a ser docente nesse horizonte que se espraia a nossa frente. Cumpre destacar a polissemia do termo “comunidade” no contexto estudado e as dificuldades vivenciadas no início da carreira docente, o que evidencia a necessidade de investimentos em desenvolvimento docente nos cursos médicos, em geral, e nos recém-criados, em particular.', 'N', '2013-01-01', '2015-12-31', '2018-10-19 21:55:41', '2018-10-19 21:58:12', 2, 3, 'Narrativas e Memórias de Docentes Médicos sobre o Ensino Baseado na Comunidade no Sertão Nordestino', 'Revista Brasileira de Educação Médica', '42', 2018, 1, 1, 'R', '142-151');

-- --------------------------------------------------------


INSERT INTO `ArtigoAutor` (`CodArtigo`, `CodAutor`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(3, 6),
(4, 7),
(5, 8),
(5, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ArtigoCoordenador`
--

INSERT INTO `ArtigoCoordenador` (`CodArtigo`, `CodCoordenador`) VALUES
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 25);

-- --------------------------------------------------------


INSERT INTO `ArtigoInstituicao` (`CodArtigo`, `CodInstituicao`) VALUES
(1, 2),
(2, 609),
(3, 2),
(4, 2),
(5, 570);

-- --------------------------------------------------------


INSERT INTO `ArtigoPalavra` (`CodArtigo`, `CodPalavra`) VALUES
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(4, 23),
(4, 24),
(4, 25),
(4, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 30),
(5, 31);

-- --------------------------------------------------------

INSERT INTO `ArtigoTipoAnalise` (`CodArtigo`, `CodTipoAnalise`) VALUES
(2, 1),
(3, 1),
(1, 2),
(3, 2),
(4, 2),
(5, 2);

-- --------------------------------------------------------


INSERT INTO `ArtigoTipoObjetivo` (`CodArtigo`, `CodTipoObjetivo`) VALUES
(1, 2),
(2, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 1);


INSERT INTO `ArtigoTipoProcedimento` (`CodArtigo`, `CodTipoProcedimento`) VALUES
(1, 2),
(2, 3),
(3, 3),
(4, 3),
(5, 3);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
