-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 02:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabelanggota`
--

CREATE TABLE `tabelanggota` (
  `anggotaid` int(15) NOT NULL,
  `namaanggota` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tanggallahir` varchar(50) NOT NULL,
  `kontak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabelbuku`
--

CREATE TABLE `tabelbuku` (
  `bukuid` int(15) NOT NULL,
  `judulbuku` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahunterbit` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jumlahstruk` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabelpeminjaman`
--

CREATE TABLE `tabelpeminjaman` (
  `peminjamanid` int(15) NOT NULL,
  `anggotaid` int(15) NOT NULL,
  `bukuid` int(15) NOT NULL,
  `petugasid` int(15) NOT NULL,
  `tanggalpinjam` date NOT NULL,
  `tanggalkembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabelpetugas`
--

CREATE TABLE `tabelpetugas` (
  `petugasid` int(15) NOT NULL,
  `namapetugas` varchar(50) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabelanggota`
--
ALTER TABLE `tabelanggota`
  ADD PRIMARY KEY (`anggotaid`);

--
-- Indexes for table `tabelbuku`
--
ALTER TABLE `tabelbuku`
  ADD PRIMARY KEY (`bukuid`);

--
-- Indexes for table `tabelpeminjaman`
--
ALTER TABLE `tabelpeminjaman`
  ADD PRIMARY KEY (`peminjamanid`),
  ADD UNIQUE KEY `anggotaid` (`anggotaid`),
  ADD UNIQUE KEY `bukuid` (`bukuid`),
  ADD UNIQUE KEY `petugasid` (`petugasid`);

--
-- Indexes for table `tabelpetugas`
--
ALTER TABLE `tabelpetugas`
  ADD PRIMARY KEY (`petugasid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabelanggota`
--
ALTER TABLE `tabelanggota`
  MODIFY `anggotaid` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabelbuku`
--
ALTER TABLE `tabelbuku`
  MODIFY `bukuid` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabelpeminjaman`
--
ALTER TABLE `tabelpeminjaman`
  MODIFY `peminjamanid` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabelpetugas`
--
ALTER TABLE `tabelpetugas`
  MODIFY `petugasid` int(15) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabelpeminjaman`
--
ALTER TABLE `tabelpeminjaman`
  ADD CONSTRAINT `tabelpeminjaman_ibfk_1` FOREIGN KEY (`bukuid`) REFERENCES `tabelbuku` (`bukuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabelpeminjaman_ibfk_2` FOREIGN KEY (`petugasid`) REFERENCES `tabelpetugas` (`petugasid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabelpeminjaman_ibfk_3` FOREIGN KEY (`anggotaid`) REFERENCES `tabelanggota` (`anggotaid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
