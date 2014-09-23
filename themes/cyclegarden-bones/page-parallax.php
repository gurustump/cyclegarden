<?php
/*
 Template Name: Parallax Page
*/
?>

<?php get_header(); ?>
			<div id="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section class="content-one" style="background-image:url(<?php echo get_post_meta(get_the_ID(),'_cg_section_1_background',true); ?>">
					<div class="inner-content wrap">
						<div id="main" role="main">
							<header class="section-header">
								<h1 class="page-title"><?php the_title(); ?></h1>
							</header>
							<?php the_content(); ?>
						</div>
					</div>
				</section> <?php /* </content-one> */ ?><?php print_r( get_post_meta(get_the_ID())); ?>
				<section class="content-two" style="background-image:url(<?php echo get_post_meta(get_the_ID(),'_cg_section_2_background',true); ?>">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echo get_post_meta(get_the_ID(),'_cg_section_2_title',true); ?></h2>
						</header>
						<?php echo get_post_meta(get_the_ID(),'_cg_section_2_content',true); ?>
					</div>
				</section> <?php /* </content-two> */ ?>
				<section class="content-three" style="background-image:url(<?php echo get_post_meta(get_the_ID(),'_cg_section_3_background',true); ?>">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echo get_post_meta(get_the_ID(),'_cg_section_3_title',true); ?></h2>
						</header>
						<?php echo get_post_meta(get_the_ID(),'_cg_section_3_content',true); ?>
					</div>
				</section> <?php /* </content-three> */ ?>
				<section class="content-four" style="background-image:url(<?php echo get_post_meta(get_the_ID(),'_cg_section_4_background',true); ?>">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echo get_post_meta(get_the_ID(),'_cg_section_4_title',true); ?></h2>
						</header>
						<?php echo get_post_meta(get_the_ID(),'_cg_section_4_content',true); ?>
					</div>
				</section> <?php /* </content-four> */ ?>
				<section class="content-five" style="background-image:url(<?php echo get_post_meta(get_the_ID(),'_cg_section_5_background',true); ?>">
					<div class="inner-content wrap">
						<header class="section-header">
							<h2 class="section-title"><?php echo get_post_meta(get_the_ID(),'_cg_section_5_title',true); ?></h2>
						</header>
						<?php echo get_post_meta(get_the_ID(),'_cg_section_5_content',true); ?>
					</div>
				</section> <?php /* </content-five> */ ?>
				<?php endwhile; endif; ?>
			</div><?php /* </content> */ ?>
<?php get_footer(); ?>
