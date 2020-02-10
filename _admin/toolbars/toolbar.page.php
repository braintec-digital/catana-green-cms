<?php
    if($data['public']) $public = 'mdi-eye-outline';
    else $public = 'mdi-eye-off';

    if($data['main']) $main = 'mdi-toggle-switch';
    else $main = 'mdi-toggle-switch-off';

    $typecontent = ['news' => 'News','shop' => 'Shop','short' => 'Short','' => 'Clear'];
    $multitypes = '<ol>';
    foreach($typecontent as $key => $val) {
        if($key == $data['multitype']) $select = ' class="select"';
        else $select = '';
        $multitypes .= '<li multitype="'.$key.'"'.$select.'>'.$val.'</li>';
    }
    $multitypes .= '</ol>';
?>
<div class="toolbar">
    <?=$parents?>

    <ul class="section">
        <li data-action="content" class="select"><i class="mdi mdi-format-align-left fs-5x"></i></li>
        <li data-action="gallery"><i class="mdi mdi-apps fs-5x"></i></li>
    </ul>

    <ul class="">
        <li data-action="multitype"><i class="mdi mdi-table-of-contents fs-5x"></i><?=$multitypes?></li>
        <li data-action="main" data-status="<?=$data['main']?>"><i class="mdi <?=$main?> fs-5x"></i></li>
        <li data-action="public" data-status="<?=$data['public']?>"><i class="mdi <?=$public?> fs-5x"></i></li>
        <li data-action="save"><i class="mdi mdi-content-save fs-5x"></i></li>
        <li data-action="close"><i class="mdi mdi-close fs-5x"></i></li>
    </ul>
</div>