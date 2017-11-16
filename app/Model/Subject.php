<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $fillable = [
		'id' , 'name' , 'credits'
	];

	public function classes() 
	{
		return $this->hasMany(Classes::class);
	}
    public $primaryKey = 'id';
    //
}
