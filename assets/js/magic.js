/* © LeoCRAFT Digital, Magic JS for "Catana" https://catana.leocraft.digital */
document.addEventListener('DOMContentLoaded', function(){
    setTimeout(document.querySelector('body').removeAttribute('id'), 150);

    width = window.innerWidth;
    height = window.innerHeight;

    var nav = document.querySelector('nav');
    var hnav = window.getComputedStyle(nav, null).height;
    document.getElementById('listener').style.height = hnav;

    mobilenav.onclick = function() {
        document.querySelector('nav').classList.toggle("active");
    }

    var shape = document.querySelectorAll('[shape]');
    shape.forEach(function(item){
        var prop = item.getAttribute('shape');
        var covers = item.querySelectorAll('.cover');
        var w = covers[0].clientWidth;
        var shape = {
            square: w,
            wide:   w/16*9,
            letter: w/4*3,
            high:   w*1.5,
            tower:  w*2
        };
        covers.forEach(function(cover){
            cover.style.height = shape[prop] + 'px';
        });
    });

    window.addEventListener('scroll', function() {
        show();
        showVisible();
        var fix = document.querySelector('#listener');
        var off = fix.getBoundingClientRect();
        if(off.top <= 0) { document.querySelector('nav').classList.add('fixed'); }
        else { document.querySelector('nav').classList.remove('fixed'); }
    });

    function isVisible(elem) {
        let coords = elem.getBoundingClientRect();
        let windowHeight = document.documentElement.clientHeight;
        let topVisible = coords.top > 0 && coords.top < windowHeight;
        let bottomVisible = coords.bottom < windowHeight && coords.bottom > 0;
        return topVisible || bottomVisible;
    }
    function showVisible() {
        for(let img of document.querySelectorAll('[data-src]')) {
            let realSrc = img.dataset.src;
            if(!realSrc) continue;
            if(isVisible(img)) {
                if(img.classList.contains('cover')) img.style.backgroundImage = "url('"+realSrc+"')";
                else img.src = realSrc;
                img.removeAttribute('data-src');
            }
        }
    }
    function show() {
        setTimeout(function(){
            var hide = document.querySelectorAll('.hide');
            hide.forEach(function(item){
                var box = item.getBoundingClientRect();
                if(box.top < height) {
                    setTimeout(function() { item.classList.remove('hide') }, 200);
                }
            });
        }, 200);
    }

    show();
    showVisible();
    // Smoth Scroll to #anchor
    const anchors = document.querySelectorAll('a[href*="#"]');
    for(let anchor of anchors) {
        anchor.addEventListener('click',function(e) {
            e.preventDefault()
            const blockID = anchor.getAttribute('href').substr(1)
            document.getElementById(blockID).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    }
});