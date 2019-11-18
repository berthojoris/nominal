<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm_operation extends CI_Controller {
    
    public function __construct() 
    {
		parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('url'));
        $this->load->model('m_admoperation');
        $this->load->helper('download');
        $this->load->helper('form');
        $this->load->helper('directory');
		if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function showdetail($id)
    {
        $sql = "SELECT * FROM v_relokasi_edit WHERE id_relokasi = ?";
        $query = $this->db->query($sql, [$id]);
        $this->load->view('pdf/viewdetail', $query->row());
    }

    public function download($fileName)
    {
        $separate = explode("-", $fileName);
        force_download('./filesUpload/sik/'.$separate[0].'/'.$separate[1], NULL);
    }

    public function relokasi()
    {
        if($this->input->method(TRUE) == "POST") {
            add_js('relokasi_filter.js');
            $this->session->unset_userdata('filter_ip_wan');
            $this->session->unset_userdata('filter_provider');
            $this->session->unset_userdata('filter_ip_lan');
            $this->session->unset_userdata('filter_wo_no');
            $this->session->unset_userdata('filter_remote_name');
            $this->session->unset_userdata('filter_req_doc_no');
            $this->session->unset_userdata('filter_status');
            $this->session->unset_userdata('filter_pic');
            $this->session->unset_userdata('filter_order_date');
            $this->session->unset_userdata('filter_live_target');

            $filter_ip_wan = (!empty($_POST['filter_ip_wan'])) ? $_POST['filter_ip_wan'] : '-';
            $filter_provider = (!empty($_POST['filter_provider'])) ? $_POST['filter_provider'] : '-';
            $filter_ip_lan = (!empty($_POST['filter_ip_lan'])) ? $_POST['filter_ip_lan'] : '-';
            $filter_wo_no = (!empty($_POST['filter_wo_no'])) ? $_POST['filter_wo_no'] : '-';
            $filter_remote_name = (!empty($_POST['filter_remote_name'])) ? $_POST['filter_remote_name'] : '-';
            $filter_req_doc_no = (!empty($_POST['filter_req_doc_no'])) ? $_POST['filter_req_doc_no'] : '-';
            $filter_status = (!empty($_POST['filter_status'])) ? $_POST['filter_status'] : '-';
            $filter_pic = (!empty($_POST['filter_pic'])) ? $_POST['filter_pic'] : '-';
            $filter_order_date = (!empty($_POST['filter_order_date'])) ? $_POST['filter_order_date'] : '-';
            $filter_live_target = (!empty($_POST['filter_live_target'])) ? $_POST['filter_live_target'] : '-';

            $this->session->set_userdata('filter_ip_wan', $filter_ip_wan);
            $this->session->set_userdata('filter_provider', $filter_provider);
            $this->session->set_userdata('filter_ip_lan', $filter_ip_lan);
            $this->session->set_userdata('filter_wo_no', $filter_wo_no);
            $this->session->set_userdata('filter_remote_name', $filter_remote_name);
            $this->session->set_userdata('filter_req_doc_no', $filter_req_doc_no);
            $this->session->set_userdata('filter_status', $filter_status);
            $this->session->set_userdata('filter_pic', $filter_pic);
            $this->session->set_userdata('filter_order_date', $filter_order_date);
            $this->session->set_userdata('filter_live_target', $filter_live_target);

            $data['title'] = 'Relokasi';
            $data['page'] = 'Relokasi';
            $this->template->views('adm_operation/relokasi_filter', $data);
        } else {
            add_js('relokasi.js');
            $data['title'] = 'Relokasi';
            $data['page'] = 'Relokasi';
            $this->template->views('adm_operation/relokasi', $data);
        }
    }

    public function saverelokasi()
    {
        $year = date('Y');
        
        $checkFolder = directory_map('./filesUpload/sik/'.$year);
        if(!is_array($checkFolder)) {
            mkdir('./filesUpload/sik/'.$year, 0777, TRUE);
        }

        $config['upload_path']      = './filesUpload/sik/'.$year.'/';
        $config['allowed_types']    = 'pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv';
        $config['max_size']         = '10240';
        $config['overwrite']        = true;
        $config['file_ext_tolower'] = true;
        $config['encrypt_name']     = false;
        $config['remove_spaces']    = true;

        $this->load->library('upload', $config);

        $data = [];

        for ($i=1; $i <=2 ; $i++) {
            if(!empty($_FILES['file_upload_'.$i]['name'])) {
                if(!$this->upload->do_upload('file_upload_'.$i)) {
                    array_push($data, [
                        'error' => $this->upload->display_errors(),
                        'file_name' => $year."-".$this->upload->data()['file_name']
                    ]);
                } else {
                    array_push($data, [
                        'error' => null,
                        'file_name' => $year."-".$this->upload->data()['file_name']
                    ]);
                }
            }
        }

        $insert = [
            'id_jarkom' => $this->input->post('id_jarkom'),
            'id_remote_old' => $this->input->post('id_remote_old'),
            'id_remote_new' => $this->input->post('remote_name_new'),
            'reason' => $this->input->post('reason'),
            'status' => $this->input->post('status'),
            'due_date' => $this->input->post('live_target'),
            'pic' => $this->input->post('pic'),
            'ip_wan_old' => $this->input->post('ip_wan_old'),
            'ip_wan_new' => $this->input->post('ip_wan_new'),
            'req_doc_file' => $data[0]['file_name'],
            'req_doc_no' => $this->input->post('req_doc_no'),
            'req_doc_date' => $this->input->post('req_doc_date'),
            'work_order_file' => $data[1]['file_name'],
            'work_order_no' => $this->input->post('work_order_no'),
            'type_relocate' => $this->input->post('type'),
            'network_id_old' => $this->input->post('network_id_old'),
            'network_id_new' => $this->input->post('network_id_new'),
            'ip_lan_old' => $this->input->post('ip_lan_old'),
            'ip_lan_new' => $this->input->post('ip_lan_new'),
            'remote_name_old' => $this->input->post('remote_name_old'),
            'remote_name_new' => $this->input->post('remote_name_new_val'),
            'address_old' => $this->input->post('remote_address_old'),
            'address_new' => $this->input->post('remote_address_new'),
            'distance' => $this->input->post('distance'),
            'remote_type_old' => $this->input->post('remote_type_old'),
            'remote_type_new' => $this->input->post('remote_type_new'),
            'region_name_old' => $this->input->post('region_old'),
            'region_name_new' => $this->input->post('region_new'),
            'network_type_old' => $this->input->post('network_type_old'),
            'network_type_new' => $this->input->post('network_type_new')
        ];

        if($this->db->insert('tb_relokasi', $insert)) {
            $this->session->set_flashdata('notif_success', 'Relokasi has been created');
        } else {
            $this->session->set_flashdata('notif_error', 'Data has not been created');
        }

        $this->session->set_flashdata('notif_success', 'Relokasi has been created');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function updaterelokasi()
    {
        $year = date('Y');
        
        $checkFolder = directory_map('./filesUpload/sik/'.$year);
        if(!is_array($checkFolder)) {
            mkdir('./filesUpload/sik/'.$year, 0777, TRUE);
        }

        $config['upload_path']      = './filesUpload/sik/'.$year.'/';
        $config['allowed_types']    = 'pdf|jpg|jpeg|png|doc|docx|zip|rar|pdf|xls|xlsx|csv';
        $config['max_size']         = '10240';
        $config['overwrite']        = true;
        $config['file_ext_tolower'] = true;
        $config['encrypt_name']     = false;
        $config['remove_spaces']    = true;

        $this->load->library('upload',$config);

        $data = [];

        for ($i=1; $i <=2 ; $i++) {
            if(!empty($_FILES['edit_file_upload_'.$i]['name'])){
                if(!$this->upload->do_upload('edit_file_upload_'.$i)) {
                    array_push($data, [
                        'error' => $this->upload->display_errors(),
                        'file_name' => $year."-".$this->upload->data()['file_name']
                    ]);
                } else {
                    array_push($data, [
                        'error' => null,
                        'file_name' => $year."-".$this->upload->data()['file_name']
                    ]);
                }
            }
        }

        $update = [
            'id_jarkom' => $this->input->post('edit_id_jarkom_val'),
            'reason' => $this->input->post('edit_reason'),
            'type_relocate' => $this->input->post('edit_type'),
            'status' => $this->input->post('edit_status'),
            'req_doc_no' => $this->input->post('edit_req_doc_no'),
            'req_doc_date' => $this->input->post('req_doc_date'),
            'work_order_no' => $this->input->post('edit_work_order_no'),
            'pic' => $this->input->post('edit_pic'),
            'due_date' => $this->input->post('edit_live_target'),
            'network_id_new' => $this->input->post('edit_network_id_new'),
            'ip_wan_new' => $this->input->post('edit_ip_wan_new'),
            'id_remote_new' => $this->input->post('edit_remote_name_new_id'),
            'remote_name_new' => $this->input->post('edit_remote_name_new_val'),
            'req_doc_file' => $data[0]['file_name'],
            'work_order_file' => $data[1]['file_name'],
            'distance' => $this->input->post('edit_distance'),
            'region_name_old' => $this->input->post('region_old'),
            'region_name_new' => $this->input->post('region_new'),
            'remote_type_old' => $this->input->post('remote_type_old'),
            'remote_type_new' => $this->input->post('remote_type_new'),
            'network_type_old' => $this->input->post('network_type_old'),
            'network_type_new' => $this->input->post('network_type_new')
        ];

        $this->db->where('id', $this->input->post('id_relokasi'));

        if($this->db->update('tb_relokasi', $update)) {
            $this->session->set_flashdata('notif_success', 'Relokasi has been updated');
        } else {
            $this->session->set_flashdata('notif_error', 'Data has not been updated');
        }

        $this->session->set_flashdata('notif_success', 'Relokasi has been created');

        redirect($_SERVER['HTTP_REFERER']);
    }

    function randomString($length = 16) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}
