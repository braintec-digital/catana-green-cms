<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$param = explode('-', $record['param']);
unset($record['param']);
$record['param1'] = $get['word'][$param[0]];
$record['param2'] = $get['word'][$param[1]];
$record['param3'] = $get['word'][$param[2]];