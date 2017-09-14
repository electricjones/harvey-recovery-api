<?php
namespace App;

/**
 * Class Answers
 * @package App\Http\Controllers
 */
class Answers
{
    /** @var array */
    // @todo: pull this from the mysql table
    protected $questions_with_answers = [
        'medical_help', 'shelter', 'food', 'home_flood', 'find'
    ];

    /** @var array */
    // @todo: abstract this to a more easily updatable format
    protected $answers = [
        'medical_help' => [
            Survey::ANSWER_YES => 'If you need help with routine and life-saving <strong>medical treatment or medicines</strong>, please see <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001801634" target="_blank">this resource</a> for trusted help.',
        ],
        'shelter' => [
            Survey::SHELTER_NOW => 'If you need <strong>immediate shelter</strong>, please use <a href="https://johnnyqbui.github.io/Houston-Shelters/" target="_blank">this map</a> to find shelters that are accepting people.',
            Survey::SHELTER_LONG_TERM => 'If you need <strong>long term shelter</strong> because your home is flooded, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001746874" target="_blank">register with FEMA</a> for temporary housing and supplies.',
        ],
        'food' => [
            Survey::FOOD_NOW => 'If you need <strong>food immediately</strong>, please <a href="http://www.houstonfoodbank.org/services/if-you-need-food" target="_blank">use this resource</a> to find local food banks.',
            Survey::FOOD_LONG_TERM => 'If you need <strong>food for the long term</strong>, please <a href="http://www.houstonfoodbank.org/services/if-you-need-food" target="_blank">use this resource</a> to find local food banks.',
        ],

        'home_flood' => [
            Survey::HOME_FLOOD_HAVE_INSURANCE => 'If <strong>your home is flooded</strong> the first thing you should do is <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001746874" target="_blank">register with FEMA</a>, even if you do not need housing. They will have disaster relief funds you may be entitled to. Next, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001820393" target="_blank">follow this guide</a> to begin the recovery process.',
            Survey::HOME_FLOOD_LITTLE => 'If <strong>your home is flooded</strong> the first thing you should do is <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001746874" target="_blank">register with FEMA</a>, even if you do not need housing. They will have disaster relief funds you may be entitled to. Next, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001820393" target="_blank">follow this guide</a> to begin the recovery process.',
            Survey::HOME_FLOOD_TOTAL => 'If <strong>your home is flooded</strong> the first thing you should do is <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001746874" target="_blank">register with FEMA</a>, even if you do not need housing. They will have disaster relief funds you may be entitled to. Next, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001820393" target="_blank">follow this guide</a> to begin the recovery process.',
            Survey::HOME_FLOOD_NO_INSURANCE => 'If <strong>your home is flooded</strong> the first thing you should do is <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001746874" target="_blank">register with FEMA</a>, even if you do not need housing. They will have disaster relief funds you may be entitled to. Next, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001820393" target="_blank">follow this guide</a> to begin the recovery process.',
        ],

        'find' => [
            Survey::FIND_AUTO => 'If you need to find your <strong>towed car</strong>> please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001748914" target="_blank">use this resource</a>.',
            Survey::FIND_PEOPLE => 'If you need find <strong>missing or displaced persons</strong>, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001745233" target="_blank">use this resource</a>.',
            Survey::FIND_PETS => 'If you need to find <strong>missing pets</strong>, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001747133" target="_blank">use this resource</a>.',
        ]
    ];

    /**
     * @param Survey $survey
     * @return array
     */
    public function forSurvey(Survey $survey)
    {
        // Get the latest survey
        $answers = [];
        foreach (json_decode($survey->survey, true) as $key => $value) {
            if ($answer = $this->getAnswerFor($key, $value)) {
                if (!isset($answers[$key])) {
                    $answers[$key] = [];
                }

                $answers[$key] = array_merge($answers[$key], $answer);
            }
        }

        return $answers;
    }

    /**
     * @param $question
     * @param $response
     * @return array
     */
    private function getAnswerFor($question, $response)
    {
        $return = [];
        if (!is_array($response)) {
            $response = [$response];
        }

        foreach ($response as $answer) {
            if (
                array_key_exists($question, $this->answers)
                && array_key_exists($answer, $this->answers[$question])
            ) {
                $return[] = $this->answers[$question][$answer];
            }
        }

        return $return;
    }
}
