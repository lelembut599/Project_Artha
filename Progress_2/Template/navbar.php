<?php 
    require '../Koneksi/koneksi.php';


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if($_SESSION['role'] === 'user'){
        $email = $_SESSION['name'];
        $profileSql = "SELECT *  FROM akun WHERE email_akun = '$email'";
        $profileRslt = mysqli_query($conn, $profileSql);
        $profile = mysqli_fetch_assoc($profileRslt);
        if(empty($profile['foto_akun'])){
            $profile['foto_akun'] = "null-profile.png";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <img src="../Assets/artha-logo.png" alt="logo artha" class="logo">
        
        <?php if($_SESSION['role'] === 'admin'): ?>
            <ul>
                <li><a href="../Admin/homeAdmin.php">Beranda</a></li>
                <li><a href="../Admin/verifikasiReview.php">Konfirmasi</a></li>
                <li><a href="../Admin/reportReview.php">Report</a></li>
            </ul>
            <?php else: ?>
                <ul>
                    <li><a href="../User/homeUser.php">Beranda</a></li>
                    <li><a href="../User/cariReview.php">Cari</a></li>
                    <li><a href="../User/buatReview.php">Unggah</a></li>
                    <li><a href="../Auth/logout.php">Keluar</a></li>
                    <li><a href="../User/userProfile.php"><img src="../ProfilePicture/<?php echo $profile['foto_akun']?>" alt=""></a></li>
                </ul>
                <?php endif; ?>
            </nav>

    <div class="nav-underlay">
        <!-- <img src="../Assets/artha-logo.png" alt="logo artha" class="logo"> -->
    </div>
</body>
</html>