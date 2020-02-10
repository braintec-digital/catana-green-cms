<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function userInfo(){
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $referer = $_SERVER['HTTP_REFERER'];
    $uri = $_SERVER['REQUEST_URI'];
    $isite = $_SERVER["SERVER_NAME"];
    
    if((!stripos($uri,'userfiles')) && (!stripos($uri,'views')) && (!stripos($uri,'mods')) && (!stripos($uri,'library')) && (!stripos($referer,$isite)) && ($referer != '/') && ($referer != '')) {
        $res = dbSite(" INSERT INTO visitors (date,time,uri,user_ip,referer) VALUES ('$date','$time','$uri','$user_ip','$referer') ");
    }
}