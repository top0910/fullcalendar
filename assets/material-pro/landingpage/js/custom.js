/*
Template Name: Monster Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
$(function () {
    "use strict";
    $(function () {
        $(".preloader").fadeOut();
    });
    
    $('#owl-demo2').owlCarousel({
            margin:50,
            nav:false,
            autoplay:true,
            loop: true,
            slideSpeed : 10,
            rewindNav : true,
            scrollPerPage : false,
            responsive:{
                0:{
                    items:1
                },
                480:{
                    items:1
                },
                700:{
                    items:1
                },
                1000:{
                    items:1
                },
                1100:{
                    items:1
                }
            }
        })
        $('a').on('click',function(event){
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 90 }, 1000);
        event.preventDefault();
    });  
    
        
});