<?php
  $host ="localhost"; //host server
  $user ="id16503300_testingdb"; //user login phpMyAdmin
  $pass ="v+#k)JK!0{uod{}T"; //pass login phpMyAdmin
  $db ="id16503300_ctf"; //nama database
  $conn = mysqli_connect($host, $user, $pass, $db);

  // Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
  
?>