<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash_Provider extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_dashboard','m_dash_prov'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		$prov = $this->m_dash_prov->dash_prov();
		$data['prov'] = $prov;
		$index = 0;
		for ($j=0; $j < count($prov); $j++) { 
			$p = $prov[$j]->kode_provider;
			$b = $prov[$j]->brisat;
			$jarkom = $prov[$j]->kode_jenis_jarkom;
			$nick = $prov[$j]->nickname_provider;
			$data['data_prov'][$j] = $this->m_dashboard->getOnOffProvider($p,$b,$nick,$jarkom);
			$index = $j;
		}
		//var_dump($data['data_prov']);die();
		//echo count($data['prov']).'='.count($data['data_prov']);
		$data['page'] = 'prov';
        $data['title'] = 'Dashboard Provider';
		$this->template->views('dashboard/dash_prov_new3',$data);

	}

    public function Bar_dashboard()
	{
		$prov = $this->m_dash_prov->dash_prov();
		$data['prov'] = $prov;
		$index = 0;
		for ($j=0; $j < count($prov); $j++) { 
			$p = $prov[$j]->kode_provider;
			$b = $prov[$j]->brisat;
			$jarkom = $prov[$j]->kode_jenis_jarkom;
			$nick = $prov[$j]->nickname_provider;
			$data['data_prov'][$j] = $this->m_dashboard->getOnOffProvider($p,$b,$nick,$jarkom);
			$index = $j;
		}
		//var_dump($data['data_prov']);die();
		//echo count($data['prov']).'='.count($data['data_prov']);
		$data['page'] = 'provbar';
        $data['title'] = 'Dashboard Provider';
		$this->template->views('dashboard/testdash2',$data);

	}


	public function refreshProv()
	{
		
			
		$prov = $this->m_dash_prov->dash_prov();
		$data['prov'] = $prov;
		for ($j=0; $j < count($prov); $j++) { 
			$p = $prov[$j]->kode_provider;
			$b = $prov[$j]->brisat;
			$jarkom = $prov[$j]->kode_jenis_jarkom;
			$nick = $prov[$j]->nickname_provider;
			$data['data_prov'][$j] = $this->m_dashboard->getOnOffProvider($p,$b,$nick,$jarkom);
		}
		//var_dump($data['data_prov']);die();
		//echo count($data['prov']).'='.count($data['data_prov']);
		$data['page'] = 'prov';
        $data['title'] = 'Dashboard Provider';

		echo json_encode($data);

	}


	public function Jarkom_Jupiter()
	{
		
			
		$prov = $this->m_dash_prov->dash_prov_jupiter();
		$data['prov'] = $prov;
		for ($j=0; $j < count($prov); $j++) { 
			$p = $prov[$j]->kode_provider;
			$b = $prov[$j]->brisat;
			$jarkom = $prov[$j]->kode_jenis_jarkom;
			$nick = $prov[$j]->nickname_provider;
			$data['data_prov'][$j] = $this->m_dashboard->getOnOffProvider($p,$b,$nick,$jarkom);
		}
		//var_dump($data['data_prov']);die();
		//echo count($data['prov']).'='.count($data['data_prov']);
		$data['page'] = 'jupiter';
        $data['title'] = 'Dashboard Provider';

		$this->template->views('dashboard/dash_prov_jupiter',$data);

	}


	public function RefJarkom_Jupiter()
	{
		
			
		$prov = $this->m_dash_prov->dash_prov_jupiter();
		$data['prov'] = $prov;
		for ($j=0; $j < count($prov); $j++) { 
			$p = $prov[$j]->kode_provider;
			$b = $prov[$j]->brisat;
			$jarkom = $prov[$j]->kode_jenis_jarkom;
			$nick = $prov[$j]->nickname_provider;
			$data['data_prov'][$j] = $this->m_dashboard->getOnOffProvider($p,$b,$nick,$jarkom);
		}
		//var_dump($data['data_prov']);die();
		//echo count($data['prov']).'='.count($data['data_prov']);
		$data['page'] = 'prov';
        $data['title'] = 'Dashboard Provider';

		echo json_encode($data);

	}
}

/// query 
// $prov = $this->db->query("SELECT
		// 								a.kode_provider,
		// 								CONCAT(
		// 									(
		// 							    CASE 
		// 							        WHEN a.brisat=1 OR a.brisat=2 THEN 'BRISAT'
		// 							        ELSE c.jenis_jarkom
		// 							    END),
		// 									'-',
		// 									b.nickname_provider
		// 								) AS nickname,
		// 								CONCAT(
		// 									a.kode_provider,
		// 									a.kode_jenis_jarkom,
		// 									a.brisat
		// 								) AS id,
		// 							 	a.brisat,
		// 							 	a.kode_jenis_jarkom
		// 							FROM
		// 								tb_jarkom a
		// 							LEFT JOIN tb_provider b ON b.kode_provider = a.kode_provider
		// 							LEFT JOIN tb_jenis_jarkom c ON c.kode_jenis_jarkom = a.kode_jenis_jarkom
		// 							LEFT JOIN tb_remote d ON d.id_remote = a.id_remote
		// 							WHERE
		// 								d.kode_op IN (1, 2)
		// 							GROUP BY nickname
		// 							ORDER BY FIELD(a.brisat,1,0,2), a.kode_jenis_jarkom ASC, b.nickname_provider ASC")->result();