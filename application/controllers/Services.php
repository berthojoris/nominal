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
        $result = $client->call("Get_ticket_info");
        var_dump($result);
    }

}