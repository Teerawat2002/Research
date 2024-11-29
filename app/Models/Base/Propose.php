<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Advisor;
use App\Models\ProjectGroup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Propose
 * 
 * @property int $id
 * @property string $title
 * @property string $objective
 * @property string $scope
 * @property string|null $tools
 * @property int|null $group_id
 * @property string|null $type_id
 * @property string $status
 * @property string|null $comments
 * @property int|null $a_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ProjectGroup|null $project_group
 * @property Advisor|null $advisor
 *
 * @package App\Models\Base
 */
class Propose extends Model
{
	protected $table = 'proposes';

	protected $casts = [
		'group_id' => 'int',
		'a_id' => 'int'
	];

	public function project_group()
	{
		return $this->belongsTo(ProjectGroup::class, 'group_id');
	}

	public function advisor()
	{
		return $this->belongsTo(Advisor::class, 'a_id');
	}
}
