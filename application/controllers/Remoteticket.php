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
				'user_creator' => $this->session->id,
				'last_check' => $this->input->post('last_check')[$key],
				'status_ticket' => $this->input->post('status_ticket')[$key],
				'incident_number' => $this->input->post('incident_number')[$key],
				'description' => $this->input->post('remote_ticket_description')[$key],
				'notes' => $this->input->post('remote_ticket_description')[$key],
				'ip' => $this->input->ip_address(),
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

	public function newapi()
	{
		$client = new nusoap_client('http://10.35.65.11:8080/arsys/services/ARService?server=10.35.65.10&webService=HPD_IncidentInterface_Create_WS', 'wsdl');
		$header = "<AuthenticationInfo><userName>int_nominal</userName><password>123456</password></AuthenticationInfo>";
		$client->setHeaders($header);
		$result = $client->call("HelpDesk_Submit_Service");
		echo "<pre>";
		var_dump($result);
		die();
	}

	public function tiketapi()
    {
		// $ip = (empty($this->uri->segment(3))) ? '127.0.0.1' : $this->uri->segment(3);
		$ip = '55.25.70.1';
    	$client = new nusoap_client('http://10.35.65.11:8080/arsys/WSDL/public/'.$ip.'/BRI:INC:GetInfoFromIPAddress', 'wsdl');
        $header = "<AuthenticationInfo><userName>int_nominal</userName><password>123456</password></AuthenticationInfo>";
        $client->setHeaders($header);
        $result = $client->call("Get_ticket_info");
        if(!empty($result)) {
            $jsonOutput = json_encode([
                'incident_number' => $result['IncidentNumber'],
                'description' => $result['Description'],
                'notes' => $result['Notes'],
                'status' => $result['Status'],
                'code' => 200
            ]);
        } else {
            $jsonOutput = json_encode([
                'incident_number' => '-',
                'description' => '-',
                'notes' => '-',
                'status' => '-',
                'code' => 404
            ]);
		}
        echo $jsonOutput;
    }
    
    public function getNetworkDetail()
	{
		echo json_encode($this->session->userdata('data_combo'));
	}
    
}