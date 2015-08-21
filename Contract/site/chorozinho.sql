-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 09, 2012 as 04:54 
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `chorozinho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `local` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `data`, `titulo`, `local`, `descricao`) VALUES
(1, '2012-03-10', 'Abertura das Festividades', 'Praça Matriz', '21:00h - Abertura Oficial\r\n- Ítalo e Renno\r\n- Banda Solteirões do Forró\r\n- Banda Novo Caviar'),
(2, '2012-03-11', 'Show Gospel', 'Praça Matriz', 'Shirley Carvalhaes'),
(3, '2012-03-12', 'Show Católico', 'Praça Matriz', '- Batista Lima e Banda \r\n- Missa com Pe. Bruno'),
(4, '2012-03-11', 'Parabéns Chorozinho', 'Pelas ruas da cidade', '- Banda de Música Municipal \r\n- Espetáculo de dança municipal(ribeirinhos roncadores) \r\n- Forró da Pisadinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `capa_album` varchar(50) NOT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `album`
--

INSERT INTO `album` (`id_album`, `titulo`, `descricao`, `capa_album`) VALUES
(1, 'Album 1', 'Este é o Album 01', 'capa1.jpg'),
(2, 'Album 2', 'Este é o Album 02', 'capa2.jpg'),
(3, 'Album 3', 'Este é o Album 03', 'capa3.jpg'),
(4, 'Album 4 ', 'Este é o Album 04', 'capa4.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `album_fotos`
--

CREATE TABLE IF NOT EXISTS `album_fotos` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `id_album` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `foto_thumb` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_foto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `album_fotos`
--

INSERT INTO `album_fotos` (`id_foto`, `id_album`, `foto`, `foto_thumb`, `titulo`) VALUES
(1, 1, '36410781.jpg', 'capa1.jpg ', 'Foto 1 '),
(2, 1, 'header.png', '36410781.jpg', 'foto 2'),
(3, 1, 'festa-junina.jpg', 'header.png ', 'Foto 3 '),
(4, 1, 'capa1.jpg', 'festa-junina.jpg ', 'foto 4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id_banner` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `banner`
--

INSERT INTO `banner` (`id_banner`, `titulo`, `imagem`) VALUES
(1, 'Seleção Master', 'imagem2.jpg'),
(2, 'ProInfo', 'imagem1.jpg'),
(3, 'Festa do município', 'festa25anos.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `data` date NOT NULL,
  `conteudo` text NOT NULL,
  `fonte` varchar(100) NOT NULL,
  `exibir_em` int(11) NOT NULL,
  `destaque` char(1) NOT NULL DEFAULT 'N',
  `imagem` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_noticia`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `titulo`, `data`, `conteudo`, `fonte`, `exibir_em`, `destaque`, `imagem`) VALUES
(1, 'Aniversário de Emancipação Política', '2012-03-09', 'A cidade de Chorozinho comemora no próximo dia 13/03 seu 25º aniversário de emancipação política. Na ocasião serão realizada comemorações durante a semana do dia 06/03 a 13/03. No Dia 13 de março a banda de música do município fará uma alvorada pelas principais ruas da cidade. A festa será encerrada por uma missa que será celebrada pelo Pe. Enemias, primeiro pároco do municipio.', '', 0, 'S', NULL),
(2, 'Aniversário do Município', '2012-03-08', 'A cidade de Chorozinho comemora no próximo dia 13/03 seu 25º aniversário de emancipação política. Na ocasião serão realizada comemorações durante a semana do dia 06/03 a 13/03. No Dia 13 de março a banda de música do município fará uma alvorada pelas principais ruas da cidade. A festa será encerrada por uma missa que será celebrada pelo Pe. Enemias, primeiro pároco do municipio.', '', 0, 'N', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretarias`
--

CREATE TABLE IF NOT EXISTS `secretarias` (
  `id_secretaria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_secretaria` varchar(200) NOT NULL,
  `nome_responsavel` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefone` varchar(200) NOT NULL,
  `imagem_responsavel` varchar(100) NOT NULL,
  `descricao_responsavel` text NOT NULL,
  PRIMARY KEY (`id_secretaria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `secretarias`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id_video` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `link` varchar(200) NOT NULL,
  `capa_video` varchar(100) NOT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `videos`
--

INSERT INTO `videos` (`id_video`, `titulo`, `descricao`, `link`, `capa_video`) VALUES
(1, 'Video 1', 'Este é o vídeo 1', 'http://www.youtube.com/watch?v=QdvYAjQYdIs', 'capa1.jpg'),
(2, 'Video 2', 'Este é o vídeo 2', 'http://www.youtube.com/watch?v=jgxgoZ_r1Ic', 'capa2.jpg'),
(3, 'Vídeo 3', 'Este é o vídeo 3', 'http://www.youtube.com/watch?v=VBb-YEzUjBI', 'capa3.jpg'),
(4, 'Video 4', 'Este é o vídeo 4', '<iframe width="560" height="315" src="http://www.youtube.com/embed/jgxgoZ_r1Ic" frameborder="0" allowfullscreen></iframe>', 'capa4.jpg'),
(5, 'Vídeo 5', 'Este é o vídeo 5', '<iframe width="560" height="315" src="http://www.youtube.com/embed/8xtoE_iomzw" frameborder="0" allowfullscreen></iframe>', 'vid2.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
