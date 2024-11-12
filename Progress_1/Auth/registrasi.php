<?php 
    require '../Koneksi/koneksi.php';
    require 'adminCnfg.php';

    session_start();

    if (isset($_SESSION['role'])){
        echo 
            "<script>
            alert('Anda harus logout dahulu!');
            </script>"; 
    }

    if (isset($_POST['registrasi'])) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $checkEmail = "SELECT * FROM akun WHERE email_akun = '$email'";
        $checkEmailRslt = mysqli_query($conn, $checkEmail);

        if(mysqli_num_rows($checkEmailRslt)>0  || $email == $adminUsr){
            echo "
            <script>
            alert('E-mail sudah digunakan!');
            document.location.href = 'registrasi.php';
            </script>
            ";
            exit;
        }

        $checkUsr = "SELECT * FROM akun WHERE username_akun = '$username'";
        $checkUsrRslt = mysqli_query($conn, $checkUsr);

        if(mysqli_num_rows($checkUsrRslt)>0){
            echo "
            <script>
            alert('Username sudah digunakan!');
            document.location.href = 'registrasi.php';
            </script>
            ";
            exit;
        }
        $upAkun = "INSERT INTO akun (username_akun, email_akun, password_akun) VALUES ('$username', '$email', '$passwordHash')";
        if(mysqli_query($conn, $upAkun)){
            echo "
                <script>
                alert('Registrasi berhasil!');
                document.location.href = 'login.php';
                </script>
                ";
        }else{
            echo "
                <script>
                alert('Registrasi gagal!');
                document.location.href = 'registrasi.php';
                </script>
                ";
        }


    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artha || Registrasi</title>
    <link rel="stylesheet" href="../Styles/auth-style.css">
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
                <input type="text" name="username" id="username" maxlength="30" placeholder="Username" required>
            </div>
            <div class="input-group">
                <img src="../Assets/icon/key.svg" alt="icon">
                <input type="password" name="password" id="password" maxlength="10" placeholder="Password" required>
                <img onclick="togglePassword()" id="eyeIcon" style="cursor: pointer;" src="../Assets/icon/eye-slash.svg" alt="icon">
            </div>
                <input type="submit" value="DAFTAR" name="registrasi" class="btn" style="margin-top: 60px">
    </form>
    <script src="../script.js"></script>
</body>
</html>