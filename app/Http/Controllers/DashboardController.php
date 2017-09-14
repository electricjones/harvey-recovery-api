<?php
namespace App\Http\Controllers;

use App\Tracker\Answers\SheetsJsonFeedBuilder;
use App\Tracker\Dashboard\DashboardService;
use App\Tracker\Survey\SurveyRepository;
use App\Tracker\User\User;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    /**
     * Displays the user's answers and profiles
     * @param $hash
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($hash)
    {
        $builder = new SheetsJsonFeedBuilder();
        $builder->setSheetId('1veKJ6xSapEzxJ2nOqGrsMplWHMSt_KSvunGE-uii43s');
        $builder->updateJsonFile(storage_path('content.en.json'));

        /** @var User $user */
        $user = User::where('hash', $hash)->first();

        if (!$user) {
            App::abort(404);
        }

        $survey = (new SurveyRepository())->latestForUser($user);

        if (!$survey) {
            App::abort(404);
        }

        $data = [
            'user' => $user,
            'survey' => $survey,
            'user_hash' => $hash,
        ];

        $data = array_merge(
            $data,
            DashboardService::buildContent(
                (is_string($survey->responses))
                    ? json_decode($survey->responses, true) // @todo: why is this a string sometimes?
                    : $survey->responses
            )
        );

        // Build the answers section
        foreach (json_decode($data['survey']->responses) as $question => $response) {
            $data['answers'][$question] = $response;
        }

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

        return view('dashboard', $data);
    }
}
