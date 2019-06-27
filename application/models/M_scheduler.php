<?php

class M_scheduler extends CI_Model {

    function get_online($status,$region,$type_remote) {	
		$data = $this->db->select('count(id_remote) as jumlah')
								 ->from('v_all_remote')
								 ->where('kode_tipe_uker',$type_remote)
								 ->where('status',$status)
								 //s->where_in('kode_op',array(1,2))
								 ->where('kode_kanwil',$region)
								 ->get()
								 ->result();
		return $data[0]->jumlah;
    }
	
	function get_offline($status,$region,$type_remote) {	
		//var_dump($type_remote);
		$data = $this->db->select('count(id_remote) as jumlah')
								 ->from('v_all_remote')
								 ->where('kode_tipe_uker',$type_remote)
								 ->where('status',$status)
								 ->where('kode_op','1')
								 ->where_not_in('kode_tipe_uker',array(6,8,9,10,11,12,13))
								 //->where_in('kode_op',array(1,2))
								 //->where_not_in('kode_tipe_uker','6')
								 ->where('kode_kanwil',$region)
								 ->get()
								 ->result();
		return $data[0]->jumlah;
    }
	
	function get_nop($status,$region,$type_remote) {
		if($type_remote==6 || $type_remote== 8 || $type_remote== 9 || $type_remote==10 || $type_remote==11 || $type_remote== 12 || $type_remote==13){
			$data = $this->db->query("SELECT count(id_remote) as jumlah FROM `v_all_remote` WHERE `kode_tipe_uker` = '$type_remote' AND `status` ='$status' AND `kode_kanwil` = '$region' AND `kode_op` <> '0' ")
			//->get()
			->result();
		}else{
			$data = $this->db->query("SELECT count(id_remote) as jumlah FROM `v_all_remote` WHERE `kode_tipe_uker` = '$type_remote' AND `status` ='$status' AND `kode_kanwil` = '$region' AND `kode_op` = '2' ")
			//->get()
			->result();
		}

		/*$data = $this->db->select('count(id_remote) as jumlah')
								 ->from('v_all_remote')
								 ->where('kode_tipe_uker',$type_remote)
								 ->where('status',$status)
								 ->where('kode_kanwil',$region)
								 ->where('kode_op','2')
								 //->or_where('kode_tipe_uker',array(6,8,9,10,11,12,13))
								 ->get()
								 ->result();*/
		return $data[0]->jumlah;
    }
	
	function get_kanwil() {	
		$data = $this->db->select('kode_kanwil as kode_kanwil')
								 ->from('tb_dashboard_pro')
								 ->get()
								 ->result();	
		return $data;
    }

	function get_type_remote() {	
		$data = $this->db->select('*')
								 ->from('tb_tipe_uker')
								 ->get()
								 ->result();	
		return $data;
    }
	
	function set_dashboard($kode_kanwil,$data){
		/* $data = array(
               'title' => $title,
               'name' => $name,
               'date' => $date
            ); */
		
		$this->db->where('kode_kanwil', $kode_kanwil);
		$this->db->update('tb_dashboard_pro', $data); 
	}

	function insert_history_dashboard($date){
		//echo $date;
		$data = $this->db->query("INSERT INTO tb_dashboard_pro_history(flag,pdate,kode_kanwil,kanwil,total_aktif,total_on,total_off,total_nop,KC_on,KC_off,KC_nop, KCP_on,KCP_off,KCP_nop,KK_on,KK_off,KK_nop,UNIT_on,UNIT_off,UNIT_nop,TERAS_on,TERAS_off,TERAS_nop,TERLING_on,TERLING_off,TERLING_nop,EBUZZ_on,EBUZZ_off,EBUZZ_nop,ATM_on,ATM_off,ATM_nop,H2H_on,H2H_off,H2H_nop,percentage_online,KW_on,KW_off,KW_nop,TERPAL_on,TERPAL_off,TERPAL_nop,BRILINK_on,BRILINK_off,BRILINK_nop,LAINNYA_on,LAINNYA_off,LAINNYA_nop, KANINS_on,KANINS_off,KANINS_nop,EDC_on,EDC_off,EDC_nop) SELECT flag,'$date', kode_kanwil,kanwil,total_aktif,total_on,total_off,total_nop,KC_on,KC_off,KC_nop,KCP_on,KCP_off,KCP_nop,KK_on, KK_off,KK_nop,UNIT_on,UNIT_off,UNIT_nop,TERAS_on,TERAS_off,TERAS_nop,TERLING_on,TERLING_off,TERLING_nop,EBUZZ_on,EBUZZ_off,EBUZZ_nop,ATM_on,ATM_off,ATM_nop,H2H_on,H2H_off,H2H_nop,percentage_online,KW_on,KW_off,KW_nop,TERPAL_on,TERPAL_off,TERPAL_nop,BRILINK_on,BRILINK_off,BRILINK_nop,LAINNYA_on,LAINNYA_off,LAINNYA_nop,KANINS_on,KANINS_off,KANINS_nop,EDC_on,EDC_off,EDC_nop FROM tb_dashboard_pro")->result();
		//return $data;
		var_dump($data);
	}
	
}