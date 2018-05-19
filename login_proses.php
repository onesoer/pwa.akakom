<?php
	session_start();
	$nama = $_POST['nama'];
	$password = md5($_POST['password']);
	
	$dataValid="YA";
	if(strlen(trim($nama))==0){
		echo "User Harus Diisi! <br/>";
		$dataValid = "TIDAK";
	}
	if(strlen(trim($password))==0){
		echo "Password Harus Diisi! <br/>";
		$dataValid = "TIDAK";
	}

	if ($dataValid=="TIDAK") {
		# code...
		echo "Masih Ada Kesalahan, silahkan perbaiki! </br>";
		echo "<input type='button' value='kembali' onClick='self.history.back()'>";
		exit();
	}

	include "koneksi.php";
	$sql = "select * from user where
			nama='$nama' and password = '$password' limit 1";

	$hasil = mysqli_query($kon, $sql) or die(mysqli_error());
	$jumlah = mysqli_num_rows($hasil);
	if ($jumlah > 0 ) {
		# code...
		$row = mysqli_fetch_assoc($hasil);
		$_SESSION['nama'] = $row['nama'];
		$_SESSION['no_kontak'] = $row ['no_kontak'];
		$_SESSION['foto'] = $row ['foto'];
		$_SESSION['kode_jabatan'] = $row['kode_jabatan'];
		if($row['kode_jabatan']=='1'){
            header("location:admin_sistem/index.php");
        }
		else if($row['kode_jabatan']=='5'){
            header("location:admin_kantor/index.php");
        } 
		else if($row['kode_jabatan']=='100'){
            header("location:driver/index.php");
        }
		
	} else{ 
		echo "<script>
		javascript : alert('Maaf Nama Pengguna & Kata Sandi Yang Anda Masukan Tidak Cocok')
		</script> ";
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=index.html'>";
	}
?>
