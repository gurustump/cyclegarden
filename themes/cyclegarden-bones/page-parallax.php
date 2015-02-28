<?php
/*
 Template Name: Parallax Page
*/
?>
<?php
function showSection($num) {
	return get_post_meta(get_the_ID(),'_cg_section_'.$num.'_background',true) != '' || get_post_meta(get_the_ID(),'_cg_section_'.$num.'_title',true) != '' || get_post_meta(get_the_ID(),'_cg_section_'.$num.'_content',true) != '';
}
function hasBackground($num) {
	echo get_post_meta(get_the_ID(),'_cg_section_'.$num.'_background',true) == '' ? '':' bg-image';
}
function echoMeta($type,$num) {
	echo get_post_meta(get_the_ID(),'_cg_section_'.$num.'_'.$type,true);
}
function getMeta($type,$num) {
	return get_post_meta(get_the_ID(),'_cg_section_'.$num.'_'.$type,true);
}
?>
<?php get_header(); ?>
			<div id="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section class="content-one<?php echo getMeta('parallax','1') ? ' PARALLAX bg-parallax' : ' bg-repeat'; ?>" style="background-image:url(<?php echoMeta('background','1'); ?>)">
					<div class="inner-content wrap">
						<div id="main" role="main">
							<header class="section-header">
								<?php if (!is_front_page()) { ?><h1 class="page-title"><?php the_title(); ?></h1><?php } ?>
							</header>
							<?php the_content(); ?>
						</div>
					</div>
				</section> <?php /* </content-one> */ ?><?php /* print_r( get_post_meta(get_the_ID())); */ ?>
				<?php if (showSection('2')) { ?>
				<section class="content-two<?php echo getMeta('parallax','2') ? ' PARALLAX bg-parallax' : ' bg-repeat'; ?>" style="background-image:url(<?php echoMeta('background','2'); ?>)">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echoMeta('title','2'); ?></h2>
						</header>
						<?php echo apply_filters('the_content', getMeta('content','2')); ?>
					</div>
				</section> 
				<?php } /* </content-two> */ ?>
				<?php if (showSection('3')) { ?>
				<section class="content-three<?php echo getMeta('parallax','3') ? ' PARALLAX bg-parallax' : ' bg-repeat'; ?>" style="background-image:url(<?php echoMeta('background','3'); ?>)">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echoMeta('title','3'); ?></h2>
						</header>
						<?php echo apply_filters('the_content', getMeta('content','3')); ?>
					</div>
				</section>
				<?php } /* </content-three> */ ?>
				<?php if (showSection('4')) { ?>
				<section class="content-four<?php echo getMeta('parallax','4') ? ' PARALLAX bg-parallax' : ' bg-repeat'; ?>" style="background-image:url(<?php echoMeta('background','4'); ?>)">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echoMeta('title','4'); ?></h2>
						</header>
						<?php echo apply_filters('the_content', getMeta('content','4')); ?>
					</div>
				</section>
				<?php } /* </content-four> */ ?>
				<?php if (showSection('5')) { ?>
				<section class="content-five<?php echo getMeta('parallax','5') ? ' PARALLAX bg-parallax' : ' bg-repeat'; ?>" style="background-image:url(<?php echoMeta('background','5'); ?>)">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echoMeta('title','5'); ?></h2>
						</header>
						<?php echo apply_filters('the_content', getMeta('content','5')); ?>
					</div>
				</section>
				<?php } /* </content-five> */ ?>
				<?php endwhile; endif; ?>
			</div><?php /* </content> */ ?>
<?php get_footer(); ?>
