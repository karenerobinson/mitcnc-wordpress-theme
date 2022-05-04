<?php
    global $assets_uri, $contact_persons, $user_profile_page_id, $post, $contact_persons_ids;

    if($contact_persons != null){
        if(empty($contact_persons_ids)){
            $contact_persons_ids = [];
            foreach ($contact_persons as $contact_person) {
                $contact_persons_ids[] = $contact_person;
            }
            $contact_persons_ids = implode(',', $contact_persons_ids);
        }
        foreach ($contact_persons as $contact_person) {
            $contact_person_details = get_userdata( $contact_person );
            $contact_person_img = get_field('profile_image', 'user_'.$contact_person);
            $contact_person_img = !empty($contact_person_img) ? $contact_person_img : $assets_uri.'/images/placeholder.png';
            $contact_person_mit_status = is_mit_alum($contact_person);
            $contact_person_first_name = get_field('full_name', 'user_'.$contact_person);
            $contact_person_last_name = get_field('user_last_name', 'user_'.$contact_person);
            $designations = [];
            if (have_rows('designations', 'user_'.$contact_person)) {
                while (have_rows('designations', 'user_'.$contact_person)) {
                    the_row();
                    $designations[] = get_sub_field('designation_title', 'user_'.$contact_person);
                }
            }
            $teams = get_field('teams', 'user_'.$contact_person);
            $affiliations_mit = $affiliations_other = [];
            $affiliations = get_field('affiliations', 'user_'.$contact_person);
            if($affiliations){
                foreach ($affiliations as $affiliation){
                    if($affiliation != null){
                        for ($i = 0; $i < count($affiliation); $i++){
                            if(isset($affiliation[$i]['mit_affiliation_title'])){
                                $affiliations_mit[] = $affiliation[$i]['mit_affiliation_title'];
                            } else if(isset($affiliation[$i]['other_affiliation_title'])){
                                $affiliations_other[] = $affiliation[$i]['other_affiliation_title'];
                            }

                        }
                    }
                }
            }
            $contact_person_facebook = get_field('facebook', 'user_' . $contact_person);
            $contact_person_twitter = get_field('twitter', 'user_' . $contact_person);
            $contact_person_linkedin = get_field('linkedin', 'user_' . $contact_person);
            ?>
            <div class="col-sm-6">
                <div class="contact-person-image">
                    <img src="<?php echo $contact_person_img; ?>" alt="">
                    <?php if($contact_person_mit_status){ ?>
                        <div class="mit-icon">
                            <img src="<?php echo $assets_uri; ?>/images/mit-icon.svg" alt="">
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-18">
                <div class="contact-person-info">
                    <h3><?php echo $contact_person_first_name.' '.$contact_person_last_name; ?> <span><?php echo ($affiliations_mit != null) ? implode(', ', $affiliations_mit) : ''; ?></span></h3>
                    <?php if(have_rows('positions', 'user_'.$contact_person)){ ?>
                        <div class="company-name <?php echo (empty($contact_person_facebook) && empty($contact_person_twitter) && empty($contact_person_linkedin) && 0) ? 'no-border' : ''; ?>">
                            <?php
                            if (have_rows('positions', 'user_'.$contact_person)) {
                                while (have_rows('positions', 'user_'.$contact_person)) {
                                    the_row();
                                    ?>
                                    <h5><?php the_sub_field('company', 'user_'.$contact_person); ?>
                                        <span><?php the_sub_field('job_title', 'user_'.$contact_person); ?></span>
                                    </h5>
                                    <?php
                                    break;
                                }
                            }
                            ?>

                        </div>
                    <?php } ?>
                    <div class="seperater"></div>
                    <a href="mailto:<?php echo $contact_person_details->user_email; ?>" class="contact-me"><img src="<?php echo $assets_uri; ?>/images/black-envelope.svg" alt="">Contact me</a>
                    <ul class="contact-social">
                        <?php if(!empty($contact_person_facebook)){ ?>
                            <li>
                                <a href="<?php echo $contact_person_facebook; ?>" target="_blank">
                                    <img src="<?php echo $assets_uri; ?>/images/fb.svg" width="13" alt="">
                                </a>
                            </li>
                        <?php } if(!empty($contact_person_twitter)){ ?>
                            <li>
                                <a href="<?php echo $contact_person_twitter; ?>" target="_blank">
                                    <img src="<?php echo $assets_uri; ?>/images/tw.svg" width="13" alt="">
                                </a>
                            </li>
                        <?php } if(!empty($contact_person_linkedin)){?>
                            <li>
                                <a href="<?php echo $contact_person_linkedin; ?>" target="_blank">
                                    <img src="<?php echo $assets_uri; ?>/images/in.svg" width="11" alt="">
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php
        }
    }
?>