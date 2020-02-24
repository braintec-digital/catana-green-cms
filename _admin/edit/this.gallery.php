<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
if($data['img']) $cover = ' style="background-image: url('.$data['img'].')"';
else $cover = '';
if($data['altimg']) $altimg = ' style="background-image: url('.$data['altimg'].')"';
else $altimg = '';
$gallery = [];
if($data['gallery']) {
    $items = explode(',',$data['gallery']);
    $i = 1;
    foreach($items as $img){
        $gallery[$i] = '<li data-img="'.$img.'" style="background-image: url('.$img.')"><a class="clear"><i class="mdi mdi-eraser fs-4x"></i></a></li>';
        $i++;
    }
}
if(count($gallery) > 0) $n = count($gallery)+1;
else $n = 1;
while($n <= 9) {
    $gallery[$n] = '<li><a class="clear"><i class="mdi mdi-eraser fs-4x"></i></a></li>';
    $n++;
}
$gallery = implode('',$gallery);
$gallery .= '<li class="plus unsortable"><i class="mdi mdi-plus-circle fs-9x"></i></li>';

echo '<div class="cover"'.$cover.'><a class="clear"><i class="mdi mdi-eraser fs-4x"></i></a></div>';
echo '<div class="alt"'.$altimg.'><a class="clear"><i class="mdi mdi-eraser fs-4x"></i></a></div>';
echo '<p>Gallery</p>';
echo '<ul path="" class="this-gallery sorting">'.$gallery.'</ul>';