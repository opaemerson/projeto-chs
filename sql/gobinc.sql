-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/10/2024 às 20:47
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gobinc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chs_controle`
--

CREATE TABLE `chs_controle` (
  `id` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `problema` varchar(255) DEFAULT NULL,
  `data_envio` varchar(50) DEFAULT NULL,
  `situacao` varchar(50) DEFAULT NULL,
  `previsao` varchar(50) DEFAULT NULL,
  `retorno` varchar(50) NOT NULL,
  `garantia` varchar(50) DEFAULT NULL,
  `manutencao` int(50) NOT NULL,
  `equipamento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chs_controle`
--

INSERT INTO `chs_controle` (`id`, `tag`, `modelo`, `problema`, `data_envio`, `situacao`, `previsao`, `retorno`, `garantia`, `manutencao`, `equipamento_id`) VALUES
(10732, '21321', 'cc', 'Problm', 'Pendente', 'Pendente', 'Pendente', 'Pendente', 'Pendente', 2, 7),
(10736, '333', 'cc', 'Problm', '04/09/2024', 'Enviado', '14/09/2024', 'Pendente', 'Pendente', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chs_equipamento`
--

CREATE TABLE `chs_equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `chs_equipamento`
--

INSERT INTO `chs_equipamento` (`id`, `nome`, `tipo`, `usuario_id`) VALUES
(1, 'A', 'Equipamento', 7),
(7, 'B', 'Equipamento', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chs_historico`
--

CREATE TABLE `chs_historico` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chs_historico`
--

INSERT INTO `chs_historico` (`id`, `tag_id`, `usuario_id`) VALUES
(145, 10732, 7),
(149, 10736, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chs_marca`
--

CREATE TABLE `chs_marca` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chs_marca`
--

INSERT INTO `chs_marca` (`id`, `nome`, `tipo`, `usuario_id`) VALUES
(12, 'C', 'Marca', 7),
(14, 'cc', 'Marca', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chs_problema`
--

CREATE TABLE `chs_problema` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chs_problema`
--

INSERT INTO `chs_problema` (`id`, `nome`, `tipo`, `usuario_id`) VALUES
(14, 'Problm', 'Problema', 7),
(16, 'DWwq', 'Problema', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `senha` int(20) NOT NULL,
  `permissao` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `personagem_ganolia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `permissao`, `email`, `referencia`, `personagem_ganolia`) VALUES
(7, 'Emerson', 123, 'Admin', 'admin@admin', '', 3),
(16, 'carol', 123, 'Usuario', 'carol@carol', 'Amigo', 2),
(22, 'Raul', 123, 'Usuario', 'raul@raul', 'Amigo', 1),
(99, 'Criatura', 123, 'Usuario', 'criatura@criatura', 'Amigo', 99),
(100, 'dinho', 123, 'Usuario', 'dinho@dinho', 'Amigo', 100);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chs_controle`
--
ALTER TABLE `chs_controle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipamento_id` (`equipamento_id`);

--
-- Índices de tabela `chs_equipamento`
--
ALTER TABLE `chs_equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `chs_historico`
--
ALTER TABLE `chs_historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `chs_marca`
--
ALTER TABLE `chs_marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `chs_problema`
--
ALTER TABLE `chs_problema`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personagem_ganolia` (`personagem_ganolia`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chs_controle`
--
ALTER TABLE `chs_controle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10738;

--
-- AUTO_INCREMENT de tabela `chs_equipamento`
--
ALTER TABLE `chs_equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `chs_historico`
--
ALTER TABLE `chs_historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de tabela `chs_marca`
--
ALTER TABLE `chs_marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `chs_problema`
--
ALTER TABLE `chs_problema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `chs_historico`
--
ALTER TABLE `chs_historico`
  ADD CONSTRAINT `chs_historico_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `chs_controle` (`id`),
  ADD CONSTRAINT `chs_historico_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_personagem_ganolia` FOREIGN KEY (`personagem_ganolia`) REFERENCES `ganolia_personagem` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
