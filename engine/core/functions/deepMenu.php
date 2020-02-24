<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function deepMenu($parent) {
    global $get;
    $pageId = pageData("SELECT id FROM pages WHERE view='$parent'");
    $pageId = $pageId['id'];
    if($get['user']) { $secondMenu = getData("SELECT id,parent_id,view,menu,tags,icon,outlink FROM pages WHERE parent_id='$pageId' AND (public=1 AND del=0) ORDER BY num"); }
    else { $secondMenu = getData("SELECT id,parent_id,view,menu,tags,icon,outlink FROM pages WHERE parent_id='$pageId' AND (public=1 AND del=0) AND login=0 ORDER BY num"); }
    
    if($secondMenu) {
        $menu = "";
        foreach ($secondMenu as $second) {
            if($second['outlink']) $second['view'] = $second['outlink'];

            if($second['icon'] && !stristr($second['icon'],'.')) $icon = '<ico><i class="'.$second['icon'].'"></i></ico>';
            else $icon = '';

            if($second['view'] == $get['page']) {
                $active = " class='active'";
                $open = " class='open parent'";
            }
            else {
                $active = '';
                $open = " class='parent'";
            }

            if($second['view'] == $page) $active = "class='active'";
            else $active = '';
            
            if($get['user']) $children = getData("SELECT id,view,menu,tags,outlink FROM pages WHERE parent_id='".$second['id']."' AND (public=1 AND del=0) ORDER BY num");
            else $children = getData("SELECT id,view,menu,tags,outlink FROM pages WHERE parent_id='".$second['id']."' AND (public=1 AND del=0) AND login=0 ORDER BY num");

            if($children) {
                $icon = '<ico><i class="mdi mdi-dots-vertical fs-4x"></i></ico>';
                $menu .= "<li".$open.">".$icon."<a ".$active." href='".$get['langUrl'].$parent."/".$second['view']."'>".$second['menu']."</a>";
                    $menu .= "<ul>";
                    foreach ($children as $item) {
                        $menu .= "<li><a ".$active." href='".$get['langUrl'].$parent."/".$item['view']."'>".$item['menu']."</a></li>";
                    }
                    $menu .= "</ul>";
                $menu .= "</li>";
            }
            else {
                $menu .= "<li".$open.">".$icon."<a ".$active." href='".$get['langUrl'].$parent."/".$second['view']."'>".$second['menu']."</a></li>";
            }
        }
    }
    return $menu;
}