<?php
namespace App;

/**
 * Class DashboardService
 * @package App\Http\Controllers
 */
class DashboardService
{
    public static function buildContent(Survey $survey)
    {
        $answer_generator = new Answers();
        $answers = $answer_generator->forSurvey($survey);
        $content = '';
        foreach ($answers as $topic) {
            foreach ($topic as $answer) {
                $content .= "<p>{$answer}</p>";
            }
        }

        return $content;
    }
}
