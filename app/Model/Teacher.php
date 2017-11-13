<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{
	protected $fillable = [
		'id' , 'name' , 'birthday' , 'email', 'password'
	];
	public function classes()
	{
		return $this->hasMany(Classes::class);
	}

    protected $hidden = [
        'password', 'remember_token',
    ];
    //
}
