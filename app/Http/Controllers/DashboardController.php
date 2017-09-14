<?php
namespace App\Http\Controllers;

use App\Tracker\Answers\SheetsJsonFeedBuilder;
use App\Tracker\Dashboard\DashboardService;
use App\Tracker\Survey\SurveyRepository;
use App\Tracker\User\User;
use Illuminate\Support\Facades\App;

/**
 * Dashboard Controller
 *
 * Controller for the personalized dashboard
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Displays the user's answers and profile
     * @param string $hash
     * @return \Illuminate\View\View
     */
    public function show($hash)
    {
        /* First, we update the answers from the google sheet */
        // @todo: only do this temporarily, until we setup the update on a schedule
        $builder = new SheetsJsonFeedBuilder();
        $builder->setSheetId(env('GSHEET_ID'));
        $builder->updateJsonFile(storage_path('content.en.json'));

        /* Grab the User */
        /** @var User $user */
        $user = User::where('hash', $hash)->first();
        if (!$user) {
            // Show a 404 if we don't have that user
            App::abort(404);
        }

        /* Find that user's latest survey */
        $survey = (new SurveyRepository())->latestForUser($user);
        if (!$survey) {
            // Show a 404 if we don't have a survey
            App::abort(404);
        }

        /* Build the data for the view */
        $data = [
            'user' => $user,
            'survey' => $survey,
            'user_hash' => $hash,
        ];

        // Build the content for the sections
        $data = array_merge(
            $data,
            DashboardService::buildContent(
                (is_string($survey->responses))
                    ? json_decode($survey->responses, true) // @todo: why is this a string sometimes?
                    : $survey->responses
            )
        );

        // Build the "answers" section
        foreach (json_decode($data['survey']->responses) as $question => $response) {
            $data['answers'][$question] = $response;
        }

        // cleanup and remove some of the answers
        $rekey = [
            'street-address' => false,
            'city' => false,
            'zip' => false,
            'lat-lon' => false,

            'adults' => 'How many adults in your group?',
            'children' => 'How many children in your group?',
            'infants' => 'How many infants in your group?',
            'pets' => 'How many pets in your group?',
        ];
        foreach ($rekey as $key => $new_key) {
            if ($new_key === false) {
                unset($data['answers'][$key]);
            } else {
                $data['answers'][$new_key] = $data['answers'][$key];
                unset($data['answers'][$key]);
            }
        }

        /* Return the view */
        return view('dashboard', $data);
    }
}
