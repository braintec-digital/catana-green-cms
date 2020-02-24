<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$microtags = '<div itemscope itemtype="https://schema.org/WebSite">';
$microtags .= '<meta itemprop="url" content="'.$get['www'].'"/>';
$microtags .= '<meta itemprop="name" content="'.$get['site']['title'].'">';

$microtags .= '<div itemscope itemtype="https://schema.org/WebPage">';
$microtags .= '<meta itemprop="url" content="'.$get['www'].'/'.$get['view'].'"/>';
$microtags .= '<meta itemprop="name" content="'.$content['title'].'">';

include($_SERVER['DOCUMENT_ROOT'].'/engine/core/microtags/organization.php');

if($content['record']) {
    $product = ['shop','shoes','real','products','food','jobs','avto','notice'];
    $article = ['news','short','video','info','pros','services','portfolio'];

    $priceValidUntil = date("Y-m-d", time()+60*60*24*7);

    if($content['record']['seo_title']) $itemtitle = $content['record']['seo_title'];
    else $itemtitle = $content['record']['title'];
    if($content['record']['seo_descript']) $itemdescript = $content['record']['seo_descript'];
    else $itemdescript = $content['record']['descript'];

    if(in_array($content['view']['multitype'],$product)) {
        include($_SERVER['DOCUMENT_ROOT'].'/engine/core/microtags/product.php');
    }
    if(in_array($content['view']['multitype'],$article)) {
        include($_SERVER['DOCUMENT_ROOT'].'/engine/core/microtags/article.php');
    }
}
// include($_SERVER['DOCUMENT_ROOT'].'/engine/core/controllers/breadcrumbs.php');

$microtags .= '</div>';
$microtags .= '</div>';