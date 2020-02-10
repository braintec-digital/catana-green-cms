<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$stars = ceil($record['rating']/0.5)*0.5;
$record['stars'] = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/views/blocks/_other/Ratings/'.$stars.'.php', true);