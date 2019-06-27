<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
   
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->userdata('username')==null) {
            redirect('login');
        }
    }
   
    function index() {   
        if ($this->session->userdata('role')==6) {
            $data['record'] = $this->db->select('a.*,b.nama_role')
                                ->from('tb_user a')
                                ->join('tb_role b','b.id_role=a.role','left')
                                ->where('kode_kanwil',$this->session->userdata('kanwil'))
                                ->get()->result();    
        }else if($this->session->userdata('role')==1){
            $data['record'] = $this->db->select('a.*,b.nama_role')
                                ->from('tb_user a')
                                ->join('tb_role b','b.id_role=a.role','left')
                                ->where_not_in('id',array($this->session->userdata('id')))
                                ->get()->result();
        } 
       
        $data['page'] = 'user';
        $data['title'] = 'User Management';
        $this->template->views('user/view',$data);
    }

    function add() {
        if(isset($_POST['submit'])) {
        	//echo "<script>alert('tes')</script>";
            
            if(in_array($_POST['role'],array(1,2,3,5,10))){
                $data   =   array(  
                    'nama' 			=>  $_POST['nama'],
                    'username'      =>  $_POST['username'],
                    'password'      =>  md5($_POST['password']),
                    'email'  		=>  $_POST['email'],
                    'kode_provider' =>  $_POST['provider'],
                    'jabatan'       =>  $_POST['jabatan'],
                    'role'          =>  $_POST['role'],
                    'nomor_hp'      =>  $_POST['no_hp'],
                    'pass_asli'      => $_POST['password']
                );
            }else{
                $data   =   array(  
                    'nama' 			=>  $_POST['nama'],
                    'username'      =>  $_POST['username'],
                    'password'      =>  md5($_POST['password']),
                    'email'  		=>  $_POST['email'],
                    'kode_kanwil'   =>  $_POST['kanwil'],
                    'kode_kanca'    =>  $_POST['kanca'],
                    'kode_provider' =>  $_POST['provider'],
                    'jabatan'       =>  $_POST['jabatan'],
                    'role'          =>  $_POST['role'],
                    'nomor_hp'      =>  $_POST['no_hp'],
                    'pass_asli'      => $_POST['password']
                );
            }
            $cek = $this->db->get_where('tb_user',array('username'=>$_POST['username']))->result();
            if ($cek){
                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Username Has Been Used');
                    window.location.href='".site_url('User/add')."';
                    </script>");
            }else{
            	$this->db->insert('tb_user',$data);
                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Success Save User');
                    window.location.href='".site_url('User')."';
                    </script>");
            }
        }
        else {    
        	$data['kanwil'] = $this->db->select('*')->from('tb_kanwil')->order_by('nama_kanwil','asc')->get()->result();
        	$data['provider'] = $this->db->get('tb_provider')->result();
            $data['role'] = $this->db->get('tb_role')->result();
        	$data['page'] = 'user';   
            $data['title'] = 'User Management';     
            $this->template->views('user/insert',$data);
        }
    }

    function edit()
    {
        if(isset($_POST['submit']))
        {
            if(in_array($_POST['role'],array(1,2,3,5,10))){
                $data   =   array(  
                    'nama' 			=>  $_POST['nama'],
                    'username'      =>  $_POST['username'],
                    'password'      =>  md5($_POST['password']),
                    'email'  		=>  $_POST['email'],
                    'kode_provider' =>  $_POST['provider'],
                    'jabatan'       =>  $_POST['jabatan'],
                    'role'          =>  $_POST['role'],
                    'nomor_hp'      =>  $_POST['no_hp'],
                    'pass_asli'      => $_POST['password']
                );
            }else{
                $data   =   array(  
                    'nama' 			=>  $_POST['nama'],
                    'username'      =>  $_POST['username'],
                    'password'      =>  md5($_POST['password']),
                    'email'  		=>  $_POST['email'],
                    'kode_kanwil'   =>  $_POST['kanwil'],
                    'kode_kanca'    =>  $_POST['kanca'],
                    'kode_provider' =>  $_POST['provider'],
                    'jabatan'       =>  $_POST['jabatan'],
                    'role'          =>  $_POST['role'],
                    'nomor_hp'      =>  $_POST['no_hp'],
                    'pass_asli'      => $_POST['password']
                );
            }
            //$cek = $this->db->select('tb_user')->where('username',$data['username']);
            //if ($cek){
            	//echo "<script>alert('Username sudah ada')</script>";
            	//redirect('user/edit/'.$_POST['id']);
            //}else{
            	$this->db->where('id',$_POST['id']);
	            $this->db->update('tb_user',$data);
            	$response = true;
            	//return $response;
            	//echo "<script>alert('Data Disimpan')</script>";
            	redirect('user');
            //}
            
        }
        else {  
        	$data['kanwil'] = $this->db->select('*')->from('tb_kanwil')->order_by('nama_kanwil','asc')->get()->result();
        	$data['provider'] = $this->db->get('tb_provider')->result();
        	$id= $this->uri->segment(3);
            $data['record']=  $this->db->get_where('tb_user',array('id'=> $id))->row_array();
            $data['role'] = $this->db->get('tb_role')->result();
        	$data['page'] = 'user'; 
            $data['title'] = 'User Management';       
            $this->template->views('user/edit',$data);
        }
    }

    function delete($id)
    {
    	$this->db->where('id',$id);
		$this->db->delete('tb_user');
       	redirect('user');
    }

    function edit_pass()
    {
       //$new_pass = $_POST['pass1'];
        $data   =   array(  
            'password'      =>  md5($_POST['pass1'])
            //'pass_asli'      => $_POST['pass1']
        );

        $this->db->where('id',$_POST['id']);
        $this->db->update('tb_user',$data);
        //var_dump($data);
        $response = true;

        echo $response;
    }

    function map(){
    	$data['page'] = 'home';
    	$this->template->views('map',$data);
    }
}

