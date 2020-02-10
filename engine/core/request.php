<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/

if($_GET['url']) { $url = $_GET['url']; $get['type'] = 'GET'; }
elseif($_POST) { $url = ajaxUrl(); $get['type'] = 'POST'; }
else { $url = $_SERVER["REQUEST_URI"]; $get['type'] = 'URI'; }

$get['device'] = isMobile();
$get['root'] = $_SERVER['SERVER_NAME'];
$get['link'] = $_SERVER['SERVER_NAME'].$url;

$get['find'] = '';
$get['next'] = '';

if(stristr($url,'/find=')) {
    $url = explode('/find=',$url);
    $get['find'] = str_replace('_',' ',urldecode($url[1]));
    $get['find'] = str_replace('/','',$get['find']);
    $url = $url[0];
}
if(stristr($url,'/next=')) {
    $url = explode('/next=',$url);
    $get['next'] = str_replace('_',' ',urldecode($url[1]));
    $get['next'] = str_replace('/','',$get['next']);
    $url = $url[0];
}

$url = explode('/',$url);

if(strlen($url[1]) == 2) {
    $lang = $url[1];
    $get['langSet'] = pageData("SELECT * FROM langs WHERE lang='$lang'");
    $get['lang'] = $url[1];
    $get['view'] = $url[2];
    $get['page'] = $url[3];
    $get['note'] = $url[4];
    $get['canonical'] = $get['lang'];
    if($get['view']) $get['canonical'] .= '/'.$get['view'];
    if($get['page']) $get['canonical'] .= '/'.$get['page'];
    if($get['note']) $get['canonical'] .= '/'.$get['note'];
}
else {
    $get['langSet'] = pageData("SELECT * FROM langs WHERE main=1");
    $get['lang'] = $get['langSet']['lang'];
    $get['view'] = $url[1];
    $get['page'] = $url[2];
    $get['note'] = $url[3];
    if($get['view']) $get['canonical'] .= '/'.$get['view'];
    if($get['page']) $get['canonical'] .= '/'.$get['page'];
    if($get['note']) $get['canonical'] .= '/'.$get['note'];
}
if($get['langSet']['main']) {$get['langUrl'] = ''; $get['langLink'] = '';}
else {$get['langUrl'] = $get['lang'].'/'; $get['langLink'] = $get['lang'];}

$get['word'] = wordsLang($get['langSet']);
$get['site'] = siteData($get['langSet']);