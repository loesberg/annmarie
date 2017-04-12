jQuery(function($) {
	
	var windowWidth = $(window).width();
	
	
	if (windowWidth <= 480) {
	
		// Resize the logo
		$("#logo").attr({
			width: 275,
			height: 38
		});
		
		// Resize content images
		$("#content img").each(function() {
			var width = $(this).attr("width");
			var height = $(this).attr("height");
			if (width > 200) {
				var newWidth = 200
				var newHeight = (200 / width) * height;
				$(this).attr({
					width: newWidth,
					height: newHeight
				});
			}
		});
		
		// Move the sidebar to the bottom of the page
		var bulletBox = $("#bullet-box");
		$("#bullet-box").appendTo("#content");
		
		
		// Remove background images 
		
		$("#main-box").css("background-image", "none");
		
		// Navigation menu
		
		$("#nav-arrow").click(function() {
			if ($("#nav").is(":visible")) {
				$("#nav").slideUp(800, function() {
					$("#nav-arrow").html("&#9660;");
				});	
			} else {
				$("#nav").slideDown(800, function() {
					$("#nav-arrow").html("&#9650;");
				});				
			}
		});
				
		// Rearrange home page 
		
		$("#headshot").css({
			display: "block",
			margin: "10px auto"
			}
		).prependTo("#homepage-content");
		
		$("#homepage-callout").appendTo("#homepage-content");
		
		$("#slideshow-container").css({
			margin: "0 auto"		
			}
		).appendTo("#content");		
			 
	} // End width conditional
	
});