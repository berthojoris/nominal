<?php
class Req_Routing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_req_routing'));
        $this->load->library('session');
    }
    
    public function index() {
        $data['page'] = 'req_routing';
        $data['title'] = 'Request Routing';
        $this->template->views('Req_Routing/list_req_routing',$data);
    }

    function GetData_ReqRouting()
    {
        $columns = array("No","Id Request","Remote Name","IP Pool","Status","Action"); // data array columns harus sama dengan data header table yang tadi di buat di view

        $start=$this->input->post("start");//0
        $length=$this->input->post("length");//10
        $order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
        $sort = $this->input->post("order[0][dir]"); // asc
        $cari_data = $this->input->post("search[value]");
        
        
        if(empty($cari_data))
        {
            $datauker = $this->M_req_routing->GetData_ReqRouting($start,$length,'');
            $total = $this->M_req_routing->CountData_ReqRouting();
        }else{
            $datauker = $this->M_req_routing->GetData_ReqRouting($start,$length,$cari_data);
            $total = $this->M_req_routing->CountData_ReqRouting($cari_data);
        }
        
        

        //var_dump($datauker);die();
        //var_dump($total);die();

        $array_data =array();

        $no=$start+1;
        foreach ($datauker as $key) {
            
            $data["No"]=$no;
            $data["Id Request"]=$key->id;
            $data["Remote Name"]=$key->nama_remote;
            $data["IP Pool"]=$key->ip_pool;
            $data["Status"]="";
            $data["Action"]='<button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#detail" style="width: 100px"  onclick="DetailReq('.$key->id.')"><i class="fa fa-book"></i> Detail</button>
                <button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#track" style="width: 100px;margin-top:5px" onclick="TrackReq('.$key->id.')">
                    <i class="fa fa-history"></i> Tracking
                </button>';

            if ($key->status == 0) {
                $data["Status"].='<span class="label label-default">Verified</span><br>';
            }else if($key->status == 1){
                $data["Status"].='<span class="label label-primary">Verified</span><br>';
            }else{
                $data["Status"].='<span class="label label-success">Verified</span><br>';
            }

            if ($key->status_routing == 0) {
                $data["Status"].='<span class="label label-default">Routing</span><br>';
            }else if($key->status_routing == 1){
                $data["Status"].='<span class="label label-primary">Routing</span><br>';
            }else{
                $data["Status"].='<span class="label label-success">Routing</span><br>';
            }

            if ($key->status_simcard == 0) {
                $data["Status"].='<span class="label label-default">Sim Card</span><br>';
            }else if($key->status_simcard == 1){
                $data["Status"].='<span class="label label-primary">Sim Card</span><br>';
            }else{
                $data["Status"].='<span class="label label-success">Sim Card</span><br>';
            }



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

    function SaveReq()
    {
        $data = array(
            'id'              => '',
            'id_remote'       => $_POST['remote'],
            'pic'             => $_POST['pic'],
            'ip_pool'         => $_POST['ip_pool'],
            'ticket_jarkom'   => $_POST['ticket_jarkom'],
            'create_at'       => date('Y-m-d H:i:s'),
            'user_create'     => $this->session->userdata('username'),
            'status_routing'  => 1,
            'status_simcard'  => 1,
            'status_open'     => 1,
            'status'          => 1
            
        );

        $return = $this->db->insert('tb_req_routing', $data);

        if ($return) {
            $return = true;
        }else{
            $return = false;
        }

        echo $return;
    }

    function TrackReq()
    {
        $id = $_POST['id'];

        $data['data'] = $this->db->select('*')
                                 ->from('tb_req_routing_detail')
                                 ->where('id_routing',$id)
                                 ->get()->result();

        //echo "string";

        $this->load->view('Req_Routing/track_req',$data);
    }

    function DetailReq()
    {
        $id = $_POST['id'];

        $cek = $this->db->select('*')->from('tb_req_routing')->where('id',$id)->get()->result();

        // if ($cek[0]->status_open==1) {
        //     $this->db->set('status_open',2)->where('id',$id)->update('tb_req_routing');
        //     $this->db->set('status',2)->where('id',$id)->update('tb_req_routing');
        // }

        $data = $data = $this->db->query("
                                SELECT a.*,b.nama_remote,b.ip_lan FROM tb_req_routing a
                                LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
                                WHERE a.id = $id")
                             ->result();
        echo json_encode($data[0]);
    }

    function SaveOpen()
    {

        $return = $this->db->set('status_open',$_POST['status_open'])->where('id',$_POST['id'])->update('tb_req_routing');

        $status_open = '';

        if ($_POST['status_open']==0) {
            $status_open = 'Reject';
        }else if ($_POST['status_open']==2) {
            $status_open = 'Checking';
        }else if ($_POST['status_open']==3) {
            $status_open = 'Verified';
        }

        $data  = array(
            'id'                 => '',
            'id_routing'         => $_POST['id'],
            'status_description' => $status_open,
            'create_at'          => date('Y-m-d H:i:s'),
            'user_create'        => $this->session->userdata('username'),
            'reason'             => $_POST['reason']
        );

        $return = $this->db->insert('tb_req_routing_detail', $data);

        if ($return) {
            $return = true;
        }else{
            $return = false;
        }

        echo $return;
    }

    function SaveRouting()
    {
        $user = $this->session->userdata('username');
        $cek = $this->db->select('*')
                                 ->from('tb_req_routing')
                                 ->where('id',$_POST['id'])
                                 ->get()->result();
        if (!($cek[0]->user_routing==$user || $cek[0]->user_routing=='' || $cek[0]->user_routing=null)) {
            $return = false;
            echo $return; die();
        }

        $return = $this->db->set('status_routing',$_POST['status_routing'])
                           ->set('user_routing',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');

        $status_routing = '';

        if ($_POST['status_routing']==0) {
            $status_routing = 'Reject';
        }else if ($_POST['status_routing']==2) {
            $status_routing = 'Checking';
        }else if ($_POST['status_routing']==3) {
            $status_routing = 'Routing Done';
        }

        $data  = array(
            'id'                 => '',
            'id_routing'         => $_POST['id'],
            'status_description' => $status_routing,
            'create_at'          => date('Y-m-d H:i:s'),
            'user_create'        => $this->session->userdata('username'),
            'reason'             => $_POST['reason']
        );

        $return = $this->db->insert('tb_req_routing_detail', $data);

        if ($return) {
            $return = true;
        }else{
            $return = false;
        }

        echo $return;
    }

    function SaveSimcard()
    {
        $user = $this->session->userdata('username');
        $cek = $this->db->select('*')
                                 ->from('tb_req_routing')
                                 ->where('id',$_POST['id'])
                                 ->get()->result();
        if (!($cek[0]->user_simcard==$user || $cek[0]->user_simcard=='' || $cek[0]->user_simcard=null)) {
            $return = false;
            echo $return; die();
        }

        $return = $this->db->set('status_simcard',$_POST['status_simcard'])
                           ->set('user_routing',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');

        $status_simcard = '';

        if ($_POST['status_simcard']==0) {
            $status_simcard = 'Reject';
        }else if ($_POST['status_simcard']==2) {
            $status_simcard = 'Checking';
        }else if ($_POST['status_simcard']==3) {
            $status_simcard = 'Simcard Ready';
        }

        $data  = array(
            'id'                 => '',
            'id_routing'         => $_POST['id'],
            'status_description' => $status_simcard,
            'create_at'          => date('Y-m-d H:i:s'),
            'user_create'        => $this->session->userdata('username'),
            'reason'             => $_POST['reason']
        );

        $return = $this->db->insert('tb_req_routing_detail', $data);


        if ($return) {
            $return = true;
        }else{
            $return = false;
        }

        echo $return;
    }


}
