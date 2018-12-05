<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Student
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $sex
 * @property int $age
 * @property string $name
 * @property \Illuminate\Support\Carbon $create_time
 * @property \Illuminate\Support\Carbon $update_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereUpdateTime($value)
 */
class Student extends Model
{
    protected $table = 'student';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'age', 'sex']; //可批量添加的字段, create()方法需要用到

    const CREATED_AT = 'create_time'; // 重定义定义时间的字段名
    const UPDATED_AT = 'update_time';

    public $timestamps = true;

    protected $dateFormat = 'U';

    const SEX_UN = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    public function getSex($sex = null)
    {
        $array = [
            self::SEX_UN => '未知',
            self::SEX_MALE => '男',
            self::SEX_FEMALE => '女',
        ];
        if (is_null($sex)) {
            return $array;
        }

        return $array[$sex] ?? $array[self::SEX_UN];
    }

}
