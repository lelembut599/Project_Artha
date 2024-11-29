<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/function.php';

    checkAccess();

    checkIdMakanan();
    
    $idReview = $_GET['id_makanan'];

    $reportSql = "UPDATE makanan SET status_report = 'Laporkan' WHERE id_makanan = '$idReview'";
    $reportRslt = mysqli_query($conn, $reportSql);

    if($reportRslt){
        $massage = 'Report berhasil!';
        $link = "lihatReview.php?id_makanan=$idReview";
        goodAllert($massage, $link);
        exit;
    }else{
        $massage = 'Report gagal!';
        $link = "lihatReview.php?id_makanan=$idReview";
        badAllert($massage, $link);
        exit;

    }
?>