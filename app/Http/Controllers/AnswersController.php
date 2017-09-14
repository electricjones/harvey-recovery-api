<?php
namespace App\Http\Controllers;

use App\Tracker\Answers\SheetsJsonFeedBuilder;

/**
 * Class AnswersController
 * @package App\Http\Controllers
 */
class AnswersController
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update()
    {
        $builder = new SheetsJsonFeedBuilder();
        $builder->setSheetId('1veKJ6xSapEzxJ2nOqGrsMplWHMSt_KSvunGE-uii43s');
        $builder->updateJsonFile(storage_path('content.en.json'));

        return response('Updated', 200);
    }
}
