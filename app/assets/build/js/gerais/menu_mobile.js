/* =================== MENU MOBILE =================== */
jQuery(document).ready(function ($) {

  // Open menu
  $('#menu-btn-mobile').on('click', function () {
    toggleNav();
  });

  // Open submenu
  $('.has-children').children('a').on('click', function (event) {
    //prevent default clicking on direct children of .has-children 
    event.preventDefault();
    var selected = $(this);
    selected.next('ul').removeClass('is-hidden').end().parent('.has-children').parent('ul').addClass('move-out');
    $('.cd-dropdown-content').scrollTop(0);
  });

  // Voltar
  $('.go-back').on('click', function () {
    var selected = $(this),
    visibleNav = $(this).parent('ul').parent('.has-children').parent('ul');
    selected.parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('move-out');
    $('.cd-dropdown-content').scrollTop(0);
  });

  // Close menu
  $('.cd-dropdown-wrapper').on('click', function (ev) {
    if (ev.target == this) {
      closeNav();
    }
  });

  // Close menu on swipe
  $('body').on('swipeleft', function (ev) {
    closeNav();
  });

  // Toggle menu
  function toggleNav() {
    var navIsVisible = (!$('.cd-dropdown').hasClass('dropdown-is-active')) ? true : false;
    $('.cd-dropdown').toggleClass('dropdown-is-active', navIsVisible);
    $('.cd-dropdown-trigger').toggleClass('dropdown-is-active', navIsVisible);
    $('.cd-dropdown-wrapper').toggleClass('active');
    $('#menu-btn-mobile').addClass('active');
    if (!navIsVisible) {
      $('.cd-dropdown').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
        $('.has-children ul').addClass('is-hidden');
        $('.move-out').removeClass('move-out');
        $('.is-active').removeClass('is-active');
        $('#menu-btn-mobile').removeClass('active');
      });
    }
  }

  // Open menu
  function openNav() {
    var navIsVisible = (!$('.cd-dropdown').hasClass('dropdown-is-active')) ? true : false;
    $('.cd-dropdown').addClass('dropdown-is-active', navIsVisible);
    $('.cd-dropdown-trigger').addClass('dropdown-is-active', navIsVisible);
    $('.cd-dropdown-wrapper').addClass('active');
    $('#menu-btn-mobile').addClass('active');
    if (!navIsVisible) {
      $('.cd-dropdown').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
        $('.has-children ul').addClass('is-hidden');
        $('.move-out').removeClass('move-out');
        $('.is-active').removeClass('is-active');
        $('#menu-btn-mobile').removeClass('active');
      });
    }
  }

  // Close menu
  function closeNav() {
    var navIsVisible = (!$('.cd-dropdown').hasClass('dropdown-is-active')) ? true : false;
    $('.cd-dropdown').removeClass('dropdown-is-active', navIsVisible);
    $('.cd-dropdown-trigger').removeClass('dropdown-is-active', navIsVisible);
    $('.cd-dropdown-wrapper').removeClass('active');
    $('#menu-btn-mobile').removeClass('active');
    if (!navIsVisible) {
      $('.cd-dropdown').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
        $('.has-children ul').addClass('is-hidden');
        $('.move-out').removeClass('move-out');
        $('.is-active').removeClass('is-active');
        $('#menu-btn-mobile').removeClass('active');
      });
    }
  }

});
