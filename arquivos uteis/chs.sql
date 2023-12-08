-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Dez-2023 às 22:48
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `chs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`id`, `nome`) VALUES
(1, 'Headphone'),
(2, 'Teclado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_criatura`
--

CREATE TABLE `ganolia_criatura` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `territorio` varchar(30) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `recompensa_id` varchar(30) NOT NULL,
  `probabilidade` varchar(20) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `ganolia_criatura`
--

INSERT INTO `ganolia_criatura` (`id`, `nome`, `territorio`, `raridade`, `recompensa_id`, `probabilidade`, `imagem`) VALUES
(1, 'Bicho', 'Pantano', 'Comum', '1;2;3', '50;30;20', '../Images/arrow.png'),
(2, 'Amigao', 'Floresta', 'Comum', '4;4', '50;50', '../Images/arrow.png'),
(3, 'Karro', 'Pantano', 'Incomum', '1', '100', '../Images/arrow.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_item`
--

CREATE TABLE `ganolia_item` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `dados` varchar(10) NOT NULL,
  `valor` varchar(10) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `damage` text NOT NULL,
  `habilidade` varchar(50) NOT NULL,
  `taxa_habilidade` varchar(20) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `situacao` varchar(2) NOT NULL,
  `situacao_mercado` varchar(2) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `ganolia_item`
--

INSERT INTO `ganolia_item` (`id`, `nome`, `tipo`, `categoria`, `dados`, `valor`, `raridade`, `damage`, `habilidade`, `taxa_habilidade`, `descricao`, `situacao`, `situacao_mercado`, `imagem`) VALUES
(1, '1', 'Espada', 'Ataque', 'D6', '10', 'Comum', '1;2;3', 'Freeze', '15', '[5] Pedra + [2] Ferro', 'A', 'A', '../Images/Ganolia/Espadas/1.png'),
(2, '2', 'Espada', 'Ataque', 'D6', '5', 'Incomum', '2;3;4;5', 'Critico', '20', '[5] Pedra + [2] Ferro', 'A', 'I', '../Images/Ganolia/Espadas/2.png'),
(3, '3', 'Espada', 'Ataque', 'D8', '9', 'Comum', '', '', '', '[5] Pedra + [2] Ferro', 'A', 'A', '../Images/Ganolia/Espadas/3.png'),
(4, '4', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', 'A', '../Images/Ganolia/Espadas/4.png'),
(5, '5', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/5.png'),
(6, '6', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/6.png'),
(7, '7', 'Espada', 'Ataque', '', '', 'Incomum', '2;3;4;5', '', '', '', 'A', '', '../Images/Ganolia/Espadas/7.png'),
(8, '8', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/8.png'),
(9, '9', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'I', '', '../Images/Ganolia/Espadas/9.png'),
(10, '10', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/10.png'),
(11, '11', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/11.png'),
(12, '12', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/12.png'),
(13, '13', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 'I', '', '../Images/Ganolia/Espadas/13.png'),
(14, '14', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/14.png'),
(15, '15', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/15.png'),
(16, '16', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/16.png'),
(17, '17', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/17.png'),
(18, '18', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/18.png'),
(19, '19', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/19.png'),
(20, '20', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/20.png'),
(21, '21', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/21.png'),
(22, '22', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/22.png'),
(23, '23', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/23.png'),
(24, '24', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/24.png'),
(25, '25', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/25.png'),
(26, '26', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/26.png'),
(27, '27', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/27.png'),
(28, '28', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/28.png'),
(29, '29', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/29.png'),
(30, '30', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/30.png'),
(31, '31', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/31.png'),
(32, '32', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/32.png'),
(33, '33', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/33.png'),
(34, '34', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/34.png'),
(35, '35', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/35.png'),
(36, '36', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/36.png'),
(37, '37', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/37.png'),
(38, '38', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/38.png'),
(39, '39', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/39.png'),
(40, '40', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/40.png'),
(41, '41', 'Espada', 'Ataque', '', '', 'Lendario', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/41.png'),
(42, '42', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 'I', '', '../Images/Ganolia/Espadas/42.png'),
(43, '43', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/43.png'),
(44, '44', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/44.png'),
(46, '46', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/46.png'),
(47, '47', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/47.png'),
(48, '48', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 'A', '', '../Images/Ganolia/Espadas/48.png'),
(49, '49', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 'I', '', '../Images/Ganolia/Espadas/49.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `heads`
--

CREATE TABLE `heads` (
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
-- Extraindo dados da tabela `heads`
--

INSERT INTO `heads` (`id`, `tag`, `modelo`, `problema`, `data_envio`, `situacao`, `previsao`, `retorno`, `garantia`, `manutencao`, `equipamento_id`) VALUES
(10689, '232', 'A', 'B', '02-12-2023', 'Enviado', '09-12-2023', 'Pendente', 'Nao', 2, NULL),
(10690, '32', 'C', 'B', '18-10-2023', 'Concluido', 'Concluido', '02-12-2023', 'Nao', 2, 1),
(10693, 'AASASAC', 'A', 'A', '18-10-2023', 'Concluido', 'Concluido', '19-10-2023', 'Sim', 1, 1),
(10695, 'teste', 'A', 'Y', 'Pendente', 'Pendente', 'Pendente', 'Pendente', 'Nao', 0, 1),
(10696, 'r3443', 'A', 'A', '20-10-2023', 'Enviado', '27-10-2023', 'Pendente', 'Nao', 1, 2),
(10700, '23414', 'B', 'B', 'Pendente', 'Pendente', 'Pendente', 'Pendente', 'Nao', 0, 2),
(10701, '123', 'ABA', 'B', '02-12-2023', 'Enviado', '09-12-2023', 'Pendente', 'Nao', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`id`, `tag_id`, `usuario_id`) VALUES
(104, 10689, 7),
(105, 10690, 7),
(108, 10693, 7),
(110, 10695, 7),
(111, 10696, 7),
(115, 10700, 7),
(116, 10701, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id`, `nome`) VALUES
(10, 'A'),
(11, 'B'),
(12, 'C'),
(26, 'ABA'),
(27, 'AA'),
(28, 'EWQEWQDSAFG');

-- --------------------------------------------------------

--
-- Estrutura da tabela `problema`
--

CREATE TABLE `problema` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `problema`
--

INSERT INTO `problema` (`id`, `nome`) VALUES
(5, 'A'),
(6, 'B'),
(7, 'GG');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `senha` int(20) NOT NULL,
  `permissao` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `referencia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `permissao`, `email`, `referencia`) VALUES
(7, 'Emerson', 123, 'Admin', 'admin@admin', ''),
(15, 'GGG', 123, 'Usuario', 'VV@VV', 'Amigo'),
(16, 'carol', 123, 'Usuario', 'carol@carol', 'Amigo'),
(17, 'bugatti', 123, 'Usuario', 'b@b', 'Amigo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ganolia_criatura`
--
ALTER TABLE `ganolia_criatura`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ganolia_item`
--
ALTER TABLE `ganolia_item`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `heads`
--
ALTER TABLE `heads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipamento_id` (`equipamento_id`);

--
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `problema`
--
ALTER TABLE `problema`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `ganolia_criatura`
--
ALTER TABLE `ganolia_criatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `ganolia_item`
--
ALTER TABLE `ganolia_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `heads`
--
ALTER TABLE `heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10702;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `problema`
--
ALTER TABLE `problema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `heads`
--
ALTER TABLE `heads`
  ADD CONSTRAINT `heads_ibfk_1` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`);

--
-- Limitadores para a tabela `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `heads` (`id`),
  ADD CONSTRAINT `historico_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
