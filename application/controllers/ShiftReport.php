<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Spipu\Html2Pdf\Html2Pdf;

class ShiftReport extends CI_Controller{
   
   public function __construct(){
        parent::__construct();
        $this->load->model("M_ShiftReport");
        date_default_timezone_set("asia/jakarta");
        $this->load->library("form_validation");
    }


    public function list_shift_personil($id_shift)
    {

         $dataOutput=array(
            "title"=>"Shift Personnel",
            "page"=> "Shift Personnel",
            "id_shift"=>$id_shift
        );

        //SELECT `id_shift` FROM tb_shifting order by `id_shift` DESC limit 2

        //get data personil shift before..

        $table=array("tb_shifting");
        $field=array("id_shift","next_duty","on_duty");
        $condition="order by id_shift DESC limit 2";
        $dataShiftBefore = $this->M_ShiftReport->getDataListShiftReport($table,$field,$condition,null);

        $totalData=count($dataShiftBefore);
       
        //data value textarea on duty dari shift sebelumnya
        $dataOutput['before_next_duty']="";
        //data value textarea next duty untuk shift selanjutnya
        $dataOutput['after_next_duty']="";

        if( $totalData < 2 ) // jika table kosong atau hanya ada satu baris
        {
                foreach ($dataShiftBefore as $key)
                {
                    $dataOutput['before_next_duty']=$key->on_duty;
                    $dataOutput['after_next_duty']=$key->next_duty;
                }
            
        
        }else
            {  // jika table terdapat lebih dari 2 baris

                $cek_id=0;
                foreach ($dataShiftBefore as $key)
                {
                    if( $key->id_shift == $id_shift )
                    {
                        $dataOutput['before_next_duty']=$key->on_duty;
                        $dataOutput['after_next_duty']=$key->next_duty;
                        $cek_id++;
                        
                       
                    }else{
                        $dataOutput['before_next_duty']=$key->next_duty;

                    }    
                }

                if($cek_id==0)
                {
                    $condition_cek="WHERE id_shift=?";
                    $dataCek=array("id_shift"=>$id_shift);
                    $dataShiftBefore = $this->M_ShiftReport->getDataListShiftReport($table,$field,$condition_cek,$dataCek);
                    $dataOutput['before_next_duty']=$dataShiftBefore[0]->on_duty;
                    $dataOutput['after_next_duty']=$dataShiftBefore[0]->next_duty;
                }

            }

        
        // cek apakah data before_next_duty & after_next_duty sudah tersimpan di database ?
        $table_cek=array("tb_shifting");
        $field_cek=array("id_shift","next_duty","on_duty","activity");
        $condition_cek="Where id_shift =?";
        $dataBindCek=array("id_shift"=>$id_shift);
        $dataCek = $this->M_ShiftReport->getDataListShiftReport($table_cek,$field_cek,$condition_cek,$dataBindCek);

        foreach ($dataCek as $key) 
        {
            $dataOutput['db_onDuty'] =$key->on_duty;

            //untuk cek apakah shift sudah cut off atau belum ?
            $dataOutput['activity'] =$key->activity;
        }

       $this->template->views('shift_report/ShiftPersonil',$dataOutput);

        
    }


    public function convert2pdf_new($id_shift)
    {
        $lib_url=FCPATH."application/libraries/html2pdf/vendor/autoload.php";

         $fieldSet=array("shift_date","shift","groud_station","simcard","trouble_ticket","remote_down","routing","ndc","nac","jupiter","activity","next_activity","on_duty");
        $condition="WHERE id_shift = ?";
        $dataBind=array("id_shift"=>$id_shift);
        $table=array("tb_shifting");
        $getDataReportShift = $this->M_ShiftReport->getDataListShiftReport($table,$fieldSet,$condition,$dataBind);
        $page           = "print pdf";
        $shift          =$getDataReportShift[0]->shift;      
        $shift_date     =$getDataReportShift[0]->shift_date;    
        $on_duty        = $getDataReportShift[0]->on_duty;
        $groud_station  =$getDataReportShift[0]->groud_station;
        $simcard        = $getDataReportShift[0]->simcard;
        $trouble_ticket = $getDataReportShift[0]->trouble_ticket;
        $remote_down    = $getDataReportShift[0]->remote_down;
        $routing        = $getDataReportShift[0]->routing;
        $ndc            = $getDataReportShift[0]->ndc;
        $nac            = $getDataReportShift[0]->nac;
        $jupiter        = $getDataReportShift[0]->jupiter;
        $activity       = $getDataReportShift[0]->activity;
        $next_activity  = $getDataReportShift[0]->next_activity;

        
        $dataHTML = "<div id='header' style='width:90%;margin-right: 5%;margin-left: 5%;margin-bottom: 5%;' align='center'>";
        $dataHTML .="<img width='250' height='180' border='0' src='".base_url('assets/img/brisat.png')."' >";
        $dataHTML .="<h1 style='margin-top: -30px;''>NOC REPORT</h1>";
        $dataHTML .=" <h4>Shift : $shift ( $shift_date )</h4>";
        $dataHTML .= "</div>";

         try {
            require_once $lib_url;
            $filename="convert.pdf";
            
            $convert= new HTML2PDF('P','A4','en',true,'UTF-8',array(2,7,3,5));
            //$convert=$convert= new HTML2PDF();
            $convert->setDefaultFont('arial');
            $convert->writeHTML($dataHTML);
            $convert->Output();

         } catch (Exception $e) {

           echo "gagal convert : ".$e->getMessage();
         }

    }


    public function convert2pdf($id_shift)
    {
        $lib_url=FCPATH."application/libraries/html2pdf/vendor/autoload.php";

         $fieldSet=array("shift_date","shift","groud_station","simcard","trouble_ticket","remote_down","routing","ndc","nac","jupiter","activity","next_activity","on_duty","next_duty");
        $condition="WHERE id_shift = ?";
        $dataBind=array("id_shift"=>$id_shift);
        $table=array("tb_shifting");
        $getDataReportShift = $this->M_ShiftReport->getDataListShiftReport($table,$fieldSet,$condition,$dataBind);
        $data['page']           = "print pdf";
        $data['shift']          =$getDataReportShift[0]->shift;      
        $data['shift_date']     =$getDataReportShift[0]->shift_date;    
        $data['on_duty']        = $getDataReportShift[0]->on_duty;
        $data['next_duty']        = $getDataReportShift[0]->next_duty;

        $data['groud_station']  =$getDataReportShift[0]->groud_station;
        $data['simcard']        = $getDataReportShift[0]->simcard;
        $data['trouble_ticket'] = $getDataReportShift[0]->trouble_ticket;
        $data['remote_down']    = $getDataReportShift[0]->remote_down;
        $data['routing']        = $getDataReportShift[0]->routing;
        $data['ndc']            = $getDataReportShift[0]->ndc;
        $data['nac']            = $getDataReportShift[0]->nac;
        $data['jupiter']        = $getDataReportShift[0]->jupiter;
        $data['activity']       = $getDataReportShift[0]->activity;
        $data['next_activity']  = $getDataReportShift[0]->next_activity;

      //$this->load->view("shift_report/printReviewPDF",$data);

        ob_start();

        $data_convert = $this->load->view("shift_report/printReviewPDF",$data);
        
        $dataHTML = ob_get_contents();
        ob_end_clean();

         try {
            require_once $lib_url;
            $filename="convert.pdf";
            
            $convert= new HTML2PDF('P','A4','en',true,'UTF-8',array(2,7,3,5));
            $convert->setDefaultFont('arial');
            $convert->writeHTML($dataHTML);
            // $convert->Output($filename,'D');
            $convert->Output();

         } catch (Exception $e) {

           echo "gagal convert : ".$e->getMessage();
         }



        /*ob_start();

        $data_convert = $this->load->view("shift_report/printReviewPDF",$data,TRUE);
                
        $dataHTML = ob_get_contents();
        ob_end_clean();

         try {
            require_once $lib_url;
            $filename="convert.pdf";
            
            $convert= new HTML2PDF('P','A4','en',true,'UTF-8',array(2,7,3,5));
            $convert->setDefaultFont('arial');
            $convert->writeHTML($dataHTML);
            // $convert->Output($filename,'D');
            $convert->Output();

         } catch (Exception $e) {

           echo "gagal convert : ".$e->getMessage();
         }*/

    }

    public function convert2pdf_old($id_shift)
    {
        //echo $id_shift;
        $lib_url=FCPATH."application/libraries/html2pdf/vendor/autoload.php";

         $fieldSet=array("shift_date","shift","groud_station","simcard","trouble_ticket","remote_down","routing","ndc","nac","jupiter","activity","next_activity","on_duty");
        $condition="WHERE id_shift = ?";
        $dataBind=array("id_shift"=>$id_shift);
        $table=array("tb_shifting");
        $getDataReportShift = $this->M_ShiftReport->getDataListShiftReport($table,$fieldSet,$condition,$dataBind);

        $shift          =$getDataReportShift[0]->shift;      
        $shift_date     =$getDataReportShift[0]->shift_date;    
        $on_duty        = $getDataReportShift[0]->on_duty;
        $groud_station  =$getDataReportShift[0]->groud_station;
        $simcard        = $getDataReportShift[0]->simcard;
        $trouble_ticket = $getDataReportShift[0]->trouble_ticket;
        $remote_down    = $getDataReportShift[0]->remote_down;
        $routing        = $getDataReportShift[0]->routing;
        $ndc            = $getDataReportShift[0]->ndc;
        $nac            = $getDataReportShift[0]->nac;
        $jupiter        = $getDataReportShift[0]->jupiter;
        $activity       = $getDataReportShift[0]->activity;
        $next_activity  = $getDataReportShift[0]->next_activity;

        $dataReport="<div id='content' style='width:100%;'>";

        $dataReport.="<div style='margin-bottom:25px;width:100%;background:#236add;padding:10px;color:white;'>";
        $dataReport.="<h1>NOC SHIFT REPORT</h1>";
        $dataReport.="<table>";

        $dataReport.="<tr>";
        $dataReport.="<td>Shift</td>";
        $dataReport.="<td>:</td>";
        $dataReport.="<td>$shift</td>";
        $dataReport.="</tr>";
        
        $dataReport.="<tr>";
        $dataReport.="<td>Date</td>";
        $dataReport.="<td>:</td>";
        $dataReport.="<td>$shift_date</td>";
        $dataReport.="</tr>";
        
        $dataReport.="</table>";
        
        $dataReport.="</div>";

        $dataReport.="<div  style='margin-bottom:25px;width:95%;'>";

        $data_on_duty = str_replace(array("<p>","</p>"),"",$on_duty);
        $data=explode(",", $data_on_duty);

        $dataReport.="<h3>SHIFT ON DUTY :</h3>";
        $dataReport.="<hr>";
        for ($a=0;$a<count($data);$a++)
        {
            $no=$a+1;
            $dataReport.=$no." - ".$data[$a]."<br/>";
        }

        $dataReport.="</div>";

        $dataReport.="<div  style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3 style='width:50%'>GROUD STATION</h3>";
        $dataReport.="<hr>";
        $dataReport .=$groud_station;
        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3 style='width:50%'>SIMCARD</h3>";
        $dataReport.="<hr>";
        $dataReport .=$simcard;
        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3 style='width:50%'>TROUBLE TICKET</h3>";
        $dataReport.="<hr>";
        $dataReport .=$trouble_ticket;
        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3 style='width:50%'>REMOTE DOWN</h3>";
        $dataReport.="<hr>";
        $dataReport .=$remote_down;
        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3 style='width:50%'>ROUTING</h3>";
        $dataReport.="<hr>";
        $dataReport .=$routing;
        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3 style='width:50%'>NDC</h3>";
        $dataReport.="<hr>";
        $dataReport .=$ndc;
        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3 style='width:50%'>NAC</h3>";
        $dataReport.="<hr>";
        $dataReport .=$nac;
        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3 style='width:50%'>JUPITER</h3>";
        $dataReport.="<hr>";
        $dataReport .=$jupiter;
        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;'>";
        $dataReport.="<h3>Event Report</h3>";
        $dataReport.="<hr>";

    
         $dataReport.="<table border=1 cellspacing=0 style='width:95%;'>";
      
         $dataReport.="<tr>";
         $dataReport.="<th style='width:5%;padding:5px;'>No</th>";
         $dataReport.="<th style='width:20%;padding:5px;'>Report Number</th>";
         $dataReport.="<th style='width:20%;padding:5px;'>create Date</th>";
         $dataReport.="<th style='width:20%;padding:5px;'>Event Name</th>";
         $dataReport.="<th style='width:20%;padding:5px;'>Status</th>";
         $dataReport.="<th style='width:15%;padding:5px;'>Last Update</th>";
         $dataReport.="</tr>";
        
        //$dataReport.="<tbody>";


        if($activity !='' || $activity !=null) 
        {
            $data_event_closed=json_decode($activity);
            $data_event_open_and_investigated=json_decode($next_activity);

            $no=1;
          

            foreach($data_event_closed->activity->event as $key)
            {
                $dataReport.="<tr>";
                $dataReport.="<td>$no</td>";
                $dataReport.="<td>$key->report_number</td>";
                $dataReport.="<td>$key->create_at</td>";
                $dataReport.="<td>$key->event_name</td>";
                $dataReport.="<td>$key->status</td>";
                $dataReport.="<td>$key->update_at</td>";
                
                $dataReport.="</tr>";
                 $no++;
            }

            foreach($data_event_open_and_investigated->activity->event as $key)
            {
                $dataReport.="<tr>";
                $dataReport.="<td>$no</td>";
                $dataReport.="<td>$key->report_number</td>";
                $dataReport.="<td>$key->create_at</td>";
                $dataReport.="<td>$key->event_name</td>";
                $dataReport.="<td>$key->status</td>";
                $dataReport.="<td>$key->update_at</td>";
                
                $dataReport.="</tr>";
                 $no++;
            }

        }else
            {
                $dataReport.="<tr>";
                $dataReport.="<td colspan=6 style='font-weight:bold;text-align=center'>no data available (shift have no cut off)</td>";
                $dataReport.="</tr>";
            }

        //$dataReport.="</tbody>";
        $dataReport.="</table>";
      

        $dataReport.="</div>";

        $dataReport.="<div style='margin-bottom:25px;width:95%;' align=right>";
        $dataReport.="<p style='margin-right:25px;margin-bottom:70px;'>Jakarta , ".date('d-M-Y')."</p>";
        $dataReport.="<p style='margin-right:60px;'>( Approved )</p>";
        $dataReport.="</div>";    
       


        $dataReport.="</div>";

        try {
            require_once $lib_url;
            $filename="convert.pdf";
            
            $convert= new HTML2PDF();
            $convert->setDefaultFont('arial');
            $convert->writeHTML($dataReport);
            $convert->Output();

         } catch (Exception $e) {

           echo "gagal convert";
         }
    }



    // status value = "processing or review"
    public function shift_preview( $idShift,$status=null )
    {
        $fieldSet=array("shift_date","shift","groud_station","simcard","trouble_ticket","remote_down","routing","ndc","nac","jupiter","activity","next_activity","on_duty");
        $condition="WHERE id_shift = ?";
        $dataBind=array("id_shift"=>$idShift);
        $table=array("tb_shifting");
        $getDataReportShift = $this->M_ShiftReport->getDataListShiftReport($table,$fieldSet,$condition,$dataBind);
        

        foreach ($getDataReportShift as $key) 
        {
            $dataOutput["id_shift"]         = $idShift;
            $dataOutput["shift_date"]       = $key->shift_date;
            $dataOutput["shift"]            = $key->shift;
            $dataOutput["groud_station"]    = $key->groud_station;
            $dataOutput["simcard"]          = $key->simcard;
            $dataOutput["trouble_ticket"]   = $key->trouble_ticket;
            $dataOutput["remote_down"]      = $key->remote_down;
            $dataOutput["routing"]          = $key->routing;
            $dataOutput["ndc"]              = $key->ndc;
            $dataOutput["nac"]              = $key->nac;
            $dataOutput["jupiter"]          = $key->jupiter;
            $dataOutput["activity"]         = $key->activity;
            $dataOutput["next_activity"]    = $key->next_activity;
            $dataOutput["on_duty"]          = $key->on_duty;

        }

    

        /* get data even with status open & investigated */
        $fieldSetEvent=array("tb_event.id_event,tb_event.report_number","tb_event.event_name","tb_status_report.status","tb_event.update_at","tb_event.create_at");
        $conditionEventOpen="WHERE (tb_event.status=? or tb_event.status=?) AND tb_event.status=tb_status_report.id ";
        $dataBindEventOpen=array(
            "status_open"=>"1",
            "status_investigated"=>"2"
        );
        $table_preview=array("tb_event,tb_status_report");
        $getDataReportEventOpen = $this->M_ShiftReport->getDataListShiftReport($table_preview,$fieldSetEvent,$conditionEventOpen,$dataBindEventOpen);
        $dataOutput["data_event_open_status"] = $getDataReportEventOpen ;
       
       
       
         /* get data even with status closed */
        $field=array("begin","end");
        $condition = "WHERE shift=?";
        $table_jadwal=array("tb_jadwal");
        $dataBindShift=array("shift"=>$dataOutput["shift"]);
        $begin_time_shift = $this->M_ShiftReport->getDataListShiftReport($table_jadwal,$field,$condition,$dataBindShift);

        if( $dataOutput["shift"]=="1" || $dataOutput["shift"]=="2" )
        {
           $fromTimeShift = $dataOutput["shift_date"]." ".$begin_time_shift[0]->begin; 
           $endTimeShift = $dataOutput["shift_date"]." ".$begin_time_shift[0]->end; 

        }else{
            //jika shift 3

          $newDate = explode("-",$dataOutput["shift_date"]);
          $day=$newDate[2]+1;
          $date=$newDate[0]."-".$newDate[1]."-".$day;
          
          $fromTimeShift = $dataOutput["shift_date"]." ".$begin_time_shift[0]->begin; 
          $endTimeShift = $date." ".$begin_time_shift[0]->end; 
          

        }      

        //$conditionEventClosed="WHERE tb_event.status=? and tb_event.status=tb_status_report.id and tb_event.event_end BETWEEN ? AND ? ";
        $conditionEventClosed="WHERE tb_event.status=? and tb_event.status=tb_status_report.id and tb_event.update_at BETWEEN ? AND ? ";
        $dataBindEventClosed=array(
            "status_closed"    =>"4",
            "from"             => $fromTimeShift,
            "until"            => $endTimeShift
        );
        
         $getDataReportEventClosed = $this->M_ShiftReport->getDataListShiftReport($table_preview,$fieldSetEvent,$conditionEventClosed,$dataBindEventClosed);

        $dataOutput["data_event_closed_status"] = $getDataReportEventClosed ;
        

        
         /*
          ::=======================================================================================
          :: jika tidak ada kegiatan selama 1 shift atau lebih karena error system / network dll
          :: ====================================================================================== 
         */ 

          if( count($getDataReportEventClosed)== 0)
           {

                //$conditionEventClosed="WHERE tb_event.status=? and tb_event.status=tb_status_report.id and tb_event.event_end BETWEEN ? AND ? ";
                $conditionEventClosed="WHERE tb_event.status=? and tb_event.status=tb_status_report.id and tb_event.update_at BETWEEN ? AND ? ";
                $dataBindEventClosed=array(
                    "status_closed"     =>"4",
                    "from"              => $fromTimeShift,
                    "until"             => date('Y-m-d H:i:s')
                );
                $getDataReportEventClosed = $this->M_ShiftReport->getDataListShiftReport($table_preview,$fieldSetEvent,$conditionEventClosed,$dataBindEventClosed);

                $dataOutput["data_event_closed_status"] = $getDataReportEventClosed ;


           }

           /*
          ::=======================================================================================
          :: end off
          :: ====================================================================================== 
         */  
        

        if($status == "processing" )
        {
            $this->cut_off($idShift,$dataOutput);

        }else if($status == "review"){

            $dataOutput['page']="Shifting Review";
            $dataOutput['title']="Shifting Review";

            
            $this->template->views('shift_report/Shifting_Review',$dataOutput);
        }else{

         
            $dataOutput['page']="Shifting Preview";
            $dataOutput['title']="Shifting Preview";
            //var_dump( $dataOutput["activity"]);
            $this->template->views('shift_report/Shifting_Preview',$dataOutput);    
        }
        
    }





    public function cut_off($idShift,$dataCutOff)
    {

        // var_dump($dataCutOff['data_event_closed_status']);

        if( !empty($this->session->userdata("username")) || $this->session->userdata("username") != ''  )
        {

             $user = $this->session->userdata("nama")." [ ".$this->session->userdata("username")." ] ";    

                $data_activity=array(

                    "shift"=>$dataCutOff['shift'],
                    "date"=>$dataCutOff['shift_date'],
                    "activity"=>array(

                            "report"=> array(
                                    "groud_station"     =>  $dataCutOff['groud_station'],
                                    "simcard"           =>  $dataCutOff['simcard'],
                                    "trouble_ticket"    =>  $dataCutOff['trouble_ticket'],
                                    "remote_down"       =>  $dataCutOff['remote_down'],
                                    "routing"           =>  $dataCutOff['routing'],
                                    "ndc"               =>  $dataCutOff['ndc'],
                                    "nac"               =>  $dataCutOff['nac'],
                                    "jupiter"           =>  $dataCutOff['jupiter'],
                                ),
                            "event" => $dataCutOff['data_event_closed_status']
                        )
                );

               $data_next_activity = array(

                    "shift"=>$dataCutOff['shift'],
                    "date"=>$dataCutOff['shift_date'],
                    "activity"=>array(

                            "event" => $dataCutOff['data_event_open_status']
                        )
                );

                
                $table_cek=array("tb_shifting");
                $field_cek=array("on_duty","next_duty","user_create","groud_station","simcard","trouble_ticket","remote_down","routing","ndc","nac","jupiter");
                $condition_cek="WHERE id_shift=?";
                $dataBind=array("id_shift"=>$idShift);

                $data_on_duty = $this->M_ShiftReport->getDataListShiftReport($table_cek,$field_cek,$condition_cek,$dataBind);

                $on_duty        =   $data_on_duty[0]->on_duty;
                $next_duty      =   $data_on_duty[0]->next_duty;
                $user_create    =   $data_on_duty[0]->user_create;
                $groud_station  =   $data_on_duty[0]->groud_station;
                $simcard        =   $data_on_duty[0]->simcard;
                $trouble_ticket =   $data_on_duty[0]->trouble_ticket;
                $remote_down    =   $data_on_duty[0]->remote_down;
                $routing        =   $data_on_duty[0]->routing;
                $ndc            =   $data_on_duty[0]->ndc;
                $nac            =   $data_on_duty[0]->nac;
                $jupiter        =   $data_on_duty[0]->jupiter;

                if( $on_duty=='' || $next_duty=='' )
                {
                    $status=false;
                    $message="  data on duty or next duty still empty  ";
                
                }else if( $groud_station=='' || $simcard=='' || $trouble_ticket=='' || $remote_down=='' || $routing=='' || $ndc=='' || $nac=='' || $jupiter=='' )
                    {
                        $status=false;
                        $message= " report team still empty  ";

                    }else{

                            

                            if( trim($user) == trim($user_create))
                            {
                                $table_update="tb_shifting";
                                $field_update=array("activity","next_activity");
                                $condition_update="WHERE id_shift=?";
                                $dataBindUpdate=array(

                                        "activity"=>json_encode($data_activity),
                                        "next_activity"=>json_encode($data_next_activity),
                                        "id_shift"=>$idShift
                                    );

                                $update_table =$this->M_ShiftReport->UpdateDataListShiftReport( $table_update,$field_update,$condition_update,$dataBindUpdate );

                                    if($update_table)
                                    {
                                        $status = true;
                                        $message = "DATA SAVED";
                                    }else{

                                        $status = false;
                                        $message = "ERROR QUERY :".$update_table;
                                
                                    }     
                            
                            }else{
                                $status=false;
                                $message="shift report created by : ".$user_create." !";
                            }

                   
                    }

                $output=array(
                    "status" => $status,
                    "message" => $message
                );


               

        }else{

            $output=array(
                    "status" => false,
                    "message" => "session login habis.."
            );
        }    
        
         echo json_encode($output);

    }


   public function update_data_report()
   {
        /*
        ::------------------------------------------------------------------------------------------
        :: fungsi ini digunakan untuk 2 form berbeda 
        :: 1. proses update form_team ( createReport.php ) &
        :: 2. proses update form_duty ( shiftPersonil.php ) 
        ::-------------------------------------------------------------------------------------------
        */

        $dataForm=$this->input->post("dataForm");
        $id_shift = $this->input->post("id_shift");
        $fieldName = $dataForm."_textarea";

        $this->form_validation->set_rules($fieldName,$fieldName,"trim|required");

        if($this->form_validation->run()==false)
        {
            $validationStatus=false;
        }else{
            $validationStatus=true;

        }

        if($validationStatus==true)
        {
            $data_input = $this->input->post($fieldName);
            $fieldset=array($dataForm,"user_update","update_at");
            $condition = "WHERE id_shift=?";
             $user_update = $this->session->userdata("nama")." [ ".$this->session->userdata("nama")." ] ";
            $dataBind=array(
                "textField"=>$data_input,
                "user_update"=>$user_update,
                "update_at"=>date('Y-m-d h:i:s'),
                "id_shift"=>$id_shift
            );
            $process_update = $this->M_ShiftReport->UpdateDataListShiftReport("tb_shifting",$fieldset,$condition,$dataBind);
        
        }else{
            $process_update ="invalid";
        }

        $output = array(
            "validationStatus"=>$validationStatus,
            "process_update" => $process_update
        );

        echo json_encode($output);
   }

   public function update_page($id_shift)
   {
        $field=array("shift_date","shift","groud_station","simcard","trouble_ticket","remote_down","routing","ndc","nac","jupiter","activity");
        $condition = "WHERE id_shift=?";
        $dataBind=array("id_shift"=>$id_shift);
        $table=array("tb_shifting");
        $getDataShift= $this->M_ShiftReport->getDataListShiftReport($table,$field,$condition,$dataBind);



        $data_page=array(
            "id_shift"=>$id_shift,
            "title"=>"Create Report",
            "page" =>"Create Report"
        );

        foreach ($getDataShift as $key) {
           
           $data_page['shift_date']= $key->shift_date;
           $data_page['shift']= $key->shift;
           $data_page['data_groud_station']= $key->groud_station;
           $data_page['data_simcard']= $key->simcard;
           $data_page['data_trouble_ticket']= $key->trouble_ticket;
           $data_page['data_remote_down']= $key->remote_down;
           $data_page['data_routing']= $key->routing;
           $data_page['data_ndc']= $key->ndc;
           $data_page['data_nac']= $key->nac;
           $data_page['data_jupiter']= $key->jupiter;
           $data_page['data_activity']= $key->activity;
        }
        $this->template->views("shift_report/createReport",$data_page);
   }

  

   public function checkDataShift()
   {
        $table=array("tb_shifting");
        $field=array("MAX(id_shift) as id_shift");
        $checkProcess=$this->M_ShiftReport->getDataListShiftReport($table,$field,null,null);

        if( $checkProcess[0]->id_shift==null )
        {
            $this->insertDataShift();
           // $this->createShift();
        
        }else{

            $last_id_shift = $checkProcess[0]->id_shift;
            $tableCheck=array("tb_shifting");
            $fieldCheck=array("activity","next_activity","on_duty","next_duty");
            $conditionCheck="WHERE id_shift=?";
            $dataBindCheck=array( "last_id_shift" => $last_id_shift );

            $dataShift=$this->M_ShiftReport->getDataListShiftReport($tableCheck,$fieldCheck,$conditionCheck,$dataBindCheck);

            foreach ($dataShift as $key) 
            {
                $dataActivity=$key->activity;
                $dataNextActivity=$key->next_activity;
                $dataOnDuty=$key->on_duty;
                $dataNextDuty=$key->next_duty;
            }

            if($dataActivity =="" || $dataNextActivity=="" || $dataOnDuty=="" || $dataNextDuty=="")
            {
                $output = array(
                    "process_insert"=>false,
                    "message" => " ANOTHER SHIFT HAVE NO CUT OFF YET "
                );

                echo json_encode($output);

            }else{

                $this->insertDataShift();
               // $this->createShift();
            }    
        }
   }

   /* public function createShift()
   {
        $dateCreate=date("Y-m-d H:i:s");
        // $timeCreate= strtotime( date("H:i:s") );
         $timeCreate= date("H:i:s") ;

        if($timeCreate > "06:00:00")
        {
            echo "true : $timeCreate";
        }else{
            echo "false : $timeCreate";
        }

        if($timeCreate >= "07:00:00" && $timeCreate <= "14:59:59")
        {
            $Shift="pagi";
        }else{
            $Shift="siang";
        }

        echo $Shift;

        $output = array(
            "dateCreate"=>$dateCreate,
            "timeCreate"=>$timeCreate
        );
        echo json_encode($output);
   }*/


   public function insertDataShift()
   {

        if( $this->session->userdata('username') != null || $this->session->userdata('username') != '')
        {

            $this->form_validation->set_rules("shift","shift","trim|required");
            $this->form_validation->set_rules("tanggal_shift","tanggal_shift","trim|required");

            $field=array();
            if($this->form_validation->run()==false)
            {
                $validationStatus = false;

                foreach ($_POST as $key => $value) 
                {
                    if( empty($_POST[$key]) || $_POST[$key]=='' || $_POST[$key]==null )
                    {
                        array_push($field,$key);
                    }    
                }

                $process_insert="failed";

            }else{

                $validationStatus = true;

                $user_create = $this->session->userdata("nama")." [ ".$this->session->userdata("username")." ] ";
                $dataParams=array(
                    "id_shift"=>null,
                    "shift_date"=>$this->input->post("tanggal_shift"),
                    "shift" =>$this->input->post("shift"),
                    "user_create" =>$user_create,
                    "create_at" => date("Y-m-d h:i:s")

                );
                $process_insert = $this->M_ShiftReport->insertDataShift($dataParams);

            }

            $output = array(
                "validation_status"=>$validationStatus,
                "field" =>$field,
                "process_insert"=>$process_insert
            );
         
         }else{

             $output = array(
                "validation_status"=>'',
                "field" =>'',
                "process_insert"=>'',
                "message"=>' session is end , please relogin'
            );
         }
            

        echo json_encode($output);
   }
    

    public function tableShiftReport()
    {
        $data['page'] = 'table_shift';
        $data['title'] = 'Shifting Report';
        $this->template->views('shift_report/tableShiftReport',$data);
    }

    public function updateReportShift()
    {
        $data['page'] = 'Create Report';
        $data['title'] = '::Create Report::';
        $this->template->views('shift_report/createReport',$data);
    }


    public function showListShiftReport()
    {
        //var_dump($this->input->post());
        $columns=array("No","Tanggal","Shift","Action");

        
        $field=array("id_shift","shift_date","shift");
        $table=array("tb_shifting");
        $totalData = count( $this->M_ShiftReport->getDataListShiftReport($table,$field,null,null) ) ;
        

        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $sort = $this->input->post("order[0][dir]");
        $search = $this->input->post("search[value]");

        $order = $this->input->post("order[0][column]");



        switch($order)
        {
            case '0' : 
                $orderBy = "id_shift";
            break;
            
            case '1' : 
                $orderBy = "shift_date";
            break;

            case '2' : 
                $orderBy = "shift";
            break;

            default : $orderBy = "id_shift"; break;    
        }

        if(empty($search))
        {
            $field=array("id_shift","shift_date","shift");
            $condition = " ORDER BY $orderBy $sort LIMIT $start,$limit ";
            $table=array("tb_shifting");
            $listData = $this->M_ShiftReport->getDataListShiftReport($table,$field,$condition,null);

        }else{

            $field=array("id_shift","shift_date","shift");
            $condition = "WHERE id_shift like '%$search%' or shift_date like '%$search%' or shift like '%$search%'  ORDER BY $orderBy $sort LIMIT $start,$limit ";
            $table=array("tb_shifting");
            $listData = $this->M_ShiftReport->getDataListShiftReport($table,$field,$condition,null);

        }

      
        $data = array();
        $no=1;
        foreach ($listData as $key) 
        {


            /*
            ::===================================
            :: checking ...have shift cut off ??
            ::===================================
            */

            $field_check=array("activity");
            $condition_check = "WHERE id_shift = ? ";
            $table_check=array("tb_shifting");
            $param_check=array("id_shift"=>$key->id_shift);
            $status_check = $this->M_ShiftReport->getDataListShiftReport($table_check,$field_check,$condition_check,$param_check);
            $status=$status_check[0]->activity;

           

            if($status !='')
             {
                $button     = "<a class='btn btn-primary btn-xs' href='update_page/$key->id_shift' title='edit' > <span class='glyphicon glyphicon-pencil'> </a>&nbsp;";
                $button    .= "<a class='btn btn-warning btn-xs' href='shift_preview/$key->id_shift' title='preview' >  <span class='glyphicon glyphicon-eye-open'></span> </a>&nbsp;";
                $button    .= "<a class='btn btn-success btn-xs' href='list_shift_personil/$key->id_shift' title='show list personil' >  <span class='glyphicon glyphicon-user'></span> </a>&nbsp;";
                $button    .= "<a class='btn btn-info btn-xs' href='shift_preview/$key->id_shift/review' title='convert & print' >  <span class='glyphicon glyphicon-print'></span> </a>&nbsp; ";
             
             }else{

                     $button     = "<a class='btn btn-primary btn-xs' href='update_page/$key->id_shift' title='edit' > <span class='glyphicon glyphicon-pencil'> </a>&nbsp;";
                     $button    .= "<a class='btn btn-warning btn-xs' href='shift_preview/$key->id_shift' title='preview' >  <span class='glyphicon glyphicon-eye-open'></span> </a>&nbsp;";
                     $button    .= "<a class='btn btn-success btn-xs' href='list_shift_personil/$key->id_shift' title='show list personil' >  <span class='glyphicon glyphicon-user'></span> </a>&nbsp;";
                     
             }


            /*
            ::===================================
            :: end checking 
            ::===================================
            */

             $list=array(
                "No" => $no,
                "Tanggal" => $key->shift_date,
                "Shift" => $key->shift,
                "Action" => $button
            );

             

            array_push($data,$list);
            $no++;
        }

       

        $output = array(

            "draw"=>intval( $this->input->post('draw') ),
            "recordsTotal"=>intval($totalData),
            "recordsFiltered"=>intval($totalData),
            "data"=>$data
        );

        echo json_encode($output);
    }
}

