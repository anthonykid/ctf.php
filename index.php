<?php
    include "koneksi.php";
    session_start();
    if(isset($_POST['login'])){
        $user = $_POST['user'];
		$pass = $_POST['pass'];

		if ($user[0] != ' ' && preg_match("/^[a-zA-Z ]*$/",$user)){
			$cekLogin = mysqli_query($conn,"select * from tabel_login WHERE username='$user' AND password='$pass'");
			// menghitung jumlah data yang ditemukan
			$cek = mysqli_num_rows($cekLogin);
			
			if($cek > 0){
				$_SESSION['username'] = $user;
				$_SESSION['password'] = $pass;
				header("Location: menu.php");
			}
			else{
				//echo "Username dan Password Salah";
				$msg = "Login gagal! Username atau Password salah!";
			}
		}
		else{
			$msg = "Buat Akun gagal! Tidak boleh spasi awal username";
		}

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/style.min.css">
	<title>Mainweb</title>
	<script src="https://kit.fontawesome.com/b4f4eda484.js" crossorigin="anonymous"></script>
</head>
<body>
	<section>
<div class="circle"></div>	
<header>
	<div class="logo"><a href="">CTF 2021_UAJM</a></div>
	<div class="containerSign">
		<div class="sigNp"><a href="">Belum Punya Akun  ?</a></div>
		<a href="buat_akun.php"><div class="buttonSign"> Sign Up </div></a>
	</div>
</header>


<div class="formContainer">
	<div class="formBox">
		<div class="judulForm"><h1>WELCOME</h1><h2>Capture The Flag</h2></div>
        <br>

        <?php 
            if(isset($msg)){  // Check if $msg is not empty
                echo '<b style="color:red">'.$msg.'</b>'; // Display our message
            } 
        ?>
  
		<form method="POST" class="formAction" action="index.php">
			
				<div class="inputUser">
					<input class="user" type="text" id="user" name="user" placeholder="User Name">
				</div>
				<div class="passUser">
					<input class="pass" type="password" id="pass" name="pass" placeholder="Password">
				</div>
		
			<div class="buttonLogin">
                    <button type="submit" name="login" class="Login">LOGIN</button>
			</div>
	
			<div class="copyRight">
				<p></p><i class="far fa-copyright"></i>CTF Atma Jaya Makassar 2021 </p>
			</div>
		</form>
	</div>
</div>
</section>
</body>
</html>