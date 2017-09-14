<?php
namespace App\Http\Controllers;

use App\QualtricsSurveyProvider;
use App\Tracker\Messaging\SMSServiceInterface;
use App\Tracker\Survey\SurveyRepository;
use App\Tracker\User\UserRepository;
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
     *
     * @todo: refactor and cleanup
     *    - Move classes
     *    - Docblocks and inline docs
     *    - Refactor to SOLID
     *
     * @todo: open source
     *    - move to github repo
     *    - work out environment variables
     *    - find a workflow for the design
     *    - connect aws to my github
     *    - documentation and readme
     *
     * @todo: first time -> user.first_time
     * @todo: finish checkboxes and undo boxes -> user.meta -> {'done':['some-id','some-other-id']}
     *
     * @todo: integrate with mailgun
     * @todo: build email message from dashboard view
     *
     * @todo: make sure I can handle international phone numbers (only matters for SMS)
     *
     * @todo: holding us back from actual business
     *      - Integrated question and answers workflow
     *      - Setting up the PushToApi call
     */
    public function store(
        Request $request,
        UserRepository $user_repo,
        SurveyRepository $survey_repo,
        SMSServiceInterface $sms
    )
    {
        $responses = $this->parseResponses($request->getContent());

        try {
            $phone = $this->getPhoneNumber($responses['phone']);
            $email = $responses['email'];
            $tenant = 1; // @todo: expand and pull from survey when there are more tenants

            $user = \DB::transaction(function () use ($user_repo, $survey_repo, $responses, $phone, $email, $tenant) {
                $user = $user_repo->addIfNeeded($phone, $email, $tenant);
                $survey_repo->addFromSurveyResponses($responses, $user->id);

                return $user; // @todo: make sure this returns
            });

            // Create Twilio Response
            $message = $this->getMessage($user->hash);
//            \Mail::to($responses['email'])->send(new DashboardEmailLink($message));
//            $sms->send($phone, $message);

//// @todo: use an actual service provider
$message = wordwrap($message, 70, "\r\n");
mail($responses['email'], 'Personalized Status', $message);

            return response($message, 200);

        } catch (\Exception $e) {
            \Log::warning("Post Failed for survey " . json_encode($responses));
            throw $e;
        }
    }

    /**
     * @param $user_id
     * @return string
     */
    private function getMessage($user_id)
    {
        $site = \Config::get('sms.DASHBOARD_SITE_URL');
        return "Follow this link to your Recovery Status page: {$site}users/{$user_id}";
    }

    function getPhoneNumber ($str) {
        preg_match_all('/\d+/', $str, $matches);
        return implode("", $matches[0]);
    }

    /**
     * @param string $request
     * @return array
     */
    protected function parseResponses($request)
    {
        // @todo: intelligently figure out which provider, as more providers are added
        $provider = new QualtricsSurveyProvider();
        return $provider->parseRequest($request);
    }
}
