<?php
    if(!is_user_logged_in()){
        if (strpos($_SERVER["HTTP_USER_AGENT"], "faceb") !== false) {} else{
            wp_redirect(home_url('login'));
            exit;
        }
    }
    get_header();
    global $assets_uri, $post;
?>
    <section>
        <article class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <?php get_breadcrumb(); ?>
                    </div>
                    <div class="col-sm-17">
                        <div class="row mb15">
                            <div class="col-sm-24">
                                <h1 class="heading_8">Brain Teaser</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-24">
                                <?php echo do_shortcode(wpautop($post->post_content)); ?>
                            </div>
                            <div class="col-sm-24 mt40 mb40">
                                <?php if(!is_user_logged_in()){ ?>
                                    <a href="<?php echo home_url('login'); ?>" class="default-btn  red-btn ">Login for Answer <img src=" <?php echo $assets_uri; ?>/images/arrow_right_white.svg" alt=""></a>
                                <?php } else{ ?>
                                    <a href="javascript:void(0)" class="default-btn  red-btn show-answer">Show Answer <img src=" <?php echo $assets_uri; ?>/images/arrow_right_white.svg" alt=""></a>
                                <?php } ?>

                            </div>
                        </div>

                        <?php if(is_user_logged_in()){ ?>
                            <div class="answer-box">
                                    <?php echo get_field('answer_box', $post->ID)?>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-sm-24">
                                <ul class="ans-list ">
                                    <li>
                                        <span>Problem by<span>
                                        <span class="name"><?php echo get_field('problem_by', $post->ID)?></span>
                                    </li>
                                    <li>
                                        <span>Solution by<span>
                                        <span class="name"> <?php echo get_field('solution_by', $post->ID)?></span>
                                    </li>

                                    <li>
                                         <span class="ques-power">Powered by</span>
                                         <img src="<?php echo get_field('powered_by', $post->ID)?>" />
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-24">
                               

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </section>
<?php get_footer(); ?>