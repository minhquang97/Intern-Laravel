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
    protected $fillable = ['name', 'birthday', 'address', 'class'];
}

