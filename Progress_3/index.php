<?php 
    session_start();
    if (isset($_SESSION['role'])){
    if($_SESSION['role'] === 'admin'){
        echo "
            <script>
            document.location.href = '../Admin/homeAdmin.php';
            </script>";
            exit;
        }
        echo "
        <script>
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
    <link rel="stylesheet" href="Styles/index-style.css">
    <link rel="stylesheet" href="Styles/color.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="Assets/asp-net.png">
    <title>ARTHA</title>
</head>
<body>

    <nav>
        <img src="Assets/artha-logo.png" alt="logo artha" class="logo">
        
        <ul>
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#postingan">Postingan</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="Auth/login.php" class="masuk">Masuk</a></li>
        </ul>
        

        <div class="nav-hamburger">
            <input type="checkbox">
            <span class="garis-1"></span>
            <span class="garis-2"></span>
            <span class="garis-3"></span>
        </div>
    </nav>

    <section id="beranda">
        <div class="content">
            <p class="judul-1">Butuh rekomendasi makanan?</p>
            <p class="judul-2">Cari di <strong>ARTHA</strong> aja</p>
            <a href="Auth/registrasi.php">Bergabung sekarang <i class="bi bi-arrow-right"></i></a>
        </div>

        <img src="Assets/landing-ill.png" alt="gambar">
    </section>

    <section id="postingan">
        <p class="judul">POSTINGAN</p>
        <div class="content">
            <img src="Assets/makanan1-landing.jpg" alt="">
            <img src="Assets/makanan2-landing.png" alt="">
            <img src="Assets/makanan3-landing.jpg" alt="">
            
        </div>
        <a href="Auth/login.php">
            <button>LEBIH BANYAK</button>
        </a>
    </section>

    <section id="about">
        <p class="judul">TENTANG KAMI</p>
        <div class="content">
            <div class="main-content">
                <p class="main-content-header">Apa itu ARTHA?</p>
                <p class="main-content-desc" >ARTHA adalah platform review makanan yang membantu pecinta kuliner menemukan hidangan terbaik. Di ARTHA, pengguna dapat menemukan ulasan jujur tentang berbagai makanan dari restoran, kafe, hingga street food. Dengan fitur pencarian yang mudah, ARTHA menjadi panduan untuk mengeksplorasi kuliner lezat di berbagai tempat.</p>
            </div>
            <div class="separator"></div>
            <img src="Assets/artha-logo.png" alt="gambar">
        </div>
    </section>

    <?php require "Template/footer.php" ?>

    <script>
        const hamburgerToggle = document.querySelector('.nav-hamburger input');
        const nav = document.querySelector('nav ul');
        hamburgerToggle.addEventListener('click', function() {
            nav.classList.toggle('slide');
        })
    </script>
</body>
</html>