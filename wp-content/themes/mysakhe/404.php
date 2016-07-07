<?php 
@session_start(); 
get_includes('head');
get_includes('header');
get_includes('banner');
get_includes('mid');
?>
		
		<!-- MAIN -->
		<div id="main">
			<div class="container clearfix wrapper">
				<section class="content f-right">
					<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
					<div class="entry-content">
						<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</section>
				
				<?php get_includes('sidebar');?>
				
			</div>
		</div>
		
		 
<?php 
get_includes('bottom');
get_includes('footer');
?>