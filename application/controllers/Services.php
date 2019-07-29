<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
        $this->load->library('session');
		if (is_null($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function ticketdetail()
    {
        $client = new nusoap_client('http://10.35.65.11:8080/arsys/WSDL/public/10.35.65.10/BRI:INC:GetInfoFromIPAddress', 'wsdl');
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
        return $jsonOutput;
    }

}