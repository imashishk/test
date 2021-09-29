<?php
/*
Plugin Name: Booking calendar ddcgroup Plugin
Plugin URI: https://wordpress.org/plugins/
Description: This will show ddcgroup Booking Calendar form detail
Author: wordpress
*/



include_once('booking-calendar-admin.php');



function ddcgroup_booking_calendar_function (){
	
// Frontend Adding to cart

	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'Book Online'){
		$product_id = $_POST['product_id'];
		
		WC()->cart->add_to_cart( $product_id );
		
		
	}
	
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		
		if(!isset($_GET['product_id'])){
			wp_redirect( $shop_page_url );
			die;
		}
		
		if(isset($_GET['product_id'])){
		
		$product_id = $_GET['product_id'];
		$product = wc_get_product( $product_id );
		
		$zones = array(
			'zone 1' => array('Mount Eliza', 'Frankston', 'Frankston South',  'Mornington', 'Mount Martha', 'Moorooduc', 'Somerville', 'Baxter', 'Tyabb'),
			'zone 2' => array('Frankston North', 'Seaford', 'Carrum Downs', 'Skye', 'Sandhurst', 'Baxter', 'Hastings', 'Langwarrin', 'Somerville', 'Tyabb', 'Safety Beach', 'Dromana'),
		);
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="<?php echo plugin_dir_url('booking-calendar'); ?>booking-calendar/assets/js/jquery.simple-calendar.js"></script>
		  <link rel="stylesheet" href="<?php echo plugin_dir_url('booking-calendar'); ?>booking-calendar/assets/js/simple-calendar.css">
		<form method="POST" action="" >
		<?php
		
			echo "<h2>".$product->get_name()."</h2>";
			
		?>
			<input type="hidden" name="product_name" value="<?php echo $product->get_name(); ?>" />
			<input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>" />
			<input type="hidden" name="product_price" value="<?php echo $product->get_price(); ?>" />
			<label for="zone">Choose a Zone:</label>
			<select name="zone" id="zone">
			<?php  foreach($zones as $zone => $suburbs) { ?>
			  <optgroup label="<?php echo $zone; ?>">
			  <?php  foreach($suburbs as $suburb) { ?>
				<option value="<?php echo $suburb; ?>"><?php echo $suburb; ?></option>
			  <?php } ?>	
			  </optgroup>
			<?php } ?>
			</select>
			
			<div id="container" class="calendar-container booking-calendar"></div>
			<script>
			  var $calendar;
			  $(document).ready(function () {
				let container = $("#container").simpleCalendar({
				  fixedStartDay: 0, // begin weeks by sunday
				  disableEmptyDetails: true,
				  events: [
					// generate new event after tomorrow for one hour
					{
					  startDate: new Date(new Date().setHours(new Date().getHours() + 24)).toDateString(),
					  endDate: new Date(new Date().setHours(new Date().getHours() + 25)).toISOString(),
					  summary: 'Visit of the Eiffel Tower'
					},
					// generate new event for yesterday at noon
					{
					  startDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 12, 0)).toISOString(),
					  endDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 11)).getTime(),
					  summary: 'Restaurant'
					},
					// generate new event for the last two days
					{
					  startDate: new Date(new Date().setHours(new Date().getHours() - 48)).toISOString(),
					  endDate: new Date(new Date().setHours(new Date().getHours() - 24)).getTime(),
					  summary: 'Visit of the Louvre'
					}
				  ],

				});
				$calendar = container.data('plugin_simpleCalendar')
			  });
			</script>
			<input type="file" class="button" value="" />
			<br/>
			<br/>
			<input type="submit" class="button" name="submit" value="Book Online" />
		</form>
		<?php
		}
}
// Adding Shortcode for book caledar page
add_shortcode( 'shortcode_ddcgroup_booking_calendar', 'ddcgroup_booking_calendar_function' );

// Changing Default Woocomerce plugin Button cart link
add_filter( 'woocommerce_loop_add_to_cart_link', 'ts_replace_add_to_cart_button', 10, 2 );

function ts_replace_add_to_cart_button( $button, $product ) {

	if (is_product_category() || is_shop()) {
		$button_text = __("Book Now", "woocommerce");
		$button_link = get_site_url().'/booking-calendar?product_id='.$product->get_id();
		$button = '<a class="button" href="' . $button_link . '">' . $button_text . '</a>';
		return $button;
	}
}