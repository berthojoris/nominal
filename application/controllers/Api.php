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
        foreach ($users as $key => $value) {
            echo "ID : ".$value->id."<br>";
            echo "Nama : ".$value->nama."<br>";
            echo "Username : ".$value->username."<br>";
            echo "Email : ".$value->email."<br><br>";
        }
    }
}
