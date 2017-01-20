$('#video-wrap').css('height', $(window).height());

$(window).bind("load", function() {
	$('.loading').fadeOut();
});

$(document).ready(function() {
    $('#header-video').backgroundVideo({
        pauseVideoOnViewLoss: true
    });
    
    $(".countdown").TimeCircles({
	   	bg_width: 1,
	   	fg_width: .05,
	   	time: {
	        Days: { color: "#9E1F63" },
	        Hours: { color: "#BE1E2D" },
	        Minutes: { color: "#F15A29" },
	        Seconds: { color: "#F7941E" }
	    }
	});
	
	$(".fancybox").fancybox({padding : 0});
	
	var parent = $('.sponsors');
	var pheight = parent.height();
	
	$('.sponsors img').each(function(){
		var cheight = $(this).height();
		$(this).css('marginTop', ((100*(1-(cheight/pheight)))/2) + '%');
	});
	
});


$("#video-wrap .arrow").click(function() {
    $('html, body').animate({
        scrollTop: $(".cta").offset().top-$('nav').height()
    }, 1000);
});

if($('body').hasClass('home')){
	$(window).scroll(function(){
	    var top = $(window).scrollTop();
	    if(top > $(".cta").offset().top-$('nav').height()){
	        $('nav').css('background','rgba(35, 31, 32, 1)');
	    }else{
	        $('nav').css('background','rgba(35, 31, 32, 0.8)');
	    }
	});
}


/*
$('.google-map iframe').addClass('scrolloff');                // set the mouse events to none when doc is ready

$('.google-map .overlay').on("mouseup",function(){          // lock it when mouse up
    $('.google-map iframe').addClass('scrolloff'); 
    //somehow the mouseup event doesn't get call...
});
$('.google-map .overlay').on("mousedown",function(){        // when mouse down, set the mouse events free
    $('.google-map iframe').removeClass('scrolloff');
});

$(".google-map iframe").mouseleave(function () {              // becuase the mouse up doesn't work... 
    $('.google-map iframe').addClass('scrolloff');            // set the pointer events to none when mouse leaves the map area
                                                // or you can do it on some other event
});
*/

$('.grid .item').hover(function(){
	$(this).find('.overlay').fadeIn(200);
}, function(){
	$(this).find('.overlay').fadeOut(200);
});

$('.filter li').click(function(){
	$(this).parent().find('li').removeClass('active');
	
	var selected = $('.filter li.active');
	
	if(selected.data('value') == -1){
		var second = '';
	}else{
		var second = '[data-'+selected.parent().data('type')+'="'+selected.data('value')+'"]';
	}
	
	if($(this).data('value') == "-1"){
		$('.grid .item[data-'+$(this).parent().data('type')+']'+second).fadeIn(500);
	}else{
		$('.grid .item[data-'+$(this).parent().data('type')+'!="'+$(this).data('value')+'"]').fadeOut(500);
		$('.grid .item[data-'+$(this).parent().data('type')+'="'+$(this).data('value')+'"]'+second).fadeIn(500);
	}
	
	$(this).addClass('active');
});

$(".sendEmail").click(function(e){  
	e.preventDefault();
	$('#contactMe').slideUp();	
	$(this).fadeOut();	
	$.post('includes/mailer.php', 
		$('#contactMe').serialize(),
		function(data){
		  $(".results").html(data);
		  $('.results').fadeIn();	
	});
  return false;   
});

$('.scroll').click(function(){
	if($(this).hasClass('right')){
		$(this).parent().find('.grid').animate({scrollLeft: $('.grid .item').width()*2}, 500);
	}else if($(this).hasClass('left')){
		$(this).parent().find('.grid').animate({scrollLeft: $('.grid .item').width()*-2}, 500);
	}
});