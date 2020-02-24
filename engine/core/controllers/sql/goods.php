<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$sql = "SELECT url,title,descript,price,price_old,quant,param,img FROM records WHERE (public=1 AND del=0) ORDER BY date DESC, time DESC, num ASC";