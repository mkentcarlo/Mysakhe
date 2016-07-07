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
					<h1>Welcome to <span>My Sakhe</span></h1>
					<p>These text are temporary, dummy text follows amet do eiusmod reprehenderit sint magna adipisicing dolore laboris ipsum cillum.</p>
					<p>Duis aute nulla fugiat ut fugiat ipsum labore. Commodo eu eiusmod deserunt aute veniam, id anim excepteur consequat ut do consectetur pariatur consequat. Tempor aute quis aute consequat officia eu minim incididunt. Excepteur non aute eu ut nisi officia enim aliqua exercitation id ex proident.</p>
				</section>
				
				<?php get_includes('sidebar');?>
				
			</div>
		</div>
		
		 
<?php 
get_includes('bottom');
get_includes('footer');
?>