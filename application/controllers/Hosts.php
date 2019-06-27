<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hosts extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_hosts'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}
    
    public function index()
    {
        $data['page'] = 'hosts';
		$this->template->views('hosts',$data);
    }
    
    public function getHosts()
    {
        $data['page'] = 'hosts';
        $ip      = $_POST['ip'];
        $netmask = $_POST['net'];
        
        //echo $ip;

        $ipaddr = explode(".",$ip);
        $segment = $ipaddr[0].".".$ipaddr[1].".".$ipaddr[2].".";
        //$exRes = array();
        $nmap = exec("sudo nmap -n -sn -PE $ip/$netmask -oG - | awk '/Up$/{print $2}'",$result);    // buat dapetin host yang online
        
        $in = "0";
        for($i=0 ; $i < count($result) ; $i++)
        {
            $exRes = explode(".",$result[$i]);
            $in .= ",'".$exRes[3]."'";    
        }
		
		//var_dump($result);
        
        $data['hosts'] = $this->M_hosts->getIpHosts($segment,$in);
        echo json_encode($data);
        //var_dump($result);
    }

    public function getHost()
    {
        $data['page'] = 'hosts';
        $ip      = $this->uri->segment(3);
        $netmask = 24;
        
        //echo $ip;

        $ipaddr = explode(".",$ip);
        $segment = $ipaddr[0].".".$ipaddr[1].".".$ipaddr[2].".";
        //$exRes = array();
        $nmap = exec("nmap -n -sn -PE $ip/$netmask -oG - | awk '/Up$/{print $2}'",$result);    // buat dapetin host yang online
        
        $in = "0";
        for($i=0 ; $i < count($result) ; $i++)
        {
            $exRes = explode(".",$result[$i]);
            $in .= ",'".$exRes[3]."'";    
        }
        
        $data['hosts'] = $this->M_hosts->getIpHosts($segment,$in);
        //echo json_encode($data);
        //var_dump($result);
        return $data;
    }
    
    public function cektHosts()
    {
        $data['page'] = 'hosts';
        $ip      = $_POST['ip'];
        $netmask = $_POST['net'];
        
        $nmap = exec("nmap -n -sn $ip/$netmask -oG - | awk '/Up$/{print $2 $4 $5}'",$result);    // buat dapetin host yang online
                
        var_dump($result);
    }
}