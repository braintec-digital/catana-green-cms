<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function addComment($data,$table){
    $count = 0;
    foreach($data as $key => $item) {
        $row[$count] = $key;
        $val[$count] = "'".$item."'";
        $count++;
    }
    $row = implode(',',$row);
    $val = implode(',',$val);
    
    $res = dbSite(" INSERT INTO record_comments ($row) VALUES ($val) ");
    if($res) {
        $record = pageData("SELECT comments FROM $table WHERE id=".$data['record_id']);
        $comment = $record['comments']+1;
        $res = dbSite(" UPDATE $table SET `comments`='$comment' WHERE id=".$data['record_id']);
    }
}