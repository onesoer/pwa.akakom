<?php
	$idUser = $_GET['idUser'];
	include "../koneksi.php";
	$sql = "select * from user where idUser ='$idUser'";
	$hasil = mysqli_query($kon, $sql);
	if (!$hasil) die ("gagal koneksi");
	
	$data = mysqli_fetch_assoc($hasil);
	$idUser = $data["idUser"];
	$nama = $data["nama"];
	$foto = $data["foto"];
	
	echo "APAKAH ANDA AKAN MENGHAPUS DATA";
	echo "ID User : ".$idUser."<br/>";
	echo "Nama User : ".$nama."<br/>";
	echo "Foto : <img src='../thumb/t_".$foto."'/><br/><br/>";
	echo "APAKAH DATA INI AKAN DIHAPUS?<br/>";
	echo "<a href='konfirmasi_hapus.php?idUser=$idUser&hapus=1'>YA</a>";
	echo"&nbsp; &nbsp;";
	echo "<a href='tampil_admin.php'>TIDAK</a><br/><br/>";
	
	if(isset($_GET['hapus'])){
		$sql = "delete from User where idUser ='$idUser'";
		$hasil = mysqli_query($kon, $sql);
		if(!$hasil){
			echo "<script>
			javascript : alert('Maaf Data Tidak Dapat Dihapus')
			</script> ";
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=tampil_admin.html'>";
		}else{
			$gbr = "../pict/$foto";
			if(file_exists($gbr)) unlink($gbr);
			$gbr = "../thumb/t_$foto";
			if(file_exists($gbr)) unlink($gbr);
			echo "<script>
			javascript : alert('Data User $idUser Berhasil Dihapus')
			</script> ";
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=tampil_admin.php'>";
		}
	}
?>