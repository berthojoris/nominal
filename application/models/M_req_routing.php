<?php
class M_req_routing extends CI_Model {

	function GetData_ReqRouting($start='',$length='',$search='',$kategori='')
	{
		$where = '';
		if ($search) {

			if ($kategori=='new') {
				$where = " a.status = 1 AND ";
			}else if ($kategori=='done') {
				$where = " (a.status_open = 3 AND a.status_routing = 3 AND a.status_simcard = 3 AND  a.status = 3) AND ";
			}else if ($kategori=='reqroll') {
				$where = " a.status = 11 AND ";
			}else if ($kategori=='rolldone') {
				$where = " a.status = 13 AND a.status_open > 0 AND ";
			}

			else if ($kategori=='newopen') {
				$where = " a.status_open = 1 AND ";
			}else if ($kategori=='checkopen') {
				$where = " a.status_open = 2 AND ";
			}else if ($kategori=='veropen') {
				$where = " a.status_open = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) AND ";
			}else if ($kategori=='rejopen') {
				$where = " a.status_open = 0 AND ";
			}

			else if ($kategori=='newrout') {
				$where = " a.status_routing = 1 AND ";
			}else if ($kategori=='checkrout') {
				$where = " a.status_routing = 2 AND ";
			}else if ($kategori=='verrout') {
				$where = " a.status_routing = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) AND ";
			}else if ($kategori=='rejrout') {
				$where = " a.status_routing = 0 AND ";
			}

			else if ($kategori=='newsim') {
				$where = " a.status_simcard = 1 AND ";
			}else if ($kategori=='checksim') {
				$where = " a.status_simcard = 2 AND ";
			}else if ($kategori=='versim') {
				$where = " a.status_simcard = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) AND ";
			}else if ($kategori=='rejsim') {
				$where = " a.status_simcard = 0 AND ";
			}

			else if($kategori=='proroll'){
				$where = " a.status = 12 AND ";
			}

			$data = $this->db->query("SELECT a.*,b.nama_remote,b.alamat_uker,b.ip_lan,b.tipe_uker,b.nama_kanwil FROM tb_req_routing a
								LEFT JOIN v_all_remote b ON b.id_remote = a.id_remote
								WHERE $where (b.nama_remote LIKE '%$search%'
								OR a.ip_pool LIKE '%$search%'
								OR b.ip_lan LIKE '%$search%'
								OR b.nama_kanwil LIKE '%$search%'
								OR b.tipe_uker LIKE '%$search%')
								ORDER BY a.update_at DESC
								LIMIT $start,$length")
							 ->result();
		}else{

			if ($kategori=='new') {
				$where = " WHERE a.status = 1 ";
			}else if ($kategori=='done') {
				$where = " WHERE (a.status_open = 3 AND a.status_routing = 3 AND a.status_simcard = 3 AND  a.status = 3) ";
			}else if ($kategori=='reqroll') {
				$where = " WHERE a.status = 11 ";
			}else if ($kategori=='rolldone') {
				$where = " WHERE a.status = 13 AND a.status_open > 0 ";
			}

			else if ($kategori=='newopen') {
				$where = " WHERE a.status_open = 1 ";
			}else if ($kategori=='checkopen') {
				$where = " WHERE a.status_open = 2 ";
			}else if ($kategori=='veropen') {
				$where = " WHERE a.status_open = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) ";
			}else if ($kategori=='rejopen') {
				$where = " WHERE a.status_open = 0 ";
			}

			else if ($kategori=='newrout') {
				$where = " WHERE a.status_routing = 1 ";
			}else if ($kategori=='checkrout') {
				$where = " WHERE a.status_routing = 2 ";
			}else if ($kategori=='verrout') {
				$where = " WHERE a.status_routing = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) ";
			}else if ($kategori=='rejrout') {
				$where = " WHERE a.status_routing = 0 ";
			}

			else if ($kategori=='newsim') {
				$where = " WHERE a.status_simcard = 1 ";
			}else if ($kategori=='checksim') {
				$where = " WHERE a.status_simcard = 2 ";
			}else if ($kategori=='versim') {
				$where = " WHERE a.status_simcard = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) ";
			}else if ($kategori=='rejsim') {
				$where = " WHERE a.status_simcard = 0 ";
			}

			else if($kategori=='proroll'){
				$where = "WHERE a.status = 12 ";
			}

			$data = $this->db->query("
								SELECT a.*,b.nama_remote,b.alamat_uker,b.ip_lan,b.tipe_uker,b.nama_kanwil FROM tb_req_routing a
								LEFT JOIN v_all_remote b ON b.id_remote = a.id_remote
								$where
								ORDER BY a.update_at DESC
								LIMIT $start,$length")
							 ->result();
		}

		return $data;
	}


	function CountData_ReqRouting($search='',$kategori='')
	{

		$where = '';
		if ($search) {

			if ($kategori=='new') {
				$where = " a.status = 1 AND ";
			}else if ($kategori=='done') {
				$where = " (a.status_open = 3 AND a.status_routing = 3 AND a.status_simcard = 3 AND a.status = 3) AND ";
			}else if ($kategori=='reqroll') {
				$where = " a.status = 11 AND ";
			}else if ($kategori=='rolldone') {
				$where = " a.status = 13 AND a.status_open > 0 AND ";
			}

			else if ($kategori=='newopen') {
				$where = " a.status_open = 1 AND ";
			}else if ($kategori=='checkopen') {
				$where = " a.status_open = 2 AND ";
			}else if ($kategori=='veropen') {
				$where = " a.status_open = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) AND ";
			}else if ($kategori=='rejopen') {
				$where = " a.status_open = 0 AND ";
			}

			else if ($kategori=='newrout') {
				$where = " a.status_routing = 1 AND ";
			}else if ($kategori=='checkrout') {
				$where = " a.status_routing = 2 AND ";
			}else if ($kategori=='verrout') {
				$where = " a.status_routing = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) AND ";
			}else if ($kategori=='rejrout') {
				$where = " a.status_routing = 0 AND ";
			}

			else if ($kategori=='newsim') {
				$where = " a.status_simcard = 1 AND ";
			}else if ($kategori=='checksim') {
				$where = " a.status_simcard = 2 AND ";
			}else if ($kategori=='versim') {
				$where = " a.status_simcard = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) AND ";
			}else if ($kategori=='rejsim') {
				$where = " a.status_simcard = 0 AND ";
			}

			else if($kategori=='proroll'){
				$where = " a.status = 12 AND ";
			}

			$data = $this->db->query("SELECT COUNT(a.id) as total FROM tb_req_routing a
								LEFT JOIN v_all_remote b ON b.id_remote = a.id_remote
								WHERE $where (b.nama_remote LIKE '%$search%'
								OR a.ip_pool LIKE '%$search%'
								OR b.ip_lan LIKE '%$search%'
								OR b.nama_kanwil LIKE '%$search%'
								OR b.tipe_uker LIKE '%$search%')")
							 ->result();
		}else{

			if ($kategori=='new') {
				$where = " WHERE a.status = 1 ";
			}else if ($kategori=='done') {
				$where = " WHERE (a.status_open = 3 AND a.status_routing = 3 AND a.status_simcard = 3 AND a.status = 3) ";
			}else if ($kategori=='reqroll') {
				$where = " WHERE a.status = 11 ";
			}else if ($kategori=='rolldone') {
				$where = " WHERE a.status = 13 AND a.status_open > 0 ";
			}

			else if ($kategori=='newopen') {
				$where = " WHERE a.status_open = 1 ";
			}else if ($kategori=='checkopen') {
				$where = " WHERE a.status_open = 2 ";
			}else if ($kategori=='veropen') {
				$where = " WHERE a.status_open = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) ";
			}else if ($kategori=='rejopen') {
				$where = " WHERE a.status_open = 0 ";
			}

			else if ($kategori=='newrout') {
				$where = " WHERE a.status_routing = 1 ";
			}else if ($kategori=='checkrout') {
				$where = " WHERE a.status_routing = 2 ";
			}else if ($kategori=='verrout') {
				$where = " WHERE a.status_routing = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) ";
			}else if ($kategori=='rejrout') {
				$where = " WHERE a.status_routing = 0 ";
			}

			else if ($kategori=='newsim') {
				$where = " WHERE a.status_simcard = 1 ";
			}else if ($kategori=='checksim') {
				$where = " WHERE a.status_simcard = 2 ";
			}else if ($kategori=='versim') {
				$where = " WHERE a.status_simcard = 3 AND a.status<11 AND a.id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    ) ";
			}else if ($kategori=='rejsim') {
				$where = " WHERE a.status_simcard = 0 ";
			}

			else if($kategori=='proroll'){
				$where = "WHERE a.status = 12 ";
			}

			$data = $this->db->query("SELECT COUNT(a.id) as total FROM tb_req_routing a
								LEFT JOIN v_all_remote b ON b.id_remote = a.id_remote
								$where")
							 ->result();
		}
		
		return $data[0]->total;
	}

	function GetUser($user='',$start='',$end='')
	{
		$where = '';
		if ($start!='' && $end!='') {
			$where = " AND b.create_at BETWEEN '$start' AND '$end'";
		}

		$data = $this->db->query("SELECT 
									a.nama,
									COUNT(IF(b.status_description='Verified Open', b.status_description,NULL)) as 'v_open',
									COUNT(IF(b.status_description='Routing Ready', b.status_description,NULL)) as 'routing_r',
									COUNT(IF(b.status_description='Simcard Ready', b.status_description,NULL)) as 'simcard_r',
									COUNT(IF(b.status_description='Request Rollback', b.status_description,NULL)) as 'r_rollback',
									COUNT(IF(b.status_description='Rollback Done', b.status_description,NULL)) as 'rollback_d'
									FROM tb_user a
									LEFT JOIN tb_req_routing_detail b ON b.user_create=a.username
									WHERE b.user_create = '$user' $where")
							 ->result();
		return $data[0];
	}

}
// AND b.create_at BETWEEN '2019-04-18 06:00:00' AND '2019-05-23 00:00:00'
?>