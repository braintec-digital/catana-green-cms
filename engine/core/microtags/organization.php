<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
echo '<div itemscope itemtype="https://schema.org/Organization">';
echo '<meta itemprop="name" content="'.$get['site']['title'].'">';
echo '<meta itemprop="logo" content="'.$get['root'].'/userfiles/">';
echo '<meta itemprop="image" content="userfiles/ogImg.png">';
echo '<meta itemprop="url" content="'.$get['root'].'">';
echo '<meta itemprop="sameAs" href="https:'.$get['site']['social'][0].'"/>';
echo '<meta itemprop="sameAs" href="https:'.$get['site']['social'][1].'"/>';
echo '<meta itemprop="sameAs" href="https:'.$get['site']['social'][2].'"/>';
echo '<div itemprop="location" itemscope itemtype="https://schema.org/Place">';
echo '<meta itemprop="telephone" content="'.$get['site']['tel'][0].'"/>';
echo '<meta itemprop="telephone" content="'.$get['site']['tel'][1].'"/>';
echo '<meta itemprop="telephone" content="'.$get['site']['tel'][2].'"/>';
echo '<span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">';
echo '<meta itemprop="streetAddress" content="'.$get['site']['addr'].'">';
echo '<meta itemprop="postalCode" content="'.$get['site']['zip'].'">';
echo '<meta itemprop="addressLocality" content="'.$get['site']['city'].'">';
echo '<meta itemprop="email" content="'.$get['site']['mail'][0].'">';
echo '</span></div></div>';