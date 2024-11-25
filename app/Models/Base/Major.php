<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Advisor;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Major
 * 
 * @property int $id
 * @property string $m_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Advisor[] $advisors
 * @property Collection|Student[] $students
 *
 * @package App\Models\Base
 */
class Major extends Model
{
	protected $table = 'majors';

	public function advisors()
	{
		return $this->hasMany(Advisor::class, 'm_id');
	}

	public function students()
	{
		return $this->hasMany(Student::class, 'm_id');
	}
}
