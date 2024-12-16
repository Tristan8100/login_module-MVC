<?php
    session_start();
    include "model.php";
    include "view.php";
    include "controller.php";

    $model = new model();
    //$view = new productview();
    $view = "overrride mamaya";
    $control = new controller($view, $model);


    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['submitlog'])){
            echo "succ";
            $_POST['emaillog'];
            $_POST['passwordlog'];
            $control->processlogin($_POST['emaillog'], $_POST['passwordlog']);
        }

        if(isset($_POST['submitcreate'])){
            //$uf, $us, $up
            $control->processcreate($_POST['namecreate'], $_POST['emailcreate'], $_POST['passwordcreate']);
        }

        if(isset($_POST['subemail'])){
            $_POST['emailforgort'];
            $control->forgorpass($_POST['emailforgort']);
        }
    }

    if($_SERVER['REQUEST_METHOD'] === "GET"){
        if(isset($_GET['mess'])){
            echo "<script>alert(".$_GET['mess']."); </script>";
        }

        if(isset($_GET['codes'])){
            echo "TRY";
            $control->verifyaccount($_GET['codes']);
        }

        if(isset($_GET['codereset'])){
            $control->verifyreset($_GET['codereset']);
        }
    }
    
    if (strpos($_SERVER['REQUEST_URI'], 'login.php') === false && strpos($_SERVER['REQUEST_URI'], 
    'create_account.php') === false && strpos($_SERVER['REQUEST_URI'], 
    'forgot_password.php') === false
    && strpos($_SERVER['REQUEST_URI'], 'verify_account.php') === false) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php"); 
         }
    } 


?>