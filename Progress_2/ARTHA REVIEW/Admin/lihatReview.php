<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/function.php';

    checkRoleAdmin();

    if(!isset($_GET['id_makanan'])){
        echo 
            "<script>
            alert('Pilih makanan dahulu!');
            document.location.href = 'verifikasiReview.php';
            </script>";
            exit;
    }

    $idMakanan = $_GET['id_makanan'];

    $getRevSql = "SELECT makanan.*, akun.* FROM makanan LEFT JOIN akun ON makanan.id_akun = akun.id_akun WHERE id_makanan = '$idMakanan'";
    $getRevRslt = mysqli_query($conn, $getRevSql);
    $review = mysqli_fetch_assoc($getRevRslt); 
    if(empty($review['foto_akun'])){
        $review['foto_akun'] = "null-profile.png";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Styles/color.css">
    <link rel="stylesheet" href="../Styles/lihatReview-style.css">
    <!-- <link rel="stylesheet" href="../Styles/footer-style.css"> -->
    <title>Artha || Lihat Review</title>
</head>
<body>
    <section>
        <div class="card">
            <div class="card-content">
                <img src="../MakananUploads/<?php echo $review['foto_makanan']?>" width=350 height=350 alt="foto makanan">
    
                <div class="card-desc">
                    <div class="profile">
                        <img src="../ProfilePicture/<?php echo $review['foto_akun']?>" width=40 height=40 alt="Foto profil">
                        <div>
                            <p><?php echo $review['username_akun'] ?></p>
                            <p class="tanggal"><?php echo $review['tanggal_upload'] ?></p>
                        </div>
                    </div>
                    <div class="desc">
                        <p><strong>Judul: </strong><?php echo $review['judul_makanan']?></p>
                        <p><strong>Restoran: </strong><?php echo $review['restoran'] ?></p>
                        <p><strong>Alamat: </strong><?php echo $review['alamat']?></p>
                        <p><strong>Deskripsi: </strong><?php echo $review['deskripsi_makanan'] ?></p>
                        <div class="rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
</svg>
<p><?php echo $review['rating_makanan'] ?>/5.0</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="button">
                <?php if ($review['status_review'] === "Menunggu Verifikasi"): ?>
                    <a href="setujuiReview.php?id_makanan=<?php echo $review['id_makanan']?>">
                        <button class="primary">Setujui</button>
                    </a>
                    <?php else: ?>
                        <a href="hapusReport.php?id_makanan=<?php echo $review['id_makanan']?>">
                            <button class="primary">Hapus Dari Report</button>
                        </a>
                <?php endif; ?>
            
                <a href="tangguhkanReview.php?id_makanan=<?php echo $review['id_makanan']?>">
                    <button class="second">Tangguhkan</button>
                </a>

            </div>
        </div>
    </section>
    
    <?php require '../Template/footer.php' ?>
</body>
</html>
