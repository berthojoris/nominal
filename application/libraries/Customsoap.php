<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customsoap {

    function getDataFromSoap($dynamicIP, $proxyHost=null, $proxyPort=null, $proxyUsername=null, $proxyPassword=null) {
		$root = $_SERVER['DOCUMENT_ROOT'];
		$ipServer = $_SERVER['SERVER_ADDR'];
		if($ipServer == "127.0.0.1") {
			require_once($root . "/application/libraries/nusoap.php");
		} else {
			require_once($root . "/nominal/application/libraries/nusoap.php");
		}
        
        $proxyhost = !is_null($proxyHost) ? $proxyHost : '';
		$proxyport = !is_null($proxyPort) ? $proxyPort : '';
		$proxyusername = !is_null($proxyUsername) ? $proxyUsername : '';
		$proxypassword = !is_null($proxyPassword) ? $proxyPassword : '';

    	$client = new nusoap_client('http://10.35.65.11:8080/arsys/services/ARService?server=10.35.65.10&webService=BRI:INC:GetInfoFromIPAddress', '', $proxyhost, $proxyport, $proxyusername, $proxypassword);
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		}
		$headers = array('AuthenticationInfo' => array('userName' => 'int_nominal', 'password' => '123456'));
        $client->setHeaders($headers);
        $staticIP = "55.25.4.1";
		$param = array('IPAddress' => $dynamicIP);
		$result = $client->call('Get_ticket_info',  $param, '', '', false, true);

		if ($client->fault) {
		    $jsonOutput = json_encode([
                'incident_number' => '-',
                'description' => '-',
                'notes' => '-',
                'status' => '-',
				'code' => 500,
				'msg' => 'Soap Client Fault'
            ]);
		} else {
			$err = $client->getError();
			if($err) {
				$jsonOutput = json_encode([
					'incident_number' => '-',
					'description' => '-',
					'notes' => '-',
					'status' => '-',
					'code' => 500,
					'msg' => 'Soap Client Error'
				]);
			} else {
			    $jsonOutput = json_encode([
			        'incident_number' => $result['IncidentNumber'],
			        'description' => $result['Description'],
			        'status' => $result['Status'],
			        'code' => 200
			    ]);
			}
		}

		echo $jsonOutput;
	}

}