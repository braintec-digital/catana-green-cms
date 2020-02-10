/* © LeoCRAFT Digital, Magic jQuery for "Catana" https://catana.leocraft.digital */
$(document).ready(function(){
    
    $('nav button').click(function(){
        $('nav').toggleClass('active');
    })
    $('.listener').height($('nav#fix').height());

    $(document).scroll(function(){
        var lis = $(document).scrollTop();
        var nav = $('.listener').offset().top;
        if (lis >= nav) { $('nav#fix').addClass('fixed'); }
        else { $('nav#fix').removeClass('fixed'); }

        show();
    });

    width = $(window).width();
    height = $(window).height();
    setTimeout(() => {
        $('body').removeAttr('id');
    }, 250);

    $('[shape]').each(function(){
        var prop = $(this).attr('shape');
        var w = $(this).find('.cover:first').width();
        let shape = {
            square: w,
            wide:   w/16*9,
            letter: w/4*3,
            high:   w*1.5,
            tower:  w*2
        };
        $(this).find('.cover').height(shape[prop]);
    });

    show = function() {
        clearTimeout();
        setTimeout(() => {
            $('.hide').each(function(i, el) {
                var d = $(document).scrollTop();
                var marg = d+height;
                if($(el).offset().top < marg) {
                    setTimeout(function() { $(el).removeClass('hide'); }, i * 200);
                }
            });
        }, 250);
    }
     
    show();

});