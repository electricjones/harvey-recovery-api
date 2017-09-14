<?php
namespace App\Tracker\Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Survey
 * @property int id
 * @property string user_id
 * @property string responses
 *
 * @package App
 */
class Survey extends Model
{
    protected $guarded = ['id'];

    /**
     * @param $value
     * @return mixed
     */
    public function getResponsesAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * @param $value
     */
    public function setResponsesAttribute($value)
    {
        $this->attributes['responses'] = json_encode($value);
    }
}
