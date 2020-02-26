<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
include_once($_SERVER['DOCUMENT_ROOT'].'/_admin/config.php');

if($_POST['search']) {
    $search = $_POST['search'];
    if($search != '') $list = getData("SELECT * FROM records WHERE (view_id=".$search['view_id'].") AND (title LIKE '%".$search['search']."%') AND del=0 ORDER BY num ASC, date DESC");
    else $list = getData("SELECT * FROM records WHERE (view_id=".$search['view_id'].") AND del=0 ORDER BY num ASC, date DESC");
}
elseif($_POST['list']) {
    $search = $_POST['list'];
    if($search['note']) $select = "(view_id=".$search['view']." AND page_id=".$search['page']." AND note_id=".$search['note'].")";
    elseif($search['page']) $select = "(view_id=".$search['view']." AND page_id=".$search['page'].")";
    else $select = "(view_id=".$search['view'].")";

    if($search['type'] == 'del=1') $select .= " AND (".$search['type'].")";
    elseif($search['type']) $select .= " AND (".$search['type'].") AND del=0";
    else $select .= " AND del=0";

    $list = getData("SELECT * FROM records WHERE $select ORDER BY num ASC, date DESC");
}
else {
    $list = getData("SELECT * FROM records WHERE view_id=".$_POST['edit']['id']." AND del=0 ORDER BY num ASC, date DESC");
}

echo '<ul class="listing-records sorting" file="record" table="records">';
foreach($list as $item) {
    if($item['public']) { $public = 'mdi-eye-outline'; $class = ''; }
    else { $public = 'mdi-eye-off'; $class = ' class="off"'; }
    echo '<li id="'.$item['id'].'"'.$class.'>';
    echo '<div class="cover" style="background-image: url('.$item['img'].')"></div>';
    echo '<div>';
    echo '<p>'.$item['title'].'</p>';
    echo '</div>';
    echo '<div class="func-admin">';
    if($search['type'] == 'del=1') {
    echo '<a id="edit" help="Edit"><i class="mdi mdi-pencil fs-3x"></i></a>';
    echo '<a id="undel" help="Restore"><i class="mdi mdi-delete-restore fs-4x"></i></a>';
    echo '<a id="remove" help="Delete" confirm="true" action="delete"><i class="mdi mdi-delete-circle fs-3x"></i></a>';
    } else {
    echo '<a id="edit" help="Edit"><i class="mdi mdi-pencil fs-3x"></i></a>';
    echo '<a id="public" help="Public Off"><i class="mdi '.$public.' fs-3x"></i></a>';
    echo '<a id="del" help="Delete" confirm="true" action="delete"><i class="mdi mdi-delete fs-3x"></i></a>';
    }
    echo '</div>';
    echo '</li>';
}
echo '</ul>';
echo '<script>newSort();</script>';