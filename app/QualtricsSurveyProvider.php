<?php
namespace App;

/**
 * Class QualtricsSurveyProvider
 * @package App\Http\Controllers
 */
class QualtricsSurveyProvider
{
    /**
     * Turns the url-encoded request into a usable array of responses
     * @param $request
     * @return mixed
     */
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
