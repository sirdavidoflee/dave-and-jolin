<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<div id="content" class="contact">

	<div class="post-body">
		<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
	</div><!-- .post-body -->

</div><!-- #content -->

<ul class="lungs">
	
	<div id="ourOffice" class="contact">
		<a class="tag" href="<?php echo get_post_meta($post->ID, "Location", true); ?>" target="_blank">Map it &raquo;</a>
		<dl>
			<dt>Our Office</dt>
			<dd>
				<p>
					<?php echo get_post_meta($post->ID, "Address", true); ?>
				</p>
				<p>
					Phone: <?php echo get_post_meta($post->ID, "Phone", true); ?><br />
					Fax: <?php echo get_post_meta($post->ID, "Fax", true); ?><br />
					<a href="mailto:<?php echo get_post_meta($post->ID, "Email Office", true); ?>"><?php echo get_post_meta($post->ID, "Email Office", true); ?></a>
				</p>
			</dd>
		</dl>
	</div><!-- #ourOffice -->
					
	<div id="getInTouch" class="contact">
		<dl>
			<dt>Get in Touch</dt>
			<dd>
				<ul>
					<li>
						<h4><?php echo get_post_meta($post->ID, "Contact Owner", true); ?></h4>
						<p>
							Executive Producer<br/>
							<a href="mailto:<?php echo get_post_meta($post->ID, "Email Owner", true); ?>"><?php echo get_post_meta($post->ID, "Email Owner", true); ?></a>
						</p>
					</li>
					<li>
						<h4><?php echo get_post_meta($post->ID, "Contact Head", true); ?></h4>
						<p>
							Head of Production and Post Production<br />
							<a href="mailto:<?php echo get_post_meta($post->ID, "Email Head", true); ?>"><?php echo get_post_meta($post->ID, "Email Head", true); ?></a>
						</p>
					</li>
					<li>
						<h4>East Coast Representation</h4>
						<p>Rich Schafler <br/><a href="mailto:<?php echo get_post_meta($post->ID, "Email East", true); ?>"><?php echo get_post_meta($post->ID, "Email East", true); ?></a></p>
					</li>
					<li>
						<h4>Midwest Representation</h4>
						<p>Jim Deloye <br/><a href="mailto:<?php echo get_post_meta($post->ID, "Email West", true); ?>"><?php echo get_post_meta($post->ID, "Email West", true); ?></a></p>
					</li>
				</ul>								
			</dd>
		</dl>
	</div><!-- #getInTouch -->
		
</ul><!-- #callouts -->

<?php get_footer(); ?>


