<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Dompdf\Dompdf;

class Pdf extends CI_Controller {
    
    public function __construct() 
    {
		parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url'));
		if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function fpdf()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();
    }

    public function dompdf()
    {
        $cssPath = realpath(FCPATH.'assets/pdf/');
        $fileUrl = base_url()."index.php/showpdf/viewdetail";
        $fileContent = file_get_contents($fileUrl) ;

        $dompdf = new Dompdf();
        // $dompdf->set_base_path($cssPath);
        $dompdf->loadHtml($fileContent);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("detail_".date("Y-m-d H:i:s").".pdf");
    }

}