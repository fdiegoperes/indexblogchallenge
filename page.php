<?php get_header(); ?>
    <!-- Template responsible for Single Pages -->
		<article class="content px-3 py-5 p-md-5">
			
			<?php 
				if (have_posts()) {
					while (have_posts()) {
            the_post();
            get_template_part('template-parts/pages/content', 'page');
					}
				}
			?>

		</article>


<?php get_footer(); ?>
