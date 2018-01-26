<?php

namespace App;

use App\Model\Student;
use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
	protected $fillable = ['user_id', 'provider_user_id', 'provider'];
	
	public function user()
	{
	    return $this->belongsTo(Student::class);
	}
    //
}
