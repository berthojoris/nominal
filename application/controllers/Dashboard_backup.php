<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_dashboard'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		//$data['page'] = 'home';
		//$this->template->views('home',$data);
		redirect('Dashboard/All_Kanwil');
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
			$this->template->views('kanwil',$data);
        // }else{
        // 	$this->load->view('kanwil',$data);
        // }
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
		$data['center_loc'] = $this->m_dashboard->getKancaLocations($kanwil);
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
		$this->template->views('kanca',$data);
	}

	public function refreshKanca()
	{
		$kanwil = $this->uri->segment(3);
		$data['kanwil'] = $kanwil;
		$getnama = $this->db->select('nama_kanwil')->from('tb_kanwil')->where('kode_kanwil',$kanwil)->get()->result();
		$data['nama_kanwil'] = $getnama[0]->nama_kanwil;
		$data['center_loc'] = $this->m_dashboard->getKancaLocations($kanwil);
		$data['kanca'] = $this->db->select('*')
						->from('tb_kanca')
						->where('kode_kanwil',$kanwil)
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
		$data['kanwil'] = $this->db->select('b.kode_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$getnama = $this->db->select('nama_kanca')->from('tb_kanca')->where('kode_kanca',$kanca)->get()->result();
		$data['nama_kanca'] = $getnama[0]->nama_kanca;
		$data['tipe_uker'] = $this->db->query("SELECT * 
							FROM tb_tipe_uker
							WHERE kode_tipe_uker NOT IN('0', '1', '8', '9') 
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
		$this->template->views('remote',$data);
	}

	public function refreshRemote()
	{
		$kanca = $this->uri->segment(3);
		$data['kanca'] = $kanca;
		$getnama = $this->db->select('nama_kanca')->from('tb_kanca')->where('kode_kanca',$kanca)->get()->result();
		$data['nama_kanca'] = $getnama[0]->nama_kanca;
		$data['tipe_uker'] = $this->db->query("SELECT * 
							FROM tb_tipe_uker
							WHERE kode_tipe_uker NOT IN('0', '1', '8', '9') 
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
		$data["data"] = $this->m_dashboard->getKanwilLocations();;
        echo json_encode($data);
	}

	function getKancaLocations($kanwil)
	{
		$data["data"] = $this->m_dashboard->getKancaLocations($kanwil);
        echo json_encode($data);
	}

	function getUkerLocations($kanca)
	{
		$data["data"] = $this->m_dashboard->getUkerLocations($kanca);
        echo json_encode($data);
	}

	function data_uker()
	{
		$kanca = $this->uri->segment(3);
		$kode_tipe_uker = $this->uri->segment(4);

		$data['kanwil'] = $this->db->select('b.kode_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$data['data'] = $this->m_dashboard->data_uker($kanca,$kode_tipe_uker);
        $data['kanca'] = $this->m_dashboard->data_kanca($kanca);

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
		}

		$data['nama_uker'] = $this->db->get_where('tb_tipe_uker', array('kode_tipe_uker'=>$kode_tipe_uker))->result();
        $data['page'] = 'kanwil';
		$this->template->views('uker',$data);
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
		}

		$data['nama'] = $this->db->get_where('tb_kanwil', array('kode_kanwil'=>$kanwil))->result();
        $data['page'] = 'kanwil';
		$this->template->views('uker_kanwil',$data);
	}

	function data_uker_kanca()
	{
		$kanca = $this->uri->segment(3); 

		$data['kanwil'] = $this->db->select('b.kode_kanwil')
							->from('tb_kanca a')
							->join('tb_kanwil b','b.kode_kanwil=a.kode_kanwil','left')
							->where('a.kode_kanca',$kanca)->get()->result();

		$data['data'] =  $this->m_dashboard->data_uker_kanca($kanca);

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
		}

		$data['nama'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
        $data['page'] = 'kanwil';
		$this->template->views('uker_kanca',$data);
	}

	function detail_uker(){
		$id_remote = $this->uri->segment(3);
		$kode_tipe_uker = $this->uri->segment(4);
		$data['data'] =  $this->db->select('a.*,b.status as status_onoff,d.tipe_uker,c.latitude as lat,c.longitude as long,d.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,a.kode_op,e.keterangan as op,f.pic_pinca,f.pic_spo,f.pet_it,a.kode_kanca,f.nama_kanca')
						->from('tb_remote a')
						->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
						->join('host_location c','c.ip_address = a.ip_lan','left')
						->join('tb_tipe_uker d', 'd.kode_tipe_uker = a.kode_tipe_uker','left')
						->join('tb_op e','e.kode_op = a.kode_op','left')
						->join('tb_kanca f','f.kode_kanca = a.kode_kanca','left')
						->where('a.kode_tipe_uker',$kode_tipe_uker)
						->where('a.id_remote',$id_remote)
						->get()->result(); 
		//for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][0];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
		//}
		$query = "SELECT kode_kanwil,nama_kanwil 
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
		$data['page'] = 'kanwil';
		$this->template->views('detail_uker',$data);
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
							LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$id')")->result();

			$provider = $this->db->query("SELECT
									DISTINCT a.kode_provider
							FROM tb_jarkom a
							LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
							LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$id')")->result();


			for ($i=0; $i < count($jenis_jarkom); $i++) { 
				$jj = $jenis_jarkom[$i]->kode_jenis_jarkom;
				for ($j=0; $j < count($provider); $j++) { 
					$p = $provider[$j]->kode_provider;
					$data['data_nb'][$i][$j] = $this
										->m_dashboard
										->getOnOffProviderKanwil_NB($id,$jj,$p);
				}
			}	

			for ($i=0; $i < count($jenis_jarkom); $i++) { 
				$jj = $jenis_jarkom[$i]->kode_jenis_jarkom;
				for ($j=0; $j < count($provider); $j++) { 
					$p = $provider[$j]->kode_provider;
					$data['data_b'][$i][$j] = $this
										->m_dashboard
										->getOnOffProviderKanwil_B($id,$jj,$p);
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
							LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE b.kode_kanca = $id")->result();

			$provider = $this->db->query("SELECT
									DISTINCT a.kode_provider
							FROM tb_jarkom a
							LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
							LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
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
		
			$data['kanwil'] = $this->db->select('b.kode_kanwil')
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
			$this->template->views('provider',$data);
	}

	function edit_remote()
	{
		if(isset($_POST['submit'])) {
			//echo "<script>alert('test')</script>";
			$datakanca  = array(
				'pic_pinca' => $_POST['pic_pinca'],
				'pic_spo'   => $_POST['pic_spo'],
				'pet_it'    => $_POST['pet_it']
			);

			$this->db->where('kode_kanca',$_POST['kode_kanca']);
	        $this->db->update('tb_kanca',$datakanca);

	        $dataremote = array(
	        	'nama_pic'    => $_POST['pic_uker'],
	        	'kode_op'     => $_POST['kode_op'],
	        	'alamat_uker' => $_POST['alamat'],
	        	'telp_uker'   => $_POST['telp'],
	        	'ip_lan'   	  => $_POST['ip_lan'],
	        	'kode_uker'   => $_POST['kode_uker'],
	        	'uker_induk'  => $_POST['kode_kanca'],
	        	'keterangan'  => $_POST['keterangan'],
	        	'start_nop'   => $_POST['start_nop'],
	        	'end_nop'  	  => $_POST['end_nop'],
	        	'kode_kanca'  => $_POST['kode_kanca']
	        );

	        

	        $this->db->where('id_remote',$_POST['id_remote']);
	        $this->db->update('tb_remote',$dataremote);

	        redirect('Dashboard/detail_uker/'.$_POST['id_remote'].'/'.$_POST['kode_tipe_uker']);

		}
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
			}

			$data['nama'] = $this->db->get_where('tb_kanwil', array('kode_kanwil'=>$kanwil))->result();
	        $data['page'] = 'kanwil';

	        $this->load->view('uker_excel',$data);

		}else if($kategori == "kanca"){
			$kanca = $this->uri->segment(4); 
			$data['data'] =  $this->m_dashboard->data_uker_kanca($kanca);

			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			}

			$data['nama'] = $this->db->get_where('tb_kanca', array('kode_kanca'=>$kanca))->result();
	        $data['page'] = 'kanwil';

	        //var_dump($data['data']);
	        $this->load->view('uker_excel',$data);
		}else if($kategori == "uker"){
			$kanca = $this->uri->segment(4);
			$kode_tipe_uker = $this->uri->segment(5);

			$data['data'] = $this->m_dashboard->data_uker($kanca,$kode_tipe_uker);

			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			}

			$data['nama_uker'] = $this->db->get_where('tb_tipe_uker', array('kode_tipe_uker'=>$kode_tipe_uker))->result();
	        $data['page'] = 'kanwil';

	        $this->load->view('uker_excel',$data);
		}else if($kategori == "disable"){

			$data['data'] = $this->m_dashboard->data_uker_disable();

			for ($i=0; $i < count($data['data']) ; $i++) { 
				$remote = $data['data'][$i];
				$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			}

	        $data['page'] = 'disable';

	        $this->load->view('uker_excel',$data);
		}
	}

	function Disable()
	{
		$data['data'] = $this->m_dashboard->data_uker_disable();

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
		}

        $data['page'] = 'disable';
		$this->template->views('uker_disable',$data);
	}

	function Dash_Prov()
	{

		$data['jenis_jarkom'] = $this->db->get('tb_jenis_jarkom')->result();
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
										WHERE
											a.brisat = 1
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
											WHERE
												a.brisat = 0
											AND a.kode_jenis_jarkom = '$jj->kode_jenis_jarkom'")->result();
			$data['prov'][$jj->kode_jenis_jarkom] = $prov;
			for ($j=0; $j < count($prov); $j++) { 
				$p = $prov[$j]->kode_provider;
				$b = $prov[$j]->brisat;
				$jarkom = $prov[$j]->kode_jenis_jarkom;
				$nick = $prov[$j]->nickname_provider;
				$data['data_prov'][$jj->kode_jenis_jarkom][$j] = $this
									->m_dashboard
									->getOnOffProvider($p,$b,$nick,$jarkom);
				//if (count($data['data_prov'][$jj->kode_jenis_jarkom][$j])==null) {
					// $j--;
					// echo $data['data_prov'][$jj->kode_jenis_jarkom][$j]['on']."-".$data['data_prov'][$jj->kode_jenis_jarkom][$j]['off']."-".$data['data_prov'][$jj->kode_jenis_jarkom][$j]['nop']."<br>";
				//}
			}
		}
			//var_dump($data['jenis_jarkom']);
			//echo count($data['prov']).'='.count($data['data_prov']);
		  $data['page'] = 'prov';
		  $this->template->views('dash_prov',$data);

	}

	function refreshProv()
	{
		$prov = $this->db->query("SELECT
										a.kode_provider,
										CONCAT(
											'BRISAT',
											'-',
											b.nickname_provider
										) as nickname_provider,
										a.brisat
									FROM
										tb_jarkom a
									LEFT JOIN tb_provider b ON b.kode_provider = a.kode_provider
									WHERE
										a.brisat = 1
									UNION
										SELECT
											a.kode_provider,
											b.nickname_provider,
											a.brisat
										FROM
											tb_jarkom a
										LEFT JOIN tb_provider b ON b.kode_provider = a.kode_provider
										WHERE
											a.brisat = 0
										GROUP BY
											a.kode_provider")->result();
		$data['prov'] = $prov;
		for ($j=0; $j < count($prov); $j++) { 
			$p = $prov[$j]->kode_provider;
			$b = $prov[$j]->brisat;
			$nick = $prov[$j]->nickname_provider;
			$data['data_prov'][$j] = $this
								->m_dashboard
								->getOnOffProvider($p,$b,$nick);
		}

			//var_dump($data['prov']);
			//echo count($data['prov']).'='.count($data['data_prov']);
			echo json_encode($data);

	}

	function edit_jarkom()
	{
		if(isset($_POST['kode_jarkom'])) {

	        $datajarkom = array(
	        	'kode_jenis_jarkom'     => $_POST['kode_jenis_jarkom'],
	        	'kode_provider' 		=> $_POST['kode_provider'],
	        	'bandwidth'   			=> $_POST['bandwidth'],
	        	'ip_wan'   	 		 	=> $_POST['ip_wan'],
	        	'brisat'   				=> $_POST['brisat']
	        );

	        

	        $this->db->where('kode_jarkom',$_POST['kode_jarkom']);
	        $this->db->update('tb_jarkom',$datajarkom);

	        echo "true";

		}
	}

	function uker_prov()
	{
		$kode_provider = $this->uri->segment(3);
		$kode_jenis_jarkom = $this->uri->segment(4);
		$brisat = $this->uri->segment(5);
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
											ORDER BY c.status ASC")->result();

		//var_dump($data['remote']);
		
        $data['provider'] = $this->db->select('*')->from('tb_provider')->order_by('kode_provider','asc')->get()->result();
        $data['jenis_jarkom'] = $this->db->select('*')->from('tb_jenis_jarkom')->order_by('kode_jenis_jarkom','asc')->get()->result();
		$data['page'] = 'prov';
		$this->template->views('uker_prov',$data);
	}

}

