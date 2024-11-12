<?php 
    require '../Koneksi/koneksi.php';

    session_start();
    if(!isset($_SESSION['role'])){
        echo 
            "<script>
            alert('Tidak bisa mengakses halaman ini!');
            document.location.href = '../Auth/login.php';
            </script>";
            exit;
    }

    if($_SESSION['role'] !== 'admin'){
        echo 
            "<script>
            alert('Tidak bisa mengakses halaman ini!');
            document.location.href = '../User/homeUser.php';
            </script>";
            exit;
    }

    if(!isset($_GET['id_makanan'])){
        echo 
            "<script>
            alert('Pilih makanan dahulu!');
            document.location.href = 'verifikasiReview.php';
            </script>";
            exit;
    }

    $idMakanan = $_GET['id_makanan'];

    $setujuiSql = "UPDATE makanan SET status_review = 'Disetujui' WHERE id_makanan = '$idMakanan'";
    $setujuiRslt = mysqli_query($conn, $setujuiSql);
    if ($setujuiRslt) {
        echo 
        "<script>
            alert('Perubahan berhasil!');
            document.location.href = 'verifikasiReview.php';
        </script>";
        exit;
    }else{
        echo 
        "<script>
            alert('Perubahan gagal!');
            document.location.href = 'verifikasiReview.php';
        </script>";
        exit;

    }
?>