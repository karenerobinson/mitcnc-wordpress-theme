<?php
/*
Template Name: Hardcoded K12 Page
Template Post Type: page, post, program-page
 */
get_header();
?>
<section>
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
            <article class="inner-page">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-24">
                            <?php get_breadcrumb(); ?>
                        </div>
                        <div class="col-sm-17">
                            <h2>Mentoring with MITCNC</h2>
                            Dear MITCNC members:
                            <p>
                                The ongoing pandemic has exposed many unmet
                                needs in our community, one of which is
                                equitable education for all students. The
                                transition to distance and/or hybrid learning
                                in many schools has disproportionately
                                impacted students from low socioeconomic
                                backgrounds. The K12 Track leadership has
                                been searching for ways to facilitate MITCNC
                                members who want to help combat this problem.
                            <p>
                                Through our conversations
                                with <a href="https://www.encorps.org/">Encorps</a>,
                                a non-profit STEM Teachers Program, we have
                                identified Step Up Tutoring as a convenient
                                vehicle for our members to get involved. In
                                particular, Step Up Tutoring has partnered
                                with California schools in need of mentors.
                                You can find more information on Step Up
                                Tutoring's <a href="https://www.stepuptutoring.org/tutor">"So
                                    you want to help?"</a> webpage.
                            <p>
                                We hope you can join us for an information
                                session in late Sept or early Oct, in an
                                evening between 5:00 pm and 6:00 pm. If you
                                are interested in getting involved, please
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSeqCAQFB7ZhK5IkE-vfJxlINJqvldKGooxOYJ28B1_B0z7gug/viewform">
                                    enter your name and email address here
                                </a>.
                                We'll keep you in the loop as we get things scheduled.
                            <p>
                                Katherine and Wilson
                                <br>
                                Co-chairs, K12 Track
                                <br>
                                MITCNC

                        </div>
                    </div>
                </div>
            </article>
            <?php
        endwhile;
    endif;
    ?>
</section>
<?php get_footer(); ?>
    
