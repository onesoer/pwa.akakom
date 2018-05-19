<?php
	if(isset($_POST['idUser'])){
		$idbarang = $_POST['idUser'];
		$foto_lama = $_POST['foto_lama'];
	$simpan = "EDIT";
	}else{
	$simpan = "BARU";	
	}
	
	$idUser = $_POST['idUser']; 
    $nama = $_POST['nama'];
	$password = $_POST['password'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
    $no_kontak = $_POST['no_kontak'];
	
	$foto = $_FILES['foto']['name'];
	$tmpName = $_FILES['foto']['tmp_name'];
	$size = $_FILES['foto']['size'];
	$type = $_FILES['foto']['type'];
	
	$maxsize = 1500000;
	$typeYgBoleh = array("image/jpeg","image/png","image/pjpeg");
	
	$dirFoto = "pict";
	if(!is_dir($dirFoto))
		mkdir($dirFoto);
	$fileTujuanFoto = $dirFoto."/".$foto;
	
	$dirThumb = "thumb";
	if(!is_dir($dirThumb))
		mkdir($dirThumb);
	$fileTujuanThumb = $dirThumb."/t_".$foto;
	
		$dataValid = "Ya";
	if($size>0){
		if($size>$maxsize){
			echo "Ukuran file terlalu besar</br>";
			$validData= "Tidak";
		}
		if(!in_array($type, $typeYgBoleh)){
			echo "Type file tidak dikenal</br>";
			$validData= "Tidak";
		}
	}
    if(strlen(trim($idUser))==0){
		echo "ID USER TIDAK BOLEH KOSONg</br>";
		$dataValid = "Tidak";}
	if(strlen(trim($nama))==0){
		echo "NAMA TIDAK BOLEH KOSONG</br>";
		$dataValid = "Tidak";}
	if(strlen(trim($password))==0){
		echo "PASSWORD TIDAK BOLEH KOSONG</br>";
		$dataValid = "Tidak";}
	if(strlen(trim($tanggal_lahir))==0){
		echo "Tanggal Lahir Harus Diisi</br>";
		$dataValid = "Tidak";}
    if(strlen(trim($no_kontak))==0){
		echo "Nomer KOntak Harus Diisi</br>";
		$dataValid = "Tidak";}
	if($dataValid=="Tidak"){
		echo "masih ada kesaladan, silahkan perbaiki!</br>";
		echo "<input type='button' value='kembali'
		onClick='self.history.back()'>";
		exit;}

	include "../koneksi.php";
	if($simpan == "EDIT"){
		if($size == 0){
			$foto = $foto_lama;
		}
		$sql = "update user set
            no_kontak = '$no_kontak',
			password = '$password',
			foto = '$foto'
			where idUser = $idUser";
		}
	else{
		$sql = "insert into user
			(idUser,nama,kode_jabatan,password,foto,tangal_lahir,no_kontak)
			values
			('$idUser', '$nama', 10, MD5('$password'),'$foto', $tanggal_lahir, '$no_kontak')";
		}
	$hasil = mysqli_query($kon, $sql) or die ("Salah Query");
	if(!$hasil){
		echo "Gagal simpan, silahkan diulangi!</br>";
		echo mysqli_error($kon);
		echo "<input type='button' value='kembali'
		onClick='self.history.back()'>";
		exit;} 
	else {
	echo "Simpan data berhasil";}
	
	if ($size>0){
		if(!move_uploaded_file($tmpName, $fileTujuanFoto)){
			echo "Gagal upload gambar</br>";
			echo "<a href='barang_tampil.php>Daftar barang</a>";
			exit;
		}else{
			buat_thumbnail($fileTujuanFoto, $fileTujuanThumb);
		}
	}
	
	echo "<br/>File sudah diupload.</br>";
	
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
?>
<hr/>
<a href="tampil_admin.php"/>Daftar </a>