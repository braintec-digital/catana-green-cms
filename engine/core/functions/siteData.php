<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function siteData($lang) {
    $site = general("SELECT * FROM general WHERE id=1");
    $site = singleCluster($site,$lang);

    foreach($site as $key => $val) {
        if(stristr($val,'⣿')) {
            $temp = explode('⣿',$val);
            $newrow[$key] = $temp[$lang['id']];
        }
        else if(stristr($val,'arr:')) {
            $temp = str_replace('arr:','',$val);
            $newrow[$key] = explode(',',$temp);
        }
        else if(stristr($val,'obj:')) {
            $temp = str_replace('obj:','',$val);
            $temp = explode(',',$temp);
            foreach($temp as $item) {
                $item = explode('=',$item);
                $arr[$item[0]] = $item[1];
            }
            $newrow[$key] = $arr;
        }
        else $newrow[$key] = $val;
    }
    return $newrow;
}