/**
 * Customizer Live Preview Scripts
 */
(function($) {
    'use strict';

    // Site title
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });

    // Site description
    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Primary Color
    wp.customize('samsun_primary_color', function(value) {
        value.bind(function(to) {
            $(':root').css('--primary-color', to);
        });
    });

    // Secondary Color
    wp.customize('samsun_secondary_color', function(value) {
        value.bind(function(to) {
            $(':root').css('--secondary-color', to);
        });
    });

    // Accent Color
    wp.customize('samsun_accent_color', function(value) {
        value.bind(function(to) {
            $(':root').css('--accent-color', to);
        });
    });

    // Text Color
    wp.customize('samsun_text_color', function(value) {
        value.bind(function(to) {
            $(':root').css('--text-color', to);
            $('body').css('color', to);
        });
    });

    // Link Color
    wp.customize('samsun_link_color', function(value) {
        value.bind(function(to) {
            $('a').css('color', to);
        });
    });

    // Container Width
    wp.customize('samsun_container_width', function(value) {
        value.bind(function(to) {
            $('.container').css('max-width', to + 'px');
        });
    });

    // Font Size
    wp.customize('samsun_font_size', function(value) {
        value.bind(function(to) {
            $('body').css('font-size', to + 'px');
        });
    });

    // Footer Text
    wp.customize('samsun_footer_text', function(value) {
        value.bind(function(to) {
            $('.site-info').html(to);
        });
    });

})(jQuery);
