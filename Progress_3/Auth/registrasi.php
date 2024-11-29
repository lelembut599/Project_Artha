<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require 'adminCnfg.php';
    require '../Template/function.php';

    checkAuth();

    if (isset($_POST['registrasi'])) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $checkEmail = "SELECT * FROM akun WHERE email_akun = '$email'";
        $checkEmailRslt = mysqli_query($conn, $checkEmail);

        if(mysqli_num_rows($checkEmailRslt)>0  || $email == $adminUsr){
            $massage = 'E-mail sudah digunakan!';
            $link = 'registrasi.php';
            badAllert($massage, $link);
            exit;
        }
        
        $checkUsr = "SELECT * FROM akun WHERE username_akun = '$username'";
        $checkUsrRslt = mysqli_query($conn, $checkUsr);
        
        if(mysqli_num_rows($checkUsrRslt)>0){
            $massage = 'Username sudah digunakan!';
            $link = 'registrasi.php';
            badAllert($massage, $link);
            exit;
        }
        $upAkun = "INSERT INTO akun (username_akun, email_akun, password_akun) VALUES ('$username', '$email', '$passwordHash')";
        if(mysqli_query($conn, $upAkun)){
            echo "
            <script>
            document.location.href = 'login.php';
            </script>
            ";
        }else{
            $massage = 'Registrasi gagal!';
            $link = 'registrasi.php';
            badAllert($massage, $link);
        }


    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/auth-style.css">
    <link rel="icon" type="image/png" href="../Assets/asp-net.png">
    <title>ARTHA</title>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="image">
                <img src="../Assets/regis-ills-removebg-preview.png" alt="regist illustration">
            </div>
            <p><span style="color: #E60022">ARTHA</span> menyediakan berbagai rekomendasi makanan</p>
        </div>
        <div class="right-section">   
            <form action="" method="POST" class="formlogin">
            <h2>DAFTAR</h2> 
            <div class="input-group">
                <img src="../Assets/icon/envelope.svg" alt="icon">
                <input type="email" name="email" id="email" maxlength="255" placeholder="E-mail" required>
            </div>
            <div class="input-group">
                <img src="../Assets/icon/person.svg" alt="icon">
                <input type="text" name="username" id="username" minlength="3" maxlength="20" placeholder="Username" required>
            </div>
            <div class="input-group">
                <img src="../Assets/icon/key.svg" alt="icon">
                <input type="password" name="password" id="password" minlength="3" maxlength="10" placeholder="Password" required>
                <img onclick="togglePassword()" id="eyeIcon" style="cursor: pointer;" src="../Assets/icon/eye-slash.svg" alt="icon">
            </div>
                <input type="submit" value="DAFTAR" name="registrasi" class="btn" style="margin-top: 60px">
                <p class="links">Sudah punya akun? <a href="login.php">Masuk</a></p>
    </form>
    <script src="../script.js"></script>
</body>
</html>