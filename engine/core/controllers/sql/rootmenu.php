<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if($get['user'] || $get['admin']) $checkuser = "";
else $checkuser = " AND login='0'";
$sql = "SELECT view,menu,icon FROM pages WHERE (parent_id='0' AND main='1') AND (public='1' AND del='0'$checkuser) ORDER BY num ASC";
$records = getData($sql);