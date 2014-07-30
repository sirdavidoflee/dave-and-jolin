<?php

class Share_Tips_Widget extends WP_Widget {
	function Share_Tips_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Tufts Specific Share Tips Widget that appears in the sidebar.' 
		);
		$this->WP_Widget('shareTips', '[Tufts] Share Tips', $widget_ops);
	}
 
	function widget($args, $instance) {
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		load_template(TEMPLATEPATH . '/widgets/share-tips.php');
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
	}
 
	function form($instance) {
	}
}
register_widget('Share_Tips_Widget');


class Coupons_Widget extends WP_Widget {
	function Coupons_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows a number of latest coupons.' 
		);
		$this->WP_Widget('coupons', '[Tufts] Coupons', $widget_ops);
	}
 
	function widget($args, $instance) {
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
	    load_template(TEMPLATEPATH . "/widgets/coupons.php");
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		/* $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entry_title'] = strip_tags($new_instance['entry_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);
 
		return $instance; */
	}
 
	function form($instance) {
		/* $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
		$title = strip_tags($instance['title']);
		$entry_title = strip_tags($instance['entry_title']);
		$comments_title = strip_tags($instance['comments_title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('entry_title'); ?>">Title for entry feed: <input class="widefat" id="<?php echo $this->get_field_id('entry_title'); ?>" name="<?php echo $this->get_field_name('entry_title'); ?>" type="text" value="<?php echo attribute_escape($entry_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('comments_title'); ?>">Title for comments feed: <input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label></p>
<?php */
	}
}
register_widget('Coupons_Widget');


class Health_Toolkit_Widget extends WP_Widget {
	function Health_Toolkit_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows the link to the Health Toolkit' 
		);
		$this->WP_Widget('healthToolkit', '[Tufts] Health Toolkit', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
		//echo $before_widget;
		
		$text = empty($instance['text']) ? '&nbsp;' : $instance['text'];
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo <<<HERE
            <div id="healthToolkit" class="box1">
				<dl>
					<dt>Health Toolkit</dt>
					<dd>
						<p>{$text}</p>
						<a class="btn go next" href="#">explore tools</a>
					</dd>
				</dl>
			</div><!-- #healthToolkit -->
HERE;
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['text'] = $new_instance['text'];
		
		return $instance;
	}
 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, 
		            array( 'text' => '' ) );
		$text = $instance['text'];
?>
			<p><label for="<?php echo $this->get_field_id('text'); ?>">Widget Text (can include HTML): <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo attribute_escape($text); ?>" /></label></p>
<?php
	}
}
register_widget('Health_Toolkit_Widget');

class Feedback_Survey_Widget extends WP_Widget {
	function Feedback_Survey_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Help Us Help You! Survey Widget' 
		);
		$this->WP_Widget('helpUs', '[Tufts] Feedback Survey', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
		//echo $before_widget;
		
		$text = empty($instance['text']) ? '&nbsp;' : $instance['text'];
		$button_text = empty($instance['button_text']) ? '&nbsp;' : $instance['button_text'];
		$button_link = empty($instance['button_link']) ? '&nbsp;' : $instance['button_link'];
		
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo <<<HERE
			<div id="helpUs" class="box2">
				<dl>
					<dt>Help Us Help You</dt>
					<dd>
						<p>{$text}</p>
						<a class="btn go next" href="{$button_link}">{$button_text}</a>
					</dd>
				</dl>
			</div><!-- #helpUs -->
HERE;
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['text'] = $new_instance['text'];
		$instance['button_text'] = $new_instance['button_text'];
		$instance['button_link'] = $new_instance['button_link'];

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, 
		            array( 'text' => '' ) );
		$text = $instance['text'];
		$button_text = $instance['button_text'];
		$button_link = $instance['button_link'];
		
?>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Widget Text (can include HTML): <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo attribute_escape($text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_text'); ?>">Button Text: <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo attribute_escape($button_text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_link'); ?>">Button Link: <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo attribute_escape($button_link); ?>" /></label></p>
<?php
	}
}
register_widget('Feedback_Survey_Widget');


class Newsletter_Widget extends WP_Widget {
	function Newsletter_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows Newsletter Signup Callout' 
		);
		$this->WP_Widget('weeklyFavs', '[Tufts] Newsletter', $widget_ops);
	}
 
	function widget($args, $instance) {
		global $post;
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
		$post->text = empty($instance['text']) ? '&nbsp;' : $instance['text'];
		$post->button_text = empty($instance['button_text']) ? '&nbsp;' : $instance['button_text'];
		
		load_template(TEMPLATEPATH . '/widgets/newsletter.php');
		echo $after_widget;
	}
 
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['text'] = $new_instance['text'];
    	$instance['button_text'] = $new_instance['button_text'];

    	return $instance;
    }

    function form($instance) {
    	$instance = wp_parse_args( (array) $instance, 
    	            array( 'text' => '' ) );
    	$text = $instance['text'];
    	$button_text = $instance['button_text'];
?>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Widget Text (can include HTML): <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo attribute_escape($text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_text'); ?>">Button Text: <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo attribute_escape($button_text); ?>" /></label></p>
<?php
	}
}
register_widget('Newsletter_Widget');


class Event_Filter_Widget extends WP_Widget {
	function Event_Filter_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Sorts and filters events from the sidebar' 
		);
		$this->WP_Widget('eventSort', '[Tufts] Event Filter', $widget_ops);
	}
 
	function widget($args, $instance) {
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		load_template(TEMPLATEPATH . '/widgets/event-filter.php');
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		/* $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entry_title'] = strip_tags($new_instance['entry_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);
 
		return $instance; */
	}
 
	function form($instance) {
		/* $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
		$title = strip_tags($instance['title']);
		$entry_title = strip_tags($instance['entry_title']);
		$comments_title = strip_tags($instance['comments_title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('entry_title'); ?>">Title for entry feed: <input class="widefat" id="<?php echo $this->get_field_id('entry_title'); ?>" name="<?php echo $this->get_field_name('entry_title'); ?>" type="text" value="<?php echo attribute_escape($entry_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('comments_title'); ?>">Title for comments feed: <input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label></p>
<?php */
	}
}
register_widget('Event_Filter_Widget');


class Top_Five_Terms_Widget extends WP_Widget {
	function Top_Five_Terms_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows Top Five Glossary Terms' 
		);
		$this->WP_Widget('top5terms', '[Tufts] Top Five Glossary', $widget_ops);
	}
 
	function widget($args, $instance) {
		/* extract($args, EXTR_SKIP);
 
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$entry_title = empty($instance['entry_title']) ? '&nbsp;' : apply_filters('widget_entry_title', $instance['entry_title']);
		$comments_title = empty($instance['comments_title']) ? '&nbsp;' : apply_filters('widget_comments_title', $instance['comments_title']); */
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo <<<HERE
        	<div id="top5" class="terms list">
        		<dl>
        			<dt>Top 5 Terms Everyone Should Know</dt>
        			<dd>
        				<ol>
        					<li><a href="#">lorem ipsum</a></li>
        					<li><a href="#">Consectetur</a></li>
        					<li><a href="#">Vestibulum eu sapien</a></li>
        					<li><a href="#">Adipiscing elit</a></li>
        					<li><a href="#">Dolor sit amet</a></li>
        				</ol>
        				<a class="btn go next" href="<?php bloginfo('url'); ?>/glossary">view full glossary</a>
        			</dd>
        		</dl>
        	</div><!-- #top5 -->
HERE;
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		/* $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entry_title'] = strip_tags($new_instance['entry_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);
 
		return $instance; */
	}
 
	function form($instance) {
		/* $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
		$title = strip_tags($instance['title']);
		$entry_title = strip_tags($instance['entry_title']);
		$comments_title = strip_tags($instance['comments_title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('entry_title'); ?>">Title for entry feed: <input class="widefat" id="<?php echo $this->get_field_id('entry_title'); ?>" name="<?php echo $this->get_field_name('entry_title'); ?>" type="text" value="<?php echo attribute_escape($entry_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('comments_title'); ?>">Title for comments feed: <input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label></p>
<?php */
	}
}
register_widget('Top_Five_Terms_Widget');


class Top_Five_Events_Widget extends WP_Widget {
	function Top_Five_Events_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows Top Five Events' 
		);
		$this->WP_Widget('top5events', '[Tufts] Top Five Events', $widget_ops);
	}
 
	function widget($args, $instance) {
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		load_template(TEMPLATEPATH . '/widgets/top-five-events.php');
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
	}
 
	function form($instance) {
	}
}
register_widget('Top_Five_Events_Widget');



class Visit_Tufts_Widget extends WP_Widget {
	function Visit_Tufts_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows link to tuftshealthplan.com' 
		);
		$this->WP_Widget('alreadyMember', '[Tufts] Visit Tufts', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
	    $text = empty($instance['text']) ? '&nbsp;' : $instance['text'];
	    $button_text = empty($instance['button_text']) ? '&nbsp;' : $instance['button_text'];
	    $button_link = empty($instance['button_link']) ? '&nbsp;' : $instance['button_link'];
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo <<<HERE
            <div id="alreadyMember" class="callout">
        		<dl>
        			<dt>Already a Tufts member?</dt>
        			<dd>
        				<p>{$text}</p>
        				<a class="arrow" href="{$button_link}">{$button_text}</a>
        			</dd>
        		</dl>
        	</div><!-- #alreadyMember -->
HERE;
		echo $after_widget;
	}
 
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['text'] = $new_instance['text'];
    	$instance['button_text'] = $new_instance['button_text'];
    	$instance['button_link'] = $new_instance['button_link'];

    	return $instance;
    }

    function form($instance) {
    	$instance = wp_parse_args( (array) $instance, 
    	            array( 'text' => '' ) );
    	$text = $instance['text'];
    	$button_text = $instance['button_text'];
    	$button_link = $instance['button_link'];

?>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Widget Text (can include HTML): <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo attribute_escape($text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_text'); ?>">Button Text: <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo attribute_escape($button_text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_link'); ?>">Button Link: <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo attribute_escape($button_link); ?>" /></label></p>
<?php
	}
}
register_widget('Visit_Tufts_Widget');


class Save_More_Widget extends WP_Widget {
	function Save_More_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows link to additional tufts discounts' 
		);
		$this->WP_Widget('saveMore', '[Tufts] Additional Discounts', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
		//echo $before_widget;
		
		$text = empty($instance['text']) ? '&nbsp;' : $instance['text'];
		$button_text = empty($instance['button_text']) ? '&nbsp;' : $instance['button_text'];
		$button_link = empty($instance['button_link']) ? '&nbsp;' : $instance['button_link'];
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo <<<HERE
            <div id="saveMore" class="callout">
        		<dl>
        			<dt>Save More</dt>
        			<dd>
        				<p>{$text}</p>
        				<a class="cash-money" href="{$button_link}" target="_blank">{$button_text}</a>
        			</dd>
        		</dl>
        	</div><!-- #saveMore -->
HERE;
		echo $after_widget;
	}
 
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['text'] = $new_instance['text'];
    	$instance['button_text'] = $new_instance['button_text'];
    	$instance['button_link'] = $new_instance['button_link'];

    	return $instance;
    }

    function form($instance) {
    	$instance = wp_parse_args( (array) $instance, 
    	            array( 'text' => '' ) );
    	$text = $instance['text'];
    	$button_text = $instance['button_text'];
    	$button_link = $instance['button_link'];

?>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Widget Text (can include HTML): <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo attribute_escape($text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_text'); ?>">Button Text: <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo attribute_escape($button_text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_link'); ?>">Button Link: <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo attribute_escape($button_link); ?>" /></label></p>
<?php
	}
}
register_widget('Save_More_Widget');



class Helpful_Videos_Widget extends WP_Widget {
	function Helpful_Videos_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows a number of helpful videos' 
		);
		$this->WP_Widget('helpfulVideos', '[Tufts] Helpful Videos', $widget_ops);
	}
 
	function widget($args, $instance) {
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		load_template(TEMPLATEPATH . "/widgets/helpful-videos.php");
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
	}
 
	function form($instance) {
	}
}
register_widget('Helpful_Videos_Widget');



class Got_Idea_Widget extends WP_Widget {
	function Got_Idea_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Shows link to contact form' 
		);
		$this->WP_Widget('gotAnIdea', '[Tufts] Got an idea?', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
		//echo $before_widget;
		
		$text = empty($instance['text']) ? '&nbsp;' : $instance['text'];
		$button_text = empty($instance['button_text']) ? '&nbsp;' : $instance['button_text'];
		$button_link = empty($instance['button_link']) ? '&nbsp;' : $instance['button_link'];
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo <<<HERE
            <div id="gotAnIdea" class="callout">
        		<dl>
        			<dt>Got an idea?</dt>
        			<dd>
        				<p>{$text}</p>
        				<a class="envelope" href="{$button_link}">{$button_text}</a>
        			</dd>
        		</dl>
        	</div><!-- #gotAnIdea -->
HERE;
		echo $after_widget;
	}
 
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['text'] = $new_instance['text'];
    	$instance['button_text'] = $new_instance['button_text'];
    	$instance['button_link'] = $new_instance['button_link'];

    	return $instance;
    }

    function form($instance) {
    	$instance = wp_parse_args( (array) $instance, 
    	            array( 'text' => '' ) );
    	$text = $instance['text'];
    	$button_text = $instance['button_text'];
    	$button_link = $instance['button_link'];

?>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Widget Text (can include HTML): <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo attribute_escape($text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_text'); ?>">Button Text: <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo attribute_escape($button_text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_link'); ?>">Button Link: <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo attribute_escape($button_link); ?>" /></label></p>
<?php
	}
}
register_widget('Got_Idea_Widget');



class Enter_To_Win_Widget extends WP_Widget {
	function Enter_To_Win_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Displays enter to win text' 
		);
		$this->WP_Widget('enterToWin', '[Tufts] Enter to Win', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
//		echo $before_widget;
		$text = empty($instance['text']) ? '&nbsp;' : $instance['text'];
		
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo <<<HERE
        	<div id="enterToWin" class="callout">
        		<dl>
        			<dt>Enter to Win</dt>
        			<dd>
        				<p><img src="/wp-content/themes/tufts/img/bubble-win-callout.gif" />{$text}</p>
        			</dd>
        		</dl>
        	</div><!-- #enterToWin -->
HERE;
		echo $after_widget;
	}
 
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['text'] = $new_instance['text'];

    	return $instance;
    }

    function form($instance) {
    	$instance = wp_parse_args( (array) $instance, 
		            array( 'text' => '' ) );
		$text = $instance['text'];
?>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Widget Text (can include HTML): <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo attribute_escape($text); ?>" /></label></p>
    <?php
    	}
}
register_widget('Enter_To_Win_Widget');



class Related_Events_Widget extends WP_Widget {
	function Related_Events_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Displays related events' 
		);
		$this->WP_Widget('relatedEvents', '[Tufts] Related Events', $widget_ops);
	}
 
	function widget($args, $instance) {
		/* extract($args, EXTR_SKIP);
 
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$entry_title = empty($instance['entry_title']) ? '&nbsp;' : apply_filters('widget_entry_title', $instance['entry_title']);
		$comments_title = empty($instance['comments_title']) ? '&nbsp;' : apply_filters('widget_comments_title', $instance['comments_title']); */
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        load_template(TEMPLATEPATH . '/widgets/related-events.php');
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		/* $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entry_title'] = strip_tags($new_instance['entry_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);
 
		return $instance; */
	}
 
	function form($instance) {
		/* $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
		$title = strip_tags($instance['title']);
		$entry_title = strip_tags($instance['entry_title']);
		$comments_title = strip_tags($instance['comments_title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('entry_title'); ?>">Title for entry feed: <input class="widefat" id="<?php echo $this->get_field_id('entry_title'); ?>" name="<?php echo $this->get_field_name('entry_title'); ?>" type="text" value="<?php echo attribute_escape($entry_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('comments_title'); ?>">Title for comments feed: <input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label></p>
<?php */
	}
}
register_widget('Related_Events_Widget');


class Involved_People_Widget extends WP_Widget {
	function Involved_People_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Displays related events' 
		);
		$this->WP_Widget('InvolvedPeople', '[Element] Involved People', $widget_ops);
	}
 
	function widget($args, $instance) {
		/* extract($args, EXTR_SKIP);
 
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$entry_title = empty($instance['entry_title']) ? '&nbsp;' : apply_filters('widget_entry_title', $instance['entry_title']);
		$comments_title = empty($instance['comments_title']) ? '&nbsp;' : apply_filters('widget_comments_title', $instance['comments_title']); */
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        load_template(TEMPLATEPATH . '/widgets/involved-people.php');
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		/* $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entry_title'] = strip_tags($new_instance['entry_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);
 
		return $instance; */
	}
 
	function form($instance) {
		/* $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
		$title = strip_tags($instance['title']);
		$entry_title = strip_tags($instance['entry_title']);
		$comments_title = strip_tags($instance['comments_title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('entry_title'); ?>">Title for entry feed: <input class="widefat" id="<?php echo $this->get_field_id('entry_title'); ?>" name="<?php echo $this->get_field_name('entry_title'); ?>" type="text" value="<?php echo attribute_escape($entry_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('comments_title'); ?>">Title for comments feed: <input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label></p>
<?php */
	}
}
register_widget('Involved_People_Widget');


class My_Projects_Widget extends WP_Widget {
	function My_Projects_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Displays related events' 
		);
		$this->WP_Widget('MyProjects', '[Element] My Projects', $widget_ops);
	}
 
	function widget($args, $instance) {
		/* extract($args, EXTR_SKIP);
 
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$entry_title = empty($instance['entry_title']) ? '&nbsp;' : apply_filters('widget_entry_title', $instance['entry_title']);
		$comments_title = empty($instance['comments_title']) ? '&nbsp;' : apply_filters('widget_comments_title', $instance['comments_title']); */
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        load_template(TEMPLATEPATH . '/widgets/my-projects.php');
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		/* $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entry_title'] = strip_tags($new_instance['entry_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);
 
		return $instance; */
	}
 
	function form($instance) {
		/* $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
		$title = strip_tags($instance['title']);
		$entry_title = strip_tags($instance['entry_title']);
		$comments_title = strip_tags($instance['comments_title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('entry_title'); ?>">Title for entry feed: <input class="widefat" id="<?php echo $this->get_field_id('entry_title'); ?>" name="<?php echo $this->get_field_name('entry_title'); ?>" type="text" value="<?php echo attribute_escape($entry_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('comments_title'); ?>">Title for comments feed: <input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label></p>
<?php */
	}
}
register_widget('My_Projects_Widget');


class Twitter_Widget extends WP_Widget {
	function Twitter_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Displays related events' 
		);
		$this->WP_Widget('Twitter', '[Element] Twitter', $widget_ops);
	}
 
	function widget($args, $instance) {
		/* extract($args, EXTR_SKIP);
 
		echo $before_widget;
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$entry_title = empty($instance['entry_title']) ? '&nbsp;' : apply_filters('widget_entry_title', $instance['entry_title']);
		$comments_title = empty($instance['comments_title']) ? '&nbsp;' : apply_filters('widget_comments_title', $instance['comments_title']); */
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        load_template(TEMPLATEPATH . '/widgets/twitter.php');
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		/* $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entry_title'] = strip_tags($new_instance['entry_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);
 
		return $instance; */
	}
 
	function form($instance) {
		/* $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
		$title = strip_tags($instance['title']);
		$entry_title = strip_tags($instance['entry_title']);
		$comments_title = strip_tags($instance['comments_title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('entry_title'); ?>">Title for entry feed: <input class="widefat" id="<?php echo $this->get_field_id('entry_title'); ?>" name="<?php echo $this->get_field_name('entry_title'); ?>" type="text" value="<?php echo attribute_escape($entry_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('comments_title'); ?>">Title for comments feed: <input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label></p>
<?php */
	}
}
register_widget('Twitter_Widget');


class Flickr_Widget extends WP_Widget {
	function Flickr_Widget() {
		$widget_ops = array(
		        'classname' => 'callout', 
		        'description' => 'Displays related events' 
		);
		$this->WP_Widget('Flickr', '[Element] Flickr', $widget_ops);
	}
 
	function widget($args, $instance) {
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        load_template(TEMPLATEPATH . '/widgets/flickr.php');
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {

	}
 
	function form($instance) {

	}
}
register_widget('Flickr_Widget');