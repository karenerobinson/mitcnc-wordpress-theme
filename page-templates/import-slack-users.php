<?php

/* Template Name: Import Slack Users */

function drop_slack_users_table()
{
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}slack_users;");
}

function create_slack_users_table()
{
    global $wpdb;
    $wpdb->query(
        "CREATE TABLE {$wpdb->prefix}slack_users (
            ID bigint(20) NOT NULL AUTO_INCREMENT,
            slack_user_id varchar(250) NOT NULL,
            team_id varchar(250) NOT NULL,
            name varchar(250) NOT NULL,
            real_name varchar(250) NOT NULL,
            image_48 varchar(250) NOT NULL,
            PRIMARY KEY (ID)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
    );
}

function get_all_slack_users($cursor = '')
{
    global $slack_host, $slack_users_list_end_point, $users;
    echo 'URL: ' . esc_html("{$slack_host}{$slack_users_list_end_point}" . (!empty($cursor) ? "?cursor={$cursor}" : '')) . '<br><br>';
    $response = slack_custom_curl($slack_host . $slack_users_list_end_point . (!empty($cursor) ? "?cursor={$cursor}" : ''));
    $response = !empty($response) ? json_decode($response) : null;
    if (null != $response && isset($response->members) && null != $response->members) {
        array_push($users, $response->members);
        if (isset($response->response_metadata->next_cursor) && !empty($response->response_metadata->next_cursor)) {
            get_all_slack_users($response->response_metadata->next_cursor);
        }
    }
}

echo 'start on: ' . esc_html(date('Y-m-d H:i:s')) . '<br><br>';

global $wpdb, $slack_host, $slack_users_list_end_point, $users;

drop_slack_users_table();

create_slack_users_table();

$users = array();
get_all_slack_users();
$users = array_merge(...$users);

echo '<br><br> Total Count: ' . count($users) . '<br><br>';

if (null != $users) {
    $insert_init_sql = "
        INSERT INTO {$wpdb->prefix}slack_users (
            slack_user_id,
            team_id,
            name,
            real_name,
            image_48
        ) VALUES 
    ";

    $insert_sql = $insert_init_sql;

    $inserted_counter = 0;
    $counter = 0;

    foreach ($users as $key => $user) {
        if (1000 <= $counter) {
            $insert_sql .= ';';
            $wpdb->query($insert_sql);
            $counter = 0;
            $insert_sql = $insert_init_sql;
        }

        if (0 != $counter) {
            $insert_sql .= ',';
        }

        $insert_sql .= '(
                \'' . str_replace(array("'", '"'), array("\'", '\"'), (isset($user->id) ? $user->id : '')) . '\',
                \'' . str_replace(array("'", '"'), array("\'", '\"'), (isset($user->team_id) ? $user->team_id : '')) . '\',
                \'' . str_replace(array("'", '"'), array("\'", '\"'), (isset($user->name) ? $user->name : '')) . '\',
                \'' . str_replace(array("'", '"'), array("\'", '\"'), (isset($user->real_name) ? $user->real_name : (isset($user->profile->real_name) ? $user->profile->real_name : ''))) . '\',
                \'' . str_replace(array("'", '"'), array("\'", '\"'), (isset($user->profile->image_48) ? $user->profile->image_48 : '')) . '\'
            )';

        $counter++;
        $inserted_counter++;
    }
    $wpdb->query($insert_sql);
    
    echo 'Total Inserted Users: ' . esc_html($inserted_counter) . '<br><br>';
}

echo 'end on: ' . esc_html(date('Y-m-d H:i:s'));
