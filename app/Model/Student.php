<?php
namespace App\Model;
use function bcrypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Student extends Authenticatable
{
    protected $fillable = ['id' , 'name' , 'birthday' , 'address' , 'class', 'email', 'password',];

    public function classes()
    {
    	return $this->belongsToMany(Classes::class,'student_class','student_id','class_id')->withPivot('score');
    }

    protected $hidden = [
         'remember_token', 'password',
    ];

    public $primaryKey = 'id';

    public function verified()
    {
        $this->status = 1;
        $this->email_token = null;
        $this->save();
    }

    /*public function create($data){
       return Student::create([
           'id' => $data->id,
           'name' => $data->name,
           'address' =>$data->address,
           'birthday' => $data->birthday,
           'class' => $data->class,
           'password' => bcrypt($data->password),
           'email' => $data->email,
       ]);
    }*/
}

