-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2021 at 01:43 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `impera`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nivel` int(10) DEFAULT NULL,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `senha` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `chave` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `token` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nivel`, `nome`, `email`, `senha`, `chave`, `token`, `data_cad`, `status`) VALUES
(1, 1, 'EllosDesign', 'contato@ellosdesign.com.br', '$2y$07$ZzXYji4WgFjoKbUQSWsW0udC/TVTEAfsa/yMD0RpzkRi40xnL3bh6', '8f95cb79987e8864a34a8d26a46bff83', '87fe0b7e995567e525116569a02b4e5bd976b3b9', '2016-10-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_acessos`
--

CREATE TABLE `admin_acessos` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `data_acesso` datetime DEFAULT NULL,
  `ip_acesso` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `user_agent` varchar(500) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin_acessos`
--

INSERT INTO `admin_acessos` (`id`, `id_admin`, `data_acesso`, `ip_acesso`, `user_agent`) VALUES
(1, 1, '2021-08-06 03:39:30', '192.168.15.14', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `admin_avisos`
--

CREATE TABLE `admin_avisos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `mensagem` varchar(10000) COLLATE latin1_general_ci DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  `prioridade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_categorias_niveis`
--

CREATE TABLE `admin_categorias_niveis` (
  `id` int(11) NOT NULL,
  `categoria` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo` varchar(200) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin_categorias_niveis`
--

INSERT INTO `admin_categorias_niveis` (`id`, `categoria`, `titulo`) VALUES
(27, 'configuracoes_loja', 'Opções do site'),
(29, 'usuarios', 'Gerenciar usuários'),
(30, 'niveis', 'Gerenciar acessos'),
(54, 'logos', 'Gerenciar logos'),
(58, 'slide', 'Gerenciar slide'),
(59, 'newsletter', 'Gerenciar newsletter'),
(62, 'paginas', 'Gerenciar páginas institucionais'),
(63, 'blocos_home', 'Gerenciar blocos da home'),
(64, 'blog_categorias', 'Gerenciar categorias do blog'),
(65, 'blog_posts', 'Gerenciar as postagens do blog'),
(74, 'blog_comentarios', 'Gerenciar comentários do blog'),
(77, 'anuncios_caracteristicas', 'Gerenciar características dos Anúncios'),
(78, 'anuncios_condominios', 'Gerenciar condomínios dos Anúncios'),
(79, 'anuncios_destinos', 'Gerenciar destinos dos Anúncios'),
(80, 'proprietarios', 'Gerenciar proprietários'),
(81, 'locatarios', 'Gerenciar locatários'),
(82, 'anuncios', 'Gerenciar Anúncios'),
(83, 'anuncios_datas_indisponiveis', 'Gerenciar datas indisponíveis dos Anúncios'),
(84, 'anuncios_precos', 'Gerenciar tarifas diferenciadas dos Anúncios'),
(85, 'anuncios_taxas', 'Gerenciar taxas dos Anúncios'),
(86, 'anuncios_fotos', 'Gerenciar fotos dos Anúncios'),
(87, 'anuncios_avaliacoes', 'Gerenciar avaliações dos Anúncios'),
(88, 'anuncios_reservas', 'Gerenciar reservas'),
(89, 'videos', 'Gerenciar vídeos'),
(90, 'locatarios_mensagens', 'Gerenciar mensagens dos locatários'),
(91, 'faq', 'Gerenciar faq'),
(92, 'pag_politica-de-privacidade', 'Gerenciar políticas de privacidade'),
(93, 'anuncios_reservas_valores', 'Gerenciar pagamentos das reservas'),
(94, 'anuncios_reservas_valores_repasse', 'Gerenciar repasses das reservas'),
(95, 'proprietarios_mensagens', 'Gerenciar mensagens dos proprietários'),
(96, 'locatarios_arquivos', 'Gerenciar arquivos recebidos e enviados dos locatários	'),
(97, 'proprietarios_arquivos', 'Gerenciar arquivos recebidos e enviados dos proprietários	'),
(98, 'buscas', 'Gerenciar buscas personalizadas'),
(99, 'buscas_anuncios', 'Gerenciar anúncios das buscas personalizadas');

-- --------------------------------------------------------

--
-- Table structure for table `admin_niveis`
--

CREATE TABLE `admin_niveis` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `permissoes` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin_niveis`
--

INSERT INTO `admin_niveis` (`id`, `titulo`, `permissoes`, `status`) VALUES
(1, 'Geral', 'alertas,meus_dados,niveis,anuncios,buscas_anuncios,locatarios_arquivos,proprietarios_arquivos,blog_posts,anuncios_avaliacoes,blocos_home,buscas,anuncios_caracteristicas,blog_categorias,blog_comentarios,anuncios_condominios,anuncios_datas_indisponiveis,anuncios_destinos,faq,anuncios_fotos,locatarios,logos,locatarios_mensagens,proprietarios_mensagens,newsletter,anuncios_reservas_valores,paginas,pag_politica-de-privacidade,proprietarios,anuncios_reservas_valores_repasse,anuncios_reservas,slide,anuncios_precos,anuncios_taxas,usuarios,videos,configuracoes_loja', 1);

-- --------------------------------------------------------

--
-- Table structure for table `afiliados`
--

CREATE TABLE `afiliados` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `senha` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `cep` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `logradouro` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `numero` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `chave` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cad_compl` int(11) DEFAULT 0,
  `dta_cad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `afiliados`
--

INSERT INTO `afiliados` (`id`, `foto`, `nome`, `cpf`, `telefone`, `email`, `senha`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `chave`, `facebook_id`, `status`, `cad_compl`, `dta_cad`) VALUES
(1, '6f399198c245c8779957bf782683c41c.jpg', 'Felipe Silva', '110.448.240-18', '(11) 95910-0184', 'felipeacelino@hotmail.com', '$2y$07$NXtP/JcoQ.EuoqRZmLGMfexDyiIF.iMLiYrAT.KqN7yKcy3Pw.YvO', '', '', '', '', '', '', '', 'a582ffc247351e895779640e40c0ba8f', NULL, 1, 1, '2021-08-06 08:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `afiliados_mensagens`
--

CREATE TABLE `afiliados_mensagens` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `remetente` varchar(255) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `lida` int(1) DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afiliados_mensagens`
--

INSERT INTO `afiliados_mensagens` (`id`, `id_usuario`, `remetente`, `mensagem`, `arquivo`, `lida`, `data`) VALUES
(1, 1, 'usuario', 'teste', NULL, 0, '2021-08-06 08:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo_user` varchar(100) DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `finalidade` varchar(100) DEFAULT NULL,
  `governo` int(11) DEFAULT 0,
  `tipo_id` int(11) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `area` int(11) DEFAULT 0,
  `quartos` int(11) DEFAULT 0,
  `banheiros` int(11) DEFAULT 0,
  `vagas` int(11) DEFAULT 0,
  `andar` int(11) DEFAULT 0,
  `sol` varchar(100) DEFAULT NULL,
  `orientacao` varchar(100) DEFAULT NULL,
  `valor_venda` double(10,2) DEFAULT 0.00,
  `valor_aluguel` double(10,2) DEFAULT 0.00,
  `valor_condominio` double(10,2) DEFAULT 0.00,
  `valor_iptu` double(10,2) DEFAULT 0.00,
  `valor_seguro_incendio` double(10,2) DEFAULT 0.00,
  `valor_taxa_servico` double(10,2) DEFAULT 0.00,
  `mobiliado` int(11) DEFAULT 0,
  `possui_elevador` int(11) DEFAULT 0,
  `proximo_metro` int(11) DEFAULT 0,
  `proximo_brt` int(11) DEFAULT 0,
  `proximo_trem` int(11) DEFAULT 0,
  `aceita_pet` int(11) DEFAULT 0,
  `cep` varchar(100) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(100) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cidade_id` int(11) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `bairro_id` int(11) DEFAULT NULL,
  `regiao_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  `lng` varchar(100) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_id` varchar(100) DEFAULT NULL,
  `video_plataforma` varchar(100) DEFAULT NULL,
  `tour_url` varchar(255) DEFAULT NULL,
  `domingo_status` int(11) DEFAULT 0,
  `domingo_inicio` varchar(50) DEFAULT NULL,
  `domingo_fim` varchar(50) DEFAULT NULL,
  `segunda_status` int(11) DEFAULT 0,
  `segunda_inicio` varchar(50) DEFAULT NULL,
  `segunda_fim` varchar(50) DEFAULT NULL,
  `terca_status` int(11) DEFAULT 0,
  `terca_inicio` varchar(50) DEFAULT NULL,
  `terca_fim` varchar(50) DEFAULT NULL,
  `quarta_status` int(11) DEFAULT 0,
  `quarta_inicio` varchar(50) DEFAULT NULL,
  `quarta_fim` varchar(50) DEFAULT NULL,
  `quinta_status` int(11) DEFAULT 0,
  `quinta_inicio` varchar(50) DEFAULT NULL,
  `quinta_fim` varchar(50) DEFAULT NULL,
  `sexta_status` int(11) DEFAULT 0,
  `sexta_inicio` varchar(50) DEFAULT NULL,
  `sexta_fim` varchar(50) DEFAULT NULL,
  `sabado_status` int(11) DEFAULT 0,
  `sabado_inicio` varchar(50) DEFAULT NULL,
  `sabado_fim` varchar(50) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `destaque` int(11) DEFAULT 0,
  `exclusivo` int(11) DEFAULT 0,
  `taxa` float DEFAULT 0,
  `etapa_venda` int(11) DEFAULT 1,
  `etapa_aluguel` int(11) DEFAULT 1,
  `tag_destaque` int(1) DEFAULT 0,
  `residente` int(11) DEFAULT 0,
  `prop_nome` varchar(255) DEFAULT NULL,
  `prop_tel` varchar(255) DEFAULT NULL,
  `prop_email` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios`
--

INSERT INTO `anuncios` (`id`, `id_usuario`, `tipo_user`, `codigo`, `finalidade`, `governo`, `tipo_id`, `tipo`, `titulo`, `area`, `quartos`, `banheiros`, `vagas`, `andar`, `sol`, `orientacao`, `valor_venda`, `valor_aluguel`, `valor_condominio`, `valor_iptu`, `valor_seguro_incendio`, `valor_taxa_servico`, `mobiliado`, `possui_elevador`, `proximo_metro`, `proximo_brt`, `proximo_trem`, `aceita_pet`, `cep`, `logradouro`, `numero`, `complemento`, `cidade_id`, `bairro`, `bairro_id`, `regiao_id`, `estado_id`, `estado`, `cidade`, `lat`, `lng`, `video_url`, `video_id`, `video_plataforma`, `tour_url`, `domingo_status`, `domingo_inicio`, `domingo_fim`, `segunda_status`, `segunda_inicio`, `segunda_fim`, `terca_status`, `terca_inicio`, `terca_fim`, `quarta_status`, `quarta_inicio`, `quarta_fim`, `quinta_status`, `quinta_inicio`, `quinta_fim`, `sexta_status`, `sexta_inicio`, `sexta_fim`, `sabado_status`, `sabado_inicio`, `sabado_fim`, `hash`, `status`, `destaque`, `exclusivo`, `taxa`, `etapa_venda`, `etapa_aluguel`, `tag_destaque`, `residente`, `prop_nome`, `prop_tel`, `prop_email`, `views`, `slug`, `data_cad`) VALUES
(5, 3, 'proprietario', 'IR000005', 'aluguel', 0, 1, 'Residencial', 'Apartamento para alugar em Ipanema', 100, 4, 4, 2, 5, 'manha', 'fundos', 0.00, 3500.00, 800.00, 80.00, 25.00, 80.00, 1, 1, 1, 1, 1, 1, '22421-000', 'Rua Barão de Jaguaripe', '100', '', 5, 'Ipanema', 14, 1, 19, 'RJ', 'Rio de Janeiro', '-22.981355', '-43.205243', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '04f5fc966ed880f64caff26edab426d2daa9a2c75', 1, 0, 0, 8.5, 1, 1, 3, 0, NULL, NULL, NULL, 8, 'apartamento-para-alugar-em-ipanema', '2021-04-07 10:33:07'),
(6, 3, 'proprietario', 'IR000006', 'aluguel', 0, 1, 'Residencial', 'Apartamento para alugar na Tijuca', 100, 4, 4, 2, 5, 'manha', 'fundos', 0.00, 2000.00, 250.00, 50.00, 15.00, 25.00, 1, 1, 1, 1, 1, 1, '20520-050', 'Rua Conde de Bonfim', '100', '', 5, 'Tijuca', 18, 2, 19, 'RJ', 'Rio de Janeiro', '-22.924688', '-43.224733', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '9c1174c71be18c48694520b59a0e5ae93507f1ae6', 1, 0, 0, 8.5, 1, 1, 0, 0, NULL, NULL, NULL, 6, 'apartamento-para-alugar-na-tijuca', '2021-04-07 10:33:19'),
(7, 3, 'proprietario', 'IR000007', 'aluguel', 0, 1, 'Residencial', 'Apartamento a venda em Duque de caxias', 100, 4, 4, 2, 5, 'manha', 'fundos', 0.00, 1350.00, 250.00, 300.00, 25.00, 20.00, 1, 1, 1, 1, 1, 1, '25070-070', 'Avenida Duque de Caxias', '100', '', 2, 'Centro', 20, 10, 19, 'RJ', 'Duque de Caxias', '-22.785086', '-43.308432', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'c35c3af5f011ed60daea1eee413fe7f31549b8f77', 1, 0, 0, 8.5, 1, 1, 0, 0, NULL, NULL, NULL, 10, 'apartamento-a-venda-em-duque-de-caxias', '2021-04-07 10:33:21'),
(8, 3, 'proprietario', 'IR000008', 'aluguel', 0, 1, 'Residencial', 'Apartamento para alugar em Niterói', 100, 4, 4, 2, 5, 'manha', 'fundos', 0.00, 1500.00, 250.00, 300.00, 0.00, 0.00, 1, 1, 1, 1, 1, 1, '24020-290', 'Rua Acadêmico Walter Gonçalves', '100', '', 3, 'Centro', 21, 10, 19, 'RJ', 'Niterói', '-22.895013', '-43.120850', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'b8b35ff164e8ead4fc64071380e63d6da09a4ecc8', 1, 0, 0, 8.5, 1, 1, 3, 0, NULL, NULL, NULL, 9, 'apartamento-para-alugar-em-niteroi', '2021-04-07 10:33:24'),
(9, 3, 'proprietario', 'IR000009', 'aluguel', 0, 1, 'Residencial', 'Apartamento para alugar no Rio', 100, 4, 4, 2, 5, 'manha', 'fundos', 0.00, 1500.00, 250.00, 30.00, 15.00, 25.00, 1, 1, 1, 1, 1, 1, '20010-010', 'Praça Quinze de Novembro', '125', '', 5, 'Centro', 12, 10, 19, 'RJ', 'Rio de Janeiro', '-22.904032', '-43.174707', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '734e7cebf34afaaf45785fdcf5fa549a18e5c4a29', 1, 0, 0, 8.5, 1, 1, 0, 0, NULL, NULL, NULL, 9, 'apartamento-para-alugar-no-rio', '2021-04-07 10:33:26'),
(10, 3, 'proprietario', 'IR000010', 'venda', 0, 1, 'Residencial', 'Apartamento a venda em Copacabana', 100, 4, 4, 2, 5, 'manha', 'fundos', 1500000.00, 0.00, 250.00, 300.00, 0.00, 0.00, 1, 1, 1, 1, 1, 1, '22060-040', 'Rua Almirante Gonçalves', '100', '', 5, 'Copacabana', 16, 0, 19, 'RJ', 'Rio de Janeiro', '-22.979813', '-43.190509', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '8f78a0d24e78ae8947ba011a71bab0f2beb537f710', 1, 0, 0, 8.5, 1, 1, 0, 0, NULL, NULL, NULL, 16, 'apartamento-a-venda-em-copacabana', '2021-04-07 10:33:36'),
(11, 3, 'proprietario', 'IR000011', 'venda', 0, 1, 'Residencial', 'Apartamento a venda em Jacarepaguá', 100, 4, 4, 2, 5, 'manha', 'fundos', 1200000.00, 0.00, 250.00, 300.00, 0.00, 0.00, 1, 1, 1, 1, 1, 1, '22753-212', 'Estrada de Jacarepaguá', '100', '', 5, 'Jacarepaguá', 13, 3, 19, 'RJ', 'Rio de Janeiro', '-22.961746', '-43.334835', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '6eb447cf0ec06759fa883c04dadd2728f56dbbfb11', 1, 0, 0, 8.5, 1, 1, 0, 0, NULL, NULL, NULL, 18, 'apartamento-a-venda-em-jacarepagua', '2021-04-07 10:33:38'),
(12, 3, 'proprietario', 'IR000012', 'venda', 0, 1, 'Residencial', 'Casa a venda em Nova Iguaçu', 100, 4, 4, 2, 5, 'manha', 'fundos', 1500000.00, 0.00, 250.00, 300.00, 0.00, 0.00, 1, 1, 1, 1, 1, 1, '26210-970', 'Rua Otávio Tarquino 87', '100', '', 4, 'Centro', 23, 2, 19, 'RJ', 'Nova Iguaçu', '-22.759054', '-43.451112', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '329af202369114602697d3a3aba772d5ec95bd1812', 1, 0, 0, 8.5, 1, 1, 3, 0, NULL, NULL, NULL, 21, 'casa-a-venda-em-nova-iguacu', '2021-04-07 10:33:41'),
(13, 3, 'proprietario', 'IR000013', 'venda', 0, 2, 'Residencial', 'Casa a venda em Niterói', 100, 4, 4, 2, 5, 'manha', 'fundos', 1500000.00, 0.00, 250.00, 300.00, 0.00, 0.00, 1, 1, 1, 1, 1, 1, '24020-290', 'Rua Acadêmico Walter Gonçalves', '100', '', 3, 'Centro', 21, 10, 19, 'RJ', 'Niterói', '-22.895013', '-43.120850', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'fa25617a5c159c838da95e99cb437eb25b7beb6813', 1, 0, 0, 8.5, 1, 1, 0, 0, NULL, NULL, NULL, 17, 'casa-a-venda-em-niteroi', '2021-04-07 10:33:44'),
(14, 3, 'proprietario', 'IR000014', 'venda', 0, 1, 'Residencial', 'Apartamento a venda no Rio', 100, 4, 4, 2, 5, 'manha', 'fundos', 1500000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 1, 1, 1, 1, 1, '20010-010', 'Praça Quinze de Novembro', '100', '', 5, 'Centro', 12, 10, 19, 'RJ', 'Rio de Janeiro', '-22.904032', '-43.174707', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, '', '', 1, '08:00', '18:00', 0, '', '', 1, '09:00', '17:00', 0, '', '', 1, '10:00', '16:00', 0, '', '', 'cfb29194599f45b1a26f5e755d24192812bc415714', 1, 0, 1, 8, 1, 1, 0, 1, 'Felipe Silva', '(11) 11111-1111', 'felipeacelino@hotmail.com', 29, 'apartamento-a-venda-no-rio', '2021-04-07 10:33:48'),
(33, 10, 'proprietario', 'IR000033', 'aluguel', 0, 1, 'Residencial', 'Apartamento para venda em Vila Isabel ', 60, 2, 2, 0, 802, 'manha', 'frente', 0.00, 1000.00, 600.00, 100.00, 0.00, 0.00, 1, 1, 1, 0, 0, 1, '20560-121', 'Rua Visconde de Santa Isabel', '337', '501', 5, 'Grajaú', 19, 2, 19, 'RJ', 'Rio de Janeiro', '-22.916809', '-43.255401', NULL, NULL, NULL, NULL, 0, '', '', 1, '08:00', '18:00', 1, '08:00', '18:00', 0, '', '', 1, '08:00', '18:00', 0, '', '', 1, '09:00', '16:00', '721112c0dae35b93cc1541a173a5da58532a8d6633', 1, 0, 1, 8, 1, 1, 0, 1, NULL, NULL, NULL, 8, 'apartamento-para-venda-em-vila-isabel', '2021-05-21 20:57:27'),
(34, 10, 'proprietario', 'IR000034', 'venda', 0, 1, 'Residencial', 'Apartamento para venda em Vila Isabel ', 60, 2, 2, 0, 802, 'manha', 'frente', 300000.00, 0.00, 600.00, 100.00, 0.00, 0.00, 1, 1, 1, 0, 0, 1, '20560-121', 'Rua Visconde de Santa Isabel', '337', '501', 5, 'Grajaú', 19, 2, 19, 'RJ', 'Rio de Janeiro', '-22.916809', '-43.255401', '', '', '', '', 0, '', '', 1, '8:00', '18:00', 1, '08:00', '18:00', 0, '', '', 1, '08:00', '18:00', 0, '', '', 1, '09:00', '16:00', 'abb77259bafdaf3a7ddcec5259f443de0782388934', 1, 0, 1, 8, 1, 1, 0, 1, NULL, NULL, NULL, 23, 'apartamento-para-venda-em-vila-isabel-34', '2021-05-21 21:11:46'),
(35, 10, 'proprietario', 'IR000035', 'venda', 0, 2, 'Residencial', 'Apartamento para venda em Vila Isabel ', 0, 3, 1, 2, 6, 'manha', 'frente', 450000.00, 0.00, 200.00, 20.00, 0.00, 0.00, 1, 1, 0, 0, 0, 0, '20560-121', 'Rua Visconde de Santa Isabel', '337', '608', 5, 'Grajaú', 19, 2, 19, 'RJ', 'Rio de Janeiro', '-22.916643', '-43.255341', NULL, NULL, NULL, NULL, 0, '', '', 1, '08:00', '18:00', 1, '08:00', '18:00', 0, '', '', 0, '', '', 1, '08:00', '18:00', 1, '09:00', '16:00', '4d20783071ce50518d2ac7614eee6d23f7318cc535', 1, 0, 1, 8, 1, 1, 0, 0, NULL, NULL, NULL, 2, 'apartamento-para-venda-em-vila-isabel-35', '2021-05-22 17:38:39'),
(37, 10, 'proprietario', 'IR000037', 'venda', 0, 1, 'Residencial', 'Apartamento à venda no Grajaú ', 80, 4, 2, 2, 2, 'manha', 'frente', 560000.00, 0.00, 750.00, 80.00, 0.00, 0.00, 0, 1, 1, 0, 0, 1, '20560-121', 'Rua Visconde de Santa Isabel', '50', '205', 5, 'Grajaú', 19, 2, 19, 'RJ', 'Rio de Janeiro', '-22.917239', '-43.258792', NULL, NULL, NULL, NULL, 0, '', '', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 0, '', '', '7d5545faf08e97234de7dd5a977311fb0da0ab4b37', 1, 0, 1, 8, 1, 1, 0, 0, NULL, NULL, NULL, 9, 'apartamento-a-venda-no-grajau-37', '2021-05-23 13:53:35'),
(40, 10, 'proprietario', 'IR000040', 'venda', 0, 1, 'Residencial', 'Apartamento à venda no Grajaú ', 80, 4, 2, 2, 2, 'manha', 'frente', 560000.00, 0.00, 750.00, 80.00, 0.00, 0.00, 0, 1, 1, 0, 0, 1, '20560-121', 'Rua Visconde de Santa Isabel', '50', '205', 5, 'Grajaú', 19, 2, 19, 'RJ', 'Rio de Janeiro', '-22.917239', '-43.258792', '', '', '', '', 0, '', '', 1, '8:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 0, '', '', '3f30289c1a60a17d4854e71c582f3e265458167340', 1, 0, 1, 8, 1, 1, 0, 0, NULL, NULL, NULL, 5, 'apartamento-a-venda-no-grajau-37-40', '2021-05-23 15:37:08'),
(42, 10, 'proprietario', 'IR000042', 'venda', 0, 1, 'Residencial', 'Apartamento à venda no Grajaú ', 80, 4, 2, 2, 2, 'manha', 'frente', 560000.00, 0.00, 750.00, 80.00, 0.00, 0.00, 0, 1, 1, 0, 0, 1, '20560-121', 'Rua Visconde de Santa Isabel', '50', '205', 5, 'Grajaú', 19, 2, 19, 'RJ', 'Rio de Janeiro', '-22.917239', '-43.258792', '', '', '', '', 0, '', '', 1, '8:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 0, '', '', 'e216df9907b9789e19b1ddec90255975e69ab20142', 1, 0, 1, 8, 1, 1, 0, 0, NULL, NULL, NULL, 2, 'apartamento-a-venda-no-grajau-37-40-42', '2021-05-23 18:18:44'),
(44, 3, 'proprietario', 'IR000044', NULL, 0, 1, 'Residencial', 'Apartamento a venda no Rio', 100, 4, 4, 2, 5, 'manha', 'fundos', 1500000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 1, 1, 1, 1, 1, '20010-010', 'Praça Quinze de Novembro', '100', '', 5, 'Centro', 12, 10, 19, 'RJ', 'Rio de Janeiro', '-22.904032', '-43.174707', 'https://www.youtube.com/watch?v=OE8Wz0-v5nc', 'OE8Wz0-v5nc', 'youtube', 'https://google.com', 0, '', '', 1, '8:00', '18:00', 0, '', '', 1, '09:00', '17:00', 0, '', '', 1, '10:00', '16:00', 0, '', '', 'fc768be8403fb3a5c0b0042a81accd79a51428a744', 2, 0, 1, 8, 1, 1, 0, 1, NULL, NULL, NULL, 1, 'apartamento-a-venda-no-rio-44', '2021-06-09 18:57:27'),
(45, 15, 'corretor', 'IR000045', 'venda', 0, 1, 'Residencial', 'teste', 0, 2, 1, 1, 0, '', '', 250000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, '24020-295', 'Praça Floriano Peixoto', '10', '', 3, 'Centro', 21, 0, 19, 'RJ', 'Niterói', '-22.910690', '-43.176230', NULL, NULL, NULL, NULL, 1, '09:00', '09:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '09:00', '16:00', '16629f624c3c6a9d767f2b2a68435121471e514f45', 1, 0, 0, 8.5, 1, 1, 0, 0, 'Fulano de Tal', '(11) 13278-6783', 'teste@teste.com', 18, 'teste', '2021-06-12 12:34:38'),
(47, 10, 'proprietario', 'IR000047', 'aluguel', 0, 1, 'Residencial', 'Apartamento à venda no Grajaú ', 80, 4, 2, 2, 2, 'manha', 'frente', 0.00, 1500.00, 750.00, 80.00, 0.00, 0.00, 0, 1, 1, 0, 0, 1, '20560-121', 'Rua Visconde de Santa Isabel', '50', '205', 5, 'Grajaú', 19, 2, 19, 'RJ', 'Rio de Janeiro', '-22.917239', '-43.258792', '', '', '', '', 0, '', '', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 0, '', '', '550150224c285e8aa3d6d6331ee3f004f2e947b147', 2, 0, 1, 8, 1, 1, 0, 1, NULL, NULL, NULL, 0, 'apartamento-a-venda-no-grajau', '2021-06-14 20:48:55'),
(48, 19, 'corretor', 'IR000048', 'venda', 0, 1, 'Residencial', 'Apartamento para alugar no Grajaú', 50, 60, 2, 2, 5, 'manha', 'fundos', 500000.00, 0.00, 200.00, 30.00, 0.00, 0.00, 0, 1, 0, 0, 1, 0, '20560-121', 'Rua Visconde de Santa Isabel', '802', '201', 5, 'Grajaú', 19, 0, 19, 'RJ', 'Rio de Janeiro', '-22.916162', '-43.252262', NULL, NULL, NULL, NULL, 0, '', '', 0, '', '', 1, '08:00', '18:00', 0, '', '', 0, '', '', 1, '08:00', '18:00', 0, '', '', '3d4373352f7658bb65c9ed32dabb17ed33d1203448', 1, 0, 1, 8, 1, 1, 0, 1, NULL, NULL, NULL, 0, 'apartamento-para-alugar-no-grajau', '2021-06-17 18:30:03'),
(49, 19, 'corretor', 'IR000049', 'venda', 0, 1, 'Residencial', 'Apartamento para alugar no Grajaú', 50, 60, 2, 2, 5, 'manha', 'fundos', 500000.00, 0.00, 200.00, 30.00, 0.00, 0.00, 0, 1, 0, 0, 1, 0, '20560-121', 'Rua Visconde de Santa Isabel', '802', '201', 5, 'Grajaú', 19, 0, 19, 'RJ', 'Rio de Janeiro', '-22.919469', '-43.269628', NULL, NULL, NULL, NULL, 0, '', '', 0, '', '', 1, '', '', 0, '', '', 0, '', '', 1, '', '', 0, '', '', '655e948b7d25f1314b1f87ded5805e74351d256f49', 1, 0, 1, 8, 1, 1, 0, 1, NULL, NULL, NULL, 0, 'apartamento-para-alugar-no-grajau-49', '2021-06-17 18:32:26'),
(50, 10, 'proprietario', 'IR000050', NULL, 0, 1, 'Residencial', 'Apartamento à venda no Grajaú ', 80, 4, 2, 2, 2, 'manha', 'frente', 0.00, 1500.00, 750.00, 80.00, 0.00, 0.00, 0, 1, 1, 0, 0, 1, '20560-121', 'Rua Visconde de Santa Isabel', '50', '205', 5, 'Grajaú', 19, 2, 19, 'RJ', 'Rio de Janeiro', '-22.917239', '-43.258792', '', '', '', '', 0, '', '', 1, '', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 1, '08:00', '18:00', 0, '', '', 'aa8936533163b08ec0083e6cdbe14021c8a72bc850', 2, 0, 1, 8, 1, 1, 0, 1, NULL, NULL, NULL, 0, 'apartamento-a-venda-no-grajau-50', '2021-07-06 11:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_caracteristicas`
--

CREATE TABLE `anuncios_caracteristicas` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_caracteristicas`
--

INSERT INTO `anuncios_caracteristicas` (`id`, `ordem_exibicao`, `titulo`, `status`) VALUES
(1, 1, 'Piscina privativa', 1),
(3, 2, 'Ar-condicionado', 1),
(7, 4, 'Banheira', 1),
(8, 7, 'Box de vidro', 1),
(9, 9, 'Tanque', 1),
(10, 5, 'Chuveiro de gás', 1),
(11, 8, 'Telas nas janelas', 1),
(12, 6, 'Chuveiro elétrico', 1),
(13, 10, 'Varal de roupas', 1),
(14, 11, 'Fechadura eletrônica', 1),
(15, 3, 'Ventilador de teto', 1),
(16, 12, 'Janela anti-ruído', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_caracteristicas_n_n`
--

CREATE TABLE `anuncios_caracteristicas_n_n` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `caracteristica_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_caracteristicas_n_n`
--

INSERT INTO `anuncios_caracteristicas_n_n` (`id`, `anuncio_id`, `caracteristica_id`) VALUES
(146, 13, 1),
(147, 13, 3),
(148, 13, 15),
(149, 13, 7),
(150, 13, 10),
(151, 13, 12),
(152, 13, 8),
(153, 13, 11),
(154, 13, 9),
(155, 13, 13),
(156, 13, 14),
(157, 13, 16),
(182, 12, 1),
(183, 12, 3),
(184, 12, 15),
(185, 12, 7),
(186, 12, 10),
(187, 12, 12),
(188, 12, 8),
(189, 12, 11),
(190, 12, 9),
(191, 12, 13),
(192, 12, 14),
(193, 12, 16),
(194, 11, 1),
(195, 11, 3),
(196, 11, 15),
(197, 11, 7),
(198, 11, 10),
(199, 11, 12),
(200, 11, 8),
(201, 11, 11),
(202, 11, 9),
(203, 11, 13),
(204, 11, 14),
(205, 11, 16),
(206, 10, 1),
(207, 10, 3),
(208, 10, 15),
(209, 10, 7),
(210, 10, 10),
(211, 10, 12),
(212, 10, 8),
(213, 10, 11),
(214, 10, 9),
(215, 10, 13),
(216, 10, 14),
(217, 10, 16),
(218, 9, 1),
(219, 9, 3),
(220, 9, 15),
(221, 9, 7),
(222, 9, 10),
(223, 9, 12),
(224, 9, 8),
(225, 9, 11),
(226, 9, 9),
(227, 9, 13),
(228, 9, 14),
(229, 9, 16),
(230, 8, 1),
(231, 8, 3),
(232, 8, 15),
(233, 8, 7),
(234, 8, 10),
(235, 8, 12),
(236, 8, 8),
(237, 8, 11),
(238, 8, 9),
(239, 8, 13),
(240, 8, 14),
(241, 8, 16),
(266, 6, 1),
(267, 6, 3),
(268, 6, 15),
(269, 6, 7),
(270, 6, 10),
(271, 6, 12),
(272, 6, 8),
(273, 6, 11),
(274, 6, 9),
(275, 6, 13),
(276, 6, 14),
(277, 6, 16),
(278, 7, 1),
(279, 7, 3),
(280, 7, 15),
(281, 7, 7),
(282, 7, 10),
(283, 7, 12),
(284, 7, 8),
(285, 7, 11),
(286, 7, 9),
(287, 7, 13),
(288, 7, 14),
(289, 7, 16),
(290, 5, 1),
(291, 5, 3),
(292, 5, 15),
(293, 5, 7),
(294, 5, 10),
(295, 5, 12),
(296, 5, 8),
(297, 5, 11),
(298, 5, 9),
(299, 5, 13),
(300, 5, 14),
(301, 5, 16),
(505, 34, 1),
(506, 34, 15),
(507, 34, 7),
(508, 34, 8),
(509, 34, 11),
(510, 34, 14),
(511, 33, 1),
(512, 33, 15),
(513, 33, 7),
(514, 33, 8),
(515, 33, 11),
(516, 33, 14),
(517, 35, 15),
(522, 37, 1),
(523, 37, 3),
(524, 37, 8),
(525, 37, 11),
(526, 37, 14),
(527, 37, 16),
(533, 40, 1),
(534, 40, 3),
(535, 40, 8),
(536, 40, 11),
(537, 40, 14),
(538, 40, 16),
(545, 42, 1),
(546, 42, 3),
(547, 42, 8),
(548, 42, 11),
(549, 42, 14),
(550, 42, 16),
(575, 44, 1),
(576, 44, 3),
(577, 44, 15),
(578, 44, 7),
(579, 44, 10),
(580, 44, 12),
(581, 44, 8),
(582, 44, 11),
(583, 44, 9),
(584, 44, 13),
(585, 44, 14),
(586, 44, 16),
(593, 47, 1),
(594, 47, 3),
(595, 47, 8),
(596, 47, 11),
(597, 47, 14),
(598, 47, 16),
(599, 48, 3),
(600, 48, 15),
(601, 49, 3),
(602, 49, 15),
(603, 50, 1),
(604, 50, 3),
(605, 50, 8),
(606, 50, 11),
(607, 50, 14),
(608, 50, 16),
(609, 14, 1),
(610, 14, 3),
(611, 14, 15),
(612, 14, 7),
(613, 14, 10),
(614, 14, 12),
(615, 14, 8),
(616, 14, 11),
(617, 14, 9),
(618, 14, 13),
(619, 14, 14),
(620, 14, 16);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_comodidades`
--

CREATE TABLE `anuncios_comodidades` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_comodidades`
--

INSERT INTO `anuncios_comodidades` (`id`, `ordem_exibicao`, `titulo`, `status`) VALUES
(1, 1, 'Elevador', 1),
(2, 2, 'Ar condicionado', 1),
(3, 3, 'Aquecimento', 1),
(4, 4, 'Garagem', 1),
(5, 5, 'Depósito', 1),
(6, 6, 'Tv a cabo', 1),
(7, 7, 'Conexão à internet', 1),
(8, 8, 'Recepção', 1),
(9, 9, 'Sala de Reuniões', 1),
(10, 10, 'Entrada de serviço', 1),
(11, 11, 'Chuveiro Elétrico', 1),
(12, 12, 'Janela anti-ruído', 1),
(13, 13, 'Lavanderia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_comodidades_n_n`
--

CREATE TABLE `anuncios_comodidades_n_n` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `comodidade_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_comodos`
--

CREATE TABLE `anuncios_comodos` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_comodos`
--

INSERT INTO `anuncios_comodos` (`id`, `ordem_exibicao`, `titulo`, `status`) VALUES
(1, 1, 'Área de serviço', 1),
(2, 2, 'Escritório', 1),
(3, 3, 'Varanda', 1),
(4, 4, 'Varanda Gourmet', 1),
(5, 5, 'Área Garden', 1),
(6, 6, 'Closet', 1),
(7, 7, 'Suíte', 1),
(8, 8, 'Cozinha Americana', 1),
(9, 9, 'Dependência completa', 1),
(10, 10, 'Quarto de serviço', 1),
(11, 11, 'Banheiro de serviço', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_comodos2`
--

CREATE TABLE `anuncios_comodos2` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_comodos2`
--

INSERT INTO `anuncios_comodos2` (`id`, `ordem_exibicao`, `titulo`, `status`) VALUES
(1, 1, 'Área de serviço', 1),
(2, 2, 'Escritório', 1),
(3, 3, 'Varanda', 1),
(4, 4, 'Cozinha', 1),
(5, 5, 'Mezanino', 1),
(6, 6, 'Divisória de ambiente', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_comodos2_n_n`
--

CREATE TABLE `anuncios_comodos2_n_n` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `comodo2_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_comodos_n_n`
--

CREATE TABLE `anuncios_comodos_n_n` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `comodo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_comodos_n_n`
--

INSERT INTO `anuncios_comodos_n_n` (`id`, `anuncio_id`, `comodo_id`) VALUES
(144, 13, 1),
(145, 13, 2),
(146, 13, 3),
(147, 13, 4),
(148, 13, 5),
(149, 13, 6),
(150, 13, 7),
(151, 13, 8),
(152, 13, 9),
(153, 13, 10),
(154, 13, 11),
(177, 12, 1),
(178, 12, 2),
(179, 12, 3),
(180, 12, 4),
(181, 12, 5),
(182, 12, 6),
(183, 12, 7),
(184, 12, 8),
(185, 12, 9),
(186, 12, 10),
(187, 12, 11),
(188, 11, 1),
(189, 11, 2),
(190, 11, 3),
(191, 11, 4),
(192, 11, 5),
(193, 11, 6),
(194, 11, 7),
(195, 11, 8),
(196, 11, 9),
(197, 11, 10),
(198, 11, 11),
(199, 10, 1),
(200, 10, 2),
(201, 10, 3),
(202, 10, 4),
(203, 10, 5),
(204, 10, 6),
(205, 10, 7),
(206, 10, 8),
(207, 10, 9),
(208, 10, 10),
(209, 10, 11),
(210, 9, 1),
(211, 9, 2),
(212, 9, 3),
(213, 9, 4),
(214, 9, 5),
(215, 9, 6),
(216, 9, 7),
(217, 9, 8),
(218, 9, 9),
(219, 9, 10),
(220, 9, 11),
(221, 8, 1),
(222, 8, 2),
(223, 8, 3),
(224, 8, 4),
(225, 8, 5),
(226, 8, 6),
(227, 8, 7),
(228, 8, 8),
(229, 8, 9),
(230, 8, 10),
(231, 8, 11),
(254, 6, 1),
(255, 6, 2),
(256, 6, 3),
(257, 6, 4),
(258, 6, 5),
(259, 6, 6),
(260, 6, 7),
(261, 6, 8),
(262, 6, 9),
(263, 6, 10),
(264, 6, 11),
(265, 7, 1),
(266, 7, 2),
(267, 7, 3),
(268, 7, 4),
(269, 7, 5),
(270, 7, 6),
(271, 7, 7),
(272, 7, 8),
(273, 7, 9),
(274, 7, 10),
(275, 7, 11),
(276, 5, 1),
(277, 5, 2),
(278, 5, 3),
(279, 5, 4),
(280, 5, 5),
(281, 5, 6),
(282, 5, 7),
(283, 5, 8),
(284, 5, 9),
(285, 5, 10),
(286, 5, 11),
(458, 34, 2),
(459, 34, 3),
(460, 34, 7),
(461, 34, 8),
(462, 34, 10),
(463, 33, 2),
(464, 33, 3),
(465, 33, 7),
(466, 33, 8),
(467, 33, 10),
(468, 35, 2),
(469, 35, 3),
(474, 37, 1),
(475, 37, 2),
(476, 37, 3),
(477, 37, 5),
(478, 37, 6),
(479, 37, 7),
(485, 40, 1),
(486, 40, 2),
(487, 40, 3),
(488, 40, 5),
(489, 40, 6),
(490, 40, 7),
(497, 42, 1),
(498, 42, 2),
(499, 42, 3),
(500, 42, 5),
(501, 42, 6),
(502, 42, 7),
(525, 44, 1),
(526, 44, 2),
(527, 44, 3),
(528, 44, 4),
(529, 44, 5),
(530, 44, 6),
(531, 44, 7),
(532, 44, 8),
(533, 44, 9),
(534, 44, 10),
(535, 44, 11),
(542, 47, 1),
(543, 47, 2),
(544, 47, 3),
(545, 47, 5),
(546, 47, 6),
(547, 47, 7),
(548, 48, 7),
(549, 48, 10),
(550, 49, 7),
(551, 49, 10),
(552, 50, 1),
(553, 50, 2),
(554, 50, 3),
(555, 50, 5),
(556, 50, 6),
(557, 50, 7),
(558, 14, 1),
(559, 14, 2),
(560, 14, 3),
(561, 14, 4),
(562, 14, 5),
(563, 14, 6),
(564, 14, 7),
(565, 14, 8),
(566, 14, 9),
(567, 14, 10),
(568, 14, 11);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_condominio`
--

CREATE TABLE `anuncios_condominio` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `only_admin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_condominio`
--

INSERT INTO `anuncios_condominio` (`id`, `ordem_exibicao`, `titulo`, `status`, `only_admin`) VALUES
(1, 1, 'Parque', 1, 0),
(2, 2, 'Salão de jogos', 1, 0),
(3, 3, 'Bicicletário', 1, 0),
(4, 4, 'Brinquedoteca', 1, 0),
(5, 5, 'Espaço piquenique', 1, 0),
(6, 6, 'Pista de caminhada', 1, 0),
(7, 7, 'Wi-Fi', 1, 0),
(8, 8, 'Spa', 1, 0),
(9, 9, 'Sala de massagem', 1, 0),
(10, 10, 'Academia', 1, 0),
(11, 11, 'Churrasqueira', 1, 0),
(12, 12, 'Elevador', 1, 0),
(13, 13, 'Espaço gourmet na área comum', 1, 0),
(14, 14, 'Lavanderia no prédio', 1, 0),
(15, 15, 'Piscina', 1, 0),
(16, 16, 'Playground', 1, 0),
(17, 17, 'Portaria 24h', 1, 0),
(18, 18, 'Quadra esportiva', 1, 0),
(19, 19, 'Salão de festas', 1, 0),
(20, 20, 'Sauna', 1, 0),
(21, 21, 'Vaga para visitante', 1, 0),
(22, 22, 'Espaço Pet', 1, 0),
(24, 23, 'Fitness Externo', 1, 1),
(25, 24, 'Praça de Jogos', 1, 1),
(26, 25, 'Horta e Pomar', 1, 1),
(27, 26, 'Redário', 1, 1),
(28, 27, 'Espaço Zen', 1, 1),
(29, 28, 'Quadra de Tênis', 1, 1),
(30, 29, 'Espaço Kids', 1, 1),
(31, 30, 'Sala de Cinema', 1, 1),
(32, 31, 'Sala de Massagem', 1, 1),
(33, 32, 'Sala de Repouso', 1, 1),
(34, 33, 'Sala de Estudos', 1, 1),
(35, 34, 'Salão de Jogos Adulto', 1, 1),
(36, 35, 'Forno de Pizza', 1, 1),
(37, 36, 'Espaço Gazebo', 1, 1),
(38, 37, 'Playground Baby', 1, 1),
(39, 38, 'Espaço Coworking', 1, 1),
(40, 39, 'Espaço Bar', 1, 1),
(41, 40, 'Espaço Lobby', 1, 1),
(42, 41, 'Solarium', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_condominio_n_n`
--

CREATE TABLE `anuncios_condominio_n_n` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `condominio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_condominio_n_n`
--

INSERT INTO `anuncios_condominio_n_n` (`id`, `anuncio_id`, `condominio_id`) VALUES
(304, 13, 1),
(305, 13, 2),
(306, 13, 3),
(307, 13, 4),
(308, 13, 5),
(309, 13, 6),
(310, 13, 7),
(311, 13, 8),
(312, 13, 9),
(313, 13, 10),
(314, 13, 11),
(315, 13, 12),
(316, 13, 13),
(317, 13, 14),
(318, 13, 15),
(319, 13, 16),
(320, 13, 17),
(321, 13, 18),
(322, 13, 19),
(323, 13, 20),
(324, 13, 21),
(367, 12, 1),
(368, 12, 2),
(369, 12, 3),
(370, 12, 4),
(371, 12, 5),
(372, 12, 6),
(373, 12, 7),
(374, 12, 8),
(375, 12, 9),
(376, 12, 10),
(377, 12, 11),
(378, 12, 12),
(379, 12, 13),
(380, 12, 14),
(381, 12, 15),
(382, 12, 16),
(383, 12, 17),
(384, 12, 18),
(385, 12, 19),
(386, 12, 20),
(387, 12, 21),
(388, 11, 1),
(389, 11, 2),
(390, 11, 3),
(391, 11, 4),
(392, 11, 5),
(393, 11, 6),
(394, 11, 7),
(395, 11, 8),
(396, 11, 9),
(397, 11, 10),
(398, 11, 11),
(399, 11, 12),
(400, 11, 13),
(401, 11, 14),
(402, 11, 15),
(403, 11, 16),
(404, 11, 17),
(405, 11, 18),
(406, 11, 19),
(407, 11, 20),
(408, 11, 21),
(409, 10, 1),
(410, 10, 2),
(411, 10, 3),
(412, 10, 4),
(413, 10, 5),
(414, 10, 6),
(415, 10, 7),
(416, 10, 8),
(417, 10, 9),
(418, 10, 10),
(419, 10, 11),
(420, 10, 12),
(421, 10, 13),
(422, 10, 14),
(423, 10, 15),
(424, 10, 16),
(425, 10, 17),
(426, 10, 18),
(427, 10, 19),
(428, 10, 20),
(429, 10, 21),
(430, 9, 1),
(431, 9, 2),
(432, 9, 3),
(433, 9, 4),
(434, 9, 5),
(435, 9, 6),
(436, 9, 7),
(437, 9, 8),
(438, 9, 9),
(439, 9, 10),
(440, 9, 11),
(441, 9, 12),
(442, 9, 13),
(443, 9, 14),
(444, 9, 15),
(445, 9, 16),
(446, 9, 17),
(447, 9, 18),
(448, 9, 19),
(449, 9, 20),
(450, 9, 21),
(451, 8, 1),
(452, 8, 2),
(453, 8, 3),
(454, 8, 4),
(455, 8, 5),
(456, 8, 6),
(457, 8, 7),
(458, 8, 8),
(459, 8, 9),
(460, 8, 10),
(461, 8, 11),
(462, 8, 12),
(463, 8, 13),
(464, 8, 14),
(465, 8, 15),
(466, 8, 16),
(467, 8, 17),
(468, 8, 18),
(469, 8, 19),
(470, 8, 20),
(471, 8, 21),
(514, 6, 1),
(515, 6, 2),
(516, 6, 3),
(517, 6, 4),
(518, 6, 5),
(519, 6, 6),
(520, 6, 7),
(521, 6, 8),
(522, 6, 9),
(523, 6, 10),
(524, 6, 11),
(525, 6, 12),
(526, 6, 13),
(527, 6, 14),
(528, 6, 15),
(529, 6, 16),
(530, 6, 17),
(531, 6, 18),
(532, 6, 19),
(533, 6, 20),
(534, 6, 21),
(535, 7, 1),
(536, 7, 2),
(537, 7, 3),
(538, 7, 4),
(539, 7, 5),
(540, 7, 6),
(541, 7, 7),
(542, 7, 8),
(543, 7, 9),
(544, 7, 10),
(545, 7, 11),
(546, 7, 12),
(547, 7, 13),
(548, 7, 14),
(549, 7, 15),
(550, 7, 16),
(551, 7, 17),
(552, 7, 18),
(553, 7, 19),
(554, 7, 20),
(555, 7, 21),
(556, 5, 1),
(557, 5, 2),
(558, 5, 3),
(559, 5, 4),
(560, 5, 5),
(561, 5, 6),
(562, 5, 7),
(563, 5, 8),
(564, 5, 9),
(565, 5, 10),
(566, 5, 11),
(567, 5, 12),
(568, 5, 13),
(569, 5, 14),
(570, 5, 15),
(571, 5, 16),
(572, 5, 17),
(573, 5, 18),
(574, 5, 19),
(575, 5, 20),
(576, 5, 21),
(883, 34, 1),
(884, 34, 2),
(885, 34, 3),
(886, 34, 6),
(887, 34, 7),
(888, 34, 10),
(889, 34, 11),
(890, 34, 12),
(891, 34, 15),
(892, 34, 16),
(893, 34, 17),
(894, 34, 19),
(895, 34, 22),
(896, 33, 1),
(897, 33, 2),
(898, 33, 3),
(899, 33, 6),
(900, 33, 7),
(901, 33, 10),
(902, 33, 11),
(903, 33, 12),
(904, 33, 15),
(905, 33, 16),
(906, 33, 17),
(907, 33, 19),
(908, 33, 22),
(916, 37, 2),
(917, 37, 3),
(918, 37, 5),
(919, 37, 7),
(920, 37, 10),
(921, 37, 11),
(922, 37, 12),
(923, 37, 13),
(924, 37, 14),
(925, 37, 15),
(926, 37, 16),
(927, 37, 17),
(928, 37, 18),
(929, 37, 19),
(930, 37, 22),
(939, 40, 2),
(940, 40, 3),
(941, 40, 5),
(942, 40, 7),
(943, 40, 10),
(944, 40, 11),
(945, 40, 12),
(946, 40, 13),
(947, 40, 14),
(948, 40, 15),
(949, 40, 16),
(950, 40, 17),
(951, 40, 18),
(952, 40, 19),
(953, 40, 22),
(969, 42, 2),
(970, 42, 3),
(971, 42, 5),
(972, 42, 7),
(973, 42, 10),
(974, 42, 11),
(975, 42, 12),
(976, 42, 13),
(977, 42, 14),
(978, 42, 15),
(979, 42, 16),
(980, 42, 17),
(981, 42, 18),
(982, 42, 19),
(983, 42, 22),
(1026, 44, 1),
(1027, 44, 2),
(1028, 44, 3),
(1029, 44, 4),
(1030, 44, 5),
(1031, 44, 6),
(1032, 44, 7),
(1033, 44, 8),
(1034, 44, 9),
(1035, 44, 10),
(1036, 44, 11),
(1037, 44, 12),
(1038, 44, 13),
(1039, 44, 14),
(1040, 44, 15),
(1041, 44, 16),
(1042, 44, 17),
(1043, 44, 18),
(1044, 44, 19),
(1045, 44, 20),
(1046, 44, 21),
(1062, 47, 2),
(1063, 47, 3),
(1064, 47, 5),
(1065, 47, 7),
(1066, 47, 10),
(1067, 47, 11),
(1068, 47, 12),
(1069, 47, 13),
(1070, 47, 14),
(1071, 47, 15),
(1072, 47, 16),
(1073, 47, 17),
(1074, 47, 18),
(1075, 47, 19),
(1076, 47, 22),
(1077, 48, 2),
(1078, 48, 9),
(1079, 48, 10),
(1080, 48, 14),
(1081, 49, 2),
(1082, 49, 9),
(1083, 49, 10),
(1084, 49, 14),
(1085, 50, 2),
(1086, 50, 3),
(1087, 50, 5),
(1088, 50, 7),
(1089, 50, 10),
(1090, 50, 11),
(1091, 50, 12),
(1092, 50, 13),
(1093, 50, 14),
(1094, 50, 15),
(1095, 50, 16),
(1096, 50, 17),
(1097, 50, 18),
(1098, 50, 19),
(1099, 50, 22),
(1100, 14, 1),
(1101, 14, 2),
(1102, 14, 3),
(1103, 14, 4),
(1104, 14, 5),
(1105, 14, 6),
(1106, 14, 7),
(1107, 14, 8),
(1108, 14, 9),
(1109, 14, 10),
(1110, 14, 11),
(1111, 14, 12),
(1112, 14, 13),
(1113, 14, 14),
(1114, 14, 15),
(1115, 14, 16),
(1116, 14, 17),
(1117, 14, 18),
(1118, 14, 19),
(1119, 14, 20),
(1120, 14, 21);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_fotos`
--

CREATE TABLE `anuncios_fotos` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `destaque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_fotos`
--

INSERT INTO `anuncios_fotos` (`id`, `item_id`, `ordem`, `foto`, `descricao`, `destaque`) VALUES
(1, 14, 1, '944b26984428e0f9d564b91daa193a08.jpg', NULL, 1),
(2, 14, 3, '9a01b50b4863dfbc67f5794e0e30a55b.jpg', NULL, 0),
(3, 14, 4, '065cc9fc08e4acf256f58055dff11c17.jpg', NULL, 0),
(4, 14, 6, '022c0e370c96dfecaacc548216e6816a.jpg', NULL, 0),
(5, 14, 5, '7cc549101ceaa8ab04c65c536e024c8e.jpg', NULL, 0),
(6, 14, 2, 'cf8012cf82b7c1789252d17f5f6e24f4.jpg', NULL, 0),
(7, 13, NULL, '9f94b6466174e80a2c8b782830a16a71.jpg', NULL, 0),
(8, 13, NULL, 'ad4393e5a9b64020c2eedc3abdc1b176.jpg', NULL, 1),
(9, 13, NULL, 'a5c38feda7499f69aadebe93b63c30b6.jpg', NULL, 0),
(10, 13, NULL, 'b000ecd261cdfbef995f65b3bd948644.jpg', NULL, 0),
(11, 13, NULL, 'bc27c5172858363326a5174ec21bfecd.jpg', NULL, 0),
(12, 13, NULL, 'a2d8fdd9225271c880965b8f3a5a3ade.jpg', NULL, 0),
(13, 12, NULL, '5853474d8dd8b00c2806fe6f44ba9482.jpg', NULL, 0),
(14, 12, NULL, '8bf502f99965cdf427b574bd6c65c71c.jpg', NULL, 0),
(15, 12, NULL, '409497f5325f9bd8c625b0b4f9229b8e.jpg', NULL, 1),
(16, 12, NULL, '659e6b5fbfb46b44aeb0ba8db6bf5cec.jpg', NULL, 0),
(17, 12, NULL, 'ce1eb0a1ceff0575401dd291c32123de.jpg', NULL, 0),
(18, 12, NULL, '9b8a93443fa7e655a1eacb1bcc0b355b.jpg', NULL, 0),
(19, 11, NULL, '559773b78a59f0bc88a176b6d0b4a551.jpg', NULL, 0),
(20, 11, NULL, '4acd4370b362f1ab332240502af7935e.jpg', NULL, 0),
(21, 11, NULL, '56f4927a54def8305e2518beb1f92d4a.jpg', NULL, 0),
(22, 11, NULL, '7478a15fc805315f94a805d98d86aeed.jpg', NULL, 1),
(23, 11, NULL, 'd415ffd0e9f32627c64c39f2a9281cef.jpg', NULL, 0),
(24, 11, NULL, '84c6551a1452095adcb187141801520b.jpg', NULL, 0),
(25, 10, NULL, '2c27d892e2793480b20b0e759a16505a.jpg', NULL, 0),
(26, 10, NULL, '95038d9c6f2d903bcd4a08d5698706f7.jpg', NULL, 0),
(27, 10, NULL, '77b655d1c4cb44e129e7d5558a320357.jpg', NULL, 0),
(28, 10, NULL, 'b320e956d9f70c45439c67de6a3cd99b.jpg', NULL, 0),
(29, 10, NULL, '8970a685ff9b1b377415fe7c38ef479b.jpg', NULL, 1),
(30, 10, NULL, 'f4c282646cfb91c3e8ca58ce86a65139.jpg', NULL, 0),
(31, 9, NULL, '6ad181edeefd16bca41026646698da36.jpg', NULL, 0),
(32, 9, NULL, 'ebf6a9f2f81539ddf6cfcfba0102b784.jpg', NULL, 0),
(33, 9, NULL, '02ce7583dd5e91ca691b8acbcc42ba21.jpg', NULL, 0),
(34, 9, NULL, '2f2539a2f98a2bba96c3e67a68fc7855.jpg', NULL, 0),
(35, 9, NULL, 'cd6ec7c357a7a14d7918b15dfbb11c76.jpg', NULL, 0),
(36, 9, NULL, '0f888cb6dc58c632ca74eafa8bc2784d.jpg', NULL, 1),
(37, 8, NULL, '27c32e29e93f37b204b41abf7fc82816.jpg', NULL, 0),
(38, 8, NULL, 'd4d66c2726d3a81d03c38420625ca8f9.jpg', NULL, 0),
(39, 8, NULL, '6934cd04289e8fdf2752247f24ce9d35.jpg', NULL, 0),
(40, 8, NULL, 'f0b3e94280da42bf65b713a66a21cfb5.jpg', NULL, 0),
(41, 8, NULL, '062d7045147d83e174cb78a95a6ac3b5.jpg', NULL, 0),
(42, 8, NULL, '4ddcedfa653840eff6318b6bcee43a3d.jpg', NULL, 0),
(43, 7, NULL, '9ef4daa2328d0e0f7e06e6df0c5de14d.jpg', NULL, 0),
(44, 7, NULL, '9552685e4111ad6db0e7ca64a4e09317.jpg', NULL, 0),
(45, 7, NULL, '0e2ce2198be0f8cfa503c107502ad0f9.jpg', NULL, 0),
(46, 7, NULL, 'a5f9a0eeb3fa08dab40351db283403db.jpg', NULL, 0),
(47, 7, NULL, '09c35ad0e4b97aad64a7781fbe928dda.jpg', NULL, 0),
(48, 7, NULL, '960eae54aa87c26dd35b7e7b94bf9e86.jpg', NULL, 0),
(49, 6, NULL, '0116b3087f224518e27e258b39b7bef0.jpg', NULL, 0),
(50, 6, NULL, 'c424f181506bb5e9cddc5657f7cbde61.jpg', NULL, 0),
(51, 6, NULL, '7ecfbcefb116dea32feda36fa40bf3d3.jpg', NULL, 0),
(52, 6, NULL, 'a81b5e841d23dda8509e80ba7284c345.jpg', NULL, 0),
(53, 6, NULL, '423d71adeb0ff9b62605eaf923885ac7.jpg', NULL, 0),
(54, 6, NULL, 'c220c48f39e41436e8afd6be83f631f9.jpg', NULL, 0),
(55, 5, NULL, '8252711f8799d0e1f19cc5a6d7d4ae0d.jpg', NULL, 0),
(56, 5, NULL, '87098cc378a339d91bb76765878b4bb9.jpg', NULL, 0),
(57, 5, NULL, '5648c1fa7fab978a5c9b492af3da1287.jpg', NULL, 0),
(58, 5, NULL, 'cde5fc0c8b752e674a61daabe21ce95c.jpg', NULL, 0),
(59, 5, NULL, '8eaeb1f6cf1abb191734b02a26f1966a.jpg', NULL, 0),
(60, 5, NULL, 'df5b1e58f2dded09f2df206fe89b5c98.jpg', NULL, 0),
(61, 8, NULL, '197d2117255d18111a7e3462beced89e.jpg', NULL, 1),
(62, 7, NULL, '86ad2128d33af771f964d023ad11fda3.jpg', NULL, 1),
(63, 6, NULL, 'b172bec90737ea4d4a7f4b519cf0c42a.jpg', NULL, 1),
(64, 5, NULL, '1301438414dfdcb7d18db30f3961e93d.jpg', NULL, 1),
(88, 33, 9, 'b4682e3d4a74fd17447aeb151dfd5db9.jpg', NULL, 1),
(89, 33, 1, '97b086da9cf36f01571e5ef9d0df504f.jpg', NULL, 0),
(90, 33, 2, '160f4138db91faa08bab93cd2ddff245.jpg', NULL, 0),
(91, 33, 3, 'dec1d9a5ce76e1468aadd90925e6c52c.jpg', NULL, 0),
(92, 33, 4, 'fd03cddb45927c2794828ab63a3a627d.jpg', NULL, 0),
(93, 33, 5, '8a1d1ddbee1be8242bee5acee62c3cb8.jpg', NULL, 0),
(94, 33, 6, 'f6a5d8878b077afce5430e6e427cf997.jpg', NULL, 0),
(95, 33, 7, '990c31fd51b72d308f81da16a10c378c.jpg', NULL, 0),
(96, 33, 8, '41568417976f2a77087d0a57aff1dec0.jpg', NULL, 0),
(97, 34, 8, 'b4682e3d4a74fd17447aeb151dfd5db9.jpg', NULL, 0),
(98, 34, 1, '97b086da9cf36f01571e5ef9d0df504f.jpg', NULL, 1),
(99, 34, 6, '160f4138db91faa08bab93cd2ddff245.jpg', NULL, 0),
(100, 34, 3, 'dec1d9a5ce76e1468aadd90925e6c52c.jpg', NULL, 0),
(101, 34, 9, 'fd03cddb45927c2794828ab63a3a627d.jpg', NULL, 0),
(102, 34, 2, '8a1d1ddbee1be8242bee5acee62c3cb8.jpg', NULL, 0),
(103, 34, 5, 'f6a5d8878b077afce5430e6e427cf997.jpg', NULL, 0),
(104, 34, 4, '990c31fd51b72d308f81da16a10c378c.jpg', NULL, 0),
(105, 34, 7, '41568417976f2a77087d0a57aff1dec0.jpg', NULL, 0),
(106, 35, NULL, 'ce9a30c00e6a19837bf1e74d66c7c45e.png', NULL, 1),
(107, 37, NULL, '681b711883fdeec248f55f2b9a29cce8.jpg', NULL, 1),
(108, 37, NULL, '9f01df005e65b04ef633673da96c03ef.jpg', NULL, 0),
(109, 37, NULL, '85b62fa983aef7a95fe033b7dd5e43aa.jpg', NULL, 0),
(110, 37, NULL, '8f8f57654262a80396cb4bf3fedafdbb.jpg', NULL, 0),
(111, 37, NULL, '2fa6c0f0ae5dbedbb4247caca445be4e.jpg', NULL, 0),
(112, 37, NULL, '65930734aa7e52309c718c88aa759f1d.jpg', NULL, 0),
(113, 37, NULL, '945aabda3a79a7e0161f0f1b5f168324.jpg', NULL, 0),
(114, 37, NULL, '106e938c3d81f53d56f0540fda6ffa0e.jpg', NULL, 0),
(115, 37, NULL, '5fe02bb5bf08eda0cf673296afbc71af.jpg', NULL, 0),
(116, 37, NULL, '9bf6dfdbf0f991b37c3896142e67ccc7.jpg', NULL, 0),
(117, 37, NULL, 'f949763e0c21bdf6fd2027161dd00c79.jpg', NULL, 0),
(118, 37, NULL, '4db398bd851eb9fb95989bcecf069af6.jpg', NULL, 0),
(119, 37, NULL, '2da70d22711e970c74518eb1b8fffcf7.jpg', NULL, 0),
(120, 37, NULL, '2c31b290df0e3da2159f48216decc337.jpg', NULL, 0),
(121, 37, NULL, '198a91106d3c5e5cbdaf8a01c69f6cf7.jpg', NULL, 0),
(122, 37, NULL, 'e1cb579b6216e7b0cac6c6fec86b8ad7.jpg', NULL, 0),
(123, 37, NULL, '630cdeccf83a98a415b6c02e0cb8c402.jpg', NULL, 0),
(124, 40, NULL, '681b711883fdeec248f55f2b9a29cce8.jpg', NULL, 1),
(125, 40, NULL, '9f01df005e65b04ef633673da96c03ef.jpg', NULL, 0),
(126, 40, NULL, '85b62fa983aef7a95fe033b7dd5e43aa.jpg', NULL, 0),
(127, 40, NULL, '8f8f57654262a80396cb4bf3fedafdbb.jpg', NULL, 0),
(128, 40, NULL, '2fa6c0f0ae5dbedbb4247caca445be4e.jpg', NULL, 0),
(129, 40, NULL, '65930734aa7e52309c718c88aa759f1d.jpg', NULL, 0),
(130, 40, NULL, '945aabda3a79a7e0161f0f1b5f168324.jpg', NULL, 0),
(131, 40, NULL, '106e938c3d81f53d56f0540fda6ffa0e.jpg', NULL, 0),
(132, 40, NULL, '5fe02bb5bf08eda0cf673296afbc71af.jpg', NULL, 0),
(133, 40, NULL, '9bf6dfdbf0f991b37c3896142e67ccc7.jpg', NULL, 0),
(134, 40, NULL, 'f949763e0c21bdf6fd2027161dd00c79.jpg', NULL, 0),
(135, 40, NULL, '4db398bd851eb9fb95989bcecf069af6.jpg', NULL, 0),
(136, 40, NULL, '2da70d22711e970c74518eb1b8fffcf7.jpg', NULL, 0),
(137, 40, NULL, '2c31b290df0e3da2159f48216decc337.jpg', NULL, 0),
(138, 40, NULL, '198a91106d3c5e5cbdaf8a01c69f6cf7.jpg', NULL, 0),
(139, 40, NULL, 'e1cb579b6216e7b0cac6c6fec86b8ad7.jpg', NULL, 0),
(140, 40, NULL, '630cdeccf83a98a415b6c02e0cb8c402.jpg', NULL, 0),
(158, 42, NULL, '681b711883fdeec248f55f2b9a29cce8.jpg', NULL, 1),
(159, 42, NULL, '9f01df005e65b04ef633673da96c03ef.jpg', NULL, 0),
(160, 42, NULL, '85b62fa983aef7a95fe033b7dd5e43aa.jpg', NULL, 0),
(161, 42, NULL, '8f8f57654262a80396cb4bf3fedafdbb.jpg', NULL, 0),
(162, 42, NULL, '2fa6c0f0ae5dbedbb4247caca445be4e.jpg', NULL, 0),
(163, 42, NULL, '65930734aa7e52309c718c88aa759f1d.jpg', NULL, 0),
(164, 42, NULL, '945aabda3a79a7e0161f0f1b5f168324.jpg', NULL, 0),
(165, 42, NULL, '106e938c3d81f53d56f0540fda6ffa0e.jpg', NULL, 0),
(166, 42, NULL, '5fe02bb5bf08eda0cf673296afbc71af.jpg', NULL, 0),
(167, 42, NULL, '9bf6dfdbf0f991b37c3896142e67ccc7.jpg', NULL, 0),
(168, 42, NULL, 'f949763e0c21bdf6fd2027161dd00c79.jpg', NULL, 0),
(169, 42, NULL, '4db398bd851eb9fb95989bcecf069af6.jpg', NULL, 0),
(170, 42, NULL, '2da70d22711e970c74518eb1b8fffcf7.jpg', NULL, 0),
(171, 42, NULL, '2c31b290df0e3da2159f48216decc337.jpg', NULL, 0),
(172, 42, NULL, '198a91106d3c5e5cbdaf8a01c69f6cf7.jpg', NULL, 0),
(173, 42, NULL, 'e1cb579b6216e7b0cac6c6fec86b8ad7.jpg', NULL, 0),
(174, 42, NULL, '630cdeccf83a98a415b6c02e0cb8c402.jpg', NULL, 0),
(181, 44, 1, '944b26984428e0f9d564b91daa193a08.jpg', NULL, 1),
(182, 44, 3, '9a01b50b4863dfbc67f5794e0e30a55b.jpg', NULL, 0),
(183, 44, 4, '065cc9fc08e4acf256f58055dff11c17.jpg', NULL, 0),
(184, 44, 6, '022c0e370c96dfecaacc548216e6816a.jpg', NULL, 0),
(185, 44, 5, '7cc549101ceaa8ab04c65c536e024c8e.jpg', NULL, 0),
(186, 44, 2, 'cf8012cf82b7c1789252d17f5f6e24f4.jpg', NULL, 0),
(190, 45, 2, 'b171af330e7aa67844b3551dfc6a40e8.jpg', NULL, 1),
(191, 45, 4, '77c09ac765d9629f55be6ee2869358d9.jpg', NULL, 0),
(193, 45, 5, '3bfbbb73efcc6fd71a8ec358b6b513db.jpg', NULL, 0),
(195, 45, 1, '1a1135ca27071e28457ff4ebdbd88ee0.jpg', NULL, 1),
(201, 45, 3, '2586102f7a174a7915b1f461eeb940f1.png', NULL, 0),
(202, 47, 2, '681b711883fdeec248f55f2b9a29cce8.jpg', NULL, 0),
(203, 47, 3, '9f01df005e65b04ef633673da96c03ef.jpg', NULL, 0),
(204, 47, 1, '85b62fa983aef7a95fe033b7dd5e43aa.jpg', NULL, 1),
(205, 47, 4, '8f8f57654262a80396cb4bf3fedafdbb.jpg', NULL, 0),
(206, 47, 5, '2fa6c0f0ae5dbedbb4247caca445be4e.jpg', NULL, 0),
(207, 47, 6, '65930734aa7e52309c718c88aa759f1d.jpg', NULL, 0),
(208, 47, 7, '945aabda3a79a7e0161f0f1b5f168324.jpg', NULL, 0),
(209, 47, 8, '106e938c3d81f53d56f0540fda6ffa0e.jpg', NULL, 0),
(210, 47, 9, '5fe02bb5bf08eda0cf673296afbc71af.jpg', NULL, 0),
(211, 47, 10, '9bf6dfdbf0f991b37c3896142e67ccc7.jpg', NULL, 0),
(212, 47, 11, 'f949763e0c21bdf6fd2027161dd00c79.jpg', NULL, 0),
(213, 47, 12, '4db398bd851eb9fb95989bcecf069af6.jpg', NULL, 0),
(214, 47, 14, '2da70d22711e970c74518eb1b8fffcf7.jpg', NULL, 0),
(215, 47, 13, '2c31b290df0e3da2159f48216decc337.jpg', NULL, 0),
(216, 47, 15, '198a91106d3c5e5cbdaf8a01c69f6cf7.jpg', NULL, 0),
(217, 47, 16, 'e1cb579b6216e7b0cac6c6fec86b8ad7.jpg', NULL, 0),
(218, 47, 17, '630cdeccf83a98a415b6c02e0cb8c402.jpg', NULL, 0),
(219, 50, 2, '681b711883fdeec248f55f2b9a29cce8.jpg', NULL, 0),
(220, 50, 3, '9f01df005e65b04ef633673da96c03ef.jpg', NULL, 0),
(221, 50, 1, '85b62fa983aef7a95fe033b7dd5e43aa.jpg', NULL, 1),
(222, 50, 4, '8f8f57654262a80396cb4bf3fedafdbb.jpg', NULL, 0),
(223, 50, 5, '2fa6c0f0ae5dbedbb4247caca445be4e.jpg', NULL, 0),
(224, 50, 6, '65930734aa7e52309c718c88aa759f1d.jpg', NULL, 0),
(225, 50, 7, '945aabda3a79a7e0161f0f1b5f168324.jpg', NULL, 0),
(226, 50, 8, '106e938c3d81f53d56f0540fda6ffa0e.jpg', NULL, 0),
(227, 50, 9, '5fe02bb5bf08eda0cf673296afbc71af.jpg', NULL, 0),
(228, 50, 10, '9bf6dfdbf0f991b37c3896142e67ccc7.jpg', NULL, 0),
(229, 50, 11, 'f949763e0c21bdf6fd2027161dd00c79.jpg', NULL, 0),
(230, 50, 12, '4db398bd851eb9fb95989bcecf069af6.jpg', NULL, 0),
(231, 50, 14, '2da70d22711e970c74518eb1b8fffcf7.jpg', NULL, 0),
(232, 50, 13, '2c31b290df0e3da2159f48216decc337.jpg', NULL, 0),
(233, 50, 15, '198a91106d3c5e5cbdaf8a01c69f6cf7.jpg', NULL, 0),
(234, 50, 16, 'e1cb579b6216e7b0cac6c6fec86b8ad7.jpg', NULL, 0),
(235, 50, 17, '630cdeccf83a98a415b6c02e0cb8c402.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_lazer`
--

CREATE TABLE `anuncios_lazer` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_lazer`
--

INSERT INTO `anuncios_lazer` (`id`, `ordem_exibicao`, `titulo`, `status`) VALUES
(1, 1, 'Salão de festas', 1),
(2, 2, 'Salão de jogos', 1),
(3, 3, 'Churrasqueira', 1),
(4, 4, 'Quintal', 1),
(5, 5, 'Jardim', 1),
(6, 6, 'Bicicletário', 1),
(7, 7, 'Wi-Fi', 1),
(8, 8, 'Academia', 1),
(9, 9, 'Elevador', 1),
(10, 10, 'Espaço gourmet', 1),
(11, 11, 'Piscina', 1),
(12, 12, 'Quadra', 1),
(13, 13, 'Playground', 1),
(14, 14, 'Cobertura coletiva', 1),
(15, 15, 'Restaurante', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_lazer_n_n`
--

CREATE TABLE `anuncios_lazer_n_n` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `lazer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_mobilias`
--

CREATE TABLE `anuncios_mobilias` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_mobilias`
--

INSERT INTO `anuncios_mobilias` (`id`, `ordem_exibicao`, `titulo`, `status`) VALUES
(1, 1, 'Armários na cozinha', 1),
(2, 2, 'Armários no quarto', 1),
(3, 3, 'Armários nos banheiros', 1),
(4, 4, 'Cama de casal', 1),
(5, 5, 'Cama de solteiro', 1),
(6, 6, 'Fogão', 1),
(7, 7, 'Fogão cooktop', 1),
(8, 8, 'Geladeira', 1),
(9, 9, 'Espelho no banheiro', 1),
(10, 10, 'Mesa e cadeiras', 1),
(11, 11, 'Sofá', 1),
(12, 12, 'Televisão', 1),
(13, 13, 'Utensílios de cozinha', 1),
(14, 14, 'Microondas', 1),
(15, 15, 'Máquina de lavar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_mobilias_n_n`
--

CREATE TABLE `anuncios_mobilias_n_n` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `mobilia_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_mobilias_n_n`
--

INSERT INTO `anuncios_mobilias_n_n` (`id`, `anuncio_id`, `mobilia_id`) VALUES
(195, 13, 1),
(196, 13, 2),
(197, 13, 3),
(198, 13, 4),
(199, 13, 5),
(200, 13, 6),
(201, 13, 7),
(202, 13, 8),
(203, 13, 9),
(204, 13, 10),
(205, 13, 11),
(206, 13, 12),
(207, 13, 13),
(208, 13, 14),
(209, 13, 15),
(240, 12, 1),
(241, 12, 2),
(242, 12, 3),
(243, 12, 4),
(244, 12, 5),
(245, 12, 6),
(246, 12, 7),
(247, 12, 8),
(248, 12, 9),
(249, 12, 10),
(250, 12, 11),
(251, 12, 12),
(252, 12, 13),
(253, 12, 14),
(254, 12, 15),
(255, 11, 1),
(256, 11, 2),
(257, 11, 3),
(258, 11, 4),
(259, 11, 5),
(260, 11, 6),
(261, 11, 7),
(262, 11, 8),
(263, 11, 9),
(264, 11, 10),
(265, 11, 11),
(266, 11, 12),
(267, 11, 13),
(268, 11, 14),
(269, 11, 15),
(270, 10, 1),
(271, 10, 2),
(272, 10, 3),
(273, 10, 4),
(274, 10, 5),
(275, 10, 6),
(276, 10, 7),
(277, 10, 8),
(278, 10, 9),
(279, 10, 10),
(280, 10, 11),
(281, 10, 12),
(282, 10, 13),
(283, 10, 14),
(284, 10, 15),
(285, 9, 1),
(286, 9, 2),
(287, 9, 3),
(288, 9, 4),
(289, 9, 5),
(290, 9, 6),
(291, 9, 7),
(292, 9, 8),
(293, 9, 9),
(294, 9, 10),
(295, 9, 11),
(296, 9, 12),
(297, 9, 13),
(298, 9, 14),
(299, 9, 15),
(300, 8, 1),
(301, 8, 2),
(302, 8, 3),
(303, 8, 4),
(304, 8, 5),
(305, 8, 6),
(306, 8, 7),
(307, 8, 8),
(308, 8, 9),
(309, 8, 10),
(310, 8, 11),
(311, 8, 12),
(312, 8, 13),
(313, 8, 14),
(314, 8, 15),
(345, 6, 1),
(346, 6, 2),
(347, 6, 3),
(348, 6, 4),
(349, 6, 5),
(350, 6, 6),
(351, 6, 7),
(352, 6, 8),
(353, 6, 9),
(354, 6, 10),
(355, 6, 11),
(356, 6, 12),
(357, 6, 13),
(358, 6, 14),
(359, 6, 15),
(360, 7, 1),
(361, 7, 2),
(362, 7, 3),
(363, 7, 4),
(364, 7, 5),
(365, 7, 6),
(366, 7, 7),
(367, 7, 8),
(368, 7, 9),
(369, 7, 10),
(370, 7, 11),
(371, 7, 12),
(372, 7, 13),
(373, 7, 14),
(374, 7, 15),
(375, 5, 1),
(376, 5, 2),
(377, 5, 3),
(378, 5, 4),
(379, 5, 5),
(380, 5, 6),
(381, 5, 7),
(382, 5, 8),
(383, 5, 9),
(384, 5, 10),
(385, 5, 11),
(386, 5, 12),
(387, 5, 13),
(388, 5, 14),
(389, 5, 15),
(590, 34, 2),
(591, 34, 4),
(592, 34, 7),
(593, 34, 8),
(594, 34, 11),
(595, 34, 12),
(596, 34, 14),
(597, 34, 15),
(598, 33, 2),
(599, 33, 4),
(600, 33, 7),
(601, 33, 8),
(602, 33, 11),
(603, 33, 12),
(604, 33, 14),
(605, 33, 15),
(617, 37, 1),
(618, 37, 2),
(619, 37, 4),
(620, 37, 5),
(621, 37, 6),
(622, 37, 11),
(623, 37, 12),
(636, 40, 1),
(637, 40, 2),
(638, 40, 4),
(639, 40, 5),
(640, 40, 6),
(641, 40, 11),
(642, 40, 12),
(650, 42, 1),
(651, 42, 2),
(652, 42, 4),
(653, 42, 5),
(654, 42, 6),
(655, 42, 11),
(656, 42, 12),
(687, 44, 1),
(688, 44, 2),
(689, 44, 3),
(690, 44, 4),
(691, 44, 5),
(692, 44, 6),
(693, 44, 7),
(694, 44, 8),
(695, 44, 9),
(696, 44, 10),
(697, 44, 11),
(698, 44, 12),
(699, 44, 13),
(700, 44, 14),
(701, 44, 15),
(709, 47, 1),
(710, 47, 2),
(711, 47, 4),
(712, 47, 5),
(713, 47, 6),
(714, 47, 11),
(715, 47, 12),
(716, 48, 2),
(717, 48, 6),
(718, 49, 2),
(719, 49, 6),
(720, 50, 1),
(721, 50, 2),
(722, 50, 4),
(723, 50, 5),
(724, 50, 6),
(725, 50, 11),
(726, 50, 12),
(727, 14, 1),
(728, 14, 2),
(729, 14, 3),
(730, 14, 4),
(731, 14, 5),
(732, 14, 6),
(733, 14, 7),
(734, 14, 8),
(735, 14, 9),
(736, 14, 10),
(737, 14, 11),
(738, 14, 12),
(739, 14, 13),
(740, 14, 14),
(741, 14, 15);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_pagamentos`
--

CREATE TABLE `anuncios_pagamentos` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `aluguel` double(10,2) DEFAULT NULL,
  `iptu` double(10,2) DEFAULT NULL,
  `taxa_adm` double(10,2) DEFAULT NULL,
  `taxa_ext` double(10,2) DEFAULT NULL,
  `total` double(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_pgto` datetime DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_pagamentos`
--

INSERT INTO `anuncios_pagamentos` (`id`, `anuncio_id`, `data`, `aluguel`, `iptu`, `taxa_adm`, `taxa_ext`, `total`, `status`, `data_pgto`, `data_cad`) VALUES
(1, 14, '2021-04-01', 1500.00, 30.00, 100.00, 50.00, 1380.00, 1, '2021-04-02 15:59:48', '2021-06-08 14:19:57'),
(2, 14, '2021-05-01', 1500.00, 30.00, 100.00, 50.00, 1380.00, 1, '2021-05-02 16:01:00', '2021-06-08 14:19:57'),
(3, 14, '2021-06-01', 1500.00, 30.00, 100.00, 50.00, 1380.00, 2, NULL, '2021-06-08 14:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_regioes`
--

CREATE TABLE `anuncios_regioes` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `url_amigavel` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_regioes`
--

INSERT INTO `anuncios_regioes` (`id`, `ordem_exibicao`, `foto`, `titulo`, `url_amigavel`, `status`) VALUES
(1, 1, '705d400281f035c16b0c00f98a2e0133.jpg', 'Zona Sul', 'zona-sul', 1),
(2, 2, 'f9e574c583287f2885c8c26f6c6e61db.jpg', 'Zona Norte', 'zona-norte', 1),
(3, 3, 'ceda1409b457cb11e86af0265968a415.jpg', 'Jacarepaguá', 'jacarepagua', 1),
(8, 4, '922b0b84882b9d2f01a21a0f35fcf722.jpg', 'Zona Oeste', 'zona-oeste', 1),
(9, 5, '5a5e7d3e19ef2d1b76abb5f170252f99.jpg', 'Baixada Fluminense', 'baixada-fluminense', 1),
(10, 6, '8a957ce75530b376264fae70736779d0.jpg', 'Niterói e Região', 'niteroi-e-regiao', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_seguranca`
--

CREATE TABLE `anuncios_seguranca` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_seguranca`
--

INSERT INTO `anuncios_seguranca` (`id`, `ordem_exibicao`, `titulo`, `status`) VALUES
(1, 1, 'Circuito de segurança', 1),
(2, 2, 'Condomínio fechado', 1),
(3, 3, 'Interfone', 1),
(4, 4, 'Segurança 24h', 1),
(5, 5, 'Fechadura eletrônica', 1),
(6, 6, 'Câmera de segurança', 1),
(7, 7, 'Vigia', 1),
(8, 8, 'Sistema de alarme', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_seguranca_n_n`
--

CREATE TABLE `anuncios_seguranca_n_n` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `seguranca_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_taxas`
--

CREATE TABLE `anuncios_taxas` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `titulo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `uf` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `itbi` float DEFAULT 0,
  `escritura` float DEFAULT 0,
  `registro` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `anuncios_taxas`
--

INSERT INTO `anuncios_taxas` (`id`, `estado_id`, `titulo`, `uf`, `itbi`, `escritura`, `registro`) VALUES
(1, 1, 'Acre', 'AC', 0, 0, 0),
(2, 2, 'Alagoas', 'AL', 0, 0, 0),
(3, 3, 'Amazonas', 'AM', 0, 0, 0),
(4, 4, 'Amapá', 'AP', 0, 0, 0),
(5, 5, 'Bahia', 'BA', 0, 0, 0),
(6, 6, 'Ceará', 'CE', 0, 0, 0),
(7, 7, 'Distrito Federal', 'DF', 0, 0, 0),
(8, 8, 'Espírito Santo', 'ES', 0, 0, 0),
(9, 9, 'Goiás', 'GO', 0, 0, 0),
(10, 10, 'Maranhão', 'MA', 0, 0, 0),
(11, 11, 'Minas Gerais', 'MG', 0, 0, 0),
(12, 12, 'Mato Grosso do Sul', 'MS', 0, 0, 0),
(13, 13, 'Mato Grosso', 'MT', 0, 0, 0),
(14, 14, 'Pará', 'PA', 0, 0, 0),
(15, 15, 'Paraíba', 'PB', 0, 0, 0),
(16, 16, 'Pernambuco', 'PE', 0, 0, 0),
(17, 17, 'Piauí', 'PI', 0, 0, 0),
(18, 18, 'Paraná', 'PR', 0, 0, 0),
(19, 19, 'Rio de Janeiro', 'RJ', 3, 1.06, 0.94),
(20, 20, 'Rio Grande do Norte', 'RN', 0, 0, 0),
(21, 21, 'Rondônia', 'RO', 0, 0, 0),
(22, 22, 'Roraima', 'RR', 0, 0, 0),
(23, 23, 'Rio Grande do Sul', 'RS', 0, 0, 0),
(24, 24, 'Santa Catarina', 'SC', 0, 0, 0),
(25, 25, 'Sergipe', 'SE', 0, 0, 0),
(26, 26, 'São Paulo', 'SP', 0, 0, 0),
(27, 27, 'Tocantins', 'TO', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_tipos`
--

CREATE TABLE `anuncios_tipos` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `url_amigavel` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `anuncios_tipos`
--

INSERT INTO `anuncios_tipos` (`id`, `ordem_exibicao`, `titulo`, `url_amigavel`, `status`) VALUES
(1, 1, 'Residencial', 'residencial', 1),
(2, 2, 'Comercial', 'comercial', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_tipos_itens`
--

CREATE TABLE `anuncios_tipos_itens` (
  `id` int(11) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `url_amigavel` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `anuncios_tipos_itens`
--

INSERT INTO `anuncios_tipos_itens` (`id`, `tipo_id`, `ordem_exibicao`, `titulo`, `url_amigavel`, `status`) VALUES
(1, 1, 1, 'Apartamento', 'apartamento', 1),
(2, 1, 2, 'Casa', 'casa', 1),
(3, 1, 3, 'Casa de condomínio', 'casa-de-condominio', 1),
(4, 1, 4, 'Cobertura', 'cobertura', 1),
(5, 1, 5, 'Flat/Kitnet', 'flatkitnet', 1),
(6, 1, 6, 'Lote/Terreno', 'loteterreno', 1),
(7, 1, 7, 'Fazenda/Sítios/Chácaras', 'fazendasitioschacaras', 1),
(8, 1, 8, 'Edifício Residencial', 'edificio-residencial', 1),
(9, 2, 1, 'Sala/Conjunto', 'salaconjunto', 1),
(10, 2, 2, 'Ponto Comercial/Loja/Box', 'ponto-comerciallojabox', 1),
(11, 2, 3, 'Imóvel Comercial', 'imovel-comercial', 1),
(13, 2, 4, 'Galpão/Depósito/Armazém', 'galpaodepositoarmazem', 1),
(14, 2, 5, 'Prédio/Edifício inteiro', 'predioedificio-inteiro', 1),
(15, 2, 6, 'Consultório', 'consultorio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anuncios_visitas`
--

CREATE TABLE `anuncios_visitas` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_corretor` int(11) DEFAULT NULL,
  `origem` varchar(100) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anuncios_visitas`
--

INSERT INTO `anuncios_visitas` (`id`, `anuncio_id`, `id_cliente`, `id_corretor`, `origem`, `tipo`, `nome`, `email`, `telefone`, `data`, `status`, `data_cad`) VALUES
(1, 34, NULL, 17, 'user', 'presencial', 'João da Silva', 'joao@email.com', '(11) 95910-0187', '2021-06-19 10:00:00', 2, '2021-06-14 19:47:11'),
(2, 34, NULL, 17, 'user', 'presencial', 'Felipe Silva', 'felipe@email.com', '(11) 95910-0189', '2021-06-17 10:00:00', 2, '2021-06-14 20:00:48'),
(3, 34, NULL, 15, 'user', 'presencial', 'Bruno Faria', 'brufaria25@gmail.com', '(55) 11975-3677', '2021-06-21 09:30:00', 2, '2021-06-14 20:07:49'),
(4, 34, NULL, 18, 'user', 'presencial', 'Marcia Campos ', 'marcia234@gmail.com', '(21) 98563-2147', '2021-06-17 11:30:00', 2, '2021-06-14 21:10:42'),
(5, 40, 5, NULL, 'user', 'presencial', 'Monique Alcantara', 'moniquealcantara8@gmail.com', '(21) 96523-6758', '2021-06-16 08:00:00', 1, '2021-06-14 21:10:44'),
(6, 42, NULL, 19, 'user', 'presencial', 'VANESSA Silva ', '', '', '2021-06-25 11:30:00', 1, '2021-06-16 13:30:57'),
(7, 34, NULL, 15, 'user', 'presencial', 'teste teste', 'contato@elloosdesign.com.br', '', '2021-07-10 10:00:00', 2, '2021-06-17 19:48:20'),
(8, 14, NULL, 15, 'user', 'video', 'Fulano de tal', 'fulano@email.com', '(11) 99539-8534', '2021-08-13 12:30:00', 2, '2021-08-03 01:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `bairros`
--

CREATE TABLE `bairros` (
  `id` int(11) NOT NULL,
  `cidade_id` int(11) DEFAULT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `url_amigavel` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `bairros`
--

INSERT INTO `bairros` (`id`, `cidade_id`, `ordem_exibicao`, `titulo`, `url_amigavel`, `status`) VALUES
(12, 5, NULL, 'Centro', 'centro', 1),
(13, 5, NULL, 'Jacarepaguá', 'jacarepagua', 1),
(14, 5, NULL, 'Ipanema', 'ipanema', 1),
(15, 5, NULL, 'Pavuna', 'pavuna', 1),
(16, 5, NULL, 'Copacabana', 'copacabana', 1),
(18, 5, NULL, 'Tijuca', 'tijuca', 1),
(19, 5, NULL, 'Grajaú', 'grajau', 1),
(20, 2, NULL, 'Centro', 'centro', 1),
(21, 3, NULL, 'Centro', 'centro', 1),
(22, 3, NULL, 'Largo do Barradas', 'largo-do-barradas', 1),
(23, 4, NULL, 'Centro', 'centro', 1),
(24, 5, NULL, 'Botafogo', 'botafogo', 1),
(25, 5, NULL, 'Catete', 'catete', 1),
(26, 5, NULL, 'Flamengo', 'flamengo', 1),
(27, 5, NULL, 'Gávea', 'gavea', 1),
(28, 5, NULL, 'Glória', 'gloria', 1),
(29, 5, NULL, 'Humaitá', 'humaita', 1),
(30, 5, NULL, 'Jardim Botânico', 'jardim-botanico', 1),
(31, 5, NULL, 'Lagoa', 'lagoa', 1),
(32, 5, NULL, 'Laranjeiras', 'laranjeiras', 1),
(33, 5, NULL, 'Leblon', 'leblon', 1),
(34, 5, NULL, 'Leme', 'leme', 1),
(35, 5, NULL, 'São Conrado', 'sao-conrado', 1),
(36, 5, NULL, 'Urca', 'urca', 1),
(37, 5, NULL, 'Vila Isabel', 'vila-isabel', 1),
(38, 5, NULL, 'Andaraí', 'andarai', 1),
(39, 5, NULL, 'Méier', 'meier', 1),
(40, 5, NULL, 'São Cristóvão', 'sao-cristovao', 1),
(41, 5, NULL, 'Barra da Tijuca', 'barra-da-tijuca', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blocos_home`
--

CREATE TABLE `blocos_home` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `icone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto` text COLLATE latin1_general_ci DEFAULT NULL,
  `url` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_link` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data_cad` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `blocos_home`
--

INSERT INTO `blocos_home` (`id`, `ordem_exibicao`, `foto`, `icone`, `titulo`, `texto`, `url`, `tipo_link`, `data_cad`, `status`) VALUES
(1, 1, 'f69c8c785256ec8637598697828379db.png', '', 'Escolha seu<br> imóvel', '<p>Escolha o im&oacute;vel que voc&ecirc; mais gostar, no seu bairro de interesse e no valor que deseja pagar. E visite apenas o que lhe interessa.</p>\r\n', '', '', '2021-01-21', 1),
(2, 2, '09168b23d3dde3d0879b134fde6ba93b.png', '', 'Solicite sua Avaliação de Crédito', '<p>&Eacute; R&aacute;pida, Gratuita e sem Burocracia. Seja para Comprar ou Alugar, estamos prontos para lhe ajudar.<br />\r\n<a href=\"enviar-documentos\">Enviar Documentos</a></p>\r\n', '', '', '2021-01-21', 1),
(3, 3, '5e8d68caa85c5e66c1dba6fc9aa9c086.png', '', 'Avaliação Concluída', '<p>Nesta etapa sua avalia&ccedil;&atilde;o &eacute; conclu&iacute;da e voc&ecirc; tem acesso a todos os custos atrav&eacute;s da nossa equipe. Com transpar&ecirc;ncia e sem letras pequenas.</p>\r\n', '', '', '2021-01-21', 1),
(4, 4, '144a11337b6abca6626aab84b52bcb17.png', '', 'Tudo<br> Pronto!', '<p>Essa &eacute; a melhor parte! Com tudo conclu&iacute;do, agora &eacute; s&oacute; planejar a decora&ccedil;&atilde;o do seu novo lar e curtir essa nova etapa.</p>\r\n', '', '', '2021-01-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categorias`
--

CREATE TABLE `blog_categorias` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `url_amigavel` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto` text COLLATE latin1_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `url_amigavel` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `destaque` int(11) DEFAULT NULL,
  `comentarios` int(11) DEFAULT NULL,
  `autor` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  `data_exibe` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `keywords` text COLLATE latin1_general_ci DEFAULT NULL,
  `description` text COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `titulo`, `texto`, `foto`, `views`, `url_amigavel`, `destaque`, `comentarios`, `autor`, `data_cad`, `data_exibe`, `status`, `keywords`, `description`) VALUES
(1, 'Saiba como escolher o imóvel certo', '<p>Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut libero malesuada feugiat. Nulla quis lorem ut libero malesuada feugiat. Curabitur aliquet quam id dui posuere blandit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>\r\n\r\n<p>Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut libero malesuada feugiat. Nulla quis lorem ut libero malesuada feugiat. Curabitur aliquet quam id dui posuere blandit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>\r\n\r\n<p>Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut libero malesuada feugiat. Nulla quis lorem ut libero malesuada feugiat. Curabitur aliquet quam id dui posuere blandit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>\r\n', '1acf75d360bc7e09da37346b7bbd7e9a.jpg', 39, 'saiba-como-escolher-o-imovel-certo', 0, 1, 'Impera Real', '2021-02-03 18:33:45', '2021-02-03', 1, NULL, ''),
(2, 'É Melhor Alugar ou Financiar? ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porttitor accumsan tincidunt. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porttitor accumsan tincidunt. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porttitor accumsan tincidunt. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>\r\n', 'd8aa66a7f59bf68161ccbdea80f493fd.jpg', 7, 'e-melhor-alugar-ou-financiar', 0, 1, 'Impera Real', '2021-02-03 18:34:47', '2021-02-03', 1, NULL, ''),
(3, '10 dicas de decoração para valorizar seu imóvel ', '<p>Sed porttitor lectus nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur aliquet quam id dui posuere blandit.</p>\r\n\r\n<p>Sed porttitor lectus nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur aliquet quam id dui posuere blandit.</p>\r\n\r\n<p>Sed porttitor lectus nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur aliquet quam id dui posuere blandit.</p>\r\n', 'bfa3e37c5bd47585092438203ae98d21.jpg', 3, '10-dicas-de-decoracao-para-valorizar-seu-imovel', 0, 1, 'Impera Real', '2021-02-03 18:35:47', '2021-02-03', 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts_categorias`
--

CREATE TABLE `blog_posts_categorias` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts_comentarios`
--

CREATE TABLE `blog_posts_comentarios` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `comentario` text COLLATE latin1_general_ci DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `blog_posts_comentarios`
--

INSERT INTO `blog_posts_comentarios` (`id`, `post_id`, `nome`, `email`, `comentario`, `data_cad`, `status`) VALUES
(1, 3, 'Monique', 'moniquealcantara8@gmail.com', 'Gostei!', '2021-05-18 14:04:13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `buscas`
--

CREATE TABLE `buscas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(500) DEFAULT NULL,
  `chegada` date DEFAULT NULL,
  `saida` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `buscas_anuncios`
--

CREATE TABLE `buscas_anuncios` (
  `id` int(11) NOT NULL,
  `busca_id` int(11) DEFAULT NULL,
  `anuncio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `estado_id` int(5) NOT NULL,
  `titulo` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `url_amigavel` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cidades`
--

INSERT INTO `cidades` (`id`, `estado_id`, `titulo`, `url_amigavel`, `status`) VALUES
(2, 19, 'Duque de Caxias', 'duque-de-caxias', 1),
(3, 19, 'Niterói', 'niteroi', 1),
(4, 19, 'Nova Iguaçu', 'nova-iguacu', 1),
(5, 19, 'Rio de Janeiro', 'rio-de-janeiro', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `senha` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `cep` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `logradouro` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `numero` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `chave` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cad_compl` int(11) DEFAULT 0,
  `dta_cad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `foto`, `nome`, `cpf`, `telefone`, `email`, `senha`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `chave`, `facebook_id`, `status`, `cad_compl`, `dta_cad`) VALUES
(1, '83a79b581cfb0d1f7ee175c5ccd12d83.png', 'Felipe Silva', '881.998.127-02', '(11) 95910-0183', 'felipeacelino@hotmail.com', '$2y$07$GXCefOBdliMiZmfgnRyzdOmVUhEnypGGWPsVX5pB7OZ1LjMPiX39.', '07143-650', 'Avenida Três Corações', '150', '', 'Jardim Paraíso', 'Guarulhos', 'SP', 'a922fd17529163b0b8825f475cbf895a', NULL, 1, 1, '2021-05-21 18:11:17'),
(2, NULL, 'Monique Alcantara', NULL, '(21) 96523-6758', 'moniquemarques.corretora@gmail.com', '$2y$07$2DEE6xMNWrRE.9GNhhj6r.jXtgQFsGN5BvkwluM1CF.QSr.knQ1FS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '206f70a74bdfd0305ec395090c84bbf3', NULL, 1, 0, '2021-05-21 20:52:31'),
(3, NULL, 'Adriano Tavares', NULL, '(21) 98297-4923', 'tavares.imperareal@gmail.com', '$2y$07$aH6vSYNcEynUe9vJ5BNqleHtD8myr/KExyzyYeKYr69TADj2hxQCe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '631d44c51f4f9297e02079e539775ae3', NULL, 1, 0, '2021-05-21 21:20:39'),
(4, NULL, 'Adriano Tavares', NULL, '(21) 98297-4923', 'moniquealcantara.imperareal@gmail.com', '$2y$07$xDRzosqtsBCDmrxGRaAnbO/vF.84K9KbcBfZptnszrpVhMg1JmGzK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40f4ba22b0b9d0bc8b9e0ca0890c6828', NULL, 1, 0, '2021-06-07 11:10:44'),
(5, NULL, 'Monique Alcantara', NULL, '(21) 96523-6758', 'moniquealcantara8@gmail.com', '$2y$07$ChrjzahmzBtBsxDE6WCLGOaVQRlamv7F/Ldu4YbHTa/tCRK3/adBe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45027f095f35f9ccebc8dbc95e8da8e5', NULL, 1, 0, '2021-06-14 21:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `clientes_arquivos`
--

CREATE TABLE `clientes_arquivos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `imovel_cod` varchar(255) DEFAULT NULL,
  `origem` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `titulo` varchar(500) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `url_amigavel` varchar(500) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `date_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientes_arquivos`
--

INSERT INTO `clientes_arquivos` (`id`, `id_usuario`, `imovel_cod`, `origem`, `tipo`, `titulo`, `arquivo`, `url_amigavel`, `status`, `date_time`) VALUES
(4, 0, NULL, 'recebidos_admin', NULL, 'CPF', '719e08bcdf76ee0d78c087f1d3ffd395.png', 'cpf', 1, '2021-06-07'),
(6, 1, '123', 'recebidos_admin', 1, '', '8b0698bd6ecc54a7b113cbafe850b0d1.pdf', '', 1, '2021-06-10'),
(7, 1, '123', 'recebidos_admin', 9, 'Documento teste', '60295208f61151116632258666879231.pdf', 'documento-teste', 1, '2021-06-10'),
(8, 3, '456', 'recebidos_admin', 2, '', 'b0fc503be938eb5836f0f6ce9265b88f.jpg', '', 1, '2021-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `clientes_mensagens`
--

CREATE TABLE `clientes_mensagens` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `remetente` varchar(255) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `lida` int(1) DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientes_mensagens`
--

INSERT INTO `clientes_mensagens` (`id`, `id_usuario`, `remetente`, `mensagem`, `arquivo`, `lida`, `data`) VALUES
(1, 1, 'usuario', 'test', NULL, 0, '2021-05-21 19:03:30'),
(2, 3, 'usuario', '', 'e6f9658001b3cedfcd463e26b1046b29.png', 0, '2021-06-14 21:06:00'),
(3, 3, 'usuario', 'Olá', NULL, 0, '2021-06-14 21:06:10'),
(4, 3, 'usuario', '', '37d043297fa806cb1c3a3209442f4495.jpeg', 0, '2021-06-17 17:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `comodos`
--

CREATE TABLE `comodos` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) DEFAULT NULL,
  `caracteristica_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `corretores_arquivos`
--

CREATE TABLE `corretores_arquivos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `imovel_cod` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `origem` varchar(255) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `titulo` varchar(500) DEFAULT NULL,
  `url_amigavel` varchar(500) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `date_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `corretores_arquivos`
--

INSERT INTO `corretores_arquivos` (`id`, `id_usuario`, `id_cliente`, `imovel_cod`, `tipo`, `origem`, `arquivo`, `titulo`, `url_amigavel`, `status`, `date_time`) VALUES
(1, 1, NULL, '', 9, 'recebidos_admin', '2aca41e62f73fa4ad78a44a046977c05.png', 'teste', 'teste', 1, '2021-06-11'),
(2, 15, NULL, '', 1, 'recebidos_admin', 'a9b62714d1417d879f3acd2ee3b8e695.svg', '', '', 1, '2021-06-12'),
(3, 18, NULL, '', 1, 'recebidos_admin', '1d18a12360cae7ace41235a64c328fd6.jpg', '', '', 1, '2021-06-14'),
(4, 15, 2, '', 1, 'recebidos_admin', 'fc8bf504a821ddbba86bf23e58b974ee.jpg', '', '', 1, '2021-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `corretores_clientes`
--

CREATE TABLE `corretores_clientes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `corretores_clientes`
--

INSERT INTO `corretores_clientes` (`id`, `id_usuario`, `nome`, `email`, `telefone`, `data_cad`) VALUES
(2, 15, 'Fulano de Tal', 'teste@teste.com', '(11) 23123-8127', '2021-08-06 04:31:41'),
(3, 15, 'fsdfsdfsd', 'teste@teste.com', '', '2021-08-06 04:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `corretores_leads`
--

CREATE TABLE `corretores_leads` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `renda` varchar(255) DEFAULT NULL,
  `fgts` varchar(255) DEFAULT NULL,
  `possui_dependente` int(1) DEFAULT NULL,
  `agendado` int(1) DEFAULT NULL,
  `motivo_negativa` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `corretores_leads`
--

INSERT INTO `corretores_leads` (`id`, `id_usuario`, `nome`, `email`, `telefone`, `feedback`, `renda`, `fgts`, `possui_dependente`, `agendado`, `motivo_negativa`, `status`, `data_cad`) VALUES
(1, 1, 'João da Silva', 'joao@email.com', '(11) 11111-1111', '', '', '', 0, NULL, '', 2, '2021-08-06 06:06:02'),
(2, 1, 'Maria da Silva', 'maria@email.com', '(11) 11111-1111', '', '', '', 0, NULL, '', 2, '2021-08-06 06:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `corretores_mensagens`
--

CREATE TABLE `corretores_mensagens` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `remetente` varchar(255) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `lida` int(1) DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `corretores_mensagens`
--

INSERT INTO `corretores_mensagens` (`id`, `id_usuario`, `remetente`, `mensagem`, `arquivo`, `lida`, `data`) VALUES
(1, 1, 'usuario', 'teste', NULL, 0, '2021-06-11 17:10:51'),
(2, 15, 'usuario', 'teste', NULL, 0, '2021-06-12 12:49:41'),
(3, 15, 'usuario', 'fsdf sdfsdfs', NULL, 0, '2021-06-12 12:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `corretores_regioes_atuacao`
--

CREATE TABLE `corretores_regioes_atuacao` (
  `id` int(11) NOT NULL,
  `corretor_id` int(11) DEFAULT NULL,
  `regiao_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `corretores_regioes_atuacao`
--

INSERT INTO `corretores_regioes_atuacao` (`id`, `corretor_id`, `regiao_id`) VALUES
(15, 15, 5),
(16, 15, 6),
(25, 20, 1),
(26, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `enderecos_bloqueados`
--

CREATE TABLE `enderecos_bloqueados` (
  `id` int(11) NOT NULL,
  `bairro_id` int(11) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `data_cad` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `uf` varchar(10) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id`, `titulo`, `uf`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amazonas', 'AM'),
(4, 'Amapá', 'AP'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Minas Gerais', 'MG'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Mato Grosso', 'MT'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Pernambuco', 'PE'),
(17, 'Piauí', 'PI'),
(18, 'Paraná', 'PR'),
(19, 'Rio de Janeiro', 'RJ'),
(20, 'Rio Grande do Norte', 'RN'),
(21, 'Rondônia', 'RO'),
(22, 'Roraima', 'RR'),
(23, 'Rio Grande do Sul', 'RS'),
(24, 'Santa Catarina', 'SC'),
(25, 'Sergipe', 'SE'),
(26, 'São Paulo', 'SP'),
(27, 'Tocantins', 'TO');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto` text COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `ordem_exibicao`, `titulo`, `texto`, `status`) VALUES
(1, 1, 'Pergunta 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada. Nulla porttitor <a href=\"http://google.com\">accumsan</a> tincidunt. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat.</p>\r\n', 1),
(2, 2, 'Pergunta 2', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat.</p>\r\n', 1),
(3, 3, 'Pergunta 3', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat.</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loja_conf`
--

CREATE TABLE `loja_conf` (
  `id` int(11) NOT NULL,
  `titulo_loja` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_atendimento` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_formulario` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_agendamentos` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_propostas` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_docs_clientes` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_docs_proprietarios` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_docs_corretores` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `telefones` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `horario_funcionamento` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL,
  `endereco` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL,
  `mapa` text COLLATE latin1_general_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `skype` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `facebook` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `twitter` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `instagram` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `linkedin` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `youtube` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `taxa` float DEFAULT NULL,
  `taxa_exclusivos` float DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `loja_conf`
--

INSERT INTO `loja_conf` (`id`, `titulo_loja`, `email_atendimento`, `email_formulario`, `email_agendamentos`, `email_propostas`, `email_docs_clientes`, `email_docs_proprietarios`, `email_docs_corretores`, `telefones`, `horario_funcionamento`, `endereco`, `mapa`, `whatsapp`, `skype`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `taxa`, `taxa_exclusivos`, `status`) VALUES
(1, 'Impera Real - Imóveis à venda e para alugar no Rio de Janeiro', 'contato@imperareal.com.br', 'felipeacelino@hotmail.com', 'felipeacelino@hotmail.com', 'felipeacelino@hotmail.com', 'felipeacelino@hotmail.com', 'felipeacelino@hotmail.com', 'felipeacelino@hotmail.com', '(21) 3593-1813', '', '', '', '(21) 96530-7325', '', 'https://www.facebook.com/Imobiliaria.Imperareal/', '', 'https://www.instagram.com/imperareal.imobiliaria/', 'https://www.linkedin.com', 'https://www.youtube.com/', 8.5, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loja_logo`
--

CREATE TABLE `loja_logo` (
  `id` int(11) NOT NULL,
  `local` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `data_cad` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `loja_logo`
--

INSERT INTO `loja_logo` (`id`, `local`, `logo`, `titulo`, `status`, `data_cad`) VALUES
(1, 'principal', 'f1ce1cad86bd0ccd3a9ed9120719dbdd.png', 'Logo', 1, '2021-01-19'),
(2, 'footer', '80cef530669064d831c885c37aed9577.png', 'Branco', 1, '2021-01-19'),
(3, 'email', '2c02301c118b9d1155438a7fc1fd42e7.png', 'E-mail', 1, '2021-01-19'),
(4, 'icon_admin', 'e00203f4f07201fa026eebc1913d90cf.png', 'Admin', 1, '2021-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `data_cad` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paginas`
--

CREATE TABLE `paginas` (
  `id` int(11) NOT NULL,
  `pagina` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo_pag` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `banner_login` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto` text CHARACTER SET utf8 DEFAULT NULL,
  `foto2` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo2` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `subtitulo2` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto2` text CHARACTER SET utf8 DEFAULT NULL,
  `foto3` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo3` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `subtitulo3` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto3` text COLLATE latin1_general_ci DEFAULT NULL,
  `foto4` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo4` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `subtitulo4` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto4` text COLLATE latin1_general_ci DEFAULT NULL,
  `foto5` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo5` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `subtitulo5` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto5` text COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `paginas`
--

INSERT INTO `paginas` (`id`, `pagina`, `titulo_pag`, `foto`, `banner`, `banner_login`, `titulo`, `subtitulo`, `texto`, `foto2`, `titulo2`, `subtitulo2`, `texto2`, `foto3`, `titulo3`, `subtitulo3`, `texto3`, `foto4`, `titulo4`, `subtitulo4`, `texto4`, `foto5`, `titulo5`, `subtitulo5`, `texto5`) VALUES
(1, 'sobre', 'Quem Somos', '81c20310a7858eb8055512e0af8e60f0.jpg', 'c96bc8906c9fa0934b4bd9fe6282542f.jpg', NULL, 'O Futuro do Mercado Imobiliário Digital', 'Impera Real', '<p>Acreditamos que o futuro j&aacute; chegou, e por isso decidimos ser uma empresa multifuncional &nbsp;no segmento imobili&aacute;rio.&nbsp;</p>\r\n\r\n<p>A Impera Real &eacute; uma imobili&aacute;ria digital voltada para o mercado de venda, compra e loca&ccedil;&atilde;o de im&oacute;veis. Nascemos no ano de 2018 trazendo um processo mais tecnol&oacute;gico que reduziu a papelada e tornou as transa&ccedil;&otilde;es imobili&aacute;rias menos burocr&aacute;ticas, com isso deixamos as negocia&ccedil;&otilde;es mais r&aacute;pidas e eficientes. Atrav&eacute;s deste objetivo, fizemos com que nossos clientes tivessem mais liberdade e agilidade para concluir suas negocia&ccedil;&otilde;es de qualquer lugar, usando apenas um celular.</p>\r\n\r\n<p>Desenvolvemos uma nova plataforma com o objetivo de melhorar ainda mais a sua experi&ecirc;ncia na compra, venda e loca&ccedil;&atilde;o do im&oacute;vel. Estamos em constante crescimento no mercado digital, sempre trazendo novas ideias para proporcionar cada vez mais agilidade, transpar&ecirc;ncia e seguran&ccedil;a nas transa&ccedil;&otilde;es imobili&aacute;rias.&nbsp;</p>\r\n\r\n<p>Somos profissionais engajados no mercado e estamos sempre de olho na tecnologia para trazer novidades que facilitem o seu dia a dia de forma simples e agrad&aacute;vel.</p>\r\n', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(2, 'termos-de-uso', 'Termos de Uso', 'afae05344a4454881a52d7efb49a63eb.jpg', '369a03eb5ae95df3e96bd21d31cfc07a.jpg', NULL, 'Termos de Uso', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat.</p>\r\n', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(3, 'contato', 'Contato', NULL, 'd5e42d77437664a83308b75fd20d110e.jpg', NULL, 'Contato', '', '<p>Preencha seus dados no formul&aacute;rio abaixo que te responderemos&nbsp;o mais r&aacute;pido poss&iacute;vel!</p>\r\n', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(4, 'politica-de-privacidade', 'Política de Privacidade', 'afae05344a4454881a52d7efb49a63eb.jpg', '369a03eb5ae95df3e96bd21d31cfc07a.jpg', NULL, 'Política de Privacidade', '', '<p>N&oacute;s usamos cookies para melhorar sua experi&ecirc;ncia de navega&ccedil;&atilde;o no portal. Ao utilizar o <strong>imperareal.com.br</strong>, voc&ecirc; concorda com a pol&iacute;tica de monitoramento de cookies. Para ter mais informa&ccedil;&otilde;es sobre como isso &eacute; feito, acesse Pol&iacute;tica de cookies. Se voc&ecirc; concorda, clique em ACEITO.</p>\r\n\r\n<p><strong>O que s&atilde;o cookies?</strong><br />\r\nCookies s&atilde;o arquivos salvos em seu computador, tablet ou telefone quando voc&ecirc; visita um site.Usamos os cookies necess&aacute;rios para fazer o site funcionar da melhor forma poss&iacute;vel e sempre aprimorar os nossos servi&ccedil;os.<br />\r\nAlguns cookies s&atilde;o classificados como necess&aacute;rios e permitem a funcionalidade central, como seguran&ccedil;a, gerenciamento de rede e acessibilidade. Estes cookies podem ser coletados e armazenados assim que voc&ecirc; inicia sua navega&ccedil;&atilde;o ou quando usa algum recurso que os requer.</p>\r\n\r\n<p><strong>Cookies Prim&aacute;rios</strong><br />\r\nAlguns cookies ser&atilde;o colocados em seu dispositivo diretamente pelo nosso site - s&atilde;o conhecidos como cookies prim&aacute;rios. Eles s&atilde;o essenciais para voc&ecirc; navegar no site e usar seus recursos.</p>\r\n\r\n<p><strong>Tempor&aacute;rios</strong><br />\r\nN&oacute;s utilizamos cookies de sess&atilde;o. Eles s&atilde;o tempor&aacute;rios e expiram quando voc&ecirc; fecha o navegador ou quando a sess&atilde;o termina.</p>\r\n\r\n<p><strong>Finalidade</strong><br />\r\nEstabelecer controle de idioma e seguran&ccedil;a ao tempo da sess&atilde;o.</p>\r\n\r\n<p><strong>Persistentes</strong><br />\r\nUtilizamos tamb&eacute;m cookies persistentes que permanecem em seu disco r&iacute;gido at&eacute; que voc&ecirc; os apague ou seu navegador o fa&ccedil;a, dependendo da data de expira&ccedil;&atilde;o do cookie. Todos os cookies persistentes t&ecirc;m uma data de expira&ccedil;&atilde;o gravada em seu c&oacute;digo, mas sua dura&ccedil;&atilde;o pode variar.</p>\r\n\r\n<p><strong>Finalidade</strong><br />\r\nColetam e armazenam a ci&ecirc;ncia sobre o uso de cookies no site.</p>\r\n\r\n<p><strong>Cookies de Terceiros</strong><br />\r\nOutros cookies s&atilde;o colocados no seu dispositivo n&atilde;o pelo site que voc&ecirc; est&aacute; visitando, mas por terceiros, como, por exemplo, os sistemas anal&iacute;ticos.</p>\r\n\r\n<p><strong>Tempor&aacute;rios</strong><br />\r\nN&oacute;s utilizamos cookies de sess&atilde;o. Eles s&atilde;o tempor&aacute;rios e expiram quando voc&ecirc; fecha o navegador ou quando a sess&atilde;o termina.</p>\r\n\r\n<p><strong>Finalidade</strong><br />\r\nColetam informa&ccedil;&otilde;es sobre como voc&ecirc; usa o site, como as p&aacute;ginas que voc&ecirc; visitou e os links em que clicou. Nenhuma dessas informa&ccedil;&otilde;es pode ser usada para identific&aacute;-lo. Seu &uacute;nico objetivo &eacute; possibilitar an&aacute;lises e melhorar as fun&ccedil;&otilde;es do site.</p>\r\n\r\n<p><strong>Persistentes</strong><br />\r\nUtilizamos tamb&eacute;m cookies persistentes que permanecem em seu disco r&iacute;gido at&eacute; que voc&ecirc; os apague ou seu navegador o fa&ccedil;a, dependendo da data de expira&ccedil;&atilde;o do cookie. Todos os cookies persistentes t&ecirc;m uma data de expira&ccedil;&atilde;o gravada em seu c&oacute;digo, mas sua dura&ccedil;&atilde;o pode variar.</p>\r\n\r\n<p><strong>Finalidade</strong><br />\r\nColetam informa&ccedil;&otilde;es sobre como voc&ecirc; usa o site, como as p&aacute;ginas que voc&ecirc; visitou e os links em que clicou. Nenhuma dessas informa&ccedil;&otilde;es pode ser usada para identific&aacute;-lo. Seu &uacute;nico objetivo &eacute; possibilitar an&aacute;lises e melhorar as fun&ccedil;&otilde;es do site.</p>\r\n\r\n<p>Voc&ecirc; pode desabilit&aacute;-los alterando as configura&ccedil;&otilde;es do seu navegador, mas saiba que isso pode afetar o funcionamento do site.</p>\r\n\r\n<ul>\r\n	<li>Chrome</li>\r\n	<li>Firefox</li>\r\n	<li>Microsoft Edge</li>\r\n	<li>Internet Explorer</li>\r\n</ul>\r\n', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(5, 'busca', NULL, NULL, NULL, NULL, 'Encontre o Imóvel Ideal', 'Os melhores imóveis perto de você', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'para-voce-corretor', 'Para você corretor', '60d5c6cbd87af9b50f41d82828fa1986.png', '9fc21bfeeb9a5885a3c855bf7c07e2fa.png', 'a1780af302487a1212b8411b2bc10ec4.jpg', 'Para você Corretor!', 'Tenha acesso a uma variedade de imóveis e<br> multiplique seus negócios', '<p>Realize seu cadastro e ofere&ccedil;a excelentes im&oacute;veis ao seus clientes.</p>\r\n', NULL, 'Vantagens em ser corretor parceiro da Impera Real', '', '', NULL, 'Veja as oportunidades para cada área<br> do corretor de imóveis', 'Nossa plataforma foi pensada e criada estrategicamente para ajudar<br> a facilitar o dia a dia do corretor de imóveis, pois assim<br> valorizamos seu tempo, dedicação e esforço.', '', 'd0100b7fcd1a42641c68275daa0fc89e.png', 'Temos recursos essenciais para<br> você fazer negócios bem<br> sucedidos!', 'Alcance seu público-alvo através da nossa plataforma<br> digital e assuma o controle do seu tempo.', '', NULL, '', '', ''),
(7, 'para-voce-proprietario', 'Para você proprietário', NULL, 'a37f596164cd63850344c31c3f22e25d.jpg', '355f467b3a34b833cf26bad021a8252e.jpg', 'Facilite a sua vida vendendo<br> ou alugando seu imóvel<br> com a Impera Real', 'Deixa que a gente encontre o cliente<br> ideal para o seu imóvel!', '', NULL, 'Recursos essenciais para uma Venda<br> e Locação bem sucedida', '', '', NULL, 'Entenda os valores cobrados para<br> Vender ou Alugar seu imóvel', 'Você não paga nada antes de vendermos ou alugarmos o seu imóvel.', '<ul class=\"row blocos-faq\" data-aos=\"fade-up\">\r\n	<li class=\"grid-6 grid-m-12 grid-s-12 bloco-faq\">\r\n	<div>\r\n	<div class=\"bloco-faq-tit\">\r\n	<h2>Comiss&atilde;o por Venda</h2>\r\n	</div>\r\n\r\n	<div class=\"texto\"><b>Comiss&atilde;o da Impera Real para vendas:</b> Cobramos 5% do valor total do im&oacute;vel somente quando a venda for concretizada atrav&eacute;s da nossa plataforma.&nbsp;</div>\r\n	</div>\r\n	</li>\r\n	<li class=\"grid-6 grid-m-12 grid-s-12 bloco-faq\">\r\n	<div>\r\n	<div class=\"bloco-faq-tit\">\r\n	<h2>Comiss&atilde;o por loca&ccedil;&atilde;o</h2>\r\n	</div>\r\n\r\n	<div class=\"texto\"><b>Comiss&atilde;o da Impera Real:</b> Equivale ao valor integral do primeiro m&ecirc;s de aluguel.<br />\r\n	<br />\r\n	<b>Taxa para administra&ccedil;&atilde;o mensal:</b> 8% sobre o valor da loca&ccedil;&atilde;o para im&oacute;veis com exclusividade e 8,5% para im&oacute;veis sem exclusividade.</div>\r\n	</div>\r\n	</li>\r\n</ul>\r\n', '996154926ab054a1b320af9af79af5d8.png', 'Como faço para anunciar o meu imóvel?', '', '<ul class=\"list-steps\">\r\n	<li><span>1</span> Voc&ecirc; cria uma conta em nossa plataforma.</li>\r\n	<li><span>2</span> Cadastra o seu im&oacute;vel.</li>\r\n	<li><span>3</span> N&oacute;s melhoramos o seu an&uacute;ncio com profissionais de marketing de conte&uacute;do.</li>\r\n	<li><span>4</span> Seu im&oacute;vel &eacute; divulgado na plataforma e j&aacute; come&ccedil;a a receber visitas e propostas.</li>\r\n</ul>\r\n\r\n<p><br />\r\n<a class=\"btn btn-primario\" href=\"proprietario/criar-conta\">Cadastre-se Agora</a></p>\r\n\r\n<p><b>Melhore a divulga&ccedil;&atilde;o do seu im&oacute;vel com nossas dicas:</b><br />\r\n<a href=\"blog\">10 dicas para fotografar e turbinar o seu an&uacute;ncio</a></p>\r\n', 'e338984d8dc19c43641befd25c728dd5.png', 'Temos recursos essenciais para<br> você fazer negócios bem<br> sucedidos!', 'Alcance seu público-alvo através da nossa plataforma<br> digital e assuma o controle do seu tempo.', ''),
(8, 'para-voce-afiliado', 'Seja um afiliado', '6fcbaec56d02b287e7d0b186c633fcc6.jpg', '8093bb4cc9cf378da7a434fdc1758201.jpg', '0cc2b63d284048140a6a74de05a0c92b.jpg', 'Indique e Ganhe!', 'Faça disso um negócio e aumente a sua renda através das suas redes sociais.', '', NULL, 'Ganhe dinheiro com o programa<br> de Afiliados Impera Real', 'Junte-se ao nosso programa de Afiliados e faça quantas indicações quiser.', '<h2 style=\"text-align: center;\">Ferramenta do Afiliado</h2>\r\n\r\n<ul class=\"list-bl-steps\">\r\n	<li>Oferecemos um link de divulga&ccedil;&atilde;o exclusivo que voc&ecirc; obt&eacute;m ao se cadastrar.</li>\r\n	<li>Atrav&eacute;s do link de afiliado podemos rastrear quantos im&oacute;veis e/ou clientes voc&ecirc; indicou.</li>\r\n	<li>Dessa forma a sua comiss&atilde;o &eacute; garantida quando a negocia&ccedil;&atilde;o for finalizada.&nbsp;</li>\r\n</ul>\r\n\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n\r\n<p style=\"text-align: center;\">Siga&nbsp;<strong>3 passos</strong> simples para come&ccedil;ar a ganhar dinheiro com a <strong>Impera Real</strong>.</p>\r\n', NULL, 'Benefícios de ser um Afiliado Impera Real', 'Se você quiser indicar seus clientes, amigos, familiares e colegas de trabalho,<br> você pode ganhar uma comissão recorrente.', '', '5c59cbe1c5d1142876ff55899ee6b831.png', 'Use o programa Afiliados Impera Real e indique o quanto você quiser!', 'Junte-se ao programa e veja como é fácil ganhar dinheiro indicando.', '', NULL, '', '', ''),
(9, 'ajuda', '', NULL, '200fd7186016e386c51d14987a6ad931.jpg', NULL, 'Precisa de ajuda?', '', '<h2>Quer comprar um im&oacute;vel?</h2>\r\n\r\n<p>Se a sua d&uacute;vida &eacute; como conseguir comprar um im&oacute;vel, pode ficar calmo, pois estamos aqui para te ajudar com isso. &Eacute; muito comum as pessoas ficarem em d&uacute;vida nesse momento t&atilde;o importante da sua vida, afinal n&atilde;o s&atilde;o todos os dias que decidimos comprar a nossa casa pr&oacute;pria. Mas n&oacute;s da Impera Real entendemos a import&acirc;ncia que &eacute; esse momento e por isso resolvemos te ajudar garantindo total transpar&ecirc;ncia no atendimento e explicando com o m&aacute;ximo de clareza o funcionamento do processo (passo a passo) para que tenha certeza da sua escolha e decida com mais tranquilidade o im&oacute;vel da sua vida.</p>\r\n\r\n<h2>Quer alugar um im&oacute;vel?</h2>\r\n\r\n<p>Alugue seu im&oacute;vel com quem entende do assunto, se est&aacute; na d&uacute;vida e n&atilde;o sabe como alugar seu im&oacute;vel, somos a escolha certa para te ajudar de forma segura, r&aacute;pida e pr&aacute;tica. Nossa plataforma disponibiliza todas as informa&ccedil;&otilde;es necess&aacute;rias dos im&oacute;veis para que n&atilde;o tenha surpresas na hora de alugar. Temos fotos, tour virtual, endere&ccedil;o e localiza&ccedil;&atilde;o completa dos im&oacute;veis para facilitar a sua busca. Queremos lhe proporcionar praticidade no seu dia a dia.</p>\r\n\r\n<h2>Est&aacute; na d&uacute;vida entre comprar ou alugar um im&oacute;vel?</h2>\r\n\r\n<p>Se sua d&uacute;vida &eacute; se aluga ou compra, n&atilde;o tem problema!<br />\r\nSomos uma Empresa Multifuncional, podemos te ajudar com isso, temos &oacute;timos profissionais engajados no mercado imobili&aacute;rio a sua disposi&ccedil;&atilde;o para lhe orientar sobre o que &eacute; melhor para voc&ecirc; e seu bolso.</p>\r\n\r\n<p>Esse &eacute; um diferencial que somente quem tem experi&ecirc;ncia com venda e loca&ccedil;&atilde;o de im&oacute;veis pode lhe proporcionar. &nbsp;<br />\r\nQueremos dividir essa experi&ecirc;ncia com voc&ecirc;!</p>\r\n\r\n<h2>Ficou na d&uacute;vida de qual im&oacute;vel escolher?</h2>\r\n\r\n<p>Deixe o seu contato, temos os melhores profissionais do mercado conectados e prontos para te ajudar a encontrar o que precisa.</p>\r\n', NULL, '', 'Converse conosco e juntos encontraremos<br> o melhor lugar para você!', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(10, 'faq-corretor-imovel-pronto', 'Perguntas frequentes dos corretores', 'd4ef2ca25a2c3fab5b862e85eb2cf345.png', NULL, NULL, 'Corretor de Imóvel Pronto', '', '<p>Voc&ecirc; ter&aacute; mais autonomia e liberdade, podendo trabalhar de casa, flexibilizando melhor o seu tempo e usando a tecnologia ao seu favor. Apresente im&oacute;veis ao seu cliente de onde voc&ecirc; estiver, atrav&eacute;s de tour virtual, imagens e v&iacute;deos.</p>\r\n', NULL, 'Perguntas frequentes dos corretores', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(11, 'faq-corretor-imovel-planta', 'Perguntas frequentes dos corretores', '2d1b990c088a771f1483796864eae6ca.png', NULL, NULL, 'Corretor de Imóvel na Planta', '', '<p>Voc&ecirc; ter&aacute; um portf&oacute;lio mais acess&iacute;vel e completo com os conte&uacute;dos necess&aacute;rios para agilizar o fechamento do seu neg&oacute;cio mais rapidamente, al&eacute;m disso, poder&aacute; ter uma carteira de clientes maior e mais direcionada.</p>\r\n', NULL, 'Perguntas frequentes dos corretores', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(12, 'faq-corretor-imovel-locacao', 'Perguntas frequentes dos corretores', 'cbfe8f60d603c4a2c48dcfabedbd0348.png', NULL, NULL, 'Corretor de Imóvel para Locação', '', '<p>Atrav&eacute;s da nossa plataforma voc&ecirc; tem mais facilidade para encontrar o im&oacute;vel ideal para o seu cliente. Conte com todo o nosso suporte para agilizar todo o processo e deixe a parte burocr&aacute;tica por nossa conta.</p>\r\n', NULL, 'Perguntas frequentes dos corretores', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(13, 'blocos', NULL, NULL, NULL, NULL, 'Veja Como Funciona', 'Criamos uma experiência online perfeita para simplificar o processo de escolha do seu imóvel.', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, NULL, NULL, NULL),
(14, 'imoveis-home', NULL, NULL, NULL, NULL, 'Últimos Imóveis', 'Quer você queira Comprar, Vender ou Alugar, podemos ajudá-lo com facilidade.', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, NULL, NULL, NULL),
(15, 'regioes-home', NULL, NULL, NULL, NULL, 'Escolha a sua Região', 'Aqui você pode encontrar imóveis nas principais regiões.', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, NULL, NULL, NULL),
(16, 'podemos-ajudar', NULL, NULL, NULL, NULL, 'Como podemos ajudar?', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, NULL, NULL, NULL),
(17, 'contato-home', NULL, '5cd2b0917bf9c926f310cb018875c516.png', NULL, NULL, 'Não sabe qual<br> imóvel escolher?', 'Converse conosco e juntos encontraremos o melhor<br> lugar para você. <b>É de graça!</b>', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, NULL, NULL, NULL),
(18, 'proprietario-vantagens', NULL, '294305db02973481ee273e4b71097c03.png', NULL, NULL, 'Vantagens em Vender', '', '<ul class=\"check\">\r\n	<li>An&aacute;lise de documenta&ccedil;&atilde;o eficiente</li>\r\n	<li>Redu&ccedil;&atilde;o da burocracia</li>\r\n	<li>Aumentamos suas chances de fechar neg&oacute;cio</li>\r\n	<li>Ampla divulga&ccedil;&atilde;o do seu im&oacute;vel</li>\r\n	<li>Transpar&ecirc;ncia do in&iacute;cio ao fim do processo</li>\r\n</ul>', 'd6ce9aff4bc6eb302b59f4e30259f372.png', 'Vantagens em Alugar', '', '<ul class=\"check\">\r\n	<li>Garantia do recebimento dos alugu&eacute;is atrav&eacute;s da CredPago</li>\r\n	<li>An&aacute;lise de cr&eacute;dito eficiente para diminuir inadimpl&ecirc;ncia</li>\r\n	<li>Processo feito sem burocracia e o cadastro do inquilino &eacute; analisado em menos de 1 minuto.</li>\r\n	<li>Seu im&oacute;vel aluga mais r&aacute;pido</li>\r\n	<li>Repasse r&aacute;pido dos valores em caso de inadimpl&ecirc;ncia</li>\r\n</ul>\r\n', NULL, '', '', '', NULL, '', '', '', NULL, NULL, NULL, NULL),
(19, 'comissoes-afiliados', '', 'f3e637c1b83829a861faadb1dd2e6bda.png', NULL, NULL, 'Indicação por Venda', '', '<p>Pela <strong>indica&ccedil;&atilde;o do im&oacute;vel </strong>para venda voc&ecirc; ganha <strong>R$ 1.000,00 </strong>quando o im&oacute;vel indicado for vendido.&nbsp;</p>\r\n\r\n<p>Pela <strong>indica&ccedil;&atilde;o do cliente</strong> voc&ecirc; pode ganhar at&eacute; <strong>R$ 1.000,00</strong> quando o im&oacute;vel for vendido.</p>\r\n\r\n<p>Dessa forma voc&ecirc; pode ganhar at&eacute; <strong>R$ 2.000,00</strong> se indicar o <strong>im&oacute;vel + o cliente</strong>!&nbsp;</p>\r\n\r\n<blockquote>\r\n<p><strong>Regra para indica&ccedil;&atilde;o do cliente comprador</strong><br />\r\nSe voc&ecirc; indicar um cliente e ele comprar um Im&oacute;vel de at&eacute; <strong>250 mil</strong>, voc&ecirc; ganha <strong>R$ 500,00</strong>.<br />\r\nSe ele comprar um im&oacute;vel <strong>acima</strong> desse valor voc&ecirc; ganha <strong>R$ 1.000,00</strong>.</p>\r\n</blockquote>\r\n', '896abb1204da1c8157bd0ca15d31c71a.png', 'Indicação por Locação', '', '<p>Pela <strong>indica&ccedil;&atilde;o do im&oacute;vel</strong> para loca&ccedil;&atilde;o voc&ecirc; ganha <strong>10%</strong> do primeiro aluguel quando o im&oacute;vel for alugado.&nbsp;</p>\r\n\r\n<p>Pela <strong>indica&ccedil;&atilde;o do cliente</strong> voc&ecirc; ganha <strong>10%</strong> do primeiro aluguel quando o im&oacute;vel for alugado.&nbsp;</p>\r\n\r\n<p>Dessa forma voc&ecirc; pode ganhar at&eacute; <strong>20%</strong> do primeiro aluguel, se indicar o <strong>im&oacute;vel + o cliente</strong>!</p>\r\n\r\n<blockquote>\r\n<p><strong>Exemplo:&nbsp;</strong><br />\r\nSe o aluguel do im&oacute;vel indicado for <strong>R$ 2.000,00</strong> voc&ecirc; ganha <strong>R$ 200,00</strong>.&nbsp;<br />\r\nCaso tenha indicado o cliente ganhar&aacute; mais <strong>R$ 200,00</strong>.</p>\r\n</blockquote>\r\n', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(20, 'enviar-documentos', 'Enviar Documentos', NULL, '27e535c380fefb6d09ec10231a40a728.jpg', NULL, 'Veja como é simples e fácil<br> solicitar sua avaliação!', 'Peça a sua análise de onde estiver!', '', NULL, 'Benefícios da Compra e Locação<br> Segura pela Impera Real', '', '<h2 style=\"text-align: center;\">&nbsp;</h2>\r\n\r\n<h2 style=\"text-align: center;\">Como agilizar o resultado da minha an&aacute;lise</h2>\r\n\r\n<p style=\"text-align: center;\"><a href=\"blog\">Dicas para fotografar e enviar seus documentos</a></p>\r\n', 'fdf74e4ddd71d5256cd737429a56f26f.png', 'Agora que já escolheu o seu imóvel solicite a sua análise sem precisar sair de casa!', 'Ajudamos você a simplificar o seu dia a dia com a nossa plataforma 100% digital.', '', NULL, '', '', '', NULL, '', '', ''),
(21, 'documentos-beneficios', '', NULL, NULL, NULL, 'Para Comprar', '', '<ul class=\"check\">\r\n	<li><strong>An&aacute;lise R&aacute;pida</strong><br />\r\n	Suporte e agilidade na aprova&ccedil;&atilde;o do seu Financiamento.</li>\r\n	<li><strong>Burocracia zero</strong><br />\r\n	Envio da documenta&ccedil;&atilde;o e an&aacute;lise de cr&eacute;dito 100% digital.&nbsp;</li>\r\n	<li><strong>Atendimento Personalizado</strong><br />\r\n	Contar&aacute; com uma assessoria qualificada para acompanhar todo o processo de compra.</li>\r\n	<li><strong>Seguran&ccedil;a total</strong><br />\r\n	Comprar um im&oacute;vel com seguran&ccedil;a e ter uma an&aacute;lise de risco completa.</li>\r\n	<li><strong>Transpar&ecirc;ncia</strong><br />\r\n	Voc&ecirc; estar&aacute; por dentro de todo o processo do in&iacute;cio ao fim.</li>\r\n</ul>\r\n', NULL, 'Para Alugar', '', '<ul class=\"check\">\r\n	<li><strong>An&aacute;lise Instant&acirc;nea</strong><br />\r\n	Seu cadastro &eacute; analisado em menos de 1 minuto.</li>\r\n	<li><strong>Sem comprova&ccedil;&atilde;o de renda</strong><br />\r\n	Pagamento do seguro fian&ccedil;a feito via cart&atilde;o de cr&eacute;dito.&nbsp;</li>\r\n	<li><strong>Burocracia zero</strong><br />\r\n	N&atilde;o &eacute; necess&aacute;rio c&oacute;pias e nem autentica&ccedil;&otilde;es em cart&oacute;rio. Tudo &eacute; 100% digital.</li>\r\n	<li><strong>Multipagamento</strong><br />\r\n	Diferentes formas para pagar a garantia do aluguel com mais facilidade.</li>\r\n	<li><strong>Sem fiador</strong><br />\r\n	Fian&ccedil;a via CredPago.</li>\r\n	<li><strong>Seguran&ccedil;a total</strong><br />\r\n	Utilizamos as melhores tecnologias para prote&ccedil;&atilde;o de dados.</li>\r\n</ul>\r\n', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(22, 'quais-documentos-enviar-comprar', '', '211d2eaa2b76db708f4119942e5cab74.png', NULL, NULL, 'Para Comprar', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(23, 'quais-documentos-enviar-alugar', '', 'fd6ed21a9b59e317cb787828012cc644.png', NULL, NULL, 'Para Alugar', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(24, 'quais-documentos-enviar', 'Quais Documentos Enviar', '1adac577a617c97a03ad23acec5b09e0.png', NULL, NULL, 'Quais documentos preciso enviar para Comprar ou Alugar um imóvel?', '', '<p>Veja a rela&ccedil;&atilde;o de documentos que voc&ecirc; precisa enviar para comprar ou alugar um im&oacute;vel na Impera Real.</p>\r\n\r\n<p><a class=\"btn btn-primario\" href=\"quais-documentos-enviar\">Ver lista de documentos</a></p>\r\n', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', ''),
(25, 'casa-verde-e-amarela', 'Programa Casa Verde e Amarela', NULL, '646f56c3aef0cdf619078dd2bc75c37a.jpg', NULL, 'Como Funciona o Programa<br> Casa Verde e Amarela', 'Bem vindo ao Programa que ajuda milhares de pessoas<br> a conquistar o sonho do imóvel próprio!<br>', '', 'a42c358d1e2eaec06b397171fcf8ae9d.png', 'O que é a Casa Verde e Amarela', '', '<p>O Casa Verde e Amarela &eacute; o novo Programa Habitacional do Governo Federal que substitui o Minha Casa Minha Vida e traz novidades e melhorias.</p>\r\n\r\n<p>O novo Programa re&uacute;ne inciativas do Governo Federal para atender as necessidades de moradia habitacional da popula&ccedil;&atilde;o.</p>\r\n\r\n<p>E vem com as menores taxas de juros da hist&oacute;ria do Pa&iacute;s e com condi&ccedil;&otilde;es exclusivas para facilitar a vida de quem sonha com o im&oacute;vel pr&oacute;prio.</p>\r\n', NULL, 'Conheça as Vantagens', 'O Programa te ajuda com inúmeras facilidades', '', NULL, '', '', '', NULL, '', '', ''),
(26, 'proprietario-ajuda', '', NULL, NULL, NULL, 'Minhas dúvidas', '', '<p><strong>1 - Como a Impera Real vai vender ou alugar o meu im&oacute;vel?&nbsp;</strong><br />\r\nSomos uma das maiores plataformas digitais do mercado no Brasil.&nbsp;<br />\r\nUsamos estrat&eacute;gias de marketing 100% digital, assim podemos lhe garantir confian&ccedil;a e agilidade em todo processo referente &agrave; venda ou loca&ccedil;&atilde;o do seu im&oacute;vel.&nbsp;<br />\r\nAl&eacute;m disso, veiculamos o an&uacute;ncio do seu im&oacute;vel nas maiores redes digitais e sociais.&nbsp;</p>\r\n\r\n<p><strong>2 &ndash; Por qual valor devo anunciar o meu im&oacute;vel? &nbsp;</strong><br />\r\nPara ter uma venda ou loca&ccedil;&atilde;o mais assertiva &eacute; importante que voc&ecirc; tenha em mente que cada bairro tem o seu valor por m&sup2;, mas isso pode sofrer altera&ccedil;&otilde;es, pois a localiza&ccedil;&atilde;o e o estado atual do seu im&oacute;vel podem ser determinantes para estabelecer o valor de venda ou loca&ccedil;&atilde;o.&nbsp;<br />\r\nSe voc&ecirc; est&aacute; na d&uacute;vida de qual valor deve anunciar o seu im&oacute;vel, converse com a nossa equipe de especialistas atrav&eacute;s do seu chat.&nbsp;</p>\r\n\r\n<p><strong>3 &ndash; Onde vejo as propostas do meu im&oacute;vel?&nbsp;</strong><br />\r\nFique tranquilo, pois quando o seu im&oacute;vel receber uma proposta voc&ecirc; ser&aacute; informado via chat e atrav&eacute;s da sua linha do tempo na p&aacute;gina &ldquo;acompanhe seu an&uacute;ncio&rdquo; no seu &ldquo;menu&rdquo;.&nbsp;<br />\r\nTudo ficar&aacute; bem transparente para o seu conforto e praticidade.&nbsp;</p>\r\n\r\n<p><strong>4 &ndash; Entenda os valores cobrados para Vender ou Alugar seu im&oacute;vel.</strong></p>\r\n\r\n<ul class=\"row blocos-faq\" data-aos=\"fade-up\">\r\n	<li class=\"grid-6 grid-m-12 grid-s-12 bloco-faq\">\r\n	<div>\r\n	<div class=\"bloco-faq-tit\">\r\n	<h2>Comiss&atilde;o por Venda</h2>\r\n	</div>\r\n\r\n	<div class=\"texto\"><b>Comiss&atilde;o da Impera Real para vendas:</b> Cobramos 5% do valor total do im&oacute;vel somente quando a venda for concretizada atrav&eacute;s da nossa plataforma.&nbsp;</div>\r\n	</div>\r\n	</li>\r\n	<li class=\"grid-6 grid-m-12 grid-s-12 bloco-faq\">\r\n	<div>\r\n	<div class=\"bloco-faq-tit\">\r\n	<h2>Comiss&atilde;o por loca&ccedil;&atilde;o</h2>\r\n	</div>\r\n\r\n	<div class=\"texto\"><b>Comiss&atilde;o da Impera Real:</b> Equivale ao valor integral do primeiro m&ecirc;s de aluguel.<br />\r\n	<br />\r\n	<b>Taxa para administra&ccedil;&atilde;o mensal:</b> 8% sobre o valor da loca&ccedil;&atilde;o para im&oacute;veis com exclusividade e 8,5% para im&oacute;veis sem exclusividade.</div>\r\n	</div>\r\n	</li>\r\n</ul>\r\n\r\n<p><br />\r\n<strong>5 - Se eu optar pela exclusividade, qual &eacute; o prazo de dura&ccedil;&atilde;o?</strong><br />\r\nO prazo de exclusividade com a Impera Real &eacute; de 3 meses para loca&ccedil;&atilde;o e 6 meses para im&oacute;veis &agrave; venda, caso o seu im&oacute;vel n&atilde;o seja alugado ou vendido nesse per&iacute;odo voc&ecirc; poder&aacute; anunciar em outras plataformas.&nbsp;</p>\r\n\r\n<p><strong>6 &ndash; Qual vantagem eu terei se optar pela exclusividade?&nbsp;</strong><br />\r\nVoc&ecirc; ter&aacute; mais destaque no seu an&uacute;ncio, ou seja, seu an&uacute;ncio ser&aacute; mais divulgado, al&eacute;m de ter um desconto na taxa de administra&ccedil;&atilde;o no caso de loca&ccedil;&atilde;o.&nbsp;</p>\r\n\r\n<p><strong>7 &ndash; Qual o prazo para aprova&ccedil;&atilde;o do cliente na compra ou loca&ccedil;&atilde;o de um im&oacute;vel?&nbsp;</strong><br />\r\nAprova&ccedil;&atilde;o do cliente para Compra: O prazo para aprova&ccedil;&atilde;o da an&aacute;lise de cr&eacute;dito &eacute; de at&eacute; 48 horas ap&oacute;s o envio dos documentos.&nbsp;<br />\r\nAprova&ccedil;&atilde;o do cliente para Loca&ccedil;&atilde;o: O prazo para aprova&ccedil;&atilde;o da an&aacute;lise de cr&eacute;dito &eacute; de at&eacute; 24 horas ap&oacute;s o envio dos documentos.&nbsp;</p>\r\n\r\n<p><strong>8 &ndash; Sou propriet&aacute;rio de um im&oacute;vel financiado, posso vender?&nbsp;</strong><br />\r\nSim, &eacute; poss&iacute;vel vender o seu im&oacute;vel mesmo que ele ainda n&atilde;o esteja quitado no banco.&nbsp;</p>\r\n\r\n<p><strong>9 - N&atilde;o sou propriet&aacute;rio do im&oacute;vel, posso vender ou alugar?&nbsp;</strong><br />\r\nN&atilde;o, neste caso a venda ou loca&ccedil;&atilde;o s&oacute; poder&aacute; ser realizada caso voc&ecirc; possua a procura&ccedil;&atilde;o legal do im&oacute;vel.</p>\r\n', NULL, 'Informações do Contrato', '', '<p><strong>1 - Como vou assinar o contrato?</strong><br />\r\nO nosso contrato ser&aacute; assinado digitalmente quando a proposta do inquilino ou comprador para o seu im&oacute;vel for aceita, ser&aacute; enviado um contrato via e-mail para todas as partes assinarem.&nbsp;</p>\r\n\r\n<p><strong>2 &ndash; Quando deverei assinar o contrato digital?&nbsp;</strong><br />\r\nO contrato dever&aacute; ser assinado quando ambas as partes (propriet&aacute;rio / cliente) estiverem de acordo com as condi&ccedil;&otilde;es propostas referentes &agrave; venda ou loca&ccedil;&atilde;o do im&oacute;vel.&nbsp;<br />\r\nLembrando que, a proposta do cliente s&oacute; ser&aacute; aceita ap&oacute;s a aprova&ccedil;&atilde;o da an&aacute;lise de cr&eacute;dito do mesmo.&nbsp;</p>\r\n\r\n<p><strong>3 &ndash; Qual o tempo de dura&ccedil;&atilde;o do contrato de aluguel?&nbsp;</strong><br />\r\nO contrato de aluguel tem dura&ccedil;&atilde;o padr&atilde;o de 30 meses.&nbsp;</p>\r\n\r\n<p><strong>4 - Qual o dia do m&ecirc;s receberei o meu aluguel?&nbsp;</strong><br />\r\nO repasse do seu aluguel &eacute; realizado todo dia 12 de cada m&ecirc;s.&nbsp;</p>\r\n\r\n<p><strong>5 &ndash; Em loca&ccedil;&atilde;o, como funciona o pagamento do IPTU e condom&iacute;nio?</strong><br />\r\nAs despesas de IPTU e condom&iacute;nio s&atilde;o de responsabilidade do inquilino.&nbsp;<br />\r\nNo entanto, os valores do IPTU ser&atilde;o repassados mensalmente ao propriet&aacute;rio do im&oacute;vel, para que o mesmo efetue o pagamento.&nbsp;<br />\r\nQuanto ao condom&iacute;nio, somente ser&aacute; de responsabilidade do propriet&aacute;rio as despesas extraordin&aacute;rias, ou seja, gastos extras provenientes de imprevistos.&nbsp;</p>\r\n', NULL, 'Plataforma Impera Real', '', '<p><strong>1 &ndash; Para que serve o chat da Impera Real?</strong><br />\r\n&Eacute; um meio de voc&ecirc; se comunicar exclusivamente conosco em caso de d&uacute;vidas e receber propostas referente &agrave; venda ou loca&ccedil;&atilde;o do seu im&oacute;vel.&nbsp;<br />\r\nCaso opte por alugar o seu im&oacute;vel, tamb&eacute;m servir&aacute; para se comunicar diretamente com o seu inquilino.&nbsp;</p>\r\n\r\n<p><strong>2 - Como posso acompanhar em qual etapa encontra-se o meu im&oacute;vel?&nbsp;</strong><br />\r\nN&oacute;s criamos uma linha do tempo exclusivamente para que voc&ecirc; possa acompanhar a situa&ccedil;&atilde;o do seu im&oacute;vel.&nbsp;<br />\r\nL&aacute; voc&ecirc; poder&aacute; entender se o seu im&oacute;vel est&aacute; perto de alcan&ccedil;ar o objetivo de venda ou loca&ccedil;&atilde;o.&nbsp;<br />\r\nBasta acessar o bot&atilde;o &ldquo;Acompanhe seu an&uacute;ncio&rdquo; no menu da sua conta.&nbsp;</p>\r\n\r\n<p><strong>3 &ndash; O que significa o status no bot&atilde;o &ldquo;meus im&oacute;veis&rdquo;?&nbsp;</strong><br />\r\nO status serve para informar em qual etapa encontra-se o seu im&oacute;vel.<br />\r\nAbaixo est&atilde;o descritos as etapas e significados de todos os status.&nbsp;<br />\r\n<strong>Avalia&ccedil;&atilde;o:&nbsp;</strong>Significa que o seu im&oacute;vel est&aacute; sendo avaliado pela nossa equipe para que seja rapidamente publicado sem qualquer pend&ecirc;ncia.&nbsp;<br />\r\n<strong>Encerrado:&nbsp;</strong>Significa que o an&uacute;ncio do seu im&oacute;vel foi encerrado por algum motivo extraordin&aacute;rio.&nbsp;<br />\r\n<strong>Pend&ecirc;ncia:&nbsp;</strong>Significa que o an&uacute;ncio do seu im&oacute;vel est&aacute; incompleto.<br />\r\n<strong>Publicado: </strong>Neste caso o seu im&oacute;vel passou pela nossa avalia&ccedil;&atilde;o e j&aacute; foi publicado.&nbsp;<br />\r\n<strong>Vendido:&nbsp;</strong>Quando a venda do seu im&oacute;vel for concretizada.<br />\r\n<strong>Alugado:&nbsp;</strong>Quando a loca&ccedil;&atilde;o do seu im&oacute;vel for concretizada.&nbsp;</p>\r\n\r\n<p><strong>4 &ndash; Pagamentos para o propriet&aacute;rio locador</strong><br />\r\nO bot&atilde;o pagamento encontrado no menu da sua conta foi criado exclusivamente para que o propriet&aacute;rio locador consiga acompanhar os valores que ser&atilde;o mensalmente repassados.<br />\r\nPara n&oacute;s, a transpar&ecirc;ncia e o comprometimento sempre estar&atilde;o presentes em nosso relacionamento.</p>\r\n\r\n<p><strong>5 &ndash; Dicas do Blog&nbsp;</strong><br />\r\nNo blog voc&ecirc; ter&aacute; mais informa&ccedil;&otilde;es e orienta&ccedil;&otilde;es para vender ou alugar o seu im&oacute;vel com mais agilidade.<br />\r\nL&aacute; voc&ecirc; encontra dicas de como organizar e fotografar o seu im&oacute;vel, dessa forma voc&ecirc; ter&aacute; ainda mais possibilidade de alcan&ccedil;ar o seu objetivo. &nbsp;<br />\r\n<a href=\"https://www.ellosdesign.com/imperareal/blog\" target=\"_blank\">Dicas do blog</a></p>\r\n', NULL, '', '', '', NULL, '', '', ''),
(27, 'cliente-ajuda', '', NULL, NULL, NULL, 'Minhas Dúvidas', '', '<p><strong>1 - &nbsp;Posso enviar minha documenta&ccedil;&atilde;o antes de visitar o im&oacute;vel?</strong><br />\r\nPode sim, sua documenta&ccedil;&atilde;o pode ser enviada online atrav&eacute;s da nossa plataforma. Dessa maneira voc&ecirc; j&aacute; ficar&aacute; a par dos valores aprovados em sua avalia&ccedil;&atilde;o.</p>\r\n\r\n<p><strong>2 - &nbsp;Onde posso enviar minha documenta&ccedil;&atilde;o para comprar ou alugar?</strong><br />\r\nVoc&ecirc; poder&aacute; fazer isso aqui mesmo na sua conta de cliente, basta acessar a p&aacute;gina Documentos e seguir o passo a passo.</p>\r\n\r\n<p><strong>3 - &nbsp;Como &eacute; feita a an&aacute;lise de cr&eacute;dito para comprar ou alugar?</strong><br />\r\nA an&aacute;lise de Cr&eacute;dito &eacute; feita atrav&eacute;s de uma das nossas seguradoras parceiras, que facilita e agiliza todo esse processo para seguirmos com a loca&ccedil;&atilde;o rapidamente.<br />\r\nJ&aacute; a an&aacute;lise de cr&eacute;dito para comprar &eacute; feita pelos bancos parceiros.</p>\r\n\r\n<p><strong>4 - Posso juntar renda para comprar ou alugar um im&oacute;vel?</strong><br />\r\nVoc&ecirc; pode adicionar at&eacute; 3 pessoas para comprar ou alugar o im&oacute;vel junto com voc&ecirc;.&nbsp;<br />\r\nObs.: Todos os componentes dever&atilde;o apresentar os mesmos documentos solicitados para a avalia&ccedil;&atilde;o do im&oacute;vel de interesse.</p>\r\n\r\n<p><strong>5 - Como e onde eu envio minha proposta para o im&oacute;vel desejado?</strong><br />\r\nAp&oacute;s a escolha do im&oacute;vel de interesse, voc&ecirc; pode nos enviar a sua proposta por e-mail ou WhatsApp.<br />\r\nContato<br />\r\nE-mail: contato@imperareal.com.br<br />\r\nWhatsapp: (21) 96530-7325</p>\r\n\r\n<p><strong>6 - A Impera Real disponibiliza o contrato digital?</strong><br />\r\nSim. Para que haja mais conforto e praticidade, voc&ecirc; vai poder assinar o contrato de onde estiver evitando assim um deslocamento e desperd&iacute;cio de papel.<br />\r\nA assinatura digital equivale &agrave; assinatura a pr&oacute;prio punho e tem validade jur&iacute;dica inquestion&aacute;vel.</p>\r\n\r\n<p><strong>7 - Preciso de fiador ou dep&oacute;sito cau&ccedil;&atilde;o para alugar um im&oacute;vel?</strong><br />\r\nA Impera Real n&atilde;o trabalha com fiador ou dep&oacute;sito cau&ccedil;&atilde;o, e voc&ecirc; n&atilde;o precisa mais depender de ningu&eacute;m para alugar seu im&oacute;vel.<br />\r\nTrabalhamos em parceria com seguradoras de excel&ecirc;ncia no mercado.</p>\r\n\r\n<p><strong>8 - Qual o tempo de resposta da an&aacute;lise de cr&eacute;dito e como saberei o resultado?</strong><br />\r\n<br />\r\n<strong>Para comprar:</strong> O tempo de resposta da an&aacute;lise para comprar &eacute; de 24h a 48h. Podendo ser em menos tempo, caso os documentos enviados n&atilde;o apresentem pend&ecirc;ncias.<br />\r\n<br />\r\n<strong>Para alugar:</strong> O tempo de resposta da an&aacute;lise para alugar &eacute; de at&eacute; 24 horas. Podendo ser em menos tempo, caso os documentos enviados n&atilde;o apresentem pend&ecirc;ncias.&nbsp;<br />\r\n<br />\r\n<strong>Resultado da an&aacute;lise:</strong> Nossa equipe enviar&aacute; um arquivo com o resultado aqui mesmo na sua &aacute;rea do cliente no bot&atilde;o &ldquo;Documentos&rdquo; o arquivo estar&aacute; dispon&iacute;vel em &ldquo;Documentos Recebidos&rdquo;. Mas fique tranquilo que a nossa equipe entrar&aacute; em contato para lhe orientar a respeito da sua aprova&ccedil;&atilde;o.</p>\r\n', NULL, 'Informações de contrato', '', '<p><strong>1 - Onde eu assino o meu contrato de compra ou loca&ccedil;&atilde;o?</strong><br />\r\nSeu contrato ser&aacute; enviado por e-mail e sua assinatura ser&aacute; feita digitalmente.</p>\r\n\r\n<p><strong>2 - Quanto tempo eu tenho para assinar o meu contrato?</strong><br />\r\nAp&oacute;s o envio do contrato por e-mail voc&ecirc; tem at&eacute; 12 horas para assinar seu contrato digitalmente para que a reserva do seu im&oacute;vel n&atilde;o seja prejudicada.</p>\r\n\r\n<p><strong>3 - Eu preciso pagar algum valor para emiss&atilde;o do contrato?</strong><br />\r\nN&atilde;o. O contrato/compromisso de compra e venda ou loca&ccedil;&atilde;o &eacute; totalmente gratuito.</p>\r\n\r\n<p><strong>4 - Qual a data de vencimento do boleto do aluguel?</strong><br />\r\nA data de vencimento dos nossos boletos de aluguel &eacute; sempre no dia 10 de cada m&ecirc;s.</p>\r\n\r\n<p><strong>5 - Qual a idade m&aacute;xima para financiar um im&oacute;vel?</strong><br />\r\nA idade m&aacute;xima para financiar um im&oacute;vel varia de banco para banco, mas fica em torno de 65 a 70 anos, lembrando que a faixa de idade influencia no prazo do financiamento, ou seja, quanto maior a idade menor o prazo liberado pelo banco.</p>\r\n', NULL, 'Plataforma Impera Real', '', '<p><strong>Chat da Impera Real</strong><br />\r\nO chat &eacute; um meio exclusivo de voc&ecirc; se comunicar em caso de d&uacute;vidas.<br />\r\nE se optar por alugar um im&oacute;vel conosco, tamb&eacute;m poder&aacute; se comunicar diretamente com o propriet&aacute;rio.</p>\r\n\r\n<p><strong>P&aacute;gina Documentos</strong><br />\r\nEsta p&aacute;gina &eacute; exclusiva para voc&ecirc; enviar sua documenta&ccedil;&atilde;o diretamente para an&aacute;lise sem a necessidade de intermedia&ccedil;&atilde;o. Basta anexar os arquivos correspondentes em cada tipo de documento e clicar em cadastrar que sua documenta&ccedil;&atilde;o ser&aacute; encaminhada imediatamente para nossa base.<br />\r\nVoc&ecirc; tamb&eacute;m poder&aacute; receber a sua aprova&ccedil;&atilde;o nesta p&aacute;gina.</p>\r\n\r\n<p><strong>P&aacute;gina Meus Boletos</strong><br />\r\nA p&aacute;gina Meus Boletos &eacute; exclusiva para que voc&ecirc; possa baixar os seus boletos de loca&ccedil;&atilde;o. Lembrando que os boletos tamb&eacute;m ser&atilde;o enviados por e-mail.</p>\r\n\r\n<p><strong>Dicas do Blog</strong><br />\r\nNo blog voc&ecirc; ter&aacute; mais informa&ccedil;&otilde;es e orienta&ccedil;&otilde;es para alugar ou comprar com mais agilidade e facilidade.&nbsp;<br />\r\nL&aacute; voc&ecirc; tamb&eacute;m encontra dicas de como fotografar os documentos para an&aacute;lise, organiza&ccedil;&atilde;o de ambientes e decora&ccedil;&atilde;o.</p>\r\n\r\n<p><a href=\"https://www.ellosdesign.com/imperareal/blog\" target=\"_blank\">Siga as nossas dicas&nbsp;</a></p>\r\n', NULL, '', '', '', NULL, '', '', ''),
(28, 'corretor-ajuda', '', NULL, NULL, NULL, 'Minhas Dúvidas', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>\r\n\r\n<p>Cras ultricies ligula sed magna dictum porta. Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>\r\n', NULL, 'Informações de contrato', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>\r\n\r\n<p>Cras ultricies ligula sed magna dictum porta. Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>\r\n', NULL, 'Plataforma Impera Real', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>\r\n\r\n<p>Cras ultricies ligula sed magna dictum porta. Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>\r\n', NULL, '', '', '', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `paginas_blocos`
--

CREATE TABLE `paginas_blocos` (
  `id` int(11) NOT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto` text COLLATE latin1_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `paginas_blocos`
--

INSERT INTO `paginas_blocos` (`id`, `pagina_id`, `ordem_exibicao`, `titulo`, `texto`, `foto`, `status`) VALUES
(3, 6, 1, 'Agendamentos', '<p>N&oacute;s fazemos toda a parte de marketing para lhe proporcionar clientes j&aacute; interessados em visitar e se tornar um poss&iacute;vel fechamento de venda.</p>\r\n', 'dbf4f5a7730e0bfca5f2388ed0eb763c.png', 1),
(4, 6, 2, 'Vitrine', '<p>Nossa plataforma digital conta com um portf&oacute;lio completo com as informa&ccedil;&otilde;es de cada empreendimento para facilitar o seu entendimento e atendimento ao cliente.&nbsp;</p>\r\n', 'b6df7bf5199795d6f69fbc3af8304e42.png', 1),
(5, 6, 3, 'Agilidade', '<p>Faremos a parte burocr&aacute;tica por voc&ecirc;, para que voc&ecirc; possa focar no que faz de melhor, encantar o cliente com o seu atendimento e profissionalismo.</p>\r\n', '653a0056a9dacfe012621fe7a1e9b88b.png', 1),
(6, 6, 4, 'Transparência', '<p>Aqui n&atilde;o existe surpresa, voc&ecirc; poder&aacute; contar com o nosso suporte digital para estarmos sempre pr&oacute;ximos. Assim teremos uma parceria excelente!</p>\r\n', 'cbbd564f4322659551e0e9b2206f01a3.png', 1),
(7, 6, 5, 'Portfólio de imóveis', '<p>Estamos sempre crescendo o nosso portf&oacute;lio de im&oacute;veis para que voc&ecirc; tenha um leque de op&ccedil;&otilde;es mais amplo e qualificado para ofertar aos seus clientes.</p>\r\n', '97ceedb652ab57490dd668ba88279178.png', 1),
(8, 7, 1, 'Você mesmo faz o cadastro', '<p>Voc&ecirc; mesmo pode cadastrar o seu im&oacute;vel se desejar, assim ele ser&aacute; anunciado mais r&aacute;pido. Em segundos seu im&oacute;vel estar&aacute; sendo divulgado para milhares de pessoas e poder&aacute; ser vendido/alugado mais rapidamente.</p>\r\n', '41f0d5a0940eb2baf11df61068a7c38b.png', 1),
(9, 7, 2, 'Tecnologia Digital', '<p>Venda ou Alugue seu im&oacute;vel sem precisar sair de casa, com a nossa plataforma voc&ecirc; poder&aacute; monitorar todo o processo do seu im&oacute;vel sem fazer esfor&ccedil;o.</p>\r\n', 'a27058d9d228ffa6c76dd6e2dfa2bba6.png', 1),
(10, 7, 3, 'Agilidade nas negociações', '<p>An&aacute;lise R&aacute;pida e completa. Elimine impasses da burocracia com processos 100% digitais.</p>\r\n', '25aa669ca9abbf06f398fc3471849955.png', 1),
(11, 7, 4, 'Atendimento personalizado', '<p>Cuidamos do seu im&oacute;vel e de todo o processo burocr&aacute;tico do in&iacute;cio ao fim, assim voc&ecirc; ter&aacute; mais tempo para voc&ecirc; e menos dor de cabe&ccedil;a.</p>\r\n', 'de8c661e5439df855e1c4f66a2e58bda.png', 1),
(12, 8, 1, 'Cadastre-se', '<p>Junte-se ao nosso programa de afiliados e utilize nossa ferramenta de promo&ccedil;&atilde;o.</p>\r\n', '6197ddb8496f23b1c78b3deb32f117db.png', 1),
(13, 8, 2, 'Promova', '<p>Publique seu link em suas redes sociais e outras plataformas digitais.</p>\r\n', '90bbb2ab7e55c1cd9d6e928d459b303e.png', 1),
(14, 8, 3, 'Tenha Lucro', '<p>Voc&ecirc; acompanha os seus resultados atrav&eacute;s do seu cadastro e recebe o dinheiro direto na sua conta banc&aacute;ria.</p>\r\n', '0d04d6fa917b6d111b9b8887cad244a9.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paginas_faq`
--

CREATE TABLE `paginas_faq` (
  `id` int(11) NOT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto` text COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `paginas_faq`
--

INSERT INTO `paginas_faq` (`id`, `pagina_id`, `ordem_exibicao`, `titulo`, `texto`, `status`) VALUES
(1, 11, 1, 'O que é a Impera Real?', '<p>Somos uma imobili&aacute;ria digital que busca uma melhor integra&ccedil;&atilde;o e parceria entre<br />\r\ncorretores, clientes e imobili&aacute;ria. Usamos a tecnologia para facilitar o trabalho do<br />\r\ncorretor e agilizar na conclus&atilde;o da venda. Nossa plataforma foi pensada e criada<br />\r\nestrategicamente para ajudar a facilitar o dia a dia do corretor de im&oacute;veis, assim<br />\r\nvalorizamos seu tempo, dedica&ccedil;&atilde;o e esfor&ccedil;o.</p>\r\n', 1),
(2, 11, 2, 'Como faço para me cadastrar e ser um parceiro?', '<p>Basta efetuar o cadastro na nossa plataforma e aguardar nosso e-mail de confirma&ccedil;&atilde;o para conclus&atilde;o. Em seguida voc&ecirc; far&aacute; parte do nosso time de vendas!</p>\r\n', 1),
(3, 11, 3, 'Quando serei ativado na plataforma para começar a trabalhar?', '<p>Ap&oacute;s ter efetuado o cadastro corretamente e ter recebido o e-mail de confirma&ccedil;&atilde;o voc&ecirc; j&aacute; poder&aacute; come&ccedil;ar a atuar como nosso corretor parceiro.</p>\r\n', 1),
(4, 7, 1, 'Posso anunciar meu imóvel para Vender e Alugar ao mesmo tempo?', '<p>Sim, mas caso ele seja alugado antes de vender, voc&ecirc; ter&aacute; a op&ccedil;&atilde;o de manter ou retirar o an&uacute;ncio da venda do seu im&oacute;vel, caso opte por prosseguir com a venda, por lei deveremos dar prefer&ecirc;ncia para o inquilino que alugou o im&oacute;vel e em seguida caso o mesmo n&atilde;o queira, seguiremos com o processo de venda para o poss&iacute;vel interessado na compra.</p>\r\n', 1),
(5, 7, 2, 'Tem algum custo para cadastrar o meu imóvel?', '<p>N&atilde;o. O cadastro &eacute; gratuito, n&atilde;o realizamos nenhuma cobran&ccedil;a para a divulga&ccedil;&atilde;o do seu im&oacute;vel.</p>\r\n', 1),
(6, 7, 3, 'Existe alguma exclusividade ao me cadastrar?', '<p>N&atilde;o cobramos nenhuma exclusividade, por&eacute;m pode optar pela exclusividade e ter mais destaque no seu an&uacute;ncio, al&eacute;m de ter um desconto na taxa de administra&ccedil;&atilde;o.</p>\r\n', 1),
(7, 8, 1, 'Pergunta 1', '<p>Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus. Nulla quis lorem ut libero malesuada feugiat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh.</p>\r\n', 1),
(8, 8, 2, 'Pergunta 2', '<p>Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus. Nulla quis lorem ut libero malesuada feugiat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh.</p>\r\n', 1),
(9, 8, 3, 'Pergunta 3', '<p>Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus. Nulla quis lorem ut libero malesuada feugiat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh.</p>\r\n', 1),
(10, 11, 4, 'A Impera Real obriga o corretor a ter exclusividade?', '<p>N&atilde;o. O nosso intuito n&atilde;o &eacute; obrigar o corretor a trabalhar exclusivamente conosco, mas sim deixa-lo a vontade para otimizar seu tempo da melhor forma.</p>\r\n', 1),
(11, 11, 5, 'Qual o comissionamento do corretor para venda de imóveis na planta?', '<p>O corretor receber&aacute; <strong>1,7%</strong> l&iacute;quido de comissionamento sobre o valor final da venda do im&oacute;vel.<br />\r\n<br />\r\n* N&atilde;o descontamos nota da comiss&atilde;o do corretor.</p>\r\n', 1),
(12, 11, 6, 'Existe desconto de nota sobre a comissão?', '<p>N&atilde;o. A Impera Real n&atilde;o desconta a nota da comiss&atilde;o do corretor, ou seja, a comiss&atilde;o &eacute; integral.</p>\r\n', 1),
(13, 11, 7, 'Qual a regra de comissionamento da Impera Real?', '<p><strong>Para compra financiada:</strong> O valor da comiss&atilde;o devida s&oacute; ser&aacute; repassado ap&oacute;s o cliente finalizar a assinatura da compra do im&oacute;vel por completo, ou seja, assinar o contrato da construtora, assinar os formul&aacute;rios do Banco e por fim assinar o contrato de financiamento com o Banco. Assim que a Construtora efetuar o pagamento da Nota Fiscal para a Impera Real, faremos o repasse da comiss&atilde;o devida para o corretor da venda em at&eacute; 48 horas.</p>\r\n\r\n<p><strong>Imagem com o passo a passo do processo para recebimento da comiss&atilde;o:<img alt=\"\" src=\"https://www.ellosdesign.com/imperareal/admin/editor/ckeditor/uploads/images/6eaf4f0a35c69588122e21effaf6af20.png\" style=\"width: 100%;\" /></strong></p>\r\n\r\n<p><strong>Para compra &agrave; vista:</strong> O valor da comiss&atilde;o devida s&oacute; ser&aacute; repassado quando o cliente assinar o contrato com a Construtora e o cheque para pagamento do im&oacute;vel for liberado pela mesma. Feito isso em at&eacute; 48 horas estaremos repassando a comiss&atilde;o para o corretor da venda.</p>\r\n\r\n<p><strong>Imagem com o passo a passo do processo para recebimento da comiss&atilde;o:<img alt=\"\" src=\"https://www.ellosdesign.com/imperareal/admin/editor/ckeditor/uploads/images/259a11ecfa4334ee80e06b59ba22baec.png\" style=\"width: 100%;\" /></strong></p>\r\n\r\n<p><strong>Obs.:</strong> O repasse da comiss&atilde;o ser&aacute; feito exclusivamente para a conta cadastrada em nome do corretor. N&atilde;o repassamos comiss&atilde;o para a conta de terceiros, somente faremos para o corretor respons&aacute;vel pela venda.</p>\r\n', 1),
(14, 11, 8, 'Qual o tempo de recebimento da comissão para imóveis na planta?', '<p><strong>Para compra financiada:</strong> O repasse da comiss&atilde;o para o corretor &eacute; feita em at&eacute; 48 horas, ap&oacute;s a construtora realizar o pagamento da nota fiscal emitida pela a Impera Real.</p>\r\n\r\n<p><strong>Para compra &agrave; vista:</strong> O repasse da comiss&atilde;o para o corretor &eacute; feita em at&eacute; 48 horas, ap&oacute;s a libera&ccedil;&atilde;o do cheque pela Construtora.</p>\r\n', 1),
(15, 11, 9, 'Posso ficar tranquilo de que receberei a minha comissão quando o imóvel for vendido?', '<p>Sim, desde que a transa&ccedil;&atilde;o tenha sido realizada com o conhecimento da Impera Real, atrav&eacute;s do nosso sistema, e que todo o processo de compra e venda do im&oacute;vel tenha sido conclu&iacute;da corretamente.</p>\r\n', 1),
(16, 11, 10, 'Quais são os custos operacionais da Impera Real que justificam a cobrança de seus honorários?', '<p>S&atilde;o custos ligados &agrave; natureza de nossa opera&ccedil;&atilde;o, como a manuten&ccedil;&atilde;o da plataforma tecnol&oacute;gica, nossa estrutura, equipe, sistemas e nos investimentos em marketing.</p>\r\n', 1),
(17, 11, 11, 'Como funcionam as visitas e agendamentos com o cliente?', '<p><strong>Para visitas da plataforma:</strong> Ap&oacute;s efetuar o cadastro conosco, voc&ecirc; receber&aacute; lead de clientes agendados da nossa plataforma com o dia, local e hor&aacute;rio para atend&ecirc;-los.&nbsp;</p>\r\n\r\n<p><strong>Para visitas marcadas por voc&ecirc;:</strong> Voc&ecirc; tamb&eacute;m poder&aacute; agendar seus clientes interessados, atrav&eacute;s da nossa plataforma, desse jeito poderemos lhe ajudar com toda a parte burocr&aacute;tica deixando voc&ecirc; livre para fazer o que faz de melhor.</p>\r\n', 1),
(18, 11, 12, 'O que fazer após a visita?', '<p>O corretor dever&aacute; nos dar um retorno sobre o atendimento informando qual o grau de satisfa&ccedil;&atilde;o do cliente quanto ao im&oacute;vel visitado, isso serve para que possamos medir e lhe ajudar na conclus&atilde;o da venda.&nbsp;</p>\r\n\r\n<p>Caso o cliente tenha a inten&ccedil;&atilde;o de comprar o im&oacute;vel, o corretor dever&aacute; orienta-lo para que nos envie os documentos necess&aacute;rios para a avalia&ccedil;&atilde;o, atrav&eacute;s da nossa plataforma, ou o pr&oacute;prio corretor caso prefira pode colher a documenta&ccedil;&atilde;o do cliente e nos enviar diretamente.&nbsp;</p>\r\n\r\n<p><strong>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o de cr&eacute;dito, siga o link abaixo.&nbsp;</strong></p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(19, 11, 13, 'O que acontece se meu cliente contatar diretamente a Impera Real após a visita para fazer uma proposta?', '<p>Para que possamos fazer uma parceria de sucesso, pedimos para que voc&ecirc; informe o CPF do seu cliente no agendamento da visita, assim a Impera Real conseguir&aacute; identificar que ele est&aacute; vinculado a voc&ecirc; naquele Empreendimento. Neste caso, entraremos em contato com voc&ecirc; para evolu&ccedil;&atilde;o da negocia&ccedil;&atilde;o. Caso n&atilde;o tenha informado o CPF do cliente no agendamento, a Impera Real n&atilde;o conseguir&aacute; identificar que fizeram a visita juntos - por isso, destacamos a import&acirc;ncia de informar o n&uacute;mero do documento.&nbsp;</p>\r\n\r\n<p><strong>Por que o CPF?&nbsp;</strong></p>\r\n\r\n<p>N&uacute;mero &uacute;nico por pessoa (identifica&ccedil;&atilde;o) J&aacute; &eacute; costume fornecer em transa&ccedil;&otilde;es do dia- a-dia (ex.: nota fiscal ) &Uacute;nica forma de vincular o cliente ao corretor que agendou a visita.</p>\r\n', 1),
(20, 11, 14, 'As operações da Impera Real são feitas sem o corretor?', '<p>N&atilde;o. Muito pelo contr&aacute;rio, nossa plataforma digital &eacute; voltada para uma coopera&ccedil;&atilde;o m&uacute;tua, onde o corretor possa ter mais autonomia e liberdade, podendo trabalhar de casa ou de qualquer lugar se quiser, deixando de lado a necessidade imposta por imobili&aacute;rias tradicionais que os obrigam a estarem presentes constantemente.&nbsp;</p>\r\n\r\n<p>Assim acreditamos que podemos ajudar a melhorar e otimizar o seu tempo, melhorando o seu desempenho nas vendas e a sua qualidade de vida. Dessa forma voc&ecirc; ir&aacute; focar no que realmente &eacute; importante e deixar a parte burocr&aacute;tica por nossa conta.</p>\r\n', 1),
(21, 11, 15, 'Quem fica responsável pela assinatura do contrato de compra e venda dos imóveis na planta?', '<p>Pelo fato do contrato ser totalmente digital o cliente o receber&aacute; diretamente em seu<br />\r\ne-mail, logo ap&oacute;s a aprova&ccedil;&atilde;o do fluxo de pagamento e cr&eacute;dito.&nbsp;<br />\r\nA Impera Real notificar&aacute; o cliente quando o contrato for enviado.</p>\r\n', 1),
(22, 11, 16, 'Quais os documentos necessários para o cliente fazer análise de crédito?', '<p>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o de cr&eacute;dito, siga o link abaixo.&nbsp;</p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(23, 11, 17, 'Qual o papel do corretor durante a visita ao imóvel?', '<p>Ao saber qual im&oacute;vel dever&aacute; apresentar para o cliente em sua visita, orientamos o corretor a estudar sobre o empreendimento para que seja uma visita produtiva e de sucesso, para isso, dentro da nossa plataforma disponibilizamos todas as informa&ccedil;&otilde;es correspondentes ao im&oacute;vel selecionado.</p>\r\n\r\n<p>Durante a visita, caso haja alguma d&uacute;vida n&atilde;o hesite em consultar nossa plataforma para se informar e passar as informa&ccedil;&otilde;es corretas para o cliente.</p>\r\n', 1),
(24, 11, 18, 'Qual o tempo de resposta para uma análise de crédito?', '<p>Caso toda a documenta&ccedil;&atilde;o esteja completa e sem qualquer pend&ecirc;ncia, o retorno da avalia&ccedil;&atilde;o poder&aacute; ocorrer em at&eacute; <strong>48 horas</strong>.</p>\r\n', 1),
(25, 11, 19, 'Quais são as vantagens na parceria do corretor com a Impera Real?', '<p>Nosso objetivo &eacute; facilitar a sua vida e valorizar o seu trabalho, por isso disponibilizamos uma plataforma completamente online, com processos 100% digitais e diferenciados para uma melhor experi&ecirc;ncia tanto do cliente como a sua. Sem d&uacute;vida nenhuma, voc&ecirc; conseguir&aacute; ter mais tempo para voc&ecirc; e realizar mais vendas, pois estaremos fazendo toda a parte de marketing, divulga&ccedil;&atilde;o e agendamentos por voc&ecirc;.</p>\r\n\r\n<p><strong>Nossos Diferencias:</strong></p>\r\n\r\n<ul class=\"check\">\r\n	<li>Aqui voc&ecirc; n&atilde;o paga desconto de nota, ou seja, pagamos a sua comiss&atilde;o integral e l&iacute;quida de 1,7% sobre o valor final da venda.</li>\r\n	<li>Voc&ecirc; recebe clientes agendados mais direcionados</li>\r\n	<li>Voc&ecirc; pode cadastrar seu cliente para ser atendido por voc&ecirc;</li>\r\n	<li>Ter&aacute; acesso a v&aacute;rios empreendimentos para trabalhar</li>\r\n	<li>Poder&aacute; contar com o nosso suporte e plataforma para fechamento de vendas</li>\r\n	<li>Ter&aacute; liberdade para trabalhar de qualquer lugar</li>\r\n	<li>Poder&aacute; ganhar por indica&ccedil;&atilde;o de im&oacute;veis</li>\r\n</ul>\r\n', 1),
(26, 11, 20, 'Como vou saber que meu cliente já assinou com o banco?', '<p>N&oacute;s informaremos via e-mail quando o seu cliente finalizar o processo de compra assinando com o banco.</p>\r\n', 1),
(27, 11, 21, 'Para imóveis na planta, quem apresenta o fluxo de aprovação de compra do imóvel para o cliente?', '<p>Ap&oacute;s a avalia&ccedil;&atilde;o da an&aacute;lise de cr&eacute;dito, enviaremos o fluxo com a aprova&ccedil;&atilde;o contendo todas as informa&ccedil;&otilde;es detalhadamente para o e-mail do corretor e do cliente. Caso ache necess&aacute;rio, o corretor respons&aacute;vel pelo atendimento ter&aacute; total liberdade para entrar em contato com o cliente e explicar sobre o fluxo.</p>\r\n', 1),
(28, 11, 22, 'Onde envio a documentação do meu cliente para realizar a análise de crédito?', '<p>Na p&aacute;gina Saiba <a href=\"enviar-documentos\">como enviar seus documentos</a>, basta seguir o passo a passo.</p>\r\n', 1),
(29, 11, 23, 'Quem é o responsável por coordenar o envio dos documentos?', '<p>Caso o cliente tenha a inten&ccedil;&atilde;o de comprar o im&oacute;vel, o corretor dever&aacute; orienta-lo para que nos envie os documentos necess&aacute;rios para a avalia&ccedil;&atilde;o, atrav&eacute;s da nossa plataforma, ou o pr&oacute;prio corretor caso prefira pode colher a documenta&ccedil;&atilde;o do cliente e nos enviar diretamente.&nbsp;</p>\r\n\r\n<p><strong>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o de cr&eacute;dito, siga o link abaixo.&nbsp;</strong></p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(30, 11, 24, 'Com quanta antecedência devo agendar minha visita?', '<p>As visitas devem ser agendadas com pelo menos 1 dia de anteced&ecirc;ncia, assim nossa equipe consegue se organizar para oferecer a melhor experi&ecirc;ncia poss&iacute;vel a voc&ecirc; e seu cliente. Busque entender a fundo os atributos essenciais para seu cliente, sendo bem assertivo.</p>\r\n', 1),
(31, 10, 1, 'O que é a Impera Real?', '<p>Somos uma imobili&aacute;ria digital que busca uma melhor integra&ccedil;&atilde;o e parceria entre corretores, clientes e imobili&aacute;ria. Usamos a tecnologia para facilitar o trabalho do corretor e agilizar na conclus&atilde;o da venda. Nossa plataforma foi pensada e criada estrategicamente para ajudar a facilitar o dia a dia do corretor de im&oacute;veis, assim valorizamos seu tempo, dedica&ccedil;&atilde;o e esfor&ccedil;o.</p>\r\n', 1),
(32, 10, 2, 'Como faço para me cadastrar e ser um parceiro?', '<p>Basta efetuar o cadastro na nossa plataforma e aguardar nosso e-mail de confirma&ccedil;&atilde;o para a conclus&atilde;o. Em seguida voc&ecirc; far&aacute; parte do nosso time de vendas!</p>\r\n', 1),
(33, 10, 3, 'Quando serei ativado na plataforma para começar a trabalhar?', '<p>Ap&oacute;s ter efetuado o cadastro corretamente e ter recebido o e-mail de confirma&ccedil;&atilde;o voc&ecirc; j&aacute; poder&aacute; come&ccedil;ar a atuar como nosso corretor parceiro.</p>\r\n', 1),
(34, 10, 4, 'A Impera Real obriga o corretor a ter exclusividade?', '<p>N&atilde;o. O nosso intuito n&atilde;o &eacute; obrigar o corretor a trabalhar exclusivamente conosco, mas sim deixa-lo a vontade para otimizar seu tempo da melhor forma.</p>\r\n', 1),
(35, 10, 5, 'Como faço para indicar um imóvel?', '<p>Basta efetuar o cadastro na nossa plataforma e seguir o passo a passo para cadastrar ou indicar o im&oacute;vel.</p>\r\n', 1),
(36, 10, 6, 'Qual é a regra de comissionamento do corretor para imóveis usados?', '<p><strong>Comiss&atilde;o por venda: </strong>A comiss&atilde;o do corretor corresponde a 35% do valor total da corretagem.</p>\r\n\r\n<p><strong>Comiss&atilde;o por indica&ccedil;&atilde;o de im&oacute;veis:</strong> A comiss&atilde;o do corretor corresponde a 15% do valor total da corretagem. A comiss&atilde;o ser&aacute; repassada quando o im&oacute;vel indicado for vendido atrav&eacute;s da nossa plataforma.</p>\r\n\r\n<p>O valor atual da taxa de corretagem &eacute; de <strong>5%</strong> do valor de compra/venda do im&oacute;vel.</p>\r\n', 1),
(37, 10, 7, 'Existe desconto de nota sobre a comissão?', '<p>N&atilde;o. A Impera Real n&atilde;o desconta a nota da comiss&atilde;o do corretor, ou seja, a comiss&atilde;o &eacute; repassada no valor integral.</p>\r\n', 1),
(38, 10, 8, 'Qual a regra de tempo para recebimento da comissão?', '<p><strong>Para compra financiada:</strong> O valor da comiss&atilde;o devida s&oacute; ser&aacute; repassado ap&oacute;s o cliente finalizar a assinatura da compra do im&oacute;vel por completo, ou seja, assinar o contrato de compra e venda e o contrato de financiamento com o Banco. Assim que o propriet&aacute;rio repassar o valor devido referente &agrave; corretagem, faremos o repasse da comiss&atilde;o para o corretor da venda em at&eacute; 48 horas.</p>\r\n\r\n<p><strong>Para compra &agrave; vista:</strong> O valor da comiss&atilde;o devida s&oacute; ser&aacute; repassado quando o cliente assinar o contrato e efetuar a libera&ccedil;&atilde;o do pagamento referente ao servi&ccedil;o prestado. Feito isso em at&eacute; 48 horas estaremos repassando a comiss&atilde;o para o corretor da venda.</p>\r\n\r\n<p><strong>Obs.:</strong> O repasse da comiss&atilde;o ser&aacute; feito exclusivamente para a conta cadastrada em nome do corretor. N&atilde;o repassamos comiss&atilde;o para a conta de terceiros, somente faremos para o corretor respons&aacute;vel pela venda.</p>\r\n', 1),
(39, 10, 9, 'Posso ficar tranquilo de que receberei a minha comissão quando o imóvel for vendido?', '<p>Sim, desde que a transa&ccedil;&atilde;o tenha sido realizada com o conhecimento da Impera Real, atrav&eacute;s do nosso sistema, e que todo o processo de compra e venda do im&oacute;vel tenha sido conclu&iacute;da corretamente.</p>\r\n', 1),
(40, 10, 10, 'Quais são os custos operacionais da impera real que justificam a cobrança de seus honorários?', '<p>S&atilde;o custos ligados &agrave; natureza de nossa opera&ccedil;&atilde;o, como a manuten&ccedil;&atilde;o da plataforma tecnol&oacute;gica, nossa estrutura, equipe, sistemas e nos investimentos em marketing.</p>\r\n', 1),
(41, 10, 11, 'Como funcionam as visitas e agendamentos com o cliente?', '<p><strong>Para visitas da plataforma: </strong>Ap&oacute;s efetuar o cadastro conosco, voc&ecirc; receber&aacute; lead de clientes agendados da nossa plataforma com o dia, local e hor&aacute;rio para atend&ecirc;-los.</p>\r\n\r\n<p><strong>Para visitas marcadas por voc&ecirc;:</strong> Voc&ecirc; tamb&eacute;m poder&aacute; agendar seus clientes interessados, atrav&eacute;s da nossa plataforma, desse jeito poderemos lhe ajudar com toda a parte burocr&aacute;tica deixando voc&ecirc; livre para fazer o que faz de melhor.</p>\r\n', 1),
(42, 10, 12, 'O que fazer após a visita?', '<p>O corretor dever&aacute; nos dar um retorno sobre o atendimento informando qual o grau de satisfa&ccedil;&atilde;o do cliente quanto ao im&oacute;vel visitado, isso serve para que possamos medir e lhe ajudar na conclus&atilde;o da venda.</p>\r\n\r\n<p>Caso o cliente tenha a inten&ccedil;&atilde;o de comprar o im&oacute;vel, o corretor dever&aacute; orienta-lo para que nos envie os documentos necess&aacute;rios para a avalia&ccedil;&atilde;o, atrav&eacute;s da nossa plataforma, ou o pr&oacute;prio corretor caso prefira pode colher a documenta&ccedil;&atilde;o do cliente e nos enviar diretamente.</p>\r\n\r\n<p><strong>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o de cr&eacute;dito, siga o link abaixo.</strong></p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(43, 10, 13, 'O que acontece se meu cliente contatar diretamente a impera real após a visita para fazer uma proposta?', '<p>Para que possamos fazer uma parceria de sucesso, pedimos para que voc&ecirc; informe o CPF do seu cliente no agendamento da visita (quando o cliente for indicado por voc&ecirc;), assim a Impera Real conseguir&aacute; identificar que ele est&aacute; vinculado a voc&ecirc; naquele Im&oacute;vel. Neste caso, entraremos em contato com voc&ecirc; para evolu&ccedil;&atilde;o da negocia&ccedil;&atilde;o. Caso n&atilde;o tenha informado o CPF do cliente no agendamento, a Impera Real n&atilde;o conseguir&aacute; identificar que fizeram a visita juntos - por isso, destacamos a import&acirc;ncia de informar o n&uacute;mero do documento.<br />\r\n<br />\r\n<strong>Por que o CPF?</strong></p>\r\n\r\n<p>N&uacute;mero &uacute;nico por pessoa (identifica&ccedil;&atilde;o) J&aacute; &eacute; costume fornecer em transa&ccedil;&otilde;es do dia-a-dia (ex.: nota fiscal) &Uacute;nica forma de vincular o cliente ao corretor que agendou a visita.</p>\r\n', 1),
(44, 10, 14, 'As operações da Impera Real são feitas sem o corretor?', '<p>N&atilde;o. Muito pelo contr&aacute;rio, nossa plataforma digital &eacute; voltada para uma coopera&ccedil;&atilde;o m&uacute;tua, onde o corretor possa ter mais autonomia e liberdade, podendo trabalhar de casa ou de qualquer lugar se quiser, deixando de lado a necessidade imposta por imobili&aacute;rias tradicionais que os obrigam a estarem presentes constantemente.</p>\r\n\r\n<p>Assim acreditamos que podemos ajudar a melhorar e otimizar o seu tempo, melhorando o seu desempenho nas vendas e a sua qualidade de vida.&nbsp;</p>\r\n\r\n<p>Dessa forma voc&ecirc; ir&aacute; focar no que realmente &eacute; importante e deixar a parte burocr&aacute;tica por nossa conta.</p>\r\n', 1),
(45, 10, 15, 'Quem fica responsável pela assinatura do contrato de compra e venda dos imóveis?', '<p>Pelo fato do contrato ser totalmente digital o cliente o receber&aacute; diretamente em seu e-mail, logo ap&oacute;s a aprova&ccedil;&atilde;o do fluxo de pagamento e cr&eacute;dito.&nbsp;<br />\r\nO contrato &eacute; elaborado pelo nosso time jur&iacute;dico.&nbsp;<br />\r\nA Impera Real notificar&aacute; o cliente quando o contrato for enviado.</p>\r\n', 1),
(46, 10, 16, 'Quais os documentos necessários para o cliente fazer análise de crédito?', '<p><strong>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o de cr&eacute;dito, siga o link abaixo.</strong></p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(47, 10, 17, 'Qual o papel do corretor durante a visita ao imóvel?', '<p>Ao saber qual im&oacute;vel dever&aacute; apresentar para o cliente em sua visita, orientamos o corretor a estudar sobre o im&oacute;vel para que seja uma visita produtiva e de sucesso, para isso, dentro da nossa plataforma disponibilizamos todas as informa&ccedil;&otilde;es correspondentes ao im&oacute;vel selecionado.&nbsp;</p>\r\n\r\n<p>Durante a visita, caso haja alguma d&uacute;vida n&atilde;o hesite em consultar nossa plataforma para se informar e passar as informa&ccedil;&otilde;es corretas para o cliente.&nbsp;</p>\r\n', 1),
(48, 10, 18, 'Qual o tempo de resposta para uma análise de crédito?', '<p>Caso toda a documenta&ccedil;&atilde;o esteja completa e sem qualquer pend&ecirc;ncia, o retorno da avalia&ccedil;&atilde;o poder&aacute; ocorrer em at&eacute; 72 horas.</p>\r\n', 1),
(49, 10, 19, 'Quais são as vantagens na parceria do corretor com a Impera Real?', '<p>Nosso objetivo &eacute; facilitar a sua vida e valorizar o seu trabalho, por isso disponibilizamos uma plataforma completamente online, com processos 100% digitais e diferenciados para uma melhor experi&ecirc;ncia tanto do cliente como a sua.&nbsp;<br />\r\nSem d&uacute;vida nenhuma, voc&ecirc; conseguir&aacute; ter mais tempo para voc&ecirc; e realizar mais vendas, pois estaremos fazendo toda a parte de marketing, divulga&ccedil;&atilde;o e agendamentos por voc&ecirc;.&nbsp;</p>\r\n\r\n<p><strong>Nossos Diferencias:&nbsp;</strong></p>\r\n\r\n<ul class=\"check\">\r\n	<li>Aqui voc&ecirc; n&atilde;o paga desconto de nota, ou seja, pagamos a comiss&atilde;o de 35% sobre a corretagem de im&oacute;veis e 15% sobre a corretagem pela indica&ccedil;&atilde;o do im&oacute;vel quando ele for vendido</li>\r\n	<li>Voc&ecirc; recebe clientes agendados mais direcionados</li>\r\n	<li>Voc&ecirc; pode cadastrar seu cliente para ser atendido por voc&ecirc;&nbsp;</li>\r\n	<li>Ter&aacute; acesso a v&aacute;rios im&oacute;veis para trabalhar</li>\r\n	<li>Poder&aacute; contar com o nosso suporte e plataforma para fechamento de vendas</li>\r\n	<li>Ter&aacute; liberdade para trabalhar de qualquer lugar</li>\r\n	<li>Poder&aacute; ganhar por indica&ccedil;&atilde;o de im&oacute;veis</li>\r\n</ul>\r\n', 1),
(50, 10, 20, 'Como vou saber que meu cliente já assinou com o banco?', '<p>N&oacute;s informaremos via e-mail quando o seu cliente finalizar o processo de compra assinando com o banco.</p>\r\n', 1),
(51, 10, 21, 'Quem apresenta o fluxo de aprovação de crédito do imóvel para o cliente?', '<p>Ap&oacute;s a avalia&ccedil;&atilde;o do banco, enviaremos o fluxo com a aprova&ccedil;&atilde;o contendo todas as informa&ccedil;&otilde;es detalhadamente para o e-mail do corretor e do cliente.&nbsp;<br />\r\nCaso ache necess&aacute;rio, o corretor respons&aacute;vel pelo atendimento ter&aacute; total liberdade para entrar em contato com o cliente e explicar sobre o fluxo de aprova&ccedil;&atilde;o.</p>\r\n', 1),
(52, 10, 22, 'Onde envio a documentação do meu cliente para realizar a análise de crédito?', '<p>Na p&aacute;gina <a href=\"enviar-documentos\">Saiba como enviar seus documentos</a>, basta seguir o passo a passo.&nbsp;</p>\r\n', 1),
(53, 10, 23, 'Quem é o responsável por coordenar o envio dos documentos? ', '<p>Caso o cliente tenha a inten&ccedil;&atilde;o de comprar o im&oacute;vel, o corretor dever&aacute; orienta-lo para que nos envie os documentos necess&aacute;rios para a avalia&ccedil;&atilde;o, atrav&eacute;s da nossa plataforma, ou o pr&oacute;prio corretor caso prefira pode colher a documenta&ccedil;&atilde;o do cliente e nos enviar diretamente.&nbsp;</p>\r\n\r\n<p><strong>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o de cr&eacute;dito, siga o link abaixo.&nbsp;</strong></p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(54, 10, 24, 'Com quanta antecedência devo agendar minha visita? ', '<p>As visitas devem ser agendadas com pelo menos 1 dia de anteced&ecirc;ncia, assim nossa equipe consegue se organizar para oferecer a melhor experi&ecirc;ncia poss&iacute;vel a voc&ecirc; e &nbsp;a seu cliente. Busque entender a fundo os atributos essenciais para seu cliente, sendo bem assertivo.</p>\r\n', 1),
(55, 10, 25, 'Como a impera real garante o vínculo entre eu e o apartamento que indiquei? ', '<p>Ap&oacute;s cadastrar o im&oacute;vel no sistema da Impera Real, o corretor ser&aacute; informado se este mesmo im&oacute;vel j&aacute; foi cadastrado anteriormente por outro corretor ou pelo seu propriet&aacute;rio.&nbsp;<br />\r\nCaso seja o primeiro a fazer o cadastro do im&oacute;vel, pode ficar tranquilo que o v&iacute;nculo estar&aacute; garantido.&nbsp;</p>\r\n', 1),
(56, 10, 26, 'O que acontece se um proprietário indicar seu imóvel já cadastrado na impera real por um corretor? ', '<p>A Impera Real informar&aacute; ao propriet&aacute;rio que as negocia&ccedil;&otilde;es prosseguir&atilde;o via corretor.</p>\r\n', 1),
(57, 10, 27, 'Como formalizar a proposta do meu cliente?', '<p>Embora nosso time comercial esteja dispon&iacute;vel por telefone, todas as propostas devem ser preenchidas no formul&aacute;rio e enviadas para o e-mail propostaimperareal@gmail.com</p>\r\n\r\n<p>Baixe o formul&aacute;rio na p&aacute;gina <a href=\"enviar-documentos\">Saiba como enviar seus documentos</a>.</p>\r\n', 1),
(58, 10, 28, 'Quem confecciona a minuta do ccv e quanto tempo leva? ', '<p>A responsabilidade do CCV &eacute; da Impera Real. E quem prepara o CCV &eacute; o time jur&iacute;dico da Impera; em m&eacute;dia, levamos aproximadamente 7 dias. Em paralelo, acontecer&aacute; a an&aacute;lise da documenta&ccedil;&atilde;o pelo Banco - este tempo poder&aacute; variar conforme necessidade de complementos / esclarecimentos.</p>\r\n', 1),
(59, 12, 1, 'O que é a Impera Real?', '<p>Somos uma imobili&aacute;ria digital que busca uma melhor integra&ccedil;&atilde;o e parceria entre<br />\r\ncorretores, clientes e imobili&aacute;ria. Usamos a tecnologia para facilitar o trabalho do<br />\r\ncorretor e agilizar na conclus&atilde;o da venda. Nossa plataforma foi pensada e criada<br />\r\nestrategicamente para ajudar a facilitar o dia a dia do corretor de im&oacute;veis, assim<br />\r\nvalorizamos seu tempo, dedica&ccedil;&atilde;o e esfor&ccedil;o.</p>\r\n', 1),
(60, 12, 2, 'Como faço para me cadastrar e ser um parceiro?', '<p>Basta efetuar o cadastro na nossa plataforma e aguardar nosso e-mail de confirma&ccedil;&atilde;o para a conclus&atilde;o. Em seguida voc&ecirc; far&aacute; parte do nosso time!</p>\r\n', 1),
(61, 12, 3, 'Quando serei ativado na plataforma para começar a trabalhar?', '<p>Ap&oacute;s ter efetuado o cadastro corretamente e ter recebido o e-mail de confirma&ccedil;&atilde;o, voc&ecirc; j&aacute; poder&aacute; come&ccedil;ar a atuar como nosso corretor parceiro.</p>\r\n', 1),
(62, 12, 4, 'A impera real obriga o corretor a ter exclusividade?', '<p>N&atilde;o. O nosso intuito n&atilde;o &eacute; obrigar o corretor a trabalhar exclusivamente conosco, mas sim deixa-lo a vontade para otimizar seu tempo da melhor forma.</p>\r\n', 1),
(63, 12, 5, 'Como faço para indicar um imóvel?', '<p>Basta efetuar o cadastro na nossa plataforma e seguir o passo a passo para cadastrar ou indicar o im&oacute;vel.</p>\r\n', 1),
(64, 12, 6, 'Qual é a regra de comissionamento do corretor para locação?', '<p><strong>Comiss&atilde;o por Loca&ccedil;&atilde;o: </strong>A comiss&atilde;o do corretor corresponde a 30% do valor do primeiro aluguel.&nbsp;</p>\r\n\r\n<p>A comiss&atilde;o ser&aacute; repassada somente quando o im&oacute;vel apresentado pelo corretor for alugado pelo inquilino.&nbsp;</p>\r\n\r\n<p><strong>Comiss&atilde;o por indica&ccedil;&atilde;o de im&oacute;veis:</strong> A comiss&atilde;o do corretor corresponde a <strong>20%</strong> do valor do primeiro aluguel.&nbsp;</p>\r\n\r\n<p>A comiss&atilde;o ser&aacute; repassada somente quando o im&oacute;vel for alugado atrav&eacute;s da nossa plataforma.</p>\r\n', 1),
(65, 12, 7, 'Existe desconto de nota sobre a comissão?', '<p>N&atilde;o. A Impera Real n&atilde;o desconta a nota da comiss&atilde;o do corretor, ou seja, a comiss&atilde;o &eacute; repassada no valor integral.</p>\r\n', 1),
(66, 12, 8, 'Qual a regra de tempo para recebimento da comissão? ', '<p>A comiss&atilde;o ser&aacute; repassada todo dia 12 de cada m&ecirc;s, posterior &agrave; loca&ccedil;&atilde;o do im&oacute;vel.&nbsp;</p>\r\n\r\n<p><strong>Obs.: </strong>O repasse da comiss&atilde;o ser&aacute; feito exclusivamente para a conta cadastrada em nome do corretor. N&atilde;o repassamos comiss&atilde;o para a conta de terceiros, somente faremos para o corretor respons&aacute;vel pela venda.</p>\r\n', 1),
(67, 12, 9, 'Posso ficar tranquilo de que receberei a minha comissão quando o imóvel for alugado?', '<p>Sim, desde que a transa&ccedil;&atilde;o tenha sido realizada com o conhecimento da Impera Real, atrav&eacute;s do nosso sistema, e que todo o processo de loca&ccedil;&atilde;o do im&oacute;vel tenha sido conclu&iacute;do corretamente.</p>\r\n', 1),
(68, 12, 10, 'Quais são os custos operacionais da impera real que justificam a cobrança de seus honorários?', '<p>S&atilde;o custos ligados &agrave; natureza de nossa opera&ccedil;&atilde;o, como a manuten&ccedil;&atilde;o da plataforma tecnol&oacute;gica, nossa estrutura, equipe, sistemas e nos investimentos em marketing.</p>\r\n', 1),
(69, 12, 11, 'Como funcionam as visitas e agendamentos com o cliente?', '<p><strong>Para visitas da plataforma: </strong>Ap&oacute;s efetuar o cadastro conosco, voc&ecirc; receber&aacute; lead de clientes agendados da nossa plataforma com o dia, local e hor&aacute;rio para atend&ecirc;-los.</p>\r\n\r\n<p><strong>Para visitas marcadas por voc&ecirc;:</strong> Voc&ecirc; tamb&eacute;m poder&aacute; agendar seus clientes interessados, atrav&eacute;s da nossa plataforma, desse jeito poderemos lhe ajudar com toda a parte burocr&aacute;tica deixando voc&ecirc; livre para fazer o que faz de melhor.&nbsp;</p>\r\n', 1),
(70, 12, 12, 'O que fazer após a visita?', '<p>O corretor dever&aacute; nos dar um retorno sobre o atendimento informando qual o grau de satisfa&ccedil;&atilde;o do cliente quanto ao im&oacute;vel visitado, isso serve para que possamos medir e lhe ajudar na conclus&atilde;o da loca&ccedil;&atilde;o.&nbsp;</p>\r\n\r\n<p>Caso o cliente tenha a inten&ccedil;&atilde;o de alugar o im&oacute;vel, o corretor dever&aacute; orienta-lo para que nos envie os documentos necess&aacute;rios para a avalia&ccedil;&atilde;o, atrav&eacute;s da nossa plataforma, ou o pr&oacute;prio corretor caso prefira pode colher a documenta&ccedil;&atilde;o do cliente e nos enviar diretamente.&nbsp;</p>\r\n\r\n<p><strong>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o de cr&eacute;dito, siga o link abaixo.</strong></p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(71, 12, 13, 'O que acontece se meu cliente contatar diretamente a impera real após a visita para fazer uma proposta? ', '<p>Para que possamos fazer uma parceria de sucesso, pedimos para que voc&ecirc; informe o CPF do seu cliente no agendamento da visita (quando o cliente for indicado por voc&ecirc;), assim a Impera Real conseguir&aacute; identificar que ele est&aacute; vinculado a voc&ecirc; naquele Im&oacute;vel. Neste caso, entraremos em contato com voc&ecirc; para evolu&ccedil;&atilde;o da negocia&ccedil;&atilde;o. Caso n&atilde;o tenha informado o CPF do cliente no agendamento, a Impera Real n&atilde;o conseguir&aacute; identificar que fizeram a visita juntos - por isso, destacamos a import&acirc;ncia de informar o n&uacute;mero do documento.</p>\r\n\r\n<p><strong>Por que o CPF?</strong></p>\r\n\r\n<p>N&uacute;mero &uacute;nico por pessoa (identifica&ccedil;&atilde;o), j&aacute; &eacute; costume fornecer em transa&ccedil;&otilde;es do dia-a-dia (ex.: nota fiscal) &Uacute;nica forma de vincular o cliente ao corretor que agendou a visita.</p>\r\n', 1),
(72, 12, 14, 'As operações da impera real são feitas sem o corretor?', '<p>N&atilde;o. Muito pelo contr&aacute;rio, nossa plataforma digital &eacute; voltada para uma coopera&ccedil;&atilde;o m&uacute;tua, onde o corretor possa ter mais autonomia e liberdade, podendo trabalhar de casa ou de qualquer lugar se quiser, deixando de lado a necessidade imposta por imobili&aacute;rias tradicionais que os obrigam a estarem presentes constantemente.&nbsp;</p>\r\n\r\n<p>Assim acreditamos que podemos ajudar a melhorar e otimizar o seu tempo, melhorando o seu desempenho nas vendas e a sua qualidade de vida.&nbsp;<br />\r\nDessa forma voc&ecirc; ir&aacute; focar no que realmente &eacute; importante e deixar a parte burocr&aacute;tica por nossa conta.</p>\r\n', 1),
(73, 12, 15, 'Quem fica responsável pela assinatura do contrato de locação dos imóveis?', '<p>Pelo fato do contrato ser totalmente digital o cliente o receber&aacute; diretamente em seu e-mail, logo ap&oacute;s a aprova&ccedil;&atilde;o da nossa an&aacute;lise.&nbsp;<br />\r\nO contrato &eacute; elaborado pelo nosso time jur&iacute;dico.&nbsp;<br />\r\nA Impera Real notificar&aacute; o cliente quando o contrato for enviado.</p>\r\n', 1),
(74, 12, 16, 'Quais os documentos necessários para fazer a avaliação do cliente?', '<p>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o, siga o link abaixo.&nbsp;</p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(75, 12, 17, 'O cliente pode alugar o imóvel através de fiador?', '<p>N&atilde;o. N&atilde;o aceitamos fiador para a loca&ccedil;&atilde;o de im&oacute;veis.</p>\r\n', 1),
(76, 12, 18, 'Qual a modalidade para o cliente alugar seu imóvel na impera?', '<p>Trabalhamos com a CredPago. Logo o cliente ter&aacute; mais facilidade e garantias para alugar o seu im&oacute;vel com mais seguran&ccedil;a e agilidade.</p>\r\n', 1),
(77, 12, 19, 'Qual o papel do corretor durante a visita ao imóvel?', '<p>Ao saber qual im&oacute;vel dever&aacute; apresentar para o cliente em sua visita, orientamos o corretor a estudar sobre o im&oacute;vel para que seja uma visita produtiva e de sucesso, para isso, dentro da nossa plataforma disponibilizamos todas as informa&ccedil;&otilde;es correspondentes ao im&oacute;vel selecionado.&nbsp;<br />\r\nDurante a visita, caso haja alguma d&uacute;vida n&atilde;o hesite em consultar nossa plataforma para se informar e passar as informa&ccedil;&otilde;es corretas para o cliente.</p>\r\n', 1),
(78, 12, 20, 'Qual o tempo de resposta para a avaliação do cliente?', '<p>Caso toda a documenta&ccedil;&atilde;o esteja completa e sem qualquer pend&ecirc;ncia, o retorno da avalia&ccedil;&atilde;o poder&aacute; ocorrer em at&eacute; 48 horas.</p>\r\n', 1),
(79, 12, 21, 'Quais são as vantagens na parceria do corretor com a impera real?', '<p>Nosso objetivo &eacute; facilitar a sua vida e valorizar o seu trabalho, por isso disponibilizamos uma plataforma completamente online, com processos 100% digitais e diferenciados para uma melhor experi&ecirc;ncia tanto do cliente como a sua.&nbsp;<br />\r\nSem d&uacute;vida nenhuma, voc&ecirc; conseguir&aacute; ter mais tempo para voc&ecirc; e realizar mais vendas, pois estaremos fazendo toda a parte de marketing, divulga&ccedil;&atilde;o e agendamentos por voc&ecirc;.&nbsp;</p>\r\n\r\n<p><strong>Nossos Diferencias:&nbsp;</strong></p>\r\n\r\n<ul class=\"check\">\r\n	<li>Aqui voc&ecirc; n&atilde;o paga desconto de nota, ou seja, pagamos a comiss&atilde;o de 30% sobre o valor da primeira loca&ccedil;&atilde;o do im&oacute;vel e 20% pela indica&ccedil;&atilde;o do im&oacute;vel quando ele for alugado&nbsp;</li>\r\n	<li>Voc&ecirc; recebe clientes agendados mais direcionados</li>\r\n	<li>Voc&ecirc; pode cadastrar seu cliente para ser atendido por voc&ecirc;&nbsp;</li>\r\n	<li>Ter&aacute; acesso a v&aacute;rios im&oacute;veis para trabalhar</li>\r\n	<li>Poder&aacute; contar com o nosso suporte e plataforma para o fechamento da loca&ccedil;&atilde;o</li>\r\n	<li>Ter&aacute; liberdade para trabalhar de qualquer lugar</li>\r\n	<li>Poder&aacute; ganhar por indica&ccedil;&atilde;o de im&oacute;veis</li>\r\n</ul>\r\n', 1),
(80, 12, 22, 'Onde envio a documentação para realizar a avaliação do meu cliente?', '<p>Na p&aacute;gina <a href=\"enviar-documentos\">Saiba como enviar seus documentos</a>, basta seguir o passo a passo.&nbsp;</p>\r\n', 1),
(81, 12, 23, 'Quem é o responsável por coordenar o envio dos documentos? ', '<p>Caso o cliente tenha a inten&ccedil;&atilde;o de alugar o im&oacute;vel, o corretor dever&aacute; orienta-lo para que nos envie os documentos necess&aacute;rios para a avalia&ccedil;&atilde;o, atrav&eacute;s da nossa plataforma, ou o pr&oacute;prio corretor caso prefira pode colher a documenta&ccedil;&atilde;o do cliente e nos enviar diretamente.&nbsp;</p>\r\n\r\n<p><strong>Caso tenha d&uacute;vida de quais documentos o cliente dever&aacute; enviar para a sua avalia&ccedil;&atilde;o, siga o link abaixo.&nbsp;</strong></p>\r\n\r\n<p><a href=\"enviar-documentos\">Saiba como enviar seus documentos</a></p>\r\n', 1),
(82, 12, 24, 'Com quanta antecedência devo agendar minha visita?', '<p>As visitas devem ser agendadas com pelo menos 1 dia de anteced&ecirc;ncia, assim nossa equipe consegue se organizar para oferecer a melhor experi&ecirc;ncia poss&iacute;vel a voc&ecirc; e &nbsp;a seu cliente. Busque entender a fundo os atributos essenciais para seu cliente, sendo bem assertivo.</p>\r\n', 1),
(83, 12, 25, 'Como a impera real garante o vínculo entre eu e o apartamento que indiquei? ', '<p>Ap&oacute;s cadastrar o im&oacute;vel no sistema da Impera Real, o corretor ser&aacute; informado se este mesmo im&oacute;vel j&aacute; foi cadastrado anteriormente por outro corretor ou pelo seu propriet&aacute;rio.&nbsp;<br />\r\nCaso seja o primeiro a fazer o cadastro do im&oacute;vel, pode ficar tranquilo que o v&iacute;nculo estar&aacute; garantido.&nbsp;</p>\r\n', 1),
(84, 12, 26, 'O que acontece se um proprietário indicar seu imóvel já cadastrado na impera real por um corretor? ', '<p>A Impera Real informar&aacute; ao propriet&aacute;rio que as negocia&ccedil;&otilde;es prosseguir&atilde;o pelo seu corretor.</p>\r\n', 1),
(85, 12, 27, 'Quem confecciona o contrato de locação e quanto tempo leva? ', '<p>A responsabilidade do Contrato de Loca&ccedil;&atilde;o &eacute; da Impera Real. E quem prepara o Contrato &eacute; o time jur&iacute;dico da Impera; em m&eacute;dia, levamos aproximadamente 2 dias.</p>\r\n', 1),
(86, 7, 4, 'Se eu optar pela exclusividade, qual é o prazo de duração?', '<p>O prazo de exclusividade com a Impera Real &eacute; de 3 meses para loca&ccedil;&atilde;o e 6 meses para im&oacute;veis a venda, caso o seu im&oacute;vel n&atilde;o seja alugado ou vendido nesse per&iacute;odo voc&ecirc; poder&aacute; anunciar em outras plataformas.</p>\r\n', 1),
(87, 7, 5, 'Preciso ir ao cartório para autenticar o contrato de Locação?', '<p>N&atilde;o. Nosso contrato &eacute; 100% digital e v&aacute;lido juridicamente.</p>\r\n', 1),
(88, 22, 1, 'RG e CPF ou CNH', '<p>O documento solicitado deve estar dentro da data de validade.</p>\r\n', 1),
(89, 22, 2, 'Certidão de nascimento ou casamento', '<p>Neste caso dever&aacute; ser enviada a <strong>Certid&atilde;o de nascimento</strong> para solteiros, <strong>Certid&atilde;o de uni&atilde;o est&aacute;vel</strong> para Uni&atilde;o Est&aacute;vel e <strong>Certid&atilde;o de casamento</strong> em Regime de Bens.</p>\r\n\r\n<p><strong>Obs.: </strong>Se voc&ecirc; possuir <strong>Certid&atilde;o de casamento </strong>ou <strong>Certid&atilde;o de Uni&atilde;o est&aacute;vel</strong>, dever&aacute; encaminhar a documenta&ccedil;&atilde;o completa do seu c&ocirc;njuge.</p>\r\n', 1),
(90, 22, 3, 'Comprovante de endereço', '<p>O documento deve ter no m&aacute;ximo 60 dias da data de emiss&atilde;o.<br />\r\n<strong>Ser&atilde;o aceitos os seguintes comprovantes: </strong>Conta de &aacute;gua, Conta de Luz, Conta de g&aacute;s, Conta de telefone, Fatura de cart&atilde;o de cr&eacute;dito e Conta de tv por assinatura.</p>\r\n', 1),
(91, 22, 4, 'Comprovante de Renda', '<p><strong>Renda Formal (CLT):</strong> 3 &uacute;ltimos contracheques.</p>\r\n\r\n<p><strong>Renda Informal (Profissional liberal/Aut&ocirc;nomo): </strong>6 &uacute;ltimos extratos banc&aacute;rios da conta corrente de pessoa f&iacute;sica.</p>\r\n\r\n<p><strong>Obs.: </strong>N&atilde;o ser&aacute; aceito extrato banc&aacute;rio da conta de pessoa jur&iacute;dica.&nbsp;</p>\r\n\r\n<p><strong>Obs&sup2;: </strong>O extrato banc&aacute;rio deve conter nome completo do titular da conta, n&uacute;mero da ag&ecirc;ncia e conta corrente.</p>\r\n\r\n<p><strong>Aposentado/Pensionista: </strong>3 &uacute;ltimos extratos banc&aacute;rio pessoa f&iacute;sica + 3 &uacute;ltimos Extratos do INSS ou Institui&ccedil;&atilde;o Pagadora.</p>\r\n\r\n<p><strong>Recibo de Pens&atilde;o: </strong>3 &uacute;ltimos meses completos.</p>\r\n\r\n<p><strong>Obs.: </strong>Caso n&atilde;o possua seu extrato, acesse o site do INSS no link abaixo.</p>\r\n\r\n<p><strong>Link Site INSS: </strong><a href=\"https://www.gov.br/inss/pt-br\">https://www.gov.br/inss/pt-br</a></p>\r\n', 1),
(92, 22, 5, 'Carteira de trabalho', '<p>Dever&aacute; ser enviada as duas primeiras p&aacute;ginas (foto e qualifica&ccedil;&atilde;o civil); Todos os registros de trabalho e Anota&ccedil;&otilde;es gerais.</p>\r\n\r\n<p><strong>Obs.: </strong>Caso n&atilde;o possua carteira de trabalho, poder&aacute; baixar online pelo <strong>App</strong> ou <strong>Site</strong> do <strong>MTE</strong>.&nbsp;</p>\r\n\r\n<p><strong>Link App MTE: </strong><a href=\"https://play.google.com/store/apps/details?id=br.gov.dataprev.carteiradigital\">https://play.google.com/store/apps/details?id=br.gov.dataprev.carteiradigital</a></p>\r\n\r\n<p><strong>Link Site MTE:</strong>&nbsp;<a href=\"https://servicos.mte.gov.br/#/loginfailed/redirect=\">https://servicos.mte.gov.br/#/loginfailed/redirect=</a></p>\r\n', 1),
(93, 22, 6, 'Extrato do FGTS', '<p>Dever&aacute; ser enviado os Extratos completos de todas as Contas Ativas.</p>\r\n\r\n<p><strong>Obs.: </strong>Ser&aacute; necess&aacute;rio que voc&ecirc; ative a <strong>autoriza&ccedil;&atilde;o via aplicativo do FGTS</strong> para consulta do saldo do FGTS pelas institui&ccedil;&otilde;es financeiras.</p>\r\n\r\n<p>Siga o passo a passo do link abaixo e fa&ccedil;a seu cadastro para ativar a autoriza&ccedil;&atilde;o.</p>\r\n\r\n<p><strong>Link App FGTS:&nbsp;</strong><a href=\"https://play.google.com/store/apps/details?id=br.gov.caixa.fgts.trabalhador\">https://play.google.com/store/apps/details?id=br.gov.caixa.fgts.trabalhador</a></p>\r\n', 1),
(94, 22, 7, 'Certidão de nascimento do dependente ou Fator Social', '<p>Considera-se dependentes para efeito do fator social os seguintes casos: Filho menor de <strong>21 anos</strong> &ndash; Enviar certid&atilde;o de nascimento.</p>\r\n\r\n<p>Filho maior de <strong>21 anos</strong> e menor de <strong>24 anos</strong>, que estiver cursando faculdade &ndash; Enviar comprovante de escolaridade.</p>\r\n\r\n<p><strong>Obs.: </strong>O Dependente/Fator Social &eacute; solicitado apenas para an&aacute;lise de im&oacute;veis do <strong>Programa Casa Verde e Amarela</strong>.</p>\r\n', 1),
(95, 22, 8, 'Declaração do Imposto de Renda', '<p>Caso declare Imposto de Renda, dever&aacute; enviar a declara&ccedil;&atilde;o do ano base contendo: <strong>Corpo do Imposto de Renda</strong> (s&atilde;o de 5 a 7 p&aacute;ginas) e <strong>Recibo do Imposto de Renda</strong> (s&atilde;o 2 p&aacute;ginas).</p>\r\n', 1),
(96, 23, 1, 'RG e CPF ou CNH', '<p>O documento solicitado deve estar dentro da data de validade.</p>\r\n', 1),
(97, 23, 2, 'Comprovante de Renda', '<p><strong>Renda Formal (CLT): </strong>3 &uacute;ltimos contracheques.</p>\r\n\r\n<p><strong>Renda Informal (Profissional liberal/Aut&ocirc;nomo): </strong>6 &uacute;ltimos extratos banc&aacute;rios da conta corrente de pessoa f&iacute;sica.</p>\r\n\r\n<p><strong>Obs.: </strong>N&atilde;o ser&aacute; aceito extrato banc&aacute;rio da conta de pessoa jur&iacute;dica.&nbsp;</p>\r\n\r\n<p><strong>Obs&sup2;: </strong>O extrato banc&aacute;rio deve conter nome completo do titular da conta, n&uacute;mero da ag&ecirc;ncia e conta corrente.</p>\r\n\r\n<p><strong>Aposentado/Pensionista: </strong>3 &uacute;ltimos extratos banc&aacute;rio pessoa f&iacute;sica + 3 &uacute;ltimos Extratos do INSS ou Institui&ccedil;&atilde;o Pagadora.</p>\r\n\r\n<p><strong>Recibo de Pens&atilde;o:</strong> 3 &uacute;ltimos meses completos.</p>\r\n\r\n<p><strong>Obs.: </strong>Caso n&atilde;o possua seu extrato, acesse o site do INSS no link abaixo.</p>\r\n\r\n<p><strong>Link Site INSS: </strong><a href=\"https://www.gov.br/inss/pt-br\">https://www.gov.br/inss/pt-br</a></p>\r\n', 1),
(98, 23, 3, 'Comprovante de endereço', '<p>O documento deve ter no m&aacute;ximo 60 dias da data de emiss&atilde;o. <strong>Ser&atilde;o aceitos os seguintes comprovantes: </strong>Conta de &aacute;gua, Conta de Luz, Conta de g&aacute;s, Conta de telefone, Fatura de cart&atilde;o de cr&eacute;dito e Conta de tv por assinatura.</p>\r\n', 1);
INSERT INTO `paginas_faq` (`id`, `pagina_id`, `ordem_exibicao`, `titulo`, `texto`, `status`) VALUES
(99, 23, 4, 'Carteira de trabalho', '<p>Dever&aacute; ser enviada as duas primeiras p&aacute;ginas (foto e qualifica&ccedil;&atilde;o civil); Todos os registros de trabalho e Anota&ccedil;&otilde;es gerais.</p>\r\n\r\n<p><strong>Obs.: </strong>Caso n&atilde;o possua carteira de trabalho, poder&aacute; baixar online pelo <strong>App</strong> ou <strong>Site</strong> do <strong>MTE</strong>.</p>\r\n\r\n<p><strong>Link App MTE: </strong><a href=\"https://play.google.com/store/apps/details?id=br.gov.dataprev.carteiradigital\">https://play.google.com/store/apps/details?id=br.gov.dataprev.carteiradigital</a></p>\r\n\r\n<p><strong>Link Site MTE: </strong><a href=\"https://servicos.mte.gov.br/#/loginfailed/redirect=\">https://servicos.mte.gov.br/#/loginfailed/redirect=</a></p>\r\n', 1),
(100, 20, 1, 'Onde devo enviar minha documentação?', '<p>Atrav&eacute;s da nossa plataforma. No in&iacute;cio e no final da p&aacute;gina clique no bot&atilde;o <strong>Enviar documentos</strong>.</p>\r\n', 1),
(101, 20, 2, 'Qual o tempo de resposta da análise para comprar um imóvel?', '<p>Se toda a documenta&ccedil;&atilde;o estiver completa o tempo de resposta leva entre <strong>48</strong> a <strong>72</strong> horas. Assim que a avalia&ccedil;&atilde;o for conclu&iacute;da entraremos imediatamente em contato para informar tudo a respeito da aprova&ccedil;&atilde;o.</p>\r\n', 1),
(102, 20, 3, 'Qual o tempo de resposta da análise para Locação de imóveis?', '<p>Leva entorno de 24 horas para aprova&ccedil;&atilde;o, podendo ser no mesmo dia.</p>\r\n', 1),
(103, 20, 4, 'Preciso de fiador ou depósito caução para alugar um imóvel?', '<p>N&atilde;o. Aqui na <strong>Impera Real </strong>n&atilde;o trabalhamos com fiador ou dep&oacute;sito cau&ccedil;&atilde;o.&nbsp;<br />\r\nTrabalhamos em parceria com a <strong>CredPago</strong>, uma seguradora de excel&ecirc;ncia no mercado.</p>\r\n', 1),
(104, 20, 5, 'Como é feita a análise de crédito?', '<p><strong>Para venda</strong><br />\r\nEm caso de financiamento a an&aacute;lise &eacute; feita atrav&eacute;s dos bancos.&nbsp;<br />\r\nTempo de resposta varia entre 48 a 72 horas.</p>\r\n\r\n<p><strong>Para loca&ccedil;&atilde;o</strong><br />\r\nA an&aacute;lise de Cr&eacute;dito &eacute; feita atrav&eacute;s da CredPago, uma seguradora de excel&ecirc;ncia no mercado que facilita e agiliza todo esse processo para seguirmos com a loca&ccedil;&atilde;o rapidamente.</p>\r\n', 1),
(105, 20, 6, 'Como ficarei sabendo do resultado da minha avaliação?', '<p>N&oacute;s entraremos em contato imediatamente ap&oacute;s termos a sua aprova&ccedil;&atilde;o.</p>\r\n', 1),
(106, 20, 7, 'Por que eu tenho que renovar anualmente o meu seguro fiança?', '<p>A validade do seguro fian&ccedil;a &eacute; de 1 ano. Logo precisa ser renovado a cada 12 meses.</p>\r\n', 1),
(107, 20, 8, 'Como ter uma avaliação de crédito positiva na Locação de imóveis?', '<p>Possuir uma&nbsp;<strong>renda mensal bruta somando pelo menos 2,5 vezes</strong>&nbsp;o valor total do im&oacute;vel (aluguel, condom&iacute;nio, IPTU e seguro-inc&ecirc;ndio).</p>\r\n\r\n<p>Ter um bom <strong>score</strong> no <strong>Serasa</strong> e <strong>Boa Vista</strong>.&nbsp;</p>\r\n\r\n<p>Caso voc&ecirc; n&atilde;o tenha a renda necess&aacute;ria poder&aacute; adicionar at&eacute; 3 pessoas para fazerem parte do contrato com voc&ecirc;.&nbsp;<br />\r\nElas n&atilde;o precisam necessariamente morar no im&oacute;vel, mas podem ajudar a complementar a renda para uma boa aprova&ccedil;&atilde;o.</p>\r\n', 1),
(108, 20, 9, 'O que fazer em caso de uma avaliação negativa na Compra do imóvel?', '<p>Caso n&atilde;o seja aprovado de imediato voc&ecirc; poder&aacute; tentar novamente uma nova avalia&ccedil;&atilde;o posteriormente, por&eacute;m ap&oacute;s a sua an&aacute;lise n&oacute;s entraremos em contato para explicar os poss&iacute;veis motivos da negativa&ccedil;&atilde;o. &nbsp;</p>\r\n\r\n<p>Assim dependendo do motivo voc&ecirc; poder&aacute; acertar as pend&ecirc;ncias para uma melhor aprova&ccedil;&atilde;o no futuro.</p>\r\n', 1),
(109, 20, 10, 'O que fazer em caso de uma avaliação negativa na Locação de imóvel?', '<p>Voc&ecirc; pode adicionar at&eacute; 3 pessoas para fazerem parte do contrato.&nbsp;<br />\r\nElas n&atilde;o precisam necessariamente morar no im&oacute;vel, mas podem ajudar a complementar a renda.</p>\r\n\r\n<p>Caso a sua avalia&ccedil;&atilde;o tenha sido negativa mesmo somando renda, voc&ecirc; poder&aacute; excluir ou alterar os locat&aacute;rios que foram considerados na avalia&ccedil;&atilde;o e tentar novamente.</p>\r\n', 1),
(110, 25, 1, 'O que é o Programa Casa Verde e Amarela', '<p>&Eacute; o novo programa do Governo Federal que substitui o programa minha casa minha vida criado em 2009.</p>\r\n\r\n<p>O objetivo do novo programa &eacute; trazer melhorias que facilitem o acesso da popula&ccedil;&atilde;o a moradias atrav&eacute;s da diminui&ccedil;&atilde;o das taxas de juros para financiamento.</p>\r\n', 1),
(111, 25, 2, ' Quais as vantagens do Programa Casa Verde e Amarela?', '<p>Os im&oacute;veis s&atilde;o mais baratos.</p>\r\n\r\n<p>O programa tem a menor taxa de juros do mercado.</p>\r\n\r\n<p>Tem o maior prazo de financiamento do mercado (at&eacute; 360 meses).</p>\r\n\r\n<p>A entrada &eacute; mais facilitada.</p>\r\n\r\n<p>Tem o subs&iacute;dio do Governo (Aquele desconto que facilita e muito as condi&ccedil;&otilde;es).</p>\r\n\r\n<p>Pode usar seu FGTS como entrada.</p>\r\n', 1),
(112, 25, 5, 'Se eu for Casado (a) ou tiver União Estável, posso comprar sozinho (a) no programa Casa Verde e Amarela?', '<p>N&atilde;o. Pessoas que s&atilde;o Casadas ou que tenham Uni&atilde;o Est&aacute;vel n&atilde;o podem comprar sozinhas.</p>\r\n\r\n<p>Exceto em casos que o casamento aconteceu em Separa&ccedil;&atilde;o Total de Bens.</p>\r\n', 1),
(113, 25, 6, 'Posso financiar 100% do imóvel pelo Programa Casa Verde e Amarela?', '<p>Nenhum banco financia 100% de um im&oacute;vel, por&eacute;m como se trata de um programa do Governo Federal, voc&ecirc; tem mais facilidade com a entrada, pois ela pode ser parcelada at&eacute; a entrega das chaves.</p>\r\n', 1),
(114, 25, 7, 'Posso juntar renda com qualquer pessoa para comprar um imóvel pelo Programa?', '<p>Sim, voc&ecirc; pode juntar renda com qualquer pessoa, desde que a somat&oacute;ria das rendas n&atilde;o ultrapasse o valor m&aacute;ximo estipulado pelo programa.</p>\r\n\r\n<p>Utilizar a composi&ccedil;&atilde;o de renda &eacute; muito importante para quem deseja comprar um im&oacute;vel. Quando bem planejada, a a&ccedil;&atilde;o &eacute; determinante para gerar o financiamento, como o esperado.</p>\r\n\r\n<p>Por regra, todas as pessoas que comp&otilde;em a renda podem utilizar o FGTS. Isso permite, por exemplo, dar uma entrada maior e diminuir o total financiado. Como consequ&ecirc;ncia o tempo ou as presta&ccedil;&otilde;es s&atilde;o reduzidos.</p>\r\n', 1),
(115, 25, 8, 'O programa Casa Verde e Amarela financia qualquer imóvel?', '<p>N&atilde;o. &Eacute; preciso obedecer algumas regras como: Ser im&oacute;vel novo e com pre&ccedil;o dentro dos limites do FGTS da cidade onde ele foi constru&iacute;do.</p>\r\n\r\n<p>O valor m&aacute;ximo do im&oacute;vel no programa&nbsp;&eacute; at&eacute; R$ 240 mil, nas regi&otilde;es: metropolitana de S&atilde;o Paulo, Rio de Janeiro e no Distrito Federal.</p>\r\n', 1),
(116, 25, 9, 'Quem pode participar do Programa Casa Verde e Amarela?', '<ul>\r\n	<li>Clientes com renda familiar bruta mensal at&eacute; R$ 7.000,00</li>\r\n	<li>Clientes que n&atilde;o possuem im&oacute;vel onde moram ou trabalham</li>\r\n	<li>Clientes que n&atilde;o possuem financiamento habitacional ativo</li>\r\n	<li>Clientes que trabalhem ou morem no mesmo munic&iacute;pio do empreendimento que estiverem comprando.</li>\r\n</ul>\r\n\r\n<p>* Obs.: Caso o cliente v&aacute; utilizar o FGTS, valer&atilde;o as mesmas regras acima.</p>\r\n', 1),
(117, 25, 10, 'Posso usar meu FGTS como entrada no Casa Verde e Amarela?', '<p>Sim, desde que n&atilde;o tenha usado o FGTS para comprar outro im&oacute;vel financiado pelo SFH (Sistema Financeiro Habitacional) em qualquer outra cidade do Brasil.</p>\r\n', 1),
(118, 25, 11, 'Tenho restrição em meu nome, posso financiar um imóvel?', '<p>N&atilde;o. Se voc&ecirc; possui qualquer restri&ccedil;&atilde;o em seu nome n&atilde;o poder&aacute; realizar a An&aacute;lise de Cr&eacute;dito para tentar um financiamento.</p>\r\n\r\n<p>Mas isso n&atilde;o quer dizer que nunca vai poder financiar, pelo contr&aacute;rio, estamos aqui para te orientar do modo certo a adquirir seu primeiro im&oacute;vel.</p>\r\n\r\n<p><a href=\"contato\">Entre em contato com um de nossos consultores para mais informa&ccedil;&otilde;es.</a></p>\r\n', 1),
(119, 25, 3, 'O que eu preciso fazer para comprar meu imóvel pelo Programa Casa Verde e Amarela?', '<p>&Eacute; muito f&aacute;cil para conseguir comprar seu im&oacute;vel, basta entrar em contato com um de nossos especialistas para que possamos te ajudar a encontrar o im&oacute;vel perfeito para voc&ecirc;.</p>\r\n\r\n<p>Acompanhamos todo o seu processo de compra do in&iacute;cio ao fim para lhe dar mais seguran&ccedil;a e conforto.</p>\r\n', 1),
(120, 25, 4, 'Qual a documentação necessária para solicitar a Análise de Crédito?', '<p>Basta <a href=\"enviar-documentos\">acessar aqui</a> para ter acesso &agrave; lista e documentos e modo de envio. &Eacute; simples e f&aacute;cil!</p>\r\n', 1),
(121, 25, 12, 'Como funciona a divisão das faixas de renda no programa casa verde e amarela?', '<ul>\r\n	<li>Faixa 1,5 &ndash; Renda de&nbsp;At&eacute; R$ 2.000,00</li>\r\n	<li>Faixa 2 &ndash;&nbsp;Renda de R$ 2.000,00 at&eacute; R$ 4.000,00</li>\r\n	<li>Faixa 3 &ndash;&nbsp;Renda de R$ 4.000,00 at&eacute; R$ 7.000,00</li>\r\n</ul>\r\n', 1),
(122, 25, 13, 'Quais são os subsídios do Programa Casa Verde e Amarela?', '<p>Os valores dos subs&iacute;dios variam de acordo com a cidade e com a renda bruta familiar. Consulte a faixa de renda e a cidade do im&oacute;vel desejado para saber se voc&ecirc; se encaixa na condi&ccedil;&atilde;o do programa.</p>\r\n\r\n<ul>\r\n	<li>Faixa 1,5 &ndash; Subs&iacute;dio de&nbsp;at&eacute; <strong>R$ 47.500,00</strong>, varia&ccedil;&atilde;o dependendo da renda e regi&atilde;o do im&oacute;vel</li>\r\n	<li>Faixa 2 &ndash; Subs&iacute;dio de&nbsp;at&eacute; <strong>R$ 29.000,00</strong>,&nbsp;varia&ccedil;&atilde;o dependendo da renda e regi&atilde;o do im&oacute;vel</li>\r\n	<li>Faixa 3 &ndash;&nbsp;<strong>N&atilde;o possui subs&iacute;dio</strong>.</li>\r\n</ul>\r\n', 1),
(123, 25, 14, 'Quais são as taxas de juros no Programa Casa Verde e Amarela?', '<p>As taxas de juros variam de acordo com as faixas de renda e por regi&atilde;o do im&oacute;vel. Confira abaixo:</p>\r\n\r\n<p>No Sul, Sudeste e Centro-Oeste:</p>\r\n\r\n<ul>\r\n	<li>Faixa 1,5 &ndash;&nbsp;<strong>Entre 4,5% e 5,25% a.a</strong>.</li>\r\n	<li>Faixa 2 &ndash;&nbsp;<strong>Entre 5% e 7% a.a</strong>.</li>\r\n	<li>Faixa 3 &ndash;&nbsp;<strong>Entre 7,66% e 8,16% a.a</strong>.</li>\r\n</ul>\r\n\r\n<p><br />\r\nNo Norte e Nordeste:</p>\r\n\r\n<ul>\r\n	<li>Faixa 1,5* &ndash;&nbsp;<strong>Entre 4,5% e 5,25% a.a</strong>.</li>\r\n	<li>Faixa 2 &ndash;&nbsp;<strong>Entre 5% e 7% a.a</strong>.</li>\r\n	<li>Faixa 3 &ndash;&nbsp;<strong>Entre 7,66% e 8,16% a.a</strong>.</li>\r\n</ul>\r\n\r\n<p>* No Norte e Nordeste, a renda do grupo 1,5 ser&aacute; de&nbsp;at&eacute; <strong>R$ 2.600,00</strong>.</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paginas_fotos`
--

CREATE TABLE `paginas_fotos` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `destaque` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paginas_icones`
--

CREATE TABLE `paginas_icones` (
  `id` int(11) NOT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto` text COLLATE latin1_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `icone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `paginas_icones`
--

INSERT INTO `paginas_icones` (`id`, `pagina_id`, `ordem_exibicao`, `titulo`, `texto`, `foto`, `icone`, `status`) VALUES
(3, 6, 1, 'Agendamentos', '<p>N&oacute;s fazemos toda a parte de marketing para lhe proporcionar clientes j&aacute; interessados em visitar e se tornar um poss&iacute;vel fechamento de venda.</p>\r\n', NULL, 'fas fa-check', 1),
(4, 6, 2, 'Vitrine', '<p>Nossa plataforma digital conta com um portf&oacute;lio completo com as informa&ccedil;&otilde;es de cada empreendimento para facilitar o seu entendimento e a atendimento ao cliente.</p>\r\n', NULL, 'fas fa-check', 1),
(5, 6, 3, 'Agilidade', '<p>Faremos a parte burocr&aacute;tica por voc&ecirc;, para que voc&ecirc; possa focar no que faz de melhor, encantar o cliente com o seu atendimento e profissionalismo.</p>\r\n', NULL, 'fas fa-check', 1),
(6, 6, 4, 'Transparência', '<p>Sempre trabalhamos de uma forma transparente para termos uma parceria de excel&ecirc;ncia. Aqui n&atilde;o existe surpresa, voc&ecirc; poder&aacute; contar com um suporte digital para estarmos sempre pr&oacute;ximos lhe ajudando da melhor forma.</p>\r\n', NULL, 'fas fa-check', 1),
(7, 6, 5, 'Portfólio de imóveis', '<p>Contar&aacute; com uma imobili&aacute;ria que est&aacute; sempre um passo a frente, proporcionando melhorias constantes na capta&ccedil;&atilde;o de im&oacute;veis, com isso sempre teremos cada vez mais im&oacute;veis, aumentando o nosso e o seu portf&oacute;lio de com um leque de op&ccedil;&otilde;es mais amplo e qualificado.</p>\r\n', NULL, 'fas fa-check', 1),
(9, 7, 1, 'Não precisa assinar planos', '<p>Aqui voc&ecirc; aluga o seu im&oacute;vel com mais facilidade, diferente de outros sites, na Impera Real voc&ecirc; n&atilde;o paga para manter o seu im&oacute;vel sendo anunciado.</p>\r\n', NULL, 'fas fa-check', 1),
(10, 7, 2, 'Atendimento personalizado', '<p>a Impera Real voc&ecirc; ter&aacute; um atendimento r&aacute;pido&nbsp;<br />\r\ne sempre dispon&iacute;vel.</p>\r\n', NULL, 'fas fa-check', 1),
(11, 7, 3, 'Documentação sem burocracia', '<p>Ao vender ou alugar o seu im&oacute;vel a gente cuida de todos os documentos e processos, evitando que voc&ecirc; precise se desgastar com toda a parte burocr&aacute;tica.</p>\r\n', NULL, 'fas fa-check', 1),
(12, 8, 1, 'Você se inscreve', '<p>&Eacute; muito simples, primeiro voc&ecirc; se cadastra e ter&aacute; acesso as ferramentas necess&aacute;rias para indica&ccedil;&atilde;o, tamb&eacute;m ter&aacute; todo o suporte necess&aacute;rio para indicar da forma correta.&nbsp;</p>\r\n', NULL, 'fas fa-check', 1),
(13, 8, 2, 'Indica uma pessoa', '<p>Voc&ecirc; ter&aacute; um link exclusivo para divulga&ccedil;&atilde;o, esse link serve para que possamos identificar que o cliente foi indicado por voc&ecirc;. Dessa forma fica muito f&aacute;cil de te parabenizar e darmos a sua merecida comiss&atilde;o quando o cliente fechar o neg&oacute;cio.</p>\r\n', NULL, 'fas fa-check', 1),
(14, 8, 3, 'Recebe pela indicação', '<p>Aqui voc&ecirc; recebe excelentes comiss&otilde;es. A cada venda realizada, voc&ecirc; recebe a sua comiss&atilde;o que, em alguns casos, pode ser de at&eacute; R$ 1.000,00 por venda.</p>\r\n', NULL, 'fas fa-check', 1),
(15, 25, 1, 'Condições Diferenciadas', '<p>Agora voc&ecirc; tem a comodidade de solicitar sua An&aacute;lise de Cr&eacute;dito atrav&eacute;s da nossa plataforma digital de forma r&aacute;pida e gratuita.</p>\r\n\r\n<p>Seu <strong>FGTS </strong>pode ser usado na entrada<br />\r\nVoc&ecirc; pode<strong> juntar renda</strong> com at&eacute; 3 pessoas<br />\r\n<strong>Maior prazo</strong> para pagar o seu im&oacute;vel</p>\r\n', NULL, 'fas fa-award', 1),
(16, 25, 2, 'Financiamento de Moradia', '<p>Seu im&oacute;vel &eacute; financiado pela <strong>Caixa Econ&ocirc;mica Federal</strong>, o maior banco p&uacute;blico do Pa&iacute;s e traz a <strong>menor Taxa de Juros </strong>para facilitar o seu acesso ao financiamento do im&oacute;vel pr&oacute;prio.</p>\r\n\r\n<p>Os im&oacute;veis financiados pelo Programa tem valor m&aacute;ximo de <strong>at&eacute; 240 mil reais</strong>.</p>\r\n', NULL, 'fas fa-home', 1),
(17, 25, 3, 'Atendimento Especializado', '<p>Encontre aqui o seu im&oacute;vel e fa&ccedil;a tudo 100% online com total conforto e seguran&ccedil;a.</p>\r\n\r\n<p>Nossos consultores s&atilde;o especialistas no Programa Casa Verde e Amarela e est&atilde;o prontos para te ajudar a conquistar sua independ&ecirc;ncia.</p>\r\n', NULL, 'fas fa-star', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proprietarios`
--

CREATE TABLE `proprietarios` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `creci` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `senha` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `cep` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `logradouro` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `numero` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `chave` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `banco` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `agencia` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `conta` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `operacao` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `chave_pix` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `razao_social` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `rg` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `nascimento` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `atuacao_planta` int(1) DEFAULT NULL,
  `atuacao_avulso` int(1) DEFAULT NULL,
  `atuacao_locacao` int(1) DEFAULT NULL,
  `domingo_status` int(1) DEFAULT NULL,
  `domingo_inicio` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `domingo_fim` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `segunda_status` int(1) DEFAULT NULL,
  `segunda_inicio` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `segunda_fim` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `terca_status` int(1) DEFAULT NULL,
  `terca_inicio` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `terca_fim` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `quarta_status` int(1) DEFAULT NULL,
  `quarta_inicio` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `quarta_fim` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `quinta_status` int(1) DEFAULT NULL,
  `quinta_inicio` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `quinta_fim` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `sexta_status` int(1) DEFAULT NULL,
  `sexta_inicio` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `sexta_fim` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `sabado_status` int(1) DEFAULT NULL,
  `sabado_inicio` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `sabado_fim` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `foto_doc_frente` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `foto_doc_verso` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `como_conheceu` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cad_compl` int(11) DEFAULT 0,
  `dta_cad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `proprietarios`
--

INSERT INTO `proprietarios` (`id`, `tipo`, `foto`, `nome`, `cpf`, `creci`, `telefone`, `email`, `senha`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `chave`, `banco`, `agencia`, `conta`, `operacao`, `chave_pix`, `razao_social`, `rg`, `nascimento`, `atuacao_planta`, `atuacao_avulso`, `atuacao_locacao`, `domingo_status`, `domingo_inicio`, `domingo_fim`, `segunda_status`, `segunda_inicio`, `segunda_fim`, `terca_status`, `terca_inicio`, `terca_fim`, `quarta_status`, `quarta_inicio`, `quarta_fim`, `quinta_status`, `quinta_inicio`, `quinta_fim`, `sexta_status`, `sexta_inicio`, `sexta_fim`, `sabado_status`, `sabado_inicio`, `sabado_fim`, `foto_doc_frente`, `foto_doc_verso`, `como_conheceu`, `facebook_id`, `status`, `cad_compl`, `dta_cad`) VALUES
(3, 'proprietario', '345dec5d1584381ecf880a5398d827c1.jpg', 'Felipe Silva', '881.998.127-02', NULL, '(11) 11111-1111', 'felipeacelino@hotmail.com', '$2y$07$Owmr6TDNdcry5Pi3lFw8huXLaBEMYpGSyrIbGRVXsLLGp9a2.WnF.', '07143-650', 'Avenida Três Corações', '150', 'ap 61', 'Jardim Paraíso', 'Guarulhos', 'SP', '673d57a5ed1c1316f9bb5029bc54f6d3', 'Itáu', '1324', '123456-X', '3', '123456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2021-03-31 20:26:28'),
(8, 'proprietario', '42af02a765606bf4e5c0c8a226c21e63.png', 'Fulano de Tal', '881.998.127-03', NULL, '(11) 11111-1111', 'fulano@email.com', '$2y$07$BCF8zgjA61EVNur.dZbdcOwg6sXMloyAEPG4wtZgAILpLM4gPUkvS', '07143-650', 'Avenida Três Corações', '150', NULL, 'Jardim Paraíso', 'Guarulhos', 'SP', 'd479855e41ff96cf94d8a6a507150349', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-04-07 18:45:11'),
(9, 'proprietario', NULL, 'SDFSDFSD  DFS', NULL, NULL, NULL, 'teste@teste.com', '$2y$07$I3nK8D3RORlumN0ocf7qLOrAPQLkr1RdiEz4WdAqvw7o0hJib0N4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'f83fc3b581c9cbe20731d3e53a273b82', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-04-07 19:30:13'),
(10, 'proprietario', '55eb5ec21be1eee2791838853bf76c9c.jpg', 'Adriano Ivo Tavares ', '142.724.477-42', NULL, '(21) 98297-4923', 'tavares.imperareal@gmail.com', '$2y$07$HQmocuKVj0CLfjVYyD.zNONGgDYF/G68K/p86vHfA7XubWBMtF0ia', '20560-121', 'Rua Visconde de Santa Isabel', '337 ', NULL, 'Grajaú', 'Rio de Janeiro', 'RJ', '084e747c9508a4a191f223c1e4fb24c6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2021-04-07 20:02:28'),
(11, 'proprietario', NULL, 'teste de conta', NULL, NULL, NULL, 'teste2@teste.com', '$2y$07$XMoUg7V/yhSzxwHpxExMX.A.iwtyWPj/WsTPGsuvwfCTMI.MQBmGm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0e5c483ae03625009f3045c0e2abca38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-04-13 09:21:43'),
(12, 'proprietario', NULL, 'Joa da Silva', NULL, NULL, '(11) 95910-0183', 'joao@email.com', '$2y$07$bGcPM9CanNsU79bHYMmicexcpA5WuGC9ocjPU9y6raLF9yC1IaCPi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a854148e1c7bea23f6e6372bce5fc241', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-04-22 16:55:46'),
(13, 'proprietario', NULL, 'Monique Alcantara', NULL, NULL, '(21) 96523-6758', 'moniquealcantara.imperareal@gmail.com', '$2y$07$4sVDJaxlDiSfCs.Ra6qkSunDPVasGBSekZc0MqJ3FGknld9pU.VIO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8e528cf52a9f98b44107f4f03a07ba10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-04-23 23:06:54'),
(15, 'corretor', '7a9bc35ceeb75f5566e5fd93af876e92.png', 'Felipe Silva', '881.998.127-02', '123465', '(11) 95910-0183', 'felipeacelino@hotmail.com', '$2y$07$yWjFGKOrP650JgYpbdh94.8QUqnWdpSw23opwLaoCBmw/GZnHadqO', '07143-650', 'Avenida Três Corações', '150', '', 'Jardim Paraíso', 'Guarulhos', 'SP', 'b2ae86308db78887f4c80ee606edf788', '', '', '', '', '', 'nike', '2342342342342342', '15/12/1993', 0, 1, 1, 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', '23a91518333ee53e6adeba08ca3a7ad8.jpg', '87213e12acf4e1d7e950a6d84feb847f.jpg', 'Instagram', NULL, 1, 1, '2021-06-12 10:52:55'),
(17, 'corretor', NULL, 'João da Silva', NULL, '123456', '(11) 95910-0189', 'joao@email.com', '$2y$07$1qxM9kUWXCjgqwSN5WFoeePj/ZCivrHQRKdG8HnuZvK5kJ1tMaD3e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e2ce93bba1d0a58d8f5a38dcb2d7df9f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-06-14 19:45:16'),
(18, 'corretor', NULL, 'Adriano Ivo Tavares ', NULL, '52369', '(21) 98297-4923', 'ivottavares@gmail.com', '$2y$07$7iYU61WnkxFQ36rb7ExAFOJk3YBU9Gh7nUu2xkKGAE.rGKj/Urhxu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '976db8cba214fc7ad8e9e2871f13c9db', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-06-14 20:50:27'),
(19, 'corretor', NULL, 'Adriano Tavares', NULL, '50789', '(21) 98297-4923', 'tavares.imperareal@gmail.com', '$2y$07$emIqaQdEF1WX9UCoX10yV.kYyB9TLF7rYKOUs8m.4QbuWZcFwWogq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fa71f850cf1f021887efefe4ea2e26c0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-06-16 12:36:33'),
(20, 'corretor', NULL, 'Fulano de Tal', '110.448.240-18', '123456', '(11) 95910-0184', 'teste@teste.com', '$2y$07$NsKRU23B19jeQVdcfCMd0O734TWE6bhihYfN.3ot7NnLWqIgqzp1i', '07143-650', 'Avenida Três Corações', '150', '', 'Jardim Paraíso', 'Guarulhos', 'SP', 'e14b02d3e199cc5b6cddf7441f8f658d', 'fsdfsd', 'fsdfs', 'fsdfs', 'fsdfsdfs', '', 'teste', '23423423423423', '13/12/3123', 0, 1, 1, 0, '', '', 1, '00:30', '01:00', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', NULL, NULL, '', NULL, 1, 1, '2021-08-06 03:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `proprietarios_arquivos`
--

CREATE TABLE `proprietarios_arquivos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `imovel_cod` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `origem` varchar(255) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `titulo` varchar(500) DEFAULT NULL,
  `url_amigavel` varchar(500) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `date_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proprietarios_arquivos`
--

INSERT INTO `proprietarios_arquivos` (`id`, `id_usuario`, `imovel_cod`, `tipo`, `origem`, `arquivo`, `titulo`, `url_amigavel`, `status`, `date_time`) VALUES
(8, 7, NULL, NULL, 'recebidos_admin', '962ca2e2339b6b4cac3c0d91da52aaf4.pdf', 'teste', 'teste', 1, '2021-04-07'),
(11, 10, NULL, NULL, 'recebidos_admin', '8b7f307e02beb55ce813cae0db7bc742.jpg', 'Comprovante de residência', 'comprovante-de-residencia', 1, '2021-04-08'),
(12, 10, NULL, NULL, 'recebidos_admin', '5f28ad91174dcd8e06a56c5a0cf60f05.jpg', 'Registro do Imóvel', 'registro-do-imovel', 1, '2021-04-08'),
(13, 10, NULL, NULL, 'recebidos_admin', '08b3c84520adb958ed44f62b7ff2c60d.jpeg', 'RG e CPF', 'rg-e-cpf', 1, '2021-04-08'),
(14, 3, NULL, NULL, 'enviados_admin', '8728549e105292c8e32be60f7d38d222.pdf', 'teste', 'teste', 1, '2021-05-21'),
(15, 10, NULL, NULL, 'recebidos_admin', '512f6c9426c90f25329b2725af225c29.jpg', 'Residência', 'residencia', 1, '2021-05-23'),
(16, 10, NULL, NULL, 'recebidos_admin', '2ba48443a06215b667895f622e063433.jpg', 'RG e CPF', 'rg-e-cpf', 1, '2021-05-23'),
(17, 10, NULL, NULL, 'recebidos_admin', 'c01e7a67090520837fe442c87d7122e9.jpg', 'Imagem', 'imagem', 1, '2021-05-23'),
(19, 10, NULL, NULL, 'recebidos_admin', '3166b6263fb3af882bd598895ff06101.jpg', 'Imagem 2', 'imagem-2', 1, '2021-05-23'),
(20, 3, NULL, NULL, 'recebidos_admin', '0557351b329f3588a55cf0f6d2ff1740.pdf', 'teste', 'teste', 1, '2021-06-09'),
(21, 3, 'teste', 2, 'recebidos_admin', '7a3ce40e3088f69893d088ac4ebfd6f4.pdf', '', '', 1, '2021-06-11'),
(22, 3, '123', NULL, 'recebidos_admin', 'e92013fb00e0079c8f965d31b332e2d6.pdf', 'test123', 'test123', 1, '2021-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `proprietarios_mensagens`
--

CREATE TABLE `proprietarios_mensagens` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `remetente` varchar(255) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `lida` int(1) DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proprietarios_mensagens`
--

INSERT INTO `proprietarios_mensagens` (`id`, `id_usuario`, `remetente`, `mensagem`, `arquivo`, `lida`, `data`) VALUES
(1, 3, 'usuario', 'teste', NULL, 0, '2021-04-07 15:34:59'),
(2, 3, 'usuario', 'teste2', 'b14e84409ae83812506b4dafc8fa28db.pdf', 0, '2021-04-07 15:35:17'),
(3, 8, 'usuario', 'teste', NULL, 0, '2021-04-07 18:54:45'),
(4, 10, 'usuario', 'Oi', NULL, 1, '2021-04-07 20:24:24'),
(5, 10, 'usuario', 'Escreve mais', NULL, 1, '2021-04-07 20:24:47'),
(6, 10, 'usuario', 'Bom dia!\r\nComo você está?\r\n', NULL, 1, '2021-04-08 10:59:02'),
(7, 10, 'usuario', 'Oie', NULL, 1, '2021-04-08 11:00:00'),
(8, 13, 'usuario', 'Oi', NULL, 0, '2021-04-23 23:08:17'),
(9, 10, 'usuario', 'oi', 'd11689b41d627f41953e283c83fb04c7.jpg', 0, '2021-04-27 14:27:24'),
(10, 3, 'usuario', '', '3b37ed6e5cb99702f42f37dac3cb5f6d.jpg', 0, '2021-05-20 18:02:33'),
(11, 10, 'usuario', '', 'cb79295ef0f0f47991f483a1660d3cc1.jpg', 0, '2021-05-23 12:51:21'),
(12, 10, 'usuario', '', '5b2605f56e6017e376d4b65a12fccac5.jpg', 0, '2021-05-23 12:53:11'),
(13, 10, 'usuario', 'teste 2', NULL, 0, '2021-05-23 12:53:46'),
(14, 10, 'usuario', '', 'd8a761ebec19504bc6b669a3e6a8b89d.jpg', 0, '2021-05-23 16:49:09'),
(15, 10, 'usuario', '', NULL, 0, '2021-05-23 17:11:06'),
(16, 10, 'usuario', '', '9e341be47ed578f351a86a5bbc240480.pdf', 0, '2021-05-23 17:11:43'),
(17, 3, 'usuario', 'TESTE', NULL, 0, '2021-06-09 19:03:16'),
(18, 10, 'usuario', '', '8fb69678d805d848b28eee9c9ea5b7a5.jpg', 0, '2021-06-14 21:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `regioes_atuacao`
--

CREATE TABLE `regioes_atuacao` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `codigo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `regioes_atuacao`
--

INSERT INTO `regioes_atuacao` (`id`, `tipo`, `estado_id`, `codigo`, `descricao`, `data_cad`, `status`) VALUES
(1, 'avulso-locacao', 19, 'RJ 01', 'Andaraí, Grajaú, Tijuca, Vila Isabel, São Cristóvão, Méier', '2021-08-04 01:09:04', 1),
(2, 'avulso-locacao', 19, 'RJ 02', 'Glória, Catete, Laranjeiras, Cosme Velho', '2021-08-04 01:19:40', 1),
(3, 'avulso-locacao', 19, 'RJ 03', 'Flamengo, Botafogo, Humaitá', '2021-08-04 01:20:02', 1),
(4, 'avulso-locacao', 19, 'RJ 04', 'Urca, Leme, Copacabana, Ipanema', '2021-08-04 01:20:31', 1),
(5, 'avulso-locacao', 19, 'RJ 05', 'Lagoa, Jardim Botânico, Gávea, Leblon', '2021-08-04 01:20:58', 1),
(6, 'avulso-locacao', 19, 'RJ 06', 'São Conrado, Barra da Tijuca', '2021-08-04 01:21:13', 1),
(7, 'planta', 19, 'RJ 01', 'Zona Norte, Zona Central', '2021-08-04 01:27:58', 1),
(8, 'planta', 19, 'RJ 02', 'Zona Sul', '2021-08-04 01:28:06', 1),
(9, 'planta', 19, 'RJ 03', 'Zona Oeste 1: Barra, Recreio, Região de Jacarepaguá', '2021-08-04 01:28:41', 1),
(10, 'planta', 19, 'RJ 04', 'Zona Oeste 2: Campo Grande e Região', '2021-08-04 01:28:54', 1),
(11, 'planta', 19, 'RJ 05', 'Baixada Fluminense', '2021-08-04 01:29:03', 1),
(12, 'planta', 19, 'RJ 06', 'Niterói e Região', '2021-08-04 01:30:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sistema_conf`
--

CREATE TABLE `sistema_conf` (
  `id` int(11) NOT NULL,
  `url_base` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `smtp_host` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `smtp_user` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `smtp_pass` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email_autenticado` int(2) DEFAULT NULL,
  `envio_gmail` int(1) DEFAULT NULL,
  `google_analytcs` varchar(5000) COLLATE latin1_general_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cor_principal` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cor_secundaria` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `btn_principal` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `btn_secundario` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `cor_icheck` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `sistema_conf`
--

INSERT INTO `sistema_conf` (`id`, `url_base`, `smtp_host`, `smtp_user`, `smtp_pass`, `email_autenticado`, `envio_gmail`, `google_analytcs`, `timezone`, `cor_principal`, `cor_secundaria`, `btn_principal`, `btn_secundario`, `cor_icheck`, `status`) VALUES
(1, 'https://www.ellosdesign.com/imperareal/', 'mail.ellosdesign.com', 'naoresponder@ellosdesign.com', 'mudar@10', 1, 0, '', 'America/Sao_Paulo', '#4a0043', '#2cd9e8', '#7f277a', '#7f277a', '#2cd9e8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `ordem_exibicao` int(11) DEFAULT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `texto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `botao` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `url` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_link` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data_cad` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `ordem_exibicao`, `foto`, `titulo`, `texto`, `botao`, `url`, `tipo_link`, `data_cad`, `status`) VALUES
(1, 2, '5cb20c4708c71cfcceb8621e87d32777.jpg', '', '', '', '', '', '2021-01-19', 1),
(2, 1, '73a4a884b497a985808e69688eb36780.jpg', '', '', '', '', '', '2021-01-19', 1),
(3, 3, 'd6c3d860566fa8df67eeb5017be6b9b8.jpg', '', '', '', '', '', '2021-01-19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_acessos`
--
ALTER TABLE `admin_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_avisos`
--
ALTER TABLE `admin_avisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_categorias_niveis`
--
ALTER TABLE `admin_categorias_niveis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_niveis`
--
ALTER TABLE `admin_niveis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `afiliados`
--
ALTER TABLE `afiliados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `afiliados_mensagens`
--
ALTER TABLE `afiliados_mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_caracteristicas`
--
ALTER TABLE `anuncios_caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_caracteristicas_n_n`
--
ALTER TABLE `anuncios_caracteristicas_n_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_comodidades`
--
ALTER TABLE `anuncios_comodidades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_comodidades_n_n`
--
ALTER TABLE `anuncios_comodidades_n_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_comodos`
--
ALTER TABLE `anuncios_comodos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_comodos2`
--
ALTER TABLE `anuncios_comodos2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_comodos2_n_n`
--
ALTER TABLE `anuncios_comodos2_n_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_comodos_n_n`
--
ALTER TABLE `anuncios_comodos_n_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_condominio`
--
ALTER TABLE `anuncios_condominio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_condominio_n_n`
--
ALTER TABLE `anuncios_condominio_n_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_lazer`
--
ALTER TABLE `anuncios_lazer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_lazer_n_n`
--
ALTER TABLE `anuncios_lazer_n_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_mobilias`
--
ALTER TABLE `anuncios_mobilias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_mobilias_n_n`
--
ALTER TABLE `anuncios_mobilias_n_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_pagamentos`
--
ALTER TABLE `anuncios_pagamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_regioes`
--
ALTER TABLE `anuncios_regioes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_seguranca`
--
ALTER TABLE `anuncios_seguranca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_seguranca_n_n`
--
ALTER TABLE `anuncios_seguranca_n_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_taxas`
--
ALTER TABLE `anuncios_taxas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_tipos`
--
ALTER TABLE `anuncios_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_tipos_itens`
--
ALTER TABLE `anuncios_tipos_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`tipo_id`);

--
-- Indexes for table `anuncios_visitas`
--
ALTER TABLE `anuncios_visitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`cidade_id`);

--
-- Indexes for table `blocos_home`
--
ALTER TABLE `blocos_home`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordem_exibicao` (`ordem_exibicao`);

--
-- Indexes for table `blog_categorias`
--
ALTER TABLE `blog_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts_categorias`
--
ALTER TABLE `blog_posts_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts_comentarios`
--
ALTER TABLE `blog_posts_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buscas`
--
ALTER TABLE `buscas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buscas_anuncios`
--
ALTER TABLE `buscas_anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cidade_estado` (`estado_id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes_arquivos`
--
ALTER TABLE `clientes_arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes_mensagens`
--
ALTER TABLE `clientes_mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comodos`
--
ALTER TABLE `comodos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corretores_arquivos`
--
ALTER TABLE `corretores_arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corretores_clientes`
--
ALTER TABLE `corretores_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corretores_leads`
--
ALTER TABLE `corretores_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corretores_mensagens`
--
ALTER TABLE `corretores_mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corretores_regioes_atuacao`
--
ALTER TABLE `corretores_regioes_atuacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enderecos_bloqueados`
--
ALTER TABLE `enderecos_bloqueados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_conf`
--
ALTER TABLE `loja_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loja_logo`
--
ALTER TABLE `loja_logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paginas_blocos`
--
ALTER TABLE `paginas_blocos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`pagina_id`);

--
-- Indexes for table `paginas_faq`
--
ALTER TABLE `paginas_faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`pagina_id`);

--
-- Indexes for table `paginas_fotos`
--
ALTER TABLE `paginas_fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paginas_icones`
--
ALTER TABLE `paginas_icones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`pagina_id`);

--
-- Indexes for table `proprietarios`
--
ALTER TABLE `proprietarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proprietarios_arquivos`
--
ALTER TABLE `proprietarios_arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proprietarios_mensagens`
--
ALTER TABLE `proprietarios_mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regioes_atuacao`
--
ALTER TABLE `regioes_atuacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistema_conf`
--
ALTER TABLE `sistema_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordem_exibicao` (`ordem_exibicao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_acessos`
--
ALTER TABLE `admin_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_avisos`
--
ALTER TABLE `admin_avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_categorias_niveis`
--
ALTER TABLE `admin_categorias_niveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `admin_niveis`
--
ALTER TABLE `admin_niveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `afiliados`
--
ALTER TABLE `afiliados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `afiliados_mensagens`
--
ALTER TABLE `afiliados_mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `anuncios_caracteristicas`
--
ALTER TABLE `anuncios_caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `anuncios_caracteristicas_n_n`
--
ALTER TABLE `anuncios_caracteristicas_n_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=621;

--
-- AUTO_INCREMENT for table `anuncios_comodidades`
--
ALTER TABLE `anuncios_comodidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `anuncios_comodidades_n_n`
--
ALTER TABLE `anuncios_comodidades_n_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anuncios_comodos`
--
ALTER TABLE `anuncios_comodos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `anuncios_comodos2`
--
ALTER TABLE `anuncios_comodos2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `anuncios_comodos2_n_n`
--
ALTER TABLE `anuncios_comodos2_n_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anuncios_comodos_n_n`
--
ALTER TABLE `anuncios_comodos_n_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=569;

--
-- AUTO_INCREMENT for table `anuncios_condominio`
--
ALTER TABLE `anuncios_condominio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `anuncios_condominio_n_n`
--
ALTER TABLE `anuncios_condominio_n_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1121;

--
-- AUTO_INCREMENT for table `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `anuncios_lazer`
--
ALTER TABLE `anuncios_lazer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `anuncios_lazer_n_n`
--
ALTER TABLE `anuncios_lazer_n_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anuncios_mobilias`
--
ALTER TABLE `anuncios_mobilias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `anuncios_mobilias_n_n`
--
ALTER TABLE `anuncios_mobilias_n_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=742;

--
-- AUTO_INCREMENT for table `anuncios_pagamentos`
--
ALTER TABLE `anuncios_pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anuncios_regioes`
--
ALTER TABLE `anuncios_regioes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `anuncios_seguranca`
--
ALTER TABLE `anuncios_seguranca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `anuncios_seguranca_n_n`
--
ALTER TABLE `anuncios_seguranca_n_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anuncios_taxas`
--
ALTER TABLE `anuncios_taxas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `anuncios_tipos`
--
ALTER TABLE `anuncios_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `anuncios_tipos_itens`
--
ALTER TABLE `anuncios_tipos_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `anuncios_visitas`
--
ALTER TABLE `anuncios_visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `blocos_home`
--
ALTER TABLE `blocos_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_categorias`
--
ALTER TABLE `blog_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_posts_categorias`
--
ALTER TABLE `blog_posts_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts_comentarios`
--
ALTER TABLE `blog_posts_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buscas`
--
ALTER TABLE `buscas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buscas_anuncios`
--
ALTER TABLE `buscas_anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clientes_arquivos`
--
ALTER TABLE `clientes_arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clientes_mensagens`
--
ALTER TABLE `clientes_mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comodos`
--
ALTER TABLE `comodos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `corretores_arquivos`
--
ALTER TABLE `corretores_arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `corretores_clientes`
--
ALTER TABLE `corretores_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `corretores_leads`
--
ALTER TABLE `corretores_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `corretores_mensagens`
--
ALTER TABLE `corretores_mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `corretores_regioes_atuacao`
--
ALTER TABLE `corretores_regioes_atuacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `enderecos_bloqueados`
--
ALTER TABLE `enderecos_bloqueados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loja_conf`
--
ALTER TABLE `loja_conf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loja_logo`
--
ALTER TABLE `loja_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `paginas_blocos`
--
ALTER TABLE `paginas_blocos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `paginas_faq`
--
ALTER TABLE `paginas_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `paginas_fotos`
--
ALTER TABLE `paginas_fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paginas_icones`
--
ALTER TABLE `paginas_icones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `proprietarios`
--
ALTER TABLE `proprietarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `proprietarios_arquivos`
--
ALTER TABLE `proprietarios_arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `proprietarios_mensagens`
--
ALTER TABLE `proprietarios_mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `regioes_atuacao`
--
ALTER TABLE `regioes_atuacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sistema_conf`
--
ALTER TABLE `sistema_conf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
