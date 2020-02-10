<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function generateRandomURL($length,$table) {
    if($table == 'records') $x='0123456789';
    else $x='0123456789abcdefghik';
    $url = substr(str_shuffle(str_repeat($x, ceil($length/strlen($x)) )),1,$length);
    $check = pageData("SELECT id FROM $table WHERE url=$url");
    if($check){
        generateRandomURL($length,$table);
    }
    else {
        return $url;
    }
}