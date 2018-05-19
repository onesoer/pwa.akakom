<?php
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
	
	$idUser = $_GET['idUser'];
	include "../koneksi.php";
	$sql = "select * from user where idUser ='$idUser'";
	$hasil = mysqli_query($kon, $sql);
	if (!$hasil) die ("gagal koneksi");
	
	$data = mysqli_fetch_assoc($hasil);
	$idUser = $data["idUser"];
	$nama = $data["nama"];
	$kode_jabatan = $data["kode_jabatan"];
	$password = $data["password"];
	$foto = $data["foto"];
	$tanggal_lahir = $data["tanggal_lahir"];
	$no_kontak = $data["no_kontak"];
?>
<style>
	.button {
			width : 40 %;
			background-color: #4CAF50; 
			border: 1px solid white;
			color: white;
			padding: 10px 15px;
			text-align: center;
			display: inline-block;
			font-size: 20px;
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
			border-style: outset;
		}
	input {
			width: 80%;
			padding: 10px 12px;
			box-sizing: border-box;
			border-radius:7px;
		} 
		
		
</style>

<h2> EDIT DATA ADMIN </h2>
<form action="proses_simpan.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="idUser" value="<?php echo $idUser;?>"/>
	<input type="hidden" name="tanggal_lahir" value="<?php echo $tanggal_lahir;?>"/>
	<table style="background-color:white; border-radius:7px; width:60%;">
	<tr>
		<td style="width:50%;"> &nbsp </td>
		<td style="width:50%;"> &nbsp </td>
	</tr>
	<tr>
		<td>Password</td>
		<td>: <input type="text" name="password" value="<?php echo md5('$password');?>"/></td>
	</tr>
	<tr>
		<td>Foto</td>
		<td>
		<input type="file" name="foto" style="width:50%"/>
		<input type="hidden" name="foto_lama" value="<?php echo $foto;?>"/>
		<img src="<?php echo "../thumb/t_".$foto;?>" width ='50%'/>
		</td>
	</tr>
	<tr>
		<td>No Kontak</td>
		<td> : <input type="text" name="no_kontak" value="<?php echo $no_kontak;?>"/></td>
	</tr>
	<tr>
		<td style="width:50%;"> &nbsp </td>
		<td style="width:50%;"> &nbsp </td> 
	</tr>
	<tr>
		<td align="center">
		<input class="button" type="submit" name="proses" value="Submit"/>
		</td>
		<td>
		<input class="button" type="reset" name="reset" value="Reset"/>
		</td>
	</tr>
	<tr>
		<td style="width:50%;"> &nbsp </td>
		<td style="width:50%;"> &nbsp </td>
	</tr>
	</table>
</form>