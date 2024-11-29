<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/function.php';

    checkAccess();
    
    checkIdMakanan();
    
    $getId = $_GET['id_makanan'];
    $infoMakananSql = "SELECT * FROM makanan WHERE id_makanan = '$getId'";
    $infoMakananRslt = mysqli_query($conn, $infoMakananSql);
    $infoMakanan = mysqli_fetch_assoc($infoMakananRslt);
    $gambarLama = $infoMakanan['foto_makanan'];

    if(isset($_POST['edit'])){
        $judul = htmlspecialchars($_POST['judul']);
        $desc = htmlspecialchars($_POST['desc']);
        $resto = htmlspecialchars($_POST['resto']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $statusReview = "Menunggu Verifikasi";
        $rate = $_POST['rate'];
        $tanggal = date('Y-m-d');
        if($_FILES['foto']['error']== UPLOAD_ERR_NO_FILE){
            $gambarFinal = $gambarLama;
        }else{
            $gambar = $_FILES['foto']['name'];
            $gambarTmp = $_FILES['foto']['tmp_name'];

            $fileEkstensi = pathinfo($gambar, PATHINFO_EXTENSION);
            $gambarFinal = date('YmdHis').'.'.$fileEkstensi;

            $pathGambarLama = "../MakananUploads/". $gambarLama;
            $pathGambarBaru = "../MakananUploads/". $gambarFinal;

            if(file_exists($pathGambarLama)){
                unlink($pathGambarLama);
            }

            $ekstensiList = ['jpg', 'jpeg', 'png'];
            if(in_array(strtolower($fileEkstensi), $ekstensiList)){
                move_uploaded_file($gambarTmp, $pathGambarBaru);
            }else{
                echo "<script>
                alert('Ekstensi file tidak diperbolehkan!');
                document.location.href = 'editReview.php?id_makanan=$getId';
                </script>";
                return;
            }
        }
        $updateMakananSql = "UPDATE makanan SET judul_makanan = '$judul', deskripsi_makanan = '$desc', foto_makanan = '$gambarFinal', restoran = '$resto', alamat = '$alamat', rating_makanan = '$rate', tanggal_upload = '$tanggal', status_review = '$statusReview' WHERE id_makanan = '$getId'";
        if (mysqli_query($conn, $updateMakananSql)) {
            header ("location: checkReview.php?id_makanan=$getId");
            exit;
        }else{
            echo 
            "<script>
            alert('Upload gagal!');
            document.location.href = 'editReview.php?id_makanan=$getId';
            </script>";
            exit;
        }
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Styles/color.css">
    <link rel="stylesheet" href="../Styles/buatreview-style.css">
</head>
<body>
    <h2>EDIT REVIEW</h2>
    <div class="container">
        <div class="form-card">
            <div class="image-preview">
                <img id="preview" src="../MakananUploads/<?php echo $infoMakanan['foto_makanan']?>" alt="Pratinjau gambar">
            </div>
    
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Title</label>
                <input type="text" name="judul" id="judul" maxlength="55" placeholder="Title" value="<?php echo $infoMakanan['judul_makanan']?>" required>
            </div>
            
            <div class="form-group">
                <label for="desc">Description</label>
                <input type="text" name="desc" id="desc" maxlength="400" placeholder="Description" value="<?php echo $infoMakanan['deskripsi_makanan']?>" required>
            </div>
    
            <div class="form-group">
                <label for="resto">Restoran</label>
                <input type="text" name="resto" id="resto" maxlength="55" placeholder="Restoran" value="<?php echo $infoMakanan['restoran']?>" required>
            </div>
    
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" maxlength="55" placeholder="Alamat" value="<?php echo $infoMakanan['alamat']?>" required>
            </div>
    
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="number" name="rate" id="rate" min="0" max="5.0" step="0.1" oninput="validity.valid||(value='');" value="<?php echo $infoMakanan['rating_makanan']?>" required>
            </div>
    
            <div class="form-group">
                <label for="foto">Image</label>
                <input type="file" name="foto" id="foto" onchange="previewImage(event)">
            </div>
    
            <input type="submit" value="Edit" name="edit">
            </form>
            </div>
        </div>
    </div>
    
    <script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
    </script>

    <?php include '../Template/footer.php';  ?>
</body>
</html>