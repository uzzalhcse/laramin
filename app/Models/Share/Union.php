<?php

namespace App\Models\Share;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Share\Union
 *
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property int|null $bbs_code
 * @property int $upazila_id
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Union newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Union newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Union query()
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereBbsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Union extends Model
{
    use HasFactory;
}
