<?php
/**
 * 返回OAuth2 登录地址
 * @return string
 */
function getOAuth2Url() {
    $params = array(
        'client_id'     => constant("CLIENT_ID"),
        'redirect_uri'  => constant("REDIRECT_URI"),
        'response_type' => 'code',
        'scope'         => constant("SCOPE")
    );
    $urlParams = http_build_query($params);
    return $url = constant("LOGIN_URL") . constant('ENDPOINT_OAUTH2').'?'.$urlParams;
}

/**
 * 返回当前语言
 * @return string　zh-cn/en
 */
function dectLang() {
	if (trim($_GET['language']) == "zh-cn") { 
		setcookie('deepin_language', "zh-cn", time()+(60*60*24*365), '/', constant("COOKIE_DOMAIN"));
		return "zh-cn";

	} else if (trim($_GET['language']) == "en") {
		setcookie('deepin_language', "en", time()+(60*60*24*365), '/', constant("COOKIE_DOMAIN"));
		return "en";
	}

	if (array_key_exists("deepin_language", $_COOKIE)
			&& ($deepin_language = $_COOKIE["deepin_language"]) != ""){
		if ($deepin_language != "zh-cn" && $deepin_language != "en"){
			return "zh-cn";
		} else {
			return $deepin_language;
		}
	}

	if (array_key_exists("HTTP_ACCEPT_LANGUAGE", $_SERVER)
			&& (($browser = $_SERVER["HTTP_ACCEPT_LANGUAGE"]) != "")){
		if (strncasecmp($browser, "zh-cn", 5) !== false){
			return "zh-cn";
		} else {
			return "en";
		}
	}
	return "zh-cn";
}

/**
 * curl　get
 * @return json
 */
function getCurl($url = '', $param = array())
{
    $paramStr = '';
    if (is_array($param) && count($param)) {
        foreach ($param as $index => $value) {
            $paramStr .= $index . '=' . $value . '&';
        }
        $paramStr = substr($paramStr, 0, -1);
        $requestUrl = $url . '?' . $paramStr;
    } else {
        $requestUrl = $url;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $requestUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch) or die(curl_error($ch));
    curl_close($ch);
    return $data ? $data : false;
}

/**
 * curl　post
 * @return json
 */
function postCurl($url, $post_data)
{
    if (is_array($post_data)) {
        $params = '';
        foreach ($post_data as $key => $val) {
            if (is_array($val)) {
                foreach (@$val as $key2 => $val2) {
                    @$params .= @$key . '[' . @$key2 . ']=' . $val2 . '&';
                }
            } else {
                $params .= $key . '=' . $val . '&';
            }
        }
        $params = substr($params, 0, -1);
    } else {
        return false;
    }

    $ch = curl_init() or exit(curl_error());;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    if ($post_data != '') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $file_contents = curl_exec($ch);
    curl_close($ch);
    return $file_contents;
}

/**
 * Get access_token 
 *
 * @param  string $code
 * @return
 */
function getAccessToken($code)
{
    $post_data = array(
        'client_id' => constant("CLIENT_ID"),
        'client_secret' => constant("CLIENT_SECRET"),
        'redirect_uri' => constant("REDIRECT_URI"),
        'grant_type' => 'authorization_code',
        'code' => $code,
    );
    $request_data = postCurl(constant("LOGIN_URL") . constant("ENDPOINT_TOKEN"), $post_data);
    return json_decode($request_data, 1);
}

/**
 * Get userinfo 
 *
 * @param  string $access_token
 * @return
 */
function getUserInfo($access_token)
{
    $param = array('access_token' => $access_token);
    $request_data = getCurl(constant("API_URL") . constant("ENDPOINT_USER"), $param);
    return json_decode($request_data, 1);
}

function getUserCommonInfo($param)
{
    $requestData = getCurl(constant("API_URL") . constant("ENDPOINT_USERS") . trim($param));
    return json_decode($requestData, 1);
}

?>