-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/04/2024 às 03:23
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
(10706, '123', 'cc', 'B', '10-03-2024', 'Enviado', '17-03-2024', 'Pendente', 'Nao', 2, 5),
(10707, '4', 'C', 'C', '10-03-2024', 'Enviado', '17-03-2024', 'Pendente', 'Nao', 1, 6),
(10709, 'gt', 'C', 'C', '30-03-2024', 'Enviado', '06-04-2024', 'Pendente', 'Nao', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chs_equipamento`
--

CREATE TABLE `chs_equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chs_equipamento`
--

INSERT INTO `chs_equipamento` (`id`, `nome`, `tipo`) VALUES
(5, 'Tes', 'Equipamento'),
(6, 'One', 'Equipamento'),
(8, 'Tw', 'Equipamento');

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
(121, 10706, 7),
(122, 10707, 7),
(124, 10709, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chs_marca`
--

CREATE TABLE `chs_marca` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chs_marca`
--

INSERT INTO `chs_marca` (`id`, `nome`, `tipo`) VALUES
(12, 'C', 'Marca'),
(14, 'cc', 'Marca');

-- --------------------------------------------------------

--
-- Estrutura para tabela `chs_problema`
--

CREATE TABLE `chs_problema` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chs_problema`
--

INSERT INTO `chs_problema` (`id`, `nome`, `tipo`) VALUES
(6, 'B', 'Problema'),
(7, 'C', 'Problema');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_criatura`
--

CREATE TABLE `ganolia_criatura` (
  `id` int(11) NOT NULL,
  `ranking` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `hp` int(11) NOT NULL,
  `atq` varchar(20) NOT NULL,
  `cp` int(11) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `recompensa_id` varchar(30) NOT NULL,
  `probabilidade` varchar(20) NOT NULL,
  `situacao` varchar(2) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_criatura`
--

INSERT INTO `ganolia_criatura` (`id`, `ranking`, `nome`, `hp`, `atq`, `cp`, `raridade`, `recompensa_id`, `probabilidade`, `situacao`, `imagem`) VALUES
(1, 30, 'Bezon', 2, '1;2', 2, 'Baixo', 'COM/INC', '', 'A', '../Images/Ganolia/Criaturas/FlorestaOculta/Bezon.jpg'),
(2, 20, 'Durotan', 4, '1;2', 3, 'Baixo', '', '', 'A', ''),
(3, 18, 'Grunt', 4, '1;2', 3, 'Baixo', '', '', 'A', ''),
(4, 19, 'Jarvin', 4, '1;2', 3, 'Baixo', '', '', 'A', ''),
(5, 22, 'Nargol', 4, '1;2', 3, 'Baixo', '', '', 'A', ''),
(6, 12, 'Tweak', 5, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(7, 31, 'Zigzab', 2, '1;2', 2, 'Baixo', '', '', 'A', ''),
(8, 21, 'Noru', 8, '1;2;3;4', 4, 'Medio', 'COM/INC/RARO', '', 'A', ''),
(9, 16, 'Jangle', 8, '1;2;3;4', 5, 'Medio', '', '', 'A', ''),
(11, 25, 'Frogino', 4, '1;2', 2, 'Baixo', '', '', 'A', ''),
(12, 23, 'Grivo', 4, '1;2', 2, 'Baixo', '', '', 'A', ''),
(13, 21, 'Nazar', 4, '1;2', 3, 'Baixo', '', '', 'A', ''),
(15, 14, 'Vorup', 5, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(16, 19, 'Croco', 9, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(17, 26, 'Hazzo', 5, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(18, 25, 'Magentaro', 6, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(19, 23, 'Safir', 7, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(20, 11, 'Torpan', 10, '1;2;3;4;5', 5, 'Medio', '', '', 'A', ''),
(21, 8, 'Rellus', 10, '1;2;3;4;5;6', 6, 'Alto', 'INC/RARO', '', 'A', ''),
(22, 27, 'Cloflower', 5, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(23, 26, 'Doom', 3, '1;2', 2, 'Baixo', '', '', 'A', ''),
(24, 13, 'Dregmor', 5, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(25, 8, 'Grimsoul', 7, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(26, 3, 'Ripper', 7, '1;2;3', 4, 'Baixo', '', '', 'A', ''),
(27, 22, 'Vorkus', 7, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(28, 20, 'Darak', 8, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(29, 9, 'Bonecrave', 10, '1;2;3;4;5', 5, 'Medio', '', '', 'A', ''),
(30, 2, 'Netherbone', 14, '1;2;3;4;5', 6, 'Medio', '', '', 'A', ''),
(31, 7, 'Skulldeath', 11, '1;2;3;4;5;6', 6, 'Alto', '', '', 'A', ''),
(32, 2, 'Yonno', 17, '1;2;3;4;5;6;7;8;9', 8, 'SemiBoss', 'INC/RARO/LEND', '', 'A', ''),
(35, 16, 'Moon', 4, '1;2', 3, 'Baixo', '', '', 'A', ''),
(36, 9, 'Dorvon', 7, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(37, 10, 'Honus', 10, '1;2;3;4;5', 5, 'Medio', '', '', 'A', ''),
(38, 8, 'Hyro', 11, '1;2;3;4;5', 5, 'Medio', '', '', 'A', ''),
(40, 24, 'Glintara', 6, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(41, 1, 'Kyron', 14, '1;2;3;4;5;6;7', 8, 'Alto', '', '', 'A', ''),
(42, 4, 'Blazen', 12, '1;2;3;4;5;6;7', 7, 'Alto', '', '', 'A', ''),
(43, 27, 'Furry', 3, '1;2', 2, 'Baixo', '', '', 'A', ''),
(44, 28, 'Kurupin', 3, '1;2', 2, 'Baixo', '', '', 'A', ''),
(45, 2, 'Moltorix', 8, '1;2;3', 4, 'Baixo', '', '', 'A', ''),
(46, 5, 'Vulcan', 6, '1;2;3', 4, 'Baixo', '', '', 'A', ''),
(47, 14, 'Nalisk', 9, '1;2;3;4', 5, 'Medio', '', '', 'A', ''),
(48, 15, 'Azun', 9, '1;2;3;4', 5, 'Medio', '', '', 'A', ''),
(49, 7, 'Flamir', 11, '1;2;3;4;5', 5, 'Medio', '', '', 'A', ''),
(50, 4, 'Fenix', 13, '1;2;3;4;5', 6, 'Medio', '', '', 'A', ''),
(51, 9, 'Wuzzo', 10, '1;2;3;4;5;6', 6, 'Alto', '', '', 'A', ''),
(52, 6, 'Scar', 15, '1;2;3;4;5;6;7;8', 7, 'SemiBoss', '', '', 'A', ''),
(53, 3, 'Nero', 16, '1;2;3;4;5;6;7;8', 8, 'SemiBoss', '', '', 'A', ''),
(54, 10, 'Snowalker', 6, '1;2;3', 3, 'Baixo', '', '', 'A', '../Images/Ganolia/Criaturas/ColinasDeGelo/Snowalker.jpg'),
(55, 15, 'Worpam', 4, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(56, 6, 'Frost', 8, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(57, 29, 'Garg', 2, '1;2', 2, 'Baixo', '', '', 'A', ''),
(58, 17, 'Urinco', 8, '1;2;3;4', 5, 'Medio', '', '', 'A', ''),
(59, 12, 'Tillanus', 10, '1;2;3;4;5', 5, 'Medio', '', '', 'A', ''),
(60, 18, 'Iceblom', 9, '1;2;3;4', 4, 'Medio', '', '', 'A', ''),
(61, 3, 'Icedragon', 13, '1;2;3;4;5;6;7', 7, 'Alto', '', '', 'A', ''),
(62, 2, 'Adra', 14, '1;2;3;4;5;6;7', 8, 'Alto', '', '', 'A', ''),
(63, 4, 'Abyssal', 16, '1;2;3;4;5;6;7;8', 7, 'SemiBoss', '', '', 'A', ''),
(64, 2, 'Kimaris', 20, '1;2;3;4;5;6;7;8;9;10', 9, 'Boss', '', '', 'A', ''),
(65, 7, 'Aquam', 8, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(66, 17, 'Forbie', 4, '1;2', 3, 'Baixo', '', '', 'A', ''),
(67, 11, 'Gale', 6, '1;2;3', 3, 'Baixo', '', '', 'A', ''),
(68, 24, 'Gloom', 4, '1;2', 2, 'Baixo', '', '', 'A', ''),
(69, 5, 'Erbelim', 12, '1;2;3;4;5', 6, 'Medio', '', '', 'A', ''),
(70, 13, 'Frey', 9, '1;2;3;4', 5, 'Medio', '', '', 'A', ''),
(71, 3, 'Vladis', 13, '1;2;3;4;5', 6, 'Medio', '', '', 'A', ''),
(72, 6, 'Zara', 12, '1;2;3;4;5', 6, 'Medio', '', '', 'A', ''),
(73, 6, 'Kova', 11, '1;2;3;4;5;6', 7, 'Alto', '', '', 'A', ''),
(74, 1, 'Abaddon', 20, '1;2;3;4;5;6;7;8;9;10', 9, 'Boss', 'RARO/LEND', '', 'A', ''),
(75, 4, 'Rex', 6, '1;2;3', 4, 'Baixo', '', '', 'A', ''),
(76, 1, 'Graven', 7, '1;2;3', 4, 'Baixo', '', '', 'A', ''),
(77, 1, 'Drakonir', 14, '1;2;3;4;5', 6, 'Medio', '', '', 'A', ''),
(78, 5, 'Gobaron', 12, '1;2;3;4;5;6;7', 6, 'Alto', '', '', 'A', ''),
(79, 1, 'Arcticus', 17, '1;2;3;4;5;6;7;8;9', 8, 'SemiBoss', '', '', 'A', ''),
(80, 5, 'Dollus', 15, '1;2;3;4;5;6;7;8', 7, 'SemiBoss', '', '', 'A', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_historico`
--

CREATE TABLE `ganolia_historico` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `personagem_id` int(11) DEFAULT NULL,
  `evento` varchar(255) DEFAULT NULL,
  `item_usado` varchar(30) NOT NULL,
  `horario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_historico`
--

INSERT INTO `ganolia_historico` (`id`, `personagem_id`, `evento`, `item_usado`, `horario`) VALUES
(1, 1, 'Registrado', '', '2023-12-16 03:00:00'),
(3, 2, 'Registrado', '', '2023-12-16 03:00:00'),
(158, 26, 'Registrado', '', '2023-12-16 03:00:00'),
(345, 100, 'Registrado', '', '2023-12-16 03:00:00'),
(383, 101, 'Registrado', '', '2023-12-16 03:00:00'),
(393, 3, 'Acertou 3 de dano no alvo.', 'Espada 3', '2024-03-24 17:50:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_item`
--

CREATE TABLE `ganolia_item` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `dados` varchar(10) NOT NULL,
  `valor` varchar(10) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `damage` varchar(20) NOT NULL,
  `habilidade` varchar(30) NOT NULL,
  `taxa_habilidade` varchar(20) NOT NULL,
  `acc` varchar(30) NOT NULL,
  `ranking` int(10) NOT NULL,
  `especial` varchar(3) NOT NULL,
  `situacao` varchar(2) NOT NULL,
  `situacao_mercado` varchar(2) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_item`
--

INSERT INTO `ganolia_item` (`id`, `nome`, `categoria`, `dados`, `valor`, `raridade`, `damage`, `habilidade`, `taxa_habilidade`, `acc`, `ranking`, `especial`, `situacao`, `situacao_mercado`, `imagem`) VALUES
(1, 'Espada 1', 'Ataque', '', '', 'Lendario', '9;10;11;12', '', '', '7', 2, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e1.png'),
(2, 'Espada 2', 'Ataque', '', '', 'Raro', '8;9;10', '', '', '7', 3, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e2.png'),
(3, 'Espada Nigil', 'Ataque', '', '', 'Raro', '7;8;9;10', '', '', '7', 6, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e3.png'),
(4, 'Espada 4', 'Ataque', '', '', 'Raro', '7;8;9', '', '', '7', 7, '', 'I', 'I', '../Images/Ganolia/Equipamentos/e4.png'),
(5, 'Espada 5', 'Ataque', '', '', 'Raro', '5;6;7;8', '', '', '7', 10, '', 'I', 'I', '../Images/Ganolia/Equipamentos/e5.png'),
(6, '6', 'Ataque', '', '', 'Magico', '4;5;6;7', '', '', '5', 8, '', 'I', 'I', '../Images/Ganolia/Equipamentos/e6.png'),
(7, '7', 'Ataque', '', '', 'Incomum', '3;4;5;6;7;8', '', '', '6', 6, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e7.png'),
(8, '8', 'Ataque', '', '', 'Incomum', '4;5;6;7', '', '', '7', 10, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e8.png'),
(9, '9', 'Ataque', '', '', 'Raro', '5;6;7', '', '', '5', 4, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e9.png'),
(10, '10', 'Ataque', '', '', 'Incomum', '2;3;4;5', '', '', '7', 5, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e10.png'),
(11, '11', 'Ataque', '', '', 'Incomum', '2;3;4;5;6', '', '', '8', 6, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e11.png'),
(12, '12', 'Ataque', '', '', 'Incomum', '2;3;4', '', '', '6', 10, '', 'I', 'I', '../Images/Ganolia/Equipamentos/e12.png'),
(13, '13', 'Ataque', '', '', 'Comum', '1;2;3', '', '', '6', 6, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e13.png'),
(14, '14', 'Ataque', '', '', 'Comum', '1;2', '', '', '8', 8, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e14.png'),
(21, 'Machado', 'Ataque', '', '', 'Raro', '6;7;8;9', '', '', '7', 4, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m1.png'),
(22, 'Machado', 'Ataque', '', '', 'Incomum', ' 3;4;5;6;7;8', '', '', '7', 8, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m2.png'),
(23, 'Machado', 'Ataque', '', '', 'Raro', '5;6;7;8;9', '', '', '6', 9, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m3.png'),
(24, 'Machado', 'Ataque', '', '', 'Magico', '4;5;6', '', '', '7', 7, '', 'I', 'I', '../Images/Ganolia/Equipamentos/m4.png'),
(25, 'Machado', 'Ataque', '', '', 'Incomum', '3;4;5;6;7', '', '', '6', 9, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m5.png'),
(26, 'Machado', 'Ataque', '', '', 'Incomum', '2;3;4;5', '', '', '6', 4, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m6.png'),
(27, 'Machado', 'Ataque', '', '', 'Raro', '7;8;9;10;11', '', '', '7', 3, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m13.png'),
(28, 'Machado', 'Ataque', '', '', 'Incomum', '4;5;6', '', '', '6', 2, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m8.png'),
(30, 'Machado', 'Ataque', '', '', 'Comum', '1;2;3', '', '', '8', 4, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m10.png'),
(31, 'Machado', 'Ataque', '', '', 'Comum', '1;2', '', '', '6', 2, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m11.png'),
(32, 'Machado', 'Ataque', '', '', 'Comum', '2;3;4', '', '', '8', 1, '', 'A', 'I', '../Images/Ganolia/Equipamentos/m12.png'),
(71, 'Arco 1', 'Ataque', '', '', 'Comum', '1;2', '', '', '5', 5, '', 'I', 'I', '../Images/Ganolia/Equipamentos/a1.png'),
(72, 'Arco 2', 'Ataque', '', '', 'Raro', '5;6;7;8', '', '', '7', 2, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a2.png'),
(73, 'Arco 3', 'Ataque', '', '', 'Incomum', '2;3;4;5;6;7', '', '', '7', 1, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a3.png'),
(74, 'Arco 4', 'Ataque', '', '', 'Comum', '1;2;3;4;5', '', '', '5', 7, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a4.png'),
(75, 'Arco 5', 'Ataque', '', '', 'Comum', '1;2', '', '', '7', 7, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a5.png'),
(76, 'Arco 6', 'Ataque', '', '', 'Comum', '1;2;3', '', '', '7', 3, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a6.png'),
(77, 'Arco 7', 'Ataque', '', '', 'Raro', '6;7;8;9;10;11', '', '', '5', 5, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a7.png'),
(78, 'Arco 8', 'Ataque', '', '', 'Incomum', '2;3;4;5', '', '', '5', 8, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a8.png'),
(79, 'Arco 9', 'Ataque', '', '', 'Comum', '1;2;3;4', '', '', '6', 9, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a9.png'),
(80, 'Arco 10', 'Ataque', '', '', 'Raro', '5;6;7;8', '', '', '6', 3, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a10.png'),
(81, 'Arco 11', 'Ataque', '', '', 'Raro', '6;7;8', '', '', '6', 1, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a11.png'),
(82, 'Arco 12', 'Ataque', '', '', 'Lendario', '9;10;11;12', '', '', '6', 1, '', 'A', 'I', '../Images/Ganolia/Equipamentos/a12.png'),
(83, 'Arco 13', 'Ataque', '', '', 'Magico', '4;5;6;7', '', '', '8', 5, '', 'I', 'I', '../Images/Ganolia/Equipamentos/a13.png'),
(84, 'Arco 14', 'Ataque', '', '', 'Incomum', '2;3;4', '', '', '7', 11, '', 'I', 'I', '../Images/Ganolia/Equipamentos/a14.png'),
(85, 'Espada 4', 'Ataque', '', '', 'Comum', '1;2;3', '', '', '7', 2, '', 'A', 'I', '../Images/Ganolia/Equipamentos/e4.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_personagem`
--

CREATE TABLE `ganolia_personagem` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `classe` varchar(20) NOT NULL,
  `sessao` varchar(20) NOT NULL,
  `mochila` varchar(100) NOT NULL,
  `mochila_indice` varchar(200) NOT NULL,
  `especial_id` varchar(200) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_personagem`
--

INSERT INTO `ganolia_personagem` (`id`, `nome`, `classe`, `sessao`, `mochila`, `mochila_indice`, `especial_id`, `usuario_id`) VALUES
(1, 'Exemplar', 'Guerreiro', '', '', '', '', 7),
(2, 'Flor', 'Guerreiro', '', '1;2;3', '', '', 16),
(3, 'Krob', 'Guerreiro', '', '1;50;2;3;12;1;2;2;2;3;3;2;2;2', '0;1;2;3;4;5;6;7;8;9;10;11;12;13', '32', 7),
(26, 'Visko', 'Guerreiro', '', '', '', '', 7),
(99, 'Criatura', 'Criatura', '', '', '', '', 99),
(100, 'rrrq', 'Guerreiro', '', '', '', '', 100),
(101, 'Emerson', 'Guerreiro', '', '', '', '', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_sessao`
--

CREATE TABLE `ganolia_sessao` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `personagem_id` int(11) NOT NULL,
  `personagem_hp` int(11) NOT NULL,
  `criatura_id` int(11) NOT NULL,
  `criatura_hp` int(11) NOT NULL,
  `territorio_id` int(11) NOT NULL,
  `mao` varchar(200) NOT NULL,
  `descarte` varchar(200) NOT NULL,
  `row` int(11) NOT NULL,
  `col` int(11) NOT NULL,
  `fila` int(11) NOT NULL,
  `vez` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_sessao`
--

INSERT INTO `ganolia_sessao` (`id`, `nome`, `personagem_id`, `personagem_hp`, `criatura_id`, `criatura_hp`, `territorio_id`, `mao`, `descarte`, `row`, `col`, `fila`, `vez`) VALUES
(1, 'Aventura', 3, 10, 3, 0, 1, '0;4;5;10;13', '', 3, 1, 1, 'A'),
(2, 'Aventura', 2, 10, 2, 0, 1, '', '', 5, 4, 2, 'I'),
(4, 'Aventura', 1, 0, 1, 76, 1, '', '', 3, 4, 2, 'I');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_sessao_tmp`
--

CREATE TABLE `ganolia_sessao_tmp` (
  `id` int(11) NOT NULL,
  `personagem_id` int(11) NOT NULL,
  `ataque_ativo` varchar(30) NOT NULL,
  `imagem_ataque` varchar(30) NOT NULL,
  `qtd_ataque` int(11) NOT NULL,
  `qtd_moeda` int(11) NOT NULL,
  `qtd_acoes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_sessao_tmp`
--

INSERT INTO `ganolia_sessao_tmp` (`id`, `personagem_id`, `ataque_ativo`, `imagem_ataque`, `qtd_ataque`, `qtd_moeda`, `qtd_acoes`) VALUES
(1, 3, '3;1;2;', '', 3, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_territorio`
--

CREATE TABLE `ganolia_territorio` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(55) NOT NULL,
  `situacao` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_territorio`
--

INSERT INTO `ganolia_territorio` (`id`, `nome`, `descricao`, `situacao`) VALUES
(1, 'Pantano Flutuante', 'Local de drop itens diversas', 'A'),
(2, 'Floresta Oculta', 'Local de drop itens diversas, alguns itens de plantas', 'A'),
(3, 'Skulles', 'Local de drop itens diversas, alguns itens de osso', 'A'),
(4, 'Vale da Lua', 'Local de drop itens diversas, alguns itens brancos', 'A'),
(5, 'Pedras de Fogo', 'Local de drop itens diversas, itens vermelhos, fogo', 'A'),
(6, 'Iceborg', 'Local de drop itens de gelo.', 'A'),
(7, 'Draconia', 'Local de drop itens de dragoes', 'A'),
(8, 'Koppala', 'Local de drop itens fortes', 'A'),
(9, 'Deserto de Xantras', 'Local de drop itens diversas, alguns itens egipicios', 'I'),
(10, 'Prisma', 'Local de drop itens diferentes', 'I'),
(11, 'Orkland', 'Local de drop itens diversas', 'I'),
(12, 'Obscuria', 'Local de drop itens tipo obsidiana', 'I');

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
-- Índices de tabela `ganolia_criatura`
--
ALTER TABLE `ganolia_criatura`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ganolia_historico`
--
ALTER TABLE `ganolia_historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personagem_id` (`personagem_id`);

--
-- Índices de tabela `ganolia_item`
--
ALTER TABLE `ganolia_item`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ganolia_personagem`
--
ALTER TABLE `ganolia_personagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`usuario_id`);

--
-- Índices de tabela `ganolia_sessao`
--
ALTER TABLE `ganolia_sessao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personagem` (`personagem_id`),
  ADD KEY `ganolia_sessao_FK` (`criatura_id`);

--
-- Índices de tabela `ganolia_sessao_tmp`
--
ALTER TABLE `ganolia_sessao_tmp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ganolia_sessao_tmp_FK` (`personagem_id`);

--
-- Índices de tabela `ganolia_territorio`
--
ALTER TABLE `ganolia_territorio`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10710;

--
-- AUTO_INCREMENT de tabela `chs_equipamento`
--
ALTER TABLE `chs_equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `chs_historico`
--
ALTER TABLE `chs_historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT de tabela `chs_marca`
--
ALTER TABLE `chs_marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `chs_problema`
--
ALTER TABLE `chs_problema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `ganolia_criatura`
--
ALTER TABLE `ganolia_criatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de tabela `ganolia_historico`
--
ALTER TABLE `ganolia_historico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT de tabela `ganolia_item`
--
ALTER TABLE `ganolia_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `ganolia_personagem`
--
ALTER TABLE `ganolia_personagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de tabela `ganolia_sessao`
--
ALTER TABLE `ganolia_sessao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ganolia_sessao_tmp`
--
ALTER TABLE `ganolia_sessao_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ganolia_territorio`
--
ALTER TABLE `ganolia_territorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `chs_controle`
--
ALTER TABLE `chs_controle`
  ADD CONSTRAINT `chs_controle_ibfk_1` FOREIGN KEY (`equipamento_id`) REFERENCES `chs_equipamento` (`id`);

--
-- Restrições para tabelas `chs_historico`
--
ALTER TABLE `chs_historico`
  ADD CONSTRAINT `chs_historico_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `chs_controle` (`id`),
  ADD CONSTRAINT `chs_historico_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `ganolia_historico`
--
ALTER TABLE `ganolia_historico`
  ADD CONSTRAINT `ganolia_historico_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `ganolia_personagem` (`id`);

--
-- Restrições para tabelas `ganolia_personagem`
--
ALTER TABLE `ganolia_personagem`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `ganolia_sessao`
--
ALTER TABLE `ganolia_sessao`
  ADD CONSTRAINT `fk_personagem` FOREIGN KEY (`personagem_id`) REFERENCES `ganolia_personagem` (`id`),
  ADD CONSTRAINT `ganolia_sessao_FK` FOREIGN KEY (`criatura_id`) REFERENCES `ganolia_criatura` (`id`);

--
-- Restrições para tabelas `ganolia_sessao_tmp`
--
ALTER TABLE `ganolia_sessao_tmp`
  ADD CONSTRAINT `ganolia_sessao_tmp_FK` FOREIGN KEY (`personagem_id`) REFERENCES `ganolia_personagem` (`id`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_personagem_ganolia` FOREIGN KEY (`personagem_ganolia`) REFERENCES `ganolia_personagem` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
