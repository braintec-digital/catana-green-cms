<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$fields = 'id,page_id,cat_id,podcat_id,url,title,tags,date,time,fin_date,param,public';
$table = 'records_news';
if(strstr($datasql,':')) {
    $select = explode(':',$datasql)[1].' AND';
    $limit = explode(':',$datasql)[2];
}
else {
    $select = '';
    $limit = 12;
}
$sql = "SELECT $fields FROM $table WHERE $select (`date`<='$nowdate' AND (`fin_date`>='$nowdate' OR `fin_date` IS NULL OR `fin_date`='0000-00-00')) AND (del=0) ORDER BY date DESC, time DESC LIMIT $limit";
$records = getData($sql);