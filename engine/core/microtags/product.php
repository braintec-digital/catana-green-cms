<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if($content['record']['price'] == '0.00') $ogprice = number_format($content['record']['price_old'], 2, '.', '');
else $ogprice = number_format($content['record']['price'], 2, '.', '');

if($content['record']['brand']) $brand = $content['record']['brand'];
else $brand = $get['site']['title'];

echo '<div itemscope itemtype="https://schema.org/Product">';
echo '<meta itemprop="name" content="'.$itemtitle.'"/>';
echo '<meta itemprop="sku" content="'.$content['record']['art'].'">';
echo '<meta itemprop="description" content="'.$itemdescript.'"/>';
echo '<meta itemprop="image" content="'.$content['record']['img'].'"/>';
echo '<meta itemprop="url" content="'.$get['link'].'"/>';

echo '<div itemprop="brand" itemscope itemtype="https://schema.org/Brand">';
echo '<meta itemprop="name" content="'.$brand.'"/>';
echo '</div>';

echo '<div itemprop="offers" itemscope itemtype="https://schema.org/Offer">';
echo '<meta itemprop="price" content="'.$ogprice.'"/>';
echo '<meta itemprop="priceCurrency" content="'.$get['site']['pay_set'][1].'"/>';
echo '<link itemprop="availability" href="http://schema.org/InStock">';
echo '<meta itemprop="url" content="'.$get['link'].'"/>';
echo '<meta itemprop="description" content="'.$itemdescript.'"/>';
echo '<meta itemprop="availability" content="'.$availability[$get['lang']].'"/>';
echo '<meta itemprop="priceValidUntil" content="'.$priceValidUntil.'"/>';

echo '</div>';
echo '</div>';