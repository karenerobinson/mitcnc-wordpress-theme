<?php
    /* Template Name: Sports Page */
    get_header();
	global $assets_uri, $post;
    $past_events = get_events(
        -1,
        null,
        null,
        [11],
        null,
        true
    );
    $upcoming_events = $past_events;
    $event_loop_cols = 12;
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
							<h1 class="heading_8">Sports and Recreation</h1>
						</div>
					</div>

					<div class="row mt40">
						<div class="col-sm-24">
							<p>
                                The MITCNC Sports and Recreation group engages in activities like hiking, biking, rock climbing, and attend sports events. The hikes are generally not that strenuous, and involve 4 to 5 hours of hiking plus lunch in the middle. Non-MITers are very welcome, and constitute about half the attendance. Our email list is a Yahoo group which you can subscribe yourself to.
							</p>
                            <p>We also have a separate carpool list. To join it, <a href="http://groups.yahoo.com/group/mitcnchikers_carpooling" target="_blank" rel="noopener">visit this Yahoo page</a> and then send a message to <a href="mailto:mitcnchikers_carpooling@groups.yahoo.com">mitcnchikers_carpooling@groups.yahoo.com</a>, or post from the web interface at the above address. This requires you to get a free yahoo account; sorry about this, but in our experience, they've been harmless and respect your spam preferences.</p>
						</div>
					</div>

                    <hr />

					<?php if($past_events != null){ ?>
                        <div class="row">
                            <div class="col-sm-24">
                                <h2 class="bordered heading_1 black-text">Past Events</h2>
                                <p class="text-pad-right">
                                    2015 and beyond - we have been bad about updating this page, but there have been many events!</p>
                            </div>
                        </div>
                        <div class="row card-container">
                            <?php get_template_part('template-parts/content', 'events-loop'); ?>
                        </div>
                    <?php } ?>
                    <div class="row mt40">
                        <div class="col-sm-24">
                            <div class="meet-banner">
                                <div class="tag">CONTACT</div>
                                <div class="name">David Strosszi</div>
                                <a href="mailto:mailto:david.strosszi@gmail.com" class="email">david.strosszi@gmail.com</a>
                            </div>
                        </div>

                    </div>
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