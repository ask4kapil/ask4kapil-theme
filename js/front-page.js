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
            strings: ["an UI Expert.", "a front end developer.", "the Kapil Kumawat"],
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
        $('#myCarousel.carousel .item').height(screenHeight);
        $('#myCarousel.carousel .mask-image').height(screenHeight);
        $('#myCarousel.carousel').height(screenHeight);
    }
    setHeightCarousel();
    $( window ).resize(function() {
        screenHeight = $(window).height();
        setHeightCarousel();
    });
    //Make the navbar highlighted based on scroll and which section we are
    $(document).on("scroll", onScroll);

    $('.navbar-nav a[href]').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(".navbar-collapse").collapse('hide');
        $(document).off("scroll");
        $('a').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        var target = this.href.substr(this.baseURI.length);
        if(this.baseURI.indexOf('#') > -1 ) {
            target = this.href.substr(this.baseURI.substr(0,this.baseURI.indexOf('#')).length);
        }
        target = '#' + target.replace("/","");
        if(target === "#") {
            target="#home";
        }
        var $target = $(target);
        if($target.length > 0)
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - 100
            }, 500, 'swing', function () {
                window.location.hash = target;
                $(document).on("scroll", onScroll);
            });
    });

    function onScroll(event){
        var scrollPosition = $(document).scrollTop(),
            header = $('.navbar'),
            topHeader = $('.top-header');
       /* $('.nav li a').each(function () {
            var currentLink = $(this);
            var target = this.href.substr(this.baseURI.length);
            if(this.baseURI.indexOf('#') > -1 ) {
                target = this.href.substr(this.baseURI.substr(0,this.baseURI.indexOf('#')).length);
            }
            target = '#' + target.replace("/","");
            if(target === "#") {
                target="#home";
            }
            var refElement = $(target);
            if(refElement.length > 0)
                if (refElement.position().top <= scrollPosition && refElement.position().top + refElement.height() > scrollPosition) {
                    $('.nav li a').removeClass("active");
                    currentLink.addClass("active");
                }
                else{
                    currentLink.removeClass("active");
                }
        });*/
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

    }
    setTimeout(onScroll,100);


    /**
     * Design skills
     */
    var designSkills = [
        {
            value: 70,
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "Angular"
        },
        {
            value: 70,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Ionic"
        },
        {
            value: 80,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Bootstrap"
        },
        {
            value: 50,
            color: "#949FB1",
            highlight: "#A8B3C5",
            label: "SASS/LESS"
        },
        {
            value: 50,
            color: "#4D5360",
            highlight: "#616774",
            label: "PHP"
        }
    ];


    var designID = jQuery('#designing-skills');

    if ( designID.length){
        var canvas = document.createElement('canvas');
        //designID.remove();
        designID.append(canvas);
        canvas.setAttribute('height', '225px');
        canvas.setAttribute('width', '225px');
        canvas.style.height = '225px';
        canvas.style.width = '225px';
        jQuery(function() {
            var doughnut_ctx = canvas.getContext("2d");
            window.designSkill = new Chart(doughnut_ctx).Doughnut(designSkills, {
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            });

            var legend = designSkill.generateLegend();
            jQuery(".designing-legend").html(legend);
        });
    }
    /*-----------------------------------------------------------
     Google Map - with support of gmaps.js
     -----------------------------------------------------------*/

    var gmapID = jQuery('#g-map');
    if(gmapID.length) {
        var map;
        jQuery(document).ready(function () {
            "use strict";
            map = new google.maps.Map(gmapID[0], {
                center: new google.maps.LatLng(17.5316855, 78.3671564),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(17.5316855, 78.3671564),
                map: map,
                title: 'Kapil Kumawat home',
                icon: theme_directory+ "/img/marker.png"
            });
            var infowindow = new google.maps.InfoWindow({
                content: '<p>Kapil Kumawat Home</p>'
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
        });
    }
});
