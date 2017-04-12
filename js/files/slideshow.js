jQuery(function($) {
	
	// Set height of slideshow image box
	var boxHeight = 0;
	
	$("#slideshow img").each(function() {
		var imgHeight = $(this).attr("height");
		if (imgHeight > boxHeight) {
			boxHeight = imgHeight;
		}
	});
	boxHeight = parseInt(boxHeight) + 50;
	$("#slideshow-container").css({height: boxHeight + "px"});
	
	// Set first slideshow image to active
	$("#slideshow img:first").css({
		opacity: 1.0,
	}).addClass("active");
	
	// Run the slideshow
	setInterval(rollSlides, 6000);
	
	function rollSlides() {
		var activeImg = $("#slideshow img.active");
		var nextImg = activeImg.next("img");
		if (nextImg.length == 0) {
			nextImg = $("#slideshow img:first");
		}
		activeImg.animate({opacity: 0}, 1500);
		nextImg.animate({opacity: 1.0}, 1500, function() {
			activeImg.removeClass('active');
			nextImg.addClass('active');
		});
	}
});