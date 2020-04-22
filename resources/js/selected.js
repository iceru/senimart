$('.sidebar > ul > li > a').click(function() {
	// when clicking any of these links
	$('.sidebar > ul > li > a').removeClass('selected'); // remove highlight from all links
	$(this).addClass('selected'); // add highlight to clicked link
});
