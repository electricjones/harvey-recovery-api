<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    /**
     * Displays the user's answers and profiles
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if (!$user) {
            App::abort(404);
        }

        return view('dashboard', [
            'content' => $user->dashboard_content,
        ]);
    }
}
