<?php
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        //session_start();
        $this->load->library('session');
        $this->load->model(array('m_user'));
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }
    }
    function index() {
        $this->load->view('login');
    }

    function proses() {
        $usr = $this->input->post('username');
        $psw = $this->input->post('password');
        //$u = mysql_real_escape_string($usr);
        //$p = md5($psw);
        $cek = $this->m_user->cek($usr, $psw);
        if ($cek->num_rows() > 0) {
            //login berhasil, buat session
            foreach ($cek->result() as $qad) {
                $sess_data['id'] = $qad->id;
                $sess_data['nama'] = $qad->nama;
                $sess_data['username'] = $qad->username;
                $sess_data['role'] = $qad->role;
                $sess_data['provider'] = $qad->kode_provider;
                $sess_data['kanwil'] = $qad->kode_kanwil;
                $sess_data['kanca'] = $qad->kode_kanca;
                $query = $this->db->select('nama_role')
                                ->from('tb_user a')
                                ->join('tb_role b','b.id_role=a.role','left')
                                ->where('role',$qad->role)
                                ->get()->result();
                $sess_data['nama_role'] = $query[0]->nama_role;
                $this->session->set_userdata($sess_data);

                $time = date('Y-m-d H:i:s');
                $data = array('last_login' => $time);
                $this->db->where('id',$qad->id);
                $this->db->update('tb_user',$data);
            }
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
            redirect('login');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
