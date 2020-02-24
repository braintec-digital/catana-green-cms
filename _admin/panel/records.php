<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
include($_SERVER['DOCUMENT_ROOT'].'/_admin/config.php');

$list = getData("SELECT id,menu FROM pages WHERE (del!=1 AND type='multi')","num ASC");

foreach($list as $item) {
    echo '<li id="'.$item['id'].'" file="record"><div><span class="list-rows">'.$item['menu'].'</span></div><i class="add-edit mdi mdi-plus-circle fs-3x"></i></li>';
}