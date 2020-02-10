<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if(strstr($get['sets'],'/')) $sets = explode('/',$get['sets']);
else $sets[0] = $get['sets'];

foreach($sets as $set) {
    if(strstr($set,',')) {
        $f = explode(':',$set)[0];
        $set = str_replace($f.':','',$set);
        $s = str_replace(",","%' OR ".$f." LIKE '%",$set);
        $like[] = "($f LIKE '%".$s."%')";
    }
    else {
        $like[] = "(".str_replace(':'," LIKE '%",$set)."%')";
    }
}
$select['find'] = "(".implode(" AND ", $like).") AND";