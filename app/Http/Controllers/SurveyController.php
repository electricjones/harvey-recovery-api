<?php
namespace App\Http\Controllers;

use App\DashboardService;
use App\SMSServiceInterface;
use App\SurveyRepository;
use App\User;
use App\UserRepository;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param UserRepository $user_repo
     * @param SurveyRepository $survey_repo
     * @param SMSServiceInterface $sms
     * @return array
     * @throws \Exception
     * @todo: Write this for the actual response from the api
     * @todo: integrate this with twilio
     *
     * @todo: make this more abstractable
     * @todo: make sure I can handle international phone numbers
     */
    public function store(
        Request $request,
        UserRepository $user_repo,
        SurveyRepository $survey_repo,
        SMSServiceInterface $sms
    )
    {
        try {
            $phone = $request->input('phone');
            $user_id = User::makeId($phone);

            \DB::transaction(function () use ($user_id, $user_repo, $survey_repo, $request) {
                $survey = $survey_repo->addFromSurveyResponses($request->all(), $user_id);
                $user_repo->addFromSurveyResponses(
                    $user_id,
                    $request->all(),
                    DashboardService::buildContent($survey)
                );
            });

            // Create Twilio Response
            $message = $this->getMessage($user_id);
            $sms->send($phone, $message);

            return response($message, 200);  // @todo: does the pusher require a specific response?
        } catch (\Exception $e) {
            \Log::warning("Post Failed for survey " . json_encode($request->all()));
            throw $e;
        }
    }

    /**
     * @param $user_id
     * @return string
     */
    private function getMessage($user_id)
    {
        $site = env('DASHBOARD_SITE_URL');
        return "Thank you for answering those questions. You can find your personalized Recovery Tracker at {$site}/users/{$user_id}";
    }
}

//<p>If you need help with routine and life-saving <strong>medical treatment or medicines</strong>, please see <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001801634" target="_blank">this resource</a> for trusted help.</p>
//
//<p>If you need <strong>immediate shelter</strong>, please use <a href="https://johnnyqbui.github.io/Houston-Shelters/" target="_blank">this map</a> to find shelters that are accepting people.</p>
//
//<p>If you need <strong>food for the long term</strong>, please <a href="http://www.houstonfoodbank.org/services/if-you-need-food" target="_blank">use this resource</a> to find local food banks.</p>
//
//<p>If <strong>your home is flooded</strong> the first thing you should do is <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001746874" target="_blank">register with FEMA</a>, even if you do not need housing. They will have disaster relief funds you may be entitled to. Next, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001820393" target="_blank">follow this guide</a> to begin the recovery process.</p>
