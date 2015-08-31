<?php
/*
Plugin Name: oAuth Instagram for Developers
Description: Instagram API compliant plugin that provides functions for grabbing Instagram posts, specifically from client's account. 
Version: 1.0
Author: Pyxl, Inc (Joel Rainwater)
Author URI: http://thinkpyxl.com
License: GPL2
*/
/*
Copyright 2012  Francis Yaconiello  (email : francis@yaconiello.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Options page with Instagram Account settings
require('instagram-for-developers-settings.php');

// Core function to get posts from Instagram
function getInstaPost($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	$result = json_decode($result);
	curl_close($ch);
	return $result;
}




/** Specific methods for getting different types of posts
	with different parameters **/
	

/**
 * Get Instagram post by shortcode. 
 * In example of http://www.instagram.com/p/D the shortcode is "D"
 *
 * @param string $media_id
 * @return json data
 */	
function getInstaByShortcode($shortcode){
	$token = get_option('ifd_access_token');
	$url = "http://api.instagram.com/v1/media/shortcode/$shortcode?access_token=$token";
	return getInstaPost($url);
}
	

/**
 * Get Instagram post by url
 *
 * @param string $insta_url	|	provide full url, e.g. http://www.instagram.com/p/D
 * @return json data
 */	
function getInstaByUrl($insta_url){
	$url = "http://api.instagram.com/publicapi/oembed?url=$insta_url";
	return getInstaPost($url);
}

/**
 * Get Instagram posts by hashtag
 *
 * @param string $tag	|	provide tag text without the #
 * @param int $count	|	number of posts to return
 * @return json data
 */
function getInstaByTag($tag, $count) {
	$client_id = get_option('ifd_client_id');
	$url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?count='.$count.'&client_id='.$client_id;
	return getInstaPost($url);
}

/**
 * Get recent posts by user
 *
 * @param int $count	|	number of posts to return
 * @return json data
 */
function getInstaFeed($count){
	$user_id = get_option('ifd_user_id');
	$token = get_option('ifd_access_token');
	$url = "https://api.instagram.com/v1/users/$user_id/media/recent/?access_token=$token&count=$count";
	return getInstaPost($url);
}
