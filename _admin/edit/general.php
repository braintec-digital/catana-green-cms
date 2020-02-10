<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/engine/core/database/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/controllers/adminFns.php');
$table = 'general';
$data = editData("SELECT * FROM $table");
include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/toolbar.general.php');
echo '<content>';
echo '<form>';
echo '<input type="hidden" name="table" value="'.$table.'">';
include($_SERVER['DOCUMENT_ROOT'].'/_admin/samples/fields.general.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/samples/generator.php');
echo '</form>';
echo '<script>addoneFunc()</script>';
echo '</content>';