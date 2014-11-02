/* global google, HairpressJS */

//  ==========
//  = Custom JS and jQuery =
//  ==========

jQuery(document).ready(function($) {
    'use strict';

    var myWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;

    //  ==========
    //  = Smooth scroll to the top of the page =
    //  ==========
    $('#to-the-top').click(function(e) {
        e.preventDefault();
        $('html, body').animate({ 'scrollTop' : 0 }, 2000);
    });


    //  ==========
    //  = Carousel =
    //  ==========

    $(window).load(function() {
        $('.carousel').each(function() {
            var $this = $(this);
            $this.carouFredSel({
                auto : {
                    play : false
                },
                prev : {
                    button : $this.parent().find('.nav-left')
                },
                next : {
                    button : $this.parent().find('.nav-right')
                },
                width : '100%',
                responsive : true
            });
        });
    });

    //  ==========
    //  = Revolution Slider =
    //  ==========
    if ( myWidth > 767 ) {
        if (jQuery().revolution) {
            var $mainSlider = $('.fullwidthbanner-container-custom > .fullwidthabanner').revolution({
                delay: HairpressJS.theme_slider_delay,
                startheight:530,
                startwidth:1500,

                navigationType:'none',
                navigationArrows:'none',
                touchenabled:'on',
                onHoverStop:'off',

                navOffsetHorizontal:0,
                navOffsetVertical:20,

                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                hideSliderAtLimit:0,

                stopAtSlide:-1,
                stopAfterLoops:-1,

                shadow:0,
                fullWidth:'on'
            });

            $('#slider-nav-left').click(function(ev) {
                ev.preventDefault();
                $mainSlider.revprev();
            });
            $('#slider-nav-right').click(function(ev) {
                ev.preventDefault();
                $mainSlider.revnext();
            });

            $mainSlider.bind('revolution.slide.onchange', function(e, data) {
                var slideIndex = data.slideIndex;
                var customCaption = $('.fullwidthabanner ul li:nth-child(' + slideIndex + ') .custom-cap').text();
                $('#custom-caption-container').html(customCaption);

            });
        }
    } else {
        $('.fullwidthbanner-container-custom').css({
            'backgroundImage' : 'url(' + $('.fullwidthbanner-container-custom').find('li:first-child img').attr('src') + ')'
        });
        $('.fullwidthbanner-container-custom .fullwidthabanner').hide();
    }


    //  ==========
    //  = Collapse / accordion =
    //  ==========

    $('.accordion-heading a').click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('open').parent().find('.accordion-body').slideToggle();
    });


    //  ==========
    //  = jQuery UI datepicker =
    //  ==========
    /**
     * For time format see: http://trentrichardson.com/examples/timepicker/
     */
    $('.add-datepicker').datetimepicker({
        stepMinute: 5,
        hourMin: 6,
        hourMax: 21,
        dateFormat: HairpressJS.datetimepicker_date_format,
        //timeFormat: '',
    });

    $('.add-datepicker-icon').click(function(ev) {
        ev.preventDefault();
        $('.add-datepicker').focus();
    });

    //  ==========
    //  = Custom Google Maps =
    //  ==========
    (function () {
        if ( $('#gmaps-wide-container').length > 0 ) {
            var createLatLng = function (argument) {
                var latLng = argument.split(',');

                for ( var i = 0; i < 2; i++ ) {
                    latLng[i] = parseFloat( latLng[i] );
                }

                return new google.maps.LatLng( latLng[0],latLng[1] );
            };

            var gmapsCenter = createLatLng( HairpressJS.latLng );

            var mapOptions = {
                zoom:        parseInt( HairpressJS.zoomLevel, 10 ),
                scrollwheel: false,
                center:      gmapsCenter,
                mapTypeId:   eval( 'google.maps.MapTypeId.' + HairpressJS.mapType ),
            };

            var map = new google.maps.Map(document.getElementById('gmaps-wide-container'), mapOptions);

            // console.log(HairpressJS.gmapsLocations);
            var Infowindow = function(contentString) {
                this.marker = null;
                this.cont = new google.maps.InfoWindow({
                    content: contentString
                });
                return this;
            };

            Infowindow.prototype.setMarker = function( marker ) {
                this.marker = marker;

                google.maps.event.addListener(this.marker, 'click', $.proxy(function() {
                    this.cont.open(map,this.marker);
                }, this ) );

                return this;
            };

            var image = '';
            for (var i = 0; i < HairpressJS.gmapsLocations.length; i++) {
                image = '';
                if( HairpressJS.gmapsLocations[i].image.length > 0 ) {
                    image = '<img class="gmaps-window__img" src="' + HairpressJS.gmapsLocations[i].image + '" />';
                }
                var contentString = '<div class="gmaps-window">'+
                    '<h3 class="gmaps-window__title">' + HairpressJS.gmapsLocations[i].title + '</h3>'+
                    '<div class="gmaps-window__body">'+
                    image +
                    HairpressJS.gmapsLocations[i].description +
                    '</div>';

                new Infowindow(contentString).setMarker(new google.maps.Marker({
                    position: createLatLng( HairpressJS.gmapsLocations[i].link ),
                    map: map,
                    title: HairpressJS.gmapsLocations[i].title
                }));
            }

        }
    })();

});
