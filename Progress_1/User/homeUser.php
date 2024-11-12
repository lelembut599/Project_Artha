<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';

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

    $getRevSql = "SELECT * FROM makanan WHERE status_review = 'Disetujui'";
    $getRevRslt = mysqli_query($conn, $getRevSql);
    $review = [];

    while ($row = mysqli_fetch_assoc($getRevRslt)) {
        $review[]  = $row;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="buatReview.php">
        <button>
            Unggah
        </button>
    </a>
    <a href="../Auth/logout.php">
        <button>
            Keluar
        </button>
    </a>

    <br>

    <?php if (!empty($review)): ?>
        <?php foreach ($review as $rv): ?>
            <img src="../MakananUploads/<?php echo $rv['foto_makanan']?>" width=100 alt="foto makanan">
            <a href="reportReview.php?id_makanan=<?php echo $rv['id_makanan']?>">
                <button>Report</button>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada postingan</p>
    <?php endif; ?>
    
</body>
</html>