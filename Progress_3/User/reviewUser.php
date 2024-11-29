<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/post.php';
    require '../Template/function.php';

    checkAccess();

    $userEmail = $_SESSION['name'];

    if(!isset($_GET['status'])){
        $_GET['status'] = 'upload';
    }

    if ($_GET['status'] === 'upload') {
        $status = 'Disetujui';
    }elseif ($_GET['status'] === 'tunggu') {
        $status = 'Menunggu Verifikasi';
    }elseif ($_GET['status'] === 'tangguh') {
        $status = 'Ditangguhkan';
    }else{
        $status = 'Disetujui';
    }

    $getRevSql = "SELECT * FROM makanan LEFT JOIN akun ON makanan.id_akun = akun.id_akun WHERE email_akun = '$userEmail' AND status_review = '$status' ORDER BY tanggal_upload DESC";
    $getRevRslt = mysqli_query($conn, $getRevSql);
    $review = [];

    while ($row = mysqli_fetch_assoc($getRevRslt)) {
        $review[]  = $row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/lihatreview-user.css">
    <link rel="stylesheet" href="../Styles/color.css">
</head>
<body>
    <a href="userProfile.php"><button>
        Kembali
    </button></a>
    <?php if (!empty($review)): ?>
        <?php tampilkanPost($review)?>
    <?php else: ?>
        <?php include '../Template/empty.php';  ?>
    <?php endif; ?>

    <?php 
            include '../Template/footer.php'; 
            ?>
    
</body>
</html>