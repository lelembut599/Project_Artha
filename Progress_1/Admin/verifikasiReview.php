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

    
    $limit = 4; 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    $offset = ($page - 1) * $limit; 


    $whereClause = "WHERE makanan.status_review = 'Menunggu Verifikasi'";
    if(isset($_GET['cari'])){
        $cari = htmlspecialchars($_GET['cari']);
        $whereClause .= " AND makanan.judul_makanan LIKE '%$cari%'";
    }

    $getPostVer = "SELECT makanan.*, akun.* FROM makanan 
                   LEFT JOIN akun ON makanan.id_akun = akun.id_akun 
                   $whereClause
                   LIMIT $limit OFFSET $offset";
    $getPostRslt = mysqli_query($conn, $getPostVer);

    $postVerifikasi = [];
    while ($row = mysqli_fetch_assoc($getPostRslt)) {
        $postVerifikasi[] = $row;
    }


    $countQuery = "SELECT COUNT(*) AS total FROM makanan $whereClause";
    $countResult = mysqli_query($conn, $countQuery);
    $totalData = mysqli_fetch_assoc($countResult)['total'];
    $totalPages = ceil($totalData / $limit); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/color.css">
    <link rel="stylesheet" href="../Styles/reviewAdmin-style.css">
    <title>Artha || Verifikasi Postingan</title>

</head>
<body>
    <?php if(!empty($postVerifikasi)): ?>
    <div class="container">
        <h2>VERIFIKASI REVIEW</h2>
        <div class="table-header">
            <form action="" method="GET" class="search-container">
                <input type="text" name="cari" id="cari" placeholder="Cari" value="<?php echo isset($cari) ? $cari : ''; ?>" required>
                <button type="submit">Cari</button>
            </form>
        </div>
        <div class="table-wrapper">
            <table class="report-table">
                <thead>
                    <tr>
                    <td>Username</td>
                    <td>Foto</td>
                    <td>Judul</td>
                    <td>Lihat</td>
                    <td>Verifikasi</td>
                    <td>Tangguhkan</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($postVerifikasi as $post): ?>
                    <tr>
                        <td><?php echo $post['username_akun'] ?></td>
                        <td><img src="../MakananUploads/<?php echo $post['foto_makanan']?>" width="100" alt="foto makanan"></td>
                        <td><?php echo $post['judul_makanan'] ?></td>
                        <td><a href="lihatReview.php?id_makanan=<?php echo $post['id_makanan']?>"><button><img src="../Assets/icon/eye.svg" alt="icon"></button></a></td>
                        <td><a href="setujuiReview.php?id_makanan=<?php echo $post['id_makanan']?>"><button><img src="../Assets/icon/check.svg" alt="icon"></button></a></td>
                        <td><a href="tangguhkanReview.php?id_makanan=<?php echo $post['id_makanan']?>"><button><img src="../Assets/icon/ban.svg" alt="icon"></button></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<div class="pagination">
    <?php if($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>&cari=<?php echo isset($cari) ? $cari : ''; ?>">&laquo; </a>
        <?php else: ?>
            <a class="disabled">&laquo;</a>
            <?php endif; ?>
            
            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&cari=<?php echo isset($cari) ? $cari : ''; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                
                <?php if($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>&cari=<?php echo isset($cari) ? $cari : ''; ?>">&raquo;</a>
                    <?php else: ?>
                        <a class="disabled">&raquo;</a>
                        <?php endif; ?>
                    </div>
                    
            <?php else: ?>
                <p class="empty-message">Belum ada postingan</p>
            <?php endif; ?>
                    
</body>
</html>
<?php     require '../Template/footer.php' ?>