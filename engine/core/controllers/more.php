<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
include($_SERVER['DOCUMENT_ROOT']."/config.php");
include($_SERVER['DOCUMENT_ROOT'].'/core/controllers/request.php');
include($_SERVER['DOCUMENT_ROOT'].'/core/controllers/content.php');

include($_SERVER['DOCUMENT_ROOT']."/core/functions/checkBlockSql.php");
include($_SERVER['DOCUMENT_ROOT']."/core/controllers/magic.php");

$block = $_POST['req']['block'];
$rows = $_POST['req']['rows'];
$next = $_POST['req']['next'];
$maxi = $_POST['req']['maxi'];

if((!$maxi) || ($rows < $maxi)) {
    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$get['file'].'/views/blocks/'.$block.'/'.$block.'.php')){
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$get['file'].'/views/blocks/'.$block.'/'.$block.'.php');
    }
    else {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/views/blocks/'.$block.'/'.$block.'.php');
    }
    $code = new simple_html_dom();
    $code = str_get_html($file);

    foreach($code->find('list[datasql]') as $item) {
        $datasql = $item->datasql;
        foreach($item->find('box') as $obj) {
            $obj->style = 'opacity:0';
        }
        $code = $item->innertext;
        $genegal = true;
    }
    
    if($datasql == '@block_sql') { $datasql = checkBlockSql($get['viewid'],$get['pageid'],$get['noteid'],$block); }
    
    include($_SERVER['DOCUMENT_ROOT']."/core/controllers/magic-site.php");
    include($_SERVER['DOCUMENT_ROOT']."/core/controllers/sql.php");
    
    if($records) {
        
        if($_SESSION['cart']) $incart = $_SESSION['cart'];
        
        $item = $code; // ищем в родителе первый дочерний эелемент и берем его как образец
        $code = array();
        $row->class = "hidemore";
        
        foreach($records as $record) {
            
            $record = clusterData($record,$get['langSet']);
            
            if($get['admin']) {
                if($record['public'] == 0) {$public = 'class="off"';} else {$public = '';}
                // $adnimOn = 'edit='.$pageEdit['id'].' table="pages" lang='.$lang.'';
                if($table == 'pages') $adminRecord = 'edit='.$record['id'].' table="pages" lang='.$lang.'';
                else $adminRecord = 'edit='.$record['id'].' parent='.$record['page_id'].' table=records '.$public.'';
            } else { $adminRecord = ''; }
            
            // узнаем колличество фотографий связанных с записью
            $rid = $record['id'];
            $count = countRows(["id","record_img","record_id='$rid'"]);
            if($count > 1) { $keygallery = '<ico><i class="fa fa-1x fa-camera"></i></ico>'; }
            else { $keygallery = ''; }
            
            $line = $item;
            include($_SERVER['DOCUMENT_ROOT']."/core/controllers/magic-records.php");
            
            foreach($get['word'] as $w => $v) { // заменяем ключи на данные словаря
                $line = str_replace("@word-".$w, $v, $line);
            }
            
            $code[] = $line;
        }
    } else {
        $code = '';
    }
    echo json_encode($code);
}