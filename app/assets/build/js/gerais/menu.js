/* =================== HEADER FULL =================== */
jQuery(document).ready(function($){
  const header = $('.header-full');
  if (header.length > 0) {
    function toggleHeaderFull() {
      var scrollTop = $(window).scrollTop();
      if (scrollTop > 100) {
        header.addClass('active');
      } else {
        header.removeClass('active');
      }
    }
    toggleHeaderFull();
    $(window).on('scroll', debounce(function(){
      toggleHeaderFull();        
    }, 10));
  }
});
