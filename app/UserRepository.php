<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRepository
 * @package App\Http\Controllers
 */
class UserRepository
{
    /**
     * @param $uuid
     * @param array $responses
     * @param string $dashboard_content
     * @return User|Model
     */
    public function addFromSurveyResponses($uuid, array $responses, $dashboard_content)
    {

        $user = User::find($uuid);

        if (!$user) {
            $user = User::create([
                'uuid' => $uuid,
                'phone' => $responses['phone'],
                'location_home' => $responses['location_home'],
                'location_now' => $responses['location_now'],
                'group_count' => $responses['group_count'],
                'dashboard_content' => $dashboard_content,
            ]);
        } else {
            $user->dashboard_content = $dashboard_content;
            $user->save();
        }

        return $user;
    }
}
