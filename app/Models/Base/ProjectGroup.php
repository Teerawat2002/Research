<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\GroupMember;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectGroup
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|GroupMember[] $group_members
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
}
