<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
function Magic(){
    global $code;
    global $get;
    global $content;
    global $blockName;
    global $share;
    global $secondMenu;
    global $bookmarks;

// Langs-Words key change
    $code = str_replace("@langUrl", $get['langUrl'], $code);
    $code = str_replace("@langLink", $get['langLink'], $code);
// Панель авторизированного пользователя или регистрации

    $code = str_replace('@view',$get['view'],$code);
    $code = str_replace('@page',$get['page'],$code);

    $code = str_replace('@year',date('Y'),$code);
    $code = str_replace('@date',date('Y-m-d'),$code);
    $code = str_replace('@time',date('H:i'),$code);

    if(stristr($code,'@breadcrumbs')) {
        include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/breadcrumbs.php");
        $code = str_replace('@breadcrumbs',$bread,$code);
    }

    if($get['type'] == 'URI') {
        include_once($_SERVER['DOCUMENT_ROOT']."/engine/core/functions/primaryMenu.php");
        $code = str_replace("@rootmenu", primaryMenu($get), $code);
    }
    
    $code = str_replace("@socialinks", $share, $code);
    
// Magic Content Convertor
    if($get['view'] == '') $isview = 'main'; else $isview = $get['view'];

    if($get['multitype'] == 'jobs' || $get['multitype'] == 'news'){
        $recount = countRows("SELECT id FROM".$get['table']." WHERE (page_id=".$get['viewid'].") AND (public=1 AND del=0) AND (`fin_date`>='".$get['today']."' OR `fin_date` IS NULL OR `fin_date`='0000-00-00')");
    } else {
        $recount = countRows("SELECT id FROM ".$get['table']." WHERE (page_id=".$get['viewid'].") AND (public=1 AND del=0)");
    }
    $code = str_replace("@recount", $recount, $code);

    $code = str_replace("@site->root", $get['root'], $code);
    $code = str_replace("@site->search", $get['site']['main_search'], $code);
    $code = str_replace("@site->mail", $get['site']['mail'][0], $code);

    foreach($get['site'] as $key => $val) {
        if(!is_array($val)) $code = str_replace("@site->".$key, $val, $code);
    }
    foreach($get['word'] as $key => $val) {
        $code = str_replace("@word->".$key, $val, $code);
    }

    $html = new simple_html_dom();
    $html = str_get_html($code);

    if($get['type'] == 'URI' || $get['type'] == 'GET') {
        // PROFILE only user_id isset
        if($html->find('[profile]')) {
            foreach($html->find('[profile]') as $profile){
                if(!$content['record']['user_id']) {
                    $profile->outertext = '';
                } else {
                    $profile->notme = null;
                }
            }
        }
        // NOT My Account
        if($html->find('[notme]')) {
            foreach($html->find('[notme]') as $notme){
                if($content['record']['user_id'] == $get['user']['id']) {
                    $notme->outertext = '';
                } else {
                    $notme->notme = null;
                }
            }
        }
        // FOR My Account only
        if($html->find('[forme]')) {
            foreach($html->find('[forme]') as $forme){
                if($content['record']['user_id'] != $get['user']['id']) {
                    $forme->outertext = '';
                } else {
                    $forme->forme = null;
                }
            }
        }
        // FOR Login User
        if($html->find('[login]')) {
            foreach($html->find('[login]') as $login){
                if(!$get['user']['id']) {
                    $login->outertext = '';
                } else {
                    $login->forme = null;
                }
            }
        }
        // DATA check
        if($html->find('[data_check]')) {
            foreach($html->find('[data_check]') as $check){
                if($check->data_check == '') {
                    $check->outertext = '';
                }
                else {
                    $type = $check->data_check;
                    if($type == 'content') {
                        foreach($html->find('[data_check=content] *') as $tag){
                            if(!$tag->innertext) $tag->outertext = '';
                        }
                    }
                    if($type == 'href' || $type == 'src') {
                        foreach($html->find('[data_check] ['.$type.']') as $attr){
                            if(!$attr->$type) $attr->outertext = '';
                            $attr->check = null;
                        }
                    }
                    $check->data_check = null;
                }
            }
        }
        // Array Convertor
        if($html->find('[array]')) {
            foreach($html->find('[array]') as $item){
                $select = explode(':',$item->array);
                $item->array = null;
                $template = $item->innertext;
                $item->innertext = '';
                if(stristr($select[1],'->')) {
                    $select[1] = explode('->',$select[1]);
                    if($select[0] == 'pages') $array = pageData("SELECT ".$select[1][1]." FROM ".$select[0]." WHERE view='".$select[1][0]."'");
                    if($select[0] == 'records') $array = pageData("SELECT ".$select[1][1]." FROM ".$select[0]." WHERE url='".$select[1][0]."'");
                    $array = $array[$select[1][1]];
                    $i = 1;
                    if(is_array($array)) {
                        foreach($array as $val) {
                            $item->innertext .= str_replace('@arr->item',$val,$template);
                            $i++;
                        }
                    }
                    else {
                        $item->outertext = '';
                    }
                }
                else {
                    if($select[0] == 'general') {
                        foreach($get['site'][$select[1]] as $key => $val) {
                            if($select[1] == 'tel') {
                                $cleartel = array(" ","-","(",")","[","]");
                                $tel = str_replace($cleartel, '', $val);
                                $row = str_replace("@site->tel", $val, $template);
                                $row = str_replace("@site->call", $tel, $row);
                            }
                            if($select[1] == 'social') {
                                $row = str_replace("@site->social-name", $key, $template);
                                $row = str_replace("@site->social", $val, $row);
                            }
                            $item->innertext .= $row;
                        }
                    }
                    if($select[0] == 'records') {
                        $array = $content['record'][$select[1]];
                        if(is_array($array)) {
                            foreach($array as $val) {
                                $item->innertext .= str_replace('@arr->item',$val,$template);
                            }
                        }
                        else {
                            $item->outertext = '';
                        }
                    }
                    if($select[0] == 'pages') {
                        if($content['note'][$select[1]]) $array = $content['note'][$select[1]];
                        elseif($content['page'][$select[1]]) $array = $content['page'][$select[1]];
                        elseif($content['view'][$select[1]]) $array = $content['view'][$select[1]];
                        if(is_array($array)) {
                            foreach($array as $val) {
                                $item->innertext .= str_replace('@arr->item',$val,$template);
                            }
                        }
                        else {
                            $item->outertext = '';
                        }
                    }
                }
            }
        }
        // Check For pages
        if($html->find('[for]')) {
            foreach($html->find('[for]') as $item){
                $for = $item->for;
                $item->for = null;
                if($for) {
                    $for = explode(',',$for);
                    if(!in_array($isview,$for) && !in_array($get['page'],$for) && !in_array($get['www'],$for)) {
                        $item->outertext = '';
                    }
                }
            }
        }
        // Check Not pages
        if($html->find('[not]')) {
            foreach($html->find('[not]') as $item){
                $not = $item->not;
                $item->not = null;
                if($not) {
                    $not = explode(',',$not);
                    if(in_array($isview,$not) || in_array($get['page'],$not) || in_array($get['www'],$not)) {
                        $item->outertext = '';
                    }
                }
            }
        }
        // Check For device
        if($html->find('[device]')) {
            foreach($html->find('[device]') as $item){
                $device = $item->device;
                $item->device = null;
                if($device != $get['device']) {
                    $item->outertext = '';
                }
            }
        }
        // Records
        if($html->find('[getrecords]')) {
            foreach($html->find('[getrecords]') as $item){
                $sel = $item->getrecords;
                $div = $item->innertext;
                $item->getrecords = null;
                $item->innertext = '';
                $parent = pageData("SELECT id FROM pages WHERE view='$sel'");
                $data = getData("SELECT * FROM records WHERE view_id=".$parent['id']." ORDER BY num ASC, date DESC");
                $i = 1;
                foreach($data as $row) {
                    $line = $div;
                    foreach($row as $key => $val) {
                        $line = str_replace('@num',$i,$line);
                        $line = str_replace('@record->'.$key,$val,$line);
                        $i++;
                    }
                    $item->innertext .= $line;
                }
            }
        }
        // Get-Page content
        if($html->find('[getpage]')) {
            foreach($html->find('[getpage]') as $item){
                $sel = $item->getpage;
                $item->getpage = null;
                $div = $item->outertext;
                $data = pageData("SELECT * FROM pages WHERE view='$sel'");
                foreach($data as $key => $val) { $div = str_replace('@getpage->'.$key,$val,$div); }
                $item->outertext = $div;
            }
        }
    }
    // Select convertor
    if($html->find('[select]')) {
        foreach($html->find('[select]') as $item) {
            $template = $item->innertext;
            $select = $item->select;
            $add = $item->add;
            $item->add = null;
            $item->select = null;

            include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql.php");
            
            // First children as Item
            $row = $item->firstChild();
            $item->innertext = '';
            
            if($item->id == 'more') {
                $cols = $item->cols;
                if($limits == 0 || $found == 0 || $found < $limits) {
                    foreach($html->find('more') as $more){
                        $more->outertext = '';
                    }
                } else {
                    // for emty select
                }
                $genegal = true;
            } else {
                $genegal = false;
            }

            if($records){
                include_once($_SERVER['DOCUMENT_ROOT']."/engine/core/functions/translit.php");
                $num = 1;
                $order = 0;
                foreach($records as $record) {
                    if($record) {
                        $line = $row->outertext; // convert object to sting
                        include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/magic-records.php");
                        
                        $item->innertext .= $line;
                        $item->removeAttribute('select');
                        $num++;
                        $order++;
                    }
                }
            }
            else {
                if($get['find']) {
                    $nofound = $row->outertext;
                    include($_SERVER['DOCUMENT_ROOT']."/engine/core/NotFound.php");
                    $item->innertext .= $nofound;
                } else {
                    $item->innertext = '';
                }
            }
        }
    }
    return $html;
}