<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\GroupMember;
use App\Models\Propose;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectGroup
 * 
 * @property int $id
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|GroupMember[] $group_members
 * @property Collection|Propose[] $proposes
 * @property Collection|Student[] $students
 *
 * @package App\Models\Base
 */
class ProjectGroup extends Model
{
	protected $table = 'project_groups';

	public function group_members()
	{
		return $this->hasMany(GroupMember::class, 'group_id');
	}

	public function proposes()
	{
		return $this->hasMany(Propose::class, 'group_id');
	}

	public function students()
	{
		return $this->hasMany(Student::class, 'group_id');
	}
}
