<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TRM_Portfolio
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				post_type_archive_title( '<h1 class="entry-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
				<nav id="project-filters">
					<a href="#" class="gd">Graphic Design</a>
					<a href="#" class="wd">Web Design</a>
					<a href="#" class="wdv">Web Development</a>
					<a href="#" class="reset">Reset Filter</a>
				</nav>
			</header><!-- .page-header -->
			<div class="projects">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();?>

 
				<section <?php post_class('archive-project'); ?> style="background-image:url(<?php the_post_thumbnail_url(); ?>)" data-skills="<?php the_field('skills_used') ?>">
					
					<?php    ?>
					<h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h2>
					
				</section>

				<?php 
				
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				//get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			//the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</div>
	</main><!-- #main -->
<script>
jQuery(function ($) {

    $(".archive-project").each(function(){
		//console.log($(this).data("skills"));
		
		$data = $(this).data("skills");
		$data_arr = $data.split(", ");


		
	});

	$("#project-filters a").on("click", function(){
		
		$(this).addClass("active");
		$(this).siblings().removeClass("active");

		$(".reset").css({"display": "block"});

		$active_filter = $("#project-filters a.active").text();

		$(".archive-project").each(function(){
			
			$data = $(this).data("skills");
			$data_arr = $data.split(", ");

			if( $active_filter != "Reset Filter"){
				if( $.inArray($active_filter, $data_arr) !== -1 ){
					$(this).css({"display":"flex"});
				}else{
					$(this).css({"display":"none"});
					
				}
			}else{
				$(this).css({"display":"flex"});
				$(".reset").css({"display":"none"});
			}

			


			//console.log($data_arr);
			
		});
	});
});
</script>
<?php
get_sidebar();
get_footer();
