/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
$(document).on('keyup blur','input#url',function(){
    var data = {};
    data['row'] = $(this).val();
    data['table'] = $('[name=table]').val();
    data['act'] = $('#act').val();
    if(data['table'] == 'pages') {
        $('admin console').load('admin/_translit.php',{data},function(res){
            $newrow = $('admin console').text();
            $('admin console').empty();
            setTimeout(() => {
                $('input.newurl').val($newrow);
            }, 50);
        });
    }
    else {
        if(data['act'] == 'add') {
        $('admin console').load('admin/_translit.php',{data},function(res){
            $newrow = $('admin console').text();
            $('admin console').empty();
            setTimeout(() => {
                $('input.newurl').val($newrow);
            }, 50);
        });
        }
    }
});