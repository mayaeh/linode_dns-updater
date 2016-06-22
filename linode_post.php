<?php

require_once('config.php');


//$command='domain.list';

//$command = 'domain.resource.list';
//$data = 'DomainID='. LINODE_DOMAIN_ID. 
//	'&ResourceID='. LINODE_RESOURCE_ID;

$command = 'domain.resource.update';
$data = 'DomainID='. LINODE_DOMAIN_ID. 
	'&ResourceID='. LINODE_RESOURCE_ID. 
	'&Target=[remote_addr]';


var_dump(linode_post($command, $data));


function linode_post($command, $data) {

	$url = 'https://api.linode.com/';

	$args = 'api_key='. LINODE_API_KEY. 
		'&api_action='. $command;

	if(isset($data)) {

		$args .= '&'. $data;
	}

// for debug
//return $url. '?'. $args;

	if (function_exists('curl_version')){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);

		$result = curl_exec($ch);
		curl_close($ch);

		return $result ? json_decode($result, true) : false;

	}

}

?>
