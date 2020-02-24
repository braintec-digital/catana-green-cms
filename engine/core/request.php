<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/

if($_GET['url']) { $url = $_GET['url']; $get['type'] = 'GET'; }
elseif($_POST) { $url = ajaxUrl(); $get['type'] = 'POST'; }
else { $url = $_SERVER["REQUEST_URI"]; $get['type'] = 'URI'; }

include($_SERVER['DOCUMENT_ROOT']."/engine/pathmask.php");

$get['device'] = isMobile();
$get['www'] = $serv.$base;
$get['root'] = $base;
$get['link'] = $url;

$get['find'] = '';
$get['date'] = '';
$get['next'] = '';
$get['page'] = '';

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
if(stristr($url,'/date=')) {
    $url = explode('/date=',$url);
    $get['date'] = str_replace('_',' ',urldecode($url[1]));
    $get['date'] = str_replace('/','',$get['date']);
    $url = $url[0];
}
if(stristr($url,'/page/')) {
    $url = explode('/page/',$url);
    $get['pages'] = str_replace('_',' ',urldecode($url[1]));
    $get['pages'] = number_format(str_replace('/','',$get['pages']));
    $url = $url[0];
}

$url = explode('/',$url);

if(strlen($url[1]) == 2) {
    $lang = $url[1];
    $get['langSet'] = pageData("SELECT * FROM langs WHERE lang='$lang'");
    $get['langUrl'] = $lang.'/';
    $get['lang'] = $url[1];
    $get['view'] = $url[2];
    $get['page'] = $url[3];
    $get['note'] = $url[4];

    if($get['view']) $get['leaf'] = $get['lang'].'/'.$get['view'];
    if($get['page']) $get['leaf'] = $get['lang'].'/'.$get['view'].'/'.$get['page'];
    if($get['note']) $get['leaf'] = $get['lang'].'/'.$get['view'].'/'.$get['page'].'/'.$get['note'];

    $get['canonical'] = $get['lang'];
    if($get['view']) $get['canonical'] .= '/'.$get['view'];
    if($get['page']) $get['canonical'] .= '/'.$get['page'];
    if($get['note']) $get['canonical'] .= '/'.$get['note'];
}
else {
    $get['langSet'] = pageData("SELECT * FROM langs WHERE main=1");
    $get['langUrl'] = '';
    $get['lang'] = $get['langSet']['lang'];
    $get['view'] = $url[1];
    $get['page'] = $url[2];
    $get['note'] = $url[3];

    if($get['view']) $get['leaf'] = $get['view'];
    if($get['page']) $get['leaf'] = $get['view'].'/'.$get['page'];
    if($get['note']) $get['leaf'] = $get['view'].'/'.$get['page'].'/'.$get['note'];

    if($get['view']) $get['canonical'] .= '/'.$get['view'];
    if($get['page']) $get['canonical'] .= '/'.$get['page'];
    if($get['note']) $get['canonical'] .= '/'.$get['note'];
}
if($get['langSet']['main']) {$get['langUrl'] = ''; $get['langLink'] = '';}
else {$get['langUrl'] = $get['lang'].'/'; $get['langLink'] = $get['lang'];}

$get['word'] = wordsLang($get['langSet']);
$get['site'] = siteData($get['langSet']);

if($get['view']) {
    $get['search'] = $get['langUrl'].$get['view'];
}
else {
    $get['search'] = $get['langUrl'].$get['site']['main_search'];
}

if($get['view'] == $get['tpl']['adminlink']) {
    $get['view'] = '';
    $get['enter'] = 'admin';
}