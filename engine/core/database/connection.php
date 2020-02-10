<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
function base($sql) {
    global $host;
    $mysql = new mysqli($host['addr'], $host['user'], $host['pass'], $host['base']);
    if($mysql->connect_errno) {
        echo "BASE CONNECTION ERROR!<br>"; exit;
    }
    if($sql) {
        $mysql->set_charset("utf8");
        return $mysql->query($sql);
    }
    else { return $mysql; }
}
function dbArray($result){
    $res_array = array();
    $count = 0;
    while($row = mysql_fetch_assoc($result)) {
        $res_array[$count] = $row;
        $count ++;
    }
    return $res_array;
}
function countRows($sql) {
    return base($sql)->num_rows;
}
function getData($sql) {
    global $get;
    $result = base($sql);
    if($result->num_rows > 0) {
        $array = array();
        while($row = $result->fetch_assoc()) { $array[] = $row; }
        if($get['langSet']) $array = multiCluster($array,$get['langSet']);
        return $array;
    }
    else return false;
}
function pageData($sql) {
    global $get;
    $result = base($sql);
    if($result) {
        $result = $result->fetch_assoc();
        if($get['langSet']) $result = singleCluster($result,$get['langSet']);
        return $result;
    }
    else return false;
}
function general($sql) {
    $result = base($sql);
    if($result) {
        $result = $result->fetch_assoc();
        return $result;
    }
    else return false;
}
function nextId($table) {
    global $host;
    $result = base("SELECT `AUTO_INCREMENT`FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$host['base']."' AND TABLE_NAME = '$table'");
    $result = mysql_fetch_assoc($result);
    $result = $result['AUTO_INCREMENT'];
    return $result;
}
function tableFields($table) {
    $result = base("SHOW COLUMNS FROM $table");
    foreach($result as $item) {
        $fields[] = $item['Field'];
    }
    return $fields;
}
function showTables() {
    global $host;
    $result = base("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$host['base']."'");
    $result = dbArray($result);
    foreach($result as $item) {
        $tables[] = $item['TABLE_NAME'];
    }
    return $tables;
}
function insert($data) {
    $table = $data['table'];
    unset($data['table']);

    $count = 0;
    foreach($data as $key => $item) {
        $row[$count] = $key;
        $val[$count] = "'".$item."'";
        $count++;
    }

    $row = implode(',',$row);
    $val = implode(',',$val);
    
    $res = base(" INSERT INTO $table ($row) VALUES ($val) ");
    return $res;
}
function update($data) {
    $table = $data['table'];
    unset($data['table']);
    $id = $data['id'];
    unset($data['id']);

    if($data['social']) {
        unset($data['social']);
        unset($data['title']);
        unset($data['site']);
        $social = null;
        foreach($data as $key => $val) {
            $social .= trim($key).'⊣⊢'.trim($val).'⊣key⊢';
        }
        $res = base(" UPDATE $table SET `social_set` = '$social' WHERE id='$id' ");
    } else {
        foreach($data as $key => $val) {
            $res = base(" UPDATE $table SET `$key` = '$val' WHERE id='$id' ");
        }
    }
}

function multiCluster($data,$lang){
    $i = 0;
    foreach($data as $row) {
        foreach($row as $key => $val) {
            if(stristr($val,'⣿')) {
                $temp = explode('⣿',$val);
                $newrow[$key] = $temp[$lang['id']];
            }
            else $newrow[$key] = $val;
        }
        $new[$i] = $newrow;
        $i++;
    }
    return $new;
}
function singleCluster($data,$lang) {
    foreach($data as $key => $val) {
        if(stristr($val,'⣿')) {
            $temp = explode('⣿',$val);
            $newrow[$key] = $temp[$lang['id']];
        }
        elseif(stristr($val,'arr:')) {
            $val = str_replace('arr:','',$val);
            $val = explode(',',$val);
            $i = 0;
            foreach($val as $item) {
                $newrow[$key][$i] = $item;
                $i++;
            }
        }
        elseif(stristr($val,'obj:')) {
            $val = str_replace('obj:','',$val);
            $val = explode(',',$val);
            foreach($val as $item) {
                $item = explode('=',$item);
                $item[0] = trim($item[0]);
                $newrow[$key][$item[0]] = $item[1];
            }
        }
        else $newrow[$key] = $val;
    }
    return $newrow;
}