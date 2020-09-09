<?php

//破解 zhuchunshu.com
error_reporting(E_ALL ^ E_NOTICE);
function add_baiduAudio_js()
{
	echo '<script src="' . get_stylesheet_directory_uri() . '/pandastudio_plugins/baiduAudio/baiduAudio.js"></script>';
	echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/pandastudio_plugins/baiduAudio/baiduAudio.css"/>';
}
add_action('wp_footer', 'add_baiduAudio_js');
add_filter('modify_pandastudio_translation_array', 'add_baiduAudio_translation_array');
function add_baiduAudio_translation_array($O00O00O0OO)
{
	$O00O00OO00 = get_cache('bd_audio_tok');
	if ($O00O00OO00 == false) {
		$O00O00OO0O = 'fKTeA2Gju6WsXMHWXvouDitG';
		$O00O00OOO0 = 'U01XiwxeOqd4YnYXGggCyveOtgfR9OyN';
		$O00O00OOOO = 'https://openapi.baidu.com/oauth/2.0/token?grant_type=client_credentials&client_id=' . $O00O00OO0O . '&client_secret=' . $O00O00OOO0;
		$O00O00OO00 = file_get_contents($O00O00OOOO);
		$O00O00OO00 = json_decode($O00O00OO00, true);
		if ($O00O00OO00['access_token']) {
			set_cache('bd_audio_tok', ['access_token' => $O00O00OO00['access_token'], 'session_key' => $O00O00OO00['session_key']], $O00O00OO00[expires_in] * 0.9);
		}
	}
	$O00O00O0OO['baiduAudio'] = array_merge(get_cache('bd_audio_tok'), array('spd' => get_option('baidu_ai_audio_spd') ?: 5, 'pit' => get_option('baidu_ai_audio_pit') ?: 5, 'per' => get_option('baidu_ai_audio_per') ?: 0, 'enable' => get_option('baidu_ai_audio_enable') == 'checked'));
	return $O00O00O0OO;
}
add_filter('modify_pandastudio_options', 'add_baiduAudio_to_options');
function add_baiduAudio_to_options($O00O0O000O)
{
	$O00O0O00O0 = file_get_contents('baiduAudio_option.json', 1);
	$O00O0O00OO = json_decode($O00O0O00O0, true);
	$O00O0O0O00 = array_merge($O00O0O000O, $O00O0O00OO);
	return $O00O0O0O00;
}