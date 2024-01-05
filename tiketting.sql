-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2023 at 04:40 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiketting`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nm_customer` varchar(100) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `alamat` varchar(130) NOT NULL,
  `email` varchar(30) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `no_identitas` int(11) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `privilage` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nm_customer`, `tgl_lahir`, `gender`, `alamat`, `email`, `kontak`, `no_identitas`, `kota`, `password`, `privilage`) VALUES
(1, '', '', '', '', 'oktadha01@gmail.com', '', 0, '', 'f1de1bfb4f6690948073250a91d62bc7', ''),
(3, 'okta', '10/10/1996', '', '', 'okta@gmail.com', '08926352435', 2147483647, 'Kota Semarang', 'f1de1bfb4f6690948073250a91d62bc7', ''),
(9, '', '', '', '', 'agus@gmail.com', '', 0, '', '9b0715d6d69c869e2e1195e027e3aec6', ''),
(10, '', '', '', '', 'fauzan@gmail.com', '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nm_event` varchar(100) NOT NULL,
  `tgl_event` varchar(10) NOT NULL,
  `jam_event` varchar(5) NOT NULL,
  `batas_pesan` varchar(80) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kategori_event` varchar(20) NOT NULL,
  `desc_event` varchar(400) NOT NULL,
  `mc_by` varchar(30) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `id_user`, `nm_event`, `tgl_event`, `jam_event`, `batas_pesan`, `lokasi`, `kota`, `alamat`, `kategori_event`, `desc_event`, `mc_by`, `poster`, `header`) VALUES
(1, 1, 'Kanpa Fest', '21/04/2024', '19:00', '21/04/2024', 'Alun - Alun Ungarang', 'Kab. Semarang', 'Ungaran', 'Musik', '-', 'Udin Lar', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `akun` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `name`, `value`, `akun`, `status`) VALUES
(1, 'XENDIT_KEY', 'xnd_production_ZyPuK2YyXjXwe9gCDpHCprXICVJgGYxkgC82wjIafn5MZ0bOSxIcQ2l2w9eK0ZBJ', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `perform`
--

CREATE TABLE `perform` (
  `id_perform` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `nama_artis` varchar(100) NOT NULL,
  `status_perform` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perform`
--

INSERT INTO `perform` (`id_perform`, `id_event`, `nama_artis`, `status_perform`) VALUES
(1, 1, 'Sheila on 7', 'special'),
(2, 1, 'NDX AKA', 'also');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id_price` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `kategori_price` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `stock_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id_price`, `id_event`, `kategori_price`, `harga`, `jumlah_tiket`, `stock_tiket`) VALUES
(1, 1, 'Tiket 1', 100000, 1, 5),
(2, 1, 'Tiket 2', 50000, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_price` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `no_identitas` int(11) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `code_bayar` varchar(100) NOT NULL,
  `code_tiket` varchar(100) NOT NULL,
  `status_tiket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_customer`, `id_event`, `id_price`, `nama`, `tgl_lahir`, `gender`, `alamat`, `email`, `kontak`, `no_identitas`, `kota`, `code_bayar`, `code_tiket`, `status_tiket`) VALUES
(43, 3, 1, 1, 'okta', '10/10/1996', '', '', 'okta@gmail.com', '08926352435', 2147483647, 'Kota Semarang', 'CT-1/12192023/3', 'CT-1/3/1/1', ''),
(44, 3, 1, 1, 'okta', '10/10/1996', '', '', 'okta@gmail.com', '08926352435', 2147483647, 'Kota Semarang', 'CT-1/12192023/3', 'CT-1/3/1/2', ''),
(45, 3, 1, 2, 'okta', '10/10/1996', '', '', 'okta@gmail.com', '08926352435', 2147483647, 'Kota Semarang', 'CT-1/12192023/3', 'CT-1/3/2/1', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `code_bayar` int(11) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `agency` varchar(50) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `password` varchar(225) NOT NULL,
  `privilage` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `agency`, `nm_user`, `alamat`, `email`, `kontak`, `password`, `privilage`) VALUES
(1, 'Athreya Events & Joglo Kembar', 'AGUS SUPRIYANTO', 'Semarang kota jos', 'agussuprie70@gmail.com', '089615139361', '01c3c766ce47082b1b130daedd347ffd', 'Admin'),
(3, 'Hyuuna Agency', 'Habaek', 'Semarang jakarta', 'agussuprie70@gmail.com', '089615139362', '2f1d668804c5149eab5cd1686055a562', 'User'),
(4, 'Kanzu', 'Ahmad Sukoco', 'Patimura Ungaran Barat', 'restu.marketing@kanpa.co.id', '098988988', '2f1d668804c5149eab5cd1686055a562', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perform`
--
ALTER TABLE `perform`
  ADD PRIMARY KEY (`id_perform`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id_price`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perform`
--
ALTER TABLE `perform`
  MODIFY `id_perform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id_price` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
