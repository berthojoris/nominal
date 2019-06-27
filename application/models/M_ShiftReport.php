<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ShiftReport extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("asia/jakarta");
	}

	public function getSQLTime($interval=null,$period=null,$field=null)
	{
		$params="";
		if( $interval == null || $period ==null || $field==null)
		{
			$params .="NOW() 'time_request' ";
		}else{

			if( $interval < 0)
			{
				$interval = $interval * -1;
				$params .="( NOW()-INTERVAL $interval $period ) '$field' ";
			}else{
				$params .="( NOW()+INTERVAL $interval $period ) '$field' ";
			}
		}

		$qstr = "SELECT ".$params;

		$process = $this->db->query($qstr);

		return $process->result();
		//return $qstr;

	}

	public function UpdateDataListShiftReport($table_name,$field,$condition,$dataBind)
	{
		$fieldData="";
		
		$totalField=count($field);
		for($a=0;$a<$totalField;$a++)
		{
			if( $a == $totalField-1 )
			{
				$fieldData .=$field[$a]."=?";
			}else{
				$fieldData .=$field[$a]."=?,";
			}
		}

		

		
		$qstr = "UPDATE $table_name SET $fieldData $condition ";
		

		if($dataBind == null )
		{
			$process= $this->db->query($qstr);
		}else{
			$process= $this->db->query($qstr,$dataBind);
		}

		return $process;
		//return $qstr;
		
		

	}


	public function insertDataShift($dataBind)
	{
		$qstr = "INSERT into tb_shifting (id_shift,shift_date,shift,user_create,create_at) values (?,?,?,?,?) ";
		$process = $this->db->query($qstr,$dataBind);

		return $process;
	}

	public function getDataListShiftReport($table_name,$field,$condition,$dataBind)
	{
		$fieldData="";
		
		$totalField=count($field);
		for($a=0;$a<$totalField;$a++)
		{
			if( $a == $totalField-1 )
			{
				$fieldData .=$field[$a];
			}else{
				$fieldData .=$field[$a].",";
			}
		}

		//return $fieldData;

		$table="";
		$total_table=count($table_name);

		for($a=0;$a<$total_table;$a++)
		{
			if( $a == $total_table -1 )
			{
				$table.=$table_name[$a];
			}else{
				$table.=$table_name[$a].",";
			}
		}


		if($condition == null)
		{
			$qstr = "SELECT $fieldData from $table";	
		}else{
			$qstr = "SELECT $fieldData from $table $condition";
		}

		if($dataBind == null )
		{
			$process= $this->db->query($qstr);
		}else{
			$process= $this->db->query($qstr,$dataBind);
		}

		return $process->result();
		//return $qstr;
		//return $dataBind;

		

	}
}	