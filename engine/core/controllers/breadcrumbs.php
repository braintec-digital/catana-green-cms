<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
$link = $get['langUrl'];
$i = 1;

$bread = '<ol class="flex" itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$get['root'].'" href="" title="'.$get['word']['breadtitle'].'"><ico><i class="mdi mdi-home-circle fs-4x"></i></ico><span itemprop="name">'.$get['word']['breadtitle'].'</span></a><meta itemprop="position" content="'.$i.'"></li>';

if((($get['user'] || $get['admin'] && $content['view']['login']) || !$content['view']['login'])) {
    if($get['view']) {
        $link = $get['langUrl'].$content['view']['view'].$get['locate'];
        $breadlink = $get['root'].'/'.$link;
        if($content['view']['view_act']) {
            $i++;
            $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" href="'.$link.'" title="'.$content['view']['menu'].'"><span itemprop="name">'.$content['view']['menu'].'</span></a><meta itemprop="position" content="'.$i.'"></li>';
        } else {
            $i++;
            $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" title="'.$content['view']['menu'].'"><span itemprop="name">'.$content['view']['menu'].'</span></a><meta itemprop="position" content="'.$i.'"></li>';
        }
    }
}
if($content['page'] && (($get['user'] || $get['admin'] && $content['page']['login']) || !$content['page']['login'])) {
    $link = $get['langUrl'].$content['view']['view'].'/'.$content['page']['view'].$get['locate'];
    $breadlink = $get['root'].'/'.$link;
    $i++;
    $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" href="'.$link.'" title="'.$content['page']['menu'].'"><span itemprop="name">'.$content['page']['menu'].'</span></a><meta itemprop="position" content="'.$i.'"></li>';
}
if($content['note'] && (($get['user'] || $get['admin'] && $content['note']['login']) || !$content['note']['login'])) {
    $link = $get['langUrl'].$content['view']['view'].'/'.$content['note']['view'].$get['locate'];
    $breadlink = $get['root'].'/'.$link;
    $i++;
    $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" href="'.$link.'" title="'.$content['note']['menu'].'"><span itemprop="name">'.$content['note']['menu'].'</span></a><meta itemprop="position" content="'.$i.'"></li>';
}
if($content['record']) {
    if($content['record']['link']) $link = $content['record']['link'];
    else $link = $get['langUrl'].$content['view']['view'].'/'.$content['record']['url'].$get['locate'];
    $breadlink = $get['root'].'/'.$link;
    $i++;
    $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" href="'.$link.'" title="'.$content['record']['title'].'"><span itemprop="name">'.$content['record']['title'].'</span></a><meta itemprop="position" content="'.$i.'"></li>';
}
if($content['tags']) {
    $link = $get['view'].'/'.translit($content['tags'],'').$get['locate'];
    $breadlink = $get['root'].'/'.$link;
    $tagtext = $content['tags'];
    $i++;
    $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" href="'.$link.'" title="'.$tagtext.'"><span itemprop="name">'.$tagtext.'</span></a><meta itemprop="position" content="'.$i.'"></li>';
}
elseif($get['tags'] && !$content['note']) {
    if(is_array($get['tags'])) {
        $temp = $get['tags'];
        foreach($temp as $item) {
            if(preg_match("/[а-я]/i", $item)) {
                $templink[] = '§'.str_replace(' ','_',translit($item,''));
            }
            else {
                $templink[] = str_replace(' ','_',$item);
            }
            $tagtext[] = mb_convert_case($item, MB_CASE_TITLE, "UTF-8");
        }
        $tagtext = implode('+',$tagtext);
        $link .= '/tag='.implode('+',$templink).$get['locate'];
    }
    else {
        $link .= '/tag='.translit($get['tags'],'').$get['locate'];
        $tagtext = mb_convert_case($get['tags'], MB_CASE_TITLE, "UTF-8");
    }
    $breadlink = $get['root'].'/'.$link;
    $i++;
    $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" href="'.$link.'" title="'.$tagtext.'"><span itemprop="name">'.$tagtext.'</span></a><meta itemprop="position" content="'.$i.'"></li>';
}
if($get['find']) {
    $link .= '/search='.str_replace(' ','_',$get['find']);
    $breadlink = $get['root'].'/'.$link;
    $i++;
    $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" href="'.$link.'" title="'.$get['find'].'"><span itemprop="name"><i class="mdi mdi-magnify fs-3x"></i>'.$get['find'].'</span></a><meta itemprop="position" content="'.$i.'"></li>';
}
if($get['city']) {
    $i++;
    $bread .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" id="'.$breadlink.'" title="'.$get['find'].'"><span itemprop="name"><i class="mdi mdi-map-marker fs-3x"></i>'.$get['city'].'</span></a><meta itemprop="position" content="'.$i.'"></li>';
}
$bread .= '</ol>';

$breadcrumbs = '';