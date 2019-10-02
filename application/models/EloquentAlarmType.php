<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentAlarmType extends Eloquent {
    protected $table = 'tb_alarm_type';
    public $timestamps = false;
    public $guarded = ['id'];
}