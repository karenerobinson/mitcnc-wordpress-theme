<?php
    /* Template Name: Blogs Page */
    get_header();

    	global $assets_uri, $blogs_page_id;
 
        $blogs = get_blogs();
  

?>
    	<article class="blog-area">
    		<div class="container">
    			<div class="row">
    				<div class="col-sm-20 ">
    					<div class="row mt50">
                            <?php if($blogs != null){ ?>
                                <div class="col-sm-24">
                                    <h3 class="bordered heading_1">Blogs</h3>
                                </div>
                                <div class="col-sm-24">
                                    <ul class="blogs-list">
                                        <?php foreach ($blogs as $blog){ ?>
                                            <li class="simple-box">
                                                <a href="<?php echo get_permalink($blog->ID); ?>">
                                                    <span class="date"><?php echo date('D, M d, Y', strtotime($blog->post_date)); ?></span>
                                                    <h5><?php echo $blog->post_title; ?></h5>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                  <!--   <a href="<?php echo get_permalink($blogs_page_id); ?>" class="view-btn gray">See All Blogs <img src="<?php echo $assets_uri; ?>/images/arrow_right_gray.svg" alt=""></a> -->
                                </div>
                           <?php } ?>
    					</div>
    				</div>
    			</div>
    		</div>
    	</article>

  <?php get_footer(); ?>