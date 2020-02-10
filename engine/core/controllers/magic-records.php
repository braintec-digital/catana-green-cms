<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
$parentUrl = '';

if($table == 'pages' && $record['parent_id']) {
    $val = $record['parent_id'];
    $cat = pageData("SELECT view FROM pages WHERE id=$val");
    $parentUrl = $cat['view'].'/';
    $parent['view'] = $cat['view'];
}

if(strstr($table,'records')) {
    $parent = pageData("SELECT view,menu,icon,unit,stock FROM pages WHERE id=".$record['view_id']);
    $cat['menu'] = explode('⊣key⊢',$parent['menu']);
    $cat['menu'] = $cat['menu'][$get['langSet']['id']];
    $parentUrl = $parent['view'].'/';
    $stock['page'] = $parent['stock'];
    $unit = $parent['unit'];
    $icon = $parent['icon'];
    if($record['page_id']) {
        $cat = pageData("SELECT view,menu,icon,unit,stock FROM pages WHERE id=".$record['page_id']);
        $cat['menu'] = explode('⊣key⊢',$cat['menu']);
        $cat['menu'] = $cat['menu'][$get['langSet']['id']];
        $cat['view'] = $parent['view'].'/'.$cat['view'];
        $stock['cat'] = $cat['stock'];
        if($cat['unit']) $unit = $cat['unit'];
        if($cat['icon']) $icon = $cat['icon'];
    }
    if($record['note_id']) {
        $cat = pageData("SELECT view,menu,icon,unit,stock FROM pages WHERE id=".$record['note_id']);
        $cat['menu'] = explode('⊣key⊢',$cat['menu']);
        $cat['menu'] = $cat['menu'][$get['langSet']['id']];
        $cat['view'] = $parent['view'].'/'.$cat['view'];
        $stock['podcat'] = $cat['stock'];
        if($cat['unit']) $unit = $cat['unit'];
        if($cat['icon']) $icon = $cat['icon'];
    }
}

// date
if($record['date']) {
    $record['basedate'] = $record['date'];
    include_once($_SERVER['DOCUMENT_ROOT'].'/core/functions/changeDate.php');
    $record['usadate'] = ChangeDateUsa($record['date'],$get['word']);
    if($record['date'] == $get['today']) { $record['date'] = $get['word']['today']; }
    elseif($record['date'] == $get['yesterday']) { $record['date'] = $co.$get['word']['yesterday']; }
    else { $record['date'] = $c.ChangeDate($record['date'],$get['word']); }
}
// time
if($record['time']) $record['time'] = substr($record['time'], 0, -3);
// url
if($record['view']) {
    $record['url'] = $get['langUrl'].$parentUrl.$record['view'];
}
elseif($record['link'] && $get['name'] == 'glow') {
    $record['url'] = $get['langUrl'].$record['link'];
    $record['urlid'] = $get['langUrl'].$parentUrl.$record['id'];
    
}
elseif($record['url']) {
    $record['url'] = $get['langUrl'].$parentUrl.$record['url'];
    $record['urlid'] = $get['langUrl'].$parentUrl.$record['id'];   
}
// cover
if($record['img'] && !$record['video']) {
    $record['img'] = $get['filepath'].$record['img'];
    $record['keyvideo'] = '';
}
elseif($record['video'] && !$record['img']) {
    $record['img'] = "https://img.youtube.com/vi/".$record['video']."/mqdefault.jpg"; // maxresdefault , mqdefault
    $record['keyvideo'] = '<ico><i class="mdi mdi-youtube-play fs-4x"></i></ico>';
}
elseif($record['video'] && $record['img']) {
    $record['img'] = $get['filepath'].$record['img'];
    $record['keyvideo'] = '<ico><i class="mdi mdi-youtube-play fs-4x"></i></ico>';
}
else {
    $record['img'] = '';
    $record['keyvideo'] = '';
}
// price
if($record['price']) {
    include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/fields/price.php');
}
// params
if($record['param'] != '-' || $record['param'] != '--' || $record['param'] != '') {
    include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/fields/param.php');
}

if($record['tags']) {
    include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/fields/tags.php');
}

if(!$record['menu']) { $record['menu'] = $record['title']; }

if($record['rating']) {
    include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/fields/rating.php');
}

// check gallery
if(strstr($table,'records')) {
    if(is_array($record['gallery'])) $record['keygallery'] = '<ico><i class="mdi mdi-camera fs-4x"></i></ico>';
    else $record['keygallery'] = '';
}

$line = str_replace('@filepath',$get['filepath'],$line);
$line = str_replace('@incart',$incart,$line);

$line = str_replace('@param1',$param[0],$line);
$line = str_replace('@param2',$param[1],$line);
$line = str_replace('@param3',$param[2],$line);

$line = str_replace('@catlink',$cat['view'].$get['locate'],$line);
$line = str_replace('@cat',$cat['menu'],$line);
$line = str_replace('@unit',$unit,$line);
$line = str_replace('@icon',$icon,$line);
$line = str_replace('@num',$num,$line);
$line = str_replace('@order',$order,$line);
$line = str_replace('@site->money',$get['site']['pay_set'][1],$line);
$line = str_replace('@record->urlid',$record['urlid'].$get['locate'],$line);
$line = str_replace('@record->url',$record['url'].$get['locate'],$line);
$line = str_replace('@record->id',$record['id'],$line);
if($record['icon']) $record['menuicon'] = $record['icon'];

$line = str_replace('@record->parent',$parent['view'],$line);

$line = str_replace('@user->name',$record['user_name'],$line);
$line = str_replace('@user->comment',$record['text'],$line);

if($record['oldprice'] == '') $line = str_replace('@record->oldprice','',$line);
if($record['menuicon']) $line = str_replace('@menuicon',$record['menuicon'],$line);
// record key to val
foreach($record as $name => $value) {
    $line = str_replace('@record->'.$name,$value,$line);
}