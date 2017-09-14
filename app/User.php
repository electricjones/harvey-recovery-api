<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property string uuid
 * @property string phone
 * @property string location_home
 * @property string location_now
 * @property string group_count
 * @property string dashboard_content
 * @package App
 */
class User extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'uuid';

    public static function makeId($input)
    {
        return sha1($input);
    }
}
