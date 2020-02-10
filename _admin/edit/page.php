<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
session_start();
$admin = $_SESSION['admin'];
include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/engine/core/database/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/controllers/adminFns.php');
$table = 'pages';
if($_POST['edit']['id']) { $data = editData("SELECT * FROM $table WHERE id=".$_POST['edit']['id']); }
else { $data['public'] = '0'; $data['parent_id'] = '0'; }
$data['admin_id'] = $admin['id'];

if($data['id'] == '1') unset($fields['view']);
include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/parents.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/toolbar.page.php');
echo '<content>';
echo '<ol class="section-content">';
echo '<li class="select content">';
echo '<form>';
echo '<input type="hidden" name="table" value="'.$table.'">';
include($_SERVER['DOCUMENT_ROOT'].'/_admin/samples/fields.page.php');
include($_SERVER['DOCUMENT_ROOT'].'/_admin/samples/generator.php');
echo '</form>';
echo '</li>';
echo '<li class="gallery">';
include($_SERVER['DOCUMENT_ROOT'].'/_admin/edit/this.gallery.php');
echo '</li>';
echo '</ol>';
echo '<script>addoneFunc()</script>';
echo '</content>';