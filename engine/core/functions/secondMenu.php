<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function SecondMenu($get) {
    $pageId = $get['viewid'];
    if($get['user']) { $secondMenu = getData("SELECT id,parent_id,view,menu,tags,icon,outlink FROM pages WHERE parent_id='$pageId' AND (public=1 AND del=0) ORDER BY num"); }
    else { $secondMenu = getData("SELECT id,parent_id,view,menu,tags,icon,outlink FROM pages WHERE parent_id='$pageId' AND (public=1 AND del=0) AND login=0 ORDER BY num"); }
    
    if($secondMenu) {
        $menu = "";
        foreach ($secondMenu as $second) {
            if($second['outlink']) $second['view'] = $second['outlink'];
            if($second['tags']) {
                $tags = $second['tags'];
                if($tags) {
                    $tags = explode(',',$tags);
                    $tagmenu = '<tags><i class="mdi mdi-tag-text-outline fs-3x"></i><ol>';
                    foreach ($tags as $tag) {
                        if(!empty(trim($tag))){
                            $tag = trim($tag);
                            if(preg_match("/[а-я]/i", $tag)) $taglink = '§'.str_replace(' ','_',translit($tag,''));
                            else $taglink = str_replace(' ','_',$tag);
                            $tagmenu .= '<li><a href="'.$get['langUrl'].$get['view']."/".$get['tagset'].$taglink.$get['locate'].'">'.$tag.'</a></li>';
                        }
                    }
                    $tagmenu .= '</ol></tags>';
                }
            }
            else {
                $tags = '';
            }

            if($second['icon'] && !stristr($second['icon'],'.')) {
                $icon = '<ico><i class="mdi '.$second['icon'].' fs-3x"></i></ico>';
            } else {
                $icon = '';
            }

            if($second['view'] == $get['page']) {
                $active = " class='active'";
                $open = " class='open parent'";
            }
            else {
                $active = '';
                $open = " class='parent'";
            }

            if($second['view'] == $page) $active = "class='active'"; else $active = '';
            $cat = $second['id'];

            if($get['multitype'] == 'jobs' || $get['multitype'] == 'news'){
                $count = countRows("SELECT id FROM ".$get['table']." WHERE (cat_id='$cat') AND (public=1 AND del=0) AND (`fin_date`>='".$get['today']."' OR `fin_date` IS NULL OR `fin_date`='0000-00-00')");
            }
            if($second['outlink']) {
                $count = '#';
            }
            else {
                $count = countRows("SELECT id FROM ".$get['table']." WHERE (cat_id='$cat') AND (public=1 AND del=0)");
            }
            // $count = countRows("SELECT id FROM ".$get['table']." WHERE (cat_id='$cat') AND (public=1 AND del=0)");
            
            $parent = $second['id'];
            if($get['user']) { $children = getData("SELECT id,view,menu,tags,outlink FROM pages WHERE parent_id='$parent' AND (public=1 AND del=0) ORDER BY num"); }
            else { $children = getData("SELECT id,view,menu,tags,outlink FROM pages WHERE parent_id='$parent' AND (public=1 AND del=0) AND login=0 ORDER BY num"); }

            if($children) {
                $icon = '<ico><i class="mdi mdi-dots-vertical fs-4x"></i></ico>';
                $menu .= "<li".$open.">".$icon."<a ".$active." href='".$get['langUrl'].$get['view']."/".$second['view'].$get['locate']."'>".$second['menu']."<span>".$count."</span></a>".$tagmenu;
                    $menu .= "<ul>";
                    foreach ($children as $item) {
                        if($item['tags']) {
                            $ctags = $item['tags'];
                            if($ctags) {
                                $ctags = explode(',',$ctags);
                                $ctagmenu = '<tags><i class="mdi mdi-tag-text-outline fs-3x"></i><ol>';
                                foreach ($ctags as $tag) {
                                    if(!empty(trim($tag))){
                                        $tag = trim($tag);
                                        if(preg_match("/[а-я]/i", $tag)) $taglink = '§'.str_replace(' ','_',translit($tag,''));
                                        else $taglink = str_replace(' ','_',$tag);
                                        $ctagmenu .= '<li><a href="'.$get['langUrl'].$get['view']."/".$get['tagset'].$taglink.$get['locate'].'">'.$tag.'</a></li>';
                                    }
                                }
                                $ctagmenu .= '</ol></tags>';
                            }
                        }
                        else {
                            $ctagmenu = '';
                        }

                        $cat = $item['id'];
                        $count = countRows("SELECT id FROM ".$get['table']." WHERE (podcat_id='$cat') AND (public=1 AND del=0)");

                        $menu .= "<li><a ".$active." href='".$get['langUrl'].$get['view']."/".$item['view'].$get['locate']."'>".$item['menu']."<span>".$count."</span></a>".$ctagmenu."</li>";
                    }
                    $menu .= "</ul>";
                $menu .= "</li>";
            }
            else {
                $menu .= "<li".$open.">".$icon."<a ".$active." href='".$get['langUrl'].$get['view']."/".$second['view'].$get['locate']."'>".$second['menu']."<span>".$count."</span></a>".$tagmenu."</li>";
            }
            $tagmenu = '';
        }
    }
    return $menu;
}