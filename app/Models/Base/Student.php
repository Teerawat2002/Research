<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\AcademicYear;
use App\Models\GroupMember;
use App\Models\Major;
use App\Models\ProjectGroup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * 
 * @property int $id
 * @property int $s_id
 * @property string $s_fname
 * @property string $s_lname
 * @property string $s_password
 * @property string $status
 * @property int $m_id
 * @property int $ac_id
 * @property int|null $group_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AcademicYear $academic_year
 * @property Major $major
 * @property ProjectGroup|null $project_group
 * @property Collection|GroupMember[] $group_members
 *
 * @package App\Models\Base
 */
class Student extends Model
{
	protected $table = 'students';

	protected $casts = [
		's_id' => 'int',
		'm_id' => 'int',
		'ac_id' => 'int',
		'group_id' => 'int'
	];

	public function academic_year()
	{
		return $this->belongsTo(AcademicYear::class, 'ac_id');
	}

	public function major()
	{
		return $this->belongsTo(Major::class, 'm_id');
	}

	public function project_group()
	{
		return $this->belongsTo(ProjectGroup::class, 'group_id');
	}

	public function group_members()
	{
		return $this->hasMany(GroupMember::class, 's_id');
	}
}
