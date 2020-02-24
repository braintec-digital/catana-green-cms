<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/engine/core/includes.php');

$blockName = $_POST['block'];
$rows = $_POST['rows'];

$file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$get['tpl']['blocks'].'/'.$blockName.'/'.$blockName.'.html');
$file = explode('@blade',$file)[0];

$code = new simple_html_dom();
$code = str_get_html($file);

foreach($code->find('[select]') as $item) {
    $template = $item->innertext;
    $select = $item->select;
    $next = $item->next;
    $genegal = true;
}

include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/sql.php");

if($found > $rows+$next) $html = [$found-($rows+$limits)];
else $html = [0];

if($records) {
    foreach($records as $record) {
        $line = $template;
        include($_SERVER['DOCUMENT_ROOT']."/engine/core/controllers/magic-records.php");
        $line = str_replace("@placeholder", $get['tpl']['placeholder'], $line);
        foreach($get['word'] as $w => $v) {
            $line = str_replace("@word->".$w, $v, $line);
        }
        $html[] = trim($line);
    }
}

echo json_encode($html);