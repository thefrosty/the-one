(function (window, $, undefined) {

    var $this,
        $body = $(document.body),
        wpadminbar = $('#wpadminbar');

    /**
     * Theme JS
     */
    var TheOne = {

        init: function () {
            this.menus();
            this.widgets();
            this.miscellaneous();
        },

        menus: function () {

            var menu_primary = $('nav#menu-primary'),
                menu_secondary = $('nav#menu-secondary');

            menu_primary.on('click', 'button.open-button', function () {
                $(this).parent('nav').addClass('show-menu');
            });

            menu_primary.on('click', 'button.close-button', function () {
                $(this).parent('nav').removeClass('show-menu');
            });

            menu_secondary.on('click', 'button', function () {
                $(this).parent('nav').toggleClass('show-menu');
            });
        },

        widgets: function () {

            /**
             * Sidebar CSS selector based on number of sidebars active.
             */
            if ($body.has('.widget-area')) {
                var sidebar_count = $('.widget-area > .sidebar').length;
                $('.widget-area').addClass('childs-' + sidebar_count);
            }
        },

        comments: function () {

            /**
             * In-line labels for comment form, aiding the use of icons for labels.
             */
            if ($body.has('.comment-form')) {
                $('.comment-form p > label ').each(function () {
                    var labelText = $(this).text();
                    $(this).siblings('input, textarea').prop('placeholder', labelText);
                });
            }
        },

        miscellaneous: function () {

            /* === The following is written by Justin Tadlock (http://justintadlock.com) =============================== */

            /* Add class to links with an image. */
            $('a').has('img').addClass('img-hyperlink');

            /* Add 'has-posts' to any <td> element in the calendar that has posts for that day. */
            $('.wp-calendar tbody td').has('a').addClass('has-posts');

            /* Overrides WP's <div> wrapper around videos, which mucks with flexible videos. */
            $('div[style*="max-width: 100%"] > video').parent().css('width', '100%');

            /* Responsive videos. blip.tv adds a second <embed> with "display: none".  We don't want to wrap that. */
            $('.content-area object, .content-area embed, .content-area iframe').not('embed[style*="display"], [src*="soundcloud.com"], [src*="amazon"], [name^="gform_"]').wrap('<div class="embed-wrap" />');
        },

        statechangecomplete: function () {

            $('nav').removeClass('show-menu');
            this.init();
        }

    };

    TheOne.init();

    /**
     * Listen for the ajaxify event callback.
     */
    $(window).on('statechangecomplete', function () {
        TheOne.statechangecomplete();
    });

})(window, jQuery);