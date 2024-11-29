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
            document.location.href = 'verifikasiReview.php';
            </script>";
            exit;
    }
}


?>