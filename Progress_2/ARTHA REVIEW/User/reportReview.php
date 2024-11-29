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
        echo 
            "<script>
            alert('Report berhasil!');
            document.location.href = 'homeUser.php';
            </script>";
            exit;
        }else{
        echo 
            "<script>
            alert('Report gagal!');
            document.location.href = 'homeUser.php';
            </script>";
            exit;

    }
?>