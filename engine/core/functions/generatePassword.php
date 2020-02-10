<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function generatePassword($length){
    $chars = 'abcdefghijklmnrstxyzABCDEFGIJHKNQRSTXYZ1234567890';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
}