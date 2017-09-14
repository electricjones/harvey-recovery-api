<?php
namespace App\Tracker\Dashboard;
use App\Tracker\Answers\Builder;
use App\Tracker\Answers\ContentMapLoader;

/**
 * Class DashboardService
 * @package App\Http\Controllers
 */
class DashboardService
{
    /**
     * Builds the answers from the survey responses (using map)
     * @param array $responses
     * @return array
     */
    public static function buildContent($responses)
    {
        $map = (new ContentMapLoader(storage_path('content.en.json')))->load();
        $builder = new Builder();
        return $builder->build($responses, $map);
    }
}
