<?php

namespace App\Tracker\Survey;
use App\Tracker\User\User;

/**
 * Class SurveyRepository
 * @package App\Http\Controllers
 */
class SurveyRepository
{
    /**
     * @param $responses
     * @param $user_id
     * @return Survey|array
     */
    public function addFromSurveyResponses($responses, $user_id)
    {
        return Survey::create([
        'user_id' => $user_id,
            'responses' => json_encode($responses)
        ]);
    }

    /**
     * @param User $user
     * @return Survey
     */
    public function latestForUser(User $user)
    {
        return Survey::where([
            'user_id' => $user->id
        ])->latest()->first();
    }
}
