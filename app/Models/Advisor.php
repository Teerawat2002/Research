<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Advisor extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdvisorFactory> */
    use HasFactory;

    protected $table = 'advisors'; // ชื่อตารางในฐานข้อมูล

    protected $fillable = [
        'a_id',
        'a_fname',
        'a_lname',
        'a_password',
        'a_type',
        'm_id',
        'status',
    ];

    protected $hidden = [
        'a_password',
    ];

    public function getAuthPassword()
    {
        return $this->a_password; // ระบุรหัสผ่านที่ใช้สำหรับการ Auth
    }

    public function major()
	{
		return $this->belongsTo(Major::class, 'm_id', 'id');
	}

    public function proposes()
	{
		return $this->hasMany(Propose::class, 'a_id');
	}

    public function getNameAttribute()
    {
        return $this->a_fname . ' ' . $this->a_lname;
    }
}
