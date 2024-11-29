<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/post.php';
    require '../Template/function.php';

    checkAccess();

    $getRevSql = "SELECT * FROM makanan WHERE status_review = 'Disetujui' ORDER BY tanggal_upload DESC";
    $getRevRslt = mysqli_query($conn, $getRevSql);
    $review = [];
    
    while ($row = mysqli_fetch_assoc($getRevRslt)) {
        $review[]  = $row;
    }
    
    if(isset($_GET['cari'])){
        $cari = htmlspecialchars($_GET['cari']);
        $getRevSql = "SELECT * FROM makanan WHERE status_review = 'Disetujui' AND (judul_makanan LIKE '%$cari%' OR alamat LIKE '%$cari%' OR restoran LIKE '%$cari%')";
        $getRevRslt = mysqli_query($conn, $getRevSql);
        $review = [];
        
        while ($row = mysqli_fetch_assoc($getRevRslt)) {
            $review[]  = $row;
        }


    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artha || Cari Review</title>
</head>
<body>
    <form action="" method="GET" class="search-form">
    <div class="input-container">
        <img src="../Assets/icon/search.svg" alt="Search" class="search-icon">
        <input type="text" name="cari" id="cari" placeholder="Cari di sini">
    </div>
    </form>

    <?php if (!empty($review)): ?>
        <?php tampilkanPost($review)?>
    <?php else: ?>
        <?php include '../Template/empty.php';  ?>
        
    <?php endif; ?>

    <?php include '../Template/footer.php';  ?>
    
</body>
</html>