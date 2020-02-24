<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
$nowdate = date('Y-m-d');
$nowtime = date('H:i:s');

if($select == 'rootmenu') {
    include_once($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql/rootmenu.php");
    return $records;
}
if($select == 'secondmenu') {
    include_once($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql/secondmenu.php");
    return $records;
}

$select = explode(':',$select);
$table = $select[0];

$fieldscheck = tableFields($table);

$i = 0;
if(strstr($table,'records')) {
    foreach($fieldscheck as $key) {
        if(strstr($template,'@record->'.$key)) {
            $fields[$i] = $key;
            $i++;
        }
    }
    $fields = implode(',',$fields);
    $fields = 'id,view_id,page_id,note_id,'.$fields;
}
if(strstr($table,'pages')) {
    foreach($fieldscheck as $key) {
        if(strstr($template,'@page->'.$key)) {
            $fields[$i] = $key;
            $i++;
        }
    }
    $fields = implode(',',$fields);
    $fields = 'id,parent_id,'.$fields;
}


if($select[3] == 'date') {
    if($select[4] == 'asc') $order = "date ASC";
    else $order = "date DESC, time DESC";
} else {
    $order = $select[3];
    if($select[4] == 'asc') $order .= ' ASC';
    elseif($select[4] == 'desc') $order .= ' DESC';
    else $order .= ' ASC';
}

if(is_numeric($select[2])) $limits = $select[2]; else $limits = 0;

if($rows) {
    $limit = 'LIMIT '.$rows.','.$next;
}
elseif($get['next']) {
    if($get['next'] && $get['next'] == 'all') $limit = '';
    else $limit = 'LIMIT '.$get['next'];
}
else {
    if($select[2] == 'all') $limit = '';
    else $limit = 'LIMIT '.$select[2];
}

$selecTor = [
    'where' => '',
    'page' => '',
    'tags' => '',
    'find' => '',
    'date' => '',
    'param' => ''
];
if($table == 'pages' || stristr($table, 'records')) {
    if($get['admin']) $selecTor['public'] = "(del=0)";
    else $selecTor['public'] = "(public=1 AND del=0)";
} else {
    $selecTor['public'] = '';
}

if($select[1] == 'thispage' ) {
    if($get['tags']) {
        $selecTor['page'] = "(view_id=".$get['viewid'].") AND";
    }
    else {
        if($get['noteid'] && $content['note']['public']) $selecTor['page'] = "(view_id=".$get['viewid']." AND page_id=".$get['pageid']." AND note_id=".$get['noteid'].") AND";
        elseif($get['pageid']) $selecTor['page'] = "(view_id=".$get['viewid']." AND page_id=".$get['pageid'].") AND";
        else $selecTor['page'] = "(view_id=".$get['viewid'].") AND";
    }
    //--TAGS-FIND-DATE-SETS
    if($get['sets']) {
        include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql/sets.php");
    }

    if($get['tags']) {
        include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql/tags.php");
    }

    if($get['find']) {
        include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql/find.php");
    }

    if($get['date']) {
        $selecTor['date'] = "(date='".$get['date']."') AND";
        $limit = 'LIMIT 50';
        $limits = 50;
    }
    elseif(($rows && $next) || $get['multitype'] == 'pros' || $get['multitype'] == 'info') $selecTor['date'] = '';
    elseif(!$find) {
        if($get['table'] == 'records_news') {
            if($get['admin']) $selecTor['date'] = "(`date`<='$nowdate' AND (`fin_date`>='$nowdate' OR `fin_date` IS NULL OR `fin_date`='0000-00-00')) AND";
            else $selecTor['date'] = "((date<='$nowdate' AND (fin_date>'$nowdate' OR fin_date='0000-00-00' OR fin_date IS NULL)) OR (date='$nowdate' AND time<'$nowtime')) AND";
        }
        else {
            $selecTor['date'] = "";
        }
    }
    //--END
}
elseif($select[1] == 'stock') {
    if((!$get['tags'] && !$get['find'] && !$get['date'])) {
        $selecTor['param'] = "(param != '' AND param != '-' AND param != '--') AND";
    }
    else {
        //--TAGS-FIND-DATE-
        if($get['tags']) {
            include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql/tags.php");
        }

        if($get['find']) {
            include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql/find.php");
        }

        if($get['date']) $selecTor['date'] = "(date='".$get['date']."') AND";
        elseif(($rows && $next) || $get['multitype'] == 'pros' || $get['multitype'] == 'info') $selecTor['date'] = '';
        elseif(!$find) $selecTor['date'] = "((date<='$nowdate' AND (fin_date>'$nowdate' OR fin_date='0000-00-00' OR fin_date IS NULL)) OR (date='$nowdate' AND time<'$nowtime')) AND";
        //--END
    }
}
elseif(strstr($select[1],'/')) {
    $target = explode('/',$select[1]);
    $params = $target[0];
    $target = $target[1];
    $target = pageData("SELECT id FROM pages WHERE view='$target'");
    $selecTor['where'] = "(view_id='".$target['id']."') AND";
    if($params == 'stock') $selecTor['param'] = "(param != '' AND param != '-' AND param != '--') AND";
    else $selecTor['param'] = "(param LIKE '%$params%') AND";
}
elseif($select[1] == 'thisrecord') {
    $selecTor['where'] = "record_id='".$content['record']['id']."'";
}
elseif($select[1] == 'mainmenu') {
    $selecTor['where'] = "(parent_id=0 AND view_act=1) AND";
}
else {
    $selecTor['where'] = '('.$select[1].')';
    if($selecTor['public']) $selecTor['where'] .= " AND";
}

if($content['record']['id'] && $table == 'records') {
    $selecTor['where'] .= ' (id != '.$content['record']['id'].') AND';
}

if($get['date'] && $genegal) {
    $selecTor['date'] = "(date='".$get['date']."') AND";
    $limit = 'LIMIT 50';
    $limits = 50;
}

if($get['city']) {
    $foundLocate = '<i class="seemap mdi mdi-map-marker fs-3x"></i>'.$get['city'];
    if(strstr($get['city'],',')) {
        $loc = explode(',',$get['city']);
        $city = trim($loc[0]);
        $state = trim($loc[1]);
        $selecTor['where'] .= "(city='".$city."' AND state='".$state."') AND";
    }
    elseif(strlen($get['city']) == 2) {
        $selecTor['where'] .= "(state='".$get['city']."') AND";
    }
    else {
        $cityid = pageData("SELECT id FROM loc_city WHERE city_link=".$get['city']);
        $selecTor['where'] .= "(city='".$cityid['id']."') AND";
    }
    // wizard($selecTor);
}

if($get['view'] == 'afisha') {
    $selecTor['date'] = "";
}

$selecTor = array_diff($selecTor, array(''));
$selecTor = implode(' ',$selecTor);
if($get['admin']) $order .= ', id DESC';

$found = countRows("SELECT id FROM $table WHERE $selecTor");

if($get['pages']) {
    if($get['pages'] == 1) $limit = ' LIMIT '.$limits;
    else $limit = ' LIMIT '.$limits*($get['pages']-1).','.$limits;
}

$sql = "SELECT $fields FROM $table WHERE $selecTor ORDER BY $order $limit";
$records = getData($sql);

// print_r($sql);

$selecTor = NULL;
$select = NULL;