CREATE TABLE penggunaan (
  id_penggunaan INT AUTO_INCREMENT PRIMARY KEY,
  id_pelanggan INT NOT NULL,
  bulan VARCHAR(25) NOT NULL,
  tahun INT NOT NULL,
  meter_awal INT NOT NULL,
  meter_akhir INT NOT NULL
);

CREATE TABLE pelanggan (
  id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
  nama_pelanggan VARCHAR(128) NOT NULL,
  username VARCHAR(128) NOT NULL,
  password VARCHAR(255) NOT NULL,
  nomor_kwh VARCHAR(128),
  alamat VARCHAR(255),
  id_tarif INT
);

CREATE TABLE tagihan (
  id_tagihan INT AUTO_INCREMENT PRIMARY KEY,
  id_penggunaan INT NOT NULL,
  id_pelanggan INT NOT NULL,
  bulan VARCHAR(25) NOT NULL,
  tahun INT NOT NULL,
  jumlah_meter INT NOT NULL,
  status VARCHAR(30) NOT NULL
);

CREATE TABLE tarif (
  id_tarif INT AUTO_INCREMENT PRIMARY KEY,
  daya INT NOT NULL,
  tarif_perkwh INT NOT NULL
);

CREATE TABLE pembayaran (
  id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
  id_tagihan INT NOT NULL,
  id_pelanggan INT NOT NULL,
  tgl_bayar DATE NOT NULL,
  biaya_admin INT NOT NULL,
  total_bayar INT NOT NULL,
  id_user INT NOT NULL
);

CREATE TABLE user (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(128) NOT NULL,
  password VARCHAR(255) NOT NULL,
  nama_admin VARCHAR(128) NOT NULL,
  id_level INT NOT NULL
);

CREATE TABLE level (
  id_level INT AUTO_INCREMENT PRIMARY KEY,
  level VARCHAR(128) NOT NULL
);
