<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

/**
 * Get the bootstrap!
 */
require_once 'cmb/init.php';

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function cmb2_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

add_filter( 'cmb2_meta_boxes', 'cmb2_cyclegarden_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_cyclegarden_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cg_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	

	$meta_boxes['module_metabox'] = array(
		'id'         => 'module_metabox',
		'title'      => __( 'Module Metabox', 'cmb2' ),
		'object_types'      => array( 'module', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
            array(
				'name' => __( 'Background Image', 'cmb2' ),
                'id'   => $prefix . 'module_background',
                'type' => 'file',
            ),
			array(
				'name' => 'Parallax Enabled',
				'desc' => 'Check this to make the header image move in parallax',
				'id' => $prefix . 'module_background_parallax',
				'type' => 'checkbox'
			),
		),
	);
	
	/**
	 * Metabox for Projects / Project items
	 */
	
	$meta_boxes['project_features'] = array(
		'id'						=> 'project_features',
		'title'					=> __('Project Settings','cmb2'),
		'object_types'		=> array( 'project' ), // Post type
		'context'				=> 'normal',
		'priority'				=> 'high',
		'show_names'		=> true, // Show field names on the left
		'fields' => array(
			array(
				'name'	=> __('Location','cmb2'),
				'id'		=> $prefix . 'project_location',
				'type'	=> 'text',
			),
			array(
				'name'	=> __( 'Featured Project', 'cmb2'),
				'desc' 	=> __('Items checked as featured will be displayed first in the homepage project sub-navigation (ordered by date descending)', 'cmb2'),
				'id'   		=> $prefix . 'project_featured',
				'type' 	=> 'checkbox',
			),
			array(
				'name'	=> __('Order','cmb2'),
				'id'		=> $prefix . 'project_order',
				'desc'	=> 'Enter a number. Controls the order that featured Projects will appear on the home page Project sub-navigation',
				'type'	=> 'text',
			),
		)
	);
	
	$meta_boxes['project_gallery_group'] = array(
		'id'           => $prefix . 'project_gallery_group',
		'title'        => __( 'Gallery Images', 'cmb2' ),
		'object_types' => array( 'project', ),
		'fields'       => array(
			array(
				'id'          => $prefix . 'project_gallery_images',
				'type'        => 'group',
				'desc' => __( "Select each image you wish to appear in the slider on the Project's home page", "cmb2" ),
				'options'     => array(
					'group_title'   => __( 'Image {#}', 'cmb2' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Image', 'cmb2' ),
					'remove_button' => __( 'Remove Image', 'cmb2' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Image File',
						'id'   => 'image',
						'type' => 'file',
					),
					array(
						'name' => 'Image Title',
						'id'   => 'image_title',
						'type' => 'text',
					),
					array(
						'name' => 'Image Caption',
						'id'   => 'image_caption',
						'type' => 'textarea_small',
					),
					array(
						'name' => 'Featured',
						'id' => 'image_featured',
						'description' => 'Featured on Home Page Slider (after a Project has been selected)',
						'type' => 'checkbox',
					),
				),
			),
		),
	);

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$meta_boxes['page-parallax_metabox'] = array(
		'id'           => 'page-parallax_metabox',
		'title'        => __( 'Parallax Page Metabox', 'cmb2' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		//'show_on'      => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'       => array(
			array(
				'name' => 'Section 1 Background Image',
				'id'   => $prefix . 'section_1_background',
				'type' => 'file',
			),
			array(
				'name' => 'Section 1 Parallax',
				'desc' => "Check this to cause parallax effect on this section's background image",
				'id' => $prefix . 'section_1_parallax',
				'type' => 'checkbox'
			),
			array(
				'name' => __( 'Section 2 Title', 'cmb2' ),
				'id'   => $prefix . 'section_2_title',
				'type' => 'text',
			),
			array(
				'name' => 'Section 2 Content',
				'id'   => $prefix . 'section_2_content',
				'type' => 'textarea',
			),
			array(
				'name' => 'Section 2 Background Image',
				'id'   => $prefix . 'section_2_background',
				'type' => 'file',
			),
			array(
				'name' => 'Section 2 Parallax',
				'desc' => "Check this to cause parallax effect on this section's background image",
				'id' => $prefix . 'section_2_parallax',
				'type' => 'checkbox'
			),
			array(
				'name' => __( 'Section 3 Title', 'cmb2' ),
				'id'   => $prefix . 'section_3_title',
				'type' => 'text',
			),
			array(
				'name' => 'Section 3 Content',
				'id'   => $prefix . 'section_3_content',
				'type' => 'textarea',
			),
			array(
				'name' => 'Section 3 Background Image',
				'id'   => $prefix . 'section_3_background',
				'type' => 'file',
			),
			array(
				'name' => 'Section 3 Parallax',
				'desc' => "Check this to cause parallax effect on this section's background image",
				'id' => $prefix . 'section_3_parallax',
				'type' => 'checkbox'
			),
			array(
				'name' => __( 'Section 4 Title', 'cmb2' ),
				'id'   => $prefix . 'section_4_title',
				'type' => 'text',
			),
			array(
				'name' => 'Section 4 Content',
				'id'   => $prefix . 'section_4_content',
				'type' => 'textarea',
			),
			array(
				'name' => 'Section 4 Background Image',
				'id'   => $prefix . 'section_4_background',
				'type' => 'file',
			),
			array(
				'name' => 'Section 4 Parallax',
				'desc' => "Check this to cause parallax effect on this section's background image",
				'id' => $prefix . 'section_4_parallax',
				'type' => 'checkbox'
			),
			array(
				'name' => __( 'Section 5 Title', 'cmb2' ),
				'id'   => $prefix . 'section_5_title',
				'type' => 'text',
			),
			array(
				'name' => 'Section 5 Content',
				'id'   => $prefix . 'section_5_content',
				'type' => 'textarea',
			),
			array(
				'name' => 'Section 5 Background Image',
				'id'   => $prefix . 'section_5_background',
				'type' => 'file',
			),
			array(
				'name' => 'Section 5 Parallax',
				'desc' => "Check this to cause parallax effect on this section's background image",
				'id' => $prefix . 'section_5_parallax',
				'type' => 'checkbox'
			),
		)
	);

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$meta_boxes['page-standard_metabox'] = array(
		'id'           => 'page-standard_metabox',
		'title'        => __( 'Standard Page Metabox', 'cmb2' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		//'show_on'      => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'       => array(
			array(
				'name' => __( 'Head Section Title', 'cmb2' ),
				'id'   => $prefix . 'head_section_title',
				'type' => 'text',
			),
			array(
				'name' => 'Section Head Featured Image',
				'desc' => 'Select the image that will appear in the head section next to the description',
				'id'   => $prefix . 'head_section_featured',
				'type' => 'file',
			),
			array(
				'name' => 'Section Head Featured Custom Overide',
				'desc' => 'Check this to use custom hard-coded featured image instead of the standard one above',
				'id' => $prefix . 'head_section_featured_override',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Section Head Background Image',
				'desc' => 'The image that goes behind the head section and video section',
				'id'   => $prefix . 'head_section_background',
				'type' => 'file',
			),
			array(
				'name' => __( 'Video Section Title', 'cmb2' ),
				'id'   => $prefix . 'video_section_title',
				'type' => 'text',
			),
			array(
				'name'	=> __('YouTube Video ID', 'cmb2'),
				'id'	=> $prefix . 'youtube_vid_id',
				'type'	=> 'text'
			),
			array(
				'name'	=> __('Vimeo Video ID', 'cmb2'),
				'id'	=> $prefix . 'vimeo_vid_id',
				'type'	=> 'text'
			),
			array(
				'name' => 'Video Section Content',
				'id'   => $prefix . 'video_section_content',
				'type' => 'textarea',
			),
			array(
				'name' => __( 'Gallery Section Title', 'cmb2' ),
				'id'   => $prefix . 'gallery_section_title',
				'type' => 'text',
			),
			array(
				'name' => 'Gallery Section Content',
				'id'   => $prefix . 'gallery_section_content',
				'type' => 'wysiwyg',
				'options' => array(
					'media_buttons' => true // show insert/upload button(s)
				),
			),
			array(
				'name' => 'Gallery Section Background Image',
				'id'   => $prefix . 'gallery_section_background',
				'type' => 'file',
			),
		)
	);

	/**
	 * Metabox for the user profile screen
	 */
	$meta_boxes['user_edit'] = array(
		'id'               => 'user_edit',
		'title'            => __( 'User Profile Metabox', 'cmb2' ),
		'object_types'     => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
		'fields'           => array(
			array(
				'name'     => __( 'Extra Info', 'cmb2' ),
				'desc'     => __( 'field description (optional)', 'cmb2' ),
				'id'       => $prefix . 'exta_info',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name'    => __( 'Avatar', 'cmb2' ),
				'desc'    => __( 'field description (optional)', 'cmb2' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			),
			array(
				'name' => __( 'Facebook URL', 'cmb2' ),
				'desc' => __( 'field description (optional)', 'cmb2' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'cmb2' ),
				'desc' => __( 'field description (optional)', 'cmb2' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'cmb2' ),
				'desc' => __( 'field description (optional)', 'cmb2' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'cmb2' ),
				'desc' => __( 'field description (optional)', 'cmb2' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'User Field', 'cmb2' ),
				'desc' => __( 'field description (optional)', 'cmb2' ),
				'id'   => $prefix . 'user_text_field',
				'type' => 'text',
			),
		)
	);

	return $meta_boxes;
}
