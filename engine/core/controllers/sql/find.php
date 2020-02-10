<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$get['find'] = str_replace('amp;','',$get['find']);
function findPrice($find) {
    global $get;
    
    $start = explode('[price',$find)[0];
    $final = explode(']',$find)[1];
    $pricecheck = explode('[price',$find)[1];
    $pricecheck = explode(']',$pricecheck)[0];
    $pricecheck = str_replace(':','',$pricecheck);

    if(stristr($pricecheck, '<')) {
        $pricecheck = str_replace('<','',$pricecheck);
        $percent = 100-$get['site']['pay_set'][3];
        $pricecheck = $pricecheck/$percent*100;
        $pricelike = "price <= ".$pricecheck;
    }
    if(stristr($pricecheck, '>')) {
        $pricecheck = str_replace('>','',$pricecheck);
        $percent = 100-$get['site']['pay_set'][3];
        $pricecheck = $pricecheck/$percent*100;
        $pricelike = "price >= ".$pricecheck;
    }
    if(stristr($pricecheck, '-')) {
        $pricecheck = explode('-',$pricecheck);
        $percent = 100-$get['site']['pay_set'][3];
        $pricecheck[0] = $pricecheck[0]/$percent*100;
        $pricecheck[1] = $pricecheck[1]/$percent*100;
        $pricelike = "price >= ".$pricecheck[0]." AND price <= ".$pricecheck[1];
    }
    return $pricelike;
}

if($get['multitype'] == 'pros') {
    $searchfields = ['title','company','experience','keywords','tags'];

    if(stristr($get['find'], ' ')) { // word AND word
        $string = explode(' ', $get['find']);
        foreach($searchfields as $field){
            foreach($string as $word){
                if(strlen($word) > 3) $like[] = $field." LIKE '%".trim($word)."%'";
            }
            if($field == 'experience' || $field == 'keywords') $set[] = "(".implode(" OR ", $like).")";
            else $set[] = "(".implode(" AND ", $like).")";
            $like = null;
        }
        $multisearch = implode(" OR ", $set);
        $select['find'] = "( ".$multisearch." ) AND";
    }
    else {
        foreach($searchfields as $field){
            $like[] = $field." LIKE '%".$get['find']."%'";
        }
        $like = implode(' OR ',$like);
        $select['find'] = "(".$like.") AND";
    }
}
else {
    $searchfields = ['title','keywords','tags'];

    if($get['find'][0] == '/') {
        $get['find'] = str_replace('/','',$get['find']);
        if(stristr($get['find'], '&')) {
            $finds = explode('&',$get['find']);
            
            foreach($finds as $find) {
                if(stristr($find, '[price')) { // [price<34.99] , [price:34.99-199.00] , [price>44.00]
                    $and[] = "(".findPrice($find).")";
                }
                else {
                    if(stristr($find, '+')) {
                        $s = explode('+',$find);
                        foreach($searchfields as $field) {
                            foreach($s as $w) {
                                $like[] = $field." LIKE '%".trim($w)."%'";
                            }
                            $or[] = "(".implode(' OR ',$like).")";
                            $like = null;
                        }
                        $and[] = "(".implode(' OR ',$or).")";
                        $or = null;
                    }
                    else {
                        foreach($searchfields as $field) {
                            $like[] = $field." LIKE '%".trim($find)."%'";
                        }
                        $and[] = "(".implode(' OR ',$like).")";
                        $like = null;
                    }
                }        
            }
        }
        else {
            if(stristr($get['find'], '+')) {
                $s = explode('+',$get['find']);
                foreach($searchfields as $field) {
                    foreach($s as $w) {
                        $like[] = $field." LIKE '%".trim($w)."%'";
                    }
                    $or[] = "(".implode(' OR ',$like).")";
                    $like = null;
                }
                $and[] = "(".implode(' OR ',$or).")";
                $or = null;
            }
            else {
                if(stristr($get['find'], '[price')) { // [price<34.99] , [price:34.99-199.00] , [price>44.00]
                    $find = trim($get['find']);
                    $and[] = findPrice($find);
                }
                else {
                    foreach($searchfields as $field) {
                        $like[] = $field." LIKE '%".trim($get['find'])."%'";
                    }
                    $and[] = "(".implode(' OR ',$like).")";
                }
                $like = null;
            }
        }
        $select['find'] = "(".implode(" AND ", $and).") AND";
    }
    else {
        $temp = str_replace('amp;','',str_replace('&','_',$get['find']));
        foreach($searchfields as $field) {
            $like[] = $field." LIKE '%".trim($temp)."%'";
        }
        $and[] = "(".implode(' OR ',$like).")";
        $select['find'] = "(".implode(" AND ", $and).") AND";
    }
    
    $limit = 'LIMIT 50';
    $limits = 50;
}
// wizard($select['find']);
$foundSearch = '<i class="mdi mdi-magnify fs-3x"></i>'.mb_convert_case($get['find'], MB_CASE_TITLE, "UTF-8");