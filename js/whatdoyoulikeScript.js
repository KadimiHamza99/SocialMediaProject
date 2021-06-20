$(function () {
    'use strict';
    $('.gotohobbies').on('click', function () {
        $('.hobbies-section').addClass('section-open');
        $('.hobbies-section').removeClass('section-close');
        $('.description-section').addClass('section-close');
        $('.description-section').removeClass('section-open');
        $('.hobbies-form').slideDown();
    });
    $('.backtodescription').on('click', function () {
        $('.description-section').addClass('section-open');
        $('.description-section').removeClass('section-close');
        $('.hobbies-section').addClass('section-close');
        $('.hobbies-section').removeClass('section-open');
        $('.description-form').slideDown();
    });
});