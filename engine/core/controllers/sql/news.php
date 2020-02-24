<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$fields = 'id,page_id,cat_id,podcat_id,url,title,tags,date,time,fin_date,param,public';
$table = 'records_news';
$parent = pageData("SELECT id FROM pages WHERE table_records='records_news'");

if($get['admin']) $select['date'] = "(`date`<='$nowdate' AND (`fin_date`>='$nowdate' OR `fin_date` IS NULL OR `fin_date`='0000-00-00')) AND";
else $select['date'] = "(`date`<='$nowdate' AND (`fin_date`='0000-00-00' OR `fin_date`>='$nowdate' OR `fin_date` IS NULL) AND (`date`<='$nowdate' AND `time`<='$nowtime')) AND";