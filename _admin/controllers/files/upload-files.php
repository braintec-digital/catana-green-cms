<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
include($_SERVER['DOCUMENT_ROOT']."/engine/core/functions/translit.php");
// print_r($_POST); die;
if($_POST) {
    $folder = $_SERVER['DOCUMENT_ROOT'].'/'.$_POST['path'];
    
    if(!is_dir($folder)) { mkdir($folder); }
    
	$files = $_FILES;
    $done_files = array();
    
	foreach($files as $file) {
        $file_name = translit($file['name'],'file');
        echo $file_name;
        $path = $folder.'/'.$file_name;
		if(move_uploaded_file($file['tmp_name'],$path)) {
			$done_files[] = realpath($path);
        }
    }
}