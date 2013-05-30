;(function ($, window, undefined) {
    'use strict';
    var $doc = $(document),
        Modernizr = window.Modernizr;

    $(document).ready(function() {
        //$doc.foundation();
        /*
        $.fn.topbar                     ? $doc.topbar() : null;
        $.fn.orbit                      ? $doc.orbit() : null;
        $.fn.foundationAlerts           ? $doc.foundationAlerts() : null;
        $.fn.foundationButtons          ? $doc.foundationButtons() : null;
        $.fn.foundationAccordion        ? $doc.foundationAccordion() : null;
        $.fn.foundationNavigation       ? $doc.foundationNavigation() : null;
        $.fn.foundationTopBar           ? $doc.foundationTopBar() : null;
        $.fn.foundationCustomForms      ? $doc.foundationCustomForms() : null;
        $.fn.foundationMediaQueryViewer ? $doc.foundationMediaQueryViewer() : null;
        $.fn.foundationTabs             ? $doc.foundationTabs({callback : $.foundation.customForms.appendCustomMarkup}) : null;
        $.fn.foundationTooltips         ? $doc.foundationTooltips() : null;
        $.fn.foundationMagellan         ? $doc.foundationMagellan() : null;
        $.fn.foundationClearing         ? $doc.foundationClearing() : null;
        $.fn.placeholder ? $('input, textarea').placeholder() : null;
*/
        SW.init();

        // Hide address bar on mobile devices (except if #hash present, so we don't mess up deep linking).
        if (Modernizr.touch && !window.location.hash) {
            $(window).load(function () {
                setTimeout(function () {
                    window.scrollTo(0, 1);
                }, 0);
            });
        }
    });

    // UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE8 SUPPORT AND ARE USING .block-grids
    // $('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'both'});
    // $('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'both'});
    // $('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'both'});
    // $('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'both'});

    var SW = SW || {
        init : function () {
            this._projectDetails();
            this._orbit();
            this._topbar();
        },
        _topbar: function () {
            $doc.foundation('topbar');
        },
        _orbit : function () {
            $doc.foundation($('#featured'), 'orbit', {
                    timer_speed: 5000,
                    animation_speed: 500,
                    bullets: false,
                    stack_on_small: true,
                    container_class: 'orbit-container',
                    stack_on_small_class: 'orbit-stack-on-small',
                    next_class: 'orbit-next',
                    prev_class: 'orbit-prev',
                    timer_container_class: 'orbit-timer',
                    timer_paused_class: 'paused',
                    timer_progress_class: 'orbit-progress',
                    slides_container_class: 'orbit-slides-container',
                    bullets_container_class: 'orbit-bullets',
                    bullets_active_class: 'active',
                    slide_number_class: 'orbit-slide-number',
                    caption_class: 'orbit-caption',
                    active_slide_class: 'active',
                    orbit_transition_class: 'orbit-transitioning'
            });
        },
        _projectDetails : function () {
            $doc.foundation('section');
        },
        googleMap : function (mapElementId, lon, lat, address) {
            if (GBrowserIsCompatible()) {
                $('body').unload(function () {
                    GUnload();
                });
                var map = new GMap2(document.getElementById("map"));
                var point = new GLatLng(lat, lon);
                map.setCenter(point, 13);
                map.setUIToDefault();
                var marker = new GMarker(point);
                map.addOverlay(marker, address);
                GEvent.addListener(marker, "click", function () {
                    marker.openInfoWindowHtml(address);
                });
                marker.openInfoWindowHtml(address);
            }
        },
        googleMapByAddress : function (mapElementId, name, address) {
            if (GBrowserIsCompatible()) {
                $('body').unload(function () {
                    GUnload();
                });
                var geocoder = new GClientGeocoder();
                geocoder.getLatLng(
                    address,
                    function(point) {
                        var map = new GMap2(document.getElementById("map"));
                        map.setCenter(point, 13);
                        map.setUIToDefault();
                        var marker = new GMarker(point);
                        map.addOverlay(marker, address);
                        GEvent.addListener(marker, "click", function () {
                            marker.openInfoWindowHtml(name + '<br>' + address);
                        });
                        marker.openInfoWindowHtml(name + '<br>' + address);
                    }
                );


            }
        }
    };

})(jQuery, this);


