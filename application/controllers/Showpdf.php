<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Showpdf extends CI_Controller {
    
    public function viewdetail()
    {
        $this->load->view('pdf/viewdetail');
    }

}