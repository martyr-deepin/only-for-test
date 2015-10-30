<?php
	function getCurl($url='', $param = array()) {
		$paramStr='';
		if (is_array($param) && count($param)) {
			foreach ($param as $index=>$value) {
				$paramStr.=$index.'='.$value.'&';
			}
			$paramStr = substr($paramStr ,0 ,-1);
			$requestUrl = $url.'?'.$paramStr;
		} else {
			$requestUrl=$url;
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $requestUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch) or die(curl_error($ch));
		curl_close($ch);
		return $data ? $data : false;
	}

	function postCurl($url ,$post_data) {
		if(is_array($post_data)){
			$params = '';
			foreach($post_data as $key=>$val) {
				if(is_array($val)){
					foreach(@$val as $key2=>$val2){
						@$params .= @$key.'['.@$key2.']='.$val2.'&';
					}
				}
				else{
					$params .= $key.'='.$val.'&';
				}
			}
			$params = substr($params, 0, -1);
		}else{
			return false;
		}

	 	$ch = curl_init() or exit(curl_error());;
	 	curl_setopt($ch, CURLOPT_URL, $url);
	 	curl_setopt($ch, CURLOPT_POST, 1);
	 	if($post_data != '') {
	 		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	 	}
	 	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
	  	//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	  	curl_setopt($ch, CURLOPT_HEADER, 0);
	 	$file_contents = curl_exec($ch);
	 	curl_close($ch);
	 	return $file_contents;
	}	

	/**
	 * Get access_token info.
	 *
	 * @param  string  $code
	 * @return 
	 */
	function getAccessToken($code) {
		$post_data = array(
			'client_id'     => '20808e496366f82485da377de935a3a5f2f6707d',
			'client_secret' => 'b7c589158ea22b42409b71d2ffc83c4d5740e1d2',
			'redirect_uri'  => 'http://blog.deepin.org/wp-content/themes/deepin2015/deepin-login.php',
			'grant_type'    => 'authorization_code',
			'code'          => $code,	 
		);
		$request_data = postCurl('https://api.deepin.org/oauth2/token' ,$post_data);
		return json_decode($request_data ,1);
	}

	function getUserInfo($access_token) {
		$param = array('access_token' => $access_token);
		$request_data = getCurl('https://api.deepin.org/v1/user' ,$param);
		return json_decode($request_data,1);
	}

	function getUserCommonInfo($param) {
		$requestData = getCurl('https://api.deepin.org/v1/users'.trim($param));
		return json_decode($requestData,1);
	}




	$access_info = getAccessToken($_GET['code']);
	$user_info = getUserInfo($access_info['access_token']);
	//用户头像
	setcookie('AVATAR', $user_info['avatar'], time()+3600, '/');




	define('WP_ROOT', join( DIRECTORY_SEPARATOR, array_slice( explode( DIRECTORY_SEPARATOR, dirname( __FILE__ ) ), 0, -4 ) ) );
	require_once( WP_ROOT . '/blog.deepin.org/wp-load.php');
	if(username_exists($user_info['username'])) {
	    $user_id = username_exists($user_info['username']);
	    wp_set_auth_cookie($user_id);
	} else {
	    $user_id = wp_create_user($user_info['username'], 'deepinpassword', $user_info['email']);
	    wp_set_auth_cookie($user_id);
	}


	header("location:http://blog.deepin.org"); 
?>