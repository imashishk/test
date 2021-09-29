<?php
add_action( 'admin_menu', 'page_booking_calendar' );  

function page_booking_calendar(){  
 
		$page_title = 'Booking Calendar DDcgroup';  
		$menu_title = 'Booking Calendar DDcgroup';  
		$capability = 'manage_options';  
		$menu_slug  = 'booking_calendar_ddcgroup';
		$function   = 'admin_booking_calendar_ddcgroup';  
		$icon_url   = 'dashicons-calendar'; 
		$position   = 20;  
		
		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function,$icon_url,$position ); 
		
}

function admin_booking_calendar_ddcgroup(){
	
	$pluginurl = admin_url().'admin.php?page=booking_calendar_ddcgroup';
	
		$bookingeventname = '';
		$bookingeventdate = '';
		$bookingeventtime = array();
		$eventaction = '';
		$eventid = '';
		
	
		$booking_detailabc =  unserialize(get_option( 'booking_detail'));
		
		
		
	if(!empty($booking_detailabc)) {
		$booking_detail = $booking_detailabc;
	}else {
		$booking_detail = array();
	}
	// Adding Event to Admin

	if(isset($_GET['eventedit'])){
		$booking_detailedit =  unserialize(get_option( 'booking_detail'));
		$eventdetail = $booking_detailedit[$_GET['eventedit']];
		
		$bookingeventname = $eventdetail['eventname'];
		$bookingeventdate = $eventdetail['eventdate'];
		$bookingeventtime = $eventdetail['eventtime'];
		$eventaction = 'eventedit';
		$eventid = $_GET['eventedit'];
	}
	 if(isset($_GET['eventdelete'])){
			
			unset($booking_detail[$_GET['eventdelete']]);
			
			$booking_detail_data =  serialize($booking_detail);
			
			update_option( 'booking_detail', $booking_detail_data, $autoload = null );
			
			if ( wp_redirect($pluginurl) ) {
				exit;
			}
		}
		

	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'Book Slot'){
		
		if($_POST['eventaction']=="eventedit"){
				//$booking_detail_db =  unserialize(get_option('booking_detail'));
				
				$booking_detail[$_POST['eventid']]['eventname'] = $_POST['bookingeventname'];
				$booking_detail[$_POST['eventid']]['eventdate'] = $_POST['bookingeventdate'];
				$booking_detail[$_POST['eventid']]['eventtime'] = $_POST['bookingeventtime'];
			
		} else {
			$data = array(
				'eventname' => $_POST['bookingeventname'],
				'eventdate' => $_POST['bookingeventdate'],
				'eventtime' => $_POST['bookingeventtime'],
			);
			
			array_push($booking_detail,$data);
		}
		
			$booking_detail_data =  serialize($booking_detail);
			
			$booking_detaildv =  get_option( 'booking_detail');

				if($booking_detaildv != null) { 
					update_option( 'booking_detail', $booking_detail_data, $autoload = null );
				} else{
					add_option( 'booking_detail', $booking_detail_data);	
				}
		
			if ( wp_redirect($pluginurl) ) {
				exit;
			}
	}
	
?>
	<form method="post" action="" />
		<h1>Booking Calendar Event</h1>
		<a class="button button-primary" href="<?php echo admin_url(); ?>admin.php?page=booking_calendar_ddcgroup">Add New Event</a>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="bookingeventname">Booking Event Title</label></th>
					<td><input name="bookingeventname" type="text" id="bookingeventname" value="<?php echo $bookingeventname; ?>" class="regular-text" ></td>
				</tr>
				<tr>
					<th scope="row"><label for="bookingeventdate">Booking Date</label></th>
					<td><input name="bookingeventdate" type="date" id="bookingeventdate" value="<?php echo $bookingeventdate; ?>" class="regular-text" ></td>
				</tr>
				<tr>
					<th scope="row"><label for="bookingeventtime">Booking Time</label></th>
					<td>
					<?php
					 $timing = array("9:00 am","9:30 am","10:00 am","10:30 am","11:00 am","11:30 am","12:00 pm","12:30 pm","1:00 pm","1:30 pm","2:00 pm","2:30 pm","3:30 pm","4:00 pm","4:30 pm","5:00 pm","5:30 pm");
					  foreach ($timing as $timeall)  {
						  
						  if(in_array($timeall,$bookingeventtime)) {
					 ?>
					 <label style="margin-right:9px;">
					 <input type="checkbox" id="bookingeventtime" checked name="bookingeventtime[]" value="<?php echo $timeall; ?>"><?php echo $timeall; ?></label>			
					 <?php
					  } else {
					 ?>	
						<label style="margin-right:9px;">
					 <input type="checkbox" id="bookingeventtime" name="bookingeventtime[]" value="<?php echo $timeall; ?>"><?php echo $timeall; ?></label>	
					 <?php
						}
					  }
					 ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<input type="hidden" name="eventaction" value="<?php echo $eventaction; ?>">
					<input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
					<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Book Slot"></p></td>
				</tr>
			</tbody>	
		</table>
	</form>

	<table class="form-table">
			<thead>
				<tr>
					<th>Event Name</th>
					<th>Event Date</th>
					<th>Event Time</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			if(!empty(get_option('booking_detail') )){
			$booking_detail = unserialize(get_option('booking_detail'));
			
			}
			
			else{
			$booking_detail = array();	
			}
if(!empty($booking_detail )){
	foreach($booking_detail as $key => $detail) {
	?>
				<tr>
					<td><?php echo $detail['eventname']; ?></td>
					<td><?php echo $detail['eventdate']; ?></td>
					<td>
					<?php 
					foreach($detail['eventtime'] as $eventtime) {
					 echo '<span style="padding: 3px 6px;border: 1px solid #aaa;margin: 2px;display: inline-block;">'.$eventtime.'</span>';
					}
					?>
					</td>
					<td><a href="<?php echo admin_url(); ?>admin.php?page=booking_calendar_ddcgroup&eventedit=<?php echo $key; ?>">Edit</a>  <a href="<?php echo admin_url(); ?>admin.php?page=booking_calendar_ddcgroup&eventdelete=<?php echo $key; ?>">Delete</a></td> 
				</tr>
				<?php 
					}
}
					?>
			</tbody>	
		</table>
	<?php
}