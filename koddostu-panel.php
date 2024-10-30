<?php
/**
* Plugin Name: Koddostu Panel
* Plugin URI: http://panel.koddostu.com/wp.html
* Description: A plugin to easily implement Koddostu Panel on any wordpress blog or website.
* Version: 1.0
* Author: G. Mete Erturk
* Author URI: http://e-mete.com/
* License: GPL2
*Koddostu Panel is free software: you can redistribute it and/or modify
*it under the terms of the GNU General Public License as published by
*the Free Software Foundation, either version 2 of the License, or
*any later version.
* 
*Koddostu Panel is distributed in the hope that it will be useful,
*but WITHOUT ANY WARRANTY; without even the implied warranty of
*MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
*GNU General Public License for more details.
* 
*You should have received a copy of the GNU General Public License
*along with Koddostu Panel. If not, see panel.koddostu.com
**/

function koddostu_panel_plugin_menu() {
	add_options_page( 'Koddostu Panel Ayarları', 'Koddostu Panel', 'manage_options', 'koddostu-panel-identifier', 'koddostu_panel_plugin_options' );
}

add_action( 'admin_menu', 'koddostu_panel_plugin_menu' );

// add the admin settings and such
add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init(){
register_setting( 'plugin_optionskhgba', 'plugin_optionskhgba', 'plugin_options_validate' );
add_settings_section('plugin_mainkhgba', 'Panel Kodunuz:', 'plugin_section_text', 'plugin');
add_settings_field('plugin_text_stringkhgba', 'Panel Kodunuz', 'plugin_setting_string', 'plugin', 'plugin_mainkhgba');
}

 function plugin_setting_string() {
$options = get_option('plugin_optionskhgba');
echo "<input id='plugin_text_string' name='plugin_optionskhgba[text_string]' size='40' type='text' value='{$options['text_string']}' />";
} 

 function plugin_section_text() {
echo '<p>panel.koddostu.com\'dan aldığınız panel kodunu girin.</p>';
}

function plugin_options_validate($input) {
$newinput['text_string'] = trim($input['text_string']);
if(!preg_match('/^(siteid=)([0-9]+)(&hesapid=)([0-9]+)$/', $newinput['text_string'])) {
$newinput['text_string'] = '';
}
return $newinput;
}

function koddostu_panel_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
?>
<div>
<h2>Koddostu Panel Ayarları</h2>
Koddostu Panel seçenekleri sayfasıdır.
<form action="options.php" method="post">
<?php settings_fields('plugin_optionskhgba'); ?>
<?php do_settings_sections('plugin'); ?>
 
<input name="Submit" type="submit" value="Kaydet" />
</form></div>
 
<?php
}

function kd_panel_js_installer() {
	
	if(get_option("plugin_optionskhgba") === FALSE){
	}
	else if(strlen(get_option("plugin_optionskhgba")["text_string"]) >= 17){
	echo "<script type='text/javascript' src='http://panel.koddostu.com/js/handler.php?" . get_option("plugin_optionskhgba")["text_string"] . "'></script>";
	}
}
add_action('wp_footer', 'kd_panel_js_installer');