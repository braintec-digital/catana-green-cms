<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$sql = "SELECT * FROM record_img WHERE (page_id='".$content['record']['page_id']."' OR page_id='0') AND record_id='".$content['record']['id']."' ORDER BY num ASC";
$records = getData($sql);