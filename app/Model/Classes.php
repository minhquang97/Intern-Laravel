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
		return $this->belongsto(Teacher::class);
	}

	public function subject()
	{
		return $this->belongsto(Subject::class);
	}

    public function students()
    {
	   	return $this->belongsToMany(Student::class,'student_class','class_id','student_id')->withPivot('score');
    }

    //
}
