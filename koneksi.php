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
?>
