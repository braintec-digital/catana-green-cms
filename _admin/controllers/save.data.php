<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
include($_SERVER['DOCUMENT_ROOT'].'/_admin/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/engine/core/functions/translit.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/controllers/adminFns.php');
$post = $_POST['data'];

if($post['order']) {
    sortData($post);
}
elseif($post['remove']) {
    deleteData($post);
}
else {
    if($post['id']) updateData($post);
    else insertData($post);
}