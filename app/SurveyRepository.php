<?php

namespace App;
/**
 * Class SurveyRepository
 * @package App\Http\Controllers
 */
class SurveyRepository
{
    /**
     * @param $responses
     * @param $user_id
     * @return Survey
     */
    public function addFromSurveyResponses($responses, $user_id)
    {
        return Survey::create([
            'user_id' => $user_id,
            'survey' => json_encode([
                'completing_for' => $responses['completing_for'],
                'medical_help' => $responses['medical_help'],
                'location_home' => $responses['location_home'],
                'location_now' => $responses['location_now'],
                'group_count' => $responses['group_count'],
                'shelter' => $responses['shelter'],
                'food' => $responses['food'],

                // multiple selection
                'home_flood' => $responses['home_flood'],
                'find' => $responses['find'],
            ])
        ]);
    }
}
