<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

	protected $table = 'tb_users';
    protected $primaryKey = 'ID';
}