<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/function.php';


    checkRoleAdmin();

    checkIdMakananAdmin();

    $idMakanan = $_GET['id_makanan'];

    $setujuiSql = "UPDATE makanan SET status_report = NULL WHERE id_makanan = '$idMakanan'";
    $setujuiRslt = mysqli_query($conn, $setujuiSql);
    if ($setujuiRslt) {
        echo 
        "<script>
            alert('Perubahan berhasil!');
            document.location.href = 'reportReview.php';
        </script>";
        exit;
    }else{
        echo 
        "<script>
            alert('Perubahan gagal!');
            document.location.href = 'reportReview.php';
        </script>";
        exit;

    }
?>