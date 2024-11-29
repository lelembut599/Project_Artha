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
            <div class= "user-detail">
                <p class="usn"><?php echo $akunInfo['username_akun'] ?></p>
                <p class="email"><?php echo $akunInfo['email_akun'] ?></p>
                <a href="editProfile.php" class="edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    <p>Ubah</p>
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
                <button>  
                    <p>Review</p>
                    <p><?php echo $jumlahRev['Total_Review'] ?></p>
                </button>
            </a>
        
            <a href="reviewUser.php?status=tunggu" class="secondary">
                <button>
                    <p>Menunggu Verifikasi</p>
                    <p><?php echo $jumlahTgg['Total_Tunggu'] ?></p>
                    
                </button>
            </a>
        
            <a href="reviewUser.php?status=tangguh" class="secondary">
                <button>
                    <p>Ditangguhkan</p>
                    <p><?php echo $jumlahTangguh['Total_Tangguh'] ?></p>    
                </button>
            </a>
        </div>
    </div>

    <?php require '../Template/footer.php' ?>
</body>
</html>