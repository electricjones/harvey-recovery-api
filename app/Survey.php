<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Survey
 * @property int id
 * @property string user_id
 * @property string survey
 *
 * @package App
 */
class Survey extends Model
{
    const COMPLETE_FOR_MYSELF = 'myself';
    const COMPLETE_FOR_OTHER = 'other';

    const ANSWER_NO = 'no';
    const ANSWER_YES = 'yes';

    const SHELTER_NOW = 'shelter-now';
    const SHELTER_LONG_TERM = 'shelter-long-term';

    const FOOD_NOW = 'food-now';
    const FOOD_LONG_TERM = 'food-long-term';

    const HOME_FLOOD_LITTLE = 'home-flood-little';
    const HOME_FLOOD_TOTAL = 'home-flood-total';

    const HOME_FLOOD_HAVE_INSURANCE = 'home-flood-have-insurance';
    const HOME_FLOOD_NO_INSURANCE = 'home-flood-no-insurance';

    const FIND_PEOPLE = 'find-people';
    const FIND_PETS = 'find-pets';
    const FIND_AUTO = 'find-auto';

    protected $guarded = ['id'];
}
