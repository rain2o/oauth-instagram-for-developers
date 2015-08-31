<?php

//Add an option page
if (is_admin()) {
  add_action('admin_menu', 'ifd_menu');
  add_action('admin_init', 'ifd_register_settings');
}

function ifd_menu() {
	add_options_page('Instagram for Developers','Instagram oAuth','manage_options','ifd_settings','ifd_settings_output');
}

function ifd_settings() {
	$ifd = array();
	$ifd[] = array('name'=>'ifd_client_id','label'=>'Instagram Application Client ID');
	$ifd[] = array('name'=>'ifd_client_secret','label'=>'Instagram Application Client Secret');
	$ifd[] = array('name'=>'ifd_access_token','label'=>'Instagram User Access Token');
	$ifd[] = array('name'=>'ifd_user_id','label'=> 'Instagram User ID');
	return $ifd;
}

function ifd_register_settings() {
	$settings = ifd_settings();
	foreach($settings as $setting) {
		register_setting('ifd_settings',$setting['name']);
	}
}


function ifd_settings_output() {
	$settings = ifd_settings();
		
	echo '<div class="wrap">';
	echo '<h2>oAuth Instagram for Developers</h2>';
	echo "<p>Access Token and User ID are only needed if pulling posts from user's account.</p>";
	echo "<p>To find the user's ID, you can use <a href='http://jelled.com/instagram/lookup-user-id' target='_blank'>this tool</a>.</p>";
	echo "<p>To get your Access Token, first save your Client ID and Secret below. Then ";
	echo "<a href='https://api.instagram.com/oauth/authorize/?client_id=".get_option('ifd_client_id')."&redirect_uri=".admin_url('options-general.php?page=ifd_settings')."&response_type=token'>click here</a>.";
	echo "You should be redirected here and the token will be in the field. Be sure to click Save.</p>";
	echo '<hr />';	
	echo '<form method="post" action="options.php">';
		
    settings_fields('ifd_settings');

	echo '<table>';
	foreach($settings as $setting) {
		echo '<tr>';
		echo '<td>'.$setting['label'].'</td>';
		echo '<td><input type="text" style="width: 400px" name="'.$setting['name'].'" value="'.get_option($setting['name']).'" /></td>';
		echo '</tr>';
	}
	echo '</table>';
	
	submit_button();
	
	echo '</form>';	
	echo '</div>';
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			var hash = window.location.hash,
				token = hash.substring(14);
			if (hash){
				$('input[name="ifd_access_token"]').val(token);
			}	
		})
	</script>
	<?php
	
}