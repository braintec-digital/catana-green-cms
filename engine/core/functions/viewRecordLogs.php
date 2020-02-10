<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function viewRecordCount($id){
    global $content;
    if($content['view']['table_records']) $table = $content['view']['table_records'];
    else $table = 'records';

    $views = pageData(" SELECT views FROM $table WHERE id=$id "); $views = $views['views'];
    $views++;
    $res = base(" UPDATE $table SET `views`='$views' WHERE id='$id' ");
    return $views;
}
function viewRecordLogs($id,$target){
    global $content;
    $pageid = $content['view']['id'];

    $data = array();
    $data['table'] = 'record_views';
    $data['view_id'] = $pageid;
    $data['record_id'] = $id;
    $data['user_id'] = $_SESSION['user']['id'];
    $data['date'] = date('Y-m-d');
    $data['time'] = date('H:m');
    $data['sess_id'] = $sess_id = $_COOKIE['PHPSESSID'];
    $data['user_ip'] = $_SERVER['REMOTE_ADDR'];
    $data['referal'] = $_SERVER['HTTP_REFERER'];
    $data['target'] = $target;

    $lastview = pageData("SELECT date FROM record_views WHERE view_id='$pageid' AND record_id='$id' AND sess_id='$sess_id' ORDER BY id DESC ");
    if(!$lastview || ($lastview['date'] < $data['date'])) {
        insert($data);
        viewRecordCount($id);
    }
}
// Click Count
function clickRecordCount($id){
    $click = pageData(" SELECT click FROM record_img WHERE id=$id "); $click = $click['click'];
    $click++;
    $res = dbSite(" UPDATE record_img SET `click`='$click' WHERE id='$id' ");
}
// Take Count
function takeRecordCount($id,$take){
    $res = dbSite(" UPDATE records SET `takes`='$take' WHERE id='$id' ");
}
function ratingRecord($id,$rating) {
    $res = dbSite(" UPDATE records SET `rating`='$rating' WHERE id='$id' ");
}