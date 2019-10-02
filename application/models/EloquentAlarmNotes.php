<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentAlarmNotes extends Eloquent {
    protected $table = 'tb_alarm_notes';
    public $timestamps = false;
    public $guarded = ['id'];
}