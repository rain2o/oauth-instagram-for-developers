=== oAuth Instagram for Developers ===
Contributors: rain2o
Tags: instagram, oauth, feed
Version: 1.0
License: MIT
License URI: http://opensource.org/licenses/MIT

Instagram API v1 compliant plugin that provides functions to get an array of Instagram posts for use in themes.

== Description ==

Instagram API v1 compliant plugin that provides functions to get an array of Instagram posts for use in themes.

Instagram API v1 compliant plugin that provides functions to get an array of Instagram posts for use in themes.

There are multiple functions available depending on your Instagram feed needs. For more details about the Instagram API, check out [Instagram's Developer Documentation](https://instagram.com/developer/endpoints/). The available functions in this plugin are as follows.

- getInstaByShortcode($shortcode): Gets a single Instagram post using the given shortcode. The shortcode is the alpha-numeric id in the url of the post, after `https://instagram.com/p/`.
- getInstaByUrl($insta_url): Gets a single Instagram post using the full URL of the post. This works the same as the shortcode, but it does not require the user to strip the shortcode from the URL. The parameter `$insta_url` should look something like `https://instagram.com/p/A1B2C3`. 
- getInstaByTag($tag, $count): Returns an array of the most recent public posts using the given hashtag, limited to `$count`. The parameter `$tag` should **not** include the hashtag. 
- getInstaFeed($count): Returns an array of the most recent posts by the user provided in the plugin's Settings page, limited to `$count`.


== Installation ==

Upload the files to your wp-content/plugins directory.

Navigate to the Settings > Instagram oAuth.

Here you'll find settings fields to authenticate with Instagram.  You'll need to create a new Application on https://instagram.com/developer. Under Valid redirect URIs, include http://`{base-url}`/wp-admin/options-general.php?page=ifd_settings as a valid URI, replacing `{base-url}` with the base URL of your WordPress site. In the **Security** tab, be sure to uncheck "Disable Implicit OAuth" for this to work. 

Once you've create the app, copy and paste your Client ID and Client Secret into their respective fields in the plugin settings page and click Save Changes. After you have saved, click the link provided in the settings page's description to generate an authentication token. It will redirect you back to the settings page with the Authentication ID already filled out. You will need to click Save Changes again to save this value. If it does not fill out the field with that value there was an issue validating your application. Make sure your settings are correct. 

Now, anywhere in your theme files you can call the functions provided to get Instagram posts. 


== About ==

Version: 1.0
Written by Joel Rainwater of Pyxl - <http://www.thinkpyxl.com>