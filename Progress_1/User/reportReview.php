<?php 
    require '../Koneksi/koneksi.php';

    session_start();

    if (!isset($_SESSION['name']) || $_SESSION['role']=='admin'){
        if($_SESSION['role'] == 'admin'){
            echo 
            "<script>
            alert('Tidak bisa mengakses halaman ini!');
            document.location.href = '../Admin/homeAdmin.php';
            </script>";
            exit;
        }else{
            echo 
            "<script>
            alert('Tidak bisa mengakses halaman ini!');
            document.location.href = '../Auth/login.php';
            </script>";
            exit;
        }
    }

    if(!isset($_GET['id_makanan'])){
        echo 
            "<script>
            alert('Pilih postingan dahulu!');
            document.location.href = 'homeUser.php';
            </script>";
            exit;
    }

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