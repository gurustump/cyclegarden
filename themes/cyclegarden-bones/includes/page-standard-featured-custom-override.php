<?php
if (get_the_title() == 'Speedo Rebuilds') { ?>
<div class="speedo-container SPEEDO">
	<h2>[Mouse-over Speedo]</h2>
	<img src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/Speedo-Template.png" alt="Speedo" usemap="#speedo_map" />
	<img class="hover generator-warning" src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/speedo_generator_over.jpg" alt="Generator Warning" />
	<img class="hover high-beam" src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/speedo_high_beam_over.png" alt="High Beam" />
	<img class="hover left-turn" src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/speedo_left_turn_over.png" alt="Left Turn Signal" />
	<img class="hover neutral-gear" src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/speedo_neutral_over.jpg" alt="Neutral Gear" />
	<img class="hover oil-pressure" src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/speedo_oil_pressure_over.jpg" alt="Oil Pressure Warning" />
	<img class="hover right-turn" src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/speedo_right_turn_over.png" alt="Right Turn Signal" />
	<img class="hover spotlight" src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/speedo_spotlight_over.jpg" alt="Spotlights (originally map light)" />
	<map name="speedo_map" id="speedo-map">
		<area shape="circle" alt="Push/Pull Spotlights (originally map light)" coords="190,95,22">
		<area shape="circle" alt="Push/Pull Kill Switch" coords="467,93,22">
		<area shape="circle" alt="Hazard Lights - 4 Flashing" coords="519,162,26">
		<area shape="rect" alt="Odometer" coords="299,168,362,184">
	</map>
	
</div>
<?php }
?>