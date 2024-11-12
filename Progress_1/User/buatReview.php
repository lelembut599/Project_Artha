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
                    echo "
                    <script>
                    alert('Upload berhasil!');
                    document.location.href = 'homeUser.php';
                    </script>
                    ";
                }else{
                    echo "
                    <script>
                    alert('Upload gagal!');
                    document.location.href = 'buatReview.php';
                    </script>
                    ";

                }
            }else{
                echo 
                "<script>
                alert('Gagal mengupload gambar!');
                document.location.href = 'buatReview.php';
                </script>";

            }
        }else{
            echo 
            "<script>
            alert('File harus berupa gambar!');
            document.location.href = 'buatReview.php';
            </script>";
        }
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
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="judul">Title</label>
        <input type="text" name="judul" id="judul" maxlength="55" placeholder="Title" required>

        <br>

        <label for="desc">Description</label>
        <input type="text" name="desc" id="desc" maxlength="400" placeholder="Description" required>

        <br>

        <label for="resto">Restoran</label>
        <input type="text" name="resto" id="resto" maxlength="55" placeholder="Restoran" required>

        <br>

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" maxlength="55" placeholder="Alamat" required>

        <br>

        <label for="rate">Rate</label>
        <input type="number" name="rate" id="rate" min="0" max="5.0" step="0.1" oninput="validity.valid||(value='');" required>

        <br>

        <label for="foto">Image</label>
        <input type="file" name="foto" id="foto">

        <br>

        <input type="submit" value="Unggah" name="unggah">
    </form>
</body>
</html>