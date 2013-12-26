$(document).ready(function(){
  var title_on_top = 'Research Visualization'
  var title_down = '<span class="icon-arrow-up"></span> Research Visualization'
  /* FIXED HEADER
  /////////////////////////////////////////////////////////////////*/
  $(window).scroll(function (event) {
    var y = $(this).scrollTop();
    if (y > 50) {
      $('.header__title__link').attr('href', '#header');
      $('.header__title__link').html(title_down);
      $('.header, .navigation').addClass('overlayed');
    } else {
      $('.header__title__link').attr('href', '/');
      $('.header__title__link').html(title_on_top);
      $('.header, .navigation').removeClass('overlayed');
    }
  });
  $('.header__title__link[href*="header"]').live('click', function(){
    $('html, body').animate({scrollTop:0},{duration:500, queue:true, complete:function(){
      $('.header__title__link').attr('href', '/');
      }
    });
    return false;
  });
  $('.navigation__link').qtip({
    show: {
      delay: 300,
      effect: "fade"
    },
    hide: {
      effect: "fade"
    },
    style: {
      classes: 'ui-tooltip-datavis'
    },
    position: {
      my: 'top center',
      at: 'bottom center',
      adjust: {
        y: 4
      }
    },
  });
});