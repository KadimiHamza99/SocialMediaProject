$(function () {
   
    'use strict';

    $('.signin-section').on('click', function () {
        $(this).addClass('section-open');
        $('.signin-section').removeClass('section-close');
        $('.signup-section').addClass('section-close');
        $('.signup-section').removeClass('section-open');
    });

    $('.signup-section').on('click', function () {
        $(this).addClass('section-open');
        $('.signup-section').removeClass('section-close');
        $('.signin-section').addClass('section-close');
        $('.signin-section').removeClass('section-open');
        $('.signin-form').slideDown();
    });
});