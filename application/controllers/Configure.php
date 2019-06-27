<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configure extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('m_dashboard','m_dash_prov','m_configure'));

        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

/*     public function index()
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
		$this->template->views('dashboard/kanwil',$data);

	} */
	
    public function add()
	{
		if(isset($_POST['id_jarkom'])){
					
			$id_jarkom = $_POST['id_jarkom'];
			$remote = $this->db->select('*')->from('v_all_remote_jarkom')->where('id_jarkom',$id_jarkom)->limit(10)->get()->result();
			$data["remote"] = $remote[0];
		}
		
		$data['page'] = 'prov';
        $data['title'] = 'New Configure Remote Router';
		$this->template->views('configure/add1',$data);
	}
	
	public function generate()
	{	
		$ip_tunnel_1 = "";
		$ip_tunnel_2 = "";
		
		$ip_lan = $_POST['ip_lan'];
		//$ip_wan = 0;
		if(isset($_POST['ip_wan'])){
			$ip_wan = $_POST['ip_wan'];
		}
		$data['id_jarkom'] = $_POST['id_jarkom'];
		$ip_pool = $_POST['ip_pool'];
		$kode_provider = $_POST['kode_provider'];
		$kode_jenis_jarkom = $_POST['kode_jenis_jarkom'];
		$interface_lan = $_POST['interface_lan'];
		if(isset($_POST['ip_tunnel_1'])){
			$ip_tunnel_1 = $_POST['ip_tunnel_1'];
		};
		if(isset($_POST['ip_tunnel_2'])){
			$ip_tunnel_2 = $_POST['ip_tunnel_2'];
		};
		
		
		$data['config'] = $this->db->select('*')->from('tb_template_config')
										->where('kode_provider',$kode_provider)
										->where('kode_jenis_jarkom',$kode_jenis_jarkom)
										->limit(10)->get()->result()[0]->template;

		//$data['config'] = $config[0];
		exec("ipcalc $ip_tunnel_1/30", $out_1);
		$tunnel_1_host_min = explode(" ", $out_1[5])[3];
		$tunnel_1_host_max = explode(" ", $out_1[6])[3];
		exec("ipcalc $ip_tunnel_2/30", $out_2);
		$tunnel_2_host_min = explode(" ", $out_2[5])[3];	
		$tunnel_2_host_max = explode(" ", $out_2[6])[3];
		
		exec("ipcalc $ip_lan", $out_lan);
		$lan_network = explode(" ", $out_lan[4])[3];
		$gateway = explode(" ", $out_lan[5])[3];
		
		$data['config'] = str_replace("[INDEX_ETHER]",$interface_lan,$data['config']);
		$data['config'] = str_replace("[IP_POOL]",$ip_pool,$data['config']);
		
		
		$data['config'] = str_replace("[INTERFACE_TO_LAN]","ether".($interface_lan+1),$data['config']);
		$data['config'] = str_replace("[IP_TUNNEL_1_1]",$tunnel_1_host_min,$data['config']);
		$data['config'] = str_replace("[IP_TUNNEL_2_1]",$tunnel_2_host_min,$data['config']);
		$data['config'] = str_replace("[IP_TUNNEL_1_2]",$tunnel_1_host_max,$data['config']);
		$data['config'] = str_replace("[IP_TUNNEL_2_2]",$tunnel_2_host_max,$data['config']);
		$data['config'] = str_replace("[GATEWAY_IP_LAN_SUBNET]",$gateway."/24",$data['config']);
		$data['config'] = str_replace("[GATEWAY_IP_LAN]",$gateway,$data['config']);
		$data['config'] = str_replace("[NETWORK_IP_LAN]",$lan_network,$data['config']);
		
		$data['page'] = 'prov';
        $data['title'] = 'New Configure Remote Router';
		//$this->template->views('configure/generate',$data);
		echo json_encode($data);
	}
	
	public function save_config()
	{
		//CEK DULU APAKAH REMOTE TERSEBUT SUDAH ADA DI DATABASE TAPI BELUM DI PUSH
		$id_jarkom = $_POST["id_jarkom_gen"];
		$script    = $_POST["script"];
		$exist     = $this->m_configure->getSavedConfig($id_jarkom);
		
		//var_dump($exist);
		
		if($exist==null)//JIKA BELUM ADA, MAKA INSERT
		{
			//$data['title'] = 'Null';
			$res = $this->m_configure->saveInsertConfig($id_jarkom,$script);
			if($res)
			{
				$data['title'] = "Saved Successfully";
			}
			else
			{
				$data['title'] = "Save Failed";
			}
		}
		else// JIKA SUDAH ADA, MAKA UPDATE
		{
			$res = $this->m_configure->saveUpdateConfig($id_jarkom,$script);
			if($res)
			{
				$data['title'] = "Saved Successfully";
			}
			else
			{
				$data['title'] = "Save Failed";
			}
		}
		/*
		$data = array(
		   'id_jarkom' => $_POST['id_jarkom_gen'],
		   'script' => $_POST['script'],
		   'create_at' => date("Y-m-d H:i:s", time()),
		   'user_create' => $this->session->userdata('username')
		);

		$this->db->insert('tb_config', $data); 
		*/		
		$data['page']  = 'prov';
        
		//$this->template->views('configure/generate',$data);
		echo json_encode($data);
	}
	
	function GetRemote()
	{
		$ip_lan = $_GET["nama_remote"];

		$output = array();

		$remote = $this->db->select('*')->from('v_all_remote_jarkom')->like('ip_lan',$ip_lan)->or_like('ip_wan',$ip_lan)->limit(10)->get()->result();

		foreach ($remote as $r) {
			$data['id'] = $r->id_jarkom;
	        $data['text'] = $r->tipe_uker." ".$r->nama_remote."  ||  IP LAN (".$r->ip_lan.")  ||  Provider (".$r->nickname_provider.") ||  Jenis Jarkom (".$r->jenis_jarkom.")  ||  IP WAN (".$r->ip_wan.")";
			//$data['ip_lan'] = $r->ip_lan;
			//$data['ip_wan'] = $r->ip_wan;
			//$data['provider'] = $r->nickname_provider;
	        array_push($output, $data);
		}

		if (! empty($output)) {
			// Encode ke format JSON.
			echo json_encode($output);
			//var_dump($output);
		}
	}
	
	function GetRemote1()
	{
		$ip_lan = $_POST["ip_addr"];

		$output = array();

		$remote = $this->db->select('*')->from('v_all_remote_jarkom')->like('ip_lan',$ip_lan)->or_like('ip_wan',$ip_lan)->limit(10)->get()->result();

		foreach ($remote as $r) {
			$data['id'] = $r->id_jarkom;
	        $data['text'] = $r->tipe_uker." ".$r->nama_remote."  ||  IP LAN (".$r->ip_lan.")  ||  Provider (".$r->nickname_provider.") ||  Jenis Jarkom (".$r->jenis_jarkom.")  ||  IP WAN (".$r->ip_wan.")";
			$data['ip_lan'] = $r->ip_lan;
			$data['rem_name'] = $r->tipe_uker." ".$r->nama_remote;
			
			//$data['ip_wan'] = $r->ip_wan;
			//$data['provider'] = $r->nickname_provider;
	        array_push($output, $data);
		}

		if (! empty($output)) {
			// Encode ke format JSON.
			echo json_encode($output);
			//var_dump($output);
		}
	}
	
	function getJarkom()
	{
		$id_jarkom = $_POST["id_jarkom"];
		
		$data["data"]  = $this->m_configure->getJarkom($id_jarkom);
		
		$data["page"]  = 'jarkom';
        $data["title"] = 'Get Jarkom Jarkom';
		echo json_encode($data);
	}
	
	function getSavedConfig()
	{
		$id_jarkom = $_POST["id_jarkom"];
		$data["data"]  = $this->m_configure->getSavedConfig($id_jarkom);
		
		$data["page"]  = 'jarkom';
        $data["title"] = 'Get Jarkom Jarkom';
		echo json_encode($data);
	}
	
	 public function push_config()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(($_POST['username']=='') && ($_POST['password']=='')){
			$username = "BRI";
			$password = "mikrotikBR1";
		}
		$ip_address = $_POST['ip_address_push'];
		
		$this->load->library('RouterosAPI');
		$API = new RouterosAPI();

		$config = $this->db->select('*')
					->from('tb_config')
					->where('user_create',$this->session->userdata('username'))
					->where('status',null)
					->order_by('id', 'DESC')
					->limit(1)->get()->result();
		$script = $config[0]->script;
		
		$skuList = explode(PHP_EOL, $script);
		$script_awal = "";
		if ($API->connect($ip_address, $username, $password)) {
			foreach ($skuList as $value) {
				$data_config =array();
				$root =null;
				$line = explode(" ", $value);
				if($value[0]=='/') {				
					$script_awal = str_replace(" ","/",$value);
				}else{
					$script =  explode(" ", $value);
					$root = trim($script_awal)."/".$script[0];
					if(substr_count($value, 'add ')){
						$command = str_replace("add ","",$value);
						$detail_script =  explode(" ", $command);
						//echo $root."<br>";
						for($i=0;$i<count($detail_script);$i++){
							$attribute = explode("=", $detail_script[$i]);
							$data_config[$attribute[0]] = ((isset($attribute[1])) ? $attribute[1] : "''");
							 $API->comm($root, $data_config);
						}
					}
					if(substr_count($value, 'set ')){
						$command = str_replace("set ","",$value);
						$detail_script =  explode(" ", $command);
						//echo $root."<br>";
						for($i=0;$i<count($detail_script);$i++){
							$attribute = explode("=", $detail_script[$i]);
							$data_config[$attribute[0]] = ((isset($attribute[1])) ? $attribute[1] : "''");
							$API->comm($root,$data_config);
						}
					}
					//echo "<br>";
				}
				//var_dump($data_config);
			}
		   //var_dump($ips);
		   $API->disconnect();
		}
		$this->db->set('status', '1')
		->where('id', $config[0]->id)
		->update('tb_config');
	
		$data['page'] = 'prov';
		$data['title'] = 'Configuration Pushed';
		$data['status_push'] = true;
		//$this->template->views('configure/generate',$data);
		echo json_encode($data);
	}
	
	function GetIdRemote()
	{
		$ip_lan = $_GET["ip"];

		$output = array();

		$remote = $this->db->select('*')->from('v_all_remote')->like('ip_lan',$ip_lan)->limit(10)->get()->result();

		foreach ($remote as $r) {
			$data['id'] = $r->id_remote;
			$data['ip'] = $r->ip_lan;
	        $data['text'] = $r->nama_remote."  ||  IP LAN (".$r->ip_lan.")";
			//$data['ip_lan'] = $r->ip_lan;
			//$data['ip_wan'] = $r->ip_wan;
			//$data['provider'] = $r->nickname_provider;
	        array_push($output, $data);
		}

		if (! empty($output)) {
			// Encode ke format JSON.
			echo json_encode($output);
			//var_dump($output);
		}
	}

	function ChangeRemote()
	{
		// $kode_jarkom = $_POST['kode_jarkom'];
		// $ip_lan = $_POST['ip_lan'];
		// $id_remote = $_POST['id_remote'];
		// $used_status = $_POST['used_status'];

		$datajarkom = array(
        	'ip_wan'   	 		 	=> $_POST['ip_lan'],
			'used_status'   		=> $_POST['used_status'],
			'id_remote'   			=> $_POST['id_remote'],
			'user_update'			=> $this->session->userdata('username'),
			'update_at'				=> date('Y-m-d H:i:s')
        );

        

        $return = $this->db->where('kode_jarkom',$_POST['kode_jarkom'])->update('tb_jarkom',$datajarkom);


        $jarkom = array(
        	'kode_jarkom'			=> $_POST['kode_jarkom'],
        	'kode_jenis_jarkom'     => $_POST['kode_jenis_jarkom'],
        	'kode_provider' 		=> $_POST['kode_provider'],
        	'bandwidth'   			=> $_POST['bandwidth'],
        	'ip_wan'   	 		 	=> $_POST['ip_lan'],
			'brisat'   				=> $_POST['brisat'],
			'used_status'   		=> $_POST['used_status'],
			'id_remote'   			=> $_POST['id_remote'],
			'id_spk'				=> $_POST['id_spk'],
			'user_update'			=> $this->session->userdata('username'),
			'update_at'				=> date('Y-m-d H:i:s')
        );

        $this->db->insert('tb_jarkom_history',$jarkom);

        if ($return) {
            $return = true;
        }else{
            $return = false;
        }

        echo json_encode($return);
	}
	
	
}