/*
 * Admin Scripts File
 * Author: Matthew Stumphy
 *
 * Just any extra javascript to run in the admin area.
*/


jQuery(document).ready(function($) {
	toggleMetaboxes($);
	$('#page_template').change(function() {
		toggleMetaboxes($);
	});
});

function toggleMetaboxes($) {
	var pageTemplate = $('#page_template').val()
	if (pageTemplate == 'page-parallax.php') {
		$('#page-parallax_metabox').show();
	} else {
		$('#page-parallax_metabox').hide();
	}
	if (pageTemplate == 'page-standard.php') {
		$('#page-standard_metabox').show();
	} else {
		$('#page-standard_metabox').hide();
	}
}
