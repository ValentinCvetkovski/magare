( function( $ ) {

    $( function() {

        console.log("Neisa!");

		$( '.flexslider' ).flexslider({
			animation: "slide",
			directionNav: false,
			controlNav: false
		} );

		/*test this not done*/
		var bodyHeight = $("body").height();
		var vwptHeight = $(window).height();
		if (vwptHeight > bodyHeight) {
			$("footer.footer").css("position","absolute").css("bottom",0).css("width","100%");
		}

    });

}( jQuery ));
