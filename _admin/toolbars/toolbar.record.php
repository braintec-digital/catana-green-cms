<?php
    if($data['public']) $public = 'mdi-eye-outline';
    else $public = 'mdi-eye-off';
?>
<div class="toolbar">
    <?=$parents?>
    
    <ul class="section">
        <li data-action="content" class="select"><i class="mdi mdi-format-align-left fs-5x"></i></li>
        <li data-action="gallery"><i class="mdi mdi-apps fs-5x"></i></li>
    </ul>

    <ul>
        <li data-action="public" data-status="<?=$data['public']?>"><i class="mdi <?=$public?> fs-5x"></i></li>
        <li data-action="save"><i class="mdi mdi-content-save fs-5x"></i></li>
        <li data-action="close"><i class="mdi mdi-close fs-5x"></i></li>
    </ul>
</div>