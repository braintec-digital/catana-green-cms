<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
foreach($fields as $field => $type) {
    if($type[0] == 'hidden') {
        echo '<input type="hidden" name="'.$field.'" value="'.$data[$field].'" autocomplete="off">';
    }
    if($type[0] == 'langs') {
        // langs content
    }
    if($type[0] == 'input') {
        echo '<div><span><i class="mdi '.$type[1].' fs-4x"></i></span><input type="text" name="'.$field.'" value="'.$data[$field].'" autocomplete="off" placeholder="'.$field.'"></div>';
    }
    if($type[0] == 'textarea') {
        echo '<div><span><i class="mdi '.$type[1].' fs-4x"></i></span><textarea name="'.$field.'" autocomplete="off" placeholder="'.$field.'">'.$data[$field].'</textarea></div>';
    }
    if($type[0] == 'shortext') {
        echo '<div class="slipwi">';
        include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/slipwi-bigtext.php');
        echo '<div class="shortext slipwi-content" name="'.$field.'" contenteditable="true">'.$data[$field].'</div>';
        echo '</div>';
    }
    if($type[0] == 'bigtext') {
        echo '<div class="slipwi">';
        include($_SERVER['DOCUMENT_ROOT'].'/_admin/toolbars/slipwi-bigtext.php');
        echo '<div class="bigtext slipwi-content" name="'.$field.'" contenteditable="true">'.$data[$field].'</div>';
        echo '</div>';
    }
    if(is_numeric($field)) {
        echo '<div class="cluster">';
        foreach($type as $item => $elem) {
            echo '<div><span><i class="mdi '.$elem[1].' fs-4x"></i></span><input type="text" name="'.$item.'" value="'.$data[$item].'" autocomplete="off" placeholder="'.$item.'"></div>';
        }
        echo '</div>';
    }
}