-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2017 at 02:19 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_printing`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `ID_BARANG` int(11) NOT NULL,
  `NAMA_BARANG` varchar(255) NOT NULL,
  `SATUAN` varchar(50) DEFAULT NULL,
  `KETERANGAN` mediumtext,
  `JENIS_HARGA` varchar(4) NOT NULL,
  `HARGA_SATUAN` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`ID_BARANG`, `NAMA_BARANG`, `SATUAN`, `KETERANGAN`, `JENIS_HARGA`, `HARGA_SATUAN`) VALUES
(1, 'Mini X Banner ( Alat Banner  )', 'Pcs', NULL, 'SAMA', 4500000),
(2, 'HVS 70gr A3', 'Lbr', NULL, 'BEDA', 0),
(3, 'Ivory 260', 'gr', NULL, 'BEDA', 0),
(4, 'Jasa Desain Logo', 'Pcs', NULL, 'SAMA', 65000);

-- --------------------------------------------------------

--
-- Table structure for table `m_customer`
--

CREATE TABLE `m_customer` (
  `ID_CUSTOMER` int(11) NOT NULL,
  `NAMA_CUSTOMER` varchar(100) DEFAULT NULL,
  `HP_CUSTOMER` varchar(25) DEFAULT NULL,
  `ALAMAT_CUSTOMER` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_customer`
--

INSERT INTO `m_customer` (`ID_CUSTOMER`, `NAMA_CUSTOMER`, `HP_CUSTOMER`, `ALAMAT_CUSTOMER`) VALUES
(1, 'Sartono', '085731020099', 'Jl Tarakan Sulawesi '),
(2, 'Lian Andany', '2347809274', 'jl sidoarjo'),
(3, 'Aditya', '081345345', 'JL. Margomulyo'),
(4, 'Misly', '444444444', 'jl kednidng'),
(5, 'Misly', '12345678', 'jl jalan');

-- --------------------------------------------------------

--
-- Table structure for table `m_karyawan`
--

CREATE TABLE `m_karyawan` (
  `ID_KARYAWAN` int(11) NOT NULL,
  `NAMA_KARYAWAN` varchar(65) NOT NULL,
  `ID_KATEGORI_USER` int(11) NOT NULL,
  `USERNAME` varchar(25) NOT NULL,
  `PASSWORD` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_karyawan`
--

INSERT INTO `m_karyawan` (`ID_KARYAWAN`, `NAMA_KARYAWAN`, `ID_KATEGORI_USER`, `USERNAME`, `PASSWORD`) VALUES
(1, 'Admin Aplikasi', 1, 'admin', '1234'),
(2, 'Indah ( CS 1 )', 2, 'cs_1', '1234'),
(3, 'Kartika ( CS 2 )', 2, 'cs_2', '1234'),
(4, 'Andika ( OP Grafis 1 )', 3, 'grafis_1', '1234'),
(5, 'Eka ( OP Grafis 2 )', 3, 'grfais_2', '1234'),
(8, 'Anisa ( Kasir 1 )', 5, 'kasir_1', '1234'),
(9, 'Mona ( Kasir 2 )', 5, 'kasir_2', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori_user`
--

CREATE TABLE `m_kategori_user` (
  `ID_KATEGORI_USER` int(3) NOT NULL,
  `NAMA_KATEGORI_USER` varchar(35) NOT NULL,
  `KETERANGAN` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori_user`
--

INSERT INTO `m_kategori_user` (`ID_KATEGORI_USER`, `NAMA_KATEGORI_USER`, `KETERANGAN`) VALUES
(1, 'Administrator Aplikasi', 'Full Akses'),
(2, 'Customer Service', 'CS Penerima Customer\r\n'),
(3, 'OP Grafis', ''),
(5, 'Kasir', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_menu`
--

CREATE TABLE `m_menu` (
  `ID_MENU` int(11) NOT NULL,
  `ID_PARENT` int(4) NOT NULL,
  `NAMA_MENU` varchar(50) NOT NULL,
  `JUDUL_MENU` varchar(250) NOT NULL,
  `LINK_MENU` varchar(25) NOT NULL,
  `ICON_MENU` varchar(25) NOT NULL,
  `AKTIF_MENU` enum('Y','N') NOT NULL COMMENT 'Y = Yes , N = No',
  `TINGKAT_MENU` int(11) NOT NULL,
  `URUTAN_MENU` int(11) NOT NULL,
  `ADD_BUTTON` enum('Y','N') NOT NULL,
  `EDIT_BUTTON` enum('Y','N') NOT NULL,
  `DELETE_BUTTON` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_menu`
--

INSERT INTO `m_menu` (`ID_MENU`, `ID_PARENT`, `NAMA_MENU`, `JUDUL_MENU`, `LINK_MENU`, `ICON_MENU`, `AKTIF_MENU`, `TINGKAT_MENU`, `URUTAN_MENU`, `ADD_BUTTON`, `EDIT_BUTTON`, `DELETE_BUTTON`) VALUES
(1, 0, 'Administrator', '', '', 'database', 'Y', 1, 1, 'N', 'N', 'N'),
(2, 0, 'Data Master', '', '', 'cubes', 'Y', 1, 2, 'N', 'N', 'N'),
(3, 1, 'Pengguna Aplikasi ', 'adalah Data User/Pengguna dari Aplikasi', 'user', '', 'Y', 2, 2, 'Y', 'Y', 'Y'),
(4, 2, 'Karyawan', 'adalah Data Keseluruhan Pegawai', 'karyawan', '', 'Y', 2, 1, 'Y', 'Y', 'Y'),
(5, 1, 'Kategori Pengguna Aplikasi', 'adalah Halaman yang berisina Data Kategori Pengguna Aplikasi. Dalam menu ini akan diatur untuk hak Akses dari Kategori Pengguna.', 'kategori_user', '', 'Y', 2, 1, 'Y', 'Y', 'Y'),
(6, 0, 'Order', 'adalah Halaman untuk Order ', 'order', 'cart-arrow-down', 'Y', 1, 3, 'N', 'N', 'N'),
(7, 0, 'Operator Grafis', 'adalah Halaman untuk WO yang masih di proses Desing', 'grafis', 'edit', 'Y', 1, 4, 'N', 'N', 'N'),
(9, 0, 'Kasir', 'adalah Halaman untukPembayaran WO', 'kasir', 'dollar', 'Y', 1, 6, 'N', 'N', 'N'),
(10, 2, 'Barang', 'adalah Data Master barang. untuk penentuan Harga', 'barang', ' ', 'Y', 2, 2, 'Y', 'Y', 'Y'),
(11, 2, 'Customer', 'adalah Data Master Pembeli', 'customer', ' ', 'Y', 2, 3, 'Y', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_barang_order`
--

CREATE TABLE `t_barang_order` (
  `COUNT_BARANG` int(11) NOT NULL,
  `ID_ORDER` int(11) NOT NULL,
  `JUMLAH_QTY` int(11) DEFAULT NULL,
  `HARGA_SATUAN` int(11) DEFAULT NULL,
  `TOTAL_HARGA` int(11) DEFAULT NULL,
  `NAMA_BARANG` varchar(150) NOT NULL,
  `SATUAN_BARANG` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_barang_order`
--

INSERT INTO `t_barang_order` (`COUNT_BARANG`, `ID_ORDER`, `JUMLAH_QTY`, `HARGA_SATUAN`, `TOTAL_HARGA`, `NAMA_BARANG`, `SATUAN_BARANG`) VALUES
(2, 1, 256, 1200, 307200, 'Ivory 260', 'gr'),
(1, 1, 12, 4500, 54000, 'HVS 70gr A3', 'Lbr');

-- --------------------------------------------------------

--
-- Table structure for table `t_bayar_order`
--

CREATE TABLE `t_bayar_order` (
  `ID_T_BAYAR_ORDER` int(11) NOT NULL,
  `ID_ORDER` int(11) DEFAULT NULL,
  `JENIS_BAYAR` varchar(25) DEFAULT NULL,
  `JUMLAH_BAYAR` int(11) DEFAULT NULL,
  `TGL_BAYAR` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bayar_order`
--

INSERT INTO `t_bayar_order` (`ID_T_BAYAR_ORDER`, `ID_ORDER`, `JENIS_BAYAR`, `JUMLAH_BAYAR`, `TGL_BAYAR`) VALUES
(1, 0, '1', 356100, '2017-06-18 13:18:32'),
(1, 0, '1', 356100, '2017-06-18 13:44:02'),
(1, 0, '1', 356100, '2017-06-18 13:58:23'),
(1, 1, 'TRANSFER', 356100, '2017-06-18 13:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `t_hak_akses`
--

CREATE TABLE `t_hak_akses` (
  `ID_KATEGORI_USER` int(11) NOT NULL,
  `ID_MENU` int(11) NOT NULL,
  `ADD_BUTTON` enum('Y','N') NOT NULL,
  `EDIT_BUTTON` enum('Y','N') NOT NULL,
  `DELETE_BUTTON` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_hak_akses`
--

INSERT INTO `t_hak_akses` (`ID_KATEGORI_USER`, `ID_MENU`, `ADD_BUTTON`, `EDIT_BUTTON`, `DELETE_BUTTON`) VALUES
(1, 1, '', '', ''),
(1, 5, 'Y', 'Y', 'Y'),
(1, 3, 'Y', 'Y', 'Y'),
(1, 2, '', '', ''),
(1, 4, 'Y', 'Y', 'Y'),
(1, 10, 'Y', 'Y', 'Y'),
(1, 11, 'Y', 'Y', 'Y'),
(1, 6, '', '', ''),
(1, 7, '', '', ''),
(1, 8, '', '', ''),
(1, 9, '', '', ''),
(2, 2, '', '', ''),
(2, 10, '', '', ''),
(2, 11, '', '', ''),
(2, 6, '', '', ''),
(5, 2, '', '', ''),
(5, 10, 'Y', 'Y', 'Y'),
(5, 11, '', '', ''),
(5, 9, '', '', ''),
(3, 2, '', '', ''),
(3, 10, '', '', ''),
(3, 7, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_harga_barang`
--

CREATE TABLE `t_harga_barang` (
  `ID_T_HARGA_BARANG` int(11) NOT NULL,
  `ID_BARANG` int(11) DEFAULT NULL,
  `MIN_BARANG` int(11) DEFAULT NULL,
  `MAX_BARANG` int(11) DEFAULT NULL,
  `HARGA` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_harga_barang`
--

INSERT INTO `t_harga_barang` (`ID_T_HARGA_BARANG`, `ID_BARANG`, `MIN_BARANG`, `MAX_BARANG`, `HARGA`) VALUES
(1, 3, 1, 5, 1500),
(2, 3, 6, 20, 1400),
(3, 3, 21, 100, 1300),
(4, 3, 101, 250, 1250),
(5, 3, 251, 999999999, 1200),
(6, 2, 1, 50, 4500),
(7, 2, 51, 250, 4300),
(8, 2, 251, 999999999, 4100);

-- --------------------------------------------------------

--
-- Table structure for table `t_log_order`
--

CREATE TABLE `t_log_order` (
  `ID_ORDER` int(11) NOT NULL,
  `TGL_LOG_ORDER` datetime NOT NULL,
  `ID_KARYAWAN` int(11) NOT NULL,
  `DARI` varchar(15) NOT NULL,
  `KE` varchar(15) NOT NULL,
  `CATATAN_LOG_ORDER` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_log_order`
--

INSERT INTO `t_log_order` (`ID_ORDER`, `TGL_LOG_ORDER`, `ID_KARYAWAN`, `DARI`, `KE`, `CATATAN_LOG_ORDER`) VALUES
(1, '2017-06-18 13:17:39', 1, 'CS', 'OP-GRAFIS', 'Oke'),
(1, '2017-06-18 13:17:50', 1, 'OP-GRAFIS', 'FINISH-DESIGN', 'Oke'),
(1, '2017-06-18 13:18:01', 1, 'OP-GRAFIS', 'KASIR', 'Ke Proses Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `t_order`
--

CREATE TABLE `t_order` (
  `ID_ORDER` int(11) NOT NULL,
  `ID_CUSTOMER` int(11) DEFAULT NULL,
  `TGL_ORDER` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TGL_AMBIL` timestamp NULL DEFAULT NULL,
  `DISCOUNT` int(11) DEFAULT NULL,
  `TOTAL_BAYAR` int(11) DEFAULT NULL,
  `POSISI_ORDER` varchar(15) DEFAULT NULL,
  `NO_ORDER` int(45) DEFAULT NULL,
  `NO_WO` varchar(15) NOT NULL,
  `LOG_MEMBER` char(1) NOT NULL COMMENT 'Y = Member ,, N == Bukan member (Customer Baru)',
  `STATUS_BAYAR` varchar(2) DEFAULT NULL COMMENT 'BL= Belum Lunas , L = Lunas'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_order`
--

INSERT INTO `t_order` (`ID_ORDER`, `ID_CUSTOMER`, `TGL_ORDER`, `TGL_AMBIL`, `DISCOUNT`, `TOTAL_BAYAR`, `POSISI_ORDER`, `NO_ORDER`, `NO_WO`, `LOG_MEMBER`, `STATUS_BAYAR`) VALUES
(1, 2, '2017-06-18 06:58:23', NULL, 5100, 356100, 'FINISH', 1, '180617-1', 'Y', 'BL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`ID_BARANG`),
  ADD UNIQUE KEY `M_BARANG_PK` (`ID_BARANG`);

--
-- Indexes for table `m_customer`
--
ALTER TABLE `m_customer`
  ADD PRIMARY KEY (`ID_CUSTOMER`),
  ADD UNIQUE KEY `M_CUSTOMER_PK` (`ID_CUSTOMER`);

--
-- Indexes for table `m_karyawan`
--
ALTER TABLE `m_karyawan`
  ADD PRIMARY KEY (`ID_KARYAWAN`);

--
-- Indexes for table `m_kategori_user`
--
ALTER TABLE `m_kategori_user`
  ADD PRIMARY KEY (`ID_KATEGORI_USER`),
  ADD UNIQUE KEY `nama_user` (`NAMA_KATEGORI_USER`);

--
-- Indexes for table `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`ID_MENU`);

--
-- Indexes for table `t_barang_order`
--
ALTER TABLE `t_barang_order`
  ADD PRIMARY KEY (`COUNT_BARANG`,`ID_ORDER`);

--
-- Indexes for table `t_harga_barang`
--
ALTER TABLE `t_harga_barang`
  ADD PRIMARY KEY (`ID_T_HARGA_BARANG`);

--
-- Indexes for table `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`ID_ORDER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_karyawan`
--
ALTER TABLE `m_karyawan`
  MODIFY `ID_KARYAWAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `m_kategori_user`
--
ALTER TABLE `m_kategori_user`
  MODIFY `ID_KATEGORI_USER` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `ID_MENU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
