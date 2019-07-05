<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('EloquentUser');
    }
    
    public function index()
    {
		  $users = EloquentUser::take(5)->get();
		
      return view('api', [
        'users' => $users
      ]);
    }
}
