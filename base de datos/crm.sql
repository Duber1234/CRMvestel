-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2020 a las 22:09:25
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aauth_login_attempts`
--

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aauth_login_attempts`
--

INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(5, '::1', '2019-09-16 08:52:02', 16),
(9, '::1', '2019-09-19 17:15:45', 1),
(48, '::1', '2019-10-29 14:26:44', 1),
(116, '::1', '2019-11-25 16:40:01', 1),
(117, '::1', '2019-11-26 08:15:08', 1),
(119, '::1', '2019-11-26 09:33:54', 1),
(121, '::1', '2019-11-26 10:35:09', 1),
(122, '::1', '2019-11-26 11:27:45', 1),
(123, '::1', '2019-11-26 14:17:47', 1),
(164, '::1', '2020-07-23 15:07:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aauth_pms`
--

CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) NOT NULL,
  `pm_deleted_receiver` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aauth_users`
--

CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text DEFAULT NULL,
  `roleid` int(1) NOT NULL,
  `picture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `roleid`, `picture`) VALUES
(8, 'sistemas@vestel.com.co', 'c8430a118bdedca3c4a2118457ac5545b25abb4a1d838f3989724677750460bb', 'admin', 0, '2020-07-09 07:43:01', '2020-07-09 07:43:01', '2019-09-13 16:57:43', NULL, '2019-11-30 00:00:00', 'Hq79EhUs3zQF4Z6m', '79df626e4dc2ca90c1371b644867d525c62ad7e3', NULL, '::1', 5, 'example.png'),
(9, 'canal6yopal@gmail.com', 'f3d7d8f68ee2c0bfd08b6b71872634c633b4634011383a458755b21fcdeb4a6f', 'ANNIEARAGON', 0, '2019-09-13 11:24:30', '2019-09-13 11:24:30', '2019-09-13 11:23:03', NULL, NULL, NULL, 'ddde9390fb07e00fb64852868dc13cee2f107688', NULL, '::1', 3, 'example.png'),
(13, 'contabilidad@vestel.com.co', '0d9f89182b7572de5694a769bc9073d204754bad5bc043c69acafcaf484922fe', 'super', 0, NULL, NULL, '2019-10-23 17:07:56', NULL, NULL, NULL, NULL, NULL, NULL, 5, 'example.png'),
(14, 'yopal@vestel.com.co', '2a74b4a28f00408c278c6620a81f507dd1a74a7e0237eab83c4a967665968f48', 'indemcol', 0, '2019-10-23 17:10:09', '2019-10-23 17:10:09', '2019-10-23 17:09:15', NULL, NULL, NULL, NULL, NULL, '::1', 2, 'example.png'),
(15, 'villanueva@vestel.com.co', '196075d3b960128ae4a5cf79596d3d06ed482c5535c813ec0c7dbc2e6be032be', 'villanueva', 0, '2019-10-23 17:12:27', '2019-10-23 17:12:27', '2019-10-23 17:11:44', NULL, NULL, NULL, NULL, NULL, '::1', 1, 'example.png'),
(16, 'monterrey@vestel.com.co', '8c04f0d45d99fb3c09f7c82165b9672b53145f042c0d27a0067b25103c26408f', 'monterrey', 0, '2019-12-02 08:11:41', '2019-12-02 08:11:41', '2019-10-23 17:14:16', NULL, NULL, NULL, NULL, NULL, '::1', 2, 'example.png'),
(17, 'presidencia@vestel.com.co', '1cb4df1f9cc3eff69f9fa98a554c0cac43000c0fa999e7e51bd80fc23ab644a1', 'presidencia', 0, NULL, NULL, '2019-12-02 09:47:17', NULL, NULL, NULL, NULL, NULL, NULL, 4, 'example.png'),
(18, 'lina.02paola@gmail.com', '5b3a57853d818af459519d72f1c55bb1fb8cee2ff49838ff0b79b051ffe5e66d', 'PaolaJimenez', 0, '2020-07-09 08:25:24', '2020-07-09 08:25:24', '2020-07-08 10:04:05', NULL, NULL, NULL, NULL, NULL, '::1', 3, 'example.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aauth_user_variables`
--

CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `id` int(5) NOT NULL,
  `acn` varchar(35) NOT NULL,
  `holder` varchar(100) NOT NULL,
  `adate` datetime NOT NULL,
  `lastbal` decimal(16,2) DEFAULT 0.00,
  `code` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`id`, `acn`, `holder`, `adate`, `lastbal`, `code`) VALUES
(1, '12345678', 'Company Sales Account', '2018-01-01 00:00:00', '-1114690.00', 'Company Sales Account'),
(2, '60100035190', 'Dicelar', '0000-00-00 00:00:00', '-2196400.00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) DEFAULT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(2, 0, '4a6f058f80d6732ce1d1a529', 0, 0, 0, NULL, '2019-09-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_system`
--

CREATE TABLE `app_system` (
  `id` int(1) NOT NULL,
  `cname` char(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `region` varchar(40) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postbox` varchar(15) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `taxid` varchar(20) NOT NULL,
  `tax` int(11) NOT NULL,
  `currency` varchar(4) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `currency_format` int(1) NOT NULL,
  `prefix` varchar(5) NOT NULL,
  `dformat` int(1) NOT NULL,
  `zone` varchar(25) NOT NULL,
  `logo` varchar(30) NOT NULL,
  `lang` varchar(20) DEFAULT 'english'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `app_system`
--

INSERT INTO `app_system` (`id`, `cname`, `address`, `city`, `region`, `country`, `postbox`, `phone`, `email`, `taxid`, `tax`, `currency`, `currency_format`, `prefix`, `dformat`, `zone`, `logo`, `lang`) VALUES
(1, 'Vesga telecomunicaciones', 'Dig 34 n 31B - 87', 'yopal', 'casanare', 'Colombia', '123', '3106247129', 'sistemas@vestel.com.co', '23442', 0, '$', 0, 'SRN', 1, 'America/Bogota', '1574342263394687344.png', 'spanish');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `acn` varchar(50) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `enable` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE `barrio` (
  `idBarrio` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `idLocalidad` int(11) NOT NULL,
  `barrio` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billing_terms`
--

CREATE TABLE `billing_terms` (
  `id` int(4) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` int(1) NOT NULL,
  `terms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `billing_terms`
--

INSERT INTO `billing_terms` (`id`, `title`, `type`, `terms`) VALUES
(2, 'Consignacion', 0, '<p>realizado en pad</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idCiudad` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `ciudad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idCiudad`, `idDepartamento`, `ciudad`) VALUES
(1, 1, 'Yopal'),
(2, 1, 'Aguazul'),
(3, 1, 'Chámeza'),
(4, 1, 'Hato Corozal'),
(5, 1, 'La Salina'),
(6, 1, 'Maní'),
(7, 1, 'Monterrey'),
(8, 1, 'Nunchía'),
(9, 1, 'Orocué'),
(10, 1, 'Paz de Ariporo'),
(11, 1, 'Pore'),
(12, 1, 'Recetor'),
(13, 1, 'Sabanalarga'),
(14, 1, 'Sácama'),
(15, 1, 'San Luis de Palenque'),
(16, 1, 'Támara'),
(17, 1, 'Tauramena'),
(18, 1, 'Trinidad'),
(19, 1, 'Villanueva'),
(20, 2, 'Mocoa'),
(21, 2, 'Colón'),
(22, 2, 'Orito'),
(23, 2, 'Puerto Asís'),
(24, 2, 'Puerto Caicedo'),
(25, 2, 'Puerto Guzmán'),
(26, 2, 'Puerto Leguízamo'),
(27, 2, 'San Francisco'),
(28, 2, 'San Miguel'),
(29, 2, 'Santiago'),
(30, 2, 'Sibundoy'),
(31, 2, 'Valle del Guamuez'),
(32, 2, 'Villagarzón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1ff6oli94i2gkjgaik1aofndomsq7j1q', '::1', 1594300954, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330303935343b69647c733a313a2238223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32323a2273697374656d61734076657374656c2e636f6d2e636f223b6c6f67676564696e7c623a313b),
('3r7cl49p5g7mtk0ifi35rp61c9cbcbcl', '::1', 1594308362, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330383334323b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('4sem9pos20cvkl49f3romqkvcvvi1fmg', '::1', 1594304003, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330343030333b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('7crfenuht1r16srsdreme23p6ououjer', '::1', 1594299521, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343239393532313b69647c733a313a2238223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32323a2273697374656d61734076657374656c2e636f6d2e636f223b6c6f67676564696e7c623a313b),
('9g5p4sc4d3dmk3q6jfq4tiuudg7ntiqk', '::1', 1594302519, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330323531393b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('b1uk7e3crbn2fnmgv2snepf06vn1nr40', '::1', 1594308342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330383334323b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('bvku76shj9l7b0og013sklj4mrfd1ml0', '::1', 1594303683, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330333638333b69647c733a313a2238223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32323a2273697374656d61734076657374656c2e636f6d2e636f223b6c6f67676564696e7c623a313b),
('ctbngn6l1i6jrvf6tkanetpev926n5r7', '::1', 1594303685, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330333638333b69647c733a313a2238223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32323a2273697374656d61734076657374656c2e636f6d2e636f223b6c6f67676564696e7c623a313b),
('f5r9uip6v7jdar3m3e5vjkmq5oc6966h', '::1', 1594303693, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330333639333b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('fvjrhu0hi67jid3r4i77fhpmbb5dgkjt', '::1', 1594301873, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330313837333b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('g5hc07tn4j906kkf65le6u3p1m2jvknb', '::1', 1594299877, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343239393837373b69647c733a313a2238223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32323a2273697374656d61734076657374656c2e636f6d2e636f223b6c6f67676564696e7c623a313b),
('gnscg7ps70pgikq02g9im9mr5c10g5ro', '::1', 1594304934, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330343933343b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('h34h68m24rol3f1vbjnf2d15csqdnbf5', '::1', 1594305427, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330353432373b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('h6u7je61ikn1s5ljd5rhfr2jbvmcu8e0', '::1', 1594304467, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330343436373b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('jem9j7nv72a4s5mrtqpcjcejldj28bnj', '::1', 1594301115, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330313131353b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('ktbjo76in8pe0j28atesp4cnld39ehta', '::1', 1594299175, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343239393137353b69647c733a313a2238223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32323a2273697374656d61734076657374656c2e636f6d2e636f223b6c6f67676564696e7c623a313b),
('q190pmp7avujbj1f8e2euq6ch3c0bm30', '::1', 1595534852, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539353533343834383b),
('q80qebbfbhlig9902ee8usob76osppff', '::1', 1594299959, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343239393935393b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b),
('ses6qjiiqvil9vtf0s2lqmjotvm0md83', '::1', 1594301300, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330313330303b69647c733a313a2238223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32323a2273697374656d61734076657374656c2e636f6d2e636f223b6c6f67676564696e7c623a313b),
('tllro8seg093634gn0iap7j0keureihs', '::1', 1594307648, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343330373634383b69647c733a323a223138223b757365726e616d657c733a31323a2250616f6c614a696d656e657a223b656d61696c7c733a32323a226c696e612e303270616f6c6140676d61696c2e636f6d223b6c6f67676564696e7c623a313b);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conf`
--

CREATE TABLE `conf` (
  `id` int(1) NOT NULL DEFAULT 1,
  `bank` int(1) NOT NULL,
  `acid` int(11) NOT NULL,
  `ext1` varchar(255) DEFAULT NULL,
  `ext2` varchar(255) DEFAULT NULL,
  `recaptcha_p` varchar(255) DEFAULT NULL,
  `captcha` int(1) NOT NULL,
  `recaptcha_s` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `conf`
--

INSERT INTO `conf` (`id`, `bank`, `acid`, `ext1`, `ext2`, `recaptcha_p`, `captcha`, `recaptcha_s`) VALUES
(1, 1, 1, 'ltr', '0', '0', 0, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corn_job`
--

CREATE TABLE `corn_job` (
  `id` int(1) NOT NULL,
  `cornkey` varchar(50) NOT NULL,
  `rec_email` int(11) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `rec_due` int(11) DEFAULT NULL,
  `recemail` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `corn_job`
--

INSERT INTO `corn_job` (`id`, `cornkey`, `rec_email`, `email`, `rec_due`, `recemail`) VALUES
(1, '24492429', 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `id` int(4) NOT NULL,
  `code` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `symbol` varchar(3) DEFAULT NULL,
  `rate` decimal(10,3) NOT NULL,
  `thous` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `dpoint` char(1) CHARACTER SET latin1 NOT NULL,
  `decim` int(2) NOT NULL,
  `cpos` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `symbol`, `rate`, `thous`, `dpoint`, `decim`, `cpos`) VALUES
(1, 'GBP', 'X', '0.717', ',', '.', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `identification_card` int(20) DEFAULT NULL,
  `Conditions` varchar(20) DEFAULT NULL,
  `edate` varchar(20) DEFAULT NULL,
  `phone` varchar(10) DEFAULT 'NULL',
  `email` varchar(60) DEFAULT 'NULL',
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `Place_acte` varchar(50) DEFAULT NULL,
  `acts` varchar(20) DEFAULT NULL,
  `license_plate` varchar(100) DEFAULT 'NULL',
  `Type` varchar(100) DEFAULT 'NULL',
  `insurance_carrier` varchar(100) DEFAULT 'NULL',
  `policy` varchar(50) DEFAULT NULL,
  `Dixs` varchar(50) DEFAULT NULL,
  `claim_class` varchar(50) DEFAULT NULL,
  `claim_status` varchar(50) DEFAULT NULL,
  `razon` text DEFAULT NULL,
  `observation` varchar(100) DEFAULT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'example.png',
  `gid` int(5) NOT NULL DEFAULT 1,
  `cedula` varchar(100) DEFAULT NULL,
  `historial` varchar(100) DEFAULT NULL,
  `faltantes` varchar(100) DEFAULT NULL,
  `soat` varchar(100) DEFAULT NULL,
  `tarjeta` varchar(100) DEFAULT NULL,
  `informe` varchar(100) DEFAULT NULL,
  `declaracion` varchar(100) DEFAULT NULL,
  `Poder` varchar(100) DEFAULT NULL,
  `balance` float(16,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `name`, `age`, `identification_card`, `Conditions`, `edate`, `phone`, `email`, `address`, `city`, `Place_acte`, `acts`, `license_plate`, `Type`, `insurance_carrier`, `policy`, `Dixs`, `claim_class`, `claim_status`, `razon`, `observation`, `picture`, `gid`, `cedula`, `historial`, `faltantes`, `soat`, `tarjeta`, `informe`, `declaracion`, `Poder`, `balance`) VALUES
(54, 'Yesid Barrera', 20, 1116040547, 'Ocupante', '23-10-2019', '3106247129', 'administrador@yopal.com', 'Dig 34 n 31B - 87', 'yopal', 'YOPAL DG 34 N 31B', 'el hueso se rompio', 'asd 154', 'Automovil', 'axxa', '124578', 'el hueso', 'por ip', 'activo', NULL, 'ninguna', 'example.png', 1, '', '', '', '', '', '', '', '', 0.00),
(55, 'Yesid Barrera', 20, 112456, 'Ciclista', '23-10-2019', '3106247129', 'administrador@yopal.com', 'Dig 34 n 31B - 87', 'yopal', 'yopal dg 34', 'acciedte', 'asdfc 552', 'Automovil', 'axxa', '12545', 'fractura', 'soat', 'activa, inactiva por devolucion/ o prescripcion', NULL, 'ninguna', 'example.png', 1, '', '', '', '', '', '', '', '', 0.00),
(56, 'Yesid Barrera', 20, 1116040547, 'Conductor', '30-10-2019', '3106247129', 'sistemas@vestel.com.co', 'Dig 34 n 31B - 87', 'yopal', 'diagonal', 'caida libre', 'asx 235', 'Bus', 'axxa', '45218', 'el hueso', 'por ip', 'activo', NULL, 'ninguna', 'example.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00),
(57, 'annie', 25, 100647, 'Conductor', '30-10-2019', '3106247129', 'yeyoco05@hotmail.com', 'Dig 34 n 31B - 87', 'yopal', 'trasnversal', 'caida libre', 'aed 4587', 'Bus', 'ascc', '45785', 'el hueso', 'por ip', 'inactivo', 'falta papel', 'ninguna', 'example.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00),
(58, 'Yesid Barrera', 52, 1160547, 'Conductor', '30-10-2019', '3106247129', 'yeyoco05@hotmail.com', 'Dig 34 n 31B - 87', 'yopal', 'diagonal', 'caida cama', 'asxc 154', 'Bus', 'sdea', '457485', 'el hueso', 'por soat', 'activo', '', 'ninguna', 'example.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00),
(59, 'Vestel', 20, 14525, 'Ocupante', '30-10-2019', '3106247129', 'yeyoco05@hotmail.com', 'carrera 20 N 26 - 80', 'yopal', 'transvers', 'caida', 'sde 155', 'Automovil', 'sdfe', '4578', 'clavicula', 'de soat', 'activo', '', 'ninguna', 'example.png', 1, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00),
(60, 'camilo', 20, 4785, 'Conductor', '30-10-2019', '3106247129', 'sistemas@vestel.com.co ', 'carrera 20 N 26 - 80', 'yopal', 'calle', 'caida dos', 'sed 547', 'Bus', 'sedcc', '4578', 'coxis', 'por soat', 'activo', '', 'nungina', 'example.png', 1, 'on', 'incompleto', 'faltan hojas', NULL, NULL, NULL, NULL, NULL, 0.00),
(61, 'Yesid Barrera', 20, 4527, 'Conductor', '30-10-2019', '3106247129', 'yeyoco05@hotmail.com', 'Dig 34 n 31B - 87', 'yopal', 'adc', 'accidente', 'ase 547', 'Bus', 'adds', '4578', 'el pie', 'por soat', 'activo', '', 'ninguna', 'example.png', 1, 'on', 'completo', '', 'on', NULL, NULL, NULL, NULL, 0.00),
(62, 'Vestel', 85, 1245, 'Ocupante', '30-10-2019', '3106247129', 'administrador@yopal.com', 'carrera 20 N 26 - 80', 'yopal', 'carrera', 'ninguno', 'adf 154', 'Automovil', 'axxa', '78954', 'cabeza', 'por soat', 'activo', '', 'ninugno', 'example.png', 1, 'on', 'completo', '', 'on', 'on', NULL, NULL, NULL, 0.00),
(63, 'yadirta', 20, 45785, 'Conductor', '30-10-2019', '3106247129', 'sistemas@vestel.com.co ', 'carrera 20 N 26 - 80', 'yopal', 'numeor', 'cabeza', 'ade 458', 'Taxi', 'axxa', '45782', 'hombros', 'soat', 'activo', '', 'ninguna', 'example.png', 1, 'on', 'completo', '', 'on', 'on', 'on', NULL, NULL, 0.00),
(64, 'yusmeri duarte', 28, 1115856447, 'Conductor', '30-10-2019', '3183918148', 'yusmery1991@gmail.com', 'cra 28 a n 35 - 27', 'yopal', 'dg 34', 'ningun accidente', 'sws 79e', 'Motocicleta', 'soat', '4578526', 'clavicula', 'por ip', NULL, '', 'ninguna', 'example.png', 1, '1', 'completo', '', 'on', 'on', 'on', 'on', 'on', 0.00),
(65, 'Vestel', 20, 1452, 'Peaton', '31-10-2019', '4578', 'hoedancu92@hotmail.com', 'carrera 20 N 26 - 80', 'yopal', 'asefas', 'asdfasdfa', 'asdfasdfa', 'Automovil', 'asdfwe', 'asdfasdf', 'asdfae', 'asdfasdf', 'activo', '', 'asdfasdfa', 'example.png', 1, NULL, NULL, '', 'on', NULL, NULL, NULL, NULL, 0.00),
(66, 'jhon fredi', 45, 45, 'Conductor', '01-11-2019', '3106247129', 'yeyoco05@hotmail.com', 'Dig 34 n 31B - 87', 'yopal', 'alguna', 'el pollo', 'asd 554', 'Bus', 'axxxa', '12458', 'cadera', 'por ip', 'activo', '', 'ninguna', 'example.png', 1, '1', NULL, '', NULL, NULL, NULL, NULL, NULL, 0.00),
(67, 'wilson barrera', 35, 145785, 'Conductor', '01-11-2019', '3106247129', 'hoedancu92@hotmail.com', 'carrera 20 N 26 - 80', 'yopal', 'dg 34 n 31b', 'el hueso', 'adc 452', 'Bus', 'porvenir', '25478', 'clavicula', 'por soat', 'activo', '', 'ninguna', 'example.png', 1, 'on', 'incompleto', 'historia 1', 'on', 'on', 'on', 'on', 'on', 0.00),
(68, 'andres', 20, 204578, 'Ocupante', '01-11-2019', '310254785', 'sistemas@vestel.com.co ', 'carrera 20 N 26 - 80', 'yopal', 'dg 34 n 31', 'accidente en carro', 'ase 325', 'Automovil', 'oxxa', '456789', 'el hueso', 'por ip', 'activo', '', 'ninguna', 'example.png', 1, 'on', 'completo', '', 'on', 'on', NULL, 'on', 'on', 0.00),
(69, 'Vestel', 458, 4524, 'Conductor', '06-11-2019', '3106247129', 'sistemas@vestel.com.co ', 'carrera 20 N 26 - 80', 'yopal', 'ip', 'ninguno', 'asd 547', 'Taxi', NULL, '45785', 'por ip', 'soat', 'inactivo', 'esta', 'ninguna', 'example.png', 1, 'on', 'incompleto', 'esta', 'on', NULL, 'on', NULL, 'on', 0.00),
(70, 'jhon', 20, 4258, 'Ocupante', '06-11-2019', '3106247129', 'sistemas@vestel.com.co ', 'Dig 34 n 31B - 87', 'Barrera', 'diagonal', 'ninguno', 'ade 458', 'Automovil', 'Bus', '45284', 'asd', 'soat', 'activo', '', 'ninguna', 'example.png', 1, 'on', 'completo', '', NULL, 'on', NULL, 'on', NULL, 0.00),
(71, 'hugo', 25, 45789, 'Ocupante', '06-11-2019', '3106247129', 'sistemas@vestel.com.co ', 'carrera 20 N 26 - 80', 'Barrera', 'remanso', 'caida', 'asd 854', 'Automovil', 'COMPAÑIA MU', '457852', 'el hueso', 'soat', 'activo', '', 'ninguna', 'example.png', 1, 'on', NULL, '', 'on', 'on', 'on', NULL, NULL, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers_group`
--

CREATE TABLE `customers_group` (
  `id` int(10) NOT NULL,
  `title` varchar(60) DEFAULT NULL,
  `summary` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `customers_group`
--

INSERT INTO `customers_group` (`id`, `title`, `summary`) VALUES
(1, 'Default Group', 'Default Group'),
(2, 'Yopal', 'Usuarios sede Yopal'),
(3, 'Villanueva', 'Usuarios sede Villanueva'),
(4, 'Monterrey', 'Usuarios sede Monterrey');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `idDepartamento` int(11) NOT NULL,
  `departamento` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`idDepartamento`, `departamento`) VALUES
(1, 'Casanare'),
(2, 'Putumayo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `cdate` date NOT NULL,
  `permission` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee_profile`
--

CREATE TABLE `employee_profile` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postbox` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phonealt` varchar(15) DEFAULT NULL,
  `picture` varchar(50) NOT NULL DEFAULT 'example.png',
  `sign` varchar(100) DEFAULT 'sign.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employee_profile`
--

INSERT INTO `employee_profile` (`id`, `username`, `name`, `address`, `city`, `region`, `country`, `postbox`, `phone`, `phonealt`, `picture`, `sign`) VALUES
(8, 'admin', 'Yesid Barrera', 'Dig 34 n 31B - 87', 'yopal', NULL, 'Colombia', '850002', '3106247129', '0', 'example.png', 'sign.png'),
(9, 'ANNIEARAGON', 'annie aragon', 'calle 34 n 19 - 67', 'yopal', 'casanare', 'colombia', '85005', '3208318111', NULL, 'example.png', 'sign.png'),
(13, 'super', 'Vestel', 'carrera 20 N 26 - 80', 'yopal', 'casanare', 'Colombia', '850002', '3106247129', NULL, 'example.png', 'sign.png'),
(14, 'indemcol', 'Vestel', 'carrera 20 N 26 - 80', 'yopal', 'casanare', 'Colombia', '850002', '', NULL, 'example.png', 'sign.png'),
(15, 'villanueva', 'Vestel', 'carrera 20 N 26 - 80', 'yopal', 'casanare', 'Colombia', '850002', '', NULL, 'example.png', 'sign.png'),
(16, 'monterrey', 'Vestel', 'carrera 20 N 26 - 80', 'yopal', 'casanare', 'Colombia', '850002', '', NULL, 'example.png', 'sign.png'),
(17, 'presidencia', 'orlando', '', '', '', '', '', '', NULL, 'example.png', 'sign.png'),
(18, 'PaolaJimenez', 'PAOLA', '', '', '', '', '', '', NULL, 'example.png', 'sign.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3a87ad',
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `allDay` varchar(50) NOT NULL DEFAULT 'true',
  `rel` int(2) NOT NULL DEFAULT 0,
  `rid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `color`, `start`, `end`, `allDay`, `rel`, `rid`) VALUES
(1, 'comer', 'ensalada de frutas :)', '#3a87ad', '2020-07-09 00:00:00', '2020-07-10 00:00:00', 'true', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `goals`
--

CREATE TABLE `goals` (
  `id` int(1) NOT NULL,
  `income` bigint(20) NOT NULL,
  `expense` bigint(20) NOT NULL,
  `sales` bigint(20) NOT NULL,
  `netincome` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `goals`
--

INSERT INTO `goals` (`id`, `income`, `expense`, `sales`, `netincome`) VALUES
(1, 9999, 3333, 99999, 100000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `shipping` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `total` decimal(16,2) DEFAULT 0.00,
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') NOT NULL DEFAULT 'due',
  `csd` int(5) NOT NULL DEFAULT 0,
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) DEFAULT 0.00,
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') NOT NULL DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') NOT NULL DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL,
  `multi` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `price` decimal(16,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `totaltax` decimal(16,2) DEFAULT 0.00,
  `totaldiscount` decimal(16,2) DEFAULT 0.00,
  `product_des` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `idLocalidad` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `localidad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`idLocalidad`, `idDepartamento`, `idCiudad`, `localidad`) VALUES
(1, 1, 1, 'Comuna I'),
(2, 1, 1, 'Comuna II'),
(3, 1, 1, 'Comuna III'),
(4, 1, 1, 'Comuna IV'),
(5, 1, 1, 'Comuna V'),
(6, 1, 1, 'Comuna VI'),
(7, 1, 1, 'Comuna VII'),
(8, 2, 20, 'NINGUNA'),
(9, 1, 7, 'Ninguna'),
(10, 1, 19, 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meta_data`
--

CREATE TABLE `meta_data` (
  `id` int(11) NOT NULL,
  `type` int(3) NOT NULL,
  `rid` int(11) NOT NULL,
  `col1` varchar(255) NOT NULL,
  `col2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `milestones`
--

CREATE TABLE `milestones` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `exp` text NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `cdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`, `cdate`) VALUES
(1, 'tarea1', '<p>no tengo que hacer nada<br></p>', '2020-07-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `online_payment`
--

CREATE TABLE `online_payment` (
  `id` int(11) NOT NULL,
  `default_acid` int(11) NOT NULL DEFAULT 1,
  `currency_code` varchar(3) NOT NULL,
  `enable` int(1) NOT NULL,
  `bank` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `online_payment`
--

INSERT INTO `online_payment` (`id`, `default_acid`, `currency_code`, `enable`, `bank`) VALUES
(1, 1, 'USD', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `enable` enum('Yes','No') NOT NULL,
  `key1` varchar(255) NOT NULL,
  `key2` varchar(255) DEFAULT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `dev_mode` enum('true','false') NOT NULL,
  `ord` int(5) NOT NULL,
  `surcharge` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `enable`, `key1`, `key2`, `currency`, `dev_mode`, `ord`, `surcharge`) VALUES
(1, 'Stripe', 'Yes', 'sk_test_secratekey', 'sk_test_publickey', 'USD', 'true', 1, '0.00'),
(2, 'Authorize.Net', 'Yes', 'TRANSACTIONKEY', 'LOGINID', 'AUD', 'true', 2, '0.00'),
(3, 'Pin Payments', 'Yes', 'TEST', 'none', 'AUD', 'true', 3, '0.00'),
(4, 'PayPal', 'Yes', 'MyPayPalClientId', 'MyPayPalSecret', 'USD', 'true', 4, '0.00'),
(5, 'SecurePay', 'Yes', 'ABC0001', 'abc123', 'AUD', 'true', 5, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pcat` int(3) NOT NULL DEFAULT 1,
  `warehouse` int(11) NOT NULL DEFAULT 1,
  `product_name` varchar(50) NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_price` decimal(16,2) DEFAULT 0.00,
  `fproduct_price` decimal(16,2) NOT NULL DEFAULT 0.00,
  `taxrate` decimal(16,2) NOT NULL DEFAULT 0.00,
  `disrate` decimal(16,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL,
  `product_des` text DEFAULT NULL,
  `alert` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`pid`, `pcat`, `warehouse`, `product_name`, `product_code`, `product_price`, `fproduct_price`, `taxrate`, `disrate`, `qty`, `product_des`, `alert`) VALUES
(8, 2, 5, 'Cable Rg6', 'Mi', '95000.00', '95000.00', '0.00', '0.00', 8, 'Carretas de 305 metros', 2),
(9, 3, 5, 'Cable Rg11', 'Mo', '310000.00', '310000.00', '0.00', '0.00', 6, 'Carretas de 305m', 2),
(10, 2, 5, 'Conectores Rg6', 'Mi', '560.00', '560.00', '0.00', '0.00', 601, 'Conectores para cable Rg6 por unidad', 100),
(11, 3, 5, 'Conectores Rg11', 'Mo', '2200.00', '2200.00', '0.00', '0.00', 114, 'Conectores para cable Rg11 por unidad', 50),
(12, 2, 5, 'Tap Dc 6', 'Mi', '2500.00', '2500.00', '0.00', '0.00', 30, '', 10),
(13, 2, 5, 'Spliter X2 vias', 'Mi', '2400.00', '2400.00', '0.00', '0.00', 100, '', 10),
(14, 2, 5, 'Spliter X3 vias', 'Mi', '2900.00', '2900.00', '0.00', '0.00', 50, '', 10),
(15, 3, 5, 'Multitap X4 vias', 'Mo', '25000.00', '25000.00', '0.00', '0.00', 8, '', 4),
(16, 3, 5, 'Multitap X8 vias', 'Mo', '35000.00', '35000.00', '0.00', '0.00', 6, '', 4),
(17, 3, 5, 'Conector Pin 500', 'Mo', '10000.00', '10000.00', '0.00', '0.00', 2, '', 1),
(18, 3, 5, 'Power Inset', 'Mo', '39000.00', '39000.00', '0.00', '0.00', 1, '', 1),
(19, 2, 5, 'Spliter X4 vias', 'Mo', '3500.00', '3500.00', '0.00', '0.00', 1, '', 1),
(20, 3, 5, 'Cinta autofundente', 'Mo', '19000.00', '19000.00', '0.00', '0.00', 2, '', 1),
(21, 3, 5, 'Candados', 'Mo', '1000.00', '1000.00', '0.00', '0.00', 18, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_cat`
--

CREATE TABLE `product_cat` (
  `id` int(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `extra` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product_cat`
--

INSERT INTO `product_cat` (`id`, `title`, `extra`) VALUES
(1, 'General', 'General Product Category'),
(2, 'Material indoor', 'material para mantenimiento e instalaciones'),
(3, 'Material Outdoor', 'Material para mantenimiento de redes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_warehouse`
--

CREATE TABLE `product_warehouse` (
  `id` int(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `extra` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product_warehouse`
--

INSERT INTO `product_warehouse` (`id`, `title`, `extra`) VALUES
(2, 'Almacen Yopal', 'material de instalaciones'),
(3, 'Almacen Monterrey', 'materiales sede monterrey'),
(4, 'Almacen Villanueva', 'Materiales sede Villanueva'),
(5, 'Dicelar', 'almacen de probeedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `p_id` varchar(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Waiting','Pending','Terminated','Finished','Progress') NOT NULL DEFAULT 'Pending',
  `priority` enum('Low','Medium','High','Urgent') NOT NULL DEFAULT 'Medium',
  `progress` int(3) NOT NULL,
  `cid` int(11) NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `phase` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `worth` decimal(16,2) NOT NULL DEFAULT 0.00,
  `ptype` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_meta`
--

CREATE TABLE `project_meta` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `meta_key` int(11) NOT NULL,
  `meta_data` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `key3` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `shipping` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `total` decimal(16,2) DEFAULT 0.00,
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial','end') DEFAULT 'due',
  `csd` int(5) NOT NULL DEFAULT 0,
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) DEFAULT 0.00,
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT NULL,
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `purchase`
--

INSERT INTO `purchase` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`) VALUES
(9, 1001, '2019-11-22', '2019-11-22', '774690.00', '0.00', '0.00', '123690.00', '774690.00', 'Cash', '', 'paid', 12, 8, '774690.00', 3, 'yes', 1, '%', 'yopal', 2),
(10, 1002, '2019-11-25', '2019-11-25', '311560.00', '0.00', '0.00', '0.00', '311560.00', NULL, '', 'due', 12, 8, '0.00', 3, '', 1, '%', NULL, 1),
(11, 1003, '2019-11-25', '2019-11-25', '313200.00', '0.00', '0.00', '0.00', '313200.00', NULL, '', 'paid', 12, 8, '0.00', 3, '', 1, '%', 'yopal', 1),
(12, 1004, '2019-11-25', '2019-11-25', '810000.00', '0.00', '0.00', '0.00', '810000.00', NULL, '', 'canceled', 10, 8, '0.00', 12, '', 1, '%', 'yopal', 1),
(13, 1005, '2019-11-25', '2019-11-25', '136400.00', '0.00', '0.00', '0.00', '136400.00', NULL, '', 'due', 10, 8, '0.00', 28, '', 1, '%', '', 1),
(14, 1006, '2019-11-26', '2019-11-26', '339000.00', '0.00', '0.00', '0.00', '339000.00', NULL, '', 'due', 14, 8, '0.00', 3, '', 1, '%', 'villanueva', 2),
(15, 1007, '2019-11-26', '2019-11-26', '2332400.00', '0.00', '0.00', '372400.00', '2332400.00', NULL, '', 'partial', 15, 8, '0.00', 1, 'yes', 1, '%', 'Yopal', 2),
(16, 1008, '2019-11-27', '2019-11-27', '312200.00', '0.00', '0.00', '0.00', '312200.00', NULL, '', 'due', 12, 8, '0.00', 2, 'yes', 1, '%', 'yopal', 2),
(17, 1009, '2019-11-27', '2019-11-27', '96190.00', '0.00', '0.00', '190.00', '96190.00', NULL, '', 'canceled', 12, 8, '0.00', 2, 'yes', 1, 'flat', 'yopal', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `totaltax` decimal(16,2) DEFAULT 0.00,
  `totaldiscount` decimal(16,2) DEFAULT 0.00,
  `product_des` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `tid`, `pid`, `product`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`) VALUES
(41, 1002, 9, 'Cable Rg11', 1, '310000.00', '0.00', '0.00', '310000.00', '0.00', '0.00', 'Carretas de 305m'),
(42, 1002, 10, 'Conectores Rg6', 1, '560.00', '0.00', '0.00', '560.00', '0.00', '0.00', 'Conectores para cable Rg6 por unidad'),
(43, 1002, 21, 'Candados', 1, '1000.00', '0.00', '0.00', '1000.00', '0.00', '0.00', ''),
(56, 1003, 9, 'Cable Rg11', 1, '310000.00', '0.00', '0.00', '310000.00', '0.00', '0.00', 'Carretas de 305m'),
(57, 1003, 21, 'Candados', 1, '1000.00', '0.00', '0.00', '1000.00', '0.00', '0.00', ''),
(58, 1003, 11, 'Conectores Rg11', 1, '2200.00', '0.00', '0.00', '2200.00', '0.00', '0.00', 'Conectores para cable Rg11 por unidad'),
(59, 1004, 9, 'Cable Rg11', 1, '310000.00', '0.00', '0.00', '310000.00', '0.00', '0.00', 'Carretas de 305m'),
(60, 1004, 9, 'Cable Rg11', 1, '310000.00', '0.00', '0.00', '310000.00', '0.00', '0.00', 'Carretas de 305m'),
(61, 1004, 20, 'Cinta autofundente', 10, '19000.00', '0.00', '0.00', '190000.00', '0.00', '0.00', ''),
(62, 1005, 21, 'Candados', 15, '1000.00', '0.00', '0.00', '15000.00', '0.00', '0.00', ''),
(63, 1005, 11, 'Conectores Rg11', 12, '2200.00', '0.00', '0.00', '26400.00', '0.00', '0.00', 'Conectores para cable Rg11 por unidad'),
(64, 1005, 8, 'Cable Rg6', 1, '95000.00', '0.00', '0.00', '95000.00', '0.00', '0.00', 'Carretas de 305 metros'),
(65, 1006, 17, 'Conector Pin 500', 1, '10000.00', '0.00', '0.00', '10000.00', '0.00', '0.00', ''),
(66, 1006, 9, 'Cable Rg11', 1, '310000.00', '0.00', '0.00', '310000.00', '0.00', '0.00', 'Carretas de 305m'),
(67, 1006, 20, 'Cinta autofundente', 1, '19000.00', '0.00', '0.00', '19000.00', '0.00', '0.00', ''),
(70, 1007, 0, 'Cable modem EOC', 20, '98000.00', '19.00', '0.00', '2332400.00', '372400.00', '0.00', ''),
(71, 1008, 11, 'Conectores Rg11', 1, '2200.00', '0.00', '0.00', '2200.00', '0.00', '0.00', 'Conectores para cable Rg11 por unidad'),
(72, 1008, 9, 'Cable Rg11', 1, '310000.00', '0.00', '0.00', '310000.00', '0.00', '0.00', 'Carretas de 305m'),
(73, 1009, 21, 'Candados', 1, '1000.00', '19.00', '0.00', '1190.00', '190.00', '0.00', ''),
(74, 1009, 8, 'Cable Rg6', 1, '95000.00', '0.00', '0.00', '95000.00', '0.00', '0.00', 'Carretas de 305 metros'),
(76, 1001, 10, 'Conectores Rg6', 100, '560.00', '19.00', '0.00', '66640.00', '10640.00', '0.00', 'Conectores para cable Rg6 por unidad'),
(77, 1001, 8, 'Cable Rg6', 5, '95000.00', '19.00', '0.00', '565250.00', '90250.00', '0.00', 'Carretas de 305 metros'),
(78, 1001, 13, 'Spliter X2 vias', 50, '2400.00', '19.00', '0.00', '142800.00', '22800.00', '0.00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `shipping` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `total` decimal(16,2) DEFAULT 0.00,
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `csd` int(5) NOT NULL DEFAULT 0,
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) NOT NULL,
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL,
  `proposal` text DEFAULT NULL,
  `multi` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotes_items`
--

CREATE TABLE `quotes_items` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `totaltax` decimal(16,2) DEFAULT 0.00,
  `totaldiscount` decimal(16,2) DEFAULT 0.00,
  `product_des` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rec_invoices`
--

CREATE TABLE `rec_invoices` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `shipping` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `total` decimal(16,2) DEFAULT 0.00,
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') NOT NULL DEFAULT 'due',
  `csd` int(5) NOT NULL DEFAULT 0,
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) DEFAULT 0.00,
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') DEFAULT 'yes',
  `discstatus` tinyint(1) DEFAULT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL,
  `rec` varchar(10) NOT NULL,
  `ron` enum('Recurring','Stopped') DEFAULT 'Recurring',
  `multi` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rec_invoices`
--

INSERT INTO `rec_invoices` (`id`, `tid`, `invoicedate`, `invoiceduedate`, `subtotal`, `shipping`, `discount`, `tax`, `total`, `pmethod`, `notes`, `status`, `csd`, `eid`, `pamnt`, `items`, `taxstatus`, `discstatus`, `format_discount`, `refer`, `term`, `rec`, `ron`, `multi`) VALUES
(1, 1001, '2019-09-13', '2019-10-13', '70000.00', '0.00', '0.00', '0.00', '70000.00', 'Cash', '', 'paid', 1, 8, '70000.00', 2, 'yes', 1, '%', '01', 1, '30 day', 'Recurring', 1),
(2, 1002, '2019-12-06', '2019-12-06', '25000.00', '0.00', '0.00', '0.00', '25000.00', NULL, '', 'due', 60, 8, '0.00', 1, '', 1, '%', '12456', 2, '7 day', 'Recurring', 0),
(3, 1003, '2019-12-06', '2020-01-05', '15000.00', '0.00', '0.00', '0.00', '15000.00', 'Cash', '', 'paid', 60, 8, '15000.00', 1, '', 1, '%', '', 2, '30 day', 'Recurring', 1),
(4, 1004, '2019-12-06', '2019-12-06', '55000.00', '0.00', '0.00', '0.00', '55000.00', NULL, '', 'due', 70, 8, '0.00', 1, '', 1, '%', '45214', 2, '30 day', 'Recurring', 0),
(5, 1005, '2019-12-07', '2019-12-07', '95000.00', '0.00', '0.00', '0.00', '95000.00', NULL, '', 'due', 60, 8, '0.00', 1, '', 1, '%', '', 2, '30 day', 'Recurring', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rec_invoice_items`
--

CREATE TABLE `rec_invoice_items` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `totaltax` decimal(16,2) DEFAULT 0.00,
  `totaldiscount` decimal(16,2) DEFAULT 0.00,
  `product_des` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rec_invoice_items`
--

INSERT INTO `rec_invoice_items` (`id`, `tid`, `pid`, `product`, `qty`, `price`, `tax`, `discount`, `subtotal`, `totaltax`, `totaldiscount`, `product_des`) VALUES
(1, 1001, 0, 'television', 1, '25000.00', '0.00', '0.00', '25000.00', '0.00', '0.00', ''),
(2, 1001, 0, 'internet', 1, '45000.00', '0.00', '0.00', '45000.00', '0.00', '0.00', ''),
(3, 1002, 0, 'television', 1, '25000.00', '0.00', '0.00', '25000.00', '0.00', '0.00', ''),
(4, 1003, 0, 'reconeccion', 1, '15000.00', '0.00', '0.00', '15000.00', '0.00', '0.00', ''),
(5, 1004, 0, 'internet', 1, '55000.00', '0.00', '0.00', '55000.00', '0.00', '0.00', ''),
(6, 1005, 8, 'Cable Rg6+', 1, '95000.00', '0.00', '0.00', '95000.00', '0.00', '0.00', 'Carretas de 305 metros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `month` varchar(10) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `invoices` int(11) NOT NULL,
  `sales` decimal(16,2) DEFAULT 0.00,
  `items` int(11) NOT NULL,
  `income` decimal(16,2) DEFAULT 0.00,
  `expense` decimal(16,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_return`
--

CREATE TABLE `stock_return` (
  `id` int(11) NOT NULL,
  `tid` int(8) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `shipping` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `total` decimal(16,2) DEFAULT 0.00,
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('pending','accepted','rejected','partial','canceled') DEFAULT 'pending',
  `csd` int(5) NOT NULL DEFAULT 0,
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) DEFAULT 0.00,
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT NULL,
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_return_items`
--

CREATE TABLE `stock_return_items` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT 0.00,
  `tax` decimal(16,2) DEFAULT 0.00,
  `discount` decimal(16,2) DEFAULT 0.00,
  `subtotal` decimal(16,2) DEFAULT 0.00,
  `totaltax` decimal(16,2) DEFAULT 0.00,
  `totaldiscount` decimal(16,2) DEFAULT 0.00,
  `product_des` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `region` text DEFAULT NULL,
  `cuenta` varchar(50) DEFAULT NULL,
  `typo` varchar(50) DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'example.png',
  `gid` int(5) NOT NULL DEFAULT 1,
  `company` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `nit`, `phone`, `email`, `address`, `city`, `region`, `cuenta`, `typo`, `banco`, `picture`, `gid`, `company`) VALUES
(10, 'Hesham Mansour', '52311478', '3108198138', 'requerir', 'Cra 134 # 46 - 35', 'bogota', 'bogota', '226-566750-91', 'Ahorros', 'Bancolombia', 'example.png', 1, 'Sussy kwan technology'),
(11, 'globotecto LTDA', '900106749-9', '312 8119528', 'requerir', 'Cll 50 N 71 120  estadio', 'medellin', 'antioquia', '60964210198', 'Ahorros', 'Bancolombia', 'example.png', 1, 'globotecto LTDA'),
(12, 'Carlos lozano', '900.981.204-9', '3869541', 'requerir', 'CLL 145A N 45A-47', 'Bogota', 'Bogota', '60100035190', 'Ahorros', 'Bancolombia', 'example.png', 1, 'DICELAR S.A.S'),
(13, 'Luis Carlos Torres', '9084681', '3108723936', 'requerir', 'cra 114f # 147 11 apt 101', 'Bogota', 'Bogota', '634-809777-36', 'Ahorros', 'Bancolombia', 'example.png', 1, 'Luis Carlos Torres'),
(14, 'CARLOS ALBERTO DE AVILA DIAZ', '80187997', 'n', 'n', 'n', 'villavicencio', 'Meta', '03106638632', 'Ahorros', 'Bancolombia', 'example.png', 1, 'CARLOS ALBERTO DE AVILA DIAZ'),
(15, 'Latinoamericana TCA s.a.s', '811017576-7', '3135660007', 'solicitar', 'Carrera 51a N° 10 sur 81 ', 'Medellin', 'Antioquia', '10382318160', 'Ahorros', 'Bancolombia', 'example.png', 1, 'Latinoamericana TCA s.a.s');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_smtp`
--

CREATE TABLE `sys_smtp` (
  `id` int(11) NOT NULL,
  `host` varchar(100) NOT NULL,
  `port` int(11) NOT NULL,
  `auth` enum('true','false') NOT NULL,
  `auth_type` enum('none','tls','ssl') NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_smtp`
--

INSERT INTO `sys_smtp` (`id`, `host`, `port`, `auth`, `auth_type`, `username`, `password`, `sender`) VALUES
(1, 'smtp.com', 587, 'true', 'none', 'support@example.com', '123456', 'support@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `cid` int(11) NOT NULL,
  `status` enum('Solved','Processing','Waiting') NOT NULL,
  `section` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_th`
--

CREATE TABLE `tickets_th` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `cid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `attach` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `tdate` date NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` enum('Due','Done','Progress') NOT NULL DEFAULT 'Due',
  `start` date NOT NULL,
  `duedate` date NOT NULL,
  `description` text DEFAULT NULL,
  `eid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `related` int(11) NOT NULL,
  `priority` enum('Low','Medium','High','Urgent') NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `todolist`
--

INSERT INTO `todolist` (`id`, `tdate`, `name`, `status`, `start`, `duedate`, `description`, `eid`, `aid`, `related`, `priority`, `rid`) VALUES
(1, '2020-07-09', 'ase', 'Done', '2020-07-09', '2020-07-09', '<p>realizar aseo de los equipos</p>', 8, 8, 0, 'Medium', 0),
(2, '2019-11-02', 'enviar mensajes', 'Progress', '2019-11-02', '2019-11-02', '<p>realizar <span style=\"background-color: rgb(255, 255, 0);\">envio </span>de mensales<br></p>', 13, 16, 0, 'Low', 0),
(3, '2019-12-02', 'casa', 'Done', '2019-12-02', '2019-12-02', '', 13, 8, 0, 'Urgent', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `acid` int(11) NOT NULL,
  `account` varchar(200) NOT NULL,
  `type` enum('Income','Expense','Transfer') NOT NULL,
  `cat` varchar(200) NOT NULL,
  `debit` decimal(16,2) DEFAULT 0.00,
  `credit` decimal(16,2) DEFAULT 0.00,
  `payer` varchar(200) DEFAULT NULL,
  `payerid` int(11) NOT NULL DEFAULT 0,
  `method` varchar(200) DEFAULT NULL,
  `date` date NOT NULL,
  `tid` int(11) NOT NULL DEFAULT 0,
  `eid` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `ext` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transactions`
--

INSERT INTO `transactions` (`id`, `acid`, `account`, `type`, `cat`, `debit`, `credit`, `payer`, `payerid`, `method`, `date`, `tid`, `eid`, `note`, `ext`) VALUES
(1, 1, 'Company Sales Account', 'Income', 'Sales', '0.00', '70000.00', 'Vestel', 1, 'Cash', '2019-09-13', 1001, 8, 'Payment for invoice #1001', 2),
(2, 2, 'Dicelar', 'Expense', 'Purchase', '2096400.00', '0.00', 'Dicelar', 1, 'Cash', '2019-11-07', 10035, 8, 'Payment for purchase #10035', 1),
(3, 2, 'Dicelar', 'Expense', 'Purchase', '100000.00', '0.00', 'Dicelar', 1, 'Cash', '2019-11-08', 1001, 8, 'Payment for purchase #1001', 1),
(4, 1, 'Company Sales Account', 'Expense', 'Purchase', '725000.00', '0.00', 'Dicelar', 1, 'Cash', '2019-11-18', 10036, 8, 'Payment for purchase #10036', 1),
(5, 1, 'Company Sales Account', 'Expense', 'Purchase', '774690.00', '0.00', 'Carlos lozano', 12, 'Cash', '2019-11-22', 1001, 8, 'Payment for purchase #1001', 1),
(6, 1, 'Company Sales Account', 'Income', 'Ventas', '0.00', '300000.00', 'Yopal', 0, 'Cash', '2019-12-02', 0, 8, '', 0),
(7, 1, 'Company Sales Account', 'Income', 'Sales', '0.00', '15000.00', 'camilo', 60, 'Cash', '2019-12-06', 1003, 8, 'Payment for invoice #1003', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions_cat`
--

CREATE TABLE `transactions_cat` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transactions_cat`
--

INSERT INTO `transactions_cat` (`id`, `name`) VALUES
(1, 'Ventas'),
(2, 'Compra'),
(3, 'Cartera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `univarsal_api`
--

CREATE TABLE `univarsal_api` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `key1` varchar(255) DEFAULT NULL,
  `key2` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `method` varchar(10) DEFAULT NULL,
  `other` text DEFAULT NULL,
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `univarsal_api`
--

INSERT INTO `univarsal_api` (`id`, `name`, `key1`, `key2`, `url`, `method`, `other`, `active`) VALUES
(1, 'Goo.gl URL Shortner', 'yourkey', '0', '0', '0', '0', 0),
(2, 'Twilio SMS API', 'ac', 'key', '+11234567', '0', '0', 1),
(3, 'Company Support', '1', '1', 'support@gmail.com', NULL, '<p>realizar actividad</p><p>Your footer</p>', 1),
(4, 'Currency', '', '.', '0', 'l', NULL, NULL),
(5, 'Exchange', 'key1', 'key2', 'COP', NULL, NULL, 1),
(6, 'New Invoice Notification', '[{Company}] Invoice #{BillNumber} Generated', NULL, NULL, NULL, 'Dear Client,\r\nWe are contacting you in regard to a payment received for invoice # {BillNumber} that has been created on your account. You may find the invoice with below link.\r\n\r\nView Invoice\r\n{URL}\r\n\r\nWe look forward to conducting future business with you.\r\n\r\nKind Regards,\r\nTeam\r\n{CompanyDetails}', NULL),
(7, 'Invoice Payment Reminder', '[{Company}] Invoice #{BillNumber} Payment Reminder', NULL, NULL, NULL, '<p>Dear Client,</p><p>We are contacting you in regard to a payment reminder of invoice # {BillNumber} that has been created on your account. You may find the invoice with below link. Please pay the balance of {Amount} due by {DueDate}.</p><p>\r\n\r\n<b>View Invoice</b></p><p><span style=\"font-size: 1rem;\">{URL}\r\n</span></p><p><span style=\"font-size: 1rem;\">\r\nWe look forward to conducting future business with you.</span></p><p><span style=\"font-size: 1rem;\">\r\n\r\nKind Regards,\r\n</span></p><p><span style=\"font-size: 1rem;\">\r\nTeam\r\n</span></p><p><span style=\"font-size: 1rem;\">\r\n{CompanyDetails}</span></p>', NULL),
(8, 'Invoice Refund Proceeded', '{Company} Invoice #{BillNumber} Refund Proceeded', NULL, NULL, NULL, '<p>Dear Client,</p><p>\r\nWe are contacting you in regard to a refund request processed for invoice # {BillNumber} that has been created on your account. You may find the invoice with below link. Please pay the balance of {Amount}  by {DueDate}.\r\n</p><p>\r\nView Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.\r\n</p><p>\r\nKind Regards,\r\n</p><p>\r\nTeam\r\n\r\n{CompanyDetails}</p>', NULL),
(9, 'Invoice payment Received', '{Company} Payment Received for Invoice #{BillNumber}', NULL, NULL, NULL, '<p>Dear Client,\r\n</p><p>We are contacting you in regard to a payment received for invoice  # {BillNumber} that has been created on your account. You can find the invoice with below link.\r\n</p><p>\r\nView Invoice</p><p>\r\n{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.\r\n</p><p>\r\nKind Regards,\r\n</p><p>\r\nTeam\r\n</p><p>\r\n{CompanyDetails}</p>', NULL),
(10, 'Invoice Overdue Notice', '{Company} Invoice #{BillNumber} Generated for you', NULL, NULL, NULL, '<p>Dear Client,</p><p>\r\nWe are contacting you in regard to an Overdue Notice for invoice # {BillNumber} that has been created on your account. You may find the invoice with below link.\r\nPlease pay the balance of {Amount} due by {DueDate}.\r\n</p><p>View Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.\r\n</p><p>\r\nKind Regards,\r\n</p><p>\r\nTeam</p><p>\r\n\r\n{CompanyDetails}</p>', NULL),
(11, 'Quote Proposal', '{Company} Quote #{BillNumber} Generated for you', NULL, NULL, NULL, '<p>Dear Client,</p><p>\r\nWe are contacting you in regard to a new quote # {BillNumber} that has been created on your account. You may find the quote with below link.\r\n</p><p>\r\nView Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.</p><p>\r\n\r\nKind Regards,</p><p>\r\n\r\nTeam</p><p>\r\n\r\n{CompanyDetails}</p>', NULL),
(12, 'Purchase Order Request', '{Company} Purchase Order #{BillNumber} Requested', NULL, NULL, NULL, '<p>Dear Client,\r\n</p><p>We are contacting you in regard to a new purchase # {BillNumber} that has been requested on your account. You may find the order with below link. </p><p>\r\n\r\nView Invoice\r\n</p><p>{URL}</p><p>\r\n\r\nWe look forward to conducting future business with you.</p><p>\r\n\r\nKind Regards,\r\n</p><p>\r\nTeam</p><p>\r\n\r\n{CompanyDetails}</p>', NULL),
(13, 'Stock Return Mail', '{Company} New purchase return # {BillNumber}', NULL, NULL, NULL, 'Dear Client,\r\n\r\nWe are contacting you in regard to a new purchase return # {BillNumber} that has been requested on your account. You may find the order with below link.\r\n\r\nView Invoice\r\n\r\n{URL}\r\n\r\nWe look forward to conducting future business with you.\r\n\r\nKind Regards,\r\n\r\nTeam\r\n\r\n{CompanyDetails}', NULL),
(30, 'New Invoice Notification', NULL, NULL, NULL, NULL, 'Dear Customer, new invoice  # {BillNumber} generated. {URL} Regards', NULL),
(31, 'Invoice Payment Reminder', NULL, NULL, NULL, NULL, 'Dear Customer, Please make payment of invoice  # {BillNumber}. {URL} Regards', NULL),
(32, 'Invoice Refund Proceeded', NULL, NULL, NULL, NULL, 'Dear Customer, Refund generated of invoice # {BillNumber}. {URL} Regards', NULL),
(33, 'Invoice payment Received', NULL, NULL, NULL, NULL, 'Dear Customer, Payment received of invoice # {BillNumber}. {URL} Regards', NULL),
(34, 'Invoice Overdue Notice', NULL, NULL, NULL, NULL, 'Dear Customer, Dear Customer,Payment is overdue of invoice # {BillNumber}. {URL} Regards', NULL),
(35, 'Quote Proposal', NULL, NULL, NULL, NULL, 'Dear Customer, Dear Customer, a quote created for you # {BillNumber}. {URL} Regards', NULL),
(36, 'Purchase Order Request', NULL, NULL, NULL, NULL, 'Dear Customer, Dear, a purchased order for you # {BillNumber}. {URL} Regards', NULL),
(51, 'QT#', 'PO#', 'REC#', 'SR#', 'TRN#', 'SRN#', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `var_key` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`users_id`, `user_id`, `var_key`, `status`, `is_deleted`, `name`, `password`, `email`, `profile_pic`, `user_type`, `cid`) VALUES
(7, '1', NULL, 'active', '0', 'Vestel', '$2y$10$j.lj9kmQMIR6WGIokucdjuDqNqNGcNfhvT1427Eql0F92N..q5yVi', 'yeyoco05@hotmail.com', NULL, 'Member', 8),
(8, '1', NULL, 'active', '0', 'Vestel', '$2y$10$jP6xLvBpsmTzk25t345i/O17hOu.5zv8/3R8ILMKEo/qIomIMP9Nq', 'sistemas@vestel.com.co', NULL, 'Member', 9),
(9, '1', NULL, 'active', '0', 'Vesga telecomunicaciones', '$2y$10$hBhn6osPdZzYIhNtYNut2ufM6Drit.SWQ1oIs1uJgaU5pQYaU5aKq', 'hoedancu92@hotmail.com', NULL, 'Member', 10),
(14, '1', NULL, 'active', '0', 'Vestel', '$2y$10$lIepbykfaNvfG7NFFx4hz.s.UmIikuuMgBulRGUmcMz/MigpThxYu', 'sistemas@vestel.com.co ', NULL, 'Member', 15),
(15, '1', NULL, 'active', '0', 'Yesid Barrera', '$2y$10$XkTNEP1Y2erVyLcjMQqILOz43wEODKMAQViHxgdoeBOLMHwMWaXOm', 'sistemas@vestel.com.co', NULL, 'Member', 16),
(16, '1', NULL, 'active', '0', 'Yesid Barrera', '$2y$10$QIAn3uMFe/aWTkzioqPzWuxUTw5TX1qseG2GiI/gAHdbKzDNWk0Z.', 'sistemas@vestel.com.co ', NULL, 'Member', 17),
(53, '1', NULL, 'active', '0', 'Yesid Barrera', '$2y$10$C.LavoEWXXmdxSfenLeNjO53MnPy2rQHAGRe58UhUnu.N35M9sI6S', 'administrador@yopal.com', NULL, 'Member', 54),
(54, '1', NULL, 'active', '0', 'Yesid Barrera', '$2y$10$PVYK7aXEZujvxyaOM87eiuDRAWyJisDNPcSBGXidoClpI1jJkB2jC', 'administrador@yopal.com', NULL, 'Member', 55),
(55, '1', NULL, 'active', '0', 'Yesid Barrera', '$2y$10$bK2uZnzVMyEkkeIkhYrIZ.QvheCP2r/bPMRYYeQiVZTR30F0dkEpW', 'sistemas@vestel.com.co', NULL, 'Member', 56),
(56, '1', NULL, 'active', '0', 'annie', '$2y$10$IFZdzR.j109v8AwT4BG82uSrcNaiLQnLIYg9fLAdzXV28KSkn/7su', 'yeyoco05@hotmail.com', NULL, 'Member', 57),
(57, '1', NULL, 'active', '0', 'Yesid Barrera', '$2y$10$/kk2GawJleXDwnrmo5n.I.htyEYycmZtys3ddbMc35cK7SuC7sp2a', 'yeyoco05@hotmail.com', NULL, 'Member', 58),
(58, '1', NULL, 'active', '0', 'Vestel', '$2y$10$tfTyEMLOy3y7a4LHlxpQ5eUXcxhRuoKACEny9JJozjYCFhN84Btqi', 'yeyoco05@hotmail.com', NULL, 'Member', 59),
(59, '1', NULL, 'active', '0', 'camilo', '$2y$10$w7WbtY17En4ddZj6U/Nl8.RNfC3ekvinMbHmzlbibkDLt7VibLFfC', 'sistemas@vestel.com.co ', NULL, 'Member', 60),
(60, '1', NULL, 'active', '0', 'Yesid Barrera', '$2y$10$z.JSbS45q77PAw.D5QZQBOqLFAuzjMS4RxovpgdlhJk/2aDTEyove', 'yeyoco05@hotmail.com', NULL, 'Member', 61),
(61, '1', NULL, 'active', '0', 'Vestel', '$2y$10$EV1b8D.gh9mhU7RFWkTFBuos0KzVZmSrOTXLWDG6CYwKXbn/S6ODm', 'administrador@yopal.com', NULL, 'Member', 62),
(62, '1', NULL, 'active', '0', 'yadirta', '$2y$10$U/xYi//H1nqfuXqRmqBFVutk5vOUDZwST5VTf5XSHIX4aHe76MAsS', 'sistemas@vestel.com.co ', NULL, 'Member', 63),
(63, '1', NULL, 'active', '0', 'yusmeri duarte', '$2y$10$0l9I9HjPypFQThekeGVYqe7nIuHKomaEEToyFcRxRux6tV7Gzmx1q', 'yusmery1991@gmail.com', NULL, 'Member', 64),
(64, '1', NULL, 'active', '0', 'Vestel', '$2y$10$oQpolBz01IyTcKyz3wfBb.i65xHCeFgMU.PVAqUQ8XgJi2eZQPucC', 'hoedancu92@hotmail.com', NULL, 'Member', 65),
(65, '1', NULL, 'active', '0', 'jhon fredi', '$2y$10$nvwQqk8XEWSZv919GDr/heogOeLJaFFSWOeRr8tDh8qNcEWUyUuk.', 'yeyoco05@hotmail.com', NULL, 'Member', 66),
(66, '1', NULL, 'active', '0', 'wilson barrera', '$2y$10$A6QsS4jWSDQdW8rJCPaKne6YoAEMt72E9ZupTXCEx/lvdtdzjGuB2', 'hoedancu92@hotmail.com', NULL, 'Member', 67),
(67, '1', NULL, 'active', '0', 'andres', '$2y$10$anZUwZ61oTzjAIYnqcJp6uLc4HAemkzdDZhxD79z5EJeYCwO9hE6e', 'sistemas@vestel.com.co ', NULL, 'Member', 68),
(68, '1', NULL, 'active', '0', 'Vestel', '$2y$10$AwGabqH56H34Dj88AFr2ZubeLmCvj5tCZ2GPp0.MfDnyX.os5UkWi', 'sistemas@vestel.com.co ', NULL, 'Member', 69),
(69, '1', NULL, 'active', '0', 'jhon', '$2y$10$39FIDxWEsSzZQUChVQUVAezLxnpIUVGrXI4n0vIlaE5Wury9Fv042', 'sistemas@vestel.com.co ', NULL, 'Member', 70),
(70, '1', NULL, 'active', '0', 'hugo', '$2y$10$czWWdwkuhks1/SXsn/OkwOTiAXsotlvI4PX/7oZbS8LC0lVymEzBi', 'sistemas@vestel.com.co ', NULL, 'Member', 71);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indices de la tabla `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `username` (`username`);

--
-- Indices de la tabla `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acn` (`acn`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `app_system`
--
ALTER TABLE `app_system`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD PRIMARY KEY (`idBarrio`);

--
-- Indices de la tabla `billing_terms`
--
ALTER TABLE `billing_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idCiudad`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `conf`
--
ALTER TABLE `conf`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `corn_job`
--
ALTER TABLE `corn_job`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gid` (`gid`);

--
-- Indices de la tabla `customers_group`
--
ALTER TABLE `customers_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employee_profile`
--
ALTER TABLE `employee_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel` (`rel`),
  ADD KEY `rid` (`rid`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`tid`),
  ADD KEY `eid` (`eid`),
  ADD KEY `csd` (`csd`);

--
-- Indices de la tabla `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice` (`tid`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`idLocalidad`);

--
-- Indices de la tabla `meta_data`
--
ALTER TABLE `meta_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `rid` (`rid`);

--
-- Indices de la tabla `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `online_payment`
--
ALTER TABLE `online_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pcat` (`pcat`),
  ADD KEY `warehouse` (`warehouse`);

--
-- Indices de la tabla `product_cat`
--
ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_warehouse`
--
ALTER TABLE `product_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indices de la tabla `project_meta`
--
ALTER TABLE `project_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `meta_key` (`meta_key`),
  ADD KEY `key3` (`key3`);

--
-- Indices de la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`tid`),
  ADD KEY `eid` (`eid`),
  ADD KEY `csd` (`csd`);

--
-- Indices de la tabla `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice` (`tid`);

--
-- Indices de la tabla `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`tid`),
  ADD KEY `eid` (`eid`),
  ADD KEY `csd` (`csd`);

--
-- Indices de la tabla `quotes_items`
--
ALTER TABLE `quotes_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice` (`tid`);

--
-- Indices de la tabla `rec_invoices`
--
ALTER TABLE `rec_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`tid`),
  ADD KEY `eid` (`eid`),
  ADD KEY `csd` (`csd`);

--
-- Indices de la tabla `rec_invoice_items`
--
ALTER TABLE `rec_invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice` (`tid`);

--
-- Indices de la tabla `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock_return`
--
ALTER TABLE `stock_return`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`tid`),
  ADD KEY `eid` (`eid`),
  ADD KEY `csd` (`csd`);

--
-- Indices de la tabla `stock_return_items`
--
ALTER TABLE `stock_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice` (`tid`) KEY_BLOCK_SIZE=1024 USING BTREE;

--
-- Indices de la tabla `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sys_smtp`
--
ALTER TABLE `sys_smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets_th`
--
ALTER TABLE `tickets_th`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tid` (`tid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `eid` (`eid`);

--
-- Indices de la tabla `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transactions_cat`
--
ALTER TABLE `transactions_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `univarsal_api`
--
ALTER TABLE `univarsal_api`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT de la tabla `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `barrio`
--
ALTER TABLE `barrio`
  MODIFY `idBarrio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `billing_terms`
--
ALTER TABLE `billing_terms`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `customers_group`
--
ALTER TABLE `customers_group`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `employee_profile`
--
ALTER TABLE `employee_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `idLocalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `meta_data`
--
ALTER TABLE `meta_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `product_cat`
--
ALTER TABLE `product_cat`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product_warehouse`
--
ALTER TABLE `product_warehouse`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `project_meta`
--
ALTER TABLE `project_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `quotes_items`
--
ALTER TABLE `quotes_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rec_invoices`
--
ALTER TABLE `rec_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rec_invoice_items`
--
ALTER TABLE `rec_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock_return`
--
ALTER TABLE `stock_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock_return_items`
--
ALTER TABLE `stock_return_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tickets_th`
--
ALTER TABLE `tickets_th`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `transactions_cat`
--
ALTER TABLE `transactions_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `univarsal_api`
--
ALTER TABLE `univarsal_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
