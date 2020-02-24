nextRecords = function() {
    var block = document.querySelector('.next-case').closest('section').getAttribute('class');
    var rows = document.querySelectorAll('.next-case > *').length;
    block = block.split(' ')[0];
    var next = new XMLHttpRequest();
    next.open("POST", 'engine/core/controllers/next.php', true);
    next.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    next.responseType = 'json';
    next.onload = function() {
        var records = next.response;
        console.log(records);
        if(records[0] != 0) {
            document.querySelector('#nextrecords').setAttribute('left',records[0]);
            records.splice(0, 1);
        }
        else {
            records.splice(0, 1);
            document.querySelector('#nextrecords').remove();
        }
        if(records.length) {
            records.forEach(function(item){
                document.querySelector('.next-case').innerHTML += item;
            });
            shape();
            show();
            showCover();
        }
    }
    next.send('block='+block+'&rows='+rows);
}