<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Remoteticket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('EloquentRemoteTicket');
		if ($this->session->userdata('username')==null) {
            redirect('login');
		}
    }

    public function insertTicket()
	{
		$uuid = Uuid::uuid1();
		
		foreach ($this->input->post('type') as $key => $val) {
			EloquentRemoteTicket::create([
				'uuid' => $uuid,
				'type' => $this->input->post('type')[$key],
				'network_status' => ($this->input->post('type')[$key] == 'jarkom') ? $this->input->post('network_status')[$key] : '',
				'id_remote' => $this->input->post('remote_id')[$key],
				'created_at' => date('Y-m-d H:i:s'),
				'user_creator' => $this->session->userdata('nama'),
				'last_check' => $this->input->post('last_check')[$key],
				'status_ticket' => $this->input->post('status_ticket')[$key],
				'incident_number' => $this->input->post('incident_number')[$key],
				'description' => $this->input->post('remote_ticket_description')[$key],
				'notes' => $this->input->post('remote_ticket_description')[$key],
				'ip' => $this->input->post('remote_id')[$key],
				'branch' => '-',
				'ip_address' => '-',
				'nama_uker' => '-',
				'provider_jarkom' => '-',
				'permasalahan' => '-',
				'action' => '-',
				'pic' => '-',
			]);
		}

		$this->session->set_userdata('notif_success','done');

		redirect('Dashboard/new_list_all');
	}

	public function zendsoap()
	{
		$client = new Zend\Soap\Client("http://10.35.65.11:8080/arsys/services/ARService?server=10.35.65.10&webService=BRI:INC:GetInfoFromIPAddress?wsdl");

		$header = "<AuthenticationInfo><userName>int_nominal</userName><password>123456</password></AuthenticationInfo>";
        $client->setHeaders($header);

		try {
			echo "<pre>" . $client->Get_ticket_info() . "</pre>";
		} catch (SoapFault $fault) {
			echo $fault->getMessage();
		} catch (Exception $exception) {
			echo $exception->getMessage();
		}
    }

	public function newapi()
	{
		$url = "http://10.35.65.11:8080/arsys/services/ARService?server=10.35.65.10&webService=BRI:INC:GetInfoFromIPAddress";
		$username = "int_nominal";
		$password = "123456";

		$client = new nusoap_client($url, 'wsdl');

		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
		}

		$client->setUseCurl($useCURL);

		$login_parameters = array(
			'user_auth' => array(
				'user_name' => $username,
				'password' => md5($password),
				'version' => '1'
			),
			'application_name' => 'SoapTest',
			'name_value_list' => array(),
		);

		$login_result = $client->call('login', $login_parameters);
		echo '<pre>';
		print_r($login_result);
		echo '</pre>';
	}

	public function tiketapi()
    {
		$root = $_SERVER['DOCUMENT_ROOT']; // SET DOCUMENT ROOT
		require_once($root . "/nominal/application/libraries/nusoap.php"); //INCLUDE LIBRARY NUSOAP

		$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
		$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
		$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
		$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

    	$client = new nusoap_client('http://10.35.65.11:8080/arsys/services/ARService?server=10.35.65.10&webService=BRI:INC:GetInfoFromIPAddress', '', $proxyhost, $proxyport, $proxyusername, $proxypassword);
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		}
		$headers = array('AuthenticationInfo' => array('userName' => 'int_nominal', 'password' => '123456'));
		$client->setHeaders($headers);
		$param = array('IPAddress' => '55.25.4.1');
		// $param = array('IPAddress' => $this->uri->segment(3));
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
    
    public function getNetworkDetail()
	{
		echo json_encode($this->session->userdata('data_combo'));
	}
    
}