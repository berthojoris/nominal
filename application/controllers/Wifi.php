<?php
class Wifi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_wifi'));
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }
    
    public function index() {
        $data['page'] = 'wifi';
        $data['title'] = 'Wifi Complaint';
        $this->template->views('Wifi/input',$data);
    }
    
    public function Chat($id='') {
        $data['id_complaint'] = $id;


        $complaint = $this->db->select("*")
                                 ->from('v_complaint_wifi')
                                 ->where('id',$id)
                                 ->get()->result();
        $data['complaint'] = $complaint[0];

        $data['page'] = 'wifi';
        $data['title'] = 'Wifi Complaint';
        $this->template->views('Wifi/chat',$data);
    }

    public function SaveComplaint()
    {
        if(isset($_POST['complaint'])){
            $data  = array(
                'complaint' => $_POST['complaint'],
                'complaint_detail' => $_POST['complaint_detail'],
                'user_contact' => $_POST['contact'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s'),
                'status_complaint' => 1
            );

            $return = $this->db->insert('tb_wifi_complaint',$data);
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }

            echo json_encode($return);
        }
    }

    public function GetComplaint()
    {
        $columns = array("No","Id Complaint","Complaint","Status","Action"); // data array columns harus sama dengan data header table yang tadi di buat di view

        $start=$this->input->post("start");//0
        $length=$this->input->post("length");//10
        $order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
        $sort = $this->input->post("order[0][dir]"); // asc
        $cari_data = $this->input->post("search[value]");
        
        if(empty($cari_data)){
            $datauker = $this->M_wifi->GetData_Complaint($start,$length,'');
            $total = $this->M_wifi->CountData_Complaint();
        }else{
            $datauker = $this->M_wifi->GetData_Complaint($start,$length,$cari_data);
            $total = $this->M_wifi->CountData_Complaint($cari_data);
        }    

        //var_dump($datauker);die();
        //var_dump($total);die();

        $array_data =array();

        $no=$start+1;
        foreach ($datauker as $key) {
            
            $data["No"]=$no;
            $data["Id Complaint"]=$key->id;
            $data["Complaint"]=$key->complaint_name;
            $data["Status"]='';
            if($key->status_complaint == 1){
                $data["Status"].='<span class="label label-danger">'.$key->status.'</span><br>';
            }else if($key->status_complaint == 2){
                $data["Status"].='<span class="label label-warning">'.$key->status.'</span><br>';
            }else if($key->status_complaint == 3){
                $data["Status"].='<span class="label label-primary">'.$key->status.'</span><br>';
            }else if($key->status_complaint == 4){
                $data["Status"].='<span class="label label-success">'.$key->status.'</span><br>';
            }

            $data["Action"]='<a href="'.base_url().'index.php/Wifi/Chat/'.$key->id.'"><button type="button" class="btn btn-block btn-primary btn-xs" style="width: 100px"><i class="fa fa-book"></i> Detail</button></a>';
            
            array_push($array_data,$data);
            $no++;

        }


        //settingan terpenting dari datatable

        $output=array(

            "draw"=>intval($this->input->post("draw")),
            "recordsTotal"=>intval($total),
            "recordsFiltered"=>intval($total),
            "data"=>$array_data
        );

        echo json_encode($output);
    }

    public function GetComment()
    {
        $id_complaint = $_POST['id_complaint'];

        $data['data'] = $this->db->select('a.*,b.nama')
                                 ->from('tb_wifi_comment a')
                                 ->join('tb_user b','b.username = a.user_create','left')
                                 ->where('id_wifi_complaint',$id_complaint)
                                 ->get()->result();

        //echo "string";

        $this->load->view('Wifi/boxchat',$data);
    }

    public function SaveComment()
    {
        if(isset($_POST['message'])){
            $cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

            if ($cek[0]->status_complaint==1) {
                $this->db->set('status_complaint',2)->where('id',$_POST['id_complaint'])->update('tb_wifi_complaint');
            }

            $data  = array(
                'comment' => $_POST['message'],
                'id_wifi_complaint' => $_POST['id_complaint'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s')
            );

            $return = $this->db->insert('tb_wifi_comment',$data);
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }

            echo json_encode($return);
        }
    }

    public function ReqClose()
    {
        $cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

        if($cek[0]->status_complaint<3){

            $data  = array(
                'comment' => '[Request Closed by '.$this->session->userdata('username').']',
                'id_wifi_complaint' => $_POST['id_complaint'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('tb_wifi_comment',$data);

            $return = $this->db->set('status_complaint',3)->where('id',$_POST['id_complaint'])->update('tb_wifi_complaint');
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }
        }else{
            $return = false;
        }

        echo json_encode($return);
    }

    public function RejectReq()
    {
        $cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

        if($cek[0]->status_complaint==3){

            $data  = array(
                'comment' => '[Reject Request Closed by '.$this->session->userdata('username').']',
                'id_wifi_complaint' => $_POST['id_complaint'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('tb_wifi_comment',$data);

            $return = $this->db->set('status_complaint',2)->where('id',$_POST['id_complaint'])->update('tb_wifi_complaint');
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }
        }else{
            $return = false;
        }

        echo json_encode($return);
    }

    public function Close()
    {
        $cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

        if($cek[0]->status_complaint==3){   

            $data  = array(
                'comment' => '[Closed by '.$this->session->userdata('username').']',
                'id_wifi_complaint' => $_POST['id_complaint'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('tb_wifi_comment',$data);

            $return = $this->db->set('status_complaint',4)->where('id',$_POST['id_complaint'])->update('tb_wifi_complaint');
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }
        }else{
            $return = false;
        }

        echo json_encode($return);
    }

    public function GetStatus()
    {
        $complaint = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

        echo $complaint[0]->status_complaint;
    }



    public function ReqPending()
    {
        $cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

        if($cek[0]->status_complaint<3){

            $data  = array(
                'comment' => '[Request Pending by '.$this->session->userdata('username').'] '.$_POST['note'],
                'id_wifi_complaint' => $_POST['id_complaint'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('tb_wifi_comment',$data);

            $return = $this->db->set('status_complaint',11)->where('id',$_POST['id_complaint'])->update('tb_wifi_complaint');
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }
        }else{
            $return = false;
        }

        echo json_encode($return);
    }


    public function ApprovePending()
    {
        $cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

        if($cek[0]->status_complaint==11){

            $data  = array(
                'comment' => '[Approve Pending by '.$this->session->userdata('username').']',
                'id_wifi_complaint' => $_POST['id_complaint'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('tb_wifi_comment',$data);

            $return = $this->db->set('status_complaint',12)->where('id',$_POST['id_complaint'])->update('tb_wifi_complaint');
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }
        }else{
            $return = false;
        }

        echo json_encode($return);
    }


    public function RejectPending()
    {
        $cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

        if($cek[0]->status_complaint==11){

            $data  = array(
                'comment' => '[Reject Pending by '.$this->session->userdata('username').']',
                'id_wifi_complaint' => $_POST['id_complaint'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('tb_wifi_comment',$data);

            $return = $this->db->set('status_complaint',2)->where('id',$_POST['id_complaint'])->update('tb_wifi_complaint');
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }
        }else{
            $return = false;
        }

        echo json_encode($return);
    }


    public function StopPending()
    {
        $cek = $this->db->select("*")
                                 ->from('tb_wifi_complaint')
                                 ->where('id',$_POST['id_complaint'])
                                 ->get()->result();

        if($cek[0]->status_complaint==12){

            $data  = array(
                'comment' => '[Stop Pending by '.$this->session->userdata('username').']',
                'id_wifi_complaint' => $_POST['id_complaint'],
                'user_create' => $this->session->userdata('username'),
                'create_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('tb_wifi_comment',$data);

            $return = $this->db->set('status_complaint',2)->where('id',$_POST['id_complaint'])->update('tb_wifi_complaint');
            if ($return) {
                $return = true;
            }else{
                $return = false;
            }
        }else{
            $return = false;
        }

        echo json_encode($return);
    }

    function UploadImage(){

        //$data_file = $_FILES['file']['tmp_name'];
        $fileName=$_FILES['file_image']['name'];

        $nama =  base64_encode($fileName).date('Ymd')."".date('His');
        // $tempData=$_FILES['file']['tmp_name'];
        // $ranNumb=rand(0,99);
        // $newFileName=date('Y-m-d')."_".date('H:i:s')."-".$ranNumb."-".$fileName;
        // $newDestination = "./filesUpload/Image_comment";

        // $upload_process = move_uploaded_file($tempData, "$newDestination/$newFileName");

        // echo $upload_process;
        $config['file_name'] = $nama;
        $config['upload_path'] = './filesUpload';///Image_comment';
        $config['allowed_types'] = 'gif|jpg|png';
        
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
     
        $this->load->library('upload', $config);
     
        if ( ! $this->upload->do_upload('file_image')){
            $error = array('error' => $this->upload->display_errors());
            //print_r($error);
            $return = false;
        }else{
            $data = array('upload_data' => $this->upload->data());
            //print_r($data);
            $comment = '<img class="img-responsive pad" src="'.base_url().'filesUpload/'.$data['upload_data']['file_name'].'" alt="Photo"><p>'.$_POST['comment'].'</p>';

            $return = $this->M_wifi->InputChatImage($_POST['id_complaint'],$comment);

            if ($return) {
                $return = true;
            }else{
                $return = false;
            }
        }

        echo json_encode($return);
    }


}
