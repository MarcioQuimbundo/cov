-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Jul-2018 às 09:04
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cov`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_agenda`
--

CREATE TABLE `tbl_agenda` (
  `id_agenda` int(11) NOT NULL,
  `id_paciente` varchar(11) NOT NULL,
  `id_medico` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `n_consulta` varchar(100) NOT NULL,
  `hora` varchar(22) NOT NULL,
  `data` varchar(22) NOT NULL,
  `servicos` varchar(100) NOT NULL,
  `tipo_servicos` varchar(100) NOT NULL,
  `cancelado` int(11) NOT NULL,
  `data_agenda` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_agenda`
--

INSERT INTO `tbl_agenda` (`id_agenda`, `id_paciente`, `id_medico`, `user_id`, `n_consulta`, `hora`, `data`, `servicos`, `tipo_servicos`, `cancelado`, `data_agenda`) VALUES
(1, '3', '43', '3', 'AGEND0003', '08:00', '2018-07-28', 'exames', 'HCV', 0, '2018-07-28 11:25:59'),
(2, '4', '54', '24', 'AGEND0004', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:29:27'),
(3, '2', '54', '28', 'AGEND0002', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:29:57'),
(4, '1', '', '3', '', '', '', 'gerais', '1 SESSAO DE FISIOTERAPIA', 0, '2018-07-28 13:17:56'),
(5, '5', '', '3', '', '', '', 'estomatologia', 'EXTRACAO DE DENTE SIZO', 0, '2018-07-28 13:19:21'),
(6, '7', '54', '25', 'AGEND0007', '08:02', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:34:34'),
(7, '6', '54', '24', 'AGEND0006', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:35:15'),
(8, '8', '54', '25', 'AGEND0008', '08:03', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:37:23'),
(9, '10', '51', '3', 'AGEND00010', '10:38', '2018-07-27', 'gerais', '15 SESSOES DE FISIOTERAPIA', 0, '2018-07-27 10:49:41'),
(10, '11', '65', '25', 'AGEND00011', '08:05', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:41:38'),
(11, '12', '71', '3', 'AGEND00012', '14:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 13:24:21'),
(12, '13', '65', '25', 'AGEND00013', '08:06', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:44:28'),
(13, '15', '54', '24', 'AGEND00015', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:50:33'),
(14, '16', '65', '25', 'AGEND00016', '08:07', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:51:50'),
(15, '17', '22', '25', 'AGEND00017', '08:08', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:55:04'),
(16, '18', '41', '24', 'AGEND00018', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:55:17'),
(17, '19', '71', '25', 'AGEND00019', '09:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:58:27'),
(18, '20', '54', '24', 'AGEND00020', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:59:20'),
(19, '14', '71', '24', 'AGEND00014', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 08:59:58'),
(20, '9', '71', '28', 'AGEND0009', '08:20', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:01:29'),
(21, '21', '41', '28', 'AGEND00021', '08:50', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:02:44'),
(22, '22', '71', '25', 'AGEND00022', '08:09', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:04:40'),
(23, '24', '54', '24', 'AGEND00024', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:07:46'),
(24, '25', '71', '28', 'AGEND00025', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:08:24'),
(25, '27', '65', '28', 'AGEND00027', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:14:33'),
(26, '26', '40', '24', 'AGEND00026', '07:30', '2018-07-27', 'gerais', 'ATESTADO MEDICO P/SERVICO', 0, '2018-07-27 09:16:55'),
(27, '28', '22', '25', 'AGEND00028', '09:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:17:00'),
(28, '29', '71', '28', 'AGEND00029', '08:50', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:19:43'),
(29, '30', '65', '25', 'AGEND00030', '09:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:20:12'),
(30, '31', '21', '25', 'AGEND00031', '09:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:23:32'),
(31, '32', '41', '24', 'AGEND00032', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:25:26'),
(32, '33', '21', '25', 'AGEND00033', '09:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:27:25'),
(33, '34', '21', '24', 'AGEND00034', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:29:21'),
(34, '35', '21', '25', 'AGEND00035', '09:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:31:23'),
(35, '23', '40', '24', 'AGEND00023', '07:30', '2018-07-27', 'exames', 'ACIDO URICO', 0, '2018-07-27 09:44:16'),
(36, '37', '41', '24', 'AGEND00037', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:43:26'),
(37, '38', '54', '24', 'AGEND00038', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:48:20'),
(38, '39', '54', '25', 'AGEND00039', '09:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:53:04'),
(39, '40', '52', '25', 'AGEND00040', '09:00', '2018-07-27', 'gerais', '4 SESSOES PSICOTERAPIA', 0, '2018-07-27 09:55:49'),
(40, '41', '22', '24', 'AGEND00041', '07:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 09:56:51'),
(41, '42', '52', '25', 'AGEND00042', '09:00', '2018-07-27', 'gerais', '4 SESSOES PSICOTERAPIA', 0, '2018-07-27 10:05:08'),
(42, '43', '51', '1', 'AGEND00043', '10:00', '2018-07-27', 'gerais', '10 SESSOES DE FISIOTERAPIA', 0, '2018-07-27 11:08:58'),
(43, '44', '21', '25', 'AGEND00044', '09:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 11:12:28'),
(44, '45', '40', '3', 'AGEND00045', '12:00', '2018-07-27', 'gerais', 'RELATORIO MEDICO', 0, '2018-07-27 12:24:44'),
(45, '46', '55', '24', 'AGEND00046', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:28:35'),
(46, '47', '55', '25', 'AGEND00047', '12:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:31:49'),
(47, '48', '55', '25', 'AGEND00048', '12:01', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:32:32'),
(48, '49', '55', '24', 'AGEND00049', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:32:34'),
(49, '50', '55', '25', 'AGEND00050', '12:02', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:34:51'),
(50, '51', '20', '24', 'AGEND00051', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:35:02'),
(51, '52', '55', '25', 'AGEND00052', '12:04', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:36:55'),
(52, '53', '20', '24', 'AGEND00053', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:37:06'),
(53, '54', '20', '24', 'AGEND00054', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:40:06'),
(54, '55', '55', '25', 'AGEND00055', '12:06', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:40:22'),
(55, '56', '55', '25', 'AGEND00056', '12:06', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:42:52'),
(56, '57', '40', '3', 'AGEND00057', '13:00', '2018-07-27', 'exames,exames', 'COLESTEROL,ACIDO URICO', 0, '2018-07-27 12:43:34'),
(57, '58', '20', '24', 'AGEND00058', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:43:28'),
(58, '60', '55', '24', 'AGEND00060', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:46:24'),
(59, '59', '55', '25', 'AGEND00059', '12:08', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:46:49'),
(60, '61', '66', '25', 'AGEND00061', '12:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:49:17'),
(61, '62', '20', '24', 'AGEND00062', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:50:12'),
(62, '63', '66', '25', 'AGEND00063', '12:01', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:52:12'),
(63, '64', '20', '24', 'AGEND00064', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:52:34'),
(64, '65', '66', '25', 'AGEND00065', '12:03', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:54:32'),
(65, '66', '20', '24', 'AGEND00066', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:55:13'),
(66, '67', '55', '25', 'AGEND00067', '12:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:57:44'),
(67, '68', '20', '24', 'AGEND00068', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 12:58:03'),
(68, '69', '55', '24', 'AGEND00069', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 13:01:53'),
(69, '70', '52', '25', 'AGEND00070', '12:00', '2018-07-27', 'gerais', '4 SESSOES PSICOTERAPIA', 0, '2018-07-27 13:03:35'),
(70, '71', '55', '24', 'AGEND00071', '11:30', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 13:04:18'),
(71, '73', '20', '25', 'AGEND00073', '12:00', '2018-07-27', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-27 13:42:55'),
(72, '74', '52', '25', 'AGEND00074', '13:00', '2018-07-27', 'gerais', '4 SESSOES PSICOTERAPIA', 0, '2018-07-27 13:53:20'),
(73, '75', '52', '25', 'AGEND00075', '12:00', '2018-08-03', 'gerais', '4 SESSOES PSICOTERAPIA', 0, '2018-07-27 14:32:37'),
(74, '36', '43', '1', 'AGEND00036', '08:00', '2018-07-28', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-28 08:14:25'),
(75, '72', '43', '3', 'AGEND00072', '08:00', '2018-07-28', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-28 09:41:58'),
(76, '76', '55', '3', 'AGEND00076', '08:00', '2018-07-28', 'consultas,consultas', 'CONSULTA NORMAL,CONSULTA NORMAL', 0, '2018-07-28 11:37:13'),
(77, '77', '43', '3', 'AGEND00077', '10:00', '2018-07-28', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-28 12:40:20'),
(78, '78', '', '3', 'AGEND00078', '', '', 'gerais', '20 SESSOES DE FISIOTERAPIA', 0, '2018-07-28 13:46:02'),
(79, '79', '43', '3', 'AGEND00079', '01:10', '2018-07-28', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-28 15:24:43'),
(80, '81', '43', '3', 'AGEND00081', '08:00', '2018-07-29', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-29 05:23:29'),
(81, '82', '43', '3', 'AGEND00082', '08:00', '2018-07-29', 'consultas,consultas', 'CONSULTA NORMAL,CONSULTA NORMAL', 0, '2018-07-29 07:21:53'),
(82, '84', '', '3', 'AGEND00084', '', '', 'gerais', '20 SESSOES DE FISIOTERAPIA', 0, '2018-07-29 07:54:24'),
(83, '85', '43', '3', 'AGEND00085', '11:12', '2018-07-29', 'consultas,consultas', 'CONSULTA NORMAL,CONSULTA NORMAL', 0, '2018-07-29 08:50:57'),
(84, '86', '55', '1', 'AGEND00086', '14:00', '2018-07-29', 'consultas', 'CONSULTA NORMAL', 0, '2018-07-29 09:26:54'),
(85, '87', '', '1', 'AGEND00087', '', '', 'gerais', 'RELATORIO MEDICO', 0, '2018-07-29 09:28:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_agenda_medico`
--

CREATE TABLE `tbl_agenda_medico` (
  `id_agenda_medico` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `medico` varchar(50) NOT NULL,
  `especialidade` varchar(50) NOT NULL,
  `dia_da_semana` varchar(30) NOT NULL,
  `consultorio` varchar(10) NOT NULL,
  `hora_do_inicio` varchar(10) NOT NULL,
  `hora_do_fim` varchar(10) NOT NULL,
  `agendado_por` varchar(50) NOT NULL,
  `data_modificada` varchar(30) NOT NULL,
  `data_agendada` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_antecedentes`
--

CREATE TABLE `tbl_antecedentes` (
  `id_antecedentes` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `transfusoes` varchar(1000) NOT NULL,
  `endocrinas_metabolicas` varchar(1000) NOT NULL,
  `acidentes` varchar(11) NOT NULL,
  `tuberculose` varchar(11) NOT NULL,
  `doencas_renais_cronicas` varchar(11) NOT NULL,
  `alergia` varchar(11) NOT NULL,
  `anemia` varchar(11) NOT NULL,
  `cardiopatias` varchar(11) NOT NULL,
  `diabetes` varchar(11) NOT NULL,
  `etilismo` varchar(11) NOT NULL,
  `tabagismo` varchar(11) NOT NULL,
  `drogas` varchar(11) NOT NULL,
  `dts` varchar(11) NOT NULL,
  `cancro` varchar(11) NOT NULL,
  `hta` varchar(11) NOT NULL,
  `cirurgias` varchar(11) NOT NULL,
  `osteoporose` varchar(11) NOT NULL,
  `avc` varchar(11) NOT NULL,
  `viroses` varchar(11) NOT NULL,
  `data_criada` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_atendimento_medico`
--

CREATE TABLE `tbl_atendimento_medico` (
  `id_atendimento` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `medico` varchar(200) NOT NULL,
  `resumo_atendimento` varchar(500) NOT NULL,
  `data` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_atendimento_medico`
--

INSERT INTO `tbl_atendimento_medico` (`id_atendimento`, `id_paciente`, `medico`, `resumo_atendimento`, `data`) VALUES
(1, 18, '41', '2018-07-27 09:51:16', 'consulta'),
(2, 5, '54', '2018-07-27 09:55:30', 'consulta'),
(3, 6, '54', '2018-07-27 09:55:56', 'consulta'),
(4, 17, '22', '2018-07-27 09:57:26', 'consulta'),
(5, 17, '22', '2018-07-27 10:04:13', 'consulta'),
(6, 21, '41', '2018-07-27 10:07:52', 'consulta'),
(7, 31, '21', '2018-07-27 10:17:08', 'consulta'),
(8, 10, '54', '2018-07-27 10:19:14', 'consulta'),
(9, 32, '41', '2018-07-27 10:20:01', 'consulta'),
(10, 7, '54', '2018-07-27 10:38:27', 'consulta'),
(11, 37, '41', '2018-07-27 10:40:52', 'consulta'),
(12, 35, '21', '2018-07-27 10:54:41', 'consulta'),
(13, 3, '54', '2018-07-27 10:59:31', 'consulta'),
(14, 15, '54', '2018-07-27 11:03:49', 'consulta'),
(15, 20, '54', '2018-07-27 11:22:49', 'consulta'),
(16, 41, '22', '2018-07-27 11:41:12', 'consulta'),
(17, 1, '54', '2018-07-27 12:04:02', 'consulta'),
(18, 8, '54', '2018-07-27 12:04:15', 'consulta'),
(19, 44, '21', '2018-07-27 12:18:39', 'consulta'),
(20, 4, '54', '2018-07-27 12:29:07', 'consulta'),
(21, 38, '54', '2018-07-27 12:52:39', 'consulta'),
(22, 29, '71', '2018-07-27 12:59:50', 'consulta'),
(23, 9, '71', '2018-07-27 13:00:02', 'consulta'),
(24, 19, '71', '2018-07-27 13:00:38', 'consulta'),
(25, 25, '71', '2018-07-27 13:00:55', 'consulta'),
(26, 22, '71', '2018-07-27 13:01:10', 'consulta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_atestado`
--

CREATE TABLE `tbl_atestado` (
  `id_atendimento` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_facturacao` int(11) NOT NULL,
  `data` varchar(15) NOT NULL,
  `servico` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_caixa_abrir`
--

CREATE TABLE `tbl_caixa_abrir` (
  `id_abertura` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `valor_abertura` varchar(50) NOT NULL,
  `nome_funcionario` varchar(30) NOT NULL,
  `data_abertura` varchar(30) NOT NULL,
  `data_abertura_simples` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_caixa_abrir`
--

INSERT INTO `tbl_caixa_abrir` (`id_abertura`, `id_funcionario`, `valor_abertura`, `nome_funcionario`, `data_abertura`, `data_abertura_simples`) VALUES
(1, 12, '0', 'EDMUNDO MANUEL', '27-07-2018 08:06:04', '27-07-2018'),
(2, 4, '1000', 'João ', '27-07-2018 10:23:22', '27-07-2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_caixa_fechar`
--

CREATE TABLE `tbl_caixa_fechar` (
  `id_caixa_fechar` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `valor_fecho` varchar(50) NOT NULL,
  `valor_fecho_mao` varchar(50) NOT NULL,
  `nome_funcionario` varchar(30) NOT NULL,
  `data_fecho` varchar(30) NOT NULL,
  `data_fecho_simples` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_caixa_fechar`
--

INSERT INTO `tbl_caixa_fechar` (`id_caixa_fechar`, `id_funcionario`, `valor_fecho`, `valor_fecho_mao`, `nome_funcionario`, `data_fecho`, `data_fecho_simples`) VALUES
(1, 12, '33600', '0', 'EDMUNDO MANUEL', '27-07-2018 15:30:23', '27-07-2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_configuration`
--

CREATE TABLE `tbl_configuration` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `value` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_configuration`
--

INSERT INTO `tbl_configuration` (`id`, `name`, `value`) VALUES
(1, 'website_name', 'UserCake'),
(2, 'website_url', 'localhost/Theme/'),
(3, 'email', 'noreply@ILoveUserCake.com'),
(4, 'activation', 'false'),
(5, 'resend_activation_threshold', '0'),
(6, 'language', 'models/languages/en.php'),
(7, 'template', 'models/site-templates/default.css');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_consultorio`
--

CREATE TABLE `tbl_consultorio` (
  `id_consultorio` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_consultorio`
--

INSERT INTO `tbl_consultorio` (`id_consultorio`, `nome`, `id_especialidade`, `data_cadastro`) VALUES
(2, 'CONSULTORIO 01', 8, '2018-07-29 09:23:57'),
(3, 'CONSULTÓRIO 02', 2, '2018-07-29 14:54:46'),
(4, 'CONSULTÓRIO 03', 3, '2018-07-29 14:55:09'),
(5, 'CONSULTÓRIO 04', 4, '2018-07-29 14:55:24'),
(6, 'CONSULTÓRIO 05', 5, '2018-07-29 14:55:43'),
(7, 'CONSULTÓRIO 06', 6, '2018-07-29 14:56:06'),
(8, 'CONSULTÓRIO 07', 9, '2018-07-29 14:56:36'),
(9, 'CONSULTÓRIO 08', 10, '2018-07-29 14:58:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_contas_a_pagar`
--

CREATE TABLE `tbl_contas_a_pagar` (
  `id_contas_a_pagar` int(11) NOT NULL,
  `vencimento` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_devolucao_servicos_consultas`
--

CREATE TABLE `tbl_devolucao_servicos_consultas` (
  `id` int(11) NOT NULL,
  `n_fatura` varchar(100) NOT NULL,
  `paciente` varchar(100) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `data_devolucao` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_devolucao_servicos_consultas`
--

INSERT INTO `tbl_devolucao_servicos_consultas` (`id`, `n_fatura`, `paciente`, `servico`, `total`, `motivo`, `data_devolucao`) VALUES
(1, '1', 'Carlos Pascoal Joval', 'CONSULTA NORMAL', '300', 'null', '27-07-2018 08:12:33pm'),
(2, '2', 'Miguel Teixeira', 'CONSULTA NORMAL', '300', 'null', '29-07-2018 08:10:32am');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_devolucao_servicos_estomatologia`
--

CREATE TABLE `tbl_devolucao_servicos_estomatologia` (
  `id` int(11) NOT NULL,
  `n_fatura` varchar(100) NOT NULL,
  `paciente` varchar(100) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `data_devolucao` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_devolucao_servicos_exames`
--

CREATE TABLE `tbl_devolucao_servicos_exames` (
  `id` int(11) NOT NULL,
  `n_fatura` varchar(100) NOT NULL,
  `paciente` varchar(100) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `data_devolucao` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_devolucao_servicos_gerais`
--

CREATE TABLE `tbl_devolucao_servicos_gerais` (
  `id` int(11) NOT NULL,
  `n_fatura` varchar(100) NOT NULL,
  `paciente` varchar(100) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `data_devolucao` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_devolucao_servicos_gerais`
--

INSERT INTO `tbl_devolucao_servicos_gerais` (`id`, `n_fatura`, `paciente`, `servico`, `total`, `motivo`, `data_devolucao`) VALUES
(1, '28', 'Eva EugÃ©nia Miguel Luanda', '4 SESSOES PSICOTERAPIA', '1000', 'null', '29-07-2018 08:07:42am');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_diario_clinico`
--

CREATE TABLE `tbl_diario_clinico` (
  `id_atendimento` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `medico` varchar(200) NOT NULL,
  `resumo_atendimento` varchar(500) NOT NULL,
  `servico` varchar(40) NOT NULL,
  `data` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_diario_clinico`
--

INSERT INTO `tbl_diario_clinico` (`id_atendimento`, `id_paciente`, `medico`, `resumo_atendimento`, `servico`, `data`) VALUES
(1, 6, '54', 'paciente que traze resultados de exame ', 'consultas', '27-07-2018 09:26:19am'),
(2, 18, '41', 'PCTE DE 54 ANOS DE IDADE, COM ANTECEDENTES DE SEPSIS URINARIA RESOCCERNTE, DOR B/V E MAL ESTAR GERAL, SOLICITO AVALIAÃ‡ÃƒO DE UROLOGIA.', 'consultas', '27-07-2018 09:38:37am'),
(3, 5, '54', 'PACIENTE DE 7 ANOS DE IDADE REFERE  APRESSENTAR DOR EM OMBRO BRACO EZQUERDA E COSTA DIREITA LOGO DE CAIDA DE ALTURA MAIS 1/ 2  METRO FAZE   UMA SEMANA.', 'consultas', '27-07-2018 09:43:20am'),
(4, 17, '22', ' PTE DE 38 ANOS DE IDADE SEXO MASCULINO QUE OCORREU AOS NOSSOS SERVIÃ‡OS VINDO DO DOMICILIO AO REFERIR-SE DE DOR NA REGIÃƒO TORAXICA, DOR ARTICULAR, MIALGIA, QUEIXANDO-SE HÃ+ MENOS 3 MESES, NEGA OUTRA QUEIXAS. PTE QUE SE ENCONTRA NEUROGICAMENTE, CALMO, CONSCIENTE, COLABORANTE,ORIENTADO EM TEMPO E EM PESSOA, HEMODINAMICAMENTE COM ALTERAÃ‡ÃƒO CONFORME OS PARAMETROS VITAIS REGISTRADOS NO GRAFICO COM P.A. DE 163MMHG DE SISTOLICA E 86 DE DISTOLICA, SOLICITO EXAMES DE BIOQUIMICAS, HEMATOLOGICOS E UM ', 'consultas', '27-07-2018 09:55:54am'),
(5, 21, '41', 'PCTE DE 34 ANOS COM HISTORIA DE LOMBOCIATALGIA A ESQUERDA , HÃ MAIS DE 8 MESES, QUE NÃƒO ALEVIA COM TRATAMENTO ANALGSICO, \r\nMOTIVO QUE A OBRIGA A ACORRER A NOSSA INSTITUIÃ‡ÃƒO.\r\nSOLICITO EXAMES DE RX DA COLUNA LOMB-SAGRADA, AVALIAÃ‡ÃƒO DE FISIOTERAPIA E ORTOPEDIA.\r\nID: LOMBOCIATALGIA  CRONICA AGUDIZADA.', 'consultas', '27-07-2018 10:00:18am'),
(6, 8, '54', 'PACIENTE  DE 33 ANOS DE IDADE REFERE APRESENTER DOR EM PITO QUE NAO  CONSIGUE  DORMIR ASOCIADO  A DOR DE COLUNA LOMBAR.  ', 'consultas', '27-07-2018 10:05:24am'),
(7, 31, '21', 'QUEIXAS: DOR NO MEMBRO INFERIOR ESQUERDO , DOR LOMBAR  A + OU - 6 MESES E IRRADIA ATÃ‰ AOS MEMBROS INFERIORES , CÃƒIBRAS NO MEMBROS INFERIORES ,  E COM DOR NO MEMBRO ESQUERDO , HIPERTENSO SEM SEGUIMENTO . AO EXAME FÃSICO PTE CALMA COLABORANTE ORIENTADA NO TEMPO E NO ESPAÃ‡O  MUCOSAS CORADAS ,  BOCA:  COM TÃRTARA ( ESTOMATOLOGIA)  PESCOÃ‡O COM DOR  E  SEM DIFICULDADE DE MOVIMENTO DE ROTAÃ‡ÃƒO A DIREITA E ESQUERDA , A BDOMEM  , PLANO E SEM DOR  A PALPAÃ‡ÃƒO  MMSS- SIMÃ‰TRICOS E COM DOR MEMBRO ES', 'consultas', '27-07-2018 10:11:24am'),
(8, 32, '41', 'PCTE DE 56 ANOS, CAOM ANTECEDENTES APARENTE DE SAUDE ATE HÃ 15 DIAS, QUE AO DESPERTAR NOTOU DIFICULDADE DE MANTER SE DE PE, POR DIMINUIÃ‡ÃƒO DA FORÃ‡A MUSCULAR DA PERNA ESQUERDA.\r\nID: MONOPARESIA DO MI ESQUERDO.\r\nSOLICITO ESTUDO E AVALIÃ‡ÃƒO DE FISIATRIA.', 'consultas', '27-07-2018 10:13:30am'),
(9, 10, '54', 'PACIENTE QUUE ACODE COM RESULTADO DE ECOGRAFIA  QUE INFORMA SINAIS DE TRAUMA MUSCULAR.  NAO OTRAS ALTERACAES.', 'consultas', '27-07-2018 10:16:51am'),
(10, 7, '54', 'PACIENTE COM ANTECEDENTES  E DIABETES MELLITUS FAZE 5 ANOS PARA O   QUAL LEVA TRATAMENTO METAFORMINA E DAUNIL , REFERE QUE EM MES DE ABRIL TIVE INTERNADO COM DESCOMPENSACAO DE DIABETES E DISMINUÃ‡AO DA FORÃ‡A MUSCULARA D HEMICORPO DIREITO COM TAC NEGATIVA . AGORA ACODE COM DIFICULDADE A MARCHA. ', 'consultas', '27-07-2018 10:32:24am'),
(11, 37, '41', 'PCTE PARAPARETICO HÃ UM ANO E TRS MESE APOS TRAUMATISMO LOMBAR ,EM ACIDENTE DE VIAÃ‡ÃƒO. ACORRE A CONSULTA POR APRESENTAR DOR ABDOMINAL DIFUSO MAIS MARCADO NO EPIGÃSTRIO, INDICO TRATAMENTO SINTOMÃTICO E SOLICITO ACOMPANHAMENTO NA CONSULTA DE MEDICINA INTERNA.', 'consultas', '27-07-2018 10:35:32am'),
(12, 35, '21', ' PTE DE 15 ANOS DE IDADE COM HEMIPARESIA  O PAI REFERE QUE  O MESMO TER CUMPRIDO COM O CALENDÃRIO DE VACINAÃ‡ÃƒO , DOR NO MEMBRO INFERIOR ESQUERDO DOR NO MEMBRO SUPERIOR ESQUERDO ,AO EXAME FÃSICO PTE   CALMO COLABORANTE ORIENTADO NO TEMPO E NO ESPAÃ‡O , MUCOSAS CORADAS , PESCOÃ‡O SEM DOR , BOCA SEM HALITOSE , TÃ“RAX ASSIMÃ‰TRICO NA REGIÃƒO ANTERIOR E POSTERIOR O MESMO FOI LEVADO PARA FAZ O TRATAMENTO DE GIBA  NO PERÃODO DE 6 MESES SEM RESULTADO  , ABDOMEM PLANO E COM DOR NO HIPOCONDRÃACO ESQ', 'consultas', '27-07-2018 10:48:20am'),
(13, 15, '54', 'PACIENTE QUE ACODE COM RESULTADO DE EXAMENES HEMOGRAMA GLICEMIA COLESTERL TRIGLICERIDOS ENTRE LIMITES NORMAIS  RADIOLOGIA COLOMNA LOMBAR CON SINAIS DE ARTROSE . \r\n ', 'consultas', '27-07-2018 10:55:16am'),
(14, 20, '54', 'PACIENTE  DE 58 ANOS DE IDADE COM ANTECEDENTE DE  HTA  TTO COM HIDROCLOROTIAZIDA , AMLODIPINO . REFERE APRESENTAR DOR EM OMBRO , E CACANEO EZQUERDO , ', 'consultas', '27-07-2018 11:12:43am'),
(15, 29, '71', 'bynu89j9+yrd4ryjiko', 'consultas', '27-07-2018 11:17:12am'),
(16, 41, '22', 'PTE DE 55 ANOS DE IDADE SEXO FEMININO QUE ACORREU AOS NOSSOS SEVIÃ‡OS VINDA DO DOMICLIO AO APRESENTAR AS SERGUELAS DE HEMIPARESIA A ESQDA POIS UM EPISODIO DE A.V.C. HEMORRAGICO OCORRIDO NO MES DE MAIO NO DIA DIA 10 DO CORENTE ANO , PTE CALMO , CONSCIENTE, COLABORANTE, ORIENTADA EM TEMPO E EM PESSOA,HEMODINAMICAMENTE COM ALTERAÃ‡OES NOS NIVEIS TENSIONAIS DE 170/90MMHG, RECOMENDA-SE A CONSULTA DE NEUROLOGIA E CONSULTA DE FISIATRIA, ASSIM COMO ATOMA DE ANTI-HIPERTENSIVOS.TAIS COMO AMLODIPINA 10MG, ', 'consultas', '27-07-2018 11:40:55am'),
(17, 29, '71', 'dor lombar, dor e inflamaÃ§Ã£o  dos pÃ©s dor de dente, cefaleias, cervicoalgias, quadro clinico de evoluÃ§Ã£o arrastada', 'consultas', '27-07-2018 11:42:12am'),
(18, 44, '21', 'ghhjjkk.lllÃ§-Ã§-Ã§Ã§-Ã§-Ã§-Ã§', 'consultas', '27-07-2018 11:58:11am'),
(19, 9, '71', 'EDEMA FACIAL, ANTECEDENTES DE PARALISIA FACIAL, OSTEOMIOARTRALGIA, SENSAÃ‡ÃƒO FEBRIL, CAIMBRAS NO HEMICORPO DTO. QUADRO CLINICO QUE EVOLUI HA UM ANO. REFERE CONSULTAS NO HOSPITAL MUNICIPAL DE V INA E HOSPITAL AMÃ‰RICO BOAVIDA', 'consultas', '27-07-2018 11:59:46am'),
(20, 19, '71', 'PTE SEGUIDA EM CONSULTAS DE MEDICINA. HOJE TRAZ EXAMES SOLICITADOS:\r\nGLIC-90; COLEST-251; AC, URIC-5,81; HBS-NEG; VDRL-NEG; TASO-NEG; FR-NEG, URINA COM ALGUMAS BACTÃ‰RIAS; HEMOGRAM SEM ALTS DE REALCE; ', 'consultas', '27-07-2018 12:08:19pm'),
(21, 44, '21', 'PTE COM DOR LOMBAR A + OU 7 MESES A MESMA Ã‰ ACOMPANHADA  NO C.O.V NA SESSÃƒO DE FISIOTERAPIA COM HD: ESPONDIOLARTROSE  . A MESMA REFERE CÃƒIBRA NOS DEDOS DO MEMBROS SUPERIORES E INFERIORES , CALMA COLABORANTE ORIENTADA NO TEMPO E NO ESPAÃ‡O   MUCOSAS CORADAS , ATEROSCLERÃ“TICAS , TÃ“RAX SIMÃ‰TRICO , ABDOMEM PLANO E SEM DOR A PALPAÃ‡ÃƒO , MMSS - SIMÃ‰TRICOS  E MMII SIMÃ‰TRICOS E COM DOR .S.V 101/73MMHG/  P-80 / B/MN .', 'consultas', '27-07-2018 12:16:48pm'),
(22, 25, '71', 'SEGUIDA EM MEDICINA POR  CERVICOALGIAS, CEFALEIAS, DOR EPIGASTRICA, AQUECIMENTO DO CORPO. TRAZ EXAMES SOLICITADOS NA ULTIMA CONSULTA.GLIC-79; VS-25; WIDAL-1/160; JBS-NEG; HIV-NEG; VDRL-NEG; URINA COM ALGUMAS BACTÃ‰RIAS.', 'consultas', '27-07-2018 12:25:47pm'),
(23, 22, '71', 'PTE HIPERTENSA E DIABETICA, MEDICADA POR IECAS E ARA, BEM COMO POR ANTIDIABETICOS ORAIS. TRAZ  RESULTADOS.\r\nHGB-11,6; PP-NEG; URINA COM ALGUNS LEUCOCITOS; GLICOSE-220; CREAT-0,9; WIDAL-NEG; \r\nRX DA COLUNA LOMBOSAGRADA EVIDENCIA SINAIS DE ESPONDILOARTROSE.', 'consultas', '27-07-2018 12:35:30pm'),
(24, 36, '43', 'ytwefdytedgfyusdgfysdgfnsduyfgsdnfsydgfnsdufygodnyugas auysd asiudgyas dyguasdas dasuyglds dasygdua slduyasgd sluygda sdluyasgd slyugs dbasyudgu asuydagsd sad', '', '28-07-2018 09:03:36am'),
(25, 36, '43', 'teste\r\nteste\r\nteste', '', '28-07-2018 09:23:19am'),
(26, 72, '43', 'teste', 'consultas', '28-07-2018 01:58:47pm'),
(27, 79, '43', 'asuioah dasidg siagys diaghasiduy asiduyhas iduhasuidhf iudfh isufh aiousdfh diufha sdioufhas diufhasduio fhasduifh asidufhasduif hasidufh sdiufh iuuuufasiudfh sidufh isaudfh siudfh sdf\r\nsf sdfauhsdf asdf\r\nasd fadsf fasudhf adfa\r\nf asdfasdifuagsdf asiduafh sdfa\r\nsdf asdfasdifasgd fasidufga sdfasd\r\nfa dsfasdighf aiue sehiuh fudishf aiusdfh iush dfsd', 'consultas', '28-07-2018 03:33:53pm'),
(28, 81, '43', 'swdbahsdjkbasdbdasjbasdjabhdasjhas dasliydgabs jdbasgvy dlyagsdl asyugasd aysgdas dasyugdv uaysgd ausygda sdasd', 'consultas', '29-07-2018 05:36:45am'),
(29, 81, '43', 'Ã©Ãª', 'consultas', '29-07-2018 05:50:58am'),
(30, 82, '43', 'kjkjsnsdask dskbda sygbd ujgvydf akdjhyvas djfsdgv fkasdghvfa hdfasdgv askhdg vasdkvasdv', 'consultas', '29-07-2018 07:29:58am'),
(31, 85, '43', 'jgvschjxvajsbchjabscasjcasascablkbksjbcajksbcascas\r\nskjcavbsjckasbckaucsbakshcblh<bdsclhbdscjhbdasvjbhadsvjabvlasdjvbasdvasd\r\nvasdvasdvasdjavbdakjdsvasdv', 'consultas', '29-07-2018 09:01:43am');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_entrada_de_produto`
--

CREATE TABLE `tbl_entrada_de_produto` (
  `id_entrada_produto` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `preco_unitario` varchar(30) NOT NULL,
  `data_entrada_produto` varchar(22) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_entrada_de_produto_farmacia`
--

CREATE TABLE `tbl_entrada_de_produto_farmacia` (
  `id_entrada_produto` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `preco_unitario` varchar(30) NOT NULL,
  `data_entrada_produto` varchar(22) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_entrada_de_produto_farmacia`
--

INSERT INTO `tbl_entrada_de_produto_farmacia` (`id_entrada_produto`, `id_produto`, `qtde`, `preco_unitario`, `data_entrada_produto`, `user_id`) VALUES
(1, 1, 1000, '00', '2018-07-26 15:28:20', 69),
(2, 1, 4, '100', '2018-07-26 15:38:54', 1),
(3, 1, 4, '100', '2018-07-26 15:45:51', 1),
(4, 4, 10, '00', '2018-07-26 14:40:27', 59);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_especialidade`
--

CREATE TABLE `tbl_especialidade` (
  `id_especialidade` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data_criada` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_especialidade`
--

INSERT INTO `tbl_especialidade` (`id_especialidade`, `nome`, `data_criada`) VALUES
(1, 'CLINICA GERAL', '2018-07-22 15:33:15'),
(2, 'MEDICINA INTERNA', '2018-07-22 15:33:38'),
(3, 'UROLOGIA', '2018-07-22 15:33:58'),
(4, 'NEUROLOGIA', '2018-07-22 15:34:16'),
(5, 'FISIOTERAPIA', '2018-07-22 15:34:34'),
(6, 'FISIATRIA', '2018-07-22 15:34:50'),
(7, 'PSICOLOGIA', '2018-07-22 15:35:10'),
(8, 'ORTOPEDIA', '2018-07-22 15:35:33'),
(9, 'ODONTOLOGIA/ESTOMATOLOGIA', '2018-07-22 15:36:27'),
(10, 'SALA DE OBSERVACAO', '2018-07-25 19:49:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_especialidade_medico`
--

CREATE TABLE `tbl_especialidade_medico` (
  `id_especialidade_medico` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `data_criada` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_estoque`
--

CREATE TABLE `tbl_estoque` (
  `id_estoque` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `preco_unitario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_estoque`
--

INSERT INTO `tbl_estoque` (`id_estoque`, `id_produto`, `qtde`, `preco_unitario`) VALUES
(1, 1, 0, '1000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_estoque_farmacia`
--

CREATE TABLE `tbl_estoque_farmacia` (
  `id_estoque` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `preco_unitario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_estoque_farmacia`
--

INSERT INTO `tbl_estoque_farmacia` (`id_estoque`, `id_produto`, `qtde`, `preco_unitario`) VALUES
(1, 1, 108, '100'),
(2, 3, 0, '100'),
(3, 4, 10, '00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_exame_clinico`
--

CREATE TABLE `tbl_exame_clinico` (
  `id_exame_clinico` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `grupo` varchar(100) NOT NULL,
  `data_criacao` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_exame_clinico`
--

INSERT INTO `tbl_exame_clinico` (`id_exame_clinico`, `descricao`, `grupo`, `data_criacao`) VALUES
(1, 'Glicose', 'BioquÃ­mica', '13-04-2018'),
(2, 'Gota Espessa', 'HematolÃ³gia', '13-04-2018'),
(3, 'Ecografia Pélvica', 'Imagiologia', '13-04-2018'),
(4, 'Fezes', 'Parasitológicos', '13-04-2018'),
(5, 'Rx Peria Pical', 'Raio X07', '13-04-2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_exame_clinico_consultado`
--

CREATE TABLE `tbl_exame_clinico_consultado` (
  `exame_clinico_id` int(11) NOT NULL,
  `id_paciente` varchar(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `exame_clinico` varchar(255) NOT NULL,
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_exame_clinico_consultado`
--

INSERT INTO `tbl_exame_clinico_consultado` (`exame_clinico_id`, `id_paciente`, `id_medico`, `exame_clinico`, `data_cadastro`) VALUES
(1, '3', 54, ' resultado de urina: amarelo  aspecto turbio resto normal  ', '27-07-2018 09:09:40am'),
(2, '6', 54, 'HEMOGRAMA  12OG/L  COLESTEROL 217 MMOL/ LM TRIGLICERIDOS  202MMOL/ L  AC URICO 5,36 GLICOSE 74 MMOL/ L ', '27-07-2018 09:29:44am'),
(3, '5', 54, 'SOMA: DOR A PALPACAO EM COSTA DIREITA, OMB RO, BRAÃ‡O EZQUERDA  NAO LIMITACAO ARTCULAR', '27-07-2018 09:46:05am'),
(4, '8', 54, 'MUCOSAS COREADAS E HUMIDAS TCS NAO INFILTRADO APARATO RESPIRATORIO MV NORMAL FR 20 BATIM / MINAPARATO CARDIOVASCULAR  RC RITMICOS E AUDIBLES NAO SOPLOS FC 80 MIN\r\nSOMA NORMAL ', '27-07-2018 10:09:55am'),
(5, '31', 21, 'PEÃ‡O RX TOTAL DA COLUNA AP / PERFIL COM RELATÃ“RIO \r\n\r\n', '27-07-2018 10:13:00am'),
(6, '29', 71, 'urina, hemograma, vs, pcr, factor reumatico, glicemia, ', '27-07-2018 11:44:31am'),
(7, '36', 43, 'fkushdisbd fisydgfb asuygf auygdfbvad fyugvabdf asdy fvahdgf vashdgf vadhutdas fasdu avdfadtv fdt fvausdgtv fasudkfsadf\r\ndfasdfasdfsadf\r\nsdfsfsadf\r\nsdfsd', '28-07-2018 09:21:40am'),
(8, '79', 43, 'siodnasijaioÃ§ajsd\r\nsdansuidabnsduiÃ§ahnduiasdnasiduas\r\ndasndasiudanslÃ§duiansda\r\nsdasndasiduasbndasda\r\nsdasuibdasjkdbasda\r\n', '28-07-2018 03:39:44pm'),
(9, '81', 43, 'xÃªnia', '29-07-2018 05:41:58am'),
(10, '81', 43, 'XÃªnia', '29-07-2018 05:45:35am'),
(11, '81', 43, 'Xênia', '29-07-2018 05:47:49am'),
(12, '85', 43, '1) - ioushdnausiohdnascasc\r\n2) - suodnbaskduansdasdasd\r\n3) - sadnaskdasdsajdnakadsd\r\n4) - sauidnbasukdnaskndaksndas', '29-07-2018 08:59:52am');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_exame_fisico`
--

CREATE TABLE `tbl_exame_fisico` (
  `id_exame_fisico` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `objectivo_principal` varchar(1000) NOT NULL,
  `genito_unitario` varchar(1000) NOT NULL,
  `cabeca` varchar(100) NOT NULL,
  `membros_superiores` varchar(100) NOT NULL,
  `membros_inferiores` varchar(100) NOT NULL,
  `pescoco` varchar(100) NOT NULL,
  `torax` varchar(255) NOT NULL,
  `sistema_nervoso` varchar(100) NOT NULL,
  `abdomen` varchar(100) NOT NULL,
  `data_criada` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_facturacao`
--

CREATE TABLE `tbl_facturacao` (
  `facturacao_id` int(11) NOT NULL,
  `n_factura` varchar(22) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `nome_paciente` varchar(100) NOT NULL,
  `funcionario` int(11) NOT NULL,
  `idade` varchar(22) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `tipoServico` varchar(50) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `total` varchar(11) NOT NULL,
  `troco` varchar(22) NOT NULL,
  `total_recebido` varchar(22) NOT NULL,
  `tipo_pagamento` varchar(22) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `d_servicos_gerais` int(11) NOT NULL,
  `d_servicos_exames` int(11) NOT NULL,
  `d_servicos_consultas` int(11) NOT NULL,
  `d_servicos_estomatologia` int(11) NOT NULL,
  `data` varchar(22) NOT NULL,
  `data_simples` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_facturacao`
--

INSERT INTO `tbl_facturacao` (`facturacao_id`, `n_factura`, `id_paciente`, `nome_paciente`, `funcionario`, `idade`, `telefone`, `tipoServico`, `servico`, `total`, `troco`, `total_recebido`, `tipo_pagamento`, `referencia`, `d_servicos_gerais`, `d_servicos_exames`, `d_servicos_consultas`, `d_servicos_estomatologia`, `data`, `data_simples`) VALUES
(1, 'COVV0003', 3, 'Carlos Pascoal Joval', 12, '1982-04-10', '925339500', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 1, 0, '27-07-2018 08:26:36', '27-07-2018'),
(2, 'COVV0004', 4, 'Miguel Teixeira', 12, '1966-01-01', '922226920', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 1, 0, '27-07-2018 08:35:23', '27-07-2018'),
(3, 'COVV0006', 6, 'Isabel Jose Manuel Sambo', 12, '1958-08-20', '931993741', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:37:32', '27-07-2018'),
(4, 'COVV0007', 7, 'JosÃ© Augusto Ferreira', 12, '1969-07-10', '923966182', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:41:45', '27-07-2018'),
(5, 'COVV00011', 11, 'Teresa AntÃ³nio', 12, '1965-03-15', '926691069', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:43:19', '27-07-2018'),
(6, 'COVV0008', 8, 'Arlete Francisco Cardoso', 12, '1984-10-12', '', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:44:42', '27-07-2018'),
(7, 'COVV00010', 10, 'Cofuilson Bernardo JosÃ©', 12, '1979-02-14', '923585412', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:46:01', '27-07-2018'),
(8, 'COVV00013', 13, 'Maria Filomena Muecheno', 12, '1974-01-09', '924069435', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:51:42', '27-07-2018'),
(9, 'COVV00016', 16, 'Isabel Mandele Jacunana', 12, '1972-10-25', '948952056', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:53:39', '27-07-2018'),
(10, 'COVV00015', 15, 'Basilio Costa', 12, '1961-06-01', '923428901', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:55:34', '27-07-2018'),
(11, 'COVV0005', 5, 'Ana Lerato dos santos', 12, '2010-09-27', '923666127', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 08:57:47', '27-07-2018'),
(12, 'COVV00020', 20, 'Maria Cristina Da Silva jeronimo', 12, '1960-04-09', '930513590', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:03:43', '27-07-2018'),
(13, 'COVV00021', 21, 'Maria JosÃ© Milombe', 12, '1983-10-03', '923681270', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:05:28', '27-07-2018'),
(14, 'COVV00018', 18, 'MArgarida Natividade Jose Da Silva', 12, '1964-03-24', '932236000', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:10:00', '27-07-2018'),
(15, 'COVV00025', 25, 'Isabel MaLungo Saqui', 12, '1981-03-19', '925035003', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:11:23', '27-07-2018'),
(16, 'COVV00017', 17, 'Francisco Paulo JosÃ©', 12, '1980-09-25', '928222270', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:11:56', '27-07-2018'),
(17, 'COVV00019', 19, 'Filomena AntÃ³nio LuÃ­s de Oliveira', 12, '1966-12-05', '928635688', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:13:04', '27-07-2018'),
(18, 'COVV0009', 9, 'Carmela JosÃ© Panzo', 12, '1969-08-24', '', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:15:24', '27-07-2018'),
(19, 'COVV00032', 32, 'Manuel Antonio SebastiÃ£o', 12, '1962-06-05', '924688901', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:36:52', '27-07-2018'),
(20, 'COVV00035', 35, 'Zito joaquim Domingos', 12, '2003-07-04', '945742603', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:40:33', '27-07-2018'),
(21, 'COVV00030', 30, 'Enisvaldo Elisio Fernandes da Costa', 12, '2001-10-27', '922936138', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:41:06', '27-07-2018'),
(22, 'COVV00031', 31, 'Domingas AndrÃ©', 12, '1964-02-24', '924688901', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:41:41', '27-07-2018'),
(23, 'COVV00029', 29, 'Alice edilia Nambuta Fernando', 12, '1973-02-07', '924227155', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:42:45', '27-07-2018'),
(24, 'COVV00037', 37, 'Lauindo JoÃ£o Sawino', 12, '1974-11-25', '937105883', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:46:06', '27-07-2018'),
(25, 'COVV00038', 38, 'Edson Sidney Rocha Henrrique', 12, '1993-06-01', '935010511', 'consultas', 'CONSULTA NORMAL', '300', '1700', '2000', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:53:14', '27-07-2018'),
(26, 'COVV00022', 22, 'Rosa Maria Tchombe Quirino', 12, '1958-01-07', '', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:54:34', '27-07-2018'),
(27, 'COVV00041', 41, 'Maria Joaquim Kahanda', 12, '1963-07-07', '922585011', 'consultas', 'CONSULTA NORMAL', '300', '700', '1000', 'Cash', '', 0, 0, 0, 0, '27-07-2018 09:59:24', '27-07-2018'),
(28, 'COVV00042', 42, 'Eva EugÃ©nia Miguel Luanda', 12, '1988-08-27', '925965363', 'gerais', '4 SESSOES PSICOTERAPIA', '1000', '0', '1000', 'Cash', '', 1, 0, 0, 0, '27-07-2018 10:47:20', '27-07-2018'),
(29, 'COVV00010', 10, 'Cofuilson Bernardo JosÃ©', 12, '1979-02-14', '923585412', 'gerais', '15 SESSOES DE FISIOTERAPIA', '6000', '0', '6000', 'Cash', '', 0, 0, 0, 0, '27-07-2018 11:00:26', '27-07-2018'),
(30, 'COVV00043', 43, 'Jose Lucamba Marques', 12, '1977-07-10', '925878425', 'gerais', '10 SESSOES DE FISIOTERAPIA', '4000', '0', '4000', 'Cash', '', 0, 0, 0, 0, '27-07-2018 11:11:36', '27-07-2018'),
(31, 'COVV00044', 44, 'Helga Cassanda Kinanga', 12, '1983-12-15', '930509899', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 11:23:03', '27-07-2018'),
(32, 'COVV00050', 50, 'Augusto AdÃ£o Diogo', 12, '1978-02-05', '923967247', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:43:05', '27-07-2018'),
(33, 'COVV00056', 56, 'Antonica JosÃ© GuimarÃ£es', 12, '1971-09-05', '', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:45:02', '27-07-2018'),
(34, 'COVV00055', 55, 'AntÃ³nio Joaquim JÃºnior', 12, '1960-09-14', '922058979', 'consultas', 'CONSULTA NORMAL', '300', '1700', '2000', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:47:36', '27-07-2018'),
(35, 'COVV00049', 49, 'Firmina Albano Ngolombole', 12, '1966-06-22', '925478601', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:49:48', '27-07-2018'),
(36, 'COVV00062', 62, 'Madalena Antonio Pereira', 12, '1991-03-19', '941058557', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:51:00', '27-07-2018'),
(37, 'COVV00058', 58, 'JoÃ£o Alberto Muchabata Serrote', 12, '1990-03-01', '934863604', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:51:46', '27-07-2018'),
(38, 'COVV00059', 59, 'EsperanÃ§a Ngunza Domngos', 12, '1959-07-20', '', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:53:21', '27-07-2018'),
(39, 'COVV00046', 46, 'Maria Manuela GuimarÃ£es', 12, '1968-10-26', '927824465', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:57:14', '27-07-2018'),
(40, 'COVV00053', 53, 'Moyo Angelina Mayunga', 12, '1981-03-03', '946525682', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:58:01', '27-07-2018'),
(41, 'COVV00048', 48, 'Faustina Missengo Katimba', 12, '2000-07-03', '939529728', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 12:59:23', '27-07-2018'),
(42, 'COVV00067', 67, 'Silvania Ludmila Wenga Barros', 12, '2008-07-03', '944444907', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 13:02:40', '27-07-2018'),
(43, 'COVV00071', 71, 'Delfina Carlos Antonio', 12, '1973-03-11', '', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 13:05:16', '27-07-2018'),
(44, 'COVV00068', 68, 'Antonia Filipe Da Costa', 12, '1983-12-10', '927905213', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 13:05:53', '27-07-2018'),
(45, 'COVV00069', 69, 'Isabel Malungo Sake', 12, '1981-03-19', '925035003', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 0, 0, '27-07-2018 13:07:44', '27-07-2018'),
(46, 'COVV00063', 63, 'Airosa  InÃªs Bartolomeu Vunda', 12, '1994-07-04', '949843630', 'consultas', 'CONSULTA NORMAL', '300', '700', '1000', 'Cash', '', 0, 0, 0, 0, '27-07-2018 13:09:28', '27-07-2018'),
(47, 'COVV00052', 52, 'Valdemiro Francisco dos Santos Vaz', 12, '1979-09-22', '935498366', 'consultas', 'CONSULTA NORMAL', '300', '0', '300', 'Cash', '', 0, 0, 0, 0, '27-07-2018 13:12:14', '27-07-2018'),
(48, 'COVV00061', 61, 'Domingas da Silva', 12, '1961-05-29', '924041449', 'consultas', 'CONSULTA NORMAL', '300', '200', '500', 'Cash', '', 0, 0, 0, 0, '27-07-2018 13:18:44', '27-07-2018'),
(49, 'COVV00045', 45, 'Antonio AdÃ¢o Pascoal', 12, '1963-12-05', '923223097', 'gerais', 'RELATORIO MEDICO', '2000', '0', '2000', 'Cash', '', 0, 0, 0, 0, '27-07-2018 13:21:08', '27-07-2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_fornecedores`
--

CREATE TABLE `tbl_fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `nome` text NOT NULL,
  `nif` int(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `endereco` varchar(1000) NOT NULL,
  `area_actuacao` varchar(1000) NOT NULL,
  `descricao` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_funcionario`
--

CREATE TABLE `tbl_funcionario` (
  `Id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nasc` varchar(22) NOT NULL,
  `estado_civil` varchar(22) NOT NULL,
  `genero` varchar(22) NOT NULL,
  `profissao` varchar(100) NOT NULL,
  `funcao` varchar(100) NOT NULL,
  `telefone` int(11) NOT NULL,
  `especialidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipo_id` varchar(22) NOT NULL,
  `n_identificacao` varchar(16) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `pais` varchar(22) NOT NULL,
  `provincia` varchar(22) NOT NULL,
  `n_seguranca_social` varchar(100) NOT NULL,
  `n_identificacao_fiscal` varchar(22) NOT NULL,
  `data` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_hipotese`
--

CREATE TABLE `tbl_hipotese` (
  `id_hipotese` int(11) NOT NULL,
  `codigo` decimal(11,0) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_criacao` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_hipotese_consultado`
--

CREATE TABLE `tbl_hipotese_consultado` (
  `tbl_hipotese_consultado_id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `hipotese` varchar(255) NOT NULL,
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_isencao_servicos_consultas`
--

CREATE TABLE `tbl_isencao_servicos_consultas` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `servicos` varchar(500) NOT NULL,
  `preco` varchar(1000) NOT NULL,
  `quantidade` varchar(1000) NOT NULL,
  `total` varchar(1000) NOT NULL,
  `motivo_isencao` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_isencao_servicos_consultas`
--

INSERT INTO `tbl_isencao_servicos_consultas` (`id`, `id_paciente`, `servicos`, `preco`, `quantidade`, `total`, `motivo_isencao`, `user_id`) VALUES
(1, 22, '1', '400', '1', '0', '										\r\n	PACIENTE COM 60 ANOS	    					', 7),
(2, 48, '1', '300', '1', '300', '										\r\n		FILHA DA COLEGA    					', 7),
(3, 2, '1', '300', '1', '300', '	mnmm									\r\n		    					', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_isencao_servicos_estomatologia`
--

CREATE TABLE `tbl_isencao_servicos_estomatologia` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `servicos` varchar(500) NOT NULL,
  `preco` varchar(1000) NOT NULL,
  `quantidade` varchar(1000) NOT NULL,
  `total` varchar(1000) NOT NULL,
  `motivo_isencao` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_isencao_servicos_estomatologia`
--

INSERT INTO `tbl_isencao_servicos_estomatologia` (`id`, `id_paciente`, `servicos`, `preco`, `quantidade`, `total`, `motivo_isencao`, `user_id`) VALUES
(1, 5, '1', '650', '2', '1300', '	ok									\r\n		    					', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_isencao_servicos_exames`
--

CREATE TABLE `tbl_isencao_servicos_exames` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `servicos` varchar(500) NOT NULL,
  `preco` varchar(1000) NOT NULL,
  `quantidade` varchar(1000) NOT NULL,
  `total` varchar(1000) NOT NULL,
  `motivo_isencao` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_isencao_servicos_exames`
--

INSERT INTO `tbl_isencao_servicos_exames` (`id`, `id_paciente`, `servicos`, `preco`, `quantidade`, `total`, `motivo_isencao`, `user_id`) VALUES
(1, 3, '2', '750', '2', '1500', '			ok							\r\n		    					', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_isencao_servicos_gerais`
--

CREATE TABLE `tbl_isencao_servicos_gerais` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `servicos` varchar(500) NOT NULL,
  `preco` varchar(1000) NOT NULL,
  `quantidade` varchar(1000) NOT NULL,
  `total` varchar(1000) NOT NULL,
  `motivo_isencao` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_isencao_servicos_gerais`
--

INSERT INTO `tbl_isencao_servicos_gerais` (`id`, `id_paciente`, `servicos`, `preco`, `quantidade`, `total`, `motivo_isencao`, `user_id`) VALUES
(1, 1, '1', '400', '2', '800', '										ok\r\n		    					', 7),
(2, 10, '2', '800', '2', '1600', '	maa									\r\n		    					', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_justificativo_medico`
--

CREATE TABLE `tbl_justificativo_medico` (
  `id_justificativo_medico` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `qtd_dias` int(11) NOT NULL,
  `cid_doenca` varchar(200) NOT NULL,
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_justificativo_medico`
--

INSERT INTO `tbl_justificativo_medico` (`id_justificativo_medico`, `id_paciente`, `id_medico`, `qtd_dias`, `cid_doenca`, `data_cadastro`) VALUES
(1, 30, 65, 2, 'lombalgia', '2018-07-27'),
(2, 44, 21, 4, 'malaria', '2018-07-27'),
(3, 79, 43, 1, 'paludismo', '2018-07-28'),
(4, 81, 43, 1, 'teste', '2018-07-29'),
(5, 85, 43, 2, 'Paludismo', '2018-07-29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_medico`
--

CREATE TABLE `tbl_medico` (
  `id_medico` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `sexo` varchar(22) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(22) NOT NULL,
  `especialidade` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_medico`
--

INSERT INTO `tbl_medico` (`id_medico`, `nome`, `sexo`, `email`, `telefone`, `especialidade`) VALUES
(1, 'Marcio Teixeira Quimbundo', 'Masculino', 'marcioquimbundo@hotmail.com', '991531622', 'Cardiologia'),
(2, 'Manuel Padre', 'Masculino', 'Teste@teste.com', '9912928384', 'Cardiologia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_paciente`
--

CREATE TABLE `tbl_paciente` (
  `Id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nasc` varchar(30) NOT NULL,
  `genero` varchar(15) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `tipo_id` varchar(100) NOT NULL,
  `n_identificacao` varchar(50) NOT NULL,
  `nome_parente` varchar(100) NOT NULL,
  `telefone_parente` varchar(15) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `pagou` int(11) NOT NULL,
  `pagou_estomatologia` int(11) NOT NULL,
  `pagou_exames` int(11) NOT NULL,
  `pagou_sgerais` int(11) NOT NULL,
  `triado` int(11) NOT NULL,
  `agendado` int(11) NOT NULL,
  `atendido_medico` int(11) NOT NULL,
  `data` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_paciente`
--

INSERT INTO `tbl_paciente` (`Id`, `nome`, `data_nasc`, `genero`, `endereco`, `telefone`, `tipo_id`, `n_identificacao`, `nome_parente`, `telefone_parente`, `provincia`, `pagou`, `pagou_estomatologia`, `pagou_exames`, `pagou_sgerais`, `triado`, `agendado`, `atendido_medico`, `data`) VALUES
(1, 'Jurelma Anita Njinga', '2016-04-30', 'Femenino', 'Km 30/Viana', '935196082', 'NÃ£o Aplicavel', '', 'Agustinha Njinga', '', 'Luanda', 0, 0, 0, 0, 0, 1, 0, '2018-07-27 08:16:48'),
(2, 'Lemba SimÃ£o Dias', '1941-05-06', 'Femenino', 'Viana', '949480192', 'Bilhete', '003363932BO036', 'Maria FabiÃ£o', '990668174', 'Icolo E Bengo', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 08:21:28'),
(3, 'Carlos Pascoal Joval', '1982-04-10', 'Masculino', 'Viana', '925339500', 'Bilhete', '000095355LA039', 'Fatima Alfredo', '932740180', 'Luanda', 1, 0, 1, 0, 0, 1, 0, '2018-07-27 08:21:42'),
(4, 'Miguel Teixeira', '1966-01-01', 'Masculino', 'Cacuaco', '922226920', 'Bilhete', '004629878ME046', '', '', 'Malanje', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:28:28'),
(5, 'Ana Lerato dos santos Castilho', '2010-09-27', 'Femenino', 'Viana', '923666127', 'NÃ£o Aplicavel', '', 'Andreia Castilho', '923667127', 'Africa do Sul', 0, 1, 0, 0, 0, 1, 0, '2018-07-27 09:16:07'),
(6, 'Isabel Jose Manuel Sambo', '1958-08-20', 'Femenino', 'Viana', '931993741', 'Bilhete', '004894006KN043', 'JoÃ£o Sambo', '', 'Kwanza Norte', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:33:09'),
(7, 'JosÃ© Augusto Ferreira', '1969-07-10', 'Masculino', 'Viana/Zango 2', '923966182', 'Bilhete', '000109529BA010', '', '', 'Benguela', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:33:59'),
(8, 'Arlete Francisco Cardoso', '1984-10-12', 'Femenino', 'Viana', '', 'Bilhete', '005095194BO045', '', '', 'Bengo', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:36:53'),
(9, 'Carmela JosÃ© Panzo', '1969-08-24', 'Femenino', 'Viana/ Mulevo de Cima', '', 'Bilhete', '007977857KN047', 'Fernando Mateus Vindo', '', 'Cuanza Norte', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:38:08'),
(10, 'Cofuilson Bernardo JosÃ©', '1979-02-14', 'Masculino', 'Viana', '923585412', 'Bilhete', '001233799KN034', 'Valentina UCuaengo', '941052373', 'Kwanza Norte', 0, 0, 0, 1, 1, 1, 0, '2018-07-27 08:39:19'),
(11, 'Teresa AntÃ³nio', '1965-03-15', 'Femenino', 'Cacuaco', '926691069', 'Bilhete', '001782784UE038', 'Miguel AntÃ³nio', '926691069', 'UÃ­ge', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 08:41:04'),
(12, 'Antonio Miguel Antonio', '1956-01-01', 'Masculino', 'Viana', '923954095', 'Bilhete', '000500499KN039', 'Juliana Suanga', '925061563', 'Kwanza Norte', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 08:42:31'),
(13, 'Maria Filomena Muecheno', '1974-01-09', 'Femenino', 'Viana/ Caop', '924069435', 'NÃ£o Aplicavel', '', '', '', 'Moxico', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 08:43:53'),
(14, 'Miguel Antonio Luis', '1957-05-20', 'Masculino', 'Viana', '924047831', 'Bilhete', '008669930ME041', '', '', 'Malanje', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 08:45:18'),
(15, 'Basilio Costa', '1961-06-01', 'Masculino', 'Viana', '923428901', 'Bilhete', '000794140HO034', 'Alice Costa', '931293459', 'Huambo', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:50:01'),
(16, 'Isabel Mandele Jacunana', '1972-10-25', 'Femenino', 'Prenda/Maianga', '948952056', 'Bilhete', '005321064KN043', 'Jacira Fula', '938275456', 'Cuanza-Norte', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 08:51:09'),
(17, 'Francisco Paulo JosÃ©', '1980-09-25', 'Masculino', 'Vila-Nova', '928222270', 'Bilhete', '000047339BO022', '', '', 'Bengo', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:54:29'),
(18, 'MArgarida Natividade Jose Da Silva', '1964-03-24', 'Femenino', 'K.Kiaxi', '932236000', 'NÃ£o Aplicavel', '', 'Francisco Alfredo', '921731556', 'Luanda', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:54:34'),
(19, 'Filomena AntÃ³nio LuÃ­s de Oliveira', '1966-12-05', 'Femenino', 'Viana/Gamek', '928635688', 'Bilhete', '000043249LA035', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:57:54'),
(20, 'Maria Cristina Da Silva jeronimo', '1960-04-09', 'Femenino', 'Viana', '930513590', 'NÃ£o Aplicavel', '', 'Miguel Jeronimo', '937081126', 'Kwanza Norte', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 08:58:26'),
(21, 'Maria JosÃ© Milombe', '1983-10-03', 'Femenino', 'Bem Fica', '923681270', 'Bilhete', '005023283LN042', 'SebastiÃ£o Fernandes', '926309243', 'Lunda Norte', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:00:56'),
(22, 'Rosa Maria Tchombe Quirino', '1958-01-07', 'Femenino', 'Palanca', '', 'NÃ£o Aplicavel', '', '', '', 'HuÃ­la/Lubango', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:03:43'),
(23, 'Carlos Manuel de Almeida Afonso', '1990-07-28', 'Masculino', 'Viana', '921491785', 'Bilhete', '002118905LA039', '', '', 'Luanda', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:06:44'),
(24, 'Francisco Soares', '1951-12-24', 'Masculino', 'K.Kiaxi', '931256834', 'Bilhete', '001738504ME035', '', '', 'Malanje', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:07:19'),
(25, 'Isabel MaLungo Saqui', '1981-03-19', 'Femenino', 'Viana/Calemba2', '925035003', 'NÃ£o Aplicavel', '', 'Fernando Lando', '924662367', 'UigÃ©', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:07:44'),
(26, 'Pedro Antonio Tungaquio Beia', '1991-10-07', 'Masculino', 'Viana', '935232293', 'Bilhete', '001500887LA034', '', '', 'Luanda', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:11:55'),
(27, 'AntÃ³nio JosÃ© Igreja', '1955-04-20', 'Masculino', 'Cacuaco', '926691069', 'Bilhete', '000752246KN035', 'Miguel Igreja', '926691069', 'Kwaza Norte', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:13:38'),
(28, 'JÃºlia Manuel JoÃ£o', '1935-12-17', 'Femenino', 'Viana/Zango 3', '924079570', 'NÃ£o Aplicavel', '', '', '', 'Malange', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:16:28'),
(29, 'Alice edilia Nambuta Fernando', '1973-02-07', 'Femenino', 'Bairro EsperanÃ§a', '924227155', 'Bilhete', '000645066BE034', 'Fernando Jamba', '', 'BiÃ©', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:18:53'),
(30, 'Enisvaldo Elisio Fernandes da Costa', '2001-10-27', 'Masculino', 'Calemba/Kilamba-Kiaxi', '922936138', 'NÃ£o Aplicavel', '', '', '', 'Bengo', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 09:19:40'),
(31, 'Domingas AndrÃ©', '1964-02-24', 'Femenino', 'Viana/Estalagem', '924688901', 'NÃ£o Aplicavel', '', '', '', 'Cuanza-Norte', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:23:02'),
(32, 'Manuel Antonio SebastiÃ£o', '1962-06-05', 'Masculino', 'Viana', '924688901', 'Bilhete', '004672746KN042', '', '', 'Kwanza Norte', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:25:00'),
(33, 'Rosa Manuel', '1953-06-20', 'Femenino', 'Viana', '', 'NÃ£o Aplicavel', '', '', '', 'Zaire/ Tomboco', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:26:46'),
(34, 'Josefa Manuel', '1952-09-05', 'Femenino', 'Viana', '924637212', 'NÃ£o Aplicavel', '', 'Bernardo Fastudo', '', 'Kwanza Sul', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:27:51'),
(35, 'Zito joaquim Domingos', '2003-07-04', 'Masculino', 'Viana/ Mulevos', '945742603', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:30:56'),
(36, 'Marta Jumba Rodrigues', '1955-07-24', 'Femenino', 'Viana/ Zango 4', '', 'Bilhete', '000239842KS037', '', '', 'Cuanza-Sul', 0, 0, 0, 0, 1, 1, 1, '2018-07-27 09:33:45'),
(37, 'Lauindo JoÃ£o Sawino', '1974-11-25', 'Masculino', 'Viana', '937105883', 'Bilhete', '001306321HA033', 'Laurinda JoÃ£o', '944279256', 'Huila', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:42:58'),
(38, 'Edson Sidney Rocha Henrrique', '1993-06-01', 'Masculino', 'Viana', '935010511', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:47:50'),
(39, 'Laura Chipuco', '1952-07-08', 'Femenino', 'Viana', '996352977', 'NÃ£o Aplicavel', '', '', '', 'Huambo', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:52:21'),
(40, 'Benvindo Ribeiro da Silva', '1993-02-20', 'Masculino', 'Calemba 2/Kilamba-Kiaxi', '946442626', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 09:55:03'),
(41, 'Maria Joaquim Kahanda', '1963-07-07', 'Femenino', 'Viana', '922585011', 'NÃ£o Aplicavel', '', 'Martins Eduardo', '', 'Kwanza Sul', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 09:56:27'),
(42, 'Eva EugÃ©nia Miguel Luanda', '1988-08-27', 'Femenino', 'Viana/ B. EsperanÃ§a', '925965363', 'Bilhete', '001532309LA038', '', '', 'Luanda', 0, 0, 0, 1, 1, 1, 0, '2018-07-27 09:58:53'),
(43, 'Jose Lucamba Marques', '1977-07-10', 'Masculino', 'Cacuaco', '925878425', 'Bilhete', '000072844LA019', 'Adellia Pedro', '923370158', 'Luanda', 0, 0, 0, 1, 1, 1, 0, '2018-07-27 11:08:25'),
(44, 'Helga Cassanda Kinanga', '1983-12-15', 'Femenino', 'Calemba 2/Kilamba-Kiaxi', '930509899', 'Bilhete', '002419642UE037', '', '', 'UÃ­ge', 1, 0, 0, 0, 1, 1, 1, '2018-07-27 11:11:56'),
(45, 'Antonio AdÃ¢o Pascoal', '1963-12-05', 'Masculino', 'cazenga', '923223097', 'Bilhete', '0017338611KN037', 'Antonio AdÃ£o Pascoal', '990223097', 'solteiro', 0, 0, 0, 1, 0, 1, 0, '2018-07-27 12:21:49'),
(46, 'Maria Manuela GuimarÃ£es', '1966-10-26', 'Femenino', 'Viana', '927824465', 'Bilhete', '000026449LA023', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 13:44:04'),
(47, 'InÃªs Figueredo', '2016-08-11', 'Femenino', 'Viana/ Zona verde', '937578984', 'NÃ£o Aplicavel', '', 'Maria Salvador', '937578984', 'Luanda', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 12:30:49'),
(48, 'Faustina Missengo Katimba', '2000-07-03', 'Femenino', 'Viana', '939529728', 'NÃ£o Aplicavel', '', 'Tito Katimba e Luisa Kalunga Missengo', '939529728', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:31:13'),
(49, 'Firmina Albano Ngolombole', '1966-06-22', 'Femenino', 'Caxito', '925478601', 'Bilhete', '001489466ME037', '', '', 'Malange', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:31:55'),
(50, 'Augusto AdÃ£o Diogo', '1978-02-05', 'Masculino', 'Viana', '923967247', 'Bilhete', '0000013279LA026', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:34:20'),
(51, 'Armando Ngunza Ginga', '1956-05-18', 'Masculino', 'Viana', '923562513', 'Bilhete', '000639812ME035', '', '', 'Malange', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 12:34:25'),
(52, 'Valdemiro Francisco dos Santos Vaz', '1979-09-22', 'Masculino', ' Viana/Km 14B', '935498366', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:36:23'),
(53, 'Moyo Angelina Mayunga', '1981-03-03', 'Femenino', 'Viana', '946525682', 'NÃ£o Aplicavel', '', '', '', 'Zaire', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:36:29'),
(54, 'Braulio Vencislau Mayunga Vemba', '2010-04-22', 'Masculino', 'Viana', '946525682', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 12:38:38'),
(55, 'AntÃ³nio Joaquim JÃºnior', '1960-09-14', 'Masculino', 'Viana/Km 30 ', '922058979', 'Bilhete', '000005107LA030', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:39:45'),
(56, 'Antonica JosÃ© GuimarÃ£es', '1971-09-05', 'Femenino', 'Viana/ Caop', '', 'Bilhete', '004847443ME047', '', '', 'Malange', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:42:03'),
(57, 'Olimpio Joao Lima', '1962-04-16', 'Masculino', 'Camama', '947784586', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 0, 0, 1, 0, 1, 1, 0, '2018-07-27 12:42:04'),
(58, 'JoÃ£o Alberto Muchabata Serrote', '1990-03-01', 'Masculino', 'Viana', '934863604', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:42:55'),
(59, 'EsperanÃ§a Ngunza Domngos', '1959-07-20', 'Femenino', 'Viana/Regedoria', '', 'Bilhete', '001556869UE031', '', '', 'UÃ­ge', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:44:55'),
(60, 'Francisco Maya', '1948-03-12', 'Masculino', 'Viana', '925890022', 'NÃ£o Aplicavel', '', '', '', 'Malange', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 12:45:37'),
(61, 'Domingas da Silva', '1961-05-29', 'Femenino', 'Viana/Km 14 A', '924041449', 'Bilhete', '003065486UE035', '', '', 'UÃ­ge', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:48:46'),
(62, 'Madalena Antonio Pereira', '1991-03-19', 'Femenino', 'Viana', '941058557', 'Bilhete', '00776659LA045', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:49:15'),
(63, 'Airosa  InÃªs Bartolomeu Vunda', '1994-07-04', 'Femenino', 'Viana/Grafanil', '949843630', 'Bilhete', '006129295LA043', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:51:31'),
(64, 'Maria Do Ceu Moises', '1951-02-12', 'Femenino', 'Viana', '944235212', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 12:52:06'),
(65, 'AmÃ©lia Joaquim TrovÃ£o', '1951-07-01', 'Femenino', 'Viana/ Caop', '927989060', 'Bilhete', '000459190ME036', '', '', 'Malange/Calandula', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 12:54:03'),
(66, 'Eva JoÃ£o Francisco', '1951-05-30', 'Femenino', 'Viana', '915514388', 'Bilhete', '003630604ME034', '', '', 'Malange', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 12:54:43'),
(67, 'Silvania Ludmila Wenga Barros', '2008-07-03', 'Femenino', 'Viana/Estalagem', '944444907', 'NÃ£o Aplicavel', '', '', '', 'Luanda/Cazenga', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:57:19'),
(68, 'Antonia Filipe Da Costa', '1983-12-10', 'Femenino', 'Viana', '927905213', 'Bilhete', '000759422LA031', '', '', 'Luanda', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 12:57:28'),
(69, 'Isabel Malungo Sake', '1981-03-19', 'Femenino', 'Viana', '925035003', 'NÃ£o Aplicavel', '', '', '', 'Uige', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 13:01:28'),
(70, 'Welguer Matos Caquienga', '2010-09-12', 'Masculino', 'Viana/Boa FÃ©', '923760436', 'NÃ£o Aplicavel', '', '', '', 'Luanda', 0, 0, 0, 0, 1, 1, 0, '2018-07-27 13:03:00'),
(71, 'Delfina Carlos Antonio', '1973-03-11', 'Femenino', 'Viana', '', 'Bilhete', '000102531KS016', '', '', 'Kwanza Sul', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 13:03:49'),
(72, 'Maria Santa Lukidi AndrÃ© Luvumbo', '1995-04-01', 'Femenino', 'Viana/Estalagem', '926557415', 'Bilhete', '005402921LA049', '', '', 'Luanda/Viana', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 13:06:07'),
(73, 'Alice Elisa Martins AntÃ³nio', '1991-07-29', 'Femenino', 'Viana/500 casas', '945392223', 'Bilhete', '005324130LS048', 'Elvecio', '929172554', 'Lunda-Sul', 1, 0, 0, 0, 1, 1, 0, '2018-07-27 13:42:23'),
(74, 'Elviro Martinho Sacufa', '2002-08-18', 'Masculino', 'Calemba 2/Kilamba-Kiaxi', '929302606', 'Bilhete', '006455516LA044', '', '', 'Luanda', 0, 0, 0, 0, 0, 1, 0, '2018-07-27 13:52:11'),
(75, 'Augusto SebastiÃ£o Fernando', '1995-03-15', 'Masculino', 'Viana', '949385562', 'Bilhete', '', '', '', 'Luanda', 1, 0, 0, 0, 0, 1, 0, '2018-07-27 14:31:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `id` int(11) NOT NULL,
  `page` varchar(150) NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_pages`
--

INSERT INTO `tbl_pages` (`id`, `page`, `private`) VALUES
(1, 'account.php', 1),
(2, 'activate-account.php', 0),
(3, 'admin_configuration.php', 1),
(4, 'admin_page.php', 1),
(5, 'admin_pages.php', 1),
(6, 'admin_permission.php', 1),
(7, 'admin_permissions.php', 1),
(8, 'admin_user.php', 1),
(9, 'admin_users.php', 1),
(10, 'forgot-password.php', 0),
(11, 'index.php', 0),
(12, 'left-nav.php', 0),
(13, 'login.php', 0),
(14, 'logout.php', 1),
(15, 'register.php', 0),
(16, 'resend-activation.php', 0),
(17, 'user_settings.php', 1),
(18, 'BUE.php', 0),
(19, 'activar_atendimento.php', 0),
(20, 'add_alocador.php', 0),
(21, 'add_funcionario.php', 0),
(23, 'add_paciente.php', 0),
(24, 'add_produto.php', 0),
(25, 'add_servicos_exames.php', 0),
(26, 'add_servicos_gerais.php', 0),
(27, 'administracao.php', 0),
(28, 'agenda.php', 0),
(29, 'alocador.php', 0),
(30, 'atendimento.php', 0),
(31, 'banco_de_urgencia.php', 0),
(32, 'cancelar_atendimento.php', 0),
(33, 'consulta.php', 0),
(34, 'consultorio.php', 0),
(35, 'consultorios.php', 0),
(36, 'contas_a_pagar.php', 0),
(37, 'doctor.php', 0),
(38, 'editar_produto.php', 0),
(39, 'emergencia.php', 0),
(40, 'enfermaria.php', 0),
(41, 'entrada.php', 0),
(42, 'especialidades.php', 0),
(43, 'estatistica.php', 0),
(44, 'externos.php', 0),
(45, 'facturacao.php', 0),
(46, 'facturacao_detalhes.php', 0),
(47, 'facturacao_exames_detalhes.php', 0),
(48, 'facturacao_produtos_detalhes.php', 0),
(49, 'facturacao_sg_detalhes.php', 0),
(50, 'facturar_consultas.php', 0),
(51, 'facturar_exames.php', 0),
(52, 'facturar_lst_exames_pacientes.php', 0),
(53, 'facturar_lst_pacientes.php', 0),
(54, 'facturar_lst_produto_pacientes.php', 0),
(55, 'facturar_lst_sg_pacientes.php', 0),
(56, 'facturar_produtos.php', 0),
(57, 'facturar_servicos_gerais.php', 0),
(58, 'facturas_em_atrasos.php', 0),
(59, 'farmacia.php', 0),
(60, 'fornecedores.php', 0),
(61, 'historico_vendas.php', 0),
(62, 'historico_vendas_exames.php', 0),
(63, 'historico_vendas_produtos.php', 0),
(64, 'historico_vendas_sg.php', 0),
(65, 'hospital.php', 0),
(66, 'hospital_details.php', 0),
(67, 'imprimir_factura.php', 0),
(68, 'info_pessoais.php', 0),
(69, 'internados.php', 0),
(70, 'internamento.php', 0),
(72, 'lab_consultas.php', 0),
(73, 'laboratorio.php', 0),
(74, 'labs.php', 0),
(75, 'library.php', 0),
(76, 'locais.php', 0),
(77, 'medico_area.php', 0),
(78, 'medicos.php', 0),
(79, 'menu.php', 0),
(80, 'pacientes.php', 0),
(81, 'painel.php', 0),
(82, 'painel_doctor.php', 0),
(83, 'pesquisar_funcionarios.php', 0),
(84, 'pesquisar_servicos.php', 0),
(85, 'pharma_quotation.php', 0),
(86, 'pharma_quotation_details.php', 0),
(87, 'pharmaceuticals.php', 0),
(88, 'pharmaceuticals_details.php', 0),
(89, 'prestadores.php', 0),
(90, 'procedimentos.php', 0),
(91, 'produtos.php', 0),
(92, 'recursos_humanos.php', 0),
(93, 'relatorio.php', 0),
(94, 'relatorio_consultas.php', 0),
(95, 'relatorioo.php', 0),
(96, 'saida.php', 0),
(97, 'seguro_saude.php', 0),
(98, 'servicos.php', 0),
(99, 'tesouraria.php', 0),
(100, 'triagem.php', 0),
(101, 'triagem_banco_ue.php', 0),
(102, 'urgencia.php', 0),
(103, 'usuarios.php', 0),
(106, 'ver_alocador.php', 0),
(107, 'ver_produto.php', 0),
(108, 'ver_produtos.php', 0),
(109, 'estoque.php', 0),
(110, 'funcionarios.php', 0),
(111, 'painel_caixa.php', 0),
(113, 'painel_enfermeiro.php', 0),
(114, 'produtos_farmacia.php', 0),
(115, 'saida_produtos.php', 0),
(116, 'pacientes - Copy.php', 0),
(117, 'pacientes_banco_urgencia.php', 0),
(118, 'pacientes_consulta.php', 0),
(119, 'pacientes_faturacao.php', 0),
(120, 'pacientes_triados.php', 0),
(121, 'pacientes_triagem.php', 0),
(122, 'usuarios - Copy.php', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_facturacao` varchar(22) NOT NULL,
  `id_servico` varchar(22) NOT NULL,
  `qtd` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `name`) VALUES
(1, 'New Member'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_permission_page_matches`
--

CREATE TABLE `tbl_permission_page_matches` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_permission_page_matches`
--

INSERT INTO `tbl_permission_page_matches` (`id`, `permission_id`, `page_id`) VALUES
(1, 1, 1),
(2, 1, 14),
(3, 1, 17),
(4, 2, 1),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5),
(8, 2, 6),
(9, 2, 7),
(10, 2, 8),
(11, 2, 9),
(12, 2, 14),
(13, 2, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_prestadores`
--

CREATE TABLE `tbl_prestadores` (
  `id_prestador` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `nif` varchar(22) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `area_actuacao` varchar(1000) NOT NULL,
  `telefone` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `obs` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_produto`
--

CREATE TABLE `tbl_produto` (
  `id_produto` int(11) NOT NULL,
  `status` varchar(22) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `estoque_minimo` int(11) NOT NULL,
  `estoque_maximo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `criado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_produto`
--

INSERT INTO `tbl_produto` (`id_produto`, `status`, `descricao`, `estoque_minimo`, `estoque_maximo`, `id_user`, `criado`) VALUES
(1, 'Ativo', 'teste', 20, 30, 1, '2018-07-28 21:20:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_produto_farmacia`
--

CREATE TABLE `tbl_produto_farmacia` (
  `id_produto` int(11) NOT NULL,
  `nome_comercial` varchar(100) NOT NULL,
  `nome_quimico` varchar(100) NOT NULL,
  `data_fabrico` varchar(22) NOT NULL,
  `data_expiracao` varchar(22) NOT NULL,
  `forma_farmaceutica` varchar(100) NOT NULL,
  `apresentacao` varchar(50) NOT NULL,
  `embalagem` varchar(100) NOT NULL,
  `custo_compra` varchar(22) NOT NULL,
  `preco_venda` varchar(22) NOT NULL,
  `taxa` varchar(50) NOT NULL,
  `receita` varchar(22) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `estoque_minimo` int(11) NOT NULL,
  `estoque_maximo` int(11) NOT NULL,
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_produto_farmacia`
--

INSERT INTO `tbl_produto_farmacia` (`id_produto`, `nome_comercial`, `nome_quimico`, `data_fabrico`, `data_expiracao`, `forma_farmaceutica`, `apresentacao`, `embalagem`, `custo_compra`, `preco_venda`, `taxa`, `receita`, `descricao`, `estoque_minimo`, `estoque_maximo`, `data_cadastro`) VALUES
(1, 'ASPRINA', 'ACIDO ACETILSALICILICO', '2018-04-12', '2020-04-12', 'Comprimidos', '300mg', 'Por Unidade', '0', '0', 'Imposto NÃ£o Aplicavel', 'Sim', 'Nao tomar em caso de ulcera gastrica', 1500, 5000, '2018-07-25 20:42:04'),
(3, 'BACTRIM', 'COTRIMOXAZOL', '2018-01-12', '2020-03-12', 'Comprimidos', '500mg', 'Por Unidade', '0', '-3', 'Imposto NÃ£o Aplicavel', 'Sim', '', 500, 5000, '2018-07-25 21:19:47'),
(4, 'gentamicina ', 'gentamicina ', '2016-12-02', '2019-03-04', '4', '4', 'Por Unidade', '00', '00', 'Imposto NÃ£o Aplicavel', 'Sim', '        ', 100, 2000, '2018-07-26 14:39:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_queixas_historial`
--

CREATE TABLE `tbl_queixas_historial` (
  `id_queixas_historial` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `queixas` varchar(200) NOT NULL,
  `historial` varchar(200) NOT NULL,
  `data_criada` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_receitas`
--

CREATE TABLE `tbl_receitas` (
  `id_receita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `medico` varchar(50) NOT NULL,
  `quantidade` varchar(10) NOT NULL,
  `medicamento` varchar(50) NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `data_receita` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_receitas`
--

INSERT INTO `tbl_receitas` (`id_receita`, `id_paciente`, `medico`, `quantidade`, `medicamento`, `observacao`, `data_receita`) VALUES
(1, 18, '41', '', 'amp', '2comp 8/8h  20 total', '2018-07-27 09:27:19'),
(2, 18, '41', '', 'gfdfgsdf', 'fgggfd', '2018-07-27 09:30:33'),
(3, 31, '21', '', '', '', '2018-07-27 09:53:03'),
(4, 17, '22', ',', 'NOLOTIL 575 MG---------------20  COMP.,', ',', '2018-07-27 09:57:06'),
(5, 21, '41', '', 'IBUPROFENO 400 MG, UM COMP 6H 14H 22H 20 TOTAL', '', '2018-07-27 10:01:29'),
(6, 31, '21', '', 'DICLOFENAC GEL APLICAR 2 X AO DIA 12/ 12h', '', '2018-07-27 10:13:48'),
(7, 31, '21', '', '', '', '2018-07-27 10:14:05'),
(8, 30, '65', '1', 'paracetamol', '3   ', '2018-07-27 10:16:10'),
(9, 37, '41', '', '', '', '2018-07-27 10:39:30'),
(10, 29, '71', '', '', '', '2018-07-27 11:44:54'),
(11, 29, '71', '', 'Arcoxia 90 mg', '', '2018-07-27 11:45:58'),
(12, 44, '21', '', 'ooooooo', '', '2018-07-27 12:02:22'),
(13, 44, '21', '1,', 'paracetamol-500mg,', '6-14-22h,', '2018-07-27 12:04:33'),
(14, 44, '21', '10,', 'ARCOXIA -90MG -10C,NEUROBION-0,2 MG-20 C ', '1 C / DIA-7 HORAS,1C6-18 H / 10DIAS', '2018-07-27 12:18:24'),
(15, 36, '43', '2,4', 'teste,teste', 'teste,teste', '2018-07-28 09:13:38'),
(16, 79, '43', '2,1', 'paracetamol,paracetamol', 'de 1 em 1 hora,de 1 em 1 hora', '2018-07-28 15:34:22'),
(17, 81, '43', '1', 'teste', 'teste', '2018-07-29 05:41:12'),
(18, 85, '43', '1,2', 'paracetamol de 500mg,paracetamol de 500mg', 'tomar 8 em 8h,tomar 8 em 8h', '2018-07-29 09:00:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_requisicao`
--

CREATE TABLE `tbl_requisicao` (
  `id_requisicao` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `medico` varchar(200) NOT NULL,
  `data` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_saida_de_produto`
--

CREATE TABLE `tbl_saida_de_produto` (
  `id_saida_produto` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `local` varchar(50) NOT NULL,
  `data_saida` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_saida_de_produto_farmacia`
--

CREATE TABLE `tbl_saida_de_produto_farmacia` (
  `id_saida_produto` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `local` varchar(50) NOT NULL,
  `data_saida` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_saida_de_produto_farmacia`
--

INSERT INTO `tbl_saida_de_produto_farmacia` (`id_saida_produto`, `id_produto`, `qtde`, `local`, `data_saida`, `user_id`) VALUES
(1, 1, 50, 'SO', '2018-07-25 20:48:40', 58),
(2, 1, 50, 'AMBULATORIO', '2018-07-25 20:52:06', 58),
(3, 1, 100, 'AMBULATORIO', '2018-07-25 20:52:40', 58);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_seguro_saude`
--

CREATE TABLE `tbl_seguro_saude` (
  `id_seguro_saude` int(11) NOT NULL,
  `empresa` varchar(150) NOT NULL,
  `registo_ANS` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_servico`
--

CREATE TABLE `tbl_servico` (
  `id_servico` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `status` varchar(22) NOT NULL DEFAULT '"1"',
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_servicos_consultas`
--

CREATE TABLE `tbl_servicos_consultas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `status` varchar(22) NOT NULL DEFAULT '"1"',
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_servicos_consultas`
--

INSERT INTO `tbl_servicos_consultas` (`id`, `nome`, `preco`, `descricao`, `status`, `data_cadastro`) VALUES
(1, 'CONSULTA NORMAL', '300', 'ok    ', '1', '2018-07-22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_servicos_estomatologia`
--

CREATE TABLE `tbl_servicos_estomatologia` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `status` varchar(22) NOT NULL DEFAULT '"1"',
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_servicos_estomatologia`
--

INSERT INTO `tbl_servicos_estomatologia` (`id`, `nome`, `preco`, `descricao`, `status`, `data_cadastro`) VALUES
(1, 'CONSULTA DE ESTOMATOLOGIA', '650', 'CODIGO 01    ', '1', '2018-07-22'),
(2, 'EXTRACAO DE DENTE SIZO', '2500', 'CODIGO 03    ', '1', '2018-07-22'),
(3, 'LIMPEZA DENTARIA DESTARTARIZACAO', '4000', 'CODIGO 04    ', '1', '2018-07-22'),
(4, 'TRATAMENTO DE ABCESSO', '4000', 'CODIGO 05    ', '1', '2018-07-22'),
(5, '1 SELANTES DE FOSSAS E FISSURAS', '2000', 'CODIGO 06    ', '1', '2018-07-22'),
(6, '1 RESTAURACAOO COM AXIDO DE ZINCO', '2000', 'CODIGO 07    ', '1', '2018-07-22'),
(7, 'TRATAMENTO DE ALVEOLITES', '2000', 'CODIGO 08    ', '1', '2018-07-22'),
(8, 'APLICACAO DE FLUOR TIPICO', '2000', 'CODIGO 09    ', '1', '2018-07-22'),
(9, 'CONSULTA DE URGENCIA DE ESTOMATOLOGIA', '2000', 'CODIGO 12    ', '1', '2018-07-22'),
(10, 'RX PERIA PICAL', '1800', 'CODIGO 13    ', '1', '2018-07-22'),
(11, ' RESTAURACACAO DE 3a CLASSE', '2500', 'CODIGO 15    ', '1', '2018-07-22'),
(12, 'EXTRACCAO DE 1 DENTE PERMANENTE', '2000', '    ', '1', '2018-07-27'),
(13, 'EXTRACCAO DE 2 DENTE PERMANENTE', '4000', '    ', '1', '2018-07-27'),
(14, '2 SELANTES DE FOSSAS E FISURAS', '4000', '    ', '1', '2018-07-27'),
(15, '3 SELANTES DE FOSSAS E FISURAS', '6000', '    ', '1', '2018-07-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_servicos_exames`
--

CREATE TABLE `tbl_servicos_exames` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `status` varchar(22) NOT NULL DEFAULT '"1"',
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_servicos_exames`
--

INSERT INTO `tbl_servicos_exames` (`id`, `nome`, `preco`, `descricao`, `status`, `data_cadastro`) VALUES
(1, 'VS', '800', 'CODIGO 01        ', '1', '2018-07-22'),
(2, 'FALCIFORMACAO', '750', 'CODIGO 02        ', '1', '2018-07-22'),
(3, 'GRUPO SANGUINEO', '900', '        ', '1', '2018-07-22'),
(4, 'R/WIDAL', '1000', '        ', '1', '2018-07-22'),
(5, 'VDRL', '900', '        ', '1', '2018-07-22'),
(6, 'HBSG', '900', '        ', '1', '2018-07-22'),
(7, 'HIV', '00', '    ', '1', '2018-07-22'),
(8, 'GLICOSE', '800', '    ', '1', '2018-07-22'),
(9, 'UREIA', '900', '        ', '1', '2018-07-22'),
(10, 'CREATININA', '900', '        ', '1', '2018-07-22'),
(11, 'COLESTEROL', '900', '        ', '1', '2018-07-22'),
(12, 'TRIGLICERIDOS', '900', '        ', '1', '2018-07-22'),
(13, 'PROTEINAS TOTAIS', '900', '        ', '1', '2018-07-22'),
(14, 'BELIRRUBINA DIRECTA', '900', '        ', '1', '2018-07-22'),
(15, 'BELIRRUBINA TOTAL', '900', '        ', '1', '2018-07-22'),
(16, 'FOSFATOSE ALCALINA', '800', '    ', '1', '2018-07-22'),
(17, 'TEMPODEHEMORRAGIA', '500', '    ', '1', '2018-07-22'),
(18, 'TEMPO DE COAGULACAO', '500', '    ', '1', '2018-07-22'),
(19, 'HCV', '800', '    ', '1', '2018-07-22'),
(20, 'PCR', '900', '        ', '1', '2018-07-22'),
(21, 'ACIDO URICO', '850', '    ', '1', '2018-07-27'),
(22, 'H.B', '800', '    ', '1', '2018-07-27'),
(23, 'HEMOGRAMA COMPLETO', '1200', '    ', '1', '2018-07-27'),
(24, 'GLICEMIA', '800', '    ', '1', '2018-07-27'),
(25, 'HDL', '900', '    ', '1', '2018-07-27'),
(26, 'LDH', '900', '    ', '1', '2018-07-27'),
(27, 'LDL', '900', '    ', '1', '2018-07-27'),
(28, 'TGO', '900', '    ', '1', '2018-07-27'),
(29, 'TGP', '900', '    ', '1', '2018-07-27'),
(30, 'LDL', '900', '    ', '1', '2018-07-27'),
(31, 'F.REUMATOIDE', '900', '    ', '1', '2018-07-27'),
(32, 'TASO', '800', '    ', '1', '2018-07-27'),
(33, 'TESTE DE GRAVIDEZ', '1000', '    ', '1', '2018-07-27'),
(34, 'EXUDADO VAGINAL', '800', '    ', '1', '2018-07-27'),
(35, 'ESPERMOGRAMA', '1000', '    ', '1', '2018-07-27'),
(36, 'URINA TIPO II', '950', '    ', '1', '2018-07-27'),
(37, 'FEZES', '550', '    ', '1', '2018-07-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_servicos_gerais`
--

CREATE TABLE `tbl_servicos_gerais` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `status` varchar(22) NOT NULL DEFAULT '"1"',
  `data_cadastro` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_servicos_gerais`
--

INSERT INTO `tbl_servicos_gerais` (`id`, `nome`, `preco`, `descricao`, `status`, `data_cadastro`) VALUES
(1, '1 SESSAO DE FISIOTERAPIA', '400', '    ', '1', '2018-07-22'),
(2, '2 SESSAO DE FISIOTERAPIA', '800', '    ', '1', '2018-07-22'),
(3, '4 SESSAO DE FISIOTERAPIA', '1600', '    ', '1', '2018-07-22'),
(4, '8 SESSOES DE FISIOTERAPIA', '3200', '    ', '1', '2018-07-22'),
(5, '10 SESSOES DE FISIOTERAPIA', '4000', '    ', '1', '2018-07-22'),
(6, '15 SESSOES DE FISIOTERAPIA', '6000', '    ', '1', '2018-07-22'),
(7, '20 SESSOES DE FISIOTERAPIA', '8000', '    ', '1', '2018-07-22'),
(8, 'ATESTADO MEDICO P/SERVICO', '1500', '    ', '1', '2018-07-27'),
(9, 'ATESTADO MEDICO P/MATRICULA', '500', '    ', '1', '2018-07-27'),
(10, 'ATESTADO MEDICO P/BOLSA DE ESTUDO', '500', '    ', '1', '2018-07-27'),
(11, 'ATESTADO MEDICO P/PASSAPORTE', '500', '    ', '1', '2018-07-27'),
(12, 'ATESTADO MEDICO P/DESPORTO', '1500', '    ', '1', '2018-07-27'),
(13, 'ATESTADO MEDICO P/CARTA DE CONDUCAO', '2000', '    ', '1', '2018-07-27'),
(14, 'INFORMACAO CLINICA', '2000', '    ', '1', '2018-07-27'),
(15, 'RELATORIO MEDICO', '2000', '    ', '1', '2018-07-27'),
(16, '4 SESSOES PSICOTERAPIA', '1000', '    ', '1', '2018-07-27'),
(17, '6 SESSOES PSICOTERAPIA', '1500', '    ', '1', '2018-07-27'),
(18, '3 SESSOES PSICOTERAPIA', '750', '    ', '1', '2018-07-27'),
(19, '8 SESSOES PSICOTERAPIA', '2000', '    ', '1', '2018-07-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_tratamentos_recomendacoes`
--

CREATE TABLE `tbl_tratamentos_recomendacoes` (
  `id_tratamento_rec` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `tratamentos` varchar(1000) NOT NULL,
  `recomendacoes` varchar(1000) NOT NULL,
  `data_criada` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_tratamentos_recomendacoes`
--

INSERT INTO `tbl_tratamentos_recomendacoes` (`id_tratamento_rec`, `id_paciente`, `id_medico`, `tratamentos`, `recomendacoes`, `data_criada`) VALUES
(1, 3, 66, 'gjioserlk', 'sdfilsrl', '2018-07-26 13:21:05'),
(2, 3, 66, '', 'zbjhcbnjkzxcvnkx', '2018-07-26 15:21:13'),
(3, 3, 66, '', 'hjnbmnmnnk,', '2018-07-26 15:34:27'),
(4, 3, 54, '', '', '2018-07-27 09:13:11'),
(5, 6, 54, '', '', '2018-07-27 09:31:02'),
(6, 5, 54, '', 'RADIOGRAFIA DE TORAX \r\n HEMOGRAMA, ORINA E FEZES.', '2018-07-27 09:47:53'),
(7, 8, 54, '', 'EXAMENES COMPLEMETARIOS: PP , HEMOGRA COMPLETO , ECG', '2018-07-27 10:11:14'),
(8, 7, 54, '', ' NEUROBIOM', '2018-07-27 10:35:13'),
(9, 35, 21, '', 'PTE COM HEMIPLEGIA ENCAMINHO PARA FISIOTERAPIA PARA UMA MELHOR AVALIAÃ‡ÃƒO CLÃNICA .', '2018-07-27 10:53:34'),
(10, 15, 54, '', 'TTO', '2018-07-27 10:58:02'),
(11, 15, 54, '', '', '2018-07-27 11:03:45'),
(12, 20, 54, '', 'TTO', '2018-07-27 11:22:35'),
(13, 1, 54, 'ID:  DEFICIENCIA AO ANDAR', ' RADIOLOGIA DE COXA E JOEHLOS \r\nREAVALIACAO', '2018-07-27 12:03:58'),
(14, 44, 21, 'jddgdgdg', 'dfgdgdfgd', '2018-07-27 12:05:45'),
(15, 4, 54, 'NEUROBIOM 1 COMP DIARIO', 'REALICAR EXERCICIOS EM CASA DIARIO \r\n HELIOTERAPIA.', '2018-07-27 12:26:40'),
(16, 38, 54, 'TTO REABILITADOR  15 SS/ DIARIA  \r\n IV 60CM 10 MTOS  PARA PERNA EZQUERDA \r\n ENTRENAMENTO DA MARCHA  DESACARGA DO PESO PROGRESIVA \r\n EXERCICIOS A A \r\n TO: PEDALEO \r\n', 'TTO', '2018-07-27 12:52:34'),
(17, 36, 43, 'teste\r\nteste', 'teste\r\nteste', '2018-07-28 09:29:07'),
(18, 36, 43, 'teste', 'teste', '2018-07-28 09:32:18'),
(19, 36, 43, 'a', 'a', '2018-07-28 09:32:49'),
(20, 79, 43, 'teste', 'teste', '2018-07-28 15:41:34'),
(21, 81, 43, 'yugwdyagudygaksydgasdaksds', 'sdaisgdasiudgalsdbavlsuylgdabusyda', '2018-07-29 07:05:24'),
(22, 85, 43, 'kyuguygrfkyuasgrkfarfad,jvhybadjvhasdjvhybajsdvajs,dhvhasdbvh,asdbvhjbsadvhj,sdabvhjasbvd,hjadsvbj,hvbds,hvdsb,hdsvbj,hvbdhz,dbxvz,jhxbcvh,jzxbcvx,jhcv,xzhvbz,xhcvb,zxhcvbzx', 'vasdkvbuasdkuvbausdbvasjdbvkaysdvkyasbdvkhsaybdvhasbydvjasbhdvasjvbdhasjvbdhasjvhdb,asjdvb,ajhdsvb,adshvbh,svasdvsadhvbas,dvbhasdbas,dvhsav,asbvh,sabv,sad', '2018-07-29 09:02:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_triagem`
--

CREATE TABLE `tbl_triagem` (
  `id_triagem` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `funcionario` varchar(100) NOT NULL,
  `temperatura` varchar(5) NOT NULL,
  `respiracao` int(11) NOT NULL,
  `pulso` int(11) NOT NULL,
  `tensao` int(11) NOT NULL,
  `tensao2` int(11) NOT NULL,
  `peso` varchar(5) NOT NULL,
  `altura` varchar(5) NOT NULL,
  `imc` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `observacao` varchar(100) NOT NULL,
  `data` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_triagem`
--

INSERT INTO `tbl_triagem` (`id_triagem`, `id_paciente`, `funcionario`, `temperatura`, `respiracao`, `pulso`, `tensao`, `tensao2`, `peso`, `altura`, `imc`, `estado`, `observacao`, `data`) VALUES
(1, 3, 'BENILDE COSTA', '14', 46, 61, 144, 94, '78', '1.79', 24, '5', 'pte que  procura os nossos serviÃ§os para uma consulta de fiatria', '27-07-2018 08:45:05am'),
(2, 6, 'MILENIO ANDRE', '13', 18, 66, 142, 76, '74', '1.65', 27, '5', 'estado normal', '27-07-2018 08:45:33am'),
(3, 8, 'BENILDE COSTA', '13', 15, 69, 108, 79, '59', '1.60', 23, '5', 'estado normal\r\n', '27-07-2018 08:51:00am'),
(4, 10, 'MILENIO ANDRE', '13', 18, 57, 113, 76, '71', '1.62', 27, '5', 'rasoavel', '27-07-2018 08:51:03am'),
(5, 7, 'BENILDE COSTA', '13', 15, 88, 123, 88, '76', '1.6', 30, '5', 'pte lucido', '27-07-2018 08:55:08am'),
(6, 1, 'MILENIO ANDRE', '13', 18, 82, 90, 50, '11', '0.50', 44, '5', 'nao urgente', '27-07-2018 08:56:30am'),
(7, 15, 'MILENIO ANDRE', '13', 18, 62, 115, 67, '87', '1.68', 31, '5', 'nao urgente', '27-07-2018 09:00:15am'),
(8, 16, 'BENILDE COSTA', '13', 14, 83, 168, 102, '55', '1.6', 21, '4', 'pte refere ter feito a medicaÃ§ao anti himpertensiva hoje as 7h', '27-07-2018 09:01:51am'),
(9, 20, 'MILENIO ANDRE', '13', 18, 65, 169, 89, '99', '1.65', 36, '4', 'pouco urgente', '27-07-2018 09:11:46am'),
(10, 13, 'BENILDE COSTA', '14', 14, 80, 98, 68, '59', '1.6', 23, '5', 'pte  refere dor nos membros imferiores', '27-07-2018 09:12:13am'),
(11, 21, 'BENILDE COSTA', '13', 14, 89, 138, 94, '63', '1.6', 25, '4', 'pte refere dor no membro imferior esquerdo', '27-07-2018 09:15:40am'),
(12, 17, 'MILENIO ANDRE', '13', 18, 60, 163, 86, '76', '1.65', 28, '4', 'pouco urgente', '27-07-2018 09:19:14am'),
(13, 5, 'BENILDE COSTA', '14', 18, 74, 87, 47, '23', '1.2', 16, '4', 'refere ter caido  do muro.', '27-07-2018 09:21:35am'),
(14, 18, 'BENILDE COSTA', '13', 15, 59, 151, 82, '86', '1.6', 34, '3', 'refere muitas cefaleias', '27-07-2018 09:23:21am'),
(15, 19, 'BENILDE COSTA', '13', 15, 81, 159, 83, '56', '1.6', 22, '4', 'pte refere muita dor de coluna...', '27-07-2018 09:28:53am'),
(16, 9, 'MILENIO ANDRE', '13', 18, 90, 162, 92, '47', '1.62', 18, '4', 'pouco urgente', '27-07-2018 09:31:06am'),
(17, 4, 'BENILDE COSTA', '13', 14, 62, 142, 90, '52', '1.6', 20, '4', 'estado rasoavel', '27-07-2018 09:32:09am'),
(18, 25, 'MILENIO ANDRE', '13', 18, 74, 97, 61, '49', '1.65', 18, '5', 'ok', '27-07-2018 09:38:53am'),
(19, 11, 'BENILDE COSTA', '13', 15, 88, 247, 110, '76', '1.6', 30, '4', 'pte nao fez medicaÃ§ao  por esquecimento...', '27-07-2018 09:43:29am'),
(20, 32, 'MILENIO ANDRE', '13', 18, 50, 117, 68, '64', '1.65', 24, '5', 'ok', '27-07-2018 09:43:47am'),
(21, 31, 'MILENIO ANDRE', '13', 18, 69, 156, 89, '58', '1.65', 21, '5', 'ok', '27-07-2018 09:48:04am'),
(22, 29, 'MILENIO ANDRE', '13', 18, 77, 134, 83, '95', '1.68', 34, '5', 'ok', '27-07-2018 09:50:33am'),
(23, 37, 'MILENIO ANDRE', '13', 18, 86, 138, 93, '48', '1.65', 18, '5', 'ok', '27-07-2018 09:55:18am'),
(24, 30, 'MILENIO ANDRE', '13', 18, 90, 113, 68, '50', '1.65', 18, '5', 'ok', '27-07-2018 09:58:20am'),
(25, 35, 'BENILDE COSTA', '13', 18, 84, 117, 84, '53', '1.6', 21, '3', 'rasoavel', '27-07-2018 10:00:41am'),
(26, 38, 'MILENIO ANDRE', '13', 18, 90, 145, 97, '74', '1.65', 27, '4', 'pouco urgente', '27-07-2018 10:03:52am'),
(27, 22, 'BENILDE COSTA', '13', 14, 69, 170, 93, '54', '1.6', 21, '4', 'refere ter feito medicaÃ§ao hoje as 7h', '27-07-2018 10:08:47am'),
(28, 41, 'MILENIO ANDRE', '13', 18, 74, 157, 97, '54', '1.65', 20, '5', 'ok', '27-07-2018 10:11:56am'),
(29, 41, 'MILENIO ANDRE', '13', 18, 74, 157, 97, '54', '1.65', 20, '5', 'ok', '27-07-2018 10:12:17am'),
(30, 40, 'MILENIO ANDRE', '13', 18, 63, 107, 67, '59', '1.62', 22, '5', 'ok', '27-07-2018 10:26:40am'),
(31, 27, 'BENILDE COSTA', '13', 18, 90, 141, 88, '54', '1.6', 21, '4', 'rasoavel', '27-07-2018 10:28:08am'),
(32, 12, 'MILENIO ANDRE', '13', 18, 64, 133, 71, '68', '1.65', 25, '5', 'ok', '27-07-2018 10:29:39am'),
(33, 34, 'MILENIO ANDRE', '13', 18, 82, 118, 68, '48', '1.65', 18, '5', 'ok', '27-07-2018 10:32:10am'),
(34, 39, 'BENILDE COSTA', '13', 14, 70, 136, 76, '70', '1.6', 27, '4', 'rasoavel', '27-07-2018 10:32:47am'),
(35, 14, 'MILENIO ANDRE', '13', 18, 78, 172, 82, '53', '1.65', 19, '5', 'ok', '27-07-2018 10:38:55am'),
(36, 2, 'MILENIO ANDRE', '13', 18, 68, 126, 81, '49', '1.65', 18, '5', 'ok', '27-07-2018 10:40:28am'),
(37, 33, 'BENILDE COSTA', '13', 14, 72, 145, 83, '71', '1.6', 28, '5', 'rasoavel', '27-07-2018 10:41:49am'),
(38, 28, 'MILENIO ANDRE', '13', 18, 82, 209, 131, '86', '1.65', 32, '3', 'urgente', '27-07-2018 10:45:18am'),
(39, 24, 'BENILDE COSTA', '13', 14, 79, 195, 92, '61', '1.6', 24, '4', 'pte diabetico a tres anos esta com os niveis elevados e nao fes medicaÃ§ao  anti himpertensiva', '27-07-2018 10:47:28am'),
(40, 23, 'BENILDE COSTA', '12', 16, 36, 58, 28, '2', '2', 1, '4', '2036', '27-07-2018 10:57:28am'),
(41, 10, 'BENILDE COSTA', '12', 16, 36, 57, 26, '2', '1', 2, '4', 'lkjjjkhj', '27-07-2018 10:58:06am'),
(42, 23, 'MILENIO ANDRE', '13', 18, 81, 115, 70, '68', '1.65', 25, '5', 'ok', '27-07-2018 10:59:33am'),
(43, 23, 'MILENIO ANDRE', '13', 18, 81, 115, 70, '68', '1.65', 25, '5', 'ok', '27-07-2018 10:59:46am'),
(44, 44, 'MILENIO ANDRE', '13', 14, 72, 101, 73, '80', '1.6', 31, '3', 'rasoavel\r\n', '27-07-2018 11:34:03am'),
(45, 42, 'MILENIO ANDRE', '13', 17, 78, 123, 58, '58', '1.32', 33, '5', 'ok', '27-07-2018 12:13:38pm'),
(46, 26, 'MILENIO ANDRE', '13', 19, 78, 120, 80, '56', '1.62', 21, '5', 'ok', '27-07-2018 12:14:24pm'),
(47, 43, 'MILENIO ANDRE', '13', 18, 78, 120, 58, '54', '1.62', 21, '5', 'ok', '27-07-2018 12:15:04pm'),
(48, 56, 'MILENIO ANDRE', '13', 18, 89, 109, 96, '104', '1.65', 38, '5', 'ok', '27-07-2018 12:52:55pm'),
(49, 54, 'MILENIO ANDRE', '13', 18, 82, 90, 50, '24', '1.2', 17, '5', 'ok', '27-07-2018 12:56:41pm'),
(50, 50, 'MILENIO ANDRE', '13', 18, 70, 127, 90, '83', '1.65', 30, '5', 'ok', '27-07-2018 12:58:33pm'),
(51, 48, 'BENILDE COSTA', '13', 15, 90, 118, 71, '54', '1.6', 21, '4', 'rasoavel', '27-07-2018 01:06:33pm'),
(52, 49, 'MILENIO ANDRE', '13', 18, 50, 169, 93, '80', '1.62', 30, '5', 'ok', '27-07-2018 01:06:54pm'),
(53, 67, 'BENILDE COSTA', '13', 17, 51, 99, 50, '26', '1.1', 21, '4', 'refere dor no membros inferiores', '27-07-2018 01:10:43pm'),
(54, 63, 'BENILDE COSTA', '13', 36, 74, 139, 82, '82', '1.7', 28, '4', 'rasoavel', '27-07-2018 01:15:35pm'),
(55, 60, 'MILENIO ANDRE', '13', 18, 46, 124, 61, '55', '1.65', 20, '5', 'ok', '27-07-2018 01:16:51pm'),
(56, 55, 'MILENIO ANDRE', '13', 17, 83, 124, 75, '58', '1.65', 21, '5', 'ok', '27-07-2018 01:18:24pm'),
(57, 47, 'BENILDE COSTA', '14', 18, 87, 48, 25, '9', '1.6', 4, '5', 'rasoavel', '27-07-2018 01:19:29pm'),
(58, 53, 'BENILDE COSTA', '14', 15, 80, 94, 59, '60', '1.6', 23, '5', 'rasoavel', '27-07-2018 01:20:59pm'),
(59, 66, 'MILENIO ANDRE', '13', 17, 64, 126, 70, '53', '1.62', 20, '5', 'ok', '27-07-2018 01:22:10pm'),
(60, 59, 'BENILDE COSTA', '13', 15, 73, 131, 85, '46', '1.6', 18, '4', 'refere cefaleia', '27-07-2018 01:23:51pm'),
(61, 51, 'MILENIO ANDRE', '13', 17, 80, 125, 69, '66', '1.65', 24, '5', 'ok', '27-07-2018 01:24:31pm'),
(62, 12, 'Paulo Enfermeiro', '13', 16, 64, 133, 71, '68', '1.6', 27, '5', 'ok', '27-07-2018 01:26:54pm'),
(63, 65, 'BENILDE COSTA', '13', 14, 82, 121, 74, '67', '1.6', 26, '4', 'rasoavel', '27-07-2018 01:27:27pm'),
(64, 69, 'MILENIO ANDRE', '13', 17, 68, 102, 59, '49', '1.65', 18, '5', 'ok', '27-07-2018 01:30:32pm'),
(65, 68, 'BENILDE COSTA', '13', 14, 83, 107, 73, '69', '1.6', 27, '3', 'refere dores de coluna', '27-07-2018 01:30:33pm'),
(66, 61, 'MILENIO ANDRE', '13', 17, 79, 119, 77, '64', '1.65', 24, '5', 'ok', '27-07-2018 01:32:49pm'),
(67, 58, 'BENILDE COSTA', '13', 14, 81, 121, 73, '53', '1.6', 21, '4', 'raasoavel', '27-07-2018 01:34:02pm'),
(68, 71, 'MILENIO ANDRE', '13', 18, 82, 124, 76, '64', '1.62', 24, '5', 'ok', '27-07-2018 01:36:29pm'),
(69, 46, 'BENILDE COSTA', '13', 14, 50, 175, 89, '105', '1.45', 50, '4', 'Normal', '27-07-2018 01:37:41pm'),
(70, 52, 'BENILDE COSTA', '13', 14, 87, 140, 90, '86', '1.70', 30, '4', 'normal', '27-07-2018 01:42:44pm'),
(71, 62, 'MILENIO ANDRE', '13', 18, 89, 104, 54, '42', '1.65', 15, '5', 'ok', '27-07-2018 01:44:41pm'),
(72, 70, 'MILENIO ANDRE', '13', 18, 78, 120, 80, '74', '1.62', 28, '5', 'ok', '27-07-2018 01:45:28pm'),
(73, 64, 'BENILDE COSTA', '13', 1, 80, 153, 92, '73', '1.65', 27, '4', 'Norma', '27-07-2018 01:45:49pm'),
(74, 57, 'MILENIO ANDRE', '13', 18, 78, 120, 80, '78', '1.65', 29, '5', 'ok', '27-07-2018 01:46:21pm'),
(75, 73, 'BENILDE COSTA', '19', 14, 90, 95, 55, '39', '1.55', 16, '4', 'razoÃ¡vel', '27-07-2018 01:50:55pm'),
(76, 36, 'Marcio Quimbundo', '2', 2, 30, 53, 21, '50', '1.70', 17, '4', 'Ok', '28-07-2018 08:18:44am'),
(77, 72, 'Paulo Enfermeiro', '15', 15, 37, 54, 24, '60', '1.70', 21, '4', 'ok', '28-07-2018 09:47:00am'),
(78, 79, 'Paulo Enfermeiro', '15', 13, 31, 50, 24, '50', '1.70', 17, '4', 'Ok', '28-07-2018 03:31:40pm'),
(79, 81, 'Paulo Enfermeiro', '14', 16, 33, 58, 25, '50', '1.70', 17, '4', 'ok', '29-07-2018 05:25:13am'),
(80, 82, 'Paulo Enfermeiro', '15', 17, 36, 58, 19, '60', '1.50', 27, '4', 'Ok', '29-07-2018 07:25:29am'),
(81, 85, 'Paulo Enfermeiro', '1', 2, 20, 48, 21, '50', '1.70', 17, '4', 'Ok', '29-07-2018 08:58:34am'),
(82, 76, 'Paulo Enfermeiro', '18', 19, 37, 56, 27, '90', '1.90', 25, '1', 'hjdjas', '29-07-2018 09:52:02am'),
(83, 77, 'Paulo Enfermeiro', '19', 19, 38, 56, 25, '89', '0.90', 110, '1', 'ok', '29-07-2018 09:53:03am');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(150) NOT NULL,
  `activation_token` varchar(225) NOT NULL,
  `last_activation_request` int(11) NOT NULL,
  `lost_password_request` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(150) NOT NULL,
  `sign_up_stamp` int(11) NOT NULL,
  `last_sign_in_stamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_name`, `display_name`, `password`, `email`, `activation_token`, `last_activation_request`, `lost_password_request`, `active`, `title`, `sign_up_stamp`, `last_sign_in_stamp`) VALUES
(1, 'admin', 'Marcio Quimbundo', '815f3afcc91f51c16b65f75a2a8238574ac1d800e72a010458228076adaad9073', 'marcioquimbundo@gmail.com', '9c01e3c02cdb9922fe967833403a854c', 1393566194, 0, 1, 'admin', 1393566194, 1532933904),
(3, 'catalogador', 'João Catalogador', 'dbff512cced83a08c104bf6ac1f0ebdc88ede3d3d39ae83e322708cf6c6940e1d', 'padre@gmail.com', '9c01e3c02cdb9922fe967833403a854c', 1393566194, 0, 1, 'catalogador', 1393566194, 1532864311),
(4, 'caixa', 'João ', '4a1adff8e437706ca498466c989d3ce5bbedae3c13d944bcb5e2927f39787c41b', 'padre@gmail.com', '9c01e3c02cdb9922fe967833403a854c', 1393566194, 0, 0, 'caixa', 1393566194, 1532782652),
(5, 'enfermeiro', 'Paulo Enfermeiro', '2e7c5efc0705e6624ad0e98ecd7a447572f3190a685b25162c12d040570804de2', 'padre@gmail.com', '9c01e3c02cdb9922fe967833403a854c', 1393566194, 0, 1, 'enfermeiro', 1393566194, 1532875609),
(7, 'tesoreiro', 'Manuel Tesoreiro', '45f19ef065926c122787493599b589136da0f90dedf9dc545376f7407fee6049a', 'tesoreiro@hotmail.com', '995a0973e06d21b949fe028060b577e3', 1527056594, 0, 1, 'tesoreiro', 1527056594, 1532887276),
(9, 'jf', 'João Farmacéutico', '6b2a4cef455947bfe451237fd1edcb31df49212530dbfd2e7592493b77ab1cd6d', 'marthaeugeniaduany@gmail.com', '7d6d19712fd465b096631f82d0362ae8', 1532275191, 0, 1, 'farmaceutico', 1532275191, 1532275554),
(10, 'mirobaldo', 'MIROBALDO MATIAS', 'd7144d99893821d4eae09aff9b76ccfaaba4c745057324646ef10bc3349e12fb0', 'antoniopadre60@gmail.com', '31b6c7b845d4adb7fa68b7200a912b15', 1532275810, 0, 1, 'caixa', 1532275810, 1532342518),
(11, 'adgena', 'ADGENA DOS SANTOS', '8f470ed5a8d5d3510ad7fe8c5a55d38c8fd4d993388372f0f4dce08c4a4ef2834', 'sdggjyu7y', '46ba46bb464dbbac57dcd73b42b8aaf4', 1532275916, 0, 1, 'caixa', 1532275916, 1532279537),
(12, 'edmundo', 'EDMUNDO MANUEL', '21ed0f934d5ba502a24275f80515eeba22d682f9618bf323dd281b386e88a55c1', '', 'a4c6982cb86a34ad8d0a36c323fe6e20', 1532276171, 0, 0, 'caixa', 1532276171, 1532869020),
(13, 'gestorestoque', 'João do Estoque', 'c7fc5561e9535e9b10ad827377717b2c860021f4ab8f80768d956cf2b11f2693b', 'gestestoque@gmail.com', '5dc19492298c96762bd3ff534e1d2c09', 1532276273, 0, 1, 'gestorestoque', 1532276273, 1532276579),
(14, 'ana', 'ANA ZAU', '0d30a5f1109a990879e57ee321ed8a85a31f8c38e2714133a2dbba12c74179487', '', '7c481aa21223edf3e5c2e044e8759111', 1532276454, 0, 1, 'tesoreiro', 1532276454, 1532714839),
(15, 'ivete', 'IVETE JOSÉ', 'bf565d3b7458e2c3950345b7ec0f0039598ab0af47be3b6e5ea305cbee5c5c657', 'ivete@gmail.com', 'd8812cabe17ce7560e1265940373c984', 1532276530, 0, 1, 'tesoreiro', 1532276530, 0),
(17, 'rh', 'Joana Recursos Humanos', '2185b77639fb9ba6919e8ef62eace84c5a063581f5b016dec4311756d63446713', 'rh@rh.com', '506a58117cea89aca5d3bcbbf16855e9', 1532277140, 0, 1, 'rh', 1532277140, 1532277162),
(18, 'inocencio', 'INOCENCIO MACHADO', '0cd4d93f256931b689143d3bbc53023223eb8342a25b39cceae7194aecf850af1', 'cov.chado@gmail.com', '0498240210b48e764dc522ed5be72301', 1532334870, 0, 1, 'doctor', 1532334870, 0),
(19, 'kafeca', 'MARIA KAFECA', 'eff1a2ba91020e1421f3f6fb1f887e063faaae1dc7550f777035ab386c372c8e7', 'cov.cafeca@gmail.com', 'aeaebc60ae707becd76efcf898a2d3c6', 1532334976, 0, 1, 'doctor', 1532334976, 0),
(20, 'mariaceu', 'MARIA CEU', '57fc210ec1e005323efe1ada4253676940d940557cd8b15c51bc6a4484f3ca2e9', '', '0fb338ddf8fe4e550493ceec8bfd20fd', 1532335054, 0, 1, 'doctor', 1532335054, 1532723208),
(21, 'dilango', 'DOMINGAS DILANGO', '1e0dd665e7c990bb6384c3f707d7cd7b9e15b041c99a9574035b1185eef257d8b', '', 'be0fb64b676697db62ea5f496f0ae383', 1532335173, 0, 1, 'doctor', 1532335173, 1532703338),
(22, 'linote', 'FRANCISCO LINOTE', 'b1a74105cf0dcc4c4930cd84928a8d47d783aff72cce5bfeffe32c7b475ee9c90', '', 'afa2a06eea0ad9ec3147ce0a83b44f22', 1532335247, 0, 1, 'doctor', 1532335247, 1532695012),
(23, 'joana', 'JOANA GASPAR', '9a96b63b999e7c1947e9addaf31bcbc97aeef924b284697c799f18fd94748521c', 'cov.joana@gmail.com', '21e333a9104479c5dc931ef8b115c069', 1532337653, 0, 1, 'catalogador', 1532337653, 0),
(24, 'estima', 'JOSE ESTIMA', '7d11dc66db3165f9be0639910f6c23050be0ad75f2f11853ae1d6def0b2dd0962', 'estima828@hotmail.com', '7134810093781913635bf114820d8645', 1532337806, 0, 1, 'catalogador', 1532337806, 1532704550),
(25, 'paula', 'MARLENE PAULA', '96236574491781d8cdf859cccdea714bee5f7162ac476b496dbe55b892d63f756', '', 'f3dd46cee38f209485b9f6bd004b06ae', 1532337872, 0, 1, 'catalogador', 1532337872, 1532689956),
(26, 'nelson', 'NELSON CHARLES', '1e621688bdf734d1a97443193902c1440c0f0527a3b24b6eb0302772c006bda71', '', 'f1105b4ef2e65365868462eb2c57ed81', 1532338047, 0, 1, 'catalogador', 1532338047, 0),
(27, 'andreia', 'ANDREIA CASTILHO', '9a781a8540ae88d7c66297f1c771f86d841264f1485cfcc1ceda834245ac8a1de', '', 'ca5269a89b40961b24e28436e19f60d6', 1532526607, 0, 1, 'catalogador', 1532526607, 1532705246),
(28, 'julia', 'JULIA KUYUNGU', '370fbaca8abbcf3016a369f689f00d3723a3e62702293d82bdfebe8efbfbe997e', '', '198aef8822c6ba42da5ec13dda00c5f4', 1532526779, 0, 1, 'catalogador', 1532526779, 1532690236),
(29, 'dolores', 'DOLORES CHIPULULU', '6971ec7775d86644fefc404c20c5c8f3a648f57a998314c05edeef26336dabc23', 'dolores@cov.co.ao', 'f9e55420bdbb18a020487665bffe2bbf', 1532526939, 0, 1, 'catalogador', 1532526939, 0),
(30, 'benilde', 'BENILDE COSTA', 'e8c175d6c0b1c21f37968a87015a3555eedd564f5411d0253b0e72bdb226c1f47', '', 'b11a60c871cf28af16d9589b7542ca9a', 1532528182, 0, 1, 'enfermeiro', 1532528182, 1532707021),
(31, 'milenio', 'MILENIO ANDRE', '039367cb801aad738a05dff28df6b758c2d05db0761dee0af50afe476f7da9463', '', '4cf78addc8794834f35f664f8830a595', 1532528265, 0, 1, 'enfermeiro', 1532528265, 1532704237),
(32, 'andre', 'ANDRE VUANGA', '4b86aac9fde61e9f23e3b85d7c7a2ff205b04a7037d739e53ae6c66f1c51f73b3', '', 'f1a3ecd703b21dd6e2da554be924a5d8', 1532528329, 0, 1, 'enfermeiro', 1532528329, 1532529281),
(33, 'conceicao', 'CONCEICAO FILHO', '5ec2211335c2a9879e5cf8dc5b253988d160a0e11bc0e0e4caeb1d2d58cd3d359', '', 'fd12123e2b1d7ed1c34b3eb5c3838c02', 1532528388, 0, 1, 'enfermeiro', 1532528388, 0),
(34, 'claudina', 'CLAUDINA FRAGATA', '0b98f8d780299612e51b654a80310ad829c42614cc6018faf7504ded14e9c1610', 'claudina@cov.co.ao', '105c13ba757ca1f8bf1604282d6b013c', 1532528732, 0, 1, 'caixa', 1532528732, 1532528765),
(35, 'lucilia', 'LUCILIA COSTA', 'bf34925f4d9d6d01af22a091483855652d956bb20a25ab4a3d17c3c7b238b0eb6', 'lucilia@cov.co.ao', '483b149cd08ec67dfa1011efca7c9fd0', 1532531605, 0, 1, 'doctor', 1532531605, 0),
(37, 'deolinda', 'DEOLINDA CHIVELA', 'e118b264802fb610207a4240e84fabcf9602d7357e6e7dd1a4a7e20fa9f2982ef', 'deolinda@cov.co.ao', 'bc9275ab46124dc046feea9ba766bc7f', 1532536437, 0, 1, 'catalogador', 1532536437, 0),
(39, 'mouzinho', 'ENGRACIA MOUZINHO', '7b55db07df3af415fb39888baa81e80abcd3349a7c544deb6b61cb910be9a357b', 'mouzinho@cov.co.ao', '529e75460376a1fcaf6b0731c82d480d', 1532537707, 0, 1, 'doctor', 1532537707, 0),
(40, 'so', 'SALA DE OBSERVACAO', 'a2b8fe6220998bc9dbc2b7f1a0c9ee1400d454540aac2a6220af8503520b9ce00', '', 'e1ba2ef0f5b3ce788d2d1f4963d8eaa5', 1532537796, 0, 1, 'doctor', 1532537796, 1532548097),
(41, 'eugenio', 'EUGENIO MARTINS', 'f8fc0c45449ac536dc9c48cf142d5f01078a98952ba5aa8701acd28c6a2b17185', '', '23ad8127a8693cff13746d4f0c647163', 1532538010, 0, 1, 'doctor', 1532538010, 1532692617),
(42, 'araujo', 'ANA ARAUJO', '9e7055f19be5af9e1c7ab1a4f6d7f6d052c998f6a33b889f9941dcf39ecc538d7', 'araujo@cov.co.ao', '33c70758d4b1232b9ccb93c6653e79a3', 1532538059, 0, 1, 'doctor', 1532538059, 0),
(43, 'adelaide', 'ADELAIDE ANTONIO', '9b52d4bc2ffcb9292638e5968661302549468103edade8edb3514bba0a2bdcfdf', '', 'f6698e7e6903de9039ef1d41391d406e', 1532538129, 0, 1, 'doctor', 1532538129, 1532875868),
(44, 'guias', 'ESPERANÃ‡A GUIAS', '8383273338ff1d095c765297b35e90aaaeef7b5667757a7f54312373b1ca59842', 'guias@cov.co.ao', '505906fda3be039c6611d747fe1b0260', 1532541413, 0, 1, 'doctor', 1532541413, 0),
(45, 'jubilo', 'JUBILO ANTONIO', 'ddc9a4c76cf3746b40692a261c485686903a5842179d53a9e3f49b44c5ba3f23e', 'jubilo@cov.co.ao', '2761efa0b47d8e617bd6cd2cb6acc835', 1532541470, 0, 1, 'doctor', 1532541470, 0),
(46, 'kiavisa', 'KIAVISA DOMINGOS', '49296da34e3a4062e5cb0009c9db8da3a19e009e970202d3402c845f532415e82', 'kiavisa@cov.co.ao', '039ae1b1c63c7a47446cb712612dce28', 1532541519, 0, 1, 'doctor', 1532541519, 0),
(47, 'lyudmila', 'LYUDMILA CARDOSO', 'b42fafb5ed061c3edaaf5ff9c9e4faf709b94b5a537b81cdc2681501736d7c10a', 'lyudmila@cov.co.ao', 'c4c8700b92f518bd69fd593842404e72', 1532541561, 0, 1, 'doctor', 1532541561, 0),
(48, 'luquenia', 'LUQUENIA ANDRE', '2964b49063a6d44161943e64c15a3c34c88dfc138e5e1bc76304913b9c5a75da7', 'luquenia@cov.co.ao', 'e85d8f24cca14235e1b6af8a82f63154', 1532541598, 0, 1, 'doctor', 1532541598, 0),
(49, 'anaduarte', 'ANA VAN-DUNEM', 'bf1ce37dc4adaf50a911fa7f19a457906615b336d0985b57ffd0046d426c1ae5e', 'anaduarte@cov.co.ao', '70d23dbab180815b9cd23dfed9bb78a0', 1532541641, 0, 1, 'doctor', 1532541641, 0),
(50, 'magda', 'MAGDA FARIA', '0a734b7e6253d2f1898fa1099aee7a883915707abb78b673304848caed8efefa6', 'magda@cov.co.ao', '56ad8c6ffce12f2ce11d898cd5c51c38', 1532541679, 0, 1, 'doctor', 1532541679, 0),
(51, 'calupe', 'ANA CALUPE', 'd5c4612779401c4da1095efd48f98cc1c9613453106256a36f59f368a90a12782', 'calupe@cov.co.ao', 'd0adcd46f69bbe44736d237b090aa9a0', 1532541743, 0, 1, 'doctor', 1532541743, 0),
(52, 'luisa', 'LUISA FRANCISCO', 'fdfa3588db4ddc9b39072e38232b570b5bc705b5436f3d1b036d70133b1b39116', 'luisa@cov.co.ao', '3a9c3089e165d16e51fa304f48044922', 1532541785, 0, 1, 'doctor', 1532541785, 0),
(53, 'ukuamaca', 'JOSE UKUAMACA', 'c434bc7f343deac54d7bc709bfbfb4a1b2ab6bd28c31c3da96f6dc773c2121fce', 'ukuamaca@cov.co.ao', 'b3ce05859048a9a425bbe6fc565f9317', 1532541845, 0, 1, 'doctor', 1532541845, 0),
(54, 'marta', 'MARTA FIGUEROA', 'f3e79715119fb0a9974cf5748fbe3a206d964931990eccf9090728fa286c10442', '', '5d74e15308dd2bce09a0a21fb3b8e37e', 1532541903, 0, 1, 'doctor', 1532541903, 1532692148),
(55, 'afonso', 'AFONSO K', '2605f2babed63050f015195fd562bcd7f1e4af522c1cc09a4a8975da119457335', '', '9f939711c5a4846182c0e3d4205ea9e9', 1532541961, 0, 1, 'doctor', 1532541961, 1532716885),
(56, 'michel', 'michel michel', '57f2b21bded2875ae52bce6e7170a1475be09aff77d3572f84c39011dea7b1f1c', 'michel@cov.co.ao', '9a3419998919d170a42263597c257a3b', 1532542022, 0, 1, 'doctor', 1532542022, 0),
(57, 'nambionganga', 'FERNANDO NAMBIONGANGA', 'f7ac33490cebe6f69a4f8ddee5f125785ff7036f460f133d648178a40fc0164af', 'nambionganga@cov.co.ao', 'b7688e8f4004f5afa0ce6cc025e84140', 1532542191, 0, 1, 'doctor', 1532542191, 0),
(58, 'cuvila', 'TOMAS CUVILA', 'f36306f10d574e50f89afdbd7eed1735cc4dd15a423b39527037b119a8ab16f7d', '', '2b807822eb26e1d1185a67d191b616b0', 1532542345, 0, 1, 'farmaceutico', 1532542345, 1532546183),
(59, 'sousa', 'LUIS SOUSA', '989fabc8177cf40c6704d032a78e1ff4c7d0e76342652654ca51439bd2a2cfc19', '', '52b212dee81b2c7af20e0cc284f705e7', 1532542421, 0, 1, 'farmaceutico', 1532542421, 1532640372),
(60, 'ndombasi', 'BERNARDO NDOMBASI', '5a8375c18391c35c7561ad675748a83ab41c4dcea5a2240d651b72a105d057529', 'ndombasi@cov.co.ao', 'f9ed41f3d001a1b53e3ea78ffddde84a', 1532542539, 0, 1, 'farmaceutico', 1532542539, 0),
(61, 'alcina', 'ALCINA CHISSENDE', 'e365b626c8d482ee0029f10478cd39e56e15acbe71615f5dff07fe0d2029bcf75', 'alcina@cov.co.ao', '3e2a3225b566cc4dc225fb10b8e77eb9', 1532542628, 0, 1, 'farmaceutico', 1532542628, 0),
(62, 'juelma', 'JUELMA SOLANGE', '1f75c0a1c72c94a9896445e41ff5df0f0788ee1555c9ed0f86759c41b418738b4', 'juelma@cov.co.ao', 'f38218ce3bd842fea7aa967c40ac7faf', 1532542707, 0, 1, 'doctor', 1532542707, 0),
(63, 'elsa', 'ELSA', '36dad931e2d5513e904f110fb0470f8951251312353ee3a42055b65d592aaeb49', 'elsa@cov.co.ao', '0091bbca6c75f3949109710d6a2e2c31', 1532542807, 0, 1, 'doctor', 1532542807, 0),
(64, 'lourenco', 'LOURENÃ‡O JOSE', '65805bde2066da0a0346834d16d1921a050cc9228040e8b4566b58e8adcb0fd06', 'lourenco@cov.co.ao', 'da05b686150858ef6a4de468290de99f', 1532544219, 0, 1, 'doctor', 1532544219, 0),
(65, 'josina', 'JOSINA NATIVIDADE', '9869411b69f4e0e9237e75650a3c5013d97e6447a4d58e1916d00fdad5e63893d', '', '986bb4e0ceb64f8f436e8bfb67042edc', 1532544253, 0, 1, 'doctor', 1532544253, 1532697316),
(66, 'euma', 'EUMA SILVA', '0558f3e27f79304043cdda599fcbd9fa803d7fff71f520dde06082d2d4ef8dc78', '', '4c99ac8d53a18f004fa86eb3cb0d44aa', 1532544380, 0, 1, 'doctor', 1532544380, 1532709647),
(67, 'pedro', 'PEDRO COSTA', '5ed0ee19744e29f5003c207776a3fc7bc15bdcf9cbc5d2ad403f70ecd8df28798', 'pedro@cov.co.ao', 'da4161969fb6b30d157cc6cb53d6d73c', 1532544526, 0, 1, 'doctor', 1532544526, 0),
(68, 'catarina', 'CATARINA CHICANGALA', '8771b1e17bad7fcdde6d0e5d35a7419494329ccf96e509afd52497fe6b489f653', 'catarina@cov.co.ao', '0b97214ca841cdaeec293978a6b8ce90', 1532546443, 0, 1, 'doctor', 1532546443, 0),
(69, 'teka', 'JULIANA TEKA', '36f45ee845a7969dc106daad3c78d0a2f6e5f8a2c72465f733ced26680aebabe3', '', '47431a88a68d0558d32d28dd3825fa05', 1532611247, 0, 1, 'farmaceutico', 1532611247, 1532611332),
(70, 'padre', 'ANTONIO PADRE', 'c1cf0d7713b86b3edc64a2c669baf715372c416bf35e53f8c1d910c7cf476b832', 'padre@cov.co.ao', '3515790db94dcee16c122ea1482c8636', 1532687044, 0, 1, 'admin', 1532687044, 1532710056),
(71, 'manuel', 'MANUEL CHIQUETE', '2a1299ebed4655ec1d18af347dea86e43ed24a7947b5aecfe700069e5a71bcb80', '', '3049b3782db20f92e3483cb5798e47af', 1532692497, 0, 1, 'doctor', 1532692497, 1532710057),
(72, 'grafico', 'GrÃ¡fico', '1cf26fce39adead86f8ae2d85c46aca6e89a5cf1d8cec3ef96d926dd91a3e21db', 'grafico@cov.co.ao', '23f11eca773d122bc8f34e386aca91a0', 1532880930, 0, 1, 'grafico', 1532880930, 1532886270);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_user_permission_matches`
--

CREATE TABLE `tbl_user_permission_matches` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_user_permission_matches`
--

INSERT INTO `tbl_user_permission_matches` (`id`, `user_id`, `permission_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 0, 1),
(4, 0, 1),
(5, 6, 1),
(6, 7, 1),
(7, 0, 1),
(8, 0, 1),
(9, 0, 1),
(10, 0, 1),
(11, 8, 1),
(12, 9, 1),
(13, 10, 1),
(14, 6, 1),
(15, 7, 1),
(16, 8, 1),
(17, 9, 1),
(18, 10, 1),
(19, 11, 1),
(20, 12, 1),
(21, 13, 1),
(22, 14, 1),
(23, 15, 1),
(24, 16, 1),
(25, 17, 1),
(26, 18, 1),
(27, 19, 1),
(28, 20, 1),
(29, 21, 1),
(30, 22, 1),
(31, 23, 1),
(32, 24, 1),
(33, 25, 1),
(34, 26, 1),
(35, 27, 1),
(36, 27, 1),
(37, 28, 1),
(38, 29, 1),
(39, 30, 1),
(40, 31, 1),
(41, 32, 1),
(42, 33, 1),
(43, 34, 1),
(44, 35, 1),
(45, 36, 1),
(46, 37, 1),
(47, 38, 1),
(48, 39, 1),
(49, 40, 1),
(50, 41, 1),
(51, 42, 1),
(52, 43, 1),
(53, 44, 1),
(54, 45, 1),
(55, 46, 1),
(56, 47, 1),
(57, 48, 1),
(58, 49, 1),
(59, 50, 1),
(60, 51, 1),
(61, 52, 1),
(62, 53, 1),
(63, 54, 1),
(64, 55, 1),
(65, 56, 1),
(66, 57, 1),
(67, 58, 1),
(68, 59, 1),
(69, 60, 1),
(70, 61, 1),
(71, 62, 1),
(72, 63, 1),
(73, 64, 1),
(74, 65, 1),
(75, 66, 1),
(76, 67, 1),
(77, 68, 1),
(78, 69, 1),
(79, 70, 1),
(80, 71, 1),
(81, 72, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `tbl_agenda_medico`
--
ALTER TABLE `tbl_agenda_medico`
  ADD PRIMARY KEY (`id_agenda_medico`);

--
-- Indexes for table `tbl_antecedentes`
--
ALTER TABLE `tbl_antecedentes`
  ADD PRIMARY KEY (`id_antecedentes`);

--
-- Indexes for table `tbl_atendimento_medico`
--
ALTER TABLE `tbl_atendimento_medico`
  ADD PRIMARY KEY (`id_atendimento`);

--
-- Indexes for table `tbl_atestado`
--
ALTER TABLE `tbl_atestado`
  ADD PRIMARY KEY (`id_atendimento`);

--
-- Indexes for table `tbl_caixa_abrir`
--
ALTER TABLE `tbl_caixa_abrir`
  ADD PRIMARY KEY (`id_abertura`);

--
-- Indexes for table `tbl_caixa_fechar`
--
ALTER TABLE `tbl_caixa_fechar`
  ADD PRIMARY KEY (`id_caixa_fechar`);

--
-- Indexes for table `tbl_configuration`
--
ALTER TABLE `tbl_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_consultorio`
--
ALTER TABLE `tbl_consultorio`
  ADD PRIMARY KEY (`id_consultorio`);

--
-- Indexes for table `tbl_contas_a_pagar`
--
ALTER TABLE `tbl_contas_a_pagar`
  ADD PRIMARY KEY (`id_contas_a_pagar`);

--
-- Indexes for table `tbl_devolucao_servicos_consultas`
--
ALTER TABLE `tbl_devolucao_servicos_consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_devolucao_servicos_estomatologia`
--
ALTER TABLE `tbl_devolucao_servicos_estomatologia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_devolucao_servicos_exames`
--
ALTER TABLE `tbl_devolucao_servicos_exames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_devolucao_servicos_gerais`
--
ALTER TABLE `tbl_devolucao_servicos_gerais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_diario_clinico`
--
ALTER TABLE `tbl_diario_clinico`
  ADD PRIMARY KEY (`id_atendimento`);

--
-- Indexes for table `tbl_entrada_de_produto`
--
ALTER TABLE `tbl_entrada_de_produto`
  ADD PRIMARY KEY (`id_entrada_produto`);

--
-- Indexes for table `tbl_entrada_de_produto_farmacia`
--
ALTER TABLE `tbl_entrada_de_produto_farmacia`
  ADD PRIMARY KEY (`id_entrada_produto`);

--
-- Indexes for table `tbl_especialidade`
--
ALTER TABLE `tbl_especialidade`
  ADD PRIMARY KEY (`id_especialidade`);

--
-- Indexes for table `tbl_especialidade_medico`
--
ALTER TABLE `tbl_especialidade_medico`
  ADD PRIMARY KEY (`id_especialidade_medico`);

--
-- Indexes for table `tbl_estoque`
--
ALTER TABLE `tbl_estoque`
  ADD PRIMARY KEY (`id_estoque`);

--
-- Indexes for table `tbl_estoque_farmacia`
--
ALTER TABLE `tbl_estoque_farmacia`
  ADD PRIMARY KEY (`id_estoque`);

--
-- Indexes for table `tbl_exame_clinico`
--
ALTER TABLE `tbl_exame_clinico`
  ADD PRIMARY KEY (`id_exame_clinico`);

--
-- Indexes for table `tbl_exame_clinico_consultado`
--
ALTER TABLE `tbl_exame_clinico_consultado`
  ADD PRIMARY KEY (`exame_clinico_id`);

--
-- Indexes for table `tbl_exame_fisico`
--
ALTER TABLE `tbl_exame_fisico`
  ADD PRIMARY KEY (`id_exame_fisico`);

--
-- Indexes for table `tbl_facturacao`
--
ALTER TABLE `tbl_facturacao`
  ADD PRIMARY KEY (`facturacao_id`);

--
-- Indexes for table `tbl_fornecedores`
--
ALTER TABLE `tbl_fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Indexes for table `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_hipotese`
--
ALTER TABLE `tbl_hipotese`
  ADD PRIMARY KEY (`id_hipotese`);

--
-- Indexes for table `tbl_hipotese_consultado`
--
ALTER TABLE `tbl_hipotese_consultado`
  ADD PRIMARY KEY (`tbl_hipotese_consultado_id`);

--
-- Indexes for table `tbl_isencao_servicos_consultas`
--
ALTER TABLE `tbl_isencao_servicos_consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_isencao_servicos_estomatologia`
--
ALTER TABLE `tbl_isencao_servicos_estomatologia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_isencao_servicos_exames`
--
ALTER TABLE `tbl_isencao_servicos_exames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_isencao_servicos_gerais`
--
ALTER TABLE `tbl_isencao_servicos_gerais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_justificativo_medico`
--
ALTER TABLE `tbl_justificativo_medico`
  ADD PRIMARY KEY (`id_justificativo_medico`);

--
-- Indexes for table `tbl_medico`
--
ALTER TABLE `tbl_medico`
  ADD PRIMARY KEY (`id_medico`);

--
-- Indexes for table `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permission_page_matches`
--
ALTER TABLE `tbl_permission_page_matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_prestadores`
--
ALTER TABLE `tbl_prestadores`
  ADD PRIMARY KEY (`id_prestador`);

--
-- Indexes for table `tbl_produto`
--
ALTER TABLE `tbl_produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `tbl_produto_farmacia`
--
ALTER TABLE `tbl_produto_farmacia`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `tbl_queixas_historial`
--
ALTER TABLE `tbl_queixas_historial`
  ADD PRIMARY KEY (`id_queixas_historial`);

--
-- Indexes for table `tbl_receitas`
--
ALTER TABLE `tbl_receitas`
  ADD PRIMARY KEY (`id_receita`);

--
-- Indexes for table `tbl_requisicao`
--
ALTER TABLE `tbl_requisicao`
  ADD PRIMARY KEY (`id_requisicao`);

--
-- Indexes for table `tbl_saida_de_produto`
--
ALTER TABLE `tbl_saida_de_produto`
  ADD PRIMARY KEY (`id_saida_produto`);

--
-- Indexes for table `tbl_saida_de_produto_farmacia`
--
ALTER TABLE `tbl_saida_de_produto_farmacia`
  ADD PRIMARY KEY (`id_saida_produto`);

--
-- Indexes for table `tbl_seguro_saude`
--
ALTER TABLE `tbl_seguro_saude`
  ADD PRIMARY KEY (`id_seguro_saude`);

--
-- Indexes for table `tbl_servico`
--
ALTER TABLE `tbl_servico`
  ADD PRIMARY KEY (`id_servico`);

--
-- Indexes for table `tbl_servicos_consultas`
--
ALTER TABLE `tbl_servicos_consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_servicos_estomatologia`
--
ALTER TABLE `tbl_servicos_estomatologia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_servicos_exames`
--
ALTER TABLE `tbl_servicos_exames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_servicos_gerais`
--
ALTER TABLE `tbl_servicos_gerais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tratamentos_recomendacoes`
--
ALTER TABLE `tbl_tratamentos_recomendacoes`
  ADD PRIMARY KEY (`id_tratamento_rec`);

--
-- Indexes for table `tbl_triagem`
--
ALTER TABLE `tbl_triagem`
  ADD PRIMARY KEY (`id_triagem`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_permission_matches`
--
ALTER TABLE `tbl_user_permission_matches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbl_agenda_medico`
--
ALTER TABLE `tbl_agenda_medico`
  MODIFY `id_agenda_medico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_antecedentes`
--
ALTER TABLE `tbl_antecedentes`
  MODIFY `id_antecedentes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_atendimento_medico`
--
ALTER TABLE `tbl_atendimento_medico`
  MODIFY `id_atendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_atestado`
--
ALTER TABLE `tbl_atestado`
  MODIFY `id_atendimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_caixa_abrir`
--
ALTER TABLE `tbl_caixa_abrir`
  MODIFY `id_abertura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_caixa_fechar`
--
ALTER TABLE `tbl_caixa_fechar`
  MODIFY `id_caixa_fechar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_configuration`
--
ALTER TABLE `tbl_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_consultorio`
--
ALTER TABLE `tbl_consultorio`
  MODIFY `id_consultorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_contas_a_pagar`
--
ALTER TABLE `tbl_contas_a_pagar`
  MODIFY `id_contas_a_pagar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_devolucao_servicos_consultas`
--
ALTER TABLE `tbl_devolucao_servicos_consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_devolucao_servicos_estomatologia`
--
ALTER TABLE `tbl_devolucao_servicos_estomatologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_devolucao_servicos_exames`
--
ALTER TABLE `tbl_devolucao_servicos_exames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_devolucao_servicos_gerais`
--
ALTER TABLE `tbl_devolucao_servicos_gerais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_diario_clinico`
--
ALTER TABLE `tbl_diario_clinico`
  MODIFY `id_atendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_entrada_de_produto`
--
ALTER TABLE `tbl_entrada_de_produto`
  MODIFY `id_entrada_produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_entrada_de_produto_farmacia`
--
ALTER TABLE `tbl_entrada_de_produto_farmacia`
  MODIFY `id_entrada_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_especialidade`
--
ALTER TABLE `tbl_especialidade`
  MODIFY `id_especialidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_especialidade_medico`
--
ALTER TABLE `tbl_especialidade_medico`
  MODIFY `id_especialidade_medico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_estoque`
--
ALTER TABLE `tbl_estoque`
  MODIFY `id_estoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_estoque_farmacia`
--
ALTER TABLE `tbl_estoque_farmacia`
  MODIFY `id_estoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_exame_clinico`
--
ALTER TABLE `tbl_exame_clinico`
  MODIFY `id_exame_clinico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_exame_clinico_consultado`
--
ALTER TABLE `tbl_exame_clinico_consultado`
  MODIFY `exame_clinico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_exame_fisico`
--
ALTER TABLE `tbl_exame_fisico`
  MODIFY `id_exame_fisico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_facturacao`
--
ALTER TABLE `tbl_facturacao`
  MODIFY `facturacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_fornecedores`
--
ALTER TABLE `tbl_fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hipotese`
--
ALTER TABLE `tbl_hipotese`
  MODIFY `id_hipotese` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hipotese_consultado`
--
ALTER TABLE `tbl_hipotese_consultado`
  MODIFY `tbl_hipotese_consultado_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_isencao_servicos_consultas`
--
ALTER TABLE `tbl_isencao_servicos_consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_isencao_servicos_estomatologia`
--
ALTER TABLE `tbl_isencao_servicos_estomatologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_isencao_servicos_exames`
--
ALTER TABLE `tbl_isencao_servicos_exames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_isencao_servicos_gerais`
--
ALTER TABLE `tbl_isencao_servicos_gerais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_justificativo_medico`
--
ALTER TABLE `tbl_justificativo_medico`
  MODIFY `id_justificativo_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_medico`
--
ALTER TABLE `tbl_medico`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_permission_page_matches`
--
ALTER TABLE `tbl_permission_page_matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_prestadores`
--
ALTER TABLE `tbl_prestadores`
  MODIFY `id_prestador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_produto`
--
ALTER TABLE `tbl_produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_produto_farmacia`
--
ALTER TABLE `tbl_produto_farmacia`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_queixas_historial`
--
ALTER TABLE `tbl_queixas_historial`
  MODIFY `id_queixas_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_receitas`
--
ALTER TABLE `tbl_receitas`
  MODIFY `id_receita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_requisicao`
--
ALTER TABLE `tbl_requisicao`
  MODIFY `id_requisicao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_saida_de_produto`
--
ALTER TABLE `tbl_saida_de_produto`
  MODIFY `id_saida_produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_saida_de_produto_farmacia`
--
ALTER TABLE `tbl_saida_de_produto_farmacia`
  MODIFY `id_saida_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_seguro_saude`
--
ALTER TABLE `tbl_seguro_saude`
  MODIFY `id_seguro_saude` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_servico`
--
ALTER TABLE `tbl_servico`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_servicos_consultas`
--
ALTER TABLE `tbl_servicos_consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_servicos_estomatologia`
--
ALTER TABLE `tbl_servicos_estomatologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_servicos_exames`
--
ALTER TABLE `tbl_servicos_exames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_servicos_gerais`
--
ALTER TABLE `tbl_servicos_gerais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_tratamentos_recomendacoes`
--
ALTER TABLE `tbl_tratamentos_recomendacoes`
  MODIFY `id_tratamento_rec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_triagem`
--
ALTER TABLE `tbl_triagem`
  MODIFY `id_triagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tbl_user_permission_matches`
--
ALTER TABLE `tbl_user_permission_matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
