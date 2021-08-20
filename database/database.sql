-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20/08/2021 às 07:14
-- Versão do servidor: 10.4.15-MariaDB-cll-lve
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u885894041_novodelivery`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bkp_vendas`
--

CREATE TABLE `bkp_vendas` (
  `id` int(11) NOT NULL,
  `cliente` varchar(20) CHARACTER SET utf8 NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `total_pago` decimal(8,2) NOT NULL,
  `troco` decimal(8,2) NOT NULL,
  `tipo_pgto` varchar(30) CHARACTER SET utf8 NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(25) CHARACTER SET utf8 NOT NULL,
  `pago` varchar(5) CHARACTER SET utf8 NOT NULL,
  `obs` varchar(350) CHARACTER SET utf8 DEFAULT NULL,
  `nome_cliente` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` int(11) NOT NULL,
  `bairro` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rua` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `cpf` varchar(20) CHARACTER SET utf8 NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `id_venda`, `id_produto`, `cpf`, `quantidade`) VALUES
(83, 0, 22, '51981677711', 2),
(85, 0, 23, '55999433296', 2),
(86, 0, 22, '55999433296', 2),
(87, 0, 21, '55999433296', 3),
(89, 0, 26, '55999433296', 2),
(90, 0, 14, '55999433296', 2),
(91, 0, 17, '55999433296', 1),
(92, 126, 23, '51996919023', 2),
(93, 126, 22, '51996919023', 2),
(94, 126, 21, '51996919023', 3),
(96, 126, 19, '51996919023', 1),
(97, 126, 28, '51996919023', 1),
(98, 126, 27, '51996919023', 1),
(99, 127, 23, '51996919023', 2),
(108, 128, 22, '51996919023', 2),
(109, 129, 23, '51996919023', 2),
(110, 129, 21, '51996919023', 3),
(111, 130, 19, '51996919023', 1),
(112, 130, 22, '51996919023', 2),
(113, 131, 22, '51996919023', 2),
(114, 131, 21, '51996919023', 3),
(115, 131, 28, '51996919023', 1),
(116, 132, 23, '51996919023', 2),
(117, 132, 22, '51996919023', 2),
(118, 132, 21, '51996919023', 3),
(119, 133, 22, '51996919023', 2),
(120, 133, 21, '51996919023', 3),
(124, 134, 19, '51996919023', 1),
(125, 134, 17, '51996919023', 1),
(126, 135, 19, '51996919023', 1),
(129, 137, 21, '51996919023', 3),
(130, 137, 20, '51996919023', 3),
(131, 137, 18, '51996919023', 2),
(132, 137, 14, '51996919023', 2),
(133, 137, 19, '51996919023', 1),
(134, 137, 23, '51996919023', 2),
(135, 137, 28, '51996919023', 1),
(136, 137, 27, '51996919023', 1),
(137, 137, 25, '51996919023', 1),
(138, 138, 28, '51996919023', 1),
(139, 138, 22, '51996919023', 2),
(140, 139, 22, '51996919023', 2),
(141, 139, 21, '51996919023', 3),
(142, 0, 28, '55999433296', 1),
(144, 0, 19, '55999433296', 1),
(145, 140, 22, '51996919023', 2),
(146, 141, 22, '51993164081', 2),
(147, 141, 21, '51993164081', 1),
(148, 141, 20, '51993164081', 3),
(149, 143, 23, '51993164081', 2),
(150, 144, 23, '51993164081', 2),
(151, 144, 22, '51993164081', 2),
(152, 144, 21, '51993164081', 1),
(153, 144, 20, '51993164081', 1),
(155, 145, 23, '996919023', 1),
(156, 146, 22, '996919023', 2),
(157, 147, 28, '51996919023', 1),
(158, 148, 23, '51996919023', 1),
(159, 149, 22, '51996919023', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 NOT NULL,
  `descricao` varchar(50) CHARACTER SET utf8 NOT NULL,
  `imagem` varchar(100) CHARACTER SET utf8 NOT NULL,
  `nome_url` varchar(50) CHARACTER SET utf8 NOT NULL,
  `produtos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`, `imagem`, `nome_url`, `produtos`) VALUES
(1, 'Bebidas', 'Bebidas', 'categorias/yWIg8RvY0kqjPS6TEr5PJ6uXx1jCkxa5yGr672EJ.jpeg', 'bebidas', 4),
(8, 'Lanches', 'Lanches', 'categorias/YMxatfAJ9kyycClUt9Ru4bQr2PaBOr3OQy72DXOY.jpeg', 'lanches', 3),
(14, 'Porções', 'Porções', 'categorias/EsZGweFBZFhGhSiR8qTQyElgkxldechLEfp8ywna.jpeg', 'porcoes', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cpf` varchar(20) CHARACTER SET utf8 NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `rua` varchar(100) CHARACTER SET utf8 NOT NULL,
  `numero` varchar(20) CHARACTER SET utf8 NOT NULL,
  `bairro` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cidade` varchar(50) CHARACTER SET utf8 NOT NULL,
  `estado` varchar(5) CHARACTER SET utf8 NOT NULL,
  `cep` varchar(20) CHARACTER SET utf8 NOT NULL,
  `cartao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `telefone`, `email`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `cartao`) VALUES
(1, 'Marcos Santos', '000.000.000-10', '(11) 11111-1111', 'marcos@gmail.com', 'Rua 5', '55', 'Céu Azul', 'Belo Horizonte', 'MG', '33333-333', 21),
(2, 'Hugo Freitas', '111.111.111-11', '(11) 11111-1111', 'hugovasconcelosf@hotmail.com', 'Rua 5', '55', 'Céu Azul', 'Belo Horizonte', '', '', 0),
(3, 'José Silva ', '000.000.000-01', '(99) 99999-999', 'teste@teste.com', 'Hhhh', '6666', 'Canderlária', 'Hhgghh', '', '', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `previsao_minutos` int(11) NOT NULL,
  `taxa_entrega` decimal(8,2) NOT NULL,
  `abertura` time NOT NULL,
  `fechamento` time NOT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ativo',
  `contato` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `config`
--

INSERT INTO `config` (`id`, `previsao_minutos`, `taxa_entrega`, `abertura`, `fechamento`, `status`, `contato`) VALUES
(1, 20, '6.00', '18:00:00', '03:00:00', 'Aberto', '51996919023');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `horarios`
--

CREATE TABLE `horarios` (
  `id` int(15) NOT NULL,
  `dia` varchar(45) DEFAULT NULL,
  `horario_inicio` varchar(45) DEFAULT NULL,
  `horario_final` varchar(45) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `horarios`
--

INSERT INTO `horarios` (`id`, `dia`, `horario_inicio`, `horario_final`, `status`) VALUES
(0, 'Domingo', '18:00', '03:00', 0),
(1, 'Segunda-Feira', '18:00', '03:00', 0),
(2, 'Terça-Feira', '18:00', '03:00', 1),
(3, 'Quarta-Feira', '18:00', '03:00', 1),
(4, 'Quinta-Feira', '18:00', '03:00', 1),
(5, 'Sexta-Feira', '09:00', '03:00', 1),
(6, 'Sábado', '18:00', '03:00', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `locais`
--

CREATE TABLE `locais` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `locais`
--

INSERT INTO `locais` (`id`, `nome`, `valor`) VALUES
(16, 'Centro', '5.00'),
(17, 'Bairros', '6.00'),
(18, 'Agasa', '10.00'),
(19, 'Palmital', '10.00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_16_200009_create_products_table', 1),
(5, '2020_08_23_222812_create_carrinho_table', 2),
(6, '2020_08_23_222812_create_categorias_table', 2),
(7, '2020_08_23_222812_create_clientes_table', 2),
(8, '2020_08_23_222812_create_config_table', 2),
(9, '2020_08_23_222812_create_failed_jobs_table', 2),
(10, '2020_08_23_222812_create_locais_table', 2),
(11, '2020_08_23_222812_create_password_resets_table', 2),
(12, '2020_08_23_222812_create_products_table', 2),
(13, '2020_08_23_222812_create_produtos_table', 2),
(14, '2020_08_23_222812_create_users_table', 2),
(15, '2020_08_23_222812_create_usuarios_table', 2),
(16, '2020_08_23_222812_create_vendas_table', 2),
(17, '2020_08_24_002848_create_carrinho_table', 3),
(18, '2020_08_24_002848_create_categorias_table', 3),
(19, '2020_08_24_002848_create_clientes_table', 3),
(20, '2020_08_24_002848_create_config_table', 3),
(21, '2020_08_24_002848_create_failed_jobs_table', 3),
(22, '2020_08_24_002848_create_locais_table', 3),
(23, '2020_08_24_002848_create_password_resets_table', 3),
(24, '2020_08_24_002848_create_products_table', 3),
(25, '2020_08_24_002848_create_produtos_table', 3),
(26, '2020_08_24_002848_create_users_table', 0),
(27, '2020_08_24_002848_create_usuarios_table', 0),
(28, '2020_08_24_002848_create_vendas_table', 0),
(32, '2020_10_11_192813_create_produto_categorias_table', 4),
(33, '2020_10_12_002554_create_produtos_table', 4),
(34, '2020_11_03_222545_create_locais_table', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('maiki09salles@gmail.com', '$2y$10$UIeX5pjpP/xnp4AatS/Heu2jmzjrykXYoc2Otuo.afiTf2b5gjzGW', '2020-10-08 15:25:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_longa` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produto_categoria_id` bigint(20) UNSIGNED NOT NULL,
  `estoque` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `valor` decimal(10,2) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_url` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `descricao_longa`, `produto_categoria_id`, `estoque`, `valor`, `image`, `nome_url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Coca cola 2L', '2 litros', 'Coca cola 2 litros', 10, 0, '9.00', 'produtos/K9sWrXphpyooaAuDZXqUF9r5EUWXah7tv2QMmeHC.jpg', NULL, NULL, NULL, NULL),
(7, 'Schweppes', 'Citrus 1.5 litros', 'Schweppes citrus 1.5l', 10, 12, '7.00', 'produtos/OJTq8pBz2beDt5ox5dRY6YqSc82lHJI12lgU90CO.jpg', NULL, NULL, NULL, NULL),
(8, 'Baly maçã verde', '2 litros', 'Maçã verde 2 litros', 11, 4, '16.00', 'produtos/Ou6GdOsazFBJ30ZfDOx6jLchTCuYrUuuadkucrAM.jpg', NULL, NULL, NULL, NULL),
(9, 'Baly tradicional', '2 litros', 'baly tradicional 2 litros', 11, 12, '15.00', 'produtos/ZiTJN3uMWfNkCfxSVJl7jlY2XDSGGczXXIkTM9qA.jpg', NULL, NULL, NULL, NULL),
(10, 'Baly tropical', '2 litros', 'baly trop 2 litros', 11, 12, '15.00', 'produtos/gK0lGVEJi7lZgphqX1sx8jBgxHZxZGXHdKmaz80B.jpg', NULL, NULL, NULL, NULL),
(11, 'Safadão', '2 litros', 'safadão 2 litros', 11, 12, '10.00', 'produtos/F8pWn9oIwyVSAQ78rtjcg79CYr8khmjltCrQClU3.jpg', NULL, NULL, NULL, NULL),
(12, 'Eisenbahn latão', '473ml', 'eisen latão pilsen', 13, 0, '6.25', 'produtos/5N7cEzLOJggRkR23iqHkZwlz2cDk5Dy27BpGs6iJ.jpg', NULL, NULL, NULL, NULL),
(14, 'Corona extra long neck', '330ml', 'corona long neck', 13, 48, '7.50', 'produtos/dK5Dq2ghEAyPIPk8wllOxLNU3DmRXXbJtP1rZAnu.jpg', NULL, NULL, NULL, NULL),
(15, 'Brahma chopp latão', '473ml', 'brahma latão', 13, 60, '5.00', 'produtos/MJHcWsHfiLB9JdfNYAuQ3uh3Kz62DuPC8VV6MNQV.jpg', NULL, NULL, NULL, NULL),
(16, 'Smirnoff', 'vodka 1 Litro', 'smirnoff grande', 12, 5, '55.00', 'produtos/9CXVEZswIJ0TPc6jw2YNgTgiXb2tN4xvX0T8uWFh.jpg', NULL, NULL, NULL, NULL),
(17, 'Vodka intencion', '1 litro', 'vodka', 12, 12, '25.00', 'produtos/HRQLbGrF3KJk1Wg3jMphfYUPMjYreuDOt1A5LSCk.jpg', NULL, NULL, NULL, NULL),
(18, 'Brahma duplo malte', '350ml', 'brahma dp malte', 13, 60, '4.50', 'produtos/lPH1zxMLO0Vdfs1LrjrxjiXfEOwqy0nD7rFNR2Td.jpg', NULL, NULL, NULL, NULL),
(19, 'Whisky Bell\'s', '750ML', 'whisky bells', 12, 2, '50.00', 'produtos/8WMzhGO0cIsO9791JgOyuXz7dEG0sX8drw3kluHr.jpg', NULL, NULL, NULL, NULL),
(20, 'Antarctica Sub Zero', 'latão 473ML', 'sub zero latão', 13, 60, '3.80', 'produtos/Ss417Fip8v9pt8ddx7GKWIx1PiEtHdJNKWjGzagA.jpg', NULL, NULL, NULL, NULL),
(21, 'Polar latão', '473ML', 'polar latão', 13, 60, '4.50', 'produtos/5w34g2vR1RCjIdXyaImfOSzH6l5fnpamNgIPeHpu.jpg', NULL, NULL, NULL, NULL),
(22, 'Amstel', 'latão 473ML', 'amstel latão', 13, 60, '5.50', 'produtos/Sl1QuRzCgGlkQ5iekuf4ehzfVEmAj258wJtNMUQu.jpg', NULL, NULL, NULL, NULL),
(23, 'Gelo Pop 3Kg', '3 KG', 'galo 3kg', 14, 40, '8.00', 'produtos/7YZ30i3xOCS49wdZsCuARJ9msutRtKL7ZNhcxaxV.jpg', NULL, NULL, NULL, NULL),
(24, '5 Unidades de Gudang avulso', 'gudang garang importado', 'guds', 15, 100, '10.00', 'produtos/Y4U3F3Bv8GiU0QIbHm5GNOStaA67Yqh4xwCs2lzK.jpg', NULL, NULL, NULL, NULL),
(25, 'Chesterfield azul', 'box 20 unidades', 'chester azul', 15, 20, '7.00', 'produtos/rJAoaOZoPpRnyjwCpfcPi1MazHZefIdxWgk1ML7o.jpg', NULL, NULL, NULL, NULL),
(26, '1Un. gudang avulso', '1 unidade gudang avulso', 'gud', 15, 200, '2.50', 'produtos/AAl215nQ4Pg4v0SqhmTI0lsUDFRFjtXej2yWfM6X.jpg', NULL, NULL, NULL, NULL),
(27, 'Carteita gudang garang', '1 box de gudang', 'gud', 15, 10, '40.00', 'produtos/4M3Ou31CCiMubtWLtZwP2eUywj86jxnZM80zc8DH.jpg', NULL, NULL, NULL, NULL),
(28, 'Seda kings size smoking', 'seda grande', 'seda grande', 15, 50, '7.00', 'produtos/xYsWYkpGzCaviRUsrhhPiigLjlBmHj6hR2o5ioK4.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_categorias`
--

CREATE TABLE `produto_categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produto_categorias`
--

INSERT INTO `produto_categorias` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Refrigerantes', 'categorias/DjA68WejTHrRqb7rY3wFZjzL3MYIzYm4xOtVRSOM.png', '2021-03-26 22:35:39', '2021-03-26 22:35:39', NULL),
(11, 'Energéticos', 'categorias/e7Y7wDbmtjKhT5wBkc3Y72S4UrB05ieZCsCQIXwb.png', '2021-03-26 22:36:24', '2021-03-26 22:36:24', NULL),
(12, 'Destilados', 'categorias/v3JQU7aGclQ52D0Ptpdo0IBrHtP4epwYF0P21VPe.png', '2021-03-26 22:37:00', '2021-03-26 22:37:00', NULL),
(13, 'Cervejas', 'categorias/sguh8BEQ9cM81DLGaKJl38rso6tYpHQnyE4azcbz.jpeg', '2021-03-26 22:37:25', '2021-04-01 21:32:03', NULL),
(14, 'Gelo', 'categorias/3OTV1HhkJzePm3ROvGxMZRdVU8OvjNQECL1Aj6Qt.png', '2021-03-26 22:38:17', '2021-03-26 22:38:17', NULL),
(15, 'Tabacaria', 'categorias/uHH4PtH61jFPPE49V7Wrhi0WkxKSNAIKIE5KJO9j.png', '2021-03-26 22:39:12', '2021-03-26 22:39:12', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Maikelen Salles', 'maiki09salles@gmail.com', NULL, '$2y$10$5jwYM5jCizx85JQD6hrz5Olt0ssWtu0B40UvmqrRJhd4/4FBF/7LG', NULL, '2020-08-24 00:41:08', '2020-08-24 00:41:08'),
(3, 'Master', 'lopes.jocimar@gmail.com', NULL, '$2y$10$lVGeaLSkmXbfydGVJIwbTeDr25wGMmkZrmORdufjAZHPlkqGNNpee', NULL, '2021-03-26 19:57:02', '2021-03-26 19:57:02'),
(4, 'Kings Beer', 'contatokingbeer@gmail.com', NULL, '$2y$10$zgUSrTRPKdzxT/z9wZJ7Xe..T/XG2Ac0ogvm9EB//rrmNw51ai8By', 'RMAAc8yAJHVbb6TNHJsRmBnGkJdQbuCthoWrSszRiO19PtuzkMMXwWR2HTUb', '2021-03-26 23:31:45', '2021-03-26 23:31:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cpf` varchar(20) CHARACTER SET utf8 NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(35) CHARACTER SET utf8 NOT NULL,
  `nivel` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `cliente` varchar(20) CHARACTER SET utf8 NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `total_pago` decimal(8,2) NOT NULL,
  `troco` decimal(8,2) NOT NULL DEFAULT 0.00,
  `tipo_pgto` varchar(30) CHARACTER SET utf8 NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(25) CHARACTER SET utf8 NOT NULL,
  `pago` varchar(5) CHARACTER SET utf8 NOT NULL,
  `obs` varchar(350) CHARACTER SET utf8 DEFAULT NULL,
  `nome_cliente` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` int(11) NOT NULL,
  `bairro` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rua` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `cliente`, `total`, `total_pago`, `troco`, `tipo_pgto`, `data`, `hora`, `status`, `pago`, `obs`, `nome_cliente`, `telefone`, `bairro`, `rua`, `numero`) VALUES
(126, '51996919023', '126.50', '0.00', '0.00', 'CARTÃO', '2021-04-10', '20:17:11', 'Iniciado', 'Não', 'Teste', 'Jocimar', 2147483647, 'Caravagio', 'Test', '1215'),
(127, '51996919023', '14.00', '14.00', '0.00', 'DINHEIRO', '2021-04-11', '02:27:52', 'Iniciado', 'Não', '', 'Arthur', 2147483647, 'cara', 'Rua', '1012'),
(128, '51996919023', '17.00', '20.00', '3.00', 'DINHEIRO', '2021-04-12', '02:58:33', 'Iniciado', 'Não', '', 'Jocimar Lopes', 2147483647, 'Caravagio', 'Conego P Jacobs', '1012'),
(129, '51996919023', '17.50', '20.00', '2.50', 'DINHEIRO', '2021-04-12', '03:02:28', 'Iniciado', 'Não', '', 'Jocimar', 2147483647, 'Caravagio', 'Conego P Jacobs', '1012'),
(130, '51996919023', '67.00', '100.00', '33.00', 'DINHEIRO', '2021-04-12', '03:08:45', 'Iniciado', 'Não', '', 'Jocimar', 2147483647, 'Caravagio', 'conego p jacobs', '1012'),
(131, '51996919023', '28.50', '30.00', '1.50', 'DINHEIRO', '2021-04-12', '03:34:54', 'Iniciado', 'Não', 'Teste', 'Jocimar', 2147483647, 'Caravagio', 'Conego P Jacobs', '1012'),
(132, '51996919023', '24.00', '30.00', '6.00', 'DINHEIRO', '2021-04-12', '03:36:22', 'Iniciado', 'Não', 'Teste', 'Jocimar', 2147483647, 'caravagio', 'conego p jacobs', '1012'),
(133, '51996919023', '21.50', '30.00', '8.50', 'DINHEIRO', '2021-04-12', '03:54:35', 'Iniciado', 'Não', '*Sem* *referências*', 'Jocimar', 2147483647, 'caravagio', 'Conego P jacobs', '1012'),
(134, '51996919023', '81.00', '100.00', '19.00', 'DINHEIRO', '2021-04-12', '04:04:26', 'Iniciado', 'Não', '*Sem* *referências*', 'Jocimar ', 2147483647, 'Caravagio', 'Cônego Pedro Jacobs', '1012'),
(135, '51996919023', '56.00', '70.00', '14.00', 'DINHEIRO', '2021-04-12', '05:25:38', 'Iniciado', 'Não', '*Sem* *referências*', 'Jocimar ', 2147483647, 'Caravágio', 'Conego Pedro Jacobs', '1012'),
(136, '51996919023', '56.00', '70.00', '14.00', 'DINHEIRO', '2021-04-12', '05:25:56', 'Iniciado', 'Não', '*Sem* *referências*', 'Jocimar ', 2147483647, 'Caravágio', 'Conego Pedro Jacobs', '1012'),
(137, '51996919023', '142.80', '0.00', '0.00', 'DINHEIRO', '2021-04-12', '16:45:41', 'Iniciado', 'Não', '*Sem* *referências*', 'Jocimar Lopes', 2147483647, 'Caravagio', 'Cônego p Jacobs', '1012'),
(138, '51996919023', '18.50', '20.00', '1.50', 'DINHEIRO', '2021-04-12', '19:55:37', 'Iniciado', 'Não', 'Próximo ao Avenida', 'Jocimar', 2147483647, 'Aberto', 'Conego P Jacobs', '1012'),
(139, '51996919023', '16.00', '20.00', '4.00', 'DINHEIRO', '2021-04-12', '19:58:01', 'Iniciado', 'Não', '*Sem* *referências*', 'Jocimar', 2147483647, '6.00', 'Conego', '1012'),
(140, '51996919023', '11.50', '20.00', '8.50', 'DINHEIRO', '2021-04-14', '22:52:03', 'Iniciado', 'Não', 'Teste', 'Jocimar ', 2147483647, 'Caravagio', 'Conrg', '1012'),
(141, '51993164081', '26.40', '0.00', '0.00', 'DINHEIRO', '2021-04-27', '18:15:30', 'Iniciado', 'Não', 'UPA', 'Amauri', 2147483647, 'centro ', 'Rua Um', '11'),
(142, '51993164081', '26.40', '0.00', '0.00', 'DINHEIRO', '2021-04-27', '18:16:22', 'Iniciado', 'Não', 'UPA', 'Amauri', 2147483647, 'centro ', 'Rua Um', '11'),
(143, '51993164081', '45.00', '0.00', '0.00', 'DINHEIRO', '2021-04-27', '18:17:47', 'Iniciado', 'Não', 'Upa', 'Amauri', 2147483647, 'Ok', 'A', '1'),
(144, '51993164081', '34.80', '0.00', '0.00', 'DINHEIRO', '2021-04-27', '18:34:46', 'Iniciado', 'Não', '*Sem* *referências*', 'Amauri', 2147483647, 'Cenrro', 'A', '1'),
(145, '996919023', '14.00', '0.00', '0.00', 'CARTÃO', '2021-07-13', '00:29:22', 'Iniciado', 'Não', 'caixa dágua', 'Jocimar Lopes', 996919023, 'Bairros', 'Conego P Jacobs', '1012'),
(146, '996919023', '17.00', '0.00', '0.00', 'CARTÃO', '2021-07-13', '00:33:21', 'Iniciado', 'Não', 'Caixa dágua', 'Jocimar Lopes', 996919023, 'Bairros', 'Conego P Jacobs', '1012'),
(147, '51996919023', '13.00', '0.00', '0.00', 'CARTÃO', '2021-07-16', '07:14:36', 'Iniciado', 'Não', 'Canxa ', 'Joximar ', 2147483647, 'Bairros', 'Conego P Jacobs', '1012'),
(148, '51996919023', '14.00', '0.00', '0.00', 'CARTÃO', '2021-08-20', '05:00:53', 'Iniciado', 'Não', 'Caixa d\'água', 'Jocimar Lopes', 2147483647, 'Bairros', 'Conego P Jacobs', '1012'),
(149, '51996919023', '11.50', '20.00', '8.50', 'DINHEIRO', '2021-08-20', '05:14:02', 'Iniciado', 'Não', 'Caixa dágua', 'Jocimar', 2147483647, 'Bairros', 'Conego P Jacobs', '1012');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `bkp_vendas`
--
ALTER TABLE `bkp_vendas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_produto_categoria_id_foreign` (`produto_categoria_id`);

--
-- Índices de tabela `produto_categorias`
--
ALTER TABLE `produto_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `bkp_vendas`
--
ALTER TABLE `bkp_vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `locais`
--
ALTER TABLE `locais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `produto_categorias`
--
ALTER TABLE `produto_categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_produto_categoria_id_foreign` FOREIGN KEY (`produto_categoria_id`) REFERENCES `produto_categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
