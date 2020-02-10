<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$sql = "SELECT parent_id,view,menu,icon FROM pages WHERE parent_id=".$get['viewid']." AND (public='1' AND del='0') ORDER BY num ASC";
$records = getData($sql);
$table = 'pages';