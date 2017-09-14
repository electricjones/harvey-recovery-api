<?php
namespace Tests\Unit;

use App\DashboardService;
use App\Survey;
use App\SurveyRepository;
use App\User;
use App\UserRepository;
use Tests\TestCase;

// @todo: write actual tests
class ExampleTest extends TestCase
{
    protected $survey = [
        'phone' => '832-998-7271',
        'completing_for' => Survey::COMPLETE_FOR_MYSELF,
        'medical_help' => Survey::ANSWER_NO,
        'location_home' => '111111',
        'location_now' => '222222',
        'group_count' => '2',
        'shelter' => Survey::ANSWER_NO,
        'food' => Survey::FOOD_LONG_TERM,
        'home_flood' => Survey::ANSWER_NO,
        'find' => [Survey::FIND_PETS, Survey::FIND_PEOPLE],
    ];

    public function test_post_a_survey_to_a_user()
    {
        // repos
        $user_repo = new UserRepository();
        $survey_repo = new SurveyRepository();
        $request = collect($this->survey);
        $phone = '111-111-1111';

        // In the controller
        $user_id = User::makeId($phone);

        $survey = $survey_repo->addFromSurveyResponses($request->all(), $user_id);
        $user_repo->addFromSurveyResponses(
            $user_id,
            $request->all(),
            $content = DashboardService::buildContent($survey)
        );

        // Tests
        $this->assertTrue(
            str_contains($content, ['find my pets', 'find people', 'long term'])
        );
    }
}
