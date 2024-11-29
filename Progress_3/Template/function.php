<?php 

function checkAccess() {
    if (!isset($_SESSION['name']) || $_SESSION['role'] == 'admin') {
        if ($_SESSION['role'] == 'admin') {
            echo 
            "<script>
            document.location.href = '../Admin/homeAdmin.php';
            </script>";
        } else {
            echo 
            "<script>
            document.location.href = '../Auth/login.php';
            </script>";
        }
        exit;
    }
}

function checkIdMakanan(){
    if(!isset($_GET['id_makanan'])){
        header ("location: ../User/homeUser.php");
        exit;
    }
}

function checkAuth(){
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
}

function checkRoleAdmin(){
    if(!isset($_SESSION['role'])){
        echo 
            "<script>
            document.location.href = '../Auth/login.php';
            </script>";
            exit;
    }

    if($_SESSION['role'] !== 'admin'){
        echo 
            "<script>
            document.location.href = '../User/homeUser.php';
            </script>";
            exit;
    }
}

function checkIdMakananAdmin(){
    if(!isset($_GET['id_makanan'])){
        echo 
            "<script>
            document.location.href = 'homeAdmin.php';
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
    <link rel="stylesheet" href="../Styles/color.css">
    <link rel="stylesheet" href="../Styles/allert-style.css">
    <link rel="icon" type="image/png" href="../Assets/asp-net.png">
    <title>ARTHA</title>
</head>
<body>

    <?php function badAllert($massage, $link){ ?>
        <div class="modal">
            <div class="card">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#696969" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                </svg>
                <p class="massage"><?php echo $massage ?></p>
                <a href="<?php echo $link?>"><button>OK</button></a>
            </div>
        </div>
        <?php } ?>
        
        <?php function goodAllert($massage, $link){ ?>
            <div class="modal">
                <div class="card">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#696969" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                </svg>
                    <p class="massage"><?php echo $massage ?></p>
                    <a href="<?php echo $link?>"><button>OK</button></a>
                </div>
            </div>     
        <?php } ?>

        
        
    </body>
</html>