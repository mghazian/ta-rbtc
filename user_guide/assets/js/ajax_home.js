/**
 * @author Shaumik Daityari
 * @copyright Copyright © 2013 All rights reserved.
 */

 var load = load || {};

 (function($, load) {

 	"use strict";

 	var page = 2,
 	buttonId = "#button-more",
 	loadingId = "#loading-div",
 	container = "#data-container";

 	load.load = function() {

 		var url = "<?php echo base_url();?>ajax/halaman_utama/";

 		$(buttonId).hide();
 		$(loadingId).show();

 		$.ajax({
 			url: url,
 			success: function(response) {
 				if (!response || response.trim() == "NONE") {
 					$(buttonId).fadeOut();
 					$(loadingId).text("No more entries to load!");
 					return;
 				}
 				appendContests(response);
 			},
 			error: function(response) {
 				$(loadingId).text("Sorry, there was some error with the request. Please refresh the page.");
 			}
 		});
 	};

 	var appendContests = function(response) {
 		var id = $(buttonId);

 		$(buttonId).show();
 		$(loadingId).hide();

 		$(response).appendTo($(container));
 		page += 1;
 	};

 })(jQuery, load);