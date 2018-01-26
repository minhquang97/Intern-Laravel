<?php

namespace App\Model;

use App\Notifications\TeacherResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Teacher extends Authenticatable
{
    use Notifiable;
	protected $fillable = [
		'id' , 'name' , 'birthday' , 'email', 'password',
	];
	public function classes()
	{
		return $this->hasMany(Classes::class);
	}

    protected $hidden = [
        'password', 'remember_token',
    ];
    public $primaryKey = 'id';

    public function verified()
    {
        $this->status = 1;
        $this->email_token = null;
        $this->save();
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TeacherResetPasswordNotification($token));
    }
/*
    public function create(array $data){
        return Teacher::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'birthday' => $data['birthday'],
            'password' => ($data['password']),
            'email' => $data['email'],
        ]);
    }*/
    //
}
