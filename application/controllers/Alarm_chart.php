<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alarm_chart extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_watch','m_dashboard'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		//$data['page'] = 'home';
		//$this->template->views('home',$data);
		//redirect('Dashboard/All_Kanwil');
		if ($this->session->userdata('role')==10) {
            redirect('Dashboard/Dash_Prov');
        }else{
			redirect('Dashboard/All_Kanwil');
		}
	}

	function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

	function main_branch()
	{

		$data['page'] = 'main-branch-watch';
		$data['title'] = 'Main And Sub Branch Watch';
		
		$data['watch_1'] = 'KC';
		$data['watch_2'] = 'KCP';
		$main_branches = $this->m_watch->get_main_branch('2');
		$data['main_branch']= $main_branches;
		for ($i=0; $i < count($main_branches) ; $i++) { 
			$remote = $main_branches[$i];
			$data['jarkom_main_branch'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		$submain_branches = $this->m_watch->get_main_branch('3');
		$data['submain_branch']= $submain_branches;
		for ($i=0; $i < count($submain_branches) ; $i++) { 
			$remote = $submain_branches[$i];
			$data['jarkom_submain_branch'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		
		$this->template->views('reporting/main_branch_watch',$data);
	}
	
	function priority_atm()
	{
		$data['page']  = 'atm-priority';
		$data['title'] = 'Priority ATM Watch';
		
		$priority_atm = $this->m_watch->get_priority_atm('7');
		$data['priority_atm']= $priority_atm;
		for ($i=0; $i < count($priority_atm) ; $i++) { 
			$remote = $priority_atm[$i];
			$data['jarkom_priority_atm'][$remote->id_remote] = $this->m_dashboard->getjarkom($remote->id_remote);			
		}
		
		for ($i=0; $i < count($priority_atm) ; $i++) { 
			$remote = $priority_atm[$i];
			$data['tid_atm'][$remote->id_remote] = $this->m_dashboard->getTid($remote->id_remote);			
		}
		
		$this->template->views('reporting/priority_atm',$data);
	}
	
	
	function alarm()
	{

		$data['page'] = 'sub-watch';
		$data['title'] = 'Sub and Small Branch Watch';

				
		$data['list_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('kode_op_asli','2')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());	
		
		
		$this->template->views('chart/alarm_chart',$data);
	}
	

	
	function maps_dasboard(){
		
		
		$data['page'] = 'maps-dashboard';
		$data['title'] = 'Maps & Offline Dashboard';
	
	
	
		$now = date('Y-m-d H:i:s');
		$now_int = strtotime($now);		

		$data['total_remote_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					
					->where('kode_op_asli',1)
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());
		
		$data['total_remote_nop'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('kode_op_asli','2')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());	
		
		$data['total_kc_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KC')
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());
					
		$data['total_kcp_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KCP')
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());	

		$data['total_kk_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','KK')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-900)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());			

		$data['total_unit_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('kode_op_asli',1)
					->where('tipe_uker','UNIT')
					//->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-900)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());
					
		$data['total_atm_offline'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('tipe_uker','ATM')
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());		
					
					
	
		
		$data['total_remote_offline_less_1_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->get()->result());
		
		$data['total_remote_offline_1_4_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					->get()->result());					
		
		$data['total_remote_offline_4_12_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					->get()->result());					
		
		$data['total_remote_offline_12_24_hour'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					->get()->result());	
					
		$data['total_remote_offline_1_5_day'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());	

		$data['total_remote_offline_more_5_day'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->get()->result());
		

		

		$data['total_remote_offline_less_1_hour_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_offline_less_1_hour_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());

		$data['total_remote_offline_1_4_hour_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_offline_1_4_hour_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());

		$data['total_remote_offline_4_12_hour_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	
		$data['total_remote_offline_4_12_hour_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	

		$data['total_remote_offline_12_24_hour_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	
		$data['total_remote_offline_12_24_hour_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	

		$data['total_remote_offline_1_5_day_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	
		$data['total_remote_offline_1_5_day_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
					->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());	

		$data['total_remote_offline_more_5_day_unack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_offline_more_5_day_ack'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_name','OFFLINE')
					->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
					//tambahan begin
					->where('status_alarm>','0')
					//tambahan end
					->where('id_alarm_type IS NOT NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());


		
		 $data['total_remote_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm>','0')
					->where('status_name','OFFLINE')
					->where('status_name<>','NOP')
					->get()->result());
		$data['total_remote_unack_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					//->where('status_alarm<','3')
					->where('id_alarm_type is NULL', NULL, FALSE)
					->where('status_alarm>','0')
					->where('status_name','OFFLINE')
					->where('status_name<>','NOP')
					->get()->result());
		/*$data['total_remote_ack_alarm'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm','3')
					->where('id_alarm_type is NULL', NULL, FALSE)
					->where('status_name<>','NOP')
					->get()->result());*/
		$data['total_remote_ack_alarm_define'] = count($this->db->select('id_remote')
					->from('v_all_remote')
					->where('status_alarm=','3')
					->where('id_alarm_type is NOT NULL', NULL, FALSE)
					->where('status_name','OFFLINE')
					->where('status_name<>','NOP')
					->get()->result());
		
		
		$this->template->views('watch/maps_dashboard',$data);
	}
	
	

}

