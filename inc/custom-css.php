<?php

namespace TheOne\Inc;

/* Add custom inline style */
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\custom_css' );

function custom_css() {

	$background_color = esc_attr( get_theme_mod( 'background_color', 'fafafa' ) );
	$theone_accent_color = esc_attr( get_theme_mod( 'theone_accent_color', '#d64431' ) );
	$theone_header_overlay_color = esc_attr( get_theme_mod( 'theone_header_overlay_color', '#000000' ) );
	$theone_header_overlay_opacity = absint( get_theme_mod( 'theone_header_overlay_opacity', '1' ) );
	$theone_site_title_bg_color = esc_attr( get_theme_mod( 'theone_site_title_bg_color', '#080808' ) );
	
	$css = "";
	
	/* === Custom Background Color =================================== */

	if ( 'fafafa' !== $background_color ) {
		/* If custom background color is not default color. Also, unlike other hex values below, this one doesn't include the # sign because $background_color doesn't include the # sign with the value. However, it does include # in the customizer JS preview code. */

		$css .= "
			.comment-author .avatar {
				box-shadow: inset -1px 0 0 #{$background_color};
			}
			.comment-meta .comment-reply-link,
			.comment-meta .comment-reply-login {
				box-shadow: inset 1px 0 0 #{$background_color};
			}
			@media only screen and (min-width: 980px) {
				.nav.dropdown .wrap {
					background: #{$background_color};
				}
			}
		";

	} /* End check for custom background color. */
	
	/* === Header Color and Opacity =================================== */
	if ( '0' !== $theone_header_overlay_opacity ) { /* If header opacity is not 0. */

		$css .= "
			.header-overlay {
				background: {$theone_header_overlay_color};
				opacity: 0.{$theone_header_overlay_opacity};
			}
		";
		
	} /* End check for header opacity */
	
	/* === Site Title Background Color =================================== */
	if ( '#080808' !== $theone_site_title_bg_color ) { /* If site title background color is not default color. */

		$css .= "
			.site-title .text-link {
				background-color: {$theone_site_title_bg_color};
			}
			.site-title .text-link:hover,
			.site-title .text-link:focus {
				background: rgba(0,0,0,0.9);
			}
		";

	} /* End check for site title background color. */
	
	/* === Primary Color =================================== */
	if ( '#d64431' !== $theone_accent_color ) { /* If primary color is not blank or #d64431 (default). */

		$css .= "
			.button,
			button,
			input[type='button'],
			input[type='reset'],
			input[type='submit'],
			.nav.offcanvas .open-button::before,
			.nav.offcanvas .close-button::before,
			.edit-content a,
			.featured-media,
			.comment-meta .comment-reply-link:hover,
			.comment-meta .comment-reply-link:focus,
			.comment-meta .comment-reply-login:hover,
			.comment-meta .comment-reply-login:focus,
			#cancel-comment-reply-link {
				background-color: {$theone_accent_color};
			}
			blockquote,
			.alert::before,
			.page-links a:hover,
			.page-links a:focus {
				border-color: {$theone_accent_color};
			}
			.entry a:hover,
			.entry a:focus,
			.comments-area a:hover,
			.comments-area a:focus,
			.widget a:hover,
			.widget a:focus,
			.site-info a:hover,
			.site-info a:focus {
				box-shadow: inset 0 -2px 0 {$theone_accent_color};
			}
			.nav.offcanvas li a:hover,
			.nav.offcanvas li a:focus,
			.nav.offcanvas .current-menu-item > a,
			.nav.dropdown li a:hover,
			.nav.dropdown li a:focus,
			.nav.dropdown .current-menu-item > a {
				box-shadow: inset 3px 0 0 {$theone_accent_color};
			}
			.nav.social li a:hover,
			.nav.social li a:focus {
				box-shadow: inset 0 0 0 1px {$theone_accent_color};
			}
			.alert::before,
			a,
			.nav.offcanvas a:hover,
			.nav.offcanvas a:focus,
			.nav.offcanvas .current-menu-item > a,
			.nav.dropdown .open-button:hover,
			.nav.dropdown .open-button:focus,
			.nav.dropdown li a:hover,
			.nav.dropdown li a:focus,
			.nav.dropdown .current-menu-item > a,
			.nav.social li a:hover,
			.nav.social li a:focus,
			.paging-navigation a:hover,
			.paging-navigation a:focus,
			.post-navigation a:hover,
			.post-navigation a:focus,
			.comment-navigation a:hover,
			.comment-navigation a:focus,
			.comment-meta a:hover,
			.comment-meta a:focus,
			.site-info a,
			#page #infinite-handle:hover span {
				color: {$theone_accent_color};
			}
			@media only screen and (min-width: 980px) {
				.nav.dropdown li a:hover,
				.nav.dropdown li a:focus,
				.nav.dropdown .current-menu-item > a {
					background: {$theone_accent_color};
					box-shadow: none;
					border-color: {$theone_accent_color};
					color: #fff;
				}
				.nav.dropdown .current-menu-item > a {
					background: transparent;
					color: {$theone_accent_color};
				}
					.nav.dropdown li li a:hover,
					.nav.dropdown li li a:focus,
					.nav.dropdown li .current-menu-item > a {
						background: #000;
						border-color: rgba(255,255,255,0.15);
						box-shadow: inset 3px 0 0 {$theone_accent_color};
						color: {$theone_accent_color};
					}
			}
		";
		
	} /* End check custom primary color. */

	/* If CSS is not empty */
	if ( !empty( $css ) ) {
		wp_add_inline_style( 'style', $css );
	}

}
