<?php
    global $newletter_post_type, $newsletter_type_taxonomy;
    $post_types_list = [
        [
            'label' => 'Event Agenda',
            'label_plural' => 'Events Agenda',
            'slug' => 'events-agenda',
            'menu_icon' => 'dashicons-calendar',
            'supports' => ['title'],
            'rewrite' => ['hierarchical' => true],
            'taxonomy' => [
                'label' => 'Agenda Year',
                'label_plural' => 'Agenda Years',
                'slug' => 'events-agenda-years',
                'post_type' => 'events-agenda',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'taxonomy' => [
                'label' => 'Agenda Date',
                'label_plural' => 'Agenda Date',
                'slug' => 'events-agenda-dates',
                'post_type' => 'events-agenda',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'label' => 'Event',
            'label_plural' => 'Events',
            'slug' => 'events',
            'menu_icon' => 'dashicons-calendar',
            'supports' => ['title', 'thumbnail', 'editor'],
            'rewrite' => ['hierarchical' => true],
            'taxonomy' => [
                'label' => 'Events Category',
                'label_plural' => 'Event Categories',
                'slug' => 'event-cat',
                'post_type' => 'events',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'taxonomy' => [
                'label' => 'Events Location',
                'label_plural' => 'Event Locations',
                'slug' => 'event-locations',
                'post_type' => 'events',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'taxonomy' => [
                'label' => 'Events Program',
                'label_plural' => 'Event Programs',
                'slug' => 'event-programs',
                'post_type' => 'events',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'taxonomy' => [
                'label' => 'Events Audience',
                'label_plural' => 'Event Audience',
                'slug' => 'event-audience',
                'post_type' => 'events',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'taxonomy' => [
                'label' => 'Event Access Type',
                'label_plural' => 'Event Access Types',
                'slug' => 'event-access-types',
                'post_type' => 'events',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'taxonomy' => [
                'label' => 'Event Topic',
                'label_plural' => 'Event Topics',
                'slug' => 'event-topics',
                'post_type' => 'events',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'label' => 'Media Gallery',
            'label_plural' => 'Media Gallery',
            'slug' => 'media-gallery',
            'menu_icon' => 'dashicons-format-gallery',
            'supports' => ['title', 'editor'],
            'rewrite' => ['hierarchical' => true],
            'taxonomy' => [
                'label' => 'Media Gallery Category',
                'label_plural' => 'Media Gallery Categories',
                'slug' => 'media-gallery-cat',
                'post_type' => 'media-gallery',
                'rewrite' => ['hierarchical' => true],
            ]
        ],
        [
            'label' => 'Brass Rat',
            'label_plural' => 'Brass Rats',
            'slug' => 'brass-rats',
            'menu_icon' => 'dashicons-smiley',
            'supports' => ['title', 'thumbnail'],
            'rewrite' => ['hierarchical' => true]
        ],
        [
            'label' => 'Puzzle',
            'label_plural' => 'Puzzles',
            'slug' => 'puzzles',
            'menu_icon' => 'dashicons-layout',
            'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
            'rewrite' => ['hierarchical' => true]
        ],
        [
            'label' => 'Puzzle Snacks',
            'label_plural' => 'Puzzle Snacks',
            'slug' => 'puzzle-snacks',
            'menu_icon' => 'dashicons-layout',
            'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
            'rewrite' => ['hierarchical' => true, 'slug' => 'puzzlesnacks']
        ],
        [
            'label' => 'Newsletter - Event',
            'label_plural' => 'Newsletter - Event',
            'slug' => 'newsletter-single',
            'menu_icon' => 'dashicons-media-document',
            'supports' => ['title'],
            'rewrite' => ['hierarchical' => true]
        ],
        [
            'label' => 'Beaver Bulletin',
            'label_plural' => 'Beaver Bulletins',
            'slug' => 'newsletter-beaver',
            'menu_icon' => 'dashicons-media-document',
            'supports' => ['title'],
            'rewrite' => ['hierarchical' => true]
        ],
        [
            'label' => 'Weekly Event',
            'label_plural' => 'Weekly Events',
            'slug' => 'newsletter-upcoming',
            'menu_icon' => 'dashicons-media-document',
            'supports' => ['title'],
            'rewrite' => ['hierarchical' => true]
        ],
        [
            'label' => 'Event reminder',
            'label_plural' => 'Event reminder',
            'slug' => 'event-reminder',
            'menu_icon' => 'dashicons-media-document',
            'supports' => ['title'],
            'rewrite' => ['hierarchical' => true]
        ]
    ];
    execCustomPostTypeAndTaxonomy($post_types_list);

    function acf_load_moderators_list_field_choices( $field ) {
        $field['choices'] = array();
        $speakers = get_users_by_type('speakers', '', false);
        if( $speakers != null ) {
            foreach( $speakers as $speaker ) {
                $speaker_first_name = get_field('full_name', 'user_'.$speaker->ID);
                $speaker_last_name = get_field('user_last_name', 'user_'.$speaker->ID);
                $field['choices'][$speaker->ID] = $speaker_first_name.' '.$speaker_last_name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=moderators_list', 'acf_load_moderators_list_field_choices');
    function acf_load_organizers_list_field_choices( $field ) {
        if(isset($_REQUEST['taxonomy']) && isset($_REQUEST['tag_ID']) && $_REQUEST['taxonomy'] == 'event-programs'){
            $program = $_REQUEST['tag_ID'];
        } else{
            $program = '';
        }
        $field['choices'] = array();
        $speakers = get_users_by_type('speakers', '', false, $program);
        if( $speakers != null ) {
            foreach( $speakers as $speaker ) {
                $speaker_first_name = get_field('full_name', 'user_'.$speaker->ID);
                $speaker_last_name = get_field('user_last_name', 'user_'.$speaker->ID);
                $field['choices'][$speaker->ID] = $speaker_first_name.' '.$speaker_last_name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=organizers_list', 'acf_load_organizers_list_field_choices');
    function acf_load_speakers_list_field_choices( $field ) {
        if(isset($_REQUEST['taxonomy']) && isset($_REQUEST['tag_ID']) && $_REQUEST['taxonomy'] == 'event-programs'){
            $program = $_REQUEST['tag_ID'];
        } else{
            $program = '';
        }
        $field['choices'] = array();
        $speakers = get_users_by_type('speakers', '', false, $program);
        if( $speakers != null ) {
            foreach( $speakers as $speaker ) {
                $speaker_first_name = get_field('full_name', 'user_'.$speaker->ID);
                $speaker_last_name = get_field('user_last_name', 'user_'.$speaker->ID);
                $field['choices'][$speaker->ID] = $speaker_first_name.' '.$speaker_last_name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=speakers_list', 'acf_load_speakers_list_field_choices');
    add_filter('acf/load_field/name=speakers_list_2', 'acf_load_speakers_list_field_choices');

    function acf_load_team_list_field_choices( $field ) {
        if(isset($_REQUEST['taxonomy']) && isset($_REQUEST['tag_ID']) && $_REQUEST['taxonomy'] == 'event-programs'){
            $program = $_REQUEST['tag_ID'];
        } else{
            $program = '';
        }
        $field['choices'] = array();
        $leadership = get_users_by_type('leadership_team', '', false, $program);
        if( $leadership != null ) {
            foreach( $leadership as $leader ) {
                $leader_first_name = get_field('full_name', 'user_'.$leader->ID);
                $leader_last_name = get_field('user_last_name', 'user_'.$leader->ID);
                $field['choices'][$leader->ID] = $leader_first_name.' '.$leader_last_name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=team_list', 'acf_load_team_list_field_choices');
    
    function acf_load_awards_team_list_field_choices( $field ) {
        if(isset($_REQUEST['taxonomy']) && isset($_REQUEST['tag_ID']) && $_REQUEST['taxonomy'] == 'event-programs'){
            $program = $_REQUEST['tag_ID'];
        } else{
            $program = '';
        }
        $field['choices'] = array();
        $leadership = get_users_by_type('awards', '', false, $program);
        if( $leadership != null ) {
            foreach( $leadership as $leader ) {
                $leader_first_name = get_field('full_name', 'user_'.$leader->ID);
                $leader_last_name = get_field('user_last_name', 'user_'.$leader->ID);
                $field['choices'][$leader->ID] = $leader_first_name.' '.$leader_last_name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=awards_team_list', 'acf_load_awards_team_list_field_choices');

    function acf_load_directors_list_field_choices( $field ) {
        $field['choices'] = array();
        $board_of_directors = get_users_by_type('board_of_directors', '', false);
        if( $board_of_directors != null ) {
            foreach( $board_of_directors as $director ) {
                $director_first_name = get_field('full_name', 'user_'.$director->ID);
                $director_last_name = get_field('user_last_name', 'user_'.$director->ID);
                $field['choices'][$director->ID] = $director_first_name.' '.$director_last_name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=directors_list', 'acf_load_directors_list_field_choices');

    function acf_load_volunteer_list_field_choices( $field ) {
        $field['choices'] = array();
        $volunteer_spotlight = get_users_by_type('volunteer_spotlight', '', false);
        if( $volunteer_spotlight != null ) {
            foreach( $volunteer_spotlight as $volunteer ) {
                $volunteer_first_name = get_field('full_name', 'user_'.$volunteer->ID);
                $volunteer_last_name = get_field('user_last_name', 'user_'.$volunteer->ID);
                $field['choices'][$volunteer->ID] = $volunteer_first_name.' '.$volunteer_last_name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=volunteer_list', 'acf_load_volunteer_list_field_choices');

    function acf_load_contact_persons_field_choices( $field ) {
        if(isset($_REQUEST['taxonomy']) && isset($_REQUEST['tag_ID']) && $_REQUEST['taxonomy'] == 'event-programs'){
            $program = $_REQUEST['tag_ID'];
        } else{
            $program = '';
        }
        $field['choices'] = array();
        $speakers = get_users_by_type('speakers', '', false, $program);
        $leadership = get_users_by_type('leadership_team', '', false, $program);
        $bod = get_users_by_type('board_of_directors', '', false, $program);
        if( $speakers != null ) {
            foreach( $speakers as $speaker ) {
                $speaker_first_name = get_field('full_name', 'user_'.$speaker->ID);
                $speaker_last_name = get_field('user_last_name', 'user_'.$speaker->ID);
                $field['choices'][$speaker->ID] = $speaker_first_name.' '.$speaker_last_name;
            }
        }
        if( $leadership != null ) {
            foreach( $leadership as $speaker ) {
                $speaker_first_name = get_field('full_name', 'user_'.$speaker->ID);
                $speaker_last_name = get_field('user_last_name', 'user_'.$speaker->ID);
                $field['choices'][$speaker->ID] = $speaker_first_name.' '.$speaker_last_name;
            }
        }
        if( $bod != null ) {
            foreach( $bod as $speaker ) {
                $speaker_first_name = get_field('full_name', 'user_'.$speaker->ID);
                $speaker_last_name = get_field('user_last_name', 'user_'.$speaker->ID);
                $field['choices'][$speaker->ID] = $speaker_first_name.' '.$speaker_last_name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=contact_persons', 'acf_load_contact_persons_field_choices');

    function acf_load_media_gallery_field_choices( $field ) {
        $field['choices'] = array();
        $media_gallery = get_posts([
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'post_type' => 'media-gallery',
            'orderby' => 'title',
            'order' => 'ASC'
        ]);
        if( $media_gallery != null ) {
            foreach( $media_gallery as $gallery ) {
                $field['choices'][$gallery->ID] = $gallery->post_title;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=media_gallery', 'acf_load_media_gallery_field_choices');

    function acf_load_programs_list_field_choices( $field ) {
        global $event_program_taxonomy;
        $field['choices'] = array();
        $programs = get_terms($event_program_taxonomy, ['hide_empty' => false]);
        if( $programs != null ) {
            foreach( $programs as $program ) {
                $field['choices'][$program->term_id] = $program->name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=programs_list', 'acf_load_programs_list_field_choices');

    function parse_event_list($events, $post){
        global $post, 
            $newletter_post_type, 
            $event_location_taxonomy, 
            $newsletter_post_type_single_event, 
            $newsletter_post_type_beaver_bulletin, 
            $newsletter_post_type_upcoming_events, 
            $newsletter_post_type_event_reminder;
        $arr = [];
        if( $events != null ) {
            foreach( $events as $event ) {
                if(
                    isset($post->post_type) && 
                    in_array(
                        $post->post_type, [
                            $newletter_post_type, 
                            $newsletter_post_type_single_event, 
                            $newsletter_post_type_beaver_bulletin, 
                            $newsletter_post_type_upcoming_events,
                            $newsletter_post_type_event_reminder
                        ]
                    ) 
                ){
                    $loc = wp_get_post_terms($event->ID, $event_location_taxonomy, ['fields' => 'names']);
                    $loc = isset($loc[0]) ? implode(', ', $loc) : '';
                    $arr[$event->ID] = '<span style="padding: 10px; display: inline-block;">
                        <b style="display: block;">'.strip_tags($event->post_title).'</b>
                        <span style="display: block;">
                            '.date('l, F j, Y', strtotime(get_field('date_time_date_time_start', $event->ID))).' -  
                            '.date('g:i A', strtotime(get_field('date_time_date_time_start', $event->ID))).'
                            '.(!empty($loc) ? ' | ' : '').$loc.'
                        </span>
                    </span>';
                } else{
                    $arr[$event->ID] = strip_tags($event->post_title);
                }
            }
        }
        return $arr;
    }

    function acf_load_event_list_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events();
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=event_list', 'acf_load_event_list_field_choices');

    function acf_load_featured_event_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events();
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=featured_event', 'acf_load_featured_event_field_choices');

    function acf_load_member_event_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events(-1, null, null, null, null, false, null, null, null, false, [77]);
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=member_event', 'acf_load_member_event_field_choices');

    function acf_load_event_list_bay_area_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events(-1, null, [72]);
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=event_list_bay_area', 'acf_load_event_list_bay_area_field_choices');
    function acf_load_event_list_east_bay_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events(-1, null, [39]);
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=event_list_east_bay', 'acf_load_event_list_east_bay_field_choices');
    function acf_load_event_list_north_bay_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events(-1, null, [36]);
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=event_list_north_bay', 'acf_load_event_list_north_bay_field_choices');
    function acf_load_event_list_peninsula_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events(-1, null, [37]);
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=event_list_peninsula', 'acf_load_event_list_peninsula_field_choices');
    function acf_load_event_list_sacramento_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events(-1, null, [70]);
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=event_list_sacramento', 'acf_load_event_list_sacramento_field_choices');
    function acf_load_event_list_san_francisco_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events(-1, null, [57]);
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=event_list_san_francisco', 'acf_load_event_list_san_francisco_field_choices');
    function acf_load_event_list_south_bay_field_choices( $field ) {
        global $post;
        $field['choices'] = array();
        $events = get_events(-1, null, [38]);
        $field['choices'] = parse_event_list($events, $post);
        return $field;
    }
    add_filter('acf/load_field/name=event_list_south_bay', 'acf_load_event_list_south_bay_field_choices');

    function acf_load_brass_rats_field_choices( $field ) {
    $field['choices'] = array();
        $events = get_posts([
            'post_type' => 'brass-rats',
            'post_status' => ['publish', 'draft'],
            'post_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        ]);
        if( $events != null ) {
            foreach( $events as $event ) {
                $field['choices'][$event->ID] = $event->post_title;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=brass_rats', 'acf_load_brass_rats_field_choices');

    function acf_load_puzzles_field_choices( $field ) {
        $field['choices'] = array();
        $events = get_posts([
            'post_type' => 'puzzles',
            'post_status' => ['publish', 'draft'],
            'post_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        ]);
        if( $events != null ) {
            foreach( $events as $event ) {
                $field['choices'][$event->ID] = $event->post_title;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=puzzles', 'acf_load_puzzles_field_choices');

    function acf_load_color_list_field_choices( $field ) {
        $field['choices'] = array(
            '#a41931' => 'Red',
            '#f88a00' => 'Orange'
        );

        return $field; ?>
    <?php
    }
    add_filter('acf/load_field/name=color_list', 'acf_load_color_list_field_choices');

    function acf_load_event_location_list_field_choices( $field ) {
        global $event_location_taxonomy;
        $field['choices'] = array();
        $programs = get_terms($event_location_taxonomy, ['hide_empty' => false]);
        if( $programs != null ) {
            foreach( $programs as $program ) {
                $field['choices'][$program->term_id] = $program->name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=event_location_list', 'acf_load_event_location_list_field_choices');

    function acf_load_event_topics_field_choices( $field ) {
        global $event_topics_taxonomy;
        $field['choices'] = array();
        $programs = get_terms($event_topics_taxonomy, ['hide_empty' => false]);
        if( $programs != null ) {
            foreach( $programs as $program ) {
                $field['choices'][$program->term_id] = $program->name;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=event_topics', 'acf_load_event_topics_field_choices');

    add_filter( 'manage_users_columns', 'rudr_modify_user_table' );
    function rudr_modify_user_table( $columns ) {
        $columns['who_is_this_from'] = 'Who is this from?';
        return $columns;
    }
    add_filter( 'manage_users_custom_column', 'rudr_modify_user_table_row', 10, 3 );
    function rudr_modify_user_table_row( $row_output, $column_id_attr, $user ) {
        switch ( $column_id_attr ) {
            case 'who_is_this_from' :
                $who = get_field('who_is_this_from', 'user_'.$user);
                return (is_array($who) && $who != null) ? implode(', ', $who) : '--';
                break;
            default:
        }
        return $row_output;
    }
    add_filter('acf/load_field/name=featured_speakers_list', 'acf_load_speakers_list_field_choices');


    add_filter( 'manage_events_posts_columns', 'set_custom_edit_events_columns' );
    function set_custom_edit_events_columns( $columns ) {
        unset( $columns['date'] );
        $columns['event_start_date'] = 'Event Date';
        return $columns;
    }
    add_action( 'manage_events_posts_custom_column' , 'custom_events_column', 10, 2 );
    function custom_events_column( $column, $post_id ) {
        switch ( $column ) {
            case 'event_start_date' :
                echo date('D, M j Y', strtotime(get_field( 'date_time_date_time_start', $post_id )));
                break;

        }
    }
    add_filter( 'manage_edit-events_sortable_columns', 'set_custom_events_sortable_columns' );
    function set_custom_events_sortable_columns( $columns ) {
        $columns['event_start_date'] = 'event_start_date';
        return $columns;
    }
    add_action( 'pre_get_posts', 'mycpt_custom_orderby' );
    function mycpt_custom_orderby( $query ) {
        if ( ! is_admin() )
            return;

        $post_type = $query->get('post_type');
        if($post_type == 'events'){
            $orderby = $query->get( 'orderby');
            $orderby = (isset($_REQUEST['orderby']) ? $orderby : 'event_start_date');
            $order = $query->get( 'order');
            $order = (isset($_REQUEST['order']) ? $order : 'DESC');
            if ( 'event_start_date' == $orderby ) {
                $query->set( 'meta_key', 'date_time_date_time_start' );
                $query->set( 'orderby', 'meta_value' );
                $query->set( 'order', $order );
            }
        }
    }

    function klf_acf_colors_admin_footer(){
        global $screen,$key;
        $screen = get_current_screen();
        if ($screen->post_type == 'events' ) {
            ?>
            <script type="text/javascript">
                (function ($) {
                    $('.iris-picker-inner').css({'display': 'none'});
                    $('.iris-border').css({'width': 'auto', 'height': '15px','padding-bottom':'45px','display':'block'});
                    $('.wp-picker-input-wrap.hidden').css({'display':'inline-block'});
                    $('.iris-palette-container a').css({'width':'40px','height':'40px'});
                    acf.add_filter('color_picker_args', function (args, $field) {
                        args.palettes = [
                            // these are the old colors which can be used in future
                            /* '#8fbcbb', '#88c0d0', '#81a1c1', '#5e81ac',
                            '#bf616a', '#d08770', '#ebcb8b', '#a3be8c', '#b48ead',
                            '#ff7058' */
                            '#57CEDE', '#FFB46D', '#80A5FB', '#F59C71', '#FFB303',
                            '#EEC26B', '#BD76DC', '#00B9FF', '#4FD964', '#767C88'
                        ];
                        return args;
                    });
                } )(jQuery);
            </script>
            <?php
        }
    }
    add_action('acf/input/admin_head', 'klf_acf_colors_admin_footer');

    function newsletter_taxonomy_radio_buttons( $args ) {
        global $newsletter_type_taxonomy;
        if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === $newsletter_type_taxonomy) {
            if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
                if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                    class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                        function walk( $elements, $max_depth, $args = array() ) {
                            $output = parent::walk( $elements, $max_depth, $args );
                            $output = str_replace(
                                array( 'type="checkbox"', "type='checkbox'" ),
                                array( 'type="radio"', "type='radio'" ),
                                $output
                            );
                            return $output;
                        }
                    }
                }
                $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
            }
        }
        return $args;
    }
    add_filter( 'wp_terms_checklist_args', 'newsletter_taxonomy_radio_buttons' );

    function wpb_widgets_init() {
        register_widget( 'my_plain_text_widget' );
        register_sidebar( array(
            'name'          => 'Exclude See All Event Button for Pages',
            'id'            => 'event_see_all_exclude_for',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => '',
        ) );
    }
    add_action( 'widgets_init', 'wpb_widgets_init' );

    // creating custom widget for plain text
    class my_plain_text_widget extends WP_Widget {
    
        function __construct() {
            parent::__construct(
                'my_plain_text_widget', 
                __('Plain Text', 'my_plain_text_widget_domain'), 
                array( 'description' => __( 'Simple Text can be written here', 'my_plain_text_widget_domain' ), ) 
            );
        }
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            echo $args['before_widget'];
            if ( ! empty( $title ) )
                echo $args['before_title'] . $title . $args['after_title'];

            echo __( '', 'my_plain_text_widget_domain' );
            echo $args['after_widget'];
        }
        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
                $title = __( '', 'my_plain_text_widget_domain' );
            }
            ?>
                <p>
                    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( '' ); ?></label> 
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                </p>
            <?php 
        }
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            return $instance;
        }
    }
