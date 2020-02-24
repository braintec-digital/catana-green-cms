<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$microtags .= '<div itemscope itemtype="https://schema.org/Article">
<meta itemprop="datePublished" content="'.$content['record']['date'].'">
<meta itemprop="dateModified" content="'.$content['record']['date'].'">
<div itemprop="articleBody">
<meta itemprop="headline" content="'.$itemtitle.'"/>
<meta itemprop="description" content="'.$itemdescript.'"/>
<meta itemprop="url" content="'.$get['link'].'"/>
<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
<meta itemprop="image" content="'.$get['www'].'/'.$content['record']['img'].'"/>
<meta itemprop="url" content="'.$get['link'].'"/>
<meta itemprop="width" content="">
<meta itemprop="height" content="">
</span>
</div>
<span itemprop="author" itemscope itemtype="https://schema.org/Person">
<meta itemprop="name" content="'.$get['site']['title'].'"/>
</span>
<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
<meta itemprop="name" content="'.$get['site']['title'].'"/>
<meta itemprop="address" content="'.$get['site']['addr'].'"/>
<meta itemprop="telephone" content="'.$get['site']['tel'][1].'"/>
<meta itemprop="logo" url="'.$get['www'].'/'.$get['tpl']['logo'].'">
</div>
<div itemprop="mainEntityOfPage" itemscope itemtype="https://schema.org/WebPage">
<meta itemprop="url" content="'.$get['www'].'/'.$get['view'].'"/>
</div>
</div>';