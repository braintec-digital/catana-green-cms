<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$tags = explode(',',$record['tags']);
$record['tags'] = '<ol class="tags">';
foreach ($tags as $tag) {
    if(!empty(trim($tag))){
        $tag = trim($tag);
        if(array_key_exists($tag,$get['word'])) {
            $taglink = $tag;
            $tag = $get['word'][$tag];
        }
        else {
            if(preg_match("/[а-я]/i", $tag)) $taglink = '§'.str_replace(' ','_',translit($tag,''));
            else $taglink = str_replace(' ','_',$tag);
        }
        $record['tags'] .= '<li><a href="'.$get['langUrl'].$content['view']['view']."/".$get['tagset'].$taglink.'">'.$tag.'</a></li>';
    }
}
$record['tags'] .= '</ol>';
$tags = '';