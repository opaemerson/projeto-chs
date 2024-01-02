-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/01/2024 às 01:49
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
-- Banco de dados: `chs`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipamento`
--

INSERT INTO `equipamento` (`id`, `nome`) VALUES
(1, 'Headphone'),
(2, 'Teclado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_criatura`
--

CREATE TABLE `ganolia_criatura` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `territorio` varchar(30) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `recompensa_id` varchar(30) NOT NULL,
  `probabilidade` varchar(20) NOT NULL,
  `situacao` varchar(2) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_criatura`
--

INSERT INTO `ganolia_criatura` (`id`, `nome`, `territorio`, `raridade`, `recompensa_id`, `probabilidade`, `situacao`, `imagem`) VALUES
(1, 'Bezon', 'Floresta Oculta', 'Baixo', '1;2', '50;50', '', '../Images/Ganolia/Criaturas/FlorestaOculta/Bezon.jpg'),
(2, 'Durotan', 'Floresta Oculta', 'Baixo', '', '', '', ''),
(3, 'Grunt', 'Floresta Oculta', 'Baixo', '', '', '', ''),
(4, 'Jarvin', 'Floresta Oculta', 'Baixo', '', '', '', ''),
(5, 'Nargol', 'Floresta Oculta', 'Baixo', '', '', '', ''),
(6, 'Tweak', 'Floresta Oculta', 'Baixo', '', '', '', ''),
(7, 'Zigzab', 'Floresta Oculta', 'Baixo', '', '', '', ''),
(8, 'Noru', 'Floresta Oculta', 'Medio', '', '', '', ''),
(9, 'Jangle', 'Floresta Oculta', 'Medio', '', '', '', ''),
(10, 'Letoe', 'Floresta Oculta', 'Medio', '', '', '', ''),
(11, 'Frogino', 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(12, 'Grivo', 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(13, 'Nazar', 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(14, 'Ropalo', 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(15, 'Vorup', 'Pantano Flutuante', 'Baixo', '', '', '', ''),
(16, 'Croco', 'Pantano Flutuante', 'Medio', '', '', '', ''),
(17, 'Hazzo', 'Pantano Flutuante', 'Medio', '', '', '', ''),
(18, 'Magentaro', 'Pantano Flutuante', 'Medio', '', '', '', ''),
(19, 'Safir', 'Pantano Flutuante', 'Medio', '', '', '', ''),
(20, 'Torpan', 'Pantano Flutuante', 'Medio', '', '', '', ''),
(21, 'Rellus', 'Pantano Flutuante', 'SemiBoss', '', '', '', ''),
(22, 'Cloflower', 'Skulles', 'Baixo', '', '', '', ''),
(23, 'Doom', 'Skulles', 'Baixo', '', '', '', ''),
(24, 'Dregmor', 'Skulles', 'Baixo', '', '', '', ''),
(25, 'Grimsoul', 'Skulles', 'Baixo', '', '', '', ''),
(26, 'Ripper', 'Skulles', 'Baixo', '', '', '', ''),
(27, 'Vorkus', 'Skulles', 'Baixo', '', '', '', ''),
(28, 'Darak', 'Skulles', 'Medio', '', '', '', ''),
(29, 'Bonecrave', 'Skulles', 'Medio', '', '', '', ''),
(30, 'Netherbone', 'Skulles', 'Medio', '', '', '', ''),
(31, 'Skulldread', 'Skulles', 'Medio', '', '', '', ''),
(32, 'Yonno', 'Skulles', 'SemiBoss', '', '', '', ''),
(33, 'Pepon', 'Vale da Lua', 'Baixo', '', '', '', ''),
(34, 'Mystara', 'Vale da Lua', 'Baixo', '', '', '', ''),
(35, 'Moon', 'Vale da Lua', 'Baixo', '', '', '', ''),
(36, 'Dorvon', 'Vale da Lua', 'Baixo', '', '', '', ''),
(37, 'Honus', 'Vale da Lua', 'Medio', '', '', '', ''),
(38, 'Hyro', 'Vale da Lua', 'Medio', '', '', '', ''),
(39, 'Loris', 'Vale da Lua', 'Medio', '', '', '', ''),
(40, 'Glintara', 'Vale da Lua', 'Medio', '', '', '', ''),
(41, 'Kyron', 'Vale da Lua', 'Alto', '', '', '', ''),
(42, 'Blazen', 'Vale da Lua', 'Alto', '', '', '', ''),
(43, 'Furry', 'Pedras de Fogo', 'Baixo', '', '', '', ''),
(44, 'Kurupin', 'Pedras de Fogo', 'Baixo', '', '', '', ''),
(45, 'Moltorix', 'Pedras de Fogo', 'Baixo', '', '', '', ''),
(46, 'Vulcan', 'Pedras de Fogo', 'Baixo', '', '', '', ''),
(47, 'Nalisk', 'Pedras de Fogo', 'Medio', '', '', '', ''),
(48, 'Azun', 'Pedras de Fogo', 'Medio', '', '', '', ''),
(49, 'Flamir', 'Pedras de Fogo', 'Medio', '', '', '', ''),
(50, 'Fenix', 'Pedras de Fogo', 'Medio', '', '', '', ''),
(51, 'Wuzzo', 'Pedras de Fogo', 'Alto', '', '', '', ''),
(52, 'Scar', 'Pedras de Fogo', 'SemiBoss', '', '', '', ''),
(53, 'Nero', 'Pedras de Fogo', 'SemiBoss', '', '', '', ''),
(54, 'Snowalker', 'Colinas de Gelo', 'Baixo', '1;3', '50;50', '', '../Images/Ganolia/Criaturas/ColinasDeGelo/Snowalker.jpg'),
(55, 'Worpam', 'Colinas de Gelo', 'Baixo', '', '', '', ''),
(56, 'Frost', 'Colinas de Gelo', 'Baixo', '', '', '', ''),
(57, 'Garg', 'Colinas de Gelo', 'Baixo', '', '', '', ''),
(58, 'Urinco', 'Colinas de Gelo', 'Medio', '', '', '', ''),
(59, 'Tillanus', 'Colinas de Gelo', 'Medio', '', '', '', ''),
(60, 'Iceblom', 'Colinas de Gelo', 'Medio', '', '', '', ''),
(61, 'Icedragon', 'Colinas de Gelo', 'Alto', '', '', '', ''),
(62, 'Adra', 'Colinas de Gelo', 'Alto', '', '', '', ''),
(63, 'Abyssal', 'Colinas de Gelo', 'SemiBoss', '', '', '', ''),
(64, 'Kimaris', 'Colinas de Gelo', 'Boss', '', '', '', ''),
(65, 'Aquam', 'Koppala', 'Baixo', '', '', '', ''),
(66, 'Forbie', 'Koppala', 'Baixo', '', '', '', ''),
(67, 'Gale', 'Koppala', 'Baixo', '', '', '', ''),
(68, 'Gloom', 'Koppala', 'Baixo', '', '', '', ''),
(69, 'Erbelim', 'Koppala', 'Medio', '', '', '', ''),
(70, 'Frey', 'Koppala', 'Medio', '', '', '', ''),
(71, 'Vladis', 'Koppala', 'Medio', '', '', '', ''),
(72, 'Zara', 'Koppala', 'Medio', '', '', '', ''),
(73, 'Kova', 'Koppala', 'Alto', '', '', '', ''),
(74, 'Abaddon', 'Koppala', 'Boss', '', '', '', ''),
(75, 'Rex', 'Draconia', 'Baixo', '', '', '', ''),
(76, 'Graven', 'Draconia', 'Baixo', '', '', '', ''),
(77, 'Drakonir', 'Draconia', 'Medio', '', '', '', ''),
(78, 'Gobaron', 'Draconia', 'Alto', '', '', '', ''),
(79, 'Arcticus', 'Draconia', 'SemiBoss', '', '', '', ''),
(80, 'Dollus', 'Draconia', 'SemiBoss', '', '', '', '');

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
(154, 1, 'Acertou 3 de dano no alvo.', 'Espada 1', '2023-12-31 22:24:25'),
(155, 3, 'Acertou 3 de dano no alvo.', 'Espada 1', '2023-12-31 22:29:26'),
(158, 26, 'Registrado', '', '2023-12-16 03:00:00'),
(159, 26, 'Acertou 2 de dano no alvo.', 'Espada 1', '2024-01-01 22:29:57');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ganolia_item`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_item`
--

INSERT INTO `ganolia_item` (`id`, `nome`, `tipo`, `categoria`, `dados`, `valor`, `raridade`, `damage`, `habilidade`, `taxa_habilidade`, `descricao`, `ranking`, `especial`, `situacao`, `situacao_mercado`, `imagem`) VALUES
(1, 'Espada 1', 'Espada', 'Ataque', 'D6', '', 'Comum', '1;2;3', 'Freeze', '15', '', 5, '', 'A', 'I', '../Images/Ganolia/Espadas/1.png'),
(2, 'Espada 2', 'Espada', 'Ataque', 'D6', '', 'Incomum', '2;3;4;5', 'Critico', '20', '', 11, '', 'A', 'I', '../Images/Ganolia/Espadas/2.png'),
(3, 'Espada 3', 'Espada', 'Ataque', 'D8', '10', 'Comum', '', '', '', '', 1, '', 'A', 'A', '../Images/Ganolia/Espadas/3.png'),
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
(23, '23', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 11, '', 'A', 'I', '../Images/Ganolia/Espadas/23.png'),
(24, '24', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 3, '', 'A', 'I', '../Images/Ganolia/Espadas/24.png'),
(25, '25', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 4, '', 'A', 'I', '../Images/Ganolia/Espadas/25.png'),
(26, '26', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 8, '', 'A', 'I', '../Images/Ganolia/Espadas/26.png'),
(27, '27', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 2, '', 'A', 'I', '../Images/Ganolia/Espadas/27.png'),
(28, '28', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 5, '', 'A', 'I', '../Images/Ganolia/Espadas/28.png'),
(29, '29', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 2, '', 'A', 'I', '../Images/Ganolia/Espadas/29.png'),
(30, '30', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 9, '', 'A', 'I', '../Images/Ganolia/Espadas/30.png'),
(31, '31', 'Espada', 'Ataque', '', '', 'Comum', '', '', '', '', 0, '', 'I', 'I', '../Images/Ganolia/Espadas/31.png'),
(32, '32', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 4, '', 'A', 'I', '../Images/Ganolia/Espadas/32.png'),
(33, '33', 'Espada', 'Ataque', '', '', 'Magico', '', '', '', '', 1, '', 'A', 'I', '../Images/Ganolia/Espadas/33.png'),
(34, '34', 'Espada', 'Ataque', '', '', 'Raro', '', '', '', '', 3, '', 'A', 'I', '../Images/Ganolia/Espadas/34.png'),
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
(49, '49', 'Espada', 'Ataque', '', '', 'Incomum', '', '', '', '', 0, '', 'I', 'I', '../Images/Ganolia/Espadas/49.png');

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
  `especial_id` varchar(200) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ganolia_personagem`
--

INSERT INTO `ganolia_personagem` (`id`, `nome`, `classe`, `sessao`, `mochila`, `especial_id`, `usuario_id`) VALUES
(1, 'Exemplar', 'Guerreiro', '', '', '', 7),
(2, 'Flor', 'Guerreiro', '', '', '', 16),
(3, 'Krob', 'Guerreiro', '', '', '', 7),
(26, 'Visko', 'Guerreiro', '', '', '', 7);

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
-- Estrutura para tabela `heads`
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
-- Despejando dados para a tabela `heads`
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
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historico`
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
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marca`
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
-- Estrutura para tabela `problema`
--

CREATE TABLE `problema` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `problema`
--

INSERT INTO `problema` (`id`, `nome`) VALUES
(5, 'A'),
(6, 'B'),
(7, 'GG');

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
(7, 'Emerson', 123, 'Admin', 'admin@admin', '', 26),
(16, 'carol', 123, 'Usuario', 'carol@carol', 'Amigo', 2),
(22, 'Raul', 123, 'Usuario', 'raul@raul', 'Amigo', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `equipamento`
--
ALTER TABLE `equipamento`
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
-- Índices de tabela `ganolia_territorio`
--
ALTER TABLE `ganolia_territorio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `heads`
--
ALTER TABLE `heads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipamento_id` (`equipamento_id`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `problema`
--
ALTER TABLE `problema`
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
-- AUTO_INCREMENT de tabela `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `ganolia_criatura`
--
ALTER TABLE `ganolia_criatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `ganolia_historico`
--
ALTER TABLE `ganolia_historico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de tabela `ganolia_item`
--
ALTER TABLE `ganolia_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `ganolia_personagem`
--
ALTER TABLE `ganolia_personagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `ganolia_territorio`
--
ALTER TABLE `ganolia_territorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

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
-- Restrições para tabelas `heads`
--
ALTER TABLE `heads`
  ADD CONSTRAINT `heads_ibfk_1` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamento` (`id`);

--
-- Restrições para tabelas `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `heads` (`id`),
  ADD CONSTRAINT `historico_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_personagem_ganolia` FOREIGN KEY (`personagem_ganolia`) REFERENCES `ganolia_personagem` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
