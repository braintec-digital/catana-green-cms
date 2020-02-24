/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/

function newSort() {
    $('.sorting').sortable({
        placeholder: 'placeholder',
        items: "li:not(.unsortable)",
        containment: 'parent',
        update: function() {
            sortRecords($(this));
        }
    });
}
newSort();

function sortRecords(list) {
    var data = {};
    data['table'] = list.attr('table');
    data['order'] = list.sortable("toArray");
    if(data['table'] == 'pages' || data['table'] == 'records') {
        $('#admin dialog').load('_admin/controllers/save.data.php',{data});
    }
    else {
        galleryCreate();
    }
}

function saveData(form) {
    var fields = form.serializeArray();
    var data = {};
    $.map(fields, function(n, i) { data[n['name']] = n['value']; });
    $(form).find('div[name]').each(function(){
        if($(this).parents('.slipwi').is('.html')) data[$(this).attr('name')] = $(this).text();
        else data[$(this).attr('name')] = $(this).html();
    });
    return data;
}

$(document).on('click','#admin ul.panel li',function(){
    $('#admin ul.panel li').removeClass('active');
    $(this).addClass('active');
    $('#admin ul.listing, #admin div.edit').empty();
    if($(this).is('[file]')) {
        var file = $(this).attr('file');
        $('#admin ul.listing').attr('table',file).load('_admin/panel/'+file+'.php');
    }
    if($(this).is('[edit]')) {
        var file = $(this).attr('edit');
        $('#admin div.edit').load('_admin/edit/'+file+'.php');
    }
});

$(document).on('click','#admin [confirm=true]',function(){
    var action = $(this).attr('action');
    setTimeout(() => {
        $('#admin dialog').append('<div class="alert" action="'+action+'"><a id="abort">no</a><a id="confirm">yes</a></div>'); 
    }, 50);
});

$(document).on('click','#admin dialog .alert a',function(){
    var action = $(this).parent().attr('action');
    if(action == 'exit-admin') {
        if($(this).is('#confirm')) {
            $('#admin dialog').load('_admin/controllers/action.php',{action});
        }
    }
    if(action == 'delete') {
        if($(this).is('#confirm')) {
            $('#admin dialog').load('_admin/controllers/save.data.php',{data},function(){
                $(elem).detach();
            });
        }
    }
    $('#admin dialog').empty();
});

$(document).on('click','#admin ul.panel div.close-panel',function(){
    $('#admin ul.panel li').removeClass('active');
    $('#admin ul.listing, #admin div.edit').empty();
});

$(document).on('click','#admin div.alert',function(){
    $('#admin dialog').empty();
});

$(document).on('click','#admin li div i.next',function(){
    $(this).parent('div').parent('li').toggleClass('active');
});

$(document).on('click','#admin .add-edit',function(){
    var edit = {};
    edit['file'] = $(this).closest('[file]').attr('file');
    if($(this).closest('[id]').attr('id')) edit['id'] = $(this).closest('[id]').attr('id');
    $('#admin div.edit').load('_admin/edit/'+edit['file']+'.php',{edit});
});

$(document).on('click','#admin .list-rows',function(){
    var edit = {};
    edit['file'] = $(this).closest('[file]').attr('file');
    edit['id'] = $(this).closest('[id]').attr('id');
    $('#admin div.edit').load('_admin/list/'+edit['file']+'.php',{edit});
});

$(document).on('click','#admin #edit',function(){
    var edit = {};
    edit['file'] = $(this).closest('[file]').attr('file');
    edit['id'] = $(this).parents('[view_id]').attr('view_id');
    edit['record_id'] = $(this).parents('[id]').attr('id');
    $('#admin div.edit').load('_admin/edit/'+edit['file']+'.php',{edit});
});
$(document).on('click','#admin #public',function(){
    var data = {};
    data['table'] = $(this).closest('ul').attr('table');
    data['id'] = $(this).parents('[id]').attr('id');

    var public = $(this).parents('[id]').is('.off');
    if(public) {
        $(this).find('i').removeClass('mdi-eye-off').addClass('mdi-eye-outline');
        $(this).parents('[id]').removeClass('off');
        data['public'] = '1';
    }
    if(!public) {
        $(this).find('i').removeClass('mdi-eye-outline').addClass('mdi-eye-off');
        $(this).parents('[id]').addClass('off');
        data['public'] = '0';
    }
    $('#admin dialog').load('_admin/controllers/save.data.php',{data});
});

$(document).on('click','#admin #undel',function(){
    var data = {};
    data['table'] = $(this).closest('ul').attr('table');
    data['id'] = $(this).parents('[id]').attr('id');
    data['del'] = '0';
    $('#admin dialog').load('_admin/controllers/save.data.php',{data});
    $(this).parents('li').detach();
});

$(document).on('click','#admin #remove',function(){
    var data = {};
    data['remove'] = 'data';
    data['table'] = $(this).closest('ul').attr('table');
    data['id'] = $(this).parents('[id]').attr('id');
    $('#admin dialog').load('_admin/controllers/save.data.php',{data});
    $(this).parents('li').detach();
});

$(document).on('click','#admin ul.listing-records #del',function(){
    data = {};
    data['table'] = $(this).closest('ul.listing-records').attr('table');
    data['id'] = $(this).parents('[id]').attr('id');
    data['del'] = '1';
    elem = $(this).parents('li');
});

$(document).on('click','#admin .parents-menu li span',function(){
    var table = $(this).closest('[table]').attr('table');
    var list = $(this).closest('[table]').attr('list');
    $('#admin .parents-menu > div > span').text($(this).text());
    
    if(list) {
        var list = {};
        list['view'] = $(this).parents('.parents-menu').attr('view');
        list['page'] = $(this).parents('[page]').attr('page');
        list['note'] = $(this).parents('[note]').attr('note');
        if(!list['page']) list['page'] = 0;
        if(!list['note']) list['note'] = 0;
        $('#admin content').attr('page_id',list['page']);
        if(page) $('#admin content').attr('note_id',list['note']);
        $('#admin content').load('_admin/list/list.records.php',{list});
    }
    else {
        if(table == 'pages') {
            var parent = $(this).parents('[parent]').attr('parent');
            $('.edit form [name=parent_id]').val(parent);
        }
        if(table == 'records') {
            var view = $(this).parents('[view]').attr('view');
            var page = $(this).parents('[page]').attr('page');
            var note = $(this).parents('[note]').attr('note');

            $('.edit form [name=view_id]').val(view);
            if(page) $('.edit form [name=page_id]').val(page);
            else $('.edit form [name=page_id]').val(0);
            if(note) $('.edit form [name=note_id]').val(note);
            else $('.edit form [name=note_id]').val(0);
        }
    }
});
$(document).on('click','#admin .parents-menu li.service i',function(){
    var list = {};
    list['type'] = $(this).attr('type');
    list['view'] = $('#admin content').attr('view_id');
    list['page'] = $('#admin content').attr('page_id');
    list['note'] = $('#admin content').attr('note_id');
    $('#admin content').load('_admin/list/list.records.php',{list});
});


$(document).on('click','#admin .toolbar li',function(e){
    var act = $(this).attr('data-action');
    switch(act) {
        case('save'):
            $('.slipwi-content table div').detach();
            $('.slipwi-content .select').removeAttr('class');
            
            var form = $(this).parents('.edit').find('form');
            var data = saveData(form);
            $(this).addClass('save');
            setTimeout(() => { $(this).removeClass('save'); }, 1000);
            $('#admin dialog').load('_admin/controllers/save.data.php',{data},function(res){
                if(!res && data['table'] == 'pages') {
                    $('#admin ul.listing li[id="'+data['id']+'"]').find('span').text(data['menu']);
                    if(data['public'] == 1) $('#admin ul.listing li[id="'+data['id']+'"]').find('span').find('i').detach();
                    if(data['public'] == 0) $('#admin ul.listing li[id="'+data['id']+'"]').find('span').html(data['menu']+'<i class="mdi mdi-eye-off fs-3x"></i>');
                }
            });
        break;

        case('main'):
            var public = $(this).attr('data-status');
            if(public == '1') {
                $(this).attr('data-status','0').find('i').removeClass('mdi-toggle-switch').addClass('mdi-toggle-switch-off');
                $('#admin form [name=main]').val('0');
            }
            if(public == '0') {
                $(this).attr('data-status','1').find('i').removeClass('mdi-toggle-switch-off').addClass('mdi-toggle-switch');
                $('#admin form [name=main]').val('1');
            }
        break;

        case('public'):
            var public = $(this).attr('data-status');
            if(public == '1') {
                $(this).attr('data-status','0').find('i').removeClass('mdi-eye-outline').addClass('mdi-eye-off');
                $('#admin form [name=public]').val('0');
            }
            if(public == '0') {
                $(this).attr('data-status','1').find('i').removeClass('mdi-eye-off').addClass('mdi-eye-outline');
                $('#admin form [name=public]').val('1');
            }
        break;

        case('comment_set'):
            var public = $(this).attr('data-status');
            if(public == '1') {
                $(this).attr('data-status','0').find('i').removeClass('mdi-message-bulleted').addClass('mdi-message-bulleted-off');
                $('#admin form [name=comment_set]').val('0');
            }
            if(public == '0') {
                $(this).attr('data-status','1').find('i').removeClass('mdi-message-bulleted-off').addClass('mdi-message-bulleted');
                $('#admin form [name=comment_set]').val('1');
            }
        break;

        case('multitype'):
            $(this).find('li').removeAttr('class');
            $(e.target).addClass('select');
            $('#admin form [name=multitype]').val($(e.target).attr('multitype'));
        break;

        case('content'):
            $('ol.section-content li, .toolbar ul.section li').removeClass('select');
            $('ol.section-content li.content').addClass('select');
            $('div.cover, ul.this-gallery li').removeClass('select');
            $(this).addClass('select');
        break;

        case('gallery'):
            $('ol.section-content li, .toolbar ul.section li').removeClass('select');
            $('ol.section-content li.gallery').addClass('select');
            $(this).addClass('select');
        break;

        case('comments'):
            $('ol.section-content li, .toolbar ul.section li').removeClass('select');
            $('ol.section-content li.comments').addClass('select');
            $(this).addClass('select');
        break;

        case('analytics'):
            $('ol.section-content li, .toolbar ul.section li').removeClass('select');
            $('ol.section-content li.analytics').addClass('select');
            $(this).addClass('select');
        break;

        case('close'):
            $('#admin div.edit').empty();
        break;
    }
});
/* File Manager */
fileManager = function(){
    setTimeout(() => {
        var cat = $('ul.this-gallery').attr('path');
        $('#admin dialog').load('_admin/toolbars/toolbar.files.php',function(){
            $('#admin dialog .toolbar li[data-action="close"]').detach();
            $('#admin dialog .toolbar li.viewtype').removeClass('select');
            $('#admin dialog .toolbar li[data-action="viewgrid"]').addClass('select');
            $('#admin dialog').append('<dir id="files" class="viewgrid"></dir>');
            $('#admin dialog dir').load('_admin/controllers/files/read-folder.php',{cat});
        });
        
    }, 50);
}
/* Cover Gallery */
galleryCreate = function(){
    var i = 0;
    var gallery = [];
    $('.this-gallery li').each(function(){
        if($(this).attr('data-img')) {
            gallery[i] = $(this).attr('data-img');
            i++;
        }
    });
    if(gallery.length > 1) {
        gallery.join(',');
        gallery = 'arr:'+gallery;
    }
    else gallery = gallery[0];
    $('#admin div.edit form [name=gallery]').val(gallery);
}

$(document).on('dblclick','div.cover, div.alt, ul.this-gallery li:not(.plus)',function(){
    $('div.cover, div.alt, ul.this-gallery li').removeClass('select');
    $(this).addClass('select');
    fileManager();
});
$(document).on('click','ul.this-gallery li.plus',function(){
    $(this).before('<li><a class="clear"><i class="mdi mdi-eraser fs-4x"></i></a></li>');
});
$(document).on('dblclick','#admin dialog dir#files li.file',function(){
    if($(this).attr('type') == 'img') {
        var link = $(this).attr('data-path');
        if($('#admin content li.gallery').is('.select')) {
            if($('#admin content li.gallery div.cover').is('.select')) {
                $('#admin div.edit form [name=img]').val(link);
            }
            if($('#admin content li.gallery div.alt').is('.select')) {
                $('#admin div.edit form [name=altimg]').val(link);
            }
            setTimeout(() => {
                galleryCreate();
            }, 50);
            $('#admin content li.gallery .select').attr('style','background-image: url('+link+')').attr('data-img',link);
        } else {
            $('.slipwi img[src=null]').attr('src',link).removeAttr('class');
        }
        $('#admin dialog').empty();
    }
});
$(document).on('click','#admin content li.gallery a.clear',function(){
    if($(this).parent('li')) {
        $(this).parent('li').removeAttr('style').removeAttr('data-img');
        galleryCreate();
    }
    if($(this).parent('div.cover')) {
        $(this).parent('div.cover').removeAttr('style');
        $('#admin div.edit form [name=img]').val('');
    }
    if($(this).parent('div.alt')) {
        $(this).parent('div.alt').removeAttr('style');
        $('#admin div.edit form [name=altimg]').val('');
    }
});

/* Search Records */
$(document).on('keyup','.search-records [name=search]',function(e){
    var search = {};
    search['view_id'] = $('#admin content').attr('view_id');
    search['page_id'] = $('#admin content').attr('page_id');
    search['note_id'] = $('#admin content').attr('note_id');
    search['search'] = $(this).val();
    if(e.keyCode != 8 && search['search'].length >= 3) {
        $('#admin content').load('_admin/list/list.records.php',{search});
    }
    else if(e.keyCode == 8 && search['search'].length == 0) {
        $('#admin content').load('_admin/list/list.records.php',{search});
    }
});

$(document).click(function(e){
    var div = $("#admin dialog");
    if(!div.is(e.target) && div.has(e.target).length === 0) {
		div.empty();
	}
});

/* FileManager */
confirmDel = function(){
    if(confirm("Удалить выбранные объекты?")) { return true; }
    else { return false; }
}
// Open Folder
$(document).on('dblclick','#admin dir#files li.folder',function(){
    cat = $(this).attr('cat');
    $('#admin').append('<wait><i class="mdi mdi-loading mdi-spin"></i></wait>');
    $('#admin dir#files').load('_admin/controllers/files/read-folder.php',{cat},function(){
        if($('ul.this-gallery')) $('ul.this-gallery').attr('path',cat);
        $('#admin wait').detach();
    });
});
// Open File
$(document).on('dblclick','#admin :not(dialog) dir#files li.file',function(){
    open = {};
    open['path'] = $('div[path]').attr('path');
    open['file'] = $(this).attr('file');
    open['type'] = $(this).attr('type');
    $('#admin').append('<wait><i class="mdi mdi-loading mdi-spin"></i></wait>');
    $('#admin dialog').load('_admin/controllers/files/open-file.php',{open},function(){
        $('#admin wait').detach();
    });
});
// Select Items
$(document).on('click','#admin dir#files li',function(k){
    k.preventDefault();
    if(k.altKey) {
        $(this).toggleClass('select');
    }
    else if(k.shiftKey) {
        $(this).toggleClass('select');
        i=0;
        $('#admin dir#files li').each(function(){
            if($(this).is('.select')) i++;
            if(i==1) $(this).addClass('select');
            if(i>2) { return; }
        });
    }
    else {
        $('#admin dir#files li').removeClass('select');
        setTimeout(() => {
            if(!$(this).is('.back')) $(this).addClass('select');
        }, 100);
    }
    setTimeout(() => {
        if($('dir#files li').is('.select')) {
            $('.toolbar [data-action="cut"], .toolbar [data-action="delete"]').removeClass('none');
        }
        else {
            $('.toolbar [data-action="cut"], .toolbar [data-action="delete"]').addClass('none');
        }
    }, 200);
});
// View Type
$(document).on('click','#admin .toolbar .viewtype',function(){
    $('#admin .toolbar .viewtype').removeClass('select');
    $(this).addClass('select');
    $('#admin dir#files').removeAttr('class').addClass($(this).attr('data-action'));
});
// Actions
$(document).on('click','#admin .toolbar .action:not(.none)',function(){
    if($(this).attr('data-action') != 'paste') {
        action = {};
        action['type'] = $(this).attr('data-action');
        action['path'] = $('div[path]').attr('path');
        i=1;
        $('#admin dir#files li.select').each(function(){
            action['file_'+i] = $(this).attr('file');
            i++;
        });
    }
    else {
        action['type'] = 'paste';
        action['newpath'] = $('div[path]').attr('path');
    }
    if($('#admin dir#files li.select i').is('.system')) {
        alert('Выбран объект который Защищен от Удаления и Переноса!');
        return;
    }
    // Cut Files
    if(action['type'] == 'cut') {
        $('#admin dir#files li').removeClass('cut');
        $('#admin dir#files li.select').addClass('cut');
    }
    if(action['type'] == 'paste') {
        $('#admin dir#files li.select').addClass('cut');
        if(action['newpath'] == action['path']) {
            $('#admin dir#files li.select').removeClass('cut');
        }
        else {
            actionManager(action,cat);
        }
    }
    // Delete Files Or Folders
    if(action['type'] == 'delete' && confirmDel()) {
        actionManager(action,'');
    }
    // NewFolder
    if(action['type'] == 'newfolder') {
        $('#admin dir#files li').removeClass('select');
        $('#admin dir#files').append('<li class="folder newfolder" cat="NewFolder" file="NewFolder"><i class="mdi mdi-folder"></i><p>NewFolder</p></li>');
        $('.newfolder p').attr('contenteditable','true').focus().parents('li').addClass('select');
    }
});
$(document).on('click','#admin dir#files li:not([help]).select p',function(){
    $(this).attr('contenteditable','true').focus();
});
$(document).on('keydown','#admin dir#files li.select p[contenteditable]',function(e){
    if(e.which == 13) {
        e.preventDefault();
        $(this).blur();
    }
});
$(document).on('blur','#admin dir#files li.select p',function(){
    action = {};
    if($(this).parents('li').is('.newfolder')) {
        action['type'] = 'newfolder';
    }
    else {
        action['type'] = 'rename';
        action['item'] = $(this).parents('li').attr('file');
    }
    action['path'] = $('div[path]').attr('path');
    action['newname'] = $(this).text();
    $(this).removeAttr('contenteditable').parents('li').removeClass('newfolder');
    if(action['item'] != action['newname']){
        actionManager(action,cat);
    }
});

function actionManager(action,cat){
    $('#admin').append('<wait><i class="mdi mdi-loading mdi-spin"></i></wait>');
    $('#admin dialog').load('_admin/controllers/files/open-file.php',{action},function(){
        if(action['type'] == 'delete') { $('#admin dir#files li.select').detach(); }
        if(action['newpath']) { $('#admin dir#files').load('_admin/controllers/files/read-folder.php',{cat}); }
        $('#admin wait').detach();
    });
}

/* UploadFiles */
$(document).on('click','[data-action="upload"]',function() {
    var files;
    var path = $('#admin div[path]').attr('path');
    var cat = $('#admin div[path]').attr('cat');
    $('#admin dir#files input[type=file]').val('').detach();
    $('#admin dir#files').append('<input type="file" multiple="multiple" accept=".txt,image/*">');
    $('#admin dir#files input[type=file]').trigger('click');
    
    $('#admin dir#files input[type=file]').change(function() {
        $('#admin').append('<wait><i class="mdi mdi-loading mdi-spin"></i>upload</wait>');

        files = this.files;

        if(typeof files == 'undefined') {
            $('#admin dir#files input[type=file]').val('').detach();
            return;
        }

        var data = new FormData();
        
        $.each(files,function(key,value){
            data.append(key,value);
        });
        data.append('upload',1);
        data.append('path',path);
        
        console.log(data);
        // return;

        $.ajax({
            url: '_admin/controllers/files/upload-files.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function(html) {
                console.log(html);
            },
            complete: function(html) {
                $('#admin dir#files input[type=file]').val('').detach();
                $('#admin dir#files').load('_admin/controllers/files/read-folder.php',{cat});
                $('#admin wait').detach();
            },
            error: function(html) {
                console.log(html);
            }
        });
    });
});

$(document).on('focus','[name=date], [name=fin_date]',function(){
    $("#admin form .select").removeClass('select');
    $(this).parent('div').addClass('select');
    setTimeout(() => {
        $('#admin dialog').load('_admin/widgets/calendar.php',{data:''});
    }, 50);
});
$(document).on('click','.calendaradmin [date]',function(){
    var date = $(this).attr('date');
    $('div.select input').val(date);
    $('.calendaradmin [date]').removeClass('select');
    $(this).addClass('select');
});

$(document).on('click','.calendaradmin mont a',function(){
    var data = {};
    data['mont'] = $(this).attr('mont');
    data['year'] = $(this).attr('year');
    $('#admin dialog').load('_admin/widgets/calendar.php',{data});
});

$(document).click(function(e){
    var div = $("#admin form .select");
    var dia = $("#admin dialog")
    if((!div.is(e.target) && div.has(e.target).length === 0) && (!dia.is(e.target) && dia.has(e.target).length === 0)) {
		div.removeClass('select');
	}
});

$(document).on('focus','[name=time]',function(){
    $("#admin form .select").removeClass('select');
    $(this).parent('div').addClass('select');
    var data = {};
    var time = $(this).val();
    time = time.split(':');
    data['h'] = time[0];
    data['i'] = time[1];
    setTimeout(() => {
        $('#admin dialog').load('_admin/widgets/clock.php',{data});
    }, 50);
});

$(document).on('click','#admin dialog .clock i',function(){
    var t = Number($(this).parent('div').find('li').text());
    if($(this).parent('div').is('.hour')) { var max = 23; step = 1;}
    else { var max = 55; var step = 5;}
    if($(this).is('.next')) {
        if(t < max) { t = t+step; }
        else t = 0;
    }
    if($(this).is('.prev')) {
        if(t > 0) { t = t-step; }
        else t = max;
    }
    if(t < 10) t = '0'+t;
    $(this).parent('div').find('li').text(t);
    setTimeout(() => {
        var time = $('#admin dialog .clock .hour li').text();
        time += ':' + $('#admin dialog .clock .minute li').text();
        $('#admin form .select').find('input').val(time+':00');
    }, 50);
});

$(document).on('click','#admin form .clear',function(){
    $(this).parent('span').parent('div').find('input').val('');
});

/* SlipWi Editor */
// $(document).ready(function() {
    $('.slipwi .slipwi-content').attr('contenteditable','true');

    document.execCommand("defaultParagraphSeparator", false, "p");

    mousedown = false;
    $(document).on('mousedown','.slipwi .slipwi-content',function(){
        mousedown = true;
    });
    $(document).on('mouseup','.slipwi .slipwi-content',function(){
        mousedown = false;
    });

    $elements = '.slipwi .slipwi-content img, .slipwi .slipwi-content video, .slipwi .slipwi-content iframe';
    $(document).on('click',$elements,function(){
        var $elem = $(this).closest('#wrap-select').attr('id');
        if($elem != 'wrap-select') {
            var $obj = $(this);
            if($(this).is('img') || $(this).is('video') || $(this).is('iframe')) {
                $(this).wrap('<div style="display: inline-block" id="wrap-select"></div>');
            }
            else {
                $(this).wrap('<div id="wrap-select"></div>');
            }
        }
    });
    $(document).on('mouseleave','.slipwi .slipwi-content *',function(){
        var $elem = $(this).closest('#wrap-select').attr('id');
        if($elem != 'wrap-select') $('#wrap-select').children().unwrap();
    });
    $(document).on('mousedown','#wrap-select',function(el){
        console.log(el);
    });

    $('.slipwi .conten').focus();
    addoneFunc = function() {
        newSort();
        var colorPalette = [
            'BFEDD2', 'FBEEB8', 'F8CAC6', 'ECCAFA', 'C2E0F4',
            '2DC26B', 'F1C40F', 'E03E2D', 'B96AD9', '3598DB',
            '169179', 'E67E23', 'BA372A', '843FA1', '236FA1',
            'ECF0F1', 'CED4D9', '95A5A6', '7E8C8D', '34495E',
            'FFFFFF', 'DDDDDD', 'AAAAAA', '555555'
        ];
        
        for (var i = 0; i < colorPalette.length; i++) {
            $('.color').append('<a href="#" data-command="forecolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
            $('.marker').append('<a href="#" data-command="backcolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
            $('.fill').append('<a href="#" data-command="fill" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
        }
        $('.color, .marker, .fill').append('<a href="#" data-command="fill" data-value=""><i class="mdi mdi-palette fs-4x"></i></a>');
        // Table Selector
        var r = 1;
        var table = '<table>';
        while (r <= 9) {
            var c = 1;
            table = table+'<tr>';
            while (c <= 9) {
                table = table+'<td row="'+r+'" col="'+c+'"></td>';
                c++;
            }
            table = table+'</tr>';
            r++;
        }
        table = table+'</table><p>0 x 0</p>';
        $('.seltable').append(table);
        // Block Selector
        var r = 1;
        var block = '<table>';
        while (r <= 7) {
            var c = 1;
            block = block+'<tr>';
            while (c <= 5) {
                block = block+'<td row="'+r+'" col="'+c+'"></td>';
                c++;
            }
            block = block+'</tr>';
            r++;
        }
        block = block+'</table><p>0 x 0</p>';
        $('.selblock').append(block);
    }
    
    $(document).on('mouseenter','.seltable table td, .selblock table td',function() {
        var $row = $(this).attr('row');
        var $col = $(this).attr('col');
        $('.seltable td, .selblock td').each(function(){
            if($(this).attr('row') <= $row && $(this).attr('col') <= $col) {
                $(this).addClass('select');
            }
            else {
                $(this).removeClass('select');
            }
        });
        $('.seltable p, .selblock p').text($col+' x '+$row);
    });
    $(document).on('mouseleave','.seltable, .selblock',function() {
        $(this).find('td').removeAttr('class');
        $(this).find('p').text('0 x 0');
    });
    
    $(document).on('click','.seltable td',function() {
        var $row = $(this).attr('row');
        var $col = $(this).attr('col');
        
        var r = 1;
        var table = '<table>';
        while (r <= $row) {
            var c = 1;
            table = table+'<tr>';
            while (c <= $col) {
                table = table+'<td></td>';
                c++;
            }
            table = table+'</tr>';
            r++;
        }
        table = table+'</table>';
        
        $(this).closest('li.table').addClass('hide');
        setTimeout(() => {
            $(this).closest('li.table').removeClass('hide');
        }, 100);
        
        document.execCommand('insertHTML', false, table);
    });

    $(document).on('click','.selblock td',function() {
        var $row = $(this).attr('row');
        var $col = $(this).attr('col');
        
        var r = 1;
        var block = '<ul cols="'+$col+'">';
        while (r <= $col*$row) { block = block+'<li></li>'; r++; }
        block = block+'</ul>';
        
        $(this).closest('li.table').addClass('hide');
        setTimeout(() => {
            $(this).closest('li.table').removeClass('hide');
        }, 100);
        
        document.execCommand('insertHTML', false, block);
    });
    
    $(document).on('click','.slipwi-toolbar a',function(e) {
        e.preventDefault();
        var command = $(this).data('command');
        var contain = $(this).closest('.slipwi').find('.slipwi-content');
        if(command == 'insertHTML') {
            if($(this).data('value') == 'video') {
                url = prompt('Enter the link here: ','https://');
                var $html = '<video src="'+url+'"></video>';
            }
            if($(this).data('value') == 'iframe') {
                url = prompt('Enter the link here: ','https://');
                var $html = '<iframe src="'+url+'"></iframe>';
            }
            if($(this).data('value') == 'audio') {
                url = prompt('Enter the link here: ','https://');
                var $html = '<audio src="'+url+'" controls="controls"></audio>';
            }
            if($(this).data('value') == 'code') {
                code = document.getSelection();
                var $html = '<pre class="code">'+code+'</pre>';
            }
    
            document.execCommand($(this).data('command'), false, $html);
        }
        else if(command == 'viewHtml') {
            $('.slipwi .slipwi-content table td').removeAttr('class');
            $('.slipwi .slipwi-content table div').detach();
            $(this).closest('.slipwi').toggleClass('html');
            if($('.slipwi').is('html')) {
                $('.slipwi .slipwi-content').attr('spellcheck',false);
            }
            else {
                $('.slipwi .slipwi-content').attr('spellcheck',true);
            }
            $(this).toggleClass('active');
            if($(this).is('.active')) {
                $text = $(contain).html();
                $text = $text.replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#39;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
                
                var $tags = [
                    'h1','h2','h3','h4','h5','h6','p','ul','ol','li','div','pre','section','blockquote','article','table','thead','tbody','tr'
                ];
                $tags.forEach(tag => {
                    var regex = new RegExp('/'+tag+'&gt;','g');
                    var legex = new RegExp('&lt;'+tag+'&gt;','g');
                    if(tag == 'ul' || tag == 'ol' || tag == 'thead' || tag == 'tbody') {
                        $text = $text.replace(legex, '&lt;'+tag+'&gt;<br>');
                    }
                    $text = $text.replace(regex, '/'+tag+'&gt;<br>');
                });
                var $tags = [
                    '/thead','/tbody','thead','tbody','tr','li'
                ];
                $tags.forEach(tag => {
                    var regex = new RegExp('&lt;'+tag,'g');
                    if(tag == 'thead' || tag == 'tbody') $text = $text.replace(regex, '<br><tab></tab>&lt;'+tag);
                    if(tag == '/thead' || tag == '/tbody') $text = $text.replace(regex, '<tab></tab>&lt;'+tag);
                    if(tag == 'tr') $text = $text.replace(regex, '<tab></tab><tab></tab>&lt;'+tag);
                    if(tag == 'li') $text = $text.replace(regex, '<tab></tab>&lt;'+tag);
                });
                var $attr = [
                    ' href',' url',' src',' style',' class',' id'
                ];
                
                $text = $text.replace(/&quot;/g, '<s>&quot;</s>');
                $text = $text.replace(/=/g, '<s>=</s>');
                $text = $text.replace(/&lt;/g, '<tag><s>&lt;</s>');
                $text = $text.replace(/&gt;/g, '<s>&gt;</s></tag>');
                $attr.forEach(attr => {
                    var regex = new RegExp(attr,'g');
                    $text = $text.replace(regex, '<b>'+attr+'</b>');
                });
                
                $(contain).html($text);
            }
            else {
                $(contain).html($(contain).text());
            }
        }
        else if(command == 'clearFormat') {
            var $attr = [
                'style','class','color','width','height','align','face','name','lang','valign','border','cellspacing','cellpadding','itemprop'
            ];
            var $tags = [
                'o:p'
            ];
            // clear tags
            $tags.forEach(tag => {
                $(contain).find(tag).detach();
            });
            // clear attr
            $attr.forEach(attr => {
                $(contain).find('*').removeAttr(attr);
            });
            // select
            $text = $(contain).html();
            // clear MS Word text
            $text = $text.replace(/&nbsp;/g, ' ');
            var prestart = $text.split('<!--[if gte mso 9]>')[0];
            $text = prestart+$text.split('<!--StartFragment-->')[1];
            if($text) {
                $text = $text.split('<!--EndFragment-->').join('');
                $text = $text.split('<o:p></o:p>').join('');
                $text = $text.split('<o:p> </o:p>').join('');
                // $text = $text.split('&nbsp;').join(' ');
            }
            $text = $text.split('\n\n').join('');
            $text = $text.split('\t\t').join('');
            $text = $text.split('undefined').join('');
            // paste
            $(contain).html($text);
            // clear Table
            $(contain).find('td').each(function(){
                var text = $(this).text();
                text = $.trim(text);
                text = text.split('\n').join(' ');
                $(this).text(text);
            });
        }
        else if(command == 'h1' || command == 'h2' || command == 'h3' || command == 'h4' || command == 'h5' || command == 'h6' || command == 'p' || command == 'section' || command == 'blockquote' || command == 'pre' || command == 'article') {
            document.execCommand('formatBlock', false, command);
        }
        else if(command == 'forecolor' || command == 'backcolor') {
            document.execCommand($(this).data('command'), false, $(this).data('value'));
        }
        else if(command == 'fill') {
            if($(this).data('value') != '#FFFFFF') {
                $('td.select, td.selected, li.select, li.selected').css('background',$(this).data('value'));
            }
            else {
                $('td.select, td.selected, li.select, li.selected').removeAttr('style');
            }
        }
        else if(command == 'fontSize') {
            var el = document.getSelection();
            var node = el.focusNode;
            var parent = el.focusNode.parentElement;
            $(parent).css('font-size',$(this).data('value'));
        }
        else if(command == 'lineSpacing') {
            var el = document.getSelection();
            var node = el.focusNode;
            var parent = el.focusNode.parentElement;
            $(parent).css('line-height',$(this).data('value'));
        }
        else if(command == 'createlink') {
            url = prompt('Enter the link here: ','https://');
            if(url) document.execCommand($(this).data('command'), false, url);
        }
        else if(command == 'insertimage') {
            $('[src=null]').detach();
            document.execCommand($(this).data('command'), false, null);
            $('.slipwi img[src=null]').addClass('select');
            fileManager();
        }
        else if(command == 'insertText') {
            text = document.getSelection();
            document.execCommand($(this).data('command'), false, text);
        }
        
        else document.execCommand($(this).data('command'), false, null);
    });
    
    $(document).on('dblclick','.slipwi-content a',function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        url = prompt('Edit the link here: ', url);
        if(url) $(this).attr('href',url);
    });
    $(document).on('dblclick','.slipwi-content video, .slipwi-content iframe',function(e) {
        var url = $(this).attr('src');
        url = prompt('Edit the link here: ', url);
        if(url) $(this).attr('src',url);
        else $(this).detach();
    });
    
    $(document).on('mousedown','.slipwi-content',function(el){
        // console.log(el);
        if($(el.toElement).is('td')) {
            $('.td-fill').show();
            $(el.toElement.offsetParent).find('td').removeAttr('class');
            $(el.toElement).addClass('select');
        }
        else if(!$(el.toElement).is('i') && !$(el.toElement).is('a')) {
            $('.slipwi .slipwi-content table td').removeAttr('class');
            $('.td-fill').hide();
        }

        if($(el.toElement.offsetParent).is('table')) {
            $('.slipwi .slipwi-content table div').detach();
            $('.slipwi .slipwi-content table td.select').trigger('select');
            $(el.toElement.offsetParent).append('<div class="table-set" contenteditable="false">'
            +'<a action="append-col" help="Unordered List"><i class="mdi mdi-table-column-plus-before fs-3x"></i></a>'
            +'<a action="prepend-col" help="Unordered List"><i class="mdi mdi-table-column-plus-after fs-3x"></i></a>'
            +'<a action="append-row" help="Unordered List"><i class="mdi mdi-table-row-plus-before fs-3x"></i></a>'
            +'<a action="prepend-row" help="Unordered List"><i class="mdi mdi-table-row-plus-after fs-3x"></i></a>'
            +'<a action="remove-col" help="Unordered List"><i class="mdi mdi-table-column-remove fs-3x"></i></a>'
            +'<a action="remove-row" help="Unordered List"><i class="mdi mdi-table-row-remove fs-3x"></i></a>'
            +'<a action="select-all" help="Unordered List"><i class="mdi mdi-tab-unselected fs-3x"></i></a>'
            +'</div>');
        }
        else if(!$(el.toElement).is('i') && !$(el.toElement).is('a')) {
            $('.slipwi .slipwi-content table div').detach();
            $('.slipwi .slipwi-content td').removeAttr('selected');
        }
        // $(document).on('mouseleave','.slipwi .slipwi-content table',function(){
        //     $('.slipwi .slipwi-content table div').detach();
        //     $('.slipwi .slipwi-content table .select').removeAttr('class');
        // });
    });

    $(document).on('mousedown','.slipwi-content',function(el){
        console.log();
        if($(el.toElement.offsetParent).is('[cols]')) {
            $('.td-fill').show();
            $(el.toElement.offsetParent).find('li').removeAttr('class');
            $(el.toElement).addClass('select');
        }
        else {
            $('.slipwi .slipwi-content [cols] li').removeAttr('class');
        }
    });

    $(document).on('mouseenter','.slipwi .slipwi-content td, .slipwi .slipwi-content [cols] li',function(){
        if(mousedown) {
            $(this).addClass('selected');
            // $(this).prev().addClass('selected');
        }
    });

    $(document).on('click','.table-set a',function(){
        var act = $(this).attr('action');
        var table = $(this).closest('table');
        var row = $(this).closest('table').find('td.select').parent('tr');
        var col = $('.slipwi .slipwi-content table td.select');
        var colnum = col[0].cellIndex+1;
        var rowcol = $(this).closest('table').find('td.select').parent('tr').find('td').length;
        
        var c = 1;
        var rows = '<tr>';
        while (c <= rowcol) { rows = rows+'<td></td>'; c++; }
        rows = rows+'</tr>';
        
        if(act == 'append-row') { $(row).before(rows); }
        if(act == 'prepend-row') { $(row).after(rows); }
        if(act == 'remove-row') {
            if($(table).find('tr').length > 1) $(row).detach();
        }
        if(act == 'append-col') {
            $(this).closest('table').find('tr').each(function(){
                $(this).find('td:nth-child('+colnum+')').before('<td></td>');
            });
        }
        if(act == 'prepend-col') {
            $(this).closest('table').find('tr').each(function(){
                $(this).find('td:nth-child('+colnum+')').after('<td></td>');
            });
        }
        if(act == 'remove-col') {
            $(this).closest('table').find('tr').each(function(){
                if($(this).find('td').length > 1) $(this).find('td:nth-child('+colnum+')').detach();
            });
        }
        if(act == 'select-all') {
            $(this).closest('table').find('td').addClass('selected');
        }
    });
    
    $(document).on('click','.slipwi-content img',function(){
        $(this).attr('resizing',true);
    });
    $(document).on('click','.slipwi .slipwi-toolbar a.max',function(){
        $(this).closest('.slipwi').addClass('max');
    });
    $(document).on('click','.slipwi .slipwi-toolbar a.min',function(){
        $(this).closest('.slipwi').removeClass('max');
    });

    addoneFunc();
// });