<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$microtags .= '<div itemscope itemtype="https://schema.org/Organization">
<meta itemprop="name" content="'.$get['site']['title'].'">
<meta itemprop="logo" content="'.$get['www'].'/'.$get['tpl']['logo'].'">
<meta itemprop="image" content="'.$get['www'].'/'.$get['tpl']['img'].'">
<meta itemprop="url" content="'.$get['www'].'">
<div itemprop="location" itemscope itemtype="https://schema.org/Place">
<meta itemprop="telephone" content="'.$get['site']['tel'][0].'"/>
<meta itemprop="telephone" content="'.$get['site']['tel'][1].'"/>
<meta itemprop="telephone" content="'.$get['site']['tel'][2].'"/>
<span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
<meta itemprop="streetAddress" content="'.$get['site']['addr'].'">
<meta itemprop="postalCode" content="'.$get['site']['zip'].'">
<meta itemprop="addressLocality" content="'.$get['site']['city'].'">
<meta itemprop="email" content="'.$get['site']['mail'][0].'">
</span></div></div>';