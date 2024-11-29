<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/function.php';

    checkAccess();

    $email = $_SESSION['name'];
    $getId = "SELECT id_akun FROM akun WHERE email_akun = '$email'";
    $getIdRslt = mysqli_query($conn, $getId);
    $akun = mysqli_fetch_assoc($getIdRslt);
    $idAkun = $akun['id_akun'];

    if(isset($_POST['unggah'])){
        $judul = htmlspecialchars($_POST['judul']);
        $desc = htmlspecialchars($_POST['desc']);
        $resto = htmlspecialchars($_POST['resto']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $statusReview = "Menunggu Verifikasi";
        $rate = $_POST['rate'];
        $tanggal = date('Y-m-d');
        $gambar = $_FILES['foto']['name'];
        $gambarTemp = $_FILES['foto']['tmp_name'];

        $fileEkstensi = pathinfo($gambar, PATHINFO_EXTENSION);
        $gambarFinal = date('YmdHis').'.'.$fileEkstensi;

        $dir =  "../MakananUploads/";
        $uploadDir = $dir . $gambarFinal;

        $ekstensiList = ['jpg', 'jpeg', 'png'];

        if(in_array(strtolower($fileEkstensi), $ekstensiList)){
            if(move_uploaded_file($gambarTemp, $uploadDir)){
                $uploadSql = "INSERT INTO makanan(judul_makanan, deskripsi_makanan, foto_makanan, restoran, alamat, rating_makanan, tanggal_upload, status_review, id_akun) VALUES ('$judul', '$desc', '$gambarFinal', '$resto', '$alamat', '$rate', '$tanggal', '$statusReview', '$idAkun')";
                if(mysqli_query($conn, $uploadSql)){
                    $massage = 'Upload berhasil!';
                    $link = 'homeUser.php';
                    goodAllert($massage, $link);
                }else{
                    $massage = 'Upload gagal!';
                    $link = 'buatReview.php';
                    badAllert($massage, $link);
                }
            }else{
                $massage = 'Gagal mengupload gambar!';
                $link = 'buatReview.php';
                badAllert($massage, $link);                
            }
        }else{
            $massage = 'File harus berupa gambar!';
            $link = 'buatReview.php';
            badAllert($massage, $link);
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
    <style>
        #preview {
            display: none;
        }
    </style>
</head>
<body>
    <h2>UPLOAD REVIEW</h2>

    <div class="container">
        <div class="form-card">
            <div class="image-preview">
                <img id="preview" alt="Pratinjau gambar">
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" maxlength="55" placeholder="Masukkan nama makanan" required>
                </div>

                <div class="form-group">
                    <label for="desc">Deskripsi</label>
                    <input type="text" name="desc" id="desc" maxlength="400" placeholder="Masukkan deskripsi makanan" required>
                </div>

                <div class="form-group">
                    <label for="resto">Restoran</label>
                    <input type="text" name="resto" id="resto" maxlength="55" placeholder="Masukkan nama restoran" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" maxlength="55" placeholder="Masukkan alamat restoran" required>
                </div>

                <div class="form-group">
                    <label for="rate">Rating</label>
                    <input type="number" name="rate" id="rate" min="0" max="5.0" step="0.1" placeholder="Berikan rating makanan" oninput="validity.valid||(value='');" required>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" onchange="previewImage(event)" required>
                </div>

                <input type="submit" value="Unggah" name="unggah">
            </form>
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
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
    </script>

    <?php include '../Template/footer.php';  ?>
</body>
</html>