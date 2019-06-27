<?php
class Req_Routing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_req_routing','M_dashboard'));
        $this->load->library('session');
        //$this->load->library('pdf'); 
    }
    
    public function index() {
        $data['page'] = 'req_routing';
        $data['title'] = 'Request Routing';

        $new = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=1")->result();
        $done = $this->db->query("SELECT COUNT(id) as 'total' 
                                FROM tb_req_routing 
                                WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3")->result();
        $reqroll = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=11")->result();
        $rolldone = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=13 AND status_open>0")->result();

        $data['new']=$new[0]->total;
        $data['done']=$done[0]->total;
        $data['reqroll']=$reqroll[0]->total;
        $data['rolldone']=$rolldone[0]->total;

        $this->template->views('Req_Routing/list_req_routing',$data);
    }

    function GetData_ReqRouting($kategori='')
    {
        $columns = array("No","Id Request","Remote Name","Address","Region","Remote Type","IP LAN","IP Pool","Last Change Update","Network","Status","Action","Ticket"); // data array columns harus sama dengan data header table yang tadi di buat di view

        $start=$this->input->post("start");//0
        $length=$this->input->post("length");//10
        $order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
        $sort = $this->input->post("order[0][dir]"); // asc
        $cari_data = $this->input->post("search[value]");
        
        if(empty($cari_data))
        {
            $datauker = $this->M_req_routing->GetData_ReqRouting($start,$length,'',$kategori);
            $total = $this->M_req_routing->CountData_ReqRouting('',$kategori);
        }else{
            $datauker = $this->M_req_routing->GetData_ReqRouting($start,$length,$cari_data,$kategori);
            $total = $this->M_req_routing->CountData_ReqRouting($cari_data,$kategori);
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
            $data["Address"]=$key->alamat_uker;
            $data["Region"]=$key->nama_kanwil;
            $data["Remote Type"]=$key->tipe_uker;
            $data["IP LAN"]=$key->ip_lan;
            $data["Ticket"]=$key->ticket_jarkom;

            $firstTime = strtotime($key->update_at);
            $lastTime = strtotime(date('Y-m-d H:i:s'));
            $lama = (($lastTime - $firstTime) / 3600) / 24;
            $date_a = new DateTime($key->update_at);

            $date_b = new DateTime(date('Y-m-d H:i:s'));

            $interval = date_diff($date_a, $date_b);

            $lamane = $interval->format('%ad %hh %im %ss');

            $data["Last Change Update"]=$lamane;

            $jarkom = $this->M_dashboard->getjarkom($key->id_remote);

            $data["Network"]='';

            foreach ($jarkom as $jarkoms) {
                // if ($jarkoms->status==3) {
                //   $data["Network"].='<span class="label label-success">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                // }else if ($jarkoms->status==1) {
                //   $data["Network"].='<span class="label label-danger">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                // }else{
                  $data["Network"].='<span class="label label" style="color:#3d3d29">'.$jarkoms->jenis_jarkom.'/'.$jarkoms->nickname_provider.'</span><br>';
                //}
            }


            $data["Status"]="";
            $data["Action"]='<button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#detail" style="width: 50px"  onclick="DetailReq('.$key->id.')" title="Detail"><i class="fa fa-book"></i></button>
                <button type="button" class="btn btn-block btn-info btn-xs" data-toggle="modal" data-target="#track" style="width: 50px;margin-top:5px" onclick="TrackReq('.$key->id.')" title="Tracking">
                    <i class="fa fa-history"></i>
                </button>';
            if($this->session->userdata('role')==1){
                $data["Action"].='<button type="button" class="btn btn-block btn-danger btn-xs" style="width: 50px;margin-top:5px" onclick="DeleteReq('.$key->id.')" title="Delete">
                    <i class="fa fa-trash"></i>
                </button>';
            }

            if ($key->status == 1 && $key->status_open == 1 && $key->status_routing == 1 && $key->status_simcard == 1) {

                $data["Status"].='<span class="label label-primary">NEW REQUEST</span><br>';
            
            }else if($key->status == 11){

                $data["Status"].='<span class="label label-danger">REQUEST ROLLBACK</span><br>';

            }else if($key->status == 13 && $key->status_open == 0){

                $data["Status"].='<span class="label label-danger">CANCEL REQUEST ROUTING</span><br>';

            }else if($key->status == 12){

                $data["Status"].='<span class="label label-warning">PROGRESS ROLLBACK</span><br>';

            }else if($key->status == 13){

                $data["Status"].='<span class="label label-success">ROLLBACK DONE</span><br>';

            }else if($key->status_open == 3 && $key->status_routing == 3 && $key->status_simcard == 3){

                $data["Status"].='<span class="label label-success">ROUTING DONE</span><br>';

                if( in_array($this->session->userdata('role'), array(1,5,6,7)) ){
                    $data["Action"].='<button type="button" class="btn btn-block btn-primary btn-xs" style="width: 50px;margin-top:5px" title="Rollback" data-toggle="modal" data-target="#rollback" onclick="DetailRollback('.$key->id.')">
                        <i class="fa fa-long-arrow-left"></i>
                    </button>';

                    // $data["Action"].='<button type="button" class="btn btn-block btn-primary btn-xs" style="width: 50px;margin-top:5px" title="Rollback" onclick="Rollback('.$key->id.')">
                    //     <i class="fa fa-long-arrow-left"></i>
                    // </button>';
                }

            }else if($key->status <=3){

                if ($key->status_open == 0) {
                    $data["Status"].='<span class="label label-danger">Reject Open</span><br>';
                }else if($key->status_open == 1){
                    $data["Status"].='<span class="label label-primary">New Open</span><br>';
                }else if($key->status_open == 2){
                    $data["Status"].='<span class="label label-warning">Checking Open</span><br>';
                }else if($key->status_open == 3){
                    $data["Status"].='<span class="label label-success">Verified</span><br>';
                }

                if ($key->status_routing == 0) {
                    $data["Status"].='<span class="label label-danger">Reject Routing</span><br>';
                }else if($key->status_routing == 1){
                    $data["Status"].='<span class="label label-primary">New Routing</span><br>';
                }else if($key->status_routing == 2){
                    $data["Status"].='<span class="label label-warning">Checking Routing</span><br>';
                }else if($key->status_routing == 3){
                    $data["Status"].='<span class="label label-success">Routing Ready</span><br>';
                }

                if ($key->status_simcard == 0) {
                    $data["Status"].='<span class="label label-danger">Reject Sim Card</span><br>';
                }else if($key->status_simcard == 1){
                    $data["Status"].='<span class="label label-primary">New Sim Card</span><br>';
                }else if($key->status_simcard == 2){
                    $data["Status"].='<span class="label label-warning">Checking Sim Card</span><br>';
                }else if($key->status_simcard == 3){
                    $data["Status"].='<span class="label label-success">Sim Card Ready</span><br>';
                }

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

    function GetRemote()
    {
        $search = $_GET["search"];

        $output = array();

        $remote = $this->db->select('*')->from('v_all_remote')
                    ->like('nama_remote',$search)
                    ->or_like('ip_lan',$search)
                    ->or_like('id_remote',$search)
                    ->limit(10)->get()->result();

        foreach ($remote as $r) {
            $data['id'] = $r->id_remote;
            $data['text'] = $r->tipe_uker." | ".$r->nama_remote." | ".$r->ip_lan;
            array_push($output, $data);
        }

        if (! empty($output)) {
            // Encode ke format JSON.
            echo json_encode($output);
            //var_dump($output);
        }
    }

    function SaveReq()
    {
        $cek = $this->db->select('*')
                        ->from('tb_req_routing')
                        ->where('id_remote',$_POST['remote'])
                        ->where('status!=','13')
                        ->get()->result();

        if (isset($cek[0]->id_remote)) {
            echo 2; die();
        }else{

            $data = array(
                'id'              => '',
                'id_remote'       => $_POST['remote'],
                'pic'             => $_POST['pic'],
                'ip_pool'         => $_POST['ip_pool'],
                'ticket_jarkom'   => $_POST['ticket_jarkom'],
                'create_at'       => date('Y-m-d H:i:s'),
                'update_at'       => date('Y-m-d H:i:s'),
                'user_create'     => $this->session->userdata('username'),
                'user_update'     => $this->session->userdata('username'),
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
    }

    function TrackReq()
    {
        $id = $_POST['id'];

        $data['data'] = $this->db->select('*')
                                 ->from('tb_req_routing_detail')
                                 ->where('id_routing',$id)
                                 //->order_by('id','desc')
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
                                SELECT a.*,b.nama_remote,b.ip_lan,c.nama as 'namaopen',d.nama as 'namarout',e.nama as 'namasimcard' FROM tb_req_routing a
                                LEFT JOIN tb_remote b ON b.id_remote = a.id_remote
                                LEFT JOIN tb_user c ON c.username = a.user_open
                                LEFT JOIN tb_user d ON d.username = a.user_routing
                                LEFT JOIN tb_user e ON e.username = a.user_simcard
                                WHERE a.id = $id")
                             ->result();
        echo json_encode($data[0]);
    }

    function SaveOpen()
    {
        $user = $this->session->userdata('username');
        $cek = $this->db->select('*')
                                 ->from('tb_req_routing')
                                 ->where('id',$_POST['id'])
                                 ->get()->result();
        // if (!($cek[0]->user_open=$user || $cek[0]->user_routing=='' || $cek[0]->user_routing=null)) {
        //     $return = false;
        //     echo $return; die();
        // }

        if ($_POST['status_open']==0 && $_POST['reason']==null && $_POST['reason']=='') {
            $return = false;
            echo $return; die();
        }

        $return = $this->db->set('status_open',$_POST['status_open'])
                           ->set('user_open',$this->session->userdata('username'))
                           ->set('update_at',date('Y-m-d H:i:s'))
                           ->set('user_update',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');

        $status_open = '';

        if ($_POST['status_open']==0) {
            $status_open = 'Reject Open';
        }else if ($_POST['status_open']==2) {
            $status_open = 'Checking Open';
            $this->db->set('status',2)
                     ->set('update_at',date('Y-m-d H:i:s'))
                     ->set('user_update',$this->session->userdata('username'))
                     ->where('id',$_POST['id'])->update('tb_req_routing');
        }else if ($_POST['status_open']==3) {
            $status_open = 'Verified Open';
            $this->db->set('status',3)
                     ->set('status_routing',1)
                     ->set('status_simcard',1)
                     ->set('update_at',date('Y-m-d H:i:s'))
                     ->set('user_update',$this->session->userdata('username'))
                     ->where('id',$_POST['id'])->update('tb_req_routing');
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
        $tanggal = date('Y-m-d H:i:s');
        // if (!($cek[0]->user_routing==$user || $cek[0]->user_routing=='' || $cek[0]->user_routing=null)) {
        //     $return = false;
        //     echo $return; die();
        // }

        if ($_POST['status_routing']==0 && $_POST['reason']==null && $_POST['reason']=='') {
            $return = false;
            echo $return; die();
        }

        $return = $this->db->set('status_routing',$_POST['status_routing'])
                           ->set('user_routing',$this->session->userdata('username'))
                           ->set('update_at', $tanggal)
                           ->set('user_update',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');

        //var_dump($return);die();

        $status_routing = '';

        if ($_POST['status_routing']==0) {
            $status_routing = 'Reject Routing';
            // $this->db->set('status_open',2)
            //          ->set('update_at',date('Y-m-d H:i:s'))
            //          ->set('user_update',$this->session->userdata('username'))
            //          ->where('id',$_POST['id'])->update('tb_req_routing');
        }else if ($_POST['status_routing']==2) {
            $status_routing = 'Checking Routing';
        }else if ($_POST['status_routing']==3) {
            $status_routing = 'Routing Ready';
        }else if ($_POST['status_routing']==4) {
            $status_routing = 'Routing Done';
            if ($cek[0]->status_simcard==4) {
                $this->db->set('status',13)
                     ->set('update_at',date('Y-m-d H:i:s'))
                     ->set('user_update',$this->session->userdata('username'))
                     ->where('id',$_POST['id'])->update('tb_req_routing');
            }
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

        echo json_encode($return);
    }

    function SaveSimcard()
    {
        $user = $this->session->userdata('username');
        $cek = $this->db->select('*')
                                 ->from('tb_req_routing')
                                 ->where('id',$_POST['id'])
                                 ->get()->result();
        $tanggal = date('Y-m-d H:i:s');
        // if (!($cek[0]->user_simcard==$user || $cek[0]->user_simcard=='' || $cek[0]->user_simcard=null)) {
        //     $return = false;
        //     echo $return; die();
        // }

        if ($_POST['status_simcard']==0 && $_POST['reason']==null && $_POST['reason']=='') {
            $return = false;
            echo $return; die();
        }

        $return = $this->db->set('status_simcard',$_POST['status_simcard'])
                           ->set('user_simcard',$this->session->userdata('username'))
                           ->set('update_at',$tanggal)
                           ->set('user_update',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');

        $status_simcard = '';

        if ($_POST['status_simcard']==0) {
            $status_simcard = 'Reject SIM Card';
            // $this->db->set('status_open',2)
            //          ->set('update_at',date('Y-m-d H:i:s'))
            //          ->set('user_update',$this->session->userdata('username'))
            //          ->where('id',$_POST['id'])->update('tb_req_routing');
        }else if ($_POST['status_simcard']==2) {
            $status_simcard = 'Checking SIM Card';
        }else if ($_POST['status_simcard']==3) {
            $status_simcard = 'Simcard Ready';
        }else if ($_POST['status_simcard']==4) {
            $status_simcard = 'Deactiveted SIM Card';
            if ($cek[0]->status_routing==4) {
                $this->db->set('status',13)
                     ->set('update_at',$tanggal)
                     ->set('user_update',$this->session->userdata('username'))
                     ->where('id',$_POST['id'])->update('tb_req_routing');
            }
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

    function DeleteReq()
    {
        $return = $this->db->where('id', $_POST['id'])->delete('tb_req_routing');


        if ($return) {
            $return = true;
        }else{
            $return = false;
        }

        echo $return;
    }

    function Rollback()
    {
        $return = $this->db->set('status',11)
                           ->set('update_at',date('Y-m-d H:i:s'))
                           ->set('user_update',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');


        if ($return) {
            $return = true;

            $data  = array(
                'id'                 => '',
                'id_routing'         => $_POST['id'],
                'status_description' => "Rollback",
                'create_at'          => date('Y-m-d H:i:s'),
                'user_create'        => $this->session->userdata('username'),
                'reason'             => $_POST['note']
            );

            $this->db->insert('tb_req_routing_detail', $data);
        }else{
            $return = false;
        }

        echo $return;
    }

    function ReqRollback()
    {
        $return = $this->db->set('status',11)
                           ->set('update_at',date('Y-m-d H:i:s'))
                           ->set('user_update',$this->session->userdata('username'))
                           ->set('pic',$_POST['pic_rollback'])->where('id',$_POST['id'])->update('tb_req_routing');


        if ($return) {
            $return = true;

            $data  = array(
                'id'                 => '',
                'id_routing'         => $_POST['id'],
                'status_description' => "Request Rollback",
                'create_at'          => date('Y-m-d H:i:s'),
                'user_create'        => $this->session->userdata('username'),
                'reason'             => $_POST['note']
            );

            $this->db->insert('tb_req_routing_detail', $data);
        }else{
            $return = false;
        }

        echo $return;
    }



    function AppRollback()
    {
        $return = $this->db->set('status',12)
                           ->set('update_at',date('Y-m-d H:i:s'))
                           ->set('user_update',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');


        if ($return) {
            $return = true;

            $data  = array(
                'id'                 => '',
                'id_routing'         => $_POST['id'],
                'status_description' => "Approve Rollback",
                'create_at'          => date('Y-m-d H:i:s'),
                'user_create'        => $this->session->userdata('username'),
                'reason'             => ''
            );

            $this->db->insert('tb_req_routing_detail', $data);
        }else{
            $return = false;
        }

        echo $return;
    }

    function ReRollback()
    {
        $return = $this->db->set('status',3)
                           ->set('update_at',date('Y-m-d H:i:s'))
                           ->set('user_update',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');


        if ($return) {
            $return = true;

            $data  = array(
                'id'                 => '',
                'id_routing'         => $_POST['id'],
                'status_description' => "Reject Rollback",
                'create_at'          => date('Y-m-d H:i:s'),
                'user_create'        => $this->session->userdata('username'),
                'reason'             => ''
            );

            $this->db->insert('tb_req_routing_detail', $data);
        }else{
            $return = false;
        }

        echo $return;
    }

    function DoneRollback()
    {
        $return = $this->db->set('status',13)
                           ->set('update_at',date('Y-m-d H:i:s'))
                           ->set('user_update',$this->session->userdata('username'))
                           ->where('id',$_POST['id'])->update('tb_req_routing');


        if ($return) {
            $return = true;

            $data  = array(
                'id'                 => '',
                'id_routing'         => $_POST['id'],
                'status_description' => "Rollback Done",
                'create_at'          => date('Y-m-d H:i:s'),
                'user_create'        => $this->session->userdata('username'),
                'reason'             => ''
            );

            $this->db->insert('tb_req_routing_detail', $data);
        }else{
            $return = false;
        }

        echo $return;
    }

    function Dashboard()
    {
        $data['page'] = 'dash_req_routing';
        $data['title'] = 'Dashboard Request Routing';
        $new = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=1")->result();
        $done = $this->db->query("SELECT COUNT(id) as 'total' 
                                FROM tb_req_routing 
                                WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3")->result();

        $reqroll = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=11")->result();
        $proroll = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=12")->result();
        $rolldone = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=13 AND status_open>0")->result();


        $newopen = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_open=1")->result();
        $checkopen = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_open=2")->result();
        $veropen = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_open=3 AND status<11 AND id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    )")->result();
        $rejopen = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_open=0")->result();


        $newrout = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_routing=1")->result();
        $checkrout = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_routing=2")->result();
        $verrout = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_routing=3 AND status<11 AND id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    )")->result();
        $rejorout = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_routing=0")->result();


        $newsim = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_simcard=1")->result();
        $checksim = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_simcard=2")->result();
        $versim = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_simcard=3 AND status<11 AND id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    )")->result();
        $rejsim = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_simcard=0")->result();

        $data['new']=$new[0]->total;
        $data['done']=$done[0]->total;
        $data['reqroll']=$reqroll[0]->total;
        $data['proroll']=$proroll[0]->total;
        $data['rolldone']=$rolldone[0]->total;

        $data['newopen']=$newopen[0]->total;
        $data['checkopen']=$checkopen[0]->total;
        $data['veropen']=$veropen[0]->total;
        $data['rejopen']=$rejopen[0]->total;

        $data['newrout']=$newrout[0]->total;
        $data['checkrout']=$checkrout[0]->total;
        $data['verrout']=$verrout[0]->total;
        $data['rejrout']=$rejorout[0]->total;

        $data['newsim']=$newsim[0]->total;
        $data['checksim']=$checksim[0]->total;
        $data['versim']=$versim[0]->total;
        $data['rejsim']=$rejsim[0]->total;
        
        $this->template->views('Req_Routing/dashboard',$data);
    }

    function Refresh_dash()
    {
        $data['page'] = 'dash_req_routing';
        $data['title'] = 'Dashboard Request Routing';
        $new = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=1")->result();
        $done = $this->db->query("SELECT COUNT(id) as 'total' 
                                FROM tb_req_routing 
                                WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3")->result();

        $reqroll = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=11")->result();
        $proroll = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=12")->result();
        $rolldone = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status=13 AND status_open>0")->result();


        $newopen = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_open=1")->result();
        $checkopen = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_open=2")->result();
        $veropen = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_open=3 AND status<11 AND id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    )")->result();
        $rejopen = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_open=0")->result();


        $newrout = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_routing=1")->result();
        $checkrout = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_routing=2")->result();
        $verrout = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_routing=3 AND status<11 AND id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    )")->result();
        $rejorout = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_routing=0")->result();


        $newsim = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_simcard=1")->result();
        $checksim = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_simcard=2")->result();
        $versim = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_simcard=3 AND status<11 AND id NOT IN (
                                        SELECT id 
                                        FROM tb_req_routing 
                                        WHERE status=3 AND status_open = 3 AND status_routing = 3 AND status_simcard = 3
                                    )")->result();
        $rejsim = $this->db->query("SELECT COUNT(id) as 'total' FROM tb_req_routing WHERE status_simcard=0")->result();

        $data['new']=$new[0]->total;
        $data['done']=$done[0]->total;
        $data['reqroll']=$reqroll[0]->total;
        $data['proroll']=$proroll[0]->total;
        $data['rolldone']=$rolldone[0]->total;

        $data['newopen']=$newopen[0]->total;
        $data['checkopen']=$checkopen[0]->total;
        $data['veropen']=$veropen[0]->total;
        $data['rejopen']=$rejopen[0]->total;

        $data['newrout']=$newrout[0]->total;
        $data['checkrout']=$checkrout[0]->total;
        $data['verrout']=$verrout[0]->total;
        $data['rejrout']=$rejorout[0]->total;

        $data['newsim']=$newsim[0]->total;
        $data['checksim']=$checksim[0]->total;
        $data['versim']=$versim[0]->total;
        $data['rejsim']=$rejsim[0]->total;
        
        echo json_encode($data);
    }

    function List()
    {
        $kategori = $this->uri->segment(3);
        $data['page'] = 'req_routing';
        $data['title'] = 'Request Routing';
        // if($kategori=='new'){
        //     $this->template->views('Req_Routing/list_new_req_routing',$data);
        // }else if($kategori=='done'){
        //     $this->template->views('Req_Routing/list_done_req_routing',$data);
        // }else if($kategori=='reqroll'){
        //     $this->template->views('Req_Routing/list_req_roll',$data);
        // }else if($kategori=='rolldone'){
        //     $this->template->views('Req_Routing/list_roll_done',$data);
        // }else{          
            $this->template->views('Req_Routing/list',$data);
        //}
    }


    function GetUser()
    {
        $columns = array("No","User","Verified Open","Routing Ready","SIM Card Ready","Request Rollback","Rollback Done","Total"); // data array columns harus sama dengan data header table yang tadi di buat di view

        $start=$this->input->post("start");//0
        $length=$this->input->post("length");//10
        $order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
        $sort = $this->input->post("order[0][dir]"); // asc
        $cari_data = $this->input->post("search[value]");  
        

        if ($start=='') {
            $start = 0;
        }
        if ($length=='') {
            $length = 10;
        }
        $where = '';
        if ($cari_data!='') {
            $where = " AND b.nama LIKE '%$cari_data%' ";
        }

        $start_time = rawurldecode($this->uri->segment(3));
        $end_time =  rawurldecode($this->uri->segment(4));
        
        $sql = $this->db->query("SELECT a.user_create 
                                FROM tb_req_routing_detail a
                                LEFT JOIN tb_user b ON b.username=a.user_create
                                WHERE a.user_create!='' $where GROUP BY a.user_create LIMIT ".$start.",".$length)->result();

        $dataarr = array();

        for ($i=0; $i < count($sql); $i++) { 
            $dataarr[$i] = $this->M_req_routing->GetUser($sql[$i]->user_create);
        }

        $total = count($this->db->query("SELECT user_create FROM tb_req_routing_detail WHERE user_create!='' GROUP BY user_create")->result());

        //print_r($dataarr);
  

        $array_data =array();

        $no=$start+1;
        foreach ($dataarr as $key) {
            
            $data["No"]=$no;
            $data["User"]=$key->nama;
            $data["Verified Open"]=$key->v_open > 0 ? $key->v_open : '';
            $data["Routing Ready"]=$key->routing_r > 0 ? $key->routing_r : '';
            $data["SIM Card Ready"]=$key->simcard_r > 0 ? $key->simcard_r : '';
            $data["Request Rollback"]=$key->r_rollback > 0 ? $key->r_rollback : '';
            $data["Rollback Done"]=$key->rollback_d > 0 ? $key->rollback_d : '';
            $data["Total"]=$key->v_open+$key->routing_r+$key->simcard_r+$key->r_rollback+$key->rollback_d;

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




    function GetUser2()
    {
        $columns = array("No","User","Verified Open","Routing Ready","SIM Card Ready","Request Rollback","Rollback Done","Total"); // data array columns harus sama dengan data header table yang tadi di buat di view

        $start=$this->input->post("start");//0
        $length=$this->input->post("length");//10
        $order = $this->input->post("order[0][column]");  // kita akan order by nama dari database
        $sort = $this->input->post("order[0][dir]"); // asc
        $cari_data = $this->input->post("search[value]"); 

        if ($start=='') {
            $start = 0;
        }
        if ($length=='') {
            $length = 10;
        }
        $where = '';
        if ($cari_data!='') {
            $where = " AND b.nama LIKE '%$cari_data%' ";
        }

        $start_time = rawurldecode($this->uri->segment(3));
        $end_time =  rawurldecode($this->uri->segment(4));
        
        $sql = $this->db->query("SELECT a.user_create 
                                FROM tb_req_routing_detail a
                                LEFT JOIN tb_user b ON b.username=a.user_create
                                WHERE a.user_create!='' $where GROUP BY a.user_create LIMIT ".$start.",".$length)->result();

        $dataarr = array();

        for ($i=0; $i < count($sql); $i++) { 
            $dataarr[$i] = $this->M_req_routing->GetUser($sql[$i]->user_create,$start_time,$end_time);
        }

        $total = count($this->db->query("SELECT user_create FROM tb_req_routing_detail WHERE user_create!='' GROUP BY user_create")->result());

        //print_r($dataarr);
  

        $array_data =array();

        $no=$start+1;
        foreach ($dataarr as $key) {
            
            $data["No"]=$no;
            $data["User"]=$key->nama;
            $data["Verified Open"]=$key->v_open > 0 ? $key->v_open : '';
            $data["Routing Ready"]=$key->routing_r > 0 ? $key->routing_r : '';
            $data["SIM Card Ready"]=$key->simcard_r > 0 ? $key->simcard_r : '';
            $data["Request Rollback"]=$key->r_rollback > 0 ? $key->r_rollback : '';
            $data["Rollback Done"]=$key->rollback_d > 0 ? $key->rollback_d : '';
            $data["Total"]=$key->v_open+$key->routing_r+$key->simcard_r+$key->r_rollback+$key->rollback_d;

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

    function CetakNoc(){

        $start_time = rawurldecode($this->uri->segment(3));
        
        $end_time =  rawurldecode($this->uri->segment(4));
        
        $sql = $this->db->query("SELECT a.user_create 
                                FROM tb_req_routing_detail a
                                LEFT JOIN tb_user b ON b.username=a.user_create
                                WHERE a.user_create!='' GROUP BY a.user_create ")->result();

        $dataarr = array();
        if ($start_time==0) {
            for ($i=0; $i < count($sql); $i++) { 
                $dataarr[$i] = $this->M_req_routing->GetUser($sql[$i]->user_create);
            }
        }else{
            for ($i=0; $i < count($sql); $i++) { 
                $dataarr[$i] = $this->M_req_routing->GetUser($sql[$i]->user_create,$start_time,$end_time);
            }
        }

        $data['data'] = $dataarr;

        $this->load->view('Req_Routing/excel',$data);
    }

    public function Cetak_pdf(){

        $start_time = rawurldecode($this->uri->segment(3));
        
        $end_time =  rawurldecode($this->uri->segment(4));
        
        $sql = $this->db->query("SELECT a.user_create 
                                FROM tb_req_routing_detail a
                                LEFT JOIN tb_user b ON b.username=a.user_create
                                WHERE a.user_create!='' GROUP BY a.user_create ")->result();

        $dataarr = array();
        if ($start_time==0) {
            for ($i=0; $i < count($sql); $i++) { 
                $dataarr[$i] = $this->M_req_routing->GetUser($sql[$i]->user_create);
            }
        }else{
            for ($i=0; $i < count($sql); $i++) { 
                $dataarr[$i] = $this->M_req_routing->GetUser($sql[$i]->user_create,$start_time,$end_time);
            }
        }

        $data['data'] = $dataarr;
        $html = $this->load->view('Req_Routing/excel',$data,true); 
        $pdf = $this->pdf->load();
        $pdf->AddPage('L');
        $pdf->WriteHTML($html);
        $pdf->Output('report.pdf', 'D');
    }

}
