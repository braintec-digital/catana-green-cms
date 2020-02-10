<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
include_once($_SERVER['DOCUMENT_ROOT']."/config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/functions/clusterData.php");

$root = $_SERVER['DOCUMENT_ROOT'].'/';
if($_POST['open']) {
    $type = $_POST['open']['type'];
    $path = $_POST['open']['path'];
    $file = $_POST['open']['file'];
    switch($type){
        case 'img':
        echo '<img src="'.$path.$file.'"/>';
        break;
    
        case 'pdf':
        echo '<iframe src="'.$path.$file.'"></iframe>';
        break;
    
        case 'doc':
        echo '<iframe src="'.$path.$file.'"></iframe>';
        break;

        case 'video':
        echo '<iframe src="'.$path.$file.'" frameborder="0" allow="autoplay" style="width: 900px; height: 550px;"></iframe>';
        break;

        case 'audio':
        echo '<audio controls id="player" src="'.$path.$file.'"></audio>';
        break;
    }
}
if($_POST['check']){
    $file = $_POST['check'];
    
    $chek = pageData("SELECT title,public,del,date FROM records WHERE img LIKE '%$file%'");
    if($chek) {
        echo '<b>Обложка записи:</b><br>'.$chek['title'];
        if($chek['public']) echo '<br><b>Публикуется!</b> c '.$chek['date'];
        else echo '<br><b>Не публикуется!</b>';
    }
}
if($_POST['action']){
    
    $type = $_POST['action']['type'];
    $path = $_POST['action']['path'];

    unset($_POST['action']['type']);
    unset($_POST['action']['path']);

    $files = $_POST['action'];

    if($type == 'delete') {
        foreach($files as $item) {
            if(is_dir($root.$path.$item)) rmdir($root.$path.$item);
            else unlink($root.$path.$item);
        }
        // echo '<confirm class="succsess"><p>Выбранные Объекты Удалены!</p></confirm>';
    }
    if($type == 'newfolder') {
        $item = $_POST['action']['newname'];
        mkdir($root.$path.$item);
    }
    if($type == 'rename') {
        $old = $_POST['action']['item'];
        $new = $_POST['action']['newname'];
        if(is_dir($root.$path.$old)) {
            rename($root.$path.$old, $root.$path.$new);
        }
        else {
            $pag = getData("SELECT id,img FROM pages WHERE img LIKE '%$old'");
            if($pag) {
                foreach($pag as $field){
                    $id = $field['id'];
                    $img = str_replace($old, $new, $field['img']);
                    dbSite("UPDATE pages SET img = '$img' WHERE id='$id' ");
                }
            }
            $rec = getData("SELECT id,img FROM records WHERE img LIKE '%$old'");
            if($rec) {
                foreach($rec as $field){
                    $id = $field['id'];
                    $img = str_replace($old, $new, $field['img']);
                    dbSite("UPDATE records SET img = '$img' WHERE id='$id' ");
                }
            }
            rename($root.$path.$old, $root.$path.$new);
        }
    }
    if($type == 'paste') {
        $newpath = $_POST['action']['newpath'];
        unset($_POST['action']['newpath']);
        // echo 'перенос файлов! из '.$path.' в '.$newpath.'<br>';
        foreach($files as $item) {
            // echo $item.'<br>';
            if(is_dir($root.$path.$item)) {
                if(mkdir($root.$newpath.$item)){
                    rmdir($root.$path.$item);
                }
            }
            else {
                if(copy($root.$path.$item, $root.$newpath.$item)){
                    unlink($root.$path.$item);
                }
            }
        }
    }
}
unset($_POST);