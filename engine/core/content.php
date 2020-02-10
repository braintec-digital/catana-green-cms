<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
function getContent(){
    
    global $get;

    if($get['site']['city']) $city = ', '.$get['site']['city'];
    elseif($get['city']) $city = ', '.$get['city'];
    else $city = '';

    if($get['find']) $find = $get['word']['search-result'].' ['.$get['find'].'] | ';
    else $find = '';
    if($get['tags']) $find = $get['word']['tag-records'].' ['.$get['tags'].'] | ';
    else $find = '';
    
    if($get['note']) {
        
    }
// Page or Tags
    if($get['page'] && !$get['note']) {
        if(is_numeric($get['page'])) $id = " OR id='".$get['page']."'";
        
        $view = pageData("SELECT * FROM pages WHERE view='".$get['view']."'");
        
        if($view['table_records']) $get['table'] = $view['table_records'];
        else $get['table'] = 'records';
        
        $reco = pageData("SELECT * FROM ".$get['table']." WHERE (url='".$get['page']."'$id) AND view_id=".$view['id']);
        
        if($reco){
            // parent page
            if($reco['note_id']) {
                $podcat = pageData("SELECT * FROM pages WHERE id=".$reco['note_id']);
            }
            if($reco['page_id']) {
                $page = pageData("SELECT * FROM pages WHERE id=".$reco['page_id']);
            }
        }
        else {
            $page = pageData("SELECT * FROM pages WHERE (view='".$get['page']."' AND parent_id='".$view['id']."') AND del=0");
            if(!$page) {
                $page = pageData("SELECT * FROM pages WHERE view='".$get['page']."' AND del=0");
                if(!$page) {
                    $link = mb_convert_encoding($get['page'], 'utf-8', mb_detect_encoding($get['page']));
                    if($get['lang'] == 'ru' || $get['lang'] == 'uk') $tags = backTranslit($get['page']);
                    else $tags = str_replace('-',' ',$get['page']);
                    
                    $page = pageData("SELECT * FROM pages WHERE (tags LIKE '%$link%' OR tags LIKE '%$tags%' ESCAPE '-') AND parent_id='".$view['id']."' AND del=0");
                }
            }
        }
        
        if(!$page && !$reco) return false;

        if(!$reco && ($page['parent_id'] != $view['id'])) {
            $podcat = $page;
            $page = pageData("SELECT * FROM pages WHERE id='".$page['parent_id']."' AND del=0");
        }

        if($reco) {
            // title
            if($reco['seo_title']) $seoTitle = $reco['seo_title'];
            else $seoTitle = $reco['title'];
            // descript
            if($reco['seo_descript']) $seoDescript = $reco['seo_descript'];
            else $seoDescript = $reco['descript'];
        }
        elseif($page) {
            // title
            if($page['seo_title']) $seoTitle = $page['seo_title'];
            else $seoTitle = $page['title'];
            // descript
            if($page['seo_descript']) $seoDescript = $page['seo_descript'];
            else $seoDescript = $page['descript'];
        }
        elseif($view) {
            // title
            if($view['seo_title']) $seoTitle = $view['seo_title'];
            else $seoTitle = $view['title'];
            // descript
            if($view['seo_descript']) $seoDescript = $view['seo_descript'];
            else $seoDescript = $view['descript'];
        }
        if($tags) {
            $tags = mb_convert_case($tags, MB_CASE_TITLE, "UTF-8");
            $seoTitle = $tags.' | '.$view['title'];
            $seoDescript = $tags.' | '.$view['title'];
        }

        $content = [
            'title' => $seoTitle.' | '.$get['site']['title'].$city,
            'descr' => $seoDescript,
            'ogtitle' => $seoTitle.' | '.$get['site']['title'].$city,
            'ogdescription' => $seoDescript,
            'view' => $view,
            'page' => $page,
            'note' => $podcat,
            'record' => $reco,
            'tags' => $tags
        ];
        return $content;
    }

// View + Tags
    if($get['view'] && !$get['page'] && $get['tags']) {
        
        $view = pageData("SELECT * FROM pages WHERE view='".$get['view']."'");

        if($view['table_records']) $get['table'] = $view['table_records'];
        else $get['table'] = 'records';

        if($view['seo_title']) {$seoTitle = $find.$view['seo_title'];}
        else {$seoTitle = $find.$view['title'];}

        if($view['seo_descript']) {$seoDescript = $view['seo_descript'];}
        else {$seoDescript = $view['descript'];}

        $content = [
            'title' => $seoTitle.' | '.$get['site']['title'].$city,
            'descr' => $seoDescript,
            'ogtitle' => $view['title'].' | '.$get['site']['title'].$city,
            'ogdescription' => $view['descript'],
            'view' => $view,
            'page' => '',
            'note' => '',
            'record' => ''
        ];
        return $content;
    }
// View -
    if($get['view'] && !$get['page'] && !$get['tags']) {
        
        $note = pageData("SELECT * FROM records WHERE link='".$get['view']."'");
        $view = pageData("SELECT * FROM pages WHERE view='".$get['view']."' AND del=0");

        if($view['table_records']) $get['table'] = $view['table_records'];
        else $get['table'] = 'records';

        if($note) {
            $fields = pageData("SELECT * FROM records_fields WHERE record_id='".$note['id']."'");
            $content = pageData("SELECT * FROM records_content WHERE record_id='".$note['id']."'");
            if($fields){
                unset($fields['id']);
                unset($fields['record_id']);
                $note = array_merge($recordNote, $fields);
            }
            if($content){
                unset($content['id']);
                unset($content['record_id']);
                $note = array_merge($recordNote, $fields);
            }
            // parent page
            if($note['note_id']) {
                $podcat = pageData("SELECT * FROM pages WHERE id=".$note['note_id']);
            }
            if($note['page_id']) {
                $page = pageData("SELECT * FROM pages WHERE id=".$note['page_id']);
            }
            if($note['view_id']) {
                $view = pageData("SELECT * FROM pages WHERE id=".$note['view_id']);
            }

            if($note) {
                // content
                if($note['seo_title']) $seoTitle = $note['seo_title'].' | '.$view['title'];
                else $seoTitle = $note['title'].' | '.$view['title'];
                // descript
                if($note['seo_descript']) $seoDescript = $note['seo_descript'];
                else $seoDescript = $note['descript'];
            }
            elseif($view) {
                // content
                if($view['seo_title']) $seoTitle = $view['seo_title'];
                else $seoTitle = $view['title'];
                // descript
                if($view['seo_descript']) $seoDescript = $view['seo_descript'];
                else $seoDescript = $view['descript'];
            }
            
            $content = array(
                'title' => $seoTitle.' | '.$get['site']['title'].$city,
                'descr' => $seoDescript,
                'ogtitle' => $note['title'].' | '.$get['site']['title'].$city,
                'ogdescription' => $note['descript'],
                'view' => $view,
                'page' => $page,
                'note' => $podcat,
                'record' => $note
            );
            return $content;
        }

        if($view) {
            if($view['login'] && !$get['user'] && !$get['admin']) return false;
            else {
                if($get['find']) $find = $get['word']['search-result'].' ['.$get['find'].'] | ';
                else $find = '';
                
                if($view['seo_title']) {$seoTitle = $find.$view['seo_title'];}
                else {$seoTitle = $find.$view['title'];}

                if($view['seo_descript']) {$seoDescript = $view['seo_descript'];}
                else {$seoDescript = $view['descript'];}
                
                $content = [
                    'title' => $seoTitle.' | '.$get['site']['title'].$city,
                    'descr' => $seoDescript,
                    'ogtitle' => $view['title'].' | '.$get['site']['title'].$city,
                    'ogdescription' => $view['descript'],
                    'view' => $view
                ];
            }
            return $content;
        }
        // error 404
        if($get['view'] && !$content) return false;
    }
// Main -
    if(!$get['view'] || $get['view'] == '') {
        
        $view = pageData("SELECT * FROM pages WHERE view='' AND del=0");
        
        if($view['seo_title']) {$seoTitle = $view['seo_title'];}
        else {$seoTitle = $view['title'];}

        if($view['seo_descript']) {$seoDescript = $view['seo_descript'];}
        else {$seoDescript = $view['descript'];}

        $content = [
            'title' => $seoTitle.' | '.$get['site']['title'].' '.$get['site']['city'],
            'descr' => $seoDescript,
            'ogtitle' => $view['title'].' | '.$get['site']['title'].' '.$get['site']['city'],
            'ogdescription' => $view['descript'],
            'view' => $view
        ];
        
        return $content;
    }
}

$content = getContent();

if($content) {
    if($content['tags']) {
        $get['page'] = $content['page']['view'];
        $get['tags'] = $content['tags'];
    }
    if($content['note'] && !$content['note']['public']) {
        $get['tags'] = backTranslit($get['page']);
    }
    if($content['view']) $get['view'] = $content['view']['view'];
    if($content['page']) $get['page'] = $content['page']['view'];
    // $get['note'] = $content['note']['view'];
    $get['viewid'] = $content['view']['id'];
    $get['pageid'] = $content['page']['id'];
    $get['noteid'] = $content['note']['id'];
    if($get['view'] != '') {
        $get['multitype'] = $content['view']['multitype'];
    }
    
    if($get['link'] == '/') $pagelink = '-main';
    else $pagelink = $get['link'];
    $get['cache'] = str_replace('.','-',$get['www']).str_replace('/','-',$pagelink).'.html';

    // формируем OG параметры
    if($content['view']) {
        if($content['view']['img']) $get['img'] = $get['root'].'/'.$get['filepath'].$content['view']['img'];
        $SeoH1 = $content['view']['title'];
    }
    if($content['page']) {
        if($content['page']['img']) $get['img'] = $get['root'].'/'.$get['filepath'].$content['page']['img'];
        $SeoH1 = $content['page']['title'];
    }
    if($content['note']) {
        if($content['note']['img']) $get['img'] = $get['root'].'/'.$get['filepath'].$content['note']['img'];
        $SeoH1 = $content['note']['title'];
    }
    if($content['record']) {
        if($content['record']['img']){
            $get['img'] = $get['root'].'/'.$get['filepath'].$content['record']['img'];
            $SeoH1 = $content['record']['title'];
        }
        elseif(!$content['record']['img'] && $content['record']['video']) {
            $get['img'] = "https://img.youtube.com/vi/".$content['record']['video']."/mqdefault.jpg";
            $SeoH1 = $content['record']['title'];
        }
    }
    if($get['img'] == '') {$get['img'] = $get['root'].'/'.$get['filepath'].'ogImg.png';}

    // Check on Opens Parent Page
    if($get['view'] && !$get['page'] && !$get['tags'] && !$get['find'] && !$get['date'] && !$get['city']){
        if(!$content['view']['view_act']) {
            if($get['langSet']['main']) header('Location: '.$serv.$base, true, 301);
            else header('Location: '.$serv.$base.'/'.$get['lang'], true, 301);
        }
    }
    $meta = [
        'lang' => $get['lang'],
        'base' => $serv.$base,
        'device' => $get['device'],
        'title' => $content['title'],
        'descript' => $content['descr'],
        'img' => $get['img'],
        'site' => $get['root'],
        'url' => $serv.$get['link'],
        'canonical' => $get['canonical'],
        'favicon' => $get['tpl']['favicon'],
        'appicon' => $get['tpl']['appicon']
    ];
}
else { // 404
    $htmlpage = file_get_contents($_SERVER['DOCUMENT_ROOT']."/views/404.html");
    header("HTTP/1.0 404 Not Found");
    $meta = [
        'lang' => $get['lang'],
        'base' => $serv.$base,
        'device' => $get['device'],
        'title' => '404',
        'descript' => 'Page Not Found',
        'img' => '',
        'site' => $get['root'],
        'url' => $serv.$get['link'],
        'canonical' => $get['canonical'],
        'favicon' => $get['tpl']['favicon'],
        'appicon' => $get['tpl']['appicon']
    ];
}