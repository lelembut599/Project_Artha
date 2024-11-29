<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/function.php';

    checkAccess();
    checkIdMakanan();

    
    $idMakanan = $_GET['id_makanan'];

    $deleteKomenSql = "DELETE FROM komentar WHERE id_makanan = '$idMakanan'";
    $deleteKomen = mysqli_query($conn, $deleteKomenSql);

    $getMakananSql = "SELECT * FROM makanan WHERE id_makanan = '$idMakanan'";
    $getMakananRslt = mysqli_query($conn, $getFotoMakananSql);
    $makanan = mysqli_fetch_assoc($getMakananRslt);
    $foto = $makanan['foto_makanan'];
    
    if ($makanan['status_review'] === "Menunggu Verifikasi"){
        $link = "reviewUser.php?status=tunggu";
    }else{
        $link = "reviewUser.php?status=tangguh";
    }

    $pathFoto = '../User/MakananUploads/'. $foto;

    if(file_exists($pathFoto)){
        unlink($pathFoto);
    }

    $deleteMakananSql = "DELETE FROM makanan WHERE id_makanan = '$idMakanan'";
    $deleteMakanan = mysqli_query($conn, $deleteMakananSql);

    if($deleteMakanan){
        echo "<script>
        alert('Berhasil menghapus review!');
        document.location.href = $link;
        </script>";
        exit;
    }else{
        echo "<script>
        alert('Berhasil menghapus review!');
        document.location.href = $link;
        </script>";
        exit;

    }
?>