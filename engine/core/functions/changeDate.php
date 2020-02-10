<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function ChangeDate($date,$word) {
    $newDate = '';
    if($date == date('Y-m-d')) { $newDate = $word['today']; }
    elseif($date == date("Y-m-d", time()-(60*60*24))) { $newDate = $word['yesterday']; }
    elseif($date == date("Y-m-d", time()+(60*60*24))) { $newDate = $word['tomorrow']; }
    else {
        $date = explode('-',$date);
        $newDate .= "<d>".$date[2]."</d>";
        $newDate .= "<m>".$word[$date[1]]."</m>";
        $newDate .= "<y>'".substr($date[0], 2, 2)."</y>";
    }
    return $newDate;
}
function ChangeDateString($date,$word) {
    $newDate = '';
    if($date == date('Y-m-d')) { $newDate = $word['today']; }
    elseif($date == date("Y-m-d", time()-(60*60*24))) { $newDate = $word['yesterday']; }
    elseif($date == date("Y-m-d", time()+(60*60*24))) { $newDate = $word['tomorrow']; }
    else {
        $date = explode('-',$date);
        $newDate .= $date[2]." ";
        $newDate .= $word[$date[1]]." ";
        $newDate .= substr($date[0], 2, 2);
    }
    return $newDate;
}
function ChangeDateUsa($date,$word) {
    $newDate = '';
    if($date == date('Y-m-d')) { $newDate = $word['today']; }
    elseif($date == date("Y-m-d", time()-(60*60*24))) { $newDate = $word['yesterday']; }
    else {
        $date = explode('-',$date);
        $newDate .= "<m>".$word[$date[1]]."</m>";
        $newDate .= "<d>".$date[2]."</d>";
        $newDate .= "<y>'".substr($date[0], 2, 2)."</y>";
    }
    return $newDate;
}
function ChangeDateStand($date,$word) {
    $newDate = '';
    $date = explode('-',$date);
    $newDate .= $date[2];
    $newDate .= ' '.$word[$date[1]];
    $newDate .= ' '.$date[0];
    return $newDate;
}