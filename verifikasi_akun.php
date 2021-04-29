<?php
    include "koneksi.php";
    session_start();
    if(isset($_POST['buatAkun'])){
        if(isset($_POST['userAkun']) && isset($_POST['email']) && isset($_POST['passAkun']) && isset($_POST['confirmPass'])){
            $nama = $_POST['userAkun'];
            $email = $_POST['email'];
            $passAkun = $_POST['passAkun'];
            $confirmPass = $_POST['confirmPass'];

            //Cek Apakah email nya sudah pernah terpakai
            $cekEmail = mysqli_query($conn,"select * from tabel_login WHERE email='$email'");
            // menghitung jumlah data yang ditemukan
            $cek = mysqli_num_rows($cekEmail);
            
            if($cek > 0){
                $msg = "Email Anda sudah pernah terdaftar";
            }
            else{
                if ($nama[0] != ' ' && preg_match("/^[a-zA-Z ]*$/",$nama)){
                    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", trim($email))){
                        if($passAkun == $confirmPass){
                            $kode = md5(uniqid(rand()));

                            $queryBuat = mysqli_query($conn,"INSERT INTO tabel_login (username, password, email, kode, active) VALUES ('$nama', '$passAkun', '$email', '$kode', 'F')");

                            $to=$email;
                            $subject="Email verification";
                            $headers .= "MIME-Version: 1.0"."\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                            $headers .= 'From:CTF UAJM 18 <ctf18email@gmail.com>'."\r\n";

                            $ms.="<html></body><div><div>Dear $nama,</div></br></br>";
                            $ms.="<div style='padding-top:8px;'>Please click The following link For verifying and activation of your account</div>
                            <div style='padding-top:10px;'><a href='https://ctfwebsitefreehosting.000webhostapp.com/menu1.html'>Click Here</a></div>
                            <div style='padding-top:4px;'>Powered by <a href='https://ctfwebsitefreehosting.000webhostapp.com/'>Free Hosting CTF</a></div></div>
                            </body></html>";
                            mail($to,$subject,$ms,$headers);


                            
                            if($queryBuat){
                                //echo "Akun Berhasil dibuat. Tinggal Verifikasi";
                                echo "<script>alert('Silahkan verifikasi akun melalui link pada email Anda')</script>";
                                echo "<script>window.location.href='index.php';</script>";
                            }
                            else{
                                die ('Akun Gagal Dibuat!' .mysqli_error($conn));
                            }

                        }
                        else{
                            $msg = "Buat Akun gagal! Password & COnfirm Password tidak cocok";
                        }
                    }
                    else{
                        $msg = "Buat Akun gagal! Bukan email";
                    }
                }
                else {
                    $msg = "Buat Akun gagal! Tidak boleh spasi awal username";
                }
            }

        }
        else{
            $msg = "Tidak Boleh kosong";
        }
    }

?>