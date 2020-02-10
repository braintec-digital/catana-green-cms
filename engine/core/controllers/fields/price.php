<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$record['discount'] = '';
if($record['price'] == '0.00') {$record['price'] = $get['word']['priceinfo'];}
else {
    // проверка на курс валюты
    if($get['site']['pay_set'][2] > '0') {
        $record['price'] = $record['price']*$get['site']['pay_set'][2];
    }
    
    $record['oldprice'] = '';
    $record['down-price'] = '';
    if($record['price_old'] != '0.00') {
        if($get['site']['pay_set'][11]) $record['price_old'] = number_format($record['price_old'], 2, '.', ' ');
        else $record['price_old'] = number_format($record['price_old'], 0, '.', ' ');
        $record['oldprice'] = '<s class="oldprice">'.$record['price_old'].'</s>';
        $record['discount'] = '<i text="<s>'.$record['price_old'].'</s>" class="mdi mdi-ticket-percent discount"></i>';
        $record['down-price'] = '<span class="downprice">'.$get['word']['downprice'].'</span>';
    }
    else {
        $record['oldprice'] = '';
        if($stock['podcat'] > 0) {
            $record['oldprice'] = '<s>'.$record['price'].'</s>';
            $record['discount'] = '<i text="<div>-'.$stock['podcat'].'%</div>'.$record['oldprice'].'" class="mdi mdi-ticket-percent discount"></i>';
            $percent = 100-$stock['podcat'];
            $record['price'] = $record['price']/100*$percent;
        }
        else {
            if($stock['cat'] > 0 && $stock['podcat'] >= 0) {
                $record['oldprice'] = '<s>'.$record['price'].'</s>';
                $record['discount'] = '<i text="<div>-'.$stock['cat'].'%</div>'.$record['oldprice'].'" class="mdi mdi-ticket-percent discount"></i>';
                $percent = 100-$stock['cat'];
                $record['price'] = $record['price']/100*$percent;
            }
            else {
                if($stock['page'] > 0 && $stock['cat'] >= 0 && $stock['podcat'] >= 0) {
                    $record['oldprice'] = '<s>'.$record['price'].'</s>';
                    $record['discount'] = '<i text="<div>-'.$stock['page'].'%</div>'.$record['oldprice'].'" class="mdi mdi-ticket-percent discount"></i>';
                    $percent = 100-$stock['page'];
                    $record['price'] = $record['price']/100*$percent;
                }
                else {
                    if($get['site']['pay_set'][3] != 0 && ($stock['page'] >= 0 && $stock['cat'] >= 0 && $stock['podcat'] >= 0)) {
                        $record['oldprice'] = '<s>'.$record['price'].'</s>';
                        $record['discount'] = '<i text="<div>-'.$get['site']['pay_set'][3].'%</div>'.$record['oldprice'].'" class="mdi mdi-ticket-percent discount"></i>';
                        $percent = 100-$get['site']['pay_set'][3];
                        $record['price'] = $record['price']/100*$percent;
                    }
                }
            }
        }
    }
    
    if($get['site']['pay_set'][11]) $record['price'] = number_format($record['price'], 2, '.', ' ');
    else $record['price'] = number_format($record['price'], 0, '.', ' ');
}
// старая цена
if($record['price_old'] != '0.00') {
    $setrec1 = $get['word']['stock'];
}
else {
    $setrec1 = '';
}

// количество и доступность корзины
if($record['quant'] <= 0) {
    $record['instock'] = $get['word']['absent'];
    $record['cartype'] = '<b class="callback" place="'.$get['word']['orderme'].': '.$record['title'].'"><i class="mdi mdi-email fs-5x"></i></b>';
    $record['altcartype'] = '<b class="callback" place="'.$get['word']['orderme'].': '.$record['title'].'"><i class="fmdi mdi-email fs-5x"></i></b>';
}
else {
    // проверка корзины
    if($get['cart']) {
        $keycart = array_key_exists($record['id'], $get['cart']);
    }
    if($keycart) {$select = 'class="select"'; $cartquant = $get['cart'][$record['id']];} else {$select = ''; $cartquant = '0';}
    $record['instock'] = $get['word']['there'];
    if($cartquant == '0') $minus = ' none'; else $minus = '';
    $record['cartype'] = '<l class="mdi mdi-minus'.$minus.'"></l><b item="'.$record['id'].'" pres="'.$record['quant'].'" class="cart"><i class="mdi mdi-cart fs-4x"></i><q>'.$cartquant.'</q></b>';
    $record['altcartype'] = '<b class="callback" place="'.$get['word']['orderme'].': '.$record['title'].'"><i class="mdi mdi-email fs-5x"></i></b>';
}