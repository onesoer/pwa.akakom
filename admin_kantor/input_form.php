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
?>
<style>
	input {
			width: 80%;
			padding: 10px 12px;
			box-sizing: border-box;
			border-radius:7px;
		} 
		
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
</style>
<h2>  TAMBAH AKUN ADMIN </h2>
<form action="proses_simpan.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="kode_jabatan" value="<?php $kode_jabatan=10; echo $kode_jabatan?>"/>
	<table style="background-color:white; border-radius:7px; width:60%;">
	<tr>
		<td style="width:50%;"> &nbsp </td>
		<td style="width:50%;"> &nbsp </td>
	</tr>
	<tr>
		<td>ID User</td>
		<td> : <input type="text" name="idUser"/></td>
	</tr>
	<tr>
		<td>Nama User</td>
		<td> :  <input type="text" name="nama"/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td> :  <input type="password" name="password"/></td>
	</tr>
	<tr>
		<td>Foto</td>
		<td> : <input type="file" name="foto"/>	</td>
	</tr>
	<tr>
		<td>Tanggal Lahir</td>
		<td> : <input type="text" name="tanggal_lahir"/></td>
	</tr>
	<tr>
		<td>No Kontak</td>
		<td> : <input type="text" name="no_kontak"/></td>
	</tr>
	<tr>
		<td align="center"> <input class="button" type="submit" name="Simpan" value="Submit"/> </td>
		<td> <input class="button" type="reset" name="Reset" value="Reset"/> </td>
	</tr>
	<tr>
		<td> &nbsp </td>
		<td> &nbsp </td>
	</tr>
	</table>
</form>