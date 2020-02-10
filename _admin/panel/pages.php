<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/engine/core/database/connection.php');

$list = getData("SELECT id,public,menu FROM pages WHERE (del!=1 AND parent_id=0)","num ASC");

echo '<li id="" file="page"><div><span class="add-edit">Add New Page</span></div><i class="add-edit mdi mdi-plus-circle fs-3x"></i></li>';
foreach($list as $item) {
    $pages = getData("SELECT id,public,menu FROM pages WHERE (del!=1 AND parent_id=".$item['id'].")","num ASC");
    if($pages) {
        $i = '<i class="next mdi mdi-chevron-right fs-3x"></i>';
        $second = '<ul class="second">';
        foreach($pages as $page) {
            $nexts = getData("SELECT id,public,menu FROM pages WHERE (del!=1 AND parent_id=".$page['id'].")","num ASC");
            if($nexts) {
                $u = '<i class="next mdi mdi-chevron-right fs-3x"></i>';
                $notes = '<ul class="next">';
                foreach($nexts as $next) {
                    if(!$next['public']) {$p = '<i class="mdi mdi-eye-off fs-3x"></i>';} else {$p = '';}
                    $notes .= '<li id="'.$next['id'].'" file="page"><div><span class="add-edit">'.$next['menu'].$p.'</span></div></li>';
                }
                $notes .= '</ul>';
            }
            else {
                $u = ''; $notes = '';
            }
            if(!$page['public']) {$p = '<i class="mdi mdi-eye-off fs-3x"></i>';} else {$p = '';}
            $second .= '<li id="'.$page['id'].'" file="page"><div><span class="add-edit">'.$page['menu'].$p.'</span>'.$u.'</div>'.$notes.'</li>';
        }
        $second .= '</ul>';
    }
    else {
        $i = ''; $second = '';
    }
    if(!$item['public']) {$p = '<i class="mdi mdi-eye-off fs-3x"></i>';} else {$p = '';}
    echo '<li id="'.$item['id'].'" file="page"><div><span class="add-edit">'.$item['menu'].$p.'</span>'.$i.'</div>'.$second.'</li>';
}