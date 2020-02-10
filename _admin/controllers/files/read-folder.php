<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
include_once($_SERVER['DOCUMENT_ROOT']."/_admin/controllers/adminFns.php");
$root = 'userfiles/';
$back = NULL;

if($_POST['cat'] && $_POST['cat'] != '.') {
    $cat = $_POST['cat'].'/';
    if(stristr($_POST['cat'],'/')){
        $link = explode('/',$_POST['cat']);
        $key = key( array_slice($link, -1, 1,TRUE));
        if($key) unset($link[$key]);
        if(is_array($link)) $link = implode('/',$link);
        $back = '<li class="folder back" cat="'.$link.'"><i class="mdi mdi-folder-open"></i><p>..</p></li>';
    }
    else {
        $back = '<li class="folder back" cat="."><i class="mdi mdi-folder-open"></i><p>..</p></li>';
    }
}
else {
    $cat = '';
    $back = '';
}
if($_POST['cat'] && $_POST['cat'] != '.') $filepath = '<b>></b>'.str_replace('/','<b>></b>', $_POST['cat']);
else $filepath = '';

echo '<div path="'.$root.$cat.'" cat="'.$_POST['cat'].'"><i class="mdi mdi-server fs-4x"></i>userfiles'.$filepath.'</div>';
$path = $_SERVER['DOCUMENT_ROOT'].'/'.$root.$cat;
$list = scandir($path);
unset($list[0]);
unset($list[1]);

echo $back;
foreach($list as $item) {
    if(is_dir($path.'/'.$item)) {
        if($item == 'userfiles' || $item == 'views' || $item == 'templates' || $item == 'blocks' || $item == 'users') {
            $ico = 'mdi-folder-image system';
            $help = ' help="Системная Папка"';
        }
        else {
            $ico = 'mdi-folder';
            $help = '';
        }
        echo '<li'.$help.' class="folder" cat="'.$cat.$item.'" file="'.$item.'"><i class="mdi '.$ico.'"></i><p>'.$item.'</p></li>';
    }
}
foreach($list as $item) {
    if(!is_dir($path.'/'.$item)) {
        $type = checkFileType($item);
        if($type['type'] == 'img') $view = ' help="<img src='.$root.$cat.$item.'/>"';
        echo '<li class="file" type="'.$type['type'].'" file="'.$item.'" data-path="'.$root.$cat.$item.'" open="'.$cat.$item.'"><pics style="background-image: url('.$root.$cat.$item.')"></pics><i'.$view.' class="mdi '.$type['ico'].'"></i><p>'.$item.'</p></li>';
    }
}