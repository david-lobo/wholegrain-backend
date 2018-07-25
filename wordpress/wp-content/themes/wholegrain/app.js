jQuery(document).ready(function($) {
	$.get( "wp-json/wp/v2/recipes", function( data ) {
	  var html = '';
	  if (data && data.length > 0) {
		  $(data).each(function(i, v) {
		  	var recipe = '';
		  	var title = '<h3>' + v.title + '</h3>';
		  	var content = v.content;
		  	var link = '<p><a href="' + v.link + '"' + '>Click Here</a></p>';
		  	recipe += title + content + link;
		  	if (v.categories && v.categories.length > 0) {
		  		var categories = v.categories.join(',');
		  		categories = '<p><i>' + categories + '</i></p>';
		  		recipe += categories;
		  	}
		  	html += '<li>' + recipe + '</li>';
		  });

		  $('#recipes').html('<ul>' + html + '</ul>');
		}
	});
});
