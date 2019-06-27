<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_scheduler_alarm extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model(array('m_scheduler'));
		
		$this->load->helper('form');
        $this->load->library('session');
		if ($this->session->userdata('username')==null) {
            redirect('login');
        }
	}
	
	public function alarm_count(){
		$now_int = time();
		$now =  date('Y-m-d H:i:s', time());

		//$date = date("Y-m-d H:i:s");
		$time = strtotime($now);
		$time_threshold = $time - (5 * 60);
		$date_threshold = date("Y-m-d H:i:00", $time_threshold);
		$date = date("Y-m-d H:i:00", $time);

		echo $date;

		//$kode_kanwil = "SELECT kode_kanwil,nama_kanwil FROM tb_kanwil ";
		//$result_kode_kanwil = $conn->query($kode_kanwil);

		$insert_dashboard_history = "INSERT INTO dashboard_offline_remote_alarm_history (date_time, down_duration,unack,ack,total_alarm) SELECT date_time, down_duration,unack,ack,total_alarm FROM dashboard_offline_remote_alarm_current";
					

		if ($this->db->query($insert_dashboard_history) === TRUE) {
			echo "INSERTED SUCCESS<br>";
		}


		$delete = "DELETE FROM dashboard_offline_remote_alarm_current WHERE id>0; ";
					if ($this->db->query($delete) === TRUE) {
						echo "DELETED <br>";
					}


			$total_remote_offline_less_1_hour_unack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());
			$total_remote_offline_less_1_hour_ack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-3600)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NOT NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());
			$total_alarm = $total_remote_offline_less_1_hour_unack+$total_remote_offline_less_1_hour_ack;
			$total_remote_offline_less_1_hour = "INSERT INTO dashboard_offline_remote_alarm_current (date_time, down_duration,unack,ack,total_alarm) VALUES ('$date', '0-1',$total_remote_offline_less_1_hour_unack,$total_remote_offline_less_1_hour_ack,$total_alarm);";
					

			if ($this->db->query($total_remote_offline_less_1_hour) === TRUE) {
				echo "insert 1 success<br>";
			}else echo $total_remote_offline_less_1_hour;

			$total_remote_offline_1_4_hour_unack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());
			$total_remote_offline_1_4_hour_ack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-3600)))
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-14400)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NOT NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());
			$total_alarm = $total_remote_offline_1_4_hour_unack+$total_remote_offline_1_4_hour_ack;
			$total_remote_offline_1_4_hour = "INSERT INTO dashboard_offline_remote_alarm_current (date_time, down_duration,unack,ack,total_alarm) VALUES ('$date', '0-4',$total_remote_offline_1_4_hour_unack, $total_remote_offline_1_4_hour_ack, $total_alarm);";
					

			if ($this->db->query($total_remote_offline_1_4_hour) === TRUE) {
				echo "insert 1 success<br>";
			}

			$total_remote_offline_4_12_hour_unack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());	
			$total_remote_offline_4_12_hour_ack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-14400)))
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-43200)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NOT NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());
			$total_alarm = $total_remote_offline_4_12_hour_unack+$total_remote_offline_4_12_hour_ack;
			$total_remote_offline_4_12_hour = "INSERT INTO dashboard_offline_remote_alarm_current (date_time, down_duration,unack,ack,total_alarm) VALUES ('$date', '4-12',$total_remote_offline_4_12_hour_unack, $total_remote_offline_4_12_hour_ack, $total_alarm);";
					
			if ($this->db->query($total_remote_offline_4_12_hour) === TRUE) {
				echo "insert 1 success<br>";
			}	

			$total_remote_offline_12_24_hour_unack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());	
			$total_remote_offline_12_24_hour_ack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-43200)))
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-86400)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NOT NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());	
			$total_alarm = $total_remote_offline_12_24_hour_unack+$total_remote_offline_12_24_hour_ack;
			$total_remote_offline_12_24_hour = "INSERT INTO dashboard_offline_remote_alarm_current (date_time, down_duration,unack,ack,total_alarm) VALUES ('$date', '12-24',$total_remote_offline_12_24_hour_unack, $total_remote_offline_12_24_hour_ack, $total_alarm);";
					
			if ($this->db->query($total_remote_offline_12_24_hour) === TRUE) {
				echo "insert 1 success<br>";
			}	

			$total_remote_offline_1_5_day_unack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());	
			$total_remote_offline_1_5_day_ack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-86400)))
							->where('status_fail_date>=',date("Y-m-d H:i:s", ($now_int-432000)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NOT NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());
			$total_alarm = $total_remote_offline_1_5_day_unack+$total_remote_offline_1_5_day_ack;
			$total_remote_offline_1_5_day = "INSERT INTO dashboard_offline_remote_alarm_current (date_time, down_duration,unack,ack,total_alarm) VALUES ('$date', '24-120',$total_remote_offline_1_5_day_unack, $total_remote_offline_1_5_day_ack, $total_alarm);";
					
			if ($this->db->query($total_remote_offline_1_5_day) === TRUE) {
				echo "insert 1 success<br>";
			}

			$total_remote_offline_more_5_day_unack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());
			$total_remote_offline_more_5_day_ack = count($this->db->select('id_remote')
							->from('v_all_remote')
							->where('status_name','OFFLINE')
							->where('status_fail_date<',date("Y-m-d H:i:s", ($now_int-432000)))
							//tambahan begin
							->where('status_alarm>','0')
							//tambahan end
							->where('id_alarm_type IS NOT NULL', NULL, FALSE)
							->where('status_name<>','NOP')
							->get()->result());
			$total_alarm = $total_remote_offline_more_5_day_unack+$total_remote_offline_more_5_day_ack;
			$total_remote_offline_more_5_day = "INSERT INTO dashboard_offline_remote_alarm_current (date_time, down_duration,unack,ack,total_alarm) VALUES ('$date', '120-',$total_remote_offline_more_5_day_unack, $total_remote_offline_more_5_day_ack, $total_alarm);";
					
			if ($this->db->query($total_remote_offline_more_5_day) === TRUE) {
				echo "insert 1 success<br>";
			}
				


		$i=0;

		$start = time();

		//$conn->close();
		echo "<br>Waktu yang dibutuhkan selama = ".(time()-$now_int)." Detik";
	}
	
}

