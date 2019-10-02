<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Remoteticket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('EloquentRemoteTicket');
		$this->load->model('EloquentAlarm');
		$this->load->model('EloquentAlarmType');
		$this->load->library('ticketremedy');
		if ($this->session->userdata('username')==null) {
            redirect('login');
		}
    }

    public function insertTicket()
	{
		if($this->ticketremedy->beforeSubmit($this->input->post('txtIPLan')) == "EMPTY") {
			foreach ($this->input->post('type') as $key => $val) {
				EloquentRemoteTicket::create([
					'type' => $this->input->post('type')[$key],
					'network_status' => ($this->input->post('type')[$key] == 'jarkom') ? $this->input->post('network_status')[$key] : '',
					'id_remote' => $this->input->post('remote_id')[$key],
					'created_at' => date('Y-m-d H:i:s'),
					'user_creator' => $this->session->userdata('nama'),
					'last_check' => $this->input->post('last_check')[$key],
					'status_ticket' => $this->input->post('status_ticket')[$key],
					'incident_number' => $this->input->post('incident_number')[$key],
					'description' => $this->input->post('remote_ticket_description')[$key],
					'notes' => $this->input->post('remote_ticket_description')[$key],
					'ip' => $this->input->post('remote_id')[$key],
					'branch' => '-',
					'ip_address' => '-',
					'nama_uker' => '-',
					'provider_jarkom' => '-',
					'permasalahan' => '-',
					'action' => '-',
					'pic' => '-',
				]);
			}
			$this->session->set_userdata('notif_success', 'done');
		} else {
			$this->session->set_userdata('ticket_created', 'error');
		}

		redirect('Dashboard/new_list_all');
	}

	public function tiketapi()
    {
		$sesIdAlarm = $this->session->userdata('id_alarm');
		$idAlarm = (empty($sesIdAlarm) || is_null($sesIdAlarm)) ? 'EMPTY' : $sesIdAlarm;
		
		if($idAlarm != 'EMPTY') {
			$alarmNotes = EloquentAlarm::where('id', $idAlarm)->first();
			if(!empty($alarmNotes)) {
				if($alarmNotes->id_alarm_type != 0) {
					$output = $alarmNotes->id_alarm_type;
					$alarmType = EloquentAlarmType::where('id', $output)->first()->alarm_type; // Ambil alarm typenya
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