-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/11/2023 às 03:11
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `barbearia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id_agendamento` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `agendamento`
--
DELIMITER $$
CREATE TRIGGER `id_agendamento` BEFORE INSERT ON `agendamento` FOR EACH ROW BEGIN
    SET NEW.id_agendamento = FLOOR(RAND() * 1000); -- Substitua 1000 pelo intervalo desejado
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `email` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `dataUpload` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` smallint(6) NOT NULL,
  `nascimento` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nascimento`, `nome`, `telefone`, `email`) VALUES
(502, '1223-03-12', 'Diogo Besel', '123', '2345@123'),
(711, '2002-11-19', 'Diogo Besel', '12345678901', '123@123');

--
-- Acionadores `cliente`
--
DELIMITER $$
CREATE TRIGGER `id_cliente` BEFORE INSERT ON `cliente` FOR EACH ROW BEGIN
    SET NEW.id_cliente = FLOOR(RAND() * 1000); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estabelecimento`
--

CREATE TABLE `estabelecimento` (
  `id_barber` smallint(6) NOT NULL,
  `cep` int(8) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `endereço` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `horarioAtendimento` varchar(50) NOT NULL,
  `serviços` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estabelecimento`
--

INSERT INTO `estabelecimento` (`id_barber`, `cep`, `cidade`, `complemento`, `endereço`, `estado`, `nome`, `telefone`, `email`, `horarioAtendimento`, `serviços`) VALUES
(307, 12345678, 'Florianópolis', 'Casa 101', 'Rua B', 'sc', 'Barber Shop', '2147483647', '321@321', '08:00 - 12:00', 'Corte de cabelo'),
(758, 12345678, 'São José', 'Casa 101', 'Rua A', 'sc', 'Conexão Barbearia', '12345678901', '321@3214', '08:00 - 12:00', 'Corte de cabelo');

--
-- Acionadores `estabelecimento`
--
DELIMITER $$
CREATE TRIGGER `id_estabelecimento` BEFORE INSERT ON `estabelecimento` FOR EACH ROW BEGIN
    SET NEW.id_barber = FLOOR(RAND() * 1000); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`email`, `tipo`, `senha`) VALUES
('123@123', 'cliente', '123'),
('2345@123', 'cliente', '123'),
('321@321', 'estabelecimento', '123'),
('321@3214', 'estabelecimento', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id_agendamento`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_email` (`email`);

--
-- Índices de tabela `estabelecimento`
--
ALTER TABLE `estabelecimento`
  ADD PRIMARY KEY (`id_barber`),
  ADD KEY `fk_email` (`email`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id_agendamento` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=996;

--
-- AUTO_INCREMENT de tabela `estabelecimento`
--
ALTER TABLE `estabelecimento`
  MODIFY `id_barber` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=891;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `estabelecimento`
--
ALTER TABLE `estabelecimento`
  ADD CONSTRAINT `estabelecimento_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
