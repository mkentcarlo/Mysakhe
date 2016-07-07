<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_front_page() ) { ?>
			<h1><span>My Sakhe Difference</span></h1>
		<?php } else { ?>
			<span class="welcome"><?php the_title(); ?></span>
			<?php if($post->post_content=="") { ?>
					<!-- <p><span class="comingsoon">Coming Soon...</span></p> -->
			<?php } ?>
		<?php } ?>
		<div class="entry-content">
			<?php the_content(); 
			if(is_page('non-medical-in-home-care-sign-up')){ 
				get_client_backend("sign-up");
			}
			else if(is_page('non-medical-in-home-care-log-in')){
				get_client_backend("login");
			}
			else if(is_page('non-medical-in-home-care-reset-password')){
				get_client_backend("reset-password");
			}
			else if(is_page('non-medical-in-home-care-dashboard')){
				get_client_backend("user-dashboard");
			}
			 ?>
				<!-- <p><iframe id="myframe" src="<?php bloginfo('template_url'); ?>/forms/SignUp.php" style="width:100%; overflow:hidden; border:none;">Your browser does not support inline frames or is currently configured not to display inline frames. Content can be viewed at actual source<?php bloginfo('template_url'); ?>/forms/contactForm.php</iframe>
				<script type="text/javascript">
				//<![CDATA[ 
				document.getElementById('myframe').onload = function(){
				calcHeight();
				};
				//]]>
				</script>
				</p> -->
			
			<!-- <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?> -->
			<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-## -->
<?php endwhile; // end of the loop. ?>