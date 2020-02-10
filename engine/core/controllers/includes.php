<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
$include = $_POST['include'];
include($_SERVER['DOCUMENT_ROOT']."/config.php");
include($_SERVER['DOCUMENT_ROOT'].'/core/controllers/request.php');
include($_SERVER['DOCUMENT_ROOT'].'/core/controllers/content.php');

include($_SERVER['DOCUMENT_ROOT']."/core/controllers/magic.php");

if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$include['file'])){
    $code = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$include['file']);

    if(strpos($code, '@TVnow')) {
        $today = date('Y-m-d');
        $time = date('H:i');
        $tv = selectDB(["title,short","records_short","page_id='63' AND date='$today'"]);
        $code = str_replace('@nowBaseDate',$today,$code);
        $code = str_replace('@nowTime',$time,$code);

        $tv['short'] = explode('⊣key⊢',$tv['short']);
        $tv['short'] = $tv['short'][$get['langSet']['id']];

        $tv['title'] = explode('⊣key⊢',$tv['title']);
        $tv['title'] = $tv['title'][$get['langSet']['id']];

        $code = str_replace('@TVnow',$tv['short'],$code);
        $code = str_replace('@TVday',$tv['title'],$code);
    }
    $code = str_replace('@sitename',$get['file'],$code);

    if($get['pageid']) {$code = str_replace('@pageId',$get['pageid'],$code);}
    else {$code = str_replace('@pageId',$get['viewid'],$code);}

    $code = str_replace('@view',$get['view'],$code);
    $code = str_replace('@page',$get['page'],$code);
    $code = str_replace('@locate',$get['city'],$code);
    $code = str_replace('@recordId',$get['record']['id'],$code);
    $code = str_replace('@lang',$get['lang'],$code);

    $code = str_replace('@Atype',$Atype,$code);
    $code = str_replace('@Aid',$Aid,$code);

    if(strpos($code, '@user')) {
        $code = str_replace('@user_login',$get['user']['login'],$code);
        $code = str_replace('@user_status',$get['user']['status'],$code);
        $code = str_replace('@user_id',$get['user']['id'],$code);
        $code = str_replace('@user_img',$get['user']['img'],$code);
        $code = str_replace('@user_mail',$get['user']['mail'],$code);
        $code = str_replace('@user_phone',$get['user']['phone'],$code);
        $code = str_replace('@user_firstname',$get['user']['firstname'],$code);
        $code = str_replace('@user_lastname',$get['user']['lastname'],$code);
        $code = str_replace('@user_birthday',$get['user']['birthday'],$code);
        $code = str_replace('@user_sex',$get['user']['sex'],$code);
        $code = str_replace('@user_country',$get['user']['country'],$code);
        $code = str_replace('@user_region',$get['user']['region'],$code);
        $code = str_replace('@user_city',$get['user']['city'],$code);
        $code = str_replace('@user_street',$get['user']['street'],$code);
        $code = str_replace('@user_home',$get['user']['home'],$code);
        $code = str_replace('@user_room',$get['user']['room'],$code);
        $code = str_replace('@user_interests',$get['user']['interests'],$code);
        $code = str_replace('@user_profession',$get['user']['profession'],$code);
    }

    foreach($get['word'] as $key => $val) { // заменяем ключи на данные словаря
        $key = str_replace($delang,'',$key); // отсекаем язык
        $code = str_replace("@word-".$key, $val, $code);
    }

    $code = Magic();
    echo $code;
}