<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\MainTopic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Formset
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|MainTopic[] $main_topics
 *
 * @package App\Models\Base
 */
class Formset extends Model
{
	protected $table = 'formsets';

	public function main_topics()
	{
		return $this->hasMany(MainTopic::class, 'form_id');
	}
}
