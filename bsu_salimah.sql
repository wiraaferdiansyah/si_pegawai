-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Des 2023 pada 15.32
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsu_salimah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id_jenis` varchar(20) NOT NULL,
  `jensiSampah` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `jensiSampah`, `harga`) VALUES
('P01B', 'PP Gelas Bening Bersih', 5800),
('P01K', 'PP Gelas Bening Kotor', 2500),
('P02B', 'PP Gelas Warna', 1900),
('P02C', 'PP Cincin Gelas', 1500),
('P02K', 'PP Gelas Warna Kotor', 1500),
('P03B', 'PET Bening Bersih', 4700);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nasabah`
--

CREATE TABLE `tb_nasabah` (
  `noInduk` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `noHp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_nasabah`
--

INSERT INTO `tb_nasabah` (`noInduk`, `nama`, `alamat`, `noHp`) VALUES
('1119', 'Sahrur', 'Batua', '081786554233');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`) VALUES
(1, 'Sahrur Ramadhan', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id_profil` int(11) NOT NULL,
  `nama_profil` varchar(50) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_profil`
--

INSERT INTO `tb_profil` (`id_profil`, `nama_profil`, `alamat`) VALUES
(1, 'BANK SAMPAH UNIT SALIMAH', 'MAKASSAR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_setoran`
--

CREATE TABLE `tb_setoran` (
  `idSetoran` int(11) NOT NULL,
  `id_jenis` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `debit` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_setoran`
--

INSERT INTO `tb_setoran` (`idSetoran`, `id_jenis`, `tanggal`, `berat`, `debit`, `kredit`, `saldo`) VALUES
(1, NULL, '0002-02-21', 2, 600, 11000, NULL),
(2, NULL, '1222-03-31', 2, 500, 2500, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tb_setoran`
--
ALTER TABLE `tb_setoran`
  ADD PRIMARY KEY (`idSetoran`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_setoran`
--
ALTER TABLE `tb_setoran`
  MODIFY `idSetoran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_setoran`
--
ALTER TABLE `tb_setoran`
  ADD CONSTRAINT `tb_setoran_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis` (`id_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
