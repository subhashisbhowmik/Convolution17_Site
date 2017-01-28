// Toggle Script
(function() {
	var container = document.getElementById( 'container' );
		//trigger = container.querySelector( 'button.trigger' );

	function toggleContent() {
		if( classie.has( container, 'container-open' ) ) {
			classie.remove( container, 'container-open' );
			//classie.remove( trigger, 'trigger-active' );
			window.addEventListener( 'scroll', noscroll );
		}
		else {
			classie.add( container, 'container-open' );
			//classie.add( trigger, 'trigger-active' );
			window.removeEventListener( 'scroll', noscroll );
		}
	}

	function noscroll() {
		window.scrollTo( 0, 0 );
	}

	// reset scrolling position
	document.body.scrollTop = document.documentElement.scrollTop = 0;

	// disable scrolling
	window.addEventListener( 'scroll', noscroll );

	//trigger.addEventListener( 'click', toggleContent );

	// For Demo purposes only (prevent jump on click)
	[].slice.call( document.querySelectorAll('.content-wrapper a') ).forEach( function(el) { el.onclick = function() { return false; } } );
})();

// screen loader
$(window).load(function() {
    "use strict";
    $('.screen-loader').fadeOut('slow');
});


// preload
$(document).ready(function() {
    "use strict";
    $('#preload').css({
        display: 'table'
    });
});


// preload function
$(window).load(preLoader);
"use strict";

function preLoader() {
    setTimeout(function() {
        $('#preload').delay(1000).fadeOut(1500);
    });
};

// niceScroll
$(document).ready(function() {
    "use strict";
    $("body").niceScroll({
        cursorcolor: "#fff",
        cursorwidth: "5px",
        cursorborder: "1px solid #fff",
        cursorborderradius: "0px",
        zindex: "9999",
        scrollspeed: "60",
        mousescrollstep: "40"
    });
});


// niceScroll || scrollbars resize
$("body").getNiceScroll().resize();
