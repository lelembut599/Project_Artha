<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/function.php';

    checkAccess();

    checkIdMakanan();
    $idMakanan = $_GET['id_makanan'];


    $getReviewSql = "SELECT makanan.*, akun.* FROM makanan LEFT JOIN akun ON makanan.id_akun = akun.id_akun WHERE id_makanan = '$idMakanan'";
    $getReviewRslt = mysqli_query($conn, $getReviewSql);
    $review = mysqli_fetch_assoc($getReviewRslt);

    if($review['foto_akun'] === NULL){
        $review['foto_akun'] = "null-profile.png";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Styles/color.css">
    <link rel="stylesheet" href="../Styles/checkreview-style.css">
</head>
<body>
    <div class="card">
        <div class="image">
            <img src="../MakananUploads/<?php echo $review['foto_makanan']?>" alt="Foto makanan">
        </div>
        <div class="detail">
            <div class="profile">
                <img src="../ProfilePicture/<?php echo $review['foto_akun']?>" alt="Foto akun">
                <div class="username">
                    <p><strong><?php echo $review['username_akun'] ?></strong></p>
                    <p><?php echo $review['tanggal_upload'] ?></p>
                </div>
                <div class="status">
                    <p><?php echo $review['status_review'] ?></p>                    
                </div>
            </div>
            <div class="desc">
                <p><strong>Judul: </strong><?php echo $review['judul_makanan'] ?></p>
                <p><strong>Restoran: </strong><?php echo $review['restoran'] ?></p>
                <p><strong>Alamat: </strong><?php echo $review['alamat'] ?></p>
                <p><strong>Deskripsi: </strong><?php echo $review['deskripsi_makanan'] ?></p>
                <p><img src="../Assets/icon/star.svg" alt="icon" class="icon"> <?php echo $review['rating_makanan'] ?>/5.0</p>

                <div class="btn">
                    <a href="editReview.php?id_makanan=<?php echo $review['id_makanan']?>"><img src="../Assets/icon/pencil-square.svg" alt="icon" class="icon"></a>
                    <a href="hapusReview.php?id_makanan=<?php echo $review['id_makanan']?>"><img src="../Assets/icon/trash.svg" alt="icon" class="icon"></a>
                </div>
            </div>
        </div>
    </div>
    <?php require '../Template/footer.php' ?>
</body>
</html>