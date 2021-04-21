-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 21, 2021 at 07:31 AM
-- Server version: 10.4.15-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u649782035_security`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `areanya` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`areanya`) VALUES
('onigashima'),
('singapura'),
('timor leste');

-- --------------------------------------------------------

--
-- Table structure for table `data_area`
--

CREATE TABLE `data_area` (
  `ID_area` int(100) NOT NULL,
  `Nama_area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persentase_ngantuk` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persentase_tidur` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persentase_kerja` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_area`
--

INSERT INTO `data_area` (`ID_area`, `Nama_area`, `Lokasi`, `persentase_ngantuk`, `persentase_tidur`, `persentase_kerja`) VALUES
(1, 'The Pakubuono New', 'Jakarta', '10', '0', '90'),
(2, 'The Pakubuono Signature', 'Jakarta', '35', '5', '60'),
(3, 'The Pakubuono Spring', 'Jakarta', '40', '40', '20'),
(7, 'sarina', 'jaksel', '40', '30', '30'),
(8, 'fx sudirman', 'jakarta', NULL, NULL, NULL),
(9, 'ANDARA MALL', 'TANGGERANG', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `ID_jabatan` int(100) NOT NULL,
  `Jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nama_area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`ID_jabatan`, `Jabatan`, `Nama_area`, `Deskripsi`) VALUES
(2, 'Direktur', 'The Pakubuono Spring', 'Direktur the pakubuono spring'),
(11, 'Supervisor', 'The Pakubuono Spring', 'Supervisor daerah'),
(22, 'Direktur', 'The Pakubuono Signature', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `data_jam`
--

CREATE TABLE `data_jam` (
  `ID_jam` int(11) NOT NULL,
  `merek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_jam`
--

INSERT INTO `data_jam` (`ID_jam`, `merek`, `latitude`, `longitude`) VALUES
(4, 'Zeblaze', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `data_latih`
--

CREATE TABLE `data_latih` (
  `ID` int(100) NOT NULL,
  `HeartRate` int(100) NOT NULL,
  `Time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_latih`
--

INSERT INTO `data_latih` (`ID`, `HeartRate`, `Time`) VALUES
(1, 77, '14:20:09'),
(2, 88, '12:21:08'),
(3, 80, '15:12:45'),
(59, 12, '12'),
(60, 12, '12'),
(61, 99, '99');

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggaran`
--

CREATE TABLE `data_pelanggaran` (
  `ID_pelanggaran` int(100) NOT NULL,
  `NIK` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jenis_pelanggaran` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_pelanggaran`
--

INSERT INTO `data_pelanggaran` (`ID_pelanggaran`, `NIK`, `tanggal`, `jam`, `Jenis_pelanggaran`) VALUES
(1, '12345678', '2020-10-09', '11:57:01', 'Tidur'),
(2, '12345678', '2020-11-10', '12:10:10', 'Terlambat'),
(18, '12345678', '2021-04-18', '14:34:02', ''),
(19, '12345678', '2021-04-18', '14:34:20', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_role_user`
--

CREATE TABLE `data_role_user` (
  `ID_role_user` int(100) NOT NULL,
  `Jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Lihat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tambah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Ubah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Hapus` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_role_user`
--

INSERT INTO `data_role_user` (`ID_role_user`, `Jabatan`, `Lihat`, `Tambah`, `Ubah`, `Hapus`) VALUES
(2, 'Direktur', 'ya', 'tidak', 'tidak', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `data_shift`
--

CREATE TABLE `data_shift` (
  `ID_shift` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggali` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nama_area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_shift`
--

INSERT INTO `data_shift` (`ID_shift`, `shift`, `tanggali`, `hari`, `jam`, `Nama_area`) VALUES
('1', 'pagi', '2020-12-28', 'Senin', '07.00', 'The Pakubuono Spring'),
('2', 'malam', '2020-12-28', 'Senin', '19.00', 'The Pakubuono Signature');

-- --------------------------------------------------------

--
-- Table structure for table `data_shift_personil`
--

CREATE TABLE `data_shift_personil` (
  `ID_shift` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIK` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nama_area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_shift_personil`
--

INSERT INTO `data_shift_personil` (`ID_shift`, `NIK`, `Nama_area`) VALUES
('1', '12345678', 'The Pakubuono Spring'),
('1', '23456789', 'The Pakubuono Spring'),
('2', 'A12345678', 'The Pakubuono Signature');

-- --------------------------------------------------------

--
-- Table structure for table `master_data_admin`
--

CREATE TABLE `master_data_admin` (
  `NIK` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` int(2) NOT NULL DEFAULT 0,
  `Foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Expiredate` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_data_admin`
--

INSERT INTO `master_data_admin` (`NIK`, `Nama`, `Password`, `Status`, `Foto`, `Jabatan`, `Email`, `Expiredate`, `Keterangan`) VALUES
('A12345', 'Ammar Zaam', '12345', 0, 'qwerty_Ammar Zaam.jpg 	', 'Supervisor', 'ammarzaam@gmail.com', '4 Agustus 2040, 23:59', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `master_data_customer`
--

CREATE TABLE `master_data_customer` (
  `ID_customer` int(100) NOT NULL,
  `Nama_customer` varchar(100) NOT NULL,
  `Area` varchar(100) NOT NULL,
  `Telepon_customer` varchar(100) NOT NULL,
  `Nama_PIC` varchar(100) NOT NULL,
  `Telepon_PIC` varchar(100) NOT NULL,
  `Email_PIC` varchar(100) NOT NULL,
  `Alamat_PIC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_data_customer`
--

INSERT INTO `master_data_customer` (`ID_customer`, `Nama_customer`, `Area`, `Telepon_customer`, `Nama_PIC`, `Telepon_PIC`, `Email_PIC`, `Alamat_PIC`) VALUES
(2, 'Zaam Studio', 'Botanica', '081777111777', 'Axel Duncen', '088221228786', 'axeled@gmail.com', 'Jalan Kebayoran Jakarta Pusat');

-- --------------------------------------------------------

--
-- Table structure for table `master_data_personil`
--

CREATE TABLE `master_data_personil` (
  `NIK` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PIN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Umur` int(100) NOT NULL,
  `Nomor_HP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `Foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `State` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_data_personil`
--

INSERT INTO `master_data_personil` (`NIK`, `PIN`, `Nama`, `Umur`, `Nomor_HP`, `Status`, `Foto`, `State`, `Email`) VALUES
('12345678', '123456', 'Fajar Hamid', 23, '083000111333', 0, '12345678_Fajar Hamid Embutara.png', 'NORMAL', ''),
('23456789', '123456', 'Ananda Rebel', 21, '088999000123', 0, '23456789_Ananda Rebel.png', '1', ''),
('A12345678', '123456', 'Axel Elcana Duncan', 50, '0812345678', 0, 'A12345678_Axel Claloe Set.jpg', '2', ''),
('NULL', '', '', 0, NULL, 0, NULL, ' ', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_area`
--
ALTER TABLE `data_area`
  ADD PRIMARY KEY (`ID_area`),
  ADD UNIQUE KEY `Nama_area` (`Nama_area`);

--
-- Indexes for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`ID_jabatan`),
  ADD KEY `Nama_area` (`Nama_area`),
  ADD KEY `Jabatan` (`Jabatan`);

--
-- Indexes for table `data_jam`
--
ALTER TABLE `data_jam`
  ADD PRIMARY KEY (`ID_jam`);

--
-- Indexes for table `data_latih`
--
ALTER TABLE `data_latih`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `data_pelanggaran`
--
ALTER TABLE `data_pelanggaran`
  ADD PRIMARY KEY (`ID_pelanggaran`),
  ADD KEY `NIK` (`NIK`);

--
-- Indexes for table `data_role_user`
--
ALTER TABLE `data_role_user`
  ADD PRIMARY KEY (`ID_role_user`),
  ADD UNIQUE KEY `Jabatan` (`Jabatan`) USING BTREE;

--
-- Indexes for table `data_shift`
--
ALTER TABLE `data_shift`
  ADD PRIMARY KEY (`ID_shift`),
  ADD KEY `Nama_area` (`Nama_area`);

--
-- Indexes for table `data_shift_personil`
--
ALTER TABLE `data_shift_personil`
  ADD UNIQUE KEY `ID_shift` (`ID_shift`,`NIK`),
  ADD KEY `NIK` (`NIK`);

--
-- Indexes for table `master_data_admin`
--
ALTER TABLE `master_data_admin`
  ADD PRIMARY KEY (`NIK`),
  ADD KEY `Keterangan` (`Keterangan`),
  ADD KEY `Jabatan` (`Jabatan`);

--
-- Indexes for table `master_data_customer`
--
ALTER TABLE `master_data_customer`
  ADD PRIMARY KEY (`ID_customer`),
  ADD KEY `Nama_customer` (`Nama_customer`);

--
-- Indexes for table `master_data_personil`
--
ALTER TABLE `master_data_personil`
  ADD PRIMARY KEY (`NIK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_area`
--
ALTER TABLE `data_area`
  MODIFY `ID_area` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `ID_jabatan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data_jam`
--
ALTER TABLE `data_jam`
  MODIFY `ID_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_latih`
--
ALTER TABLE `data_latih`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `data_pelanggaran`
--
ALTER TABLE `data_pelanggaran`
  MODIFY `ID_pelanggaran` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `data_role_user`
--
ALTER TABLE `data_role_user`
  MODIFY `ID_role_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_data_customer`
--
ALTER TABLE `master_data_customer`
  MODIFY `ID_customer` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD CONSTRAINT `data_jabatan_ibfk_1` FOREIGN KEY (`Nama_area`) REFERENCES `data_area` (`Nama_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pelanggaran`
--
ALTER TABLE `data_pelanggaran`
  ADD CONSTRAINT `data_pelanggaran_ibfk_1` FOREIGN KEY (`NIK`) REFERENCES `master_data_personil` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_role_user`
--
ALTER TABLE `data_role_user`
  ADD CONSTRAINT `data_role_user_ibfk_1` FOREIGN KEY (`Jabatan`) REFERENCES `data_jabatan` (`Jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_shift`
--
ALTER TABLE `data_shift`
  ADD CONSTRAINT `data_shift_ibfk_1` FOREIGN KEY (`Nama_area`) REFERENCES `data_area` (`Nama_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_shift_personil`
--
ALTER TABLE `data_shift_personil`
  ADD CONSTRAINT `data_shift_personil_ibfk_6` FOREIGN KEY (`NIK`) REFERENCES `master_data_personil` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_shift_personil_ibfk_8` FOREIGN KEY (`ID_shift`) REFERENCES `data_shift` (`ID_shift`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `master_data_admin`
--
ALTER TABLE `master_data_admin`
  ADD CONSTRAINT `master_data_admin_ibfk_1` FOREIGN KEY (`Jabatan`) REFERENCES `data_jabatan` (`Jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
