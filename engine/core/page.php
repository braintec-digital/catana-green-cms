<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
if($content) {
    if($get['view'] && $get['tpl']['breadcrumbs']) {
        include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/breadcrumbs.php");
        $htmlpage = '<section id="breadcrumbs" class="notmodal">'.$bread.'</section>';
    }
    
    if($content['note']) $page = $content['note'];
    elseif($content['page']) $page = $content['page'];
    else $page = $content['view'];
    $record = $content['record'];
    if($record) include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/magic-record.php");

    $share = htmlspecialchars_decode($get['site']['share'], ENT_QUOTES);
    // SecondMenu
    include($_SERVER['DOCUMENT_ROOT']."/engine/core/functions/secondMenu.php");
    $secondMenu = SecondMenu($get);
    // Generate Page
    $cssBlocks = '<style>';
    $jsBlocks = '<script>';
    $i = 1;
    foreach ($blocks as $block) {
        $blockPath = $_SERVER['DOCUMENT_ROOT'].'/'.$get['tpl']['blocks'].'/'.$block.'/'.$block;
        if($block && file_exists($blockPath.'.'.$get['tpl']['blockType'])) {
            $pagecontents = file_get_contents($blockPath.'.'.$get['tpl']['blockType']);
        
            if(file_exists($blockPath.'.css')) {
                $cssBlocks .= file_get_contents($blockPath.'.css');
                
                foreach($get['tpl']['colors'] as $key => $val){
                    $cssBlocks = str_replace($key,$val, $cssBlocks);
                }
                $cssBlocks = str_replace('fontText', $get['tpl']['fontText'], $cssBlocks);
                $cssBlocks = str_replace('fontHead', $get['tpl']['fontHead'], $cssBlocks);
                $cssBlocks = str_replace('fontAlt', $get['tpl']['fontAlt'], $cssBlocks);
                $cssBlocks = str_replace('.blockName', '.'.$block, $cssBlocks);
            }
            if(file_exists($blockPath.'.js')) {
                $jsBlocks .= file_get_contents($blockPath.'.js');
            }
        
            $pagecontents = explode('@blade',$pagecontents);
            if(count($pagecontents) > 1) {
                if(!$record) { $pagecontents = $pagecontents[0]; }
                else { $pagecontents = $pagecontents[1]; }
            }
            else { $pagecontents = $pagecontents[0]; }

            $pagecontents = str_replace("@blockName", $block, $pagecontents);
            $pagecontents = str_replace("@secondmenu", $secondMenu, $pagecontents);
            $pagecontents = str_replace("@placeholder", $get['tpl']['placeholder'], $pagecontents);

            foreach($page as $key => $val) {
                $pagecontents = str_replace("@page->".$key, $val, $pagecontents);
            }
            if($record) {
                foreach($record as $key => $val) {
                    $pagecontents = str_replace("@record->".$key, $val, $pagecontents);
                }
            }
            // $code = Magic();
        }
        else {
            $pagecontents = '<section><h1 style="background: red; color: #fff; padding: 15px;">Block [<b>'.$block.'.'.$get['tpl']['blockType'].'</b>] Not Found!</h1></section>';
        }

        if($record && ($block == 'PageContent' || $block == 'SeoContent')) {
            // if PageContent or SeoContent
        } else {
            $htmlpage .= $pagecontents;
        }
    $i++;
    }

    $cssBlocks .= '</style>';
    $jsBlocks .= '</script>';

    $htmlpage .= $cssBlocks;
    $htmlpage .= $jsBlocks;
}