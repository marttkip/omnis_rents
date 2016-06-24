<div class="parallax-section parallax-image-2" style="background-position: 50% -82px;">
	<div class="w100 parallax-section-overley">
    	<div class="container">
            <div class="row">
    
                <div class="col-sm-7 col-md-7">
    
                    <div class="hero-block text-center">
                        <div class="hero-unit">
                            <h1 class="meet-the-team">Meet the team</h1>
                            <p class="meet-the-team">Ian & Scott Haggarty </p>
                            <p class="team2"> Over 45 years' combined experience, wisely they listen to their client's needs.</p>
                            <a href="<?php echo site_url().'about';?>" class="view-property">Find out more</a>
                        </div>
                    </div>
    
                </div>
                
            </div>
        </div>
  	</div>
</div>

<script src="<?php echo base_url();?>assets/themes/custom/js/jquery.parallax-1.1.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	/*==================================
	Parallax  
	====================================*/
	if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
		// Detect ios User // 
		$('.parallax-section').addClass('isios');
		$('.navbar-header').addClass('isios');
	}
	
	if (/Android|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		// Detect Android User // 
		 $('.parallax-section').addClass('isandroid');
    }
	
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		// Detect Mobile User // No parallax
		 $('.parallax-section').addClass('ismobile');
		 $('.parallaximg').addClass('ismobile');

    } else {
		// All Desktop 
        $(window).bind('scroll', function (e) {
            parallaxScroll();
        });

        function parallaxScroll() {
            var scrolledY = $(window).scrollTop();
            $('.parallaximg').css('marginTop', '' + ((scrolledY * 0.3)) + 'px');
        }


        if ($(window).width() < 600) {} else {
            $('.parallax-section').parallax("100%", 100, 0.2, true);
        }
    }
}); // end Ready
</script>