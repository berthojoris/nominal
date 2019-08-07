<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentJenisJarkom extends Eloquent {
    protected $table = 'tb_jenis_jarkom';
    public $timestamps = false;
    public $guarded = ['id'];
}