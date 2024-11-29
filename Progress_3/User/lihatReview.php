<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/function.php';

    checkAccess();

    checkIdMakanan();

    $email = $_SESSION['name'];
    $idMakanan = $_GET['id_makanan'];

    $getIdAkunSql = "SELECT id_akun FROM akun WHERE email_akun = '$email'";
    $getIdAkunRslt = mysqli_query($conn, $getIdAkunSql);
    $getIdAkun = mysqli_fetch_assoc($getIdAkunRslt);
    $idAkun = $getIdAkun['id_akun'];



    $getReviewSql = "SELECT makanan.*, akun.* FROM makanan LEFT JOIN akun ON makanan.id_akun = akun.id_akun WHERE id_makanan = '$idMakanan'";
    $getReviewRslt = mysqli_query($conn, $getReviewSql);
    $review = mysqli_fetch_assoc($getReviewRslt);

    if($review['foto_akun'] === NULL){
        $review['foto_akun'] = "null-profile.png";
    }

    if(isset($_POST['kirim'])){
        $isiKomentar = htmlspecialchars($_POST['komentar']);

        $upKomenSql = "INSERT INTO komentar (isi_komentar, id_makanan, id_akun) VALUES ('$isiKomentar', '$idMakanan', '$idAkun')";
        $upKomenRslt = mysqli_query($conn, $upKomenSql);
        if(!$upKomenRslt){
            $link = "lihatReview.php?id_makanan=$idMakanan";
            $massage = 'Gagal mengunggah komentar!';
            badAllert($massage, $link);
        }
    }

    $getKomentarSql = "SELECT komentar.*, akun.* from komentar left join akun on komentar.id_akun = akun.id_akun where id_makanan = '$idMakanan'";
    $getKomentarRslt = mysqli_query($conn, $getKomentarSql);
    $komentar = [];
    while($row = mysqli_fetch_assoc($getKomentarRslt)){
        if($row['foto_akun']=== NULL){
            $row['foto_akun'] = "null-profile.png";
        }
        $komentar[] = $row;
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
    <div class="container-content">
        <div class="container-makanan">
            <img class="gambar"src="../MakananUploads/<?php echo $review['foto_makanan']?>" alt="Foto makanan">
        </div>
        <div class="container-review">
        <div class="profile-info">
            <img src="../ProfilePicture/<?php echo $review['foto_akun']?>" alt="Foto akun">
                <div class="profile-text">
                    <p><?php echo $review['username_akun'] ?></p>
                    <p><?php echo $review['tanggal_upload'] ?></p>
                    <!-- <p><?php echo $review['status_review'] ?></p> -->
                </div>
            </div>
            <p><strong>Judul    : </strong><?php echo $review['judul_makanan'] ?></p>
            <p><strong>Restoran : </strong><?php echo $review['restoran'] ?></p>
            <p><strong>Alamat   : </strong><?php echo $review['alamat'] ?></p>
            <p><strong>Deskripsi: </strong><?php echo $review['deskripsi_makanan'] ?></p>
            <p class= "rating" ><img src="../Assets/icon/star.svg" alt="icon"> <?php echo $review['rating_makanan'] ?>/5.0</p>
            <a href="reportReview.php?id_makanan=<?php echo $review['id_makanan']?>"><button>Report</button></a>
        </div>
    </div>

    <div class="container-koment">
    <p class="judul">Komentar</p>

    <?php if (!empty($komentar)) : ?>
        <?php foreach ($komentar as $km) : ?>
            <div class="comment-item">
                <div class="comment-avatar">
                    <img src="../ProfilePicture/<?php echo $km['foto_akun'] ?>" alt="Foto Akun">
                </div>
                <div class="comment-content">
                    <p class="comment-username"><?php echo $km['username_akun'] ?></p>
                    <p class="comment-text"><?php echo $km['isi_komentar'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="no-comment">Belum ada komentar</p>
    <?php endif; ?>

    <form action="" method="POST" class="comment-form">
        <input type="text" name="komentar" id="komentar" maxlength="350" placeholder="Komentar disini .........." required>
        <button type="submit" name="kirim">
            <img src="../Assets/icon/send.svg" alt="Kirim">
        </button>
    </form>
</div>
    <?php include '../Template/footer.php' ?>
</body>
</html>