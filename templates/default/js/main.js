
function scrollToBox(idBox){
    $('html,body').animate({ scrollTop: $("#"+idBox).offset().top}, 'slow');
}
function slider_team(){
    var owl = $("#slider_team");
    owl.owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        pagination: false,
        responsive:{
            0:{ items:1},
            600:{ items:1},
            1000:{ items:1}
        }
    })
    $(".prev-team").click(function () {
        owl.trigger('prev.owl.carousel');
    });

    $(".next-team").click(function () {
        owl.trigger('next.owl.carousel');
    });
}


function slider_item(index){
    var owl = $("#slider_item"+index);
    owl.owlCarousel({
        margin:30,
        responsive:{
            0:{ items:1},
            600:{ items:21},
            1000:{ items:2},
            1200:{ items:2}
        },
        pagination: false,
        navigation : false

    });
    $(".prev"+index).click(function () {
        owl.trigger('prev.owl.carousel');
    });

    $(".next"+index).click(function () {
        owl.trigger('next.owl.carousel');
    });
}

function slider_feedback(){
    var owl = $("#slider_feedback");
    owl.owlCarousel({
        loop:true,
        margin:30,
        nav:false,
        pagination: false,
        responsive:{
            0:{ items:1},
            600:{ items:2},
            1000:{ items:2}
        }
    })
    $(".prev-feedback").click(function () {
        owl.trigger('prev.owl.carousel');
    });

    $(".next-feedback").click(function () {
        owl.trigger('next.owl.carousel');
    });
}


$(document).ready(function() {
    $('.navbar .dropdown .bulet-dropdown').click(function(){
        //$('.dropdown-menu').hide();
        $(this).parent().find('.dropdown-menu').toggle();
        $(this).parent().toggleClass('nav-pos');
    })
});


