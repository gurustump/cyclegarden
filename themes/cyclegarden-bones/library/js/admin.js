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
	if ($('#page_template').val() == 'page-parallax.php') {
		$('#page-parallax_metabox').show();
	} else {
		$('#page-parallax_metabox').hide();
	}
}
