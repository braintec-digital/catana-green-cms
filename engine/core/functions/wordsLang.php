<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function wordsLang($lang){
    if(is_array($lang)) {
        $thelang = $lang['lang'];
        $langwordsSite = getData("SELECT word_key,langs_word FROM langs_words");
        foreach ($langwordsSite as $val) {
            $val['lang'] = explode('⊣key⊢',$val['langs_word']);
            $word[$val['word_key']] = $val['lang'][$lang['id']];
        }
    }
    else {
        $lang = pageData(" SELECT * FROM langs WHERE lang='$lang' ");
        $langwordsSite = getData("SELECT word_key,langs_word FROM langs_words");
        foreach ($langwordsSite as $val) {
            $val['lang'] = explode('⊣key⊢',$val['langs_word']);
            $word[$val['word_key']] = $val['lang'][$lang['id']];
        }
    }
    return $word;
}