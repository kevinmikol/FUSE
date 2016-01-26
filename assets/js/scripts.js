$(document).ready(function() {
    $('#header-video').backgroundVideo({
        pauseVideoOnViewLoss: true
    });
    
    var date = new Date();
    setInterval(function(){
        var data = getCountdown(date);
        $('.countdown .seconds').text(data['seconds']);
        $('.countdown .minutes').text(data['minutes']);
        $('.countdown .hours').text(data['hours']);
        $('.countdown .days').text(data['days']);
    }, 1000);
});

$("#video-wrap .arrow").click(function() {
    $('html, body').animate({
        scrollTop: $(".cta").offset().top
    }, 1000);
});

var headerHeight = $(".cta").offset().top;

$(window).scroll(function(){
    var top = $(window).scrollTop();
    if(top > headerHeight){
        $('nav').css('background','rgba(255, 0, 0, 0.5)');
    }else{
        $('nav').css('background','rgba(0, 0, 0, 0)');
    }
});

var offset = get_time_zone_offset();

function getCountdown(collision){
    data = new Array;
    
    var now = new Date();
    now.setHours(now.getHours() + (offset-5));
    //var seconds = Math.ceil((collision.getTime() - now.getTime()) * 0.001);
    //var minutes = Math.ceil(seconds/60);
    //var hours = Math.ceil(seconds/60/60 * 10)/10;
    //var days = Math.ceil((seconds/60/60/24) * 100)/100;
    data['seconds'] = Math.floor((collision.getTime() - now.getTime()) * 0.001);
    data['minutes'] = (Math.floor(data['seconds']/60) % 60); //60 minutes in an hour
    data['hours'] = (Math.floor(data['seconds']/60/60 * 10)/10) % 24; //24 hours in a day
    data['days'] = Math.floor((data['seconds']/60/60/24));
    //var weeks = Math.ceil((days/7) * 100)/100;
    
    return data;
}

function get_time_zone_offset(){
    var current_date = new Date();
    var gmt_offset = current_date.getTimezoneOffset()/60;
    return gmt_offset;
}