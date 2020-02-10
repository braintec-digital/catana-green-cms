<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function ajaxUrl(){
    $url = explode($_SERVER['SERVER_NAME'].'/',$_SERVER['HTTP_REFERER']);
    if($url[1] != '') $url = '/'.$url[1];
    else $url = ' ';
    return $url;
}