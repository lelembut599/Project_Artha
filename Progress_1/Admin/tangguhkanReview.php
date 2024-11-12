<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
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

    $reportStatusSql = "SELECT * FROM makanan WHERE id_makanan = '$idMakanan'";
    $reportStatusRslt = mysqli_query($conn, $reportStatusSql);
    $reportStatus = mysqli_fetch_assoc($reportStatusRslt);

    
    $setujuiSql = "UPDATE makanan SET status_review = 'Ditangguhkan' WHERE id_makanan = '$idMakanan'";
    $setujuiRslt = mysqli_query($conn, $setujuiSql);
    if ($setujuiRslt) {
        if($reportStatus['status_report'] === NULL){
            echo 
            "<script>
            alert('Perubahan berhasil!');
            document.location.href = 'verifikasiReview.php';
            </script>";
            exit;
        }
        $setujuiSql = "UPDATE makanan SET status_report = NULL WHERE id_makanan = '$idMakanan'";
        $setujuiRslt = mysqli_query($conn, $setujuiSql);
        echo 
        "<script>
        alert('Perubahan berhasil!');
        document.location.href = 'reportReview.php';
        </script>";
        exit;
        
    }else{
        if($reportStatus['status_report'] === NULL){
            echo 
            "<script>
                alert('Perubahan gagal!');
                document.location.href = 'verifikasiReview.php';
            </script>";
            exit;
        }
        echo 
        "<script>
            alert('Perubahan gagal!');
            document.location.href = 'reportReview.php';
        </script>";
        exit;
    }
?>