<?php

namespace App\Models\Share;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Share\Upazila
 *
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property int|null $bbs_code
 * @property int $district_id
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Share\District $district
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Share\Union[] $unions
 * @property-read int|null $unions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila query()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereBbsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Upazila extends Model
{
    use HasFactory;

    public function unions(){
        return $this->hasMany(Union::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
}
