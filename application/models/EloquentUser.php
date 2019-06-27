<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentUser extends Eloquent {
    protected $table = 'tb_user';
    public $timestamps = false;
}
