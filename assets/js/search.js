gosearch.onclick = function() {
    var find = document.querySelector('#searchpanel input').value;
    var link = document.querySelector('#searchpanel').getAttribute('link');
    if(find.length > 2) document.location.href = link+'/find='+find;
}
document.querySelector('input').addEventListener('keydown', function(e) {
    if(e.keyCode === 13) {
        var find = document.querySelector('#searchpanel input').value;
        var link = document.querySelector('#searchpanel').getAttribute('link');
        if(find.length > 2) document.location.href = link+'/find='+find;
    }
});