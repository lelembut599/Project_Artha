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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php if (!empty($review)): ?>
        <!-- diambil dari post.php -->
        <?php tampilkanPost($review)?> 
    <?php else: ?>
        <?php include '../Template/empty.php';  ?>
    <?php endif; ?>

    <?php include '../Template/footer.php'; ?>
    
</body>
</html>