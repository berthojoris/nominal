<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ApiSimcard extends CI_Model 
{

	public function getDataFileBatch($qstr)
	{
		$process = $this->db->query($qstr);
		return $process->result();
	}

	public function count_data($qstr){

		$process = $this->db->query($qstr);
		return $process->result();
	}

	public function insert_data_batch_excel($data)
	{
		$qstr = "INSERT into tb_excel_batch VALUES(?,?,?,?,?,?)";
		$process = $this->db->query($qstr,$data);

		return $process;
	}

	public function UpdateDataSimCard($data,$page)
	{
		if($page=="search_device_ui"){
			//$qstr = "UPDATE tb_simcard set kondisi_simcard=?,kode_replacement=?,tid=?,kode_uker=?,pic=?,id_remote=?,kota=?,sn=?,modem_id=?,user_create=?,user_update=?,create_at=?,update_at=? where iccid=?";
			$qstr = "UPDATE tb_simcard set kondisi_simcard=?,kode_replacement=?,tid=?,kode_uker=?,pic=?,id_remote=?,kota=?,sn=?,modem_id=? where iccid=?";	
		}

		if($page=="master_iccid_number"){
			$qstr = "UPDATE tb_simcard set iccid=?,ip_address=?,msisdn=?,imsi=?,user_update=?,update_at=? where id=?";
		}
		
		$process = $this->db->query($qstr,$data);
		return $process;
	}

	public function getAccess($iccid)
	{
		$qstr = "SELECT tb_simcard_api.username , tb_simcard_api.key , tb_simcard_api.apn from tb_simcard,tb_simcard_api where tb_simcard.apn = tb_simcard_api.apn and tb_simcard.kode_provider = tb_simcard_api.kode_provider and tb_simcard.iccid=? ";
		$process = $this->db->query($qstr,[$iccid]);
		return $process->result();
		//return $qstr;
	}
	

	public function backupDataSimcard($data)
	{
		
		$qstr = "insert into tb_simcard_replacement (kode_replacement,id_simcard,user_create,create_at) values(?,?,?,?)";
		$process = $this->db->query($qstr,[ $data['kode_replacement'],$data['id_simcard'],$data['user_create'],$data['create_at'] ] );
		return $process;
		
	}

	public function changeStatusSimcard($data_simcard,$status)
	{
		$qstr = "update tb_simcard set status_simcard=?,kode_replacement=?,user_create=?,create_at=? where id=?";
		$process = $this->db->query($qstr,[ $status,$data_simcard['kode_replacement'],$data_simcard['user_create'],$data_simcard['create_at'],$data_simcard['id_simcard'] ]);
		return $process;
	}


	public function checkingDataIccid($checkingData=null,$dataId=null)
	{
		if($dataId==null){
			$qstr = "SELECT id from tb_simcard where iccid =?";
			$process = $this->db->query($qstr,[$checkingData]);	
		}else{
			$qstr = "SELECT * from tb_simcard where id =?";
			$process = $this->db->query($qstr,[$dataId]);
		}
		
		return $process->result();
	
	}


	public function getDataICCID($dataQuery = null,$dataBind = null)
	{
		if($dataQuery == null){
			$qstr = "SELECT * from tb_simcard";	
		}else{
			$qstr = $dataQuery;
		}
		
		if($dataBind == null)
		{
			$process = $this->db->query($qstr);	
		}else{
			$process = $this->db->query($qstr,$dataBind);
		}

		
		return $process->result();
	}

	/*public function getAccess($iccid)
	{
		$qstr = "SELECT tb_simcard_api.username,tb_simcard_api.key from tb_simcard,tb_simcard_api where tb_simcard.apn = tb_simcard_api.apn and tb_simcard.kode_provider = tb_simcard_api.kode_provider and tb_simcard.iccid=?";
		$process = $this->db->query($qstr,[$iccid]);
		return $process->result();
	}*/
}

?>	