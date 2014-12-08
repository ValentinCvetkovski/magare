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

		/*$( '.menu-item-has-children a' ).removeClass( 'caret');
		$( '.menu-item-has-children a' ).on( 'click', function( e ){
            e.stopPropagation();
            e.preventDefault();

			var $dropdownSection = $( this ).parent().children( '.dropdown-menu' );

            if ( $dropdownSection.css( 'display') == 'none' ) {
                $dropdownSection.slideToggle( 350 );
                $( this ).addClass( 'open-ts' );

            } else {
                $dropdownSection.slideUp( 150 );
                $( this ).removeClass( 'open-ts' );
            }

		});*/

    });

}( jQuery ));
