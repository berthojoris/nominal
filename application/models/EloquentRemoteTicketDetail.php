<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentRemoteTicketDetail extends Eloquent
{
    protected $table = 'tb_remote_ticket_detail';
    public $timestamps = false;
    public $guarded = ['id'];
}

