<?php 
    session_start();
    require '../Koneksi/koneksi.php';

    include '../Template/navbar.php'; 

    
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
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Styles/homeadmin-style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
        <title>Artha || Dashboard Admin</title>
    </head>
    <style src="../Styles/homeadmin-style.css"></style>
    <body>   
        <div class="container">
            <main>
                <div class="welcome">
                    <h2>Welcome, <span>Admin :)</span></h2>
                    <button class="button">
                        Permintaan <br>Konfirmasi
                        <!-- <span class="line"></span> -->
                        <span class="count">0</span>
                    </button>
                    <button class="button report">
                        Daftar <br> Report
                        <!-- <span class="line"></span> -->
                        <span class="count">  0</span>
                    </button>
                    <a class="exit" href="../Auth/logout.php">
                            <i class="bi bi-x-lg"></i>
                            <!-- <span class="line"></span> -->
                            Keluar
                    </a>
                </div>
                <div class="illustration">
                    <img src="../Assets/admin-removebg-preview.png" alt="Dashboard Image">
                </div>
            </main>
        </div>
        <footer>
            <?php 
            include '../Template/footer.php'; 
            ?>
    </footer>
</body>
</html>
