<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
echo '<div itemscope itemtype="https://schema.org/Article">';
echo '<meta itemprop="datePublished" content="'.$content['record']['date'].'">';
echo '<meta itemprop="dateModified" content="'.$content['record']['date'].'">';
echo '<div itemprop="articleBody">';
echo '<meta itemprop="headline" content="'.$itemtitle.'"/>';
echo '<meta itemprop="description" content="'.$itemdescript.'"/>';
echo '<meta itemprop="url" content="'.$get['link'].'"/>';
echo '<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';
echo '<meta itemprop="image" content="'.$get['root'].'/'.$get['filepath'].$content['record']['img'].'"/>';
echo '<meta itemprop="url" content="'.$get['link'].'"/>';
echo '<meta itemprop="width" content="">';
echo '<meta itemprop="height" content="">';
echo '</span>';
echo '</div>';
echo '<span itemprop="author" itemscope itemtype="https://schema.org/Person">';
echo '<meta itemprop="name" content="'.$get['site']['title'].'"/>';
echo '</span>';
echo '<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">';
echo '<meta itemprop="name" content="'.$get['site']['title'].'"/>';
echo '<meta itemprop="address" content="'.$get['site']['addr'].'"/>';
echo '<meta itemprop="telephone" content="'.$get['site']['tel'][1].'"/>';
echo '<meta itemprop="logo" url="'.$get['root'].'/'.$get['filepath'].$get['tpl']['favicon'].'">';
echo '</div>';
echo '<div itemprop="mainEntityOfPage" itemscope itemtype="https://schema.org/WebPage">';
echo '<meta itemprop="url" content="'.$get['root'].'/'.$get['view'].'"/>';
echo '</div>';
echo '</div>';