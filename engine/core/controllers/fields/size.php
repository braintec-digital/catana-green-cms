<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$record['quant'] = 0;
if($record['size']) {
    $record['size'] = explode('size-',$record['size']);
    $record['size'] = array_filter($record['size']);
    foreach($record['size'] as $colors) {
        $cs = explode(':',$colors);
        $s = rtrim($cs[1],';');
        if(strstr($s,';')) $color[$cs[0]] = explode(';',$s);
        elseif($s) $color[$cs[0]] = [$s];
    }

    foreach($color as $c => $s) {
        foreach($s as $i) {
            $si = explode('=',$i);
            $a[$si[0]] = $si[1];
            $count += $si[1];
        }
        $sizes[$c] = $a;
        $a = null;
    }

    $record['size'] = '<p>Выберите размер в доступном цвете:</p><ol class="sizes">';
    foreach($sizes as $key => $val) {
        $record['size'] .= '<li><div class="color" color="'.$key.'" style="background: #'.$key.'"></div>';
        foreach($val as $size => $count) {
            $record['size'] .= '<div count="'.$count.'">'.$size.'</div>';
            $record['quant'] += $count;
        }
        $record['size'] .= '</li>';
    }
    $record['size'] .= '</ol>';
}

if($record['quant'] > 0) {
    $record['size'] .= '<button item="'.$record['id'].'" count="" pres="'.$record['quant'].'" class="cart param" param="" alert="Выберите размер!"><ico><i class="mdi mdi-cart fs-4x"></i></ico><span>в корзину</span></button>';
}
else {
    $tags = explode(';',$content['view']['tags']);
    foreach($tags as $tag) {
        if(strstr($tag,'Размер')) $sizes = explode(',',explode(':',$tag)[1]);
    }
    if($sizes) {
        $sizesel = '<ol class="selectsize">';
        foreach($sizes as $size) {
            $sizesel .= '<li>'.$size.'</li>';
        }
        $sizesel .= '</ol>';
    }
    $record['size'] = '<p>Закажите нужный размер:</p>';
    $record['size'] .= $sizesel;
    $record['size'] .= '<button class="sendmail order" head="Заказ модели" place="'.$record['title'].'" type="" alert="Выберите размер!"><ico><i class="mdi mdi-email fs-4x"></i></ico><span>заказать</span></button>';
}


