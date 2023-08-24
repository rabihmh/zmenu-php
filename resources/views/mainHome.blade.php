<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DMENU &#8211; System with QR menu for restaurant menu, cafe menu or products catalogue</title>
    <link rel='dns-prefetch' href='//fonts.googleapis.com'/>
    <link rel='dns-prefetch' href='//s.w.org'/>
    <script type="text/javascript">
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/svg\/",
            "svgExt": ".svg",
            "source": {
                "wpemoji": "https:\/\/www.dmenuonline.com\/wp-includes\/js\/wp-emoji.js?ver=5.4.12",
                "twemoji": "https:\/\/www.dmenuonline.com\/wp-includes\/js\/twemoji.js?ver=5.4.12"
            }
        };
        /**
         * @output wp-includes/js/wp-emoji-loader.js
         */

        (function (window, document, settings) {
            var src, ready, ii, tests;

            // Create a canvas element for testing native browser support of emoji.
            var canvas = document.createElement('canvas');
            var context = canvas.getContext && canvas.getContext('2d');

            /**
             * Checks if two sets of Emoji characters render the same visually.
             *
             * @since 4.9.0
             *
             * @private
             *
             * @param {number[]} set1 Set of Emoji character codes.
             * @param {number[]} set2 Set of Emoji character codes.
             *
             * @return {boolean} True if the two sets render the same.
             */
            function emojiSetsRenderIdentically(set1, set2) {
                var stringFromCharCode = String.fromCharCode;

                // Cleanup from previous test.
                context.clearRect(0, 0, canvas.width, canvas.height);
                context.fillText(stringFromCharCode.apply(this, set1), 0, 0);
                var rendered1 = canvas.toDataURL();

                // Cleanup from previous test.
                context.clearRect(0, 0, canvas.width, canvas.height);
                context.fillText(stringFromCharCode.apply(this, set2), 0, 0);
                var rendered2 = canvas.toDataURL();

                return rendered1 === rendered2;
            }

            /**
             * Detects if the browser supports rendering emoji or flag emoji.
             *
             * Flag emoji are a single glyph made of two characters, so some browsers
             * (notably, Firefox OS X) don't support them.
             *
             * @since 4.2.0
             *
             * @private
             *
             * @param {string} type Whether to test for support of "flag" or "emoji".
             *
             * @return {boolean} True if the browser can render emoji, false if it cannot.
             */
            function browserSupportsEmoji(type) {
                var isIdentical;

                if (!context || !context.fillText) {
                    return false;
                }

                /*
                 * Chrome on OS X added native emoji rendering in M41. Unfortunately,
                 * it doesn't work when the font is bolder than 500 weight. So, we
                 * check for bold rendering support to avoid invisible emoji in Chrome.
                 */
                context.textBaseline = 'top';
                context.font = '600 32px Arial';

                switch (type) {
                    case 'flag':
                        /*
                         * Test for Transgender flag compatibility. This flag is shortlisted for the Emoji 13 spec,
                         * but has landed in Twemoji early, so we can add support for it, too.
                         *
                         * To test for support, we try to render it, and compare the rendering to how it would look if
                         * the browser doesn't render it correctly (white flag emoji + transgender symbol).
                         */
                        isIdentical = emojiSetsRenderIdentically(
                            [0x1F3F3, 0xFE0F, 0x200D, 0x26A7, 0xFE0F],
                            [0x1F3F3, 0xFE0F, 0x200B, 0x26A7, 0xFE0F]
                        );

                        if (isIdentical) {
                            return false;
                        }

                        /*
                         * Test for UN flag compatibility. This is the least supported of the letter locale flags,
                         * so gives us an easy test for full support.
                         *
                         * To test for support, we try to render it, and compare the rendering to how it would look if
                         * the browser doesn't render it correctly ([U] + [N]).
                         */
                        isIdentical = emojiSetsRenderIdentically(
                            [0xD83C, 0xDDFA, 0xD83C, 0xDDF3],
                            [0xD83C, 0xDDFA, 0x200B, 0xD83C, 0xDDF3]
                        );

                        if (isIdentical) {
                            return false;
                        }

                        /*
                         * Test for English flag compatibility. England is a country in the United Kingdom, it
                         * does not have a two letter locale code but rather an five letter sub-division code.
                         *
                         * To test for support, we try to render it, and compare the rendering to how it would look if
                         * the browser doesn't render it correctly (black flag emoji + [G] + [B] + [E] + [N] + [G]).
                         */
                        isIdentical = emojiSetsRenderIdentically(
                            [0xD83C, 0xDFF4, 0xDB40, 0xDC67, 0xDB40, 0xDC62, 0xDB40, 0xDC65, 0xDB40, 0xDC6E, 0xDB40,
                                0xDC67, 0xDB40, 0xDC7F
                            ],
                            [0xD83C, 0xDFF4, 0x200B, 0xDB40, 0xDC67, 0x200B, 0xDB40, 0xDC62, 0x200B, 0xDB40, 0xDC65,
                                0x200B, 0xDB40, 0xDC6E, 0x200B, 0xDB40, 0xDC67, 0x200B, 0xDB40, 0xDC7F
                            ]
                        );

                        return !isIdentical;
                    case 'emoji':
                        /*
                         * Love is love.
                         *
                         * To test for Emoji 12 support, try to render a new emoji: men holding hands, with different skin
                         * tone modifiers.
                         *
                         * When updating this test for future Emoji releases, ensure that individual emoji that make up the
                         * sequence come from older emoji standards.
                         */
                        isIdentical = emojiSetsRenderIdentically(
                            [0xD83D, 0xDC68, 0xD83C, 0xDFFE, 0x200D, 0xD83E, 0xDD1D, 0x200D, 0xD83D, 0xDC68, 0xD83C,
                                0xDFFC
                            ],
                            [0xD83D, 0xDC68, 0xD83C, 0xDFFE, 0x200B, 0xD83E, 0xDD1D, 0x200B, 0xD83D, 0xDC68, 0xD83C,
                                0xDFFC
                            ]
                        );

                        return !isIdentical;
                }

                return false;
            }

            /**
             * Adds a script to the head of the document.
             *
             * @ignore
             *
             * @since 4.2.0
             *
             * @param {Object} src The url where the script is located.
             * @return {void}
             */
            function addScript(src) {
                var script = document.createElement('script');

                script.src = src;
                script.defer = script.type = 'text/javascript';
                document.getElementsByTagName('head')[0].appendChild(script);
            }

            tests = Array('flag', 'emoji');

            settings.supports = {
                everything: true,
                everythingExceptFlag: true
            };

            /*
             * Tests the browser support for flag emojis and other emojis, and adjusts the
             * support settings accordingly.
             */
            for (ii = 0; ii < tests.length; ii++) {
                settings.supports[tests[ii]] = browserSupportsEmoji(tests[ii]);

                settings.supports.everything = settings.supports.everything && settings.supports[tests[ii]];

                if ('flag' !== tests[ii]) {
                    settings.supports.everythingExceptFlag = settings.supports.everythingExceptFlag && settings.supports[
                        tests[ii]];
                }
            }

            settings.supports.everythingExceptFlag = settings.supports.everythingExceptFlag && !settings.supports.flag;

            // Sets DOMReady to false and assigns a ready function to settings.
            settings.DOMReady = false;
            settings.readyCallback = function () {
                settings.DOMReady = true;
            };

            // When the browser can not render everything we need to load a polyfill.
            if (!settings.supports.everything) {
                ready = function () {
                    settings.readyCallback();
                };

                /*
                 * Cross-browser version of adding a dom ready event.
                 */
                if (document.addEventListener) {
                    document.addEventListener('DOMContentLoaded', ready, false);
                    window.addEventListener('load', ready, false);
                } else {
                    window.attachEvent('onload', ready);
                    document.attachEvent('onreadystatechange', function () {
                        if ('complete' === document.readyState) {
                            settings.readyCallback();
                        }
                    });
                }

                src = settings.source || {};

                if (src.concatemoji) {
                    addScript(src.concatemoji);
                } else if (src.wpemoji && src.twemoji) {
                    addScript(src.twemoji);
                    addScript(src.wpemoji);
                }
            }

        })(window, document, window._wpemojiSettings);

    </script>
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }

    </style>
    <link rel='stylesheet' id='wp-block-library-css'
          href='{{asset('home/includes/css/dist/block-library/style.css?ver=5.4.12')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='contact-form-7-css'
          href='{{asset('home/content/plugins/contact-form-7/includes/css/styles.css?ver=5.3')}}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='fw-ext-builder-frontend-grid-css'
          href='{{asset('home/content/plugins/unyson/framework/extensions/builder/static/css/frontend-grid.css?ver=1.2.12')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='fw-ext-forms-default-styles-css'
          href='{{asset('home/content/plugins/unyson/framework/extensions/forms/static/css/frontend.css?ver=2.7.24')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='font-awesome-css'
          href='{{asset('home/content/plugins/unyson/framework/static/libs/font-awesome/css/font-awesome.min.css?ver=2.7.24')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='js_composer_front-css'
          href='{{asset('home/content/plugins/js_composer/assets/css/js_composer.min.css?ver=6.4.2')}}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='bootstrap-css'
          href='{{asset('home/content/themes/jevelin/css/plugins/bootstrap.min.css?ver=3.3.4')}}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='jevelin-plugins-css'
          href='{{asset('home/content/themes/jevelin/css/plugins.css?ver=5.4.12')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='jevelin-shortcodes-css'
          href='{{asset('home/content/themes/jevelin/css/shortcodes.css?ver=5.4.12')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='jevelin-styles-css' href='{{asset('home/content/themes/jevelin/style.css?ver=5.4.12')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='jevelin-responsive-css'
          href='{{asset('home/content/themes/jevelin/css/responsive.css?ver=5.4.12')}}' type='text/css' media='all'/>
    <style id='jevelin-responsive-inline-css' type='text/css'>
        .cf7-required:after,
        .woocommerce ul.products li.product a h3:hover,
        .woocommerce ul.products li.product ins,
        .post-title h2:hover,
        .sh-team:hover .sh-team-role,
        .sh-team-style4 .sh-team-role,
        .sh-team-style4 .sh-team-icon:hover i,
        .sh-header-search-submit,
        .woocommerce .woocommerce-tabs li.active a,
        .woocommerce .required,
        .sh-recent-products .woocommerce .star-rating span::before,
        .woocommerce .woocomerce-styling .star-rating span::before,
        .woocommerce div.product p.price,
        .woocomerce-styling li.product .amount,
        .post-format-icon,
        .sh-accent-color,
        .sh-blog-tag-item:hover h6,
        ul.page-numbers a:hover,
        .sh-portfolio-single-info-item i,
        .sh-filter-item.active,
        .sh-filter-item:hover,
        .sh-nav .sh-nav-cart li.menu-item-cart .mini_cart_item .amount,
        .sh-pricing-button-style3,
        #sidebar a:not(.sh-social-widgets-item):hover,
        .logged-in-as a:hover,
        .woocommerce table.shop_table.cart a:hover,
        .wrap-forms sup:before,
        .sh-comment-date a:hover,
        .reply a.comment-edit-link,
        .comment-respond #cancel-comment-reply-link,
        .sh-portfolio-title:hover,
        .sh-portfolio-single-related-mini h5:hover,
        .sh-header-top-10 .header-contacts-details-large-icon i,
        .sh-unyson-frontend-test.active,
        .plyr--full-ui input[type=range],
        .woocommerce td.woocommerce-grouped-product-list-item__label a:hover {
            color: #000000 !important;
        }

        .woocommerce p.stars.selected a:not(.active),
        .woocommerce p.stars.selected a.active,
        .sh-dropcaps-full-square,
        .sh-dropcaps-full-square-border,
        .masonry2 .post-content-container a.post-meta-comments:hover,
        .sh-header-builder-edit:hover {
            background-color: #000000;
        }

        .contact-form input[type="submit"],
        .sh-back-to-top:hover,
        .sh-dropcaps-full-square-tale,
        .sh-404-button,
        .woocommerce .wc-forward,
        .woocommerce .checkout-button,
        .woocommerce div.product form.cart button,
        .woocommerce .button:not(.add_to_cart_button),
        .sh-blog-tag-item,
        .sh-comments .submit,
        .sh-sidebar-search-active .search-field,
        .sh-nav .sh-nav-cart .buttons a.checkout,
        ul.page-numbers .current,
        ul.page-numbers .current:hover,
        .post-background,
        .post-item .post-category .post-category-list,
        .cart-icon span,
        .comment-input-required,
        .widget_tag_cloud a:hover,
        .widget_product_tag_cloud a:hover,
        .woocommerce #respond input#submit,
        .sh-portfolio-overlay1-bar,
        .sh-pricing-button-style4,
        .sh-pricing-button-style11,
        .sh-revslider-button2,
        .sh-portfolio-default2 .sh-portfolio-title,
        .sh-recent-posts-widgets-count,
        .sh-filter-item.active:after,
        .blog-style-largedate .post-comments,
        .sh-video-player-style1 .sh-video-player-image-play,
        .sh-video-player-style2 .sh-video-player-image-play:hover,
        .sh-video-player-style2 .sh-video-player-image-play:focus,
        .woocommerce .woocommerce-tabs li a:after,
        .sh-image-gallery .slick-dots li.slick-active button,
        .sh-recent-posts-carousel .slick-dots li.slick-active button,
        .sh-recent-products-carousel .slick-dots li.slick-active button,
        .sh-settings-container-bar .sh-progress-status-value,
        .post-password-form input[type="submit"],
        .wpcf7-form .wpcf7-submit,
        .sh-portfolio-filter-style3 .sh-filter-item.active .sh-filter-item-content,
        .sh-portfolio-filter-style4 .sh-filter-item:hover .sh-filter-item-content,
        .sh-woocommerce-categories-count,
        .sh-woocommerce-products-style2 .woocommerce ul.products li.product .add_to_cart_button:hover,
        .woocomerce-styling.sh-woocommerce-products-style2 ul.products li.product .add_to_cart_button:hover,
        .sh-icon-group-style2 .sh-icon-group-item:hover,
        .sh-text-background,
        .plyr--audio .plyr__control.plyr__tab-focus,
        .plyr--audio .plyr__control:hover,
        .plyr--audio .plyr__control[aria-expanded=true] {
            background-color: #000000 !important;
        }

        .sh-cf7-style4 form input:not(.wpcf7-submit):focus {
            border-bottom-color: #000000;
        }

        ::selection {
            background-color: #000000 !important;
            color: #fff;
        }

        ::-moz-selection {
            background-color: #000000 !important;
            color: #fff;
        }

        .woocommerce .woocommerce-tabs li.active a {
            border-bottom-color: #000000 !important;
        }

        #header-quote,
        .sh-dropcaps-full-square-tale:after,
        .sh-blog-tag-item:after,
        .widget_tag_cloud a:hover:after,
        .widget_product_tag_cloud a:hover:after {
            border-left-color: #000000 !important;
        }

        .cart-icon .cart-icon-triangle-color {
            border-right-color: #000000 !important;
        }

        .sh-back-to-top:hover,
        .widget_price_filter .ui-slider .ui-slider-handle,
        .sh-sidebar-search-active .search-field:hover,
        .sh-sidebar-search-active .search-field:focus,
        .sh-cf7-style2 form p input:not(.wpcf7-submit):focus,
        .sh-cf7-style2 form p textarea:focus {
            border-color: #000000 !important;
        }

        .post-item .post-category .arrow-right {
            border-left-color: #000000;
        }

        .woocommerce .wc-forward:hover,
        .woocommerce .button:not(.add_to_cart_button):hover,
        .woocommerce .checkout-button:hover,
        .woocommerce #respond input#submit:hover,
        .contact-form input[type="submit"]:hover,
        .wpcf7-form .wpcf7-submit:hover,
        .sh-video-player-image-play:hover,
        .sh-404-button:hover,
        .post-password-form input[type="submit"],
        .sh-pricing-button-style11:hover,
        .sh-revslider-button2.spacing-animation:not(.inverted):hover {
            background-color: #6b6b6b !important;
        }

        .sh-cf7-unyson form .wpcf7-submit {
            background-size: 200% auto;
            background-image: linear-gradient(to right, #000000, #6b6b6b, #6b6b6b);
        }

        .sh-mini-overlay-container,
        .sh-portfolio-overlay-info-box,
        .sh-portfolio-overlay-bottom .sh-portfolio-icon,
        .sh-portfolio-overlay-bottom .sh-portfolio-text,
        .sh-portfolio-overlay2-bar,
        .sh-portfolio-overlay2-data,
        .sh-portfolio-overlay3-data {
            background-color: rgba(0, 0, 0, 0.75) !important;
        }

        .widget_price_filter .ui-slider .ui-slider-range {
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        .sh-team-social-overlay2 .sh-team-image:hover .sh-team-overlay2,
        .sh-overlay-style1,
        .sh-portfolio-overlay4 {
            background-color: rgba(0, 0, 0, 0.8) !important;
        }

        .sh-header .sh-nav > .current_page_item > a,
        .sh-header .sh-nav > .current-menu-ancestor > a,
        .sh-header .sh-nav > .current-menu-item > a,
        .sh-header-left-side .sh-nav > .current_page_item > a {
            color: #6b6b6b !important;
        }

        .sh-popover-mini:not(.sh-popover-mini-dark) {
            background-color: #000000;
        }

        .sh-popover-mini:not(.sh-popover-mini-dark):before {
            border-color: transparent transparent #000000 #000000 !important;
        }

        .sh-footer .sh-footer-widgets a:hover,
        .sh-footer .sh-footer-widgets li a:hover,
        .sh-footer .sh-footer-widgets h6:hover {
            color: #00456b;
        }

    </style>
    <link rel='stylesheet' id='jevelin-ie-css' href='{{asset('home/content/themes/jevelin/css/ie.css?ver=5.4.12')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='jevelin-theme-settings-css'
          href='{{asset('home/content/uploads/jevelin-dynamic-styles.css?ver=104835049')}}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='plyr-css' href='{{asset('home/content/themes/jevelin/css/plugins/plyr.css?ver=5.4.12')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='jevelin-fonts-css'
          href='https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Raleway:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&#038;subset=latin'
          type='text/css' media='all'/>
    <script type='text/javascript' src='{{asset('home/includes/js/jquery/jquery.js?ver=1.12.4-wp')}}'>
    </script>
    <script type='text/javascript' src='{{asset('home/includes/js/jquery/jquery-migrate.js?ver=1.4.1')}}'>
    </script>
    <script type='text/javascript' src='{{asset('home/content/themes/jevelin/js/plugins.js?ver=5.4.12')}}'>
    </script>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var jevelin_loadmore_posts = {
            "ajax_url": "https:\/\/www.dmenuonline.com\/wp-admin\/admin-ajax.php"
        };
        var jevelin = {
            "page_loader": "0",
            "notice": "",
            "header_animation_dropdown_delay": "1000",
            "header_animation_dropdown": "easeOutQuint",
            "header_animation_dropdown_speed": "300",
            "lightbox_opacity": "0.88",
            "lightbox_transition": "elastic",
            "lightbox_window_max_width": "1200",
            "lightbox_window_max_height": "1200",
            "lightbox_window_size": "0.8",
            "page_numbers_prev": "Previous",
            "page_numbers_next": "Next",
            "rtl_support": "",
            "footer_parallax": "",
            "one_pager": "1",
            "wc_lightbox": "jevelin",
            "quantity_button": "on"
        };
        /* ]]> */

    </script>
    <script type='text/javascript' src='{{asset('home/content/themes/jevelin/js/scripts.js?ver=5.4.12')}}'>
    </script>
    <script type='text/javascript' src='{{asset('home/content/themes/jevelin/js/plugins/plyr.min.js?ver=5.4.12')}}'>
    </script>
    <style type="text/css" data-type="vc_shortcodes-custom-css">
        .vc_custom_1594218867471 {
            padding-right: 60px !important;
            padding-left: 60px !important;
            background-image: url(https://cdn.jevelin.shufflehound.com/mobile-app-2/wp-content/uploads/sites/40/2019/11/BG2.jpg?id=226) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .vc_custom_1607090449024 {
            padding-top: 135px !important;
            padding-bottom: 135px !important;
            background-image: url(https://www.dmenuonline.com/wp-content/uploads/2020/12/DSC08383-copy.jpg?id=258) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .vc_custom_1594208500826 {
            padding-top: 150px !important;
        }

        .vc_custom_1594208662652 {
            padding-top: 50px !important;
            padding-bottom: 180px !important;
        }

        .vc_custom_1607088695260 {
            padding-top: 190px !important;
            padding-right: 45px !important;
            padding-bottom: 190px !important;
            padding-left: 45px !important;
            background-image: url(https://cdn.jevelin.shufflehound.com/mobile-app-2/wp-content/uploads/sites/40/2019/11/Rectangle-2-copy-4.jpg?id=133) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .vc_custom_1607090339471 {
            background-image: url(https://www.dmenuonline.com/wp-content/uploads/2020/12/DSC08383.jpg?id=257) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .vc_custom_1594211052929 {
            padding-top: 150px !important;
        }

        .vc_custom_1593795409719 {
            background-image: url(https://cdn.jevelin.shufflehound.com/mobile-app-2/wp-content/uploads/sites/40/2019/11/Polygon-1-copy-22-1.jpg?id=130) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: contain !important;
        }

        .vc_custom_1593795430983 {
            background-image: url(https://cdn.jevelin.shufflehound.com/mobile-app-2/wp-content/uploads/sites/40/2019/11/Polygon-1-copy-10.jpg?id=135) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: contain !important;
        }

        .vc_custom_1594117071134 {
            background-image: url(https://cdn.jevelin.shufflehound.com/mobile-app-2/wp-content/uploads/sites/40/2019/11/Polygon-1-copy-23.jpg?id=132) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: contain !important;
        }

        .vc_custom_1594211426980 {
            padding-top: 0px !important;
            padding-right: 30px !important;
            padding-left: 30px !important;
        }

        .vc_custom_1594215012757 {
            padding-top: 0px !important;
            padding-right: 30px !important;
            padding-left: 30px !important;
        }

        .vc_custom_1594217105270 {
            background-color: #ffffff !important;
            border-radius: 35px !important;
        }

        .vc_custom_1594199752945 {
            padding-top: 0px !important;
        }

        .vc_custom_1594217096726 {
            background-color: #ffffff !important;
            border-radius: 35px !important;
        }

        .vc_custom_1594215089210 {
            padding-top: 0px !important;
        }

        .vc_custom_1607090095711 {
            padding-top: 170px !important;
            padding-bottom: 180px !important;
        }

        .vc_custom_1594216696109 {
            margin-right: 0px !important;
            margin-left: 0px !important;
            padding-right: 0px !important;
            padding-left: 0px !important;
        }

    </style>
    <noscript>
        <style>
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }

        </style>
    </noscript>
</head>

<body
    class="home page-template-default page page-id-174 wpb-js-composer js-comp-ver-6.4.2 vc_responsive sh-header-mobile-spacing-compact sh-body-header-sticky carousel-dot-style1 carousel-dot-spacing-5px carousel-dot-size-standard">

<div id="page-container" class="">

    <div class="sh-header-template" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
        <style type="text/css" data-type="vc_shortcodes-custom-css">
            .vc_custom_1607205083420 {
                padding-top: 40px !important;
                padding-right: 20px !important;
                padding-left: 20px !important;
            }

        </style>
        <p>
        <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true"
             class="vc_row wpb_row vc_row-fluid vc_row_1318264568">
            <div class="wpb_column vc_column_container vc_col-sm-12 vc_column_1971482392">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                        <script type="text/javascript">
                            jQuery(document).ready(function ($) {
                                $('#sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile').css('height', $(
                                    '#sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile').actual('outerHeight'));
                            });

                        </script>


                        <style media="screen">
                            /* Topbar */
                            #sh-header-builder-MsPfXcWAqv .container {
                                width: 100% !important;
                                min-width: 100% !important;
                                max-width: 100% !important;
                                padding-left: 30px !important;
                                padding-right: 30px !important;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-topbar {
                                color: #ffffff;
                                background-color: ;
                                min-height: 54px;
                                font-size: 13px;
                                font-weight: ;

                                border-bottom: 1px solid rgba(255, 255, 255, 0.2)
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-topbar i {
                                font-size: 17px;
                            }


                            /* Topbar - Navigation */
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-topbar .sh-topbar-nav a {
                                font-size: 13px;
                                color: #ffffff;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-topbar .sh-topbar-nav a {
                                font-weight: 400
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header .sh-nav > .current_page_item > a {
                                font-weight: 500
                            }


                            /* Topbar - Buttons */
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-topbar .sh-header-builder-buttons a {
                                color: ;
                                background-color: ;
                                font-weight: 400;
                                border-radius: 8px;
                            }


                            /* Topbar - Contacts */


                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-contacts i {
                                color: #ffffff;
                            }


                            /* Main */
                            #sh-header-builder-MsPfXcWAqv {
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-container {
                                background-color: transparent;
                                min-height: 100px;
                                font-size: 18px;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-element-navigation ul.sh-nav > li > a {
                                min-height: 100px;
                                line-height: 100px;
                            }


                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main ul.sh-nav > li > a {
                                color: #111111 !important;


                                font-weight: 500 !important;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main ul.sh-nav > li:hover > a {
                                color: #3c4b64 !important;
                            }

                            #sh-header-builder-MsPfXcWAqv ul.sh-nav > li.current_page_item > a,
                            #sh-header-builder-MsPfXcWAqv ul.sh-nav > li.current-menu-ancestor > a {
                                font-weight: 500 !important;
                            }

                            #sh-header-builder-MsPfXcWAqv i.sh-header-builder-main-element-icon {
                                font-size: 16px;
                                color:
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile .c-hamburger span,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile .c-hamburger span::before,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile .c-hamburger span::after {
                                background-color: ;
                            }

                            #sh-header-builder-MsPfXcWAqv i.sh-header-builder-main-element-icon:hover {
                                color:
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile .c-hamburger:hover span,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile .c-hamburger:hover span::before,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile .c-hamburger:hover span::after {
                                background-color: ;
                            }


                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-element-divider {
                                margin-right: 30px !important;
                            }


                            /* Main - Dropdown */
                            #sh-header-builder-MsPfXcWAqv li.menu-item:not(.sh-nav-cart) .sh-header-builder-main ul.sub-menu {
                                background-color: ;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation ul.sub-menu li.menu-item > a,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation ul.sub-menu li.menu-item > a > i {
                                color: ;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation ul.sub-menu li.menu-item > a:hover,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation ul.sub-menu li.menu-item > a:hover > i {
                                color: ;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation ul.mega-menu-row .menu-item-has-children > a {
                                color: ;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation .mega-menu-row > li.menu-item,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation .widget_shopping_cart_content p.buttons a:first-child {
                                border-color: !important;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation li.menu-item:not(.menu-item-cart) ul a:hover,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-navigation .menu-item-cart .total {
                                border-bottom: !important;
                            }


                            /* Main - Icons */


                            /* Header - Sticky */
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-sticky-fixed .sh-header-builder-main-container,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile-sticky-fixed {
                                background-color: #ffffff;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-sticky-fixed .sh-header-builder-main-container {
                                min-height: 90px;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-sticky-fixed ul.sh-nav > li > a {
                                color: !important;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-sticky-fixed ul.sh-nav > li:hover > a {
                                color: !important;
                            }


                            /* Header - Buttons */

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-element-button-item {
                                font-weight: 400;

                                border-radius: 20px;

                                padding-left: 30px;
                                padding-right: 30px;

                                line-height: 55px;

                                color: #ffffff;

                                background-color: #000000;

                                margin-left: 30px;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile .sh-header-builder-main-element-button-item {
                                margin-left: 0px;
                                margin-right: 30px;
                            }


                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-element-button-item:hover,
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main-element-button-item:focus {
                                color: #ffffff;

                                background-color: #111111;
                            }


                            /* Header - Search */
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-main .sh-header-search {
                                background-color: #ffffff;
                            }


                            /* Mobile */
                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile-content {
                                min-height: 70px;
                            }

                            #sh-header-builder-MsPfXcWAqv .sh-header-builder-mobile {
                                border-bottom: 1px solid #e4e4e4;
                                background-color:
                            }

                            #sh-header-builder-MsPfXcWAqv i.sh-header-builder-mobile-element-icon {
                                font-size: ;
                                color:
                            }

                            #sh-header-builder-MsPfXcWAqv i.sh-header-builder-mobile-element-icon:hover {
                                color:
                            }

                        </style>


                        <header id="sh-header-builder-MsPfXcWAqv"
                                class="sh-header-builder sh-header-builder-MsPfXcWAqv sh-header-builder-main-spacing-standard sh-header-builder-main-nav-spacing-small sh-header-builder-main-icons-small  vc_custom_1607205083420">


                            <div
                                class="sh-header-builder-main sh-header-builder-layout1 sh-header-builder-main-sticky-enabled sh-header-megamenu-style2">
                                <div class="sh-header-builder-main-container">
                                    <div class="container">
                                        <div class="sh-header-builder-main-content">

                                            <div class="sh-header-builder-main-content-left">

                                                <div class="sh-header-builder-main-logo">
                                                    <div class="sh-header-builder-logo"><a
                                                            href="https://www.dmenuonline.com/"><img
                                                                src="https://www.dmenuonline.com/wp-content/uploads/2019/11/logo.png"
                                                                class="sh-header-builder-logo-standard"/><img
                                                                src="https://www.dmenuonline.com/wp-content/uploads/2019/11/logo.png"
                                                                class="sh-header-builder-logo-sticky"/></a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="sh-header-builder-main-content-right">

                                                <div class="sh-header-builder-main-navigation">
                                                    <div class="sh-header-builder-main-navigation-alignment">
                                                        <div
                                                            class="sh-header-builder-main-element sh-header-builder-main-element-navigation sh-nav-container">
                                                            <ul id="menu-header-mobile-app" class="sh-nav">
                                                                <li id="menu-item-32"
                                                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-32">
                                                                    <a href="#about">About</a></li>
                                                                <li id="menu-item-33"
                                                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-33">
                                                                    <a href="#features">Features</a></li>
                                                                <li id="menu-item-34"
                                                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-34">
                                                                    <a href="#pricing">Pricing</a></li>
                                                                <li id="menu-item-35"
                                                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-35">
                                                                    <a href="#contact">Contact</a></li>
                                                            </ul>
                                                        </div>
                                                        <div
                                                            class="sh-header-builder-main-element sh-header-builder-main-element-divider">
                                                        </div>
                                                        <div
                                                            class="sh-header-builder-main-element sh-header-builder-main-element-buttons sh-nav-container"
                                                            style="display: inline-block;">
                                                            <div
                                                                class="sh-header-builder-main-element-button-container ">
                                                                <a href="https://app.zmenu.test/login"
                                                                   class="sh-header-builder-main-element-button-item">
                                                                    <i class="ti-view-grid"></i>Login
                                                                </a></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="sh-header-search">
                                        <div class="sh-table-full">
                                            <div class="sh-table-cell">

                                                <div class="line-test">
                                                    <div class="container">

                                                        <form method="get" class="sh-header-search-form"
                                                              action="https://www.dmenuonline.com/">
                                                            <input type="search" class="sh-header-search-input"
                                                                   placeholder="Search Here.." value="" name="s"
                                                                   required/>
                                                            <button type="submit"
                                                                    class="sh-header-search-submit">
                                                                <i class="icon-magnifier"></i>
                                                            </button>
                                                            <div
                                                                class="sh-header-search-close close-header-search">
                                                                <i class="ti-close"></i>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="sh-header-builder-mobile  sh-header-builder-mobile-sticky-enabled">
                                <div class="sh-header-builder-mobile-container container">
                                    <div class="sh-header-builder-mobile-content sh-header-builder-layout1">

                                        <div class="sh-header-builder-mobile-content-left">

                                            <div class="sh-header-builder-mobile-logo">
                                                <div class="sh-header-builder-logo"><a
                                                        href="https://www.dmenuonline.com/"><img
                                                            src="https://www.dmenuonline.com/wp-content/uploads/2019/11/logo.png"
                                                            class="sh-header-builder-logo-standard"/><img
                                                            src="https://www.dmenuonline.com/wp-content/uploads/2019/11/logo.png"
                                                            class="sh-header-builder-logo-sticky"/></a></div>
                                            </div>

                                        </div>
                                        <div class="sh-header-builder-mobile-content-right">

                                            <div class="sh-header-builder-mobile-navigation">

                                                <div
                                                    class="sh-header-builder-mobile-element sh-header-builder-mobile-menu"
                                                    style="cursor: pointer;">
															<span class="c-hamburger c-hamburger--htx">
																<span>Toggle menu</span>
															</span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <nav class="sh-header-mobile-dropdown">
                                    <div class="container sh-nav-container">

                                        <ul class="sh-nav-mobile"></ul>

                                    </div>


                                    <div class="container sh-nav-container">
                                        <div style="margin-bottom: 30px;">
                                            <div
                                                class="sh-header-builder-main-element sh-header-builder-main-element-buttons sh-nav-container"
                                                style="display: inline-block;">
                                                <div class="sh-header-builder-main-element-button-container ">
                                                    <a href="https://app.zmenu.test/login"
                                                       class="sh-header-builder-main-element-button-item">
                                                        <i class="ti-view-grid"></i>Login
                                                    </a></div>
                                            </div>
                                        </div>


                                        <div class="header-mobile-search">
                                            <form role="search" method="get" class="header-mobile-form"
                                                  action="https://www.dmenuonline.com/">
                                                <input class="header-mobile-form-input" type="text"
                                                       placeholder="Search here.." value="" name="s" required/>
                                                <button type="submit" class="header-mobile-form-submit">
                                                    <i class="icon-magnifier"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </header>

                        <style type="text/css">
                            .vc_column_1971482392:not(.vc_parallax):not(.jarallax) {
                                overflow: center !important;
                                position: relative;
                            }

                        </style>
                    </div>
                </div>
            </div>
        </div>
        <div class="vc_row-full-width vc_clearfix"></div>
        </p>
    </div>
    <div id="wrapper">
        <div class="content-container">
            <div class="container entry-content">
                <div id="content" class="page-content  page-default-content">
                    <div id="about" data-vc-full-width="true" data-vc-full-width-init="false"
                         data-vc-stretch-content="true"
                         class="vc_row wpb_row vc_row-fluid wpb_animate_when_almost_visible wpb_fadeInUp fadeInUp vc_custom_1594218867471 vc_row-has-fill vc_row_442752069">
                        <div
                            class="wpb_column vc_column_container vc_col-sm-6 vc_column_mobile_element_alignment_center vc_column_1463159545">
                            <div class="vc_column-inner vc_custom_1594211052929">
                                <div class="wpb_wrapper"
                                     style="width: 100%; max-width: 750px;margin-left: auto; margin-right: auto;">

                                    <div class="sh-empty-space vc_empty_space sh-empty-space-gY5zn7STPI  "
                                         style="height: 20px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>

                                    <div class="sh-heading sh-heading-style1" id="heading-IrKbdNpHz0">
                                        <h2 class="sh-heading-content size-xxxl">
                                            </span>
                                            <span style="text-align: left;">Carefully crafted digital menu
													solution.</span>
                                            <span></h2>
                                    </div>

                                    <style type="text/css">
                                        #heading-IrKbdNpHz0 {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        #heading-IrKbdNpHz0 .sh-heading-content {
                                            line-height: 110% !important;
                                            font-weight: 600 !important;
                                        }

                                    </style>


                                    <div class="sh-empty-space vc_empty_space sh-empty-space-9ycWCzAexq  "
                                         style="height: 10px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>

                                    <div class="sh-heading  " id="heading-4A0Z2YVaQX">
                                        <div class="sh-element-margin">

                                            <h1 class="sh-heading-content size-custom text-left">
                                                Turn your paper menu into an interactive digital one. </h1>
                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #heading-4A0Z2YVaQX .sh-element-margin {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        #heading-4A0Z2YVaQX .sh-heading-content {
                                            font-size: 30px;
                                            font-weight: 400 !important;
                                            color: #c2c2c2;
                                        }

                                        #heading-4A0Z2YVaQX .sh-heading-content,
                                        #heading-4A0Z2YVaQX .sh-heading-additional-text {
                                        }

                                    </style>


                                    <div class="sh-empty-space vc_empty_space sh-empty-space-z3dm1kWyrI  "
                                         style="height: 60px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>


                                    <div id="button-AnSFCUejwY" class="sh-button-container  sh-button-style-2">
                                        <div class="sh-element-margin">
                                            <a href="#features" target="_self"
                                               class="sh-button sh-button-medium sh-button-icon-left">

													<span class="sh-button-icon">
														<i class="fa fa-angle-down"></i>
													</span>

                                                <span class="sh-button-text">
														Find out more </span>


                                            </a>
                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #button-AnSFCUejwY .sh-button-text {
                                            font-weight: 600;
                                        }

                                        #button-AnSFCUejwY .sh-button {
                                            line-height: 62px;
                                            padding-top: 0;
                                            padding-bottom: 0;
                                            padding-left: 30px;
                                            padding-right: 30px;
                                            font-size: 20px;
                                            border-radius: 25px;
                                            background-color: #000000;
                                            color: #ffffff;
                                        }

                                        #button-AnSFCUejwY {
                                        }

                                        #button-AnSFCUejwY:not(.sh-button-style-2) .sh-button:hover {
                                            background-color: #111111;
                                        }

                                        #button-AnSFCUejwY.sh-button-style-2 .sh-button:after {
                                            background-color: #111111;
                                        }

                                        #button-AnSFCUejwY.sh-button-style-2 .sh-button:hover {
                                        }

                                        @media (max-width: 800px) {
                                            #button-AnSFCUejwY {
                                                text-align: left;
                                            }
                                        }

                                    </style>

                                    <style media="screen">
                                        @media (max-width: 1025px) {
                                            .sh-empty-space-CmsqgBRytY {
                                                height: 50px !important;
                                            }
                                        }

                                    </style>

                                    <div class="sh-empty-space vc_empty_space sh-empty-space-CmsqgBRytY  "
                                         style="height: 120px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>

                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_1463159545 > .vc_column-inner {
                                                padding: 60px 30px 30px 30px !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-6 vc_column_1054609628">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper">
                                    <div id="single-image-bIVBQ7x9dj" class="sh-single-image  ">
                                        <div class="sh-element-margin">


                                            <div class="sh-single-image-container">

                                                <img class="sh-image-url"
                                                     src="https://www.dmenuonline.com/wp-content/uploads/2020/12/8168833.png"
                                                     alt="8168833"/>


                                            </div>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #single-image-bIVBQ7x9dj {
                                            text-align: center;
                                        }

                                    </style>
                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_1054609628 > .vc_column-inner {
                                                padding: 0px 30px 60px 30px !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                        <style type="text/css">
                            @media (max-width: 800px) {

                                #content .vc_row_442752069,
                                .sh-footer-template .vc_row_442752069,
                                .sh-header-template .vc_row_442752069 {
                                    padding: 0px 0px 0px 0px !important;
                                }
                            }

                            .vc_row_442752069 {
                                background-position: left center !important;
                            }

                        </style>
                    </div>
                    <div class="vc_row-full-width vc_clearfix"></div>
                    <div
                        class="vc_row wpb_row vc_row-fluid wpb_animate_when_almost_visible wpb_fadeInUp fadeInUp vc_row_1441059481">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper" style="text-align: center;">
                                    <div class="sh-heading  " id="heading-ytbwZXYo0r">
                                        <div class="sh-element-margin">


                                            <h2 class="sh-heading-content size-custom text-center">
                                                About </h2>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #heading-ytbwZXYo0r .sh-element-margin {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        #heading-ytbwZXYo0r .sh-heading-content {
                                            font-size: 48px;
                                            font-weight: 400 !important;
                                            color: #c2c2c2;
                                        }

                                        #heading-ytbwZXYo0r .sh-heading-content,
                                        #heading-ytbwZXYo0r .sh-heading-additional-text {
                                        }

                                    </style>


                                    <div class="sh-heading sh-heading-style1" id="heading-1o8HRAEUDY">
                                        <h2 class="sh-heading-content size-custom">
                                            </span>
                                            <span style="text-align: center;">Watch our quick</span>
                                            <span style="text-align: center;">introduction</span>
                                            <span style="text-align: center;">video</span>
                                            <span></h2>
                                    </div>

                                    <style type="text/css">
                                        #heading-1o8HRAEUDY {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        @media (max-width: 1024px) {
                                            #heading-1o8HRAEUDY .sh-heading-content {
                                                font-size: 40px !important;
                                            }
                                        }

                                        #heading-1o8HRAEUDY .sh-heading-content {
                                            font-size: 60px;
                                            line-height: 120% !important;
                                        }

                                    </style>


                                    <div class="sh-empty-space vc_empty_space sh-empty-space-4WgnKcE8vX  "
                                         style="height: 60px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>


                                    <div id="text-block-0tcfqBsWIJ" class="sh-text-block">
                                        </p>
                                        <p style="text-align: center;"><strong>DMENU</strong> is the perfect tool
                                            for restaurants, cafes, shops and other business types to provide their
                                            customers with an attractive QR, digital menu and help them navigate
                                            with a few simple clicks.</p>
                                        <p>
                                    </div>
                                    <style type="text/css">
                                        #text-block-0tcfqBsWIJ {
                                            margin: 0px 0px 15px 0px;
                                        }

                                        #text-block-0tcfqBsWIJ a:hover,
                                        #text-block-0tcfqBsWIJ a:focus {
                                            color: #6b6b6b;
                                        }

                                        #text-block-0tcfqBsWIJ p,
                                        #text-block-0tcfqBsWIJ {
                                            line-height: 150%;
                                        }

                                        #text-block-0tcfqBsWIJ .drop-cap {
                                            font-weight: bold;
                                            font-size: 50px;
                                            display: block;
                                            float: left;
                                            margin: 8px 10px 0 0;
                                        }

                                    </style>

                                    <style media="screen">
                                        @media (max-width: 1025px) {
                                            .sh-empty-space-ZF20duiDNp {
                                                height: 50px !important;
                                            }
                                        }

                                    </style>

                                    <div class="sh-empty-space vc_empty_space sh-empty-space-ZF20duiDNp  "
                                         style="height: 120px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true"
                         data-jarallax data-speed="0.2"
                         class="vc_row wpb_row vc_row-fluid vc_custom_1607090449024 vc_row-has-fill vc_row-o-equal-height vc_row-o-content-middle vc_row-flex vc_row_63199875 jarallax">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper"
                                     style="width: 100%; max-width: 510px;margin-left: auto; margin-right: auto;text-align: center;">
                                    <div id="icon-KQSumPlEy8" class="sh-icon  sh-icon-center">

                                        <a href="https://www.youtube.com/embed/FlDYXbpQQtU" data-rel="lightcase"
                                           target="_self">

                                            <div class="sh-element-margin">
                                                <div class="sh-icon-container">
                                                    <i class="sh-icon-data fa fa-play"></i>
                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                    <style type="text/css">
                                        #icon-KQSumPlEy8 .sh-icon-container {
                                            transition: all 0.4s ease-in-out;
                                            background-color: #fafafa;
                                            border-radius: 100px;
                                            text-align: center;
                                            width: 110px;
                                            height: 110px;
                                            line-height: 110px;
                                        }

                                        #icon-KQSumPlEy8 .sh-icon-container:hover {
                                            background-color: #000000;
                                        }

                                        #icon-KQSumPlEy8 .sh-icon-data {
                                            font-size: 21px;
                                            color: #272727;
                                        }

                                        #icon-KQSumPlEy8:hover .sh-icon-data {
                                            color: #ffffff;
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vc_row-full-width vc_clearfix"></div>
                    <div id="features" data-vc-full-width="true" data-vc-full-width-init="false"
                         data-vc-stretch-content="true"
                         class="vc_row wpb_row vc_row-fluid vc_custom_1594208500826 vc_row-o-equal-height vc_row-o-content-middle vc_row-flex vc_row_1378277659 vc_row_reversed_columns">
                        <div
                            class="wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill">
                            <div class="vc_column-inner vc_custom_1593795409719">
                                <div class="wpb_wrapper">
                                    <div id="single-image-IzFinfV9e5" class="sh-single-image  ">
                                        <div class="sh-element-margin">


                                            <div class="sh-single-image-container">

                                                <img class="sh-image-url"
                                                     src="https://www.dmenuonline.com/wp-content/uploads/2020/12/816882.png"
                                                     alt="816882"/>


                                            </div>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #single-image-IzFinfV9e5 {
                                            text-align: center;
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                        <div
                            class="wpb_animate_when_almost_visible wpb_fadeInRightBig fadeInRightBig wpb_column vc_column_container vc_col-sm-6 vc_column_1131620685">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper"
                                     style="width: 100%; max-width: 560px;margin-left: 0; margin-right: auto;">
                                    <div class="sh-heading  " id="heading-hzpS6wK7rn">
                                        <div class="sh-element-margin">


                                            <h2 class="sh-heading-content size-custom text-left">
                                                Manage Everything </h2>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #heading-hzpS6wK7rn .sh-element-margin {
                                            margin: 0px 0px 18px 0px;
                                        }

                                        #heading-hzpS6wK7rn .sh-heading-content {
                                            font-size: 36px;
                                            font-weight: 400 !important;
                                            color: #c2c2c2;
                                        }

                                        #heading-hzpS6wK7rn .sh-heading-content,
                                        #heading-hzpS6wK7rn .sh-heading-additional-text {
                                        }

                                    </style>


                                    <div class="sh-heading sh-heading-style1" id="heading-RuETdfOFPh">
                                        <h2 class="sh-heading-content size-custom">
                                            </span>
                                            <span style="text-align: left;">Endless menu categories and items</span>
                                            <span></h2>
                                    </div>

                                    <style type="text/css">
                                        #heading-RuETdfOFPh {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        @media (max-width: 1024px) {
                                            #heading-RuETdfOFPh .sh-heading-content {
                                                font-size: 40px !important;
                                            }
                                        }

                                        #heading-RuETdfOFPh .sh-heading-content {
                                            font-size: 60px;
                                            line-height: 120% !important;
                                        }

                                    </style>


                                    <div class="sh-empty-space vc_empty_space sh-empty-space-cQdlohAMwE  "
                                         style="height: 60px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>


                                    <div id="text-block-Y6AOtWFPLk" class="sh-text-block">
                                        </p>
                                        <p style="text-align: left;">Manage your menu seamlessly with your own
                                            dashboard access.</p>
                                        <p>
                                    </div>
                                    <style type="text/css">
                                        #text-block-Y6AOtWFPLk {
                                            font-size: 24px;
                                            margin: 0px 0px 15px 0px;
                                        }

                                        #text-block-Y6AOtWFPLk a:hover,
                                        #text-block-Y6AOtWFPLk a:focus {
                                            color: #6b6b6b;
                                        }

                                        #text-block-Y6AOtWFPLk p,
                                        #text-block-Y6AOtWFPLk {
                                            line-height: 150%;
                                        }

                                        #text-block-Y6AOtWFPLk .drop-cap {
                                            font-weight: bold;
                                            font-size: 50px;
                                            display: block;
                                            float: left;
                                            margin: 8px 10px 0 0;
                                        }

                                    </style>
                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_1131620685 > .vc_column-inner > .wpb_wrapper {
                                                margin-left: 0 !important;
                                                margin-right: auto !important;
                                            }
                                        }

                                        @media (max-width: 800px) {
                                            .vc_column_1131620685 > .vc_column-inner {
                                                padding: 0px 30px 30px 30px !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vc_row-full-width vc_clearfix"></div>
                    <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true"
                         class="vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-o-content-middle vc_row-flex vc_row_1751014760">
                        <div
                            class="wpb_animate_when_almost_visible wpb_fadeInLeftBig fadeInLeftBig wpb_column vc_column_container vc_col-sm-6 vc_column_585175437">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper"
                                     style="width: 100%; max-width: 560px;margin-left: auto; margin-right: 0;">
                                    <div class="sh-heading  " id="heading-FS2m7zskc9">
                                        <div class="sh-element-margin">


                                            <h2 class="sh-heading-content size-custom text-left">
                                                Advanced marketing </h2>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #heading-FS2m7zskc9 .sh-element-margin {
                                            margin: 0px 0px 18px 0px;
                                        }

                                        #heading-FS2m7zskc9 .sh-heading-content {
                                            font-size: 36px;
                                            font-weight: 400 !important;
                                            color: #c2c2c2;
                                        }

                                        #heading-FS2m7zskc9 .sh-heading-content,
                                        #heading-FS2m7zskc9 .sh-heading-additional-text {
                                        }

                                    </style>


                                    <div class="sh-heading sh-heading-style1" id="heading-4CmiRlAE3X">
                                        <h2 class="sh-heading-content size-custom">
                                            </span>
                                            <span style="text-align: left;">Grow your brand</span>
                                            <span></h2>
                                    </div>

                                    <style type="text/css">
                                        #heading-4CmiRlAE3X {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        @media (max-width: 1024px) {
                                            #heading-4CmiRlAE3X .sh-heading-content {
                                                font-size: 40px !important;
                                            }
                                        }

                                        #heading-4CmiRlAE3X .sh-heading-content {
                                            font-size: 60px;
                                            line-height: 120% !important;
                                        }

                                    </style>


                                    <div class="sh-empty-space vc_empty_space sh-empty-space-Eks8gCRmLB  "
                                         style="height: 60px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>

                                    <div
                                        class="vc_row wpb_row vc_inner vc_row-fluid vc_row-o-equal-height vc_row-o-content-middle vc_row-flex vc_row_1822713493">
                                        <div class="wpb_column vc_column_container vc_col-sm-1/5">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div id="icon-cqxW4u91KT"
                                                         class="sh-icon  sh-element-inline sh-icon-left">


                                                        <div class="sh-element-margin">
                                                            <div class="sh-icon-container">
                                                                <i class="sh-icon-data icon-picture"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <style type="text/css">
                                                        #icon-cqxW4u91KT .sh-icon-container {
                                                            transition: all 0.4s ease-in-out;
                                                            background-color: #f7f7f7;
                                                            border-radius: 20px;
                                                            padding: 20px 21px 16px 22px;
                                                        }

                                                        #icon-cqxW4u91KT .sh-icon-container:hover {
                                                            background-color: #f7f7f7;
                                                        }

                                                        #icon-cqxW4u91KT .sh-icon-data {
                                                            font-size: 36px;
                                                            color: #000000;
                                                        }

                                                        #icon-cqxW4u91KT .sh-element-margin {
                                                            margin: 0px 0px 0px 0px;
                                                        }

                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wpb_column vc_column_container vc_col-sm-4/5">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper"
                                                     style="width: 100%; max-width: 260px;margin-left: 0; margin-right: auto;">
                                                    <div id="text-block-GRhQ0Modq9" class="sh-text-block">
                                                        </p>
                                                        <p style="text-align: left;">Create engaging Ads Popup
                                                            targeting subscribers or anonymous visitors.</p>
                                                        <p>
                                                    </div>
                                                    <style type="text/css">
                                                        #text-block-GRhQ0Modq9 {
                                                            font-size: 24px;
                                                            color: #111111;
                                                            margin: 0px 0px 0px 0px;
                                                        }

                                                        #text-block-GRhQ0Modq9 a:hover,
                                                        #text-block-GRhQ0Modq9 a:focus {
                                                            color: #6b6b6b;
                                                        }

                                                        #text-block-GRhQ0Modq9 p,
                                                        #text-block-GRhQ0Modq9 {
                                                            line-height: 150%;
                                                        }

                                                        #text-block-GRhQ0Modq9 .drop-cap {
                                                            font-weight: bold;
                                                            font-size: 50px;
                                                            display: block;
                                                            float: left;
                                                            margin: 8px 10px 0 0;
                                                        }

                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="vc_row wpb_row vc_inner vc_row-fluid vc_row-o-equal-height vc_row-o-content-middle vc_row-flex vc_row_1059491289">
                                        <div
                                            class="wpb_column vc_column_container vc_col-sm-1/5 vc_column_829636341">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div id="icon-bWnAE2GtJy"
                                                         class="sh-icon  sh-element-inline sh-icon-left">


                                                        <div class="sh-element-margin">
                                                            <div class="sh-icon-container">
                                                                <i class="sh-icon-data fa fa-comments-o"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <style type="text/css">
                                                        #icon-bWnAE2GtJy .sh-icon-container {
                                                            transition: all 0.4s ease-in-out;
                                                            background-color: #f7f7f7;
                                                            border-radius: 20px;
                                                            padding: 20px 21px 16px 22px;
                                                        }

                                                        #icon-bWnAE2GtJy .sh-icon-container:hover {
                                                            background-color: #f7f7f7;
                                                        }

                                                        #icon-bWnAE2GtJy .sh-icon-data {
                                                            font-size: 36px;
                                                            color: #000000;
                                                        }

                                                        #icon-bWnAE2GtJy .sh-element-margin {
                                                            margin: 0px 0px 0px 0px;
                                                        }

                                                    </style>
                                                    <style type="text/css">
                                                        .vc_column_829636341:not(.vc_parallax):not(.jarallax) {
                                                            overflow: center !important;
                                                            position: relative;
                                                        }

                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wpb_column vc_column_container vc_col-sm-4/5">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper"
                                                     style="width: 100%; max-width: 260px;margin-left: 0; margin-right: auto;">
                                                    <div id="text-block-BvlQoikuHX" class="sh-text-block">
                                                        </p>
                                                        <p style="text-align: left;">Engage with your customers by
                                                            sending SMS messages.</p>
                                                        <p>
                                                    </div>
                                                    <style type="text/css">
                                                        #text-block-BvlQoikuHX {
                                                            font-size: 24px;
                                                            color: #111111;
                                                            margin: 0px 0px 0px 0px;
                                                        }

                                                        #text-block-BvlQoikuHX a:hover,
                                                        #text-block-BvlQoikuHX a:focus {
                                                            color: #6b6b6b;
                                                        }

                                                        #text-block-BvlQoikuHX p,
                                                        #text-block-BvlQoikuHX {
                                                            line-height: 150%;
                                                        }

                                                        #text-block-BvlQoikuHX .drop-cap {
                                                            font-weight: bold;
                                                            font-size: 50px;
                                                            display: block;
                                                            float: left;
                                                            margin: 8px 10px 0 0;
                                                        }

                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="vc_row wpb_row vc_inner vc_row-fluid vc_row-o-equal-height vc_row-o-content-middle vc_row-flex vc_row_1019461012">
                                        <div
                                            class="wpb_column vc_column_container vc_col-sm-1/5 vc_column_1048398765">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div id="icon-SMN8vboy9t"
                                                         class="sh-icon  sh-element-inline sh-icon-left">


                                                        <div class="sh-element-margin">
                                                            <div class="sh-icon-container">
                                                                <i class="sh-icon-data fa fa-users"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <style type="text/css">
                                                        #icon-SMN8vboy9t .sh-icon-container {
                                                            transition: all 0.4s ease-in-out;
                                                            background-color: #f7f7f7;
                                                            border-radius: 20px;
                                                            padding: 20px 21px 16px 22px;
                                                        }

                                                        #icon-SMN8vboy9t .sh-icon-container:hover {
                                                            background-color: #f7f7f7;
                                                        }

                                                        #icon-SMN8vboy9t .sh-icon-data {
                                                            font-size: 36px;
                                                            color: #000000;
                                                        }

                                                        #icon-SMN8vboy9t .sh-element-margin {
                                                            margin: 0px 0px 0px 0px;
                                                        }

                                                    </style>
                                                    <style type="text/css">
                                                        .vc_column_1048398765:not(.vc_parallax):not(.jarallax) {
                                                            overflow: center !important;
                                                            position: relative;
                                                        }

                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wpb_column vc_column_container vc_col-sm-4/5">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper"
                                                     style="width: 100%; max-width: 260px;margin-left: 0; margin-right: auto;">
                                                    <div id="text-block-KVl7ZDGpR3" class="sh-text-block">
                                                        </p>
                                                        <p style="text-align: left;">Track your visitors activities:
                                                            ratings, visits, favorites.</p>
                                                        <p>
                                                    </div>
                                                    <style type="text/css">
                                                        #text-block-KVl7ZDGpR3 {
                                                            font-size: 24px;
                                                            color: #111111;
                                                            margin: 0px 0px 0px 0px;
                                                        }

                                                        #text-block-KVl7ZDGpR3 a:hover,
                                                        #text-block-KVl7ZDGpR3 a:focus {
                                                            color: #6b6b6b;
                                                        }

                                                        #text-block-KVl7ZDGpR3 p,
                                                        #text-block-KVl7ZDGpR3 {
                                                            line-height: 150%;
                                                        }

                                                        #text-block-KVl7ZDGpR3 .drop-cap {
                                                            font-weight: bold;
                                                            font-size: 50px;
                                                            display: block;
                                                            float: left;
                                                            margin: 8px 10px 0 0;
                                                        }

                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_585175437 > .vc_column-inner > .wpb_wrapper {
                                                margin-left: 0 !important;
                                                margin-right: auto !important;
                                            }
                                        }

                                        @media (max-width: 800px) {
                                            .vc_column_585175437 > .vc_column-inner {
                                                padding: 0px 30px 30px 30px !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                        <div
                            class="wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill">
                            <div class="vc_column-inner vc_custom_1593795430983">
                                <div class="wpb_wrapper">
                                    <div id="single-image-QOtz54i7hl" class="sh-single-image  ">
                                        <div class="sh-element-margin">


                                            <div class="sh-single-image-container">

                                                <img class="sh-image-url"
                                                     src="https://www.dmenuonline.com/wp-content/uploads/2020/12/AD10-copy.png"
                                                     alt="AD10 copy"/>


                                            </div>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #single-image-QOtz54i7hl {
                                            text-align: center;
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vc_row-full-width vc_clearfix"></div>
                    <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true"
                         class="vc_row wpb_row vc_row-fluid vc_custom_1594208662652 vc_row-o-equal-height vc_row-o-content-middle vc_row-flex vc_row_693655799 vc_row_reversed_columns">
                        <div data-vc-parallax="1.5"
                             class="wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill vc_general vc_parallax vc_parallax-content-moving">
                            <div class="vc_column-inner vc_custom_1594117071134">
                                <div class="wpb_wrapper">
                                    <div id="single-image-47Om2dJBDX" class="sh-single-image  ">
                                        <div class="sh-element-margin">


                                            <div class="sh-single-image-container">

                                                <img class="sh-image-url"
                                                     src="https://www.dmenuonline.com/wp-content/uploads/2020/12/AD101-copy.png"
                                                     alt="AD101 copy"/>


                                            </div>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #single-image-47Om2dJBDX {
                                            text-align: center;
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                        <div
                            class="wpb_animate_when_almost_visible wpb_fadeInRightBig fadeInRightBig wpb_column vc_column_container vc_col-sm-6 vc_column_1131302661">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper"
                                     style="width: 100%; max-width: 560px;margin-left: 0; margin-right: auto;">
                                    <div class="sh-heading  " id="heading-s7paKhfNtv">
                                        <div class="sh-element-margin">


                                            <h2 class="sh-heading-content size-custom text-left">
                                                Never Miss </h2>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #heading-s7paKhfNtv .sh-element-margin {
                                            margin: 0px 0px 18px 0px;
                                        }

                                        #heading-s7paKhfNtv .sh-heading-content {
                                            font-size: 36px;
                                            font-weight: 400 !important;
                                            color: #c2c2c2;
                                        }

                                        #heading-s7paKhfNtv .sh-heading-content,
                                        #heading-s7paKhfNtv .sh-heading-additional-text {
                                        }

                                    </style>


                                    <div class="sh-heading sh-heading-style1" id="heading-KJLrnQ1t6X">
                                        <h2 class="sh-heading-content size-custom">
                                            </span>
                                            <span style="text-align: left;">Facebook Messenger Integration</span>
                                            <span></h2>
                                    </div>

                                    <style type="text/css">
                                        #heading-KJLrnQ1t6X {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        @media (max-width: 1024px) {
                                            #heading-KJLrnQ1t6X .sh-heading-content {
                                                font-size: 40px !important;
                                            }
                                        }

                                        #heading-KJLrnQ1t6X .sh-heading-content {
                                            font-size: 60px;
                                            line-height: 120% !important;
                                        }

                                    </style>


                                    <div class="sh-empty-space vc_empty_space sh-empty-space-DiUqmrOzwc  "
                                         style="height: 60px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>


                                    <div id="text-block-QfSTx9Vj0U" class="sh-text-block">
                                        </p>
                                        <p style="text-align: left;">You can communicate directly with your
                                            customers from within the menu using the facebook messenger integration.
                                        </p>
                                        <p>With simple clicks connect your facebook page.
                                    </div>
                                    <style type="text/css">
                                        #text-block-QfSTx9Vj0U {
                                            font-size: 24px;
                                            margin: 0px 0px 15px 0px;
                                        }

                                        #text-block-QfSTx9Vj0U a:hover,
                                        #text-block-QfSTx9Vj0U a:focus {
                                            color: #6b6b6b;
                                        }

                                        #text-block-QfSTx9Vj0U p,
                                        #text-block-QfSTx9Vj0U {
                                            line-height: 150%;
                                        }

                                        #text-block-QfSTx9Vj0U .drop-cap {
                                            font-weight: bold;
                                            font-size: 50px;
                                            display: block;
                                            float: left;
                                            margin: 8px 10px 0 0;
                                        }

                                    </style>
                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_1131302661 > .vc_column-inner > .wpb_wrapper {
                                                margin-left: 0 !important;
                                                margin-right: auto !important;
                                            }
                                        }

                                        @media (max-width: 800px) {
                                            .vc_column_1131302661 > .vc_column-inner {
                                                padding: 0px 30px 0px 30px !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vc_row-full-width vc_clearfix"></div>
                    <div id="pricing" data-vc-full-width="true" data-vc-full-width-init="false"
                         data-vc-stretch-content="true" data-jarallax data-speed="0.2"
                         class="vc_row wpb_row vc_row-fluid vc_custom_1607088695260 vc_row-has-fill vc_row-o-equal-height vc_row-flex vc_row_938186133 jarallax">
                        <div class="wpb_column vc_column_container vc_col-sm-4 vc_column_123263729">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper"
                                     style="width: 100%; max-width: 400px;margin-left: auto; margin-right: auto;">
                                    <div class="sh-heading  " id="heading-Vgo1d7TaFR">
                                        <div class="sh-element-margin">


                                            <h2 class="sh-heading-content size-custom text-left">
                                                Pricing </h2>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #heading-Vgo1d7TaFR .sh-element-margin {
                                            margin: 0px 0px 18px 0px;
                                        }

                                        #heading-Vgo1d7TaFR .sh-heading-content {
                                            font-size: 36px;
                                            font-weight: 400 !important;
                                            color: #ffffff;
                                        }

                                        #heading-Vgo1d7TaFR .sh-heading-content,
                                        #heading-Vgo1d7TaFR .sh-heading-additional-text {
                                        }

                                    </style>


                                    <div class="sh-heading sh-heading-style1" id="heading-kZpisn0x94">
                                        <h2 class="sh-heading-content size-custom">
                                            </span>
                                            <span style="text-align: left;">Choose what suits your needs the
													best</span>
                                            <span></h2>
                                    </div>

                                    <style type="text/css">
                                        #heading-kZpisn0x94 {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        @media (max-width: 1024px) {
                                            #heading-kZpisn0x94 .sh-heading-content {
                                                font-size: 40px !important;
                                            }
                                        }

                                        #heading-kZpisn0x94 .sh-heading-content {
                                            font-size: 60px;
                                            line-height: 120% !important;
                                            font-weight: 600 !important;
                                            color: #ffffff;
                                        }

                                    </style>


                                    <div class="sh-empty-space vc_empty_space sh-empty-space-mCa1cOUFru  "
                                         style="height: 56px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>

                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_123263729 > .vc_column-inner > .wpb_wrapper {
                                                margin-left: 0 !important;
                                                margin-right: auto !important;
                                            }
                                        }

                                        @media (max-width: 800px) {
                                            .vc_column_123263729 > .vc_column-inner {
                                                padding: 30px 30px 30px 30px !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                        <div
                            class="wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_column vc_column_container vc_col-sm-4 vc_column_785783448">
                            <div class="vc_column-inner vc_custom_1594211426980">
                                <div class="wpb_wrapper"
                                     style="width: 100%; max-width: 405px;margin-left: auto; margin-right: 0;">
                                    <div
                                        class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1594217105270 vc_row-has-fill vc_row_1692552579"
                                        style="width: 100%; max-width: 410px;margin-left: auto; margin-right: 0;">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner vc_custom_1594199752945">
                                                <div class="wpb_wrapper">

                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-UHeDiJqVkR  "
                                                        style="height: 60px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-Q5imcIUrgn">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Basic plan </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-Q5imcIUrgn .sh-element-margin {
                                                            margin: 0px 0px 5px 0px;
                                                        }

                                                        #heading-Q5imcIUrgn .sh-heading-content {
                                                            font-size: 28px;
                                                            font-weight: 600 !important;
                                                            color: #959595;
                                                        }

                                                        #heading-Q5imcIUrgn .sh-heading-content,
                                                        #heading-Q5imcIUrgn .sh-heading-additional-text {
                                                        }

                                                    </style>

                                                    <div class="sh-heading  " id="heading-fd6BFo21Ek">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                $12 </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-fd6BFo21Ek .sh-element-margin {
                                                            margin: 0px 0px 0px 0px;
                                                        }

                                                        #heading-fd6BFo21Ek .sh-heading-content {
                                                            font-size: 90px;
                                                            font-weight: 500 !important;
                                                        }

                                                        #heading-fd6BFo21Ek .sh-heading-content,
                                                        #heading-fd6BFo21Ek .sh-heading-additional-text {
                                                        }

                                                    </style>

                                                    <div class="sh-heading  " id="heading-norELTJfMW">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                /monthly </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-norELTJfMW .sh-element-margin {
                                                        }

                                                        #heading-norELTJfMW .sh-heading-content {
                                                            font-size: 22px;
                                                            line-height: 50% !important;
                                                            font-weight: 400 !important;
                                                            color: #acacac;
                                                        }

                                                        #heading-norELTJfMW .sh-heading-content,
                                                        #heading-norELTJfMW .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-F7Djtpa9fm  "
                                                        style="height: 56px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div id="button-XQ1fyWLYZo"
                                                         class="sh-button-container  sh-button-style-2">
                                                        <div class="sh-element-margin">
                                                            <a href="https://app.zmenu.test/register" target="_self"
                                                               class="sh-button sh-button-medium ">


																	<span class="sh-button-text">
																		Get Started </span>


                                                            </a>
                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #button-XQ1fyWLYZo .sh-button-text {
                                                            font-weight: 600;
                                                        }

                                                        #button-XQ1fyWLYZo .sh-button {
                                                            line-height: 62px;
                                                            padding-top: 0;
                                                            padding-bottom: 0;
                                                            padding-left: 45px;
                                                            padding-right: 45px;
                                                            font-size: 20px;
                                                            border-radius: 25px;
                                                            background-color: rgba(255, 255, 255, 0.01);
                                                            color: #000000;
                                                            border: 2px solid #111111;
                                                            display: block !important;
                                                            width: 100%;
                                                        }

                                                        #button-XQ1fyWLYZo {
                                                            text-align: center;
                                                        }

                                                        #button-XQ1fyWLYZo:not(.sh-button-style-2) .sh-button:hover {
                                                            background-color: #000000;
                                                            color: #ffffff;
                                                        }

                                                        #button-XQ1fyWLYZo.sh-button-style-2 .sh-button:after {
                                                            background-color: #000000;
                                                        }

                                                        #button-XQ1fyWLYZo.sh-button-style-2 .sh-button:hover {
                                                            color: #ffffff;
                                                        }

                                                        @media (max-width: 800px) {
                                                            #button-XQ1fyWLYZo {
                                                                text-align: center;
                                                            }
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-xEndF6l0ki  "
                                                        style="height: 30px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-fgHbM8wNLe">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Unlimited menu items </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-fgHbM8wNLe .sh-element-margin {
                                                        }

                                                        #heading-fgHbM8wNLe .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-fgHbM8wNLe .sh-heading-content,
                                                        #heading-fgHbM8wNLe .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-yQpcohKPDF  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-JVSvEdaNse">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Customer Registration </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-JVSvEdaNse .sh-element-margin {
                                                        }

                                                        #heading-JVSvEdaNse .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-JVSvEdaNse .sh-heading-content,
                                                        #heading-JVSvEdaNse .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-tdkvKlzDja  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-YVQnibuk1H">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Analytics </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-YVQnibuk1H .sh-element-margin {
                                                        }

                                                        #heading-YVQnibuk1H .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-YVQnibuk1H .sh-heading-content,
                                                        #heading-YVQnibuk1H .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-Upo4tDNYbE  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-XsrdRytYGc">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Custom design </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-XsrdRytYGc .sh-element-margin {
                                                        }

                                                        #heading-XsrdRytYGc .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-XsrdRytYGc .sh-heading-content,
                                                        #heading-XsrdRytYGc .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-qcxkTzfhsl  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-Y9wXzD8FEf">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                - </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-Y9wXzD8FEf .sh-element-margin {
                                                        }

                                                        #heading-Y9wXzD8FEf .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-Y9wXzD8FEf .sh-heading-content,
                                                        #heading-Y9wXzD8FEf .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-0fWVKnRjyQ  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-T1NP4qX2Ff">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                - </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-T1NP4qX2Ff .sh-element-margin {
                                                        }

                                                        #heading-T1NP4qX2Ff .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-T1NP4qX2Ff .sh-heading-content,
                                                        #heading-T1NP4qX2Ff .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-rEkn2AY3wX  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-L6XuH5pY3S">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                - </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-L6XuH5pY3S .sh-element-margin {
                                                        }

                                                        #heading-L6XuH5pY3S .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-L6XuH5pY3S .sh-heading-content,
                                                        #heading-L6XuH5pY3S .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-pclqOZmdY6  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-8tlTBAgNJK">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                - </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-8tlTBAgNJK .sh-element-margin {
                                                        }

                                                        #heading-8tlTBAgNJK .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-8tlTBAgNJK .sh-heading-content,
                                                        #heading-8tlTBAgNJK .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-qlx15JU0gO  "
                                                        style="height: 70px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <style type="text/css">
                                            @media (max-width: 800px) {
                                                .vc_row_1692552579 {
                                                    margin-left: auto !important;
                                                    margin-right: auto !important;
                                                }
                                            }

                                        </style>
                                    </div>
                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_785783448 > .vc_column-inner > .wpb_wrapper {
                                                margin-left: auto !important;
                                                margin-right: auto !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                        <div
                            class="wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_column vc_column_container vc_col-sm-4 vc_column_2026341464">
                            <div class="vc_column-inner vc_custom_1594215012757">
                                <div class="wpb_wrapper">
                                    <div
                                        class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1594217096726 vc_row-has-fill vc_row_689070019"
                                        style="width: 100%; max-width: 410px;margin-left: 0; margin-right: auto;">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner vc_custom_1594215089210">
                                                <div class="wpb_wrapper">

                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-mQ8tckx9T0  "
                                                        style="height: 60px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-MaGqkoNS9K">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Premium plan </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-MaGqkoNS9K .sh-element-margin {
                                                            margin: 0px 0px 5px 0px;
                                                        }

                                                        #heading-MaGqkoNS9K .sh-heading-content {
                                                            font-size: 28px;
                                                            font-weight: 600 !important;
                                                            color: #959595;
                                                        }

                                                        #heading-MaGqkoNS9K .sh-heading-content,
                                                        #heading-MaGqkoNS9K .sh-heading-additional-text {
                                                        }

                                                    </style>

                                                    <div class="sh-heading  " id="heading-YUj2gdruJy">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                $20 </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-YUj2gdruJy .sh-element-margin {
                                                            margin: 0px 0px 0px 0px;
                                                        }

                                                        #heading-YUj2gdruJy .sh-heading-content {
                                                            font-size: 90px;
                                                            font-weight: 500 !important;
                                                            color: #000000;
                                                        }

                                                        #heading-YUj2gdruJy .sh-heading-content,
                                                        #heading-YUj2gdruJy .sh-heading-additional-text {
                                                        }

                                                    </style>

                                                    <div class="sh-heading  " id="heading-UI3Ovro0lZ">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                /monthly </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-UI3Ovro0lZ .sh-element-margin {
                                                        }

                                                        #heading-UI3Ovro0lZ .sh-heading-content {
                                                            font-size: 22px;
                                                            line-height: 50% !important;
                                                            font-weight: 400 !important;
                                                            color: #acacac;
                                                        }

                                                        #heading-UI3Ovro0lZ .sh-heading-content,
                                                        #heading-UI3Ovro0lZ .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-yAFnTjZ2Dr  "
                                                        style="height: 56px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div id="button-Ar1TqxfpJW"
                                                         class="sh-button-container  sh-button-style-2">
                                                        <div class="sh-element-margin">
                                                            <a href="https://app.zmenu.test/register" target="_self"
                                                               class="sh-button sh-button-medium ">
																	<span class="sh-button-text">
																		Get started </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #button-Ar1TqxfpJW .sh-button-text {
                                                            font-weight: 600;
                                                        }

                                                        #button-Ar1TqxfpJW .sh-button {
                                                            line-height: 62px;
                                                            padding-top: 0;
                                                            padding-bottom: 0;
                                                            padding-left: 45px;
                                                            padding-right: 45px;
                                                            font-size: 20px;
                                                            border-radius: 25px;
                                                            background-color: #111111;
                                                            color: #ffffff;
                                                            border: 2px solid transparent;
                                                            display: block !important;
                                                            width: 100%;
                                                        }

                                                        #button-Ar1TqxfpJW {
                                                            text-align: center;
                                                        }

                                                        #button-Ar1TqxfpJW:not(.sh-button-style-2) .sh-button:hover {
                                                            background-color: #ffffff;
                                                            color: #000000;
                                                            border: 2px solid #000000;
                                                        }

                                                        #button-Ar1TqxfpJW.sh-button-style-2 .sh-button:after {
                                                            background-color: #ffffff;
                                                        }

                                                        #button-Ar1TqxfpJW.sh-button-style-2 .sh-button:hover {
                                                            color: #000000;
                                                            border: 2px solid #000000;
                                                        }

                                                        @media (max-width: 800px) {
                                                            #button-Ar1TqxfpJW {
                                                                text-align: center;
                                                            }
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-LqIJQtaj75  "
                                                        style="height: 30px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-8GlWcxVFNB">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Unlimited menu items </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-8GlWcxVFNB .sh-element-margin {
                                                        }

                                                        #heading-8GlWcxVFNB .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-8GlWcxVFNB .sh-heading-content,
                                                        #heading-8GlWcxVFNB .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-OCXwtqo2VS  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-zOQvSV6B49">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Customer Registration </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-zOQvSV6B49 .sh-element-margin {
                                                        }

                                                        #heading-zOQvSV6B49 .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-zOQvSV6B49 .sh-heading-content,
                                                        #heading-zOQvSV6B49 .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-0weWTHASkO  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-aeIpTRs4Ei">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Analytics </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-aeIpTRs4Ei .sh-element-margin {
                                                        }

                                                        #heading-aeIpTRs4Ei .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-aeIpTRs4Ei .sh-heading-content,
                                                        #heading-aeIpTRs4Ei .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-jqdO2ZVG7X  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-y1uxZ4MWHQ">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Custom design </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-y1uxZ4MWHQ .sh-element-margin {
                                                        }

                                                        #heading-y1uxZ4MWHQ .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-y1uxZ4MWHQ .sh-heading-content,
                                                        #heading-y1uxZ4MWHQ .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-uaF9EkyPvp  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-AY2kGlyJ08">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Facebook integration </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-AY2kGlyJ08 .sh-element-margin {
                                                        }

                                                        #heading-AY2kGlyJ08 .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-AY2kGlyJ08 .sh-heading-content,
                                                        #heading-AY2kGlyJ08 .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-UnF9JZNfmK  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-UE8cS9kJ7H">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Customers Feedback </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-UE8cS9kJ7H .sh-element-margin {
                                                        }

                                                        #heading-UE8cS9kJ7H .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-UE8cS9kJ7H .sh-heading-content,
                                                        #heading-UE8cS9kJ7H .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-WhHZ3BcNiT  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-jJO0CkesEU">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                SMS Messages </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-jJO0CkesEU .sh-element-margin {
                                                        }

                                                        #heading-jJO0CkesEU .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-jJO0CkesEU .sh-heading-content,
                                                        #heading-jJO0CkesEU .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-mYU3XDSdq1  "
                                                        style="height: 15px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>


                                                    <div class="sh-heading  " id="heading-AYqSMphkJV">
                                                        <div class="sh-element-margin">


                                                            <h2 class="sh-heading-content size-custom text-center">
                                                                Ads Popup </h2>


                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        #heading-AYqSMphkJV .sh-element-margin {
                                                        }

                                                        #heading-AYqSMphkJV .sh-heading-content {
                                                            font-size: 20px;
                                                            font-weight: 400 !important;
                                                        }

                                                        #heading-AYqSMphkJV .sh-heading-content,
                                                        #heading-AYqSMphkJV .sh-heading-additional-text {
                                                        }

                                                    </style>


                                                    <div
                                                        class="sh-empty-space vc_empty_space sh-empty-space-wrJbyYt9aR  "
                                                        style="height: 70px">
                                                        <span class="vc_empty_space_inner"></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <style type="text/css">
                                            @media (max-width: 800px) {
                                                .vc_row_689070019 {
                                                    margin-left: auto !important;
                                                    margin-right: auto !important;
                                                }
                                            }

                                        </style>
                                    </div>
                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_2026341464 > .vc_column-inner {
                                                padding: 30px 30px 30px 30px !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                        <style type="text/css">
                            @media (max-width: 800px) {

                                #content .vc_row_938186133,
                                .sh-footer-template .vc_row_938186133,
                                .sh-header-template .vc_row_938186133 {
                                    padding: 30px 0px 30px 0px !important;
                                }
                            }

                        </style>
                    </div>
                    <div class="vc_row-full-width vc_clearfix"></div>
                    <div id="contact" data-vc-full-width="true" data-vc-full-width-init="false" data-jarallax
                         data-speed="0.2"
                         class="vc_row wpb_row vc_row-fluid vc_custom_1607090339471 vc_row-has-fill vc_row_1853563176 jarallax">
                        <div class="wpb_column vc_column_container vc_col-sm-12 vc_column_1061817475">
                            <div class="vc_column-inner vc_custom_1607090095711">
                                <div class="wpb_wrapper">
                                    <div class="sh-heading  " id="heading-KF5CRoG20D">
                                        <div class="sh-element-margin">


                                            <h2 class="sh-heading-content size-custom text-center">
                                                Reach us </h2>


                                        </div>
                                    </div>
                                    <style type="text/css">
                                        #heading-KF5CRoG20D .sh-element-margin {
                                            margin: 0px 0px 8px 0px;
                                        }

                                        #heading-KF5CRoG20D .sh-heading-content {
                                            font-size: 36px;
                                            font-weight: 400 !important;
                                            color: #ffffff;
                                        }

                                        #heading-KF5CRoG20D .sh-heading-content,
                                        #heading-KF5CRoG20D .sh-heading-additional-text {
                                        }

                                    </style>


                                    <div class="sh-heading sh-heading-style1" id="heading-sFGlI2Zzao">
                                        <h2 class="sh-heading-content size-custom">
                                            </span>
                                            <span style="text-align: center;">Do not hesitate to ask us any
													questions</span>
                                            <span></h2>
                                    </div>

                                    <style type="text/css">
                                        #heading-sFGlI2Zzao {
                                            margin: 0px 0px 0px 0px;
                                        }

                                        @media (max-width: 1024px) {
                                            #heading-sFGlI2Zzao .sh-heading-content {
                                                font-size: 40px !important;
                                            }
                                        }

                                        #heading-sFGlI2Zzao .sh-heading-content {
                                            font-size: 60px;
                                            line-height: 120% !important;
                                            color: #ffffff;
                                        }

                                    </style>


                                    <div class="sh-empty-space vc_empty_space sh-empty-space-1kNgp5VqFZ  "
                                         style="height: 60px">
                                        <span class="vc_empty_space_inner"></span>
                                    </div>

                                    <div class="vc_row wpb_row vc_inner vc_row-fluid vc_row_631012712">
                                        <div
                                            class="wpb_column vc_column_container vc_col-sm-4 wpb_animate_when_almost_visible wpb_pulse pulse">
                                            <div class="vc_column-inner vc_custom_1594216696109">
                                                <div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element ">
                                                        <div class="wpb_wrapper">
                                                            <p style="text-align: center; color: #fff;">Lebanon,
                                                                Beirut</p>
                                                            <p style="text-align: center; color: #fff;">+96171188875
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="wpb_column vc_column_container vc_col-sm-4 vc_column_1731935068">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element ">
                                                        <div class="wpb_wrapper">
                                                            <p style="text-align: center; color: #fff;">UAE, Dubai
                                                            </p>
                                                            <p style="text-align: center; color: #fff;">
                                                                +971552234133</p>

                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        .vc_column_1731935068:not(.vc_parallax):not(.jarallax) {
                                                            overflow: center !important;
                                                            position: relative;
                                                        }

                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style type="text/css">
                                        @media (max-width: 800px) {
                                            .vc_column_1061817475 > .vc_column-inner {
                                                padding: 60px 30px 60px 30px !important;
                                            }
                                        }

                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vc_row-full-width vc_clearfix"></div>

                    <div class="sh-clear"></div>


                </div>


            </div>
        </div>


        <footer class="sh-footer-template" role="contentinfo" itemscope="itemscope"
                itemtype="http://schema.org/WPFooter">
            <div class="container">
                <style type="text/css" data-type="vc_shortcodes-custom-css">
                    .vc_custom_1594121410617 {
                        padding-top: 70px !important;
                        padding-bottom: 120px !important;
                    }

                </style>
                <div data-vc-full-width="true" data-vc-full-width-init="false"
                     class="vc_row wpb_row vc_row-fluid vc_custom_1594121410617 vc_row_1191694880">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper" style="text-align: center;">

                                <div class="sh-empty-space vc_empty_space sh-empty-space-2wH6vWbnMm  "
                                     style="height: 30px">
                                    <span class="vc_empty_space_inner"></span>
                                </div>


                                <div id="single-image-kSuDx9RUEs" class="sh-single-image  ">
                                    <div class="sh-element-margin">


                                        <div class="sh-single-image-container">
                                            <a href="https://www.dmenuonline.com/wp-content/uploads/2019/11/logo22-e1607087047838.png"
                                               rel="lightbox">

                                                <img class="sh-image-url"
                                                     src="https://www.dmenuonline.com/wp-content/uploads/2019/11/logo22-e1607087047838.png"
                                                     alt="logo22"/>

                                            </a>

                                        </div>


                                    </div>
                                </div>
                                <style type="text/css">
                                    #single-image-kSuDx9RUEs {
                                        text-align: center;
                                    }

                                </style>


                                <div class="sh-empty-space vc_empty_space sh-empty-space-E0pTlnQRxB  "
                                     style="height: 20px">
                                    <span class="vc_empty_space_inner"></span>
                                </div>


                                <div class="sh-heading  " id="heading-GyfOeX0dtj">
                                    <div class="sh-element-margin">


                                        <h2 class="sh-heading-content size-custom text-center">
                                            24/7 Support </h2>


                                    </div>
                                </div>
                                <style type="text/css">
                                    #heading-GyfOeX0dtj .sh-element-margin {
                                    }

                                    #heading-GyfOeX0dtj .sh-heading-content {
                                        font-size: 18px;
                                        font-weight: 500 !important;
                                        color: #111111;
                                    }

                                    #heading-GyfOeX0dtj .sh-heading-content,
                                    #heading-GyfOeX0dtj .sh-heading-additional-text {
                                    }

                                </style>


                                <div class="sh-empty-space vc_empty_space sh-empty-space-JT0mnjwL6H  "
                                     style="height: 20px">
                                    <span class="vc_empty_space_inner"></span>
                                </div>


                                <div class="sh-heading  " id="heading-kWuvl6pf2U">
                                    <div class="sh-element-margin">


                                        <h2 class="sh-heading-content size-custom text-center">
                                            info@dmenuonline.com </h2>


                                    </div>
                                </div>
                                <style type="text/css">
                                    #heading-kWuvl6pf2U .sh-element-margin {
                                    }

                                    #heading-kWuvl6pf2U .sh-heading-content {
                                        font-size: 18px;
                                        font-weight: 500 !important;
                                        color: #111111;
                                    }

                                    #heading-kWuvl6pf2U .sh-heading-content,
                                    #heading-kWuvl6pf2U .sh-heading-additional-text {
                                    }

                                </style>

                                <div id="single-image-spLKJQlwt5" class="sh-single-image  ">
                                    <div class="sh-element-margin">


                                        <div class="sh-single-image-container">

                                        </div>


                                    </div>
                                </div>
                                <style type="text/css">
                                    #single-image-spLKJQlwt5 {
                                        text-align: left;
                                    }

                                </style>

                                <div id="text-block-kx4v8WN3oF" class="sh-text-block">
                                    © 2020 DMENU All Rights Reserved.
                                </div>
                                <style type="text/css">
                                    #text-block-kx4v8WN3oF {
                                        font-size: 16px;
                                        color: #111111;
                                        margin: 0px 0px 15px 0px;
                                    }

                                    #text-block-kx4v8WN3oF a:hover,
                                    #text-block-kx4v8WN3oF a:focus {
                                        color: #6b6b6b;
                                    }

                                    #text-block-kx4v8WN3oF p,
                                    #text-block-kx4v8WN3oF {
                                        line-height: 200%;
                                    }

                                    #text-block-kx4v8WN3oF .drop-cap {
                                        font-weight: bold;
                                        font-size: 50px;
                                        display: block;
                                        float: left;
                                        margin: 8px 10px 0 0;
                                    }

                                </style>

                                <div id="icon-group-Dn3H91ysjp"
                                     class="sh-icon-group sh-icon-group-center sh-icon-group-style4">

                                    <div class="sh-icon-group-item">
                                        <div class="sh-icon-group-item-container">
                                            <a href="https://www.facebook.com/dmenuonline" target="_blank">

                                                <i class="icon-social-facebook"></i>

                                            </a>
                                        </div>
                                    </div>


                                    <div class="sh-icon-group-item">
                                        <div class="sh-icon-group-item-container">
                                            <a href="https://www.instagram.com/dmenuonline" target="_blank">

                                                <i class="icon-social-instagram"></i>

                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <style type="text/css">
                                    @media (max-width: 800px) {
                                        #icon-group-Dn3H91ysjp {
                                            text-align: center;
                                        }
                                    }

                                    #icon-group-Dn3H91ysjp .sh-icon-group-item,
                                    #icon-group-Dn3H91ysjp.sh-icon-group-style1 .sh-icon-group-item-container {
                                        width: 30px;
                                        height: 30px;
                                    }

                                    #icon-group-Dn3H91ysjp.sh-icon-group-style1 .sh-icon-group-item-container {
                                        position: relative;
                                        top: 0;
                                        right: 0;
                                        transform: none;
                                        animation: none !important;
                                    }

                                    #icon-group-Dn3H91ysjp .sh-icon-group-item i {
                                        line-height: 30px;
                                    }

                                    #icon-group-Dn3H91ysjp .sh-icon-group-item i {
                                        font-size: 14px;
                                    }

                                    #icon-group-Dn3H91ysjp .sh-icon-group-item i {
                                        color: #111111;
                                    }

                                    #icon-group-Dn3H91ysjp .sh-icon-group-item-container:hover i {
                                        color: rgba(68, 68, 68, 0.69);
                                    }

                                </style>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vc_row-full-width vc_clearfix"></div>
            </div>
        </footer>

    </div>


    <div class="sh-back-to-top sh-back-to-top1">
        <i class="icon-arrow-up"></i>
    </div>

</div>

<script type="text/html" id="wpb-modifications"></script>
<link rel='stylesheet' id='vc_animate-css-css'
      href='{{asset('home/content/plugins/js_composer/assets/lib/bower/animate-css/animate.min.css?ver=6.4.2')}}'
      type='text/css' media='all'/>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wpcf7 = {
        "apiSettings": {
            "root": "https:\/\/www.dmenuonline.com\/index.php\/wp-json\/contact-form-7\/v1",
            "namespace": "contact-form-7\/v1"
        },
        "cached": "1"
    };
    /* ]]> */

</script>
<script type='text/javascript'
        src='{{asset('home/content/plugins/contact-form-7/includes/js/scripts.js?ver=5.3')}}'></script>
<script type='text/javascript' src='{{asset('home/includes/js/jquery/ui/effect.min.js?ver=1.11.4')}}'>
</script>
<script type='text/javascript' src='{{asset('home/content/themes/jevelin/js/plugins/bootstrap.min.js?ver=3.3.4')}}'>
</script>
<script type='text/javascript'
        src='{{asset('home/content/themes/jevelin/js/plugins/jquery.instagramFeed.min.js?ver=1.0')}}'>
</script>
<script type='text/javascript' src='{{asset('home/includes/js/wp-embed.js?ver=5.4.12')}}'></script>
<script type='text/javascript'
        src='{{asset('home/content/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=6.4.2')}}'>
</script>
<script type='text/javascript'
        src='{{asset('home/content/plugins/js_composer/assets/lib/vc_waypoints/vc-waypoints.min.js?ver=6.4.2')}}'>
</script>
<script type='text/javascript'
        src='{{asset('home/content/plugins/js_composer/assets/lib/bower/skrollr/dist/skrollr.min.js?ver=6.4.2')}}'>
</script>
<script type='text/javascript' src='{{asset('home/includes/js/comment-reply.js?ver=5.4.12')}}'>
</script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        "use strict";
    });

</script>

</body>

</html>
