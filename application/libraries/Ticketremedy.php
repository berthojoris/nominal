<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ticketremedy {

	function postTicketRemedy($dynamicIP, $proxyHost=null, $proxyPort=null, $proxyUsername=null, $proxyPassword=null) {
		$root = $_SERVER['DOCUMENT_ROOT'];
		$serverIP = $_SERVER['SERVER_ADDR'];

		if($serverIP == "127.0.0.1") {
			require_once($root . "/application/libraries/nusoap.php");
		} else {
			require_once($root . "/nominal/application/libraries/nusoap.php");
		}

		$proxyhost = !is_null($proxyHost) ? $proxyHost : '';
		$proxyport = !is_null($proxyPort) ? $proxyPort : '';
		$proxyusername = !is_null($proxyUsername) ? $proxyUsername : '';
		$proxypassword = !is_null($proxyPassword) ? $proxyPassword : '';

		$client = new nusoap_client('http://10.35.65.11:8080/arsys/WSDL/public/10.35.65.10/HPD_IncidentInterface_Create_WS', '', $proxyhost, $proxyport, $proxyusername, $proxypassword);
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		}
		$headers = array('AuthenticationInfo' => array('userName' => 'int_nominal', 'password' => '123456'));
        $client->setHeaders($headers);
		$param = [
			'Assigned_Support_Company' => 'Bank BRI',
			'Assigned_Support_Organization' => 'Divisi Satelit',
			'CI_Name' => '55.25.70.1',
			'First_Name' => 'Jordan',
			'Impact' => '2-Significant/Large',
			'Last_Name' => 'Timothy',
			'Reported_Source' => 'Phone',
			'Service_Type' => 'User Service Restoration',
			'Status' => 'Assigned',
			'Summary' => 'test 2',
			'Notes' => 'test 2 3 4 5',
			'Urgency' =>  '2-High',
			'Work_Info_Locked' => 'No',
			'Work_Info_View_Access' => 'Internal',
			'Action' => '',
		];
		$result = $client->call('HelpDesk_Submit_Service',  $param, '', '', false, true);

		if ($client->fault) {
		    $jsonOutput = json_encode([
				'code' => 500,
				'output' => 'Soap Client Fault'
            ]);
		} else {
			$err = $client->getError();
			if($err) {
				$jsonOutput = json_encode([
					'code' => 500,
					'output' => 'Soap Client Error'
				]);
			} else {
			    $jsonOutput = json_encode([
					'code' => 200,
					'output' => $result
				]);
			}
		}

		echo $jsonOutput;
	}

    function getTicketRemedy($dynamicIP, $proxyHost=null, $proxyPort=null, $proxyUsername=null, $proxyPassword=null) {
		$root = $_SERVER['DOCUMENT_ROOT'];
		$serverIP = $_SERVER['SERVER_ADDR'];
		if($serverIP == "127.0.0.1") {
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