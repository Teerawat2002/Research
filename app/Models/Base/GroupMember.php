<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ProjectGroup;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupMember
 * 
 * @property int $id
 * @property int $group_id
 * @property int $s_id
 * @property string|null $grade
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ProjectGroup $project_group
 * @property Student $student
 *
 * @package App\Models\Base
 */
class GroupMember extends Model
{
	protected $table = 'group_members';

	protected $casts = [
		'group_id' => 'int',
		's_id' => 'int'
	];

	public function project_group()
	{
		return $this->belongsTo(ProjectGroup::class, 'group_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 's_id');
	}
}
