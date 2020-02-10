<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if($_POST['action'] == 'exit-admin') {
    session_start();
    unset($_SESSION['admin']);
    echo '<script>window.location.reload()</script>';
}