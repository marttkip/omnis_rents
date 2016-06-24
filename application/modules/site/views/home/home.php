
<!-- Slider -->
<?php echo $this->load->view('home/slider', '', TRUE); ?>


<!-- // filter -->
<?php echo $this->load->view('home/filter', '', TRUE); ?>

<!-- // Wrapper -->

<div class="container container-wrapper gradient">
		
    <!-- get the videos -->
    <?php echo $this->load->view('home/video', '', TRUE); ?>
    <?php //echo $this->load->view('home/video_promotion', '', TRUE); ?>
    <div class="clear-both"></div>
    <?php //echo $this->load->view('home/our_features', '', TRUE); ?>
    <!-- // Recent Properties 
    <?php echo $this->load->view('home/latest', '', TRUE); ?>
    <!-- // Featured Properties -->
    <?php echo $this->load->view('home/featured', '', TRUE); ?>
    <!-- // Our Features -->

</div>

		<div class="clear-both"></div>
    <?php //echo $this->load->view('home/promotion', '', TRUE); ?>