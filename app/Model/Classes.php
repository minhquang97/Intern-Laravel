<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
	protected $fillable = [
		'id' , 'teacher_id' , 'subject_id' , 'semester'
	];

	public function teacher() 
	{
		return $this->belongsto('App\Model\Teacher');
	}

	public function subject()
	{
		return $this->belongsto('App\Model\Subject');
	}

	 public function students()
	    {
	    	return $this->belongsToMany('App\Model\Student','student_class','class_id','student_id')->withPivot('score');
	    }
    //
}
