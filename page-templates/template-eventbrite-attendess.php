<?php
    /* Template Name: Eventbrite Attendess */
    wp_head();
    global $eventbrite_token,$eventbrite_event_id,$wp;

if (isset($_REQUEST['fetch'])) :
        $ppage_number = 1;
        $ppage_count  = 10;
        $has_more_items = true;
        $total_record = 0;
        $total_insert_record = 0;


    for ($ppage = 1; $ppage <= $ppage_count; $ppage++) {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
            CURLOPT_URL => "https://www.eventbriteapi.com/v3/events/{$eventbrite_event_id}/attendees/?page=" . $ppage,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer {$eventbrite_token}",
            'Cookie: mgrefby=; G=v%3D2%26i%3D7bb524f2-6c38-4845-a664-f38a46c61a82%26a%3Dd1a%26s%3Db13df43397a918a5f9402f7101b288ca1b9dc4b4; SS=AE3DLHQMxx9-ocVhRyMdiEcEy8I43t44mA; eblang=lo%3Den_US%26la%3Den-us; AS=70ecc0d8-6e53-4965-bcd7-9052cad62ad6; mgref=typeins; SP=AGQgbbng1M84QrmqJB3YtVwz6Ganrf-kcVgXAEAkU_tVt0yZym9-oNQZSvp-bs8AVeRVDNS8J00UeJnVz-020fJlFvctk_JFPi3LtRtsIGwQziK4TQfWwCC1tK7JYKHPi8Opc8HazVZpZ3SLK-6Lh1rdwOTSTG-7BqM0jsHNH6D249qNdDIZIfZn1_K--zyKmeTjoxUQEII5trSqhvrmTmRxsn-5_Y8sSy5oBgZDDOH8lm86jGx_Fek'
                ),
            )
        );
    
        $response = curl_exec($curl);
        curl_close($curl);
                
        if (!empty($response)) {
            $result = json_decode($response);
            if (!empty($result) && isset($result->attendees) && count($result->attendees) > 0) {
                if (isset($result->pagination)) {
                    $ppage_count = $result->pagination->page_count;
                    $total_record = $total_record + $result->pagination->page_size;
                }
    
                foreach ($result->attendees as $key => $attendee) {
                    if (isset($attendee->profile)) {
                        if (isset($attendee->profile->email) && !empty($attendee->profile->email)) {
                                $table_name = $wpdb->base_prefix . 'be_attendees';
                                $query = $wpdb->prepare('SHOW TABLES LIKE %s', $wpdb->esc_like($table_name));
                            if (!$wpdb->get_var($query) == $table_name) {
                                // go go
                                $sql  = "CREATE TABLE {$table_name}(
                                                id INT(20) AUTO_INCREMENT,
                                                email VARCHAR(255),
                                                name VARCHAR(255),
                                                ticket_class_id VARCHAR(255),
                                                ticket_class_name VARCHAR(255),
                                                event_id VARCHAR(255),
                                                status INT(20) DEFAULT 0,
                                                order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                                PRIMARY KEY(id))";
                                if (!function_exists('dbDelta')) {
                                    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                                }

                                dbDelta($sql);
                                echo 'Tables created...';
    
                                $my_part_ID = $wpdb->get_var(
                                    $wpdb->prepare(
                                        'SELECT id FROM ' . $table_name . ' WHERE email = %s AND event_id = %s AND ticket_class_id = %s LIMIT 1',
                                        $attendee->profile->email,
                                        $eventbrite_event_id,
                                        $attendee->ticket_class_id
                                    )
                                );
        
                                if ($my_part_ID > 0) {
                                    $total_insert_record++;
                                } else {
                                    $result = $wpdb->insert(
                                        $table_name,
                                        array(
                                                'name' => $attendee->profile->name,
                                                'email' => $attendee->profile->email,
                                                'event_id' => $eventbrite_event_id,
                                                'ticket_class_id' => $attendee->ticket_class_id,
                                                'ticket_class_name' => $attendee->ticket_class_name
                                            )
                                    );
                                        $total_insert_record++;
                                }
                            } else {
                                $my_part_ID = $wpdb->get_var(
                                    $wpdb->prepare(
                                        'SELECT id FROM ' . $table_name . ' WHERE email = %s AND event_id = %s AND ticket_class_id = %s LIMIT 1',
                                        $attendee->profile->email,
                                        $eventbrite_event_id,
                                        $attendee->ticket_class_id
                                    )
                                );
    
                                if ($my_part_ID > 0) {
                                    $total_insert_record++;
                                } else {
                                    $result = $wpdb->insert(
                                        $table_name,
                                        array(
                                                'name' => $attendee->profile->name,
                                                'email' => $attendee->profile->email,
                                                'event_id' => $eventbrite_event_id,
                                                'ticket_class_id' => $attendee->ticket_class_id,
                                                'ticket_class_name' => $attendee->ticket_class_name
                                            )
                                    );
                                        $total_insert_record++;
                                }
                            }
                        }
                    }
                }
                        

                $TotalRecords  = $wpdb->get_results(
                    'SELECT distinct ticket_class_name FROM ' . $table_name
                );
                    $event_field_key = 'field_5f08df647dc3a';
                    $tickets = array();
                if (is_array($TotalRecords) && !empty($TotalRecords) && count($TotalRecords) > 0) {
                    foreach ($TotalRecords as $record) {
                            $record->ticket_class_name;
                            array_push($tickets, array('ticket_class_name' => $record->ticket_class_name));
                    }
                }

                    $agenda_terms = get_terms(
                        array(
                            'taxonomy' => 'events-agenda-dates',
                            'hide_empty' => true,
                        )
                    );

                if (is_array($agenda_terms) && !empty($agenda_terms) && count($agenda_terms) > 0) {
                    foreach ($agenda_terms as $agenda_term) {
                            update_field($event_field_key, $tickets, 'events-agenda-dates_' . $agenda_term->term_id);
                    }
                }
            }
        }
    }

        $date = date('m/d/Y h:i:s a', time());
        echo 'Total Pages : ' . esc_html($ppage) . ' Total Inserted Record : ' . esc_html($total_insert_record) . ' Time Stamp : ' . esc_html($date);
endif;
