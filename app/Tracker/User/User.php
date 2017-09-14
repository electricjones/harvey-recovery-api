<?php
namespace App\Tracker\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property string id
 * @property string hash
 * @property string tenant
 * @property string phone
 * @property string email
 * @package App
 */
class User extends Model
{
    protected $guarded = ['id'];

    /**
     * Creates the user's unique hash
     * @param $input
     * @return string
     */
    public static function makeHash($input)
    {
        return sha1($input);
    }
}
