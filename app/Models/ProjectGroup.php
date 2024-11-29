<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGroup extends Model
{
    protected $table = 'project_groups';

    protected $fillable = ['status'];

	public function group_members()
	{
		return $this->hasMany(GroupMember::class, 'group_id');
	}

	public function students()
	{
		return $this->hasMany(Student::class, 'group_id');
	}
}
