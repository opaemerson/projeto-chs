-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Jan-2024 às 23:21
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `hp` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `territorio` varchar(30) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `recompensa_id` varchar(30) NOT NULL,
  `probabilidade` varchar(20) NOT NULL,
  `situacao` varchar(2) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_criatura`
--

INSERT INTO `ganolia_criatura` (`id`, `nome`, `hp`, `cp`, `territorio`, `raridade`, `recompensa_id`, `probabilidade`, `situacao`, `imagem`) VALUES
(1, 'Bezon', 0, 2, 'Floresta Oculta', 'Baixo', '1;2', '50;50', '', '../Images/Ganolia/Criaturas/FlorestaOculta/Bezon.jpg'),
(2, 'Durotan', 0, 1, 'Floresta Oculta', 'Baixo', '1;2;3;4', '25;25;25;25', '', ''),
(3, 'Grunt', 0, 0, 'Floresta Oculta', 'Baixo', '', '', '', ''),
(4, 'Jarvin', 0, 0, 'Floresta Oculta', 'Baixo', '', '', '', ''),
(5, 'Nargol', 0, 0, 'Floresta Oculta', 'Baixo', '', '', '', ''),
(6, 'Tweak', 0, 0, 'Floresta Oculta', 'Baixo', '', '', '', ''),
(7, 'Zigzab', 0, 0, 'Floresta Oculta', 'Baixo', '', '', '', ''),
(8, 'Noru', 0, 0, 'Floresta Oculta', 'Medio', '', '', '', ''),
(9, 'Jangle', 0, 0, 'Floresta Oculta', 'Medio', '', '', '', ''),
(10, 'Letoe', 0, 0, 'Floresta Oculta', 'Medio', '', '', '', ''),
(11, 'Frogino', 0, 0, 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(12, 'Grivo', 0, 0, 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(13, 'Nazar', 0, 0, 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(14, 'Ropalo', 0, 0, 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(15, 'Vorup', 0, 0, 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(16, 'Croco', 0, 0, 'Pantano Flutuante', 'Medio', '', '', '', ''),
(17, 'Hazzo', 0, 0, 'Pantano Flutuante', 'Medio', '', '', '', ''),
(18, 'Magentaro', 0, 0, 'Pantano Flutuante', 'Medio', '', '', '', ''),
(19, 'Safir', 0, 0, 'Pantano Flutuante', 'Medio', '', '', '', ''),
(20, 'Torpan', 0, 0, 'Pantano Flutuante', 'Medio', '', '', '', ''),
(21, 'Rellus', 0, 0, 'Pantano Flutuante', 'SemiBoss', '', '', '', ''),
(22, 'Cloflower', 0, 0, 'Skulles', 'Baixo', '', '', '', ''),
(23, 'Doom', 0, 0, 'Skulles', 'Baixo', '', '', '', ''),
(24, 'Dregmor', 0, 0, 'Skulles', 'Baixo', '', '', '', ''),
(25, 'Grimsoul', 0, 0, 'Skulles', 'Baixo', '', '', '', ''),
(26, 'Ripper', 0, 0, 'Skulles', 'Baixo', '', '', '', ''),
(27, 'Vorkus', 0, 0, 'Skulles', 'Baixo', '', '', '', ''),
(28, 'Darak', 0, 0, 'Skulles', 'Medio', '', '', '', ''),
(29, 'Bonecrave', 0, 0, 'Skulles', 'Medio', '', '', '', ''),
(30, 'Netherbone', 0, 0, 'Skulles', 'Medio', '', '', '', ''),
(31, 'Skulldread', 0, 0, 'Skulles', 'Medio', '', '', '', ''),
(32, 'Yonno', 0, 0, 'Skulles', 'SemiBoss', '', '', '', ''),
(33, 'Pepon', 0, 0, 'Vale da Lua', 'Baixo', '', '', '', ''),
(34, 'Mystara', 0, 0, 'Vale da Lua', 'Baixo', '', '', '', ''),
(35, 'Moon', 0, 0, 'Vale da Lua', 'Baixo', '', '', '', ''),
(36, 'Dorvon', 0, 0, 'Vale da Lua', 'Baixo', '', '', '', ''),
(37, 'Honus', 0, 0, 'Vale da Lua', 'Medio', '', '', '', ''),
(38, 'Hyro', 0, 0, 'Vale da Lua', 'Medio', '', '', '', ''),
(39, 'Loris', 0, 0, 'Vale da Lua', 'Medio', '', '', '', ''),
(40, 'Glintara', 0, 0, 'Vale da Lua', 'Medio', '', '', '', ''),
(41, 'Kyron', 0, 0, 'Vale da Lua', 'Alto', '', '', '', ''),
(42, 'Blazen', 0, 0, 'Vale da Lua', 'Alto', '', '', '', ''),
(43, 'Furry', 0, 0, 'Pedras de Fogo', 'Baixo', '', '', '', ''),
(44, 'Kurupin', 0, 0, 'Pedras de Fogo', 'Baixo', '', '', '', ''),
(45, 'Moltorix', 0, 0, 'Pedras de Fogo', 'Baixo', '', '', '', ''),
(46, 'Vulcan', 0, 0, 'Pedras de Fogo', 'Baixo', '', '', '', ''),
(47, 'Nalisk', 0, 0, 'Pedras de Fogo', 'Medio', '', '', '', ''),
(48, 'Azun', 0, 0, 'Pedras de Fogo', 'Medio', '', '', '', ''),
(49, 'Flamir', 0, 0, 'Pedras de Fogo', 'Medio', '', '', '', ''),
(50, 'Fenix', 0, 0, 'Pedras de Fogo', 'Medio', '', '', '', ''),
(51, 'Wuzzo', 0, 0, 'Pedras de Fogo', 'Alto', '', '', '', ''),
(52, 'Scar', 0, 0, 'Pedras de Fogo', 'SemiBoss', '', '', '', ''),
(53, 'Nero', 0, 0, 'Pedras de Fogo', 'SemiBoss', '', '', '', ''),
(54, 'Snowalker', 0, 0, 'Colinas de Gelo', 'Baixo', '1;3', '50;50', '', '../Images/Ganolia/Criaturas/ColinasDeGelo/Snowalker.jpg'),
(55, 'Worpam', 0, 0, 'Colinas de Gelo', 'Baixo', '', '', '', ''),
(56, 'Frost', 0, 0, 'Colinas de Gelo', 'Baixo', '', '', '', ''),
(57, 'Garg', 0, 0, 'Colinas de Gelo', 'Baixo', '', '', '', ''),
(58, 'Urinco', 0, 0, 'Colinas de Gelo', 'Medio', '', '', '', ''),
(59, 'Tillanus', 0, 0, 'Colinas de Gelo', 'Medio', '', '', '', ''),
(60, 'Iceblom', 0, 0, 'Colinas de Gelo', 'Medio', '', '', '', ''),
(61, 'Icedragon', 0, 0, 'Colinas de Gelo', 'Alto', '', '', '', ''),
(62, 'Adra', 0, 0, 'Colinas de Gelo', 'Alto', '', '', '', ''),
(63, 'Abyssal', 0, 0, 'Colinas de Gelo', 'SemiBoss', '', '', '', ''),
(64, 'Kimaris', 0, 0, 'Colinas de Gelo', 'Boss', '', '', '', ''),
(65, 'Aquam', 0, 0, 'Koppala', 'Baixo', '', '', '', ''),
(66, 'Forbie', 0, 0, 'Koppala', 'Baixo', '', '', '', ''),
(67, 'Gale', 0, 0, 'Koppala', 'Baixo', '', '', '', ''),
(68, 'Gloom', 0, 0, 'Koppala', 'Baixo', '', '', '', ''),
(69, 'Erbelim', 0, 0, 'Koppala', 'Medio', '', '', '', ''),
(70, 'Frey', 0, 0, 'Koppala', 'Medio', '', '', '', ''),
(71, 'Vladis', 0, 0, 'Koppala', 'Medio', '', '', '', ''),
(72, 'Zara', 0, 0, 'Koppala', 'Medio', '', '', '', ''),
(73, 'Kova', 0, 0, 'Koppala', 'Alto', '', '', '', ''),
(74, 'Abaddon', 0, 0, 'Koppala', 'Boss', '', '', '', ''),
(75, 'Rex', 0, 0, 'Draconia', 'Baixo', '', '', '', ''),
(76, 'Graven', 0, 0, 'Draconia', 'Baixo', '', '', '', ''),
(77, 'Drakonir', 0, 0, 'Draconia', 'Medio', '', '', '', ''),
(78, 'Gobaron', 0, 0, 'Draconia', 'Alto', '', '', '', ''),
(79, 'Arcticus', 0, 0, 'Draconia', 'SemiBoss', '', '', '', ''),
(80, 'Dollus', 0, 0, 'Draconia', 'SemiBoss', '', '', '', ''),
(99, 'Jogador', 0, 0, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_historico`
--

CREATE TABLE `ganolia_historico` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `personagem_id` int(11) DEFAULT NULL,
  `evento` varchar(255) DEFAULT NULL,
  `item_usado` varchar(30) NOT NULL,
  `horario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_historico`
--

INSERT INTO `ganolia_historico` (`id`, `personagem_id`, `evento`, `item_usado`, `horario`) VALUES
(1, 1, 'Registrado', '', '2023-12-16 03:00:00'),
(3, 2, 'Registrado', '', '2023-12-16 03:00:00'),
(158, 26, 'Registrado', '', '2023-12-16 03:00:00'),
(345, 100, 'Registrado', '', '2023-12-16 03:00:00'),
(352, 3, 'Acertou 2 de dano no alvo.', 'Espada 2', '2024-01-20 16:45:32'),
(353, 3, 'Acertou 5 de dano no alvo.', 'Espada 1', '2024-01-20 17:19:35'),
(354, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 17:19:39'),
(355, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 17:39:02'),
(356, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 20:09:34'),
(357, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 20:10:41'),
(358, 3, 'Acertou 3 de dano no alvo.', 'Espada 3', '2024-01-20 21:03:53'),
(359, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 21:05:26'),
(360, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 21:06:11'),
(361, 3, 'Acertou 3 de dano no alvo.', 'Espada 3', '2024-01-20 21:07:23'),
(362, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 21:48:57'),
(363, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 21:58:49'),
(364, 3, 'Acertou 4 de dano no alvo.', 'Espada 3', '2024-01-20 22:00:20'),
(365, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:06:48'),
(366, 3, 'Acertou 4 de dano no alvo.', 'Espada 3', '2024-01-20 22:09:44'),
(367, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:10:41'),
(368, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:10:50'),
(369, 3, 'Acertou 5 de dano no alvo.', 'Espada 1', '2024-01-20 22:17:25'),
(370, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:24:36'),
(371, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:25:28'),
(372, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:30:02'),
(373, 3, 'Acertou 3 de dano no alvo.', 'Espada 3', '2024-01-20 22:32:06'),
(374, 3, 'Acertou 4 de dano no alvo.', 'Espada 3', '2024-01-20 22:34:35'),
(375, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:36:42'),
(376, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:40:59'),
(377, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:44:24'),
(378, 3, 'Acertou 5 de dano no alvo.', 'Espada 1', '2024-01-20 22:47:19'),
(379, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:48:07'),
(380, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:48:13'),
(381, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-20 22:48:15'),
(382, 3, 'Acertou 6 de dano no alvo.', 'Espada 2', '2024-01-21 15:57:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_item`
--

CREATE TABLE `ganolia_item` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `dados` varchar(10) NOT NULL,
  `valor` varchar(10) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `damage` varchar(20) NOT NULL,
  `habilidade` varchar(30) NOT NULL,
  `taxa_habilidade` varchar(20) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `ranking` int(10) NOT NULL,
  `especial` varchar(3) NOT NULL,
  `situacao` varchar(2) NOT NULL,
  `situacao_mercado` varchar(2) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_item`
--

INSERT INTO `ganolia_item` (`id`, `nome`, `tipo`, `categoria`, `dados`, `valor`, `raridade`, `damage`, `habilidade`, `taxa_habilidade`, `descricao`, `ranking`, `especial`, `situacao`, `situacao_mercado`, `imagem`) VALUES
(1, 'Espada 1', 'Espada', 'Ataque', 'D6', '', 'Comum', '5;5', 'Freeze', '15', '', 5, '', 'A', 'I', '../Images/Ganolia/Espadas/1.png'),
(2, 'Espada 2', 'Espada', 'Ataque', 'D6', '', 'Incomum', '6;6', 'Critico', '20', '', 11, '', 'A', 'I', '../Images/Ganolia/Espadas/2.png'),
(3, 'Espada 3', 'Espada', 'Ataque', 'D8', '10', 'Comum', '3;4', '', '', '', 1, '', 'A', 'A', '../Images/Ganolia/Espadas/3.png'),
(4, 'Espada 4', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 12, '', 'A', 'I', '../Images/Ganolia/Espadas/4.png'),
(5, 'Espada 5', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 9, '', 'A', 'I', '../Images/Ganolia/Espadas/5.png'),
(6, '6', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 8, '', 'A', 'I', '../Images/Ganolia/Espadas/6.png'),
(7, '7', 'Espada', 'Ataque', '', '', 'Incomum', '2;3;4;5', '', '', '', 7, '', 'A', 'I', '../Images/Ganolia/Espadas/7.png'),
(8, '8', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 9, '', 'A', 'I', '../Images/Ganolia/Espadas/8.png'),
(9, '9', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 0, '', 'I', 'I', '../Images/Ganolia/Espadas/9.png'),
(10, '10', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 10, '', 'A', 'I', '../Images/Ganolia/Espadas/10.png'),
(11, '11', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 14, '', 'A', 'I', '../Images/Ganolia/Espadas/11.png'),
(12, '12', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 15, '', 'A', 'I', '../Images/Ganolia/Espadas/12.png'),
(13, '13', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 0, '', 'I', 'I', '../Images/Ganolia/Espadas/13.png'),
(14, '14', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 2, '', 'A', 'I', '../Images/Ganolia/Espadas/14.png'),
(15, '15', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 1, '', 'A', 'I', '../Images/Ganolia/Espadas/15.png'),
(16, '16', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 13, '', 'A', 'I', '../Images/Ganolia/Espadas/16.png'),
(17, '17', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 6, '', 'A', 'I', '../Images/Ganolia/Espadas/17.png'),
(18, '18', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 7, '', 'A', 'I', '../Images/Ganolia/Espadas/18.png'),
(19, '19', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 3, '', 'A', 'I', '../Images/Ganolia/Espadas/19.png'),
(20, '20', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 12, '', 'A', 'I', '../Images/Ganolia/Espadas/20.png'),
(21, '21', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 4, '', 'A', 'I', '../Images/Ganolia/Espadas/21.png'),
(22, '22', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 10, '', 'A', 'I', '../Images/Ganolia/Espadas/22.png'),
(23, '23', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 11, 'A', 'A', 'I', '../Images/Ganolia/Espadas/23.png'),
(24, '24', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 3, '', 'A', 'I', '../Images/Ganolia/Espadas/24.png'),
(25, '25', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 4, '', 'A', 'I', '../Images/Ganolia/Espadas/25.png'),
(26, '26', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 8, '', 'A', 'I', '../Images/Ganolia/Espadas/26.png'),
(27, '27', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 2, 'A', 'A', 'I', '../Images/Ganolia/Espadas/27.png'),
(28, '28', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 5, '', 'A', 'I', '../Images/Ganolia/Espadas/28.png'),
(29, '29', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 2, '', 'A', 'I', '../Images/Ganolia/Espadas/29.png'),
(30, '30', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 9, '', 'A', 'I', '../Images/Ganolia/Espadas/30.png'),
(31, '31', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 0, '', 'I', 'I', '../Images/Ganolia/Espadas/31.png'),
(32, '32', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 4, 'A', 'A', 'I', '../Images/Ganolia/Espadas/32.png'),
(33, '33', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 1, '', 'A', 'I', '../Images/Ganolia/Espadas/33.png'),
(34, '34', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 3, 'A', 'A', 'I', '../Images/Ganolia/Espadas/34.png'),
(35, '35', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 6, '', 'A', 'I', '../Images/Ganolia/Espadas/35.png'),
(36, '36', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 7, '', 'A', 'I', '../Images/Ganolia/Espadas/36.png'),
(37, '37', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 6, '', 'A', 'I', '../Images/Ganolia/Espadas/37.png'),
(38, '38', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 5, '', 'A', 'I', '../Images/Ganolia/Espadas/38.png'),
(39, '39', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 2, '', 'A', 'I', '../Images/Ganolia/Espadas/39.png'),
(40, '40', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 8, '', 'A', 'I', '../Images/Ganolia/Espadas/40.png'),
(41, '41', 'Espada', 'Ataque', '', '', 'Lendario', '', '', '', '', 1, '', 'A', 'I', '../Images/Ganolia/Espadas/41.png'),
(42, '42', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 0, '', 'I', 'I', '../Images/Ganolia/Espadas/42.png'),
(43, '43', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 4, '', 'A', 'I', '../Images/Ganolia/Espadas/43.png'),
(44, '44', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 5, '', 'A', 'I', '../Images/Ganolia/Espadas/44.png'),
(46, '46', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 3, '', 'A', 'I', '../Images/Ganolia/Espadas/46.png'),
(47, '47', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 10, '', 'A', 'I', '../Images/Ganolia/Espadas/47.png'),
(48, '48', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 1, '', 'A', 'I', '../Images/Ganolia/Espadas/48.png'),
(49, '49', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 0, '', 'I', 'I', '../Images/Ganolia/Espadas/49.png'),
(50, 'Moeda 1', 'Moeda', 'Moeda', '', '', '', '', '', '', '', 5, '', 'A', 'I', '../Images/Ganolia/Moedas/1.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_personagem`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_personagem`
--

INSERT INTO `ganolia_personagem` (`id`, `nome`, `classe`, `sessao`, `mochila`, `mochila_indice`, `especial_id`, `usuario_id`) VALUES
(1, 'Exemplar', 'Guerreiro', '', '', '', '', 7),
(2, 'Flor', 'Guerreiro', '', '1;2;3', '', '', 16),
(3, 'Krob', 'Guerreiro', '', '1;50;2;3;12;1;2;2;2;3;3;2;2;2', '0;1;2;3;4;5;6;7;8;9;10;11;12;13', '32', 7),
(26, 'Visko', 'Guerreiro', '', '', '', '', 7),
(99, 'Criatura', 'Criatura', '', '', '', '', 99),
(100, 'rrrq', 'Guerreiro', '', '', '', '', 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_sessao`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_sessao`
--

INSERT INTO `ganolia_sessao` (`id`, `nome`, `personagem_id`, `personagem_hp`, `criatura_id`, `criatura_hp`, `territorio_id`, `mao`, `descarte`, `row`, `col`, `fila`, `vez`) VALUES
(1, 'Aventura', 3, 10, 99, 0, 1, '', ';0;1;5;11;12;3;7;8;10;13', 3, 3, 1, 'A'),
(2, 'Aventura', 2, 10, 99, 0, 1, '', '', 5, 4, 2, 'I'),
(4, 'Aventura', 99, 0, 1, 76, 1, '', '', 3, 4, 2, 'I');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_sessao_tmp`
--

CREATE TABLE `ganolia_sessao_tmp` (
  `id` int(11) NOT NULL,
  `personagem_id` int(11) NOT NULL,
  `ataque_ativo` varchar(30) NOT NULL,
  `imagem_ataque` varchar(30) NOT NULL,
  `qtd_ataque` int(11) NOT NULL,
  `qtd_moeda` int(11) NOT NULL,
  `qtd_acoes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_sessao_tmp`
--

INSERT INTO `ganolia_sessao_tmp` (`id`, `personagem_id`, `ataque_ativo`, `imagem_ataque`, `qtd_ataque`, `qtd_moeda`, `qtd_acoes`) VALUES
(1, 3, '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_territorio`
--

CREATE TABLE `ganolia_territorio` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(55) NOT NULL,
  `situacao` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_territorio`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `heads`
--

INSERT INTO `heads` (`id`, `tag`, `modelo`, `problema`, `data_envio`, `situacao`, `previsao`, `retorno`, `garantia`, `manutencao`, `equipamento_id`) VALUES
(10690, '32', 'C', 'B', '18-10-2023', 'Concluido', 'Concluido', '02-12-2023', 'Nao', 2, 1),
(10696, 'r3443', 'A', 'A', '20-10-2023', 'Enviado', '27-10-2023', 'Pendente', 'Nao', 1, 2),
(10702, '123', 'A', 'B', '15-01-2024', 'Concluido', 'Concluido', '15-01-2024', 'Sim', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`id`, `tag_id`, `usuario_id`) VALUES
(105, 10690, 7),
(111, 10696, 7),
(117, 10702, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id`, `nome`) VALUES
(10, 'A'),
(11, 'B'),
(12, 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `problema`
--

CREATE TABLE `problema` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `problema`
--

INSERT INTO `problema` (`id`, `nome`) VALUES
(5, 'A'),
(6, 'B'),
(7, 'C');

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
  `referencia` varchar(20) NOT NULL,
  `personagem_ganolia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `permissao`, `email`, `referencia`, `personagem_ganolia`) VALUES
(7, 'Emerson', 123, 'Admin', 'admin@admin', '', 3),
(16, 'carol', 123, 'Usuario', 'carol@carol', 'Amigo', 2),
(22, 'Raul', 123, 'Usuario', 'raul@raul', 'Amigo', 1),
(99, 'Criatura', 123, 'Usuario', 'criatura@criatura', 'Amigo', 99),
(100, 'dinho', 123, 'Usuario', 'dinho@dinho', 'Amigo', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ganolia_criatura`
--
ALTER TABLE `ganolia_criatura`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ganolia_historico`
--
ALTER TABLE `ganolia_historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personagem_id` (`personagem_id`);

--
-- Indexes for table `ganolia_item`
--
ALTER TABLE `ganolia_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ganolia_personagem`
--
ALTER TABLE `ganolia_personagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`usuario_id`);

--
-- Indexes for table `ganolia_sessao`
--
ALTER TABLE `ganolia_sessao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personagem` (`personagem_id`),
  ADD KEY `ganolia_sessao_FK` (`criatura_id`);

--
-- Indexes for table `ganolia_sessao_tmp`
--
ALTER TABLE `ganolia_sessao_tmp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ganolia_sessao_tmp_FK` (`personagem_id`);

--
-- Indexes for table `ganolia_territorio`
--
ALTER TABLE `ganolia_territorio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heads`
--
ALTER TABLE `heads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipamento_id` (`equipamento_id`);

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problema`
--
ALTER TABLE `problema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personagem_ganolia` (`personagem_ganolia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ganolia_criatura`
--
ALTER TABLE `ganolia_criatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `ganolia_historico`
--
ALTER TABLE `ganolia_historico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `ganolia_item`
--
ALTER TABLE `ganolia_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `ganolia_personagem`
--
ALTER TABLE `ganolia_personagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `ganolia_sessao`
--
ALTER TABLE `ganolia_sessao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ganolia_sessao_tmp`
--
ALTER TABLE `ganolia_sessao_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ganolia_territorio`
--
ALTER TABLE `ganolia_territorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `heads`
--
ALTER TABLE `heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10703;

--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `problema`
--
ALTER TABLE `problema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ganolia_historico`
--
ALTER TABLE `ganolia_historico`
  ADD CONSTRAINT `ganolia_historico_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `ganolia_personagem` (`id`);

--
-- Limitadores para a tabela `ganolia_personagem`
--
ALTER TABLE `ganolia_personagem`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `ganolia_sessao`
--
ALTER TABLE `ganolia_sessao`
  ADD CONSTRAINT `fk_personagem` FOREIGN KEY (`personagem_id`) REFERENCES `ganolia_personagem` (`id`),
  ADD CONSTRAINT `ganolia_sessao_FK` FOREIGN KEY (`criatura_id`) REFERENCES `ganolia_criatura` (`id`);

--
-- Limitadores para a tabela `ganolia_sessao_tmp`
--
ALTER TABLE `ganolia_sessao_tmp`
  ADD CONSTRAINT `ganolia_sessao_tmp_FK` FOREIGN KEY (`personagem_id`) REFERENCES `ganolia_personagem` (`id`);

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

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_personagem_ganolia` FOREIGN KEY (`personagem_ganolia`) REFERENCES `ganolia_personagem` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
