<?php
    /* Template Name: Brass Rats Page */
    get_header();

    	global $assets_uri;
        $brass_rats = get_brass_rats();

?>
<section>
    

    	<article class="brass-rats-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <?php get_breadcrumb(); ?>
                </div>
            </div>
            <?php if($brass_rats != null){ ?>
                <div class="row">
                    <div class="col-sm-24">
                        <h1>MIT Alumni - Brass Rats</h1>
                        <p>Albert and Newton '99 in the Bay Area</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-24">
                            <?php
                                foreach ($brass_rats as $brass_rat){
                                    $brass_rat_img = get_image_by_post_id($brass_rat->ID, 'full');
                                    ?>
                                    <div class="col-sm-24">
                                        <div class="mt15">
                                            <div class="item-brass">
                                                <img src="<?php echo $brass_rat_img; ?>" alt="">
                                                <div class="info">
                                                    <h6><?php echo get_field('author_name', $brass_rat->ID); ?></h6>
                                                    <h4><?php echo $brass_rat->post_title ?></h4>
                                                </div>
                                                <!--<ul>
                                                    <li><a href="#"><img src="<?php /*echo $assets_uri; */?>/images/valentines-heart.svg" alt=""></a></li>

                                                    <li><a href="#"><img src="<?php /*echo $assets_uri; */?>/images/share-symbol.svg" alt=""></a></li>
                                                </ul>-->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                    </div>
                </div>
                    <?php
                }
            ?>
        </div>
    </article>
</section>

  <?php get_footer(); ?>