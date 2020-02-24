<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$list = 'records';
$table = 'records';
include($_SERVER['DOCUMENT_ROOT'].'/_admin/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/parents.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/toolbar.list.php');
echo '<content view_id="'.$_POST['edit']['id'].'" page_id="0" note_id="0">';
include($_SERVER['DOCUMENT_ROOT'].'/_admin/list/list.records.php');
echo '</content>';