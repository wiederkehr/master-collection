/* Image path options
	http://marijerooze.nl/thesis/graphics/images/guardian/guardian_australiaElections2013.jpg
	http://marijerooze.nl/thesis/graphics/images/nytimes/nytimes_economytwistandturns.jpg
*/

Handlebars.registerHelper("getImgPath", function( data ) {
	var img = data.thumbnail,
		newspaper = data.newspaper === "Guardian" ? "guardian" : "nytimes";

	var imgPath	= "/public/media/"+ img;
  	return imgPath;
});

// sets correct class on title which has the favicon in css 
Handlebars.registerHelper("setFavicon", function( data ) {
	var faviconClass = data === "Guardian" ? 'gua' : 'nyt'
	faviconClass+= " favicon";
	return faviconClass;
})

Handlebars.registerHelper("setRightFacet", function(param1, param2) {
	var sel;

	if (param1.independent) { // if param1 is independent, every individual item contains a facet
		sel = param2.facet; 
	} else {
		sel = param1.facet;
	}

	return sel.toLowerCase();
})


Handlebars.registerHelper("setSelected", function(param1, param2) {
	sel = param1.selection === param2 ? "selected" : "";

	return sel;
})


// set filters by default collapsed or expanded
Handlebars.registerHelper("isExpanded", function(param) {
	var expanded = param ? "expanded" : "collapsed";

	return expanded;
})




