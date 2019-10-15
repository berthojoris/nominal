<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remoteticket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->library('ticketremedy');
		if ($this->session->userdata('username')==null) {
            redirect('login');
		}
    }

    public function insertTicket()
	{
		// if($this->ticketremedy->beforeSubmit($this->input->post('txtIPLan')) == "EMPTY") {
			
		// } else {
		// 	$this->session->set_flashdata('ticket_created', 'Ticket have been made before');
		// }

		foreach ($this->input->post('type') as $key => $val) {
			if($this->input->post('type')[$key] == 'remote') {
				$dataToInsert = [
					'network_status' => $this->input->post('type')[$key],
					'id_remote' => $this->session->idRemote,
					'created_at' => date('Y-m-d H:i:s'),
					'user_creator' => $this->session->userdata('nama'),
					'last_check' => $this->input->post('last_check')[$key],
					'status_ticket' => $this->input->post('status_ticket')[$key],
					'incident_number' => $this->input->post('incident_number')[$key],
					'description' => $this->input->post('remote_ticket_description')[$key],
					'notes' => $this->input->post('remote_ticket_notes')[$key],
					'ip_lan' => $this->input->post('ip_lan_wan')[$key],
					'branch' => '-',
					'ip_address' => '-',
					'nama_uker' => '-',
					'provider_jarkom' => '-',
					'permasalahan' => '-',
					'action' => '-',
					'pic' => '-',
				];
				$this->db->insert('tb_remote_ticket', $dataToInsert);
			} else {
				$dataToInsert = [
					'network_status' => $this->input->post('type')[$key],
					'id_remote' => $this->session->idRemote,
					'created_at' => date('Y-m-d H:i:s'),
					'user_creator' => $this->session->userdata('nama'),
					'last_check' => $this->input->post('last_check')[$key],
					'status_ticket' => $this->input->post('status_ticket')[$key],
					'incident_number' => $this->input->post('incident_number')[$key],
					'description' => $this->input->post('remote_ticket_description')[$key],
					'notes' => $this->input->post('remote_ticket_notes')[$key],
					'ip_wan' => $this->input->post('ip_lan_wan')[$key],
					'branch' => '-',
					'ip_address' => '-',
					'nama_uker' => '-',
					'provider_jarkom' => '-',
					'permasalahan' => '-',
					'action' => '-',
					'pic' => '-',
				];
				$this->db->insert('tb_network_ticket', $dataToInsert);
			}
		}
		$this->session->set_flashdata('notif_success', 'Success create ticket');

		redirect($this->session->redirectBack, 'refresh');
	}

	public function tiketapi()
    {
		$sesIdAlarm = $this->session->userdata('id_alarm');
		$idAlarm = (empty($sesIdAlarm) || is_null($sesIdAlarm)) ? 'EMPTY' : $sesIdAlarm;
		
		if($idAlarm != 'EMPTY') {
			$alarmNotes = $this->db->select('*')->from('tb_alarm')->where('id', $idAlaram)->get()->row();
			if(!empty($alarmNotes)) {
				if($alarmNotes->id_alarm_type != 0) {
					$at = $alarmNotes->id_alarm_type;
            		$output = $this->db->select('*')->from('tb_alarm_type')->where('id', $at)->get()->row();
				} else {
					$output = 'EMPTY'; //Jika di tabel tb_alarm, id_alarm_type = 0
				}
			} else {
				$output = 'EMPTY'; //Jika di tabel tb_alarm, data tidak ditemukan
			}	
		} else {
			echo $this->ticketremedy->getTicketRemedy($this->uri->segment(3), 'EMPTY');
		}
	}
	
	public function createticket()
    {
		$description = $_POST['description'];
		$notes = $_POST['notes'];
		echo $this->ticketremedy->postTicketRemedy($this->uri->segment(3), $description, $notes);
    }
    
    public function getNetworkDetail()
	{
		echo json_encode($this->session->userdata('data_combo'));
	}
    
}