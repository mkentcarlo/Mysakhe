<!-- FOOTER -->
		<footer id="footer">
			<div class="wrapper container clearfix">
				<div class="contact ft-col f-left">
					<?php dynamic_sidebar( 'contact-info' );?>
				</div>
				
				<div class="social ft-col">
					<h3>Stay <span>Connected</span></h3>
					<a href="https://www.facebook.com/" target="_blank">Like us on Facebook</a>
					<a href="https://twitter.com/" target="_blank">Follow us on Twitter</a>
				</div>
				
				<div class="fnav ft-col f-right">
					<h3>Site <span>Navigation</span></h3>
					<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
				</div>
			</div>
					
			<div class="copyright">
				<span>&copy; Copyright <?php $start_year = '2016'; $current_year = date('Y'); $copyright = ($current_year == $start_year) ? $start_year : $start_year.' - '.$current_year; echo $copyright; ?></span>
				&nbsp;&bull;&nbsp;
				<span>My Sakhe</span>
				&nbsp;&bull;&nbsp;
				<span><a href="http://www.proweaver.com/in-home-care-web-design" target="_blank">Non-Medical In-Home Care Web Design</a>: <a href="http://proweaver.com" target="_blank">Proweaver</a></span>
			</div>
		</footer>
	
	</div>
	
		<?php get_includes('ie');?>
		
		<script src="<?php bloginfo('template_url'); ?>/js/jquery-2.1.1.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/modernizr-custom-v2.7.1.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/selectivizr-min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/calcheight.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.skitter.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/responsiveslides.min.js"></script>

		<!-- For backend -->
		<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.validate.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery-ui.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.time-picker.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.dataTables.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/dataTables.bootstrap.js"></script>
		<script>
			$(document).ready(function(){
				document.getElementById("s").placeholder = "What do you need help with?";
			});
		</script>
		<script src="<?php bloginfo('template_url'); ?>/js/plugins.js"></script>
		
	<?php wp_footer(); ?>
	</body>
</html> 