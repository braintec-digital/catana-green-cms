<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if($table == 'pages') $root = getData("SELECT id,menu FROM pages WHERE parent_id='0' ORDER BY num ASC");
elseif($list == 'records' || $table == 'records') $root = getData("SELECT id,menu FROM pages WHERE parent_id=".$_POST['edit']['id']." ORDER BY num ASC");
else $root = getData("SELECT id,menu FROM pages WHERE parent_id='0' AND multitype!='' ORDER BY num ASC");

$actual = pageData("SELECT menu FROM pages WHERE id=".$_POST['edit']['id']);
if(!$actual) $actual['menu'] = 'Root Menu';

$service = '<li class="service">
<i type="del=1" class="mdi mdi-delete fs-4x"></i>
<i type="public=0" class="mdi mdi-eye-off fs-4x"></i>
<i type="public=1" class="mdi mdi-eye-outline fs-4x"></i>
<i type="comments=0" class="mdi mdi-comment-remove-outline fs-4x"></i>
<i type="comments!=0" class="mdi mdi-comment-check-outline fs-4x"></i>
</li>';

$parents  = '<div class="parents-menu" table="'.$table.'" view="'.$_POST['edit']['id'].'" list="'.$list.'">';
$parents .= '<div>';
$parents .= '<i class="mdi mdi-sort-variant fs-5x"></i>';
$parents .= '<span>'.$actual['menu'].'</span>';
$parents .= '</div>';
if($root && ($table == 'pages' && $_POST['edit']['id'] != '1')) {
    $parents .= '<ul>';
    foreach($root as $view) {
        if($view['id'] != $_POST['edit']['id']) {
            $childs = getData("SELECT id,menu FROM pages WHERE parent_id=".$view['id']);
            if($childs) {
                $i = '<i class="next mdi mdi-chevron-right fs-3x"></i>';
                $second = '<ul>';
                foreach($childs as $page) {
                    $second .= '<li parent="'.$page['id'].'"><div><span>'.$page['menu'].'</span></div></li>';
                }
                $second .= '</ul>';
            }
            else {
                $i = '';
                $second = '';
            }
            $parents .= '<li parent="'.$view['id'].'"><div><span>'.$view['menu'].'</span>'.$i.'</div>'.$second.'</li>';
        }
    }
    $parents .= '<li parent="0" class="root"><div><i class="mdi mdi-menu fs-3x"></i><span>Root Menu</span></div></li>';
    $parents .= '</ul>';
}
if($root && $table == 'records') {
    $parents .= '<ul>';
    foreach($root as $view) {
        $childs = getData("SELECT id,menu FROM pages WHERE parent_id=".$view['id']);
        if($childs) {
            $i = '<i class="next mdi mdi-chevron-right fs-3x"></i>';
            $second = '<ul>';
            foreach($childs as $page) {
                $second .= '<li note="'.$page['id'].'"><div><span>'.$page['menu'].'</span></div></li>';
            }
            $second .= '</ul>';
        }
        else {
            $i = '';
            $second = '';
        }
        $parents .= '<li page="'.$view['id'].'"><div><span>'.$view['menu'].'</span>'.$i.'</div>'.$second.'</li>';
    }
    if($list) {
        $parents .= '<li view="0" class="root"><div><i class="mdi mdi-menu fs-3x"></i><span>'.$actual['menu'].'</span></div></li>';
        $parents .= $service;
    }
    else $parents .= '<li view="'.$_POST['edit']['id'].'" class="root"><div><i class="mdi mdi-menu fs-3x"></i><span>'.$actual['menu'].'</span></div></li>';
    $parents .= '</ul>';
}
elseif($list) {
    $parents .= '<ul>'.$service.'</ul>';
}
$parents .= '</div>';