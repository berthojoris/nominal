<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_apiSimcard extends CI_Model 
{

	public function UpdateDataSimCard($data)
	{
		$qstr = "UPDATE tb_simcard set kondisi_simcard=?,kode_replacement=?,tid=?,kode_uker=?,pic=?,id_remote=?,kota=?,sn=?,modem_id=?,user_create=?,user_update=?,create_at=?,update_at=? where iccid=?";
		$process = $this->db->query($qstr,$data);
		return $process;
	}

	public function getAccess($iccid)
	{
		$qstr = "SELECT tb_simcard_api.username , tb_simcard_api.key from tb_simcard,tb_simcard_api where tb_simcard.apn = tb_simcard_api.apn and tb_simcard.kode_provider = tb_simcard_api.kode_provider and tb_simcard.iccid=? ";
		$process = $this->db->query($qstr,[$iccid]);
		return $process->result();
		//return $iccid;
	}
	

	public function backupDataSimcard($data)
	{
		$qstr = "insert into tb_inq_iccid (id,iccid,ip,msisdn,imsi) values(?,?,?,?,?)";
		//$process = $this->db->query($qstr,[$data]);
		$process = $this->db->query($qstr,[ $data['id'],$data['iccid'],$data['ip'],$data['msisdn'],$data['imsi'] ]);
		return $process;
	}

	public function changeStatusSimcard($id,$status)
	{
		$qstr = "update tb_iccid set status=? where id=?";
		$process = $this->db->query($qstr,[$status,$id]);
		return $process;
	}

	public function getDataICCID(string $dataQuery = null,array $bind=null)
	{
		if($dataQuery == null){
			$qstr = "SELECT * from tb_simcard";	
		}else{
			$qstr = $dataQuery;
		}

		if($bind !=null)
		{
			$process = $this->db->query($qstr,$bind);	
		}else{
			$process = $this->db->query($qstr);
		}
		
		// $process = $this->db->query($qstr);
		return $process->result();
		//$process = $this->db->query($qstr);
		//return $bind;



	}

	public function checkingDataIccid($checkingData=null,$dataId=null)
	{
		if($dataId==null){
			$qstr = "SELECT id from tb_iccid where iccid =?";
			$process = $this->db->query($qstr,[$checkingData]);	
		}else{
			$qstr = "SELECT * from tb_iccid where id =?";
			$process = $this->db->query($qstr,[$dataId]);
		}
		
		return $process->result();
		//return $qstr; 
	}



	public function insertDataIccid($param)
	{
		$qstr = "INSERT into tb_iccid (iccid,ip,msisdn,imsi) values (?,?,?,?)";
		$process = $this->db->query($qstr,$param);
		return $process;
		//return $qstr; 
	}



}

?>	