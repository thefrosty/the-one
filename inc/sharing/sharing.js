(function ($, window, undefined) {

    var document = window.document;

    jQuery(document).ready(function ($) {

        var $body = document.body;

        /**
         * Look for Pinterest content sharing links and load script on click
         * The following uses the Jetpack plugin method to help Pinterest links
         * function as they should without Pinterest's taking over link styling
         * with its own custom CSS.
         */
        $body.on('click', 'a.share-pinterest', function (e) {
            e.preventDefault();

            // Load Pinterest Bookmarklet code
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = window.location.protocol + "//assets.pinterest.com/js/pinmarklet.js?r=" + ( Math.random() * 99999999 );
            var x = document.getElementsByTagName("script")[0];
            x.parentNode.insertBefore(s, x);
        });

        if ($body.has('.share')) { // If page has share list.

            var sharing_position;

            /* Get sharing list position */
            sharing_position = $('.share').attr('data-position');
            sharing_position = sharing_position.replace(/\s+/g, '-');

            /* Add position to <body> tag as class */
            $body.addClass(sharing_position);

            /* Toggle button */
            $('.share .open-button, .share .close-button').on('click', function () {
                $(this).parent('.share').toggleClass('show-menu');
            });

            /* Remove title attribute for JS enabled users, show title by CSS instead.*/
            $('.share li a').removeAttr('title');

        } // End check for presence of share list.

    });

})(jQuery);