<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Troubleshoot extends CI_Controller {

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
	
	public function speedtest()
	{
		$data['page'] = 'Tools';
        $data['title'] = 'Tools Speedtest';
		$this->template->views('troubleshoot/speedtest',$data);

	}
	
	
	public function test_ping()
	{
		$data['page'] = 'Tools';
        $data['title'] = 'Tools Ping';
		$this->template->views('troubleshoot/ping',$data);

	}
	
	public function test_traceroute()
	{
		$data['page'] = 'Tools';
        $data['title'] = 'Tools Traceroute';
		$this->template->views('troubleshoot/traceroute',$data);

	}
	
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
	
	
	 public function call_traceroute()
	{
		$this->traceroute('traceroute -n -w 3 -q 1 1.147.17.1');

	}
	
	public function call_ping()
	{
		$this->ping('ping 1.147.17.1 -c 3');

	}
	
	
	function traceroute()
	{
		/*
		$cmd = "traceroute -n -w 3 -q 1 ".$_POST['ip_address'];
		//echo "<title>Traceroute to ".$_POST['ip_address']."</title>";
		//echo '<div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Traceroute... (please wait)</div><br><br>';
		
		while (@ ob_end_flush()); // end all output buffers if any

		$proc = popen("$cmd 2>&1 ; echo Exit status : $?", 'r');
		$live_output     = "";
		$complete_output = "";
		$i=0;
		while (!feof($proc))
		{
			//sleep(1);
			$live_output     = fread($proc, 4096);
			//$live_output     = fread($proc, 1024);
			$complete_output = $complete_output . $live_output;
			//echo "$live_output";
			@ flush();
		}
		$start = explode("packets",$complete_output);
		echo $start[0]."packets<br>";
		$traceroute = explode("ms",$start[1]);
		//$traceroute = explode("*",$start[1]);
		//$reply      = explode("ms",$traceroute[0]);
		//echo $traceroute[0]."ms<br>";
		for($j=0;$j<count($traceroute);$j++){			
			echo $traceroute[$j]."ms<br>";
		}
		//echo $traceroute[0];
		pclose($proc);

		// get exit status
		preg_match('/[0-9]+$/', $complete_output, $matches);

		// return exit status and intended output
		return array (
						'exit_status'  => intval($matches[0]),
						'output'       => str_replace("Exit status : " . $matches[0], '', $complete_output)
					 );
		*/
		
		$a = popen('traceroute -n -w 3 -q 1 '.$_POST['ip_address'], 'r');
		echo('<div style="font-family:\'Courier New\';font-size:10pt;">');
		while($b = fgets($a, 2048)) {
		echo $b."<br>\n";
		ob_flush();flush();
		}		
		pclose($a);
		echo "<br />Done.";
		echo('<div/>');
	}
	
	function ping()
	{
		if(!isset($_POST['count'])){
			$count = 4;
		}
		else if($_POST['count']==""){
			$count = 4;
		}else{
			$count=$_POST['count'];
		}
		/*
		echo "<title>Ping to ".$_POST['ip_address']."</title>";
		//echo '<div class="panel-heading" align="center" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">Ping... (please wait)</div><br><br>';
		$cmd = "ping ".$_POST['ip_address']." -c ".$count;
		while (@ ob_end_flush()); // end all output buffers if any

		$proc = popen("$cmd 2>&1 ; echo Exit status : $?", 'r');
		$live_output     = "";
		$complete_output = "";
		//echo "<br>";
		while (!feof($proc))
		{
			$live_output     = fread($proc, 4096);
			//$live_output     = fread($proc, 1024);
			$complete_output = $complete_output . $live_output;
			$start = explode("data.",$live_output);
			if(isset($start[1])){
				echo $start[0]."data.<br>".$start[1]."<br>";
			}else{
				//echo "$live_output <br>";
				if(strpos($live_output, "---")){
					$end = explode("---",$live_output);
					echo $end[0]."<br>";
					echo "<br>".$end[1]." :<br>";
					$rtt = explode("rtt",$end[2]); 
					echo $rtt[0]."<br>";
					echo "rtt ".$rtt[1]."<br>";
				}else{
					echo "$live_output <br>";
				}
			}
			
			
			@ flush();
			//echo " a <br>";
		}
		//echo $traceroute[0];
		pclose($proc);

		// get exit status
		preg_match('/[0-9]+$/', $complete_output, $matches);

		// return exit status and intended output
		return array (
						'exit_status'  => intval($matches[0]),
						'output'       => str_replace("Exit status : " . $matches[0], '', $complete_output)
					 );
		*/
		
		$a = popen('ping '.$_POST['ip_address'].' -c '.$count, 'r');
		echo('<div style="font-family:\'Courier New\';font-size:10pt;">');
		while($b = fgets($a, 2048)) {
		echo $b."<br>\n";
		ob_flush();flush();
		}
		echo('<div/>');
		pclose($a);
	}
	
	
}