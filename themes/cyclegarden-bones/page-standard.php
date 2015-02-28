<?php
/*
 Template Name: Standard Page
*/
?>
<?php
function showSection($sec) {
	return get_post_meta(get_the_ID(),'_cg_'.$sec.'_section_background',true) != '' || get_post_meta(get_the_ID(),'_cg_'.$sec.'_section_title',true) != '' || get_post_meta(get_the_ID(),'_cg_'.$sec.'_section_content',true) != '';
}
function metaExists($type,$sec) {
	return get_post_meta(get_the_ID(),'_cg_'.$sec.'_section_'.$type,true) != '';
}
function hasBackground($sec) {
	echo get_post_meta(get_the_ID(),'_cg_'.$sec.'_section_background',true) == '' ? '':' bg-image';
}
function echoMeta($type,$sec) {
	echo get_post_meta(get_the_ID(),'_cg_'.$sec.'_section_'.$type,true);
}
function getMeta($type,$sec) {
	return get_post_meta(get_the_ID(),'_cg_'.$sec.'_section_'.$type,true);
}
?>
<?php get_header(); ?>
			<div id="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section class="content-head PARALLAX<?php hasBackground('head') ?>" style="background-image:url(<?php echoMeta('background','head'); ?>)">
					<header class="page-header">
						<?php if (!is_front_page()) { ?><h1 class="page-title"><?php the_title(); ?></h1><?php } ?>
					</header>
					<div class="inner-content wrap">
						<div id="main" role="main">
							<div class="featured">
								<?php if (metaExists('featured_override','head')) {
									include 'includes/page-standard-featured-custom-override.php';
								} else if (metaExists('featured','head')) { ?>
								<img src="<?php echoMeta('featured','head'); ?>" alt="<?php the_title(); ?>" />
								<?php } ?>
							</div>
							<div class="section-content">
								<h2><?php echoMeta('title','head'); ?></h2>
								<div class="hard-columns raw COLUMNS">
									<?php  /*
									$mainContent = get_the_content();
									$mainContentStrings = wordwrap($mainContent, 800, '<!--BREAK-->');
									$mainContentChunks = explode('<!--BREAK-->',$mainContentStrings);
									$segmented_content = '<div class="hard-columns COLUMNS COLUMNS-'.count($mainContentChunks).'">';
									foreach($mainContentChunks as $chunk) {
										$segmented_content .= '<div>';
										$segmented_content .= $chunk;
									  $segmented_content .= '</div> ';
									}
									echo apply_filters('the_content', $segmented_content);
									*/ ?>
									<?php
									if (file_exists(get_stylesheet_directory().'/library/images/section-icons/'.$post->post_name.'.png')) {
										echo do_shortcode('[section-icon class="single-column"]');
									} 
									the_content();
									?>
								</div>
							</div>
						</div>
					</div>
					<?php if (showSection('video')) { ?>
					<div class="content-video<?php hasBackground('video'); ?>" style="background-image:url(<?php echoMeta('background','video'); ?>)">
						<div class="inner-content wrap">
							<header class="section-header">
								<h2 class="section-title"><?php echoMeta('title','video'); ?></h2>
							</header>
							<div class="section-content">
								<?php echo apply_filters('the_content', getMeta('content','video')); ?>
							</div>
							<?php
							$youtube_vid_id = get_post_meta(get_the_ID(),'_cg_youtube_vid_id',true);
							$vimeo_vid_id = get_post_meta(get_the_ID(),'_cg_vimeo_vid_id',true);
							$vid_id = '';
							$vid_type = '';
							if (! empty($vimeo_vid_id)) {
								$vid_id = $vimeo_vid_id;
								$vid_type = 'vimeo';
								$vid_embed = '<iframe src="//player.vimeo.com/video/'. $vimeo_vid_id .'?title=0&amp;byline=0&amp;portrait=0" width="1140" height="641" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
							} else if (! empty($youtube_vid_id)) {
								$vid_id = $youtube_vid_id;
								$vid_type = 'youtube';
								$vid_embed = '<iframe width="1920" height="1080" src="http://www.youtube.com/embed/'. $youtube_vid_id .'?vq=hd1080&rel=0&modestbranding=1&wmode=transparent" frameborder="0" allowfullscreen></iframe>';
							}
							?>
							<a class="vid-launch VID_LAUNCH" href="<?php echo $vid_id; ?>" data-type="<?php echo $vid_type; ?>">
								Play Video
								<span class="vid-embed-dummy VID_EMBED_DUMMY"><?php echo $vid_embed; ?></span>
							</a>
						</div>
					</div> 
					<?php } /* </content-video> */ ?>
				</section> <?php /* </content-head> */ ?><?php /* print_r( get_post_meta(get_the_ID())); */ ?>
				<?php if (showSection('gallery')) { ?>
				<section class="content-gallery<?php hasBackground('gallery'); ?>" style="background-image:url(<?php echoMeta('background','gallery'); ?>)">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echoMeta('title','gallery'); ?></h2>
						</header>
						<div class="section-content">
							<?php echo apply_filters('the_content', getMeta('content','gallery')); ?>
						</div>
					</div>
				</section>
				<?php } /* </content-gallery> */ ?>
				<?php endwhile; endif; ?>
			</div><?php /* </content> */ ?>
<?php get_footer(); ?>
