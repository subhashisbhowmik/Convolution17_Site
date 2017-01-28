jQuery(document).ready(function($) {
	
	var colors = '';
	var server_url = ''; 
	var folder_url = 'css/colors/'; 

	// Style switcher
 	$(".hide-color").show(5000);
    $('#custumize-style').animate({
        left: '-134px'
    });

    $('#custumize-style .switcher').click(function(e) {
        e.preventDefault();
        var div = $('#custumize-style');
        if (div.css('left') === '-134px') {
            $('#custumize-style').animate({
                left: '0px'
            });

            // open switcher and add class open
            $(this).addClass('open');
            $(this).removeClass('closed');

        } else {
            $('#custumize-style').animate({
                left: '-134px'
            });

            // close switcher and add closed
            $(this).addClass('closed');
            $(this).removeClass('open');

        }
    })
	
 
	
		
	//Text Color change:
    $("#custom-color li a").click(function() {
		if($("#colors-style").length == 0) {
			$('<link href="" rel="stylesheet" type="text/css" id="colors-style">').appendTo('body');
		}
		var color_code = $(this).attr('class');
        $(this).parent().parent().find('li').removeClass('active');
        $("#colors-style").attr("href", folder_url + color_code +".css");
        $(this).parent().addClass('active');
        //$.cookie("layout_color", server_url + color_code +".css");
        return false;
    }); 
	
	
	//Background Image change:	
    $('#bgimg li a').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().find('a').removeClass('active');
        $(this).addClass('active');
        var bg = $(this).css('backgroundImage');
        $('body').css('backgroundImage', bg);

        //$.cookie('layout_bgImage', bg);
        //$.cookie('layout_bgColors', null);

    });

	//Background Solid Color change:	
    $('#bgsolid li a').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().find('a').removeClass('active');
        $(this).addClass('active');
        var bg = $(this).css('backgroundColor');
        $('body').css('backgroundColor', bg).css('backgroundImage', 'none');
        //$.cookie('layout_bgColors', bg);

    });
	
	//menu position change:	
    $('.menu-position li a').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().find('a').removeClass('active');
        $(this).addClass('active');
		var menu_pos = $(this).attr('id');
        $('#wrapper').removeClass();
        $('#wrapper').addClass('container');
        $('#wrapper').addClass(menu_pos);
        //$.cookie('layout_menuPosition', menu_pos);
    });
	
	//container-height change:	
    $('.container-height li a').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().find('a').removeClass('active');
        $(this).addClass('active');
		var container_height = $(this).attr('id');
		if(container_height=="container-height-fixed"){
			$('.main-container').addClass('fixed-height');
	  		$(".fixed-height .scrollbar").mCustomScrollbar("destroy"); 
			$(".fixed-height .scrollbar").mCustomScrollbar({
			  contentTouchScroll: true,
			  advanced: {
				updateOnContentResize: true,
				updateOnBrowserResize: true,
				autoScrollOnFocus: false
			  }
			}); 
		}else if(container_height=="container-height-auto"){
	  		$(".fixed-height .scrollbar").mCustomScrollbar("destroy"); 
			$('.main-container').removeClass('fixed-height');
		}
    });

	//button-reset:	
    $('#button-reset a').click(function(e) {
        $('body').css('background', '#fff');
        $("#colors-style").attr("href", folder_url + "yellow.css");
        //$.cookie('layout_color',  server_url + 'yellow.css');
		
		//menu reset:
        $('#wrapper').removeClass();
        $('#wrapper').addClass('container');
        $('.menu-position li a').parent().parent().find('a').removeClass('active');
        $('#menu-left-bottom').addClass('active');
        //$.cookie('layout_menuPosition', '');
		
		//container-height reset:
        $('#container-height-fixed').trigger('click');
    });
});