<?php
// CRM server connection data
define('CRM_HOST', 'domain.bitrix24.ru'); // your CRM domain name
define('CRM_PORT', '443'); // CRM server port
define('CRM_PATH', '/crm/configs/import/lead.php'); // CRM server REST service path

// CRM server authorization data
define('CRM_LOGIN', 'e@mail.ltd'); // login of a CRM user able to manage leads
define('CRM_PASSWORD', 'yourpassword'); // password of a CRM user
// OR you can send special authorization hash which is sent by server after first successful connection with login and password
//define('CRM_AUTH', 'e54ec19f0c5f092ea11145b80f465e1a'); // authorization hash

/********************************************************************************************/

// POST processing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$leadData = $_POST;

	// get lead data from the form
	$postData = array(
		'TITLE' => $leadData['TITLE'],
		'NAME' => $leadData['NAME'],
		'EMAIL_HOME' => $leadData['EMAIL_HOME'],
		'COMMENTS' => $leadData['COMMENTS'],
    		'ASSIGNED_BY_ID' => '', // id responsible for lead
	);

	// append authorization data
	if (defined('CRM_AUTH')) {
		$postData['AUTH'] = CRM_AUTH;
	} else {
		$postData['LOGIN'] = CRM_LOGIN;
		$postData['PASSWORD'] = CRM_PASSWORD;
	}

	// open socket to CRM
	$fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
	if ($fp) {
		// prepare POST data
		$strPostData = '';
		foreach ($postData as $key => $value)
			$strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

		// prepare POST headers
		$str = "POST ".CRM_PATH." HTTP/1.0\r\n";
		$str .= "Host: ".CRM_HOST."\r\n";
		$str .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$str .= "Content-Length: ".strlen($strPostData)."\r\n";
		$str .= "Connection: close\r\n\r\n";

		$str .= $strPostData;

		// send POST to CRM
		fwrite($fp, $str);

		// get CRM headers
		$result = '';
		while (!feof($fp))
		{
			$result .= fgets($fp, 128);
		}
		fclose($fp);

		// cut response headers
		$response = explode("\r\n\r\n", $result);

		$output = '<pre>'.print_r($response[1], 1).'</pre>';
	} else {
		echo 'Connection Failed! '.$errstr.' ('.$errno.')';
	}
}
else {
	$output = '';
}
