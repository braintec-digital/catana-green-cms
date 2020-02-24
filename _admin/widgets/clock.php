<?php
$h = $_POST['data']['h'];
$i = $_POST['data']['i'];
$c = $i / 5;
$i = round($c) * 5;
if($i < 10) $i = '05';

$clock = '<div class="clock">';
$clock .= '<div class="hour"><i class="mdi mdi-chevron-up next"></i><ul>';
$clock .= '<li>'.$h.'</li>';
$clock .= '</ul><i class="mdi mdi-chevron-down prev"></i></div>';
$clock .= '<div class="minute"><i class="mdi mdi-chevron-up next"></i><ul>';
$clock .= '<li>'.$i.'</li>';
$clock .= '</ul><i class="mdi mdi-chevron-down prev"></i></div>';
$clock .= '</div>';

echo $clock;