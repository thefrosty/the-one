/**
 * Theme Customizer enhancements for a better user experience.
 * something
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
 
( function( $ ) {

	/* === Site title and description === */
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	
	/* === Header overlay color === */
 	wp.customize( 'theone_header_overlay_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' !== to )
				$( '.header-overlay' ).css( 'background', to );
		} );
	} );
	
	/* === Header overlay opacity === */
	wp.customize( 'theone_header_overlay_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.header-overlay' ).css( 'opacity', '0.'+to );
		} );
	} );
	
	/* === Site title background color === */
 	wp.customize( 'theone_site_title_bg_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' !== to )
				$( '.site-title .text-link' ).css( 'background', to );
		} );
	} );
	
	/* === Make selected elements match background color === */
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {

			if ( 'blank' !== to ) { /* If primary color is not blank. */

				/* Turn what's about to be appended into a variable to keep it tidy. */
				var TheOne_Background_Color =
					"<style type='text/css' class='theone-match-background-color'>"
							+".comment-author .avatar {"
								+"box-shadow: inset -1px 0 0 "+to+";"
							+"}"

							+".comment-meta .comment-reply-link,"
							+".comment-meta .comment-reply-login {"
								+"box-shadow: inset 1px 0 0 "+to+";"
							+"}"

							+"@media only screen and (min-width: 980px) {"
								+".nav.dropdown .wrap {"
									+"background: "+to+";"
								+"}"
							+"}"					
					+"</style>";

				/* Add CSS to body */
				$( 'head' ).append( TheOne_Background_Color );
				
				/*
					If added already, add again then remove the previous version.
					Use .siblings() instead of .prev() in case the old and new CSS
					DIVs aren't sitting immediately next to each other.
				*/
				if( $( '.theone-match-background-color' ).last().siblings( '.theone-match-background-color' ).length ) {
					$( '.theone-match-background-color' ).last().siblings( '.theone-match-background-color' ).remove();
				} /* End check if there are multiple DIVs of the same 'theone-match-background-color' class. */

			} /* End check if background color is not blank. */

		} );
	} );
	
	/* === Primary color === */
	wp.customize( 'theone_accent_color', function( value ) {
		value.bind( function( to ) {

			if ( 'blank' !== to ) { // If primary color is not blank.

				/* Turn what's about to be appended into a variable to keep it tidy. */
				var TheOne_Accent_Color =
					"<style type='text/css' class='theone-accent-primary'>"
						+".button,"
						+"button,"
						+"input[type='button'],"
						+"input[type='reset'],"
						+"input[type='submit'],"
						+".nav.offcanvas .open-button::before,"
						+".nav.offcanvas .close-button::before,"
						+".edit-content a,"
						+".featured-media,"
						+".comment-meta .comment-reply-link:hover,"
						+".comment-meta .comment-reply-link:focus,"
						+".comment-meta .comment-reply-login:hover,"
						+".comment-meta .comment-reply-login:focus,"
						+"#cancel-comment-reply-link {"
							+"background-color: "+to+";"
						+"}"
						
						+"blockquote,"
						+".alert::before,"
						+".page-links a:hover,"
						+".page-links a:focus {"
							+"border-color: "+to+";"
						+"}"

						+".entry a:hover,"
						+".entry a:focus,"
						+".comments-area a:hover,"
						+".comments-area a:focus,"
						+".widget a:hover,"
						+".widget a:focus,"
						+".site-info a:hover,"
						+".site-info a:focus {"
							+"box-shadow: inset 0 -2px 0 "+to+";"
						+"}"

						+".nav.offcanvas li a:hover,"
						+".nav.offcanvas li a:focus,"
						+".nav.offcanvas .current-menu-item > a,"
						+".nav.dropdown li a:hover,"
						+".nav.dropdown li a:focus,"
						+".nav.dropdown .current-menu-item > a {"
							+"box-shadow: inset 3px 0 0 "+to+";"
						+"}"
						
						+".nav.social li a:hover,"
						+".nav.social li a:focus {"
							+"box-shadow: inset 0 0 0 1px "+to+";"
						+"}"

						+".alert::before,"
						+"a,"
						+".nav.offcanvas a:hover,"
						+".nav.offcanvas a:focus,"
						+".nav.offcanvas .current-menu-item > a,"
						+".nav.dropdown .open-button:hover,"
						+".nav.dropdown .open-button:focus,"
						+".nav.dropdown li a:hover,"
						+".nav.dropdown li a:focus,"
						+".nav.dropdown .current-menu-item > a,"
						+".nav.social li a:hover,"
						+".nav.social li a:focus,"
						+".paging-navigation a:hover,"
						+".paging-navigation a:focus,"
						+".post-navigation a:hover,"
						+".post-navigation a:focus,"
						+".comment-navigation a:hover,"
						+".comment-navigation a:focus,"
						+".comment-meta a:hover,"
						+".comment-meta a:focus,"
						+".site-info a,"
						+"#page #infinite-handle:hover span {"
							+"color: "+to+";"
						+"}"

						+"@media only screen and (min-width: 980px) {"
							+".nav.dropdown li a:hover,"
							+".nav.dropdown li a:focus,"
							+".nav.dropdown .current-menu-item > a {"
								+"background: "+to+";"
								+"box-shadow: none;"
								+"border-color: "+to+";"
								+"color: #fff;"
							+"}"
							+".nav.dropdown .current-menu-item > a {"
								+"background: transparent;"
								+"color: "+to+";"
							+"}"
								+".nav.dropdown li li a:hover,"
								+".nav.dropdown li li a:focus,"
								+".nav.dropdown li .current-menu-item > a {"
									+"background: #000;"
									+"border-color: rgba(255,255,255,0.15);"
									+"box-shadow: inset 3px 0 0 "+to+";"
									+"color: "+to+";"
								+"}"
						+"}"
					+"</style>";

				/* Add CSS to body */
				$( 'head' ).append( TheOne_Accent_Color );
				
				/*
					If added already, add again then remove the previous version.
					Use .siblings() instead of .prev() in case the old and new CSS
					DIVs aren't sitting immediately next to each other.
				*/
				if( $( '.theone-accent-primary' ).last().siblings( '.theone-accent-primary' ).length ) {
					$( '.theone-accent-primary' ).last().siblings( '.theone-accent-primary' ).remove();
				} /* End check if there are multiple DIVs of the same 'theone-accent-primary' class. */

			} /* End check if primary color is not blank. */

		} );
	} );
	
} )( jQuery );