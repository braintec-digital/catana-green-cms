<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ERROR);

include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/engine/core/database/connection.php');

if($_POST['login'] && $_POST['pass']) {
    $login = $_POST['login'];
    $pass = md5($_POST['pass']);

    $admin = pageData("SELECT id,admin,email,status FROM admins WHERE admin='$login' AND pass='$pass'");

    if($admin) {
        $_SESSION['admin'] = $admin;
        echo 'enter';
    }
    else {
        echo 'WRONG Admin [Login or Pass]!';
    }
}