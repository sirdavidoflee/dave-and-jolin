<?php 

$event_categories = get_categories(array(
                        'child_of' => get_category_by_slug('events')->term_id
                    )); 

$location_categories = get_categories(array(
                         'child_of' => get_category_by_slug('location')->term_id
                     ));
?>

            <form id="eventSort" name="eventSort" action="#">

        		<div id="byType" class="filter">
        			<dl>
        				<dt>Filter By Type</dt>
        				<dd>
        					<table summary="filter calendar list by type of event">
        						<?php foreach($event_categories as $cat): ?>
        						    <?php $catSlug = 'type' . ucfirst($cat->slug); ?>
        						    <tr>
        							    <td class="checkbox"><input type="checkbox" id="<?php echo $catSlug; ?>" name="typeFilter[]" value="<?php echo $cat->term_id ?>" /></td>
        							    <th><label for="<?php echo $catSlug; ?>"><?php echo $cat->name; ?></label></th>
        							    <td><?php echo $cat->count; ?></td>
        						    </tr>
        						<?php endforeach; ?>
        					</table>
        					<p><a class="all" href="#">Check all</a> | <a class="none" href="#">Uncheck all</a></p>
        				</dd>
        			</dl>
        		</div><!-- #byType -->

        		<div id="byLocation" class="filter">
        			<dl>
        				<dt>Filter By Location</dt>
        				<dd>
        					<table summary="filter calendar list by location of event">
        						<?php foreach($location_categories as $cat): ?>
        						    <?php $catSlug = 'type' . ucfirst($cat->slug); ?>
        						    <tr>
        							    <td class="checkbox"><input type="checkbox" id="<?php echo $catSlug; ?>" name="typeFilter[]" value="<?php echo $cat->term_id ?>" /></td>
        							    <th><label for="<?php echo $catSlug; ?>"><?php echo $cat->name; ?></label></th>
        						    </tr>
    						    <?php endforeach; ?>
        					</table>
        					<p><a class="all" href="#">Check all</a> | <a class="none" href="#">Uncheck all</a></p>
        				</dd>
        			</dl>
        		</div><!-- #byLocation -->

        		<div id="byDate" class="filter">
        			<dl>
        				<dt>Filter By Date</dt>
        				<dd>
        					<table summary="filter calendar list by date of event">
        						<tr>
        							<th><label for="startDate">Start Date</label></th>
        							<th><label for="endDate">End Date</label></th>
        						</tr>
        						<tr class="text-input">
        							<td class="start-date"><input type="text" id="startDate" name="startDate" value="mm/dd/yy" /></td>
        							<td class="end-date"><input type="text" id="endDate" name="endDate" value="mm/dd/yy" /></td>
        						</tr>
        						<tr class="buttons">
        							<td colspan="2">
        								<button class="btn next">update</button>
        								<p><a href="<?php bloginfo('url'); ?>/events">Clear dates</a></p>
        							</td>
        						</tr>
        					</table>
        				</dd>
        			</dl>
        		</div><!-- #byDate -->

        	</form><!-- #eventSort -->