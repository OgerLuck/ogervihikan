<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model{

	protected $table = 'tb_blogs';
    protected $primaryKey = 'ID';
}