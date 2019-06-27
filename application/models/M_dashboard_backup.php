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

    function getOnOffKanwil($kanwil)
    {
    	$data['prosentase']=0;
    	//onlineAll
    	$sql_onAll = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan 		
    				WHERE a.kode_kanca 
					IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil') 
					AND c.status='3'
					AND a.kode_op IN (1,2)";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offlineAllOp
		$sql_offOp = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan 		
    				WHERE a.kode_kanca 
					IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil') 
					AND c.status='1' 
					AND a.kode_op = '1'";
		$query_offOp = $this->db->query($sql_offOp)->result();

		//offlineAllNop
		$sql_offNop = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan 		
    				WHERE a.kode_kanca 
					IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil') 
					AND c.status='1' 
					AND a.kode_op = '2'";
		$query_offNop = $this->db->query($sql_offNop)->result();

		//all_OP
		$sql_all = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan  		
    				WHERE a.kode_kanca 
					IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')
					AND a.kode_op!=0";
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
    	$sql_onAll = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan 		
    				WHERE a.kode_kanca = '$kanca'
					AND c.status = '3'
					AND a.kode_tipe_uker NOT IN (0,8,9)
					AND a.kode_op IN (1,2)";
		$query_onAll = $this->db->query($sql_onAll)->result();

		
		//offlineAllOp
		$sql_offOp = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan 		
    				WHERE a.kode_kanca = '$kanca' 
					AND c.status='1' 
					AND a.kode_op = '1'";
		$query_offOp = $this->db->query($sql_offOp)->result();

		//onlineAllNop
		$sql_offNop = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan 		
    				WHERE a.kode_kanca = '$kanca' 
					AND c.status='3' 
					AND a.kode_tipe_uker NOT IN (0,8,9)
					AND a.kode_op = '2'";
		$query_offNop = $this->db->query($sql_offNop)->result();

		//all_OP
		$sql_all = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan  		
    				WHERE a.kode_kanca = '$kanca'
					AND a.kode_tipe_uker NOT IN (0,8,9)
					AND a.kode_op != '0'";
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
    	$sql_onAll = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a  
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan 		
    				WHERE a.kode_kanca = '$kanca'
					AND c.status = '3'
					AND a.kode_tipe_uker = '$uker'
					AND a.kode_op IN (1,2)";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan 		
    				WHERE a.kode_kanca = '$kanca' 
					AND c.status='3' 
					AND a.kode_tipe_uker = '$uker'
					AND a.kode_op = '2'";
		$query_onNop = $this->db->query($sql_onNop)->result();

		//all_OP
		$sql_all = "SELECT COUNT(a.id_remote) as total
    				FROM tb_remote a 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan  		
    				WHERE a.kode_kanca = '$kanca'
					AND a.kode_tipe_uker = '$uker'
					AND a.kode_op = '1'";
		$query_all = $this->db->query($sql_all)->result();

		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_onNop[0]->total;
		$data['all'] = $query_all[0]->total;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['all'] + $data['off'])*100;
		}
		//var_dump($data);
		return $data;
    }

    function getKanwilLocations()
    {
        $query = "SELECT a.ip_lan as ip,b.ip_address as host,b.latitude as latitude,b.longitude as longitude
        			FROM tb_remote a 
					LEFT JOIN host_location b ON b.ip_address=a.ip_lan 
        			WHERE a.kode_tipe_uker=1 ";
        $result = $this->db->query($query)->result();
        //var_dump($result);
        //$num_rows = $query->num_rows();
        //return array("all_data"=>$result);
        return $result; 
    }

    function getKancaLocations($kanwil)
    {
        $query = "SELECT a.ip_lan as ip,b.ip_address as host,b.latitude as latitude,b.longitude as longitude,a.kode_tipe_uker
					FROM tb_remote a 
					LEFT JOIN host_location b ON b.ip_address=a.ip_lan 
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
    	$query = "SELECT a.ip_lan as ip,b.ip_address as host,b.latitude as latitude,b.longitude as longitude,a.kode_tipe_uker
					FROM tb_remote a 
					LEFT JOIN host_location b ON b.ip_address=a.ip_lan 
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
        $query = "SELECT a.ip_lan as ip,b.ip_address as host,b.latitude as latitude,b.longitude as longitude,a.kode_tipe_uker,c.status
					FROM tb_remote a 
					LEFT JOIN host_location b ON b.ip_address=a.ip_lan 
					LEFT JOIN tb_remote_status c ON c.ip_lan=a.ip_lan
					WHERE a.kode_tipe_uker NOT IN (0,1)
					AND a.kode_kanca = '$kanca' 
					ORDER BY a.kode_tipe_uker ASC";
        $result = $this->db->query($query)->result();
        //var_dump($result);
        //$num_rows = $query->num_rows();
        //return array("all_data"=>$result);
        return $result;
        
    }

    function getjarkom($id_remote)
    {
    	$data = $this->db->select('a.*,b.jenis_jarkom,c.nama_provider,c.nickname_provider,e.status')
						->from('tb_jarkom a')
						->join('tb_jenis_jarkom b','b.kode_jenis_jarkom = a.kode_jenis_jarkom','left')
						->join('tb_provider c','c.kode_provider = a.kode_provider','left')
						->join('tb_remote d','d.id_remote = a.id_remote','left')
						->join('tb_remote_status e','e.id_remote = d.id_remote','left')
						->where('a.id_remote',$id_remote)
						->get()->result();
    	return $data;
    }

    function data_uker_kanwil($kanwil,$ids)
    {
    	
		$data = $this->db->select('a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op,g.tid_atm')
						->from('tb_remote a')
						->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
						->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
						->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
						->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
						->join('tb_op f','f.kode_op = a.kode_op','left')
                        ->join('tb_atm g','a.id_remote = g.id_remote','left')
						->where_in('a.kode_kanca',$ids)
						//->where_in('b.status',array(1,3))
						->where_in('a.kode_op',array(1,2))
						->order_by("b.status,f.kode_op", "asc")
						->get()->result();
    	
		return $data;
    }

    function data_uker_kanca($kanca)
    {
		$data = $this->db->select('a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op,g.tid_atm')
						->from('tb_remote a')
						->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
						->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
						->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
						->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
						->join('tb_op f','f.kode_op = a.kode_op','left')
                        ->join('tb_atm g','a.id_remote = g.id_remote','left')
						->where('a.kode_kanca',$kanca)
						//->where_in('b.status',array(1,3))
						->where_in('a.kode_op',array(1,2))
						->order_by("b.status,f.kode_op", "asc")
						->get()->result();
  
		return $data;
    }

    function data_uker($kanca,$tipe_uker)
    {
		$data =  $this->db->select('a.*,b.status as status_onoff,c.tipe_uker,b.last_update as last_up,b.status_fail_date,b.status_rec_date,d.nama_kanca,e.nama_kanwil,f.keterangan as op')
					->from('tb_remote a')
					->join('tb_remote_status b', 'b.ip_lan = a.ip_lan','left')
					->join('tb_tipe_uker c', 'c.kode_tipe_uker = a.kode_tipe_uker','left')
					->join('tb_kanca d','d.kode_kanca = a.kode_kanca','left')
					->join('tb_kanwil e','e.kode_kanwil = d.kode_kanwil','left')
					->join('tb_op f','f.kode_op = a.kode_op','left')
					->where('a.kode_tipe_uker',$tipe_uker)
					->where('a.kode_kanca',$kanca)
					//->where_in('b.status',array(1,3))
					->where_in('a.kode_op',array(1,2))
					->order_by("b.status,f.kode_op", "asc")
					->get()->result();

    	
		return $data;
    }
    
    function data_kanca($kanca)
    {
        $data =  $this->db->select('nama_kanca')
        ->from('tb_kanca')
        ->where('kode_kanca',$kanca)
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
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
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
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1'  
						AND a.brisat = 0
						AND b.kode_op IN (1,2)
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
						AND a.brisat = 0 
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
		$data['nama'] = $query_onAll[0]->nama;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on']+ $data['nop'] + $data['off'])*100;
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
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
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
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1'  
						AND a.brisat = 1
						AND b.kode_op IN (1,2)
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca IN (SELECT kode_kanca FROM tb_kanca WHERE kode_kanwil='$kanwil')";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT
						CONCAT('BRISAT','-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
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
		$data['nama'] = $query_onAll[0]->nama;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on']+ $data['nop'] + $data['off'])*100;
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
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3'  
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
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1' 
						AND a.brisat = 0 
						AND b.kode_op IN (1,2)
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca = $kanca";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3'  
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
		$data['nama'] = $query_onAll[0]->nama;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on']+ $data['nop'] + $data['off'])*100;
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
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
						AND a.brisat = 1
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
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1'  
						AND a.brisat = 1
						AND b.kode_op IN (1,2)
						AND a.kode_jenis_jarkom = '$kjj'
						AND a.kode_provider = '$kp'
						AND b.kode_kanca = $kanca";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT
						CONCAT(e.jenis_jarkom,'-',d.nickname_provider) AS nama,COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.kode_uker = b.kode_uker
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3'  
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
		$data['nama'] = $query_onAll[0]->nama;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on']+ $data['nop'] + $data['off'])*100;
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
						LEFT JOIN tb_remote_status c ON c.ip_lan = b.ip_lan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3' 
						AND a.brisat = '$b'
						AND b.kode_op IN (1,2)
						AND a.kode_provider = '$p'
						AND a.kode_jenis_jarkom = '$jj'";
		$query_onAll = $this->db->query($sql_onAll)->result();

		//offAll
    	$sql_offAll = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = b.ip_lan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='1' 
						AND a.brisat = '$b'
						AND b.kode_op IN (1,2)
						AND a.kode_provider = '$p'
						AND a.kode_jenis_jarkom = '$jj'";
		$query_offAll = $this->db->query($sql_offAll)->result();

		//onlineAllNop
		$sql_onNop = "SELECT COUNT(a.kode_jarkom) AS total,a.kode_provider
						FROM tb_jarkom a
						LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
						LEFT JOIN tb_remote_status c ON c.ip_lan = b.ip_lan
						LEFT JOIN tb_provider d ON d.kode_provider = a.kode_provider
						LEFT JOIN tb_jenis_jarkom e ON e.kode_jenis_jarkom = a.kode_jenis_jarkom 
						WHERE c.status ='3'
						AND a.brisat = '$b'
						AND b.kode_op = 2
						AND a.kode_provider = '$p'
						AND a.kode_jenis_jarkom = '$jj'";
		$query_onNop = $this->db->query($sql_onNop)->result();

		$data['on'] = $query_onAll[0]->total;
		$data['off'] = $query_offAll[0]->total;
		$data['nop'] = $query_onNop[0]->total;
		if ($data['on']!=0) {
			$data['prosentase'] = $data['on']/($data['on']+ $data['nop'] + $data['off'])*100;
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

}
