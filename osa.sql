-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Feb 2025 pada 15.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `scan_rfid`
--

CREATE TABLE `scan_rfid` (
  `ID` int(11) NOT NULL,
  `IDCard` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `scan_rfid`
--

INSERT INTO `scan_rfid` (`ID`, `IDCard`, `Date`, `Time`) VALUES
(292, '34:49:4:4', '2025-02-02', '13:15:22'),
(293, 'C2:84:8:4', '2025-02-02', '13:15:27'),
(294, '9A:3D:9:4', '2025-02-02', '13:15:30'),
(295, '45:A8:3:4', '2025-02-02', '13:15:33'),
(296, 'ED:D1:3:4', '2025-02-02', '13:15:36'),
(297, '91:E3:2:4', '2025-02-02', '13:15:39'),
(298, 'D9:33:A:4', '2025-02-02', '13:15:42'),
(299, '94:89:1B:2', '2025-02-02', '13:15:45'),
(300, '84:5D:6:4', '2025-02-02', '13:15:48'),
(301, 'DA:31:7:4', '2025-02-02', '13:15:52'),
(302, 'EE:31:5:4', '2025-02-02', '13:15:56'),
(303, '6E:31:7:4', '2025-02-02', '13:15:59'),
(304, 'D:9F:9:4', '2025-02-02', '13:16:02'),
(305, '84:E4:6:4', '2025-02-02', '13:16:06'),
(306, '53:DE:6:4', '2025-02-02', '13:16:22'),
(307, '26:B7:6:4', '2025-02-02', '13:34:54'),
(308, 'A9:E8:9:4', '2025-02-02', '13:41:07'),
(309, '45:46:8:4', '2025-02-02', '13:41:12'),
(310, '5:DE:8:4', '2025-02-02', '13:41:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `scan_yolo`
--

CREATE TABLE `scan_yolo` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `total_people_detected` smallint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `scan_yolo`
--

INSERT INTO `scan_yolo` (`id`, `date`, `time`, `total_people_detected`) VALUES
(37, '2025-02-02', '13:39:50', 16),
(38, '2025-02-02', '13:43:08', 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `IDCard` varchar(20) NOT NULL,
  `NIM` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`ID`, `IDCard`, `NIM`, `Name`) VALUES
(33, '23:57:3:4', 1247050001, 'ALDILA ZAHIRRA SHAFFA'),
(34, '39:55:17:3', 1247050008, 'DIAH KHAIRUNISA MAULA'),
(35, 'EC:18:9:4', 1247050012, 'AULIA SAFARINA DWI RAHAYU '),
(36, 'C4:D0:8:4', 1247050015, 'DICKI RAMADAN'),
(37, 'B:8E:19:4', 1247050016, 'ARHAM MAHASIN KHAWWA'),
(38, '43:80:6:4', 1247050017, 'ABDUL KARIM'),
(39, '26:B7:6:4', 1247050024, 'ADAM HALAWI'),
(40, '1D:D7:7:4', 1247050029, ' DEVI ALIYANTI '),
(41, '12:71:9:4', 1247050031, 'ALDI PRAMANA '),
(42, 'E6:61:A:4', 1247050032, 'FAIZ MUHAMMAD ILHAM HARIRY'),
(43, '59:11:9:4', 1247050043, 'ARDYAN FAUZI SYAKIR'),
(44, 'A9:E8:9:4', 1247050047, ' AHMAD FADHILAH GUMANTARA '),
(45, '34:49:4:4', 1247050050, 'ALDEN SHALIH FALAH '),
(46, 'C2:84:8:4', 1247050058, 'DHIAURRAHMAN FAIZ WINARDI'),
(47, '9A:3D:9:4', 1247050069, 'ADITYA RAHMAN SYACH'),
(48, '45:A8:3:4', 1247050073, 'DAMAR ALAM'),
(49, 'ED:D1:3:4', 1247050074, 'ADI SATRIA PERMANA'),
(50, '91:E3:2:4', 1247050080, 'ARYA FABIO ISMAIL'),
(51, 'D9:33:A:4', 1247050144, 'DAFFA ALDIFA PRATAMA'),
(52, '94:89:1B:2', 1247050139, 'AVINA NAJLA KHOERUNNISA '),
(53, '84:5D:6:4', 1247050135, 'FAHAD MUHAMMAD ALFARIZI'),
(54, 'DA:31:7:4', 1247050127, 'ADI KARUNIA'),
(55, 'EE:31:5:4', 1247050126, 'AZMI PUTRI KUSWANDI'),
(56, '6E:31:7:4', 1247050120, 'DIAN EKA FAJRIANI '),
(57, '53:DE:6:4', 1247050114, 'FAIZ ABDULLAH FAWAZ'),
(58, '5:DE:8:4', 1247050111, 'AFDHAL JIHADI'),
(59, '45:46:8:4', 1247050106, 'AHMAD RIYADH FAWWAZ'),
(60, '84:E4:6:4', 1247050105, 'ALYA KHANSA DZAFIRA'),
(61, 'D:9F:9:4', 1247050102, 'AZKIYA FAUZAN SRI HIDAYAT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmprfid`
--

CREATE TABLE `tmprfid` (
  `IDCard` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `validation`
--

CREATE TABLE `validation` (
  `id` int(10) NOT NULL,
  `total_rfid_scan` smallint(11) NOT NULL,
  `total_yolo_scan` smallint(11) NOT NULL,
  `validation_date` date NOT NULL,
  `validation_time` time NOT NULL,
  `validation_status` enum('valid','invalid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `validation`
--

INSERT INTO `validation` (`id`, `total_rfid_scan`, `total_yolo_scan`, `validation_date`, `validation_time`, `validation_status`) VALUES
(34, 16, 16, '2025-02-02', '13:39:50', 'valid'),
(35, 19, 19, '2025-02-02', '13:43:08', 'valid');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `scan_rfid`
--
ALTER TABLE `scan_rfid`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IDCard` (`IDCard`);

--
-- Indeks untuk tabel `scan_yolo`
--
ALTER TABLE `scan_yolo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IDCard` (`IDCard`,`NIM`);

--
-- Indeks untuk tabel `tmprfid`
--
ALTER TABLE `tmprfid`
  ADD PRIMARY KEY (`IDCard`);

--
-- Indeks untuk tabel `validation`
--
ALTER TABLE `validation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `scan_rfid`
--
ALTER TABLE `scan_rfid`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT untuk tabel `scan_yolo`
--
ALTER TABLE `scan_yolo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `validation`
--
ALTER TABLE `validation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
