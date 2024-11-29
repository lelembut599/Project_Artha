<?php 
session_start();
require '../Koneksi/koneksi.php';
require 'adminCnfg.php';
require '../Template/function.php';

checkAuth();

if(isset($_POST['masuk'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if($email === $adminUsr){
        if($password == $adminPass){
            $_SESSION['role'] = 'admin';
            $_SESSION['name'] = $email;
            echo "
                <script>
                    document.location.href = '../Admin/homeAdmin.php';
                </script>";
        }else{
            echo "
                <script>
                    alert('Password Salah!');
                    document.location.href = 'login.php';
                </script>";

        }
    }else{
        $findUsr = "SELECT * FROM akun WHERE email_akun = '$email'";
        $findUsrRslt = mysqli_query($conn, $findUsr);

        if (mysqli_num_rows($findUsrRslt) === 1){
            $akun = mysqli_fetch_assoc($findUsrRslt);
                if(password_verify($password, $akun['password_akun'])){
                    $_SESSION['role'] = 'user';
                    $_SESSION['name'] = $email;
                    echo "
                    <script>
                        document.location.href = '../User/homeUser.php';
                    </script>";
                }else{
                    echo "
                    <script>
                        alert('Password Salah!');
                        document.location.href = 'login.php';
                    </script>";
                } 
        }else{
            echo "
                <script>
                    alert('E-mail Salah!');
                    document.location.href = 'login.php';
                </script>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artha || Masuk</title>
    <link rel="stylesheet" href="../Styles/auth-style.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="image">
                <img src="../Assets/login--ills-removebg-preview.png" alt="login illustration">
            </div>
            <p>Temukan berbagai rekomendasi makanan di <span style="color: #E60022">ARTHA</span></p>
        </div>
        <div class="right-section">    
            <form action="" method="post" class="formlogin">
                <h2>MASUK</h2>
                <div class="input-group">
                    <img src="../Assets/icon/envelope.svg" alt="icon">
                    <input type="email" name="email" id="email" placeholder="E-mail" required>
                </div>
                <div class="input-group">
                    <img src="../Assets/icon/key.svg" alt="icon">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <img onclick="togglePassword()" style="cursor: pointer;" id="eyeIcon" src="../Assets/icon/eye-slash.svg" alt="icon">
                </div>
                <input type="submit" value="MASUK" name="masuk" class="btn" style="margin-bottom: 10px;">
                <p class="links">Belum punya akun? <a href="registrasi.php">Daftar</a></p>
            </form>
        </div>
    </div>
    <script src="../script.js"></script>
</body>
</html>