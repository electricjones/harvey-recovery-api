<?php
namespace App;

/**
 * Class QualtricsSurveyProvider
 * @package App\Http\Controllers
 */
class QualtricsSurveyProvider
{
    /**
     * QualtricsSurveyProvider constructor.
     */
    public function __construct()
    {
    }

    public function parseRequest($request)
    {
        $decoded = urldecode($request);
        $array = [];
        parse_str($decoded, $array);

        $clean = str_replace("\\", "", array_values($array)[0]);
        $clean = str_replace("!", "", $clean);
        $clean = rtrim($clean, '"');

        $responses = json_decode($clean, true);

        return $responses;
    }
}
