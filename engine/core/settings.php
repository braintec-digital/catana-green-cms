<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ERROR);

if((!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") && ($get['tpl']['https'])) {
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $redirect");
}
elseif(!in_array($_SERVER['HTTP_HOST'],$ssl) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == 'https') {
    $redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $redirect");
}
$check = explode('.',$_SERVER["SERVER_NAME"]);
if($check[0] == 'www' && !$get['tpl']['www']) {
    unset($check[0]);
    $redirect = implode('.',$check).$_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: //$redirect");
}
elseif($check[0] != 'www' && $get['tpl']['www']) {
    $redirect = 'www.'.implode('.',$check).$_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: //$redirect");
}

if($redirects) {
    if($_SERVER['REQUEST_URI'] != '/') $uri = $_SERVER['REQUEST_URI'];
    foreach ($redirects as $old => $new) {
        if($uri == '/'.$old) {
            header('Location: //'.$_SERVER["SERVER_NAME"].'/'.$new, true, 301);
            exit;
        }
    }
}

if($_SERVER['HTTPS']) $serv = 'https://';
else $serv = 'http://';
$base = $_SERVER['HTTP_HOST'];

$get['folder'] = $base;
$get['file'] = '_root/'.$base;
$get['filepath'] = 'userfiles/';
$get['userpath'] = 'get_img=';
$get['realpath'] = '_root/'.$base.'/userfiles';