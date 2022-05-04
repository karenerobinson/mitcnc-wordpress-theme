<?php global $post; ?>
<div class="col-lg-24 col-md-10 col-sm-24 text-right yearly-events">
    
    <ul>
        <li class="<?php echo ( 5470 || 6019 == $post->ID ) ? 'active' : ''; ?>">
            <a href="<?php bloginfo('url'); ?>/events/mit-ai-conference-2020/">2020</a>
        </li>
        <li class="<?php echo ( 2501 == $post->ID ) ? 'active' : ''; ?>">
            <a href="<?php bloginfo('url'); ?>/events/mit-ai-conference-2019/">2019</a>
        </li>
        <li class="<?php echo ( 2576 == $post->ID ) ? 'active' : ''; ?>">
            <a href="<?php bloginfo('url'); ?>/events/mit-ai-conference-2018/">2018</a>
        </li>
        <li class="<?php echo ( 1955 == $post->ID ) ? 'active' : ''; ?>">
            <a href="<?php bloginfo('url'); ?>/events/mit-ai-conference-2017/">2017</a>
        </li>
    </ul>
</div>
