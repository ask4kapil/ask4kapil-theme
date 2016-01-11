/**
 * Created by erkap on 09-Jan-16.
 */
$(document).ready (function(){
    'use strict';

    scrollTo(0,0);
    //To make Carousel Quotes using library Quovolver
    $('.quotes').quovolver({
        equalHeight   : true
    });

    //To make the banner images carousel using library of bootstrap
    $('#myCarousel').carousel({
        interval: 10000,
        cycle: true
    });

    setTimeout(function() {
        $("#typed").typed({
            strings: ["a UI Expert.", "a front end developer.", "the Kapil Kumawat"],
            typeSpeed: 30,
            callback: function(){
                lift();
            }
        });
    }, 4000);

    function lift(){
        $(".head-text").addClass("lift-text");
    }

    if (screen.width > 966) {
        window.scrollReveal = new scrollReveal();
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
    $( window ).resize(function() {
        screenHeight = $(window).height();
        setHeightCarousel();
    });
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
        var scrollPosition = $(document).scrollTop(),
            header = $('.navbar'),
            topHeader = $('.top-header');
        if(scrollPosition > screenHeight) {
            header.addClass('navbar-fixed-top');
            header.addClass('navbar-shrink');
            topHeader.addClass('top-fixed');
        }
        else {
            header.removeClass('navbar-fixed-top');
            header.removeClass('navbar-shrink' );
            topHeader.removeClass('top-fixed');
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

    /**
     * Design skills
     */
    var designSkills = [
        {
            value: 80,
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "Adobe Photoshop"
        },
        {
            value: 50,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Adobe Illustrator"
        },
        {
            value: 60,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "HTML and CSS"
        },
        {
            value: 90,
            color: "#949FB1",
            highlight: "#A8B3C5",
            label: "WordPress"
        },
        {
            value: 90,
            color: "#4D5360",
            highlight: "#616774",
            label: "PHP"
        },
    ];


    var designID = jQuery('#designing-skills');

    if ( designID.length){
        jQuery(function() {
            var doughnut_ctx = document.getElementById("designing-skills").getContext("2d");
            window.designSkill = new Chart(doughnut_ctx).Doughnut(designSkills, {
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            });

            var legend = designSkill.generateLegend();
            jQuery(".designing-legend").html(legend);
        });
    }

});
