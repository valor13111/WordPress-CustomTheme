$('#left-sidebar-menu a').hover(
  function() {
    $('.sub-menu li').slideDown();
  },
  function() {
    $('.sub-menu li').slideUp();
  }
);
