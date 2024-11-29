<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/function.php';

    checkAccess();

    $userEmail = $_SESSION['name'];

    $getAkunInfoSql = "SELECT * FROM akun WHERE email_akun = '$userEmail'";
    $getAkunInfoRrlt = mysqli_query($conn, $getAkunInfoSql);
    $akunInfo = mysqli_fetch_assoc($getAkunInfoRrlt);
    if(empty($akunInfo['foto_akun'])){
        $akunInfo['foto_akun'] = "null-profile.png";
    }
    $jumlahRevSql = "SELECT IFNULL(COUNT(*), 0) AS 'Total_Review' FROM makanan LEFT JOIN akun ON makanan.id_akun = akun.id_akun WHERE email_akun = '$userEmail' AND status_review = 'Disetujui'";
    $jumlahRevRslt = mysqli_query($conn, $jumlahRevSql);
    $jumlahRev = mysqli_fetch_assoc($jumlahRevRslt);

    $jumlahTggSql = "SELECT IFNULL(COUNT(*), 0) AS 'Total_Tunggu' FROM makanan LEFT JOIN akun ON makanan.id_akun = akun.id_akun WHERE email_akun = '$userEmail' AND status_review = 'Menunggu Verifikasi'";
    $jumlahTggRslt = mysqli_query($conn, $jumlahTggSql);
    $jumlahTgg = mysqli_fetch_assoc($jumlahTggRslt);

    $jumlahTangguhSql = "SELECT IFNULL(COUNT(*), 0) AS 'Total_Tangguh' FROM makanan LEFT JOIN akun ON makanan.id_akun = akun.id_akun WHERE email_akun = '$userEmail' AND status_review = 'Ditangguhkan'";
    $jumlahTangguhRslt = mysqli_query($conn, $jumlahTangguhSql);
    $jumlahTangguh = mysqli_fetch_assoc($jumlahTangguhRslt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Styles/color.css">
    <link rel="stylesheet" href="../Styles/userprofile-style.css">
</head>
<body>
    <h2>PROFIL</h2>
    <div class="profil">
        <div class="detail">
            <div class="image">
                <img src="../ProfilePicture/<?php echo $akunInfo['foto_akun']?>" alt="foto akun">
            </div>
            <div>
                <p class="usn"><?php echo $akunInfo['username_akun'] ?></p>
                <p><?php echo $akunInfo['email_akun'] ?></p>
                <a href="editProfile.php">
                <img src="../Assets/icon/pencil-square.svg" alt="icon" class="icon">
                Edit
                </a>
                <div class="logoutbtn">
                    <a href="../Auth/logout.php"><button>Keluar</button></a>
                </div>
            </div>
        </div>        
                
                
        <div class="btn">
            <a href="buatReview.php" class="primary">
                <button>Buat Review</button>
            </a>
                
            <a href="reviewUser.php?status=upload" class="secondary">
                <button>Review   <?php echo $jumlahRev['Total_Review'] ?></button>
            </a>
        
            <a href="reviewUser.php?status=tunggu" class="secondary">
                <button>Menunggu Verifikasi   <?php echo $jumlahTgg['Total_Tunggu'] ?></button>
            </a>
        
            <a href="reviewUser.php?status=tangguh" class="secondary">
                <button>Ditangguhkan   <?php echo $jumlahTangguh['Total_Tangguh'] ?></button>
            </a>
        </div>
    </div>

    <?php require '../Template/footer.php' ?>
</body>
</html>