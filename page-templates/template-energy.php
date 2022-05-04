<?php
    /* Template Name: Energy Page */
    get_header();
	global $assets_uri, $post, $program_energy_and_env, $event_program_taxonomy;
?>
<section>
	
	<article class="inner-page energy">
		<div class="container">
			<div class="row">
				<div class="col-sm-24">
                    <?php get_breadcrumb(); ?>
				</div>
				<div class="col-sm-17">
					<div class="row">
						<div class="col-sm-24">
							<h1 class="heading_8">Energy & Environment</h1>
						</div>
					</div>

					<div class="row mt40">
						<div class="col-sm-24">
							<h2>Mission</h2>
							<p class="double-quotes">	&ldquo;</p>
							<p>
								Actively inform and engage MIT alumni and their colleagues in Northern California in a broad area of highly important topics relating to the replacement of fossil fuels for energy generation and transportation and other aspects of protecting the environment and sustaining our critical natural resources.  Our programs are OPEN TO ALL. 
							</p>
						</div>
					</div>

					<div class="row mt40">
						<div class="col-sm-24">
							<div>
								<h2>Primary Topics</h2>
								<p class="mt30 mb50">We feature topics of greatest demonstrated alumni interest.  In most cases, we will explore both science & technology as well as policy & economics in order to maintain a pragmatic viewpoint.</p>

								<div class="row">
									 <div class="col-lg-8 col-md-12">
										<div class="simple-box">
											<div class="img-box">
												<img src="<?php echo $assets_uri; ?>/images/p-icon1.png" alt="">
											</div>
											<h4>Electric Power Generation</h4>
											<p>both distributed and utility - class</p>
										</div>
									</div>

									 <div class="col-lg-8 col-md-12">
										<div class="simple-box">
											<div class="img-box">
												<img src="<?php echo $assets_uri; ?>/images/p-icon2.png" alt="">
											</div>
											<h4>Storage</h4>
											<p>both grid-level and distributed, for renewable energy sources</p>
										</div>
									</div>

									 <div class="col-lg-8 col-md-12">
										<div class="simple-box">
											<div class="img-box">
												<img src="<?php echo $assets_uri; ?>/images/p-icon3.png" alt="">
											</div>
											<h4>The Electric Grid</h4>
											<p>challenges & opportunities</p>
										</div>
									</div>

									 <div class="col-lg-8 col-md-12">
										<div class="simple-box">
											<div class="img-box">
												<img src="<?php echo $assets_uri; ?>/images/p-icon4.png" alt="">
											</div>
											<h4>Transportation</h4>
											<p>Electric Vehicles & Biofuels</p>
										</div>
									</div>

									 <div class="col-lg-8 col-md-12">
										<div class="simple-box">
											<div class="img-box">
												<img src="<?php echo $assets_uri; ?>/images/p-icon5.png" alt="">
											</div>
											<h4>Climate	Change</h4>
										</div>
									</div>

									 <div class="col-lg-8 col-md-12">
										<div class="simple-box">
											<div class="img-box">
												<img src="<?php echo $assets_uri; ?>/images/p-icon6.png" alt="">
											</div>
											<h4>Clean Energy Investing</h4>
										</div>
									</div>


								</div>
							</div>
						</div>
					</div>

					<!-- <div class="row mt40">
						<div class="col-sm-24">
							<h2>Tours</h2>
							<p>
								We are now arranging tours of facilities that relate to our major topics, such as the California Independent Service Operator (ISO), National Ignition Facility, Natural Gas Power Plants and more.  The tours are organized so that the tour directors understand the audience and speak to our issues.  These tours sell out in just a day or two, so be on the lookout for the next one.
							</p>
						</div>
					</div> -->

					<!-- <div class="row mt20">
						<div class="gallery-stye-1">
							<div class="col-sm-24">
								<img src="<?php echo $assets_uri; ?>/images/galler-image.jpg" alt="" class="img-responsive">
							</div>
					
						</div>
						
					</div> -->


					<div class="row mt40">
						<div class="col-sm-15">
							<h2>Panel Discussions & Guest Speakers</h2>
							<p class="text-pad-right">
								We feature high profile, experienced and knowledgeable participants in our panel discussions in the same topical areas as MITEI on the Road, so as to provide both a research and a commercial perspective.  These discussions are intended to be informative and thought-provoking and should provide many attendees with important new contacts in their areas of interest.  Most panel discussions include executives from relatively new companies in order to maintain our entrepreneurial orientation. <br>

We also feature prominent speakers from the energy industry, typically CEOs or founders of important companies, to comment on a wide range of issues and provide a glimpse of things to come. 
							</p>
						</div>

						<div class="col-sm-9">
							<h2>MITEI* on the Road</h2>
							<p>
								This program features visiting MIT professors who are experts in their fields and will describe their most innovative and promising energy research, much of which may be commercializable within a few years.
							</p>
							<p class="note">
								Note: *MITEI stands for “MIT Energy initiative”, which now encompasses 25% of the MIT faculty.
							</p>
						</div>
					</div>

                    <?php get_template_part('template-parts/content', 'programs-common'); ?>

				</div>
				<div class="col-sm-6 offset-sm-1">
				 	 <?php get_sidebar(); ?> 
				</div>
			</div>
			
		</div>
	</article>
</section>


<?php

    get_footer();

?>