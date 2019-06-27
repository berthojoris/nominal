<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_pscf extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_dashboard','m_dashboard_rekap'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    /*public function index()
	{
		if ($this->session->userdata('role')==10) {
            redirect('Dashboard/Dash_Prov');
        }else{
			redirect('Dashboard/All_Kanwil');
		}
	}*/

    public function rekap_kanwil()
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

		$this->template->views('kanwil',$data);
		
	}
    
	public function index(){
        $data["title"]="BRI PSCF Core Weathermap";
		$data['page'] = 'dashboard';
		
		$this->template->views('dashboard/index_view_weathermap_pscf',$data);
        //$this->load->view("dashboard/index_view",$data);
    }
	
	
	//halaman yang akan diload pertama kali
	public function content_weathermap_pscf() {
		//begin block
		//redirect('http://172.18.65.24/under_construction', 'refresh');
		//block block
		 $data["title"]="BRI PSCF Core";
		 $data['page'] = 'dashboard';
		 $datene =  date('Y-m-d H:00:00');

         //$data['time'] = $this->m_dashboard_rekap->query("pdate","tb_dashboard_pro","1 limit 1;");


		 //$data['header'] = $this->m_dashboard_rekap->query("*","tb_notification","1 and hook = 'header';");
		  
        //$data['all_data'] = $this->m_dashboard_rekap->query("*","tb_dashboard_pro","1 and --pdate='$datene'-- ORDER BY no");
		//var_dump($data['all_data']);
		$this->load->view("dashboard/content_weathermap_core_pscf.php",$data);
		//$this->load->view("dashboard/content");
    }

    public function monitoring_scheduler(){
        $data_all = $this->m_dashboard_rekap->query("pdate,count(`no`) as jumlah","tb_dashboard_pro_history","1 GROUP BY pdate;");
        $i=1;
        echo "<table border=1><tr><th>No.</th><th>Date Time</th><th>Total Data</th></tr>";
        foreach($data_all as $row) {
            if ($row->jumlah==20){$keterangan="Sukses";}else{$keterangan="Gagal";}
            echo " <tr><td>".$i."</td><td>".$row->pdate."</td><td>".$row->jumlah."</td><td>".$keterangan."</td></tr>";
            $i++;
        }
        echo "</table>";            
    }
	
	/*
	 public function load_content() {
        $data['header'] = $this->m_dashboard_rekap->query("*","tb_notification","1 and hook = 'header';");
        $data['title'] = 'AVAILABILITY JARKOM BRI';
		$datene =  date('Y-m-d H:00:00');
		echo $datene."damar";
        $data['all_data'] = $this->m_dashboard_rekap->query("*","tb_dashboard_pro","1 and pdate='$datene' ORDER BY no");
        //var_dump($data['all_data']);
        $this->load->view("dashboard/realtime_region",$data);
    }*/
    
}

