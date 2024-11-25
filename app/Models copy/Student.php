<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\AdvisorFactory> */
    use HasFactory;

    protected $fillable = [
        's_id',
        's_fname',
        's_lname',
        's_password',
        'status',
        'm_id',
        'ac_id',
    ];

    protected $hidden = [
        's_password', // ซ่อนรหัสผ่าน
    ];

    public function getNameAttribute()
    {
        return $this->s_fname;
    }

    public function getAuthPassword()
    {
        return $this->s_password; // ระบุรหัสผ่านที่ใช้สำหรับการ Auth
    }
}
