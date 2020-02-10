<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
$clearSpace = array("\r\n", "\r", "\n", "\t", "     ", "    ", "   ", "  ");

include($_SERVER['DOCUMENT_ROOT']."/engine/routes.php");

// Template Connection
if(file_exists($get['tpl']['template'])){
    $code = file_get_contents($get['tpl']['template']);
    // Admin Panel
    $admin = '';
    if($get['view'] == $get['tpl']['adminlink'] && !$_SESSION['admin']) {
        $admin = file_get_contents('_admin/login.html');
        $admin = str_replace('@year',date('Y'),$admin);
        $admin .= '<style>'.file_get_contents('_admin/css/login.css').'</style>';
        $admin .= '<script>'.file_get_contents('_admin/js/login.js').'</script>';
        $get['view'] = '';
    }
    if($_SESSION['admin']) {
        $admin = file_get_contents('_admin/admin.html');
        if(!$extantion['MaterialDesign']) $admin .= '<style>'.file_get_contents('assets/fonts/MaterialDesign.css').'</style>';
        $admin .= '<style>'.file_get_contents('_admin/css/admin.css').'</style>';
        if(!stristr($code,'/jquery') && (!$extantion['Jquery'] || !$extantion['Magic+Jquery'])) { $admin .= '<script src="assets/js/jquery-3.3.1.min.js"></script>'; }
        $admin .= '<script>'.file_get_contents('_admin/js/admin.js').'</script>';
    }

    $csscode = '';
    if($extantion['MaterialDesign']) { $csscode .= file_get_contents('assets/fonts/MaterialDesign.css'); unset($extantion['MaterialDesign']); }
    if($extantion['FontAwesome']) { $csscode .= file_get_contents('assets/fonts/FontAwesome.css'); unset($extantion['FontAwesome']); }
    if($extantion['Micons']) { $csscode .= file_get_contents('assets/fonts/Micons.css'); unset($extantion['Micons']); }

    if($extantion['Magic'] || $extantion['Magic+Jquery']) $csscode .= file_get_contents('assets/css/magic.css');
    if($get['tpl']['style']) $csscode .= file_get_contents($get['tpl']['template'].'/style.css');
    $csscode = str_replace('fontText',$get['tpl']['fontText'], $csscode);
    $csscode = str_replace('fontHead',$get['tpl']['fontHead'], $csscode);
    $csscode = str_replace('fontAlt',$get['tpl']['fontAlt'], $csscode);
    // Colors Swap
    foreach($get['tpl']['colors'] as $key => $val){ $csscode = str_replace($key,$val, $csscode); }
    $csscode = '<style>'.$csscode.'</style>';

    // Page Blocks Contents
    if(stristr($code,'@page->contents')) { include($_SERVER['DOCUMENT_ROOT'].'/engine/core/page.php'); $code = str_replace('@page->contents',$htmlpage, $code); }
    // Site Style
    if(stristr($code,'@site->style')) { $code = str_replace('@site->style',$csscode, $code); }
    // Maric Convertor
    $code = Magic();
    // Meta
    foreach($meta as $key => $val) { $code = str_replace("@meta->".$key, $val, $code); }
    // Words
    foreach($get['word'] as $key => $val) { $code = str_replace("@word->".$key, $val, $code); }
    // Extantions
    $ext = '';
    foreach($extantion as $item) { $ext .= $item;}
    $code = str_replace("@site->extantion", $ext, $code);
    // Check Compress Setup
    if($get['tpl']['compress']) $code = str_replace($clearSpace, ' ', $code);
    // Echo Site
    if($_SESSION['admin']) $code = str_replace('@admin', 'admin', $code);
    else $code = str_replace('@admin', '', $code);

    echo $code;
}
else {
    echo 'Temlate [<span style="color: #018e56">'.$get['tpl']['template'].'</span>] Not Found!';
}

echo $admin;