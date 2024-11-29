<?php 
    session_start();
    require '../Koneksi/koneksi.php';
    require '../Template/navbar.php';
    require '../Template/function.php';

    checkAccess();

    $userEmail = $_SESSION['name'];
    $getAkunInfoSql = "SELECT * FROM akun WHERE email_akun = '$userEmail'";
    $getAkunInfoRrlt = mysqli_query($conn, $getAkunInfoSql);
    $akunInfo = mysqli_fetch_assoc($getAkunInfoRrlt);
    $idAkun = $akunInfo['id_akun'];
    $gambarLama = $akunInfo['foto_akun'];

    if(isset($_POST['edit'])){
        $username = htmlspecialchars($_POST['username']);
        $checkUsernameSql = "SELECT username_akun FROM akun WHERE username_akun = '$username' AND id_akun <> '$idAkun'";
        $checkUsernameRslt = mysqli_query($conn, $checkUsernameSql);

        if (mysqli_num_rows($checkUsernameRslt)>0) {
            echo "
            <script>
            alert('Username sudah digunakan!');
            document.location.href = 'editProfile.php';
            </script>";
        }else{
            if ($_FILES['foto']['error'] == UPLOAD_ERR_NO_FILE) {
                $gambarFinal = $gambarLama;
            }else{
                $gambarUp = $_FILES['foto']['name'];
                $gambarUpTmp = $_FILES['foto']['tmp_name'];

                $gambarEkstensi = pathinfo($gambarUp, PATHINFO_EXTENSION);
                $gambarFinal = date('Y-m-d_H-i-s'). ".". $gambarEkstensi;
                
                $pathGambarLama = "../ProfilePicture/". $gambarLama;
                $pathGambarBaru = "../ProfilePicture/". $gambarFinal;

                if(file_exists($pathGambarLama) && $gambarLama !== NULL){
                    unlink($pathGambarLama);
                }
                $ekstensiList = ['jpg', 'jpeg', 'png'];
                if(in_array(strtolower($gambarEkstensi), $ekstensiList)){
                    move_uploaded_file($gambarUpTmp, $pathGambarBaru);
                }else{
                    echo "<script>
                    alert('Ekstensi file tidak diperbolehkan!');
                    document.location.  href = 'editProfile.php'
                    </script>";
                    return;
                }
            }
            $updateSql = "UPDATE akun SET username_akun = '$username', foto_akun='$gambarFinal' WHERE id_akun = '$idAkun'";
            if(mysqli_query($conn, $updateSql)){
                echo "
                <script>
                alert('Update berhasil!');
                document.location.href = 'userProfile.php';
                </script>
                ";
            }else{
                echo "<script>
                    alert('Data gagal diubah!');
                    document.location.href = 'editProfile.php';
                </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/editprofile-style.css">
    <link rel="stylesheet" href="../Styles/color.css">
    <title>Artha || Edit Profil</title>
</head>

<body>
    <h2>Edit Profil</h2>
<div class="container">
        <div class="form-container">
            <div class="image-preview">
                <img id="preview" src="../ProfilePicture/<?php echo $akunInfo['foto_akun'] ?: 'default.png'; ?>" alt="Pratinjau Gambar">
            </div>
            <div class="form-edit">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Isi username disini" value="<?php echo $akunInfo['username_akun'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" onchange="previewImage(event)">
                    </div>
                    <div class="button-group">
                        <a href="userProfile.php" class="btn btn-cancel">Batal</a>
                        <input type="submit" value="Edit" name="edit" class="btn btn-submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    <?php require '../Template/footer.php' ?>
</body>

</html>
