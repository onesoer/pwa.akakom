<!DOCTYPE html>
<html lang="en">
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
?>
<head>
<title>Input Data Admin</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		html {
			background: url(../logo.png);
			background-size: 400px 400px;
			background-repeat : repeat;
			font-family: "Lucida Console";
		}
		
		tr:hover {background-color: #f1f1f1;}
		
		body {
			margin: 5%;
		}
		
		.header {
			background-color: #f1f1f1;
			padding: 10px;
			text-align: center;
		}
		
		.footer {
			background-color: #f1f1f1;
			padding: 10px;
			text-align: center;
		}
		
		.column {
			float: left;
			padding: 10px;
			height: auto;
		}
		
		.column.middle {
			width: 73%;
			margin : 5px;
		}
		
		.column.side {
			width: 21%;
			margin : 5px;
		}

		.row:after {
			content: "";
			display: table;
			clear: both;
		}
		
		img {
			border: 1px solid #ddd;
			border-radius: 35%;
			padding: 5px;
			width: 100px;
		}
		
		.sidebar {
			width :50%;
			align : center;
			border : 3px solid white;
			border-radius : 5%;
			background-color: #f1f1f1;;
		}
		
		@media (max-width: 600px) {
		.column.side, .column.middle {
			width: 80%;
		}
		}
	</style>
</head>
<body>

<div class="header">
  <h1>PT. ABC </h1> 
  <h2>SISTEM INFORMASI 
  </br> PENGUPAHAN DRIVER TAKSI </h2>
</div>

<div class="row">
  <div class="column side" style="background-color:#aaa;">
	  <table style="color:black; align :center;">
			<tr class="sidebar"> 
			<td class="sidebar" align="center">
			<?php
			echo "<a href='../pict/{$_SESSION['foto']}'/>
			  <img src='../thumb/t_{$_SESSION['foto']}'witdh ='100'/>
			  </a>"; ?> </br>
			Nama : <?php echo $_SESSION['nama'];?> </br>
			No Kontak : <?php echo $_SESSION['no_kontak'];?> </br>
			</td> 
			</tr> 
			<tr>
			<td>  &nbsp  </td> 
			<tr>
			<tr>
			<td>  Menu  </td> 
			<tr class="sidebar">
			<td class="sidebar"> <a href="index.php"> Beranda </a> </td> 
			</tr>
			<tr class="sidebar">
			<td class="sidebar">  <a href="tampil_admin.php"> TAMPILKAN SEMUA DATA ADMIN KANTOR </a> </td> 
			</tr>
			<tr class="sidebar">
			<td class="sidebar"> <a href="input_admin.php"> INPUT DATA ADMIN KANTOR </a> </td>
			</tr>
			<tr class="sidebar">
			<td class="sidebar"> <a href="../logout.php"> LOGOUT </a> </td>
			</tr>
	  </table> 
  </div>
  
  <div class="column middle" style="background-color:#bbb;"> 
  <?php include "input_form.php";?>   
  </div>
</div>

<div class="footer">
  <p>TUGAS PENGEMBANGAN APLIKASI WEB
	   </br> STMIK AKAKOM YOGYAKARTA 
	   </br> &copy; by ONE </p>
</div>

</body>
</html>
