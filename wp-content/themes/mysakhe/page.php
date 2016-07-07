<?php 

if(is_page('admin-panel')){
	get_admin_page("index");
}
else {
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
					<?php get_template_part( 'loop', 'page' );?>
				</section>
				
				<?php get_includes('sidebar');?>
				
			</div>
		</div>
		
		 
<?php 
get_includes('bottom');
get_includes('footer');
}
?>