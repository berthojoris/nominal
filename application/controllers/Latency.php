<?php
class Latency extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_req_routing','M_dashboard'));
        $this->load->library('session'); 
    }
    
    public function index() {
        $data['page'] = 'list_latency';
        $data['title'] = 'Latency Report';

        $this->template->views('Req_Routing/list_req_routing',$data);
    }

    function GetData($kategori='')
    {
        $columns = array("No","Remote Name","IP Remote","Remote Type","Network","Max","Min","Avg"); // data array columns harus sama dengan data header table yang tadi di buat di view

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

    
}
