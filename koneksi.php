<?php
 error_reporting(E_ALL ^ E_DEPRECATED);
 $host = "fdb4.awardspace.net";
 $user = "2540699_paw";
 $pass = "one165610068";
 $dbname = "2540699_paw";
 
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
	//buat tabel 
	$sqlUser = "create table if not exists user (
					idUser INT(3) NOT NULL auto_increment primary key,
					nama varchar(40) not null,
					kode_jabatan int (3) not null,
					password varchar (50) not null,
					foto varchar(70) not null default '',
					tanggal_lahir date not null, 
					no_kontak varchar (12) not null)";			
	mysqli_query($kon,"$sqlUser")or die("Gagal buat tabel User");
	
	$sqlUpahHarian = "create table if not exists Upah_Harian(
						id_upah varchar (8) not null, 
						idUser int (5) not null, 
						jumlah int (12) not null, 
						tanggal date not null, 
						setoran_kotor int (12) not null, 
						bbm int (12) not null, 
						potongan_driver int (12) not null)";
	mysqli_query($kon,"$sqlUpahHarian")or die("Gagal buat tabel Upah Harian");
	
	$sqlUtangDriver = "create table if not exists Utang_Driver(
						id_utang varchar (8) not null, 
						idUser int (5) not null, 
						jumlah int (12) not null, 
						tanggal date not null, 
						setoran_kotor int (12) not null, 
						bbm int (12) not null, 
						potongan_driver int (12) not null)";
	mysqli_query($kon,"$sqlUtangDriver")or die("Gagal buat tabel Utang Driver");
	
	$sqlBayarUtang = "create table if not exists Bayar_Utang(
						id_bayar varchar (8) not null,
						id_utang varchar (8) not null,						
						idUser int (5) not null, 
						jumlah int (12) not null, 
						tanggal date not null)";
	mysqli_query($kon,"$sqlBayarUtang")or die("Gagal buat tabel Bayar Utang");
	
	$sqlJabatan = "create table if not exists Jabatan(
						kode_jabatan int (3) not null, 
						nama_jabatan varchar (12) not null)";
	mysqli_query($kon,"$sqlJabatan")or die("Gagal buat tabel Jabatan");
	
	
	//primary key 
	$sqlPKUser = "alter table User add primary key (kode_jabatan)";
	mysqli_query($kon,"$sqlPKUser")or die("Gagal buat PK Di tabel User");
	
	$sqlPKUpahHarian = "alter table Upah_Harian add primary key (id_upah,idUser)";
	mysqli_query($kon,"$sqlPKUpahHarian")or die("Gagal buat PK Di tabel Upah Harian");
	
	$sqlPKUtang = "alter table Utang_Driver add primary key (id_utang,idUser)";
	mysqli_query($kon,"$sqlPKUtang")or die("Gagal buat PK Di tabel Utang_Driver");
	
	$sqlPKBayar = "alter table Bayar_Utang add primary key (id_bayar, idUser, id_utang)";
	mysqli_query($kon,"$sqlPKBayar")or die("Gagal buat PK Di tabel Bayar_Utang");
	
	$sqlPKJabat = "alter table Jabatan add primary key (kode_jabatan)";
	mysqli_query($kon,"$sqlPKJabat")or die("Gagal PK di Tabel Jabatan");
	
	//relasi
	$sqlRelasi1 = "alter table User add foreign key (kode_jabatan) 
				   references Jabatan(kode_jabatan)
				   on update cascade on delete cascade";
	mysqli_query($kon,"$sqlRelasi1")or die("Gagal buat relasi 1");
	
	$sqlRelasi2 = "alter table Upah_Harian add foreign key (idUser) 
				   references User(idUser)
				   on update cascade on delete cascade";
	mysqli_query($kon,"$sqlRelasi2")or die("Gagal buat relasi 2");
	
	$sqlRelasi2 = "alter table Upah_Harian add foreign key (idUser) 
				   references User(idUser)
				   on update cascade on delete cascade";
	mysqli_query($kon,"$sqlRelasi2")or die("Gagal buat relasi 2");
	
	$sqlRelasi3 = "alter table Utang_Driver add foreign key (idUser) 
				   references User(idUser)
				   on update cascade on delete cascade";
	mysqli_query($kon,"$sqlRelasi3")or die("Gagal buat relasi 3");
	
	$sqlRelasi4 = "alter table Bayar_Utang add foreign key (idUser) 
				   references User(idUser)
				   on update cascade on delete cascade";
	mysqli_query($kon,"$sqlRelasi4")or die("Gagal buat relasi 4");
	
	$sqlRelasi5 = "alter table Bayar_Utang add foreign key (id_utang) 
				   references Utang_Driver(id_utang)
				   on update cascade on delete cascade";
	mysqli_query($kon,"$sqlRelasi5")or die("Gagal buat relasi 5");
	
	$sql ="insert into Jabatan values ('1','Manajer'),('10','Admin'),('100','Driver')";
	mysqli_query($kon,$sql) or die ("Gagal Tambah Record Di Tabel Jabatan");
	
	$sql = "select * from user";
	$hasil = mysqli_query($kon,$sql);
	$jumlah = mysqli_num_rows($hasil);
	if ($jumlah==0) {
		$sql = "insert into user (idUser, nama, kode_jabatan, password, tanggal_lahir, no_kontak)
					values 
					('2','Manajer','1', md5('manajer'),'1992-09-09','081243590903'),
					('11','Admin','10', md5('12345'),'1992-09-09','081243590903')";
		mysqli_query($kon,$sql) or die ("Gagal Tambah Record");
	}
	
?>
