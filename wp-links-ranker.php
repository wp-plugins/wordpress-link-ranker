<?php
/*
  Plugin Name: WordPress Link Ranker
  Plugin URI: http://www.moallemi.ir/blog
  Description: This plugin adds the Google Page Rank and Alexa Rank to Links Page in WordPress admin panel
  Version: 0.2
  Author: Reza Moallemi
  Author URI: http://www.moallemi.ir/blog
  Text Domain: wp-link-ranker
  Domain Path: /languages/
 */


load_plugin_textdomain('wp-link-ranker', NULL, dirname(plugin_basename(__FILE__)) . "/languages");

	add_action('admin_menu', 'wplr_menu');

	function wplr_menu() 
	{
		add_options_page('Links Ranker', __('Links Ranker', 'wp-link-ranker'), 8, 'wp-link-ranker', 'wplr_options');
	}

	function wplr_get_options() {
		$wplr_options = array('enable_alexa' => 'true',
								'enable_google' => 'true',);
		$wplr_save_options = get_option('wplr_options');
		if (!empty($wplr_save_options)) {
			foreach ($wplr_save_options as $key => $option)
			$wplr_options[$key] = $option;
		}
		update_option('wplr_options', $wplr_options);
		return $wplr_options;
	}

	function wplr_options() {
		$wplr_options = wplr_get_options();
		
		if (isset($_POST['update_wplr_settings'])) {
			$wplr_options['enable_alexa'] = isset($_POST['enable_alexa']) ? $_POST['enable_alexa'] : 'false';
			$wplr_options['enable_google'] = isset($_POST['enable_google']) ? $_POST['enable_google'] : 'false';

			update_option('wplr_options', $wplr_options);
			?>
			<div class="updated">
				<p><strong><?php _e("Settings Saved.","wp-link-ranker");?></strong></p>
			</div>
			<?php
		} ?>
		<div class="wrap">
		<?php if(function_exists('screen_icon')) screen_icon(); ?>
			<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
				<h2><?php _e('WordPress Links Ranker Settings', 'wp-link-ranker'); ?></h2>
				<p>
					<input class="checkbox" type="checkbox" value="true" <?php checked($wplr_options['enable_alexa'], 'true', true) ?> name="enable_alexa" />
					<?php _e(' Enable Alexa Rank', 'wp-link-ranker'); ?>
				</p>
				<p>
					<input class="checkbox" type="checkbox" value="true" <?php checked($wplr_options['enable_google'], 'true', true) ?> name="enable_google" />
					<?php _e(' Enable Google Page Rank', 'wp-link-ranker'); ?>
				</p>
				<div class="submit">
					<input class="button-primary" type="submit" name="update_wplr_settings" value="<?php _e('Save Changes', 'wp-link-ranker'); ?>" />
				</div>
				<hr />
				<div>
					<p>
						<h4><?php _e('Plugin Sponsored by: ', 'wp-link-ranker'); ?> <a href="http://www.pcday.ir">pcday.ir</a></h4>
					</p>
					<h4><?php _e('My other plugins for wordpress:', 'wp-link-ranker'); ?></h4>
					<ul>
						<li><b><font color="red">- <?php _e('Google Reader Stats ', 'wp-link-ranker'); ?></font></b>
							(<a href="http://wordpress.org/extend/plugins/google-reader-stats/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/en/blog/2010/06/03/google-reader-stats-for-wordpress/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
						<li><b>- <?php _e('Gravatar Like ', 'wp-link-ranker'); ?></b>
							(<a href="http://wordpress.org/extend/plugins/gravatar-like/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/blog/1390/07/13/%d9%85%d8%b9%d8%b1%d9%81%db%8c-%d8%a7%d9%81%d8%b2%d9%88%d9%86%d9%87-%d9%88%d8%b1%d8%af%d9%be%d8%b1%d8%b3-%da%af%d8%b1%d8%a7%d9%88%d8%a7%d8%aa%d8%a7%d8%b1-%d9%84%d8%a7%db%8c%da%a9/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
						<li><b>- <?php _e('Extended Gravatar ', 'wp-link-ranker'); ?></b>
							(<a href="http://wordpress.org/extend/plugins/extended-gravatar/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/blog/1390/05/09/%d8%a7%d9%81%d8%b2%d9%88%d9%86%d9%87-%d9%88%d8%b1%d8%af%d9%be%d8%b1%d8%b3-%da%af%d8%b1%d8%a7%d9%88%d8%a7%d8%aa%d8%a7%d8%b1-%d8%aa%d9%88%d8%b3%d8%b9%d9%87-%db%8c%d8%a7%d9%81%d8%aa%d9%87/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
						<li><b>- <?php _e('Advanced User Agent Displayer ', 'wp-link-ranker'); ?></b>
							(<a href="http://wordpress.org/extend/plugins/advanced-user-agent-displayer/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/en/blog/2009/09/20/advanced-user-agent-displayer/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
						<li><b>- <?php _e('Likekhor ', 'wp-link-ranker'); ?></b>
							(<a href="http://wordpress.org/extend/plugins/wp-likekhor/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/blog/1389/04/30/%D9%85%D8%B9%D8%B1%D9%81%DB%8C-%D8%A7%D9%81%D8%B2%D9%88%D9%86%D9%87-%D9%84%D8%A7%DB%8C%DA%A9-%D8%AE%D9%88%D8%B1-%D9%88%D8%B1%D8%AF%D9%BE%D8%B1%D8%B3/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
						<li><b>- <?php _e('Google Transliteration ', 'wp-link-ranker'); ?></b>
							(<a href="http://wordpress.org/extend/plugins/google-transliteration/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/en/blog/2009/10/10/google-transliteration-for-wordpress/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
						<li><b>- <?php _e('Behnevis Transliteration ', 'wp-link-ranker'); ?></b> 
							(<a href="http://wordpress.org/extend/plugins/behnevis-transliteration/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="http://www.moallemi.ir/blog/1388/07/25/%D8%A7%D9%81%D8%B2%D9%88%D9%86%D9%87-%D9%86%D9%88%DB%8C%D8%B3%D9%87-%DA%AF%D8%B1%D8%AF%D8%A7%D9%86-%D8%A8%D9%87%D9%86%D9%88%DB%8C%D8%B3-%D8%A8%D8%B1%D8%A7%DB%8C-%D9%88%D8%B1%D8%AF%D9%BE%D8%B1%D8%B3/"><?php _e('More Information', 'wp-link-ranker'); ?></a> )
						</li>
						<li><b>- <?php _e('Comments On Feed ', 'wp-link-ranker'); ?></b> 
							(<a href="http://wordpress.org/extend/plugins/comments-on-feed/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/en/blog/2009/12/18/comments-on-feed-for-wordpress/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
						<li><b>- <?php _e('Feed Delay ', 'wp-link-ranker'); ?></b> 
							(<a href="http://wordpress.org/extend/plugins/feed-delay/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/en/blog/2010/02/25/feed-delay-for-wordpress/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
						<li><b>- <?php _e('Contact Commenter ', 'wp-link-ranker'); ?></b> 
							(<a href="http://wordpress.org/extend/plugins/contact-commenter/"><?php _e('Download', 'wp-link-ranker'); ?></a> | 
							<a href="<?php _e('http://www.moallemi.ir/blog/1388/12/27/%d9%87%d8%af%db%8c%d9%87-%da%a9%d8%a7%d9%88%d8%b4%da%af%d8%b1-%d9%85%d9%86%d8%a7%d8%b3%d8%a8%d8%aa-%d8%b3%d8%a7%d9%84-%d9%86%d9%88-%d9%88%d8%b1%d8%af%d9%be%d8%b1%d8%b3/', 'wp-link-ranker'); ?>"><?php _e('More Information', 'wp-link-ranker'); ?></a>)
						</li>
					</ul>
				</div>
			</form>
		</div>
		<?php
	}

add_filter('manage_link-manager_columns', 'wplr_manage_link_columns');
add_action('manage_link_custom_column', 'wplr_manage_link_custom_column', 10 , 2);

function wplr_manage_link_columns($columns) {
		
		$wplr_options = wplr_get_options();
		if($wplr_options['enable_alexa'] == 'false' and $wplr_options['enable_google'] == 'false')
		return $columns;

    $columns['rank'] = __('Rank', 'wp-link-ranker');
    return $columns;
}

function wplr_manage_link_custom_column($name, $id) {

    switch ($name) {
        case 'rank':
						$wplr_options = wplr_get_options();
						$url = get_bookmark_field( 'link_url', $id);
						
						if($wplr_options['enable_alexa'] == 'true') {

							echo 'Alexa Rank: <b>'.alexaRank($url). '</b>';
						}
						if($wplr_options['enable_google'] == 'true') {
						
							include_once 'lib/class.seostats.php';
							try {
								$url = new SEOstats($url);
								echo '<br /> Google Page Rank: <b>'.$url->Google_Page_Rank(). '</b>';
							} 
							catch (SEOstatsException $e) { echo ($e->getMessage()); }
						}
            break;
    }
}

function alexaRank($domain){
    $remote_url = 'http://data.alexa.com/data?cli=10&dat=snbamz&url='.trim($domain);
    $search_for = '<POPULARITY URL';
    if ($handle = @fopen($remote_url, "r")) {
        while (!feof($handle)) {
            $part .= fread($handle, 100);
            $pos = strpos($part, $search_for);
            if ($pos === false)
            continue;
            else
            break;
        }
        $part .= fread($handle, 100);
        fclose($handle);
    }
    $str = explode($search_for, $part);
    $str = array_shift(explode('"/>', $str[1]));
    $str = explode('TEXT="', $str);
    $str = explode(' ', $str[1]);

    return str_replace('"', '', $str[0]);
}