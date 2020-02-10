<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if(is_array($get['tags'])) {
    $temp = $get['tags'];
    foreach($temp as $ta) {
        $ta = str_replace('amp;','',str_replace('&','_',$ta));
        $alt = str_replace(' ','-',$ta);
        if($alt != $ta) $set[] = "(tags LIKE '%$ta%' OR tags LIKE '%$alt%')";
        else $set[] = "(tags LIKE '%$ta%')";
        $tageset[] = mb_convert_case($ta, MB_CASE_TITLE, "UTF-8");
    }
    $multisearch = implode(" AND ", $set);
    $select['tags'] = "( ".$multisearch." ) AND";
    $foundSearch = '<i class="mdi mdi-record fs-2x"></i>'.implode('+',$tageset);
}
else {
    $temp = str_replace('amp;','',str_replace('&','_',$get['tags']));
    $alt = str_replace(' ','-',$temp);
    if($temp != $ta) $select['tags'] = "(tags LIKE '%$temp%' OR tags LIKE '%$alt%') AND";
    else $select['tags'] = "(tags LIKE '%$temp%') AND";
    $foundSearch = '<i class="mdi mdi-record fs-2x"></i>'.mb_convert_case($get['tags'], MB_CASE_TITLE, "UTF-8");
}