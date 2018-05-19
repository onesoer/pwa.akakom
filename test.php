<?php
 error_reporting(E_ALL ^ E_DEPRECATED);
 $host = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "paw";
 
 $kon = mysqli_connect($host, $user, $pass);
 if(!$kon)
	 die("Gagal koneksi...");
 
 $hasil = mysqli_select_db($kon, $dbname);
 if(!$hasil){
	 $hasil = mysqli_query($kon,"create database $dbname");
	 if(!$hasil)
		 die("Gagal buat database");
	 else
		 $hasil = mysqli_select_db($kon, $dbname);
		 if(!$hasil)die("Gagal konek database");
	}
$sql = "INSERT INTO `user` (`idUser`, `nama`, `kode_jabatan`, `password`, `foto`, `tanggal_lahir`, `no_kontak`)             VALUES ('42', 'Admin42', '10', MD5('admin'), 'logo atmik akakom.png', '2000-01-02', '76543')";
$hasil = mysqli_query($kon, $sql) or die ('Haduh Dimana Salahnya');
?>

