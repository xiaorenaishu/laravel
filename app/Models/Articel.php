<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Articel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Articel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Articel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Articel query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $role_id
 * @property string $real_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Articel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Articel whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Articel whereRoleId($value)
 */
class Articel extends Model
{
    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = '';
}
