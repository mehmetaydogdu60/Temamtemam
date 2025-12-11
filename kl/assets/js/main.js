/**
 * Main Theme Scripts
 */
(function($) {
    'use strict';

    $(document).ready(function() {

        // Smooth scroll for anchor links
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && 
                location.hostname === this.hostname) {
                
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800);
                    return false;
                }
            }
        });

        // Add class to header on scroll
        $(window).on('scroll', function() {
            const header = $('.site-header');
            
            if ($(this).scrollTop() > 100) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        });

        // Back to top button
        const backToTop = $('<button class="back-to-top" aria-label="Back to top">↑</button>');
        $('body').append(backToTop);

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                backToTop.addClass('visible');
            } else {
                backToTop.removeClass('visible');
            }
        });

        backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
            return false;
        });

        // Add animation class to elements when they come into view
        function checkScroll() {
            $('.entry-title, .entry-content, .widget').each(function() {
                const elementTop = $(this).offset().top;
                const elementBottom = elementTop + $(this).outerHeight();
                const viewportTop = $(window).scrollTop();
                const viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('animate-in');
                }
            });
        }

        $(window).on('scroll resize', checkScroll);
        checkScroll();

        // Make tables responsive
        $('.entry-content table').wrap('<div class="table-responsive"></div>');

        // Add target="_blank" to external links
        $('a').filter(function() {
            return this.hostname && this.hostname !== location.hostname;
        }).attr('target', '_blank').attr('rel', 'noopener noreferrer');

        // Widget search form enhancement
        $('.widget_search input[type="search"]').attr('placeholder', 'Ara...');

        // Add icons to widget lists
        $('.widget ul li').each(function() {
            if (!$(this).find('ul').length) {
                $(this).prepend('<span class="widget-list-icon">→</span>');
            }
        });

        // Responsive videos
        $('.entry-content').fitVids();

        // Image lazy loading fallback
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.dataset.src || img.src;
            });
        }

        // Comment form enhancements
        $('.comment-form input, .comment-form textarea').on('focus', function() {
            $(this).parent().addClass('focused');
        }).on('blur', function() {
            if (!$(this).val()) {
                $(this).parent().removeClass('focused');
            }
        });

        // Sticky sidebar
        if ($(window).width() > 992) {
            const sidebar = $('.widget-area');
            const sidebarTop = sidebar.offset().top - 100;

            $(window).on('scroll', function() {
                const scrollTop = $(this).scrollTop();

                if (scrollTop > sidebarTop) {
                    sidebar.addClass('sticky-sidebar');
                } else {
                    sidebar.removeClass('sticky-sidebar');
                }
            });
        }

        // Archive dropdown for mobile
        $('.widget_archive select, .widget_categories select').on('change', function() {
            if ($(this).val()) {
                window.location = $(this).val();
            }
        });

    });

    // FitVids plugin replacement
    $.fn.fitVids = function() {
        return this.each(function() {
            const $this = $(this);
            $this.find('iframe[src*="youtube"], iframe[src*="vimeo"]').each(function() {
                const $iframe = $(this);
                const aspectRatio = $iframe.height() / $iframe.width();
                
                $iframe.wrap('<div class="video-wrapper"></div>')
                    .parent().css('padding-bottom', (aspectRatio * 100) + '%');
            });
        });
    };

})(jQuery);
