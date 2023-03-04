## Aplikasi Pembayaran Listrik Pasca-Bayar Menggunakan CodeIgniter 3

## Persyaratan

- **PHP** v8.1+
- **MYSQL** v15.1
- **Web Server** Apache/Nginx


## Teknologi Yang Dipakai

1. **Javascript**
2. **PHP** dengan framework **CodeIgniter 3 (3.1.13)**
3. **MySQL**
5. **AdmitKit** Template



## Instalasi


#### 1. Download atau clone repository dari GitHub dan pindahkan ke folder root web server anda:
```bash
git clone https://github.com/nama_pengguna/nama_repositori.git
```
#### 2. Buatlah sebuah database MySQL pada server. Berikan nama yang sesuai dengan kebutuhan aplikasi.
#### 3. Import file database db_listrik.sql yang terletak di folder ./docs pada root folder aplikasi ke dalam database yang telah dibuat sebelumnya.
#### 4. Konfigurasikan koneksi database pada file application/config/database.php.
```php
$db['default'] = array(
    'dsn'      => '',
    'hostname' => 'nama_host', // defaultnya 'localhost'
    'username' => 'nama_pengguna',
    'password' => 'kata_sandi',
    'database' => 'nama_database',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    ...
);
```
> Sesuaikan nilai nama_host, nama_pengguna, kata_sandi, dan nama_database dengan nilai yang sesuai untuk menghubungkan ke database yang telah dibuat pada langkah sebelumnya.

#### 5. Buka aplikasi melalui browser dengan URL yang sesuai.
#### 6. Aplikasi siap digunakan.

<br>

## Contoh Login Untuk Admin dan Pelanggan

```
# Admin
ID : ADM000
pw : superadmin

# Pelanggan
username : unit
pw : 1234
username: test
pw: 12345
username: wkwkwk
pw: 12345
```

<br>