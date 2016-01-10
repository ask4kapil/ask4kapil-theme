/**
 * Created by erkap on 09-Jan-16.
 */
$(document).ready (function(){
    'use strict';
    //To make Carousel Quotes using library Quovolver
    $('.quotes').quovolver({
        equalHeight   : true
    });

    //To make the banner images carousel using library of bootstrap
    $('#myCarousel').carousel({
        interval: 10000,
        cycle: true
    });

    $('#myCarousel').bind('slide.bs.carousel', function (e) {

    });
    setTimeout(function() {
        $("#typed").typed({
            strings: ["a UI Expert.", "a front end developer.", "Kapil Kumawat"],
            typeSpeed: 30,
            callback: function(){
                lift();
            }
        });
    }, 4000)
    function lift(){
        $(".head-text").addClass("lift-text");
    }

    // Make the images mixitUP library
    $('#lessonsimg').mixItUp();

    var screenHeight = $(window).height();
    function setHeightCarousel() {
        $('.carousel .item').height(screenHeight);
        $('.carousel .mask-image').height(screenHeight);
        $('.carousel').height(screenHeight);
    }
    setHeightCarousel();

    //Make the navbar highlighted based on scroll and which section we are
    $(document).on("scroll", onScroll);
    $('a[href^="#"].page-scroll').on('click', function (e) {
        e.preventDefault();
        $(".navbar-collapse").collapse('hide');
        $(document).off("scroll");
        $('a').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        var target = this.hash;
        target = target.replace("/","");
        var $target = $(target);
        if($target.length > 0)
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 500, 'swing', function () {
                window.location.hash = target;
                $(document).on("scroll", onScroll);
            });
    });
    function onScroll(event){
        var scrollPosition = $(document).scrollTop();
        if(scrollPosition > screenHeight) {
            $('.navbar').addClass('navbar-fixed-top');
        }
        else {
            $('.navbar').removeClass('navbar-fixed-top');
        }
        $(".navbar-collapse").collapse('hide');
        $('.nav li a').each(function () {
            var currentLink = $(this);
/*            var refElement = $(currentLink.attr("href").replace("/",""));
            if(refElement.length > 0)
                if (refElement.position().top <= scrollPosition && refElement.position().top + refElement.height() > scrollPosition) {
                    $('.nav li a').removeClass("active");
                    currentLink.addClass("active");
                }
                else{
                    currentLink.removeClass("active");
                }*/
        });
    }
    setTimeout(onScroll,100);
    /**
     * cbpAnimatedHeader.js v1.0.0
     * http://www.codrops.com
     *
     * Licensed under the MIT license.
     * http://www.opensource.org/licenses/mit-license.php
     *
     * Copyright 2013, Codrops
     * http://www.codrops.com
     */
    var docElem = document.documentElement,
        header = document.querySelector( '.navbar-fixed-top' ),
        didScroll = false,
        changeHeaderOn = 300;

    function init() {
        window.addEventListener( 'scroll', function( event ) {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( scrollPage, 250 );
            }
        }, false );
    }

    function scrollPage() {
        var sy = scrollY();
        if ( sy >= changeHeaderOn ) {
            classie.add( header, 'navbar-shrink' );
        }
        else {
            classie.remove( header, 'navbar-shrink' );
        }
        didScroll = false;
    }

    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }

    function openPage(page, tab) {
        $state.go(page);
        setTimeout(onScroll, 1000);
        if(tab && $state.$current.name !== page) {
            var tabStr = 'a[href=\'' + tab + '\']';
            setTimeout(function() {
                $(tabStr).click();
            },1000);
        }
    }
    init();
});
