calendar = function(year,mont) {
    var load = new XMLHttpRequest();
    load.open("POST", 'engine/widgets/calendar.php', true);
    load.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    load.onload = function() {
        document.querySelector('.calendar').outerHTML = load.responseText;
    }
    load.send('year='+year+'&mont='+mont);
}
document.addEventListener('mouseover',function(){
    prevmont.addEventListener('click',function(){
        var year = prevmont.getAttribute('year');
        var mont = prevmont.getAttribute('mont');
        calendar(year,mont);
    }, false);
    nextmont.addEventListener('click',function(){
        var year = nextmont.getAttribute('year');
        var mont = nextmont.getAttribute('mont');
        calendar(year,mont);
    }, false);
});