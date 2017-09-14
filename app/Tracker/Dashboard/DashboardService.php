<?php
namespace App\Tracker\Dashboard;
use App\Tracker\Answers\Builder;
use App\Tracker\Answers\JsonLoader;

/**
 * Class DashboardService
 * @package App\Http\Controllers
 */
class DashboardService
{
    public static function buildContent($responses)
    {
        $map = (new JsonLoader(storage_path('content.en.json')))->load();
        $builder = new Builder();
        return $builder->build($responses, $map);
    }
}
