<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/function.php';

    checkRoleAdmin();

    checkIdMakananAdmin();

    $idMakanan = $_GET['id_makanan'];

    $reportStatusSql = "SELECT * FROM makanan WHERE id_makanan = '$idMakanan'";
    $reportStatusRslt = mysqli_query($conn, $reportStatusSql);
    $reportStatus = mysqli_fetch_assoc($reportStatusRslt);

    
    $setujuiSql = "UPDATE makanan SET status_review = 'Ditangguhkan' WHERE id_makanan = '$idMakanan'";
    $setujuiRslt = mysqli_query($conn, $setujuiSql);
    if ($setujuiRslt) {
        if($reportStatus['status_report'] === NULL){
            $massage = 'Perubahan berhasil!';
            $link = 'verifikasiReview.php';
            goodAllert($massage, $link);
            exit;
        }
        $setujuiSql = "UPDATE makanan SET status_report = NULL WHERE id_makanan = '$idMakanan'";
        $setujuiRslt = mysqli_query($conn, $setujuiSql);
        $massage = 'Perubahan berhasil!';
        $link = 'reportReview.php';
        goodAllert($massage, $link);
        exit;
        
    }else{
        if($reportStatus['status_report'] === NULL){
            $massage = 'Perubahan gagal!';
            $link = 'verifikasiReview.php';
            badAllert($massage, $link);
            exit;
        }
        $massage = 'Perubahan gagal!';
        $link = 'reportReview.php';
        badAllert($massage, $link);
        exit;
    }
?>