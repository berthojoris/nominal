<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_maps'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    public function index()
	{
		$data['page']  = 'maps';
		$data['title'] = 'Remote Locations';
		$this->template->views('maps_osm',$data);
       //$this->template->views('maps');
	}
	
	public function fullscreen()
	{
		$data['page']  = 'mapsfull';
		$data['title'] = 'Remote Locations Monitoring';
		//$this->load->view('maps3',$data);
		$this->load->view('maps_osm_fs',$data);
	}
	
	public function fullscreenOsm()
	{
		$data['page']  = 'OsmFull';
		$data['title'] = 'Remote Locations Monitoring';
		$this->load->view('maps_osm_dev',$data);
	}
    
    public function All_Uker()
    {
        $data['page'] = 'maps';
        $data['all']  = $this->M_maps->getAllUker();
                
        echo json_encode($data);
    }
    
    public function getListKanwil()
    {
        $data['page']   = 'maps';
        $data['kanwil'] = $this->M_maps->getListKanwil();
                
        echo json_encode($data);
    }
	
	public function getCenterMap()
    {
		$kanwil = $_POST['kw'];
        $data['page']   = 'centermap';
        $data['center'] = $this->M_maps->getCenterMap($kanwil);
                
        echo json_encode($data);
    }
	
	public function getCenterMapRemote()
    {
		$kanca = $_POST['kc'];
        $data['page']   = 'centermap';
        $data['center'] = $this->M_maps->getCenterMapRemote($kanca);
                
        echo json_encode($data);
    }
    
    public function getListKanca()
    {
        $kanwil = explode(",",$_POST['kanwil']);
        $in = "'".$kanwil[0]."'";
        for($i = 1 ; $i < count($kanwil) ; $i++)
        {
            $in .= ",'".$kanwil[$i]."'";
        }          
        //$data['kanwil']   = $in;
        $data['page']   = 'maps';
        $data['kanca'] = $this->M_maps->getListKanca($in);
        //echo $kanwil;        
        echo json_encode($data);
    }
	
	public function getListJenisUkerAll()
    {
				
        $data['page']      = 'maps';
        $data['jenisuker'] = $this->M_maps->getListJenisUkerAll();
                
        echo json_encode($data);
    }
    
    public function getListJenisUker()
    {
		$dts = $_POST['data'];
		$where = "";		

		if($dts=="kanca" || $dts=="remote")
		{
			$where = "WHERE kode_tipe_uker IN (2,3,4,5,6,7,10,11,12,13,14)";
		}
		
        $data['page']      = 'maps';
        $data['jenisuker'] = $this->M_maps->getListJenisUker($where);
                
        echo json_encode($data);
    }
    
    public function getListProvider()
    {
        $data['page']      = 'maps';
        $data['provider'] = $this->M_maps->getListProvider();
                
        echo json_encode($data);
    }
	
	public function viewLocationAll()
    {
		$data['page']   = 'maps';
        $data['filter'] = $this->M_maps->viewLocationAll();
        echo json_encode($data);
	}
    
    public function viewLocation()
    {
        $where = "WHERE 1";
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
				$where .= " AND kode_kanwil IN(".$in.")";  
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
				$where .= " AND kode_kanca IN(".$in.")";  
			}
        }
		
		if(isset($_POST['jns']))
		{
			if($_POST['jns'] != null && $_POST['jns'] != 'null')
			{
				$jns = explode(",",$_POST['jns']);
				$in = "'".$jns[0]."'";
				for($i = 1 ; $i < count($jns) ; $i++)
				{
					$in .= ",'".$jns[$i]."'";
				}
				$where .= " AND kode_tipe_uker IN(".$in.")";  
			}
        }
		/*
		if(isset($_POST['prv']))
		{
			if($_POST['prv'] != null && $_POST['prv'] != 'null')
			{
				$prv = explode(",",$_POST['prv']);
				$in = "'".$prv[0]."'";
				for($i = 1 ; $i < count($prv) ; $i++)
				{
					$in .= ",'".$prv[$i]."'";
				}
				$where .= " AND f.kode_provider IN(".$in.")";  
			}
        }
        */
        $data['page']   = 'maps';
        $data['filter'] = $this->M_maps->viewLocation($where);
         //var_dump($where);       
        echo json_encode($data);
    }

	function getLocationInduk()
	{
		$idremote       = $_POST['idremote'];
		$data['page']   = 'maps';
        $data['filter'] = $this->M_maps->getLocationInduk($idremote);
		echo json_encode($data); 
		//echo $data;
	}
}

