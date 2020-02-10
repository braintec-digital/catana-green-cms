<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function primaryMenu($get){
    if($get['user'] || $get['admin']) { $nav = getData("SELECT id,view,view_act,menu,outlink FROM pages WHERE public=1 AND main=1 AND parent_id=0 AND del=0 ORDER BY num"); }
    else { $nav = getData("SELECT id,view,view_act,menu,outlink FROM pages WHERE public=1 AND main=1 AND parent_id=0 AND del=0 AND login=0 ORDER BY num"); }

    $primaryMenu = '';
    foreach ($nav as $item) {        
        if($item['view'] == $get['view']) $active = ' class="active"'; else $active = ' ';
        if($item['view_act']) $href = ' href="'.$get['langUrl'].$item['view'].$get['locate'].'"'; else $href = '';
        if($item['outlink'] != '') $href = ' href="'.$item['outlink'].'"';
        if($item['view']) $class = ' class="'.$item['view'].'"';
        else $class = '';
        $primaryMenu .= '<li'.$class.'><a'.$active.$href.'>'.$item['menu'].'</a>';
        $id = $item['id']; $url = $item['view']; $act = $item['view_act']; $primaryMenu .= checkParen($id,$url,$act,$get,$get['admin']);
        $primaryMenu .= '</li>';
    }
    if($get['admin']) {
        $primaryMenu .= '<li id="addNewPage" help="Добавить новую страницу"><a class="admin"><i class="mdi mdi-plus fs-5x"></i></a></li>';
    }
    return $primaryMenu;
}
// Children Menu
function checkParen($id,$url,$act,$get) {
    if($get['user'] || $get['admin']) { $secondlist = getData("SELECT id,view,view_act,menu,outlink FROM pages WHERE parent_id='$id' AND (main=1 AND public=1 AND del=0) ORDER BY num"); }
    else { $secondlist = getData("SELECT id,view,view_act,menu,outlink FROM pages WHERE parent_id='$id' AND (main=1 AND public=1 AND del=0 AND login=0) ORDER BY num"); }
    if($secondlist) {
        $parentMenu = '<i class="mdi mdi-dots-horizontal"></i><ul class="'.$url.'">';
        foreach ($secondlist as $second) {
            if(!empty($second['icon'])) {$icon = '<i class="'.$second['icon'].'"></i>';}
            else {$icon = '';}
            if(!empty($url)) $parentUrl = $url.'/'; else $parentUrl = '';
            if($second['view'] == $page) $active = ' class="active"'; else $active = ' ';

            if($second['outlink']) $second['view'] = $second['outlink'];

            $parent = $second['id'];
            $children = getData("SELECT id,view,view_act,menu,outlink FROM pages WHERE parent_id='$parent' AND (del=0 AND public=1 AND main=1 AND login=0) ORDER BY num");
            if($children) {
                $parentMenu .= '<li><i class="mdi mdi-dots-vertical"></i><a'.$active.' href="'.$get['langUrl'].$parentUrl.$second['view'].'">'.$second['menu'].'</a>';
                $parentMenu .= '<ul>';
                foreach ($children as $item) {
                    $item = clusterData($item,$get['langSet']);
                    // if($item['outlink']) $item['view'] = $item['outlink'];
                    $parentMenu .= '<li><a'.$active.' href="'.$get['langUrl'].$parentUrl.$item['view'].$get['locate'].'">'.$item['menu'].'</a></li>';
                }
                $parentMenu .= '</ul></li>';
            }
            else {
                $parentMenu .= '<li><a'.$active.' href="'.$get['langUrl'].$parentUrl.$second['view'].'">'.$icon.$second['menu'].'</a></li>';
            }
        }
        $parentMenu .= '</ul>';
    }
    else {$parentMenu = '';}
    return $parentMenu;
}