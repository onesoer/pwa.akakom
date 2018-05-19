<?php
	session_start();
	session_unset();
	session_destroy();
	echo "Anda Sudah Logout <br/>";
	header("location:index.html");
?>
