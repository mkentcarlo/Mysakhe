$(document).ready(function(){

	// Global Variables
	var toggle_primary_button    = $('.nav-toggle-button'),  
		toggle_primary_icon    	 = $('.nav-toggle-button i'),  
		toggle_secondary_button  = $('nav li span'),  
		toggle_secondary_icon    = $('nav li span i'),  
		primary_menu        	 = $('nav'),   
		secondary_menu   		 = $('nav ul ul'),
		window_width			 = $(window).width();  
 
 
	//Multi-line Tab
	toggle_secondary_button.each(function(){
		$(this).click(function(){
			$(this).parent("li").children("ul").slideToggle();
			$(this).children().toggleClass("fa-caret-up").toggleClass("fa-caret-down");;
		});
	});
		
	// Basic functionality for nav-toggle-button
	$(toggle_primary_button).click(function(){
		primary_menu.slideToggle();		
		toggle_primary_icon.toggleClass("fa-times").toggleClass("fa-navicon");
	});
	
	// Add class to tab having drop down
	$( "nav li:has(ul)").find('span i').addClass("fa-caret-down");		
	
	// Reset all configs when width > 760
	$(window).resize(function(){  
		
		if(window_width > 760 && primary_menu.is(':visible') || primary_menu.is(':hidden') || secondary_menu.is(':visible') || secondary_menu.is(':hidden')) { 
			primary_menu.removeAttr('style');  
			toggle_primary_icon.removeClass("fa-times").addClass("fa-navicon");
			
			secondary_menu.removeAttr('style'); 
			toggle_secondary_icon.removeClass("fa-caret-up").addClass("fa-caret-down");			
		}
		
	});
	$(".rslides").responsiveSlides();
	$('.box_skitter_large').skitter({
		theme: 'default',
		numbers_align: 'center',
		progressbar: false,
		navigation: false,
		numbers: false,
		dots:false, 
		preview: false,
		interval: 5000
	});
	$(".content").each(function() {
			$(this).html(
					$(this).html()
					.replace(/My Sakhe/gi, "<span class='comp'>$&</span>"));
	});

	$("#sign-up").submit(function(e){
		
		if($("input[name=terms_and_policy]:checked").length<1){
			alert("Please agree with MySakhe's Terms and Policy");
			e.preventDefault();
		}

	});
	   $('.datetime').datetimepicker({
        dateFormat: 'yy-mm-dd'
        });

      $("#table_orders").DataTable();
      $(".user-dashboard").show();

	
});
