<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentRemoteTicket extends Eloquent {
    protected $table = 'tb_remote_ticket';
    public $timestamps = false;
    public $guarded = ['id'];
}
