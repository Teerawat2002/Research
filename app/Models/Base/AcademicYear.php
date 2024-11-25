<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AcademicYear
 * 
 * @property int $id
 * @property string $year
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Student[] $students
 *
 * @package App\Models\Base
 */
class AcademicYear extends Model
{
	protected $table = 'academic_years';

	public function students()
	{
		return $this->hasMany(Student::class, 'ac_id');
	}
}
