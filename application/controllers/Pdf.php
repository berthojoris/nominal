<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

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

    public function test()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();
    }

    public function relokasi()
    {
        $path = APPPATH."/views/pdf/about.php";
        try {
            $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->pdf->SetDisplayMode('fullpage');
            ob_start();
            include $path;
            $content = ob_get_clean();
            $html2pdf->writeHTML($content);
            $html2pdf->createIndex('Sommaire', 30, 12, false, true, 2, null, '10mm');
            $html2pdf->output('about.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

}