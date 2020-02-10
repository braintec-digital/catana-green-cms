<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function removeBom($data) {
    $bom = pack('H*','EFBBBF');
    $data = preg_replace("/^$bom/", '', $data);
    return $data;
}
function clearData($data) {
    if(is_array($data)) {
        foreach($data as $key => $val) {
            $data[$key] = removeBom(trim(strip_tags(htmlspecialchars(stripslashes($val)))));
        }
    } else {
        $data = removeBom(trim(strip_tags(htmlspecialchars(stripslashes($data)))));
    }
    return $data;
}