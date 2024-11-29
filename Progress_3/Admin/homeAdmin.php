<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    include '../Template/navbar.php'; 
    require '../Template/function.php';

    checkRoleAdmin();

    $verifikasiSql = "SELECT IFNULL(COUNT(*), 0) AS total_verifikasi FROM makanan WHERE status_review = 'Menunggu Verifikasi'";
    $verifikasiRslt = mysqli_query($conn, $verifikasiSql);
    $verifikasi = mysqli_fetch_assoc($verifikasiRslt);
    
    $reportSql = "SELECT IFNULL(COUNT(*), 0) AS total_report FROM makanan WHERE status_report = 'Laporkan'";
    $reportRslt = mysqli_query($conn, $reportSql);
    $report = mysqli_fetch_assoc($reportRslt);

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Styles/homeadmin-style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
        <title>Artha || Dashboard Admin</title>
    </head>
    <style src="../Styles/homeadmin-style.css"></style>
    <body>   
        <div class="container">
            <main>
                <div class="welcome">
                    <h2>Welcome, <span>Admin :)</span></h2>
                    <a href="verifikasiReview.php">
                        <button class="button">
                            Permintaan <br>Konfirmasi
                            <!-- <span class="line"></span> -->
                            <span class="count"><?php echo $verifikasi['total_verifikasi'] ?></span>
                        </button>
                    </a>
                    <a href="reportReview.php">
                        <button class="button report">
                            Daftar <br> Report
                            <!-- <span class="line"></span> -->
                            <span class="count"><?php echo $report['total_report'] ?></span>
                        </button>
                    </a>
                    <a class="exit" href="../Auth/logout.php">
                            <i class="bi bi-x-lg"></i>
                            <!-- <span class="line"></span> -->
                            Keluar
                    </a>
                </div>
                <div class="illustration">
                    <img src="../Assets/admin-removebg-preview.png" alt="Dashboard Image">
                </div>
            </main>
        </div>
        <footer>
            <?php 
            include '../Template/footer.php'; 
            ?>
    </footer>
</body>
</html>
