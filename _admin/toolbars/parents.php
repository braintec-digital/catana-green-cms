<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if($table == 'pages') $root = getData("SELECT id,menu FROM pages WHERE parent_id='0'");
else $root = getData("SELECT id,menu FROM pages WHERE parent_id='0' AND multitype!=''");

$actual = pageData("SELECT menu FROM pages WHERE id=".$_POST['edit']['id']);
if(!$actual) $actual['menu'] = 'Root Menu';

$parents  = '<div class="parents-menu" table="'.$table.'">';
$parents .= '<div>';
$parents .= '<i class="mdi mdi-sort-variant fs-5x"></i>';
$parents .= '<span>'.$actual['menu'].'</span>';
$parents .= '</div>';
if(($table == 'pages' && $_POST['edit']['id'] != '1') || $table == 'records') {
    $parents .= '<ul>';
    foreach($root as $view) {
        $childs = getData("SELECT id,menu FROM pages WHERE parent_id=".$view['id']);
        if($childs) {
            $i = '<i class="next mdi mdi-chevron-right fs-3x"></i>';
            $second = '<ul>';
            foreach($childs as $page) {
                $second .= '<li page="'.$page['id'].'"><div><span>'.$page['menu'].'</span></div></li>';
            }
            $second .= '</ul>';
        }
        else {
            $i = '';
            $second = '';
        }
        $parents .= '<li view="'.$view['id'].'"><div><span>'.$view['menu'].'</span>'.$i.'</div>'.$second.'</li>';
    }
    if($table == 'pages') $parents .= '<li view="0" class="root"><div><i class="mdi mdi-menu fs-3x"></i><span>Root Menu</span></div></li>';
    $parents .= '</ul>';
}
$parents .= '</div>';