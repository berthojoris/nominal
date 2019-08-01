<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Dashboard extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('m_dashboard'));
		$this->load->model('EloquentRemoteTicket');
		$this->load->model('EloquentRemoteTicketDetail');

        $this->load->library('session');
		$this->load->library('curl');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

	public function tiketapi()
    {
		$ip = (empty($this->uri->segment(3))) ? '127.0.0.1' : $this->uri->segment(3);
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

	public function insertTicket()
	{
        $insert = EloquentRemoteTicket::create([
            'type' => $this->input->post('type'),
            'id_remote' => $this->input->post('remote_id'),
            'created_at' => date('Y-m-d H:i:s'),
            'user_creator' => $this->session->id,
            'last_check' => $this->input->post('last_check'),
            'status_ticket' => $this->input->post('status_ticket'),
            'incident_number' => $this->input->post('incident_number'),
            'description' => $this->input->post('remote_ticket_description'),
            'ip' => $this->input->ip_address()
        ]);

		if($this->input->post('formCounter') > 0) {
            foreach ($this->input->post('branch') as $key => $val) {
                EloquentRemoteTicketDetail::create([
                    'remote_ticket_id' => $insert->id,
                    'branch' => $this->input->post('branch')[$key],
                    'ip_address' => $this->input->post('ip_address')[$key],
                    'nama_uker' => $this->input->post('nama_uker')[$key],
                    'provider_jarkom' => $this->input->post('provider_jarkom')[$key],
                    'permasalahan' => $this->input->post('permasalahan')[$key],
                    'action' => $this->input->post('action')[$key],
                    'pool' => $this->input->post('pool')[$key],
                    'pic' => $this->input->post('pic')[$key],
                ]);
            }
        }

		$this->session->set_userdata('notif_success','done');

		redirect('Dashboard/new_list_all');
	}

    public function index()
	{
		//$data['page'] = 'home';
		//$this->template->views('home',$data);
		//redirect('Dashboard/All_Kanwil');
		if ($this->session->userdata('role')==10) {
            redirect('Dash_Provider');
        }else{
			redirect('Dashboard/All_Kanwil');
		}
	}

	function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function All_Kanwil()
	{
        //$data['kanwil'] = $this->db->get('tb_kanwil')->result();
        $kw  = array('T','U','V','Y');
        $data['kanwil'] = $this->db->select('*')->from('tb_kanwil')->where_not_in('kode_kanwil',$kw)->order_by("nama_kanwil", "asc")->get()->result();
        $onAll = 0;
        $offOp = 0;
        $offNop = 0;
        $All = 0;
        $prosentase = 0;
        for ($i=0; $i < count($data['kanwil']); $i++) { 
        	$k=$data['kanwil'][$i];
        	$data['data']['persen'][$i] = $this->m_dashboard->getOnOffKanwil($k->kode_kanwil);
        	//echo $data['data']['total'][$i]['on']."-";
        	$onAll = $onAll + $data['data']['persen'][$i]['on'];
	        $offOp = $offOp + $data['data']['persen'][$i]['off'];
	        $offNop = $offNop + $data['data']['persen'][$i]['off_nop'];
	        $prosentase = $prosentase + $data['data']['persen'][$i]['prosentase'];
	        $All = $All + $data['data']['persen'][$i]['all'];
        	$data['data']['nama_kanwil'][$i] = $k->nama_kanwil;
        	$data['data']['kode_kanwil'][$i] = $k->kode_kanwil;
        }
        $i = count($data['kanwil']);
        $data['data']['persen'][$i]['on'] = $onAll;
        $data['data']['persen'][$i]['off'] = $offOp;
        $data['data']['persen'][$i]['off_nop'] = $offNop;
        $data['data']['persen'][$i]['all'] = $All;
        //$data['data']['persen'][$i]['prosentase'] = $prosentase/$i;
        $data['data']['persen'][$i]['prosentase'] = ($onAll/($onAll+$offOp))*100;
        $data['data']['nama_kanwil'][$i] = 'ALL KANWIL';
        $data['data']['kode_kanwil'][$i] = '000';

        $data['page'] = 'kanwil';
        $data['title'] = 'Dashboard All Region';
        $refresh = $this->uri->segment(3);

		$this->template->views('dashboard/kanwil',$data);
		
	}

    public function testdash()
	{
        //$data['kanwil'] = $this->db->get('tb_kanwil')->result();
        $kw  = array('T','U','V','Y');
        $data['kanwil'] = $this->db->select('*')->from('tb_kanwil')->where_not_in('kode_kanwil',$kw)->order_by("nama_kanwil", "asc")->get()->result();
        $onAll = 0;
        $offOp = 0;
        $offNop = 0;
        $All = 0;
        $prosentase = 0;
        for ($i=0; $i < count($data['kanwil']); $i++) { 
        	$k=$data['kanwil'][$i];
        	$data['data']['persen'][$i] = $this->m_dashboard->getOnOffKanwil($k->kode_kanwil);
        	//echo $data['data']['total'][$i]['on']."-";
        	$onAll = $onAll + $data['data']['persen'][$i]['on'];
	        $offOp = $offOp + $data['data']['persen'][$i]['off'];
	        $offNop = $offNop + $data['data']['persen'][$i]['off_nop'];
	        $prosentase = $prosentase + $data['data']['persen'][$i]['prosentase'];
	        $All = $All + $data['data']['persen'][$i]['all'];
        	$data['data']['nama_kanwil'][$i] = $k->nama_kanwil;
        	$data['data']['kode_kanwil'][$i] = $k->kode_kanwil;
        }
        $i = count($data['kanwil']);
        $data['data']['persen'][$i]['on'] = $onAll;
        $data['data']['persen'][$i]['off'] = $offOp;
        $data['data']['persen'][$i]['off_nop'] = $offNop;
        $data['data']['persen'][$i]['all'] = $All;
        //$data['data']['persen'][$i]['prosentase'] = $prosentase/$i;
        $data['data']['persen'][$i]['prosentase'] = ($onAll/($onAll+$offOp))*100;
        $data['data']['nama_kanwil'][$i] = 'ALL KANWIL';
        $data['data']['kode_kanwil'][$i] = '000';

        $data['page'] = 'kanwil';
        $data['title'] = 'Dashboard All Region';
        $refresh = $this->uri->segment(3);

		$this->template->views('dashboard/testdash',$data);
		
	}
    
    public function refreshKanwil()
	{
        //$data['kanwil'] = $this->db->get('tb_kanwil')->result();
        $kw  = array('T','U','V','Y');
        $data['kanwil'] = $this->db->select('*')->from('tb_kanwil')->where_not_in('kode_kanwil',$kw)->order_by("nama_kanwil", "asc")->get()->result();
        $onAll = 0;
        $onNop = 0;
        $offNop = 0;
        $All = 0;
        $prosentase = 0;
        for ($i=0; $i < count($data['kanwil']); $i++) { 
        	$k=$data['kanwil'][$i];
        	$data['data']['persen'][$i] = $this->m_dashboard->getOnOffKanwil($k->kode_kanwil);
        	//echo $data['data']['total'][$i]['on']."-";
        	$onAll = $onAll + $data['data']['persen'][$i]['on'];
	        $onOp = $onNop + $data['data']['persen'][$i]['off'];
	        $offNop = $offNop + $data['data']['persen'][$i]['off_nop'];
	        $prosentase = $prosentase + $data['data']['persen'][$i]['prosentase'];
	        $All = $All + $data['data']['persen'][$i]['all'];
        	$data['data']['nama_kanwil'][$i] = $k->nama_kanwil;
        	$data['data']['kode_kanwil'][$i] = $k->kode_kanwil;
        }
        $i = count($data['kanwil']);
        $data['data']['persen'][$i]['on'] = $onAll;
        $data['data']['persen'][$i]['off'] = $onNop;
        $data['data']['persen'][$i]['off_nop'] = $offNop;
        $data['data']['persen'][$i]['all'] = $All;
        $data['data']['persen'][$i]['prosentase'] = $prosentase/$i;
        $data['data']['nama_kanwil'][$i] = 'ALL KANWIL';
        $data['data']['kode_kanwil'][$i] = '000';

        $data['page'] = 'kanwil';
        $refresh = $this->uri->segment(3);
        //if($refresh==''){
		//	$this->template->views('kanwil',$data);
        // }else{
        // 	$this->load->view('kanwil',$data);
        // }
        
        echo json_encode($data);
	}

	public function Kanca()
	{
		$kanwil = $this->uri->segment(3);
		$data['kanwil'] = $kanwil;
		$getnama = $this->db->select('nama_kanwil')->from('tb_kanwil')->where('kode_kanwil',$kanwil)->get()->result();
		$data['nama_kanwil'] = $getnama[0]->nama_kanwil;
		$data['center_loc'] = $this->m_dashboard->getCenterKanca($kanwil);
		$query_kanca = $this->db->query("SELECT kode_kanca FROM tb_kanca WHERE nama_kanca LIKE '%KANWIL%'")->result();
		$not = array();
		foreach ($query_kanca as $qk) {
			$not[] = $qk->kode_kanca;
		}
		//var_dump($not);
		$data['kanca'] = $this->db->select('*')
						->from('tb_kanca')
						->where('kode_kanwil',$kanwil)
						->where_not_in('kode_kanca',$not)
						->order_by('nama_kanca','ASC')
						->get()->result();
        for ($i=0; $i < count($data['kanca']); $i++){
        	$k=$data['kanca'][$i];
        	//$data['data']['total'][$i] = $this->m_dashboard->jumlah_uker($k->kode_kanca);
        	$data['data']['persen'][$i] = $this->m_dashboard->getOnOffKanca($k->kode_kanca);
        	$data['data']['nama_kanca'][$i] = $k->nama_kanca;
        	$data['data']['kode_kanca'][$i] = $k->kode_kanca;
        }
  		$data['page'] = 'kanwil';
  		$data['title'] = 'Dashboard Region '.$data['nama_kanwil'] ;
  		//var_dump($data['kanca']);
		//$this->template->views('kanca',$data);

		if(in_array( $this->session->userdata('role'), array(1,2,3,5))){
			$this->template->views('dashboard/kanca',$data);
        }else if (in_array( $this->session->userdata('role'), array(6,7))){
            if ($this->session->userdata('kanwil')==$kanwil) {
            	$this->template->views('dashboard/kanca',$data);
            }else{
				//echo "<script>alert('test');</script>";
        		redirect('Dashboard/All_Kanwil');
            }
        }else{
        	redirect('Dashboard/All_Kanwil');
        }
	}

	public function refreshKanca()
	{
		$kanwil = $this->uri->segment(3);
		$data['kanwil'] = $kanwil;
		$getnama = $this->db->select('nama_kanwil')->from('tb_kanwil')->where('kode_kanwil',$kanwil)->get()->result();
		$data['nama_kanwil'] = $getnama[0]->nama_kanwil;
		$data['center_loc'] = $this->m_dashboard->getCenterKanca($kanwil);
		$query_kanca = $this->db->query("SELECT kode_kanca FROM tb_kanca WHERE nama_kanca LIKE '%KANWIL%'")->result();
		$not = array();
		foreach ($query_kanca as $qk) {
			$not[] = $qk->kode_kanca;
		}
		//var_dump($not);
		$data['kanca'] = $this->db->select('*')
						->from('tb_kanca')
						->where('kode_kanwil',$kanwil)
						->where_not_in('kode_kanca',$not)
						->order_by('nama_kanca','ASC')
						->get()->result();
        for ($i=0; $i < count($data['kanca']); $i++){
        	$k=$data['kanca'][$i];
        	//$data['data']['total'][$i] = $this->m_dashboard->jumlah_uker($k->kode_kanca);
        	$data['data']['persen'][$i] = $this->m_dashboard->getOnOffKanca($k->kode_kanca);
        	$data['data']['nama_kanca'][$i] = $k->nama_kanca;
        	$data['data']['kode_kanca'][$i] = $k->kode_kanca;
        }
  		$data['page'] = 'kanwil';
		//$this->template->views('kanca',$data);
		echo json_encode($data);
	}

	public function Remote()
	{
		$kanca = $this->uri->segment(3);
		$data['kanca'] = $kanca;
		$data['kanwil'] = $this->db->select('b.kode_kanwil,b.nama_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$getnama = $this->db->select('nama_kanca')->from('tb_kanca')->where('kode_kanca',$kanca)->get()->result();
		$data['nama_kanca'] = $getnama[0]->nama_kanca;
		$data['tipe_uker'] = $this->db->query("SELECT * 
							FROM tb_tipe_uker
							WHERE kode_tipe_uker NOT IN('0', '1', '8', '9', '13') 
							ORDER BY  FIELD(kode_tipe_uker,1,2,3,4,5,6,7,8,9,10,14,11,12) ASC")->result();
		for ($i=0; $i < count($data['tipe_uker']); $i++) { 
			$u = $data['tipe_uker'][$i];
			//var_dump($u);
			$data['data']['total'][$i] = $this->m_dashboard->get_remote($kanca,$u->kode_tipe_uker);
			$data['data']['persen'][$i] = $this->m_dashboard->getOnOffRemote($kanca,$u->kode_tipe_uker);
			$data['data']['tipe_uker'][$i] = $u->tipe_uker;
			$data['data']['kode_tipe_uker'][$i] = $u->kode_tipe_uker;
		}
        $data['page'] = 'kanwil';
        $data['title'] = 'Dashboard All Remote - Main Branch '.$data['nama_kanca'];
		//$this->template->views('remote',$data);

		if(in_array( $this->session->userdata('role'), array(1,2,3,5))){
			$this->template->views('dashboard/remote',$data);
        }else if (in_array( $this->session->userdata('role'), array(6,7))){
            if ($this->session->userdata('kanwil')==$data['kanwil'][0]->kode_kanwil) {
            	$this->template->views('dashboard/remote',$data);
            }else{
        		redirect('Dashboard/Kanca/'.$this->session->userdata('kanwil'));
            }
        }else{
        	redirect('Dashboard/All_Kanwil');
        }
	}

	public function refreshRemote()
	{
		$kanca = $this->uri->segment(3);
		$data['kanca'] = $kanca;
		$getnama = $this->db->select('nama_kanca')->from('tb_kanca')->where('kode_kanca',$kanca)->get()->result();
		$data['nama_kanca'] = $getnama[0]->nama_kanca;
		$data['tipe_uker'] = $this->db->query("SELECT * 
							FROM tb_tipe_uker
							WHERE kode_tipe_uker NOT IN('0', '1', '8', '9', '13') 
							ORDER BY  FIELD(kode_tipe_uker,1,2,3,4,5,6,7,8,9,10,11,12) ASC")->result();
		for ($i=0; $i < count($data['tipe_uker']); $i++) { 
			$u = $data['tipe_uker'][$i];
			//var_dump($u);
			$data['data']['total'][$i] = $this->m_dashboard->get_remote($kanca,$u->kode_tipe_uker);
			$data['data']['persen'][$i] = $this->m_dashboard->getOnOffRemote($kanca,$u->kode_tipe_uker);
			$data['data']['tipe_uker'][$i] = $u->tipe_uker;
			$data['data']['kode_tipe_uker'][$i] = $u->kode_tipe_uker;
		}
        $data['page'] = 'kanwil';
		//$this->template->views('remote',$data);
		echo json_encode($data);
	}

	function getKanwilLocations()
	{
		$data["data"] = $this->m_dashboard->getKanwilLocations();
        echo json_encode($data);
	}

	function getKancaLocations($kanwil)
	{
		$data["data"] = $this->m_dashboard->getKancaLocations($kanwil);
        echo json_encode($data);
	}

	function getKanca()
	{
		$kanwil = $_POST['kanwil'];
		$data = $this->db->select('kode_kanca,nama_kanca')->from('tb_kanca')->where('kode_kanwil',$kanwil)->order_by('nama_kanca','acs')->get()->result();
        echo json_encode($data);
	}

	function getUkerLocations($kanca)
	{
		
		$data["data"] = $this->m_dashboard->getUkerLocations($kanca);
		$data["center"] = $this->m_dashboard->getCenterLocation($kanca);
        echo json_encode($data);
	}

	function data_uker()
	{
		$kanca = $this->uri->segment(3);
		$kode_tipe_uker = $this->uri->segment(4);

		$data['kanwil'] = $this->db->select('b.kode_kanwil,b.nama_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$data['data'] = $this->m_dashboard->data_uker($kanca,$kode_tipe_uker);

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}

		$data['nama_uker'] = $this->db->get_where('tb_tipe_uker', array('kode_tipe_uker'=>$kode_tipe_uker))->result();
		$data['kanca'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List';
		$this->template->views('List/uker',$data);
	}

	function data_uker2()
	{
		$kanca = $this->uri->segment(3);
		$kode_tipe_uker = $this->uri->segment(4);

		$data['kanwil'] = $this->db->select('b.kode_kanwil,b.nama_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$data['data'] = $this->m_dashboard->data_uker($kanca,$kode_tipe_uker);

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}

		$data['nama_uker'] = $this->db->get_where('tb_tipe_uker', array('kode_tipe_uker'=>$kode_tipe_uker))->result();
		$data['kanca'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List';
		$this->template->views('List/uker2',$data);
	}

	function data_uker_kanwil()
	{
		$kanwil = $this->uri->segment(3);
		$data['kode_kanwil'] = $kanwil;
		$data['kanca'] = $this->db->select('kode_kanca')->from('tb_kanca')->where('kode_kanwil',$kanwil)->get()->result();
		$ids = array();
		foreach ($data['kanca'] as $datakanca) {
			$ids[] = $datakanca->kode_kanca;
		}

		$data['data'] =  $this->m_dashboard->data_uker_kanwil($kanwil,$ids);


		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
			
		}

		$data['nama'] = $this->db->get_where('tb_kanwil', array('kode_kanwil'=>$kanwil))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List - Region '.$data['nama'][0]->nama_kanwil;
		$this->template->views('List/uker_kanwil',$data);
	}

	function TestTable()
	{
		$where = $this->uri->segment(3);
		if ($where!=null) {
			$data['data'] = $this->db->select('b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 ->like('a.event',$where)
								 //->where('a.event',$where)
								 // ->limit(100,0)
								 ->get()
								 ->result();
			$data['page'] = $where.'-reporting';
			$data['title'] = 'Branch Monitoring';
		}else{
			$data['data'] = $this->db->select('b.*,GREATEST(b.status_fail_date,b.status_rec_date) as last_update')
								 ->from('tb_militan a')
								 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
								 ->order_by('b.status','asc')
								 ->order_by('last_update','asc')
								 ->order_by('b.nama_remote','asc')
								 // ->where_in('kode_op',array(1,2))
								 // ->limit(100,0)
								 ->get()
									 ->result();
			$data['page'] = 'naru-reporting';
			$data['title'] = 'NARU Monitoring';
		}


		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
			
		}

		$this->template->views('testTable',$data);
	}
	
	function data_uker_kanwil2()
	{
		$kanwil = $this->uri->segment(3);
		$data['kode_kanwil'] = $kanwil;
		$data['kanca'] = $this->db->select('kode_kanca')->from('tb_kanca')->where('kode_kanwil',$kanwil)->get()->result();
		$ids = array();
		foreach ($data['kanca'] as $datakanca) {
			$ids[] = $datakanca->kode_kanca;
		}

		$data['data'] =  $this->m_dashboard->data_uker_kanwil($kanwil,$ids);


		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
			
		}

		$data['nama'] = $this->db->get_where('tb_kanwil', array('kode_kanwil'=>$kanwil))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List - Region '.$data['nama'][0]->nama_kanwil;
		$this->template->views('List/uker_kanwil2',$data);
	}

	function data_uker_kanca()
	{
		$kanca = $this->uri->segment(3); 

		$data['kanwil'] = $this->db->select('b.nama_kanwil,b.kode_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$data['data'] =  $this->m_dashboard->data_uker_kanca($kanca);

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}

		$data['nama'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List - Region '.$data['kanwil'][0]->nama_kanwil.' - '.$data['nama'][0]->nama_kanca;
		$this->template->views('List/uker_kanca',$data);
	}

	function data_uker_kanca2()
	{
		$kanca = $this->uri->segment(3); 

		$data['kanwil'] = $this->db->select('b.nama_kanwil,b.kode_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$data['data'] =  $this->m_dashboard->data_uker_kanca($kanca);

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}

		$data['nama'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List - Region '.$data['kanwil'][0]->nama_kanwil.' - '.$data['nama'][0]->nama_kanca;
		$this->template->views('List/uker_kanca2',$data);
	}

	function detail_uker(){
		$id_remote = $this->uri->segment(3);
		$kode_tipe_uker = $this->uri->segment(4);
		$data['data'] =  $this->db->select('a.*,a.status_l as status_onoff,d.tipe_uker,a.latitude as lat,a.longitude as long,
								d.tipe_uker,a.last_update_l as last_up,a.status_fail_date_l as status_fail_date,
								a.status_rec_date_l as status_rec_date,a.kode_op,e.keterangan as op,f.pic_pinca,
								f.pic_spo,f.pet_it,a.kode_kanca,f.nama_kanca,g.pic_kanwil,g.kode_kanwil')
						->from('tb_remote a')
						->join('tb_tipe_uker d', 'd.kode_tipe_uker = a.kode_tipe_uker','left')
						->join('tb_op e','e.kode_op = a.kode_op','left')
						->join('tb_kanca f','f.kode_kanca = a.kode_kanca','left')
						->join('tb_kanwil g','g.kode_kanwil = f.kode_kanwil','left')
						->where('a.kode_tipe_uker',$kode_tipe_uker)
						->where('a.id_remote',$id_remote)
						->limit(1)
						->get()->result(); 
		//for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][0];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
			
			$data['locinduk'][$remote->id_remote] = $this->m_dashboard->getLocInduk($remote->id_remote,$kode_tipe_uker);
		//}

		$tamp = $this->db->query("SELECT * FROM tb_remote where kode_kanca='$remote->kode_kanca' AND kode_tipe_uker = 2")->result();

		if ($remote->latitude == '' || $remote->longitude == '') {
			$data['latitude'] = $tamp[0]->latitude;
			$data['longitude'] = $tamp[0]->longitude;
		}else{
			$data['latitude'] = $remote->latitude;
			$data['longitude'] = $remote->longitude;
		}

		 

		$query = "SELECT nama_kanwil,kode_kanwil 
					FROM tb_kanwil 
					WHERE kode_kanwil IN (
						SELECT kode_kanwil 
						FROM tb_kanca 
						WHERE kode_kanca IN (
							SELECT kode_kanca 
							FROM tb_remote 
							WHERE id_remote = '$id_remote'
						)
					)";
        $data['kanwil'] = $this->db->query($query)->result();
        $data['kanca'] = $this->db->select('*')->from('tb_kanca')->order_by('nama_kanca','asc')->get()->result();
        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
        $data['tipe_uker'] = $this->db->select('*')->from('tb_tipe_uker')->order_by('kode_tipe_uker','asc')->get()->result();
		$data['type_alarm'] = $this->db->select('*')->from('tb_alarm_type')->get()->result();
		$data['page'] = 'kanwil';
		$data['title'] = 'Remote Detail';
		//$this->template->views('detail_uker',$data);
		
		//begin get data from librenms
			/* $device_api = curl_init();
			curl_setopt($device_api, CURLOPT_URL, "http://172.18.65.159/api/v0/devices/".$remote->ip_lan);
			curl_setopt($device_api, CURLOPT_HTTPHEADER, array(
			  'X-Auth-Token: cf684b7a913ce8d7187a3afddc4c5db3',
			  'Content-Type: application/json',
		   ));
			curl_setopt($device_api, CURLOPT_RETURNTRANSFER, 1); 
			$output_device = curl_exec($device_api); 
			curl_close($device_api);      
			$device =  json_decode($output_device,true);
			if(isset($device['devices'][0]['device_id'])){
				$ch = curl_init();
				$waktu = date("Y-m-d H:i:s", strtotime('-2 hours'));
				$now =date("Y-m-d H:i:s");
				curl_setopt($ch, CURLOPT_URL, "http://172.18.65.159/api/v0/logs/eventlog/".$device['devices'][0]['device_id']."?from=".str_replace(' ', '%', $waktu)."&to=".str_replace(' ', '%', $now));
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				  'X-Auth-Token: cf684b7a913ce8d7187a3afddc4c5db3',
				  'Content-Type: application/json',
			   ));

				// return the transfer as a string 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

				// $output contains the output string 
				$output = curl_exec($ch); 

				// tutup curl 
				curl_close($ch);      

				// menampilkan hasil curl
				
				$data['system_log_remote'] =  json_decode($output,true);
			}else {$data['system_log_remote']=null;
		} */
		$query_militan = "SELECT event FROM tb_militan WHERE id_remote = '$id_remote' AND (event='LAYANAN TERBATAS' OR event='ATM PRIORITAS' OR event='POSKO' OR event='WEEKEND BANKING')";
        $militan = $this->db->query($query_militan)->result();
        if (count($militan)>0) {
        	$data['militan']="<tr>";
	        $data['militan'].="<th>ATTENTION</th><td style='width: 10px'>:</td><td>";
	        foreach ($militan as $militan_data){
	        	$data['militan'].= "<span class='label label-primary'>".$militan_data->event."</span> - ";
	        }
	        $data['militan'].="</td></tr>";
        }
        //end get data from librenms
        
        // $log = new Logger('debug');
        // $log->pushHandler(new StreamHandler(FCPATH.'log/logger.log', Logger::DEBUG));
        // $log->info('database', $data);
		

		if(in_array( $this->session->userdata('role'), array(1,2,3,5,10))){
			$this->template->views('detail_uker_new',$data);
        }else if (in_array( $this->session->userdata('role'), array(6,7))){
            if ($this->session->userdata('kanwil')==$data['kanwil'][0]->kode_kanwil) {
            	$this->template->views('detail_uker_new',$data);
            }else{
        		redirect('Dashboard/All_Kanwil');
            }
        }
	}

	function Provider()
	{
		$kategori = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		if ($kategori == "kanwil") {
			$jenis_jarkom = $this->db->query("SELECT
									DISTINCT a.kode_jenis_jarkom
							FROM tb_jarkom a
							LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
							LEFT JOIN tb_remote_status c ON c.ip_lan = b.ip_lan
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE a.used_status = 1
							AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$id') ORDER BY a.kode_jenis_jarkom")->result();

			$provider = $this->db->query("SELECT
									DISTINCT a.kode_provider
							FROM tb_jarkom a
							LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
							LEFT JOIN tb_remote_status c ON c.ip_lan = b.ip_lan
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE a.used_status = 1
							AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$id') ORDER BY a.kode_provider")->result();


			for ($i=0; $i < count($jenis_jarkom); $i++) { 
				$jj = $jenis_jarkom[$i]->kode_jenis_jarkom;
				for ($j=0; $j < count($provider); $j++) { 
					$p = $provider[$j]->kode_provider;
					$data['data_nb'][$i][$j] = $this
										->m_dashboard
										->getOnOffProviderKanwil_NB($id,$jj,$p);
					//echo $jj.'-'.$p.'<br>';
				}
			}	

			for ($a=0; $a < count($jenis_jarkom); $a++) { 
				$j = $jenis_jarkom[$a]->kode_jenis_jarkom;
				for ($b=0; $b < count($provider); $b++) { 
					$pr = $provider[$b]->kode_provider;
					$data['data_b'][$a][$b] = $this
										->m_dashboard
										->getOnOffProviderKanwil_B($id,$j,$pr);
				}
			}			
						
			//var_dump($provider[0]->kode_provider);
			//var_dump($data['data']);
			$data['kategori'] = $kategori;
			$data['jenis_jarkom'] = count($jenis_jarkom);
			$data['provider'] = count($provider);
			$data['nama'] = $this->db->select('nama_kanwil as nama')->where('kode_kanwil',$id)->from('tb_kanwil')->get()->result();
			$data['page'] = 'kanwil';

		} else if($kategori=='kanca'){
			$jenis_jarkom = $this->db->query("SELECT
									DISTINCT a.kode_jenis_jarkom
							FROM tb_jarkom a
							LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE b.kode_kanca = $id")->result();

			$provider = $this->db->query("SELECT
									DISTINCT a.kode_provider
							FROM tb_jarkom a
							LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE b.kode_kanca = $id")->result();

			for ($i=0; $i < count($jenis_jarkom); $i++) { 
				$jj = $jenis_jarkom[$i]->kode_jenis_jarkom;
				for ($j=0; $j < count($provider); $j++) { 
					$p = $provider[$j]->kode_provider;
					$data['data_nb'][$i][$j] = $this
										->m_dashboard
										->getOnOffProviderKanca_NB($id,$jj,$p);
				}
			}

			for ($i=0; $i < count($jenis_jarkom); $i++) { 
				$jj = $jenis_jarkom[$i]->kode_jenis_jarkom;
				for ($j=0; $j < count($provider); $j++) { 
					$p = $provider[$j]->kode_provider;
					$data['data_b'][$i][$j] = $this
										->m_dashboard
										->getOnOffProviderKanca_B($id,$jj,$p);
				}
			}			
		
			$data['kanwil'] = $this->db->select('b.kode_kanwil,b.nama_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$id)->get()->result();
			
			//var_dump($provider[0]->kode_provider);
			//var_dump($data['data']);
			$data['kategori'] = $kategori;
			$data['jenis_jarkom'] = count($jenis_jarkom);
			$data['provider'] = count($provider);
			$data['nama'] = $this->db->select('nama_kanca as nama')->from('tb_kanca')->where('kode_kanca',$id)->get()->result();
			$data['page'] = 'kanwil';

		}
		
		$data['title'] = 'List Provider';
		$this->template->views('List/provider',$data);
		//var_dump($data['data_nb']); 
	}

	function edit_remote()
	{
		//if(isset($_POST['submit'])) {
			//echo "<script>alert('test')</script>";
			$keterangan = '';
			if ($_POST['keterangan']!='') {
				$keterangan = '['.date('Y-m-d H:i:s').'] '.$_POST['keterangan'];
			}
			if ($this->session->userdata('role')==1) {

				$datakanwil  = array(
					'pic_kanwil' => $_POST['pic_kanwil']
				);

				$this->db->where('kode_kanwil',$_POST['kode_kanwil']);
		        $this->db->update('tb_kanwil',$datakanwil);

				$datakanca  = array(
					'pic_pinca' => $_POST['pic_pinca'],
					'pic_spo'   => $_POST['pic_spo'],
					'pet_it'    => $_POST['pet_it']
				);

				$this->db->where('kode_kanca',$_POST['kode_kanca']);
		        $this->db->update('tb_kanca',$datakanca);
				//$dataremote = array ();
		        $dataremote = array(
		        	'pic_uko'    	=> $_POST['pic_uker'],
		        	'kode_op'     	=> $_POST['kode_op'],
		        	'kode_tipe_uker'=> $_POST['kode_tipe_uker'],
		        	'nama_remote'   => $_POST['nama_remote'],
		        	'alamat_uker' 	=> $_POST['alamat'],
		        	'telp_uker'  	=> $_POST['telp'],
		        	'ip_lan'   	  	=> $_POST['ip_lan'],
		        	'kode_uker'   	=> $_POST['kode_uker'],
		        	'keterangan'  	=> $keterangan,
		        	'start_nop'   	=> $_POST['start_nop'],
		        	'end_nop'  	  	=> $_POST['end_nop'],
		        	'user_update'	=> $this->session->userdata('username'),
		        	'update_at'		=> date('Y-m-d H:i:s'),
		        	//'kode_kanca'  	=> $_POST['kode_kanca']
		        );
				
				if($this->session->userdata('role')==1){
					$dataremote['ip_lan'] = $_POST['ip_lan'];
					$dataremote['kode_kanca']=$_POST['kode_kanca'];
				}

		        //var_dump($dataremote);
		        if ($_POST['ip_monitoring']!=$_POST['ip_monitoring_old']) {
						$new = $_POST['ip_monitoring'];
						$old = $_POST['ip_monitoring_old'];
						$url = "http://172.18.65.159/api/v0/devices/$old/rename/$new";
						$username = 'damar';
						$password = 'cf684b7a913ce8d7187a3afddc4c5db3';
						
					   // persiapkan curl
						$ch = curl_init(); 

						// set url 
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							'X-Auth-Token: cf684b7a913ce8d7187a3afddc4c5db3',
							'Content-Type: application/json',
						));

						// return the transfer as a string 
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

						// $output contains the output string 
						$output = curl_exec($ch); 

						// tutup curl 
						curl_close($ch);
						
						$convert = json_decode($output);
						$array_object = (array) $convert;
						if($array_object['status']=='ok'){
					        $this->db->where('id_remote',$_POST['id_remote']);
					        $this->db->update('tb_remote',$dataremote);
						}else{
							echo "<script>alert('Update Data Remote Error');</script>";
							redirect('Dashboard/detail_uker/'.$_POST['id_remote'].'/'.$_POST['kode_tipe_uker']);
						}
				}else{
					$this->db->where('id_remote',$_POST['id_remote']);
					$this->db->update('tb_remote',$dataremote);
				}
			}else if($this->session->userdata('role')==5){
				$datakanwil  = array(
					'pic_kanwil' => $_POST['pic_kanwil']
				);

				$this->db->where('kode_kanwil',$_POST['kode_kanwil']);
		        $this->db->update('tb_kanwil',$datakanwil);

				$datakanca  = array(
					'pic_pinca' => $_POST['pic_pinca'],
					'pic_spo'   => $_POST['pic_spo'],
					'pet_it'    => $_POST['pet_it']
				);

				$this->db->where('kode_kanca',$_POST['kode_kanca2']);
		        $this->db->update('tb_kanca',$datakanca);
				//$dataremote = array ();
		        $dataremote = array(
		        	'pic_uko'    	=> $_POST['pic_uker'],
		        	'kode_op'     	=> $_POST['kode_op'],
		        	'kode_tipe_uker'=> $_POST['kode_tipe_uker'],
		        	'nama_remote'   => $_POST['nama_remote'],
		        	'alamat_uker' 	=> $_POST['alamat'],
		        	'telp_uker'  	=> $_POST['telp'],
		        	'kode_uker'   	=> $_POST['kode_uker'],
		        	'keterangan'  	=> $keterangan,
		        	'start_nop'   	=> $_POST['start_nop'],
		        	'end_nop'  	  	=> $_POST['end_nop'],
		        	'user_update'	=> $this->session->userdata('username'),
		        	'update_at'		=> date('Y-m-d H:i:s'),
		        	//'kode_kanca'  	=> $_POST['kode_kanca']
		        );
				
				if($this->session->userdata('role')==1){
					$dataremote['ip_lan'] = $_POST['ip_lan'];
					$dataremote['kode_kanca']=$_POST['kode_kanca'];
				}

		        //var_dump($dataremote);
		  //       if ($_POST['ip_monitoring']!=$_POST['ip_monitoring_old']) {
				// 		$new = $_POST['ip_monitoring'];
				// 		$old = $_POST['ip_monitoring_old'];
				// 		$url = "http://172.18.65.159/api/v0/devices/$old/rename/$new";
				// 		$username = 'damar';
				// 		$password = 'cf684b7a913ce8d7187a3afddc4c5db3';
						
				// 	   // persiapkan curl
				// 		$ch = curl_init(); 

				// 		// set url 
				// 		curl_setopt($ch, CURLOPT_URL, $url);
				// 		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				// 			'X-Auth-Token: cf684b7a913ce8d7187a3afddc4c5db3',
				// 			'Content-Type: application/json',
				// 		));

				// 		// return the transfer as a string 
				// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

				// 		// $output contains the output string 
				// 		$output = curl_exec($ch); 

				// 		// tutup curl 
				// 		curl_close($ch);
						
				// 		$convert = json_decode($output);
				// 		$array_object = (array) $convert;
				// 		if($array_object['status']=='ok'){
				// 	        $this->db->where('id_remote',$_POST['id_remote']);
				// 	        $this->db->update('tb_remote',$dataremote);
				// 		}else{
				// 			echo "<script>alert('Update Data Remote Error');</script>";
				// 			redirect('Dashboard/detail_uker/'.$_POST['id_remote'].'/'.$_POST['kode_tipe_uker']);
				// 		}
				// }else{
					$this->db->where('id_remote',$_POST['id_remote']);
					$this->db->update('tb_remote',$dataremote);
				//}
			}else if($this->session->userdata('role')==6){
				$kode_kanca = '';

				if (isset($_POST['kode_kanca'])) {
					$kode_kanca = $_POST['kode_kanca'];
				}else{
					$kode_kanca = $_POST['kode_kanca2'];
				}
				
				$datakanwil  = array(
					'pic_kanwil' => $_POST['pic_kanwil']
				);

				$this->db->where('kode_kanwil',$_POST['kode_kanwil']);
		        $this->db->update('tb_kanwil',$datakanwil);

				$datakanca  = array(
					'pic_pinca' => $_POST['pic_pinca'],
					'pic_spo'   => $_POST['pic_spo'],
					'pet_it'    => $_POST['pet_it']
				);

				$this->db->where('kode_kanca',$kode_kanca);
		        $this->db->update('tb_kanca',$datakanca);

		        $dataremote = array(
		        	'pic_uko'    => $_POST['pic_uker'],
		        	//'kode_op'     => $_POST['kode_op'],
		        	'alamat_uker' => $_POST['alamat'],
		        	'telp_uker'   => $_POST['telp'],
		        	//'ip_lan'   	  => $_POST['ip_lan'],
		        	//'kode_uker'   => $_POST['kode_uker'],
		        	'keterangan'  => $keterangan,
		        	'start_nop'   => $_POST['start_nop'],
		        	'end_nop'  	  => $_POST['end_nop'],
		        	'user_update'	=> $this->session->userdata('username'),
		        	'update_at'		=> date('Y-m-d H:i:s'),
		        	'kode_kanca'  => $kode_kanca
		        );

		        //var_dump($dataremote);

		        $this->db->where('id_remote',$_POST['id_remote']);
		        $this->db->update('tb_remote',$dataremote);
			}
			
			$datahistory = array(
					'id'			=> '',
		        	'pic_uko'    	=> $_POST['pic_uker'],
		        	'kode_op'     	=> $_POST['kode_op'],
		        	'kode_tipe_uker'=> $_POST['kode_tipe_uker'],
		        	'nama_remote'   => $_POST['nama_remote'],
		        	'alamat_uker' 	=> $_POST['alamat'],
		        	'telp_uker'  	=> $_POST['telp'],
		        	//'ip_lan'   	  	=> $_POST['ip_lan'],
		        	//'ip_monitoring' => $_POST['ip_monitoring'],
		        	'kode_uker'   	=> $_POST['kode_uker'],
		        	'keterangan'  	=> $keterangan,
		        	'start_nop'   	=> $_POST['start_nop'],
		        	'end_nop'  	  	=> $_POST['end_nop'],
		        	'user_update'	=> $this->session->userdata('username'),
		        	'user_creator'	=> $this->session->userdata('username'),
		        	'create_at'		=> date('Y-m-d H:i:s'),
		        	'update_at'		=> date('Y-m-d H:i:s'),
		        	//'kode_kanca'  	=> $_POST['kode_kanca'],
		        	'id_remote'  	=> $_POST['id_remote'],
		        	'latitude'  	=> $_POST['latitude'],
		        	'longitude'  	=> $_POST['longitude'],
		        	'action'		=> 'Edit Remote'
		        );
				
				if($this->session->userdata('role')!=1){
					 $datahistory = array(
						'ip_lan'   	  	=> $_POST['ip_lan'],
						'kode_kanca'  	=> $_POST['kode_kanca2']
					);
				}else{
					$datahistory = array(
						'ip_lan'   	  	=> $_POST['ip_lan'],
						'kode_kanca'  	=> $_POST['kode_kanca']
					);
				}
				
			$this->db->insert('tb_remote_history',$datahistory);

	        redirect('Dashboard/detail_uker/'.$_POST['id_remote'].'/'.$_POST['kode_tipe_uker']);

		//}
	}


	function add_remote()
	{
		$keterangan = '';
		if ($_POST['keterangan']!='') {
			$keterangan = '['.date('Y-m-d H:i:s').'] '.$_POST['keterangan'];
		}

		$data = array(
					'id_remote'		=> '',
		        	'pic_uko'    	=> $_POST['pic_uker'],
		        	'kode_op'     	=> $_POST['kode_op'],
		        	'kode_tipe_uker'=> $_POST['kode_tipe_uker'],
		        	'nama_remote'   => $_POST['nama_remote'],
		        	'alamat_uker' 	=> $_POST['alamat'],
		        	'telp_uker'  	=> $_POST['telp'],
		        	'ip_lan'   	  	=> $_POST['ip_lan'],
		        	'kode_uker'   	=> $_POST['kode_uker'],
		        	'keterangan'  	=> $keterangan,
		        	'start_nop'   	=> $_POST['start_nop'],
		        	'end_nop'  	  	=> $_POST['end_nop'],
		        	'user_update'	=> $this->session->userdata('username'),
		        	'user_creator'	=> $this->session->userdata('username'),
		        	'create_at'		=> date('Y-m-d H:i:s'),
		        	'update_at'		=> date('Y-m-d H:i:s'),
		        	'kode_kanca'  	=> $_POST['kode_kanca'],
		        	'latitude'  	=> $_POST['latitude'],
		        	'longitude'  	=> $_POST['longitude']
		        );
		$this->db->insert('tb_remote',$data);

		$datahistory = array(
					'id_remote'		=> '',
		        	'pic_uko'    	=> $_POST['pic_uker'],
		        	'kode_op'     	=> $_POST['kode_op'],
		        	'kode_tipe_uker'=> $_POST['kode_tipe_uker'],
		        	'nama_remote'   => $_POST['nama_remote'],
		        	'alamat_uker' 	=> $_POST['alamat'],
		        	'telp_uker'  	=> $_POST['telp'],
		        	'ip_lan'   	  	=> $_POST['ip_lan'],
		        	'kode_uker'   	=> $_POST['kode_uker'],
		        	'keterangan'  	=> $keterangan,
		        	'start_nop'   	=> $_POST['start_nop'],
		        	'end_nop'  	  	=> $_POST['end_nop'],
		        	'user_update'	=> $this->session->userdata('username'),
		        	'user_creator'	=> $this->session->userdata('username'),
		        	'create_at'		=> date('Y-m-d H:i:s'),
		        	'update_at'		=> date('Y-m-d H:i:s'),
		        	'kode_kanca'  	=> $_POST['kode_kanca'],
		        	'latitude'  	=> $_POST['latitude'],
		        	'longitude'  	=> $_POST['longitude'],
		        	'action'		=> 'Edit Remote'
		        );
		$this->db->insert('tb_remote_history',$datahistory);

        redirect('Dashboard/All_uker');
	}


	function uker_excel()
	{
		$kategori = $this->uri->segment(3);
		if ($kategori == "kanwil") { 

			$kanwil = $this->uri->segment(4);
			$data['kanca'] = $this->db->select('kode_kanca')->from('tb_kanca')->where('kode_kanwil',$kanwil)->get()->result();
			$ids = array();
			foreach ($data['kanca'] as $datakanca) {
				$ids[] = $datakanca->kode_kanca;
			}
			$data['data'] =  $this->m_dashboard->data_uker_kanwil($kanwil,$ids);


			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
				if($remote->kode_tipe_uker==7){
					$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
				}
			}

			$data['nama'] = $this->db->get_where('tb_kanwil', array('kode_kanwil'=>$kanwil))->result();
	        $data['page'] = 'kanwil';

	        $this->load->view('List/uker_excel',$data);

		}else if ($kategori == "per_kanwil") { 

			$status = $this->uri->segment(4);
			$kanwil = $this->uri->segment(5);
			$kode_tipe_uker = $this->uri->segment(6);
			$kode_op = $this->uri->segment(7);

			$data['kode_kanwil'] = $kanwil;
			$data['kanca'] = $this->db->select('kode_kanca')->from('tb_kanca')->where('kode_kanwil',$kanwil)->get()->result();

			$ids = array();
			foreach ($data['kanca'] as $datakanca) {
				$ids[] = $datakanca->kode_kanca;
			}

			$data['data'] =  $this->m_dashboard->data_uker_per_kanwil($kanwil,$ids,$status,$kode_tipe_uker,$kode_op);


			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
				if($remote->kode_tipe_uker==7){
					$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
				}
				
			}

			$data['nama_kanwil'] = $this->db->get_where('tb_kanwil', array('kode_kanwil'=>$kanwil))->result();
			$data['tipe_uker'] = $this->db->get_where('tb_tipe_uker', array('kode_tipe_uker'=>$kode_tipe_uker))->result();
	        $data['page'] = 'kanwil';
	        $data['title'] = 'Remote List - Region '.$data['nama_kanwil'][0]->nama_kanwil;

	        $this->load->view('List/uker_excel',$data);

		}else if($kategori == "kanca"){
			$kanca = $this->uri->segment(4); 
			$data['data'] =  $this->m_dashboard->data_uker_kanca($kanca);

			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
				if($remote->kode_tipe_uker==7){
					$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
				}
			}

			$data['nama'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
	        $data['page'] = 'kanwil';

	        //var_dump($data['data']);
	        $this->load->view('List/uker_excel',$data);
		}else if($kategori == "uker"){
			$kanca = $this->uri->segment(4);
			$kode_tipe_uker = $this->uri->segment(5);

			$data['data'] = $this->m_dashboard->data_uker($kanca,$kode_tipe_uker);

			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
				if($remote->kode_tipe_uker==7){
					$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
				}
			}

			$data['nama_uker'] = $this->db->get_where('tb_tipe_uker', array('kode_tipe_uker'=>$kode_tipe_uker))->result();
	        $data['page'] = 'kanwil';

	        $this->load->view('List/uker_excel',$data);
		}else if($kategori == "disable"){

			$data['data'] = $this->m_dashboard->data_uker_disable();

			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
				if($remote->kode_tipe_uker==7){
					$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
				}
			}

	        $data['page'] = 'disable';

	        $this->load->view('List/uker_excel',$data);
		}else if($kategori == "All"){

			$data['data'] =  $this->m_dashboard->data_all_uker();


			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
				if($remote->kode_tipe_uker==7){
					$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
				}
			}

			$data['nama'] = 'ALL Region';
	        $data['page'] = 'kanwil';

	        $this->load->view('List/uker_excel',$data);

		}else if($kategori == "provider"){

			$kode_provider = $this->uri->segment(4);
            $kode_jenis_jarkom = $this->uri->segment(5);
            $brisat = $this->uri->segment(6);

            $total = $this->m_dashboard->uker_prov_total($kode_provider, $brisat, $kode_jenis_jarkom, '');

			$data['total'] = $total;


			$data['remote'] = $this->m_dashboard->uker_prov_all($kode_provider,$brisat,$kode_jenis_jarkom,'','','');

			//var_dump($data['remote']);

	        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
	        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
			$data['page'] = 'prov';
			$data['title'] = 'Network List';
			
			$this->load->view('excel_prov',$data);
			
		}else if($kategori == "testTable"){

			$where = $this->uri->segment(4);
			if ($where=='branch') {
				$data['data'] = $this->db->select('b.*,b.status as status_onoff')
									 ->from('tb_militan a')
									 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
									 ->order_by('b.status','asc')
									 ->like('a.event',$where)
									 //->where('a.event',$where)
									 // ->limit(100,0)
									 ->get()
									 ->result();
			}else{
				$data['data'] = $this->db->select('b.*,b.status as status_onoff')
									 ->from('tb_militan a')
									 ->join('v_all_remote b','b.id_remote=a.id_remote','left')
									 ->order_by('b.status','asc')
									 // ->where_in('kode_op',array(1,2))
									 // ->limit(100,0)
									 ->get()
									 ->result();
			}

			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
				if($remote->kode_tipe_uker==7){
					$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
				}
				
			}
			$data['page'] = 'naru-reporting';
			$data['title'] = 'NARU Monitoring';

	        $this->load->view('List/uker_excel',$data);
		}
	}

	function Disable()
	{
		$data['data'] = $this->m_dashboard->data_uker_disable();

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}

        $data['page'] = 'disable';
        $data['title'] = 'Remote List Disable';
		$this->template->views('List/uker_disable',$data);
	}

	function Un_Used()
	{
		$data['data'] = $this->m_dashboard->data_jarkom_disable();

		// for ($i=0; $i < count($data['data']) ; $i++) { 
		// 	$remote = $data['data'][$i];
		// 	$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkombyid($remote->koja);
		// 	if($remote->kode_tipe_uker==7){
		// 		$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
		// 	}
		// }

        $data['page'] = 'unused';
        $data['title'] = 'Network List Un Used';
		$this->template->views('List/jarkom_disable',$data);
	}

	function Dash_Prov()
	{

		$data['jenis_jarkom'] = $this->db->get('tb_jenis_jarkom')->result();
		
		$no=0;
		foreach ($data['jenis_jarkom'] as $jj) {
			
			$prov = $this->db->query("SELECT
											a.kode_provider,
											CONCAT(
												'BRISAT',
												'-',
												b.nickname_provider
											) AS nickname_provider,
											a.brisat,
											a.kode_jenis_jarkom,
											CONCAT(
												a.kode_provider,
												a.kode_jenis_jarkom,
												a.brisat
											) AS id
										FROM
											tb_jarkom a
										LEFT JOIN tb_provider b ON b.kode_provider = a.kode_provider
										LEFT JOIN tb_jenis_jarkom c ON c.kode_jenis_jarkom = a.kode_jenis_jarkom
										LEFT JOIN tb_remote d ON d.id_remote = a.id_remote
										WHERE
											d.kode_op IN (1, 2)
										AND a.brisat = 1
										AND a.kode_jenis_jarkom = '$jj->kode_jenis_jarkom'
										UNION
											SELECT
												a.kode_provider,
												CONCAT(
													c.jenis_jarkom,
													'-',
													b.nickname_provider
												) AS nickname_provider,
												a.brisat,
												a.kode_jenis_jarkom,
												CONCAT(
													a.kode_provider,
													a.kode_jenis_jarkom,
													a.brisat
												) AS id
											FROM
												tb_jarkom a
											LEFT JOIN tb_provider b ON b.kode_provider = a.kode_provider
											LEFT JOIN tb_jenis_jarkom c ON c.kode_jenis_jarkom = a.kode_jenis_jarkom
											LEFT JOIN tb_remote d ON d.id_remote = a.id_remote
											WHERE
												d.kode_op IN (1, 2)
											AND a.brisat = 0
											AND a.kode_jenis_jarkom = '$jj->kode_jenis_jarkom'")->result();
			$data['prov'][$jj->kode_jenis_jarkom] = $prov;
			$data['total'][$no] = 0;
			for ($j=0; $j < count($prov); $j++) { 
				$p = $prov[$j]->kode_provider;
				$b = $prov[$j]->brisat;
				$jarkom = $prov[$j]->kode_jenis_jarkom;
				$nick = $prov[$j]->nickname_provider;
				$data['data_prov'][$jj->kode_jenis_jarkom][$j] = $this
									->m_dashboard
									->getOnOffProvider($p,$b,$nick,$jarkom);
				//$data['total'][$no] = $data['total'][$no] + $data['data_prov'][$jj->kode_jenis_jarkom][$j]['on'];
				$data['total'][$no] = $data['total'][$no] + $data['data_prov'][$jj->kode_jenis_jarkom][$j]['total'];
			}
			$no++;
		}
		//	var_dump($data);
			//echo count($data['prov']).'='.count($data['data_prov']);
		$data['page'] = 'prov';
        $data['title'] = 'Dashboard Provider';
		$this->template->views('dashboard/dash_prov_one2',$data);

	}

	function refreshProv()
	{
		$data['jenis_jarkom'] = $this->db->get('tb_jenis_jarkom')->result();
		
		$no=0;
		foreach ($data['jenis_jarkom'] as $jj) {
			$prov = $this->db->query("SELECT
											a.kode_provider,
											CONCAT(
												'BRISAT',
												'-',
												b.nickname_provider
											) AS nickname_provider,
											a.brisat,
											a.kode_jenis_jarkom,
											CONCAT(
												a.kode_provider,
												a.kode_jenis_jarkom,
												a.brisat
											) AS id
										FROM
											tb_jarkom a
										LEFT JOIN tb_provider b ON b.kode_provider = a.kode_provider
										LEFT JOIN tb_jenis_jarkom c ON c.kode_jenis_jarkom = a.kode_jenis_jarkom
										LEFT JOIN tb_remote d ON d.id_remote = a.id_remote
										WHERE
											d.kode_op IN (1, 2)
										AND a.brisat = 1
										AND a.kode_jenis_jarkom = '$jj->kode_jenis_jarkom'
										UNION
											SELECT
												a.kode_provider,
												CONCAT(
													c.jenis_jarkom,
													'-',
													b.nickname_provider
												) AS nickname_provider,
												a.brisat,
												a.kode_jenis_jarkom,
												CONCAT(
													a.kode_provider,
													a.kode_jenis_jarkom,
													a.brisat
												) AS id
											FROM
												tb_jarkom a
											LEFT JOIN tb_provider b ON b.kode_provider = a.kode_provider
											LEFT JOIN tb_jenis_jarkom c ON c.kode_jenis_jarkom = a.kode_jenis_jarkom
											LEFT JOIN tb_remote d ON d.id_remote = a.id_remote
											WHERE
												d.kode_op IN (1, 2)
											AND a.brisat = 0
											AND a.kode_jenis_jarkom = '$jj->kode_jenis_jarkom'")->result();
			$data['prov'][$jj->kode_jenis_jarkom] = $prov;
			$data['total'][$no] = 0;
			for ($j=0; $j < count($prov); $j++) { 
				$p = $prov[$j]->kode_provider;
				$b = $prov[$j]->brisat;
				$jarkom = $prov[$j]->kode_jenis_jarkom;
				$nick = $prov[$j]->nickname_provider;
				$data['data_prov'][$jj->kode_jenis_jarkom][$j] = $this
									->m_dashboard
									->getOnOffProvider($p,$b,$nick,$jarkom);
				//$data['total'][$no] = $data['total'][$no] + $data['data_prov'][$jj->kode_jenis_jarkom][$j]['on'];
				$data['total'][$no] = $data['total'][$no] + $data['data_prov'][$jj->kode_jenis_jarkom][$j]['total'];
			}
			$no++;
		}

			//var_dump($data['prov']);
			//echo count($data['prov']).'='.count($data['data_prov']);
			echo json_encode($data);

	}

	function Get_Jarkom()
	{
		$kode_jarkom = $_POST['kode_jarkom'];

		$data = $this->m_dashboard->getjarkombykode($kode_jarkom);

		echo json_encode($data);
	}

	function edit_jarkom()
	{
		if(isset($_POST['kode_jarkom'])) {
			$brisat = 0;
			$brisat_batch = '0';
	        if (isset($_POST['brisat'])) {
	        	$brisat = $_POST['brisat'];

	        	// if ($_POST['brisat']=='21') {
	        	// 	$brisat_batch = 'A';
	        	// 	$brisat = 2;
	        	// }else if ($_POST['brisat']=='22') {
	        	// 	$brisat_batch = 'B';
	        	// 	$brisat = 2;
	        	// }

	        	if ($brisat=='2') {
	        		$brisat_batch = $_POST['brisat_batch'];
	        	}else{
	        		$brisat_batch = 0;
	        	}

	        }else{
	        	$brisat = $_POST['brisat_awal'];
	        }

	        if ($_POST['kode_jenis_jarkom']!=1) {
	        	$brisat = 0;
	        }

	        $datajarkom = array(
	        	'kode_jenis_jarkom'     => $_POST['kode_jenis_jarkom'],
	        	'kode_jarkom'     		=> $_POST['kode_jarkom'],
	        	'kode_provider' 		=> $_POST['kode_provider'],
	        	'bandwidth'   			=> $_POST['bandwidth'],
	        	'ip_wan'   	 		 	=> $_POST['ip_wan'],
				'brisat'   				=> $brisat,
				'brisat_batch'   		=> $brisat_batch,
				'used_status'   		=> $_POST['used_status'],
				'keterangan'   			=> $_POST['keterangan'],
				'user_update'			=> $this->session->userdata('username'),
				'update_at'				=> date('Y-m-d H:i:s')
	        );

	        $this->db->where('id',$_POST['id_jarkom']);
	        $this->db->update('tb_jarkom',$datajarkom);


	        $jarkom = array(
	        	'kode_jarkom'			=> $_POST['kode_jarkom'],
	        	'kode_jenis_jarkom'     => $_POST['kode_jenis_jarkom'],
	        	'kode_provider' 		=> $_POST['kode_provider'],
	        	'bandwidth'   			=> $_POST['bandwidth'],
	        	'ip_wan'   	 		 	=> $_POST['ip_wan'],
				'brisat'   				=> $brisat,
				'used_status'   		=> $_POST['used_status'],
				'id_remote'   			=> $_POST['id_remote'],
				'id_spk'				=> 1,
				'keterangan'   			=> $_POST['keterangan'],
				'user_update'			=> $this->session->userdata('username'),
				'update_at'				=> date('Y-m-d H:i:s')
	        );

	        $this->db->insert('tb_jarkom_history',$jarkom);

	        echo "true";

		}
	}

	function uker_prov()
	{

        $this->load->library('pagination');

		$kode_provider = $this->uri->segment(3);
		$kode_jenis_jarkom = $this->uri->segment(4);
		$brisat = $this->uri->segment(5);
		$name = $this->uri->segment(6);

		$total = $this->m_dashboard->uker_prov_total($kode_provider, $brisat, $kode_jenis_jarkom, '');

		$data['total'] = $total;

        $config['base_url'] = base_url().'index.php/Dashboard/uker_prov/'.$kode_provider.'/'.$kode_jenis_jarkom.'/'.$brisat.'/'.$name.'/';        
        $config['total_rows'] = $total;        
        $config['per_page'] = 10;        
        $config['uri_segment'] = 7;        
        $config['full_tag_open'] = '<div><ul class="pagination">';        
        $config['full_tag_close'] = '</ul></div>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="prev">';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li>';        
        $config['num_tag_close'] = '</li>';

        $page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
        $this->pagination->initialize($config);

		$data['remote'] = $this->m_dashboard->uker_prov($kode_provider,$brisat,$kode_jenis_jarkom,$config['per_page'], $page,'');

		//var_dump($data['remote']);

        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
		$data['page'] = 'prov';
		$data['title'] = 'Network List';
		$this->template->views('List/uker_prov',$data);
	}

	function uker_prov_search()
	{

        $this->load->library('pagination');
        $page = 0;
        $config = array();

		$kode_provider = $this->uri->segment(3);
		$kode_jenis_jarkom = $this->uri->segment(4);
		$brisat = $this->uri->segment(5);
		$name = $this->uri->segment(6);
		$search = $this->uri->segment(7);//$_POST['input'];
        //echo $search;
        $config['per_page'] = 10;

		$total = $this->m_dashboard->uker_prov_total($kode_provider,$brisat,$kode_jenis_jarkom,$search);
		$data['total'] = $total;

        $config['total_rows'] = $total;
        $config['base_url'] = base_url().'index.php/Dashboard/uker_prov_search/'.$kode_provider.'/'.$kode_jenis_jarkom.'/'.$brisat.'/'.$name.'/'.$search;
        $config['uri_segment'] = 8;        
        $config['full_tag_open'] = '<div><ul class="pagination">';        
        $config['full_tag_close'] = '</ul></div>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="prev">';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li>';        
        $config['num_tag_close'] = '</li>';

        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
        $this->pagination->initialize($config);

		$data['remote'] = $this->m_dashboard->uker_prov($kode_provider,$brisat,$kode_jenis_jarkom,$config['per_page'],$page,$search);

		//var_dump($data['remote']);

        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
		$data['page'] = 'prov';
		$data['title'] = 'Network List';
		$this->template->views('List/uker_prov_search',$data);
	}

	function uker_prov_json()
	{

       

		$kode_provider = $this->uri->segment(3);
		$kode_jenis_jarkom = $this->uri->segment(4);
		$brisat = $this->uri->segment(5);
		$name = $this->uri->segment(6);
		$total = $this->uri->segment(7);

		$data['remote'] = $this->db->query("SELECT
										a.*,
										b.nama_remote,
										b.kode_op,
										c.status,
										f.nama_kanca,
										g.nama_kanwil,
										h.tipe_uker,
										c.status_fail_date,
										c.status_rec_date
									FROM
										tb_jarkom a
									LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
									LEFT JOIN tb_remote_status c ON c.ip_lan = b.ip_lan
									LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
									LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom
									LEFT JOIN tb_kanca f ON f.kode_kanca = b.kode_kanca
									LEFT JOIN tb_kanwil g ON g.kode_kanwil = f.kode_kanwil
									LEFT JOIN tb_tipe_uker h ON h.kode_tipe_uker = b.kode_tipe_uker
									WHERE a.kode_provider = '$kode_provider'
									AND a.brisat = '$brisat'
									AND a.kode_jenis_jarkom = '$kode_jenis_jarkom'
									AND b.kode_op != 0
									ORDER BY c.status ASC LIMIT $start,$per_page")->result();

		//var_dump($data['remote']);

        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
		$data['page'] = 'prov';
		echo json_encode($data);
	}

	function All_uker()
	{
		$this->load->library('pagination');

        $config['per_page'] = 10;

		$total = $this->m_dashboard->jumlah_uker_all();

		$data['total'] = $total;

        $config['total_rows'] = $total;
        $config['base_url'] = base_url().'index.php/Dashboard/All_uker/';
        $config['uri_segment'] = 3;        
        $config['full_tag_open'] = '<div><ul class="pagination">';        
        $config['full_tag_close'] = '</ul></div>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="prev">';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li>';        
        $config['num_tag_close'] = '</li>';

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);

		$data['data'] = $this->m_dashboard->data_uker_all($config['per_page'],$page,'','');

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}
		//var_dump($data['data']);
		$data['kanca'] = $this->db->select('*')->from('tb_kanca')->order_by('nama_kanca','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
        $data['tipe_uker'] = $this->db->select('*')->from('tb_tipe_uker')->order_by('kode_tipe_uker','asc')->get()->result();
        
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List';
		$this->template->views('List/uker_all',$data);
	}
	
	function All_uker2()
	{
		$this->load->library('pagination');

        $config['per_page'] = 10;

		$total = $this->m_dashboard->jumlah_uker_all();

		$data['total'] = $total;

        $config['total_rows'] = $total;
        $config['base_url'] = base_url().'index.php/Dashboard/All_uker2/';
        $config['uri_segment'] = 3;        
        $config['full_tag_open'] = '<div><ul class="pagination">';        
        $config['full_tag_close'] = '</ul></div>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="prev">';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li>';        
        $config['num_tag_close'] = '</li>';

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);

		$data['data'] = $this->m_dashboard->data_uker_all($config['per_page'],$page,'','');

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}
		//var_dump($data['data']);
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List';
		$this->template->views('List/uker_all2',$data);
	}

	function All_uker_search()
	{
		$this->load->library('pagination');

		$search = urldecode($this->uri->segment(4));//$_POST['input'];
		$kategori = $this->uri->segment(3);//$_POST['kategori'];

        $config['per_page'] = 10;

		$total = $this->m_dashboard->jumlah_uker_all_search2($kategori,$search);

		$data['total'] = $total;
		//var_dump($data['total']);die();

        $config['total_rows'] = $total;
        $config['base_url'] = base_url().'index.php/Dashboard/All_uker_search/'.$kategori.'/'.$search;
        $config['uri_segment'] = 5;        
        $config['full_tag_open'] = '<div><ul class="pagination">';        
        $config['full_tag_close'] = '</ul></div>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="prev">';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li>';        
        $config['num_tag_close'] = '</li>';

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $this->pagination->initialize($config);

		//$data['data'] = $this->m_dashboard->data_uker_all($config['per_page'],$page,$kategori,$search);
		$data['data'] = $this->m_dashboard->data_all_uker_search($config['per_page'],$page,$kategori,$search);

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}
		//var_dump($data['data']);
		$data['kanca'] = $this->db->select('*')->from('tb_kanca')->order_by('nama_kanca','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
        $data['tipe_uker'] = $this->db->select('*')->from('tb_tipe_uker')->order_by('kode_tipe_uker','asc')->get()->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List';
		$this->template->views('List/uker_all_search',$data);
	}

	function disable_jarkom()
	{
		if(isset($_POST['kode_jarkom'])) {

	        $datajarkom = array(
	        	'used_status' => 0
	        );	        

	        $this->db->where('kode_jarkom',$_POST['kode_jarkom']);
	        $this->db->update('tb_jarkom',$datajarkom);

	        echo "true";

		}
	}

	function add_jarkom()
	{
		if(isset($_POST['submit'])) {
			//$kode_jarkom = $this->m_dashboard->get_id_last_jarkom();
			$brisat = 0;
			$brisat_batch = '0';
			if ($_POST['kode_jenis_jarkom']!=1) {
				$_POST['brisat'] = 0;
			}else{
				$brisat = $_POST['brisat'];

	        	// if ($_POST['brisat']=='21') {
	        	// 	$brisat_batch = 'A';
	        	// 	$brisat = 2;
	        	// }else if ($_POST['brisat']=='22') {
	        	// 	$brisat_batch = 'B';
	        	// 	$brisat = 2;
	        	// }

	        	if ($_POST['brisat']=='2') {
	        		$brisat_batch = $_POST['brisat_batch'];
	        	}else{
	        		$brisat_batch = 0;
	        	}
			}
			//var_dump($kode_jarkom);die();
	        $data = array(
	        	'id_remote'   		=> $_POST['id_remote'],
	        	'kode_jarkom'  		=> $_POST['kode_jarkom'],
	        	'keterangan'    	=> $_POST['keterangan'],
	        	'kode_provider' 	=> $_POST['kode_provider'],
	        	'kode_jenis_jarkom' => $_POST['kode_jenis_jarkom'],
	        	'ip_wan'   	    	=> $_POST['ip_wan'],
	        	'bandwidth'   		=> $_POST['bandwidth'],
				'brisat'   			=> $brisat,
				'brisat_batch'   	=> $brisat_batch,
	        	'create_at'			=> date("Y-m-d H:i:s"),
	        	'user_create'		=> $this->session->userdata("username"),
	        	'id_spk'   			=> 1,
	        	'used_status'  		=> 1
	        );

	        //var_dump($data);
	        $this->db->insert('tb_jarkom', $data);
	        $this->db->insert('tb_jarkom_history', $data);

	        redirect('Dashboard/detail_uker/'.$_POST['id_remote'].'/'.$_POST['kode_tipe_uker']);

		}else{
			$kode_jarkom = $this->m_dashboard->get_id_last_jarkom();

			echo json_encode($kode_jarkom);
		}
	}

	function test($search = '')
	{
		$data = $this->m_dashboard->data_all_uker_search_prov($search);

		var_dump($data);
	}

	function getPIC()
	{
		$kanca = $_POST['kanca'];
		$data = $this->m_dashboard->getPIC($kanca);
		echo json_encode($data);
	}

	function data_uker_per_kanwil($status='',$kanwil='',$kode_tipe_uker='',$kode_op='')
	{
		$data['kode_kanwil'] = $kanwil;
		$data['kanca'] = $this->db->select('kode_kanca')->from('tb_kanca')->where('kode_kanwil',$kanwil)->get()->result();

		$ids = array();
		foreach ($data['kanca'] as $datakanca) {
			$ids[] = $datakanca->kode_kanca;
		}

		$data['data'] =  $this->m_dashboard->data_uker_per_kanwil($kanwil,$ids,$status,$kode_tipe_uker,$kode_op);

		//print_r($data['data']); die();


		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
			
		}

		$data['nama_kanwil'] = $this->db->get_where('tb_kanwil', array('kode_kanwil'=>$kanwil))->result();
		$data['tipe_uker'] = $this->db->get_where('tb_tipe_uker', array('kode_tipe_uker'=>$kode_tipe_uker))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List - Region '.$data['nama_kanwil'][0]->nama_kanwil;


		$this->template->views('List/uker_per_kanwil',$data);
	}


	/*
	:: ================================================
	:: *** shifting report function *** 
	:: *** Author = idris sulaiman  *** 
	::
	:: ================================================
	*/

	function tableEvent()
	{
		$data['page'] = 'Listing Event';
		$data['title'] = '::listing event::';
		$this->template->views('shifting_report/tableEvent',$data);
	}

	function updateEvent($id)
	{
		$this->load->model("M_ShiftReport");
		$qstr = "SELECT id_type_event from tb_event where id_event=?";
		$data=array($id);
		$process = $this->M_ShiftReport->getDataEvent($qstr,$data);

		$type_event = $process[0]->id_type_event;

		switch($type_event)
		{
			case "1" :
				

					$queryStringEvent = "SELECT tb_event.id_type_event,tb_event.report_number,tb_event.event_name,tb_event.event_detail,tb_event.event_start,tb_event.event_end,tb_event.email,tb_status_report.status,tb_event.note from tb_event,tb_status_report where tb_event.id_event=? and tb_status_report.id=tb_event.status ";

					$queryStringLocation="SELECT tb_kota.id,tb_kota.name from tb_event,tb_kota where tb_kota.id = tb_event.id_location and tb_event.id_event = ?";

					$queryStringEnginer="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_escalate where tb_user.id = tb_escalate.id_engineer and tb_escalate.id_event = tb_event.id_event and tb_event.id_event=?";

					$queryStringReporter="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_operator where tb_user.id = tb_operator.id_operator and tb_operator.id_event = tb_event.id_event and tb_event.id_event=?";

					$process = $this->M_ShiftReport->getDataEvent($queryStringEvent,$data);
					$processLocation = $this->M_ShiftReport->getDataEvent($queryStringLocation,$data);
					$processEnginer = $this->M_ShiftReport->getDataEvent($queryStringEnginer,$data);
					$processReporter = $this->M_ShiftReport->getDataEvent($queryStringReporter,$data);

					$data['message']="type report 1";
					$data['proses'] = $process;
					foreach ($process as $key) 
					{
						$data['id_event']		= $id; // id pada baris table_event
						$data['type_report'] 	= $key->id_type_event;
						$data['report_number'] 	= $key->report_number;
						$data['plan_name'] 		= $key->event_name;
						$data['activity'] 		= $key->event_detail;
						$data['start_time'] 	= $key->event_start;
						$data['end_time'] 		= $key->event_end;
						$data['status'] 		= $key->status;
						$data['note'] 			= $key->note;
						$data['emails'] 		= $key->email;						
					}

					$data['location'] 		= $processLocation[0]->name;
					$data['id_location'] 		= $processLocation[0]->id;

					$data['enginer'] = array();
					foreach ($processEnginer as $key) {
						
						$list_enginer['id_enginer'] = $key->id;
						$list_enginer['nama_enginer'] = $key->nama;

						array_push($data['enginer'], $list_enginer);
					}

					$data['reporter'] = array();
					foreach ($processReporter as $key) {
						
						$list_reporter['id_reporter'] = $key->id;
						$list_reporter['nama_reporter'] = $key->nama;

						array_push($data['reporter'], $list_reporter);
					}
			break;

			/* end off case !*/

			case '2' :

				$queryStringEvent = "SELECT tb_event.id_type_event,tb_event.report_number,tb_event.event_name,tb_event.event_detail,tb_event.event_start,tb_event.event_end,tb_event.email,tb_status_report.status,tb_event.note from tb_event,tb_status_report where tb_event.id_event=? and tb_status_report.id=tb_event.status ";
				$queryStringLocation="SELECT tb_kota.id,tb_kota.name from tb_event,tb_kota where tb_kota.id = tb_event.id_location and tb_event.id_event = ?";

				$queryStringEnginer="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_escalate where tb_user.id = tb_escalate.id_engineer and tb_escalate.id_event = tb_event.id_event and tb_event.id_event=?";

				$queryStringReporter="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_operator where tb_user.id = tb_operator.id_operator and tb_operator.id_event = tb_event.id_event and tb_event.id_event=?";

				$queryStringIncident = "SELECT tb_incident_report.impact,tb_incident_report.root_cause,tb_incident_report.action from tb_incident_report,tb_event where tb_event.id_event=? and tb_event.id_event = tb_incident_report.id_event ";

				$process = $this->M_ShiftReport->getDataEvent($queryStringEvent,$data);
				$processLocation = $this->M_ShiftReport->getDataEvent($queryStringLocation,$data);
				$processEnginer = $this->M_ShiftReport->getDataEvent($queryStringEnginer,$data);
				$processReporter = $this->M_ShiftReport->getDataEvent($queryStringReporter,$data);
				$processIncident = $this->M_ShiftReport->getDataEvent($queryStringIncident,$data);



				$data['message']="type report 2";
					foreach ($process as $key) 
					{
						$data['id_event']		= $id; // id pada baris table_event
						$data['type_report'] 	= $key->id_type_event;
						$data['report_number'] 	= $key->report_number;
						$data['plan_name'] 		= $key->event_name;
						$data['activity'] 		= $key->event_detail;
						$data['start_time'] 	= $key->event_start;
						$data['end_time'] 		= $key->event_end;
						$data['status'] 		= $key->status;
						$data['note'] 			= $key->note;
						$data['emails'] 		= $key->email;						
					}

				$data['location'] 			= $processLocation[0]->name;
				$data['id_location'] 		= $processLocation[0]->id;

				$data['enginer'] = array();
					foreach ($processEnginer as $key) {
						
						$list_enginer['id_enginer'] = $key->id;
						$list_enginer['nama_enginer'] = $key->nama;

						array_push($data['enginer'], $list_enginer);
					}

				$data['reporter'] = array();
					foreach ($processReporter as $key) {
						
						$list_reporter['id_reporter'] = $key->id;
						$list_reporter['nama_reporter'] = $key->nama;

						array_push($data['reporter'], $list_reporter);
					}

				$data['incident'] = array();
					foreach ($processIncident as $key) {
						
						$list_incident['impact'] = $key->impact;
						$list_incident['root_cause'] = $key->root_cause;
						$list_incident['action'] = $key->action;

						array_push($data['incident'], $list_incident);
					}		
				
			break;

		/* end off case !*/
		
		case '3' :

				$queryStringEvent = "SELECT tb_event.id_type_event,tb_event.report_number,tb_event.event_name,tb_event.event_detail,tb_event.event_start,tb_event.event_end,tb_event.email,tb_status_report.status,tb_event.note,tb_event.user_create from tb_event,tb_status_report where tb_event.id_event=? and tb_status_report.id=tb_event.status ";

				$queryStringReporter="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_operator where tb_user.id = tb_operator.id_operator and tb_operator.id_event = tb_event.id_event and tb_event.id_event=?";

				$queryStringLocation="SELECT tb_kota.id,tb_kota.name from tb_event,tb_kota where tb_kota.id = tb_event.id_location and tb_event.id_event = ?";
				
				$process = $this->M_ShiftReport->getDataEvent($queryStringEvent,$data);
				$processReporter = $this->M_ShiftReport->getDataEvent($queryStringReporter,$data);
				$processLocation = $this->M_ShiftReport->getDataEvent($queryStringLocation,$data);


					foreach ($process as $key) 
					{
						$data['message']        ="type report ".$key->id_type_event;
						$data['id_event']		= $id; // id pada baris table_event
						$data['type_report'] 	= $key->id_type_event;
						$data['report_number'] 	= $key->report_number;
						$data['event_name'] 	= $key->event_name;
						$data['event_detail'] 	= $key->event_detail;
						$data['start_time'] 	= $key->event_start;
						$data['end_time'] 		= $key->event_end;
						$data['status'] 		= $key->status;
						$data['note'] 			= $key->note;
						$data['emails'] 		= $key->email;	
						$data['user_create'] 	= $key->user_create;						
					}

					$data['reporter'] = array();
					foreach ($processReporter as $key) {
						
						$list_reporter['id_reporter'] = $key->id;
						$list_reporter['nama_reporter'] = $key->nama;

						array_push($data['reporter'], $list_reporter);
					}

					$data['location'] 			= $processLocation[0]->name;
					$data['id_location'] 		= $processLocation[0]->id;	

				//$data['type_report']="3";
			break;

		/* end off case !*/
		
		case '4' :

				$queryStringEvent = "SELECT tb_event.id_type_event,tb_event.report_number,tb_event.event_name,tb_event.event_detail,tb_event.event_start,tb_event.event_end,tb_event.email,tb_status_report.status,tb_event.note,tb_event.user_create from tb_event,tb_status_report where tb_event.id_event=? and tb_status_report.id=tb_event.status ";

				$queryStringReporter="SELECT tb_user.id,tb_user.nama from tb_event,tb_user,tb_operator where tb_user.id = tb_operator.id_operator and tb_operator.id_event = tb_event.id_event and tb_event.id_event=?";

				$queryStringLocation="SELECT tb_kota.id,tb_kota.name from tb_event,tb_kota where tb_kota.id = tb_event.id_location and tb_event.id_event = ?";
				
				$process = $this->M_ShiftReport->getDataEvent($queryStringEvent,$data);
				$processReporter = $this->M_ShiftReport->getDataEvent($queryStringReporter,$data);
				$processLocation = $this->M_ShiftReport->getDataEvent($queryStringLocation,$data);


					foreach ($process as $key) 
					{
						$data['message']        ="type report ".$key->id_type_event;
						$data['id_event']		= $id; // id pada baris table_event
						$data['type_report'] 	= $key->id_type_event;
						$data['report_number'] 	= $key->report_number;
						$data['event_name'] 	= $key->event_name;
						$data['event_detail'] 	= $key->event_detail;
						$data['start_time'] 	= $key->event_start;
						$data['end_time'] 		= $key->event_end;
						$data['status'] 		= $key->status;
						$data['note'] 			= $key->note;
						$data['emails'] 		= $key->email;	
						$data['user_create'] 	= $key->user_create;						
					}

					$data['reporter'] = array();
					foreach ($processReporter as $key) {
						
						$list_reporter['id_reporter'] = $key->id;
						$list_reporter['nama_reporter'] = $key->nama;

						array_push($data['reporter'], $list_reporter);
					}

					$data['location'] 			= $processLocation[0]->name;
					$data['id_location'] 		= $processLocation[0]->id;	

				//$data['type_report']="3";
			break;

			/* end off case !*/				
				


			default: $data['message']="type report not found";break;	
		}

		$data['page'] = 'update Event';
		$data['title'] = '::update event::';
		$this->template->views('shifting_report/updateEvent',$data);

		//echo $type_event;
	}




	/*
	:: ================================================
	:: *** end of shifting report function *** 
	:: ================================================
	*/


	function tampil_table()
	{
		//var_dump($this->input->post());
		$kategori = $this->uri->segment(3);

		$columns = array("No","Remote Id","Remote Name","Remote Type","Region","Main Branch","Branch Code","IP Address","Remote Status","Last Change Update","Network","Action"); // data array columns harus sama dengan data header table yang tadi di buat di view

		$start=$this->input->post("start");//0
		$length=$this->input->post("length");//10
		$order = $this->input->post("order[0][column]"); // kita akan order by dari database
		$sort = $this->input->post("order[0][dir]"); // asc atau desc
		$cari_data = $this->input->post("search[value]");

		$field = '';

		switch ($order) {
		    case 1:
		        $field = "id_remote";
		        break;
		    case 2:
		        $field = "nama_remote";
		        break;
		    case 3:
		        $field = "tipe_uker";
		        break;
		    case 4:
		        $field = "nama_kanwil";
		        break;
		    case 5:
		        $field = "nama_kanca";
		        break;
		    case 6:
		        $field = "kode_uker";
		        break;
		    case 7:
		        $field = "ip_lan";
		        break;
		    case 8:
		        $field = "status_name";
		        break;
		    default:
		        $field = "status";
		}

		if ($cari_data!='') {
			$field='';
			$sort='';
		}

		if ($kategori=='') {
			if(empty($cari_data))
			{
				$datauker = $this->m_dashboard->new_uker_all($length,$start,'','','','','',$order,$sort,$field);
				$total = $this->m_dashboard->jumlah_uker_all();
			}else{

				$datauker = $this->m_dashboard->new_uker_all($length,$start,'',$cari_data,'','','',$order,$sort,$field);
				$total = $this->m_dashboard->jumlah_uker_search($cari_data,'','','','');

			}
		}else if($kategori=='kanwil'){
			$kanwil = $this->uri->segment(4);
			if(empty($cari_data))
			{
				$datauker = $this->m_dashboard->new_uker_all($length,$start,$kategori,'',$kanwil,'','',$order,$sort,$field);
				$total = $this->m_dashboard->new_jumlah_uker($kategori,$kanwil,'','');
			}else{

				$datauker = $this->m_dashboard->new_uker_all($length,$start,$kategori,$cari_data,$kanwil,'','',$order,$sort,$field);
				$total = $this->m_dashboard->jumlah_uker_search($cari_data,$kategori,$kanwil,'','');

			}
		}else if($kategori=='kanca'){
			$kanca = $this->uri->segment(4);
			if(empty($cari_data))
			{
				$datauker = $this->m_dashboard->new_uker_all($length,$start,$kategori,'','',$kanca,'',$order,$sort,$field);
				$total = $this->m_dashboard->new_jumlah_uker($kategori,'',$kanca,'');
			}else{

				$datauker = $this->m_dashboard->new_uker_all($length,$start,$kategori,$cari_data,'',$kanca,'',$order,$sort,$field);
				$total = $this->m_dashboard->jumlah_uker_search($cari_data,$kategori,'',$kanca,'');

			}
		}else if($kategori=='tipe_uker'){
			$kanca = $this->uri->segment(4);
			$tipe_uker = $this->uri->segment(5);
			if(empty($cari_data))
			{
				$datauker = $this->m_dashboard->new_uker_all($length,$start,$kategori,'','',$kanca,$tipe_uker,$order,$sort,$field);
				$total = $this->m_dashboard->new_jumlah_uker($kategori,'',$kanca,$tipe_uker);
			}else{

				$datauker = $this->m_dashboard->new_uker_all($length,$start,$kategori,$cari_data,'',$kanca,$tipe_uker,$order,$sort,$field);
				$total = $this->m_dashboard->jumlah_uker_search($cari_data,$kategori,'',$kanca,$tipe_uker);

			}
		}else if($kategori=='nop'){
			if(empty($cari_data))
			{
				$datauker = $this->m_dashboard->new_uker_all($length,$start,$kategori,'','','','',$order,$sort,$field);
				$total = $this->m_dashboard->new_jumlah_uker($kategori,'','','');
			}else{

				$datauker = $this->m_dashboard->new_uker_all($length,$start,$kategori,$cari_data,'','','',$order,$sort,$field);
				$total = $this->m_dashboard->jumlah_uker_search($cari_data,$kategori,'','','');

			}
		}

		//var_dump($datauker);die();
		//var_dump($total);die();

		$array_data =array();

		$no=$start+1;
		foreach ($datauker as $key) {
			
			$data["No"]=$no;
	        $data["Remote Id"]=$key->id_remote;
	        $data["Remote Name"]=$key->nama_remote;
	        $data["Remote Type"]=$key->tipe_uker;
	        $data["Region"]=$key->nama_kanwil;
	        $data["Main Branch"]=$key->nama_kanca;
	        $data["Branch Code"]=$key->kode_uker;
	        $data["IP Address"]=$key->ip_lan;
	        //$data["Remote Status"]=$key->status_onoff;

	        if ($key->status_onoff==3) {
            	$data["Remote Status"]='<span class="label label-success">ONLINE</span>';
            	$waktu = $key->status_rec_date;
            }else if($key->status_onoff==1 && $key->kode_op==2 || ( $key->kode_op==1 && $key->status_onoff==1 && in_array($key->kode_tipe_uker, array(10,6,11,13)) ) ){
            	$data["Remote Status"]='<span class="label label-primary">NOP</span>';
            	$waktu = $key->status_fail_date;
            }else if($key->status_onoff==1 && $key->kode_op==1){
            	$data["Remote Status"]='<span class="label label-danger">OFFLINE</span>';
            	$waktu = $key->status_fail_date;
            }else{
	            $data["Remote Status"]='<span class="label label-primary">UNKNOWN</span>';
	            $waktu = $key->status_fail_date;
            }

            $firstTime = strtotime($waktu);
			$lastTime = strtotime(date('Y-m-d H:i:s'));
			$lama = (($lastTime - $firstTime) / 3600) / 24;
			$date_a = new DateTime($waktu);

			$date_b = new DateTime(date('Y-m-d H:i:s'));

			$interval = date_diff($date_a, $date_b);

			$lamane = $interval->format('%ad %hh %im %ss');

	        $data["Last Change Update"]=$lamane;

            $jarkom = $this->m_dashboard->getjarkom($key->id_remote);

            $data["Network"]='';

            foreach ($jarkom as $jarkoms) {
              if ($jarkoms->brisat==1) {
                if ($jarkoms->status==3) {
                  $data["Network"].='<span class="label label-success">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                }else if ($jarkoms->status==1) {
                  $data["Network"].='<span class="label label-danger">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                }else{
                  $data["Network"].='<span class="label label" style="color:#3d3d29">BRISAT/'.$jarkoms->nickname_provider.'</span><br>';
                }
              }else{
                if ($jarkoms->status==3) {
                  $data["Network"].='<span class="label label-success">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                }else if ($jarkoms->status==1) {
                  $data["Network"].='<span class="label label-danger">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                }else{
                  $data["Network"].='<span class="label label" style="color:#3d3d29">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                }
              }
            }

	        $data["Action"]='<a href="'.base_url().'index.php/Dashboard/detail_uker/'.$key->id_remote.'/'.$key->kode_tipe_uker.'"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a>';

			array_push($array_data,$data);
			$no++;

		}


		//settingan terpenting dari datatable

		$output=array(

			"draw"=>intval($this->input->post("draw")),
			"recordsTotal"=>intval($total),
			"recordsFiltered"=>intval($total),
			"data"=>$array_data
		);

		echo json_encode($output);
	}

	function table_serverside()
	{

		$data['kanca'] = $this->db->select('*')->from('tb_kanca')->order_by('nama_kanca','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
        $data['tipe_uker'] = $this->db->select('*')->from('tb_tipe_uker')->order_by('kode_tipe_uker','asc')->get()->result();

        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List';

		$this->template->views('test',$data);
	}

	function new_list_all()
	{

		$data['kanca'] = $this->db->select('*')->from('tb_kanca')->order_by('nama_kanca','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
        $data['tipe_uker'] = $this->db->select('*')->from('tb_tipe_uker')->order_by('kode_tipe_uker','asc')->get()->result();

        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List';

		$this->template->views('List/new_list_all',$data);
	}

	function new_list_kanwil()
	{
		$kanwil = $this->uri->segment(3);
		$data['nama'] = $this->db->get_where('tb_kanwil', array('kode_kanwil'=>$kanwil))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List - Region '.$data['nama'][0]->nama_kanwil;

		$this->template->views('List/new_list_kanwil',$data);
	}

	function new_list_kanca()
	{
		$kanca = $this->uri->segment(3); 

		$data['kanwil'] = $this->db->select('b.nama_kanwil,b.kode_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$data['nama'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List - Region '.$data['kanwil'][0]->nama_kanwil.' - '.$data['nama'][0]->nama_kanca;
		$this->template->views('List/new_list_kanca',$data);
	}

	function new_list_remote()
	{
		$kanca = $this->uri->segment(3);
		$kode_tipe_uker = $this->uri->segment(4);

		$data['kanwil'] = $this->db->select('b.kode_kanwil,b.nama_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$data['nama_uker'] = $this->db->get_where('tb_tipe_uker', array('kode_tipe_uker'=>$kode_tipe_uker))->result();
		$data['kanca'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
        $data['page'] = 'kanwil';
        $data['title'] = 'Remote List';
		$this->template->views('List/new_list_remote',$data);
	}

	function new_list_nop()
	{

		$data['kanca'] = $this->db->select('*')->from('tb_kanca')->order_by('nama_kanca','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
        $data['tipe_uker'] = $this->db->select('*')->from('tb_tipe_uker')->order_by('kode_tipe_uker','asc')->get()->result();

        $data['page'] = 'nop';
        $data['title'] = 'Remote List';

		$this->template->views('List/new_list_nop',$data);
	}

	function provider_table()
	{

		$columns = array("No","Network ID","Remote Name","Remote Type","Region","Main Branch","Branch Code","IP WAN","Network Status","Last Change Update","Bandwidth","Action"); // data array columns harus sama dengan data header table yang tadi di buat di view

		$start=$this->input->post("start");//0
		$length=$this->input->post("length");//10
		$order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
		$sort = $this->input->post("order[0][dir]"); // asc
		$cari_data = $this->input->post("search[value]");

		$kode_provider = $this->uri->segment(3);
		$kode_jenis_jarkom = $this->uri->segment(4);
		$brisat = $this->uri->segment(5);
		$name = $this->uri->segment(6);

		$field = '';

		switch ($order) {
		    case 1:
		        $field = "kode_jarkom";
		        break;
		    case 2:
		        $field = "nama_remote";
		        break;
		    case 3:
		        $field = "tipe_uker";
		        break;
		    case 4:
		        $field = "nama_kanwil";
		        break;
		    case 5:
		        $field = "nama_kanca";
		        break;
		    case 6:
		        $field = "kode_uker";
		        break;
		    case 7:
		        $field = "ip_wan";
		        break;
		    case 8:
		        $field = "status_name";
		        break;
		    case 10:
		        $field = "bandwidth";
		        break;
		    default:
		        $field = "status";
		}
		
		if ($this->uri->segment(3)=='all') {
			if(empty($cari_data))
			{
				$datauker = $this->m_dashboard->uker_prov('','','',$length,$start,'',$order,$sort,$field);
				$total = $this->m_dashboard->uker_prov_total('', '', '', '');
			}else{

				$datauker = $this->m_dashboard->uker_prov('','','',$length,$start,$cari_data,$order,$sort,$field);
				$total = $this->m_dashboard->uker_prov_total('', '', '',$cari_data);

			}
		}else{
			if(empty($cari_data))
			{
				$datauker = $this->m_dashboard->uker_prov($kode_provider,$brisat,$kode_jenis_jarkom,$length,$start,'',$order,$sort,$field);
				$total = $this->m_dashboard->uker_prov_total($kode_provider, $brisat, $kode_jenis_jarkom, '');
			}else{

				$datauker = $this->m_dashboard->uker_prov($kode_provider,$brisat,$kode_jenis_jarkom,$length,$start,$cari_data,$order,$sort,$field);
				$total = $this->m_dashboard->uker_prov_total($kode_provider, $brisat, $kode_jenis_jarkom,$cari_data);

			}
		}
		

		//var_dump($datauker);die();
		//var_dump($total);die();

		$array_data =array();

		$no=$start+1;
		foreach ($datauker as $key) {
			
			$data["No"]=$no;
	        $data["Network ID"]=$key->kode_jarkom;
	        $data["Remote Name"]=$key->nama_remote;
	        $data["Remote Type"]=$key->tipe_uker;
	        $data["Region"]=$key->nama_kanwil;
	        $data["Main Branch"]=$key->nama_kanca;
	        $data["Branch Code"]=$key->kode_uker;
	        $data["IP WAN"]=$key->ip_wan;
	        //$data["Remote Status"]=$key->status_onoff;

	        if ($key->status==3) {
            	$data["Network Status"]='<span class="label label-success">ONLINE</span>';
            	$waktu = $key->status_rec_date;
            }else if($key->status==1 && $key->kode_op==2 || ( $key->kode_op==1 && $key->status==1 && in_array($key->kode_tipe_uker, array(10,6,11,13)) ) ){
            	$data["Network Status"]='<span class="label label-primary">NOP</span>';
            	$waktu = $key->status_fail_date;
            }else if($key->status==1 && $key->kode_op==1){
            	$data["Network Status"]='<span class="label label-danger">OFFLINE</span>';
            	$waktu = $key->status_fail_date;
            }else{
	            $data["Network Status"]='<span class="label label-primary">UNKNOWN</span>';
	            $waktu = $key->status_fail_date;
            }

            $firstTime = strtotime($waktu);
			$lastTime = strtotime(date('Y-m-d H:i:s'));
			$lama = (($lastTime - $firstTime) / 3600) / 24;
			$date_a = new DateTime($waktu);

			$date_b = new DateTime(date('Y-m-d H:i:s'));

			$interval = date_diff($date_a, $date_b);

			$lamane = $interval->format('%ad %hh %im %ss');

	        $data["Last Change Update"]=$lamane;

            $data["Bandwidth"]=$key->bandwidth.' Kbps';

            $kode = "'".$key->kode_jarkom."'";

	        $data["Action"]='<a href="'.base_url().'index.php/Dashboard/detail_uker/'.$key->id_remote.'/'.$key->kode_tipe_uker.'"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a>';

			array_push($array_data,$data);
			$no++;

		}


		//settingan terpenting dari datatable

		$output=array(

			"draw"=>intval($this->input->post("draw")),
			"recordsTotal"=>intval($total),
			"recordsFiltered"=>intval($total),
			"data"=>$array_data
		);

		echo json_encode($output);
	}

	function new_list_provider()
	{

		$kode_provider = $this->uri->segment(3);
		$kode_jenis_jarkom = $this->uri->segment(4);
		$brisat = $this->uri->segment(5);
		$name = $this->uri->segment(6);

        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
		$data['page'] = 'prov';
		$data['title'] = 'Network List';
		$this->template->views('List/new_list_provider',$data);
	}

	function new_list_allprov()
	{
        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
		$data['page'] = 'jarkom';
		$data['title'] = 'Network List';
		$this->template->views('List/new_list_allprov',$data);
	}

	function Getdata_jarkom(){
		$kode_jarkom = $_POST['kodejarkom'];
		$data = $this->m_dashboard->getjarkombyid($kode_jarkom);
		echo json_encode($data[0]);
	}
	
	/*
		edit data jarkom yang disable
	*/
	function Edit_jarkom_disable()
	{
		$data['data'] = $this->db->select('*')->from('v_all_remote_jarkom')->where('kode_jarkom',$this->uri->segment(3))->get()->result();
        $data['page'] = 'unused';
        $data['title'] = 'Network List Un Used';
		$this->template->views('disable/edit_disable_jarkom',$data);
	}

	function SaveChangeRemote()
	{
		$return = $this->db->set('id_remote',$_POST['id_remote'])
		                   ->set('used_status',$_POST['used_status'])
		                   ->where('kode_jarkom',$_POST['kode_jarkom'])
		                   ->update('tb_jarkom');
		if ($return) {
            $return = true;

            $jarkom = array(
	        	'kode_jarkom'			=> $_POST['kode_jarkom'],
	        	'kode_jenis_jarkom'     => $_POST['kode_jenis_jarkom'],
	        	'kode_provider' 		=> $_POST['kode_provider'],
	        	'bandwidth'   			=> $_POST['bandwidth'],
	        	'ip_wan'   	 		 	=> $_POST['ip_wan'],
				'brisat'   				=> $_POST['brisat'],
				'used_status'   		=> $_POST['used_status'],
				'id_remote'   			=> $_POST['id_remote'],
				'id_spk'				=> $_POST['id_spk'],
				'user_update'			=> $this->session->userdata('username'),
				'update_at'				=> date('Y-m-d H:i:s')
	        );

	        $this->db->insert('tb_jarkom_history',$jarkom);

        }else{
            $return = false;
        }

        echo $return;
	}
	
	//begin get port di librenms
	function get_ports(){
		    // persiapkan curl
			$ip_lan = $this->uri->segment(3);
			$ch = curl_init(); 
			//echo ($ip_lan);
			// set url 
			curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/".$ip_lan."/ports?columns=ifDescr%2CifName%2CifAlias%2Cport_id%2CifSpeed");
			//curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/53.45.12.1/graphs");
			//curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/ports?columns=ifDescr%2Cport_id");

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  'X-Auth-Token: fc7665d615d9c36ae9f9bc0d34607971',
			  'Content-Type: application/json',
		   ));

			// return the transfer as a string 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

			// $output contains the output string 
			$output = curl_exec($ch); 

			// tutup curl 
			curl_close($ch);      

			// menampilkan hasil curl
			echo $output;
	}
	//end get interface di librenms
	
	//begin get graphs dari librenms
		function get_graphs(){
		    // persiapkan curl
			$ch = curl_init(); 
			$ip = $this->uri->segment(3);
			$iface = $this->uri->segment(4);
			// set url 
			//curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/53.45.12.1/2");
			//curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/7.131.17.1/ports/Gi8/port_bits");
			curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/".$ip."/ports/".$iface."/port_bits");
			
			//localhost
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  'X-Auth-Token: fc7665d615d9c36ae9f9bc0d34607971',
			  'Content-Type: application/jpeg',
		   ));

			// return the transfer as a string 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

			// $output contains the output string 
			$output = curl_exec($ch); 

			// tutup curl 
			curl_close($ch);      

			// menampilkan hasil curl
			header('content-type: image/jpeg');
			//echo $output;
			
			$base64 = base64_encode($output);
			echo '<img src="data:image/jpeg;base64,'.$base64.'" width="100%" />';
	}
	//end get graphs dari librenms

	function Edit_ipmonitoring()
	{
		//$ip_old = $_POST['ip_monitoring_old'];
		
		/*$return = $this->db->set('ip_monitoring',$_POST['ip_monitoring'])->where('id_remote',$_POST['id_remote'])->update('tb_remote');
*/
        //if ($return) {
        	$new = $_POST['ip_monitoring'];
			$old = $_POST['ip_monitoring_old'];
			$url = "http://172.18.65.159/api/v0/devices/$old/rename/$new";
			$username = 'damar';
			$password = 'cf684b7a913ce8d7187a3afddc4c5db3';
						
			// persiapkan curl
			$ch = curl_init(); 

			// set url 
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'X-Auth-Token: cf684b7a913ce8d7187a3afddc4c5db3',
				'Content-Type: application/json',
			));

			// return the transfer as a string 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');

			// $output contains the output string 
			$output = curl_exec($ch); 

			// tutup curl 
			curl_close($ch);
						
			$convert = json_decode($output);
			//var_dump($convert);
			$array_object = (array) $convert;
			if($array_object['status']=='ok'){
				$return = $this->db->set('ip_monitoring',$_POST['ip_monitoring'])->where('id_remote',$_POST['id_remote'])->update('tb_remote');

				/*$this->db->where('id_remote',$_POST['id_remote']);
				$this->db->update('tb_remote',$dataremote);*/
		//	}else{
				//echo "<script>alert('Update Data Remote Error');</script>";
				//redirect('Dashboard/detail_uker/'.$_POST['id_remote'].'/'.$_POST['kode_tipe_uker']);
		//	}
        	$return = true;
        }else{
            $return = false;
        }
           

        echo $return;
	}
	
}

