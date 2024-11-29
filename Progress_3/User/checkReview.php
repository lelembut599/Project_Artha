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
    if ($review['status_review'] === "Menunggu Verifikasi"){
        $link = "reviewUser.php?status=tunggu";
    }else{
        $link = "reviewUser.php?status=tangguh";
    }

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
            <a href="<?php echo $link?>" class="back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                <p>Kembali</p>
            </a>
    <div class="card">
        <div class="image">
            <img src="../MakananUploads/<?php echo $review['foto_makanan']?>" alt="Foto makanan">
        </div>
        <div class="detail">
            <div class="profile">
                <div class="profile-info">
                    <img src="../ProfilePicture/<?php echo $review['foto_akun']?>" alt="Foto akun">
                    <div class="username">
                        <p><strong><?php echo $review['username_akun'] ?></strong></p>
                        <p><?php echo $review['tanggal_upload'] ?></p>
                    </div>
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
                    <a href="editReview.php?id_makanan=<?php echo $review['id_makanan']?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                        <p>Ubah</p>
                    </a>
                    <a href="hapusReview.php?id_makanan=<?php echo $review['id_makanan']?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        <p>Hapus</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php require '../Template/footer.php' ?>
</body>
</html>