<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentAlarm extends Eloquent {
    protected $table = 'tb_alarm';
    public $timestamps = false;
    public $guarded = ['id'];
}