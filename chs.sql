-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Out-2023 às 21:41
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
  `territorio` varchar(30) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_criatura`
--

INSERT INTO `ganolia_criatura` (`id`, `nome`, `territorio`, `raridade`, `imagem`) VALUES
(1, 'Bicho', 'Floresta', 'Comum', '../Images/arrow.png'),
(2, 'Amigao', 'Floresta', 'Comum', '../Images/arrow.png'),
(3, 'Karro', 'Caverna', 'Incomum', '../Images/arrow.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_item`
--

CREATE TABLE `ganolia_item` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `raridade` varchar(30) NOT NULL,
  `damage` text NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_item`
--

INSERT INTO `ganolia_item` (`id`, `nome`, `tipo`, `categoria`, `raridade`, `damage`, `descricao`, `imagem`) VALUES
(1, 'Teste', 'Espada', 'Ataque', 'Comum', '1;2;3', '', '../Images/arrow.png'),
(2, 'Pudim', 'Machado', 'Ataque', 'Incomum', '2;3;4;5', 'Cair 03 dobra', '../Images/pudim.png'),
(3, 'Conclusao', 'Espada', 'Ataque', 'Comum', '3;4', '', '../Images/concluido.png'),
(4, 'Moeda 5', 'Material', 'Material', 'Comum', '', 'Serve para compra', '../Images/enviadow.png'),
(5, 'Excluir', 'Escudo', 'Defesa', 'Comum', '', '', '../Images/excluir.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganolia_vinculo`
--

CREATE TABLE `ganolia_vinculo` (
  `id` int(11) NOT NULL,
  `criatura_id` int(11) NOT NULL,
  `recompensa_id` text NOT NULL,
  `probabilidade` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ganolia_vinculo`
--

INSERT INTO `ganolia_vinculo` (`id`, `criatura_id`, `recompensa_id`, `probabilidade`) VALUES
(1, 1, '1;2;3', '50;30;20'),
(2, 2, '1;2;3;4;5', '50;10;10;10;10'),
(3, 3, '1;2', '50;50');

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
(10689, '232', 'A', 'A', '23-10-2023', 'Enviado', '30-10-2023', 'Pendente', 'Nao', 2, NULL),
(10690, '32', 'ABA', 'GG', '18-10-2023', 'Enviado', '25-10-2023', 'Pendente', 'Nao', 2, 1),
(10692, '1', 'A', 'A', 'Pendente', 'Pendente', 'Pendente', 'Pendente', 'Nao', 0, NULL),
(10693, 'AASASAC', 'A', 'A', '18-10-2023', 'Concluido', 'Concluido', '19-10-2023', 'Sim', 1, 1),
(10695, 'teste', 'A', 'Y', 'Pendente', 'Pendente', 'Pendente', 'Pendente', 'Nao', 0, 1),
(10696, 'r3443', 'A', 'A', '20-10-2023', 'Enviado', '27-10-2023', 'Pendente', 'Nao', 1, 2),
(10697, 'dasdsadsdas', 'A', 'A', '23-10-2023', 'Concluido', 'Concluido', '23-10-2023', 'Sim', 1, 1),
(10700, '23414', 'B', 'B', 'Pendente', 'Pendente', 'Pendente', 'Pendente', 'Nao', 0, 2);

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
(104, 10689, 7),
(105, 10690, 7),
(107, 10692, 7),
(108, 10693, 7),
(110, 10695, 7),
(111, 10696, 7),
(112, 10697, 7),
(115, 10700, 7);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `permissao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `permissao`) VALUES
(1, 'Wwe', 123, NULL),
(2, 'Abner', 123, NULL),
(3, 'Abceeeee', 444, NULL),
(4, 'Abc', 123, 'Amigo'),
(5, 'Abcd', 123, NULL),
(6, 'Axa', 123, NULL),
(7, 'Emerson', 123, 'Admin'),
(8, 'Teste', 123, NULL),
(9, 'Amigo', 123, 'Usuario'),
(10, 'Baca', 123, 'Usuario'),
(11, 'Guguinha', 123, 'Usuario');

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
-- Indexes for table `ganolia_item`
--
ALTER TABLE `ganolia_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ganolia_vinculo`
--
ALTER TABLE `ganolia_vinculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_criatura_id` (`criatura_id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ganolia_item`
--
ALTER TABLE `ganolia_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `heads`
--
ALTER TABLE `heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10701;

--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `problema`
--
ALTER TABLE `problema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ganolia_vinculo`
--
ALTER TABLE `ganolia_vinculo`
  ADD CONSTRAINT `fk_criatura_id` FOREIGN KEY (`criatura_id`) REFERENCES `ganolia_criatura` (`id`);

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
