<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$sql = "SELECT * FROM record_comments WHERE page_id='".$content['record']['page_id']."' AND record_id='".$content['record']['id']."' ORDER BY id DESC LIMIT 30";
$records = getData($sql);