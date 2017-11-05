<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Student extends Model
{
    protected $fillable = ['id','name', 'birthday', 'address', 'class'];

    public function classes()
    {
    	return $this->belongsToMany('App\Model\Classes','student_class','student_id','class_id')->withPivot('score');
    }
}

