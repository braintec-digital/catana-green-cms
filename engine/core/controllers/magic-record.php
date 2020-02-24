<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
viewRecordLogs($record['id'],'');

$recid = $record['id'];

$record['basedate'] = $record['date'];
$record['usadate'] = ChangeDateUsa($record['date'],$get['word']);
$record['date'] = ChangeDate($record['date'],$get['word']);

$record['time'] = substr($record['time'], 0, -3);

if($record['tags']) {
    include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/fields/tags.php');
}

if($record['param'] != '-' || $record['param'] != '--' || $record['param'] != '') {
    include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/fields/param.php');
}
if(isset($record['size'])) {
    include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/fields/size.php');
}

if($get['site']['pay_set'][2] > '0') {
    $prices = $record['price']*$get['site']['pay_set'][2];
    $oldprices = $record['price_old']*$get['site']['pay_set'][2];
}
else {
    $prices = $record['price'];
    $oldprices = $record['price_old'];
}
if($record['price']) {
    $stock['page'] = $content['view']['stock'];
    $stock['cat'] = $content['page']['stock'];
    $stock['podcat'] = $content['note']['stock'];
    include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/fields/price.php');
}