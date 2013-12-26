$(document).ready(function(){
	/* ISOTOPE SETUP
	/////////////////////////////////////////////////////////////////*/
	var $container = $('.content__container');
	$container.isotope({
	  itemSelector: '.card',
    layoutMode: 'cellsByRow',
    getSortData : {
      name : function ( $elem ) {
        var name = $elem.find('.card__title').text();
        return name;
      }
    },
    sortBy : 'name',
    cellsByRow : {
      columnWidth : 245
    }
	});
	
  /* ISOTOPE FILTER
	/////////////////////////////////////////////////////////////////*/
  var filters = {};

  // filter buttons
  $('.navigation__link').click(function(){
    var $this = $(this);
    if ( $this.hasClass('selected') ) {
      return;
    }
    var $optionSet = $this.parents('.option-set');
    $optionSet.find('.selected').removeClass('selected');
    $this.addClass('selected');

    var group = $optionSet.attr('data-filter-group');
    filters[ group ] = $this.attr('data-filter');
    var isoFilters = [];
    for ( var prop in filters ) {
      isoFilters.push( filters[ prop ] )
    }
    var selector = isoFilters.join('');
    $container.isotope({ filter: selector });
    console.log(selector);

    return false;
  });
  
  /* QUICKSEARCH
  /////////////////////////////////////////////////////////////////*/
  $('.search__field').quicksearch('.card');
  
  $('.search__field').quicksearch('.card', {
      'show': function() {
          $(this).addClass('quicksearch-match');
      },
      'hide': function() {
          $(this).removeClass('quicksearch-match');
      },
      onAfter: function() {
        $container.isotope({ filter: '.quicksearch-match'});
      }
  });
  
  /* CARD FLIP
  /////////////////////////////////////////////////////////////////*/
  $('.card .card__front').append('<span class="card__flip__back"></span>');
  $('.card .card__back').append('<span class="card__flip__front"></span>');
  
  $('.card').click(function(e){
    if($(this).hasClass('flip')){
      if(e.target.tagName == "A"){
        window.open(e.target.href);
        e.preventDefault();
      }else{
        $(this).removeClass('flip');
      }
    }else{
      if(e.target.tagName == "A"){
        window.open(e.target.href);
        e.preventDefault();
      }else{
        $(this).addClass('flip');
      }
    }
  });
  
  /* FIT TEXT
  /////////////////////////////////////////////////////////////////*/
  $(this).find(".card .card__front a").fitText(205);
  
});
