<?php
    /* Template Name: Speaker Awards */
    
    get_header();
	global $assets_uri, $post, $user_profile_page_id, $volunteer_spotlight_page_id, $board_of_directors_page_id;
    $is_speaker = $is_leader = $is_director = $is_spotlight = false;
    $team = $featured_team = null;
    $program = (isset($_REQUEST['program'])) ? strip_tags($_REQUEST['program']) : '';
	$featured_team = get_field('awards_team_list', $post->ID);
    $team = get_users_by_type('awards', '', false, $program, false, 'ASC', null, $featured_team);
    $featured_team = is_array($featured_team) ? get_users_by_type('awards', -1, false, $program, false, 'ASC', $featured_team, null) : null;
    $is_speaker = true;
?>

<section>
	<article class="inner-page energy">
		<div class="container">
			<div class="row">
				<div class="col-sm-24">
                    <?php //get_breadcrumb(); ?>
                    <?php echo wpd_nav_menu_breadcrumbs( 'header_main' ); ?>
				</div>
				<div class="col-sm-24">
					<div class="row">
						<div class="col-sm-16">
							<h1><?php echo $post->post_title; ?></h1>
							<?php  echo wpautop($post->post_content); ?>
                        </div>
                        <div class="col-sm-6 offset-sm-1">
                        <?php get_sidebar(); ?> 
                        </div>

					</div>
                    <?php if($post->ID == $leadership_team_page_id){ ?>
                        <div class="row">
                            <div class="col-sm-16">
                                <p>Officers serving during FY 20<?php echo date('y'); ?>/<?php echo ((int)date('y') + 1); ?></p>
                            </div>
					    </div>
                    <?php } ?>
                    <div class="row">
                        <!-- <div class="col-sm-8">
                            <div class="form--search-field-wrapper form-group" style="position: relative;">
                                <i class="fa fa-search" style="position: absolute;top: 10px;left: 10px;"></i>
                                <input class="form--search-field form-control" type="text" value="" placeholder="Search by Name" style="padding-left: 27px;" />
                            </div>
                        </div> -->
                        <div class="col-sm-8">
                            <div class="form--search-field-wrapper form-group" style="position: relative;">
                            <?php $field = get_field_object('field_5daffd8a2c203'); // field key "award" acf users field group ?>
                            <?php if($field && !empty($field)): ?>
                                    <?php if($field['choices'] && !empty($field['choices'])): ?>
                                        <select class="form-control" id="topics">
                                            <!-- <option value='all' >All Awards</option> -->
                                            <?php foreach($field['choices'] as $key => $value): ?>
                                                <option value='<?php echo $value; ?>'><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php $block_content = get_field('block_content',$post->ID); ?>
                        <?php if($block_content && !empty($block_content)): ?>
                            <?php echo $block_content; ?>
                        <?php endif; ?>
                    </div>
                    <div class="row speakers-awards users_list">
                    <?php 
                     if($team != null){
                        
                        foreach ($team as $value){
                            $companies = [];
                            if (have_rows('companies', 'user_'.$value->ID)) {
                                while (have_rows('companies', 'user_'.$value->ID)) {
                                    the_row();
                                    $companies[] = get_sub_field('company_name', 'user_'.$value->ID);
                                }
                            }

                            $designations = [];
                            if (have_rows('designations', 'user_'.$value->ID) && !$is_spotlight && !$is_speaker) {
                                while (have_rows('designations', 'user_'.$value->ID)) {
                                    the_row();
                                    $designations[] = '<span class="tag">'.get_sub_field('designation_title', 'user_'.$value->ID).'</span>';
                                }
                            }
                            $awards = [];
                            // $awards_to_sort = [];
                            if (have_rows('award', 'user_'.$value->ID)) {
                                while (have_rows('award', 'user_'.$value->ID)) {
                                    the_row();
                                    $year = get_sub_field('year', 'user_'.$value->ID);
                                    $award_name = get_sub_field('name', 'user_'.$value->ID);
                                    if($awards != null){
                                        $award_exists = false;
                                        foreach ($awards as $key => $val) {
                                            if ($val['name'] === $award_name) {
                                                $awards[$key]['year'][] = $year;
                                                $award_exists = true;
                                                arsort($awards[$key]['year']);
                                            }
                                        } 
                                        if(!$award_exists){
                                            $awards[] = [
                                                'name' => $award_name,
                                                'year' => [$year]
                                            ];
                                        }
                                    } else{
                                        $awards[] = [
                                            'name' => $award_name,
                                            'year' => [$year]
                                        ];
                                    }

                                    // echo '<pre>'; var_dump(['name'] == $award_name); echo '</pre>';
                                    // $awards[] = [
                                    //     'name' => $award_name,
                                    //     'year' => $year
                                    // ];
                                    // $awards_to_sort[] = ['year' => $year];
                                }
                            }
                            
                            // echo '<pre>'; print_r($awards_to_sort); echo '</pre>';
                            // echo '<pre>'; print_r($awards); echo '</pre>';
                            if ($awards != null){
                                // arsort($awards_to_sort);
                                foreach($awards as $kkk => $award){
                                    $job_title = get_field('job_title', 'user_'.$value->ID);
                                    $member_img = get_field('profile_image', 'user_'.$value->ID);
                                    $member_img = !empty($member_img) ? $member_img : $assets_uri.'/images/placeholder.png';
                                    $member_mit_status = is_mit_alum($value->ID);
                                    $affiliations_mit = $affiliations_other = [];
                                    $affiliations = get_field('affiliations', 'user_'.$value->ID);
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
                                    $member_first_name = get_field('full_name', 'user_'.$value->ID);
                                    $member_last_name = get_field('user_last_name', 'user_'.$value->ID);
                                    $teams =  get_field('teams', 'user_'.$value->ID);
                                    
                                    $speaker_facebook = get_field('facebook', 'user_' . $value->ID);
                                    $speaker_twitter = get_field('twitter', 'user_' . $value->ID);
                                    $speaker_linkedin = get_field('linkedin', 'user_' . $value->ID);
                                    $speaker_link = get_author_posts_url($value->ID);
                                    $awards[$kkk]['year'] = array_values($awards[$kkk]['year']);
                                    ?>
                                     <div class="col-lg-6 col-md-12 awards-section" data-team_member="<?php echo strtolower(str_replace(["'", '  '], ['', ' '], $member_first_name.' '.$member_last_name)); ?>" data-topic="<?php  echo (isset($awards[$kkk]['name']) ? $awards[$kkk]['name'] : ''); ?>" data-years="<?php echo (isset($awards[$kkk]['year'][0]) ? $awards[$kkk]['year'][0] : ''); // echo (isset($awards[$kkk]['year']) ? implode(', ', $awards[$kkk]['year']) : ''); ?>" style="display: none;">
                                         <div class="speaker-card">
                                             <a href="<?php echo (!$is_director && !$is_leader) ?  $speaker_link : 'javascript:void(0)'; ?>">
                                                 <div class="card-img">
                                                     <img src="<?php echo $member_img; ?>" alt="">
                                                         <?php if($member_mit_status){ ?>
                                                             <div class="icon-mit">
                                                                 <img src="<?php echo $assets_uri; ?>/images/mit-icon.svg" alt="">
                                                             </div>
                                                         <?php } ?>
                                                 </div>
                                                 <div class="card-text">
                                                     <div class="name">
                                                         <h3><?php echo $member_first_name .' ' . $member_last_name; ?> </h3>
                                                         <span class="code"><?php echo ($affiliations_mit != null) ? implode(', ', $affiliations_mit) : ''; ?></span>
                                                     </div>
                                                     <div class="company-name <?php echo (empty($speaker_facebook) && empty($speaker_twitter) && empty($speaker_linkedin) && 0) ? 'no-border' : ''; ?>">
                                                         <h4><?php echo $awards[$kkk]['name']; ?></h4>
                                                         <span><?php echo implode(', ', $awards[$kkk]['year']); ?></span>
                                                                 
                                                     </div>
                                                         <?php if(!empty($speaker_facebook) || !empty($speaker_twitter) || !empty($speaker_linkedin) || ($teams != null && is_array($teams)) ||  $affiliations_other != null || (have_rows('designations', 'user_'.$value->ID) && !$is_spotlight && !$is_speaker)){ ?>

                                                                 <div class="border-dotted"></div>

                                                     <?php } ?>
                                                     <div class="tags-box">
                                                         <?php echo implode('', $designations); ?>
                                                     </div>
                                                     <?php if(!$is_spotlight && !$is_speaker) { ?>

                                                         <div class="team">
                                                             <?php if ($teams != null && is_array($teams)) { ?>
                                                                 <p>Team : <span><?php echo  implode(', ', $teams); ?></span></p>
                                                             <?php } ?>


                                                                 <?php if ($affiliations_other != null) { ?>
                                                             <p>Other Affiliations : <span><?php echo  implode(', ', $affiliations_other); ?></span></p>
                                                             <?php } ?>
                                                         </div>
                                                     <?php } ?>
                                                     <ul class="social-icons">
                                                         <?php if(!empty($speaker_facebook)){ ?>
                                                         <li>
                                                             <a href="<?php echo $speaker_facebook; ?>" target="_blank">
                                                                 <img src="<?php echo $assets_uri; ?>/images/fb.svg" alt="">
                                                             </a>
                                                         </li>
                                                         <?php } if(!empty($speaker_twitter)){ ?>
                                                         <li>
                                                             <a href="<?php echo $speaker_twitter; ?>" target="_blank">
                                                                 <img src="<?php echo $assets_uri; ?>/images/tw.svg" alt="">
                                                             </a>
                                                         </li>
                                                         <?php } if(!empty($speaker_linkedin)){?>
                                                         <li>
                                                             <a href="<?php echo $speaker_linkedin; ?>" target="_blank">
                                                                 <img src="<?php echo $assets_uri; ?>/images/in.svg" alt="">
                                                             </a>
                                                         </li>
                                                         <?php } ?>
                                                     </ul>
                                                 </div>
                                             </a>
                                         </div>
                                     </div>
                                   <?php 
                                }
                                       
                               
                            }
                           
                        }
                    }
                    ?>
                    </div>
				</div>
			</div>
		</div>
	</article>
</section>
<?php get_footer(); ?>