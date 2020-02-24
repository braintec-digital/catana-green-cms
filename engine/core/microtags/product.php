<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if($content['record']['price'] == '0.00') $ogprice = number_format($content['record']['price_old'], 2, '.', '');
else $ogprice = number_format($content['record']['price'], 2, '.', '');

if($content['record']['brand']) $brand = $content['record']['brand'];
else $brand = $get['site']['title'];

$microtags .= '<div itemscope itemtype="https://schema.org/Product">
<meta itemprop="name" content="'.$itemtitle.'"/>
<meta itemprop="sku" content="'.$content['record']['art'].'">
<meta itemprop="description" content="'.$itemdescript.'"/>
<meta itemprop="image" content="'.$content['record']['img'].'"/>
<meta itemprop="url" content="'.$get['link'].'"/>
<div itemprop="brand" itemscope itemtype="https://schema.org/Brand">
<meta itemprop="name" content="'.$brand.'"/>
</div>
<div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
<meta itemprop="price" content="'.$ogprice.'"/>
<meta itemprop="priceCurrency" content="'.$get['site']['pay_set'][1].'"/>
<link itemprop="availability" href="http://schema.org/InStock">
<meta itemprop="url" content="'.$get['link'].'"/>
<meta itemprop="description" content="'.$itemdescript.'"/>
<meta itemprop="availability" content="'.$availability[$get['lang']].'"/>
<meta itemprop="priceValidUntil" content="'.$priceValidUntil.'"/>
</div>
</div>';