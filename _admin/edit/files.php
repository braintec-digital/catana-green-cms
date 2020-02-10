<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/toolbar.files.php');
echo '<content>';
echo '<dir id="files">';
include($_SERVER['DOCUMENT_ROOT']."/_admin/controllers/files/read-folder.php");
echo '</dir>';
echo '</content>';