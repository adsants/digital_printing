-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11 Jun 2017 pada 08.48
-- Versi Server: 5.7.14
-- PHP Version: 5.6.25

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
-- Struktur dari tabel `m_barang`
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
-- Dumping data untuk tabel `m_barang`
--

INSERT INTO `m_barang` (`ID_BARANG`, `NAMA_BARANG`, `SATUAN`, `KETERANGAN`, `JENIS_HARGA`, `HARGA_SATUAN`) VALUES
(1, 'Mini X Banner ( Alat Banner  )', 'Pcs', NULL, 'SAMA', 4500000),
(2, 'HVS 70gr A3', 'Lbr', NULL, 'BEDA', 0),
(3, 'Ivory 260', 'gr', NULL, 'BEDA', 0),
(4, 'Jasa Desain Logo', 'Pcs', NULL, 'SAMA', 65000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_customer`
--

CREATE TABLE `m_customer` (
  `ID_CUSTOMER` int(11) NOT NULL,
  `NAMA_CUSTOMER` varchar(100) DEFAULT NULL,
  `HP_CUSTOMER` varchar(25) DEFAULT NULL,
  `ALAMAT_CUSTOMER` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_customer`
--

INSERT INTO `m_customer` (`ID_CUSTOMER`, `NAMA_CUSTOMER`, `HP_CUSTOMER`, `ALAMAT_CUSTOMER`) VALUES
(1, 'Sartono', '085731020099', 'Jl Tarakan Sulawesi '),
(2, 'Lian Andany', '2347809274', 'jl sidoarjo'),
(3, 'Aditya', '081345345', 'JL. Margomulyo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_karyawan`
--

CREATE TABLE `m_karyawan` (
  `ID_KARYAWAN` int(11) NOT NULL,
  `NAMA_KARYAWAN` varchar(65) NOT NULL,
  `ID_KATEGORI_USER` int(11) NOT NULL,
  `USERNAME` varchar(25) NOT NULL,
  `PASSWORD` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_karyawan`
--

INSERT INTO `m_karyawan` (`ID_KARYAWAN`, `NAMA_KARYAWAN`, `ID_KATEGORI_USER`, `USERNAME`, `PASSWORD`) VALUES
(1, 'Admin Aplikasi', 1, 'admin', '1234'),
(2, 'Indah ( CS 1 )', 2, 'cs_1', '1234'),
(3, 'Kartika ( CS 2 )', 2, 'cs_2', '1234'),
(4, 'Andika ( OP Grafis 1 )', 3, 'grafis_1', '1234'),
(5, 'Eka ( OP Grafis 2 )', 3, 'grfais_2', '1234'),
(6, 'Amin ( OP Print 1 )', 4, 'print_1', '1234'),
(7, 'Arif (OP Print 2 )', 4, 'print_2', '1234'),
(8, 'Anisa ( Kasir 1 )', 5, 'kasir_1', '1234'),
(9, 'Mona ( Kasir 2 )', 5, 'kasir_2', '1234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kategori_user`
--

CREATE TABLE `m_kategori_user` (
  `ID_KATEGORI_USER` int(3) NOT NULL,
  `NAMA_KATEGORI_USER` varchar(35) NOT NULL,
  `KETERANGAN` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_kategori_user`
--

INSERT INTO `m_kategori_user` (`ID_KATEGORI_USER`, `NAMA_KATEGORI_USER`, `KETERANGAN`) VALUES
(1, 'Administrator Aplikasi', 'Full Akses'),
(2, 'Customer Service', 'CS Penerima Customer\r\n'),
(3, 'OP Grafis', ''),
(4, 'OP Print', ''),
(5, 'Kasir', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_menu`
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
-- Dumping data untuk tabel `m_menu`
--

INSERT INTO `m_menu` (`ID_MENU`, `ID_PARENT`, `NAMA_MENU`, `JUDUL_MENU`, `LINK_MENU`, `ICON_MENU`, `AKTIF_MENU`, `TINGKAT_MENU`, `URUTAN_MENU`, `ADD_BUTTON`, `EDIT_BUTTON`, `DELETE_BUTTON`) VALUES
(1, 0, 'Administrator', '', '', 'database', 'Y', 1, 1, 'N', 'N', 'N'),
(2, 0, 'Data Master', '', '', 'cubes', 'Y', 1, 2, 'N', 'N', 'N'),
(3, 1, 'Pengguna Aplikasi ', 'adalah Data User/Pengguna dari Aplikasi', 'user', '', 'Y', 2, 2, 'Y', 'Y', 'Y'),
(4, 2, 'Karyawan', 'adalah Data Keseluruhan Pegawai', 'karyawan', '', 'Y', 2, 1, 'Y', 'Y', 'Y'),
(5, 1, 'Kategori Pengguna Aplikasi', 'adalah Halaman yang berisina Data Kategori Pengguna Aplikasi. Dalam menu ini akan diatur untuk hak Akses dari Kategori Pengguna.', 'kategori_user', '', 'Y', 2, 1, 'Y', 'Y', 'Y'),
(6, 0, 'Order', 'adalah Halaman untuk Order ', 'order', 'cart-arrow-down', 'Y', 1, 3, 'N', 'N', 'N'),
(7, 0, 'Operator Grafis', 'adalah Halaman untuk WO yang masih di proses Desing', 'grafis', 'edit', 'Y', 1, 4, 'N', 'N', 'N'),
(8, 0, 'Operator Print', 'adalah Halaman untuk WO yang masih di proses Printing', 'printing', 'print', 'Y', 1, 5, 'N', 'N', 'N'),
(9, 0, 'Kasir', 'adalah Halaman untukPembayaran WO', 'kasir', 'dollar', 'Y', 1, 6, 'N', 'N', 'N'),
(10, 2, 'Barang', 'adalah Data Master barang. untuk penentuan Harga', 'barang', ' ', 'Y', 2, 2, 'Y', 'Y', 'Y'),
(11, 2, 'Pembeli', 'adalah Data Master Pembeli', 'customer', ' ', 'Y', 2, 3, 'Y', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_barang_order`
--

CREATE TABLE `t_barang_order` (
  `ID_BARANG` int(11) NOT NULL,
  `ID_ORDER` int(11) NOT NULL,
  `JUMLAH_QTY` int(11) DEFAULT NULL,
  `HARGA_SATUAN` int(11) DEFAULT NULL,
  `TOTAL_HARGA` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_barang_order`
--

INSERT INTO `t_barang_order` (`ID_BARANG`, `ID_ORDER`, `JUMLAH_QTY`, `HARGA_SATUAN`, `TOTAL_HARGA`) VALUES
(2, 1, 25, 3800, 95000),
(3, 1, 45, 3800, 171000),
(4, 2, 1, 65000, 65000),
(2, 3, 450, 3200, 1440000),
(1, 4, 2, 4500000, 9000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_bayar_order`
--

CREATE TABLE `t_bayar_order` (
  `ID_T_BAYAR_ORDER` int(11) NOT NULL,
  `ID_ORDER` int(11) DEFAULT NULL,
  `TGL_BAYAR` int(11) DEFAULT NULL,
  `JENIS_BAYAR` varchar(25) DEFAULT NULL,
  `JUMLAH_BAYAR` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_bayar_order`
--

INSERT INTO `t_bayar_order` (`ID_T_BAYAR_ORDER`, `ID_ORDER`, `TGL_BAYAR`, `JENIS_BAYAR`, `JUMLAH_BAYAR`) VALUES
(1, NULL, 2147483647, 'TUNAI', 254000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_hak_akses`
--

CREATE TABLE `t_hak_akses` (
  `ID_KATEGORI_USER` int(11) NOT NULL,
  `ID_MENU` int(11) NOT NULL,
  `ADD_BUTTON` enum('Y','N') NOT NULL,
  `EDIT_BUTTON` enum('Y','N') NOT NULL,
  `DELETE_BUTTON` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_hak_akses`
--

INSERT INTO `t_hak_akses` (`ID_KATEGORI_USER`, `ID_MENU`, `ADD_BUTTON`, `EDIT_BUTTON`, `DELETE_BUTTON`) VALUES
(1, 1, '', '', ''),
(1, 5, 'Y', 'Y', 'Y'),
(1, 3, 'Y', 'Y', 'Y'),
(1, 2, '', '', ''),
(1, 4, 'Y', 'Y', 'Y'),
(1, 10, 'Y', 'Y', 'Y'),
(1, 11, 'Y', 'Y', 'Y'),
(1, 6, 'Y', 'Y', ''),
(1, 7, '', 'Y', ''),
(1, 8, '', 'Y', ''),
(1, 9, '', '', ''),
(2, 2, '', '', ''),
(2, 4, '', '', ''),
(2, 10, 'Y', 'Y', 'Y'),
(2, 11, 'Y', 'Y', 'Y'),
(2, 6, '', '', ''),
(4, 2, '', '', ''),
(4, 10, '', '', ''),
(4, 8, '', '', ''),
(3, 2, '', '', ''),
(3, 10, '', '', ''),
(3, 7, '', '', ''),
(5, 2, '', '', ''),
(5, 10, '', '', ''),
(5, 11, '', '', ''),
(5, 9, '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_harga_barang`
--

CREATE TABLE `t_harga_barang` (
  `ID_T_HARGA_BARANG` int(11) NOT NULL,
  `ID_BARANG` int(11) DEFAULT NULL,
  `MIN_BARANG` int(11) DEFAULT NULL,
  `MAX_BARANG` int(11) DEFAULT NULL,
  `HARGA` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_harga_barang`
--

INSERT INTO `t_harga_barang` (`ID_T_HARGA_BARANG`, `ID_BARANG`, `MIN_BARANG`, `MAX_BARANG`, `HARGA`) VALUES
(1, 3, 1, 10, 4600),
(2, 3, 11, 25, 4100),
(3, 3, 26, 100, 3800),
(4, 3, 101, 999999999, 3500),
(5, 2, 1, 10, 4000),
(6, 2, 11, 25, 3800),
(7, 2, 26, 50, 3600),
(8, 2, 51, 255, 3450),
(9, 2, 256, 999999999, 3200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_log_order`
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
-- Dumping data untuk tabel `t_log_order`
--

INSERT INTO `t_log_order` (`ID_ORDER`, `TGL_LOG_ORDER`, `ID_KARYAWAN`, `DARI`, `KE`, `CATATAN_LOG_ORDER`) VALUES
(1, '2017-06-11 15:32:40', 1, 'CS', 'OP-GRAFIS', ''),
(1, '2017-06-11 15:35:30', 1, 'OP-GRAFIS', 'OP-PRINT', 'Ok Lanjut'),
(1, '2017-06-11 15:35:47', 1, 'OP-PRINT', 'OP-GRAFIS', 'Balik... tepiannya kurang lebar jaraknya'),
(1, '2017-06-11 15:35:55', 1, 'OP-GRAFIS', 'OP-PRINT', 'Oke sudah'),
(1, '2017-06-11 15:36:07', 1, 'OP-PRINT', 'KASIR', 'Lanjur ke Kasir'),
(1, '2017-06-11 15:36:44', 1, 'KASIR', 'BAYAR', 'Ok .. barang sudah diterima customer'),
(2, '2017-06-11 15:43:43', 1, 'CS', 'OP-GRAFIS', ''),
(3, '2017-06-11 15:44:31', 1, 'CS', 'OP-PRINT', ''),
(4, '2017-06-11 15:47:02', 1, 'CS', 'KSR', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_order`
--

CREATE TABLE `t_order` (
  `ID_ORDER` int(11) NOT NULL,
  `ID_CUSTOMER` int(11) DEFAULT NULL,
  `TGL_ORDER` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TGL_AMBIL` timestamp NULL DEFAULT NULL,
  `JENIS_BAYAR` varchar(25) DEFAULT NULL,
  `DISCOUNT` int(11) DEFAULT NULL,
  `TOTAL_BAYAR` int(11) DEFAULT NULL,
  `POSISI_ORDER` varchar(15) DEFAULT NULL,
  `CATATAN` mediumtext,
  `STATUS_BAYAR` varchar(5) DEFAULT NULL,
  `ID_KARYAWAN` int(11) NOT NULL,
  `JENIS_ORDER` int(11) DEFAULT NULL,
  `NO_ORDER` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_order`
--

INSERT INTO `t_order` (`ID_ORDER`, `ID_CUSTOMER`, `TGL_ORDER`, `TGL_AMBIL`, `JENIS_BAYAR`, `DISCOUNT`, `TOTAL_BAYAR`, `POSISI_ORDER`, `CATATAN`, `STATUS_BAYAR`, `ID_KARYAWAN`, `JENIS_ORDER`, `NO_ORDER`) VALUES
(1, 1, '2017-06-11 08:36:44', '2017-06-11 08:32:40', NULL, 12000, 254000, 'BAYAR', 'Paket Lengkap', 'L', 1, 1, '170611083240'),
(2, 2, '2017-06-11 08:43:43', '2017-06-11 08:43:43', NULL, NULL, NULL, 'OP-GRAFIS', 'Hanya Desain', NULL, 1, 2, '170611084343'),
(3, 1, '2017-06-11 08:44:31', '2017-06-11 08:44:31', NULL, NULL, NULL, 'OP-PRINT', 'Filenya ada di Flashdisk', NULL, 1, 3, '170611084431'),
(4, 3, '2017-06-11 08:47:27', '2017-06-11 08:47:02', NULL, NULL, NULL, 'KASIR', 'Beli alat', NULL, 1, 4, '170611084702');

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
  ADD PRIMARY KEY (`ID_BARANG`,`ID_ORDER`);

--
-- Indexes for table `t_bayar_order`
--
ALTER TABLE `t_bayar_order`
  ADD PRIMARY KEY (`ID_T_BAYAR_ORDER`);

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
--
-- AUTO_INCREMENT for table `t_bayar_order`
--
ALTER TABLE `t_bayar_order`
  MODIFY `ID_T_BAYAR_ORDER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
