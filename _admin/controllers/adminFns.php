<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
function editData($sql) {
    $result = base($sql);
    if($result) {
        $result = $result->fetch_assoc();
        $result = reClusterData($result);
        return $result;
    }
    else return false;
}
function clusterSaveData($post,$table) {
    $fields = tableFields($table);
    foreach($post as $key => $value) {
        foreach($fields as $field) {
            if($key == $field) {
                $new[$field] = $value;
            }
            elseif(stristr($key,$field.'-')) {
                $sub = str_replace($field.'-','',$key);
                if(!stristr($new[$field],'lang:')) $new[$field] .= 'lang:';
                if($value) $new[$field] .= $value.'⣿';
            }
            elseif(stristr($key,$field.':')) {
                if(!stristr($new[$field],'arr:')) $new[$field] .= 'arr:';
                if($value) $new[$field] .= $value.',';
            }
            elseif(stristr($key,$field.'=')) {
                if(!stristr($new[$field],'obj:')) $new[$field] .= 'obj:';
                $key = explode('=',$key)[1];
                if($value) $new[$field] .= $key.'='.$value.',';
            }
        }
    }
    foreach($new as $key => $item) {
        if(stristr($item,'arr:')) $new[$key] = rtrim($item,';');
        else $new[$key] = $item;
    }
    return $new;
}
function reClusterData($data){
    foreach($data as $key => $val){
        if(stristr($val,'⣿')) $newdata[$key] = explode('⣿',$val);
        elseif(stristr($val,'arr:')) {
            $val = str_replace('arr:','',$val);
            if($key != 'gallery') {
                $val = explode(',',$val);
                $i = 1;
                foreach($val as $item) {
                    $newdata[$key.':'.$i] = $item;
                    $i++;
                }
            }
            else {
                $newdata[$key] = $val;
            }
        }
        elseif(stristr($val,'obj:')) {
            $val = str_replace('obj:','',$val);
            $val = explode(',',$val);
            foreach($val as $item) {
                $item = explode('=',$item);
                $item[0] = trim($item[0]);
                $newdata[$key.'='.$item[0]] = $item[1];
            }
        }
        else $newdata[$key] = $val;
    }
    return $newdata;
}
function insertData($post) {
    $table = $post['table'];
    unset($post['id']);
    unset($post['table']);

    $post = clusterSaveData($post,$table);

    $count = 0;
    foreach($post as $keys => $item){
        $key[$count] = $keys;
        $item = trim($item,',');
        if($keys == 'url') $item = translit($post['title'],'');
        $val[$count] = "'".$item."'";
        $count++;
    }

    $key = implode(',',$key);
    $val = implode(',',$val);

    // print_r(" INSERT INTO $table ($key) VALUES ($val) "); die;
    
    $res = base(" INSERT INTO $table ($key) VALUES ($val) ");
    if(!$res) echo "ERROR!";
}
function updateData($post) {
    $table = $post['table'];
    $id = $post['id'];
    unset($post['table']);
    unset($post['id']);

    $post = clusterSaveData($post,$table);

    foreach($post as $key => $val){
        $val = trim($val,',');
        $res = base(" UPDATE $table SET $key = '$val' WHERE id='$id' ");
        if(!$res) echo "ERROR! $key";
    }
}

function checkFileType($item){
    $filetypes = array(
        '.jpeg'=>'mdi-file-image',
        '.jpg'=>'mdi-file-image',
        '.png'=>'mdi-file-image',
        '.gif'=>'mdi-file-image',
        '.bmp'=>'mdi-file-image',
        '.svg'=>'mdi-file-image',
        '.doc'=>'mdi-file-word',
        '.docx'=>'mdi-file-word',
        '.pdf'=>'mdi-file-pdf',
        '.xls'=>'mdi-file-excel',
        '.csv'=>'mdi-file-excel',
        '.mp3'=>'mdi-file-music',
        '.wav'=>'mdi-file-music',
        '.fla'=>'mdi-file-music',
        '.mp4'=>'mdi-file-video',
        '.avi'=>'mdi-file-video',
        '.mov'=>'mdi-file-video',
        '.ppt'=>'mdi-file-powerpoint',
        '.xml'=>'mdi-file-xml',
        '.zip'=>'mdi-zip-box',
        '.rar'=>'mdi-zip-box',
        '.php'=>'mdi-code-array',
        '.css'=>'mdi-language-css3',
        '.js'=>'mdi-language-javascript',
        '.htm'=>'mdi-language-html5',
        '.html'=>'mdi-language-html5',
        '.txt'=>'mdi-file'
    );
    foreach($filetypes as $file => $type){
        if(stristr($item,$file)) {
            if($type == 'mdi-file-image') $arr = array('ico' => $type,'type' => 'img');
            if($type == 'mdi-file-word') $arr = array('ico' => $type,'type' => 'doc');
            if($type == 'mdi-file-pdf') $arr = array('ico' => $type,'type' => 'pdf');
            if($type == 'mdi-file-excel') $arr = array('ico' => $type,'type' => 'xls');
            if($type == 'mdi-file-music') $arr = array('ico' => $type,'type' => 'audio');
            if($type == 'mdi-file-powerpoint') $arr = array('ico' => $type,'type' => 'ppt');
            if($type == 'mdi-file-xml') $arr = array('ico' => $type,'type' => 'xml');
            if($type == 'mdi-zip-box') $arr = array('ico' => $type,'type' => 'zip');
            if($type == 'mdi-code-array') $arr = array('ico' => $type,'type' => 'code');
            if($type == 'mdi-language-css3') $arr = array('ico' => $type,'type' => 'code');
            if($type == 'mdi-language-javascript') $arr = array('ico' => $type,'type' => 'code');
            if($type == 'mdi-language-html5') $arr = array('ico' => $type,'type' => 'code');
            if($type == 'mdi-file') $arr = array('ico' => $type,'type' => 'file');
            if($type == 'mdi-file-video') $arr = array('ico' => $type,'type' => 'video');
        } 
    }
    return $arr;
}