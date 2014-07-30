<?php 
	// $talent_categories = get_categories(array('child_of' => get_category_by_slug('talent')->term_id));
	// $talent_categories_dir = get_categories(array('child_of' => get_category_by_slug('directors')->term_id));
	// $talent_categories_ed = get_categories(array('child_of' => get_category_by_slug('editors')->term_id));
	// $talent_categories_prod = get_categories(array('child_of' => get_category_by_slug('producers')->term_id));
	// 
	// $about_categories = get_categories(array('child_of' => get_category_by_slug('about')->term_id));

	$daveChildren = get_categories(array(
	                        'child_of' => get_category_by_slug('dave')->term_id
	                    ));
	
	$jolinChildren = get_categories(array(
	                        'child_of' => get_category_by_slug('jolin')->term_id
	                    ));
	
	$jointChildren = get_categories(array(
	                        'child_of' => get_category_by_slug('joint')->term_id
	                    ));
	
	$vidsChildren = get_categories(array(
	                        'child_of' => get_category_by_slug('videos')->term_id
	                    ));

 ?>

			</div>

			<div class="head">
				<a href="#" class="show-nav" style="display: none;">Menu</a>
				<span class="message">A glorified blog disguised as a full website! Clever!<br/>
				From paper robots to cooking videos, check it out!</span>
				<a href="<?php bloginfo('url'); ?>/" class="logo">Dave and Jolin</a>
				
				<div class="face">
					
					<div class="ears">
						<form action="/" id="searchform" method="get" role="search">
							<input type="text" value="Search our awesomeness" name="s" id="s" />
							<button type="submit" id="searchsubmit">Go</button>
						</form>
					</div>
				
					<ul class="mouth">
						<li <?php current_nav('dave'); ?>>
							<a href="<?php bloginfo('url'); ?>/dave"><strong>Dave's</strong> List</a>
							<ul>
							<?php foreach($daveChildren as $daves): ?>
								<li><a href="<?php bloginfo('url'); ?>/dave/<?php echo $daves->slug; ?>"><?php echo $daves->name; ?></a></li>
							<?php endforeach; ?>
							</ul>
						</li>
						<li <?php current_nav('jolin'); ?>>
							<a href="<?php bloginfo('url'); ?>/jolin"><strong>Jolin's</strong> List</a>
							<ul>
								<?php foreach($jolinChildren as $jolins): ?>
									<li><a href="<?php bloginfo('url'); ?>/jolin/<?php echo $jolins->slug; ?>"><?php echo $jolins->name; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li <?php current_nav('joint'); ?>>
							<a href="<?php bloginfo('url'); ?>/joint"><strong>Joint</strong> List</a>
							<ul>
								<?php foreach($jointChildren as $joints): ?>
									<li><a href="<?php bloginfo('url'); ?>/joint/<?php echo $joints->slug; ?>"><?php echo $joints->name; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li <?php current_nav('videos'); ?>>
							<a href="<?php bloginfo('url'); ?>/videos"><strong>Awesome</strong> Videos</a>
							<ul>
								<?php foreach($vidsChildren as $vids): ?>
									<li><a href="<?php bloginfo('url'); ?>/videos/<?php echo $vids->slug; ?>"><?php echo $vids->name; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li><a href="http://wedding.daveandjolin.com/" target="_blank"><strong>Wedding</strong> Site</a></li>
					</ul>
				</div>
			</div>
			
			<div class="feet">
				<ul class="toes">
					<li><a href="http://daveandjolin.com/feed/"><img class="alignnone" title="RSS feed" src="/wp-content/themes/dj/img/rss.jpg" alt="" /></a></li>

				</ul>
				<p class="heel">&copy; 2011 Dave and Jolin, proud sponsors of the Dinosaur Adoption Agency</p>
			</div>
			
			<div class="secrets">
			
				<a href="/wp-content/themes/dj/img/words.jpg" class="word-bgs" target="_blank">you found me</a>
					
			</div>
			
		</div>
	
		<h6 id="tooBig">Your browser is too big! We REFUSE to show you anything until you shrink it!</h6>
	
		<div class="modal">
			<div class="modal-bg"></div>
			<div class="modal-content"></div>
		</div>
	
	</body>
</html>
