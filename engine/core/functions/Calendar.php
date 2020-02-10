<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function Calendar($mont,$year){
    global $get;
    // count days in mont
    if(!$mont && !$year) {
        $mont = date('m');
        $year = date('y');
        $y = date('Y');
    }
    else {
        $y = '20'.$year;
    }
    $today = date('j');

    $preyear = $year;
    $nexyear = $year;

    if($mont == 1) {$premont = 12; $preyear--;}
    else {$premont = $mont-1;}
    
    if($mont == 12) {$nexmont = 1; $nexyear++;}
    else {$nexmont = $mont+1;}

    if(strlen($mont) == 1) $mont = '0'.$mont;
    if(strlen($premont) == 1) $premont = '0'.$premont;
    if(strlen($nexmont) == 1) $nexmont = '0'.$nexmont;
    
    $lang['ru'] = [
        '01' => 'январь',
        '02' => 'февраль',
        '03' => 'март',
        '04' => 'апрель',
        '05' => 'май',
        '06' => 'июнь',
        '07' => 'июль',
        '08' => 'август',
        '09' => 'сентябрь',
        '10' => 'октябрь',
        '11' => 'ноябрь',
        '12' => 'декабрь'
    ];
    $lang['uk'] = [
        '01' => 'січень',
        '02' => 'лютий',
        '03' => 'березень',
        '04' => 'квітень',
        '05' => 'травень',
        '06' => 'червень',
        '07' => 'липень',
        '08' => 'серпень',
        '09' => 'вересень',
        '10' => 'жовтень',
        '11' => 'листопад',
        '12' => 'грудень'
    ];
    $lang['en'] = [
        '01' => 'january',
        '02' => 'february',
        '03' => 'march',
        '04' => 'april',
        '05' => 'may',
        '06' => 'june',
        '07' => 'july',
        '08' => 'august',
        '09' => 'september',
        '10' => 'october',
        '11' => 'november',
        '12' => 'december'
    ];
    
      $dayofmonth = date('t', mktime(0,0,0,date($mont),1,$y));
    
      $day_count = 1;
      // first week
      $num = 0;
    
    for($i = 0; $i < 7; $i++) {
        // Вычисляем номер дня недели для числа
        $dayofweek = date('w',mktime(0, 0, 0, date($mont), $day_count, $y));
        // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
        $dayofweek = $dayofweek - 1;
        if($dayofweek == -1) $dayofweek = 6;
        if($dayofweek == $i)
        {
            // Если дни недели совпадают,
            // заполняем массив $week
            // числами месяца
            $week[$num][$i] = $day_count;
            $day_count++;
        }
        else {
            $week[$num][$i] = "";
        }
    }
      // 2. Последующие недели месяца
      while(true) {$num++;
        for($i = 0; $i < 7; $i++)
        {
            $week[$num][$i] = $day_count;
            $day_count++;
            // Если достигли конца месяца - выходим из цикла
            if($day_count > $dayofmonth) break;
        }
        // Если достигли конца месяца - выходим из цикла
        if($day_count > $dayofmonth) break;
      }
      // 3. Выводим содержимое массива $week в виде календаря
      // Выводим таблицу
      $calendar = '<mont><a class="modal" mont="'.$premont.'" year="'.$preyear.'">'.$get['word'][$premont].'</a><p>'.$lang[$get['lang']][$mont].'`'.$year.'</p><a class="modal" mont="'.$nexmont.'" year="'.$nexyear.'">'.$get['word'][$nexmont].'</a></mont><table>';
      $calendar .= '<thead><tr><td>пн</td><td>вт</td><td>ср</td><td>чт</td><td>пт</td><td class="weekend">сб</td><td class="weekend">вс</td></tr></thead>';

      for($i = 0; $i < count($week); $i++) {
        $calendar .= '<tr>';
        for($j = 0; $j < 7; $j++) {
            if(!empty($week[$i][$j]))
            {
                if(strlen($week[$i][$j]) == 1) $week[$i][$j] = '0'.$week[$i][$j];
                $dates = $y.'-'.$mont.'-'.$week[$i][$j];
                $daynum = $week[$i][$j];
                $now = date('Y-m-d');
                if($dates == $now) {$nowday = ' class="now"';}
                else {$nowday = '';}
                // Если имеем дело с субботой и воскресенья подсвечиваем их
                if($j == 5 || $j == 6) {
                    $calendar .= '<td '.$nowday.' date="'.$dates.'" class="weekend">'.$daynum.'</td>';
                }
                else {
                  $calendar .= '<td '.$nowday.' date="'.$dates.'">'.$daynum.'</td>';
                }
            }
            else {
                $calendar .= '<td></td>';
            }
        }
        $calendar .= '</tr>'; 
    }
    $calendar .= '</table>';
    
    return $calendar;
}

if($_POST['data']) {
    include($_SERVER['DOCUMENT_ROOT']."/config.php");
    include($_SERVER['DOCUMENT_ROOT'].'/core/controllers/request.php');
    include($_SERVER['DOCUMENT_ROOT'].'/core/controllers/content.php');

    $mont = $_POST['data']['mont'];
    $year = $_POST['data']['year'];
    if(strlen($mont) == 1) $mont = '0'.$mont;
    echo Calendar($mont,$year);
}