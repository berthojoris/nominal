<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentJarkomTicket extends Eloquent {
    protected $table = 'tb_jarkom_ticket';
    public $timestamps = false;
    public $guarded = ['id'];
}
