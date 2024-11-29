<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/color.css">
    <link rel="stylesheet" href="../Styles/post-style.css">
</head>
<body>
    <?php function tampilkanPost($post) {?>

    <div class="post-container">
        <?php foreach ($post as $p): ?>
        <?php if($p['status_review'] !== 'Disetujui'){
            $lihat = "../User/checkReview.php";
        }else{
            $lihat = "../User/lihatReview.php";
        } ?>

        <a href="<?php echo $lihat?>?id_makanan=<?php echo $p['id_makanan']?>">
            <div class="post">
                <img src="../MakananUploads/<?php echo $p['foto_makanan'] ?>" alt="">
                <div class="img-overlay">
                    <p><?php echo $p['judul_makanan'] ?></p>
                </div>
            </div>
        </a>

        <?php endforeach; ?>
    </div>
    <?php } ?>
</body>
</html>