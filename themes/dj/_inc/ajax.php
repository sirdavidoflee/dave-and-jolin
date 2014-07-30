<?php

// TODO: Ensure AJAX security here.
    
// Add our ajax actions here
$mrh_actions = array("mrh_imn_submit", "mrh_csv_submit", "mrh_tip_submit", "mrh_event_submit", "mrh_filter_events_date",
                 "mrh_retrieve_tips", "mrh_filter_events_cat", "mrh_tell_friend_submit", "mrh_fetch_glossary_term");
foreach($mrh_actions as $mrh_action) {
    add_action('wp_ajax_' . $mrh_action, $mrh_action);
    add_action('wp_ajax_nopriv_' . $mrh_action, $mrh_action);
}

/**
 * Ajax function that grabs a glossary term based on a slug
 *
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_fetch_glossary_term() {
    extract($_POST);
    
    $term_query = new WP_Query();
    $term_query->query(array("name" => $slug, 'showposts' => 1));
        
    while($term_query->have_posts()) {
        $term_query->the_post();
        
        echo get_the_content();
        die;
    }
    echo "No glossary term - please double check your tag";
    die;
}

/**
 * Ajax function that filters events based on date.
 *
 * @return void
 * @uses filter_where
 * @author Mark Robert Henderson
 */
function mrh_filter_events_date() {
    $events = new WP_Query();
    add_filter('posts_where', 'filter_where');
    $events->query(array('cat' => 3));
    
    $return = array();
    while($events->have_posts()) {
        $events->the_post();
        
        $cat = get_the_category();
        $id = get_the_id();
        
        $return[] = array('content' => get_the_content(),
                          'cat' => $cat[0]->slug,
                          'the_id' => $id,
                          'title' => get_the_title(),
                          'permalink' => get_permalink(),
                          'excerpt' => get_the_excerpt(),
                          'rating' => mrh_get_percentage($id));
    }
    
    echo json_encode($return);

    die;
}
    //based on Austin Matzko's code from wp-hackers email list
    function filter_where($where = '') {
        extract($_REQUEST);
        
        $start = date("Y-m-d" , strtotime($startDate));
        $end = date("Y-m-d" , strtotime($endDate));
        
        //posts for March 1 to March 15, 2009
        $where .= " AND post_date >= '{$start}' AND post_date < '{$end}'";
        return $where;
    }

/**
 * Filters Events based on category
 *
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_filter_events_cat() {
    extract($_REQUEST);
    
    $event_id = get_category_by_slug('events')->term_id;
    $categories = empty($cats) ? $event_id : $cats;
    $locations = empty($locs) ? null : split(",", $locs);
    
    $events = new WP_Query();
    $events->query(array('cat' => $categories,
                         'showposts' => -1,
                         'caller_get_posts' => 1));
    
    $return = array();

    while($events->have_posts()) {
        $events->the_post();
        
        $cat = get_the_category();
        
        $skip = true;
        for($i = 0; $i <= count($cat); $i++) {
            if(!empty($locations) && in_array($cat[$i]->cat_ID, $locations)) $skip = false;
            if($cat[$i]->parent != $event_id) unset($cat[$i]);
        }
        if($skip && !empty($locations)) continue;
        $cat = array_merge($cat);
        
        $id = get_the_id();
                
        $return[] = array('content' => get_the_content(),
                          'cat' => $cat[0]->slug,
                          'the_id' => $id,
                          'title' => get_the_title(),
                          'permalink' => get_permalink(),
                          'excerpt' => get_the_excerpt(),
                          'rating' => mrh_get_percentage($id));
    }
    
    echo json_encode($return);
    
    die;
}

/**
 * Grabs 6 new tips from the db
 *
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_retrieve_tips() {
    extract($_REQUEST);
    
    $tips = new WP_Query();
    $tips->query(array('cat' => 6,
                       'showposts' => (int)$num));
//    $order = isset($dir) ? "desc" : "asc";
    
    $return = array();
    while($tips->have_posts()) {
        $tips->the_post();
        
        $cat = get_the_category();
        $id = get_the_id();
        
        $return[] = array('content' => get_the_content(),
                          'cat' => $cat[0]->slug,
                          'the_id' => $id,
                          'rating' => mrh_get_percentage($id),
                          'tip_author' => get_post_meta($id, "Tip Author", true));
    }
    
    echo json_encode($return);
    
    die;
}


/**
 * Function to send email to friend
 *
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_tell_friend_submit() {
    extract($_POST);
    
    if(wp_mail($friend_email, "Here's a healthy little tidbit for you:", $message . "\n\n". $url, "From: {$name} <{$email}>")) {
        die("Mail Sent");
    }
    die("Mail Not Sent");
}

/**
 * mrh_event_submit 
 *
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_event_submit() {
    global $wpdb;
    extract($_POST);
    
    $page = array(
        "post_type" => "post",
        "post_content" => $text,
        "post_parent" => 0,
        "post_status" => "draft",
        "post_title" => $title,
        "post_author" => 3
    );

    //$page = apply_filters('yourplugin_add_new_page', $page, 'teams');
    
    $post_id = wp_insert_post($page);
    if($post_id) {
        wp_set_post_categories($post_id, array($cat));
        
        // Email administrator that a new tip has been created.
        wp_mail( get_bloginfo("admin_email"), "A New Tip Has Been Created", 'Log in to see: http://'.get_bloginfo("wp_url").'/wp-adming/edit.php');
        die("Page Created");
    } else {
        die("Page Creation Failed");
    }
    
    die;
}

/**
 * mrh_tip_submit 
 *
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_tip_submit() {
    global $wpdb;
    extract($_POST);
    
    $page = array(
        "post_type" => "post",
        "post_content" => $text,
        "post_parent" => 0,
        "post_status" => "draft",
        "post_title" => myTruncate($text, 50, " "),
        "post_author" => 2
    );

    //$page = apply_filters('yourplugin_add_new_page', $page, 'teams');
    
    $post_id = wp_insert_post($page);
    if($post_id) {
        add_post_meta($post_id, 'Tip Author', $name);
        wp_set_post_categories($post_id, array($cat));
        
        // Email administrator that a new tip has been created.
        wp_mail( get_bloginfo("admin_email"), "A New Tip Has Been Created", 'Log in to see: http://'.get_bloginfo("wp_url").'/wp-adming/edit.php');
        die("Page Created");
    } else {
        die("Page Creation Failed");
    }
    
    die;
}

/**
 * mrh_csv_submit
 * 
 * Stores data from coupon submit and comment submit to csv file
 *
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_csv_submit() {
    global $wpdb;
    
    $row = 1;
    extract($_REQUEST);
    
    // Important note! Make sure you move emails.csv to a non-public directory on the live webserver!
    $email_csv = TEMPLATEPATH . '/emails.csv';
    
    if (($handle = fopen($email_csv, "ra+")) !== FALSE) {
        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            // Check to see if email already exists
            if(in_array($email, $data)) {
                if($post_id) {
                    $row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID=$post_id LIMIT 1");
                    $row->post_thumbnail = get_the_post_thumbnail($post_id);
                    echo json_encode($row);
                } else {
                    echo true;
                }
                die;
            }
        }
        
        // It made it through the loop without a problem.
        $fields = array($name, $email, time());
        if(fputcsv($handle, $fields)) {
            if($post_id) {
                $row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID=$post_id LIMIT 1");
                $row->post_thumbnail = get_the_post_thumbnail($post_id);
                echo json_encode($row);
            } else {
                echo true;
            }
            die;
        } else {
            echo false;
        }
        
        fclose($handle);
    }
    die;
}

/**
 * mrh_imn_submit
 *
 * Looking to mimic this form with a CURL request
 * 
 * <form method="POST" action="http://www.imakenews.com/eletra/mod_input_proc.cfm" enctype="iso-8859-1">
 * <input type="hidden" name="XXDESXXuser" value="kyh2010">
 * <input type="hidden" name="XXDESXXbackto" value="CALLER">
 * <input type="hidden" name="mod_name" value="subscription">
 * <input type="text" name="XXDESXXemail_address" size="15" maxlength="100" value="[Your Email]">
 * <br />
 * <input type="radio" value="Add" name="XXDESXXsubscribe_op" checked> Add <input type="radio" value="Remove" name="XXDESXXsubscribe_op"> Remove<br />
 * <input type="checkbox" name="XXDESXXemail_type" value="htm" checked> Send as HTML<br />
 * <input type="submit" value="Submit" name="add">
 * </form> 
 *
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_imn_submit() {
    
    //extract data from the post
    extract($_POST);
    
    //set POST variables
    $url = 'http://www.imakenews.com/eletra/mod_input_proc.cfm';
    
    $fields = array(
        'XXDESXXuser'=>urlencode("kyh2010"),
    	'XXDESXXbackto'=>urlencode("CALLER"),
    	'mod_name'=>urlencode("subscription"),
    	'XXDESXXemail_address'=>urlencode($email),
    	'XXDESXXsubscribe_op'=>urlencode($type),
    	'add'=>urlencode("Submit"),
    	'XXDESXXemail_type'=>urlencode("htm")
    );

    //url-ify the data for the POST
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string,'&');

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

    //execute post
    $result = curl_exec($ch);

    echo $result;

    //close connection
    curl_close($ch);
    
    die;
}