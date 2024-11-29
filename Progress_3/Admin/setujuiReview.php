<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/function.php';

    checkRoleAdmin();

    checkIdMakananAdmin();

    $idMakanan = $_GET['id_makanan'];

    $setujuiSql = "UPDATE makanan SET status_review = 'Disetujui' WHERE id_makanan = '$idMakanan'";
    $setujuiRslt = mysqli_query($conn, $setujuiSql);
    if ($setujuiRslt) {
        $massage = 'Perubahan berhasil!';
        $link = 'verifikasiReview.php';
        goodAllert($massage, $link);
        exit;
    }else{
        $massage = 'Perubahan gagal!';
        $link = 'verifikasiReview.php';
        badAllert($massage, $link);
        exit;

    }
?>