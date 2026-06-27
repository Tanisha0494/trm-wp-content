<?php
/**
 * Template part for displaying projects
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TRM_Portfolio
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header project-header" style="text-align:center">
		<p class="breadcrumb-wrap" style="margin-top:.75em"><a href="/" class="breadcrumb">Home</a> / <a href="/projects" class="breadcrumb">Projects</a> / <strong><?php the_title(); ?></strong></p>

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				trm_portfolio_posted_on();
				trm_portfolio_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		
		<div class="proj-sub-head">
			<p>|| <?php the_field('skills_used'); ?> || <?php the_field('where'); ?> ||</p>
			<?php the_field('project_overview'); ?>
		</div>

	</header><!-- .entry-header -->
	

	<div class="entry-content">
		<section class="overview yllw-bg">

		
		
		<div class="one-half">
			<?php trm_portfolio_post_thumbnail(); ?>
			
		</div>
		<div class="one-half last">
			<h2 class="po-header"> Project Overview</h2>
			<?php $cms_used = get_field('cms_used'); if( $cms_used != "None"){ ?>
	        <p><strong>CMS:</strong> <?php	echo $cms_used; ?></p>
	    	<?php	} ?>
	        <p class="po-services-header"><strong>Services Provided:</strong></p>
	        <?php
	        $services_provided = get_field('services_provided');
	        if( $services_provided ): ?>
	        <ul class="services_provided wp-block-list">
	            <?php foreach( $services_provided as $service ): ?>
	                <li><?php echo $service; ?></li>
	            <?php endforeach; ?>
	        </ul>
	        <?php endif; ?>

			<?php if(get_field('link_to_website')){ ?><a href="<?php echo esc_attr( get_field('link_to_website') ); ?>" class="view-btn">Visit Website</a><?php } ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'trm_portfolio' ),
					'after'  => '</div>',
				)
			);
			?>

		</div>

		</section>
		<section class="proj-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'trm_portfolio' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
			
		</section>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php trm_portfolio_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
