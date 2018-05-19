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
		.out {
			align : center;
			border-bottom: 3px solid #f1f1f1;
			text-align : center;
		}
		
		.out:hover {
			background-color: #f1f1f1;
			color : #000000;
		}
		
</style>
<?php
	include "../koneksi.php";
	$sql = "select idUser, foto, nama, tanggal_lahir, no_kontak from user where kode_jabatan='10'";
	$hasil = mysqli_query($kon, $sql);
	if(!$hasil)
		die ("Gagal query..".mysql_error($kon));
	
?>
	<table style = "background-color: #4CAF50; color:white; width : 100%; border-radius : 8px; border : 5px solid white;">
	<tr style="text-shadow: 3px 2px black; font-size : 20px; border-bottom: 3px solid #f1f1f1; ">
		<th> ID User </th>
		<th> Foto </th>
		<th> Nama </th>
		<th> Tanggal Lahir </th>
		<th> No Kontak </th> 
		<th> Aksi </th>
	</tr>
	
<?php
	
	$no = 0;
	while ($row = mysqli_fetch_assoc($hasil)){
		echo "<tr class='out'>";
		echo "<td class='out'>".$row['idUser']."</td>";
		echo "<td class='out'><a href='../pict/{$row['foto']}'/>
					<img src='../thumb/t_{$row['foto']}'width='100px'/>
					</a></td>";
		echo "<td class='out'>".$row['nama']."</td>";
		echo "<td class='out'>".$row['tanggal_lahir']."</td>";
		echo "<td class='out'>".$row['no_kontak']."</td>";
		echo "<td class='out'> 
				<a href='input_edit.php?idUser=".$row['idUser']."'/>UBAH</a> </br> </br>
				<a href='konfirmasi_hapus.php?idUser=".$row['idUser']."'/>HAPUS</a>			
			  </td> ";
		echo "</tr>";
	}
?>
	</table>