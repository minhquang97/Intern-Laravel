<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	protected $fillable = [
		'id' , 'name' , 'birthday' , 'email'
	];
	public function classes()
	{
		return $this->hasMany(Classes::class);
	}
    //
}
