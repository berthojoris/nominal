<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_dashboard','m_home','m_report'));
		
		$this->load->helper('form');
        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function request_report()
	{
		$data['page'] = 'request-report';
        $data['title'] = 'Request Report';
			
		
		$this->template->views('Report/request_report',$data);
	}

	public function offline_report()
	{
		$data['page'] = 'offline-report';
        $data['title'] = 'Offline Report';

        $query_remote_type = "SELECT * FROM tb_tipe_uker;";

        $query_alarm_type = "SELECT * FROM tb_alarm_type;";

		$data['remote_type'] = $this->db->query($query_remote_type)->result();

		$data['alarm_type'] = $this->db->query($query_alarm_type)->result();
			
		
		$this->template->views('Report/offline_report',$data);
	}

	public function offline_report_result($excel=false)
	{
		$data['page'] = 'offline-report';
        $data['judul'] = 'Offline Report';
        $data['title'] = 'Offline Report';

        if(isset($_POST['time_range'])){
        	$time_range = $_POST['time_range'];
        	$time = explode(" - ", $time_range);
        	//echo $_POST['KC'];

        	$data['start'] = $start = $time[0];
        	$data['end'] = $end = $time[1];
        	$where_in_remote_type = $where_in_remote_alarm = "";

        	$query_remote_type = "SELECT * FROM tb_tipe_uker;";
			$remote_type = $this->db->query($query_remote_type)->result();

			$query_alarm_type = "SELECT * FROM tb_alarm_type;";
			$alarm_type = $this->db->query($query_alarm_type)->result();

			foreach ($remote_type as $value) {
                   if (isset($_POST["$value->singkatan"])) {
		        		$where_in_remote_type .= "'".$_POST["$value->singkatan"]."',";
		        	}
		    }
		    $alarm_type_ = "alarm_type_";
		    foreach ($alarm_type as $value) {
                   if (isset($_POST["$alarm_type_"."$value->id"])) {
		        		$where_in_remote_alarm .= "'".$_POST["$alarm_type_"."$value->id"]."',";
		        	}
		    }

        
        	$where_remote_type = rtrim($where_in_remote_type, ',');
        	$where_remote_alarm = rtrim($where_in_remote_alarm, ',');
        	//echo $where_in;

        	//$start_0 = substr($start,0,10);

        	//ada kondisi yg belum terpenuhi, yaitu bagaimana kalau offline sebelum waktu start dan up setelah waktu end
        	$query = "SELECT
					*,sum(TIMESTAMPDIFF(SECOND, (
						CASE
				        WHEN (offline_at<'$start' AND stop_at<'$end')  THEN '$start'
						ELSE offline_at
						END
				        ), (CASE
				        WHEN ((offline_at>='$start' AND stop_at>='$end') OR stop_at IS NULL)  THEN '$end'
						ELSE stop_at
						END)
						)
				    ) as downtime, count(id_remote) as total
				FROM
					tb_alarm,tb_tipe_uker
				WHERE
					tb_alarm.remote_type=tb_tipe_uker.tipe_uker
				    AND
					(
						(offline_at >= '$start' AND offline_at < '$end')
						OR 
				        ( offline_at<'$start' AND stop_at >= '$start')
					)
				AND kode_provider IS NULL
				AND (remote_type IN ($where_remote_type))
				AND (id_alarm_type IN ($where_remote_alarm))
				group by id_remote;";

			$data['data'] = $this->db->query($query)->result();
        	
		}
		//echo $query;
		//var_dump($data['data']);
			
		
		if ($excel) {
			$this->template->views('Report/excel_offline_report',$data);
		}else{
			$this->template->views('Report/list_remote_offline',$data);
		}
	}


	
	public function add_request_report()
	{
		if(isset($_POST['search'])){			
			$search = $_POST['search'];
			$data['search'] = $search;
			$data['found']= $this->m_home->search($search);
			$data['found_count']= $this->m_home->search_count($search);
		}
		
		$this->template->views('Report/request_report',$data);
	}
	
	public function custom()
	{
		$data['page'] = 'custom';
		$data['title'] = 'Costom Monitoring';
		$this->template->views('Report/custom',$data);
	}
	
	
	public function getCustomData()
	//public function incidental()
	{
		$where = "";
		if(isset($_POST['kw']))
		{
			if($_POST['kw'] != null && $_POST['kw'] != "null")
			{
				$kw = explode(",",$_POST['kw']);
				$in = "'".$kw[0]."'";
				for($i = 1 ; $i < count($kw) ; $i++)
				{
					$in .= ",'".$kw[$i]."'";
				}
				$where .= " AND d.kode_kanwil IN(".$in.")";  
			}
		}
        if(isset($_POST['kc']))
		{
			if($_POST['kc'] != null && $_POST['kc'] != "null")
			{
				$kc = explode(",",$_POST['kc']);
				$in = "'".$kc[0]."'";
				for($i = 1 ; $i < count($kc) ; $i++)
				{
					$in .= ",'".$kc[$i]."'";
				}
				$where .= " AND d.kode_kanca IN(".$in.")";  
			}
		}
		//$this->load->library('pagination');

        //$config['per_page'] = $_POST['length'];
        $perpage = $_POST['length'];
		$start   = $_POST['start'];

		$total = $this->m_report->jumlah_uker_all($where);

		$data['total'] = $total;
		/*
        $config['total_rows'] = $total;
        $config['base_url'] = base_url().'index.php/Report/custom';
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
		*/
        //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$this->pagination->initialize($config);

		$data['data'] = $this->m_report->data_uker_all($perpage,$start,$where);

		for ($i=0; $i < count($data['data']) ; $i++) { 
			$remote = $data['data'][$i];
			$data['jarkom'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);
			if($remote->kode_tipe_uker==7){
				$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->get_tid($remote->id_remote);
			}
		}
		//var_dump($data['data']);
        $data['page']  = 'custom';
        $data['title'] = 'Custom Report';
		//$this->template->views('Report/incidental',$data);
		//$this->template->views('Report/custom',$data);
		echo json_encode($data);
	}
}

