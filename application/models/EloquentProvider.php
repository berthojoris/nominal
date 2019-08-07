<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentProvider extends Eloquent {
    protected $table = 'tb_provider';
    public $timestamps = false;
    public $guarded = ['id'];
}