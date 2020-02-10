<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function cutString($str,$let,$len){
    if($let && stristr($str,$let)) {
        $pos = strpos($str,$let);
        if($pos <= $len) $newstr = substr($str, 0, $pos);
        else $newstr = substr($str, 0, $len);
    } else {
        $x = explode(" ",$str);
        $y = count($x);
        $newstr = '';
        for ($i = 0; $i < $y; $i++) {  
            $this_x = $x[$i]. ' ';  
            if(strlen($newstr.$this_x) > $len) $i = $y;
            else $newstr = $newstr.$this_x;
        }
    }
    return $newstr;
}