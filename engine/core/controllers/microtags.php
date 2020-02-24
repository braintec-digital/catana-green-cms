<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
if($content['record']['seo_title']) $itemtitle = $content['record']['seo_title'];
else $itemtitle = $content['record']['title'];
if($content['record']['seo_title']) $itemdescript = $content['record']['seo_descript'];
else $itemdescript = $content['record']['descript'];
$ogprice = number_format($content['record']['price'], 2, '.', '');

include($_SERVER['DOCUMENT_ROOT'].'/engine/core/microtags/webpage.php');

echo $googlenav;