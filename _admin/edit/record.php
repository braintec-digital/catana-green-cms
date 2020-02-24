<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
session_start();
$admin = $_SESSION['admin'];
include($_SERVER['DOCUMENT_ROOT'].'/_admin/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/controllers/adminFns.php');
$type = pageData("SELECT multitype FROM pages WHERE id=".$_POST['edit']['id']);
$table = 'records';
if($_POST['edit']['record_id']) {
    $data = editData("SELECT * FROM $table WHERE id=".$_POST['edit']['record_id']);
} else {
    $data['view_id'] = $_POST['edit']['id'];
    $data['page_id'] = '0';
    $data['note_id'] = '0';
    $data['public'] = '0';
    $data['date'] = date('Y-m-d');
    $data['time'] = date('H:i:s');
}
$data['admin_id'] = $admin['id'];

include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/parents.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/toolbar.record.php');
echo '<content>';
echo '<ol class="section-content">';
echo '<li class="select content">';
echo '<form>';
echo '<input type="hidden" name="table" value="'.$table.'">';

if(file_exists($adminpath['persone'].'/samples/fields.'.$type['multitype'].'.php')) include($adminpath['persone'].'/samples/fields.'.$type['multitype'].'.php');
else include($adminpath['global'].'/samples/fields.'.$type['multitype'].'.php');

include($_SERVER['DOCUMENT_ROOT'].'/_admin/samples/generator.php');
echo '</form>';
echo '</li>';
echo '<li class="gallery">';
include($_SERVER['DOCUMENT_ROOT'].'/_admin/edit/this.gallery.php');
echo '</li>';
echo '<li class="comments">';
include($_SERVER['DOCUMENT_ROOT'].'/_admin/edit/this.comments.php');
echo '</li>';
echo '</ol>';
echo '<script>addoneFunc()</script>';
echo '</content>';