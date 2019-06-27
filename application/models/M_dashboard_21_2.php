<?php

class M_dashboard extends CI_Model {

    function get_remote($kanca,$tipe_uker) {
		$this->db->select("count(id_remote) as total");
		$this->db->from('tb_remote');
		$this->db->where('tb_remote.kode_kanca',$kanca);
		$this->db->where('tb_remote.kode_tipe_uker',$tipe_uker);
		$this->db->where_not_in('tb_remote.kode_op','0');
		$data=$this->db->get()->result();
    	
		//var_dump($data[0]->total);
		return $data[0]->total;
    }

    function jumlah_uker($kanca)
    {
		$this->db->select('count(id_remote) as total');
		$this->db->from('tb_remote');
		$this->db->where('kode_kanca',$kanca);
    	$data = $this->db->get()->result();
    	//var_dump($data[0]->total);
    	return $data[0]->total;
    }

    function jumlah_uker_all()
    {
		$this->db->select('count(id_remote) as total');
		$this->db->from('tb_remote');
		$this->db->where_not_in('kode_op',array(0));
    	$data = $this->db->get()->result();
    	//var_dump($data[0]->total);
    	return $data[0]->total;
    }

    function jumlah_uker_kanwil($kanca)
    {
		$this->db->select('count(id_remote) as total');
		$this->db->from('tb_remote');
		$this->db->where_not_in('kode_tipe_uker',array(0,1));
		$this->db->where_in('kode_kanca',$kanca);
    	$data = $this->db->get()->result();
    	//var_dump($data[0]->total);
    	return $data[0]->total;
	}
	
	function get_id_last_jarkom()
    {
    	$jum = $this->db->select('kode_jarkom')->from('tb_jarkom')->order_by('kode_jarkom','desc')->limit(1)->get()->result();

		$kode_jarkom = str_pad((intval($jum[0]->kode_jarkom)+1), 8, '0', STR_PAD_LEFT);
		return $kode_jarkom;
    }

    function getOnOffKanwil($kanwil)
    {
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote 		
    				WHERE kode_kanwil = '$kanwil' 
					AND status = '3'
					AND kode_op IN (1,2)";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offlineAllOp
		$sql_offOp = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote 		
    				WHERE kode_kanwil = '$kanwil'
					AND status='1' 
					AND kode_op = '1'
					AND kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$query_offOp = $this->db->query($sql_offOp)->result();

		//offlineAllNop
		$sql_offNop = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote 		
    				WHERE kode_kanwil = '$kanwil' 
					AND status='1' 
					AND kode_op = '2'";
		$query_offNop = $this->db->query($sql_offNop)->result();

		//all_OP
		$sql_all = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote 		
    				WHERE kode_kanwil = '$kanwil'
					AND kode_op!=0";
		$query_all = $this->db->query($sql_all)->result();


		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offOp[0]->total;
		$data['off_nop'] = $query_offNop[0]->total;
		$data['all_on'] = $query_onAll[0]->total;
		$data['all'] = $query_all[0]->total;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['all_on'] + $data['off'])*100;
		}
		//var_dump($data);
		return $data;
    }

    function getOnOffKanca($kanca)
    {
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote		
    				WHERE kode_kanca = '$kanca'
					AND status = '3'
					AND kode_tipe_uker NOT IN (0,8,9)
					AND kode_op IN (1,2)";
		$query_onAll = $this->db->query($sql_onAll)->result();

		
		//offlineAllOp
		$sql_offOp = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote		
    				WHERE kode_kanca = '$kanca' 
					AND status='1' 
					AND kode_op = '1'
					AND kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$query_offOp = $this->db->query($sql_offOp)->result();

		//offlineAllNop
		$sql_offNop = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote		
    				WHERE kode_kanca = '$kanca' 
					AND status='1' 
					AND kode_tipe_uker NOT IN (0,8,9)
					AND kode_op = '2'";
		$query_offNop = $this->db->query($sql_offNop)->result();

		//all_OP
		$sql_all = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote		
    				WHERE kode_kanca = '$kanca'
					AND kode_tipe_uker NOT IN (0,8,9)
					AND kode_op != '0'";
		$query_all = $this->db->query($sql_all)->result();


		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offOp[0]->total;
		$data['off_nop'] = $query_offNop[0]->total;
		$data['all_on'] = $query_onAll[0]->total;
		$data['all'] = $query_all[0]->total;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['all_on'] + $data['off'])*100;
		}
		//var_dump($data);
		return $data;
    }

    function getOnOffRemote($kanca,$uker)
    {
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote		
    				WHERE kode_kanca = '$kanca'
					AND status = '3'
					AND kode_tipe_uker = '$uker'
					AND kode_op IN (1,2)";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offOP
		$sql_offOp = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote		
    				WHERE kode_kanca = '$kanca' 
					AND status='1' 
					AND kode_tipe_uker = '$uker'
					AND kode_op = '1'
					AND kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$query_offOp = $this->db->query($sql_offOp)->result();

		//onNOP
		$sql_onNop = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote		
    				WHERE kode_kanca = '$kanca' 
					AND status='1' 
					AND kode_tipe_uker = '$uker'
					AND kode_op = '1'";
		$query_onNop = $this->db->query($sql_onNop)->result();

		//all_OP
		$sql_all = "SELECT COUNT(id_remote) as total
    				FROM v_all_remote		
    				WHERE kode_kanca = '$kanca'
					AND kode_tipe_uker = '$uker'
					AND kode_tipe_uker NOT IN (0,8,9)
					AND kode_op != '0'";
		$query_all = $this->db->query($sql_all)->result();

		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offOp[0]->total;
		$data['off_nop'] = $query_onNop[0]->total;
		$data['all_on'] = $query_onAll[0]->total;
		$data['all'] = $query_all[0]->total;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['all_on'] + $data['off'])*100;
		}
		//var_dump($data);
		return $data;
    }

    function getKanwilLocations()
    {
        $query = "SELECT a.ip_lan as ip,b.ip_address as host,a.latitude as latitude,.longitude as longitude
        			FROM tb_remote a  
        			WHERE a.kode_tipe_uker=1 ";
        $result = $this->db->query($query)->result();
        //var_dump($result);
        //$num_rows = $query->num_rows();
        //return array("all_data"=>$result);
        return $result; 
    }

    function getKancaLocations($kanwil)
    {
        $query = "SELECT a.ip_lan as ip,a.latitude as latitude,a.longitude as longitude,a.kode_tipe_uker
					FROM tb_remote a  
					WHERE a.kode_tipe_uker IN (1,2,2,3,4,5,6,7,8,9,10)
					AND a.kode_kanca IN (SELECT c.kode_kanca FROM tb_kanca c WHERE c.kode_kanwil = '$kanwil') 
					ORDER BY a.kode_tipe_uker ASC";
        $result = $this->db->query($query)->result();
        //var_dump($result);
        //$num_rows = $query->num_rows();
        //return array("all_data"=>$result);
        return $result;
        
    }

    function getCenterKanca($kanwil)
    {
    	$query = "SELECT a.ip_lan as ip,a.latitude as latitude,a.longitude as longitude,a.kode_tipe_uker
					FROM tb_remote a 
					WHERE a.kode_tipe_uker = 1 
					AND a.kode_kanca IN (SELECT c.kode_kanca FROM tb_kanca c WHERE c.kode_kanwil = '$kanwil') 
					ORDER BY a.kode_tipe_uker ASC";
        $result = $this->db->query($query)->result();
        //var_dump($result);
        //$num_rows = $query->num_rows();
        //return array("all_data"=>$result);
        return $result; 
    }

    function getUkerLocations($kanca)
    {
        /*
		$query = "SELECT a.nama_remote,a.ip_lan as ip,a.latitude as latitude,a.longitude as longitude,a.kode_tipe_uker,b.tipe_uker,c.status
					FROM tb_remote a  
					LEFT JOIN tb_tipe_uker b ON a.kode_tipe_uker=b.kode_tipe_uker
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan
					WHERE a.kode_tipe_uker NOT IN (0,1)
					AND a.kode_kanca = '$kanca' 
					ORDER BY a.kode_tipe_uker ASC";
		*/	
		
		$query = "SELECT nama_remote, ip_lan as ip, latitude, longitude, kode_tipe_uker, tipe_uker, `status`
					FROM v_all_remote 
					WHERE kode_tipe_uker NOT IN (0,1)
					AND kode_kanca = '".$kanca."' 
					ORDER BY kode_tipe_uker ASC;";
        $result = $this->db->query($query)->result();
        //var_dump($result);
        //$num_rows = $query->num_rows();
        //return array("all_data"=>$result);
        return $result;
        
    }
	
	function getCenterLocation($kanca)
	{
		$query = "SELECT a.kode_uker, a.latitude, a.longitude FROM tb_remote a  WHERE a.kode_uker = '$kanca';";
		$result = $this->db->query($query)->result();
		return $result;
	}

    function getjarkom($id_remote)
	{

		$data = $this->db->select('*')
					->from('v_all_remote_jarkom')
					->where('id_remote',$id_remote)
					->where('used_status',1)
					->get()->result();

		return $data;
	}
	
	function getjarkombyid($id)
    {
    	$data = $this->db->select('a.*,b.jenis_jarkom,c.nama_provider,c.nickname_provider,e.status')
						->from('tb_jarkom a')
						->join('tb_jenis_jarkom b','b.kode_jenis_jarkom = a.kode_jenis_jarkom','left')
						->join('tb_provider c','c.kode_provider = a.kode_provider','left')
						->join('tb_remote d','d.id_remote = a.id_remote','left')
						->join('tb_remote_status e','e.ip_lan = d.ip_lan','left')
						->where('a.kode_jarkom',$id)
						->where('a.used_status',1)
						->get()->result();
    	return $data;
    }

    function data_all_uker()
    {
    	
		$data = $this->db->select('a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op')
						->from('tb_remote a')
						->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
						->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
						->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
						->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
						->join('tb_op f','f.kode_op = a.kode_op','left')
						->where_in('a.kode_op',array(1,2))
						->order_by("b.status,f.kode_op", "desc")
						->get()->result();
    	
		return $data;
    }

    function data_uker_kanwil($kanwil,$ids)
    {
    	
		$data = $this->db->select('*')
						->from('v_all_remote')
						->where_in('kode_kanwil',$kanwil)
						//->where_in('b.status',array(1,3))
						//->where_in('a.kode_op',array(1,2))
						->get()->result();
    	
		return $data;
    }

    function data_uker_per_kanwil($kanwil,$ids,$status,$kode_tipe_uker,$kode_op)
    {

    	if ($status==1) {

    		if ($kode_op == 2 && !in_array($kode_tipe_uker, array(6,8,9,10,11,12,13))) {

    			$data = $this->db->select('*')
							->from('v_all_remote')
							->where_in('kode_kanca',$ids)
							->where('status',$status)
							->where('kode_tipe_uker',$kode_tipe_uker)
							->where('kode_op',$kode_op)
							->order_by("status,kode_op", "asc")
							->get()->result();
			}else if( in_array($kode_tipe_uker, array(6,8,9,10,11,12,13)) ){

    			$data = $this->db->select('*')
							->from('v_all_remote')
							->where_in('kode_kanca',$ids)
							->where('status',$status)
							->where('kode_tipe_uker',$kode_tipe_uker)
							->where('kode_op',1)
							->order_by("status,kode_op", "asc")
							->get()->result();
				//return $this->db->last_query();
    		}else{
    			$data = $this->db->select('*')
							->from('v_all_remote')
							->where_in('kode_kanca',$ids)
							->where('status',$status)
							->where('kode_tipe_uker',$kode_tipe_uker)
							->order_by("status,kode_op", "asc")
							->get()->result();
    		}
    	
			
    		
    	}else{
    	
			$data = $this->db->select('*')
							->from('v_all_remote')
							->where_in('kode_kanca',$ids)
							->where('status',$status)
							->where('kode_tipe_uker',$kode_tipe_uker)
							->order_by("status,kode_op", "asc")
							->get()->result();

		}
    	
		return $data;
    }

    function data_uker_kanca($kanca)
    {
		$data = $this->db->select('*')
						->from('v_all_remote')
						->where('kode_kanca',$kanca)
						//->where_in('b.status',array(1,3))
						//->where_in('a.kode_op',array(1,2))
						//->order_by("b.status,f.kode_op", "asc")
						->get()->result();
  
		return $data;
    }

    function data_uker($kanca,$tipe_uker)
    {
		$data =  $this->db->select('*')
						->from('v_all_remote')
					->where('kode_tipe_uker',$tipe_uker)
					->where('kode_kanca',$kanca)
					//->where_in('b.status',array(1,3))
					//->where_in('a.kode_op',array(1,2))
					//->order_by("b.status,f.kode_op", "asc")
					->get()->result();

    	
		return $data;
    }

    function getOnOffProviderKanwil_NB($kanwil,$kjj,$kp){
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3'
						AND  a.used_status = 1  
						AND a.brisat = 0
						AND b.kode_op IN (1,2)
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offAll
    	$sql_offAll = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1'
						AND  a.used_status = 1  
						AND a.brisat = 0
						AND b.kode_op = 1
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_tipe_uker NOT IN (6,8,9,10,11,12,13)
						AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1' 
						AND  a.used_status = 1
						AND a.brisat = 0 
						AND b.kode_op = 2
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		$query_onNop = $this->db->query($sql_onNop)->result();


		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offAll[0]->total;
		$data['nop'] = $query_onNop[0]->total;
		//$data['all'] = $query_all[0]->total;

		if ($query_onAll[0]->nama!='') {
			$data['nama'] = $query_onAll[0]->nama;
		}else if($query_offAll[0]->nama!=''){
			$data['nama'] = $query_offAll[0]->nama;
		}else if($query_onNop[0]->nama!=''){
			$data['nama'] = $query_onNop[0]->nama;
		}else{
			$data['nama'] = '';
		}
		
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on'] + $data['off'])*100;
		}
		//var_dump($data);
		if ($data['nama']==NULL) {
			return 0;
		}else{
			return $data;
		}

    }

    function getOnOffProviderKanwil_B($kanwil,$kjj,$kp){
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT
						CONCAT('BRISAT','-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
						AND  a.used_status = 1
						AND a.brisat = 1
						AND b.kode_op IN (1,2)
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offAll
    	$sql_offAll = "SELECT
						CONCAT('BRISAT','-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1'
						AND  a.used_status = 1  
						AND a.brisat = 1
						AND b.kode_op = 1
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_tipe_uker NOT IN (6,8,9,10,11,12,13)
						AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT
						CONCAT('BRISAT','-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1' 
						AND  a.used_status = 1
						AND a.brisat = 1 
						AND b.kode_op = 2
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		$query_onNop = $this->db->query($sql_onNop)->result();

		//all_OP
		// $sql_all = "SELECT
		// 				CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
		// 				FROM tb_jarkom a
		// 				LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
		// 				LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
		// 				LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
		// 				LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
		// 				WHERE c.status ='3' 
		// 				AND b.kode_op = 1
		// 				AND a.kode_jenis_jarkom = '$kjj'
		// 				AND a.kode_provider = '$kp'
		// 				AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		// $query_all = $this->db->query($sql_all)->result();

		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offAll[0]->total;
		$data['nop'] = $query_onNop[0]->total;
		//$data['all'] = $query_all[0]->total;

		if ($query_onAll[0]->nama!='') {
			$data['nama'] = $query_onAll[0]->nama;
		}else if($query_offAll[0]->nama!=''){
			$data['nama'] = $query_offAll[0]->nama;
		}else if($query_onNop[0]->nama!=''){
			$data['nama'] = $query_onNop[0]->nama;
		}else{
			$data['nama'] = '';
		}

		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on'] + $data['off'])*100;
		}
		//var_dump($data);
		if ($data['nama']==NULL) {
			return 0;
		}else{
			return $data;
		}

    }

    function getOnOffProviderKanca_NB($kanca,$kjj,$kp){
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
						AND a.used_status = 1 
						AND a.brisat = 0
						AND b.kode_op IN (1,2)
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca = $kanca";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offAll
    	$sql_offAll = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1' 
						AND a.used_status = 1 
						AND a.brisat = 0 
						AND b.kode_op = 1
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca = $kanca
						AND b.kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1' 
						AND a.used_status = 1  
						AND a.brisat = 0
						AND b.kode_op = 2
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca = $kanca";
		$query_onNop = $this->db->query($sql_onNop)->result();

		//all_OP
		// $sql_all = "SELECT
		// 				CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
		// 				FROM tb_jarkom a
		// 				LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
		// 				LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
		// 				LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
		// 				LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
		// 				WHERE c.status ='3' 
		// 				AND b.kode_op = 1
		// 				AND a.kode_jenis_jarkom = '$kjj'
		// 				AND a.kode_provider = '$kp'
		// 				AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		// $query_all = $this->db->query($sql_all)->result();

		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offAll[0]->total;
		$data['nop'] = $query_onNop[0]->total;
		//$data['all'] = $query_all[0]->total;

		if ($query_onAll[0]->nama!='') {
			$data['nama'] = $query_onAll[0]->nama;
		}else if($query_offAll[0]->nama!=''){
			$data['nama'] = $query_offAll[0]->nama;
		}else if($query_onNop[0]->nama!=''){
			$data['nama'] = $query_onNop[0]->nama;
		}else{
			$data['nama'] = '';
		}

		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on'] + $data['off'])*100;
		}
		//var_dump($data);
		if ($data['nama']==NULL) {
			return 0;
		}else{
			return $data;
		}

    }

    function getOnOffProviderKanca_B($kanca,$kjj,$kp){
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT
						CONCAT('BRISAT','-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
						AND a.used_status = 1 
						AND a.brisat = 1
						AND b.kode_op IN (1,2)
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca = $kanca";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offAll
    	$sql_offAll = "SELECT
						CONCAT('BRISAT','-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1'  
						AND a.used_status = 1 
						AND a.brisat = 1
						AND b.kode_op = 1
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca = $kanca
						AND b.kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1'  
						AND a.used_status = 1 
						AND a.brisat = 1
						AND b.kode_op = 2
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca = $kanca";
		$query_onNop = $this->db->query($sql_onNop)->result();

		//all_OP
		// $sql_all = "SELECT
		// 				CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
		// 				FROM tb_jarkom a
		// 				LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
		// 				LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
		// 				LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
		// 				LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
		// 				WHERE c.status ='3' 
		// 				AND b.kode_op = 1
		// 				AND a.kode_jenis_jarkom = '$kjj'
		// 				AND a.kode_provider = '$kp'
		// 				AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		// $query_all = $this->db->query($sql_all)->result();

		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offAll[0]->total;
		$data['nop'] = $query_onNop[0]->total;
		//$data['all'] = $query_all[0]->total;

		if ($query_onAll[0]->nama!='') {
			$data['nama'] = $query_onAll[0]->nama;
		}else if($query_offAll[0]->nama!=''){
			$data['nama'] = $query_offAll[0]->nama;
		}else if($query_onNop[0]->nama!=''){
			$data['nama'] = $query_onNop[0]->nama;
		}else{
			$data['nama'] = '';
		}

		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on'] + $data['off'])*100;
		}
		//var_dump($data);
		if ($data['nama']==NULL) {
			return 0;
		}else{
			return $data;
		}

    }

    function getOnOffProvider($p,$b,$nick,$jj){
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE a.status_l ='3'  
						AND a.used_status = 1
						AND a.brisat = '$b'
						AND b.kode_op IN (1,2)
						AND a.kode_provider = '$p'
						AND a.kode_jenis_jarkom = '$jj'";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offAll
    	$sql_offAll = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE a.status_l ='1'  
						AND a.used_status = 1
						AND a.brisat = '$b'
						AND b.kode_op = 1
						AND a.kode_provider = '$p'
						AND a.kode_jenis_jarkom = '$jj'
						AND b.kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE a.status_l ='3' 
						AND a.used_status = 1
						AND a.brisat = '$b'
						AND b.kode_op = 2
						AND a.kode_provider = '$p'
						AND a.kode_jenis_jarkom = '$jj'";
		$query_onNop = $this->db->query($sql_onNop)->result();

		//total
		$sql_All = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE a.used_status = 1
						AND a.brisat = '$b'
						AND a.kode_provider = '$p'
						AND a.kode_jenis_jarkom = '$jj'
						AND b.kode_op IN (1,2)";
		$query_All = $this->db->query($sql_All)->result();

		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offAll[0]->total;
		$data['nop'] = $query_onNop[0]->total;
		$data['total'] = $query_All[0]->total;

		if ($p==3 && $b==1 && $jj==1) {
	    	$sql_onAll2 = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
				FROM tb_jarkom a
				LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
				LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
				LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
				LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
				WHERE a.status_l ='3'  
				AND a.used_status = 1
				AND a.brisat = '2'
				AND b.kode_op IN (1,2)
				AND a.kode_provider = '$p'
				AND a.kode_jenis_jarkom = '$jj'";
			$query_onAll2 = $this->db->query($sql_onAll2)->result();

			//offAll
	    	$sql_offAll2 = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
							FROM tb_jarkom a
							LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
							LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE a.status_l ='1'  
							AND a.used_status = 1
							AND a.brisat = '2'
							AND b.kode_op = 1
							AND a.kode_provider = '$p'
							AND a.kode_jenis_jarkom = '$jj'
							AND b.kode_tipe_uker NOT IN (6,8,9,10,11,12,13)";
			$query_offAll2 = $this->db->query($sql_offAll2)->result();


			//total
			$sql_All2 = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
							FROM tb_jarkom a
							LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
							LEFT JOIN tb_remote_status c ON c.ip_lan = a.ip_wan
							LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
							LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
							WHERE a.used_status = 1
							AND a.brisat = '2'
							AND a.kode_provider = '$p'
							AND a.kode_jenis_jarkom = '$jj'
							AND b.kode_op IN (1,2)";
			$query_All2 = $this->db->query($sql_All2)->result();

			$data['on'] = $data['on'] + $query_onAll2[0]->total;
			$data['off'] = $data['off'] + $query_offAll2[0]->total;
			$data['total'] = $data['total'] + $query_All2[0]->total;
		}

		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on'] + $data['off'])*100;
		}
		$data['nickmane_provider'] = $nick;	
		return $data;
		

    }

    function data_uker_disable()
    {
    	$data = $this->db->select('a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op')
							->from('tb_remote a')
							->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
							->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
							->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
							->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
							->join('tb_op f','f.kode_op = a.kode_op','left')
							->where('a.kode_op','0')
							->order_by("a.id_remote", "asc")
							->get()->result();
		return $data;
	}
	
	function data_jarkom_disable()
    {
    	$data = $this->db->select('x.kode_jarkom as koja,a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op')
							->from('tb_jarkom x')
							->join('tb_remote a', 'a.id_remote = x.id_remote','left')
							->join('tb_remote_status b', 'b.ip_lan = x.ip_wan','left')
							->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
							->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
							->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
							->join('tb_op f','f.kode_op = a.kode_op','left')
							->where('x.used_status','0')
							->order_by("a.id_remote", "asc")
							->get()->result();
		return $data;
    }

    function get_tid($id)
    {
    	$data = $this->db->select('tid_atm')
						->from('tb_atm')
						->where('id_remote',$id)
						->get()->result();
    	return $data;
    }

    function uker_prov($kode_provider,$brisat,$kode_jenis_jarkom,$per_page,$start,$search,$order,$sort,$field)
    {
    	$order_by='';
		if ($order>0 && $order!=9 && $order!=11) {
			$order_by=" ORDER BY $field $sort";
		}else if($order_by==''){
			$order_by="";
		}

    	$where = '';
		if ($kode_provider=='' && $brisat==''&& $kode_jenis_jarkom=='') {
			$where = '';
		}else{
			$where = "kode_provider = '$kode_provider' 
					  AND brisat = '$brisat'
					  AND kode_jenis_jarkom = '$kode_jenis_jarkom' AND";
		}

    	if ($search=='') {
    		$data = $this->db->query("SELECT * FROM
										v_list_uker_provider
									WHERE $where used_status = 1
									AND kode_op != 0
									$order_by LIMIT $start,$per_page")->result();
    	}else{
    		$data = $this->db->query("SELECT * FROM
										v_list_uker_provider
									WHERE $where used_status = 1
									AND kode_op != 0
									AND ( kode_jarkom LIKE '%$search%'
									OR nama_remote LIKE '%$search%'
									OR jenis_jarkom LIKE '%$search%'
									OR nama_kanca LIKE '%$search%'
									OR nama_kanwil LIKE '%$search%'
									OR ip_wan LIKE '%$search%'
									OR bandwidth LIKE '%$search%'
									OR tipe_uker LIKE '%$search%'
									OR status_name LIKE '%$search%' )
									$order_by LIMIT $start,$per_page")->result();
    	}
    	
    	return $data;
    }

    function uker_prov_all($kode_provider,$brisat,$kode_jenis_jarkom)
    {
    	$data = $this->db->query("SELECT
									*
								FROM
									v_list_uker_provider
								WHERE kode_provider = '$kode_provider' 
								AND used_status = 1
								AND brisat = '$brisat'
								AND kode_jenis_jarkom = '$kode_jenis_jarkom'
								AND kode_op != 0")->result();
    	
		// $data = $this->db->query("SELECT
		// 							a.*,
		// 							b.nama_remote,
		// 							b.kode_op,
		// 							a.status_l as status,
		// 							f.nama_kanca,
		// 							g.nama_kanwil,
		// 							h.tipe_uker,
		// 							a.status_fail_date_l as status_fail_date,
		// 							a.status_rec_date_l as status_rec_date,
		// 							b.kode_uker
		// 						FROM
		// 							tb_jarkom a
		// 						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
		// 						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
		// 						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom
		// 						LEFT JOIN tb_kanca f ON f.kode_kanca = b.kode_kanca
		// 						LEFT JOIN tb_kanwil g ON g.kode_kanwil = f.kode_kanwil
		// 						LEFT JOIN tb_tipe_uker h ON h.kode_tipe_uker = b.kode_tipe_uker
		// 						WHERE a.kode_provider = '$kode_provider' 
		// 						AND a.used_status = 1
		// 						AND a.brisat = '$brisat'
		// 						AND a.kode_jenis_jarkom = '$kode_jenis_jarkom'
		// 						AND b.kode_op != 0")->result();
    	
    	
    	return $data;
    }

    function uker_prov_total($kode_provider,$brisat,$kode_jenis_jarkom,$search)
    {
    	if ($search=='') {
    		$data = $this->db->query("SELECT
										COUNT(kode_jarkom) as total
									FROM
										v_list_uker_provider
									WHERE kode_provider = '$kode_provider' 
									AND used_status = 1
									AND brisat = '$brisat'
									AND kode_jenis_jarkom = '$kode_jenis_jarkom'
									AND kode_op != 0")->result();
    	}else{
			$data = $this->db->query("SELECT
											COUNT(kode_jarkom) as total
									FROM
										v_list_uker_provider
									WHERE kode_provider = '$kode_provider'
									AND used_status = 1
									AND brisat = '$brisat'
									AND kode_jenis_jarkom = '$kode_jenis_jarkom'
									AND kode_op != 0
									AND ( kode_jarkom LIKE '%$search%'
									OR nama_remote LIKE '%$search%'
									OR jenis_jarkom LIKE '%$search%'
									OR nama_kanca LIKE '%$search%'
									OR nama_kanwil LIKE '%$search%'
									OR ip_wan LIKE '%$search%'
									OR bandwidth LIKE '%$search%'
									OR tipe_uker LIKE '%$search%'
									OR status_name LIKE '%$search%' )
									ORDER BY status ASC")->result();
		}
    	return $data[0]->total;
    }

    function data_uker_all($per_page,$start,$kategori,$search)
    {
    	if ($kategori) {
			$data =  $this->db->select('a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op')
						->from('tb_remote a')
						->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
						->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
						->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
						->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
						->join('tb_op f','f.kode_op = a.kode_op','left')
						->where_in('a.kode_op',array(1,2))
						->like($kategori,$search)
						->limit($per_page,$start)
						->order_by("b.status", "desc")
						->order_by("c.tipe_uker", "asc")
						->get()->result();
    	}else{
			$data =  $this->db->select('a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op')
						->from('tb_remote a')
						->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
						->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
						->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
						->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
						->join('tb_op f','f.kode_op = a.kode_op','left')
						->where_in('a.kode_op',array(1,2))
						->limit($per_page,$start)
						->order_by("b.status", "desc")
						->order_by("c.tipe_uker", "asc")
						->get()->result();
		}

    	
		return $data;
    }

    function data_all_uker_search($per_page,$start,$kategori,$search)
    {
		if ($kategori=='status') {
			if ($search==3) {
				$data = $this->db->select('*')
							 ->from('v_all_remote')
							 ->where_in('kode_op',array(1,2))
							 ->where('status',3)
							 ->limit($per_page,$start)
							 ->get()
							 ->result();
			}else if($search=='1'){
				$data = $this->db->select('*')
							 ->from('v_all_remote')
							 ->where('kode_op',1)
							 ->where('status',1)
							 ->where_not_in('kode_tipe_uker',array(6,8,9,10,11,12,13))
							 ->limit($per_page,$start)
							 ->get()
							 ->result();
			}else if($search=='nop'){
				$data = $this->db->select('*')
							 ->from('v_all_remote')
							 ->where('kode_op',2)
							 //->or_where_in('kode_tipe_uker',array(6,8,9,10,11,12,13))
							 ->where('status',1)
							 ->limit($per_page,$start)
							 ->get()
							 ->result();
			}else if($search=='null'){
				$data = $this->db->select('*')
							 ->from('v_all_remote')
							 ->where('status IS NULL', null, false)
							 ->limit($per_page,$start)
							 ->get()
							 ->result();
			}
		}else if($kategori=='jenis_jarkom' || $kategori=='nickname_provider'){
			$data = $this->db->select('*')
						 ->from('v_all_remote_jarkom')
						 ->where_in('kode_op',array(1,2))
						 ->like($kategori,$search)
						 ->order_by('status','desc')
						 ->limit($per_page,$start)
						 ->get()
						 ->result();
		}else{
	
			$remote = $this->db->select('id_remote')
						 ->from('v_all_remote_jarkom')
						 ->where_in('kode_op',array(1,2))
						 ->like($kategori,$search)
						 ->group_by("id_remote")
						 ->get()
						 ->result();

			if (!empty($remote)) {
				$in = array();
				foreach ($remote as $r) {
					$in[] = $r->id_remote;
				}
				$data = $this->db->select('*')
							 ->from('v_all_remote')
							 ->where_in('id_remote',$in)
							 ->where_in('kode_op',array(1,2))
							 ->limit($per_page,$start)
							 ->get()
							 ->result();
			}else{
				$data = $this->db->select('*')
							 ->from('v_all_remote')
							 ->where('id_remote','')
							 ->where_in('kode_op',array(1,2))
							 ->limit($per_page,$start)
							 ->get()
							 ->result();
			}
				
		}
    	
		return $data;
    }

    function jumlah_uker_all_search($kategori,$search)
    {
    	$data =  $this->db->select('COUNT(a.id_remote) as total')
						->from('tb_remote a')
						->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
						->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
						->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
						->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
						->join('tb_op f','f.kode_op = a.kode_op','left')
						->where_in('a.kode_op',array(1,2))
						->like($kategori,$search)
						->order_by("b.status,f.kode_op", "asc")
						->get()->result();
		return $data[0]->total;
    }

    function jumlah_uker_all_search2($kategori,$search)
    {
		if ($kategori=='status') {
			if ($search==3) {
				$data = $this->db->select('COUNT(id_remote) as total')
							 ->from('v_all_remote_jarkom')
							 ->where_in('kode_op',array(1,2))
							 ->where('status',3)
							 ->group_by("id_remote")
							 ->get()
							 ->result();
			}else if($search=='1'){
				$data = $this->db->select('COUNT(id_remote) as total')
							 ->from('v_all_remote_jarkom')
							 ->where('kode_op',1)
							 ->where('status',1)
							 ->where_not_in('kode_tipe_uker',array(6,8,9,10,11,12,13))
							 ->group_by("id_remote")
							 ->get()
							 ->result();
			}else if($search=='nop'){
				$data = $this->db->select('COUNT(id_remote) as total')
							 ->from('v_all_remote_jarkom')
							 ->where('kode_op',2)
							 //->or_where_in('kode_tipe_uker',array(6,8,9,10,11,12,13))
							 ->where('status',1)
							 ->group_by("id_remote")
							 ->get()
							 ->result();
			}else if($search=='null'){
				$data = $this->db->select('COUNT(id_remote) as total')
							 ->from('v_all_remote_jarkom')
							 ->where('status IS NULL', null, false)
							 ->group_by("id_remote")
							 ->get()
							 ->result();
			}
		}else{
			$data = $this->db->select('COUNT(id_remote) as total')
							 ->from('v_all_remote_jarkom')
							 ->where_in('kode_op',array(1,2))
							 ->like($kategori,$search)
							 ->group_by("id_remote")
							 ->get()
							 ->result();
		}

		//var_dump($data);
		return count($data);
    }

    function getPIC($kanca)
    {
    	$data = $this->db->select('a.pic_pinca,a.pic_spo,a.pet_it,a.kode_kanca,a.nama_kanca,g.pic_kanwil,g.kode_kanwil')
						->from('tb_kanca a')
						->join('tb_kanwil g','g.kode_kanwil = a.kode_kanwil','left')
						->where('a.kode_kanca',$kanca)
						->get()->result(); 
		return $data[0];
    }

    function new_uker_all($per_page,$start,$kategori,$search,$kanwil='',$kanca='',$tipe_uker='',$order='',$sort='',$field='')
    {
    	//return $order.'-'.$sort;
    	if ($search) {
    		if($kategori==''){
    			$order_by='';
    			if ($order>0 && $order!=9 && $order!=11) {
    				$order_by=" ORDER BY $field $sort";
    			}

	    		$remote = $this->db->query("
    						SELECT
								id_remote
							FROM
								v_all_remote_jarkom
							WHERE nama_remote LIKE '%$search%'
							OR nama_kanca LIKE '%$search%'
							OR nama_kanwil LIKE '%$search%'
							OR tipe_uker LIKE '%$search%'
							OR nickname_provider LIKE '%$search%'
							OR jenis_jarkom LIKE '%$search%'
							OR kode_uker LIKE '%$search%'
							OR ip_lan LIKE '%$search%'
							OR nama_remote LIKE '%$search%'
							OR status_name LIKE '%$search%'
							GROUP BY
								id_remote
							LIMIT $start,$per_page")
							->result();
			}else{
				$where = '';
				if ($kategori=='kanwil') {
					$where = "kode_kanwil = '$kanwil' AND ";
				}
				if ($kategori=='kanca') {
					$where = "kode_kanca = '$kanca' AND ";
				}
				if ($kategori=='tipe_uker'){
					$where = "kode_kanca = '$kanca' AND kode_tipe_uker = '$tipe_uker' AND ";
				}
				if ($kategori=='nop') {
					$where = "kode_op_asli = 2";
				}

		    	$order_by='';
    			if ($order>0 && $order!=9 && $order!=11) {
    				$order_by=" ORDER BY $field $sort";
    			}

    			$remote = $this->db->query("
    						SELECT
								id_remote
							FROM
								v_all_remote_jarkom
							WHERE
								$where
							(nama_remote LIKE '%$search%'
							OR nama_kanca LIKE '%$search%'
							OR nama_kanwil LIKE '%$search%'
							OR tipe_uker LIKE '%$search%'
							OR nickname_provider LIKE '%$search%'
							OR jenis_jarkom LIKE '%$search%'
							OR kode_uker LIKE '%$search%'
							OR ip_lan LIKE '%$search%'
							OR nama_remote LIKE '%$search%'
							OR status_name LIKE '%$search%')
							GROUP BY
								id_remote
							LIMIT $start,$per_page")
							->result();
    		}
			//return $this->db->last_query();
			//return count($remote);

			if (!empty($remote)) {
				$in = array();
				foreach ($remote as $r) {
					$in[] = $r->id_remote;
				}
				if ($order>0 && $order!=9 && $order!=11) {
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where_in('id_remote',$in)
							->order_by($field, $sort)
							->get()->result();
    			}else{
					$data =  $this->db->select('*')
							->from('v_all_remote')
							->where_in('id_remote',$in)
							//->order_by("status", "asc")
							//->order_by("tipe_uker", "asc")
							->get()->result();
    			}
			}else{
				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('id_remote','')
							->limit($per_page,$start)
							->get()->result();
			}
			//return $this->db->last_query();

    	}else{
    		if($kategori=='kanwil'){
    			if ($order>0 && $order!=9 && $order!=11) {
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('kode_kanwil',$kanwil)
							->limit($per_page,$start)
							->order_by($field, $sort)
							->get()->result();
    			}else{
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('kode_kanwil',$kanwil)
							->limit($per_page,$start)
							//->order_by("status", "asc")
							//->order_by("tipe_uker", "asc")
							->get()->result();
				}
    		}else if($kategori=='kanca'){
    			if ($order>0 && $order!=9 && $order!=11) {
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('kode_kanca',$kanca)
							->limit($per_page,$start)
							->order_by($field, $sort)
							->get()->result();
    			}else{
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('kode_kanca',$kanca)
							->limit($per_page,$start)
							//->order_by("status", "asc")
							//->order_by("tipe_uker", "asc")
							->get()->result();
				}
    		}else if($kategori=='tipe_uker'){
    			if ($order>0 && $order!=9 && $order!=11) {
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('kode_kanca',$kanca)
							->where('kode_tipe_uker',$tipe_uker)
							->limit($per_page,$start)
							->order_by($field, $sort)
							->get()->result();
    			}else{
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('kode_kanca',$kanca)
							->where('kode_tipe_uker',$tipe_uker)
							->limit($per_page,$start)
							//->order_by("status", "asc")
							//->order_by("tipe_uker", "asc")
							->get()->result();
				}
    		}else if($kategori=='nop'){
    			if ($order>0 && $order!=9 && $order!=11) {
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('kode_op_asli',2)
							->limit($per_page,$start)
							->order_by($field, $sort)
							->get()->result();
    			}else{
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->where('kode_op_asli',2)
							->limit($per_page,$start)
							->get()->result();
				}
    		}else{
    			if ($order>0 && $order!=9 && $order!=11) {
    				$data =  $this->db->select('*')
							->from('v_all_remote')
							->limit($per_page,$start)
							->order_by($field, $sort)
							->get()->result();
    			}else{
					$data =  $this->db->select('*')
							->from('v_all_remote')
							->limit($per_page,$start)
							//->order_by("status", "asc")
							//->order_by("tipe_uker", "asc")
							->get()->result();
    			}
    		}
		}
    	
		//return $this->db->last_query();
		return $data;
    }

    function new_jumlah_uker($kategori='',$kanwil='',$kanca='',$tipe_uker='')
    {
		if($kategori=='kanwil'){
			$data =  $this->db->select('COUNT(id_remote) as total')
						->from('v_all_remote')
						->where('kode_kanwil',$kanwil)
						->get()->result();
		}else if($kategori=='kanca'){
			$data =  $this->db->select('COUNT(id_remote) as total')
						->from('v_all_remote')
						->where('kode_kanca',$kanca)
						->get()->result();
		}else if($kategori=='tipe_uker'){
			$data =  $this->db->select('COUNT(id_remote) as total')
						->from('v_all_remote')
						->where('kode_kanca',$kanca)
						->where('kode_tipe_uker',$tipe_uker)
						->get()->result();
		}else if($kategori=='nop'){
			$data =  $this->db->select('COUNT(id_remote) as total')
						->from('v_all_remote')
						->where('kode_op_asli',2)
						->get()->result();
		}else{
			$this->db->select('count(id_remote) as total');
			$this->db->from('tb_remote');
			$this->db->where_not_in('kode_op',array(0));
	    	$data = $this->db->get()->result();
		}
		//return $this->db->last_query();
    	return $data[0]->total;
    }

    function jumlah_uker_search($search,$kategori='',$kanwil='',$kanca='',$tipe_uker='')
    {

    	if ($kategori=='') {
	    	$data = $this->db->select('COUNT(DISTINCT id_remote) as total')
							 ->from('v_all_remote_jarkom')
							 ->like('nama_remote',$search)
							 ->or_like('nama_kanca',$search)
							 ->or_like('nama_kanwil',$search)
							 ->or_like('tipe_uker',$search)
							 ->or_like('nickname_provider',$search)
							 ->or_like('jenis_jarkom',$search)
							 ->or_like('kode_uker',$search)
							 ->or_like('ip_lan',$search)
							 ->or_like('nama_remote',$search)
							 ->or_like('status_name',$search)
							 ->get()
							 ->result();
    	}else{
    		$where = '';
    		if ($kategori=='kanwil') {
    			$where = "kode_kanwil = '$kanwil' AND ";
    		}
    		if ($kategori=='kanca') {
    			$where = "kode_kanca = '$kanca' AND ";
    		}
    		if ($kategori=='tipe_uker'){
    			$where = "kode_kanca = '$kanca' AND kode_tipe_uker = '$tipe_uker' AND ";
    		}
			if ($kategori=='nop') {
				$where = "kode_op_asli = 2";
			}

	    	$data = $this->db->query("
    						SELECT
								COUNT(DISTINCT id_remote) as total
							FROM
								v_all_remote_jarkom
							WHERE
								$where
							(nama_remote LIKE '%$search%'
							OR nama_kanca LIKE '%$search%'
							OR nama_kanwil LIKE '%$search%'
							OR tipe_uker LIKE '%$search%'
							OR nickname_provider LIKE '%$search%'
							OR jenis_jarkom LIKE '%$search%'
							OR kode_uker LIKE '%$search%'
							OR ip_lan LIKE '%$search%'
							OR nama_remote LIKE '%$search%'
							OR status_name LIKE '%$search%')")
							->result();
    	}
						 //return $this->db->last_query();

		return $data[0]->total;
    }

	function getLocInduk($idremote)
	{
		$sql = "SELECT a.latitude, a.longitude
				FROM tb_remote a
				WHERE kode_uker = ( SELECT b.kode_kanca FROM tb_remote b WHERE b.id_remote = ".$idremote." );";
		$query = $this->db->query($sql)->result();
		return $query;
	}
}
