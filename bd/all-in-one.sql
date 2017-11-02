-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 06/11/2017 às 02:40
-- Versão do servidor: 10.1.26-MariaDB
-- Versão do PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `all-in-one`
--
CREATE DATABASE IF NOT EXISTS `all-in-one` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `all-in-one`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ALUNOS`
--
-- Criação: 05/11/2017 às 23:21
--

DROP TABLE IF EXISTS `ALUNOS`;
CREATE TABLE `ALUNOS` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `sex` char(12) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cidade_natal` varchar(50) DEFAULT NULL,
  `cep` varchar(12) DEFAULT NULL,
  `bairro` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONAMENTOS PARA TABELAS `ALUNOS`:
--

--
-- Fazendo dump de dados para tabela `ALUNOS`
--

INSERT INTO `ALUNOS` (`id`, `email`, `password`, `nome`, `sex`, `cpf`, `endereco`, `cidade`, `estado`, `data_nascimento`, `cidade_natal`, `cep`, `bairro`) VALUES
(15, 'anderson@allinone.com', 'all-in-one', 'Anderson Lima', 'masculino', '58557434626', 'Avenida Brigadeiro LuÃ­s AntÃ´nio', 'SÃ£o Paulo', 'SP', '1800-10-10', 'Tokyo', '01318-906', 'Bela Vista');

-- --------------------------------------------------------

--
-- Estrutura para tabela `CURSOS`
--
-- Criação: 05/11/2017 às 23:21
--

DROP TABLE IF EXISTS `CURSOS`;
CREATE TABLE `CURSOS` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `url_image` varchar(50) NOT NULL,
  `apostila` varchar(1000) NOT NULL,
  `video` varchar(1000) NOT NULL,
  `id_aluno` int(100) NOT NULL,
  `status_curso` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONAMENTOS PARA TABELAS `CURSOS`:
--

--
-- Fazendo dump de dados para tabela `CURSOS`
--

INSERT INTO `CURSOS` (`id`, `nome`, `url_image`, `apostila`, `video`, `id_aluno`, `status_curso`) VALUES
(1, 'JAVASCRIPT', 'assets/img/cursos/javascript.jpg', 'http://www.ouropreto.ifmg.edu.br/dw/apostilas/desenvolvimento-web-com-html-css-e-javascript', 'https://www.youtube.com/watch?v=T-JVRDnykYg&t=11s', 10, 'FAZER'),
(2, 'HTML5', 'assets/img/cursos/default.png', 'https://www.caelum.com.br/download/caelum-java-objetos-fj11.pdf', 'https://www.youtube.com/watch?v=3JXD0duLJWY', 10, 'FAZER'),
(3, 'CSS3', 'assets/img/cursos/default.png', 'https://www.caelum.com.br/download/caelum-java-objetos-fj11.pdf', 'https://www.youtube.com/watch?v=3JXD0duLJWY', 10, 'FAZER'),
(4, 'JQUERY', 'assets/img/cursos/default.png', 'https://www.caelum.com.br/download/caelum-java-objetos-fj11.pdf', 'https://www.youtube.com/watch?v=3JXD0duLJWY', 10, 'FAZER'),
(5, 'PHP', 'assets/img/cursos/default.png', 'https://www.caelum.com.br/download/caelum-java-objetos-fj11.pdf', 'https://www.youtube.com/watch?v=3JXD0duLJWY', 10, 'FAZER'),
(6, 'MYSQL', 'assets/img/cursos/default.png', 'https://www.caelum.com.br/download/caelum-java-objetos-fj11.pdf', 'https://www.youtube.com/watch?v=3JXD0duLJWY', 10, 'FAZER'),
(7, 'BOOTSTRAP', 'assets/img/cursos/default.png', 'https://www.caelum.com.br/download/caelum-java-objetos-fj11.pdf', 'https://www.youtube.com/watch?v=3JXD0duLJWY', 10, 'FAZER'),
(8, 'EMBERJS', 'assets/img/cursos/emberjs.png', 'materiais/pdf/emberjs.pdf', 'https://www.youtube.com/watch?v=owDmPTSJkrg', 10, 'FAZENDO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `PROVAS`
--
-- Criação: 05/11/2017 às 23:21
--

DROP TABLE IF EXISTS `PROVAS`;
CREATE TABLE `PROVAS` (
  `id` int(11) NOT NULL COMMENT 'pk',
  `id_curso` int(11) NOT NULL COMMENT 'fk',
  `questoes` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONAMENTOS PARA TABELAS `PROVAS`:
--   `id_curso`
--       `CURSOS` -> `id`
--

--
-- Fazendo dump de dados para tabela `PROVAS`
--

INSERT INTO `PROVAS` (`id`, `id_curso`, `questoes`) VALUES
(1, 8, '{\"questoes\":[{\"id\":\"1\",\"descricao\":\"Ember corresponde um framework JS\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"2\",\"descricao\":\"Ember corresponde a SPA ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"3\",\"descricao\":\"Ember se baseia em MVC ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"4\",\"descricao\":\"Ember tem carregamento leve ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"5\",\"descricao\":\"Ember tem como mascote um elefante\",\"pergunta\":\"NAO\",\"resposta\":\"\"}]}'),
(2, 1, '{\"questoes\":[{\"id\":\"1\",\"descricao\":\"Ember corresponde um framework JS\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"2\",\"descricao\":\"Ember corresponde a SPA ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"3\",\"descricao\":\"Ember se baseia em MVC ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"4\",\"descricao\":\"Ember tem carregamento leve ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"5\",\"descricao\":\"Ember tem como mascote um elefante\",\"pergunta\":\"NAO\",\"resposta\":\"\"}]}'),
(3, 2, '{\"questoes\":[{\"id\":\"1\",\"descricao\":\"Ember corresponde um framework JS\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"2\",\"descricao\":\"Ember corresponde a SPA ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"3\",\"descricao\":\"Ember se baseia em MVC ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"4\",\"descricao\":\"Ember tem carregamento leve ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"5\",\"descricao\":\"Ember tem como mascote um elefante\",\"pergunta\":\"NAO\",\"resposta\":\"\"}]}'),
(4, 3, '{\"questoes\":[{\"id\":\"1\",\"descricao\":\"Ember corresponde um framework JS\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"2\",\"descricao\":\"Ember corresponde a SPA ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"3\",\"descricao\":\"Ember se baseia em MVC ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"4\",\"descricao\":\"Ember tem carregamento leve ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"5\",\"descricao\":\"Ember tem como mascote um elefante\",\"pergunta\":\"NAO\",\"resposta\":\"\"}]}'),
(5, 4, '{\"questoes\":[{\"id\":\"1\",\"descricao\":\"Ember corresponde um framework JS\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"2\",\"descricao\":\"Ember corresponde a SPA ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"3\",\"descricao\":\"Ember se baseia em MVC ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"4\",\"descricao\":\"Ember tem carregamento leve ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"5\",\"descricao\":\"Ember tem como mascote um elefante\",\"pergunta\":\"NAO\",\"resposta\":\"\"}]}'),
(17, 6, '{\"questoes\":[{\"id\":\"1\",\"descricao\":\"Ember corresponde um framework JS\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"2\",\"descricao\":\"Ember corresponde a SPA ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"3\",\"descricao\":\"Ember se baseia em MVC ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"4\",\"descricao\":\"Ember tem carregamento leve ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"5\",\"descricao\":\"Ember tem como mascote um elefante\",\"pergunta\":\"NAO\",\"resposta\":\"\"}]}'),
(18, 7, '{\"questoes\":[{\"id\":\"1\",\"descricao\":\"Ember corresponde um framework JS\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"2\",\"descricao\":\"Ember corresponde a SPA ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"3\",\"descricao\":\"Ember se baseia em MVC ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"4\",\"descricao\":\"Ember tem carregamento leve ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"5\",\"descricao\":\"Ember tem como mascote um elefante\",\"pergunta\":\"NAO\",\"resposta\":\"\"}]}'),
(19, 5, '{\"questoes\":[{\"id\":\"1\",\"descricao\":\"Ember corresponde um framework JS\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"2\",\"descricao\":\"Ember corresponde a SPA ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"3\",\"descricao\":\"Ember se baseia em MVC ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"4\",\"descricao\":\"Ember tem carregamento leve ?\",\"pergunta\":\"SIM\",\"resposta\":\"\"},{\"id\":\"5\",\"descricao\":\"Ember tem como mascote um elefante\",\"pergunta\":\"NAO\",\"resposta\":\"\"}]}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `TENTATIVAS`
--
-- Criação: 05/11/2017 às 23:21
--

DROP TABLE IF EXISTS `TENTATIVAS`;
CREATE TABLE `TENTATIVAS` (
  `id` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_prova` int(11) NOT NULL,
  `num_tentativa` int(2) NOT NULL,
  `data` date NOT NULL,
  `nota` varchar(5) NOT NULL,
  `questoes` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONAMENTOS PARA TABELAS `TENTATIVAS`:
--   `id_aluno`
--       `ALUNOS` -> `id`
--   `id_curso`
--       `CURSOS` -> `id`
--   `id_prova`
--       `PROVAS` -> `id`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tentativas_login`
--
-- Criação: 05/11/2017 às 23:21
--

DROP TABLE IF EXISTS `tentativas_login`;
CREATE TABLE `tentativas_login` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `datahora` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONAMENTOS PARA TABELAS `tentativas_login`:
--

--
-- Fazendo dump de dados para tabela `tentativas_login`
--

INSERT INTO `tentativas_login` (`id`, `email`, `datahora`) VALUES
(1, 'anderson@lima.com', '2017-11-02 19:09:29'),
(2, 'anderson@lima.com', '2017-11-02 19:09:49'),
(3, 'anderson@allinone.com', '2017-11-02 19:10:49'),
(4, 'teste@teste.com', '2017-11-02 19:12:16'),
(5, 'teste@teste.com', '2017-11-02 19:13:15'),
(6, 'anderson@lima.com', '2017-11-02 19:13:25'),
(7, 'anderson@lima.com', '2017-11-02 19:13:37'),
(8, 'anderson@lima.com', '2017-11-02 19:13:48'),
(9, 'anderson@lima.com', '2017-11-02 19:17:45'),
(10, 'anderson@lima.com', '2017-11-02 19:19:47'),
(11, 'anderson@lima.com', '2017-11-02 19:23:31'),
(12, 'lima@limao.com', '2017-11-02 19:24:04'),
(13, 'lima@limao.com', '2017-11-02 19:25:13'),
(14, 'lima@lima.com', '2017-11-02 19:36:12'),
(15, 'lima@lima.com', '2017-11-02 19:37:31'),
(16, 'lima@lima.com', '2017-11-02 19:37:39'),
(17, 'steve@jobs.com', '2017-11-02 19:41:31'),
(18, 'steve@jobs.com', '2017-11-02 19:43:25'),
(19, 'steve@jobs.com', '2017-11-02 19:43:29'),
(20, 'steve@jobs.com', '2017-11-02 19:43:33'),
(21, 'steve@jobs.com', '2017-11-02 19:43:36'),
(22, 'steve@jobs.com', '2017-11-02 19:43:39'),
(23, 'anderson@lima.com', '2017-11-04 12:18:44'),
(24, 'teste@teste.com', '2017-11-04 13:02:50'),
(25, 'anderson@lima.com', '2017-11-04 13:04:43'),
(26, 'anderson@allinone.com', '2017-11-04 13:05:05');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `ALUNOS`
--
ALTER TABLE `ALUNOS`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `CURSOS`
--
ALTER TABLE `CURSOS`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `PROVAS`
--
ALTER TABLE `PROVAS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PROVAS_CURSO` (`id_curso`);

--
-- Índices de tabela `TENTATIVAS`
--
ALTER TABLE `TENTATIVAS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TENTATIVAS_ALUNO` (`id_aluno`),
  ADD KEY `FK_TENTATIVAS_CURSO` (`id_curso`),
  ADD KEY `FK_TENTATIVAS_PRPOVA` (`id_prova`);

--
-- Índices de tabela `tentativas_login`
--
ALTER TABLE `tentativas_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `ALUNOS`
--
ALTER TABLE `ALUNOS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de tabela `CURSOS`
--
ALTER TABLE `CURSOS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `PROVAS`
--
ALTER TABLE `PROVAS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk', AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de tabela `TENTATIVAS`
--
ALTER TABLE `TENTATIVAS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT de tabela `tentativas_login`
--
ALTER TABLE `tentativas_login`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `PROVAS`
--
ALTER TABLE `PROVAS`
  ADD CONSTRAINT `FK_PROVAS_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `CURSOS` (`id`);

--
-- Restrições para tabelas `TENTATIVAS`
--
ALTER TABLE `TENTATIVAS`
  ADD CONSTRAINT `FK_TENTATIVAS_ALUNO` FOREIGN KEY (`id_aluno`) REFERENCES `ALUNOS` (`id`),
  ADD CONSTRAINT `FK_TENTATIVAS_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `CURSOS` (`id`),
  ADD CONSTRAINT `FK_TENTATIVAS_PRPOVA` FOREIGN KEY (`id_prova`) REFERENCES `PROVAS` (`id`);


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata para tabela ALUNOS
--

--
-- Fazendo dump de dados para tabela `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'all-in-one', 'ALUNOS', '{\"sorted_col\":\"`password` ASC\"}', '2017-11-03 18:49:54');

--
-- Metadata para tabela CURSOS
--

--
-- Metadata para tabela PROVAS
--

--
-- Metadata para tabela TENTATIVAS
--

--
-- Metadata para tabela tentativas_login
--

--
-- Metadata para o banco de dados all-in-one
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;