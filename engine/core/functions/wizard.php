<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function wizard($data){
    global $workip;
    if(in_array($_SERVER["REMOTE_ADDR"],$workip)) {
        print_r($data); echo '<br><br>';
    }
}