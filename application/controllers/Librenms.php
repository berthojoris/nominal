<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Librenms extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model(array('m_dashboard','m_home'));
		
		$this->load->helper('form');
        $this->load->library('curl');
		//$this->API="https://172.18.65.159/api/v0/logs/eventlog/:46.24.172.1";
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}

    function index()
{
    $username = 'damar';
    $password = 'cf684b7a913ce8d7187a3afddc4c5db3';
     
    // Alternative JSON version
    // $url = 'http://twitter.com/statuses/update.json';
    // Set up and execute the curl process
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'https://172.18.65.159/api/v0/logs/eventlog/:46.24.172.1');
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
        //'name' => $new_name,
        //'email' => $new_email
    ));
     
    // Optional, delete this line if your API is open
    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
     
    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
     
    $result = json_decode($buffer);
 
    if(isset($result->status) && $result->status == 'success')
    {
        echo 'User has been updated.';
    }
     
    else
    {
        echo 'Something has gone wrong';
    }
}

function ci_curl($new_name='', $new_email='')
{
  $username = 'damar';
    $password = 'X-Auth-Token: cf684b7a913ce8d7187a3afddc4c5db3';
     
    $this->load->library('curl');
     
    $this->curl->create('http://172.18.65.159/api/v0/logs/eventlog/:46.24.172.1');
     
    // Optional, delete this line if your API is open
    //$this->curl->http_login($username, $password);
 
    $this->curl->post(array(
        'X-Auth-Token' => $password
    ));
     
    $result = json_decode($this->curl->execute());
 
    if(isset($result->status) && $result->status == 'success')
    {
        echo 'User has been updated.';
    }
     
    else
    {
        echo 'Something has gone wrong';
    }
}


function callAPI($method, $url, $data){

}

	function test_curl(){
		    // persiapkan curl
			$ch = curl_init(); 

			// set url 
			curl_setopt($ch, CURLOPT_URL, "http://172.18.65.159/api/v0/logs/eventlog/:hostname?limit=20&start=5&from=2017-07-22%2023:00:00");
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
			echo $output;
		
	}
	
	
	function graphs_curl(){
		    // persiapkan curl
			$ch = curl_init(); 

			// set url 
			curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/1.131.129.1/ports/Cellular0/port_bits");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  'X-Auth-Token: fc7665d615d9c36ae9f9bc0d34607971',
			  'Content-Type: application/png',
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
	
		function test_curl2(){
		    // persiapkan curl
			$ch = curl_init(); 

			// set url 
			//curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/53.45.12.1/2");
			curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/7.131.17.1/ports/Gi8/port_bits");
			
			//curl_setopt($ch, CURLOPT_URL, "http://172.18.65.159/api/v0/portgroups/peering\?legend=no\&type=mport_bits\&from=1545780300\&to=1545866700\&width=406\&height=189");
			//curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/graph.php?height=189&width=406&to=1545866700&id=70&type=port_bits&from=1545780300");
			//curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/portgroups/multiport/bits/1");
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
			echo $output;
			
			//$data =  json_decode($output,true);
			//var_dump($data['devices'][0]);
			//var_dump($data['logs']);
			//foreach ($output as $k => $v) {
				//echo $v['hostname'];
			//}
			//$this->load->view('Home/graphs',$data);
			//$this->template->views('Home/graphs',$data);
	}
	
	
	function get_ports(){
		    // persiapkan curl
			$ch = curl_init(); 

			// set url 
			curl_setopt($ch, CURLOPT_URL, "http://172.18.65.212/api/v0/devices/1.100.17.1/ports?columns=ifDescr%2CifName%2Cport_id%2CifSpeed");
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

	
	function call_graphs(){
		echo '<html><body style="background-color:white;">';
		//header('content-type: image/jpeg');
		echo  '<img src="http://nominal.bri.co.id/nominal/index.php/Librenms/test_curl2">';
		//$this->test_curl2();
		echo '</body></html>';
	}



	function get_perf($ip=NULL,$start=NULL,$end=NULL)
	{

		$url = "http://172.18.65.159/api/v0/devices/$ip";
		//echo $url."<br>";
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
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');

		// $output contains the output string 
		$output = curl_exec($ch); 

		// tutup curl 
		curl_close($ch);      

		// menampilkan hasil curl
		$convert = json_decode($output);
		$array_object = (array) $convert;
		//var_dump($array_object);
		$device_id = $array_object["devices"][0]->device_id;
		echo "http://172.18.65.159/scheduler_manual/get_device_perf.php?device_id=$device_id&start=$start&end=$end";


		$data = file_get_contents("http://172.18.65.159/scheduler_manual/get_device_perf.php?device_id=$device_id&start=$start&end=$end");
		$data_array = json_decode($data);
		var_dump($data_array);
		for ($i=0; $i < count($data_array); $i++) { 
			echo $data_array[$i]->max."<br>";
		}
		//echo file_get_contents("http://172.18.65.159/scheduler_manual/get_device_perf.php?device_id=297&start=2019-04-15%2014:47&end=2019-04-15%2015:47");
//		$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
		//echo json_encode($data);
		//var_dump(json_decode($data));
		//var_dump(json_decode($data, true));

	}








	function get_perf_bulk($ip=NULL,$start=NULL,$end=NULL)
	{
		$list_ip = array(
			'3.70.17.1',
			'10.199.11.70',
			'3.133.17.1'
		);

		for ($list=0; $list < count($list_ip); $list++) { 
			# code...
			$ip = $list_ip[$list];
			$url = "http://172.18.65.159/api/v0/devices/$ip";
			//echo $url."<br>";
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
			//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');

			// $output contains the output string 
			$output = curl_exec($ch); 

			// tutup curl 
			curl_close($ch);      

			// menampilkan hasil curl
			$convert = json_decode($output);
			$array_object = (array) $convert;
			//var_dump($array_object);
			$device_id = $array_object["devices"][0]->device_id;



			$data = file_get_contents("http://172.18.65.159/scheduler_manual/get_device_perf.php?device_id=$device_id&start=$start&end=$end");
			$data_array = json_decode($data);
			var_dump($data_array);
			//for ($i=0; $i < count($data_array); $i++) { 
			//	echo $data_array[0]->max."<br>";
			//}
		}
		
		//echo file_get_contents("http://172.18.65.159/scheduler_manual/get_device_perf.php?device_id=297&start=2019-04-15%2014:47&end=2019-04-15%2015:47");
//		$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
		//echo json_encode($data);
		//var_dump(json_decode($data));
		//var_dump(json_decode($data, true));

	}



	function get_all_device()
	{
			
			$url = "http://172.18.65.159/api/v0/devices?order=hostname%20DESC%20limit%205000%20offset%2020000&type=up";
			//echo $url."<br>";
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
			//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');

			// $output contains the output string 
			$output = curl_exec($ch); 

			// tutup curl 
			curl_close($ch);      

			// menampilkan hasil curl
			$convert = json_decode($output);
			$array_object = (array) $convert;
			//var_dump($array_object);
			//echo $array_object["devices"][0]->device_id;

			for ($x=0; $x <count($array_object["devices"]) ; $x++) { 
				echo $array_object["devices"][$x]->device_id."|".$array_object["devices"][$x]->sysName."<br>";
			}


	}


	function get_perf_go_max()
	{

		$data_ip = $this->db->query("SELECT * FROM tb_perf WHERE status_cek IS NULL AND max IS NULL limit 1")->result();
		var_dump($data_ip);
		$device_id = $data_ip[0]->device_id;
		$jenis_jarkom = str_replace(' ','%20',$data_ip[0]->jenis_jarkom);
		$periode = $data_ip[0]->periode;
		$data = file_get_contents("http://172.18.65.159/scheduler_manual/get_device_perf_go.php?device_id=$device_id&periode=$periode&jenis_jarkom=$jenis_jarkom&data=max");
		$data_array = json_decode($data);
		var_dump($data_array);
		//for ($i=0; $i < count($data_array); $i++) { 
		//	echo $data_array[$i]->max."<br>";
		//}

		$data_perf  = array(
					'max' => $data_array[0]->max
					);

				$this->db->where('device_id',$device_id);
				$this->db->where('periode',$periode);
		        $this->db->update('tb_perf',$data_perf);

	}

	function get_perf_go_min()
	{

		$data_ip = $this->db->query("SELECT * FROM tb_perf WHERE status_cek IS NULL AND min IS NULL limit 1")->result();
		var_dump($data_ip);
		$device_id = $data_ip[0]->device_id;
		$jenis_jarkom = str_replace(' ','%20',$data_ip[0]->jenis_jarkom);
		$periode = $data_ip[0]->periode;
		$data = file_get_contents("http://172.18.65.159/scheduler_manual/get_device_perf_go.php?device_id=$device_id&periode=$periode&jenis_jarkom=$jenis_jarkom&data=min");
		echo "http://172.18.65.159/scheduler_manual/get_device_perf_go.php?device_id=$device_id&periode=$periode&jenis_jarkom=$jenis_jarkom&data=min";
		$data_array = json_decode($data);
		var_dump($data_array);
		//for ($i=0; $i < count($data_array); $i++) { 
		//	echo $data_array[$i]->max."<br>";
		//}

		$data_perf  = array(
					'min' => $data_array[0]->min
					);

				$this->db->where('device_id',$device_id);
				$this->db->where('periode',$periode);
		        $this->db->update('tb_perf',$data_perf);

	}

	function get_perf_go_avg()
	{

		$data_ip = $this->db->query("SELECT * FROM tb_perf WHERE status_cek IS NULL AND avg IS NULL limit 1")->result();
		var_dump($data_ip);
		$device_id = $data_ip[0]->device_id;
		$jenis_jarkom = str_replace(' ','%20',$data_ip[0]->jenis_jarkom);
		$periode = $data_ip[0]->periode;
		$data = file_get_contents("http://172.18.65.159/scheduler_manual/get_device_perf_go.php?device_id=$device_id&periode=$periode&jenis_jarkom=$jenis_jarkom&data=avg");
		//$data_array = json_decode($data);
		//var_dump($data_array);
		echo $data;

		//for ($i=0; $i < count($data_array); $i++) { 
		//	echo $data_array[$i]->max."<br>";
		//}

		$data_perf  = array(
					'avg' => $data_array[0]->avg
					);

				$this->db->where('device_id',$device_id);
				$this->db->where('periode',$periode);
		        $this->db->update('tb_perf',$data_perf);

	}

}

