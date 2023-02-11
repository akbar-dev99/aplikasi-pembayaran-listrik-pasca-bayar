-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 11 Feb 2023 pada 12.09
-- Versi server: 10.9.4-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_listrikku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` varchar(128) NOT NULL,
  `level` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `level`) VALUES
('LVL001', 'ADMIN'),
('LVL002', 'PETUGAS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(128) NOT NULL,
  `nama_pelanggan` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomor_kwh` varchar(128) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_tarif` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username`, `password`, `nomor_kwh`, `alamat`, `id_tarif`) VALUES
('PLG2209010001', 'unit zero', 'unit.zero', '$2y$10$tPA60JV0Obr6nBktdQ98AOXorcKWIOdYP17Qw5xJFzUCq1IIv.JiC', '00000000000', 'Jln 000', 'TRF20230205002'),
('PLG2210060004', 'pax', 'pax', '$2y$10$pMLeth.kT9ISPrmDWQZAFu/qwFlwGvrW3K5jxEZeyCEm.758DkASO', '0251823230800', 'Bandung', 'TRF20230205009'),
('PLG2210100001', 'KKKKKKK', 'kkkkkkk', '$2y$10$uBS4h11n2oE5CYAA7czaoOWD7gS1n2m8lKO..Myi8N75B0Rt4PPeW', '025180150800', 'JL. KKK RT.22/RW.22', 'TRF20230205009'),
('PLG2302040001', 'yo this unit', '__unitttt', '$2y$10$VUJ7BuaGNnL1uXWK4P/VSesof2HNc2uaaIlNzEbutH6CIlp9Wtl0O', '9000', 'Jl. Antara no 48', 'TRF20230205007'),
('PLG2302050001', 'unit1', 'unit1', '$2y$10$ZaE/iIWDsw2zAMZtp3SBpuLq8RN62kJ4jWqjp61Me5Vks0C.NIG/C', '800004545', 'Jl. Antara no 48', 'TRF20230205002'),
('PLG2302050002', 'unit3', 'unit3', '$2y$10$xxIc.PRr7.r1D9ceCY7hleMHYUpS3GzLTpu/lzIScUrpzzO2bwjBe', '800004545', 'Jl. ???? No 6666', 'TRF20230205002'),
('PLG2302060001', 'Unit4', 'unit4', '$2y$10$fnxnbxWPfpdrsehZHeG9keA2SWs5fmx4PEUeEs0MZBq1ICZMsDERS', '66666666', 'Bekasi Raya', 'TRF20230205002'),
('PLG2302060002', 'pelanggan 123', 'plgn123', '$2y$10$a1ervVeNULyzB.eZto2byeXlSXpW91T5rDWmmoUeDkMGeUiena0ye', '025180150800', 'Bekasi Raya', 'TRF20230205007'),
('PLG2302080001', 'collector', 'collector', '$2y$10$gQJ97faAnqsXbO2zUDrTIONmE3wDSD2793bEphEfF9kymg/UvCL6i', '94849368435', 'Jatiwaringin', 'TRF20230205007'),
('PLG2302080002', 'LOL', 'lol555', '$2y$10$kP/t5Bma05iehnEmA/A56uXRT1VuJGszN08D0IuGCPdlM4e5eRpeq', '3593480249', 'Finding....', 'TRF20230205009'),
('PLG2302090001', 'test', 'test', '$2y$10$fdgKijKfdKND.USAjNBFfegbKmKquwKiVkLIjUL1v2VcqthfC0eKe', '9248937520', 'Test Alamat', 'TRF20230205009');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(128) NOT NULL,
  `id_tagihan` varchar(128) NOT NULL,
  `id_pelanggan` varchar(128) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_user` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `id_pelanggan`, `tgl_bayar`, `biaya_admin`, `total_bayar`, `id_user`) VALUES
('PAY230210001', 'TG2302100002', 'PLG2302040001', '2023-02-10', 2500, 102500, 'USR0001'),
('PAY230210002', 'TG2302100003', 'PLG2302090001', '2023-02-10', 2500, 202500, 'USR0001'),
('PAY230210003', 'TG2209100005', 'PLG2210100001', '2022-10-01', 2500, 202500, 'USR0001'),
('PAY230210004', 'TG2211100005', 'PLG2210100001', '2022-11-01', 2500, 262500, 'USR0001'),
('PAY230210005', 'TG2302100005', 'PLG2210100001', '2023-01-01', 2500, 242500, 'USR0001'),
('PAY230211001', 'TG2302100006', 'PLG2210100001', '2023-02-01', 2500, 302500, 'USR0001'),
('PAY230211002', 'TG2302110001', 'PLG2209010001', '2023-02-01', 2500, 152500, 'USR0001'),
('PAY230211003', 'TG2302110002', 'PLG2302080001', '2023-02-01', 2500, 102500, 'USR0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` varchar(128) NOT NULL,
  `id_pelanggan` varchar(128) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
('PN220101002', 'PLG2302080001', 1, 2023, 0, 100),
('PN220910005', 'PLG2210100001', 9, 2022, 0, 100),
('PN221016005', 'PLG2210100001', 10, 2022, 100, 230),
('PN230210002', 'PLG2302040001', 1, 2023, 200, 300),
('PN230210003', 'PLG2302090001', 1, 2023, 0, 100),
('PN230210004', 'PLG2302040001', 2, 2023, 300, 400),
('PN230210005', 'PLG2210100001', 12, 2022, 230, 350),
('PN230210006', 'PLG2210100001', 1, 2023, 350, 500),
('PN230211001', 'PLG2209010001', 1, 2023, 0, 100),
('PN230211002', 'PLG2302080001', 2, 2023, 100, 210);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` varchar(128) NOT NULL,
  `id_penggunaan` varchar(128) NOT NULL,
  `id_pelanggan` varchar(128) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah_meter` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES
('TG2209100005', 'PN220910005', 'PLG2210100001', 9, 2022, 100, 'PAID'),
('TG2211100005', 'PN221016005', 'PLG2210100001', 10, 2022, 130, 'PAID'),
('TG2302100002', 'PN230210002', 'PLG2302040001', 1, 2023, 100, 'PAID'),
('TG2302100003', 'PN230210003', 'PLG2302090001', 1, 2023, 100, 'PAID'),
('TG2302100004', 'PN230210004', 'PLG2302040001', 2, 2023, 100, 'UNPAID'),
('TG2302100005', 'PN230210005', 'PLG2210100001', 12, 2022, 120, 'PAID'),
('TG2302100006', 'PN230210006', 'PLG2210100001', 1, 2023, 150, 'PAID'),
('TG2302110001', 'PN230211001', 'PLG2209010001', 1, 2023, 100, 'PAID'),
('TG2302110002', 'PN220101002', 'PLG2302080001', 1, 2023, 100, 'PAID'),
('TG2302110003', 'PN230211002', 'PLG2302080001', 2, 2023, 110, 'UNPAID');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` varchar(128) NOT NULL,
  `daya` varchar(25) NOT NULL,
  `tarif_perkwh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarif_perkwh`) VALUES
('TRF20230205002', '900VA', 1500),
('TRF20230205007', '450VA', 1000),
('TRF20230205009', '1500VA', 2000),
('TRF20230205010', '1300VA', 1500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(128) NOT NULL,
  `id_level` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_admin`, `id_level`) VALUES
('ADM0000', 'superadmin', 'superadmin', 'superadmin', 'LVL001'),
('USR0001', 'Admin', '$2y$10$yuL.WbMZOTxtTZRMoi19k.k3okzdhsut81wKd6k0B2.hDWGyHue/y', 'Admin', 'LVL001'),
('USR0002', 'petugas_admin', '$2y$10$r/0R1J98IlE5wFil6gsuZOgAkfDZ.grlfk33r2mR/At9nAuq1iF3y', 'Petugas', 'LVL002'),
('USR0003', 'petugas001', '$2y$10$F0cY/xyS0rBXDObRZNLaYuEjlmbONHamVZPCWiKIDyilKnki3q83G', 'Petugas001 UP', 'LVL002'),
('USR0004', 'zev', '$2y$10$bEP6mbZZhPTDUMBdJk736ucZ9SeDHXEi0JYhhzjzTaBKjscOWVg5W', 'zev', 'LVL001'),
('USR0005', 'wkwkwk', '$2y$10$n7Soqa3V8AZgbl1DeOU6I.oVRPzpZ9JJ1agx5RckmlEDrrVYiM0VC', 'wkwkwk', 'LVL002'),
('USR0006', 'admin2', '$2y$10$Ot/q7sj6xqTR8uzIHkl9JO.nDCFHVZxf7.aBw6TriZAf1UVX5fSbK', 'admin2', 'LVL002');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indeks untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
