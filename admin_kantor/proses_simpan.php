<?php
	session_start();
	if(!isset($_SESSION['nama'])){
		echo "<script>
		javascript : alert('Anda Harus Login Terlebih Dahulu !!')
		</script> ";
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../index.html'>";
		exit();
	} else if($_SESSION['kode_jabatan']!='1'){
		echo "<script>
		javascript : alert('Anda Tidak Mempunyai Cukup Hak Untuk Mengakses Halaman Ini !!')
		</script> ";
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../index.html'>";
		exit();
	}

	if(isset($_POST['idUser'])){
		$idUser = $_POST['idUser'];
		$simpan = "EDIT";
		
	}else{
		$simpan = "BARU";	
	}
	
	$idUser = $_POST['idUser'];
	$nama = $_POST['nama'];
	$kode_jabatan = 10;
	$password = md5 ($_POST['password']);
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$no_kontak = $_POST['no_kontak'];
	
	$foto = $_FILES['foto']['name'];
	$tmpName = $_FILES['foto']['tmp_name'];
	$size = $_FILES['foto']['size'];
	$type = $_FILES['foto']['type'];
	
	$maxsize = 1500000;
	$typeYgBoleh = array("image/jpeg","image/png","image/pjpeg");
	
	$dirFoto = "../pict";
	if(!is_dir($dirFoto))
		mkdir($dirFoto);
	$fileTujuanFoto = $dirFoto."/".$foto;
	
	$dirThumb = "../thumb";
	if(!is_dir($dirThumb))
		mkdir($dirThumb);
	$fileTujuanThumb = $dirThumb."/t_".$foto;
	
		$_POSTValid = "Ya";
	if($size>0){
		if($size>$maxsize){
			echo "Ukuran file terlalu besar</br>";
			$valid_POST= "Tidak";
		}
		if(!in_array($type, $typeYgBoleh)){
			echo "Type file tidak dikenal</br>";
			$valid_POST= "Tidak";
		}
	}
	if(strlen(trim($nama))==0){
		echo "nama harus diisi!</br>";
		$_POSTValid = "Tidak";}
	if(strlen(trim($kode_jabatan))==0){
		echo "Kode Jabatan harus diisi!</br>";
		$_POSTValid = "Tidak";}
	if(strlen(trim($password))==0){
		echo "Password harus diisi!</br>";
		$_POSTValid = "Tidak";}
	if(strlen(trim($no_kontak))==0){
		echo "No Kontak harus diisi!</br>";
		$_POSTValid = "Tidak";}
	if($_POSTValid=="Tidak"){
		echo "<script>
		javascript : alert('Ada Kesalahan Input')
		</script> ";
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=input_admin.php'>";
		exit;}
	include "../koneksi.php";
	if ($simpan == "EDIT"){
		$sql = "update user set 
				nama = '$nama',
				password ='$password',
				foto ='$foto',
				no_kontak = $no_kontak 
				where idUser = $idUser";
	}else if ($simpan == "BARU") {
		$sql = "INSERT INTO `user' (`idUser`, `nama`, `kode_jabatan`, `password`, `foto`, `tanggal_lahir`, `no_kontak`) VALUES ('$idUser','$nama','$kode_jabatan','$password','$foto','$tanggal_lahir','$no_kontak')";
	}	
	
$hasil = mysqli_query($kon, $sql);

	if(!$hasil){
		echo "<script> javascript : alert('Gagal Simpan Silahkan Inputkan Ulang') </script> ";
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=input_admin.php'>";
		exit;} 
	else {
		echo "<script>
			javascript : alert('Simpan Data Berhasil')
			</script> ";
		}
	
	if ($size>0){
		if(!move_uploaded_file($tmpName, $fileTujuanFoto)){
			echo "<script>
					javascript : alert('Gagal Upload Foto')
				  </script> ";
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=input_admin.php'>";
		exit;
		}else{
			buat_thumbnail($fileTujuanFoto, $fileTujuanThumb);
		}
	}
	
	echo "<script>
			javascript : alert('Foto Anda Berhasil Di Unggah')
		  </script> ";
	
	function buat_thumbnail($file_src, $file_dst){
		list ($w_src, $h_src, $type) = getImageSize($file_src);
		
		switch ($type){
			case 1:
			$img_src = imagecreatefromgif($file_src);
			break;
			case 2:
			$img_src = imagecreatefromjpeg($file_src);
			break;
			case 3:
			$img_src = imagecreatefrompng($file_src);
			break;
		}
		
		$thumb = 100;
		if ($w_src > $h_src){
			$w_dst = $thumb;
			$h_dst = round($thumb/$w_src*$h_src);
		}else{
			$w_dst = round($thumb/$h_src*$w_src);
			$h_dst = $thumb;
		}
		
		$img_dst = imagecreatetruecolor($w_dst, $h_dst);
		
		imagecopyresampled($img_dst,$img_src,0,0,0,0,$w_dst, $h_dst,$w_src,$h_src);
		imagejpeg($img_dst, $file_dst);
		imagedestroy($img_src);
		imagedestroy($img_dst);
	}
	header("location:tampil_admin.php");
?>